<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Display -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.23
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
global $post; $_FW = defined( 'FW' );
get_header();
alone_title_bar();
$alone_sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';

/* START - custom size container variable */
$content_class = 'content'; $sidebar_template = '';

if ( $_FW ) {
	$page_container_size = fw_get_db_post_option($post->ID, 'container_size', '');
	switch ($page_container_size) {
		case 'container-large': $content_class = 'fully'; $sidebar_template = 'fully-template'; break;
	}
}
$page_section_space = fw_get_db_post_option($post->ID, 'section_space', '');
?>
<main id="tribe-events-pg-template" class="tribe-events-pg-template bt-section-space <?php echo $page_section_space; ?>">
  <div class="<?php alone_get_content_class( $content_class, $alone_sidebar_position ); ?>">
    <?php tribe_events_before_html(); ?>
  	<?php tribe_get_view(); ?>
  	<?php tribe_events_after_html(); ?>
  </div>
  <?php get_sidebar($sidebar_template); ?>
</main> <!-- #tribe-events-pg-template -->
<?php
get_footer();
