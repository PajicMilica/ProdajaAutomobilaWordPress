<?php

if( isset($_REQUEST['success']) ) {
	success();
} else {
	failed();
}

function success() {
	?>
	<h2 class="componentheading mailsterSubscriberHeader">
		Subscription
	</h2>
	<div class="contentpane">
		<div id="mailsterContainer">
			<div id="mailsterSubscriber">

				<div id="mailsterSubscriberDescription" class="success" >Subscription successful</div>
			</div>
		</div>
	</div>
	<?php
}
function failed() {?>

	<h2 class="componentheading mailsterSubscriberHeader">
		Subscription
	</h2>
	<div class="contentpane">
		<div id="mailsterContainer">
			<div id="mailsterSubscriber">
				<div id="mailsterSubscriberDescription" class="failure" >Subscription failed</div>
			</div>
		</div>
	</div>
	<?php
}
