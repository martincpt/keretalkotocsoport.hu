<?php
	$thumb_size = (!empty($img_size))?$img_size:'full';
?>
<div class="bt-item">
	<div class="bt-thumb-wrap">
		<?php echo alone_post_thumbnail_render($image_type, $thumb_size, $img_ratio); ?>
		<div class="bt-date">
			<a href="<?php the_permalink(); ?>"><?php echo get_the_date(get_option('date_format')); ?></a>
			<span class="bt-icon"><i class="fa fa-calendar"></i></span>
		</div>
	</div>
	<div class="bt-content">
		<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php
			if((int)$excerpt_limit > 0) echo '<div class="bt-excerpt">'.wp_trim_words(get_the_excerpt(), $excerpt_limit, $excerpt_more).'</div>';
			if($readmore_text) echo '<a class="bt-readmore" href="'.get_the_permalink().'"><i class="fa fa-pencil"></i> '.$readmore_text.'</a>';
		?>
	</div>
</div>
