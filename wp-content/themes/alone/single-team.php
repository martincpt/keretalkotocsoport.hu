<?php
/**
 * The Template for displaying all single posts
 */
get_header();
alone_title_bar();
$alone_sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
$alone_general_posts_options = alone_general_posts_options();
global $post;
$position = get_post_meta($post->ID,'tb_team_position',true);
$age = get_post_meta($post->ID,'tb_team_age',true);
$phone = get_post_meta($post->ID,'tb_team_phone',true);
$email = get_post_meta($post->ID,'tb_team_email',true);
?>
<section class="class bt-main-row bt-section-space <?php alone_get_content_class( 'main', $alone_sidebar_position ); ?>" role="main" itemprop="mainEntity" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="container">
		<div class="row">
			<div class="bt-content-area <?php alone_get_content_class( 'content', $alone_sidebar_position ); ?>">
        <div class="col-md-9">
          <div class="bt-col-inner">
  					<?php // if( function_exists('fw_ext_breadcrumbs') && bearsthemes_check_is_bbpress() == '' ) fw_ext_breadcrumbs(); ?>
  					<?php while ( have_posts() ) : the_post();
  						get_template_part( 'templates/team/single/content', get_post_format() );

  						if ( comments_open() || get_comments_number() ) comments_template();
  						break;
  					endwhile; ?>
  				</div><!-- /.bt-col-inner -->
      </div>
      <div class="noo-sidebar col-md-3">
        <div class="single-sidebar">
        <h4 class="widget-title">Team Information</h4>
        <div class="class-info-sidebar">
          <div class="clearfix"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $position ?></div>
          <div class="clearfix"><i class="fa fa-user-o"></i>&nbsp;Age number: <?php echo $age ?></div>
          <div class="clearfix"><i class="fa fa-phone"></i>&nbsp;Phone: <?php echo $phone ?></div>
          <div class="clearfix"><i class="fa fa-envelope-o"></i>&nbsp;Email: <?php echo $email ?></div>
        </div>
        <?php
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

								if(!empty($social)) echo '<ul class="bt-social">'.implode(' ', $social).'</ul>'
							?>
        </div>
      </div>
			</div><!-- /.bt-content-area -->
			<?php get_sidebar(); ?>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>
<?php get_footer(); ?>
