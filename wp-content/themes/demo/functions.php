<?php
	define('THEME_URL', get_stylesheet_directory() );
	define('CORE', THEME_URL . '/core' );

	require_once(CORE . '/init.php');

	/*
		Thiet lap chieu rong noi dung
	*/
	if( !isset($content_width) ){
		$content_width = 620;
	}

	/**
		@ Khai bao chuc nang cua theme
	**/

	if( !function_exists('tich_theme_setup') ){
		function tich_theme_setup(){
			/** Thiet lap textdomain  **/
			$language_folder = THEME_URL . '/language';
			load_theme_textdomain('tich', $language_folder);

			/** Tu dong them link RSS len <head> **/
			add_theme_support('automatic-feed-links');

			/** Them post thumbnail **/
			add_theme_support('post-thumbnails');

			/** Them post format **/
			add_theme_support('post-formats', array(
				'image',
				'video',
				'gallery',
				'qoute',
				'link'
			));

			/** Them title-tag **/
			add_theme_support('title-tag');

			/** Them custom background **/
			$default_background = array(
			   'default-color' => '#e8e8e8',
			);
			add_theme_support( 'custom-background', $default_background );

			/** Them menu **/
			register_nav_menu('top-menu', __('Top Menu', 'tich'));
			register_nav_menu('primary-menu', __('Primary Menu', 'tich'));

			/** Them sidebar **/
			$sidebar = array(
				'name' => __('Main Sidebar', 'tich'),
				'id' => 'main-sidebar',
				'description' => __('Default sidebar'),
				'class' => 'main-sidebar',
				'before_title' => '<h3 class="widgettitle">',
				'after_title' => '</h3>'
			);
			register_sidebar( $sidebar );
		}
		add_action('init', 'tich_theme_setup');
	}

	/**
		TEMPLATE FUNCTIONS
	**/

	if(!function_exists('tich_header')){
		function tich_header(){
			global $tp_options;
			if($tp_options['logo-on'] == 1){
				?>
				<div class="logo">
					<img src="<?php echo $tp_options['logo-image']['url']; ?>">
				</div>
				<?php
			}
			else{

			?>
				<div class="logo">
					<div class="site-name">
						<?php
						if( is_home() ){
							printf( '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
							get_bloginfo('url'),
							get_bloginfo('description'),
							get_bloginfo('sitename') );
						}
						else{
							printf( '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
							get_bloginfo('url'),
							get_bloginfo('description'),
							get_bloginfo('sitename') );
						}
						?>
					</div>
					<div class="site-description">
						<?php bloginfo('description') ?>
					</div>
				</div>
			<?php
			}
		}
	}

	/**
		Thiet Lap Menu
	**/
	if(!function_exists('tich_menu')){
		function tich_menu($menu){
			$menu = array(
				'theme_location' => $menu,
				'container' => 'nav',
				'container_class' => $menu,
				'items_wrap'      => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>',
			);
			wp_nav_menu($menu);
		}
	}

	/**
		Thiet Lap Menu
	**/
	if(!function_exists('tich_top_menu')){
		function tich_top_menu($menu){
			$menu = array(
				'theme_location' => $menu,
				'container' => 'nav',
				'container_class' => $menu,
				'items_wrap'      => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>',
			);
			wp_nav_menu($menu);
		}
	}

	/**
		Tao phan trang
	**/
	if(!function_exists('tich_pagination')){
		function tich_pagination(){
			if($GLOBALS['wp_query']->max_num_pages < 2){
				return '';
			} ?>
			<nav class="pagination" role="navigation">

				<?php if(get_previous_posts_link()) :  ?>
					<div class="next"><?php previous_posts_link(__('Previous', 'tich')); ?></div>
				<?php endif; ?>
				<?php if(get_next_posts_link()) : ?>
					<div class="pre"><?php next_posts_link(__('Next', 'tich')); ?></div>
				<?php endif; ?>
				<?php global $numpages; ?>
				<?php echo '(Page '.$numpages.')'; ?>
			</nav>
			<?php
		}
	}

	/**
		Hien thumbnail
	**/
	if(!function_exists('tich_thumbnail')){
		function tich_thumbnail($size){
			if( !is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image') ) : ?>
			<figure class="post-thumbnail">
				<?php the_post_thumbnail( $size ); ?>	
			</figure>
			<?php endif; ?>
		<?php
		}
	}

	/**
		Hien tieu de post
	**/
	if(!function_exists('tich_entry_header')){
		function tich_entry_header(){ ?>
			<?php if(is_single() ) : ?>
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			<?php else: ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>
		<?php
		}
	}
	/**
	tich_entry_meta : lay du lieu post
	**/
	if(!function_exists('tich_entry_meta')){
		function tich_entry_meta(){ ?>
			<?php if(!is_page()) : ?>
				<div class="entry-meta">
					<?php
						printf(__('<span class="author"> Posted by %1$s', 'tich'), get_the_author() );
						printf(__('<span class="date-published"> at %1$s', 'tich'), get_the_date());
						printf(__('<span class="category"> in %1$s ', 'tich'), get_the_category_list(','));
						if(comments_open()):
							echo '<span class="meta-reply">';
							comments_popup_link(
								__('Leave a comment', 'tich'),
								__('One comment', 'tich'),
								__('% comments'),
								__('Read all comments', 'tich')
							);
							echo '</span>';
							endif;
					?>
				</div>
			<?php
			endif;
		}
	}

	/**
		Hien thi noi dung post
	**/
	if(!function_exists('tich_entry_content')){
		function tich_entry_content(){
			if( !is_single() ){
				the_excerpt();
			}
			else{
				the_content();
				/* Phan trang trong single */
				$link_pages = array(
					'before' => __('<p> Page:', 'tich'),
					'after' => '</p>',
					'nextpagelink' => __('Next Page', 'tich'),
					'previouspagelink' => __('Previous Page', 'tich')
				);
				wp_link_pages( $link_pages );
			}
		}
	}

	function tich_readmore(){
		return '<a class="read-more" href="'.get_permalink( get_the_ID() ).'">'.__('...Read More','tich').'</a>';
	}
	add_filter('excerpt_more', 'tich_readmore');

	/**
		tich_entry_tag = hien thi tag
	**/

	if( !function_exists('tich_entry_tag') ){
		function tich_entry_tag(){
			if( has_tag() ){
				echo '<div class="entry_tag">';
				printf(__('Tagged in %1$s', 'tich'), get_the_tag_list('', ','));
			}
		}
	}

	/**
@ Chèn CSS và Javascript vào theme
@ sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end
**/
	function tich_styles() {
	  /*
	   * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
	   * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
	   */
	  wp_register_style( 'main-style', get_template_directory_uri() . '/style.css', 'all' );
	  wp_enqueue_style( 'main-style' );

	  /*
		* Chèn các file CSS của SuperFish Menu
		*/
		wp_register_style( 'superfish-css', get_template_directory_uri() . '/css/superfish.css', 'all' );
		wp_enqueue_style( 'superfish-css' );
		 
		/*
		* Chèn file JS của SuperFish Menu
		*/
		wp_register_script( 'superfish-js', get_template_directory_uri() . '/js/superfish.js', array('jquery') );
		wp_enqueue_script( 'superfish-js' );
		 
		/*
		* Chèn file JS custom.js
		*/
		wp_register_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery') );
		wp_enqueue_script( 'custom-js' );

	}
	add_action( 'wp_enqueue_scripts', 'tich_styles' );

	/**
		Register footer sidebar
	**/
	if(!function_exists('tich_footer')){
		function tich_footer(){
			register_sidebar( array(
				'name' => 'Footer Sidebar 1',
				'id' => 'footer-sidebar-1',
				'description' => 'Appears in the footer area',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				) );
				register_sidebar( array(
				'name' => 'Footer Sidebar 2',
				'id' => 'footer-sidebar-2',
				'description' => 'Appears in the footer area',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				) );
				register_sidebar( array(
				'name' => 'Footer Sidebar 3',
				'id' => 'footer-sidebar-3',
				'description' => 'Appears in the footer area',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				) 
			);
		}
		add_action('widgets_init', 'tich_footer');
	}
	
