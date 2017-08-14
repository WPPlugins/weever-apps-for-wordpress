<form action='' method='post' name='photoAdminForm' id='photoAdminForm'>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-photo wx-add-item-dropdown'>
		<select id='wx-select-photo' class='wx-component-select' name='noname'>
			<option value=''><?php echo __( '+ Add a Photo Stream', 'weever' ); ?></option>
			<option value='foursquare'><?php echo __( 'Foursquare Venue Photos', 'weever' ); ?></option>
			<option value='flickr'><?php echo __( 'Flickr Photo Feed', 'weever' ); ?></option>
			<option value='flickr.photosets'><?php echo __( 'All your public Flickr Photosets', 'weever' ); ?></option>
			<option value='google.picasa'><?php echo __( 'All your public Picasa Albums', 'weever' ); ?></option>
			<option value='facebook.photos'><?php echo __( 'All your public Facebook Albums from Profile', 'weever' ); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-photo-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-photo-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>
	
	
	<div class='wx-add-photo-value wx-photo-reveal wx-reveal'>
		<input type='text' value='' id='wx-photo-url' class='wx-input wx-photo-input' name='url' />
		<label for='wx-photo-url' id='wx-foursquare-url' class='wx-photo-label'><?php echo __( 'Foursquare Venue Page URL', 'weever' ); ?></label>
		<label for='wx-photo-url' id='wx-flickr-url' class='wx-photo-label'><?php echo __( 'Flickr User Photostream Page URL', 'weever' ); ?></label>
		<label for='wx-photo-url' id='wx-google-picasa-email' class='wx-photo-label'><?php echo __( 'Picasa Profile URL or Email', 'weever' ); ?></label>
		<label for='wx-photo-url' id='wx-facebook-photos-url' class='wx-photo-label'><?php echo __( 'Facebook Profile URL', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-title wx-photo-reveal wx-reveal'>
		<input type='text' value='' id='wx-photo-title' class='wx-title wx-input wx-photo-input' name='noname' />
		<label for='wx-photo-title'><?php echo __( 'Photo Stream Tab Name', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-photo-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>

</div>

</form>