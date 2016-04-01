<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="entry-thumbnail">
		<?php tich_thumbnail('large'); ?>
	</div>
	<div class="entry-header">
		<?php tich_entry_header(); ?>
		<?php
			$attachment = get_children(array('post_parent' => $post->ID));
			$attachment_number = count($attachment);
			printf(__('This image post contains %1$s photos', 'tich'), $attachment_number);
		?>
	</div>
	<div class="entry-content">
		<?php tich_entry_content(); ?>
		<?php ( is_single() ? tich_entry_tag() : '') ?>
	</div>
	
</article>