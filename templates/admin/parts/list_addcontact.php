<form action='' method='post' name='contactAdminForm' id='contactAdminForm'>

<div class="wx-add-ui formspacer">
	<?php /*
	<div class='wx-add-item-contact wx-add-item-dropdown'>
		<select id='wx-select-contact' name='wx-select-contact'>
			<option value=''><?php echo __( '+ Add Contact Information', 'weever' ); ?></option>
			<option value='jcontact'><?php echo __( 'Wordpress User Account', 'weever' ); ?></option>
		</select>
	</div>

	<div class='wx-dummy wx-contact-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ) ; ?></option></select>
	</div>

	<div class='wx-dummy wx-contact-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __('&nbsp;', 'weever' ); ?>' />
	</div>


	<div class='wx-add-item-value wx-contact-reveal wx-reveal'>

		<select name="component_id" id="wx-add-contact-wordpress-select" class="wx-component-id-select">
			<option value="">Choose a Contact</option>
        	<?php foreach ( get_users() as $user ): ?>
			<option value="<?php echo WeeverHelper::get_user_link_relative( $user ); ?>"><?php echo $user->display_name; ?></option>
        	<?php endforeach; ?>
		</select>
        <label for='wx-add-contact-wordpress-select'><?php echo __( 'Wordpress Users', 'weever' ); ?></label>

	</div>
	*/ ?>
	<div class='wx-add-contact'>
    	<div class='wx-add-title'>
    		<label for='wx-contact-title'><?php echo __( 'Name', 'weever' ); ?></label>
    		<input type='text' value='' id='wx-contact-title' class='wx-title wx-input wx-contact-input required' name='contactname' />
    	</div>

    	<div class='wx-add-title'>
    		<label for='wx-contact-phone'><?php echo __( 'Phone Number', 'weever' ); ?></label>
    		<input type='text' value='' id='wx-contact-phone' class='wx-title wx-input wx-contact-input' name='phone' />
    	</div>

    	<div class='wx-add-title'>
    		<label for='wx-contact-email'><?php echo __( 'E-mail Address', 'weever' ); ?></label>
    		<input type='text' value='' id='wx-contact-email' class='wx-title wx-input wx-contact-input' name='email' />
    	</div>
	</div>
	
	<div class='wx-add-contact'>
    	<div class='wx-add-title'>
    		<label for='wx-contact-address'><?php echo __( 'Address', 'weever' ); ?></label>
    		<input type='text' value='' id='wx-contact-address' class='wx-title wx-input wx-contact-input' name='address' />
    	</div>

    	<div class='wx-add-title'>
    		<label for='wx-contact-town'><?php echo __( 'Town', 'weever' ); ?></label>
    		<input type='text' value='' id='wx-contact-town' class='wx-title wx-input wx-contact-input' name='town' />
    	</div>

    	<div class='wx-add-title'>
    		<label for='wx-contact-state'><?php echo __( 'State/Province', 'weever' ); ?></label>
    		<input type='text' value='' id='wx-contact-state' class='wx-title wx-input wx-contact-input' name='state' />
    	</div>

    	<div class='wx-add-title'>
    		<label for='wx-contact-country'><?php echo __( 'Country', 'weever' ); ?></label>
    		<input type='text' value='' id='wx-contact-country' class='wx-title wx-input wx-contact-input' name='country' />
    	</div>

	</div>

	<div class='wx-add-contact'>
    	<div class='wx-add-title'>
    		<label for='wx-contact-misc'><?php echo __( 'Miscellaneous Text', 'weever' ); ?></label>
    		<textarea id='wx-contact-misc' class='wx-title wx-input wx-contact-input' name='misc'></textarea>
    	</div>
    	
    	<div class='wx-add-title'>
    		<label for='wx-contact-image'><?php echo __( 'Contact Photo URL', 'weever' ); ?></label>
    		<input type='text' value='' id='wx-contact-image' placeholder='http://' class='wx-title wx-input wx-contact-input' name='image' />
    	</div>
    	
    	<div class='wx-contact-options'>
    		<input type="checkbox" name="emailform" id="wx-contact-option-email-form" value="1" />
    		<label for="wx-contact-option-email-form" class="key hasTip" title="<?php echo __( '<strong>Note:</strong> Hides the email address, except on BlackBerry phones which have a form bug and where a direct email link is the only option.', 'weever' ); ?>"><?php echo __( 'Use an email form*', 'weever' ); ?></label>
    		<br/>
    		<input type="checkbox" name="googlemaps" id="wx-contact-option-google-maps" value="1" />
    		<label for="wx-contact-option-google-maps"><?php echo __( 'Display a Google Maps&trade; link', 'weever' ); ?></label>
    	</div>
    	
	</div>
	
	<div class='wx-add-contact'>
		<div class='wx-add-submit'>
			<input type='submit' id='wx-contact-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
		</div>
	</div>
</div>

</form>