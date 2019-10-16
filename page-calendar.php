<?
get_header();
$ID = get_the_ID();
        ($_GET['active_group_match']) ? $active_age_group_slag = secureData($_GET['active_group_match']) : $active_age_group_slag = 'main';
        ($_GET['season']) ? $active_season_id = secureData($_GET['season']) : $active_season_id = get_term(get_theme_mod('fco_ex_settings_season'))->term_id;
        if ( ($_GET['tournament']) AND ($_GET['tournament'] !== 0) ) {
            $active_tournament_id = secureData($_GET['tournament']);
            $tournament_query = [
                'taxonomy' => 'tournament',
                'field'    => 'id',
                'terms'    => [$active_tournament_id],
            ];
            $selectAllTours = '';
        }
        else {
            $tournament_query = '';
            $selectAllTours = 'selected';
        }

        $query = new WP_Query( [
            'post_type' => ['match'],
            'tax_query' => [
                // 'relation' => 'OR',
                [
                    'taxonomy' => 'age-group-match',
                    'field'    => 'slug',
                    // 'terms'    => 'main',
                    'terms'    => [$active_age_group_slag],
                ],
                [
                    'taxonomy' => 'season',
                    'field'    => 'id',
                    'terms'    => [$active_season_id],
                ],
                // $tournament_query,
            ]
        ] );

        //Формируем список типов турниров, которые есть в выборке
        $tournamentsArray = [];
        $tournamentList = "<option value='0' $selectAllTours>УСІ ТУРНІРИ</option>";
        while ( $query->have_posts() ) {
            $query->the_post();
            $tournament_term = get_the_terms(get_the_ID(), 'tournament')[0];
            $tournament_term_id = $tournament_term->term_id;
            array_push($tournamentsArray, $tournament_term_id);
        }
        wp_reset_query(); 
	    wp_reset_postdata();
        $tournamentsArray = array_unique($tournamentsArray);
        foreach ($tournamentsArray as $tournament){
            $tournamentData = get_term($tournament);
            $selected = '';
            ($tournamentData->term_id == $active_tournament_id) ? $selected = ' selected' : '';
            $tournamentList .= "<option value='$tournamentData->term_id' $selected>$tournamentData->name</option>";
        }
        
        //Формируем многомерный массив $resultArray с id-турниров, расположенных по месяцам и отсортированные по дням
        $seasonsArray = explode('/', get_term(get_theme_mod('fco_ex_settings_season'))->name);
        $dateAndPostIDs_firstArray = [];
        $dateAndPostIDs_lastArray = [];
        while ( $query->have_posts() ) {
            $query->the_post();
            $postID = get_the_ID();
            // $tour_date_timestamp = (DateTime::createFromFormat('d.m.Y', get_field('tour_date')))->getTimestamp();
            $tour_date_timestamp = strtotime(get_field('tour_date'));
            $tour_year = date('Y', $tour_date_timestamp);
            $tour_type = get_the_terms(get_the_ID(), 'tournament')[0];
            if ( ($active_tournament_id == 0) OR ($tour_type->term_id == $active_tournament_id) ){
                if ($tour_year == $seasonsArray[0]){
                    $dateAndPostIDs_firstArray[] = ['postID' => $postID, 'date' => $tour_date_timestamp];
                }
                else {
                    $dateAndPostIDs_lastArray[] = ['postID' => $postID, 'date' => $tour_date_timestamp];
                }
            }
            // $resultArray['year'][$tour_year][] = ['postID' => $postID, 'date' => $tour_date_timestamp];
            // $array = 
        }
        echo '<pre>';
    print_r($dateAndPostIDs_first); 
    echo '</pre>';
        uasort($dateAndPostIDs_firstArray, function ($a, $b)
            {
                if ($a['date'] == $b['date']) return 0;
                return $a['date'] > $b['date'] ? 1 : -1;
            }
        );
        uasort($dateAndPostIDs_lastArray, function ($a, $b)
            {
                if ($a['date'] == $b['date']) return 0;
                return $a['date'] > $b['date'] ? 1 : -1;
            }
        );

    // echo '<pre>';
    // print_r($dateAndPostIDs_firstArray); 
    // echo '</pre>';
    
    

        

        


    function getSeasonsList(){
        global $active_season_id;
        $seasons = get_terms(['taxonomy' => 'season', 'hide_empty' => false]);
        $result = '';
        foreach($seasons as $season){
            ($season->term_id === $active_season_id) ? $selected = ' selected' : '';
            $result .= "<option value='$season->term_id' $selected>$season->name</option>";
        }
        return $result;
    }

