<?php
add_action('admin_menu', 'weever_admin_add_page');

weever_admin_warnings();

/**
 * Add the administration pages for Weever Apps. Uses the admin_print_scripts action to ensure
 * the javascript/css is only loaded on our configuration screens.
 */
function weever_admin_add_page() {
    if ( function_exists('add_menu_page') )
    {
        // Ensure there are no directory references
        $page = ( isset( $_GET['page'] ) ? basename( $_GET['page'] ) : '' );

        // Pseudo-page to enable/disable
        $mypage = add_submenu_page( '', __( 'Weever App', 'weever' ), __( 'Weever App', 'weever' ), 'manage_options', 'weever-app-toggle', 'weever_admin_page' );
        
        
        // If this is a weever page, add it as the admin menu item (so it is always highlighted properly between admin page tabs)
        if ( substr( $page, 0, strlen('weever-') ) == 'weever-' && file_exists( dirname( __FILE__ ) . '/templates/admin/tabs/' . str_replace( 'weever-', '', $page ) . '.php' ) )
        {
    		$mypage = add_menu_page(__('Weever App', 'weever'), __('Weever App', 'weever'), 'manage_options', $page, 'weever_admin_page', '');
    		add_action( "admin_print_scripts-$mypage", 'weever_page_scripts_init' );
    		add_action( "admin_print_styles-$mypage", 'weever_page_styles_init' );
        }
        else
        {
//    		$mypage = add_submenu_page('', __('Weever Apps Configuration', 'weever'), __('App Features and Navigation', 'weever'), 'manage_options', 'weever-tabs', 'weever_conf');
            if ( get_option( 'weever_api_key' ) )
    		    $mypage = add_menu_page(__('Weever App', 'weever'), __('Weever App', 'weever'), 'manage_options', 'weever-list', 'weever_admin_page', '');
            else
    		    $mypage = add_menu_page(__('Weever App', 'weever'), __('Weever App', 'weever'), 'manage_options', 'weever-account', 'weever_admin_page', '');
            add_action( "admin_print_scripts-$mypage", 'weever_page_scripts_init' );
    		add_action( "admin_print_styles-$mypage", 'weever_page_styles_init' );
        }
	}
}

function weever_remove_wp_magic_quotes() {
	$_GET    = stripslashes_deep( $_GET );
	$_POST   = stripslashes_deep( $_POST );
	$_COOKIE = stripslashes_deep( $_COOKIE );
	$_REQUEST = stripslashes_deep( $_REQUEST );
}

/**
 * Page controller, loads the wrapper layout and the indivdual page content
 *
 * TODO: Wrap all tabs into one so they can flip between them sans refresh?
 */
