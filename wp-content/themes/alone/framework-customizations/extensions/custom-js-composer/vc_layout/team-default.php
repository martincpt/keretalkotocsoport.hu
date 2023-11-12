<?php
	$position = get_post_meta(get_the_ID(),'tb_team_position',true);
	$age = get_post_meta(get_the_ID(),'tb_team_age',true);
	$phone = get_post_meta(get_the_ID(),'tb_team_phone',true);
	$email = get_post_meta(get_the_ID(),'tb_team_email',true);
	$facebook = get_post_meta(get_the_ID(),'tb_team_facebook',true);
	$twitter = get_post_meta(get_the_ID(),'tb_team_twitter',true);
	$linkedin = get_post_meta(get_the_ID(),'tb_team_linkedin',true);
	$pinterest = get_post_meta(get_the_ID(),'tb_team_pinterest',true);
	$google_plus = get_post_meta(get_the_ID(),'tb_team_google_plus',true);
	$tumblr = get_post_meta(get_the_ID(),'tb_team_tumblr',true);
	$instagram = get_post_meta(get_the_ID(),'tb_team_instagram',true);
	$flickr = get_post_meta(get_the_ID(),'tb_team_flickr',true);

	$social =  array();
	if($facebook) $social[] = '<li><a href="'.esc_url($facebook).'"><i class="fa fa-facebook"></i></a></li>';
	if($twitter) $social[] = '<li><a href="'.esc_url($twitter).'"><i class="fa fa-twitter"></i></a></li>';
	if($linkedin) $social[] = '<li><a href="'.esc_url($linkedin).'"><i class="fa fa-linkedin"></i></a></li>';
	if($pinterest) $social[] = '<li><a href="'.esc_url($pinterest).'"><i class="fa fa-pinterest"></i></a></li>';
	if($google_plus) $social[] = '<li><a href="'.esc_url($google_plus).'"><i class="fa fa-google-plus"></i></a></li>';
	if($tumblr) $social[] = '<li><a href="'.esc_url($tumblr).'"><i class="fa fa-tumblr"></i></a></li>';
	if($instagram) $social[] = '<li><a href="'.esc_url($instagram).'"><i class="fa fa-instagram"></i></a></li>';
	if($flickr) $social[] = '<li><a href="'.esc_url($flickr).'"><i class="fa fa-flickr"></i></a></li>';

	

	$thumb_size = (!empty($img_size))?$img_size:'full';
?>
<div class="bt-item">
	<div class="bt-thumb_wrap">
		<?php echo alone_post_thumbnail_render($image_type, $thumb_size, $img_ratio); ?>
		<div class="bt-overlay">
			<div class="bt-overlay-inner">
				<?php
					if(!empty($social)) echo '<ul class="bt-social">'.implode(' ', $social).'</ul>';
					if($email) echo '<div class="bt-email"><a href="mailto:'.esc_url($email).'">'.$email.'</a></div>';
				?>
			</div>
		</div>
	</div>
	<div class="bt-content">
		<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php if($position) echo '<div class="bt-position">'.$position.'</div>'; ?>
	</div>
</div>
