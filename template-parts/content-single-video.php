<!-- Основное содержимое страниц -->
<main>
	<div class="breadcrumb-wrapper">
        <div class="breadcrumb"><a href="<?=home_url() ?>">Головна</a> / <span><span>Медіа</span> / Відео галерея / Відео</span></div>
	</div>
	<section class="main-container container">
	<?php while ( have_posts() ) : 	the_post(); ?>
			<div class="news-single-header">
				<div class="news-single-header-logo">
                    <div class="youtube-video-frame">
                        <iframe class="youtube-video" src="https://www.youtube.com/embed/<?=the_field('youtube_link'); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
				</div>
				<div class="news-single-subheader news-single-subheader-media-item">
					<div class="news-single-subheader-title news-single-subheader-title-media-item">
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
							<?=get_the_category_by_ID(258); ?>
							</div>
						</div>
						<div class="bottom-line">
							<a class="facebook_icon facebook_icon-media-item social-icon-item" target="_blank" href="http://www.facebook.com/sharer.php?u=<? the_permalink( ); ?>&t=<? the_title(); ?>"></a>
							<a class="twitter_icon twitter_icon-media-item social-icon-item" target="_blank" href="http://twitter.com/share?text=<? the_title(); ?>. Дізнатися більше: &url=<? the_permalink( ); ?>"></a>
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
			<h2 class="block-title"><span>Дивіться</span> також</h2>
			<div class="news-container">
    
                <!-- (Из какой(-их) категории, Кол-во постов на странице, Какой категорией подписывать превьюшки, Какой пост исключить)  -->
                <? fco_view_items(258, 4, 258, get_the_ID()); ?>
                <? wp_reset_query(); ?> 
	            <? wp_reset_postdata(); ?>

            </div>
		</section>
	</section>
	<div class="ads-block-top">
		<a href="<?=get_theme_mod('fco_load_url_shop');?>" taret="_blank">
			<img src="<?=get_theme_mod('fco_load_baner_shop');?>" alt="">
		</a>
	</div>
</main>