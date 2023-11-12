<?php
/*
Element Description: VC Events Grid
*/

// Element Class
class vcEventsGrid2 extends WPBakeryShortCode {

    // Element Init
    function __construct() {

        remove_shortcode('vc_events_grid');
        //global $__VcShadowWPBakeryVisualComposerAbstract;
        //add_action( 'init', array( $this, 'vc_events_grid_mapping' ) );
        $this->vc_events_grid_mapping();
        add_shortcode( 'vc_events_grid', array( $this, 'vc_events_grid_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_events_grid', array( $this, 'vc_events_grid_html' ));
    }

    // Element Mapping
    public function vc_events_grid_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Events Grid', 'alone'),
            'base' => 'vc_events_grid',
            'description' => __('Events Grid', 'alone'),
            'category' => __('Events', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/carousel-blog-card.png',
            'params' => array(
              /* source */
              array(
          			'type' => 'textfield',
          			'heading' => __( 'Total Items', 'alone' ),
          			'param_name' => 'post_total_items',
          			'description' => __( 'Set max limit for items in event or enter -1 to display all (limited to 1000).', 'alone' ),
                'value' => 3,
                'group' => 'Source',
                'admin_label'   => true,
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Events Order', 'alone'),
                'param_name' => 'order',
                'value' => array(
                  __('ASC', 'alone') => 'ASC',
                  __('DESC', 'alone') => 'DESC',
                ),
                'std' => 'DESC',
                'description' => __( 'Select event type query.', 'alone' ),
                'group' => 'Source',
                'admin_label' => true,
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Events Type', 'alone'),
                'param_name' => 'type',
                'value' => array(
                  __('By Date', 'alone') => 'v_date',
                  __('By Title', 'alone') => 'po_title',
                  //__('By Taxonomy ID', 'alone') => 'taxonomy_id',
                  __('By ID', 'alone') => 'event_id',
                ),
                'std' => 'v_date',
                'description' => __( 'Select event type query.', 'alone' ),
                'group' => 'Source',
                'admin_label' => true,
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Offset', 'alone'),
                'param_name' => 'offset',
                'value' => 0,
                'dependency' => array(
          				'element' => 'type',
          				'value' => 'recent',
          			),
                'description' => __( 'Enter offset number.', 'alone' ),
                'group' => 'Source',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Event IDs', 'alone'),
                'param_name' => 'event_ids',
                'value' => '',
                'dependency' => array(
          				'element' => 'type',
          				'value' => 'event_id',
          			),
                'description' => __( 'Enter event id (Ex: 1,2,3).', 'alone' ),
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
              /*** Layout Options ***/
              array(
                'type' => 'dropdown',
                'heading' => __('Image Size', 'alone'),
                'param_name' => 'image_size',
                'value' => array(
                  array('value' => 'thumbnail', 'label' => esc_html__('Thumbnail', 'alone')),
                  array('value' => 'medium', 'label' => esc_html__('Medium', 'alone')),
                  array('value' => 'medium_large', 'label' => esc_html__('Medium Large', 'alone')),
                  array('value' => 'large', 'label' => esc_html__('Large', 'alone')),
                  array('value' => 'alone-image-large', 'label' => esc_html__('Large (1228 x 691)', 'alone')),
                  array('value' => 'alone-image-medium', 'label' => esc_html__('Medium (614 x 346)', 'alone')),
                  array('value' => 'alone-image-small', 'label' => esc_html__('Small (295 x 166)', 'alone')),
                  array('value' => 'alone-image-square-800', 'label' => esc_html__('Square (800 x 800)', 'alone')),
                  array('value' => 'alone-image-square-300', 'label' => esc_html__('Square (300 x 300)', 'alone')),
                ),
                'std' => 'alone-image-medium',
                'description' => __('Select a image size', 'alone'),
                'group' => 'Layout',
              ),
              array(
            			'type' => 'textfield',
            			'heading' => __( 'Columns', 'alone' ),
            			'param_name' => 'user_columns',
            			'description' => __( '', 'alone' ),
                  'group' => 'Layout',
                  'std' => 3,
                ),
              array(
                'type' => 'vc_image_picker',
                'heading' => __( 'Select Layout', 'alone' ),
                'param_name' => 'layout',
                'value' => array(
                  'default' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-slider-layout-style-1.png',
                  'style1' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-slider-layout-style-1.png',
                ),
                'std' => 'default',
                'description' => __('Select a layout display', 'alone'),
                'group' => 'Layout',
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
  		 * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_custom_heading class
  		 *
  		 * @param string - filter_name
  		 * @param string - element_class
  		 * @param string - shortcode_name
  		 * @param array - shortcode_attributes
  		 *
  		 * @since 4.3
  		 */
  		$css_class = apply_filters( 'vc_events_grid_filter_class', 'wpb_theme_custom_element wpb_events_grid ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

    public function event_get_posts($atts = array()) {
      extract($atts);

      $args = array(
        'post_type' => 'tribe_events',
        'items' => $post_total_items,
        'image_class' => 'event-featured-image',
        'date_format' => 'l, j, M',
        'image_size' => $image_size,
        'image_width' => '100%',
        'image_height' => 'auto',
        'image_post' => false,
      );
      //var_dump($args);
      switch ($type) {
        case 'v_date':
          $args['sort'] = 'v_date';
          $args['offset'] = $offset;
          $args['order'] = $order;
          break;

        case 'po_title':
          $args['sort'] = 'po_title';
          $args['offset'] = $offset;
          $args['order'] = $order;
          break;

        case 'event_id':
          $args['sort'] = 'by_id';
          $args['post_by_id'] = explode(',', $event_ids);
          # code...
          break;
      }

      return  alone_get_posts($args);
    }

    public function variables($event_id, $item_data) {

      $display_year = get_theme_mod( 'alone_event_display_year', false );
      $class        = 'item-event';

      $time_start   = get_post_meta( $event_id, '_EventStartDate', true ) ? get_post_meta( $event_id, '_EventStartDate', true ) : '';
      $time_end     = get_post_meta( $event_id, '_EventEndDate', true ) ? get_post_meta( $event_id, '_EventEndDate', true ) : '';
      $address   = tribe_get_full_address($event_id) ? tribe_get_full_address($event_id) : '';
      $venue = tribe_get_venue($event_id);
      $location = '<span class="custom-tribe-venue">'.$venue.'</span><br>'.$address;
      //var_dump($location);

      $date   = get_post_meta( $event_id, '_EventStartDateUTC', true ) ? get_post_meta( $event_id, '_EventStartDateUTC', true ) : '';
      $strtotime = strtotime($date);
      $date_stars = date_i18n('Y F d.', $strtotime);
      $date_1 = date_i18n('d', $strtotime);
      $date_2 = date_i18n('M Y', $strtotime);
      $date_3 = get_date_from_gmt( date( 'H:i', $strtotime), 'H:i' ); // date_i18n('H:i', strtotime($date));
      //echo '<pre>'; print_r(get_post_meta( $event_id)); echo '</pre>';
      //var_dump($new_date);
      $variables = array(
        '{ID}'                => $event_id,
        '{post_title}'        => fw_akg('post_title', $item_data),
        '{post_link}'         => fw_akg('post_link', $item_data),
        '{post_author_link}'  => fw_akg('post_author_link', $item_data),
        '{post_author_name}'  => fw_akg('post_author_name', $item_data),
        '{post_excerpt}'      => get_the_excerpt($event_id),
        '{term_list}'         => get_the_term_list($event_id, 'tribe_events_cat', '<div class="event-term-list">', ',', '</div>'),
        '{post_featured_image}' => get_template_directory_uri() . '/assets/images/image-default-2.jpg',

        '{start_date}'        => $date_stars,
        '{start_1}'           => $date_1,
        '{start_2}'           => $date_2,
        '{start_3}'           => $date_3,
        '{term_list}'         => get_the_term_list($event_id, 'tribe_events_cat', '<div class="event-term-list">', ',', '</div>'),
        '{post_featured_image}' => get_template_directory_uri() . '/assets/images/image-default-2.jpg',
        '{event_start_time}'  => (function_exists('bearsthemes_event_get_start_time')) ? bearsthemes_event_get_start_time($event_id) : '',
        '{event_start_time_1}'  => (function_exists('bearsthemes_event_get_start_time')) ? $new_date : '',
        '{venue}'             => $location,
      );

      return $variables;
    }

    public function _template($temp = 'default', $item = array(), $atts = array()) {
      $output = '';
      $event_id = fw_akg('post_id', $item);
      $variables = $this->variables($event_id, $item);

      /* check featured image exist */
      if ( has_post_thumbnail($event_id) ) {
        $variables['{post_featured_image}'] = get_the_post_thumbnail_url($event_id, fw_akg('image_size', $atts));
      }

      $variables['{layout}'] = $atts['layout'];
      switch ($temp) {
        case 'default':
          $output = implode('', array(
            '<div class="item-inner grid-item layout-{layout}">',
              '<div class="event-featured-image-wrap">',
                '<a href="{post_link}"><div class="event-thumbnail" style="background: url({post_featured_image}) center center / cover, #9E9E9E;"></div></a>',
                '<div class="alone-event-date">',
                  '<div class="alone-event-day"><span style="text-transform:capitalize;">{start_date}</span><!--<span>{start_1}</span> {start_2}--></div>',
                '</div>',
              '</div>',
              '<div class="content-entry">',
                '<a href="{post_link}" class="title-link" title="{post_title}"><div class="title">{post_title}</div></a>',
                '<div class="alone-event-time"><i class="fa fa-clock-o" aria-hidden="true"> </i> {start_3} <span> By {post_author_name}</span></div>',
                '<p class="alone-excerpt">{post_excerpt}</p>',
                '<div class="venue-empty"><i class="fa fa-map-marker" aria-hidden="true"> </i> {venue}</div>',
              '</div>',
            '</div>',
          ));
          break;
          case 'style1':
            $output = implode('', array(
              '<div class="item-inner grid-item layout-{layout}">',
                '<div class="bg-grid">',
                  '<div class="event-featured-image-wrap">',
                    '<a href="{post_link}"><div class="event-thumbnail" style="background: url({post_featured_image}) center center / cover, #9E9E9E;"></div></a>',
                  '</div>',
                  '<div class="content-entry">',
                    '<a href="{post_link}" class="title-link" title="{post_title}"><div class="title">{post_title}</div></a>',
                    '<div class="venue-empty"><i class="fa fa-map-marker" aria-hidden="true"> </i> {venue}</div>',
                  '</div>',
                  '<div class="alone-event-bottom">',
                    '<div class="alone-event-day"><span>{start_1}</span> {start_2}</div>',
                    '<div class="alone-event-author"><span> By {post_author_name}</span></div>',
                  '</div>',
                '</div>',
              '</div>',
            ));
            break;
      }

      return str_replace(array_keys($variables), array_values($variables), $output);
    }

    // Element HTML
    public function vc_events_grid_html( $atts, $content ) {
      $atts['self'] = $this;
      $atts['content'] = $content;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_events_grid.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcEventsGrid2();