// echo $active_age_groupe_slag;
        
        // echo $active_age_group_slag.'111<br>';
        // echo $active_season_id.'222<br>';
        // echo $tournament_query.'333<br>';
        
        // return $result;


    
    // print_r($terms);
?>
<!-- Основное содержимое страниц -->
<main>
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb"><a href="/">Головна</a> / <span>Матчі / Календар</span> </div>
        </div>
        <section class="main-container container">
            <h1 class="page-header page-header__matches-calendar">Календар</h1>

            <div class="team-header team-header__matches-standings">
                <ul>
                    <li><a href='matches-calendar.html' class="active">ФК Олександрія</a></li>
                    <li><a href="matches-calendar.html">ФК Олександрія U-21</a></li>
                    <li><a href="matches-calendar.html">ФК Олександрія U-19</a></li>
                </ul>
            </div>
            <section class="info-block-wrap">
                <div class="info-block">
                    <div class="info-block-container info-block-container__wo-top-border">
                        <div class="info-block__header">
                            <h3>Попередній матч</h3>
                        </div>
                        <div class="info-block__body">
                            <div class="info-block__logo">
                                <div class="info-block__logo--tur">
                                    8-й тур</br>сезон 2019/2020
                                </div>
                                <img src="img/upl.png" alt="">
                            </div>
                            <div class="info-block__meta">
                                <span class="info-block__date">
                                    14 Вересня 2019р.
                                </span>
                                <span class="info-block__stadium">
                                    КСК "Ніка", м.Олександрія
                                </span>

                            </div>
                            <div class="info-block__kickoff-container">
                                <div class="info-block__team-container">
                                    <span class="info-block__team-title info-block__team-title--home">
                                        Олександрія
                                    </span>
                                    <div class="info-block__team-img">
                                        <img src="https://fco.com.ua/sites/default/files/styles/original/public/opponent/olexandriya.png"
                                            alt="">
                                    </div>
                                </div>
                                <div class="info-block__score">
                                    <span>2</span>
                                    <span>0</span>

                                </div>
                                <div class="info-block__team-container">
                                    <div class="info-block__team-img">
                                        <img src="https://fco.com.ua/sites/default/files/styles/original/public/opponent/desna_0.png"
                                            alt="">
                                    </div>
                                    <span class="info-block__team-title info-block__team-title--away">
                                        Дніпро-1
                                    </span>

                                </div>
                            </div>
                            <div class="info-block__btn-container">
                                <a href="matches-center.html" class="btn info-block__btn info-block__btn--single">
                                    <span class="match-center">Матч центр</span>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="info-block-container info-block-container__wo-top-border">
                        <div class="info-block__header">
                            <h3>Наступний матч</h3>
                        </div>
                        <div class="info-block__body">
                            <div class="info-block__logo">
                                <div class="info-block__logo--tur">
                                    9-й тур</br>сезон 2019/2020
                                </div>
                                <img src="img/upl.png" alt="">
                            </div>
                            <div class="info-block__meta">
                                <span class="info-block__date">
                                    21 вересня 2019р
                                </span>
                                <span class="info-block__stadium">
                                    КСК "Олімпійський", м.Київ
                                </span>

                            </div>
                            <div class="info-block__kickoff-container">
                                <div class="info-block__team-container">
                                    <span class="info-block__team-title info-block__team-title--home">
                                        Колос
                                    </span>
                                    <div class="info-block__team-img">
                                        <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/desna_0.png"
                                            alt="">
                                    </div>
                                </div>
                                <div class="info-block__time">
                                    <span class="clock-icon"></span>
                                    <span class="knock_time">21:45</span>
                                </div>
                                <div class="info-block__team-container">
                                    <div class="info-block__team-img">
                                        <img src="https://fco.com.ua/sites/default/files/styles/original/public/opponent/olexandriya.png"
                                            alt="">
                                    </div>
                                    <span class="info-block__team-title info-block__team-title--away">
                                        Олександрія
                                    </span>

                                </div>
                            </div>
                            <div class="info-block__btn-container">
                                <a href="#" class="btn info-block__btn info-block__btn--single">
                                    <span class="buy-ticket">Купити квіток</span>
                                </a>
                                <a href="#" class="btn info-block__btn info-block__btn--single">
                                    <span class="match-center">Матч центр</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
            </section>


            

            <section class="matches-calendar">
                <div class="matches-standings__filter">
                    <div class="matches-standings__filter-item">
                        
                        <form action="">
                            <select name="date" id="date">
                                <?=getSeasonsList()?>
                            </select>
                        </form>
                    </div>
                    <div class="matches-standings__filter-item">
                        <form action="">
                            <select name="tournament" id="tournament">
                                <?=$tournamentList?>
                            </select>
                        </form>
                    </div>
                </div>
                
              <?      
                $startMonth = date('m', $dateAndPostIDs_firstArray[0]['date']);
                $monthArray = ['', 'Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'];
              ?>
              <table class="matches-calendar-table">
                        <caption class="matches-calendar-table__caption"><?=$monthArray[(int)$startMonth]?> <?=$seasonsArray[0]?></caption>
                            <tbody>
            <?
    // echo $currentMonth;
    foreach ($dateAndPostIDs_firstArray as $item){
        $itemMonth = date('m', $item['date']);
        if ($itemMonth == $startMonth){
            $content_post = get_post($item['postID']);
            $is_home = get_post_meta($item['postID'], 'tour_is_home', true);
            $tour_date = date('d.m.Y', $item['date']);
            $tour_time = (get_post_meta($item['postID'], 'tour_time', true)) ? date('H:i', strtotime(get_post_meta($item['postID'], 'tour_time', true))) : '00:00';
            $opp_select = get_post_meta($item['postID'], 'opp_select', true);
            $fco_goals = (get_post_meta($item['postID'], 'fco-successful-goals', true)) ? get_post_meta($item['postID'], 'fco-successful-goals', true) : '_';
            $fco_golas = ((int)$fco_golas < 0) ? "<span style='color: red;'>$fco_golas</span>" : $fco_goals;
            $opp_goals = (get_post_meta($item['postID'], 'opp-successful-goals', true)) ?get_post_meta($item['postID'], 'opp-successful-goals', true) : '_';
            $opp_goals = ((int)$opp_goals < 0) ? "<span style='color: red;'>$opp_goals</span>" : $opp_goals;
            $opp_logo_id = get_post_meta ( get_field('opp_select')->ID, 'fclub_logo', true );
            // echo '<pre>';
            // print_r($content_post); 
            
            // echo '</pre>';
            ?>
            <tr>
                <td class="matches-calendar-table__td--where">
                    <?=($is_home) ? '<span class="home">Д' : '<span>В'?></span>
                </td>
                <td class="matches-calendar-table__td--when">
                    <?=$tour_date?>
                </td>
                <td class="matches-calendar-table__td--time">
                    <?=$tour_time?>
                </td>
                <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                    <?
                        if ($is_home) {
                            echo '<span class="club-name">Олександрія</span>';
                            echo '<img src="' . get_template_directory_uri() . '/assets/img/olexandriya_logo_mini.png"
                                alt="' . get_bloginfo('name') . '">';
                        }
                        else {
                            echo '<span>' . get_field('opp_select')->post_title . '</span>';
                            echo wp_get_attachment_image($opp_logo_id, 'fco-club-logo-small', '', ['alt' => get_field('opp_select')->post_title]);
                        }
                    ?>
                    
                </td>
                <td class="matches-calendar-table__td--score">
                    <a href="matches-center.html"><span><?=($is_home) ? $fco_goals.' - '.$opp_goals : $opp_goals.' - '.$fco_goals ?></span></a>
                </td>
                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                    <?
                        if (!$is_home) {
                            echo '<img src="' . get_template_directory_uri() . '/assets/img/olexandriya_logo_mini.png"
                            alt="' . get_bloginfo('name') . '">';
                            echo '<span class="club-name">Олександрія</span>';
                        }
                        else {
                            echo wp_get_attachment_image($opp_logo_id, 'fco-club-logo-small', '', ['alt' => get_field('opp_select')->post_title]);
                            echo '<span>' . get_field('opp_select')->post_title . '</span>';
                        }
                    ?>
                </td>
                <td class="matches-calendar-table__td--tournament">
                    <?=$tour_type->name?>
                </td>
            </tr>
            <?
        }
        else{

        }
        // echo '<br>';    
        // echo '<pre>';
            // print_r($resultItem); 
        //     echo '</pre>';
        }

        ?>

</tbody></table>
                        
                    
            </section>
            
            
        </section>


        <div class="ads-block-top">
            <a href="<?=get_theme_mod('fco_load_url_shop');?>" taret="_blank">
                <img src="<?=get_theme_mod('fco_load_baner_shop');?>" alt="">
            </a>
        </div>


    </main>
<? get_footer(); ?>