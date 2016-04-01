<?php get_header(); ?>
<div class="content">
	<div class="main-content">
		<div class="search-info">
	        <!--Sử dụng query để hiển thị số kết quả tìm kiếm được tìm thấy
	                Cũng như hiển thị từ khóa tìm kiếm. Từ khóa tìm kiếm cũng
	                có thể hiển thị được với hàm get_search_query()-->
	        <?php
                $search_query = new WP_Query( 's='.$s.'&showposts=-1' );
                $search_keyword = wp_specialchars( $s, 1);
                $search_count = $search_query->post_count;
                // var_dump( $search_query );
                printf( __('Search results for <strong>%1$s</strong>. We found <strong>%2$s</strong> articles for you.', 'tich'), $search_keyword, $search_count );
	        ?>
	</div>
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