<!-- Основное содержимое страниц -->
<main>
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb"><a href="<?=home_url(); ?>">Головна</a> / <span><span>Команда</span> / ФК "Олександрія" / Тренери</span></div>
        </div>

        <section class="main-container container">
            <h1 class="page-header">ФК "Олександрія"</h1>
            <div class="team-header">
            
                <ul>
                    <li><a href="<?=get_preUrlLink()?>/players">Гравці</a></li>
                    <li><a href="#" class="active">Тренери</a></li>
                    <li><a href="<?=get_preUrlLink()?>/personnel">Персонал</a></li>
                </ul>
            </div>
            <div class="team-block">
                <div class="w100 team-block-items-wrapper">
                    <? fco_member_items(get_parentName(), 'coaches') ?>
                </div>
            </div>
           
        </section>
        <div class="ads-block-top">
            <a href="<?=get_theme_mod('fco_load_url_shop');?>" taret="_blank">
                <img src="<?=get_theme_mod('fco_load_baner_shop');?>" alt="">
            </a>
        </div>

    </main>