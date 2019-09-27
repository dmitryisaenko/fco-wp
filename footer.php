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
					<a href="#" alt="Nike">
						<div class="partner-img"
							style="background-image: url(https://fco.com.ua/sites/default/files/styles/original/public/banners/logo_futer_grey.png);"
							onmouseover="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/logo_futer.png)';"
							onmouseout="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/logo_futer_grey.png)';">
						</div>
					</a>
				</div>
			</div>
			<div class="partners">
				<h2>
					Партнери
				</h2>


				<div class="partners-items-wrap">
					<a href="#" alt="Nike">
						<div class="partner-img"
							style="background-image: url(https://fco.com.ua/sites/default/files/styles/original/public/banners/nike-gray.png);"
							onmouseover="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/nike-color.png)';"
							onmouseout="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/nike-gray.png)';">
						</div>
					</a>

					<a href="#" alt="Телеканал Футбол">
						<div class="partner-img"
							style="background-image: url(https://fco.com.ua/sites/default/files/styles/original/public/banners/football-channel-gray.png);"
							onmouseover="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/football-channel-color.png)';"
							onmouseout="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/football-channel-gray.png)';">
						</div>
					</a>

					<a href="#" alt="Петриківське молоко">
						<div class="partner-img"
							style="background-image: url(https://fco.com.ua/sites/default/files/styles/original/public/banners/milk-gray.png);"
							onmouseover="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/milk-color.png)';"
							onmouseout="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/milk-gray.png)';">
						</div>
					</a>

					<a href="#" alt="Стара версія сайту">
						<div class="partner-img"
							style="background-image: url(https://fco.com.ua/sites/default/files/styles/original/public/banners/staryy_sayt_logo_neaktyvne_1.png);"
							onmouseover="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/staryy_sayt_logo_aktyvne.png)';"
							onmouseout="this.style.backgroundImage = 'url(https://fco.com.ua/sites/default/files/styles/original/public/banners/staryy_sayt_logo_neaktyvne_1.png)';">
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="copyright">
			<span class="pull-left">© ФК Олександрія. 2008-2019. Всі права захищено</span>
			<span class="pull-right">
				Розроблено: <a href="isaenko.com.ua" target="_blank" class="lodzhir">
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
