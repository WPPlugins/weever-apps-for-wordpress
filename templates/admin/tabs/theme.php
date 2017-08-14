<div class="wx-add-ui">
    <form action="" enctype="multipart/form-data" method="post" id="themeAdminForm">




        <?php wp_nonce_field( 'weever_settings', 'weever_settings_nonce' ); ?>

        <div id="tabs">
        	<ul id="listTabsSortable">
        		<li><a href="#tabs-1"><?php _e( 'Basic Settings', 'weever' ); ?></a></li>
        		<li><a href="#tabs-2"><?php _e( 'App Colours', 'weever' ); ?></a></li>
        		<li><a href="#tabs-3"><?php _e( 'Advanced Theme Settings', 'weever' ); ?></a></li>
        	</ul>


<div id="wx-submitcontainer">
        <input id="wx-button-submit" name="submit" type="submit" value="<?php _e( 'Save Changes', 'weever' ); ?>" />
             <p class="wx-theme-submithelp">Click here to save your changes and update your app!</p>&nbsp;
</div>

        	<div id="tabs-1">

            	<div>
                	<fieldset class='adminForm'>
                	<legend><?php echo __( 'Basic Settings', 'weever' ); ?></legend>
                	
					<input type="hidden" name="template" value="sencha" />
                	<table class="admintable">
                    	<!-- <tr>
                        	<td class="key hasTip" title="<?php echo __( 'Changes the design layout of your app. More themes coming soon!', 'weever' ); ?>"><?php echo __( 'Choose a Template', 'weever' ); ?></td>
                        	<td>
                            	<select name="template" class="wx-220-select required">
                            	<option value="sencha" <?php echo ($weeverapp->theme->template == 'sencha' ? "selected='selected'":""); ?>><?php echo __( 'Weever Apps Light&trade;', 'weever' ); ?></option>
                            	</select>
                        	</td>
                    	</tr> -->
                    	<tr>
                        	<td class="key hasTip" title="<?php echo __( 'Selects the method in which the titlebar is generated from.', 'weever' ); ?>"><?php echo __( 'Logo Type', 'weever' ); ?></td>
                        	<td>
                            	<select name="titlebarSource" class="wx-220-select required">
                                	<option value="text" <?php echo ($weeverapp->theme->titlebarSource == 'text' ? "selected='selected'":""); ?>><?php echo __( 'Use Website Name as a Text Title:', 'weever' ); ?> ("<?php echo strip_tags($weeverapp->titlebar_title); ?>")</option>
                                	<option value="image" <?php echo ($weeverapp->theme->titlebarSource == 'image' ? "selected='selected'":""); ?>><?php echo __( 'Use Logo Image (upload below)', 'weever' ); ?></option>
                                	<option value="html" <?php echo ($weeverapp->theme->titlebarSource == 'html' ? "selected='selected'":""); ?>><?php echo __( 'Use Custom HTML (in advanced theme settings)', 'weever' ); ?></option>
                            	</select>
                        	</td>
                    	</tr>
                    	<tr>
                        	<td class="key hasTip" title="<?php echo __( 'This name is used across the top of your app if you choose a text-based titlebar. Also, if you enabled <b>Weever Ecosystem</b>, this name will be used for your listing.', 'weever' ); ?>"><?php echo __( 'Website Name' ); ?></td>
                        	<td><input type="text" name="titlebar_title" maxlength="35" style="width:250px;" value="<?php echo htmlentities($weeverapp->titlebar_title, ENT_QUOTES, "UTF-8"); ?>" class="required" /></td>
                    	</tr>
                    	<tr>
                        	<td class="key hasTip" title="<?php echo __( "This name is used for visitors who <b>install</b> your app to their homescreen, and appears underneath the app's icon.", 'weever' ); ?>"><?php echo __( 'App Installation Name' ); ?></td>
                        	<td><input type="text" name="title" maxlength="10" style="width:90px;" value="<?php echo htmlentities($weeverapp->title, ENT_QUOTES, "UTF-8"); ?>" class="required" /></td>
                    	</tr>
				
						<tr><td class="key hasTip"><?php echo __( 'Attempt to Show Prompt to Install App', 'weever' ); ?></td>
							<td>
								<select name="install_prompt">
									<option value="0"><?php echo __( 'NO', 'weever' ); ?></option>
									<option value="1" <?php echo ($weeverapp->launch->install_prompt ? "selected='selected'":""); ?>><?php echo __( 'YES', 'weever' ); ?></option>
								</select>
								
								<p style="width: 500px;">If enabled, users will be prompted to install the app to their home screen, if the device supports it and if they are not already using the installed version.</p>
							</td>
						</tr>

                	</table>
                	
                	<p class="wx-theme-submithelp">NOTE: You can further customize the look of your content by copying templates/weever-content-single.php from the Weever Apps plugin directory into your current theme directory, or copy to weever-content-single-{posttype}.php to customize only certain post types.</p>
                	
                	</fieldset>                	
                </div>

            	<div>
            		<fieldset>
                		<legend><?php echo __( 'Launch Screens, App Install Icon and Logo', 'weever' ); ?></legend>
                		<br />
                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'Tablet Portrait<br />(1536 x 2008 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="tablet_load_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->tablet_load_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 920}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->tablet_load_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>


                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'Tablet Landscape<br />(1496 x 2048 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="tablet_landscape_load_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->tablet_landscape_load_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 920}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->tablet_landscape_load_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>

                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'Phone Launch Screen<br />(640 x 920 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="phone_load_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->phone_load_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 640}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->phone_load_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>

                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'App Installation Icon<br/>(144 x 144 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="icon_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->icon_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 144, y: 144}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->icon_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>

                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'App Logo Image<br/>(600 x 64 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="titlebar_logo_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->titlebar_logo_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 600, y: 64}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->titlebar_logo_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>

            		</fieldset>
        		</div>



        	</div>
        	
        	
        	<div id="tabs-2">
        	
				<div>
                	<fieldset>
                		<legend><?php echo __( 'Logo Area Colours', 'weever' ); ?></legend>
                	
                	<table class="admintable">
						<tr>
							<th><?php echo __( 'Logo Area Background Colour', 'weever' ); ?></th>
							<th><?php echo __( 'Logo Area Text Colour<br />(If no logo used)', 'weever' ); ?></th>
						</tr>
						<tr>
							<td>
								<input type="text" id="main_titlebar_color" name="main_titlebar_color" value="<?php echo get_option( 'weever_main_titlebar_color', '#ffffff'); ?>" />
								<div id="main_titlebar_colorpicker"></div>
							</td>
							<td>
								<input type="text" id="main_titlebar_text_color" name="main_titlebar_text_color" value="<?php echo get_option( 'weever_main_titlebar_text_color', '#000000'); ?>" />
								<div id="main_titlebar_text_colorpicker"></div>
							</td>
						</tr>                	
                	</table>
                	
                	</fieldset>
                </div>
                        	
        	
                <div>
                	<fieldset>
                		<legend><?php echo __( 'Inactive Button Colours', 'weever' ); ?></legend>
                	
                	<table class="admintable">
						<tr>
							<th><?php echo __( 'Inactive Button Background Colour', 'weever' ); ?></th>
							<th><?php echo __( 'Inactive Button Text Colour', 'weever' ); ?></th>
						</tr>
						<tr>
							<td>
								<input type="text" id="inactive_button_color" name="inactive_button_color" value="<?php echo get_option( 'weever_inactive_button_color', '#808080'); ?>" />
								<div id="inactive_button_colorpicker"></div>
							</td>
							<td>
								<input type="text" id="inactive_button_text_color" name="inactive_button_text_color" value="<?php echo get_option( 'weever_inactive_button_text_color', '#ffffff'); ?>" />
								<div id="inactive_button_text_colorpicker"></div>
							</td>
						</tr>                	
                	</table>
                	
                	</fieldset>
                </div>
                

                <div>
                	<fieldset>
                		<legend><?php echo __( 'Active Button Colours', 'weever' ); ?></legend>
                	
                	<table class="admintable">
						<tr>
							<th><?php echo __( 'Active Button Background Colour', 'weever' ); ?></th>
							<th><?php echo __( 'Active Button Text Colour', 'weever' ); ?></th>
						</tr>
						<tr>
							<td>
								<input type="text" id="active_button_color" name="active_button_color" value="<?php echo get_option( 'weever_active_button_color', '#808080'); ?>" />
								<div id="active_button_colorpicker"></div>
							</td>
							<td>
								<input type="text" id="active_button_text_color" name="active_button_text_color" value="<?php echo get_option( 'weever_active_button_text_color', '#ffffff'); ?>" />
								<div id="active_button_text_colorpicker"></div>
							</td>
						</tr>                	
                	</table>
                	
                	</fieldset>
                </div>
                

                <div>
                	<fieldset>
                		<legend><?php echo __( 'Sub Tab Bar Colours', 'weever' ); ?></legend>
                	
                	<table class="admintable">
						<tr>
							<th><?php echo __( 'Sub Tab Background Colour', 'weever' ); ?></th>
							<th><?php echo __( 'Sub Tab Text Colour', 'weever' ); ?></th>
						</tr>
						<tr>
							<td>
								<input type="text" id="subtab_color" name="subtab_color" value="<?php echo get_option( 'weever_subtab_color', '#bfbfbf'); ?>" />
								<div id="subtab_colorpicker"></div>
							</td>
							<td>
								<input type="text" id="subtab_text_color" name="subtab_text_color" value="<?php echo get_option( 'weever_subtab_text_color', '#ffffff'); ?>" />
								<div id="subtab_text_colorpicker"></div>
							</td>
						</tr>                	
                	</table>
                	
                	</fieldset>
                </div>
                
                
        	</div>
        	
        	
        	<div id="tabs-3">
				<div>
            		<fieldset>
                		<legend><?php echo __( 'CSS Template Overrides' ); ?></legend>


						<?php $weever_server = $weeverapp->staging_mode ? WeeverConst::LIVE_STAGE : WeeverConst::LIVE_SERVER; ?>
						<?php $private_url = $weever_server . 'app/' . $weeverapp->primary_domain; ?>
                		<p><?php echo sprintf( __( 'Enter your valid CSS in the text box below.  You can determine the CSS to override by loading your app url (<a href="%s" target="_new">%s</a>) within a Webkit browser (such as Google Chrome) and inspecting the HTML elements.', 'weever' ), $private_url, $private_url ); ?></p>

                		<table class="admintable">
                    		<tr>
                        		<td class="key"><?php echo __( 'CSS Overrides', 'weever' ); ?></td>
                        		<td>
                        		<textarea name="css" rows="8" cols="80"><?php echo $weeverapp->theme->css; ?></textarea>
                        		</td>
                    		</tr>
                		</table>
            		</fieldset>

                	<fieldset>
                    	<legend><?php echo __( 'Title Bar Custom HTML', 'weever' ); ?></legend>

                    	<?php echo __( 'For Advanced Users only. Custom HTML override for Title Bar (logo) area.' ); ?><br /><?php echo __( 'Warning: Use of Javascript in this area may disable the web app.' ); ?>
                    	<table class="admintable">
                        	<tr>
                            	<td class="key"><?php echo __( 'Custom HTML', 'weever' ); ?></td>
                            	<td><textarea name="titlebarHtml" rows="7" cols="50"><? echo htmlspecialchars( $weeverapp->theme->titlebarHtml ); ?></textarea></td>
                        	</tr>
                    	</table>
            		</fieldset>
            	</div>

        	</div>
        </div>

    </form>
</div>
