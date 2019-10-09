<?php if (!defined('FW')) die('Forbidden'); ?>
<?
	if (isset($data['slides'])){
		echo '<div class="slick-carousel-media-single">';
		foreach ($data['slides'] as $slide){
			echo '<div> <img class="img-responsive" data-lazy="' . $slide['src'] . '" alt=""> </div>';
		}
		echo '</div>';
		echo '<div class="slider-nav">';
		foreach ($data['slides'] as $slide){
			echo '<div> <img class="img-responsive" data-lazy="' . $slide['src'] . '" alt=""> </div>';
		}
		echo '</div>';
	}
?>

