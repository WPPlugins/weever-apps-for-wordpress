<?php

class WeeverApp {

    const TIER_BASIC = 0;
    const TIER_PRO = 1;

    private $_data = array();
    private $_changed = array();
    private $_device_options = array(
            // Granular options
            'DetectIphoneOrIpod' => 0,
            'DetectAndroid' => 0,
            'DetectBlackBerryTouch' => 0,
            'DetectWebOSTablet' => 0,
            'DetectIpad' => 0,
            'DetectBlackBerryTablet' => 0,
            'DetectAndroidTablet' => 0,
            'DetectGoogleTV' => 0,
            'DetectAppleTVTwo' => 0,
            'DetectTouchPad' => 0,
            // Options if granular is disabled
            'DetectTierWeeverSmartphones' => 1,
            'DetectTierWeeverTablets' => 0,
        );

        // Options if granular is disabled
        private $_device_options_standard = array( 'DetectTierWeeverSmartphones',
            								   'DetectTierWeeverTablets' );

    // TODO: Grab most of this data from the API
    /*
     * Constructor
     *
     * @return WeeverApp
     */
    public function __construct( $load_from_server = true, $site_key = false ) {
        try {
            // Register the app with the helper class
            WeeverHelper::set_weeverapp($this);

            // Initial settings
            $this->_data['theme'] = new WeeverAppThemeStyles();
			$this->_data['launch'] = new WeeverAppThemeLaunch();
            $this->_data['app_enabled'] = get_option( 'weever_app_enabled', 0 );
            $this->_data['site_key'] = ( $site_key === false ? get_option( 'weever_api_key', '' ) : $site_key );
            $this->_data['staging_mode'] = get_option( 'weever_staging_mode', 0 );
            $this->_data['primary_domain'] = get_option( 'weever_primary_domain', '' );
            $this->_data['titlebar_title'] = '';
            $this->_data['title'] = '';
            $this->_data['google_analytics'] = '';
            $this->_data['ecosystem'] = '';
            $this->_data['domain'] = get_option( 'weever_domain', '' );
            $this->_data['tier'] = get_option( 'weever_tier', 0 ); // Payment tier 0-basic 1-pro
            $this->_data['loadspinner'] = '';
            $this->_data['expiry'] = false;
            $this->_data['local'] = '';
            $this->_data['locales'] = array();

            $this->_data['tabs'] = array();

            // QR code urls
            $this->_data['qr_code_private'] = $this->_data['qr_code_public'] = '';

            // Device detection settings
            $this->_data['granular'] = get_option( 'weever_granular_devices', 0 );
            foreach ( $this->_device_options as $key => $value ) {
                 $this->_data[$key] = get_option( 'weever_device_option_'.$key, $value );
            }

            if ( $load_from_server ) {
                $this->reload_from_server();
            }

            // Finished, mark as loaded
            $this->_data['loaded'] = true;
        } catch ( Exception $e ) {
            $this->_data['loaded'] = false;
            $this->_data['error_message'] = $e->getMessage();
        }
    }

    public function & __get($var) {

        switch ( $var ) {
            default:
                if ( array_key_exists( $var, $this->_data ) )
                    return $this->_data[$var];
                else
                    throw new Exception( "Invalid parameter name $var" );
        }

    }

    public function __set($var, $val) {

        switch ( $var ) {
        	case 'local':
        		// Only allow locales that are supported 
        		if ( isset( $this->_data['locales']->$val ) ) {
        			$this->_changed[$var] = $var;
        			$this->_data['local'] = $val;
        		}
        		break;
        		
            case 'staging_mode':
                if ( $val )
                    $this->_data['staging_mode'] = 1;
                else
                    $this->_data['staging_mode'] = 0;
                $this->_changed[$var] = $var;
                break;

            case 'site_key':
                // TODO: Add any pre-validation here
                $this->_data['site_key'] = $val;
                $this->_changed[$var] = $var;
                break;

            case 'primary_domain':
                throw new Exception( "Cannot set $var directly" );
                break;

            default:
                if ( array_key_exists( $var, $this->_data ) ) {
                    $this->_data[$var] = $val;
                    $this->_changed[$var] = $var;
                } else {
                    throw new Exception( "Invalid parameter name $var" );
                }
        }

    }

