<form action='' method='post' name='aboutappAdminForm' id='aboutappAdminForm'>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-aboutapp wx-add-item-dropdown'>
		<select id='wx-select-aboutapp' name='wx-select-aboutapp'>
			<option value=''><?php echo __( '+ Add Site Pages(s)', 'weever' ); ?></option>
			<option value='menu'><?php echo __( 'Wordpress page', 'weever' ); ?></option>
			<option value="weever-cmsfeed"><?php echo __( 'From another R3S Object (Advanced)', 'weever' ); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-aboutapp-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-aboutapp-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>

	<div class='wx-add-item-value wx-aboutapp-reveal wx-reveal'>
		<select id="wx-add-aboutapp-menu-item-select" class="wx-cms-feed-select wx-add-aboutapp-menu-item wx-aboutapp-item-choose" name="cms_feed">
			<option value=""><?php echo __( '(Choose a Content Item)' ); ?></option>
			<?php foreach ( get_pages() as $page ): ?>
			<option value="<?php echo WeeverHelper::get_page_link_relative( $page ); ?>"><?php echo $page->post_title; ?></option>
			<?php endforeach; ?>
		</select>

		<div id="wx-add-aboutapp-weever-cmsfeed-item" class="wx-aboutapp-item-choose">
    		<input type='text' value='' id='wx-add-aboutapp-weever-cmsfeed-input' class='wx-input wx-aboutapp-input' name='weever-cmsfeed' placeholder='<?php echo __( 'http://', 'weever' ); ?>' />
    		<label for='wx-add-aboutapp-weever-cmsfeed-input' id='wx-add-aboutapp-weever-cmsfeed-input-label' class='wx-aboutapp-label'><?php echo __( 'R3S Object - <a target="_blank" href="http://support.weeverapps.com/entries/20786801-what-is-the-add-an-r3s-feed-url-option-for">Details</a>', 'weever' ); ?></label>
		</div>
		
	</div>
	
	<div class='wx-add-title wx-add-title-aboutapp wx-aboutapp-reveal wx-reveal'>
		<input type='text' value='' id='wx-aboutapp-title' class='wx-title wx-input wx-aboutapp-input' name='noname' />
		<label for='wx-aboutapp-title'><?php echo __( 'Page Name', 'weever' ); ?></label>
	</div>
	
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-aboutapp-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>

</div>

</form>