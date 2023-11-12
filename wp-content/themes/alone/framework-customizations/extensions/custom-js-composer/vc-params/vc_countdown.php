<?php
/*
Element Description: VC Count Down
*/

// Element Class
class vcCountDown extends WPBakeryShortCode {

  // Element Init
    function __construct() {
      //  global $__VcShadowWPBakeryVisualComposerAbstract;
      //  add_action( 'init', array( $this, 'vc_count_down_mapping' ) );
        $this->vc_count_down_mapping();
        add_shortcode( 'vc_count_down', array( $this, 'vc_count_down_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_count_down', array( $this, 'vc_count_down_html' ));
    }

    // Element Mapping
    public function vc_count_down_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Count Down', 'alone'),
            'base' => 'vc_count_down',
            'description' => __('Count Down', 'alone'),
            'category' => __('Theme Elements', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/countdown-box.png',
      			'params' => array(
      				array(
      					'type' => 'dropdown',
      					'class' => '',
      					'heading' => __('Template', 'alone'),
      					'param_name' => 'tpl',
      					'value' => array(
      						'Template 1' => 'tpl1',
                  'Template 2' => 'tpl2',
      						'Template 3' => 'tpl3',
                  'Template 4' => 'tpl4',
      					),
      					'description' => __('Select template in this elment.', 'alone')
      				),
      				array(
      					'type' => 'textfield',
      					'holder' => 'div',
      					'class' => '',
      					'heading' => __('Count Down', 'alone'),
      					'param_name' => 'count_down',
      					'value' => '',
      					'description' => __('Please, enter time for example "Jan 5, 2019 15:37:25"', 'alone')
      				),
      				array(
      					'type' => 'textfield',
      					'class' => '',
      					'heading' => __('Extra Class', 'alone'),
      					'param_name' => 'el_class',
      					'value' => '',
      					'description' => __ ( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'alone' )
      				),
      				/* css editor */
      				  array(
      					'type' => 'css_editor',
      					'heading' => __( 'Css', 'alone' ),
      					'param_name' => 'css',
      					'group' => __( 'Design Options', 'alone' ),
      				  ),
      			),
          )
        );
    }

    /**
  	 * Parses google_fonts_data and font_container_data to get needed css styles to markup
  	 *
  	 * @param $el_class
  	 * @param $css
  	 * @param $atts
  	 *
  	 * @since 1.0
  	 * @return array
  	 */
    public function getStyles($el_class, $css, $atts) {
      $styles = array();

      /**
  		 * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_custom_heading class
  		 *
  		 * @param string - filter_name
  		 * @param string - element_class
  		 * @param string - shortcode_name
  		 * @param array - shortcode_attributes
  		 *
  		 * @since 4.3
  		 */
  		$css_class = apply_filters( 'vc_count_down_filter_class', 'wpb_theme_custom_element wpb_count_down ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

	public function _template( $temp = 'tpl1', $item = array(), $atts = array() ) {
		$variables = array(
			'{count_down}'           => fw_akg( 'count_down', $item ),
		);

    $template = implode( '', array(
			'<div id="getting-started"></div>',
		) );

		return str_replace( array_keys( $variables ), array_values( $variables ), $template );
	}

	// Element HTML
	public function vc_count_down_html( $atts, $content ) {
    $GLOBALS['vcCountDown_self'] = $this;
    $GLOBALS['vcCountDown_content'] = $content;
		//$atts['self']    = $this;
		//$atts['content'] = $content;

		return fw_render_view( get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_countdown.php', array( 'atts' => $atts ), true );
	}

} // End Element Class


// Element Class Init
new vcCountDown();