    /**
     * Attempt to reload the data from the Weever server using the API
     */
    private function reload_from_server() {
        if ( ! empty( $this->_data['site_key'] ) ) {
        	$stage_url = ($this->_data['staging_mode'] ? WeeverConst::LIVE_STAGE : "");

			// Remaining settings
        	$postdata = array(
        				'stage' => $stage_url,
        				'app' => 'json',
        				'site_key' => $this->_data['site_key'],
        				'm' => "tab_sync",
        				'version' => WeeverConst::VERSION,
        				'generator' => WeeverConst::NAME
        				);

        	$result = WeeverHelper::send_to_weever_server($postdata);

        	// Try to decode the result
            $state = json_decode($result);

        	if ( "Site key missing or invalid." == $result ) {
        	    throw new Exception( __( 'Weever Apps API key is not valid' ) );
            } else {
                if ( ! is_array( $state->results->tabs ) )
                    throw new Exception( __( 'No tabs found') );

                // Get the settings
                $this->_data['title'] = $state->results->config->title;
                $this->_data['titlebar_title'] = $state->results->config->titlebar_title;
                // TODO: Perhaps check this against the local variable and sync it up?
                //$this->_data['app_enabled'] = $state->results->config->app_enabled;
                $this->_data['ecosystem'] = $state->results->config->ecosystem;
                $this->_data['primary_domain'] = $state->results->config->primary_domain;
                $this->_data['tier'] = $state->results->config->tier;
                $this->_data['loadspinner'] = ( $state->results->config->label ? $state->results->config->label->loadspinner : '' );
                $this->_data['google_analytics'] = ( $state->results->config->analytics ? $state->results->config->analytics->code : '' );
                $this->_data['expiry'] = $state->results->config->expiry;

                // Cache the primary_domain, domain and tier value for the redirection url creation
                update_option( 'weever_primary_domain', $this->_data['primary_domain'] );
                update_option( 'weever_tier', $this->_data['tier'] );
                update_option( 'weever_domain', $this->_data['domain'] );

                // Tabs
                // First load all the tabs then add the subtabs to the main tabs
                $this->_data['tabs'] = array();
                $theme_params = json_decode($state->results->config->theme_params);

                foreach ( $state->results->tabs as $tab ) {
                    if ( $tab->type == 'tab' ) {
                        // Main level tab
                        $icon_image = isset( $theme_params->{$tab->component.'Icon'} ) ? $theme_params->{$tab->component.'Icon'} : false;
                        $this->_data['tabs'][] = new WeeverAppTab( $tab->cloud_tab_id, $tab->component, $tab->name, $tab->published, $tab->ordering, $tab->icon, $icon_image, $tab->var );
                    } else {
                        // Sub-level tab
                        $this->_data['tabs'][] = new WeeverAppSubtab( $tab->cloud_tab_id, $tab->name, $tab->type, $tab->ordering, $tab->published, $tab->cms_feed );
                    }
                }

                // Theme params, just use the object
                $this->theme->load_from_json($theme_params);

                if ( $state->results->config->launchscreen === false ) {
                	// Push defaults to server
                	$this->save_theme();
                } else {
					// Load additional theme settings from newest version
					$this->theme->titlebarSource = $state->results->config->titlebar_source;
					$this->theme->template = $state->results->config->template;
					$this->theme->tablet_load_live = $state->results->config->launchscreen->tablet_load;
					$this->theme->tablet_landscape_load_live = $state->results->config->launchscreen->tablet_landscape_load;
					$this->theme->phone_load_live = $state->results->config->launchscreen->phone_load;
					$this->theme->icon_live = $state->results->config->launchscreen->icon;
					$this->theme->titlebar_logo_live = $state->results->config->launchscreen->titlebar_logo;
					$this->launch->install_prompt = $state->results->config->launchscreen->install_prompt;
                }

                if ( ! function_exists( 'tab_order' ) ) {
                    function tab_order($a, $b) {
                        if ( $a->ordering == $b->ordering )
                            // Take the tab's ID into account
                            return $a->id - $b->id;
                        else
                            return ceil($a->ordering - $b->ordering);
                    }
                }

                // Order the tabs
                usort( $this->_data['tabs'], 'tab_order' );

                // Put the subtabs in
                foreach ( $this->_data['tabs'] as $tab ) {
                    if ( ! $tab->is_top_level_tab() ) {
                        // Get the parent tab by the subtab type
                        $parent_tab = $this->get_tab( $tab->type );
                        $parent_tab->add_subtab( $tab );
                    }
                }

                // Re-generate the qr code if needed
                $this->generate_qr_code();
                
                // Localization and other config settings
                $postdata = array(
                		'app' => 'json',
                		'site_key' => $this->_data['site_key'],
                		'm' => "config_sync",
                		'version' => WeeverConst::VERSION,
                		'generator' => WeeverConst::NAME
                );
                
                $result = WeeverHelper::send_to_weever_server($postdata);
                
                // Try to decode the result
                $state = json_decode($result);
                
                // Get the data
                $this->_data['local'] = @$state->local;
                $this->_data['locales'] = @$state->locales;
            }
        }
    }

