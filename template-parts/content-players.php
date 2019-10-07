<!-- Основное содержимое страниц -->
<main>
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb"><a href="<?=home_url(); ?>">Головна</a> / <span><span>Команда</span> / ФК "Олександрія" / Гравці</span></div>
        </div>
        <section class="main-container container">
            <h1 class="page-header"><?=get_post(get_post()->post_parent)->post_title;?></h1>
            <div class="team-header">
                <ul>
                    <li><a href="#" class="active">Гравці</a></li>
                    <li><a href="<?=get_preUrlLink()?>/coaches">Тренери</a></li>
                    <li><a href="<?=get_preUrlLink()?>/personnel">Персонал</a></li>
                </ul>
            </div>
            <div class="team-block">
                <div class="team-block-title w25">
                    <h3>Воротарі</h3>
                </div>
                <div class="w75 team-block-items-wrapper">
                    <? fco_member_items(get_parentName(), 'players', 'goalkeeper', 31) ?>
                </div>
            </div>
            <div class="team-block">
                <div class="team-block-title w25">
                    <h3>Захисники</h3>
                </div>
                <div class="w75 team-block-items-wrapper">
                    <? fco_member_items(get_parentName(), 'players', 'defender', 31) ?>
                </div>
            </div>
            <div class="team-block">
                <div class="team-block-title w25">
                    <h3>Півзахисники</h3>
                </div>
                <div class="w75 team-block-items-wrapper">
                    <? fco_member_items(get_parentName(), 'players', 'midfielder', 31) ?>
                </div>
            </div>
            <div class="team-block">
                <div class="team-block-title w25">
                    <h3>Нападники</h3>
                </div>
                <div class="w75 team-block-items-wrapper">
                    <? fco_member_items(get_parentName(), 'players', 'striker', 31) ?>
                </div>
            </div>
        </section>
        <div class="ads-block-top">
            <a href="<?=get_theme_mod('fco_load_url_shop');?>" taret="_blank">
                <img src="<?=get_theme_mod('fco_load_baner_shop');?>" alt="">
            </a>
        </div>

    </main>