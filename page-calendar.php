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
        $tourArrayForInfoBlocks[] = ['postID' => $postID, 'date' => $tour_date_timestamp];//Массив для вычисления прошлого и будущешо матча
        if ( ($active_tournament_id == 0) OR ($tour_type->term_id == $active_tournament_id) ){
            if ($tour_year == $seasonsArray[0]){
                $dateAndPostIDs_firstArray[] = ['postID' => $postID, 'date' => $tour_date_timestamp];
            }
            else {
                $dateAndPostIDs_lastArray[] = ['postID' => $postID, 'date' => $tour_date_timestamp];
            }
        }
    };
    $tourArrayForInfoBlocks[] = ['postID' => 0, 'date' => time()];//Добавляем текущую временную отметку, чтобы понимать, "где мы находимся"
    
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
    uasort($tourArrayForInfoBlocks, function ($a, $b)
        {
            if ($a['date'] == $b['date']) return 0;
            return $a['date'] > $b['date'] ? 1 : -1;
        }
    );

    //"Выравниваем" нумерацию в массиве для инфоблоков:
    $n = 1;
    $result_tourArrayForInfoBlocks = [];
    foreach($tourArrayForInfoBlocks as $tour){
        $result_tourArrayForInfoBlocks[$n] = $tour;
        $n++;
    }
    $tourArrayForInfoBlocks = $result_tourArrayForInfoBlocks;
    
    $dateAndPostIDs = array_merge($dateAndPostIDs_firstArray,  $dateAndPostIDs_lastArray);

    // echo '<pre>';
    // print_r($dateAndPostIDs); 
    // print_r($tourArrayForInfoBlocks); 
    // echo '</pre>';
    
    //Определяем ID прошлого и будущего турнира
    $n = 1;
    $currentTimePosition = '';
    foreach ($tourArrayForInfoBlocks as $key => $value){
        // echo '<pre>';
        // print_r($value['postID']); 
        // echo '</pre>';
        if($value['postID'] === 0) $currentTimePosition = $n;
        $n++;
    }
    if ($currentTimePosition === 1) {
        $lastTournamentID = false;
        $futureTournamentID = $tourArrayForInfoBlocks[2]['postID'];
    }
    elseif ($currentTimePosition === count($tourArrayForInfoBlocks)){
        $lastTournamentID = $tourArrayForInfoBlocks[$currentTimePosition - 1]['postID'];
        $futureTournamentID = false;
    }
    else{
        $lastTournamentID = $tourArrayForInfoBlocks[$currentTimePosition - 1]['postID'];
        $futureTournamentID = $tourArrayForInfoBlocks[$currentTimePosition + 1]['postID'];
    }

    // echo '<pre>';
    // echo date('d.m.Y', time()).'<br>';
    // echo time().'<br>';
    // print_r($currentTimePosition); 
    // echo '<br>';
    // print_r($lastTournamentID); 
    // echo '<br>';
    // print_r($futureTournamentID); 
    // print_r(sort($tourArrayForInfoBlocks)); 
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

function infoBlockInfo($tourID){
    $result = [];
    $result['111'] = 111;
    $result['is_home'] = get_field('tour_is_home', $tourID);
    $result['tour_time'] = (get_field('tour_time', $tourID)) ? date('H:i', strtotime(get_field('tour_time', $tourID))) : '00:00';
    $result['opp_select'] = get_field('opp_select', $tourID);
    $result['fco_goals'] = (get_field('fco-successful-goals', $tourID) !== '') ? get_field('fco-successful-goals', $tourID) : '_';
    $result['fco_golas'] = ($result['fco_goals'] < 0) ? "<span style='color: red;'>" . $result['fco_goals'] . "</span>" : $result['fco_golas'];
    $result['opp_goals'] = (get_field('opp-successful-goals', $tourID) !== '') ? get_field('opp-successful-goals', $tourID) : '_';
    $result['opp_goals'] = ($result['opp_goals'] < 0) ? "<span style='color: red;'>" . $result['opp_goals'] . "</span>" : $result['opp_goals'];
    $result['opp_logo_id'] = get_post_meta( $result['opp_select']->ID, 'fclub_logo',true );
    $result['tour_url'] = get_permalink($tourID);
    return $result;
}        
    
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
                                <? if (get_field('tour_number', $lastTournamentID)) echo get_field('tour_number', $lastTournamentID).'-й тур<br>';?>
                                    сезон <?=get_the_terms($lastTournamentID, 'season')[0]->name?>
                                </div>
<?
    $logo_data = get_the_terms($lastTournamentID, 'tournament');
    $thumb = get_field('liga-logo', 'category_'.$logo_data[0]->term_id);
    $url_logo = wp_get_attachment_image_url($thumb, 'full');
    $alt_logo = $logo_data[0]->name;
