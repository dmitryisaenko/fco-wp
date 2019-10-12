<? get_header();?>
<? the_post(); ?>
<?
$age_group = "";
$age_group_id = get_the_terms(get_the_ID(), 'age-group')[0]->term_id;
if ($age_group_id === 262) $age_group = " U-21";
elseif ($age_group_id === 263) $age_group = " U-19";
$the_ID = get_the_ID();

// echo '<pre>';
// print_r(get_field('opp_select')->ID);
// echo '<pre>';
?>
<!-- Основное содержимое страниц -->
<main>
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb"><a href="/">Головна</a> / <span><span>Матчі </span> / Календар / <? the_title(); ?></span></div>
        </div>

        <section class="main-container container">
            <div class="info-block info-block__match-center">
                <div class="info-block-container info-block-container__wo-top-border info-block-container__wo-top-border--match-center">
                    <div class="info-block__body">
                        <div class="info-block__logo">
                            <div class="info-block__logo--tur">
                                <?=get_field('tour_number')?>-й тур<br>сезон <?=get_the_terms($the_ID, 'season')[0]->name?>
                            </div>
                            <img src="img/upl.png" alt="">
                        </div>
                        <div class="info-block__meta">
                            <span class="info-block__date">
                                <?=get_field('tour_date')?>р.
                            </span>
                            <span class="info-block__stadium">
                            <?=get_the_terms($the_ID, 'stadium')[0]->name?>
                            </span>

                        </div>
                        <div class="info-block__kickoff-container">
                            <?
                            $fco_goals = get_field('fco-successful-goals');
                            $opp_goals = get_field('opp-successful-goals');
                            
                            //Список голов в хедере
                            function goals_list_header($team){
                                ($team === 'fco') ? $team = 'fco_goals' : $team = 'opp_goals';
                                if (get_field('fco_goals')) {
                                    $result = '';
                                    $goals = explode("\n", str_replace("\r", "", get_field($team)));
                                    foreach ($goals as $goal){
                                        $result .= '<span class="info-block__team--goal-player">' . $goal . '</span>';
                                    }
                                    return $result;
                                }
                            }
                            //Список голов в теле
                            function goals_list_body($team){
                                ($team === 'fco') ? $team = 'fco_goals' : $team = 'opp_goals';
                                $result = '';
                                if (get_field($team)) {
                                    $goals = explode("\n", str_replace("\r", "", get_field($team)));
                                    foreach ($goals as $goal){
                                        $result .= '<div class="team-block__item"><div class="team-block__item--player">' . $goal . '</div></div>';
                                    }
                                }
                                return $result;
                            }

                            //Предупреждения
                            function warning_list($team){
                                ($team === 'fco') ? $team = 'fco_warning' : $team = 'opp_warning';
                            }

                            //Получаем ID для вывода лого оппонента:
                            $term_id = get_post_meta ( get_field('opp_select')->ID, 'fclub_logo', true );

                            //Выводим шапку исходя из того, где играла Александрия - дома или на выезде
                            if (get_field('tour_is_home')) {
                                echo '
                                <div class="info-block__team-container info-block__team-container__match-center">
                                    <div class="info-block__team-title--wrapper">
                                        <span class="info-block__team-title info-block__team-title--uppercase info-block__team-title--home">
                                            Олександрія
                                        </span>
                                        ' . goals_list_header('fco') . '
                                    </div>
                                    <div class="info-block__team-img">
                                        <img src="' . get_template_directory_uri() . '/assets/img/olexandriya.png"
                                            alt="' . get_bloginfo('name') . '">
                                    </div>
                                </div>
                                <div class="info-block__score">
                                    <span>' . $fco_goals .'</span>
                                    <span>' . $opp_goals .'</span>
                                </div>
                                <div class="info-block__team-container info-block__team-container__match-center">
                                    <div class="info-block__team-img">
                                        ' . wp_get_attachment_image($term_id, [64,64], '', ['alt' => get_field('opp_select')->post_title]) . '
                                    </div>
                                    <div class="info-block__team-title--wrapper">
                                        <span class="info-block__team-title info-block__team-title--uppercase info-block__team-title--away">
                                        ' . get_field('opp_select')->post_title . '
                                    </span>
                                    ' . goals_list_header('opp') . '
                                    </div>
                                </div>';
                                }
                            else {
                                echo '
                                <div class="info-block__team-container info-block__team-container__match-center">
                                    <div class="info-block__team-title--wrapper">
                                        <span class="info-block__team-title info-block__team-title--uppercase info-block__team-title--home">
                                        ' . get_field('opp_select')->post_title . '
                                        </span>
                                        ' . goals_list_header('opp') . '
                                    </div>
                                    <div class="info-block__team-img">
                                        ' . wp_get_attachment_image($term_id, [64,64], '', ['alt' => get_field('opp_select')->post_title]) . '
                                    </div>
                                </div>
                                <div class="info-block__score">
                                    <span>' . $opp_goals .'</span>
                                    <span>' . $fco_goals .'</span>
                                </div>
                                <div class="info-block__team-container info-block__team-container__match-center">
                                    <div class="info-block__team-img">
                                    <img src="' . get_template_directory_uri() . '/assets/img/olexandriya.png"
                                    alt="' . get_bloginfo('name') . '">
                                    </div>
                                    <div class="info-block__team-title--wrapper">
                                        <span class="info-block__team-title info-block__team-title--uppercase info-block__team-title--away">
                                        Олександрія
                                        </span>
                                        ' . goals_list_header('fco') . '
                                    </div>
                                </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="macth-content-block">
                <div class="matches-center__horizontal-tabs-list tabs">
                    <ul class="horizontal-tabs-list tabs__caption">
                        <li class="active">Протокол</li>
                        <li>Звіт</li>
                        <li>Фото</li>
                        <li>Відео</li>
                    </ul>

                    <div id="match-protocol" class="tabs__content active">
                        <div class="group-protocol">
                            <div class="group-protocol__item">
                                <h3>
                                    <span>Голи</span>
                                </h3>
                                <div class="team-block-wrapper">
                                    <div class="team-block">
                                        <div class="team-block__team-name">
                                            <?
                                                if (get_field('tour_is_home')) echo 'Олександрія';
                                                else echo get_field('opp_select')->post_title;
                                            ?>
                                        </div>
                                        <div class="team-block__item">
                                            <?
                                            if (get_field('tour_is_home')) echo goals_list_body('fco');
                                            else echo goals_list_body('opp');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="team-block">
                                        <div class="team-block__team-name">
                                            <?
                                                if (get_field('tour_is_home')) echo get_field('opp_select')->post_title;
                                                else echo 'Олександрія';
                                            ?>
                                        </div>
                                        <?
                                        if (get_field('tour_is_home')) echo goals_list_body('opp');
                                        else echo goals_list_body('fco');
                                        
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="group-protocol__item">
                                <h3>
                                    <span>Попередження</span>
                                </h3>
                                <div class="team-block-wrapper">
                                    <div class="team-block">
                                        <div class="team-block__team-name">
                                            Ворскла
                                        </div>
                                        <div class="team-block__item">
                                            <div class="team-block__item--player">
                                                Баєнко Володимир   24
                                            </div>
                                            <div class="team-block__item--player_card">
                                                <span class="warning-card warning-card__yellow"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team-block">
                                        <div class="team-block__team-name">
                                            Олександрія
                                        </div>
                                        <div class="team-block__item">
                                            <div class="team-block__item--player">
                                                Пашаєв Павло
                                            </div>
                                            <div class="team-block__item--goals_time">
                                                34
                                            </div>
                                            <div class="team-block__item--player_card">
                                                <span class="warning-card warning-card__yellow"></span>
                                            </div>
                                        </div>
                                        <div class="team-block__item">
                                            <div class="team-block__item--player">
                                                Дубра Каспарс
                                            </div>
                                            <div class="team-block__item--goals_time">
                                                47
                                            </div>
                                            <div class="team-block__item--player_card">
                                                <span class="warning-card warning-card__yellow"></span>
                                            </div>
                                        </div>
                                        <div class="team-block__item">
                                            <div class="team-block__item--player">
                                                Довгий Олексій
                                            </div>
                                            <div class="team-block__item--goals_time">
                                                92
                                            </div>
                                            <div class="team-block__item--player_card">
                                                <span class="warning-card warning-card__yellow"></span>
                                            </div>
                                        </div>
                                        <div class="team-block__item">
                                            <div class="team-block__item--player">
                                                Бухал Гліб
                                            </div>
                                            <div class="team-block__item--goals_time">
                                                93
                                            </div>
                                            <div class="team-block__item--player_card">
                                                <span class="warning-card warning-card__yellow"></span>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="group-protocol">
                            <div class="group-protocol__item">
                                <h3>
                                    <span>Стартовий склад</span>
                                </h3>
                                <div class="team-block-wrapper">
                                    <div class="team-block">
                                        <div class="team-block__team-name team-name--main">
                                            Ворскла
                                        </div>
                                        <table class="matches-center-table">
                                            <thead>
                                                <tr>
                                                    <th>Номер</th>
                                                    <th>Гравець</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр (К)</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="team-block">
                                        <div class="team-block__team-name team-name--main">
                                            Олександрія
                                        </div>
                                        <table class="matches-center-table">
                                            <thead>
                                                <tr>
                                                    <th>Номер</th>
                                                    <th>Гравець</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр (К)</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="group-protocol__item">
                                <h3>
                                    <span>Запасні гравці</span>
                                </h3>
                                <div class="team-block-wrapper">
                                    <div class="team-block">
                                        <div class="team-block__team-name">
                                            Ворскла
                                        </div>
                                        <table class="matches-center-table">
                                            <thead>
                                                <tr>
                                                    <th>Номер</th>
                                                    <th>Гравець</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="team-block">
                                        <div class="team-block__team-name">
                                            Олександрія
                                        </div>
                                        <table class="matches-center-table">
                                            <thead>
                                                <tr>
                                                    <th>Номер</th>
                                                    <th>Гравець</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Ткаченко Олександр</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="group-protocol">
                            <div class="group-protocol__item">
                                <h3>
                                    <span>Тренери</span>
                                </h3>
                                <div class="team-block-wrapper team-block-wrapper__coaches">
                                    <div class="team-block team-block__coaches">
                                        <div class="team-block__team-name">
                                            Ворскла
                                        </div>
                                        <div class="team-block__item">
                                            <div class="team-block__item--player">
                                                Косовський Віталій
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team-block team-block__coaches">
                                        <div class="team-block__team-name">
                                            Олександрія
                                        </div>
                                        <div class="team-block__item">
                                            <div class="team-block__item--player">
                                                Шаран Володимир
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="group-protocol__item">
                                <h3>
                                    <span>Арбітри</span>
                                </h3>
                                <div class="referee-block">
                                    <div class="referee-block__item">
                                        <div class="team-block__referee">
                                            Головний арбітр
                                        </div>
                                        <div class="team-block__referee-name">
                                            Козик Ярослав
                                        </div>
                                    </div>
                                    <div class="referee-block__item">
                                        <div class="team-block__referee">
                                            Асистенти арбітра
                                        </div>
                                        <div class="referees_wrap column-direction">
                                                <div class="team-block__referee-name">
                                                        Коротін Володимир
                                                    </div>
                                                <div class="team-block__referee-name">
                                                        Коротін Володимир
                                                    </div>
                                        </div>
                                        
                                    </div>
                                    <div class="referee-block__item">
                                        <div class="team-block__referee">
                                            Четвертий арбітр
                                        </div>
                                        <div class="team-block__referee-name">
                                            Бондаренко Дмитро
                                        </div>
                                    </div>
                                    <div class="referee-block__item">
                                        <div class="team-block__referee">
                                            Суддівський спостерігач
                                        </div>
                                        <div class="team-block__referee-name">
                                            Лучі Лучано
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="match-zvit" class="tabs__content">
                        <h2>Звіт</h2>
                    </div>
                    <div id="match-foto" class="tabs__content">
                        <h2>Фото-отчет</h2>
                    </div>
                    <div id="match-video" class="tabs__content">
                        <h2>Відео-отчет</h2>
                    </div>
                </div>
            </div>
        </section>
        <div class="ads-block-top">
            <a href="<?=get_theme_mod('fco_load_url_shop');?>" taret="_blank">
                <img src="<?=get_theme_mod('fco_load_baner_shop');?>" alt="">
            </a>
        </div>


    </main>
<? get_footer(); ?>