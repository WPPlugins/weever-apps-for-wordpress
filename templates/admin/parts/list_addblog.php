<form action='' method='post' name='blogAdminForm' id='blogAdminForm'>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-blog wx-add-item-dropdown'>
		<select id='wx-select-blog' name="wx-select-blog">
			<option value=""><?php echo __( '+ Add Blog Content', 'weever' ); ?></option>
			<option value="weever_all"><?php echo __( 'All published blog posts', 'weever' ); ?></option>
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

	<div class='wx-dummy wx-blog-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>

	<div class='wx-dummy wx-blog-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>

	<div class='wx-add-item-option wx-blog-reveal wx-reveal'>

		<?php foreach ( get_taxonomies( array( 'public' => true ), 'objects' ) as $taxonomy ): ?>
		<?php if ( ! $taxonomy->query_var || $taxonomy->query_var == 'post_format' ) continue; ?>
		<div id="wx-add-blog-<?php echo $taxonomy->query_var; ?>-item" class="wx-blog-item-choose">
    		<select id="wx-add-blog-<?php echo $taxonomy->query_var; ?>-select" name="unnamed" class="wx-blog-item-select required">
    			<option value=""><?php echo __( '(Choose an option)', 'weever' ); ?></option>
            	<?php foreach ( get_terms( $taxonomy->name ) as $term ): ?>
    			<option value="<?php echo WeeverHelper::get_term_feed_link_relative( $term ); ?>"><?php echo $term->name; ?></option>
            	<?php endforeach; ?>
    		</select>
    	</div>
		<?php endforeach; ?>

		<div id="wx-add-blog-s-item" class="wx-blog-item-choose">
    		<input type='text' value='' id='wx-add-blog-s-input' class='wx-input wx-blog-input' name='s' placeholder='<?php echo __( 'Search Term', 'weever' ); ?>' />
    		<label for='wx-add-blog-s-input' id='wx-add-blog-s-input-label' class='wx-blog-label'><?php echo __( 'Search Term Description', 'weever' ); ?></label>
		</div>

		<div id="wx-add-blog-weever-cmsfeed-item" class="wx-blog-item-choose">
    		<input type='text' value='' id='wx-add-blog-weever-cmsfeed-input' class='wx-input wx-blog-input' name='weever-cmsfeed' placeholder='<?php echo __( 'http://', 'weever' ); ?>' />
    		<label for='wx-add-blog-weever-cmsfeed-input' id='wx-add-blog-weever-cmsfeed-input-label' class='wx-blog-label'><?php echo __( 'R3S Object - <a target="_blank" href="http://support.weeverapps.com/entries/20786801-what-is-the-add-an-r3s-feed-url-option-for">Details</a>', 'weever' ); ?></label>
		</div>
		
		
	</div>

	<div class='wx-add-title wx-blog-reveal wx-reveal'>

		<input type='text' id='wx-blog-title' value='' class='wx-title wx-input wx-blog-input' name='noname' />
		<label for='wx-blog-title'><?php echo __( 'Submenu Tab Name/Description', 'weever' ); ?></label>
	</div>

	<div class='wx-add-submit'>
		<input type='submit' id='wx-blog-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>

</div>

</form>