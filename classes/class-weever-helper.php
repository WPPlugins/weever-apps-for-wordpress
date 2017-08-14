<?php

    class WeeverHelper {

        private static $_weeverapp = false;

        /**
         * Function to take a url and ensure it is an absolute url
         * http://www.geekality.net/2011/05/12/php-dealing-with-absolute-and-relative-urls/
		 *
         * @param string $url
         * @param string $base
         */
        public static function make_absolute($url, $base) {
            // Return base if no url
            if( ! $url) return $base;

            // Return if already absolute URL
            if(parse_url($url, PHP_URL_SCHEME) != '') return $url;

            // Urls only containing query or anchor
            if($url[0] == '#' || $url[0] == '?') return $base.$url;

            // Parse base URL and convert to local variables: $scheme, $host, $path
            extract(parse_url($base));

            // If no path, use /
            if( ! isset($path)) $path = '/';

            // Remove non-directory element from path
            $path = preg_replace('#/[^/]*$#', '', $path);

            // Destroy path if relative url points to root
            if($url[0] == '/') $path = '';

            // Dirty absolute URL
            $abs = "$host$path/$url";

            // Replace '//' or '/./' or '/foo/../' with '/'
            $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
            for($n = 1; $n > 0; $abs = preg_replace($re, '/', $abs, -1, $n)) {}

            // Absolute URL is ready!
            return $scheme.'://'.$abs;
        }

        /**
         * Return the strings for internationalization in the javascript files
         *
         * @return array
         */
        public static function get_js_strings() {
		    return array(
    			'WEEVER_JS_ENTER_NEW_APP_ICON_NAME' => __( 'Enter a New App Icon Name:', 'weever' ),
    			'WEEVER_JS_APP_UPDATED' => __( 'App Updated', 'weever' ),
    			'WEEVER_JS_PLEASE_WAIT' => __( 'Please wait, communicating with server', 'weever' ),
    			'WEEVER_JS_SAVING_CHANGES' => __( 'Saving Changes', 'weever' ),
    			'WEEVER_JS_SERVER_ERROR' => __( 'Server Error Occurred', 'weever' ),
    			'WEEVER_JS_ENTER_NEW_APP_ITEM' => __( '' ),
    			'WEEVER_JS_ARE_YOU_SURE_YOU_WANT_TO' => __( 'Are you sure you want to ', 'weever' ),
    			'WEEVER_JS_QUESTION_MARK' => __( '?', 'weever' ),
    			'WEEVER_JS_CHANGING_NAV_ICONS' => __( 'Changing Navigation Icons:', 'weever' ),
    			'WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS_A' => __( 'Weever Apps Icons are made with &quot;Base64&quot;-encoded CSS.', 'weever' ),
                'WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS_B' => __( 'To create a new icon, please upload your icon-image to a %1Base64 Encoder%2 and paste in the results below. We strongly recommend using a black monochrome, transparent 64 x 64 pixel PNG image.', 'weever' ),
		        'WEEVER_JS_RESET_TO_DEFAULT' => __( 'Reset to Default', 'weever' ),
		        'WEEVER_JS_NO_IMAGE_URL' => WEEVER_PLUGIN_URL . 'static/images/icons/no-image.png',
    			'WEEVER_JS_CHANGING_NAV_PASTE_CODE' => __( 'Click and paste your code here', 'weever' ),
		        'WEEVER_JS_STATIC_PATH' => WEEVER_PLUGIN_URL . 'static/',
		        'WEEVER_JS_ADMIN_LIST_URL' => admin_url( 'admin.php?page=weever-list' ),
		        'WEEVER_JS_SELECT_AN_ELEMENT' => __( 'Select at least one item from the list first', 'weever' ),
		        'WEEVER_JS_CONFIRM_LIST_ACTION' => __( 'Are you sure you want to %s the selected items?', 'weever' ),
		    	'WEEVER_JS_PANEL_TRANSITION_ANIMATIONS' => __( 'Panel Transition Animations', 'weever' ),
		    	'WEEVER_JS_PANEL_TRANSITION_TOOLTIP' => __( 'When enabled, each items will transition one to the next, like a slideshow', 'weever' ),
		    	'WEEVER_JS_PANEL_TRANSITION_TOGGLE' => __( 'Transitions', 'weever' ),
		    	'WEEVER_CONFIG_DISABLED' => __( 'Disabled', 'weever' ),
		    	'WEEVER_CONFIG_ENABLED' => __( 'Enabled', 'weever' ),
		    	'WEEVER_JS_PANEL_TRANSITION_DURATION_TOOLTIP' => __( 'Controls the duration of the animated transition', 'weever' ),
		    	'WEEVER_JS_PANEL_TRANSITION_DURATION' => __( 'Animation Duration', 'weever' ),
		    	'WEEVER_JS_PANEL_TRANSITION_DURATION_SHORT' => __( 'Shorter', 'weever' ),
		    	'WEEVER_JS_PANEL_TRANSITION_DURATION_DEFAULT' => __( 'Default', 'weever' ),
		    	'WEEVER_JS_PANEL_TRANSITION_DURATION_LONG' => __( 'Longer', 'weever' ),
		    	'WEEVER_JS_PANEL_TIMEOUT_TOOLTIP' => __( 'Sets how long until a transition occurs', 'weever' ),
		    	'WEEVER_JS_PANEL_TIMEOUT' => __( 'Time Until Transition', 'weever' ),
		    	'WEEVER_JS_PANEL_TIMEOUT_SHORT' => __( 'Shorter', 'weever' ),
		    	'WEEVER_JS_PANEL_TIMEOUT_DEFAULT' => __( 'Default', 'weever' ),
		    	'WEEVER_JS_PANEL_TIMEOUT_LONG' => __( 'Longer', 'weever' ),
		    	'WEEVER_JS_PANEL_HEADERS_TOOLTIP' => __( 'When disabled, article/content items\' titles, authors, and other meta-data is not displayed.', 'weever' ),
		    	'WEEVER_JS_PANEL_HEADERS' => __( 'Content Headers', 'weever' ),
		    	'WEEVER_JS_MAP_SETTINGS' => __( 'Map Settings', 'weever' ),
		    	'WEEVER_JS_MAP_START_LATITUDE_TOOLTIP' => __( 'Latitude that which the map first starts at.', 'weever' ),
		    	'WEEVER_JS_MAP_START_LATITUDE' => __( 'Starting Latitude', 'weever' ),
		    	'WEEVER_JS_MAP_START_LONGITUDE_TOOLTIP' => __( 'Longitude that which the map first starts at.', 'weever' ),
		    	'WEEVER_JS_MAP_START_LONGITUDE' => __( 'Starting Longitude', 'weever' ),
		    	'WEEVER_JS_MAP_START_ZOOM_TOOLTIP' => __( 'Zoom level that which the map first starts at. (1-15)', 'weever' ),
		    	'WEEVER_JS_MAP_START_ZOOM' => __( 'Zoom Level (1-15)', 'weever' ),
		    	'WEEVER_JS_MAP_DEFAULT_MARKER_TOOLTIP' => __( 'Default marker sprite, used when a marker sprite is unspecified. Must be a 128x74 PNG file, containging two images 64x74 side by side.', 'weever' ),
		    	'WEEVER_JS_MAP_DEFAULT_MARKER' => __( 'Default Marker Image URL', 'weever' ),
		    );
        }

        /**
         * Get the url of the feed for the given term
         *
         * @param term $term
         * @param string $feed
         * @return string or bool false on error
         */
        public static function get_term_feed_link_relative( $term, $feed = 'r3s' ) {
		    $term_id = $term->term_id;
		    $taxonomy = $term->taxonomy;
		    $link = false;
			if ( 'category' == $taxonomy ) {
    			$link = "index.php?feed=$feed&amp;cat=$term_id";
    		}
    		elseif ( 'post_tag' == $taxonomy ) {
    			$link = "index.php?feed=$feed&amp;tag=$term->slug";
    		} else {
    			$t = get_taxonomy( $taxonomy );
    			if ( $t->query_var )
    				$link = "index.php?feed=$feed&amp;$t->query_var=$term->slug";
    		}

    		return $link;
        }

        public static function get_page_link_relative( $page ) {
            return "index.php?page_id=$page->ID";
        }

        /**
         * Get the url to the user page/feed without any permalink
         *
         * @param WPUser $user
         */
        public static function get_user_link_relative( $user ) {
            $link = "index.php?author_name=$user->user_nicename";
            return $link;
        }

        public static function get_user_feed_link_relative( $user, $feed = 'r3s' ) {
        }

        /**
         * Set the weeverapp variable in preparation for server
		 *
         * @param unknown_type $weeverapp
         */
        public static function set_weeverapp(&$weeverapp) {
            self::$_weeverapp = $weeverapp;
        }

        public static function & get_weeverapp() {
            return self::$_weeverapp;
        }

        /**
         * Retrieve and send data to the Weever Apps server
         *
         * @param unknown_type $postdata
         * @return raw data from the weever server
         */
        public static function send_to_weever_server($postdata) {
            global $wp_version;
            
            $retval = false;

            // Check for debug mode
            if ( is_admin() and isset( $_GET['debug'] ) ) {
            	$_SESSION[ 'weever_debug_mode' ] = ( $_GET['debug'] ? 1 : 0 );
            }
            
            if ( is_array( $postdata ) && self::$_weeverapp !== false ) {
            	$server = (self::$_weeverapp->staging_mode ? WeeverConst::LIVE_STAGE : WeeverConst::LIVE_SERVER);

            	if ( ! isset( $postdata['site_key'] ) )
            	    $postdata['site_key'] = self::$_weeverapp->site_key;

            	// Set the version
            	$postdata['version'] = WeeverConst::VERSION;
            	$postdata['generator'] = WeeverConst::NAME;
                $postdata['cms'] = WeeverConst::CMS;
                $postdata['cms_version'] = $wp_version;
            	
                if ( is_admin() and isset( $_SESSION[ 'weever_debug_mode' ] ) and $_SESSION[ 'weever_debug_mode' ] ) {
                	echo "Sending to $server...";
                	var_dump($postdata);
                }
                
            	$result = wp_remote_post( $server, array( 
	'method' => 'POST',
	'timeout' => 45,
	'redirection' => 5,
	'httpversion' => '1.0',
	'blocking' => true,
	'headers' => array(),
	'body' => $postdata,
	'cookies' => array() ) );

            	if ( is_admin() and isset( $_SESSION[ 'weever_debug_mode' ] ) and $_SESSION[ 'weever_debug_mode' ] ) {
            		echo "...receiving...";
            		var_dump($result);
            	}
            	
                if ( is_array( $result ) and isset( $result['body'] ) ) {
            	    $retval = $result['body'];
            	} else {
            		$error = ( is_wp_error( $result ) ? ': ' . $result->get_error_message() : '' );
            		
            	    throw new Exception( __( 'Error communicating with the Weever Apps server' . $error, 'weever' ) );
            	}
            } else {
                throw new Exception( __( 'Invalid postdata sent to function or weeverapp not set', 'weever' ) );
            }

        	return $retval;
        }
    }