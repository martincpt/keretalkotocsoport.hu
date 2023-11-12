<?php
	$thumb_size = (!empty($img_size))?$img_size:'full';
?>
<div class="bt-item">
	<div class="bt-thumb-wrap">
		<?php echo alone_post_thumbnail_render($image_type, $thumb_size, $img_ratio); ?>
	</div>
	<div class="bt-content">
		<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<ul class="bt-meta">
			<li class="bt-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(get_option('date_format')); ?></a></li>
			<li><?php echo esc_html__('By ', 'alone'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
		</ul>
	</div>
</div>
