<?php
	$thumb_size = (!empty($img_size))?$img_size:'full';
?>
<div class="bt-item">
	<?php echo alone_post_thumbnail_render($image_type, $thumb_size, $img_ratio); ?>
	<div class="bt-content">
		<div class="bt-date"><span class="bt-d"><?php echo get_the_date('d'); ?></span><span class="bt-m"><?php echo get_the_date('M'); ?></span></div>
		<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="bt-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo esc_html__('Author ', 'alone').get_the_author(); ?></a></div>
		<?php if((int)$excerpt_limit > 0) echo '<div class="bt-excerpt">'.wp_trim_words(get_the_excerpt(), $excerpt_limit, $excerpt_more).'</div>'; ?>
	</div>
</div>
