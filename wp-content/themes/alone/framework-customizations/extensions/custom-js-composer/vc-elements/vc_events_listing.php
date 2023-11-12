<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Params extraction
$atts = shortcode_atts(
  array(
    'self'              => '',
    'content'           => '',
    /* Source */
		'post_total_items'	=> 3,
		'type'							=> 'v_date',
		'order'							=> 'DESC',
		//'orderby'						=> 'date',
		'offset'						=> 0,
		'cat_ids'						=> '',
		'event_ids'					=> '',
		/* Layout */
		'image_size'				=> 'alone-image-medium',
		'layout'						=> 'default',
    /* Style */
    'el_id'             => '',
    'el_class'          => '',
    'css'               => '',
  ),
  $atts
);
extract($atts);//  echo '<pre>'; print_r($type); echo '</pre>';
//$events = tribe_get_events( [
//	'eventDisplay' => 'custom',
//	'start_date'   => '2018-10-01 00:01',
//	'end_date'     => '2022-10-31 23:59',
//] );

//print_r($events);

$events_data = $self->event_get_posts($atts); // echo '<pre>'; print_r($events_data); echo '</pre>';

/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css, $atts ) );

/** elm ID **/
$attr_id = '';
if(! empty($el_id)) { $attr_id = "id='{$el_id}'"; }
?>
<div <?php echo esc_attr($attr_id); ?> class="<?php echo esc_attr($css_class); ?>">
	<div class="vc-custom-inner-wrap">
		<?php
    if(count($events_data) > 0):
      foreach($events_data as $index => $item) {
        echo sprintf('<div class="post-event-item">%s</div>', $self->_template($layout, $item, $atts));
      }
    else :
       echo sprintf('<div class="item">%s</div>', __('There are no event to display!', 'alone'));
    endif;
    ?>
  </div>
</div>
