<aside class="right-content">
    <div class="widget">
        <?
            $age_group_id = get_the_terms(get_the_ID(), 'age-group')[0]->term_id;
            function fco_member_fio($age_group_id, $player_category_id){
                $args = [
                    'post_type' => 'team',
                    'tax_query' => [
                        'relation' => 'AND',
                        [
                            'taxonomy' => 'age-group',
                            'field'    => 'id',
                            'terms'    => $age_group_id,
                        ],
                        [
                            'taxonomy' => 'role',
                            'field'    => 'id',
                            'terms'    => 279,
                        ],
                        [
                            'taxonomy' => 'player_category',
                            'field'    => 'id',
                            'terms'    => $player_category_id,
                        ]
                    ]
                ];
                
                $query = new WP_Query( $args );
                if ( $query->have_posts() ){
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        echo '<a href="' .get_the_permalink(). '">' . get_field('member_familyname') . '</a>';
                    }
                }
                wp_reset_query(); 
                wp_reset_postdata();
            } 
$age_group = "";
$age_group_id = get_the_terms(get_the_ID(), 'age-group')[0]->term_id;
if ($age_group_id === 262) $age_group = " U-21";
elseif ($age_group_id === 263) $age_group = " U-19";
// print_r(get_post(get_post()->post_parent)->post_title);
        ?>
        <div class="widget-title widget-title-players-list">
            <span>ФК Александрія<?=$age_group?></span> гравці
        </div>
        <div class="widget-body widget-body-players-list">
            <h3 class="widget-body-players-list-title">Воротарі</h3>
            <div class="players-list-block">
                <?=fco_member_fio($age_group_id, 282)?>
            </div>
            <h3 class="widget-body-players-list-title">Захисники</h3>
            <div class="players-list-block">
            <?=fco_member_fio($age_group_id, 283)?>
            </div>
            <h3 class="widget-body-players-list-title">Півзахисники</h3>
            <div class="players-list-block">
            <?=fco_member_fio($age_group_id, 284)?>
            </div>
            <h3 class="widget-body-players-list-title">Нападники</h3>
            <div class="players-list-block">
            <?=fco_member_fio($age_group_id, 285)?>
            </div>
        </div>
    </div>
    <?php
    dynamic_sidebar( 'sidebar-team' );
    ?>
</aside>
