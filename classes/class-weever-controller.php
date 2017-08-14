<?php

/*
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9.2
*   License: 	GPL v3.0
*
*   This extension is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This extension is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details <http://www.gnu.org/licenses/>.
*
*/

class WeeverController {

	public static function ajaxSaveTabName() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['id'] );

                if ( $tab !== false ) {
                    try {
                        $tab->name = $_POST['name'];
                        $tab->save();
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            }
        } else {
            status_header(401);
        }

        die();
    }

    
	public static function ajaxUpdateTabSettings() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['id'] );
				$type = $_POST['type'];
				
				switch ( $_POST['type'] ) {
					case "map":
						$submitted_vars = explode( ',', $_POST['var'] );
						
						$tab->var->start->latitude = $submitted_vars[0];
						$tab->var->start->longitude = $submitted_vars[1];
						$tab->var->start->zoom = $submitted_vars[2];
						$tab->var->marker = $submitted_vars[3];
						
						// TODO: Figure out how to detect changes to the object itself if possible
						$tab->var = $tab->var;
						
						$tab->save();
						break;
						
					case "panel": 
					case "aboutapp":
						$submitted_vars = explode( ',' , $_POST['var'] );
						
						$tab->var->animation->type = $submitted_vars[0];
						$tab->var->animation->duration = $submitted_vars[1];
						$tab->var->animation->timeout = $submitted_vars[2];
						$tab->var->content_header = $submitted_vars[3];
						
						// TODO: Figure out how to detect changes to the object itself if possible
						$tab->var = $tab->var;
						
						$tab->save();
						break;
				}
            }
		} else {
            status_header(401);
        }

        die();
	}
    
    
	public static function ajaxSubtabDelete() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( intval( $_POST['id'] ) );
                if ( $tab !== false ) {
                    try {
                        // Delete this tab
                        $tab->delete();
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
		}

		die();
	}

	public function ajaxPublishSelected() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                try {
                    $weeverapp->publish_tabs( explode( ",", $_POST['ids'] ) );
                } catch ( Exception $e ) {
                    status_header(500);
                    echo $e->getMessage();
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
    }

	public function ajaxUnpublishSelected() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                try {
                    $weeverapp->unpublish_tabs( explode( ",", $_POST['ids'] ) );
                } catch ( Exception $e ) {
                    status_header(500);
                    echo $e->getMessage();
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
    }

	public function ajaxDeleteSelected() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                try {
                    $weeverapp->delete_tabs( explode( ",", $_POST['ids'] ) );
                } catch ( Exception $e ) {
                    status_header(500);
                    echo $e->getMessage();
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
	}

	public function ajaxTabPublish() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( intval( $_POST['id'] ) );
                if ( $tab !== false ) {
                    try {
                        // Toggle the publish flag based on the status given
                        $tab->published = $_POST['status'] ? 0 : 1;
                        $tab->save();
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
		} else {
            status_header(401);
        }

        die();
    }

	public function ajaxSaveTabIcon() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['type'] );

                if ( $tab !== false ) {
                    try {
                        $tab->icon_image = $_POST['icon'];
                        $tab->save();
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    echo __( 'Invalid tab id' );
                    status_header(500);
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
    }

	public function ajaxSaveTabOrder() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $order = explode( ",", $_POST['order'] );
                foreach ( $order as $k => $o ) {
                    $order[$k] = str_ireplace( 'tabid', '', $o );
                }
                $weeverapp->order_tabs( $order );
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
	}


	public function ajaxSaveSubtabOrder() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['type'] );

                if ( $tab !== false ) {
                    try {
                		$tab->move_subtab( $_POST['id'], ( $_POST['dir'] == WeeverAppTab::MOVE_DOWN ? WeeverAppTab::MOVE_DOWN : WeeverAppTab::MOVE_UP ) );
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            }
        } else {
            status_header(401);
        }

        die();
	}

	public function ajaxToggleAppStatus() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                try {
                    if ( isset( $_POST['app_enabled'] ) ) {
                        // Use the given value
                        $weeverapp->app_enabled = ( $_POST['app_enabled'] ? 1 : 0 );                        
                    } else {
                        // Toggle
                        $weeverapp->app_enabled = ( $weeverapp->app_enabled ? 0 : 1 );
                    }
                    $weeverapp->save();
                } catch ( Exception $e ) {
                    status_header(500);
                    echo $e->getMessage();
                }
            }
        } else {
            status_header(401);
            echo __( 'Authentication error' );
        }

        die();
	}

	public function ajaxSaveNewTab() {
		weever_remove_wp_magic_quotes();
		
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['type'] );

                if ( $tab !== false ) {
                    try {
                    	// If it's a page tab, look for an image (if any) to add as an icon
                    	if ( 'page' == $_POST['component'] ) {
                    		$page_id = str_replace( 'index.php?page_id=', '', $_POST['cms_feed'] );
                    		
                    		if ( is_numeric( $page_id ) ) {
                    			$page = get_page( $page_id );
                    			
                    			if ( ! empty( $page ) ) {
			                    	if ( has_post_thumbnail( $page_id ) ) {
			                    		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ) );
			                    	
			                    		if ( is_array( $image ) and isset( $image[0] ) )
			                    			$image = $image[0];
			                    	}
			                    	
			                    	if ( empty( $image ) ) {
			                    		$html = WeeverSimpleHTMLDomHelper::str_get_html( $page->post_content );
			                    	
			                    		foreach ( @$html->find('img') as $vv )
			                    		{
			                    			if ( $vv->src )
			                    			{
			                    				$image = WeeverHelper::make_absolute($vv->src, get_site_url());
			                    				break;
			                    			}
			                    		}
			                    	}
			                    	
			                    	if ( empty( $image ) )
			                    		$image = "";
	                    	
									$_POST['var'] = $image;
                    			}
                    		}
                    	}
                    	
                        // Create a new subtab with the given params
                        $tab->create_subtab( $_POST );
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            }
        } else {
            status_header(401);
            echo __( 'Authentication error' );
        }

        die();
	}
}
