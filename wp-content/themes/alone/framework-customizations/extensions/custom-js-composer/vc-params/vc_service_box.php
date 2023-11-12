<?php
/*
Element Description: VC Service Box
*/

// Element Class
class vcServiceBox extends WPBakeryShortCode {

  // Element Init
    function __construct() {
        //global $__VcShadowWPBakeryVisualComposerAbstract;
        //add_action( 'init', array( $this, 'vc_service_box_mapping' ) );
        $this->vc_service_box_mapping();
        add_shortcode( 'vc_service_box', array( $this, 'vc_service_box_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_service_box', array( $this, 'vc_service_box_html' ));
    }

    // Element Mapping
    public function vc_service_box_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Service Box', 'alone'),
            'base' => 'vc_service_box',
            'description' => __('Service Box', 'alone'),
            'category' => __('Theme Elements', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/featured-box.png',
      			'params' => array(
      				array(
      					'type' => 'dropdown',
      					'class' => '',
      					'heading' => __('Template', 'alone'),
      					'param_name' => 'tpl',
      					'value' => array(
      						'Template 1' => 'tpl1',
      						'Template 2' => 'tpl2'
      					),
      					'description' => __('Select template in this elment.', 'alone')
      				),
      				array(
      					'type' => 'attach_image',
      					'class' => '',
      					'heading' => __('Image', 'alone'),
      					'param_name' => 'img',
      					'value' => '',
      					'description' => __('Select image in this element.', 'alone')
      				),
      				array(
      					'type' => 'iconpicker',
      					'heading' => esc_html__( 'Icon', 'alone' ),
      					'param_name' => 'icon',
      					'settings' => array(
      					  'emptyIcon' => false,
      					  'type' => 'fontawesome',
      					  'iconsPerPage' => 32,
      					),
      					'dependency' => array(
      							'element' => 'graphic',
      							'value' => 'icon',
      						),
      					'description' => __('Select icon featured box.', 'alone'),
      				  ),
      				array(
      					'type' => 'textfield',
      					'holder' => 'div',
      					'class' => '',
      					'heading' => __('Title', 'alone'),
      					'param_name' => 'title',
      					'value' => '',
      					'description' => __('Please, enter title in this element.', 'alone')
      				),
      				array(
      					'type' => 'textarea',
      					'class' => '',
      					'heading' => __('Description', 'alone'),
      					'param_name' => 'desc',
      					'value' => '',
      					'description' => __('Please, enter description in this element.', 'alone')
      				),
      				array(
      					'type' => 'textfield',
      					'class' => '',
      					'heading' => __('Button Label', 'alone'),
      					'param_name' => 'btn_label',
      					'value' => '',
      					'description' => __('Please, enter label button in this element. Default: DONATION NOW ', 'alone')
      				),
      				array(
      					'type' => 'textfield',
      					'class' => '',
      					'heading' => __('Button Link', 'alone'),
      					'param_name' => 'btn_link',
      					'value' => '',
      					'description' => __('Please, enter link button in this element. Default: # ', 'alone')
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
  		$css_class = apply_filters( 'vc_service_box_filter_class', 'wpb_theme_custom_element wpb_service_box ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

    public function icon_html($atts) {
      $output = '';
      $graphic = fw_akg('graphic', $atts);

      switch($graphic) {
        case 'icon':
          $style = implode(';', array(
            'width: ' . fw_akg('graphic_size', $atts) . 'px',
            'height: ' . fw_akg('graphic_size', $atts) . 'px',
            'background-color: ' . fw_akg('graphic_background_color', $atts),
          ));

          $output = implode('', array(
            '<div class="type-'. $graphic .' graphic-shape-'. fw_akg('graphic_shape', $atts) .'" style="'. $style .'">',
              '<span style="color: '. fw_akg('graphic_color', $atts) .'" class="_icon '. fw_akg('icon', $atts) .'"></span>',
            '</div>',
          ));
          break;
        case 'image':
          $img_data = wp_get_attachment_image_src((int) fw_akg('image', $atts), 'full');
          $img_src = fw_akg('0', $img_data);
          $style = implode(';', array(
            'width: ' . fw_akg('graphic_size', $atts) . 'px',
          ));

          $output = implode('', array(
            '<div class="type-'. $graphic .'" style="'. $style .'">',
              '<img src="'. $img_src .'" alt="#">',
            '</div>',
          ));
          break;
      }

      return $output;
    }

    public function button_html($atts = array()) {
      $show_button = fw_akg('show_button', $atts);

      if(trim($show_button) != 'show') return;

      $output               = '';
      $button_text          = fw_akg('button_text', $atts);
      $href                 = fw_akg('href', $atts);
      $button_type          = fw_akg('button_type', $atts);
      $open_link_in_new_tab = fw_akg('open_link_in_new_tab', $atts);

      $target = ($open_link_in_new_tab == 'yes') ? 'target="_blank"' : '';

      $output = '<a href="'. $href .'" class="service-button btn-type-'. $button_type .'" '. $target .'>'. $button_text .'</a>';
      return $output;
    }

    public function getAlignmentClass($atts) {
      $output = '';
      $horizontal_alignment = fw_akg('horizontal_alignment', $atts);

      switch ($horizontal_alignment) {
        case 'center':
          $output = "content-alignment-" . fw_akg('content_alignment', $atts);
          break;

        case 'left':
          $output = "vertical-alignment-" . fw_akg('vertical_alignment_horizontal_left', $atts);
          break;

        case 'right':
          $output = "vertical-alignment-" . fw_akg('vertical_alignment_horizontal_right', $atts);
          break;
      }

      return $output;
    }

	public function _template( $temp = 'tpl1', $item = array(), $atts = array() ) {
		$variables = array(
			'{layout}'         => fw_akg( 'review_layout', $item ),
			'{name}'           => fw_akg( 'title', $item ),
			'{position}'       => fw_akg( 'manger', $item ),
			'{content_item}'   => do_shortcode( fw_akg( 'content_item', $item ) ),
			'{image}'          => fw_akg( 'image', $item ),
			'{css_class_item}' => fw_akg( 'css_class_item', $item ),

      '{icon_html}' 					=> fw_akg( 'icon', $item ),
      '{heading_text}' 					=> fw_akg( 'title', $item ),
      '{content_text}' 					=> fw_akg( 'desc', $item ),
      '{btn_label}' 					=> fw_akg( 'btn_label', $item ),
      '{btn_link}' 					=> fw_akg( 'btn_link', $item ),
      //'{img_html}' 					=> wp_get_attachment_image( $img, 'full' ),
      //'{content_alignment_class}' => $self->getAlignmentClass($atts),
		);

		$imgid            = $item['img'];
		$image_attributes = wp_get_attachment_image_src( $imgid, 'full' );
		$imgSrc           = $image_attributes[0];

		switch ( $temp ) {
			case 'tpl1':
				$template = implode( '', array(
          '<div class="bt-service-wrap">',
            '<div class="bt-service clearfix {css_class_item}">',
              '<img src="' . $imgSrc . '"/>',
              '<div class="bt-overlay">',
          		'<div class="bt-header">',
          			'<i class="{icon_html}"></i>',
          			'<h6 class="bt-title" >{heading_text}</h6>',
          		'</div>',
          		'<div class="bt-content">',
          			'<p>{content_text}</p>',
          			'<a class="bt-btn-link" href="{btn_link}">{btn_label}</a>',
          		'</div>',
              '</div>',
            '</div>',
          '</div>'
				) );
				break;
				case 'tpl2':
					$template = implode( '', array(
            '<div class="bt-service-wrap">',
              '<div class="bt-service clearfix {css_class_item}" style="background: url(' . $imgSrc . ') no-repeat center center / cover, #fafafa;">',
                '<div class="bt-overlay">',
            		'<div class="bt-content">',
                  '<div class="bt-content-middle">',
                    '<div class="bt-header">',
                      '<a class="bt-btn-link" href="{btn_link}"><i class="{icon_html}"></i></a>',
                      '<h6 class="bt-title" >{heading_text}</h6>',
                    '</div>',
              			'<p>{content_text}</p>',
              			'<a class="bt-btn-link" href="{btn_link}">{btn_label}</a>',
                  '</div>',
            		'</div>',
                '</div>',
              '</div>',
            '</div>'
					) );
					break;
		}

		return str_replace( array_keys( $variables ), array_values( $variables ), $template );
	}

	// Element HTML
	public function vc_service_box_html( $atts, $content ) {
		$atts['self']    = $this;
		$atts['content'] = $content;

		return fw_render_view( get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_service_box.php', array( 'atts' => $atts ), true );
	}

} // End Element Class


// Element Class Init
new vcServiceBox();
