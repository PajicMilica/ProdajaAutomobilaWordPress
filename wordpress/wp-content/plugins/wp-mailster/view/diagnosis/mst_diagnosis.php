<?php
	if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
		die('These are not the droids you are looking for.');
	}
	/**
	 * @copyright (C) 2016 - 2020 Holger Brandt IT Solutions
	 * @license GNU/GPL, see license.txt
	 * WP Mailster is free software; you can redistribute it and/or
	 * modify it under the terms of the GNU General Public License 2
	 * as published by the Free Software Foundation.
	 *
	 * WP Mailster is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with WP Mailster; if not, write to the Free Software
	 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA
	 * or see http://www.gnu.org/licenses/.
	 */

	$log		= MstFactory::getLogger();
	$mstUtils 	= MstFactory::getUtils();
	$mstConfig	= MstFactory::getConfig();
	$env 		= MstFactory::getEnvironment();
	$dbUtils 	= MstFactory::getDBUtils();
	$fileUtils 	= MstFactory::getFileUtils();
    $dateUtils  = MstFactory::getDateUtils();
	global $wpdb;
	$appName = MstFactory::getV()->getProductName();
	global $wp_version;
	require_once plugin_dir_path( __FILE__ )."../../models/MailsterModelMailster.php";
	$Mailster = new MailsterModelMailster();
	$data = $Mailster->getData();
    $mstversion = mst_get_version();
    global $wp_version;
