<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<? if (is_front_page()) $og_url = home_url(); else $og_url = get_permalink( ); ?>
	<? if (is_front_page()) $og_img = 'http://fco/wp-content/themes/fco/assets/img/logo.png';
		elseif (has_post_thumbnail()) $og_img = get_the_post_thumbnail_url('', 'medium' ); 
		else $og_img = 'http://fco/wp-content/themes/fco/assets/img/logo.png'; ?>
	<meta property="og:url"           content="<?=$og_url ?>" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="<? (is_front_page()) ? bloginfo( 'name' ) : the_title( ); ?>" />
	<meta property="og:description"   content="<? bloginfo( 'description ' ); ?>" />
	<meta property="og:image"         content="<?=$og_img ?>" />
	
	<?php wp_head(); ?>
	<title><?
		if (is_singular()) bloginfo( 'name' ) . " | " . the_title( );
		else bloginfo( 'name' ) . " - офіційний сайт";
	?></title>
</head>

<body >

<!-- Header страницы -->
<header>

<!-- Навигация на моб. устройствах, меньше 576px -->
<span class="toggle-button">
	<div class="menu-bar menu-bar-top"></div>
	<div class="menu-bar menu-bar-middle"></div>
	<div class="menu-bar menu-bar-bottom"></div>
</span>
<div class="menu-wrap">
	<?php wp_nav_menu( [
		'theme_location'  => 'main-menu',
		'menu'            => 2, 
		'container'       => 'div', 
		'container_class' => 'menu-sidebar', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => new Mobile_Walker_Nav_Menu()
	] ); ?>
</div>
<div class="header-top-line">
	<div class="main-logo">
		<a href="<? home_url() ?>">
			<img src="<?=get_template_directory_uri(); ?>/assets/img/logo.png" alt="" />
			<div class="logo-content">
				<h4>ОФІЦІЙНИЙ САЙТ</h4>
				<h3>ФУТБОЛЬНИЙ КЛУБ ОЛЕКСАНДРІЯ</h3>
			</div>
		</a>
	</div>
	<div class="search-and-social-block">
		<div class="search">
			<form class="search-form " action="">
				<input placeholder="Пошук по сайту" class="search-input animate" type="text" id="search-input"
					name="search" value="" size="30" maxlength="128" />
				<button type="submit" id="search-button" name="" value="Застосувати" class="form-button-submit">
					Застосувати
				</button>
			</form>
		</div>
		<div class="social">
			<ul class="social-media-links">
				<li class="facebook">
					<a href="https://www.facebook.com/fcolexandria" target="_blank" rel="nofollow"
						title="Facebook">
						<div class="social-icon"></div>
					</a>
				</li>
				<li class="youtube_channel">
					<a href="http://www.youtube.com/channel/UCHDzcbylV7d69hn1BTnJ_qA/videos" target="_blank"
						rel="nofollow" title="Youtube (Канал)">
						<div class="social-icon"></div>
					</a>
				</li>
				<li class="instagram">
					<a href="http://www.instagram.com/fcolexandria" target="_blank" rel="nofollow"
						title="Instagram">
						<div class="social-icon"></div>
					</a>
				</li>
				<li class="twitter">
					<a href="http://www.twitter.com/FCO1948" target="_blank" rel="nofollow" title="Твітер">
						<div class="social-icon"></div>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="sponsor">
		<a href="<?=get_theme_mod('fco_main_partner_url');?>" taret="_blank">
			<img src="<?=get_theme_mod('fco_main_partner_header_img');?>" alt="Main partner" />
		</a>
	</div>
</div>
<!-- Главная Навигация по сайту -->
<div class="menu-top-wrap">
	<?php wp_nav_menu( [
		'theme_location'  => 'main-menu',
		'menu'            => 2, 
		'container'       => 'nav', 
		'container_class' => 'menu-top', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => '',
	] ); ?>
</div>
</header>

<!-- Основное содержимое страниц -->
<main>
