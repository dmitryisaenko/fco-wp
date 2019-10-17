<?php
get_header();
?>
	<!-- Основное содержимое страниц -->
<main>
	<section class="main-container container">
		<section class="main-content media_991">
			<?
				if (get_the_ID() === 868) get_template_part( 'template-parts/content', 'page-buy-ticket' );
			?>
			
		</section>
	</section>

<?php
get_footer();
