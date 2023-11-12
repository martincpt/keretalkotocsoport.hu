<?php
	$thumb_size = (!empty($img_size))?$img_size:'full';
?>
<div class="bt-item">
	<?php echo alone_post_thumbnail_render($image_type, $thumb_size, $img_ratio); ?>
	<div class="bt-content">
		<div class="bt-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(get_option('date_format')); ?></a></div>
		<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</div>
</div>
