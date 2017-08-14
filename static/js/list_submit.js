/*	
*	Weever Apps Administrator Component for Wordpress
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca) / Brian Hogg (brian@weeverapps.com)
*	Version: 	1.2
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

jQuery(document).ready(function(){ 

	jQuery('input#wx-contact-submit').click(function(e) {
	  
  	  	// Validation
  	  	jQuery('#contactAdminForm').validate({ 
  	  		rules: {
  	  			contactname: { required: true }
  	  	  	},
  	  		
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();

				var tabName = jQuery('input#wx-contact-title').val();
				var nonce = jQuery("input#nonce").val();
				
				var emailForm;
				
				if(jQuery("input[name=emailform]").is(":checked"))
					emailForm = jQuery("input[name=emailform]").val();
				else
					emailForm = 0;
					
				var googleMaps;
				
				if(jQuery("input[name=googlemaps]").is(":checked"))
					googleMaps = jQuery("input[name=googlemaps]").val();
				else
					googleMaps = 0;
				
				jQuery.ajax({
				 type: "POST",
				 url: ajaxurl,
				 data: {
					 action: 'ajaxSaveNewTab',
					 name: tabName,
					 phone: jQuery('input#wx-contact-phone').val(),
					 email: jQuery('input#wx-contact-email').val(),
					 address: jQuery('input#wx-contact-address').val(),
					 town: jQuery('input#wx-contact-town').val(),
					 state: jQuery('input#wx-contact-state').val(),
					 country: jQuery('input#wx-contact-country').val(),
					 image: jQuery('input#wx-contact-image').val(),
					 misc: jQuery('#wx-contact-misc').val(),
					 type: 'contact',
					 emailform: emailForm,
					 googlemaps: googleMaps,
					 component: 'contact',
					 published: 1,
					 nonce: nonce
				 },
			  	   success: function(msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  	     
				  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
				  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#contactTab";
				  	     	document.location.reload(true);
				  	   },
				  	   error: function(v,msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  		   
				  	     	jQuery('#wx-modal-secondary-text').html('');
				  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
				  	   }
				});
  	  		}
  	  	});
	});
	
	
	jQuery('input#wx-panel-submit').click(function(e) {
  
  	  	jQuery('#panelAdminForm').validate({ 
  	  		rules: {
  	  	  		cms_feed: { required: true },
  	  			name: { required: true },
  	  			"wx-select-panel": { required: true },
  	  	  		"weever-cmsfeed": { required: true, url: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
	  	  	
  	  		submitHandler: function(form) {
  	  			e.preventDefault();

			  	var cmsFeed = jQuery("select[name=cms_feed]:visible").val();
			  	var tabName = jQuery('input#wx-panel-title').val();
				var nonce = jQuery("input#nonce").val();
				
	  			if (jQuery('#wx-select-panel').val() == 'weever-cmsfeed') {
  	  				// Custom R3S
  	  				cmsFeed = jQuery('input[name=weever-cmsfeed]:visible').val();
  	  			}
			  	
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
  		  	  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'panel',
			  		   component: 'panel',
			  		   component_behaviour: 'leaf',
			  		   published: '1',
			  		   cms_feed: cmsFeed,
			  		   nonce: nonce
			  	   },
  		  	  	   success: function(msg){
    		  	  	     jQuery('#wx-modal-loading-text').html(msg);

    		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
    		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#panelTab";
    		  	  	     	document.location.reload(true);
    		  	  	   },
    		  	  	   error: function(v,msg){
     		  	  	     jQuery('#wx-modal-loading-text').html(msg);
    		  	  	     	jQuery('#wx-modal-secondary-text').html('');
    		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
    		  	  	   }
			  	 });
  	  		}
  	  	});
	});
	
	
	jQuery('input#wx-page-submit').click(function(e) {
  
  	  	jQuery('#pageAdminForm').validate({ 
  	  		rules: {
  	  	  		cms_feed: { required: true },
  	  			name: { required: true },
  	  			"wx-select-page": { required: true },
  	  	  		"weever-cmsfeed": { required: true, url: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
	  	  	
  	  		submitHandler: function(form) {
  	  			e.preventDefault();

			  	var cmsFeed = jQuery("select[name=cms_feed]:visible").val();
			  	var tabName = jQuery('input#wx-page-title').val();
				var nonce = jQuery("input#nonce").val();

	  			if (jQuery('#wx-select-page').val() == 'weever-cmsfeed') {
  	  				// Custom R3S
  	  				cmsFeed = jQuery('input[name=weever-cmsfeed]:visible').val();
  	  			}
				
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
  		  	  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'page',
			  		   component: 'page',
			  		   component_behaviour: 'leaf',
			  		   published: '1',
			  		   cms_feed: cmsFeed,
			  		   nonce: nonce
			  	   },
  		  	  	   success: function(msg){
    		  	  	     jQuery('#wx-modal-loading-text').html(msg);

    		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
    		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#pageTab";
    		  	  	     	document.location.reload(true);
    		  	  	   },
    		  	  	   error: function(v,msg){
     		  	  	     jQuery('#wx-modal-loading-text').html(msg);
    		  	  	     	jQuery('#wx-modal-secondary-text').html('');
    		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
    		  	  	   }
			  	 });
  	  		}
  	  	});
	});
	

	jQuery('input#wx-aboutapp-submit').click(function(e) {
  
  	  	jQuery('#aboutappAdminForm').validate({ 
  	  		rules: {
  	  	  		cms_feed: { required: true },
  	  			name: { required: true },
  	  			"wx-select-aboutapp": { required: true },
  	  	  		"weever-cmsfeed": { required: true, url: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
	  	  	
  	  		submitHandler: function(form) {
  	  			e.preventDefault();

			  	var cmsFeed = jQuery("select[name=cms_feed]:visible").val();
			  	var tabName = jQuery('input#wx-aboutapp-title').val();
				var nonce = jQuery("input#nonce").val();

	  			if (jQuery('#wx-select-aboutapp').val() == 'weever-cmsfeed') {
  	  				// Custom R3S
  	  				cmsFeed = jQuery('input[name=weever-cmsfeed]:visible').val();
  	  			}
				
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
  		  	  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'aboutapp',
			  		   component: 'aboutapp',
			  		   component_behaviour: 'leaf',
			  		   published: '1',
			  		   cms_feed: cmsFeed,
			  		   nonce: nonce
			  	   },
  		  	  	   success: function(msg){
    		  	  	     jQuery('#wx-modal-loading-text').html(msg);

    		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
    		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#aboutappTab";
    		  	  	     	document.location.reload(true);
    		  	  	   },
    		  	  	   error: function(v,msg){
     		  	  	     jQuery('#wx-modal-loading-text').html(msg);
    		  	  	     	jQuery('#wx-modal-secondary-text').html('');
    		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
    		  	  	   }
			  	 });
  	  		}
  	  	});
	});
	
	
	jQuery('input#wx-blog-submit').click(function(e) {

  	  	// Validation
  	  	jQuery('#blogAdminForm').validate({ 
  	  		rules: {
  	  	  		s: { required: true },
  	  	  		"weever-cmsfeed": { required: true, url: true },
  	  			cms_feed: { required: true },
  	  			name: { required: true },
  	  			"wx-select-blog": { required: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();
  	  			
  	  			var optionVal = jQuery('#wx-select-blog').val();
  	    		var cmsFeed = jQuery("select[name=cms_feed]:visible").val();
  	    	  	var tabName = jQuery('input#wx-blog-title').val();
  	    	  	var tabSearchTerm = jQuery('input[name=s]:visible').val();
  	    	  	var nonce = jQuery("input#nonce").val();
  	    	  	
  	  			if (optionVal == 's') {
  	  				// Search feed
  	  				cmsFeed = 'index.php?s='+encodeURIComponent(tabSearchTerm)+'&feed=r3s';
  	  			} else if (optionVal == 'weever-cmsfeed') {
  	  				// Custom R3S
  	  				cmsFeed = jQuery('input[name=weever-cmsfeed]:visible').val();
  	  			} else if (optionVal == 'weever_all') {
  	  				// All posts - search term of nothing
  	  				cmsFeed = 'index.php?feed=r3s';
  	  			}
  	  			
  		  	  	jQuery.ajax({
  		  	  	   type: "POST",
  		  	  	   url: ajaxurl,
  		  	  	   data: {
  		  	  		   action: 'ajaxSaveNewTab',
  		  	  		   type: 'blog',
  		  	  		   component: 'blog',
  		  	  		   weever_action: 'add',
  		  	  		   published: '1',
  		  	  		   'cms_feed': cmsFeed,
  		  	  		   name: tabName,
  		  	  		   nonce: nonce
  		  	  	   },
  		  	  	   success: function(msg){
  		  	  	     jQuery('#wx-modal-loading-text').html(msg);

  		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
  		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#blogTab";
  		  	  	     	document.location.reload(true);
  		  	  	   },
  		  	  	   error: function(v,msg){
   		  	  	     jQuery('#wx-modal-loading-text').html(msg);
  		  	  	     	jQuery('#wx-modal-secondary-text').html('');
  		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
  		  	  	   }
  		  	  	 });
  	  		}
  	  	});
	});
	

	jQuery('input#wx-directory-submit').click(function(e) {

  	  	// Validation
  	  	jQuery('#directoryAdminForm').validate({ 
  	  		rules: {
  	  	  		s: { required: true },
  	  			'weever-cmsfeed': { required: true, url: true },
  	  			cms_feed: { required: true },
  	  			name: { required: true },
  	  			"wx-select-directory": { required: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();
  	  			
  	  			var optionVal = jQuery('#wx-select-directory').val();
  	    		var cmsFeed = jQuery("select[name=cms_feed]:visible").val();
  	    	  	var tabName = jQuery('input#wx-directory-title').val();
  	    	  	var tabSearchTerm = jQuery('input[name=s]:visible').val();
  	    	  	var nonce = jQuery("input#nonce").val();
  	    	  	var imageUrl = jQuery("input#wx-directory-image-url").val();
  	    	  	
  	  			if (optionVal == 's') {
  	  				// Search feed
  	  				cmsFeed = 'index.php?s='+encodeURIComponent(tabSearchTerm)+'&feed=r3s';
	  			} else if (optionVal == 'weever-cmsfeed') {
  	  				// Custom R3S
  	  				cmsFeed = jQuery('input[name=weever-cmsfeed]:visible').val();
	  			}
  	  			
  		  	  	jQuery.ajax({
  		  	  	   type: "POST",
  		  	  	   url: ajaxurl,
  		  	  	   data: {
  		  	  		   action: 'ajaxSaveNewTab',
  		  	  		   type: 'directory',
  		  	  		   component: 'directory',
  		  	  		   weever_action: 'add',
  		  	  		   published: '1',
  		  	  		   'cms_feed': cmsFeed,
  		  	  		   'var': imageUrl,
  		  	  		   name: tabName,
  		  	  		   nonce: nonce
  		  	  	   },
  		  	  	   success: function(msg){
  		  	  	     jQuery('#wx-modal-loading-text').html(msg);

  		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
  		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#blogTab";
  		  	  	     	document.location.reload(true);
  		  	  	   },
  		  	  	   error: function(v,msg){
   		  	  	     jQuery('#wx-modal-loading-text').html(msg);
  		  	  	     	jQuery('#wx-modal-secondary-text').html('');
  		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
  		  	  	   }
  		  	  	 });
  	  		}
  	  	});
	});
	

	
	jQuery('input#wx-proximity-submit').click(function(e) {

  	  	// Validation
  	  	jQuery('#proximityAdminForm').validate({ 
  	  		rules: {
  	  	  		s: { required: true },
  	  			cms_feed: { required: true },
  	  			'weever-cmsfeed': { required: true, url: true },
  	  			name: { required: true },
  	  			"wx-select-proximity": { required: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();
  	  			
  	  			var optionVal = jQuery('#wx-select-proximity').val();
  	    		var cmsFeed = jQuery("select[name=proximity_cms_feed]:visible").val();
  	    	  	var tabName = jQuery('input#wx-proximity-title').val();
  	    	  	var tabSearchTerm = jQuery('input[name=proximity_s]:visible').val();
  	    	  	var nonce = jQuery("input#nonce").val();
  	    	  	
  	  			if (optionVal == 's') {
  	  				// Search feed
  	  				cmsFeed = 'index.php?s='+encodeURIComponent(tabSearchTerm)+'&feed=r3s';
	  			} else if (optionVal == 'weever-cmsfeed') {
  	  				// Custom R3S
  	  				cmsFeed = jQuery('input[name=weever-cmsfeed]:visible').val();
	  			}
  	  			
  		  	  	jQuery.ajax({
  		  	  	   type: "POST",
  		  	  	   url: ajaxurl,
  		  	  	   data: {
  		  	  		   action: 'ajaxSaveNewTab',
  		  	  		   type: 'proximity',
  		  	  		   component: 'proximity',
  		  	  		   weever_action: 'add',
  		  	  		   published: '1',
  		  	  		   'cms_feed': cmsFeed,
  		  	  		   name: tabName,
  		  	  		   nonce: nonce
  		  	  	   },
  		  	  	   success: function(msg){
  		  	  	     jQuery('#wx-modal-loading-text').html(msg);

  		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
  		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#proximityTab";
  		  	  	     	document.location.reload(true);
  		  	  	   },
  		  	  	   error: function(v,msg){
   		  	  	     jQuery('#wx-modal-loading-text').html(msg);
  		  	  	     	jQuery('#wx-modal-secondary-text').html('');
  		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
  		  	  	   }
  		  	  	 });
  	  		}
  	  	});
	});
	
	
	
	
	jQuery('input#wx-map-submit').click(function(e) {

  	  	// Validation
  	  	jQuery('#mapAdminForm').validate({ 
  	  		rules: {
  	  	  		s: { required: true },
  	  			cms_feed: { required: true },
  	  			'weever-cmsfeed': { required: true, url: true },
  	  			name: { required: true },
  	  			"wx-select-map": { required: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();
  	  			
  	  			var optionVal = jQuery('#wx-select-map').val();
  	    		var cmsFeed = jQuery("select[name=map_cms_feed]:visible").val();
  	    	  	var tabName = jQuery('input#wx-map-title').val();
  	    	  	var tabSearchTerm = jQuery('input[name=map_s]:visible').val();
  	    	  	var nonce = jQuery("input#nonce").val();
  	    	  	
  	  			if (optionVal == 's') {
  	  				// Search feed
  	  				cmsFeed = 'index.php?s='+encodeURIComponent(tabSearchTerm)+'&feed=r3s';
	  			} else if (optionVal == 'weever-cmsfeed') {
  	  				// Custom R3S
  	  				cmsFeed = jQuery('input[name=weever-cmsfeed]:visible').val();
	  			}
  	  			
  		  	  	jQuery.ajax({
  		  	  	   type: "POST",
  		  	  	   url: ajaxurl,
  		  	  	   data: {
  		  	  		   action: 'ajaxSaveNewTab',
  		  	  		   type: 'map',
  		  	  		   component: 'map',
  		  	  		   weever_action: 'add',
  		  	  		   published: '1',
  		  	  		   'cms_feed': cmsFeed,
  		  	  		   name: tabName,
  		  	  		   nonce: nonce
  		  	  	   },
  		  	  	   success: function(msg){
  		  	  	     jQuery('#wx-modal-loading-text').html(msg);

  		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
  		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#mapTab";
  		  	  	     	document.location.reload(true);
  		  	  	   },
  		  	  	   error: function(v,msg){
   		  	  	     jQuery('#wx-modal-loading-text').html(msg);
  		  	  	     	jQuery('#wx-modal-secondary-text').html('');
  		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
  		  	  	   }
  		  	  	 });
  	  		}
  	  	});
	});
	
	
	jQuery('input#wx-video-submit').click(function(e) {
	  
  	  	jQuery('#videoAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			component_behaviour: { required: true, url: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();
								
		 		var tabUrl = jQuery('#wx-video-url').val();
		  	  	var tabName = jQuery('input#wx-video-title').val();
		  	  	var siteKey = jQuery("input#wx-site-key").val();
		  	  	var component = jQuery("select#wx-select-video").val();
		  	  	var nonce = jQuery("input#nonce").val();
		  
		  	  	jQuery.ajax({
		  	  	   type: "POST",
		  	  	   url: ajaxurl,
		  	  	   data: {
		  	  		   action: 'ajaxSaveNewTab',
		  	  		   name: tabName,
		  	  		   type: 'video',
		  	  		   published: '1',
		  	  		   component: component,
		  	  		   component_behaviour: tabUrl,
		  	  		   nonce: nonce
		  	  	   },
  		  	  	   success: function(msg){
    		  	  	     jQuery('#wx-modal-loading-text').html(msg);

    		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
    		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#videoTab";
    		  	  	     	document.location.reload(true);
    		  	  	   },
    		  	  	   error: function(v,msg){
     		  	  	     jQuery('#wx-modal-loading-text').html(msg);
    		  	  	     	jQuery('#wx-modal-secondary-text').html('');
    		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
    		  	  	   }
		  	  	 });
  	  		}
  	  	});
	});
	
	jQuery('input#wx-social-submit').click(function(e) {
	  
  	  	// Validation
  	  	jQuery.validator.addMethod('twitteruserrequired', function(value, element, isactive) {
  	  		return !isactive || (value.trim() != '@' && value.substr(0, 1) == '@');
  	  	}, "Please enter a valid value");
  	  	
  	  	jQuery.validator.addMethod('twitterhashtagrequired', function(value, element, isactive) {
  	  		return !isactive || (value.trim() != '#' && value.substr(0, 1) == '#');
  	  	}, "Please enter a valid value");
  	  	
  	  	jQuery('#socialAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			"component_behaviour": { required: true, twitteruserrequired: function(element) {
  	    	  		return (jQuery("select#wx-select-social").val() == 'twitteruser');
  	    	  	}, twitterhashtagrequired: function(element) {
  	    	  		return (jQuery("select#wx-select-social").val() == 'twitterhashtag');
  	    	  	} }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();

  	    		var query = jQuery('#wx-social-value').val();
  	    	  	var tabName = jQuery('input#wx-social-title').val();
  	    	  	var siteKey = jQuery("input#wx-site-key").val();
  	    	  	var component = jQuery("select#wx-select-social").val();
  	    	  	var nonce = jQuery("input#nonce").val();
  	  	
		  	  	jQuery.ajax({
		  	  	   type: "POST",
		  	  	   url: ajaxurl,
		  	  	   data: {
		  	  		   action: 'ajaxSaveNewTab',
		  	  		   name: tabName,
		  	  		   type: 'social',
		  	  		   published: 1,
		  	  		   component: component,
		  	  		   component_behaviour: query,
		  	  		   nonce: nonce
		  	  	   },
		  	  	   success: function(msg){
		  	  	     jQuery('#wx-modal-loading-text').html(msg);
		  	  	     
		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#socialTab";
		  	  	     	document.location.reload(true);
		  	  	     },
		  	  	     error: function(v,msg){
		  	  	    	 jQuery('#wx-modal-loading-text').html(msg);
		  	  	     	jQuery('#wx-modal-secondary-text').html('');
		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
		  	  	   }
		  	  	 });
  	  		}
  	  	});
	});
	
	jQuery('input#wx-photo-submit').click(function(e) {

  	  	jQuery('#photoAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			url: { required: true, url: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();
				
			  	var tabUrl = jQuery('#wx-photo-url').val();
			  	var tabName = jQuery('input#wx-photo-title').val();
			  	var siteKey = jQuery("input#wx-site-key").val();
			  	var component = jQuery("select#wx-select-photo").val();
  	    	  	var nonce = jQuery("input#nonce").val();
		
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
			  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'photo',
			  		   published: 1,
			  		   component: component,
			  		   component_behaviour: tabUrl,
			  		   nonce: nonce
			  	   },
			  	   success: function(msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  	     
				  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
				  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#photoTab";
				  	     	document.location.reload(true);
				  	   },
				  	   error: function(v,msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  		   
				  	     	jQuery('#wx-modal-secondary-text').html('');
				  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
				  	   }
			  	 });
  	  		}
  	  	});
	  	
	});
	
	
	jQuery('input#wx-calendar-submit').click(function(e) {
	  
  	  	jQuery('#calendarAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			url: { required: true, url: true },
  	  			email: { required: true, email: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
			  	e.preventDefault();
			  	 
			  	var tabEmail = jQuery('#wx-google-calendar-email').val();
			  	var tabUrl = jQuery('#wx-facebook-calendar-url').val();
			  	var tabName = jQuery('input#wx-calendar-title').val();
			  	var component = jQuery("select#wx-select-calendar").val();
			  	var componentBehaviour = null;
			  	var nonce = jQuery("input#nonce").val();
			  	
			  	if(component == "google.calendar") {
			  		componentBehaviour = tabEmail;
			  	} else {
			  		componentBehaviour = tabUrl;
			  	}
			  	
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
			  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'calendar',
			  		   published: 1,
			  		   component: component,
			  		   component_behaviour: componentBehaviour,
			  		   nonce: nonce
			  	   },
			  	   success: function(msg){
			  	     jQuery('#wx-modal-loading-text').html(msg);
			  	     
			  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
			  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#calendarTab";
			  	     	document.location.reload(true);
			  	   },
			  	   error: function(v,msg){
			  	     jQuery('#wx-modal-loading-text').html(msg);
			  		   
			  	     	jQuery('#wx-modal-secondary-text').html('');
			  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
			  	   }
			  	 });
  	  		}
  	  	});

	});
	
	
	jQuery('input#wx-form-submit').click(function(e) {
		
  	  	jQuery('#formAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			url: { required: true, url: true },
  	  			api_key: { required: true },
  	  			email: { required: true, email: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
			  	e.preventDefault();
			  	 	  
			  	var tabUrl = jQuery('#wx-form-url').val();
			  	var APIKey = jQuery('#wx-form-api-key').val();
			  	var tabName = jQuery('input#wx-form-title').val();
			  	var siteKey = jQuery("input#wx-site-key").val();
			  	var component = jQuery("select#wx-select-form").val();
			  	var nonce = jQuery("input#nonce").val();
			  	
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
			  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'form',
			  		   published: 1,
			  		   component: component,
			  		   component_behaviour: tabUrl,
			  		   'var': APIKey,
			  		   nonce: nonce
			  	   },
			  	   success: function(msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  	     
				  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
				  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#formTab";
				  	     	document.location.reload(true);
				  	   },
				  	   error: function(v,msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  		   
				  	     	jQuery('#wx-modal-secondary-text').html('');
				  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
				  	   }
			  	 });
  	  		}
  	  	});

	});

});