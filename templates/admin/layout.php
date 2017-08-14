<div class="wrap">

<?php $errors = get_settings_errors(); ?>

	<?php if (is_array($errors)): ?>
    	<?php foreach($errors as $error): ?>
		<div id="message" class="<?php echo $error['type']; ?>"><p><strong><?php echo __($error['message'], 'weever'); ?></strong></p></div>
    	<?php endforeach; ?>
    <?php endif; ?>
    
    
    
    



<div class="weever-pricing-bar" style="margin: 0; border: 1px solid #dfdfdf; border-bottom:0; background:none repeat scroll 0 0 #fdfdf4; padding:.5em 1.75em .5em 1.5em; text-align:right; font-size:0.85em; text-transform:uppercase;">
			<a href="<?php echo admin_url( "admin.php?page=weever-list&quick-start-tour=1" ); ?>" id="wx-quick-start-guide">Quick Tour</a> &nbsp; | &nbsp; <a href="#" id="weever-preview-mobile">Preview App</a> &nbsp; | &nbsp; <a href="http://weeverapps.com/pricing">Plans & Pricing</a> &nbsp; | &nbsp; <a href="http://twitter.com/weeverapps">Follow us on Twitter</a> &nbsp;


    <?php
    $onlineSpan = "";
    $offlineSpan = "";

    if ($weeverapp->app_enabled) {
    	$offlineSpan = 'class="wx-app-hide-status"';
    	$offlineStatusClass = "";
    } else {
    	$onlineSpan = 'class="wx-app-hide-status"';
    	$offlineStatusClass = "class=\"wx-app-status-button-offline\"";
    }
    ?>

<span id="wx-app-status-button" <?php echo $offlineStatusClass; ?>>
    
  <span id="wx-app-status-online" <?php echo $onlineSpan; ?>>
	<span id="wx-status-current"><?php echo __( 'Status &mdash; App is', 'weever' ); ?></span>
    <span id="wx-status-boldonline"><strong><?php echo __( 'online', 'weever' ); ?></strong></span>
    <span id="wx-status-current"><?php echo __( 'for mobile visitors &mdash;', 'weever' ); ?></span>
	<span id="wx-status-onoffline-link"><a href="<?php echo admin_url( "admin.php?page=$page&weever-app-enabled=0" ); ?>"><?php echo __( 'Take App Offline', 'weever' ); ?></a></span>
  </span>
    
  <span id="wx-app-status-offline" <?php echo $offlineSpan; ?>>
    <span id="wx-status-current"><?php echo __( 'Status &mdash; App is', 'weever' ); ?></span>
    <span id="wx-status-boldoffline"><strong><?php echo __( 'offline', 'weever' ); ?></strong></span>
    <span id="wx-status-current"><?php echo __( 'for mobile visitors &mdash;', 'weever' ); ?></span>
	<span id="wx-status-onoffline-link"><a href="<?php echo admin_url( "admin.php?page=$page&weever-app-enabled=1" ); ?>"><?php echo __( 'Turn App Online', 'weever' ); ?></a></span>
  </span>

</span>
</div>



    <div id="appmanager-header"><img src="<?php echo WEEVER_PLUGIN_URL; ?>static/images/icons/icon-48-weever_toolbar_title<?php echo $weeverapp->staging_mode ? '_staging' : ''; ?>.png" title="<?php _e('Weever Apps Configuration', 'weever'); ?>" />

<?php if ( $weeverapp->site_key ): ?>
	<?php if ( $weeverapp->tier == 3 ): ?>
		<span style="float: right; font-size: 10px;">&middot; Rebrand & Resell<br>&middot; Custom Domains</span>
		<span style="float:right; line-height: 1.25em; font-size: 1em; text-align: right; margin:1px 1.5em 0 0;">Weever Apps Pro - White Label<br><a target="_blank" href="http://weeverapps.com/pricing" id="headerbutton">Learn more</a></span>
	<?php elseif ( $weeverapp->tier == 2.1 or $weeverapp->tier == 1 ): ?>
		<span style="float:right; line-height: 1.25em; font-size:1.5em; text-align: right; margin:1px .5em 0 0;"><a id="headerbutton" style="margin:0 1em 0; float:left;" target="_blank" href="http://weeverapps.com/pricing">Go Pro</a>Enjoying Your Free App?<br><span style="font-size:.5em; float:left;">Marketing Features & More</span></span>
	<?php endif; ?>
<?php endif; ?>


