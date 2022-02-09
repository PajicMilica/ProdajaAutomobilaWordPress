<?php
	if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
		die( 'These are not the droids you are looking for.' );
	}
global $wpdb;
$lid   = (isset($_GET['lid']) && $_GET['lid']!=''?intval($_GET['lid']):'');
if ( ! $lid ) {
	if ( isset( $_POST['lid'] ) ) {
		$lid = intval($_POST['lid']);
	}
}
include_once $this->WPMST_PLUGIN_DIR."/models/MailsterModelList.php";
include_once $this->WPMST_PLUGIN_DIR."/models/MailsterModelUser.php";
$list = null;
if($lid) {
	$list = new MailsterModelList($lid);
} else {
	$list = new MailsterModelList();
}
$User = new MailsterModelUser();
$log = MstFactory::getLogger();
$newUsers = array();
$removedUsers = array();
$newRecipientCounter = 0;
$removedRecipientsCounter = 0;
$messages = array();

if ( isset( $_POST[ "tab" ] ) && intval($_POST[ "tab" ]) == 2 ) {
    $log->debug('mst_list_groups_add -> tab 2');
    $mstRecipients = MstFactory::getRecipients();
    $listUtils = MstFactory::getMailingListUtils();
    $mList = $listUtils->getMailingList(intval($lid));
    $oldRecipCount = $mstRecipients->getTotalRecipientsCount($lid); // get old, cached number
    $currentListMembers = $list->getAllListMembers();
    $oldListMembersCount = count($currentListMembers); // get count of recipients part of directly added recipients
	if(isset($_POST[ 'to' ])) {

        foreach ( $_POST['to'] as $futureRecipUserInfo ) {
            if ( isset( $futureRecipUserInfo ) && $futureRecipUserInfo != '' ) {
                $futureRecipUserData  = explode( '-', $futureRecipUserInfo );
                $user_id      = $futureRecipUserData[0];
                $is_core_user = $futureRecipUserData[1];
                // $log->debug( 'getUserData: user_id: ' . intval( $user_id ) . ', is_core_user: ' . intval( $is_core_user ) );
                $userRow = $User->getUserData( intval( $user_id ), intval( $is_core_user ) );
                $isListMember = false;
                if ( $userRow ) {
                    for($i = 0; $i < count($currentListMembers); $i++){
                        if($currentListMembers[$i]->user_id == $user_id && $currentListMembers[$i]->is_core_user == $is_core_user){
                            $currentListMembers[$i]->willStay = true;
                            // this is a member that is already a recipient
                            $isListMember = true;
                            break;
                        }
                    }

                    if ( ! $isListMember ) {
                        $isRecip = $mstRecipients->isRecipient( intval( $lid ), $userRow->email ); // even if is not a current list member, this user could be a recipient through a group....
                        $userRow->isRecip = $isRecip;
                        if( ! $isRecip ) {
                            $newRecipientCounter ++; // is not a recipient yet, but will be soon and thus will increase total user count
                        }
                        $newUsers[] = $userRow; // put it on the list to add to list members
                    }
                }

            }
        }

        // $log->debug('After checking for new users, currentListMembers: '.print_r($currentListMembers, true));
        // $log->debug('After checking for new users, newUsers: '.print_r($newUsers, true));

        // Now let us look which list members will no longer be among the list members...
        for($i = 0; $i < count($currentListMembers); $i++){
            if(!property_exists($currentListMembers[$i], 'willStay') || $currentListMembers[$i]->willStay === false){
                $removedUsers[] = $currentListMembers[$i];
                // technically we would need to look if the user is a recipient through a group
                // (in that case the $removedRecipientsCounter variable must not be incremented),
                // but we risk this for now...
                $removedRecipientsCounter++;
            }
        }


        $futureCount = $oldRecipCount - $removedRecipientsCounter + $newRecipientCounter;

        /*
        $log->debug('oldRecipCount: '.$oldRecipCount);
        $log->debug('removedRecipientsCounter: '.$removedRecipientsCounter);
        $log->debug('newRecipientCounter: '.$newRecipientCounter);
        $log->debug('futureCount: '.$futureCount);
        $log->debug('removedUsers: '.print_r($removedUsers, true));
        $log->debug('newUsers: '.print_r($newUsers, true));
        */

        //do something about over limit
        if($futureCount >  MstFactory::getV()->getFtSetting(MstVersionMgmt::MST_FT_ID_REC) ) {
            $messages[] = $this->wpmst_view_message("error", __("Too many recipients, max list members limit reached.", 'wp-mailster'));
        } else {
            //remove existing users ...
            foreach($removedUsers AS $removedUser){
                $list->removeUserById( intval($removedUser->user_id), intval($removedUser->is_core_user) );
            }
            // ... and add the new users
            foreach($newUsers AS $newUser){
                $res = $list->addUserById( intval($newUser->id), intval($newUser->is_core_user) );
                if ( $res && !$newUser->isRecip && $mList && $mList->welcome_msg > 0 && $mList->welcome_msg_admin > 0 ) {
                    $subscrUtils = MstFactory::getSubscribeUtils();
                    //$log->debug('mst_list_members_add add user ' .print_r($newUser, true));
                    $subscrUtils->sendWelcomeOrGoodbyeSubscriberMsg( $newUser->name, $newUser->email, intval( $lid ), MstConsts::SUB_TYPE_SUBSCRIBE );
                    $log->debug( 'mst_list_members_add sent welcome message to user_id: '.intval($newUser->id).' (core: '.intval($newUser->is_core_user).'): ' . $newUser->name . ', ' . $newUser->email );
                }
            }

            if($newRecipientCounter > 0){
                $messages[] = $this->wpmst_view_message("updated", sprintf(__("%d user(s) were added to list", 'wp-mailster'), $newRecipientCounter));
            }
            if($removedRecipientsCounter > 0){
                $messages[] = $this->wpmst_view_message("updated", sprintf(__("%d user(s) were removed from the list", 'wp-mailster'), $removedRecipientsCounter));
            }
            if($newRecipientCounter > 0 || $removedRecipientsCounter > 0){
                $mstRecipients->recipientsUpdated($lid);
            }
        }
    }else{
        // there are no recipients present (at least now)
        if($oldListMembersCount > 0){
            // in the past there are recipients, so remove all of them
            foreach($currentListMembers AS $currentListMember){
                $list->removeUserById( intval($currentListMember->user_id), intval($currentListMember->is_core_user) );
            }
            $mstRecipients->recipientsUpdated($lid);
            $messages[] = $this->wpmst_view_message("updated", sprintf(__("%d user(s) were removed from the list", 'wp-mailster'), $oldListMembersCount));
        }
    }
}

