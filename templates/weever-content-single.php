<?php
// the_post() has already been called by Weever Controller
?>
<div class="item-page">

<?php if ( ! isset( $_GET['content_header'] ) or $_GET['content_header'] != 'false' ): ?>
<h1 class="wx-article-title">
	<?php echo get_the_title(); ?>
</h1>
<?php endif; ?>

<div class="item-the-content">
<?php the_content(); ?>
</div>
</div>
