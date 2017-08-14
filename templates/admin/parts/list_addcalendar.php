<form action='' method='post' name='calendarAdminForm' id='calendarAdminForm'>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-calendar wx-add-item-dropdown'>
		<select id='wx-select-calendar' class='wx-component-select' name='noname'>
			<option value=''><?php echo __( '(Add new events calendar)', 'weever' ); ?></option>
			<option value='google.calendar'><?php echo __( 'Add upcoming events from a Google Calendar', 'weever' ); ?></option>
			<option value='facebook.events'><?php echo __( 'Add upcoming events from a Facebook Profile', 'weever' ); ?></option>
		</select>
                <label for="wx-select-calendar" class="key hasTip" style="color: #888888; font-size: 0.75em; padding-left: 4px; text-transform: uppercase;"
                 title="<?php echo __( '', 'weever' ); ?>"><?php echo __( '', 'weever' ); ?></label>
	</div>
	
	<div class='wx-dummy wx-calendar-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-calendar-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>
	
	
	<div class='wx-add-item-value wx-google-calendar-reveal wx-reveal'>
		<input type='text' value='yourname@email.com' id='wx-google-calendar-email' class='wx-calendar-input wx-input' name='email' />
		<label for='wx-google-calendar-email' id='wx-google-calendar-email-label'><?php echo __( 'Google Calendar Email ID', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-item-value wx-facebook-calendar-reveal wx-reveal'>
		<input type='text' value='http://' id='wx-facebook-calendar-url' class='wx-input wx-calendar-input' name='url' />
		<label for='wx-facebook-calendar-url' id='wx-facebook-calendar-url-label'><?php echo __( 'Facebook Profile URL', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-title wx-calendar-reveal wx-reveal'>
		<input type='text' value='' id='wx-calendar-title' class='wx-title wx-input' name='noname' />
                <label for='wx-calendar-title' id='wx-newcalendar-title' class='wx-calendar-label'><?php echo __( 'Event Tab Name', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-calendar-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>

</div>

</form>