// get fresh current status of members
$listMembers = $list->getAllListMembers();
$selected = array();
foreach( $listMembers as $listmember ) {
	$selected[  ] = $listmember->user_id . '-' . $listmember->is_core_user;
}
// get all users with names and emails
$allUsers  = $User->getAllUsers();
$listData = $list->getData();
//$log->debug('allUsers: '.print_r($allUsers, true));
$nonMembers = array();
$existingMembers = array();
for($i=0;$i<count($allUsers);$i++){
    $userIdValue = $allUsers[$i]->uid . '-' . $allUsers[$i]->is_core_user;
    if(in_array($userIdValue, $selected)){
        $existingMembers[] = $allUsers[$i];
    }else{
        $nonMembers[] = $allUsers[$i];
    }
}

?>
<div class="mst_container">
	<div class="wrap">
		<h2><?php echo $listData[0]->name . " - " . __("Manage Members", 'wp-mailster'); ?></h2>
		<?php $this->wpmst_print_messages($messages); ?>
		<div id="mst_list_members" class="mst_listing mst_list_members">
			<div class="wptl_container">
				<div class="wrap">
					<h4><?php _e("Manage List Members", "mailster"); ?></h4>
					<form action="" method="post" onsubmit="return markAllAndSubmit();">
						<?php wp_nonce_field( 'add-list-member_'.$lid ); ?>
						<div class="ms2side__header"><?php _e("Choose users to add to list", 'wp-mailster'); ?></div>
                        <div class="ms2side__div">
                            <div class="ms2side__select">
                                <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple"><?php
                                    foreach( $nonMembers as $nonMember ) {
                                        $userIdValue = $nonMember->uid . '-' . $nonMember->is_core_user;
                                        $userType = (( isset( $nonMember->is_core_user ) && ($nonMember->is_core_user==1)) ? 'WP User' : 'Mailster');
                                        $userName = ($nonMember->Name == "" ) ? __("(no name)", 'wp-mailster') : $nonMember->Name;
                                        ?><option value="<?php echo $userIdValue; ?>"><?php echo $userName . '&lt;'.$nonMember->Email.'&gt; ('. $userType . ')'; ?></option><?php } ?>
                                </select>
                            </div>

                            <div class="ms2side__options">
                                <button type="button" id="multiselect_rightAll" class="btn btn-block" title="<?php echo __("Add all", 'wp-mailster');?>">&raquo;</button>
                                <button type="button" id="multiselect_rightSelected" class="btn btn-block" title="<?php echo __("Add selected", 'wp-mailster');?>">&gt;</button>
                                <button type="button" id="multiselect_leftSelected" class="btn btn-block" title="<?php echo __("Remove selected", 'wp-mailster');?>">&lt;</button>
                                <button type="button" id="multiselect_leftAll" class="btn btn-block" title="<?php echo __("Remove all", 'wp-mailster');?>">&laquo;</i></button>
                            </div>

                            <div class="ms2side__select">
                                <select name="to[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"><?php
                                    foreach( $existingMembers as $listmember ) {
                                        $userIdValue = $listmember->uid . '-' . $listmember->is_core_user;
                                        $userType = (( isset( $listmember->is_core_user ) && ($listmember->is_core_user==1)) ? 'WP User' : 'Mailster');
                                        $userName = ($listmember->Name == "" ) ? __("(no name)", 'wp-mailster') : $listmember->Name;
                                    ?><option value="<?php echo $userIdValue; ?>"><?php echo $userName . '&lt;'.$listmember->Email.'&gt; ('. $userType . ')'; ?></option><?php } ?>
                                </select>
                            </div>
                        </div>
					<table style="display:block;clear:both;width:100%;">
						<tr class="form-field">
							<th scope="row"><label for="submit"></label></th>
							<td>
								<a href="<?php echo admin_url(); ?>admin.php?page=mst_mailing_lists&amp;subpage=recipients&amp;lid=<?php echo $lid; ?>"><?php _e("Back", 'wp-mailster'); ?></a>
								<input type="hidden" name="tab" value="2">
								<input type="submit" class="button-primary" name="user_action" value="<?php _e("Save changes" ,'wp-mailster'); ?>">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    function markAllAndSubmit(){
        //jQuery('ms2side__dx option').attr('selected', 'selected');
        return true;
    }
</script>