<div class="wrap">
<h1>The Real Time Chat widget settings</h1>

<form method="post" action="options.php" style="margin-top:30px;margin-bottom:30px;"> 

<b>You can find your App ID on <a href="https://therealtimechat.com/settings" target="_blank">Settings menu </a></b>
<br>

<?php settings_fields('trc-settings');?>

<?php do_settings_fields( "The Real Time Chat Widget", "settings-section" ); ?>

<?php submit_button(); ?>
</form>


<style>
	textarea, input[type='text']{
		min-width: 300px;
		width: 40%;
	}

	textarea{
		min-height: 250px;
	}

	.trc-b{
		display: block;
		margin-top:15px; 
		margin-bottom:5px; 
	}
</style>
</div>