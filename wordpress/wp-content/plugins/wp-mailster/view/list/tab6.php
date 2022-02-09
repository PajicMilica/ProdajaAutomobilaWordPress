<?php if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
	die( 'These are not the droids you are looking for.' );
}
?>
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row">
				<label for="addressing_mode"><?php _e("Recipient addressing", 'wp-mailster'); ?> </label>
			</th>
			<td>
				<?php 
				$checked = false;
				if($options->addressing_mode == 1) {
					$checked = true;
				}
				$this->mst_display_simple_radio_field("addressing_mode", 1, "use_bcc", __("Use BCC addressing, hide recipients (recommended)", 'wp-mailster'), $checked); ?>
				<br>
				<div class="suboptions" id="use_bcc_suboptions">
					<input type="text" name="bcc_count" class="small-text" value="<?php echo $options->bcc_count; ?>" placeholder="<?php _e("BCC recipients per mail", 'wp-mailster'); ?>" >
					<label for="bcc_count"><?php _e("BCC recipients per mail", 'wp-mailster'); ?></label>
					<br>
					<label for="incl_orig_headers">
						<input type='checkbox' name='incl_orig_headers' id="incl_orig_headers" <?php if($options->incl_orig_headers) echo 'checked="checked"'; ?> value="1">
						<?php _e("Include original TO and CC header addressees (Not recommended)", 'wp-mailster'); ?>
					</label>
				</div>				
				<br>
				<?php 
				$checked = false;
				if($options->addressing_mode == 0) {
					$checked = true;
				}
				$this->mst_display_simple_radio_field("addressing_mode", 0, "use_to", __("No BCC addressing, send one mail per recipient", 'wp-mailster'), $checked); ?>
			</td>
		</tr>
		<?php
		
		$this->mst_display_select_field( __('From email address', 'wp-mailster'), 'mail_from_mode',
			array(
				0 => __("General setting (Mailster config)", 'wp-mailster'),
				1 => __("Sender address", 'wp-mailster'),
				2 => __("Mailing list address", 'wp-mailster')
			),
			$options->mail_from_mode
		);
		$this->mst_display_select_field( __('From name', 'wp-mailster'), 'name_from_mode',
			array(
				0 => __("General setting (Mailster config)", 'wp-mailster'),
				1 => __("Sender name", 'wp-mailster'),
				2 => __("Mailing list name", 'wp-mailster')
			),
			$options->name_from_mode
		);

		$fields = array();
		$fields[0] = new stdClass();
		$fields[0]->value = 0;
		$fields[0]->id = "replyToList";
		$fields[0]->text = __("Replies only to mailing list", 'wp-mailster');
		$fields[0]->title = __("Configure where replies to mailing list emails should be sent to", 'wp-mailster');
		
		$fields[1] = new stdClass();
		$fields[1]->value = 1;
		$fields[1]->id = "replyToSender";
		$fields[1]->text = __("Replies only to sender", 'wp-mailster');
		$fields[1]->title = "";

		$fields[2] = new stdClass();
		$fields[2]->value = 2;
		$fields[2]->id = "replyToSenderAndList";
		$fields[2]->text = __("Reply to sender (and optional mailing list with reply-to-all)", 'wp-mailster');
		$fields[2]->title = "";		
		$this->mst_display_multiple_radio_fields( __("Reply destination", 'wp-mailster'), 'reply_to_sender', $fields, $options->reply_to_sender);

		$fields = array();
		$fields[0] = new stdClass();
		$fields[0]->value = 0;
		$fields[0]->id = "useNoBounceAddress";
		$fields[0]->text = __("No dedicated bounces address", 'wp-mailster');
		$fields[0]->title = __("Determines where automatic replies (e.g. out-of-office replies and delivery status notifications) should go to. Without a dedicated bounces address those emails go back to the list where they are not forwarded.", 'wp-mailster');
		
		$fields[1] = new stdClass();
		$fields[1]->value = 1;
		$fields[1]->id = "useBounceAddress";
		$fields[1]->text = __("Dedicated bounces address", 'wp-mailster');
		$fields[1]->title = "";

		$this->mst_display_multiple_radio_fields( __("Bounces destination", 'wp-mailster'), 'bounce_mode', $fields, $options->bounce_mode);
		?>
		<tr class="form-field" >
			<td></td>
			<td>
				<div class="suboptions" id="bounceModeSettings_suboptions">
					<input value="<?php echo $options->bounce_mail; ?>" name="bounce_mail" class="regular-text" id="bounce_mail">
					<label for="bounce_mail"><?php _e("Bounces email", 'wp-mailster'); ?></label>
				</div>
			</td>
		</tr>
		<?php
		$this->mst_display_input_field( __("Max. send attempts", 'wp-mailster'), 'max_send_attempts', $options->max_send_attempts, null, false, true);

		$this->mst_display_select_field( __("Send reports", 'wp-mailster'), 'save_send_reports',
			array(
				0 => __("Do not save send report", 'wp-mailster'),
				7 => __("Save send reports for 7 days", 'wp-mailster'),
				30 => __("Save send reports for 30 days", 'wp-mailster')
			),
			$options->save_send_reports
		);
		?>
	</tbody>
</table>