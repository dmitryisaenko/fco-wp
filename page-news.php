<? get_header();?>
<!-- Основное содержимое страниц -->
<main>
    <div class="breadcrumb-wrapper">
        <div class="breadcrumb"><a href="<?=home_url() ?>">Головна</a> / <span><span>Новини</span> клубу</span></div>
    </div>
    <section class="news-block" id="single-news-page">
        <h2 class="block-title"><span>Новини</span> клубу</h2>
        <div class="view-news view-news-single-page">
            <?
                $count_posts = wp_count_posts()->publish;
                
            ?>
            <div class="view-numbers-of-news">
                <?
                    $page = get_query_var('paged') ?: 1;
                    $posts_per_page = 16;
                    $news_end = $page * $posts_per_page;
                    $news_start = $news_end - $posts_per_page + 1;
                    $news_end = ($news_end > $count_posts) ? $count_posts : $news_end;
                    $paged = $news_start . '-' . $news_end;
                ?>
                <?=$paged;?> з <?=$count_posts; ?> новин
            </div>
            <form action="">
                <div class="news-view-filters">
                    <div class="date-day news-view-filter-item">
                        <select name="date-day" id="date-day">
                            <option value="0">День</option>
                        </select>
                    </div>
                    <div class="date-month news-view-filter-item">
                        <select name="date-month" id="date-month">
                            <option value="0">Місяць</option>
                        </select>
                    </div>
                    <div class="date-year news-view-filter-item">
                        <select name="date-year" id="date-year">
                            <option value="0">Рік</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>


        <div class="news-container">
            <div class="w100 news-items-wrapper">

                <!-- (Из какой(-их) категории, Кол-во постов на странице, Какой категорией подписывать превьюшки)  -->
                <? fco_view_items("1,257,258", 16, 1); ?> 
                
            </div>
        </div>
        <? fco_pagination(); ?>
        <? wp_reset_query(); ?> 
	    <? wp_reset_postdata(); ?>
    </section>
</main>
<? get_footer();?>