function weever_admin_page() {
	// Set the content
	// Should never get here without the page get var being set
	// TODO: Create a WeeverView class wrapper to pass arbitrary options to the view?
	$page = basename( $_GET['page'] );
	$content = dirname( __FILE__ ) . '/templates/admin/tabs/' . str_replace( 'weever-', '', $page ) . '.php';

	if ( ( function_exists('current_user_can') && current_user_can('manage_options') ) ) {
	    // Verify this is a valid page
		if ( ! file_exists( $content ) )
		    die( __( 'Invalid page given', 'weever' ) );
	
		// Load the weeverapp object, which fetches the admin page content
		try {
	        $weeverapp = new WeeverApp();
	
	        if ( ! $weeverapp->loaded ) {
		        add_settings_error('weever_settings', 'weever_settings', $weeverapp->error_message . " " . sprintf( __( '<a target="_new" href="%s">Contact Weever Apps support</a>', 'weever' ), 'http://weeverapps.com/support' ) );
	        } else {
	        	if ( isset( $_GET['page'] ) and 'weever-theme' == $_GET['page'] ) {
	        		$weeverapp->load_theme();
	        	}
	        }
		} catch (Exception $e) {
		    add_settings_error('weever_settings', 'weever_settings', __( 'Error loading necessary data' ) . " " . sprintf( __( '<a target="_new" href="%s">Contact Weever Apps support</a>', 'weever' ), 'http://weeverapps.com/support' ) );
		}
	
		if ( isset( $_GET['weever-app-enabled'] ) ) {
			try {
				if ( 0 == $_GET['weever-app-enabled'] || 1 == $_GET['weever-app-enabled'] ) {
					$weeverapp->app_enabled = ( $_GET['weever-app-enabled'] ? 1 : 0 );
					$weeverapp->save();
	        	    add_settings_error('weever_config', 'weever_settings', __( 'Weever Apps status updated', 'weever' ), 'updated' );
				}					
			} catch ( Exception $e ) {
	        	add_settings_error('weever_config', 'weever_settings', $e->getMessage() . " " . sprintf( __( '<a target="_new" href="%s">Contact Weever Apps support</a>', 'weever' ), 'http://weeverapps.com/support' ) );
			}
		}

	    // Handle form submission
		if ( isset( $_POST['submit'] ) || isset( $_POST['stagingmode'] ) ) {

			// Remove wordpress slashes
			weever_remove_wp_magic_quotes();
			
	    	switch ( $_GET['page'] ) {
	    	    case 'weever-theme':
	                try {
	                    // Handle any image uploads
	                    $overrides = array( 'test_form' => false );
	                    $images = array( 'tablet_load_live', 'tablet_landscape_load_live', 'phone_load_live', 'icon_live', 'titlebar_logo_live' );
	
	                    foreach ( $images as $image ) {
	                        if ( array_key_exists( $image, $_FILES ) ) {
	                            $file = wp_handle_upload( $_FILES[$image], $overrides );
	                            if ( isset( $file['error'] ) && 'No file was uploaded.' != $file['error'] ) {
	                                add_settings_error('weever_theme', 'weever_settings', sprintf( __( 'Error uploading file: %s', 'weever' ), $file['error'] ) . ' ' . sprintf( __( '<a target="_new" href="%s">Contact Weever Apps support</a>', 'weever' ), 'http://weeverapps.com/support' ) );
	                            } elseif ( isset( $file['url'] ) ) {
	                                $weeverapp->theme->$image = $file['url'];
	                                add_settings_error('weever_api_key', 'weever_settings', __( 'Theme image updated', 'weever' ), 'updated');
	                            }
	                        }
	                    }
	
	                    $weeverapp->theme->css = $_POST['css'];
	                    $weeverapp->theme->useCssOverride = ( isset( $_POST['useCssOverride'] ) && $_POST['useCssOverride'] ) ? 1 : 0;
	                    $weeverapp->theme->titlebarSource = $_POST['titlebarSource'];
	                    $weeverapp->theme->titlebarHtml = $_POST['titlebarHtml'];
	                    $weeverapp->theme->template = $_POST['template'];
	                    $weeverapp->launch->install_prompt = $_POST['install_prompt'];
	                    $weeverapp->title = $_POST['title'];
	                    $weeverapp->titlebar_title = $_POST['titlebar_title'];
	
	                    $weeverapp->save_theme();
	                    $weeverapp->save();
	                    
	                    // Save the colours
	                    update_option( 'weever_main_titlebar_color', $_POST['main_titlebar_color'] );
	                    update_option( 'weever_main_titlebar_text_color', $_POST['main_titlebar_text_color'] );
	                    update_option( 'weever_inactive_button_color', $_POST['inactive_button_color'] );
	                    update_option( 'weever_inactive_button_text_color', $_POST['inactive_button_text_color'] );
	                    update_option( 'weever_active_button_color', $_POST['active_button_color'] );
	                    update_option( 'weever_active_button_text_color', $_POST['active_button_text_color'] );
	                    update_option( 'weever_subtab_color', $_POST['subtab_color'] );
	                    update_option( 'weever_subtab_text_color', $_POST['subtab_text_color'] );
	                     
	                    /*
	                    
	                    jQuery('#inactive_button_colorpicker').farbtastic('#inactive_button_color');
	                    jQuery('#inactive_button_text_colorpicker').farbtastic('#inactive_button_text_color');
	                    
	                    jQuery('#active_button_colorpicker').farbtastic('#active_button_color');
	                    jQuery('#active_button_text_colorpicker').farbtastic('#active_button_text_color');
	                    
	                    jQuery('#subtab_colorpicker').farbtastic('#subtab_color');
	                    jQuery('#subtab_text_colorpicker').farbtastic('#subtab_text_color');*/
	                    
	                     
	                    
	                    add_settings_error('weever_api_key', 'weever_settings', __( 'Weever Apps theme settings saved', 'weever' ), 'updated');
	                } catch (Exception $e) {
	        	        add_settings_error('weever_theme', 'weever_settings', $e->getMessage() . " " . sprintf( __( '<a target="_new" href="%s">Contact Weever Apps support</a>', 'weever' ), 'http://weeverapps.com/support' ) );
	                }
	
	    	        break;
	
	    	    case 'weever-account':
	    	        try {
	                    $weeverapp->site_key = trim( $_POST['site_key'] );
	
	                    if ( isset( $_POST['stagingmode'] ) ) {
	                        // Toggle staging mode
	                        $weeverapp->staging_mode = ! $weeverapp->staging_mode;
	                    }
	
	                    $weeverapp->save();
	                    add_settings_error('weever_api_key', 'weever_settings', __( 'Weever Apps account settings saved', 'weever' ), 'updated');
	    	        } catch (Exception $e) {
	        	        add_settings_error('weever_api_key', 'weever_settings', $e->getMessage() . " " . sprintf( __( '<a target="_new" href="%s">Contact Weever Apps support</a>', 'weever' ), 'http://weeverapps.com/support' ) );
	    	        }
	    	        break;
	
	    	    case 'weever-config':
	    	        try {
	        	        // Save each of the mobile device options
	        	        foreach ( $weeverapp->get_device_option_names() as $option ) {
	                        // Sanitize input
	                        $weeverapp->$option = ( isset( $_POST[$option] ) && $_POST[$option] ) ? 1 : 0;
	        	        }
	
	        	        // Remaining options
	                    $weeverapp->google_analytics = ( isset( $_POST['google_analytics'] ) ? $_POST['google_analytics'] : '' );
	                    $weeverapp->ecosystem = ( isset( $_POST['ecosystem'] ) ? $_POST['ecosystem'] : '' );
	                    $weeverapp->domain = ( isset( $_POST['domain'] ) ? $_POST['domain'] : '' );
	                    $weeverapp->loadspinner = ( isset( $_POST['loadspinner'] ) ? $_POST['loadspinner'] : '' );
	                    $weeverapp->granular = ( isset( $_POST['granular'] ) && $_POST['granular'] ) ? 1 : 0;
	                    $weeverapp->local = ( isset( $_POST['local'] ) ? $_POST['local'] : '' );
	                    $weeverapp->save();
	                    add_settings_error('weever_config', 'weever_settings', __( 'Weever App settings saved', 'weever' ), 'updated');
	    	        } catch (Exception $e) {
	        	        add_settings_error('weever_config', 'weever_settings', $e->getMessage() . " " . sprintf( __( '<a target="_new" href="%s">Contact Weever Apps support</a>', 'weever' ), 'http://weeverapps.com/support' ) );
	    	        }
	
	    	        break;
	    	}
	
	        // Most form control handled via AJAX calls rather than direct post
		}
		
		// Check if the domain is different than the current site domain
		if ( $weeverapp->loaded && $weeverapp->site_key ) {
			if ( ! stripos( site_url(), $weeverapp->primary_domain ) )
				add_settings_error('weever_settings', 'weever_settings', sprintf( __( 'Your Weever App subscription key url %s does not match the current Wordpress site url %s - please verify your Wordpress settings, that you have the correct subscription key, or contact support.' ), $weeverapp->primary_domain, site_url() ) . " " . sprintf( __( '<a target="_new" href="%s">Contact Weever Apps support</a>', 'weever' ), 'http://weeverapps.com/support' ) );
		}
		
	} else {
		die( __( 'Access denied', 'weever' ) );
	}
	
	// Include the main content to fire things off
	require( dirname( __FILE__) . '/templates/admin/layout.php' );
}

