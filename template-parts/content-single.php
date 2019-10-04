<!-- Основное содержимое страниц -->
<main>
	<div class="breadcrumb-wrapper">
		<div class="breadcrumb"><a href="/">Головна</a> / <span><span>Новини</span></div>
	</div>
	<section class="main-container container">
	<?php while ( have_posts() ) : 	the_post(); ?>
			<div class="news-single-header">
				<div class="news-single-header-logo">
				<?php the_post_thumbnail(); ?>
				</div>
				<div class="news-single-subheader">
					<div class="news-single-subheader-title">
						<h1>
						<? the_title(); ?>
						</h1>
					</div>
					<div class="news-single-subheader-info">
						<div class="top-line">
							<div class="news-single-subheader-info-date">
							<?=get_the_date('d.m.Y G:i'); ?>
							</div>
							<div class="news-single-subheader-info-news_title">
							<?=get_the_category_by_ID(1); ?>
							</div>
						</div>
						<div class="bottom-line">
							<a class="facebook_icon social-icon-item" target="_blank" href="http://www.facebook.com/sharer.php?u=<? the_permalink( ); ?>&t=<? the_title(); ?>"></a>
							<a class="twitter_icon social-icon-item" target="_blank" href="http://twitter.com/share?text=<? the_title(); ?>. Дізнатися більше: &url=<? the_permalink( ); ?>"></a>
						</div>

					</div>
				</div>
			</div>
		<section class="main-content media_991">
			<div class="central-content central-content-news-single">
				<? the_content(); ?>
			</div>
	<? endwhile; ?>
			<? get_sidebar(); ?>
		</section>
		<section class="news-block">
			<h2 class="block-title"><span>Читайте</span> також</h2>
			<div class="news-container">
    
                <!-- (Из какой(-их) категории, Кол-во постов на странице, Какой категорией подписывать превьюшки, Какой пост исключить)  -->
                <? fco_view_items(1, 4, 1, get_the_ID()); ?>
                <? wp_reset_query(); ?> 
	            <? wp_reset_postdata(); ?>

            </div>
		</section>
	</section>
	<div class="ads-block-top">
	<a href="<?=get_theme_mod('fco_load_url_shop');?>" target="_blank">
		<img src="<?=get_theme_mod('fco_load_baner_shop');?>" alt="fco internet shop">
	</a>
</div>
</main>