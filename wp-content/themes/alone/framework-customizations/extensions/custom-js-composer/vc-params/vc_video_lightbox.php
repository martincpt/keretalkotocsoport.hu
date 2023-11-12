<?php
/*
Element Description: VC Liquid Button
*/

// Element Class
class vcVideoLightbox extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        $this->vc_video_lightbox_mapping();
        add_shortcode( 'vc_video_lightbox', array( $this, 'vc_video_lightbox_html' ) );
    }

    // Element Mapping
    public function vc_video_lightbox_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Video Lightbox', 'alone'),
            'base' => 'vc_video_lightbox',
            'description' => __('video', 'alone'),
            'category' => __('Theme Elements', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/icon-pixabay.jpg',
            'params' => array(
              /* source */
              array(
                'type'  => 'textfield',
                'heading' => __('Heading', 'alone'),
                'param_name' => 'heading_text',
                'value' => __('Heading text', 'alone'),
                'description' => __('Enter heading featured box.', 'alone'),
                'group' => 'Source',
              ),
              array(
                'type' => 'textarea',
                'heading' => __('Content', 'alone'),
                'param_name' => 'content_text',
                'value' => __('I am featured box. Click edit button to change this text.', 'alone'),
                'description' => __('Enter content featured box.', 'alone'),
                'group' => 'Source',
              ),
              array(
                'type' => 'colorpicker',
                'heading' => __( 'Heading Color', 'alone' ),
                'param_name' => 'heading_color',
                'value' => '#fff', // default dark
                'description' => __( 'Choose heading color.', 'alone' ),
                'group' => 'Source',
              ),
              array(
                'type' => 'colorpicker',
                'heading' => __( 'Content Color', 'alone' ),
                'param_name' => 'content_color',
                'value' => '#fff', // default dark
                'description' => __( 'Choose content color.', 'alone' ),
                'group' => 'Source',
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
                'group' => 'Source',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Href', 'alone'),
                'param_name' => 'href',
                'description' => __('Enter href', 'alone'),
                'group' => 'Source',
                'value' => '#',
              ),
              array(
                'type' => 'colorpicker',
                'heading' => __('Icon Color', 'alone'),
                'param_name' => 'icon_color',
                'value' => '#FFFFFF', //Default Red color
                'description' => __('Select text color', 'alone'),
                'group' => 'Source',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('action', 'alone'),
                'param_name' => 'action',
                'description' => __('Select button click action', 'alone'),
                'value' => array(
                  __('Default', 'alone') => '',
                  __('Lightbox', 'alone') => 'lightbox',
                ),
                'std' => '',
                'group' => 'Source',
              ),
              array(
          			'type' => 'el_id',
          			'heading' => __( 'Element ID', 'alone' ),
          			'param_name' => 'el_id',
          			'description' => __( 'Enter element ID .', 'alone' ),
                'group' => 'Source',
              ),
          		array(
          			'type' => 'textfield',
          			'heading' => __( 'Extra class name', 'alone' ),
          			'param_name' => 'el_class',
          			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'alone' ),
                'group' => 'Source',
              ),
              /* css editor */
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'alone' ),
                'param_name' => 'css',
                'group' => __( 'Design Options general', 'alone' ),
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
  		 * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_liquid_button class
  		 *
  		 * @param string - filter_name
  		 * @param string - element_class
  		 * @param string - shortcode_name
  		 * @param array - shortcode_attributes
  		 *
  		 * @since 4.3
  		 */
  		$css_class = apply_filters( 'vc_video_lightbox_filter_class', 'wpb_theme_custom_element wpb_video_lightbox ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }


    public function _template($temp = 'default', $params = array()) {

    }

    // Element HTML
    public function vc_video_lightbox_html( $atts, $content ) {
      $atts['self'] = $this;
      $atts['content'] = $content;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_video_lightbox.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcVideoLightbox();