function weever_admin_warnings() {
	global $wp_version;
	
	if ( ! get_option( 'weever_api_key' ) && ! isset( $_POST['submit']) && ( function_exists( 'is_multisite' ) || ! version_compare( $wp_version, '3.0', '<' ) ) ) {
		function weever_warning() {
			echo "
			<div id='weever-warning' class='updated'><p><strong>".__('Weever Apps is almost ready.', 'weever')."</strong> ".sprintf(__('You must <a href="%1$s">enter your Weever Apps Subscription Key</a> for it to work.  Don\'t have one?  <a target="_blank" href="http://weeverapps.com/pricing">Get one here</a>.', 'weever'), "plugins.php?page=weever-account")."</p></div>
			";
		}
		add_action( 'admin_notices', 'weever_warning' );
		return;
	}
}

function weever_admin_init() {
    global $wp_version;

    // all admin functions are disabled in old versions
    if ( ! function_exists( 'is_multisite' ) && version_compare( $wp_version, '3.0', '<' ) ) {

        function weever_version_warning() {
            echo "
            <div id='weever-warning' class='updated'><p><strong>".sprintf( __( 'Weever Apps %s requires WordPress 3.0 or higher.', 'weever' ), WeeverConst::VERSION ) ."</strong> ".sprintf( __( 'Please <a href="%s">upgrade WordPress</a> to a current version.', 'weever' ), 'http://codex.wordpress.org/Upgrading_WordPress' ). "</p></div>
            ";
        }
        add_action( 'admin_notices', 'weever_version_warning' );

        return;
    }
}

