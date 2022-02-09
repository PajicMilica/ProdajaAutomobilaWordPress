<?php
if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
	die('These are not the droids you are looking for.');
}

include_once $this->WPMST_PLUGIN_DIR."/models/MailsterModelGroup.php";
include_once $this->WPMST_PLUGIN_DIR."/models/MailsterModelUser.php";

$sid   = (isset($_GET['sid']) && $_GET['sid']!=''?intval($_GET['sid']):'');
if ( ! $sid ) {
	if ( isset( $_POST['sid'] ) ) {
		$sid = intval($_POST['sid']);
	}
}

$title  = __("New Group", 'wp-mailster');
$button = __('Add Group', 'wp-mailster');
$action = 'add';
$message = "";
$options = array();

$Group = null;
$User = new MailsterModelUser();

if($sid) {
	$Group = new MailsterModelGroup($sid);
} else {
	$Group = new MailsterModelGroup();
}

if( isset($_POST['group_action']) && !is_null($_POST['group_action']) ) { //if form is submitted
	if ( isset( $_POST[ 'add_group' ] ) ) {
		$addGroup = sanitize_text_field($_POST['add_group']);
		if( intval($_POST[ 'sid' ]) ) {
			$group_options[ 'id' ] = intval($_POST[ 'sid' ]);
		}
		$group_options[ 'name' ] = sanitize_text_field($_POST[ 'group_name' ]);
		
		$Group->saveData( $group_options, $addGroup );
		$sid = $Group->getId();

		//if we are editing an existing group, we can add members
		if ( $addGroup == 'edit' ) {
			//remove all members and then insert all new ones
			$Group->emtpyUsers();
			//insert the selected members in the group
			if( $_POST['to'] ) {
				foreach ( $_POST['to'] as $k => $v ) {
					if( isset( $v ) && $v != '' ) {
						$val = explode( '-', $v );
						$user_id = intval($val[0]);
						$is_core_user = intval($val[1]);
						$res = $Group->addUserById( $user_id, $is_core_user );
					}
				}
			}
		}
	}
}	
$values = null;
if($sid) {
	$title = __("Edit Group", 'wp-mailster');
	$button = __('Update Group', 'wp-mailster');
	$action = 'edit'; 
}

if( $sid ) {
	//get all users (wp and mailster)
    $allUsers  = $User->getAllUsers();
	//get all the group's users
	$grp_list = $Group->getAllUsers();
	$selected = array();
	foreach($grp_list as $gv){
		$selected[] = $gv->user_id.'-'.$gv->is_core_user;
	}

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

}

$options = $Group->getFormData();
?>

<div class="mst_container">
	<div class="wrap">
		<h2><?php echo $title; ?></h2>
		<?php echo (isset($message) && $message!=''?$message:'');?>
		<form action="" method="post">
			<?php wp_nonce_field( 'add-group_'.$sid ); ?>
			<table class="form-table">
				<tbody>
					<?php
					$this->mst_display_hidden_field( "sid", $sid );
					$this->mst_display_hidden_field( "add_group", $action );
					$this->mst_display_input_field( __("Group Name", 'wp-mailster'), 'group_name', $options->name, null, false, false, null );
					?>
				</tbody>
			</table>

			<?php if( $sid ) { ?>
                <div class="ms2side__header"><?php __("Choose users to add to group",'wp-mailster'); ?></div>
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

			<?php } ?>
			<input type="submit" class="button-primary" name="group_action" value="<?php echo $button; ?>">
		</form>
	</div>
</div>