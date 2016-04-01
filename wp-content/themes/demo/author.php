<?php get_header(); ?>
<div class="content">
        <div class="main-content">
                <div class="author-box"><?php
                // Hiển thị avatar của tác giả
                echo '<div class="author-avatar">'. get_avatar( get_the_author_meta( 'ID' ) ) . '</div>';
         
                // hiển thị tên tác giả
                printf( '<h3>'. __( 'Posts by %1$s', 'tich' ) . '</h3>', get_the_author() );
         
                // Hiển thị giới thiệu của tác giả
                echo '<p>'. get_the_author_meta( 'description' ) . '</p>';
         
                // Hiển thị field website của tác giả
                if ( get_the_author_meta( 'user_url' ) ) : printf( __('<a href="%1$s" title="Visit to %2$s website">Visit to my website</a>', 'tich'),
                        get_the_author_meta( 'user_url' ), get_the_author() );
                endif;
        ?></div>
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