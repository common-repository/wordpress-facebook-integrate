<?php
/*
Plugin Name: WP-Facebook Intergrate
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Use facebook social plugins to intergrate facebook and wordpress
Version: 0.3
Author: Dustin Green
License: GPL2
*/

/*  Copyright 2010  Dustin Green  (email : dustingreen987@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

*/
require_once('wp-fbi-adminsettings.php');
class WPFPI_core{
	function addXfmlLine(){
		$options = get_option('wpfbi');
		if(is_array($options)){?>
			<?php extract($options);?>
			<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
			    <meta property="og:title" content="<?php get_bloginfo('name');?>" />
				<meta property="og:type" content="blog" />
				<meta property="og:url" content="<?php get_bloginfo('url');?>" />
				<meta property="og:image" content="<?php echo $site_logo_url; ?>" />
				<meta property="fb:app_id" content="<?php echo $app_id; ?>" />
				<meta property="og:description" content="<?php get_bloginfo('description');?>" />
	<?php
		}
	 }
	 function addLoginButton(){
	 	//echo '<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US" type="text/javascript"></script>';
		echo '<p><fb:login-button autologoutlink="true"></fb:login-button></p>';
	}
	function addLoginButton_init(){
		$o = array('description' => 'Facebook login button.');
		wp_register_sidebar_widget('wpfbi-login', 'Facebook Login', array('WPFPI_core','addLoginButton'), $o);
	} 
	function addAPIref(){
		$options = get_option('wpfbi');?>
			<div id="fb-root"></div>
			<script src="http://connect.facebook.net/en_US/all.js"></script>
			<script>
  			FB.init({appId: '<?php echo $options['facebook_api_key']; ?>', status: true, cookie: true, xfbml: true});
 			FB.Event.subscribe('auth.sessionChange', function(response) {
 		   if (response.session) {
 			    
    		} else {
  	
   			 }
 			 });
			</script>	
<?php 
	}
	function addLikeButton($content){
		$link = get_permalink();
		$options = get_option('wpfbi');
		extract($options);
		if (!(isset($enabled['comments']) && is_single() === true)){
			$content .= "<br /><p><fb:like href='$link'></fb:like></p>";
		}
		return $content;
	}
	function addRecommendBox($args){
		$url = get_option('siteurl');
		$options = get_option('wpfbi');
		extract($options);
		extract($args);
		echo $before_widget . $before_title . $after_title;
		echo "<fb:recommendations site='$url' width='$recommend_box_width' height='$recommend_box_height'
			border_color='$border_color' colorscheme='$color_scheme'></fb:recommendations>";
		echo $after_widget;
	}
	function recommendBox_control(){
		$options = get_option('wpfbi');
		extract($options);?>
		<p><label>Height</label><input name="recommend_box_height" type="text" value="<?php echo $recommend_box_height?>" /></p>
		<p><label>Width</label><input name="recommend_box_width" type="text" value="<?php echo $recommend_box_width?>" /></p>
		<?php if (isset($_POST['recommend_box_height'])){
			if(is_numeric($_POST['recommend_box_height'])) 
				{ $options['recommend_box_height'] = $_POST['recommend_box_height']; }
		if(is_numeric($_POST['recommend_box_width'])) 
				{ $options['recommend_box_width'] = $_POST['recommend_box_width']; }
			update_option('wpfbi',$options);
		}
	}
	function addRecommendBox_init(){
		$o = array('description' => 'Facebook Recommend Box.');
		wp_register_sidebar_widget('wpfbi-reccomend', 'Facebook Recommend Box', array('WPFPI_core','addRecommendBox'), $o);
		wp_register_widget_control('wpfbi-reccomend', 'Facebook Recommend Box', array('WPFPI_core','recommendBox_control'));
	}
	function addCommentBox($content){
		if(is_single()){ $content.="<fb:comments></fb:comments>"; }
		return $content;
	}
	function addActivityFeed($args){
		$url = get_option('siteurl');
		$options = get_option('wpfbi');
		extract($args);
		echo $before_widget . $before_title . $after_title;
		extract($options);
		echo "<fb:activity site='$url' width='$activity_feed_width' height='$activity_feed_height' colorscheme='$color_scheme' border_color='$border_color' recommendations='false'></fb:activity>";
		echo $after_widget;
	}
	function activityFeed_control(){
		$options = get_option('wpfbi');
		extract($options);?>
		<p><label>Height</label><input name="activity_feed_height" type="text" value="<?php echo $activity_feed_height?>" /></p>
		<p><label>Width</label><input name="activity_feed_width" type="text" value="<?php echo $activity_feed_width?>" /></p>
		<?php if (isset($_POST['activity_feed_height'])){
			if(is_numeric($_POST['activity_feed_height'])) 
				{ $options['activity_feed_height'] = $_POST['activity_feed_height']; }
		if(is_numeric($_POST['activity_feed_width'])) 
				{ $options['activity_feed_width'] = $_POST['activity_feed_width']; }
			update_option('wpfbi',$options);
		}
	}
	function addActivityFeed_init(){
		$o = array('description' => 'Facebook Activity Feed.');
		wp_register_sidebar_widget('wpfbi-activity', 'Facebook Activity Feed', array('WPFPI_core','addActivityFeed'), $o);
		wp_register_widget_control('wpfbi-activity', 'Facebook Activity Feed', array('WPFPI_core','activityFeed_control'));
	}
	function addLikeBox($args){
		$options = get_option('wpfbi');
		extract($options);
		extract($args);
		if ($like_box_stream === 'on'){ $stream = 'true'; }
			else { $stream = 'false'; }
		echo $before_widget . $before_title . $after_title;
		echo "<fb:like-box profile_id='$facebook_app_id' width='$like_box_width' stream='$stream'></fb:like-box>";
		echo $after_widget;
	}
	function likeBox_control(){
		$options = get_option('wpfbi');
		extract($options); ?>
		<p><label>Width</label><input name="like_box_width" type="text" value="<?php echo $like_box_width; ?>" /></p>
		<p><label>Include Stream</label><input name="include_like_box_stream" type="checkbox" <?php if(isset($include_like_box_stream)) { echo "checked"; } ?> /></p>
		<?php if (isset($_POST['like_box_width'])){
				if(is_numeric($_POST['like_box_width'])) 
					{ $options['like_box_width'] = $_POST['like_box_width']; }
				if(isset($_POST['include_like_box_stream'])) 
					{ $options['include_like_box_stream'] = 'on'; }
					else { unset($options['include_like_box_stream']); }
				update_option('wpfbi',$options);
		}
	}
	function addLikeBox_init(){
		$o = array('description' => 'Facebook Like Box.');
		wp_register_sidebar_widget('wpfbi-likebox', 'Facebook Like Box', array('WPFPI_core','addLikeBox'), $o);
		wp_register_widget_control('wpfbi-likebox', 'Facebook Like Box', array('WPFPI_core','likeBox_control'));
	}
	
