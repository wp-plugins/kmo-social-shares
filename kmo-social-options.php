<?php // KMO Social Options Page

add_action( 'admin_notices', 'kmo_social_admin_pagehook' );
function kmo_social_admin_pagehook() {
	global $hook_suffix;
    if ( $hook_suffix == 'toplevel_page_kmo_social' ) {
		if ($_REQUEST['settings-updated']==true) 
			echo '<div id="message" class="updated"><p>Settings Updated.</p></div>'; 
	}	
} 

function kmo_social_options() { 

  $facebook_active = (esc_attr(get_option('kmo_social_facebook')) == 'on') ? ' checked="checked"' : '';
  $twitter_active = (esc_attr(get_option('kmo_social_twitter')) == 'on') ? ' checked="checked"' : '';
  $pinterest_active = (esc_attr(get_option('kmo_social_pinterest')) == 'on') ? 'checked="checked"' : '';
  $googleplus_active = (esc_attr(get_option('kmo_social_googleplus')) == 'on') ? ' checked="checked"' : '';

?>
<script language="JavaScript">
jQuery(document).ready(function($) {

    /* Color Picker */
    $('#kmo_colorpicker').farbtastic("#kmo_social_color");
    
});
</script>
<div class="wrap">

<h2><?php echo KMO_PLUGIN_NAME; ?></h2>

<form method="post" action="options.php">
    <?php settings_fields( 'kmo-social-settings' ); ?>

    <h3 class="title">Options</h3>
    <table class="form-table">
    <tr valign="top">
    <th scope="row">Facebook</th>
    <td>
        <input type="checkbox" id="kmo_social_facebook" name="kmo_social_facebook"<?php echo $facebook_active; ?>" />
        <input type="text" id="kmo_social_facebook_text" name="kmo_social_facebook_text" value="<?php echo esc_attr(get_option('kmo_social_facebook_text')); ?>" />
        <p class="description">Text to display beside icon</p>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row">Twitter</th>
    <td>
        <input type="checkbox" id="kmo_social_twitter" name="kmo_social_twitter"<?php echo $twitter_active; ?>" />
        <input type="text" id="kmo_social_twitter_text" name="kmo_social_twitter_text" value="<?php echo esc_attr(get_option('kmo_social_twitter_text')); ?>" />
        <p class="description">Text to display beside icon</p>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row">Pinterest</th>
    <td>
        <input type="checkbox" id="kmo_social_pinterest" name="kmo_social_pinterest"<?php echo $pinterest_active; ?>" />
        <input type="text" id="kmo_social_pinterest_text" name="kmo_social_pinterest_text" value="<?php echo esc_attr(get_option('kmo_social_pinterest_text')); ?>" />
        <p class="description">Text to display beside icon</p>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row">Google+</th>
    <td>
        <input type="checkbox" id="kmo_social_googleplus" name="kmo_social_googleplus"<?php echo $googleplus_active; ?>" />
        <input type="text" id="kmo_social_googleplus_text" name="kmo_social_googleplus_text" value="<?php echo esc_attr(get_option('kmo_social_googleplus_text')); ?>" />
        <p class="description">Text to display beside icon</p>
    </td>
    </tr>
    </table>
    <hr>

    <h3 class="title">Appearance</h3>
    <table class="form-table">
    <tr valign="top">
    <th scope="row">Text Color</th>
    <td>
        <div id="kmo_colorpicker"></div>
        <input type="text" id="kmo_social_color" name="kmo_social_color" value="<?php echo esc_attr(get_option('kmo_social_color')); ?>" />
        <p class="description">Select the color of the text</p>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row">Font Size</th>
    <td>
        <input type="text" id="kmo_social_font_size" name="kmo_social_font_size" value="<?php echo esc_attr(get_option('kmo_social_font_size')); ?>" />
        <p class="description">Size of the font in pixels</p>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row">Width</th>
    <td>
        <input type="text" id="kmo_social_width" name="kmo_social_width" value="<?php echo esc_attr(get_option('kmo_social_width')); ?>" />
        <p class="description">Horizontal width in pixels</p>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row">Height</th>
    <td>
        <input type="text" id="kmo_social_height" name="kmo_social_height" value="<?php echo esc_attr(get_option('kmo_social_height')); ?>" />
        <p class="description">Vertical height in pixels</p>
    </td>
    </tr>
    </table>
    <hr>
    <h3 class="title">Placement</h3>
    <table class="form-table">
    <tr valign="top">
    <th scope="row">Alignment</th>
    <td>
    <select id="kmo_social_position" name="kmo_social_position">
    <option value="left"<?php if (get_option('kmo_social_position')=="left") echo ' selected="selected"'; ?>>Left</option>
    <option value="right"<?php if (get_option('kmo_social_position')=="right") echo ' selected="selected"'; ?>>Right</option>
    </select>
    <p class="description">Position the social icons on the left or right of the page</p>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row">Top</th>
    <td>
        <input type="text" id="kmo_social_top" name="kmo_social_top" value="<?php echo esc_attr(get_option('kmo_social_top')); ?>" />
        <p class="description">Select the position from top of page</p>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row">In</th>
    <td>
        <input type="text" id="kmo_social_in" name="kmo_social_in" value="<?php echo esc_attr(get_option('kmo_social_in')); ?>" />
        <p class="description">Horizontal position from right when in</p>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row">Out</th>
    <td>
        <input type="text" id="kmo_social_out" name="kmo_social_out" value="<?php echo esc_attr(get_option('kmo_social_out')); ?>" />
        <p class="description">Horizontal position from right when out</p>
    </td>
    </tr>
    </table>

    <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>        

</form>
<?php } ?>
