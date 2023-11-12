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
    'icon'              => 'fa fa-play-circle',
    'href'              => '#',
    'heading_text'      => __('Heading text', 'alone'),
    'content_text'      => __('I am featured box', 'alone'),
    'heading_color'     => '#fff',
    'content_color'     => '#fff',
    'icon_color'        => '#FFFFFF',
    'action'            => '',
    /* Style */
    'el_id'             => '',
    'el_class'          => '',
    'css'               => '',
  ),
  $atts
);
extract($atts); // echo '<pre>';print_r($atts);echo '</pre>';
//$sd = $icon;
//var_dump($sd);
$content = wpb_js_remove_wpautop($content, true);

/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css, $atts ) );

/** elm ID **/
$attr_id = '';
if(! empty($el_id)) { $attr_id = "id='{$el_id}'"; }

?>
<div <?php echo esc_attr($attr_id); ?> class="<?php echo esc_attr($css_class); ?>">
  <div class="vc-custom-inner-wrap" <?php echo esc_attr(($action == 'lightbox') ? 'data-bears-lightgallery' : ''); ?>>
    <div class="icon-box-wrap">
      <div class="liquid-icon-text">
        <a class="liquid-icon-link item" href="<?php echo esc_attr($href); ?>" style="color: <?php echo esc_attr($icon_color); ?>"><i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i></a>
      </div>
      <div class="play-content">
        <h4 class="icon-box-title" style="color: <?php echo esc_attr($heading_color); ?>"><?php echo esc_attr($heading_text); ?></h4>
        <div class="icon-box-text" style="color: <?php echo esc_attr($content_color); ?>"><?php echo esc_attr($content_text); ?></div>
      </div>
    </div>
  </div>
</div>