    private function is_valid() {
        return isset( $this->_data['site_key'] ) && ! empty( $this->_data['site_key'] ) && ! empty( $this->_data['primary_domain'] );
    }

	public function is_free() {
		return ( $this->_data['tier'] == 1 or $this->_data['tier'] == 2.1 );
	}

    public function & get_device_option_names() {
        $option_names = array_keys( $this->_device_options );
        return $option_names;
    }

    public function & get_granular_device_option_names() {
        $option_names = $this->get_device_option_names();
        foreach ( $this->get_standard_device_option_names() as $device ) {
            foreach ( $option_names as $key => $option ) {
                if ( $device == $option )
                    unset( $option_names[$key] );
            }
        }

        return $option_names;
    }

    public function & get_standard_device_option_names() {
        return $this->_device_options_standard;
    }

    public function & get_tabs($only_top_level = true) {
        if ( ! $only_top_level ) {
            // Return everything
            return $this->_data['tabs'];
        } else {
            $retval = array();

            foreach ( $this->_data['tabs'] as $tab ) {
                if ( $tab->is_top_level_tab() ) {
                    $retval[] = $tab;
                }
            }

            return $retval;
        }
    }

    /*
     * Get a tab
     *
     * @param mixed $id either the int id of the tab or the type/component of a top level tab
     */
    public function & get_tab($id) {
    	$tab = false;

        foreach ( $this->_data['tabs'] as $tab ) {
            if ( $tab->id == $id || ( $tab->is_top_level_tab() && $tab->component == $id ) )
                return $tab;
        }

        return $tab;
    }

