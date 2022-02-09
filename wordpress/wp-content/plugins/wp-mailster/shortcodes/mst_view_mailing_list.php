<?php
	if ( preg_match( '#' . basename( __FILE__ ) . '#', $_SERVER['PHP_SELF'] ) ) {
		die( 'These are not the droids you are looking for.' );
	}

	class mst_frontend_mailing_list extends wpmst_mailster {
        public static function mst_shortcode_not_available_mst_mailing_lists( $atts, $content = "" ) {
            return sprintf(__( "Shortcode %s not available in product edition %s", 'wp-mailster' ), '[mst_mailing_lists]', MstFactory::getV()->getProductName());
        }
        public static function mst_shortcode_not_available_mst_emails( $atts, $content = "" ) {
            return sprintf(__( "Shortcode %s not available in product edition %s", 'wp-mailster' ), '[mst_emails]', MstFactory::getV()->getProductName());
        }

		public static function mst_mailing_lists_frontend( $atts, $content = "" ) {
            if ( is_admin()){
                return;
            }
            $log = MstFactory::getLogger();
            $log->debug('Shortcode mst_mailing_lists_frontend atts: '.print_r($atts, true).', subpage: '.(isset( $_GET['subpage'] ) ? $_GET['subpage'] : ' - not set -'));
			ob_start();
            if ( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'mailstermails' ) {
				include "mails.php";
			} else if ( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'mailstermail' ) {
				include "mail.php";
			} else if ( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'mailsterthreads' ) {
				include "threads.php";
			} else if ( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'mailsterthread' ) {
				include "thread.php";
			}else {
				if( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'subscribe' ) {
					//subscribe the user
					$log = MstFactory::getLogger();
					$subscrUtils = MstFactory::getSubscribeUtils();
					$user = wp_get_current_user();
					$listId = intval($_GET['listID']);
                    $userObj = MstFactory::getUserModel()->getUserData($user->ID, true);
                    $userName = (property_exists($userObj, 'name') && $userObj->name && !empty($userObj->name) && (strlen(trim($userObj->name))>0)) ? $userObj->name : $user->display_name;
					$success = $subscrUtils->subscribeUser($userName, $user->user_email, $listId, 0); // subscribing user...
					$subscrUtils->sendWelcomeOrGoodbyeSubscriberMsg($userName, $user->user_email, $listId, MstConsts::SUB_TYPE_SUBSCRIBE);
					if($success == false){
						$mstRecipients = MstFactory::getRecipients();
						$cr = $mstRecipients->getTotalRecipientsCount($listId);
						if($cr >= MstFactory::getV()->getFtSetting(MstVersionMgmt::MST_FT_ID_REC)){
							$log->debug('Too many recipients!');
							_e( 'Cannot subscribe', 'wp-mailster' );
							_e( 'Too many recipients (Product limit)', 'wp-mailster' );
						}
					}else{
						// ####### TRIGGER NEW EVENT #######
						$mstEvents = MstFactory::getEvents();
						$mstEvents->userSubscribedOnWebsite($userName, $user->user_email, $listId);
						// #################################
						_e( 'Subscription successful', 'wp-mailster' );
					}
				} else if( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'unsubscribe' ) {
					//unsubscibe the user
					$subscrUtils = MstFactory::getSubscribeUtils();
					$user = wp_get_current_user();
					$listId = intval($_GET['listID']);
					$success = $subscrUtils->unsubscribeUser($user->user_email, $listId); // unsubscribing user...
					$tmpUser = $subscrUtils->getUserByEmail($user->user_email);
					$subscrUtils->sendWelcomeOrGoodbyeSubscriberMsg($tmpUser['name'], $user->user_email, $listId, MstConsts::SUB_TYPE_UNSUBSCRIBE);
					// ####### TRIGGER NEW EVENT #######
					$mstEvents = MstFactory::getEvents();
					$mstEvents->userUnsubscribedOnWebsite($user->user_email, $listId);
					if($success) {
						_e( 'Unsubscription successful', 'wp-mailster' );
					} else {
						_e( 'There was a problem unsubscribing you from this list', 'wp-mailster' );
					}
				}


				$uid = ( isset( $_REQUEST['uid'] ) && $_REQUEST['uid'] != '' ? intval( $_REQUEST['uid'] ) : '' );
				$lid = ( isset( $_REQUEST['lid'] ) && $_REQUEST['lid'] != '' ? intval( $_REQUEST['lid'] ) : '' );
                global $wpdb;
				$query = "SELECT id, name, admin_mail, list_mail, active, allow_subscribe, allow_unsubscribe FROM " . $wpdb->prefix . "mailster_lists WHERE front_archive_access != ".MstConsts::FRONT_ARCHIVE_ACCESS_NOBODY;
				$mLists = $wpdb->get_results($query);
				MstFactory::getAuthorization();
				?>
				<div class="mst_container">
					<div class="wrap">
						<h4><?php _e( "Mailing Lists", 'wp-mailster' ); ?></h4>
						<form>
							<table id="mst_table" class="wp-list-table widefat fixed striped posts">
								<thead>
                                    <tr>
                                        <td class="mailster_lists_name"><?php _e( "Name", 'wp-mailster' ); ?></td>
                                        <td class="mailster_lists_list_email"><?php _e( "Mailing list email", 'wp-mailster' ); ?></td>
                                        <td class="mailster_lists_emails"><?php _e( "Emails", 'wp-mailster' ); ?></td>
                                        <td class="mailster_lists_actions"></td>
                                    </tr>
								</thead>
								<tbody id="the-list">
								<?php
									if ( ! empty( $mLists ) ) {
										foreach ( $mLists as $mLists ) {
											if(MstAuthorization::userHasAccess($mLists->id)) {
												$id = $mLists->id;
												?>
												<tr>
													<td class="mailster_lists_name"><?php echo $mLists->name; ?></td>
													<td class="mailster_lists_list_email"><?php echo $mLists->list_mail; ?></td>
													<td class="mailster_lists_emails">
														<a href="?subpage=mailstermails&lid=<?php echo $id; ?>"><?php _e( "View emails", 'wp-mailster' ); ?></a><br/>
														<a href="?subpage=mailsterthreads&list_choice=<?php echo $id; ?>"><?php _e( "View emails in threads", 'wp-mailster' ); ?></a>
													</td>
													<td class="mailster_lists_actions">
														<?php
														$actionPossible = false;
														$actionTitle = '';
														$actionLink = '';
														$backlink ="";
														$listUtils = MstFactory::getMailingListUtils();
														$list = $listUtils->getMailingList($id);

														if($listUtils->isSubscribed($id)){
															$actionTitle = __( 'Unsubscribe', 'wp-mailster');
															$actionLink =  '?subpage=unsubscribe&listID='. $id.'&bl='.$backlink ;
															if($mLists->allow_unsubscribe){
																$actionPossible = true;
															}
														}else{
															$actionTitle = __( 'Subscribe', 'wp-mailster');
															$actionLink = '?subpage=subscribe&listID='. $id.'&bl='.$backlink ;
															if($mLists->allow_subscribe){
																$actionPossible = true;
															}
														}
														if($actionPossible):
															?><a href="<?php echo $actionLink; ?>"><?php echo $actionTitle; ?></a>
														<?php endif;?>
													</td>
												</tr>
												<?php
													}
												}
											} else {
											?>
										<tr>
											<td align="center"
												colspan="5"><?php _e( "No record found", 'wp-mailster' ); ?>!
											</td>
										</tr>
										<?php } ?>
								</tbody>
							</table>
						</form>
						<input type='hidden' id='ajax_url' name='ajax_url'
							   value="<?php echo admin_url( 'admin-ajax.php' ) ?>">
						<button class="btn btn-primary" id="printclick"
								onclick="mst_print_Function()"><?php _e( "Print this page", 'wp-mailster' ); ?></button>
					</div>
				</div>
				<script type='application/javascript'>
					jQuery(document).ready(function ($) {
						$('#mst_table').DataTable({
							responsive: true,
							aaSorting: [[0, 'asc']],
							aoColumnDefs: [
								{"aTargets": [2], "bSortable": false},
								{"aTargets": [3], "bSortable": false},
								{"aTargets": [4], "bSortable": false}
							]
						});
					});
					function mst_print_Function() {
						window.print();
					}
				</script>
				<?php
			}
			return ob_get_clean();
		}

		public static function mst_emails_frontend( $atts, $content = "" ) {
            if ( is_admin()){
                return;
            }
            $log = MstFactory::getLogger();
            $log->debug('Shortcode mst_emails_frontend atts: '.print_r($atts, true));
            if(is_array($atts) && array_key_exists('lid', $atts)){
			    $listId = (int)$atts['lid'];
            }else{
                $listId = 0;
            }
            if(is_array($atts) && array_key_exists('order', $atts)){
                $orderParam = strtolower(trim($atts['order']));
                switch($orderParam){
                    case 'asc':
                        $msgOrder = 'asc';
                        break;
                    case 'desc':
                        $msgOrder = 'rfirst'; // recent first
                        break;
                    case 'oldfirst':
                        $msgOrder = 'asc';
                        break;
                    case 'newfirst':
                        $msgOrder = 'rfirst';
                        break;
                    case 'oldestfirst':
                        $msgOrder = 'asc';
                        break;
                    case 'newestfirst':
                        $msgOrder = 'rfirst';
                        break;
                    case 'old':
                        $msgOrder = 'asc';
                        break;
                    case 'new':
                        $msgOrder = 'rfirst';
                        break;
                    case 'rfirst':
                        $msgOrder = 'rfirst';
                        break;
                    default:
                        $msgOrder = 'rfirst';
                }
            }else{
                $msgOrder = 'rfirst';
            }
			if ( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'mailstermail' ) {
                ob_start();
				include "mail.php";
                return ob_get_clean();
			} else {
                ob_start();
                include "mails.php";
                return ob_get_clean();
			}
		}

		public static function mst_profile() {
            if ( is_admin()){
                return;
            }
			ob_start();
			if ( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'profile_subscribe' ) {
				include "profile_subscribe.php";
                include "profile.php";
			} else if ( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'profile_unsubscribe' ) {
				include "profile_unsubscribe.php";
				include "profile.php";
			} else if ( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'digest' ) {
				include "profile_digest.php";
				include "profile.php";
			} else {
				include "profile.php";
			}
			return ob_get_clean();
		}
	}