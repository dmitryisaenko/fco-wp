<? get_header();?>
<? the_post(); ?>
<?
    $the_ID = get_the_ID();

    // echo '<pre>';
    // print_r(get_field('opp_select')->ID);
    // echo '<pre>';

    $fco_goals = get_field('fco-successful-goals');
    $opp_goals = get_field('opp-successful-goals');
    
    //Получаем ID для вывода лого оппонента:
    $term_id = get_post_meta ( get_field('opp_select')->ID, 'fclub_logo', true );

    //Выводим шапку исходя из того, где играла Александрия - дома или на выезде
    if (get_field('tour_is_home')) {
        $kickoff = '
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
        $kickoff = '
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
    function warnings_list($team){
        ($team === 'fco') ? $team = 'fco_warning' : $team = 'opp_warning';
        $result = '';
        if (get_field($team)) {
            $warnings = explode("\n", str_replace("\r", "", get_field($team)));
            foreach ($warnings as $warning){
                $warning_array = explode(',', $warning);
                if ($warning_array[0] === '') return $result;
                switch ($warning_array[1]){
                    case 'y':
                        $cards = '<span class="warning-card warning-card__yellow"></span>';
                        break;
                    case 'r':
                    $cards = '<span class="warning-card warning-card__red"></span>';
                        break;
                    case 'yr':
                        $cards = '<span class="warning-card warning-card__2yellow"></span>';
                        break;
                    case 'ry':
                        $cards = '<span class="warning-card warning-card__2yellow"></span>';
                        break;
                    case 'yy':
                        $cards = '<span class="warning-card warning-card__2yellow"></span>';
                        break;
                }
                $result .= '<div class="team-block__item">
                <div class="team-block__item--player">
                    ' . $warning_array[0] . '
                </div>
                <div class="team-block__item--player_card">
                ' . $cards . '
                    
                </div>
            </div>';
            }
        }
        return $result;
    }

    //Список команд
    function teamList($teamName, $teamType){ 
        if ($teamName === 'fco') {
            ($teamType === 'start') ? $teamType = 'fco_start_list' : $teamType = 'fco_substitute_list';
        }
        else ($teamType === 'start') ? $teamType = 'opp_start_list' : $teamType = 'opp_substitute_list';
        if (!get_field($teamType)) return '';
        $result = '';
        if ($teamName === 'fco'){
            $playersID = get_field($teamType);
            foreach ($playersID as $playerID){
                $playerNumber = get_post_meta ( $playerID, 'player_number', true );
                $playerName = get_the_title( $playerID );
                $result .= "
                    <tr>
                        <td>$playerNumber</td>
                        <td>$playerName</td>
                    </tr>
                ";
                }
            }
        else{
            $playersData = explode("\n", str_replace("\r", "", get_field($teamType)));
            foreach ($playersData as $playerData){
                $playerData_array = explode(',', $playerData);
                $result .= "
                    <tr>
                        <td>$playerData_array[0]</td>
                        <td>$playerData_array[1]</td>
                    </tr>
                ";
            }
            // print_r($playersData);
            // $result = "opp";
        } 
        return $result;
    }

    //Арбитры
    function referee_list(){
        if (!get_field('referee')) return '';
        $referees = explode("\n", str_replace("\r", "", get_field('referee')));
        $result = '';
        foreach ($referees as $referee){
            if ($referee === '') return $result;
            $refereeArray = explode(':', $referee);
            $refereeTitle = $refereeArray[0];
            $refereeNameArray = explode(',', $refereeArray[1]);
            $refereeNamesTemp = '';
            foreach($refereeNameArray as $refereeName){
                $refereeNamesTemp .= "<div class='team-block__referee-name'>$refereeName</div>";
            }
            if (count($refereeNameArray) >= 2) $refereeNames = "<div class='referees_wrap column-direction'>$refereeNamesTemp</div>";
            else $refereeNames = $refereeNamesTemp;
            $result .= "
                <div class='referee-block__item'>
                    <div class='team-block__referee'>
                    $refereeTitle
                    </div>
                    $refereeNames
                </div>
            ";
        }
        return $result;
    }
    $id_post = get_field('tour_zvit_text');
    $id_gallery = get_field('tour_zvit_photo');
    $id_video = get_field('tour_zvit_video');
    ?>
    <!--  -->
<!-- Основное содержимое страниц -->
<main>
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb"><a href="/">Головна</a> / <span><span>Матчі </span> / Календар / <? the_title(); ?></span></div>
        </div>
        <?
            $terms = get_terms( [
                'taxonomy' => 'tournament',
                'fields' => 'id=>name'
            ] );
            foreach ($terms as $key => $value){
                $thumb = get_field('liga-logo', 'category_'.$key);
                $url_logo = wp_get_attachment_image_url($thumb, 'full');
                $alt_logo = $value;
            }
            // print_r($key);
            // echo $alt_logo;
            // print_r(get_term(287));
        ?>
        <section class="main-container container">
            <div class="info-block info-block__match-center">
                <div class="info-block-container info-block-container__wo-top-border info-block-container__wo-top-border--match-center">
                    <div class="info-block__body">
                        <div class="info-block__logo">
                            <div class="info-block__logo--tur">
                                <?=get_field('tour_number')?>-й тур<br>сезон <?=get_the_terms($the_ID, 'season')[0]->name?>
                            </div>
                            <img src="<?=$url_logo?>" alt="<?=$alt_logo?>" title="<?=$alt_logo?>">
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
                            <?=$kickoff?>
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
                                            <?
                                                if (get_field('tour_is_home')) echo 'Олександрія';
                                                else echo get_field('opp_select')->post_title;
                                            ?>
                                        </div>
                                            <?
                                                if (get_field('tour_is_home')) echo warnings_list('fco');
                                                else echo warnings_list('opp');
                                            ?>
                                    </div>
                                    <div class="team-block">
                                        <div class="team-block__team-name">
                                            <?
                                                if (get_field('tour_is_home')) echo get_field('opp_select')->post_title;
                                                else echo 'Олександрія';
                                            ?>
                                        </div>
                                            <?
                                                if (get_field('tour_is_home')) echo warnings_list('opp');
                                                else echo warnings_list('fco');
                                            ?>
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
                                            <?
                                                if (get_field('tour_is_home')) echo 'Олександрія';
                                                else echo get_field('opp_select')->post_title;
                                            ?>
                                        </div>
                                        <table class="matches-center-table">
                                            <thead>
                                                <tr>
                                                    <th>Номер</th>
                                                    <th>Гравець</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? 
                                                if (get_field('tour_is_home')) echo teamList('fco', 'start');
                                                else echo teamList('opp', 'start');
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="team-block">
                                        <div class="team-block__team-name team-name--main">
                                            <?
                                                if (get_field('tour_is_home')) echo get_field('opp_select')->post_title;
                                                else echo 'Олександрія';
                                            ?>
                                        </div>
                                        <table class="matches-center-table">
                                            <thead>
                                                <tr>
                                                    <th>Номер</th>
                                                    <th>Гравець</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? 
                                                    if (get_field('tour_is_home')) echo teamList('opp', 'start');
                                                    else echo teamList('fco', 'start');
                                                ?>
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
                                            <?
                                                if (get_field('tour_is_home')) echo 'Олександрія';
                                                else echo get_field('opp_select')->post_title;
                                            ?>
                                        </div>
                                        <table class="matches-center-table">
                                            <thead>
                                                <tr>
                                                    <th>Номер</th>
                                                    <th>Гравець</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? 
                                                    if (get_field('tour_is_home')) echo teamList('fco', 'substitute');
                                                    else echo teamList('opp', 'substitute');
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="team-block">
                                        <div class="team-block__team-name">
                                            <?
                                                if (get_field('tour_is_home')) echo get_field('opp_select')->post_title;
                                                else echo 'Олександрія';
                                            ?>
                                        </div>
                                        <table class="matches-center-table">
                                            <thead>
                                                <tr>
                                                    <th>Номер</th>
                                                    <th>Гравець</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? 
                                                    if (get_field('tour_is_home')) echo teamList('opp', 'substitute');
                                                    else echo teamList('fco', 'substitute');
                                                ?>
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
                                            <?
                                                if (get_field('tour_is_home')) echo 'Олександрія';
                                                else echo get_field('opp_select')->post_title;
                                            ?>
                                        </div>
                                        <div class="team-block__item">
                                            <div class="team-block__item--player">
                                            <?
                                                if (get_field('tour_is_home')) echo get_field('fco_referee');
                                                else echo get_field('opp_referee');
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team-block team-block__coaches">
                                        <div class="team-block__team-name">
                                            <?
                                                if (get_field('tour_is_home')) echo get_field('opp_select')->post_title;
                                                else echo 'Олександрія';
                                            ?>
                                        </div>
                                        <div class="team-block__item">
                                            <div class="team-block__item--player">
                                            <?
                                                if (get_field('tour_is_home')) echo get_field('opp_referee');
                                                else print_r(get_field('fco_referee')[0]->post_title);
                                            ?>
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
                                    <?=referee_list();?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="match-zvit" class="tabs__content">
                        <section class="main-container container">
                        <?php 
                            $query = new WP_Query( 'p='.$id_post );
                            while ( $query->have_posts() ) : 	$query->the_post(); 
                        ?>
                            <div class="news-single-header">
                                <div class="news-single-header-logo">
                                <?php the_post_thumbnail('', ['class' => "img-responsive"]); ?>
                                </div>
                                <div class="news-single-subheader">
                                    <div class="news-single-subheader-title">
                                        <h1>
                                        <? the_title() ?>
                                        </h1>
                                    </div>
                                    <div class="news-single-subheader-info">
                                        <div class="top-line">
                                            <div class="news-single-subheader-info-date">
                                            <?=get_the_date('d.m.Y G:i'); ?>
                                            </div>
                                            <div class="news-single-subheader-info-news_title">
                                                Звіт
                                            </div>
                                        </div>
                                        <div class="bottom-line">
                                            <a class="facebook_icon social-icon-item" target="_blank" href="http://www.facebook.com/sharer.php?u=<? the_permalink( ); ?>&t=<? the_title(); ?>"></a>
                                            <a class="twitter_icon social-icon-item" target="_blank" href="http://twitter.com/share?text=<? the_title(); ?>. Дізнатися більше: &url=<? the_permalink( ); ?>"></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <section class="main-content media_991">
                                <div class="central-content central-content-news-single">
                                    <? the_content(); ?>
                                </div>
                        <? endwhile;?>
                                <? get_sidebar(); ?>
                            </section>
                        </section>
                        <? wp_reset_query(); ?>
                    </div>
                    <div id="match-foto" class="tabs__content">
                    <section class="main-container container">
                        <?
                            echo do_shortcode('[wxas id="704"]');
                        ?>
                    </section>
                    </div>
                    <div id="match-video" class="tabs__content">
                        <section class="main-container container">
                            <div class="news-single-header-logo">
                                <div class="youtube-video-frame">
                                    <iframe class="youtube-video" src="https://www.youtube.com/embed/<?=$id_video?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </section>
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