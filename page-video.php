<? get_header();?>
<!-- Основное содержимое страниц -->
<main>
    <div class="breadcrumb-wrapper">
        <div class="breadcrumb"><a href="/">Головна</a> / <span><span>Медіа</span> / Відео галерея</span></div>
    </div>
    <section class="news-block" id="single-news-page">
        <h2 class="block-title"><span>Відео</span> галерея</h2>


        <div class="news-container">
            <div class="w100 news-items-wrapper">

                <?php
                global $post;

                $myposts = get_posts( 'numberposts=16&category=258' );

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
                                        $url = "<img src='https://img.youtube.com/vi/$youtube_id/mqdefault.jpg'>";
                                        echo $url;
                                    }
                                    
                                        else {
                                            if (has_post_thumbnail()){
                                                the_post_thumbnail( 'fco-news-logo-300px' );
                                            }
                                            else {
                                                echo "<img src='". get_template_directory_uri() . "/assets/img/no-photo-available.jpg' >";
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
                                <?=get_the_category_by_ID(258); ?>
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


        </div>
    </section>
    <div class="pagination-wrapper">
        <ul class="pagination">
            <li class="pager-first"><a title="До першої сторінки" href="/news">« перша</a></li>
            <li class="prev"><a title="На попередню сторінку" href="/news?page=2">‹ попередня</a></li>
            <li><a title="Перейти до сторінки 1" href="/news">1</a></li>
            <li><a title="Перейти до сторінки 2" href="/news?page=1">2</a></li>
            <li><a title="Перейти до сторінки 3" href="/news?page=2">3</a></li>
            <li class="active"><span>4</span></li>
            <li><a title="Перейти до сторінки 5" href="/news?page=4">5</a></li>
            <li><a title="Перейти до сторінки 6" href="/news?page=5">6</a></li>
            <li><a title="Перейти до сторінки 7" href="/news?page=6">7</a></li>
            <li><a title="Перейти до сторінки 8" href="/news?page=7">8</a></li>
            <li><a title="Перейти до сторінки 9" href="/news?page=8">9</a></li>
            <li class="pager-ellipsis disabled"><span>…</span></li>
            <li class="next"><a title="До наступної сторінки" href="/news?page=4">наступна ›</a></li>
            <li class="pager-last"><a title="До останньої сторінки" href="/news?page=45">остання »</a></li>
        </ul>
    </div>
</main>
<? get_footer();?>