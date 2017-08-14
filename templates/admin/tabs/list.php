<?php
/*
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*				Modified by Brian Hogg (brian@bhconsulting.ca)
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

//$option = JRequest::getCmd('option');
//JHTML::_('behavior.tooltip');

require( trailingslashit( dirname( __FILE__ ) ) . '../parts/list_base64images.php' );

$child_html = "";
$k = 0; // for alternating shaded rows
$iii = 0; // for making checkboxes line up right
$tabsUnpublished = 0;
?>

<div id="listTabs">
	<ul id="listTabsSortable">

        <?php

        foreach ( $weeverapp->get_tabs() as $row ) {
            // Skip tabs we don't know about in this version of the plugin
            if ( ! file_exists( dirname( __FILE__ ) . "/../parts/list_add{$row->component}.php" ) )
                continue;

        	$componentRows = $row->get_subtabs();
        	$tabActive = false;

        	// Tab is active if at least one row in the tab is published
        	foreach ( $componentRows as $subrow ) {
        		if ( $subrow->published ) {
        			$tabActive = true;
        			break;
        		}
        	}

        	$componentRowsCount = count( $componentRows );

        	if ( ! $componentRowsCount || ! $tabActive )
        		echo '<li id="' . $row->component . 'TabID" class="wx-nav-tabs" rel="unpublished" style="float:right;" style="float:center;"><a href="#'. $row->component . 'Tab" class="wx-tab-sortable"><div class="'.$row->icon.' wx-grayed-out wx-nav-icon" rel="'.$weeverapp->site_key.'" style="height:32px;width:auto;min-width:32px;text-align:center" title="'.$row->component.'"><img class="wx-nav-icon-img" src="data:image/png;base64,'.$row->icon_image.'" /></div><div class="wx-nav-label wx-grayed-out" title="ID #'.$row->id.'">'.$row->name.'</div></a></li>';
        	else
        		echo '<li id="' . $row->component . 'TabID" class="wx-nav-tabs" ><a href="#'. $row->component . 'Tab" class="wx-tab-sortable"><div class="'.$row->icon.' wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" rel="'.$weeverapp->site_key.'" title="'.$row->component.'"><img class="wx-nav-icon-img" src="data:image/png;base64,'.$row->icon_image.'" /></div><div class="wx-nav-label" title="ID #'.$row->id.'">'.$row->name.'</div></a></li>';
        }

        ?>

	</ul>

    <div id="wx-overlay-drag"><div id="wx-overlay-unpublished"><?php echo __( 'This tab has no published items' ); ?></div><img id="wx-overlay-drag-img" src="<?php echo WEEVER_PLUGIN_URL; ?>static/images/icons/drag.png" /></div>

    <div id='wx-modal-loading'>
        <div id='wx-modal-loading-text'></div>
        <div id='wx-modal-secondary-text'></div>
        <div id='wx-modal-error-text'></div>
    </div>


	<input type="hidden" id="nonce" name="nonce" value="<?php echo wp_create_nonce( 'weever-list-js' ); ?>" />

    <?php

    foreach ( $weeverapp->get_tabs() as $row ) {
        // Skip tabs we don't know about in this version of the plugin
        if ( ! file_exists( dirname( __FILE__ ) . "/../parts/list_add{$row->component}.php" ) )
            continue;

    	//$componentRowsName = $row->component . 'Rows';
    	$componentRows = $row->get_subtabs();

    	if ( count( $componentRows ) ) {
    		$published = ''; //JHTML::_('grid.published', $row, $iii);
    		$checked = ''; //JHTML::_('grid.id', $iii, $row->id);

    		if ( $row->published == 0 )
    			$tabsUnpublished++;
    	} else {
    		$published = __('WEEVER_NOT_APPLICABLE', 'weever');
    		$checked = null;
    		$tabsUnpublished++;
    	}

    	?>

    	<div id="<?php echo $row->component . 'Tab' ?>">

		<div class="row-settings">
			<span class="edit"><a href="#" title="<?php echo $row->component; ?>" class="wx-nav-label-edit"><?php echo __( 'Edit Tab Name', 'weever' ); ?></a></span> | <span class="edit"><a href="#" class="wx-nav-icon-edit" title="<?php echo $row->component; ?>"><?php echo __( 'Edit Tab Icon', 'weever'); ?></a></span>
			<?php if ( 'panel' == $row->component ): ?>
				| <span class="edit"><a href="#" id="wx-select-panel-settings" class="wx-nav-settings" title="<?php echo $row->component; ?>"><?php echo __( 'Advanced Settings', 'weever' ); ?></a></span>
				<input type="hidden" id="wx-panel-headers" value="<?php echo $row->var->content_header; ?>" />
				<input type="hidden" id="wx-panel-animate" value="<?php echo $row->var->animation->type; ?>" />
				<input type="hidden" id="wx-panel-animate-duration" value="<?php echo $row->var->animation->duration; ?>" />
				<input type="hidden" id="wx-panel-timeout" value="<?php echo $row->var->animation->timeout; ?>" />
				<input type="hidden" id="wx-panel-tab-id" value="<?php echo $row->id; ?>" />
			<?php elseif ( 'aboutapp' == $row->component ): ?>
				| <span class="edit"><a href="#" id="wx-select-aboutapp-settings" class="wx-nav-settings" title="<?php echo $row->component; ?>"><?php echo __( 'Advanced Settings', 'weever' ); ?></a></span>
				<input type="hidden" id="wx-aboutapp-headers" value="<?php echo $row->var->content_header; ?>" />
				<input type="hidden" id="wx-aboutapp-animate" value="<?php echo $row->var->animation->type; ?>" />
				<input type="hidden" id="wx-aboutapp-animate-duration" value="<?php echo $row->var->animation->duration; ?>" />
				<input type="hidden" id="wx-aboutapp-timeout" value="<?php echo $row->var->animation->timeout; ?>" />
				<input type="hidden" id="wx-aboutapp-tab-id" value="<?php echo $row->id; ?>" />
			<?php elseif ( 'map' == $row->component ): ?>
				| <span class="edit"><a href="#" id="wx-select-map-settings" class="wx-nav-settings" title="<?php echo $row->component; ?>"><?php echo __( 'Settings', 'weever' ); ?></a></span>
	
				<input type="hidden" id="wx-map-start-latitude" value="<?php echo $row->var->start->latitude; ?>" />
				<input type="hidden" id="wx-map-start-longitude" value="<?php echo $row->var->start->longitude; ?>" />
				<input type="hidden" id="wx-map-start-zoom" value="<?php echo $row->var->start->zoom; ?>" />
				<input type="hidden" id="wx-map-marker" value="<?php echo $row->var->marker; ?>" />
				<input type="hidden" id="wx-map-tab-id" value="<?php echo $row->id; ?>" />
				
			<?php endif; ?>
		</div>

    	<?php require( dirname( __FILE__) . "/../parts/list_add{$row->component}.php" ); ?>

    	<input type="hidden" name="boxchecked<?php echo $row->component; ?>" id="boxchecked<?php echo $row->component; ?>" value="0" />
    	<table class='adminlist'>
        	<thead>
            	<tr>
                	<th width='20'>
                		<input type='checkbox' name='toggle<?php echo $row->component; ?>' id='toggle<?php echo $row->component; ?>' value='' onclick='checkAllTab(<?php echo count($componentRows); ?>, "cb", document.getElementById("boxchecked<?php echo $row->component; ?>"), document.getElementById("toggle<?php echo $row->component; ?>"), <?php echo $iii; ?> + 1);' />
                	</th>

                	<th class='title'><?php echo __( 'NAME', 'weever' ); ?> &nbsp;(<a style="color:#1C94C4;" href="http://weeverapps.com/mobile-app-layout" target="_blank">?</a>)</th>
                	<th width='10%' nowrap='nowrap'><?php echo __( 'STATUS' ); ?></th>
                	<th width='8%' nowrap='nowrap'><?php echo __( 'ORDER' ); ?></th>
            	</tr>
        	</thead>

        	<?php

        	$k = 1 - $k;
        	$sub = 0;

        	foreach ( $componentRows as $row ) : $iii++; $sub++;
        	?>
        		<tr class='wx-ui-row <?php echo "row$k"; ?>'>
            		<td>
            			<input type="checkbox" id="cb<?php echo $iii; ?>" name="cid[]" value="<?php echo $row->id; ?>" title="Checkbox for row <?php echo $row->id; ?>">
            			<?php //echo JHTML::_('grid.id', $iii, $row->id); ?>
            		</td>
            		<td>
            			<span class="wx-subtab-link-text"><?php echo $row->name; ?></span>
            			<div class="row-actions">
            				<span class="edit"><a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-link">Edit Name</a></span> | 
            				<span class="toggle_publish"><a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-publish" rel="<?php echo ( $row->published ? 1 : 0 ); ?>"><?php echo __( 'Toggle Published', 'weever' ); ?></a></span> | 
            				<span class="delete"><a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-delete" rel="<?php echo $row->type; ?>" alt="<?php echo __( 'Delete', 'weever' ); ?> &quot;<?php echo htmlentities($row->name); ?>&quot;"><?php echo __( 'Delete', 'weever' ); ?></a></span>
            			</div>
            		</td>
            		<td align='center'>
            			<span class="wx-subtab-publish-text"><?php echo ( $row->published ? __( 'Published', 'weever' ) : __( 'Unpublished', 'weever' ) ); ?></span>
            		</td>
            		<td align="center">
            			<a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-down" rel="<?php echo $row->type; ?>"><img src="<?php echo WEEVER_PLUGIN_URL; ?>static/images/icons/downarrow.png" width="16" height="16" border="0" title="Move Down"></a>
            			<a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-up" rel="<?php echo $row->type; ?>"><img src="<?php echo WEEVER_PLUGIN_URL; ?>static/images/icons/uparrow.png" width="16" height="16" border="0" title="Move Up"></a>
            		</td>
        		</tr>

        	<?php
        	$k = 1 - $k; endforeach;
            ?>


        	<?php if ( ! count( $componentRows ) ): ?>
        		<tr><td colspan='6'><?php echo __( 'There are no items in this tab.', 'weever' ); ?></td></tr>
        	<?php else: ?>
        		<tr>
        			<td colspan='6'>
        				<div class="wx-list-actions">
            				<img src="<?php echo WEEVER_PLUGIN_URL; ?>static/images/icons/arrow_leftup.png" />
            				<?php echo __( 'With selected:', 'weever' ); ?> &nbsp;
            				<a href="#" id="wx-publish-selected" title="Publish"><?php echo __( 'Publish', 'weever' ); ?></a> |
            				<a href="#" id="wx-unpublish-selected" title="Unpublish"><?php echo __( 'Unpublish', 'weever' ); ?></a> |
            				<a href="#" id="wx-delete-selected" title="Delete"><?php echo __( 'Delete', 'weever' ); ?></a>
            			</div>
        			</td>
        		</tr>
			<?php endif; ?>
    	</table>
    	</div>

    	<?php

    }

    ?>

        <input type="hidden" name="option" value="<?php //echo $option; ?>" />
        <input type="hidden" name="site_key" id="wx-site-key" value="<?php echo $weeverapp->site_key; ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="view" value="list" />
        <input type="hidden" name="filter_order" value="<?php //echo $weeverapp->lists['order']; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php //echo $weeverapp->lists['order_Dir']; ?>" />

        <?php if ( get_option( 'weever-quick-tour', 1 ) || ( isset( $_GET['quick-start-tour'] ) && $_GET['quick-start-tour'] == 1 ) ): ?>
        <?php update_option( 'weever-quick-tour', 0 ); // Ensure only shown once! ?>
        <!-- Feature tour -->
        <ol id="wx-feature-tour-content">
  			<li data-id="appmanager-header" data-options="tipLocation:bottom" data-text="Next"><p>Welcome to Weever Apps!</p><p>Weever Apps lets you create great mobile apps using your Wordpress site!  This feature tour will show you the basics, and will only take a minute...</p></li>
  			<li data-id="blogTabID" data-options="tipLocation:bottom" data-text="Great!"><p>You can add many kinds of content to your app, such as your Twitter feed, YouTube videos, and content from your Wordpress site.</p><p>To add content, click on a tab, select the content you want to add using the dropdowns, then click Submit to add it to your app.</p></li>
  			<li data-id="wx-scan-test-code-image" data-options="tipLocation:top" data-text="Cool!"><p>You can preview the content by scanning this QR code using your touch-based smartphone, or clicking the link to preview the app (<b>Chrome</b> and <b>Safari</b> browsers only)</p></li>

  			
  			<li data-id="wx-status-onoffline-link" data-options="tipLocation:bottom" data-text="Great!"><p>When you're happy with your app, click here to turn your app online so mobile visitors to your website will see your app automatically.</p></li>
  			<li data-id="wx-logo-images-theme-tab" data-options="tipLocation:bottom" data-text="Great!"><p>You can customize all the graphics in your app by uploading them in the <b>Logo, Images and Theme</b> tab.</p><p>Rather us help with the graphics and design?  View details on our <a target="_blank" href="http://weeverapps.com/custom-graphics/">custom graphics package</a>.</p></li>
  			<li data-id="wx-mobile-publishing-tab" data-options="tipLocation:bottom" data-text="Great!"><p>When your app is online, you app will launch <b>instantly</b> for mobile visitors to your site.  You can choose which kinds of smart phones and/or tablets to launch your app for here, along with the language of your app.</p></li>
  			<li data-id="wx-support-link" data-options="tipLocation:bottom" data-text="Will do!"><p>If you have any questions or run into trouble, you can visit our community forms.  <a target="_blank" href="https://weeverapps.com/upgrade/?site_url=<?php echo urlencode( $weeverapp->primary_domain); ?>&subscription_type=weever-apps-pro">Weever Apps Pro</a> subscribers are able to get priority support by submitting a ticket to the Weever Apps team.</p></li>
  			<li data-id="wx-quick-start-guide" data-options="tipLocation:bottom" data-text="Finish"><p>You can view this tour again at anytime by clicking here.</p><p>Have fun creating your mobile app!</p></li>
  		</ol>
        <!-- End feature tour -->
        
        <script type="text/javascript">
  		jQuery(window).load(function() {
    		jQuery(this).joyride({
    			'tipContent': '#wx-feature-tour-content', // The ID of the <ol> used for content
    			'tipAnimation': 'fade'
      			/* Options will go here */
    		});
  		});
  		<?php endif; ?>
</script>
        
</div>

