<div>
	<fieldset class='support'>
		<legend>Weever Apps Support</legend>
		
		
        <div style="margin:0 1em 1em 1.25em;">


		<!-- Code for ZenDesk Support -->
		
		<script type="text/javascript" src="//asset0.zendesk.com/external/zenbox/v2.4/zenbox.js"></script>
		<style type="text/css" media="screen, projection">
		 @import url(//asset0.zendesk.com/external/zenbox/v2.4/zenbox.css);
		</style>
		<script type="text/javascript">
		 if (typeof(Zenbox) !== "undefined") {
		   Zenbox.init({
		     dropboxID:   "20033981",
		     url:         "https://weeverapps.zendesk.com",
		     tabID:       "support",
		     tabColor:    "#222222",
		     tabPosition: "Right",
		     hide_tab:		true
		   });
		 }
		</script>
		
        
        
        <h2><a href="#" onClick="script: Zenbox.show(); return false;">Get Support</a></h2>
        
        
		<p>If you are new to Weever Apps — <a href="http://support.weeverapps.com/" title="Weever Apps Support" target="_blank">http://support.weeverapps.com</a> is <em>the</em> place to start. Ask questions, find answers and request new features!</p>

		<h3>Want to create another app or upgrade this one?</h3>
		
		<p><a href="http://weeverapps.com/pricing">View plans and pricing</a></p>


</div>
        
        
	</fieldset>
    
    <fieldset class='support'>
		<legend>Developers / Designers</legend>
		    
        <div style="margin:0 1em 1em 1.25em;">
		
		<h3>CSS and Content Design</h3>
			<?php
        	$weever_server = $weeverapp->staging_mode ? WeeverConst::LIVE_STAGE : WeeverConst::LIVE_SERVER;
        	?>
		<p>You can customize the CSS by either using the CSS box under the Advanced tab of Logo, Images and Theme or creating a file called <strong>weever.css</strong> in your current theme.  View <a target="_blank" href="http://support.weeverapps.com/entries/20739193-adding-a-background-color-to-the-logo-area">this example</a> which shows how quickly you can start to customize every aspect of your app's design.  You can <a target="_blank" href="http://support.weeverapps.com/entries/20733892-how-to-style-the-app-to-match-your-brand-logo-site">inspect the HTML elements</a> by opening <a target="_blank" href="<?php echo $weever_server; ?>app/<?php echo $weeverapp->primary_domain; ?>">your app</a> in a Webkit browser such as Google Chrome or Safari, or in the iOS Simulator (Mac OSX only).</p>
		
		<p>You can further customize the look of your content by copying <strong>templates/weever-content-single.php</strong> from the Weever Apps plugin directory into your current theme directory, or copy to <strong>weever-content-single-{posttype}.php</strong> to customize the content of only certain post types easily.</p>
		
		<h3>API Specifications</h3>
		<p><a target="_blank" href="http://developers.weeverapps.com/">View details on our API</a></p>
		<p><a target="_blank" href="http://developers.weeverapps.com/R3S_Specifications">R3S Object Specifications</a> <br />
		
		Really Simple Semantic Syndication (R3S) is a specification designed by Weever Apps for generating relevant data from any kind of web object. This could include a blog, a web page, a category of content in a CMS, geo-tagged content, and so on.
		You can use this specification to create an R3S Object for transfering content from a non-Wordpress site into your app, or to create an API for another CMS.
		</p>
		</div>
    </fieldset>
</div>