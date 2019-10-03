</main>

<!-- Подвал сайта -->
<footer>
	<section class="social-block">
		<div class="social-item">
			<a href="https://www.facebook.com/fcolexandria" target="_blank" rel="nofollow">
				<div class="social-item-title">
					Facebook
				</div>
				<div class="social-item-content">
					<div class="social-item-icon social-item-icon-fb">

					</div>
					<div class="social-item-link">
						@fcolexandria
					</div>
				</div>
			</a>
		</div>
		<div class="social-item">
			<a href="https://www.youtube.com/channel/UCHDzcbylV7d69hn1BTnJ_qA/videos" target="_blank"
				rel="nofollow">
				<div class="social-item-title">
					Youtube
				</div>
				<div class="social-item-content">
					<div class="social-item-icon social-item-icon-yt">

					</div>
					<div class="social-item-link">
						@fcolexandriaTV
					</div>
				</div>
			</a>
		</div>
		<div class="social-item">
			<a href="https://www.instagram.com/fcolexandria" target="_blank" rel="nofollow">
				<div class="social-item-title">
					Instagram
				</div>
				<div class="social-item-content">
					<div class="social-item-icon social-item-icon-inst">

					</div>
					<div class="social-item-link">
						fcolexandria
					</div>
				</div>
			</a>
		</div>
		<div class="social-item">
			<a href="https://twitter.com/FCO1948" target="_blank" rel="nofollow">
				<div class="social-item-title">
					Twitter
				</div>
				<div class="social-item-content">
					<div class="social-item-icon social-item-icon-tw">

					</div>
					<div class="social-item-link">
						@FCO1948
					</div>
				</div>
			</a>
		</div>
	</section>
	<div class="menu-bottom-wrap">
	<?php wp_nav_menu( [
		'theme_location'  => 'main-menu',
		'menu'            => 2, 
		'container'       => 'nav', 
		'container_class' => 'menu-bottom', 
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
	<section class="footer-wrap">
		<div class="footer">
			<div class="general-partner">
				<h2>
					Генеральний спонсор
				</h2>
				<div class="general-partner-img">
					<a href="<?=get_theme_mod('fco_main_partner_url');?>" taret="_blank" alt="General Partner">
						<div class="partner-img"
							style="background-image: url(<?=get_theme_mod('fco_main_partner_footer_nonactive_img');?>);"
							onmouseover="this.style.backgroundImage = 'url(<?=get_theme_mod('fco_main_partner_footer_active_img');?>)';"
				  			onmouseout="this.style.backgroundImage = 'url(<?=get_theme_mod('fco_main_partner_footer_nonactive_img');?>)';">
						</div>
					</a>
				</div>
			</div>
			<div class="partners">
				<h2>
					Партнери
				</h2>
				<div class="partners-items-wrap">
			<?	
				$sponsor_string = get_theme_mod('fco_sponsors_order');
				if (explode(',', $sponsor_string)) $sponsor_order = explode(',', $sponsor_string);
				else $sponsor_order = [1,2,3,4];
				// print_r($sponsor_order).'<br>';
				for ($i=0; $i < 4; $i++) { 
					$sponsor_number =  $sponsor_order[$i];
					$url = "fco_sponsors_footer_" . $sponsor_order[$i] . "_url";
					$alturl = "fco_sponsors_footer_" . $sponsor_order[$i] . "_alturl";
					$nonactiveImgUrl = "fco_sponsors_footer_" . $sponsor_order[$i] . "_nonactive_img";
					$activeImgUrl = "fco_sponsors_footer_" . $sponsor_order[$i] . "_active_img";
					// echo $url.'<br>';
			?>
					<a href="<?=get_theme_mod($url);?>" taret="_blank" alt="<?=get_theme_mod($alturl);?>">
						<div class="partner-img"
							style="background-image: url(<?=get_theme_mod($nonactiveImgUrl);?>);"
							onmouseover="this.style.backgroundImage = 'url(<?=get_theme_mod($activeImgUrl);?>)';"
							onmouseout="this.style.backgroundImage = 'url(<?=get_theme_mod($nonactiveImgUrl);?>)';">
						</div>
					</a>
			<?
				;}
			?>
				</div>
			</div>
		</div>
		<div class="copyright">
			<span class="pull-left">© ФК Олександрія. 2008-2019. Всі права захищено</span>
			<span class="pull-right">
				Розроблено: <a href="http://isaenko.com.ua/rd/from-clients-sites-link.php" target="_blank">
					IDV-man
				</a>
			</span>
		</div>

	</section>
</footer>

<!-- Кнопка возврата наверх -->
<div id="back-top" class="back-top"></div>

	

<?php wp_footer(); ?>

</body>
</html>
