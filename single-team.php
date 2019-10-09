<? acf_form_head();?>
<? get_header();?>
<? the_post(); ?>
<?
$age_group = "";
$age_group_id = get_the_terms(get_the_ID(), 'age-group')[0]->term_id;
if ($age_group_id === 262) $age_group = " U-21";
elseif ($age_group_id === 263) $age_group = " U-19";

?>
<!-- Основное содержимое страниц -->
<main>
    <div class="breadcrumb-wrapper">
        <div class="breadcrumb"><a href="/">Головна</a> / <span>Команда / ФК Олександрія<?=$age_group?> / <?=get_the_terms(get_the_ID(), 'role')[0]->name?></span> </div>
    </div>
    <section class="main-container container">
        
            
            <? get_template_part('template-parts/content-single-team'); ?>
        
            
        <section class="main-content media_991">
            <div class="central-content">
                <div class="team-central-content">
                    <? the_content() ?>
                </div>
            </div>
            <? get_sidebar('team'); ?>
        </section>
        <div class="ads-block-top">
            <a href="<?=get_theme_mod('fco_load_url_shop');?>" taret="_blank">
                <img src="<?=get_theme_mod('fco_load_baner_shop');?>" alt="">
            </a>
        </div>
    </section>
</main>
<? get_footer(); ?>