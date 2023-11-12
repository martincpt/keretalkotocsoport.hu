<?php

	$thumb_size = (!empty($img_size))?$img_size:'full';
?>
<div class="bt-item">
	<div class="bt-thumb_wrap">
		<?php echo alone_post_thumbnail_render($image_type, $thumb_size, $img_ratio); ?>
	</div>
	<div class="bt-content">
		<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</div>
</div>