?>
    <script type="text/javascript">
        var callBackLicSubInfo = function subInfoResult(response){
            if(response) {
                var resultObject = eval(response);
                console.log(resultObject);
                if(resultObject && resultObject.licenseInfo) {
                    var htmlInfo = '<p>';
                    htmlInfo += '<strong><?php echo esc_html__( 'Product Edition', 'wp-mailster' ); ?>:</strong> '+resultObject.licenseInfo.item+'<br/>';
                    htmlInfo += '<strong><?php echo esc_html__( 'License Key', 'wp-mailster' ); ?>:</strong> '+resultObject.licenseInfo.key+'<br/>';
                    htmlInfo += '<strong><?php echo esc_html__( 'License Expiration', 'wp-mailster' ); ?>:</strong> '+resultObject.licenseInfo.expires_formatted+(resultObject.licenseInfo.is_expired?' <strong style="color:red"><?php echo esc_html('[ ').esc_html__( 'Expired', 'wp-mailster' ).esc_html(' ]'); ?></strong>':'');
                    htmlInfo += '</p>';
                    jQuery('.wpmst-license-msg-detail').html(htmlInfo);
                    jQuery('.wpmst-license-msg').show(250);
                } else {
                    jQuery('.wpmst-license-msg-detail').html('<strong style="color:red"><?php echo esc_html(sprintf(__( 'No license information found for license %s', 'wp-mailster' ), trim(get_option('wpmst_cfg_license_key')))); ?></strong>');
                    jQuery('.wpmst-license-msg').show(250);
                }
                saveLicChkResult(resultObject.days_left, resultObject.expiry_date, resultObject.expiry_status, resultObject.version);
            }else{
                console.log("Could not complete ajax request");
                jQuery('.wpmst-license-msg').hide(250);
            }
        };
        jQuery(document).ready(function() {
            var license_key = <?php echo json_encode(trim(get_option('wpmst_cfg_license_key'))); ?>;
            if(license_key.length > 0 && <?php echo (get_option('wpmst_cfg_version_license') !== 'free' || get_option('wpmst_cfg_current_version') !== 'free') ? 'true' : 'false'; ?> && <?php echo get_option('wpmst_cfg_allow_send') > 0 ? 'true' : 'false';  ?> ){
                getLicSubInfo(license_key, <?php echo json_encode($mstversion); ?>, <?php echo json_encode($wp_version); ?>, <?php echo json_encode(get_option('date_format')); ?>, callBackLicSubInfo);
            }
        });
    </script>
	<table class="adminform">
		<tr><th><?php _e( 'System Properties', 'wp-mailster' ); ?></th><th></th><th>&nbsp;</th></tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php echo $appName; ?>:</td>
			<td width="450px"><?php echo MstFactory::getV()->getProductVersion(true); ?></td>
			<td>&nbsp;</td>
		</tr>
        <tr class="wpmst-license-msg" style="display:none;">
            <td width="150px" style="text-align:right;"><?php echo __( 'License', 'wp-mailster' ); ?>:</td>
            <td width="450px" class="wpmst-license-msg-detail"><?php echo get_option('wpmst_cfg_license_key'); ?></td>
            <td>&nbsp;</td>
        </tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'Date', 'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo MstFactory::getV()->getProductDate(); ?></td>
			<td>&nbsp;</td>
		</tr>
        <tr>
            <td width="150px" style="text-align:right;"><?php _e( 'Database', 'wp-mailster' ); ?> (<?php _e( 'Version', 'wp-mailster' ); ?>):</td>
            <td width="450px"><?php echo get_option('wpmst_cfg_mailster_db_version'); ?></td>
            <td>&nbsp;</td>
        </tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'Operating System',  'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo php_uname(); ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'PHP version', 'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo phpversion(); ?> </td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'Max. Execution Time', 'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo ini_get('max_execution_time'); ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'Memory Limit', 'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo ini_get('memory_limit'); ?> (<?php echo $fileUtils->getFileSizeStringForSizeInBytes(memory_get_peak_usage(true)); ?>)</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php echo 'parse_ini_file'; ?>:</td>
			<td width="450px"><?php echo function_exists('parse_ini_file') ? 'OK' : 'ERROR - parse_ini_file DISABLED!'; ?> </td>
			<td>&nbsp;</td>
		</tr>
        <tr>
            <td width="150px" style="text-align:right;"><?php echo 'iconv / mb_convert_encoding'; ?>:</td>
            <td width="450px"><?php echo $env->charsetConversionFunctionAvailable() ? 'OK' : ('ERROR - iconv / mb_convert_encoding not available!<br/>'.__("No charset conversion functionality available, please check system requirements", 'wp-mailster')); ?> </td>
            <td>&nbsp;</td>
        </tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php echo 'PHP Disabled Functions'; ?>:</td>
			<td width="450px"><?php
					$disabled_functions = ini_get('disable_functions');
					if ($disabled_functions!='')
					{
						$arr = explode(',', $disabled_functions);
						sort($arr);
						echo implode(', ', $arr);
					}else{
						_e('None', 'wp-mailster');
					}
				?> </td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'Database version', 'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo $wpdb->db_version(); ?> </td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;"></td>
			<td width="450px">
				<?php
					function mstCheck_imap_mime_header_decode(){
						$convUtils = MstFactory::getConverterUtils();
						$sub = 'Umlaut =?ISO-8859-15?Q?=FCberall_Test?=';
						$exp = $convUtils->imapUtf8('Umlaut ??berall Test');
						$subConv = $convUtils->getStringAsNativeUtf8($sub);
						if(($subConv) !== ($exp)){
							echo 'imap_mime_header_decode (ERROR)<br/>';
							echo 'Expected: ' . htmlentities($exp) . '<br/>';
							echo 'Actual (imap_mime_header_decode): ' . htmlentities($subConv) . '<br/><br/>';
							echo '<pre>'.print_r(imap_mime_header_decode($sub), true).'</pre><br/>';
							echo 'imapUtf8 ('.($convUtils->imapUtf8($sub) === ($exp) ? 'OK' : 'ERROR').')<br/>';
							echo 'Actual (imapUtf8): ' . htmlentities($convUtils->imapUtf8($sub)). '<br/>';
						}else{
							echo 'imap_mime_header_decode (Test OK)';
						}
					}
                    if($env->charsetConversionFunctionAvailable()){
                        mstCheck_imap_mime_header_decode();
                    }
				?>
				<br/>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'WordPress version', 'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo $wp_version; ?> </td>
			<td>&nbsp;</td>
		</tr>
        <tr>
            <td width="150px" style="text-align:right;"><?php _e( 'Timezone' ); ?>:</td>
            <td width="450px"><?php
                $nowTime = new DateTime('now');
                $timezoneTime = new DateTime('now', $dateUtils->getWpTimezone());
                echo $nowTime->format('Y-m-d H:i:s') . ' (UTC)<br/>' .$timezoneTime->format('Y-m-d H:i:s') . ' ('.$dateUtils->getWpTimezone()->getName().')<br/>'.$dateUtils->formatDateAsConfigured().' (Local, Formatted)';
            ?></td>
            <td>&nbsp;</td>
        </tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'Site Url', 'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo get_site_url(); ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'IMAP', 'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo $env->imapExtensionInstalled() ? __( 'Loaded', 'wp-mailster' ) : __( 'No', 'wp-mailster' ); ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;">&nbsp;</td>
			<td width="450px"><?php echo __( 'Open mailbox timeout', 'wp-mailster' ) . ': ' . $mstConfig->getMailboxOpenTimeout() . ' (' . __( 'Global setting', 'wp-mailster' ) . ': ' .imap_timeout(IMAP_OPENTIMEOUT) . ')'; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;">&nbsp;</td>
			<td width="450px"><pre><?php echo $env->getImapVersion(); ?></pre></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'OpenSSL', 'wp-mailster' ); ?>:</td>
			<td width="450px"><?php echo $env->openSSLExtensionInstalled() ? __( 'Loaded', 'wp-mailster' ) : __( 'No', 'wp-mailster' ); ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;">&nbsp;</td>
			<td width="450px"><pre><?php echo $env->getOpenSSLVersion(); ?></pre></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;vertical-align:top;"><?php _e( 'Statistics', 'wp-mailster' ); ?>:</td>
			<td width="450px">
				<table cellspacing="10">
					<tr>
						<th colspan="5"><?php _e( 'General stats', 'wp-mailster' ); ?>: </th>
					</tr>
					<tr>
						<td><?php _e( 'Last email sent', 'wp-mailster' ); ?>: </td>
						<td><?php echo $mstConfig->getLastMailSentAt(); ?></td>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td><?php echo __( 'Last hour mails sent in', 'wp-mailster' ) . ' ('. __('day', 'wp-mailster').'): '; ?></td>
						<td><?php echo $mstConfig->getLastHourMailSentIn() . ' ('.$mstConfig->getLastDayMailSentIn().')'; ?></td>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td><?php echo _e( 'Number of mails sent in last hour', 'wp-mailster' ) . ' ('. __('day', 'wp-mailster').'): '; ?></td>
						<td><?php echo $mstConfig->getNrOfMailsSentInLastHour(). ' ('.$mstConfig->getNrOfMailsSentInLastDay().')'; ?></td>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="5">&nbsp;</td>
					</tr>
					<tr>
						<th colspan="5"><?php _e( 'Mailing lists', 'wp-mailster' ); ?>: </th>
					</tr>
					<tr>
						<td><?php _e( 'Name', 'wp-mailster' ); ?></td>
						<td><?php _e( 'Last check', 'wp-mailster' ); ?></td>
						<td><?php _e( 'Last email retrieved', 'wp-mailster' ); ?></td>
						<td><?php _e( 'Last email sent', 'wp-mailster' ); ?></td>
						<td><?php _e( 'ID', 'wp-mailster' ); ?></td>
					</tr>
					<?php
						$lists = &$data->lists;
						for( $i=0; $i < count( $lists ); $i++ )	{
							$mList = &$lists[$i];
							?>
							<tr>
								<td><?php echo $mList->name; ?></td>
								<td><?php echo $mList->last_check; ?></td>
								<td><?php echo $mList->last_mail_retrieved; ?></td>
								<td><?php echo $mList->last_mail_sent; ?></td>
								<td><?php echo $mList->id; ?></td>
							</tr>
							<?php
						}
					?>
				</table>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="150px" style="text-align:right;vertical-align:top;"><?php _e( 'Logging', 'wp-mailster' ); ?>:</td>
			<td width="450px">
				<table>
					<tr>
						<td><?php _e( 'Logging enabled', 'wp-mailster' ); ?>: </td>
						<td><?php echo ($log->isLoggingActive() ? __( 'yes', 'wp-mailster' ) : __( 'no', 'wp-mailster' )); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'Logging possible', 'wp-mailster' ); ?>: </td>
						<td><?php echo ($log->loggingPossible() ? __( 'yes', 'wp-mailster' ) : __( 'no', 'wp-mailster' )); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'Force logging', 'wp-mailster' ); ?>: </td>
						<td><?php echo ($log->isLoggingForced() ?  __( 'yes', 'wp-mailster' ) : __( 'no', 'wp-mailster' )); ?></td>
					</tr>
					<tr>
						<td><?php _e( 'Logging Level', 'wp-mailster' ); ?>: </td>
						<td><?php echo get_option('wpmst_cfg_logging_level'); ?></td>
					</tr>
					<tr>
						<td style="vertical-align:top;"><?php _e( 'Log file size', 'wp-mailster' ); ?>: </td>
						<td><?php echo $fileUtils->getFileSizeOfFile($log->getLogFile()) . ' ('.$log->getLogFile().')'; ?><br/><?php
                            $mstDwlLogNonce = wp_create_nonce('mst_dwl_log');
                            ?><a href="<?php echo admin_url('admin.php?mst_download=mailster.log&_wpnonce='.$mstDwlLogNonce); ?>" target="_blank"><?php _e( 'Download', 'wp-mailster' );?></a><br/>
							<a href="#" id="deleteLog"><?php _e( 'Delete log file', 'wp-mailster' );?></a>
						</td>
					</tr>
				</table>
			</td>
			<td>&nbsp;</td>
		</tr>
        <?php
         $noConnCheck = intval($_GET['nocochk']);
        if($noConnCheck !== 1){ ?>
		<tr>
			<td width="150px" style="text-align:right;"><?php _e( 'Connection Check', 'wp-mailster' ); ?>:</td>
			<td width="450px">
				<pre><?php
						require_once('mst_inbox_test.php');
					?>
				</pre>
			</td>
			<td>&nbsp;</td>
		</tr>
        <?php
        }
        ?>
	</table>