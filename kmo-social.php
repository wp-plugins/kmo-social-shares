<?php
   /*
   Plugin Name: Kmo Social
   Plugin URI: http://www.kmo.com.au/blog/wordpress-social-shares-icons
   Description: A plugin to display social share icons
   Version: 1.0.0
   Author: KMO Design Pty Ltd
   Author URI: http://www.kmo.com.au
   License: GPL3
   */


// Defaults
define( 'KMO_PLUGIN_NAME', 'KMO Social');
define( 'KMO_PLUGIN_DIRECTORY', 'kmo-social');
define( 'KMO_CURRENT_VERSION', '1.0.0' );

// Admin Settings
require_once('kmo-social-options.php');

// Custom plugin settings menu
add_action( 'admin_menu', 'kmo_create_menu' );

// Register settings function
add_action( 'admin_init', 'kmo_register_settings' );

register_activation_hook(__FILE__, 'kmo_activate');
register_deactivation_hook(__FILE__, 'kmo_deactivate');
register_uninstall_hook(__FILE__, 'kmo_uninstall');

// Activate
function kmo_activate() {
	add_option('kmo_social_facebook','on');
	add_option('kmo_social_facebook_text','Like us on<br>Facebook');
	add_option('kmo_social_twitter','on');
	add_option('kmo_social_twitter_text','Tweet this on<br>Twitter');
	add_option('kmo_social_pinterest','on');
	add_option('kmo_social_pinterest_text','Pin this on<br>Pinterest');
	add_option('kmo_social_googleplus','on');
	add_option('kmo_social_googleplus_text','+1 on<br>Google+');
	add_option('kmo_social_color','#ffffff');
	add_option('kmo_social_font_size','40');
	add_option('kmo_social_position','right');
	add_option('kmo_social_top','200');
	add_option('kmo_social_in','-90');
	add_option('kmo_social_out','0');
	add_option('kmo_social_width','120');
	add_option('kmo_social_height','36');
}

// Deactivate
function kmo_deactivate() {

}

// Uninstall
function kmo_uninstall() {
	delete_option('kmo_social_facebook');
	delete_option('kmo_social_facebook_text');
	delete_option('kmo_social_twitter');
	delete_option('kmo_social_twitter_text');
	delete_option('kmo_social_pinterest');
	delete_option('kmo_social_pinterest_text');
	delete_option('kmo_social_googleplus');
	delete_option('kmo_social_googleplus_text');
	delete_option('kmo_social_color');
	delete_option('kmo_social_font_size');
	delete_option('kmo_social_position');
	delete_option('kmo_social_top');
	delete_option('kmo_social_in');
	delete_option('kmo_social_out');
	delete_option('kmo_social_width');
	delete_option('kmo_social_height');
}

function kmo_create_menu() {
	add_options_page( 
	KMO_PLUGIN_NAME,
	KMO_PLUGIN_NAME,
	'manage_options',
	'kmo-social',
	'kmo_social_options'
	);
}

