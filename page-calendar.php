<?
    get_header();
    $active_tournament_id = 0;
    ($_GET['active_group_match']) ? $active_age_group_slag = secureData($_GET['active_group_match']) : $active_age_group_slag = 'main';
    ($_GET['season']) ? $active_season_id = secureData($_GET['season']) : $active_season_id = get_term(get_theme_mod('fco_ex_settings_season'))->term_id;
    if ( ($_GET['tournament']) AND ($_GET['tournament'] !== 0) ) {
        $active_tournament_id = secureData($_GET['tournament']);
        // $tournament_query = [
        //     'taxonomy' => 'tournament',
        //     'field'    => 'id',
        //     'terms'    => [$active_tournament_id],
        // ];
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
    // echo '<pre>';
    // print_r($query->post_count);
    // echo '</pre>';
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
    
    //Формируем многомерный массив $dateAndPostIDs с id-турниров, расположенных по месяцам и отсортированные по дням
    $seasonsArray = explode('/', get_term(get_theme_mod('fco_ex_settings_season'))->name);
    $dateAndPostIDs_firstArray = [];
    $dateAndPostIDs_lastArray = [];
    $tourArrayForInfoBlocks = [];
    while ( $query->have_posts() ) {
        $query->the_post();
        $postID = get_the_ID();
        $tour_date_timestamp = strtotime(get_field('tour_date'));
        $tour_year = date('Y', $tour_date_timestamp);
        $tour_type = get_the_terms($postID, 'tournament')[0];
        
        if ( ($active_tournament_id == 0) OR ($tour_type->term_id == $active_tournament_id) ){
            if ($tour_year == $seasonsArray[0]){
                $dateAndPostIDs_firstArray[] = ['postID' => $postID, 'date' => $tour_date_timestamp];
            }
            else {
                $dateAndPostIDs_lastArray[] = ['postID' => $postID, 'date' => $tour_date_timestamp];
            }
        }
    };
    
    
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
    
    $dateAndPostIDs = array_merge($dateAndPostIDs_firstArray,  $dateAndPostIDs_lastArray);

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

                        <?=showInfoBlock('lastTournament', $active_age_group_slag)?>

                    </div>
                    <div class="info-block-container info-block-container__wo-top-border">
                        <div class="info-block__header">
                            <h3>Наступний матч</h3>
                        </div>
                        
                        <?=showInfoBlock('futureTournament', $active_age_group_slag)?>
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
            <?$tour_select_status = '';
                if ($query->post_count == 0) {
                    $tour_select_status = ' disabled';
                }      
            ?>
                    <div class="matches-standings__filter-item">
                        <form action="">
                            <select name="tournament" id="tournament" <?=$tour_select_status?>>
                                <?=$tournamentList?>
                            </select>
                        </form>
                    </div>
                </div>
                
              <? if ($query->post_count == 0) {
                    echo '<h2 style="margin-bottom:20px;">За даними критеріями пошуку записів не знайдено!</h2>';
                }    
              else {
              $startMonth = date('m', $dateAndPostIDs_firstArray[0]['date']);
                $monthArray = ['', 'Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'];
              ?>
              <table class="matches-calendar-table">
                        <caption class="matches-calendar-table__caption"><?=$monthArray[(int)$startMonth]?> <?=$seasonsArray[0]?></caption>
                            <tbody>
            <?
    // echo $currentMonth;
    foreach ($dateAndPostIDs as $item){
        // $content_post = get_post($item['postID']);
        $is_home = get_field('tour_is_home', $item['postID']);
        $tour_date = date('d.m.Y', $item['date']);
        $tour_date_year = date('Y', $item['date']);
        $tour_time = (get_field('tour_time', $item['postID'])) ? date('H:i', strtotime(get_field('tour_time', $item['postID']))) : '00:00';
        $opp_select = get_field('opp_select', $item['postID']);
        $fco_goals = (get_field('fco-successful-goals', $item['postID']) !== '') ? get_field('fco-successful-goals', $item['postID']) : '_';
        $fco_golas = ($fco_golas < 0) ? "<span style='color: red;'>$fco_golas</span>" : $fco_goals;
        $opp_goals = (get_field('opp-successful-goals', $item['postID']) !== '') ? get_field('opp-successful-goals', $item['postID']) : '_';
        $opp_goals = ($opp_goals < 0) ? "<span style='color: red;'>$opp_goals</span>" : $opp_goals;
        $opp_logo_id = get_post_meta( $opp_select->ID, 'fclub_logo',true );
        $tour_name = get_the_terms($item['postID'],'tournament')[0]->name;
        $tour_url = get_permalink($item['postID']);
        // echo '<pre>';
        // print_r(get_permalink($item['postID'])); 
        
        // echo '</pre>';

        $itemMonth = date('m', $item['date']);
        if ($itemMonth == $startMonth){
                
            }
            else{
                $startMonth = $itemMonth;
                ?>
                        </tbody>
                    </table>
                    <table class="matches-calendar-table">
                        <caption class="matches-calendar-table__caption"><?=$monthArray[(int)$startMonth]?> <?=$tour_date_year?></caption>
                        <tbody>
                <?


            }
        // echo '<br>';    
        // echo '<pre>';
            // print_r($resultItem); 
        //     echo '</pre>';
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
                            echo '<span>' . $opp_select->post_title . '</span>';
                            echo wp_get_attachment_image($opp_logo_id, 'fco-club-logo-small', '', ['alt' => $opp_select->post_title]);
                        }
                    ?>
                    
                </td>
                <td class="matches-calendar-table__td--score">
                    <a href="<?=$tour_url?>" target='_blank'><span><?=($is_home) ? $fco_goals.' - '.$opp_goals : $opp_goals.' - '.$fco_goals ?></span></a>
                </td>
                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                    <?
                        if (!$is_home) {
                            echo '<img src="' . get_template_directory_uri() . '/assets/img/olexandriya_logo_mini.png"
                            alt="' . get_bloginfo('name') . '">';
                            echo '<span class="club-name">Олександрія</span>';
                        }
                        else {
                            echo wp_get_attachment_image($opp_logo_id, 'fco-club-logo-small', '', ['alt' => $opp_select->post_title]);
                            echo '<span>' . $opp_select->post_title . '</span>';
                        }
                    ?>
                </td>
                <td class="matches-calendar-table__td--tournament">
                    <?=$tour_name?>
                </td>
            </tr>
     
        <?
    }

        ?>
            
            </tbody>
        </table>
                        
<? } ?>           
            </section>
            
            
        </section>


        <div class="ads-block-top">
            <a href="<?=get_theme_mod('fco_load_url_shop');?>" taret="_blank">
                <img src="<?=get_theme_mod('fco_load_baner_shop');?>" alt="">
            </a>
        </div>


    </main>
<? get_footer(); ?>