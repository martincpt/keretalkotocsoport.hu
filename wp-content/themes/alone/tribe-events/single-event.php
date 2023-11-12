<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();
$alone_post_options = alone_single_post_options( $event_id );
$image_background_elem = '';
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  $style_inline = "background: url(". get_the_post_thumbnail_url($event_id, $alone_post_options['image_size']) .") center center;";
  $image_background_elem = "<div class='post-sing-image-background' style='{$style_inline}'></div>";
}
?>

<div id="tribe-events-content" class="tribe-events-single">

	<!-- Notices -->
	<?php tribe_the_notices() ?>


	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			<!-- .tribe-events-sub-nav -->
		</nav>
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<div class="post-single-entry-header"> <!-- Start .single-entry-header -->
				<?php echo "{$image_background_elem}"; ?>
				<div class="heading-entry-wrap">
					<!-- Cat & tag -->
				  <div class="cat-meta">
				    <?php echo ! empty( $alone_post_options['category_list'] ) ? '<div class="post-category">' . $alone_post_options['category_list'] . '</div>' : ''; ?>
				  </div>

					<!-- title -->
				  <?php echo "{$alone_post_options['title']}"; ?>

					<div class="extra-meta">
				    <!-- post date -->
				    <div class="post-date" title="<?php _e('Date', 'alone'); ?>">
				      <?php echo "{$alone_post_options['date']}"; ?>
				    </div>

				    <!-- post author -->
				    <div class="post-author" title="<?php _e('Author', 'alone'); ?>">
				      <span><?php echo esc_html__('By ', 'alone') ?></span>
				      <?php echo "{$alone_post_options['author_link']}"; ?>
				    </div>

				    <!-- post comment -->
				    <div class="post-total-comment" title="<?php _e('Comment', 'alone'); ?>">
				      <?php echo "{$alone_post_options['comments']}"; ?>
				      <?php echo ((int) $alone_post_options['comments'] <= 1) ? esc_html__('Comment', 'alone') : esc_html__('Comments', 'alone')  ?>
				    </div>

				    <!-- post view -->
				    <div class="post-total-view" title="<?php _e('View', 'alone'); ?>">
				      <?php echo "{$alone_post_options['views']}"; ?>
				      <?php echo ((int) $alone_post_options['views'] <= 1) ? esc_html__('View', 'alone') : esc_html__('Views', 'alone')  ?>
				    </div>
				  </div>
				</div>
				<?php echo alone_share_post(array('facebook' => true, 'twitter' => true, 'google_plus' => true, 'linkedin' => true, 'pinterest' => false));?>
			</div> <!-- End .single-entry-header -->
			<!-- Event content -->
			<div class="row">
				<div class="col-md-12">
					<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
					<div class="tribe-events-single-event-description tribe-events-content">
						<?php the_content();
						/* tags */
						if(isset($alone_post_options['tag_list']) && ! empty($alone_post_options['tag_list'])) {
							echo "<div class='single-entry-tag'>". esc_html__('Tags: ', 'alone') . "{$alone_post_options['tag_list']}</div>";
						}?>
					</div>
				</div>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			<!-- .tribe-events-sub-nav -->
		</nav>
	</div>

</div><!-- #tribe-events-content -->