</div>


	<div id="toptabs" class="ui-tabs ui-widget ui-widget-content">
		<ul class="tabline ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header">
			<li class="ui-state-default<?php echo $page == 'weever-list' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-list' ); ?>" id="wx-app-features-navigation"><?php _e('App Features + Navigation', 'weever'); ?></a></li>
			<li class="ui-state-default<?php echo $page == 'weever-theme' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-theme' ); ?>" id="wx-logo-images-theme-tab"><?php _e('Logo, Images and Theme', 'weever'); ?></a></li>
			<li class="ui-state-default<?php echo $page == 'weever-config' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-config' ); ?>" id="wx-mobile-publishing-tab"><?php _e('Mobile Publishing + Pro Features', 'weever'); ?></a></li>
			<li class="ui-state-default<?php echo $page == 'weever-account' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-account' ); ?>"><?php _e('Subscription Key + Sandbox Mode', 'weever'); ?></a></li>
			<li class="ui-state-default<?php echo $page == 'weever-support' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a id="wx-support-link" href="<?php echo admin_url( 'admin.php?page=weever-support' ); ?>"><?php _e('Support', 'weever'); ?></a></li>
		</ul>






		<div class="ui-tabs-panel ui-widget-content">
		<?php require( $content ); ?>
		</div>
	</div>

	<?php if ( $weeverapp->site_key ): ?>
	<div>
    
    
    <fieldset id="wx-scan-test-code" class='adminForm'>
                	<legend><?php echo __('<strong>Scan This Code</strong> to Test Your App'); ?></legend>

     	<?php
        	$weever_server = $weeverapp->staging_mode ? WeeverConst::LIVE_STAGE : WeeverConst::LIVE_SERVER;
        	?>
            <img id="wx-scan-test-code-image" src="<?php echo $weeverapp->qr_code_private; ?>"  class="wx-qr-imgprev" />

            <p><?php echo __( 'Scan this private QR code to directly preview your Weever App.  You can scan it each time you make a change to see how your app looks.' ); ?><br />

    		<p><?php echo __( 'You can also test using <strong>Google Chrome</strong>, <strong>Safari</strong> or the <strong>Apple iOS Simulator</strong> using this link: ' ); ?></p>
    		<a target="_blank" href="<?php echo $weever_server; ?>app/<?php echo $weeverapp->primary_domain; ?>"><?php echo $weever_server; ?>app/<?php echo $weeverapp->primary_domain; ?></a></p>
    		</fieldset>
    
    
    
    <fieldset class='adminForm'>
        			<legend style="background:#ECF4E6;"><?php echo __( 'Public QR Code for Marketing Use', 'weever' ); ?></legend>

            		<?php if ( ! $weeverapp->staging_mode ): ?>
 

    		<img src="<?php echo $weeverapp->qr_code_public; ?>"  class="wx-qr-imgprev" />


				<?php $weever_qr_link = (strpos($weeverapp->primary_domain, 'http://') === false ? 'http://' . $weeverapp->primary_domain : $weeverapp->primary_domain); ?>
                
                <p><?php echo __( 'Share this public QR code to promote your Weever app!' ); ?></p>
                
    			<p><?php echo __( 'Suggested: Business cards, flyers and more!  Be creative!' ); ?></p>
    			
                <?php echo __( 'QR Link:' ); ?> <a target="_blank" href="<?php echo $weever_qr_link; ?>">
				<?php echo $weever_qr_link; ?></a></p>
    			

    
    	<?php else: ?>
    	
    		<p style="margin:1em 0 1em 1.75em;"><?php echo __( 'You are currently in <strong>sandbox mode</strong>. Public QR Codes are not available for sandbox mode apps.' ); ?></p>
    
    	<?php endif; ?>


    	<div style="clear:both;"></div>

   </fieldset>
    
   </div>
    	
	<?php endif; ?>



	<?php include( dirname( __FILE__ ) . '/preview-app.php' ); // Preview App iFrame ?>
	
	<div id="weever-plugin-footer" style="text-align:center;clear:both; margin-top:24px;">
		<?php echo WeeverConst::NAME; ?> v<?php echo WeeverConst::VERSION; ?> <?php echo WeeverConst::RELEASE_TYPE; ?>
		<?php echo WeeverConst::COPYRIGHT_YEAR; ?> <a target="_blank" href="<?php echo WeeverConst::COPYRIGHT_URL; ?>"><?php echo WeeverConst::COPYRIGHT; ?></a><br />
		Released <?php echo WeeverConst::RELEASE_DATE; ?> under <a target="_blank" href="<?php echo WeeverConst::LICENSE_URL; ?>"><?php echo WeeverConst::LICENSE; ?></a>.
		<a target="_blank" href="http://support.weeverapps.com/">Contact Support</a>
	</div>
</div>

