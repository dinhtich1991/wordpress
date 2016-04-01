<?php get_header(); ?>
<div class="content">
	<div class="main-content">
		<div class="archive-title">
	        <h2>
                <?php
                    if ( is_tag() ) :
                            printf( __('Posts Tagged: %1$s','tich'), single_tag_title( '', false ) );
                    elseif ( is_category() ) :
                            printf( __('Posts Categorized: %1$s','tich'), single_cat_title( '', false ) );
                    elseif ( is_day() ) :
                            printf( __('Daily Archives: %1$s','tich'), get_the_time('l, F j, Y') );
                    elseif ( is_month() ) :
                            printf( __('Monthly Archives: %1$s','tich'), get_the_time('F Y') );
                    elseif ( is_year() ) :
                            printf( __('Yearly Archives: %1$s','tich'), get_the_time('Y') );
                    endif;
                ?>
	        </h2>
		</div>
		<?php if ( is_tag() || is_category() ) : ?>
	        <div class="archive-description">
	                <?php echo term_description(); ?>
	        </div>
		<?php endif; ?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<h1><?php get_template_part('content', get_post_format()); ?></h1>
			<?php endwhile; ?>
			<?php tich_pagination(); ?>
		<?php else: ?>
			<?php get_template_part('content', 'none') ?>
		<?php endif; ?>
	</div>
	<div class="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>




<?php get_footer(); ?>