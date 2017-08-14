<form action='' method='post' name='directoryAdminForm' id='directoryAdminForm'>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-directory wx-add-item-dropdown'>
		<select id='wx-select-directory' name="wx-select-directory">
			<option value=""><?php echo __( '+ Add Directory Content', 'weever' ); ?></option>
			<?php foreach ( get_taxonomies( array( 'public' => true ), 'objects' ) as $taxonomy ): ?>
			<?php if ( ! $taxonomy->query_var || $taxonomy->query_var == 'post_format' ) continue; ?>
			<option value="<?php echo $taxonomy->query_var; ?>"><?php 
			if ( $taxonomy->name == 'category' )
			    echo __( 'From a Category', 'weever' );
			elseif ( $taxonomy->name == 'post_tag' )
			    echo __( 'From a Tag', 'weever' );
			else    
			    echo sprintf( __( 'From taxonomy: %s', 'weever' ), $taxonomy->label ); 
			?></option>
			<?php endforeach; ?>
			<option value="s"><?php echo __( 'From a Search Term', 'weever' ); ?></option>
			<option value="weever-cmsfeed"><?php echo __( 'From another R3S Object (Advanced)', 'weever' ); ?></option>
		</select>
		
		<label for="wx-select-directory"><a target="_blank" href="http://weeverapps.zendesk.com/entries/20673217-what-is-the-directory-tab-for">Learn More About the Directory Tab</a></label>
	</div>

	<div class='wx-dummy wx-directory-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>

	<div class='wx-dummy wx-directory-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>

	<div class='wx-add-item-option wx-directory-reveal wx-reveal'>

		<?php foreach ( get_taxonomies( array( 'public' => true ), 'objects' ) as $taxonomy ): ?>
		<?php if ( ! $taxonomy->query_var || $taxonomy->query_var == 'post_format' ) continue; ?>
		<div id="wx-add-directory-<?php echo $taxonomy->query_var; ?>-item" class="wx-directory-item-choose">
    		<select id="wx-add-directory-<?php echo $taxonomy->query_var; ?>-select" name="unnamed" class="wx-directory-item-select required">
    			<option value=""><?php echo __( '(Choose an option)', 'weever' ); ?></option>
            	<?php foreach ( get_terms( $taxonomy->name ) as $term ): ?>
    			<option value="<?php echo WeeverHelper::get_term_feed_link_relative( $term ); ?>"><?php echo $term->name; ?></option>
            	<?php endforeach; ?>
    		</select>
    	</div>
		<?php endforeach; ?>

		<div id="wx-add-directory-s-item" class="wx-directory-item-choose">
    		<input type='text' value='' id='wx-add-directory-s-input' class='wx-input wx-directory-input' name='s' placeholder='<?php echo __( 'Search Term', 'weever' ); ?>' />
    		<label for='wx-add-directory-s-input' id='wx-add-directory-s-input-label' class='wx-directory-label'><?php echo __( 'Search Term Description', 'weever' ); ?></label>
		</div>

		<div id="wx-add-directory-weever-cmsfeed-item" class="wx-directory-item-choose">
    		<input type='text' value='' id='wx-add-directory-weever-cmsfeed-input' class='wx-input wx-directory-input' name='weever-cmsfeed' placeholder='<?php echo __( 'http://', 'weever' ); ?>' />
    		<label for='wx-add-directory-weever-cmsfeed-input' id='wx-add-directory-weever-cmsfeed-input-label' class='wx-directory-label'><?php echo __( 'R3S Object - <a target="_blank" href="http://support.weeverapps.com/entries/20786801-what-is-the-add-an-r3s-feed-url-option-for">Details</a>', 'weever' ); ?></label>
		</div>
		
	</div>

	<div class='wx-add-title wx-directory-reveal wx-reveal'>

		<input type='text' id='wx-directory-title' value='' class='wx-title wx-input wx-directory-input' name='noname' />
		<label for='wx-directory-title'><?php echo __( 'Submenu Tab Name/Description', 'weever' ); ?></label>
	</div>

	<div class='wx-add-title wx-directory-reveal wx-reveal'>

		<input type='text' id='wx-directory-image-url' value='' class='wx-title wx-input wx-directory-image-url' placeholder='http://' name='noname' />
		<label for='wx-directory-image-url'><?php echo __( 'Optional Image URL', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-directory-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>

</div>

</form>