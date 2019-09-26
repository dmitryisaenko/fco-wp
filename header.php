<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
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
	<div class="menu-sidebar">
		<ul class="menu">
			<li class='menu-item'><a href="/">Головна</a></li>
			<li class='menu-item current-menu-item'><a href="/news.html">Новини</a></li>
			<li class="menu-item menu-item-has-children">
				<a href="#">Клуб</a>
				<span class="sidebar-menu-arrow"></span>
				<ul class="sub-menu">
					<li class="menu-item"><a href="/history.html">Історія</a></li>
					<li class="menu-item current-menu-item"><a href="/symbolics.html">Символіка</a></li>
					<li class="menu-item"><a href="/infrastructure.html">Інфраструктура</a></li>
					<li class="menu-item"><a href="/leaderships.html">Керівництво</a></li>
					<li class="menu-item"><a href="/pres-sluzhba.html">Прес-служба</a></li>
					<li class="menu-item"><a href="/richniy-zvit.html">Річний звіт</a></li>
					<li class="menu-item"><a href="/contacts.html">Контакти</a></li>
				</ul>
			</li>
			<li class="menu-item menu-item-has-children">
				<a href="#">Команда</a>
				<span class="sidebar-menu-arrow"></span>
				<ul class="sub-menu">
					<li class="menu-item"><a href="/team-main.html">ФК Олександрія</a></li>
					<li class="menu-item"><a href="/team-main.html">ФК Олександрія U-21</a></li>
					<li class="menu-item"><a href="/team-main.html">ФК Олександрія U-19</a></li>
				</ul>
			</li>
			<li class="menu-item menu-item-has-children">
				<a href="#">Матчі</a>
				<span class="sidebar-menu-arrow"></span>
				<ul class="sub-menu">
					<li class="menu-item"><a href="/matches-calendar.html">Календар</a></li>
					<li class="menu-item"><a href="/matches-standings.html">Турнирна таблиця</a></li>
					<li class="menu-item"><a href="/matches-scorers.html">Бомбардири</a></li>
					<li class="menu-item"><a href="/matches-exluded_players.html">Відсторонення</a></li>
				</ul>
			</li>
			<li class="menu-item menu-item-has-children">
				<a href="/media.html">Медіа</a>
				<span class="sidebar-menu-arrow"></span>
				<ul class="sub-menu">
					<li class="menu-item"><a href="/media-foto.html">Фото галерея</a></li>
					<li class="menu-item current-menu-item"><a href="/media-video.html">Відео галерея</a></li>
				</ul>
			</li>
			<li class="menu-item"><a href="shop.fco.com.ua">Магазин</a></li>
		</ul>
	</div>
</div>
<div class="header-top-line">
	<div class="main-logo">
		<a href="#">
			<img src="img/logo.png" alt="" />
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
		<a href="#">
			<img src="img/sponsor.png" alt="" />
		</a>
	</div>
</div>
<!-- Главная Навигация по сайту -->
<div class="menu-top-wrap">
	<nav class="menu-top">
		<ul class="menu">
			<li class='menu-item'><a href="/">Головна</a></li>
			<li class='menu-item current-menu-item'><a href="/news.html">Новини</a></li>
			<li class="menu-item menu-item-has-children">
				<a href="#">Клуб</a>
				<span class="sidebar-menu-arrow"></span>
				<ul class="sub-menu">
					<li class="menu-item"><a href="/history.html">Історія</a></li>
					<li class="menu-item current-menu-item"><a href="/symbolics.html">Символіка</a></li>
					<li class="menu-item"><a href="/infrastructure.html">Інфраструктура</a></li>
					<li class="menu-item"><a href="/leaderships.html">Керівництво</a></li>
					<li class="menu-item"><a href="/pres-sluzhba.html">Прес-служба</a></li>
					<li class="menu-item"><a href="/richniy-zvit.html">Річний звіт</a></li>
					<li class="menu-item"><a href="/contacts.html">Контакти</a></li>
				</ul>
			</li>
			<li class="menu-item menu-item-has-children">
				<a href="#">Команда</a>
				<span class="sidebar-menu-arrow"></span>
				<ul class="sub-menu">
					<li class="menu-item"><a href="/team-main.html">ФК Олександрія</a></li>
					<li class="menu-item"><a href="/team-main.html">ФК Олександрія U-21</a></li>
					<li class="menu-item"><a href="/team-main.html">ФК Олександрія U-19</a></li>
				</ul>
			</li>
			<li class="menu-item menu-item-has-children">
				<a href="#">Матчі</a>
				<span class="sidebar-menu-arrow"></span>
				<ul class="sub-menu">
					<li class="menu-item"><a href="/matches-calendar.html">Календар</a></li>
					<li class="menu-item"><a href="/matches-standings.html">Турнирна таблиця</a></li>
					<li class="menu-item"><a href="/matches-scorers.html">Бомбардири</a></li>
					<li class="menu-item"><a href="/matches-exluded_players.html">Відсторонення</a></li>
				</ul>
			</li>
			<li class="menu-item menu-item-has-children">
				<a href="/media.html">Медіа</a>
				<span class="sidebar-menu-arrow"></span>
				<ul class="sub-menu">
					<li class="menu-item"><a href="/media-foto.html">Фото галерея</a></li>
					<li class="menu-item current-menu-item"><a href="/media-video.html">Відео галерея</a></li>
				</ul>
			</li>
			<li class="menu-item"><a href="shop.fco.com.ua">Магазин</a></li>
		</ul>
	</nav>
</div>
</header>

<!-- Основное содержимое страниц -->
<main>
