<?php
	$thumb_size = (!empty($img_size))?$img_size:'full';
?>
<div class="bt-item">
	<?php echo alone_post_thumbnail_render($image_type, $thumb_size, $img_ratio); ?>
	<div class="bt-content">
		<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<ul class="bt-meta">
			<li class="bt-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(get_option('date_format')); ?></a></li>
			<li class="bt-comments"><a href="<?php comments_link(); ?>"><?php comments_number( esc_html__('0 Comments', 'alone'), esc_html__('1 Comment', 'alone'), esc_html__('% Comments', 'alone') ); ?></a></li>
		</ul>
		<?php
			if((int)$excerpt_limit > 0) echo '<div class="bt-excerpt">'.wp_trim_words(get_the_excerpt(), $excerpt_limit, $excerpt_more).'</div>';
			echo '<a class="bt-readmore" href="'.get_the_permalink().'"><i class="entypo-icon entypo-icon-right-open-mini"></i></a>';
		?>
	</div>
</div>
