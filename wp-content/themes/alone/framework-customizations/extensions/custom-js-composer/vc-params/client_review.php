<?php
/*
Element Description: VC Review
*/

// Element Class
class vcBaseReview extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		//global $__VcShadowWPBakeryVisualComposerAbstract;
		//add_action( 'init', array( $this, 'vc_base_review_mapping' ) );
		$this->vc_base_review_mapping();
		add_shortcode( 'vc_base_review', array( $this, 'vc_base_review_html' ) );
	}

	// Element Mapping
	public function vc_base_review_mapping() {

		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// Map the block with vc_map()
		vc_map( array(
			'name'        => __( 'Base review', 'alone' ),
			'base'        => 'vc_base_review',
			'description' => __( 'Base OWL review', 'alone' ),
			'category'    => __( 'Theme Elements', 'alone' ),
			'icon'        => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/base-testominal.png',
			'params'      => array(
				/* source */
				array(
					'type'        => 'param_group',
					'heading'     => __( 'Values', 'alone' ),
					'param_name'  => 'values',
					'description' => __( 'Enter value item for slider.', 'alone' ),
					'value'       => urlencode( json_encode( array(
						array(
							'label'              => __( 'Your Name', 'alone' ),
							'manger'             => __( 'position', 'alone' ),
							'content_item'       => __( 'I am test text block one. Click edit button to change this text.', 'alone' ),
							'image'              => __( 0, 'alone' ),
						),
						array(
							'label'              => __( 'Your Name', 'alone' ),
							'manger'             => __( 'position', 'alone' ),
							'content_item'       => __( 'I am test text block two. Click edit button to change this text.', 'alone' ),
							'image'              => __( 0, 'alone' ),
						),
						array(
							'label'              => __( 'Your Name', 'alone' ),
							'manger'             => __( 'position', 'alone' ),
							'content_item'       => __( 'I am test text block three. Click edit button to change this text.', 'alone' ),
							'image'              => __( 0, 'alone' ),
						),
					) ) ),
					'params'      => array(
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Name', 'alone' ),
							'param_name'  => 'label',
							'description' => __( 'Enter a name', 'alone' ),
							'admin_label' => true,
						),
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Position', 'alone' ),
							'param_name'  => 'manger',
							'description' => __( 'Enter a position', 'alone' ),
							'admin_label' => true,
						),
						array(
							'type'        => 'textarea',
							'heading'     => __( 'Content', 'alone' ),
							'param_name'  => 'content_item',
							'description' => __( 'Enter your content.', 'alone' )
						),
						array(
							'type'       => 'attach_image',
							'heading'    => __( 'Avatar', 'alone' ),
							'param_name' => 'image',
							'group'      => 'Source',
						),
					),
					'group'       => 'Source',
				),
				array(
          'type'        => 'dropdown',
          'heading'     => __( 'Layout', 'alone' ),
          'param_name'  => 'review_layout',
          'value'       => array(
            __( 'Default', 'alone' ) => 'default',
            __( 'Style 1', 'alone' ) => 'style-1',
            //__( 'Style 2', 'alone' ) => 'style-2',
          ),
          'std'         => 'default',
          'description' => __( 'Select layout of review.', 'alone' ),
          'group'       => 'Source',
        ),
				array(
					'type'        => 'el_id',
					'heading'     => __( 'Element ID', 'alone' ),
					'param_name'  => 'el_id',
					'description' => __( 'Enter element ID .', 'alone' ),
					'group'       => 'Source',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Extra class name', 'alone' ),
					'param_name'  => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'alone' ),
					'group'       => 'Source',
				),
				/*** Slider Options ***/
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Items', 'alone' ),
					'param_name'  => 'items',
					'value'       => '3',
					'admin_label' => false,
					'description' => __( 'The number of items you want to see on the screen.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Margin', 'alone' ),
					'param_name'  => 'margin',
					'value'       => '30',
					'admin_label' => false,
					'description' => __( 'margin-right(px) on item.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Loop', 'alone' ),
					'param_name'  => 'loop',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Infinity loop. Duplicate last and first items to get loop illusion.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Center', 'alone' ),
					'param_name'  => 'center',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Center item. Works well with even an odd number of items.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'stagePadding', 'alone' ),
					'param_name'  => __( 'stage_padding', 'alone' ),
					'value'       => '0',
					'description' => __( 'Padding left and right on stage (can see neighbours).', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'startPosition', 'alone' ),
					'param_name'  => __( 'start_position', 'alone' ),
					'value'       => '0',
					'description' => __( 'Start position or URL Hash string like `#id`.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Nav', 'alone' ),
					'param_name'  => 'nav',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Show next/prev buttons.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Dots', 'alone' ),
					'param_name'  => 'dots',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Show dots navigation.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'slideBy', 'alone' ),
					'param_name'  => __( 'slide_by', 'alone' ),
					'value'       => 1,
					'description' => __( 'Navigation slide by x. `page` string can be set to slide by page.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Autoplay', 'alone' ),
					'param_name'  => 'autoplay',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Autoplay.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'autoplayHoverPause', 'alone' ),
					'param_name'  => 'autoplay_hover_pause',
					'value'       => array(
						__( 'Yes', 'alone' ) => '1',
						__( 'No', 'alone' )  => '0',
					),
					'std'         => '0',
					'description' => __( 'Pause on mouse hover.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'autoplayTimeout', 'alone' ),
					'param_name'  => 'autoplay_timeout',
					'value'       => '5000',
					'description' => __( 'Autoplay interval timeout.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'smartSpeed', 'alone' ),
					'param_name'  => 'smart_speed',
					'value'       => '250',
					'description' => __( 'AutoplaySpeed Calculate. More info to come..', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Table Items', 'alone' ),
					'param_name'  => 'responsive_table_items',
					'value'       => '1',
					'admin_label' => false,
					'description' => __( 'The number of items you want to see on the table screen.', 'alone' ),
					'group'       => 'Slider Options',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Mobile Items', 'alone' ),
					'param_name'  => 'responsive_mobile_items',
					'value'       => '1',
					'admin_label' => false,
					'description' => __( 'The number of items you want to see on the mobile screen.', 'alone' ),
					'group'       => 'Slider Options',
				),
				/* css editor */
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'alone' ),
					'param_name' => 'css_item',
					'group'      => __( 'Design Options items', 'alone' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'alone' ),
					'param_name' => 'css',
					'group'      => __( 'Design Options general', 'alone' ),
				),
			),
		) );
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
	public function getStyles( $el_class, $css, $atts ) {
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
		$css_class = apply_filters( 'vc_base_review_filter_class', 'wpb_theme_custom_element wpb_base_review ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		return array(
			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
			'styles'    => $styles,
		);
	}

	public function getStylesSliderItem( $class, $css, $atts ) {
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
		$css_class = apply_filters( 'vc_base_review_item_filter_class', $class . ' ' . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		return array(
			'css_class_item' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
			'styles_item'    => $styles,
		);
	}

	public function _template( $temp = 'default', $item = array(), $atts = array() ) {
		$variables = array(
			'{layout}'         => fw_akg( 'review_layout', $item ),
			'{name}'           => fw_akg( 'label', $item ),
			'{position}'       => fw_akg( 'manger', $item ),
			'{content_item}'   => do_shortcode( fw_akg( 'content_item', $item ) ),
			'{image}'          => fw_akg( 'image', $item ),
			'{css_class_item}' => fw_akg( 'css_class_item', $item ),
		);

		$imgid            = $item['image'];
		$image_attributes = wp_get_attachment_image_src( $imgid, 'full' );
		$imgSrc           = $image_attributes[0];

		switch ( $temp ) {
			case 'default':
				$output = implode( '', array(
					'<article class="alone-review">',
						'<div class="bt-content">',
							'<div class="bt-excerpt">{content_item}</div>',
						'</div>',
            '<div class="bt-info-review">',
              '<div class="bt-thumb"><img src="' . $imgSrc . '"/></div>',
              '<div class="bt-name-position">',
                '<h3 class="bt-title">{name}</h3>',
                '<div class="bt-position">{position}</div>',
              '</div>',
            '</div>',
					'</article>',
				) );
				break;
				case 'style-1':
					$output = implode( '', array(
						'<article class="alone-review">',
							'<div class="bt-content">',
								'<div class="bt-excerpt">{content_item}</div>',
								'<div class="bt-position">{position}</div>',
							'</div>',
	            '<div class="bt-info-review">',
	              '<div class="bt-thumb"><img src="' . $imgSrc . '"/></div>',
	              '<div class="bt-name-position">',
	                '<h3 class="bt-title">{name}</h3>',
	              '</div>',
	            '</div>',
						'</article>',
					) );
					break;
		}

		return str_replace( array_keys( $variables ), array_values( $variables ), $output );
	}

	// Element HTML
	public function vc_base_review_html( $atts, $content ) {
		$atts['self']    = $this;
		$atts['content'] = $content;

		return fw_render_view( get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/client_review.php', array( 'atts' => $atts ), true );
	}

} // End Element Class


// Element Class Init
new vcBaseReview();
