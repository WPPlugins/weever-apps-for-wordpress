<form action='' method='post' name='proximityAdminForm' id='proximityAdminForm'>

<div id="proximityhelp"><?php echo __( 'Create geotagged posts to add to the map using either the <a target="_blank" href="http://wordpress.org/extend/mobile/">Wordpress mobile application</a>, the <a target="_blank" href="http://wordpress.org/extend/plugins/geolocation/">Geolocation plugin</a> or the <a target="_blank" href="http://wordpress.org/extend/plugins/wp-geo/">WP Geo plugin</a>.  Add KML and custom map markers for content by editing the post, under "Weever Apps - Map Data"' ); ?></div>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-proximity wx-add-item-dropdown'>
		<select id='wx-select-proximity' name="wx-select-proximity">
			<option value=""><?php echo __( '+ Add Geotagged Content', 'weever' ); ?></option>
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
	</div>

	<div class='wx-dummy wx-proximity-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>

	<div class='wx-dummy wx-proximity-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>

	<div class='wx-add-item-option wx-proximity-reveal wx-reveal'>

		<?php foreach ( get_taxonomies( array( 'public' => true ), 'objects' ) as $taxonomy ): ?>
		<?php if ( ! $taxonomy->query_var || $taxonomy->query_var == 'post_format' ) continue; ?>
		<div id="wx-add-proximity-<?php echo $taxonomy->query_var; ?>-item" class="wx-proximity-item-choose">
    		<select id="wx-add-proximity-<?php echo $taxonomy->query_var; ?>-select" name="unnamed" class="wx-proximity-item-select required">
    			<option value=""><?php echo __( '(Choose an option)', 'weever' ); ?></option>
            	<?php foreach ( get_terms( $taxonomy->name ) as $term ): ?>
    			<option value="<?php echo WeeverHelper::get_term_feed_link_relative( $term ); ?>"><?php echo $term->name; ?></option>
            	<?php endforeach; ?>
    		</select>
    	</div>
		<?php endforeach; ?>

		<div id="wx-add-proximity-s-item" class="wx-proximity-item-choose">
    		<input type='text' value='' id='wx-add-proximity-s-input' class='wx-input wx-proximity-input' name='proximity_s' placeholder='<?php echo __( 'Search Term', 'weever' ); ?>' />
    		<label for='wx-add-proximity-s-input' id='wx-add-proximity-s-input-label' class='wx-proximity-label'><?php echo __( 'Search Term Description', 'weever' ); ?></label>
		</div>


		<div id="wx-add-proximity-weever-cmsfeed-item" class="wx-proximity-item-choose">
    		<input type='text' value='' id='wx-add-proximity-weever-cmsfeed-input' class='wx-input wx-proximity-input' name='weever-cmsfeed' placeholder='<?php echo __( 'http://', 'weever' ); ?>' />
    		<label for='wx-add-proximity-weever-cmsfeed-input' id='wx-add-proximity-weever-cmsfeed-input-label' class='wx-proximity-label'><?php echo __( 'R3S Object - <a target="_blank" href="http://support.weeverapps.com/entries/20786801-what-is-the-add-an-r3s-feed-url-option-for">Details</a>', 'weever' ); ?></label>
		</div>
		
		
	</div>

	<div class='wx-add-title wx-proximity-reveal wx-reveal'>

		<input type='text' id='wx-proximity-title' value='' class='wx-title wx-input wx-proximity-input' name='noname' />
		<label for='wx-proximity-title'><?php echo __( 'Description', 'weever' ); ?></label>
	</div>

	<div class='wx-add-submit'>
		<input type='submit' id='wx-proximity-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>

</div>

</form>