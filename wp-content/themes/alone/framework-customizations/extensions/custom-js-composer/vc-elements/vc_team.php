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
		'type'							=> 'recent',
		'offset'						=> 0,
		'taxonomy_ids'			=> '',
		'team_ids'					=> '',
    'team_columns'      => '3',
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
extract($atts); // echo '<pre>'; print_r($atts); echo '</pre>';

$team_data = $self->team_get_posts($atts); // echo '<pre>'; print_r($events_data); echo '</pre>';

/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css, $atts ) );

$class_columns = '';
	switch ($team_columns) {
		case 1:
			$class_columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
			break;
		case 2:
			$class_columns = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
			break;
		case 3:
			$class_columns = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
			break;
		case 4:
			$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
			break;
		default:
			$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
			break;
	}
//  var_dump($class_columns);
/** elm ID **/
$attr_id = '';
if(! empty($el_id)) { $attr_id = "id='{$el_id}'"; }
?>
<div <?php echo esc_attr($attr_id); ?> class="<?php echo esc_attr($css_class); ?>">
	<div class="vc-custom-inner-wrap">
		<?php
    if(count($team_data) > 0):
      foreach($team_data as $index => $item) {
        echo sprintf('<div class="post-team-item %s">%s</div>', esc_attr($class_columns), $self->_template($layout, $item, $atts));
      }
    else :
      // echo sprintf('<div class="item">%s</div>', __('There are no event to display!', 'alone'));
    endif;
    ?>
  </div>
</div>
