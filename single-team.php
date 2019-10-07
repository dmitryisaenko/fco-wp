<? get_header();?>

<?
$role = get_the_terms(get_the_ID(), 'role')[0]->term_id;
$player_category = get_the_terms(get_the_ID(), 'player_category')[0]->term_id;

//age-group: 261 = Main, 263 = U-19, 262 = U-21
//role: 279 = Игрок, 280 = Тренер, 281 = Персонал
//category_player: 282 = Вратарь, 283 = Защитник, 284 = Полузащитник, 285 = Нападающий
if ( $role !== 279 ) //Если НЕ игрок
{
    echo 'Если НЕ игрок';
}
elseif ( $player_category === 282 ) //Если вратарь
{
    echo 'Если вратарь';
}
else //Если игрок, но НЕ вратарь
{
    echo 'Если игрок, но НЕ вратарь';
}

echo '<pre>';
print_r(get_the_terms(get_the_ID(), 'age-group'));
echo '</pre>';

?>

<?php
// get_template_part('template-parts/content-team-single', get_post_format()); ?> -->

<? get_footer(); ?>