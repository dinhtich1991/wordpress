<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="entry-thumbnail">
		<?php tich_thumbnail('thumbnail'); ?>
	</div>
	<div class="entry-header">
		<?php tich_entry_header(); ?>
		<?php tich_entry_meta(); ?>
	</div>
	<div class="entry-content">
		<?php tich_entry_content(); ?>
		<?php ( is_single() ? tich_entry_tag() : '') ?>
	</div>
	
</article>