    /**
     * Generate a QR code and cache it locally
     */
	public function generate_qr_code() {
	    if ( $this->is_valid() ) {
    		if ( $this->staging_mode ) {
    			$type = 'stage';
    			$queryExtra = '&staging=1';
    		} else {
    			$type = 'live';
    			$queryExtra = '';
    		}

    		$qr_site_url = "http://qr.weever.ca/?site=" . $this->primary_domain;
    		$qr_app_url = "http://qr.weever.ca/?site=" . $this->primary_domain . "&preview=1&beta=1" . $queryExtra;

    		// Set the urls to the direct link by default
		    $this->_data['qr_code_private'] = $qr_app_url;
		    $this->_data['qr_code_public'] = $qr_site_url;

    		// See if the uploads folder is accessible, and if so cache the image
    		$uploads = wp_upload_dir();
    		if ( isset( $uploads['basedir'] ) and isset( $uploads['baseurl'] ) ) {
    		    // Try to make the weeverapps sub-folder
    		    if ( wp_mkdir_p( trailingslashit( $uploads['basedir'] ) . 'weeverapps' ) ) {
            		if ( get_option( 'weever_qr_site_'.$type.'_code_time', 0 ) > time() || @copy( $qr_site_url, trailingslashit( $uploads['basedir'] ) . 'weeverapps/qr_site_'.$type.'.png' ) ) {
                        $this->_data['qr_code_public'] = trailingslashit( $uploads['baseurl'] ) . 'weeverapps/qr_site_'.$type.'.png';

                        if ( get_option( 'weever_qr_site_'.$type.'_code_time', 0 ) <= time() )
                            // Cache for 1 hour
                            update_option( 'weever_qr_site_'.$type.'_code_time', time() + 60*60 );
            		}

            		if ( get_option( 'weever_qr_app_'.$type.'_code_time', 0 ) > time() || @copy( $qr_app_url, trailingslashit( $uploads['basedir'] ) . 'weeverapps/qr_app_'.$type.'.png' ) ) {
                        $this->_data['qr_code_private'] = trailingslashit( $uploads['baseurl'] ) . 'weeverapps/qr_app_'.$type.'.png';

                        if ( get_option( 'weever_qr_app_'.$type.'_code_time', 0 ) <= time() )
                            // Cache for 1 hour
                            update_option( 'weever_qr_app_'.$type.'_code_time', time() + 60*60 );
            		}
            	}
    		}
	    } else {
	        $this->_data['qr_code_private'] = $this->_data['qr_code_public'] = '';
	    }
	}

	public function publish_tabs( $ids ) {
		$postdata = array(
				'published' => 1,
				'app' =>'ajax',
				'm' => 'publish_tab',
				'local_tab_id' => $ids,
				);

        $result = WeeverHelper::send_to_weever_server($postdata);

        if ( 'Item Published' != $result )
            throw new Exception( __( 'Error updating published status' ) );
    }

	public function unpublish_tabs( $ids ) {

		$postdata = array(
				'published' => 0,
				'app' =>'ajax',
				'm' => 'publish_tab',
				'local_tab_id' => $ids,
				);

        $result = WeeverHelper::send_to_weever_server($postdata);

        if ( 'Item Unpublished' != $result )
            throw new Exception( __( 'Error updating published status' ) );
    }

	public function delete_tabs( $ids ) {
		$postdata = array(
				'local_tab_id' => $ids,
				'app' => 'ajax',
				'm' => 'delete_tab',
				);

        $result = WeeverHelper::send_to_weever_server($postdata);

        if ( 'Item Deleted' != $result )
            throw new Exception( __( 'Error deleting tab' ) );
	}

	/**
	 *
	 *
	 * @param array $order array of type, in order they should appear
	 */
	public function order_tabs( $order ) {

		$reorderType = array();

		foreach ($order as $k => $v) {
			$reorderType[$v] = $k;
		}

		$kk = 0;
		$reorder = array();

		foreach ( $this->get_tabs() as $k => $v ) {
			$reorder[ $reorderType[$v->component] ] = $v->id;
		}

		$reordering = json_encode($reorder);

		$postdata = array(
				'reordering' => $reordering,
				'app' => 'ajax',
				'm' => "update_order",
				);

		$result = WeeverHelper::send_to_weever_server($postdata);

		if ( 'Order Updated' != $result )
		    throw new Exception( __( 'Error updating order' ) );
	}