// Add settings link on plugin page
add_filter("plugin_action_links_".plugin_basename(__FILE__), 'kmo_social_settings_link' );
function kmo_social_settings_link($links) { 
  $settings_link = '<a href="admin.php?page=kmo-social">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}

// Register settings
function kmo_register_settings() {
	register_setting('kmo-social-settings', 'kmo_social_facebook');
	register_setting('kmo-social-settings', 'kmo_social_facebook_text');
	register_setting('kmo-social-settings', 'kmo_social_twitter');
	register_setting('kmo-social-settings', 'kmo_social_twitter_text');
	register_setting('kmo-social-settings', 'kmo_social_pinterest');
	register_setting('kmo-social-settings', 'kmo_social_pinterest_text');
	register_setting('kmo-social-settings', 'kmo_social_googleplus');
	register_setting('kmo-social-settings', 'kmo_social_googleplus_text');
	register_setting('kmo-social-settings', 'kmo_social_color');
	register_setting('kmo-social-settings', 'kmo_social_font_size');
	register_setting('kmo-social-settings', 'kmo_social_position');
	register_setting('kmo-social-settings', 'kmo_social_top');
	register_setting('kmo-social-settings', 'kmo_social_in');
	register_setting('kmo-social-settings', 'kmo_social_out');
	register_setting('kmo-social-settings', 'kmo_social_width');
	register_setting('kmo-social-settings', 'kmo_social_height');
}

// Enqueue Admin Scripts
function kmo_social_admin_scripts() {
  wp_enqueue_script('jquery');
  wp_enqueue_script( 'farbtastic' );
  wp_enqueue_script('thickbox');
}
add_action('admin_print_scripts', 'kmo_social_admin_scripts');

function kmo_social_admin_styles() {
  wp_enqueue_style( 'farbtastic' );
  wp_enqueue_style('thickbox');
}
add_action('admin_print_styles', 'kmo_social_admin_styles');

function kmo_social_add_styles() {
  wp_enqueue_style( 'kmo-social-style', plugins_url( 'css/kmo-social.css', __FILE__ ), false, '4.2', 'all' );
}
add_action('wp_print_styles', 'kmo_social_add_styles');

// Main Code
function kmo_social() {
  $path = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $uri = urlencode($path);
?>

  <div class="kmo-social-icons">
  	<?php if(get_option('kmo_social_facebook') == 'on'): ?>
      <span onclick="javascript:void(window.open('http://www.facebook.com/sharer/sharer.php?u=<?php echo $uri; ?>', 'Facebook', 'width=650,height=200,scrollbars=yes'));"><i class="entypo-social entypo-social-facebook"><span>Like us<br>on Facebook</span></i></span><br>
    <?php endif;
  	  if(get_option('kmo_social_twitter') == 'on'): ?>
      <span onclick="javascript:void(window.open('http://twitter.com/home?status=<?php the_title(); ?> <?php echo $uri; ?>', 'Twitter', 'width=650,height=400,scrollbars=yes'));"><i class="entypo-social entypo-social-twitter"><span>Tweet us<br>on Twitter</span></i></span><br>
    <?php endif;
  	  if(get_option('kmo_social_pinterest') == 'on'): ?>
      <span onclick="javascript:void(window.open('http://pinterest.com/pin/create/button/?url=<?php echo $uri; ?>&media=&description=<?php the_title(); ?>', 'Pinterest', 'width=650,height=500,scrollbars=yes'));"><i class="entypo-social entypo-social-pinterest"><span>Pin on<br>Pinterest</span></i></span><br>
    <?php endif;
  	  if(get_option('kmo_social_googleplus') == 'on'): ?>
      <span onclick="javascript:void(window.open('https://plusone.google.com/_/+1/confirm?url=<?php echo $uri; ?>', 'Plus One', 'width=650,height=600,scrollbars=yes'));"><i class="entypo-social entypo-social-googleplus"><span>Plus one<br>on Google+</span></i></span>
    <?php endif; ?>
  </div>
    <?php
}
add_action('wp_footer','kmo_social',100);
add_action('admin_head-toplevel_page_kmo_social','kmo_social');

// Enqueue CSS	
function kmo_social_css() { ?>
<style type="text/css">
.kmo-social-icons {
    top: <?php echo get_option('kmo_social_top'); ?>px;
}

.entypo-social {
  background-color: rgba(0,0,0,0.75);
  color: <?php echo get_option('kmo_social_font-size'); ?>;
  font-size: <?php echo get_option('kmo_social_font-size'); ?>px;
  height: <?php echo get_option('kmo_social_height'); ?>px;
  width: <?php echo get_option('kmo_social_width'); ?>px;
  right: <?php echo get_option('kmo_social_in'); ?>px;
}

.entypo-social-facebook:hover{ right:<?php echo get_option('kmo_social_out'); ?>px;}
.entypo-social-twitter:hover{ right:<?php echo get_option('kmo_social_out'); ?>px;}
.entypo-social-pinterest:hover{ right:<?php echo get_option('kmo_social_out'); ?>px;}
.entypo-social-googleplus:hover{ right:<?php echo get_option('kmo_social_out'); ?>px;}
</style>
<?php
}
add_action('wp_head','kmo_social_css',100);
add_action('admin_head-toplevel_page_kmo_social','kmo_social_css');