	function addFacepile($args){
		$options = get_option('wpfbi');
		extract($options);
		extract($args);
		echo $before_widget . $before_title . $after_title;
		echo "<fb:facepile max-rows='$facepile_rows' width='$facepile_width'></fb:facepile>";
		echo $after_widget;
	}
	function facepile_control(){
		$options = get_option('wpfbi');
		extract($options);?>
		<p><label>Width</label><input name="facepile_width" type="text" value="<?php echo $facepile_width?>" /></p>
		<p><label>Rows</label><input name="facepile_rows" type="text" value="<?php echo $facepile_rows?>" /></p>
		<?php if (isset($_POST['facepile_rows'])){
			if(is_numeric($_POST['facepile_rows'])) 
				{ $options['facepile_rows'] = $_POST['facepile_rows']; }
		if(is_numeric($_POST['facepile_width'])) 
				{ $options['facepile_width'] = $_POST['facepile_width']; }
			update_option('wpfbi',$options);
		}
	}
	function addFacepile_init(){
		$o = array('description' => 'Facebook Facepile.');
		wp_register_sidebar_widget('wpfbi-facepile', 'Facebook Facepile', array('WPFPI_core','addFacepile'), $o);
		wp_register_widget_control('wpfbi-facepile', 'Facebook Facepile', array('WPFPI_core','facepile_control'));
	}
	