    /**
     * Save the currently stored configuration to the server
     *
     * @throws exception on error
     */
    public function save() {

        update_option( 'weever_app_enabled', $this->_data['app_enabled'] );
        update_option( 'weever_api_key', $this->_data['site_key'] );
        update_option( 'weever_staging_mode', $this->_data['staging_mode'] );

        if ( $this->_data['site_key'] ) {
	        // Mobile settings
	        foreach ( $this->get_device_option_names() as $option ) {
	            update_option( 'weever_device_option_'.$option, $this->_data[$option] );
	        }
	        update_option( 'weever_granular_devices', $this->_data['granular'] );
	
	        // Build the devices listing
	        $devices = array();
	        if ( $this->granular ) {
	            foreach ( $this->get_granular_device_option_names() as $option ) {
	                if ( $this->$option )
	                    $devices[] = $option;
	            }
	        } else {
	            foreach ( $this->get_standard_device_option_names() as $option ) {
	                if ( $this->$option )
	                    $devices[] = $option;
	            }
	        }
	        $devices = implode( ",", $devices );
	
		    $postdata = array(
					'title' => $this->title,
		            'titlebar_title' => $this->titlebar_title,
					'devices' => $devices,
					'ecosystem' => $this->ecosystem,
					'app_enabled' => $this->app_enabled,
					'domain' => $this->domain,
		    		'loadspinner' => $this->loadspinner,
					'google_analytics' => $this->google_analytics,
					'app' => 'ajax',
					'cms' => 'wordpress',
		    		'local' => $this->local,
					'm' => "edit_config",
					);
	
			$result = WeeverHelper::send_to_weever_server($postdata);
	
			if ( "1" != $result )
			    throw new Exception( __( 'Error saving config: ', 'weever' ) . $result );
	
			if ( array_key_exists( 'site_key', $this->_changed ) ) {
				// Make sure this site key has been upgraded
				$this->upgrade_site_key();
			}
        }
        
		// Reset the changed array
		$this->_changed = array();

        // Reload the data afterwards to ensure everything was saved
        $this->reload_from_server();
    }

    /**
     * Ensure the current site key is up to date with the latest features and tabs
     */
    public function upgrade_site_key() {
    	if ( $this->_data['site_key'] ) {
	    	$postdata = array(
	    			'app' => 'ajax',
	    			'cms' => 'wordpress',
	    			'm' => "upgrade",
	    	);

	    	$result = WeeverHelper::send_to_weever_server($postdata);

	    	// Do not check return value as it varies depending on new features added
    	}
    }

    public function load_theme() {

        $stage_url = ($this->_data['staging_mode'] ? WeeverConst::LIVE_STAGE : "");

		// Theme settings
		$postdata =
			array(
				'stage' => $stage_url,
				'app' => 'json',
				'site_key' => $this->_data['site_key'],
				'm' => "theme_sync",
				'version' => WeeverConst::VERSION,
				'generator' => WeeverConst::NAME
				);

        $result = WeeverHelper::send_to_weever_server($postdata);

		// Try to decode the result
        $state = json_decode($result);

		if ( 'Site key missing or invalid.' != $state ) {
	        $this->theme->load_from_json($state->results);
	        $this->theme->load_from_json($state->results->images);
	        $this->theme->load_from_json($state->results->css);
		}
    }

	public function save_theme() {
        // Theme settings
        update_option( 'weever_tablet_load_live', $this->theme->tablet_load_live );
        update_option( 'weever_tablet_landscape_load_live', $this->theme->tablet_landscape_load_live );
        update_option( 'weever_phone_load_live', $this->theme->phone_load_live );
        update_option( 'weever_icon_live', $this->theme->icon_live );
        update_option( 'weever_titlebar_logo_live', $this->theme->titlebar_logo_live );

		$postdata = array(
			'theme' => json_encode( $this->theme ),
			'launch' => json_encode( $this->launch ),
			'app' => 'ajax',
			'titlebar_title' => $this->titlebar_title,
			'title' => $this->title,
			'm' => "edit_theme",
			'cms' => 'wordpress',
			);

        $result = WeeverHelper::send_to_weever_server($postdata);

        if ( "" != $result )
            throw new Exception( __( 'Error saving theme: ' . $result ) );
	}

    /**
     * Publish or Unpublish the given local tab ids
     *
     * @param int[] $ids
     * @param int publish flag
     */
    public function save_publish_status($ids, $publish) {

		$postdata = array(
				'published' => $publish,
				'app' =>'ajax',
				'm' => 'publish_tab',
				'site_key' => $this->site_key,
				'local_tab_id' => $ids,
				'version' => WeeverConst::VERSION,
				'generator' => WeeverConst::NAME
				);

		return WeeverHelper::send_to_weever_server($postdata);
    }
}