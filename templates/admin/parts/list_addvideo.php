<form action='' method='post' name='videoAdminForm' id='videoAdminForm'>

<div class="wx-add-ui formspacer">

	<div class='wx-add-item-video wx-add-item-dropdown'>
		<select id='wx-select-video' class='wx-component-select' name='noname'>
			<option value=''><?php echo __( '+ Add a Video Channel', 'weever' ); ?></option>
			<option value='youtube'><?php echo __( 'YouTube', 'weever' ); ?></option>
			<option value='vimeo'><?php echo __( 'Vimeo', 'weever' ); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-video-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-video-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>
	
	<div class='wx-add-item-value wx-video-reveal wx-reveal'>
		<input type='text' value='' placeholder='http://' name='component_behaviour' id='wx-video-url' class='wx-input wx-video-input' />
		<label for='wx-video-url' id='wx-vimeo-url' class='wx-video-label'><?php echo __( 'Vimeo User or Channel URL', 'weever' ); ?></label>
		<label for='wx-video-url' id='wx-youtube-url' class='wx-video-label'><?php echo __( 'YouTube Channel URL', 'weever' ); ?></label>
	</div>
	

	<div class='wx-add-title wx-video-reveal wx-reveal'>
		<input type='text' value='' id='wx-video-title' class='wx-title wx-input wx-video-input' name='noname' />
		<label for='wx-video-title'><?php echo __( 'Video Feed Tab Name', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-video-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>

</div>

</form>