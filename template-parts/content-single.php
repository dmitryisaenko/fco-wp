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
			<?php
                global $post;

                $myposts = get_posts( 'numberposts=4&offset=1&category=1,257,258' );

                foreach( $myposts as $post ):
                    {
                    $category = get_the_category();
                    setup_postdata( $post );
                    
                    if (get_post_format() === "video") $postFormat = 'youtube-news';
                    elseif (get_post_format() === "gallery") $postFormat = 'foto-news';
                    else $postFormat = 'self-news';
                    }
                ?>
                    <div class="w23 news-item">
                        <div class="news-item-media-block">
                            <div class="news-item-image <?=$postFormat;?>">
                                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <? if (get_post_format() === "video") {
                                        $youtube_id = get_field('youtube_link');
                                        $url = "<img src='https://img.youtube.com/vi/$youtube_id/mqdefault.jpg' style='height:165px;'>";
                                        echo $url;
                                    }
                                    
                                        else {
                                            if (has_post_thumbnail()){
                                                the_post_thumbnail( 'fco-news-logo-300px' );
                                            }
                                            else {
                                                echo "<img src='https://picsum.photos/300/200'>";
                                            }
                                        }

                                    
                                    ?>
                                </a>
                            </div>
                            <div class="news-item-meta">
                                <div class="news-date">
                                    <?=get_the_date('d.m.Y'); ?>
                                </div>
                                <div class="news-category">
                                    <?=get_the_category_by_ID(1); ?>
                                </div>
                            </div>
                        </div>
                        <div class="news-item-title">
                            <span>
                                <a href="<?php the_permalink() ?>"
                                    title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            </span>
                        </div>
                    </div>

                <?php endforeach; ?>
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