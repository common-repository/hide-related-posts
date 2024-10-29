<?php
/*
Plugin Name: Hide Related Posts
Description: Hides all related posts.
Version: 1.0
Author: Catering Dubai
Author URI: https://cateringindubai.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


if (is_admin())
   {   
      function hrp_hiderelatedposts_admin_restrict_data() 
		{  
			
			add_options_page('Hide Related Posts', 'Hide Related Posts', 'manage_options', 'hide_related_posts', 'hrp_hiderelatedposts');
		}   
       add_action('admin_menu','hrp_hiderelatedposts_admin_restrict_data'); 
   }
   	function hrp_hiderelatedposts()
	{
		global $wpdb;

	
		?>

<div class="main-used-container">
    <div class="main-notices">
		<div class="notices">
			<div class="logo-container"><img class="main-image" width="150" src="<?php echo plugin_dir_url( __FILE__ ) ?>/assets/img/correct.png"/></div>
			<h2 style="text-align: center;">Hide Related Posts</h2>
			<p style="text-align: center;margin-bottom:2%;">The plugin is now active and the related posts are hidden. If you wish to disable this feature simply deactivate the plugin.</p>
		</div>
    </div>
</div>
<?php
}

register_activation_hook(__FILE__, 'hrp_hiderelatedposts_my_plugin_activate');
register_deactivation_hook( __FILE__, 'hrp_hiderelatedposts_my_plugin_deactivation' );

add_action('admin_init', 'hrp_hiderelatedposts_my_plugin_redirect');

function hrp_hiderelatedposts_my_plugin_activate() {
    add_option('hrp_hiderelatedposts_my_plugin_do_activation_redirect', true);
}
function hrp_hiderelatedposts_my_plugin_deactivation() {
    
}
function hrp_hiderelatedposts_my_plugin_redirect() {
    if (get_option('hrp_hiderelatedposts_my_plugin_do_activation_redirect', false)) {
        delete_option('hrp_hiderelatedposts_my_plugin_do_activation_redirect');
        wp_redirect(get_site_url()."/wp-admin/options-general.php?page=hide_related_posts");
    }
}

function hrp_hiderelatedposts_custom_added_text() {
	if (is_singular( 'post' )){
    ?>
	
	<script>
		jQuery(document).ready(function(){
			jQuery('[class*="related-post"]').css("display", "none");
		});
	</script>
	
<?php } 
}

add_action('wp_footer', 'hrp_hiderelatedposts_custom_added_text');

function hrp_hiderelatedposts_admin_style() {
	wp_enqueue_style('admin-styles', plugin_dir_url( __FILE__ ).'assets/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'hrp_hiderelatedposts_admin_style');