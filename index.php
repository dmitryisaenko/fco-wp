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
            <div class="w100 news-items-wrapper">

                <!-- (Из какой(-их) категории, Кол-во постов на странице, Какой категорией подписывать превьюшки)  -->
                <? fco_view_items("1,257,258", 8, 1); ?> 
                
            </div>
        </div>
        <? wp_reset_query(); ?> 
	    <? wp_reset_postdata(); ?>
</section>
<section class="info-block-wrap">
	<div class="info-block">
		<div class="info-block-container pervision-info-block">
			<div class="info-block__header">
				<h3>Попередній матч</h3>
			</div>
			<?=showInfoBlock('lastTournament', 'main')?>

		</div>
		<div class="info-block-container next-info-block">
			<div class="info-block__header">
				<h3>Наступний матч</h3>
			</div>
			<?=showInfoBlock('futureTournament', 'main')?>

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