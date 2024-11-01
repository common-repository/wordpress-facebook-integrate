<?php
class WPFBI_admin{
	function wpfbi_create_menu() {
		add_options_page('WPFBI Plugin Settings', 'WPFBI Settings', 'administrator', __FILE__, array('WPFBI_admin','wpfbi_settings_page'),plugins_url('/images/icon.png', __FILE__));
		add_action( 'admin_init', array('WPFBI_admin','register_settings') );
	}

	function register_settings() {
		register_setting( 'wpfbi-settings-group', 'wpfbi' );
	}

	function wpfbi_settings_page() {
	?>
	<div class="wrap">
	<h2>Wordpress-Facebook Intergrate</h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'wpfbi-settings-group' ); ?>
		<?php $options = get_option('wpfbi');
		//Define all options to appear in array:
		//[human]: human readable title.
		//[options] optional 'check' for true or false value OR array of values for dropdown box
		$options_list[] = array('human' => 'Facebook App ID');
		$options_list[] = array('human' => 'Facebook App Secret');
		$options_list[] = array('human' => 'Facebook API key');
		$options_list[] = array('human' => 'Border Color');
		$options_list[] = array('human' => 'Color Scheme',
			'options' => array('light', 'dark'));
		$options_list[] = array('human' => 'Recommend Box Height');
		$options_list[] = array('human' => 'Recommend Box Width');
		$options_list[] = array('human' => 'Activity Feed Height');
		$options_list[] = array('human' => 'Activity Feed Width');
		$options_list[] = array('human' => 'Like Box Width');
		$options_list[] = array('human' => 'Include Like Box Stream',
			'options' => 'check');
		$options_list[] = array('human' => 'Facepile Width');
		$options_list[] = array('human' => 'Facepile Rows');
		$options_list[] = array('human' => 'Live Stream Height');
		$options_list[] = array('human' => 'Live Stream Width');
		$options_list[] = array('human' => 'Site Logo URL');
		
		//generate array property without spaces
		foreach ($options_list as $k => $v){
			$options_list[$k]['underscores'] = str_replace(' ','_',strtolower($v['human']));
		}
		?> 
		<table class="form-table">
			
			<tr valign="top">
			<th scope="row">Enabled Plugins</th>
			<td><input type="checkbox" name="wpfbi[enabled][like_button]" <?php if (isset($options['enabled']['like_button'])) { echo "checked"; }?> /> Like Button</td>
			</tr>
		
			<tr>
			<td></td>
			<td><input type="checkbox" name="wpfbi[enabled][comments]" <?php if (isset($options['enabled']['comments'])) { echo "checked"; }?> /> Comments</td>
			</tr>
			
			<?php //cycle through $options_list[] and create text fields, checkboxes or dropdown lists for each item.
			foreach($options_list as $option){ ?>
			<tr valign="top">
			<th scope="row"><?php echo $option['human']; ?>
			</th><td>
			<?php if(isset($option['options']) && is_array($option['options'])){ ?>
				<select name="wpfbi[<?php echo $option['underscores']; ?>]">
				<?php foreach($option['options'] as $o){ ?>
					<option value='<?php echo $o;?>' <?php if($options[$option['underscores']]==$o){echo "selected"; }?>><?php echo $o;?></option> <?php  } ?>
				</select>
			<?php }else{?> <input name="wpfbi[<?php echo $option['underscores']; ?>]"<?php
			} if(!isset($option['options'])) { ?>type="text" value="<?php echo $options[$option['underscores']]; ?>" />
			<?php } elseif($option['options']==='check') {
				echo 'type="checkbox"';
				if(isset($options[$option['underscores']])){ echo "checked"; }?> ></td>
		  <?php }?>
			</tr>
	<?php }?>
			
		</table>
		
		<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>

	</form>
	</div>
	<?php }
}
add_action('admin_menu', array('WPFBI_admin','wpfbi_create_menu'));?>