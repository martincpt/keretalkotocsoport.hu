<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Params extraction
extract( shortcode_atts( array(
    'self'              => '',
    'content'           => '',
    /* Source */
	'tpl' =>  'tpl1',
	'img' => '',
	'icon' => 'fa fa-archive',
	'title' => __('Heading text', 'alone'),
    'desc' => __('I am featured box. Click edit button to change this text.', 'alone'),
	'btn_label' => 'DONATE NOW',
    'btn_link' => '#',
    /* Style */
		'tpl'      => 'tpl1',
    'el_id'             => '',
    'el_class'          => '',
    'css'               => '',
  ), $atts ) );


/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css, $atts ) );


/** elm ID **/
$layout                 = $tpl;
$attr_id = '';
if ( ! empty( $el_id ) ) {
	$attr_id = "id='{$el_id}'";
}
?>
<div <?php echo esc_attr( $attr_id ); ?> class="<?php echo esc_attr( $css_class ); ?>">
	<div class="vc-custom-inner-wrap">
			<?php
					echo sprintf( '<div class="item layout-' . $layout . '">%s</div>', $self->_template( $layout, $atts ) );
			 ?>
	</div>
</div>
