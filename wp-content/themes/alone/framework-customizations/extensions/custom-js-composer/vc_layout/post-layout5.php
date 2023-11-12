<?php
	$thumb_size = (!empty($img_size))?$img_size:'full';
?>
<div class="bt-item">
	<?php echo alone_post_thumbnail_render($image_type, $thumb_size, $img_ratio); ?>
	<div class="bt-overlay">
		<div class="bt-author">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
				<?php echo esc_html__('By ', 'alone').get_the_author(); ?>
			</a>
		</div>
		<div class="bt-content">
			<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<ul class="bt-meta">
				<li class="bt-date"><a href="<?php the_permalink(); ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date('M d, Y'); ?></a></li>
				<li class="bt-comments"><a href="<?php comments_link(); ?>"><i class="fa fa-commenting"></i> <?php comments_number( esc_html__('0', 'alone'), esc_html__('1', 'alone'), esc_html__('%', 'alone') ); ?></a></li>
			</ul>
		</div>
	</div>
</div>
