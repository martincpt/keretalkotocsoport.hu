<?php
/*
Element Description: VC Events Listing
*/

// Element Class
class vcEventsListing extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        //global $__VcShadowWPBakeryVisualComposerAbstract;
        //add_action( 'init', array( $this, 'vc_events_listing_mapping' ) );
        $this->vc_events_listing_mapping();
        add_shortcode( 'vc_events_listing', array( $this, 'vc_events_listing_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_events_listing', array( $this, 'vc_events_listing_html' ));
    }

    // Element Mapping
    public function vc_events_listing_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Events Listing', 'alone'),
            'base' => 'vc_events_listing',
            'description' => __('Events Listing', 'alone'),
            'category' => __('Events', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/event-listing.png',
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
                  __('By Category ID', 'alone') => 'cat_id',
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
                'type' => 'textfield',
                'heading' => __('Event Category IDs', 'alone'),
                'param_name' => 'cat_ids',
                'value' => '',
                'dependency' => array(
          				'element' => 'type',
          				'value' => 'cat_id',
          			),
                'description' => __( 'Enter event category id (Ex: 1,2,3).', 'alone' ),
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
                'type' => 'vc_image_picker',
                'heading' => __( 'Select Layout', 'alone' ),
                'param_name' => 'layout',
                'value' => array(
                  'default' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-default.jpg',
                  'simplify' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-simplify.jpg',
                  'block-image' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-t.jpg',
                  'final' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-f.jpg',
                  'style1' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-4.jpg',
                  'style2' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-layout-2.png',
                  'style3' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-3.jpg',
                  'style4' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-3.jpg',
                  'style5' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-3.jpg',
                  'style6' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-3.jpg',
                  'style7' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-3.jpg',
                  'style8' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-3.jpg',
                  'style9' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-3.jpg',
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
  		$css_class = apply_filters( 'vc_events_listing_filter_class', 'wpb_theme_custom_element wpb_events_listing ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

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
        'cat' => $cat_ids,
        'image_width' => '100%',
        'image_height' => 'auto',
        'image_post' => false,
      );

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

        case 'cat_id':
          $args['sort'] = 'cat_id';
          # code...
          break;

        case 'event_id':
          $args['sort'] = 'by_id';
          $args['post_by_id'] = explode(',', $event_ids);
          # code...
          break;
      }
      //echo '<pre>'; print_r($orderby); echo '</pre>';

      return  alone_get_posts($args);
    }

    public function variables($event_id, $item_data) {
      $country   = tribe_get_country( $event_id);
      $time_start   = get_post_meta( $event_id, '_EventStartDate', true ) ? get_post_meta( $event_id, '_EventStartDate', true ) : '';
      $time_end     = get_post_meta( $event_id, '_EventEndDate', true ) ? get_post_meta( $event_id, '_EventEndDate', true ) : '';
      $location   = tribe_get_full_address($event_id) ? tribe_get_full_address($event_id) : '';
      $date   = get_post_meta( $event_id, '_EventStartDateUTC', true ) ? get_post_meta( $event_id, '_EventStartDateUTC', true ) : '';
      $date_stars = date_i18n('d M Y', strtotime($date));
      $date_d = date_i18n('d', strtotime($date));
      $date_m = date_i18n('M', strtotime($date));
      $date_y = date_i18n('Y', strtotime($date));
      $date_t = date_i18n('H:i', strtotime($date));
      $date_tam = date_i18n('H : i A', strtotime($date));
      $time_stars1 = date_i18n('H:i a', strtotime($date));
      $event_url   = get_post_meta( $event_id, '_EventURL', true ) ? get_post_meta( $event_id, '_EventURL', true ) : '';
      $organizer = tribe_get_organizer($event_id);
      $variables = array(
        '{ID}'                => $event_id,
        '{category_list}'         => get_the_term_list($event_id, 'tribe_events_cat', '<div class="event-cate-list">',  ',',  '</div>'),
        '{post_title}'        => fw_akg('post_title', $item_data),
        '{post_link}'         => fw_akg('post_link', $item_data),
        '{post_author_link}'  => fw_akg('post_author_link', $item_data),
        '{post_author_name}'  => fw_akg('post_author_name', $item_data),
        '{post_excerpt}'      => get_the_excerpt($event_id),
        '{term_list}'         => get_the_term_list($event_id, 'tribe_events_cat', '<div class="event-term-list">', ',', '</div>'),
        '{start_date}'        => $date_stars,
        '{start_d}'           => $date_d,
        '{start_m}'           => $date_m,
        '{start_y}'           => $date_y,
        '{start_t}'           => $date_t,
        '{start_tam}'         => $date_tam,
        '{post_featured_image}' => get_template_directory_uri() . '/assets/images/image-default-2.jpg',
        '{venue}'             => $location,
        '{event_url}'         => $event_url,
        '{organizer}'         => $organizer,
        '{event_start_time}'  => $time_start,
        '{time_stars}'        => $time_stars1,
        '{country}'        => $country,
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
            '<div class="item-inner layout-{layout}">',
              '<div class="event-featured-image-wrap">',
                '<div class="event-thumbnail"><img src="{post_featured_image}" alt="{post_title}"></div>',
                '<a class="readmore-link" href="{post_link}" title="'. __('View detail', 'alone') .'"><span class="ion-ios-arrow-right"></span></a>',
              '</div>',
              '<div class="content-entry">',
                '{term_list}',
                '<div class="break-line"></div>',
                '<a href="{post_link}" class="title-link" title="{post_title}"><div class="title">{post_title}</div></a>',
                '<div class="event-start-time"><span class="ion-ios-location"></span> {venue}, <span class="ion-ios-timer"></span> {event_start_time}</div>',
              '</div>',
            '</div>',
          ));
          break;
        case 'simplify':
          $date1 = get_post_meta( $event_id, '_EventStartDateUTC', true ) ? get_post_meta( $event_id, '_EventStartDateUTC', true ) : '';
          $date_template = implode('', array(
            '<div class="date-entry">',
              '<div class="date-entry-inner">',
                '<div class="d-d">{start_d}</div>',
                '<div class="d-my">{start_m} {start_y}</div>',
                '<div class="d-t">{start_t}</div>',
              '</div>',
            '</div>',
          ));

          $output = implode('', array(
            '<div class="item-inner layout-{layout}">',
              '<div class="event-start-date">',
                $date_template,
              '</div>',
              '<div class="content-entry">',
                '<a href="{post_link}" class="title-link" title="{post_title}"><div class="title">{post_title}</div></a>',
                '<div class="venue-empty">{venue}</div>',
                '<a href="{post_link}" class="readmore-link">'. __('Read More', 'alone') .' <span class="ion-ios-arrow-thin-right"></span></a>',
              '</div>',
            '</div>',
          ));
          break;
		      case 'block-image':
          $output = implode('', array(
            '<div class="item-inner layout-{layout}">',
              '<div class="event-featured-image-wrap" style="background-image: url({post_featured_image})">',
      				    '<a class="readmore-link" href="{post_link}" title="'. __('View detail', 'alone') .'">Read more</a>',
      			  '</div>',
              '<div class="content-entry">',
                '{term_list}',
                '<div class="break-line"></div>',
                '<a href="{post_link}" class="title-link" title="{post_title}"><div class="title">{post_title}</div></a>',
                '<div class="event-start-time"><span class="ion-ios-location"></span> {venue}, <span class="ion-ios-timer"></span> {event_start_time}</div>',
              '</div>',
            '</div>',
          ));
          break;
		      case 'final':
          $output = implode('', array(
            '<div class="item-inner layout-{layout}">',
              '<div class="event-featured-image-wrap" style="background-image: url({post_featured_image})">',
			        '</div>',
              '<div class="content-entry">',
                '<a href="{post_link}" class="title-link" title="{post_title}"><div class="title">{post_title}</div></a>',
                '{term_list}',
				        '<div class="event-start-time"><span class="ion-ios-location"></span> {venue}</div>',
              '</div>',
            '</div>',
          ));
          break;
          case 'style1':
          $output = implode('', array(
            '<div class="item-inner layout-{layout}">',
              '<div class="event-featured-image-wrap">',
                '<div class="event-thumbnail" style="background: url({post_featured_image}) no-repeat scroll center center / cover;">',
                    '<div class="bt-overlay">',
                    '</div>',
                    '<div class="bt-start-t"><span>{start_d}</span>{start_m}</div>',
                '</div>',
              '</div>',
              '<div class="content-entry">',
                '<a href="{post_link}" class="title-link" title="{post_title}"><div class="title">{post_title}</div></a>',
                '<div class="event-start-time"><span class="ion-ios-location"></span> {venue} , <span class="ion-ios-pricetags"> </span> {term_list}</div>',
                '<div class="bt-excerpt">{post_excerpt}</div>',
                '<div class="bt-read"><a class="readmore-link" href="{post_link}" title="'. __('View detail', 'alone') .'">Read More</a></div>',
              '</div>',
            '</div>',
          ));
          break;
          case 'style2':
          $output = implode('', array(
            '<div class="item-inner layout-{layout}">',
              '<div class="event-featured-image-wrap">',
                '<div class="event-thumbnail" style="background: url({post_featured_image}) no-repeat scroll center center / cover;">',
                    '<div class="bt-overlay">',
                    '</div>',
                '</div>',
              '</div>',
              '<div class="content-entry">',
                '<div class="event-term"><span class="ion-ios-pricetags"> </span> {term_list}</div>',
                '<a href="{post_link}" class="title-link" title="{post_title}"><div class="title">{post_title}</div></a>',
                '<div class="bt-start-t"><i class="fa fa-calendar" aria-hidden="true"> </i> {event_start_time}</div>',
              '</div>',
            '</div>',
          ));
          break;
          case 'style3':
            $date = date_create($variables['{start_date}']);
            $date_template = implode('', array(
              '<div class="date-entry">',
                '<div class="date-entry-inner">',
                  '<div class="d-d">'. date_format($date,'d') .'</div>',
                  '<div class="d-my">'. date_format($date,'M Y') .'</div>',
                '</div>',
              '</div>',
            ));
            $time_template = implode('', array(
              '<div class="d-t"><i class="fa fa-clock-o" aria-hidden="true"> </i> '. date_format($date,'h:i - a') .'</div>',
            ));
            $output = implode('', array(
              '<div class="item-inner layout-{layout}">',
                '<div class="event-start-date">',
                  $date_template,
                '</div>',
                '<div class="content-entry">',
                  '<div class="content-top">'.$time_template.'<span><i class="fa fa-user" aria-hidden="true"> </i> {post_author_name}</span></div>',
                  '<a href="{post_link}" class="title-link" title="{post_title}"><h4 class="title">{post_title}</h4></a>',
                  '<div class="venue-empty"><i class="fa fa-map-marker" aria-hidden="true"> </i> {venue}</div>',
                  '<a href="{post_link}" class="readmore-link">'. __('Read More', 'alone') .'</a>',
                '</div>',
              '</div>',
            ));
            break;
            case 'style4':
              $output = implode('', array(
                '<div class="item-inner layout-{layout}">',
                  '<div class="event-featured-image-wrap">',
                    '<div class="event-thumbnail" style="background: url({post_featured_image}) no-repeat scroll center center / cover;">',
                        '<div class="bt-overlay">',
                        '</div>',
                    '</div>',
                  '</div>',
                  '<div class="content-title">',
                    '<a href="{post_link}" class="title-link" title="{post_title}"><h4 class="title">{post_title}</h4></a>',
                    '<span class="organizer">{organizer}</span>',
                    '<div class="venue-empty"><i class="fa fa-compass" aria-hidden="true"></i> {venue}</div>',
                    '<div class="d-t"><i class="fa fa-clock-o" aria-hidden="true"></i> {start_tam}</div>',
                  '</div>',
                  '<div class="content-entry">',
                    '<div class="bt-excerpt">{post_excerpt}</div>',
                    '<a href="{event_url}" class="url-link">{event_url}</a>',
                  '</div>',
                  '<div class="content-ticket">',
                    '<a href="{post_link}" class="readmore-link">'. __('Find tickets', 'alone') .'</a>',
                  '</div>',
                '</div>',
              ));
              break;
              case 'style5':
              $output = implode('', array(
                '<div class="item-inner layout-{layout}" >',
                  '<div class="event-featured-image-wrap">',
          					'<h4 class="event-date">',
          						'<div class="d-d">{start_d}</div>',
          						'<div class="d-m">{start_m}</div>',
          					'</h4>',
                    '<div class="event-thumbnail" style="background: url({post_featured_image}) no-repeat scroll center center / cover;">',
                        '<div class="bt-overlay">',
                        '</div>',
                    '</div>',
                  '</div>',
                  '<div class="content-title">',
                    '<h4 class="title"><a href="{post_link}" class="title-link" title="{post_title}">{post_title}</a></h4>',
                    '<span class="organizer">{organizer}</span>',
                  '</div>',
                  '<div class="content-entry">',
                    '<div class="venue-empty"><i class="fa fa-compass" aria-hidden="true"></i> {venue}</div>',
                    '<div class="d-t"><i class="fa fa-clock-o" aria-hidden="true"></i> {start_tam}</div>',
                  '</div>',
                  '<div class="content-ticket">',
                    '<a href="{post_link}" class="readmore-link">'. __('Find tickets', 'alone') .'</a>',
                  '</div>',
                '</div>',
              ));
              break;
              case 'style6':
              $output = implode('', array(
                '<div class="item-inner layout-{layout}" >',
                  '<div class="event-time">',
                    '{time_stars}',
                  '</div>',
                  '<div class="content-title">',
                    '<h4 class="title"><a href="{post_link}" class="title-link" title="{post_title}">{post_title}</a></h4>',
                  '</div>',
                  '<div class="content-entry">',
                    '<div class="venue-empty"><i class="fa fa-map-marker" aria-hidden="true"></i> {venue}</div>',
                  '</div>',
                  '<div class="organizer">',
                    '<div><span>'. __('Organized By :', 'alone') .'</span>{organizer}</div>',
                  '</div>',
                '</div>',
              ));
              break;
              case 'style7':
              $output = implode('', array(
                '<div class="item-inner layout-{layout}" >',
                  '<div class="event-featured-image-wrap">',
                    '<div class="event-thumbnail" style="background: url({post_featured_image}) no-repeat scroll center center / cover;">',
                        '<div class="bt-overlay">',
                        '</div>',
                        '<h4 class="event-date">',
                          '<div class="d-d">{start_d}</div>',
                          '<div class="d-m">{start_m}</div>',
                        '</h4>',
                    '</div>',
                  '</div>',
                  '<div class="content-title">',
                    '<h4 class="title"><a href="{post_link}" class="title-link" title="{post_title}">{post_title}</a></h4>',
                  '</div>',
                  '<div class="content-entry">',
                    '<div class="venue-empty"><i class="fa fa-map-marker" aria-hidden="true"></i> {venue}</div>',
                  '</div>',
                  '<div class="content-ticket">',
                    '<a href="{post_link}" class="readmore-link">'. __('Get A Ticket', 'alone') .'</a>',
                  '</div>',
                '</div>',
              ));
              break;
              case 'style8':
              $output = implode('', array(
                '<div class="item-inner layout-{layout}" >',
                  '<div class="event-featured-image-wrap">',
                    '<div class="event-thumbnail" style="background: url({post_featured_image}) no-repeat scroll center center / cover;">',
                        '<div class="bt-overlay">',
                        '</div>',
                    '</div>',
                  '</div>',
                  '<div class="content-entry">',
                    '{term_list}',
                    '<h4 class="title"><a href="{post_link}" class="title-link" title="{post_title}">{post_title}</a></h4>',
                    '<ul class="info">',
                      '<li class="country"><span>'. __('Event In:', 'alone') .'</span>{country}</li>',
                      '<li class="date"><span>'. __('DATE:', 'alone') .'</span>{start_date}</li>',
                    '</ul>',
                  '</div>',
                '</div>',
              ));
              break;
              case 'style9':
              $output = implode('', array(
                '<div class="item-inner layout-{layout}" >',
                    '<div class="bt-content-events">',
                        '<div class="bt-meta-events item-content-events">',
                            '<div class="bt-content-thumbnail">',
                                '<div class="event-featured-image">',
                                    '<div class="event-thumbnail" style="background: url({post_featured_image}) no-repeat scroll center center / cover;">',
                                        '<div class="bt-overlay">',
                                        '</div>',
                                    '</div>',
                                '</div>',
                            '</div>',
                            '<div class="bt-info-events">',
                                '<h3 class="title"><a href="{post_link}" class="title-link" title="{post_title}">{post_title}</a></h3>',
                                '<div class="date-start">{start_date} @ {start_tam}</div>',
                            '</div>',
                        '</div>',
                        '<div class="category-events item-content-events">',
                            '<div class="content-cate-events">',
                                '<p class="title-category">Events Category:</p>',
                                '{category_list}',
                            '</div>',
                         '</div>',
                        '<div class="location-event item-content-events"><span class="item-title">Location: </span> {venue}</div>',
                        '<div class="btn-event item-content-events"><a href="{post_link}">View</a></div>',
                    '</div>',
                '</div>',
              ));
              break;
      }

      return str_replace(array_keys($variables), array_values($variables), $output);
    }

    // Element HTML
    public function vc_events_listing_html( $atts, $content ) {
      $atts['self'] = $this;
      $atts['content'] = $content;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_events_listing.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcEventsListing();
