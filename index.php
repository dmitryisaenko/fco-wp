<?php
get_header();
?>




<div class="ads-block-top">
	<a href="<?=get_theme_mod('fco_load_url_shop');?>" taret="_blank">
		<img src="<?=get_theme_mod('fco_load_baner_shop');?>" alt="">
	</a>
</div>
<section class="news-block">
	<h2 class="block-title"><span>Новини</span> клубу</h2>
	<div class="view-news">
		<div class="view-header">
			<a href="<? home_url() ?>/news">Більше новин</a>
		</div>
	</div>
	<div class="news-container">
	<?php
                global $post;

                $myposts = get_posts( 'numberposts=8&offset=1&category=1,257,258' );

                foreach( $myposts as $post ):
                    {
                    $category = get_the_category();
                    setup_postdata( $post );
                    
                    if (get_post_format() === "video") $postFormat = 'youtube-news';
                    elseif (get_post_format() === "gallery") $postFormat = 'foto-news';
                    else $postFormat = 'self-news';
                    }
                ?>
                    <div class="w23 news-item">
                        <div class="news-item-media-block">
                            <div class="news-item-image <?=$postFormat;?>">
                                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <? if (get_post_format() === "video") {
                                        $youtube_id = get_field('youtube_link');
                                        $url = "<img src='https://img.youtube.com/vi/$youtube_id/mqdefault.jpg' style='height:165px;'>";
                                        echo $url;
                                    }
                                    
                                        else {
                                            if (has_post_thumbnail()){
                                                the_post_thumbnail( 'fco-news-logo-300px' );
                                            }
                                            else {
                                                echo "<img src='https://picsum.photos/300/200'>";
                                            }
                                        }

                                    
                                    ?>
                                </a>
                            </div>
                            <div class="news-item-meta">
                                <div class="news-date">
                                    <?=get_the_date('j.n.Y'); ?>
                                </div>
                                <div class="news-category">
                                    <?=get_the_category_by_ID(1); ?>
                                </div>
                            </div>
                        </div>
                        <div class="news-item-title">
                            <span>
                                <a href="<?php the_permalink() ?>"
                                    title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            </span>
                        </div>
                    </div>

                <?php endforeach; ?>
                <? wp_reset_postdata(); ?>
	</div>
</section>
<section class="info-block-wrap">
	<div class="info-block">
		<div class="info-block-container pervision-info-block">
			<div class="info-block__header">
				<h3>Попередній матч</h3>
			</div>
			<div class="info-block__body">
				<div class="info-block__logo">
					<div class="info-block__logo--tur">
						8-й тур<br>сезон 2019/2020
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
		<div class="info-block-container next-info-block">
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
					<a href="matches-center.html" class="btn info-block__btn info-block__btn--single">
						<span class="match-center">Матч центр</span>
					</a>
				</div>
			</div>

		</div>
		<div class="info-block-container">
			<div class="info-block__header info-block__header--table-score">
				<h3>Турнірна таблиця</h3>
				<a href="matches-standings.html">Повна таблиця</a>
			</div>
			<div class="info-block__body info-block__body--abridged-table">
				<table class="abridged-table abridged-table__responsible">
					<thead>
						<tr class="abridged-table__header-row">
							<th class="abridged-table__header-cell abridged-table__header-cell--position" scope="col">
								<div>Місце</div>
							</th>
							<th class="abridged-table__header-cell abridged-table__header-cell--club" scope="col">
								Команда</th>
							<th scope="col" class="abridged-table__header-cell">
								<div>Ігри</div>
							</th>
							<th scope="col" class="abridged-table__header-cell">
								<div>Перемоги</div>
							</th>
							<th scope="col" class="abridged-table__header-cell">
								<div>Нічиї</div>
							</th>
							<th scope="col" class="abridged-table__header-cell">
								<div>Поразки</div>
							</th>

							<th scope="col" class="abridged-table__header-cell">
								<div>Забиті м'ячі</div>
							</th>
							<th scope="col" class="abridged-table__header-cell">
								<div>Пропущ. м'ячі</div>
							</th>
							<th scope="col" class="abridged-table__header-cell">
								<div>Різниця м'ячів</div>
							</th>
							<th scope="col" class="abridged-table__header-cell">
								<div>Очки</div>
							</th>
						</tr>
					</thead>

					<tbody class="abridged-table__table-body-container">
						<tr class=" abridged-table__row">

							<td class="abridged-table__position">
								<div class="abridged-table__pos-value">2</div>

							</td>
							<td class="abridged-table__club" scope="row">
								<div class="info-block__team-img">
									<img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/desna_0.png"
										alt="">
								</div>

								<div class="abridged-table__team">
									<div class="abridged-table__team-name">Десна</div>
								</div>
							</td>
							<td class="abridged-table__cell">5</td>
							<td class="abridged-table__cell">2</td>
							<td class="abridged-table__cell">2</td>
							<td class="abridged-table__cell">1</td>
							<td class="abridged-table__cell">4</td>
							<td class="abridged-table__cell">8</td>
							<td class="abridged-table__cell">1</td>
							<td class="abridged-table__cell">1</td>
						</tr>

						<tr class="abridged-table__row abridged-table__row--alexandria">

							<td class="abridged-table__position cell-bordered">
								<div class="abridged-table__pos-value">3</div>

							</td>
							<td class="abridged-table__club cell-bordered" scope="row">
								<div class="info-block__team-img">
									<img src="https://fco.com.ua/sites/default/files/styles/original/public/opponent/olexandriya.png"
										alt="">
								</div>
								<div class="abridged-table__team">
									<div class="abridged-table__team-name">Олександрія</div>
								</div>
							</td>
							<td class="abridged-table__cell cell-bordered">5</td>
							<td class="abridged-table__cell cell-bordered">2</td>
							<td class="abridged-table__cell cell-bordered">2</td>
							<td class="abridged-table__cell cell-bordered">1</td>
							<td class="abridged-table__cell cell-bordered"> +4
							</td>
							<td class="abridged-table__cell cell-bordered">8</td>
							<td class="abridged-table__cell cell-bordered">1</td>
							<td class="abridged-table__cell cell-bordered">1</td>
						</tr>

						<tr class=" abridged-table__row">

							<td class="abridged-table__position">
								<div class="abridged-table__pos-value">4</div>

							</td>
							<td class="abridged-table__club" scope="row">
								<div class="info-block__team-img">
									<img src="https://fco.com.ua/sites/default/files/styles/original/public/opponent/dnipro-1.png"
										alt="">
								</div>

								<div class="abridged-table__team">
									<div class="abridged-table__team-name">Дніпро-1</div>
								</div>
							</td>
							<td class="abridged-table__cell">5</td>
							<td class="abridged-table__cell">2</td>
							<td class="abridged-table__cell">2</td>
							<td class="abridged-table__cell">1</td>
							<td class="abridged-table__cell"> +4
							</td>
							<td class="abridged-table__cell">8</td>
							<td class="abridged-table__cell">1</td>
							<td class="abridged-table__cell">1</td>
						</tr>
					</tbody>


				</table>
			</div>
		</div>
	</div>
	</div>
</section>

<!-- <section class="shop">
            <img src="/img/shop.jpg" alt="">
        </section> -->



<?php
get_footer();