<form action='' method='post' name='formAdminForm' id='formAdminForm'>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-form wx-add-item-dropdown'>
		<select id='wx-select-form' class='wx-component-select'>
			<option value=''><?php echo __( '+ Add Form Content', 'weever' ); ?></option>
			<option value='wufoo'><?php echo __( 'Add a Wufoo Form', 'weever' ); ?></option>
		</select>
                <label for="wx-select-form" class="key hasTip" style="color: #888888; font-size: 0.75em; padding-left: 4px; text-transform: uppercase;"
                 title="<?php echo __( '', 'weever' ); ?>"><?php echo __( '', 'weever' ); ?></label>
	</div>
	
	<div class='wx-dummy wx-form-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-form-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>
	
	
	<div class='wx-add-item-value wx-form-reveal wx-reveal'>
		<input type='text' id='wx-form-url' class='wx-input wx-form-input' name='url' />
		<label for='wx-form-url'><?php echo __( 'Wufoo Form URL', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-item-value wx-form-reveal wx-reveal'>
		<input type='text' id='wx-form-api-key' class='wx-input wx-form-input' name='api_key' />
		<label for='wx-form-api-key'><?php echo __( 'Your Wufoo API Key', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-title wx-form-reveal wx-reveal'>
		<input type='text' value='' id='wx-form-title' class='wx-title wx-input wx-form-input' name='noname' />
                <label for='wx-form-title' id='wx-newform-title' class='wx-form-label'><?php echo __( 'Form Tab Name', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-form-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>
	
</div>

</form>