	function addLiveStream($args){
		$options = get_option('wpfbi');
		extract($options);
		extract($args);
		echo $before_widget . $before_title . $after_title;
		echo "<fb:live-stream event_app_id='$facebook_app_id' width='$live_stream_width' height='$live_stream_height'></fb:live-stream>";
		echo $after_widget;
	}
	function liveStream_control(){
		$options = get_option('wpfbi');
		extract($options);?>
		<p><label>Height</label><input name="live_stream_height" type="text" value="<?php echo $live_stream_height?>" /></p>
		<p><label>Width</label><input name="live_stream_width" type="text" value="<?php echo $live_stream_width?>" /></p>
		<?php if (isset($_POST['live_stream_height'])){
			if(is_numeric($_POST['live_stream_height'])) 
				{ $options['live_stream_height'] = $_POST['live_stream_height']; }
		if(is_numeric($_POST['live_stream_width'])) 
				{ $options['live_stream_width'] = $_POST['live_stream_width']; }
			update_option('wpfbi',$options);
		}
	}
	function addLiveStream_init(){
		$o = array('description' => 'Facebook Live Stream.');
		wp_register_sidebar_widget('wpfbi-livestream', 'Facebook Live Stream', array('WPFPI_core','addLiveStream'), $o);
		wp_register_widget_control('wpfbi-livestream', 'Facebook Live Stream', array('WPFPI_core','liveStream_control'));
	}
	
	static function init_addons(){
		//core actions for any facebook functionality.
		add_action('init',array('WPFPI_core','addXfmlLine'));
		add_action('plugins_loaded',array('WPFPI_core','addLoginButton_init'));
		add_action('wp_footer',array('WPFPI_core','addAPIref'));
		
		$options = get_option('wpfbi');
		if (isset($options['enabled']['like_button'])){
			add_filter('the_content', array('WPFPI_core','addLikeButton'));
		}
		if (isset($options['enabled']['comments'])){
			add_filter('the_content', array('WPFPI_core','addCommentBox'), 500000);	
		}
		
		//widgets.
		add_action('plugins_loaded', array('WPFPI_core','addActivityFeed_init'));
		add_action('plugins_loaded', array('WPFPI_core','addLikeBox_init'));
		add_action('plugins_loaded', array('WPFPI_core','addFacepile_init'));
		add_action('plugins_loaded', array('WPFPI_core','addRecommendBox_init'));
		add_action('plugins_loaded', array('WPFPI_core','addLiveStream_init'));	
	}
	function activation() {
    	$options = get_option('wpfbi');
    	if (!$options) {
    		$options['facebook_app_id'] = 'xxxxxxxxxxxxx';
    		$options['facebook_api_key'] = 'xxxxxxxxxxxxxxxx';
    		$options['facebook_app_secret'] = 'xxxxxxxxxxxxxxxxx';
			$options['border_color'] = 'white';
			$options['color_scheme'] = 'light';
			$options['recommend_box_height'] = '300';
			$options['recommend_box_width'] = '200';
			$options['activity_feed_height'] = '300';
			$options['activity_feed_width'] = '200';
			$options['like_box_width'] = '200';
			$options['facepile_width'] = '200';
			$options['facepile_rows'] = '1';
			$options['live_stream_height'] = '300';
			$options['live_stream_width'] = '200';
			$options['site_logo_url'] = '';
			add_option('wpfbi', $options);
    	} 
	}
}
	register_activation_hook(__FILE__, array('WPFPI_core','activation'));
	
	WPFPI_core::init_addons();