add_action( 'admin_init', 'weever_admin_init' );

/**
 * Load styles needed for Weever Apps
 */
function weever_page_styles_init() {
	wp_register_style( 'weever.css', WEEVER_PLUGIN_URL . 'static/css/weever.css', array( 'jquery-ui.css', 'jquery-ui-new.css', 'wp-jquery-ui-dialog', 'thickbox', 'joyride-1.0.3.css', 'wp-jquery-ui-dialog', 'farbtastic' ), WeeverConst::VERSION );
	wp_register_style( 'jquery-ui.css', WEEVER_PLUGIN_URL . 'static/css/jquery-ui.css', array( 'wp-jquery-ui-dialog' ) );
	wp_register_style( 'jquery-ui-new.css', WEEVER_PLUGIN_URL . 'static/css/jquery-ui-new.css', array( 'wp-jquery-ui-dialog' ) );
	wp_register_style( 'jquery-impromptu.css', WEEVER_PLUGIN_URL . 'static/css/jquery-impromptu.css' );
	wp_register_style( 'joyride-1.0.3.css', WEEVER_PLUGIN_URL . 'static/css/joyride-1.0.3.css' );
	wp_enqueue_style( 'jquery-ui.css' );
	wp_enqueue_style( 'jquery-ui-new.css' );
	wp_enqueue_style( 'jquery-impromptu.css' );
	wp_enqueue_style( 'weever.css' );
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_style( 'joyride-1.0.3.css' );
	wp_enqueue_style( 'wp-jquery-ui-dialog' );
	wp_enqueue_style( 'farbtastic' );
}

/**
 * Loads scripts needed for Weever Apps
 */
