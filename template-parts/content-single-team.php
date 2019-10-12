<?
$role = get_the_terms(get_the_ID(), 'role')[0];
$player_category = get_the_terms(get_the_ID(), 'player_category')[0];

//age-group: 261 = Main, 263 = U-19, 262 = U-21
//role: 279 = Игрок, 280 = Тренер, 281 = Персонал
//category_player: 282 = Вратарь, 283 = Защитник, 284 = Полузащитник, 285 = Нападающий
if ( $role->term_id !== 279 ) //Если НЕ игрок
{
    // echo 'Если НЕ игрок';
    $title = get_field('member_role');
    
}
elseif ( $player_category->term_id === 282 ) //Если вратарь
{
    // echo 'Если вратарь';
    $weight = '<div class="weight_wrapper"><p class="weight">' .get_field('weight') . 'кг. ' . get_field('height') . 'см.</p></div>';
    $title = $player_category->name;
    $subheader = '
    <div class="team-single-subheader-top">
        <h3>Сезон ' . get_term(get_theme_mod('fco_ex_settings_season'))->name . '</h3>
        <div>' . get_field('matches') . '</div>
        <div>' . get_field('start_sklad') . '</div>
        <div>' . get_field('player_changed') . '</div>
        <div>' . get_field('was_changed') . '</div>
        <div>' . get_field('passed_goals') . '</div>
        <div>' . get_field('yellow_cards') . '</div>
        <div>' . get_field('red_cards') . '</div>
    </div>
    <div class="team-single-subheader-middle-wrap">
        <div class="team-single-subheader-middle team-single-subheader-middle-goalkeepers">
            <div>
                <span>Матчів зіграно</span>
            </div>
            <div><span>Вийшов у стартовому складі</span></div>
            <div><span>Вийшов на заміну</span></div>
            <div><span>Був замінений</span></div>
            <div id="fall-goals"><span>Пропущено голів</span></div>
            <div id="yellow-cards"><span>Отримано жовту картку</span></div>
            <div id="red-cards"><span>Отримано червону картку</span></div>
        </div>
    </div>
    <div class="team-single-subheader-bottom">
        <h3>Всього за ФК "Олександрія"</h3>
        <div>' . get_field('matches_total') . '</div>
        <div>' . get_field('start_sklad_total') . '</div>
        <div>' . get_field('player_changed_total') . '</div>
        <div>' . get_field('was_changed_total') . '</div>
        <div>' . get_field('passed_goals_total') . '</div>
        <div>' . get_field('yellow_cards_total') . '</div>
        <div>' . get_field('red_cards_total') . '</div>
    </div>
    ';
}
else //Если игрок, но НЕ вратарь
{
    // echo 'Если игрок, но НЕ вратарь';
    $weight = '<div class="weight_wrapper"><p class="weight">' .get_field('weight') . 'кг. ' . get_field('height') . 'см.</p></div>';
    $title = $player_category->name;
    $subheader = '
    <div class="team-single-subheader-top">
        <h3>Сезон ' . get_term(get_theme_mod('fco_ex_settings_season'))->name . '</h3>
        <div>' . get_field('matches') . '</div>
        <div>' . get_field('start_sklad') . '</div>
        <div>' . get_field('player_changed') . '</div>
        <div>' . get_field('was_changed') . '</div>
        <div>' . get_field('goals') . '</div>
        <div>' . get_field('goals_penalti') . '</div>
        <div>' . get_field('autogoals') . '</div>
        <div>' . get_field('yellow_cards') . '</div>
        <div>' . get_field('red_cards') . '</div>
    </div>
    <div class="team-single-subheader-middle-wrap">
        <div class="team-single-subheader-middle">
            <div><span>Матчів зіграно</span></div>
            <div><span>Вийшов у стартовому складі</span></div>
            <div><span>Вийшов на заміну</span></div>
            <div><span>Був замінений</span></div>
            <div><span>Забито голів</span></div>
            <div><span>Забито голів з пенальті</span></div>
            <div><span>Забито автоголів</span></div>
            <div id="yellow-cards"><span>Отримано жовту картку</span></div>
            <div id="red-cards"><span>Отримано червону картку</span></div>
        </div>
    </div>
    <div class="team-single-subheader-bottom">
        <h3>Всього за ФК "Олександрія"</h3>
        <div>' . get_field('matches_total') . '</div>
        <div>' . get_field('start_sklad_total') . '</div>
        <div>' . get_field('player_changed_total') . '</div>
        <div>' . get_field('was_changed_total') . '</div>
        <div>' . get_field('goals_total') . '</div>
        <div>' . get_field('goals_penalti_total') . '</div>
        <div>' . get_field('autogoals_total') . '</div>
        <div>' . get_field('yellow_cards_total') . '</div>
        <div>' . get_field('red_cards_total') . '</div>
    </div>
    ';
}

// echo '<pre>';
// print_r(get_the_terms(get_the_ID(), 'age-group'));
// print_r($role);
// echo '</pre>';

//Вычисляем возраст участника команды:
function getAge($date) {
    return intval(date('Y', time() - strtotime($date))) - 1970;
}


?>
<div class="team-single-header-wrapper">
    <div class="team-single-header">
        <div class="team-single-header-content">
            <p class="name"><?=get_field('member_name')?></p>
            <p class="surname"><?=get_field('member_familyname')?></p>
            <p class="title"><?=$title?></p>
            <p class="birthday">Дата народження (вік)</p>
            <p class="birthday-date"><?=get_field('birthday')?> (<?=getAge(get_field('birthday'))?>)</p>
            <?=$weight?>
            <p class="civil-title">Громадянство</p>
            <p class="civil"><?=get_field('citizenship')?></p>
        </div>
        <div class="team-single-header-img">
            <img class="img-responsive" src="<?=get_field('member_photo_big')?>" alt="">
        </div>
    </div>
    <div id="nav-previous" class="team-single-header-nav_perv">
            <a href="#">Попередній</a>
        </div>
        <div id="nav-next" class="team-single-header-nav_next">
            <a href="#">Наступний</a>
        </div>
    </div>
    <div class="team-single-subheader">
        <?=$subheader?>
    </div>