?>
                                <img src="<?=$url_logo?>" alt="<?=$alt_logo?>" title="<?=$alt_logo?>">
                            </div>
                            <div class="info-block__meta">
                                <span class="info-block__date">
                                <?=ukrainianDate(get_field('tour_date', $lastTournamentID));?>р.
                                </span>
                                <span class="info-block__stadium">
                                    <?=get_the_terms($lastTournamentID, 'stadium')[0]->name?>
                                </span>

                            </div>
                            <div class="info-block__kickoff-container">
                                <div class="info-block__team-container">
                    <?
                        // print_r(infoBlockInfo($lastTournamentID));
                    if (infoBlockInfo($lastTournamentID)['is_home']) {
                        echo '<span class="info-block__team-title info-block__team-title--home">';
                        echo 'Олександрія';
                        echo '</span>';
                        echo '<div class="info-block__team-img"><img src="' . get_template_directory_uri() . '/assets/img/olexandriya_logo_mini.png"
                            alt="' . get_bloginfo('name') . '"></div>';
                    }
                    else {
                        echo '<span>' . infoBlockInfo($lastTournamentID)['opp_select']->post_title . '</span>';
                        echo '<div class="info-block__team-img">' .  wp_get_attachment_image(infoBlockInfo($lastTournamentID)['opp_logo_id'], 'fco-club-logo-small', '', ['alt' => infoBlockInfo($lastTournamentID)['opp_select']->post_title]) . '</div>';
                    }
                    ?>
                                </div>
                                <div class="info-block__score">
                                    <span><?=(infoBlockInfo($lastTournamentID)['is_home']) ? infoBlockInfo($lastTournamentID)['fco_goals'] : infoBlockInfo($lastTournamentID)['opp_goals'] ?></span>
                                    <span><?=(!infoBlockInfo($lastTournamentID)['is_home']) ? infoBlockInfo($lastTournamentID)['fco_goals'] : infoBlockInfo($lastTournamentID)['opp_goals'] ?></span>

                                </div>
                                <div class="info-block__team-container">
                    <?
                    if (!infoBlockInfo($lastTournamentID)['is_home']) {
                        echo '<div class="info-block__team-img"><img src="' . get_template_directory_uri() . '/assets/img/olexandriya_logo_mini.png"
                            alt="' . get_bloginfo('name') . '"></div>';
                        echo '<span class="info-block__team-title info-block__team-title--home">';
                        echo 'Олександрія';
                        echo '</span>';
                    }
                    else {
                        echo '<div class="info-block__team-img">' . wp_get_attachment_image(infoBlockInfo($lastTournamentID)['opp_logo_id'], 'fco-club-logo-small', '', ['alt' => infoBlockInfo($lastTournamentID)['opp_select']->post_title]) . '</div>';
                        echo '<span>' . infoBlockInfo($lastTournamentID)['opp_select']->post_title . '</span>';
                    }
                    ?>
                                </div>
                            </div>
                            <div class="info-block__btn-container">
                                <a target="_blank" href="<?=infoBlockInfo($lastTournamentID)['tour_url']?>" class="btn info-block__btn info-block__btn--single">
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
                                <? if (get_field('tour_number', $futureTournamentID)) echo get_field('tour_number', $futureTournamentID).'-й тур<br>';?>
                                    сезон <?=get_the_terms($futureTournamentID, 'season')[0]->name?>
                                </div>
<?
    $logo_data = get_the_terms($futureTournamentID, 'tournament');
    $thumb = get_field('liga-logo', 'category_'.$logo_data[0]->term_id);
    $url_logo = wp_get_attachment_image_url($thumb, 'full');
    $alt_logo = $logo_data[0]->name;
?>
                                <img src="<?=$url_logo?>" alt="<?=$alt_logo?>" title="<?=$alt_logo?>">
                            </div>
                            <div class="info-block__meta">
                            <span class="info-block__date">
                                    <?=ukrainianDate(get_field('tour_date', $futureTournamentID));?>р.
                                </span>
                                <span class="info-block__stadium">
                                    <?=get_the_terms($futureTournamentID, 'stadium')[0]->name?>
                                </span>

                            </div>
                            <div class="info-block__kickoff-container">
                                <div class="info-block__team-container">
                    <?
                    if (infoBlockInfo($futureTournamentID)['is_home']) {
                        echo '<span class="info-block__team-title info-block__team-title--home">';
                        echo 'Олександрія';
                        echo '</span>';
                        echo '<div class="info-block__team-img"><img src="' . get_template_directory_uri() . '/assets/img/olexandriya_logo_mini.png"
                            alt="' . get_bloginfo('name') . '"></div>';
                    }
                    else {
                        echo '<span>' . infoBlockInfo($futureTournamentID)['opp_select']->post_title . '</span>';
                        echo '<div class="info-block__team-img">' .  wp_get_attachment_image(infoBlockInfo($futureTournamentID)['opp_logo_id'], 'fco-club-logo-small', '', ['alt' => infoBlockInfo($futureTournamentID)['opp_select']->post_title]) . '</div>';
                    }
                    ?>
                                </div>
                                <div class="info-block__time">
                                    <span class="clock-icon"></span>
                                    <span class="knock_time"><?=infoBlockInfo($futureTournamentID)['tour_time']?></span>
                                </div>
                                <div class="info-block__team-container">
                    <?
                    if (!infoBlockInfo($futureTournamentID)['is_home']) {
                        echo '<div class="info-block__team-img"><img src="' . get_template_directory_uri() . '/assets/img/olexandriya_logo_mini.png"
                            alt="' . get_bloginfo('name') . '"></div>';
                        echo '<span class="info-block__team-title info-block__team-title--home">';
                        echo 'Олександрія';
                        echo '</span>';
                    }
                    else {
                        echo '<div class="info-block__team-img">' . wp_get_attachment_image(infoBlockInfo($futureTournamentID)['opp_logo_id'], 'fco-club-logo-small', '', ['alt' => infoBlockInfo($futureTournamentID)['opp_select']->post_title]) . '</div>';
                        echo '<span>' . infoBlockInfo($futureTournamentID)['opp_select']->post_title . '</span>';
                    }
                    ?>
                                </div>
                            </div>
                            <div class="info-block__btn-container">
                                <a target="_blank" href="<?=get_home_url()?>/buy-ticket?tournamentID=<?=$futureTournamentID?>" class="btn info-block__btn info-block__btn--single">
                                    <span class="buy-ticket">Купити квіток</span>
                                </a>
                                <a target="_blank" href="<?=infoBlockInfo($futureTournamentID)['tour_url']?>" class="btn info-block__btn info-block__btn--single">
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