function weever_page_scripts_init() {
    wp_register_script( 'jquery-impromptu.js', plugins_url( 'static/js/jquery-impromptu.js', __FILE__ ) );
    wp_enqueue_script( 'jquery-impromptu.js' );

    wp_register_script( 'jquery-validate.js', plugins_url( 'static/js/jquery.validate.min.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_script( 'jquery-validate.js' );

	wp_register_script( 'weever.js', plugins_url( 'static/js/weever.js', __FILE__ ), array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-sortable', 'jquery-ui-dialog' ), WeeverConst::VERSION );
	wp_enqueue_script( 'weever.js' );
	wp_localize_script( 'weever.js', 'WPText', WeeverHelper::get_js_strings() );
	
	// Register the feature tour script
	wp_register_script( 'jquery-joyride.js', plugins_url( 'static/js/jquery.joyride-1.0.3.js', __FILE__ ), array( 'jquery', 'weever.js' ), WeeverConst::VERSION );
	
	// Page-specific scripts
	if ( isset( $_GET['page'] ) )
	{
    	$page = basename( $_GET['page'] );

    	switch ( $page ) {
    	    case 'weever-account':
                wp_register_script( 'weever.account.js', plugins_url( 'static/js/account.js', __FILE__ ), array( 'jquery' ), WeeverConst::VERSION );
                wp_enqueue_script( 'weever.account.js' );
                
                // Feature tour scripts
                wp_enqueue_script( 'jquery-joyride.js' );
                break;

            case 'weever-list':
                wp_register_script( 'weever.list_icons.js', plugins_url( 'static/js/list_icons.js', __FILE__ ), array( 'jquery' ), WeeverConst::VERSION );
                wp_enqueue_script( 'weever.list_icons.js' );

                wp_register_script( 'weever.list_select.js', plugins_url( 'static/js/list_select.js', __FILE__ ), array( 'jquery' ), WeeverConst::VERSION );
                wp_enqueue_script( 'weever.list_select.js' );

                wp_register_script( 'weever.list_submit.js', plugins_url( 'static/js/list_submit.js', __FILE__ ), array( 'jquery' ), WeeverConst::VERSION );
                wp_enqueue_script( 'weever.list_submit.js' );

                wp_register_script( 'weever.list.js', plugins_url( 'static/js/list.js', __FILE__ ), array( 'jquery' ), WeeverConst::VERSION );
                wp_enqueue_script( 'weever.list.js' );
                
                // Feature tour scripts
                wp_enqueue_script( 'jquery-joyride.js' );
                
                break;

    	    case 'weever-theme':
                wp_register_script( 'weever.theme.js', plugins_url( 'static/js/theme.js', __FILE__ ), array( 'jquery', 'farbtastic' ), WeeverConst::VERSION );
                wp_enqueue_script( 'weever.theme.js' );
                wp_enqueue_script( 'farbtastic' );
                break;

            case 'weever-config':
                wp_register_script( 'weever.config.js', plugins_url( 'static/js/config.js', __FILE__ ), array( 'jquery' ), WeeverConst::VERSION );
                wp_enqueue_script( 'weever.config.js' );
                break;

            case 'weever-support':
    	        break;

            default:
                wp_die();
    	}
	}
}

function weever_app_toggle() {
	if ( function_exists('current_user_can') && current_user_can('manage_options') && ! isset( $_GET['weever-app-enabled'] ) )
	{		
	    $weeverapp = new WeeverApp( false );
	    if ( $weeverapp->site_key ) {
?>
	    <div class="wx-app-admin-link-enabled" <?php echo ($weeverapp->app_enabled ? '' : ' style="display:none;" '); ?>>
	    	<?php echo __( 'Weever App Enabled for Mobile Visitors', 'weever' ); ?>
	    	| <a href="<?php echo admin_url( 'admin.php?page=weever-list' ); ?>"><?php echo __( 'Settings', 'weever' ); ?></a>
		</div>
	    <div class="wx-app-admin-link-disabled" <?php echo ($weeverapp->app_enabled ? ' style="display:none;" ' : ''); ?>>
	        <?php echo __( 'Weever App Disabled for Mobile Visitors', 'weever' ); ?>
	        | <a href="<?php echo admin_url( 'admin.php?page=weever-list' ); ?>"><?php echo __( 'Settings', 'weever' ); ?></a>
	    </div>
<?php 
	    }
	}
}

add_action( 'admin_notices', 'weever_app_toggle' );

/**
 * Add custom fields for post editing, for KML and custom marker url
 */

function weever_add_custom_box() {
	add_meta_box('weever_sectionid', __( 'Weever Apps - Map Data', 'myplugin_textdomain' ), 'weever_inner_custom_box', 'post', 'advanced' );
}

add_action('admin_menu', 'weever_add_custom_box');

function weever_inner_custom_box() {
	echo '<input type="hidden" id="weever_nonce" name="weever_nonce" value="' .
			wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '
	<p>
		<label for="weever-kml">Display Address:</label>
		<input type="text" id="weever-map-address" name="weever-map-address" value="">
	</p>
	
	<p>
		<label for="weever-kml">KML File URL:</label>
		<input type="text" id="weever-kml" name="weever-kml" value="">
	</p>
	<p>
		<label for="weever-kml">Custom Map Marker URL:</label>
		<input type="text" id="weever-map-marker" name="weever-map-marker" value="">
	</p>
	<p>
		NOTE: Custom map markers must be PNG image sprites that are 128 pixels by 74 pixels. The image on the left is the normal state, the one on the right is the selected state; each is 64x74 pixels placed beside each other in the same transparent PNG image file.
	</p>
	';
}

function weever_post_admin_head() {
	global $post;
	$post_id = $post->ID;
	$post_type = $post->post_type;
	$zoom = (int) get_option('geolocation_default_zoom');
	?>
	<script type="text/javascript">
	jQuery(function() {
		jQuery(document).ready(function() {
			jQuery('#weever-map-address').val('<?php echo esc_js(get_post_meta($post_id, 'weever_map_address', true)); ?>');
			jQuery('#weever-kml').val('<?php echo esc_js(get_post_meta($post_id, 'weever_kml', true)); ?>');
			jQuery('#weever-map-marker').val('<?php echo esc_js(get_post_meta($post_id, 'weever_map_marker', true)); ?>');
		});
	});
	</script>
	<?php 
}

add_action('admin_head-post-new.php', 'weever_post_admin_head');
add_action('admin_head-post.php', 'weever_post_admin_head');

function weever_save_postdata($post_id) {
	// Check authorization, permissions, autosave, etc
	if ( ! isset( $_POST['weever_nonce'] ) or ! wp_verify_nonce( $_POST['weever_nonce'], plugin_basename( __FILE__ ) ) )
		return $post_id;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	if( 'page' == $_POST['post_type'] ) {
		if( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	update_post_meta($post_id, 'weever_map_address', $_POST['weever-map-address']);
	update_post_meta($post_id, 'weever_kml', $_POST['weever-kml']);
	update_post_meta($post_id, 'weever_map_marker', $_POST['weever-map-marker']);

	return $post_id;
}

add_action('save_post', 'weever_save_postdata');

function weever_section_text() {
	echo '<p></p>';
}

function weever_api_key_string() {
    $weever_api_key = get_option( 'weever_api_key' );
    echo "<input id='weever_api_key' name='weever_api_key' size='40' type='text' value='$weever_api_key' />";
}

function weever_api_key_validate($weever_api_key) {
	$weever_api_key = trim($weever_api_key);

	$stage_url = "";

	$postdata = http_build_query(
			array(
				'stage' => $stage_url,
				'app' => 'json',
				'site_key' => $weever_api_key,
				'm' => "tab_sync",
				'version' => WeeverConst::VERSION,
				'generator' => WeeverConst::NAME
				)
			);

	$result = wp_remote_get( WeeverConst::LIVE_SERVER."?".$postdata );

	if ( is_array( $result ) and isset( $result['body'] ) )
	{
	    $state = json_decode($result['body']);

    	if ( "Site key missing or invalid." == $result['body'] )
    	{
    	    $weever_api_key = '';
    	    add_settings_error('weever_api_key', 'weever_settings', 'Invalid Weever API key');
        } else {
            add_settings_error('weever_api_key', 'weever_settings', "Weever Apps API key saved and updated - ".$state->results->config->primary_domain, 'updated');
        }
	}
	else
	{
	    add_settings_error('weever_api_key', 'weever_settings', 'Weever API key could not be verified');
	}

	return $weever_api_key;
}

