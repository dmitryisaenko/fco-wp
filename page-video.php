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

                <!-- (Из какой(-их) категории, Кол-во постов на странице, Какой категорией подписывать превьюшки)  -->
                <? fco_view_items(258, 16, 258); ?> 

            </div>
        </div>
        <? fco_pagination(); ?>
        <? wp_reset_query(); ?> 
	    <? wp_reset_postdata(); ?>
    </section>
</main>
<? get_footer();?>