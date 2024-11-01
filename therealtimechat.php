<?php
/**
* @package The Real Time Chat
*/
/*
Plugin Name: The Real Time Chat
Plugin URI: https://therealtimechat.com/plugins
Description: The Real Time Chat plugin for your chat widget
Version: 1.0.0
Author: The Real TIme Chat
Author URI: https://therealtimechat.com
License: GPLv2 or later

*/


if(!defined("ABSPATH")){
	die("Nothing to see here");
}

class TRC_plugin{	

	function __construct(){
		add_action( 'admin_menu',  array($this, 'addSettingsPage'));
		add_action( 'admin_init',  array($this, 'settingsFields'));
		add_action( 'wp_footer',  array($this, 'getCode'));
	}

	function showCode(){
		$ret = true;

		$urls = get_option("trc-exclude-sites");
		$urls = explode(PHP_EOL, $urls);
		$page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if(strlen(get_option("trc-exclude-sites")) > 0){
			foreach($urls as $url){
				if(strpos($page, $url) != false || $page == $url){
					return false;
				}
			}
		}

		return $ret;
	}

	function getCode(){
		$appId = get_option("trc-app-id");
		if($appId != false){

			if($this->showCode()){
				echo "<script src=\"https://therealtimechat.com/widget/{$appId}\"></script>";
			}

		}	
		return "";
	}

	function settingsFields(){

		add_settings_section('settings-section', 'Settings', array($this, 'settingsSection'),  'The Real Time Chat Widget');

		add_settings_field("trc-app-id", "<b class='trc-b'>App ID<b>", array($this, 'appIdField'), 'The Real Time Chat Widget', 'settings-section');
		add_settings_field("trc-exclude-sites", $this->excludeUrlsLabel(), array($this, 'excludePagesField'), 'The Real Time Chat Widget', 'settings-section');


		register_setting('trc-settings', 'trc-app-id');
		register_setting('trc-settings', 'trc-exclude-sites');
	}

	function excludeUrlsLabel(){
		return "<b class='trc-b'>Hide widget on these pages</b><i>Enter each url on new line</i>";
	}

	function settingsSection(){
		echo "Widget Settings";
	}

	function appIdField(){
		$val = get_option('trc-app-id');
		echo "<div><input type='text' name='trc-app-id' value='".$val."' /></div>";
	}

	function excludePagesField(){
		$val = get_option('trc-exclude-sites');
		echo "<div><textarea type='text' name='trc-exclude-sites'>".$val."</textarea></div>";
	}


	function addSettingsPage() {
	    add_options_page(
	       	'The Real Time Chat Widget',
	        'The Real Time Chat',
	        'manage_options',
	        __DIR__.'/therealtimechat-menu.php'
	    );
	}	

}


if(class_exists('TRC_plugin')){
	$pluginObject = new TRC_plugin();
}



