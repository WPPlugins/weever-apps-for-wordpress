<form action='' method='post' name='socialAdminForm' id='socialAdminForm'>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-social wx-add-item-dropdown'>
		<select id='wx-select-social' name='noname' class='wx-component-select'>
			<option value=''><?php echo __( '+ Add a Social Network', 'weever' ); ?></option>
			<option value='twitteruser'><?php echo __( 'Twitter User Stream', 'weever' ); ?></option>
			<option value='twitterhashtag'><?php echo __( 'Twitter #Hashtag Stream', 'weever' ); ?></option>
			<option value='twitterquery'><?php echo __( 'Twitter Search Term', 'weever' ); ?></option>
			<option value='identi.ca'><?php echo __( 'Identi.ca Search Query', 'weever' ); ?></option>
			<option value='facebook'><?php echo __( 'Facebook Page Status/Wall', 'weever' ); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-social-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-social-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>

	
	<div class='wx-social-value wx-social-reveal wx-reveal'>
		<input type='text' value='' class='wx-input wx-social-input' id='wx-social-value' name='component_behaviour' />
		<label for='wx-social-value' id='wx-twitter-user' class='wx-social-label'><?php echo __( 'Twitter User Name', 'weever' ); ?></label>
		<label for='wx-social-value' id='wx-twitter-hashtag' class='wx-social-label'><?php echo __( 'Twitter #hashtag', 'weever' ); ?></label>
		<label for='wx-social-value' id='wx-twitter-query' class='wx-social-label'><?php echo __( 'Twitter Search Term', 'weever' ); ?></label>
		<label for='wx-social-value' id='wx-identica-query' class='wx-social-label'><?php echo __( 'Identi.ca Search Term', 'weever' ); ?></label>
		<label for='wx-social-value' id='wx-facebook-url' class='wx-social-label'><?php echo __( 'Facebook Page URL (Not Profile)', 'weever' ); ?></label>
	</div>

	<div class='wx-add-title wx-social-reveal wx-reveal'>
		<input type='text' value='' class='wx-title wx-input wx-social-input' id='wx-social-title' name='noname' />
		<label for='wx-social-title'><?php echo __( 'Social Network Tab Name', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-social-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>

	

</div>

</form>