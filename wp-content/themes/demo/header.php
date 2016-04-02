<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]> <html <?php language_attributes(); ?>> <![endif]-->
<html lang="<?php language_attributes(); ?>">
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<link rel="profile" href="http://gmgp.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
	<div id="container">
		<div class="logo">
			<?php tich_menu('top-menu') ?>
			<?php tich_header(); ?>
			<?php //tich_menu('primary-menu') ?>
			<div class="nav-menu">
				<?php suppa_implement(1); ?>
			</div>
		</div>

