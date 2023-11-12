<?php
/*
Element Description: VC Give Forms Slider
*/

// Element Class
class vcGiveFormsSlider extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        //global $__VcShadowWPBakeryVisualComposerAbstract;
        //add_action( 'init', array( $this, 'vc_give_forms_slider_mapping' ) );
        $this->vc_give_forms_slider_mapping();
        add_shortcode( 'vc_give_forms_slider', array( $this, 'vc_give_forms_slider_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_give_forms_slider', array( $this, 'vc_give_forms_slider_html' ));
    }

    // Element Mapping
    public function vc_give_forms_slider_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Give Forms Slider', 'alone'),
            'base' => 'vc_give_forms_slider',
            'description' => __('Give forms slider (carousel)', 'alone'),
            'category' => __('Give', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/give-donations-icon.png',
            'params' => array(
              array(
                'type' => 'textfield',
                'heading' => __('Number of Posts to Show', 'alone'),
                'param_name' => 'number_posts_show',
                'value' => '5',
                'admin_label' => true,
                'group' => 'Source',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Give Order', 'alone'),
                'param_name' => 'order',
                'value' => array(
                  __('ASC', 'alone') => 'ASC',
                  __('DESC', 'alone') => 'DESC',
                ),
                'std' => 'DESC',
                'description' => __( 'Select give type query.', 'alone' ),
                'group' => 'Source',
                'admin_label' => true,
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Data Type', 'alone' ),
                'param_name' => 'data_type',
                'value' => array(
                  __('By Date', 'alone') => 'p_date',
                  __('By Title', 'alone') => 'po_title',
                  __('By ID', 'alone') => 'by_id',
                ),
                'std' => 'p_date',
                'description' => __( 'Select a post data type', 'alone' ),
                'admin_label' => true,
                'group' => 'Source',
              ),
              array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Forms ID', 'alone' ),
                'param_name' => 'forms_id',
                'dependency' => array(
                  'element' => 'data_type',
                  'value' => 'by_id',
                ),
                'value' => '',
                'description' => __('Enter form id you would like show (Ex: 1,2,3).', 'alone'),
                'group' => 'Source',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Button Text', 'alone'),
                'param_name' => 'button_text',
                'value' => __('Read More', 'alone'),
                'description' => __('Enter the button text.', 'alone'),
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
                  'default' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-default.jpg',
                  'style-1' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-2.jpg',
                  'style-2' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-3.jpg',
				          'style-3' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-4.jpg',
				          'style-4' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-5.jpg',
				          'style-5' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-6.jpg',
                  'style-6' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-7.jpg',
                  'style-7' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-church.png',
                  'style-8' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-2.jpg',
				          'style-9' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-7.jpg',
                  'style-10' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-3.jpg',
                ),
                'std' => 'default',
                'description' => __('Select a layout display', 'alone'),
                'group' => 'Layout',
              ),
              /*** Slider Options ***/
              array(
                'type' => 'textfield',
                'heading' => __('Items', 'alone'),
                'param_name' => 'items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Margin', 'alone'),
                'param_name' => 'margin',
                'value' => '0',
                'admin_label' => false,
                'description' => __('margin-right(px) on item.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Loop', 'alone'),
                'param_name' => 'loop',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Infinity loop. Duplicate last and first items to get loop illusion.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Center', 'alone'),
                'param_name' => 'center',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Center item. Works well with even an odd number of items.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('stagePadding', 'alone'),
                'param_name' => __('stage_padding', 'alone'),
                'value' => '0',
                'description' => __('Padding left and right on stage (can see neighbours).', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('startPosition', 'alone'),
                'param_name' => __('start_position', 'alone'),
                'value' => '0',
                'description' => __('Start position or URL Hash string like `#id`.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Nav', 'alone'),
                'param_name' => 'nav',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Show next/prev buttons.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Dots', 'alone'),
                'param_name' => 'dots',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Show dots navigation.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('slideBy', 'alone'),
                'param_name' => __('slide_by', 'alone'),
                'value' => 1,
                'description' => __('Navigation slide by x. `page` string can be set to slide by page.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Autoplay', 'alone'),
                'param_name' => 'autoplay',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Autoplay.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('autoplayHoverPause', 'alone'),
                'param_name' => 'autoplay_hover_pause',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Pause on mouse hover.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('autoplayTimeout', 'alone'),
                'param_name' => 'autoplay_timeout',
                'value' => '5000',
                'description' => __('Autoplay interval timeout.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('smartSpeed', 'alone'),
                'param_name' => 'smart_speed',
                'value' => '250',
                'description' => __('AutoplaySpeed Calculate. More info to come..', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Table Items', 'alone'),
                'param_name' => 'responsive_table_items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the table screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Mobile Items', 'alone'),
                'param_name' => 'responsive_mobile_items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the mobile screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'alone' ),
                'param_name' => 'css',
                'group' => __( 'Design options', 'alone' ),
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
  		$css_class = apply_filters( 'vc_give_forms_slider_filter_class', 'wpb_theme_custom_element wpb_give_forms_slider ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

    public function _variables($form_id = null, $atts = array()) {
      $goal_option = get_post_meta( $form_id, '_give_goal_option', true );
      $form        = new Give_Donate_Form( $form_id );
      $goal        = $form->goal;
      $goal_format = get_post_meta( $form_id, '_give_goal_format', true );
      $income      = $form->get_earnings();
      $color       = get_post_meta( $form_id, '_give_goal_color', true );
      // set color if empty
      if(empty($color)) $color = '#01FFCC';
      if ( $goal_option == 'enabled' ) {
        $progress = ($goal === 0) ? 0 : round( ( $income / $goal ) * 100, 2 );
      }
      if ( $income >= $goal ) { $progress = 100; }
      $class_none = '';
      if ( $goal_option == 'disabled' ) { $class_none = 'class-none'; }
      // Get formatted amount.
      $income = give_human_format_large_amount( give_format_amount( $income ) );
      $goal = give_human_format_large_amount( give_format_amount( $goal ) );

      $button_donate = implode('', array(
        '<div class="give-button-donate">',
          do_shortcode('[give_form id="'. $form_id .'" show_title="true" show_goal="false" show_content="none" display_style="button"]'),
        '</div>',
      ));

	  $terms = get_the_terms( $form_id, 'give_forms_category' );
	  if ( $terms && ! is_wp_error( $terms ) ){
		$term = array_pop($terms);
		$ft_term_name = $term->name;
		$ft_term_link = get_term_link($term->slug, 'give_forms_category');
	  }else{
		$ft_term_name = esc_html__('Uncategory', 'alone');
		$ft_term_link = '#!';
	  }

        $variable = array(
		'{ft_term_name}' => $ft_term_name,
        '{ft_term_link}' => $ft_term_link,
        '{post_excerpt}' => get_the_excerpt($form_id),
        '{class_none}'=>$class_none,
        '{id}' => $form_id,
        '{form_title}' => get_the_title($form_id),
        '{form_link}' => get_permalink($form_id),
        '{form_featured_image}' => get_template_directory_uri() . '/assets/images/image-default-2.jpg',
        '{color}' => $color,
        '{author_name}' => get_the_author(),
      	'{date}' => get_the_date('d M, Y',$form_id),
        '{donors_count}' => $form->get_sales(),
		    '{raised_layout4}' => $income ,
		    '{goal_layout4}' => $goal ,
        '{pricing_text_layout4}' => sprintf(
          __('Raised: %1$s <span class="bt-padd">.</span> Goal: %2$s', 'alone'),
          '<span class="income">' . apply_filters( 'raised_output', give_currency_filter( $income ) ) . '</span>',
          '<span class="goal-text">' . apply_filters( 'give_goal_amount_target_output', give_currency_filter( $goal ) ) . '</span>'),
		    '{pricing_text_layout3}' => sprintf(
          __('Raised: %1$s / Goal: %2$s', 'alone'),
          '<span class="income">' . apply_filters( 'raised_output', give_currency_filter( $income ) ) . '</span>',
          '<span class="goal-text">' . apply_filters( 'give_goal_amount_target_output', give_currency_filter( $goal ) ) . '</span>'),
        '{pricing_text}' => sprintf(
          __('%1$s of %2$s raised', 'alone'),
          '<span class="income">' . apply_filters( 'raised_output', give_currency_filter( $income ) ) . '</span>',
          '<span class="goal-text">' . apply_filters( 'give_goal_amount_target_output', give_currency_filter( $goal ) ) . '</span>'),
        '{percentage_text}' => sprintf(
          __( '%s%% funded', 'alone' ),
          '<span class="give-percentage">' . apply_filters( 'percentage_output', round( $progress ) ) . '</span>'),

        '{goal_progress_bar_default}' => '',
        '{button_donate}' => $button_donate,
        '{none}' =>'',
      );
      //echo '<pre>' ;
    //  var_dump($button_text );
    //  echo '</pre>' ;
      //Sanity check - ensure form has goal set to output
      if ( empty( $form->ID )
      	|| ( is_singular( 'give_forms' ) && ! give_is_setting_enabled( $goal_option ) )
      	|| ! give_is_setting_enabled( $goal_option )
      	|| $goal == 0
      ) {
        $progressbar_style_1_attr = array(
          'class' => 'give-goal-progress-bar-none',
        );
        $variable['{goal_progress_bar_style_1}'] = '<div '. html_build_attributes($progressbar_style_1_attr) .'></div>';
      } else {
        $progressbar_style_default_attr = array(
          'class' => 'give-goal-progress-bar',
          'data-progressbar-svg' => json_encode(array(
            /* source */
            'shape' => 'circle', //'circle',
            'progressValue' => $progress,
            'color' => $color,
            'strokeWidth' => 20,
            'trailColor' => 'rgb(222, 222, 222)',
            'trailWidth' => 3,
            'easing' => 'easeInOut',
            'duration' => 1800,
            'textSetings' => '',
            'animateTransformSettings' => 'show',
            'delay' => 300,
            /* transform */
            'colorTransform' => $color,
            'strokeWidthTransform' => 20,
            /* text */
            'label' => '{percent}%',
            'text_color' => '#fff',
          )),
        );
        $progressbar_style_1_attr = array(
          'class' => 'give-goal-progress-bar',
          'data-progressbar-svg' => json_encode(array(
            /* source */
            'shape' => 'line', //'line',
            'progressValue' => $progress,
            'color' => $color,
            'strokeWidth' => 4,
            'trailColor' => 'rgb(222, 222, 222)',
            'trailWidth' => 4,
            'easing' => 'easeInOut',
            'duration' => 1800,
            'textSetings' => '',
            'animateTransformSettings' => 'show',
            'delay' => 300,
            'svgStyleWidth' => '100%',
            'svgStyleHeight' => '100%',
            /* transform */
            'colorTransform' => $color,
            'strokeWidthTransform' => 2,
            /* text */
            // 'textSetings' => 'show',
            // 'label' => '{percent}%',
            // 'text_color' => '#fff',
          )),
        );
        //echo '<pre>' ;
        //var_dump($none );
        //echo '</pre>' ;
        $variable['{goal_progress_bar_default}'] = '<div '. html_build_attributes($progressbar_style_default_attr) .'></div>';
        $variable['{goal_progress_bar_style_1}'] = '<div '. html_build_attributes($progressbar_style_1_attr) .'></div>';

      }
      /* check featured image exist */
      if ( has_post_thumbnail($form_id) ) {
        $variable['{form_featured_image}'] = get_the_post_thumbnail_url($form_id, $atts['image_size']);
      }
      $variable['{button_text}'] = $atts['button_text'] ;
      return $variable;
    }

    public function _template($temp = 'default', $form_id = null, $atts = array()) {
      $params = $this->_variables($form_id, $atts);

      $output = '';
      $template = array();

      /* layout default */
      $template['default'] = implode('', array(
        '<div class="item-inner give-forms-slider-layout-default">',
          '<div class="featured-image">',
            '<img src="{form_featured_image}" alt="#">',
            '<div class="give-goal-progress-wrap {class_none}">',
              '{goal_progress_bar_default}',
              '<div class="give-price-wrap">{pricing_text}</div>',
            '</div>',
            // '<a class="readmore-btn" href="{form_link}" title="{form_title}"><span class="ion-ios-arrow-right"></span></a>',
            '{button_donate}',
          '</div>',
          '<div class="entry-content">',
            '<div class="meta-donor">'. __('Donor', 'alone') .' {donors_count}</div>',
            '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
            '<div class="extra-meta">',
              '<div class="meta-item meta-author">{author_name}</div>',
              ' / ',
              '<div class="meta-item meta-date">{date}</div>',
            '</div>',
            '<a href="{form_link}" class="readmore-btn">{button_text} <span class="ion-ios-arrow-thin-right"></span></a>',
          '</div>',
        '</div>',
      ));

      /* layout style 1 horizontal give forms  */
      $template['style-1'] = implode('', array(
        '<div class="item-inner give-forms-slider-layout-style-1">',
          '<div class="featured-image " style="background: url({form_featured_image}) center center / cover, #9E9E9E;">',
            //'<img src="{form_featured_image}" alt="#">',
            '<a class="readmore-link" href="{form_link}" title="View detail"><span class="ion-ios-arrow-right"></span></a>',
          '</div>',
          '<div class="entry-content ">',
            '<div class="entry-content-inner">',
              '<div class="meta-donor">'. __('Donor', 'alone') .' {donors_count}</div>',
              '<div class="give-goal-progress-wrap {class_none}">',
                '<div class="give-price-wrap">{pricing_text}</div>',
                '{goal_progress_bar_style_1}',
              '</div>',
              '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
              '<div class="extra-meta">',
                '<div class="meta-item meta-author">{author_name}</div>',
                ' / ',
                '<div class="meta-item meta-date">{date}</div>',
              '</div>',
              '<a class="readmore-btn" href="{form_link}" title="{form_title}">{button_text} <span class="ion-ios-arrow-thin-right"></span></a>',
            '</div>',
          '</div>',
        '</div>',
      ));

      /* style-2 */
      $template['style-2'] = implode('', array(
        '<div class="item-inner give-forms-slider-layout-style-2">',
          '<div class="meta-donor">{donors_count} '. __('Donor', 'alone') .'</div>',
          '<div class="featured-image">',
            '<a href="{form_link}">',
              '<img src="{form_featured_image}" alt="#">',
            '</a>',
          '</div>',
          '<div class="entry-content ">',
            '<div class="entry-content-inner">',
              '<div class="give-goal-progress-wrap {class_none}">',
                '<div class="give-price-wrap">{pricing_text}</div>',
                '{goal_progress_bar_style_1}',
              '</div>',
              '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
              '<div class="entry-bot">',
                '<a class="readmore-btn" href="{form_link}" title="{form_title}">{button_text} <span class="ion-ios-arrow-thin-right"></span></a>',
                '<div class="extra-meta">',
                  '<div class="meta-item meta-author">{author_name}</div>',
                  ' / ',
                  '<div class="meta-item meta-date">{date}</div>',
                '</div>',
              '</div>',
            '</div>',
          '</div>',
        '</div>',
      ));

	  /* style-3 */
      $template['style-3'] = implode('', array(
        '<div class="item-inner give-forms-slider-layout-style-3">',
          '<div class="featured-image">',
            '<a href="{form_link}">',
              '<img src="{form_featured_image}" alt="#">',
            '</a>',
          '</div>',
          '<div class="entry-content ">',
            '<div class="entry-content-inner">',
			  '<div class="extra-meta">',
                '<div class="meta-item meta-date"><span class="ion-android-calendar"></span>{date}</div>',
              '</div>',
			  '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
              '<div class="give-goal-progress-wrap {class_none}">',
                '<div class="give-price-wrap">{pricing_text_layout3}</div>',
                '{goal_progress_bar_style_1}',
              '</div>',
              '<div class="entry-bot">',
                '<a class="readmore-btn" href="{form_link}" title="{form_title}"><span class="ion-log-in"></span>{button_text}</a>',
              '</div>',
            '</div>',
          '</div>',
        '</div>',
      ));

	  /* style-4 */
      $template['style-4'] = implode('', array(
        '<div class="item-inner give-forms-slider-layout-style-4">',
          '<div class="featured-image">',
            '<a href="{form_link}">',
              '<img src="{form_featured_image}" alt="#">',
            '</a>',
          '</div>',
          '<div class="entry-content ">',
            '<div class="entry-content-inner">',
			  '<div class="extra-meta">',
                '<div class="meta-item meta-date"><span class="ion-android-calendar"></span>{date}</div>',
              '</div>',
			  '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
              '<div class="give-goal-progress-wrap {class_none}">',
                '{goal_progress_bar_style_1}',
                '<div class="bt-com">Donation Completed</div>',
              '</div>',
              '<div class="entry-bot">',
                '<div class="give-price-raised"><span>'.esc_html__('Raised', 'alone').'</span><strong>$</strong>{raised_layout4}</div>',
                '<div class="give-price-goal"><span>Group Goal</span><strong>$</strong>{goal_layout4}</div>',
              '</div>',
            '</div>',
          '</div>',
        '</div>',
      ));

	   /* style-5 */
      $template['style-5'] = implode('', array(
        '<div class="item-inner give-forms-slider-layout-style-5">',
				'<div class="image-meta" style="background: url({form_featured_image}) no-repeat center center / cover, #333;">',
					'<div class="time-left-meta">{donors_count} '. __('Donor', 'alone') .'</div>',
				'</div>',
				'<div class="give-goal-progress-wrap {class_none}">',
					'<div class="give-price-wrap">{pricing_text}</div>',
					'{goal_progress_bar_style_1}',
				  '</div>',
				'<div class="info-meta">',
					'<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
					'<div class="button-meta">',
						'<div class="button-meta-inner">',
							'<a href="#" class="donate-button">{button_donate}</a>',
							'<a href="{form_link}" title="{form_title}" class="readmore-button" >{button_text}</a>',
						'</div>',
					'</div>',
				'</div>',
				'<div class="extra-meta">',
					'<div class="category"><i class="ion-ios-folder-outline"></i> {date}</div>',
					'<div class="author"><i class="ion-ios-person-outline"></i> {author_name}</div>',
				'</div>',
        '</div>',
      ));
      /* style-6 */
        $template['style-6'] = implode('', array(
          '<div class="item-inner give-forms-slider-layout-style-6">',
            '<div class="featured-image" style="background: url({form_featured_image}) no-repeat scroll center center / cover;">',
                '<div class="bt-overlay">',
                '</div>',
            '</div>',
            '<div class="entry-content ">',
              '<div class="entry-content-inner">',
  			        '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
                '<div class="bt-excerpt">{post_excerpt}</div>',
                '<div class="give-goal-progress-wrap {class_none}">',
                  '{goal_progress_bar_style_1}',
                  '<div class="give-price-wrap">{pricing_text_layout4}</div>',
                '</div>',
                '<div class="entry-bot">',
                  '<a href="{form_link}" class="donate-button"><div class="give-bt">DONATE</div></a>',
                '</div>',
              '</div>',
            '</div>',
          '</div>',
        ));
        /* style-7 */
          $template['style-7'] = implode('', array(
            '<div class="item-inner give-forms-slider-layout-style-7">',
              '<div class="featured-image" style="background: url({form_featured_image}) no-repeat scroll center center / cover;">',
                  '<div class="bt-overlay">',
                  '</div>',
              '</div>',
              '<div class="entry-content ">',
                '<div class="entry-content-inner">',
                  '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
                  '<div class="extra-meta">',
          					'<div class="date"> {date}</div>',
          					'<div class="author">By {author_name}</div>',
          				'</div>',
                '</div>',
              '</div>',
            '</div>',
          ));
          /* style-8 */
      		$template['style-8'] = implode('', array(
      			'<div class="item-inner give-forms-slider-layout-style-8">',
      				'<div class="featured-image">',
						'<div class="give-term"><a href="{ft_term_link}">{ft_term_name}</a></div>',
      					'<div class="give-image">',
      						'<div class="give-poster" style="background: url({form_featured_image}) no-repeat scroll center center / cover;"></div>',
      					'</div>',
      				'</div>',
      				'<div class="entry-content">',
      					'<h4 class="give-title"><a href="{form_link}" class="title-link">{form_title}</a></h4>',
      					'<div class="give-excerpt">{post_excerpt}</div>',
      					'<ul class="give-price">',
      						'<li><span>Goal</span>${goal_layout4}</li>',
      						'<li><span>'.esc_html__('Raised', 'alone').'</span>${raised_layout4}</li>',
      					'</ul>',
      					'<a class="give-readmore-btn" href="{form_link}" title="{form_title}">{button_text}</a>',
      				'</div>',
      			'</div>',
      		));
			/* style-9 */
          $template['style-9'] = implode('', array(
            '<div class="item-inner give-forms-slider-layout-style-9">',
              '<div class="entry-image">
				<div class="featured-image" style="background: url({form_featured_image}) no-repeat scroll center center / cover;"></div>
			  </div>',
              '<div class="entry-content ">',
                '<div class="entry-content-inner">',
					'<div class="give-term"><a href="{ft_term_link}">{ft_term_name}</a></div>',
                  '<h4 class="give-title"><a href="{form_link}" class="title-link">{form_title}</a></h4>',
					'<ul class="extra-meta">',
						'<li class="give-date"><i class="fa fa-calendar"></i> {date}</li>',
						'<li class="give-author"><i class="fa fa-user"></i> By {author_name}</li>',
					'</ul>',
					'<div class="give-goal-progress-wrap {class_none}">',
					  '<div class="give-price"><span>${raised_layout4}</span> '.esc_html__('Raised', 'alone').'</div>',
					  '{goal_progress_bar_style_1}',
					'</div>',
                '</div>',
              '</div>',
            '</div>',
          ));
          /* style-10 */
          		$template['style-10'] = implode('', array(
                '<div class="item-inner give-forms-slider-layout-style-10">',
                  '<div class="featured-image" style="background: url({form_featured_image}) no-repeat scroll center center / cover;">',
                      '<div class="bt-overlay">',
                      '</div>',
                  '</div>',
                  '<div class="entry-content ">',
                    '<div class="entry-content-inner">',
        			        '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
                      '<div class="give-date"><i class="ion-android-calendar"></i> {date}</div>',
                      '<ul class="give-price">',
            						'<li class="goal"><sub>$</sub>{goal_layout4}<span>Donation Needed</span></li>',
            						'<li class="heart"><a href="{form_link}"><i class="fa fa-heart" aria-hidden="true"></i></a></li>',
            					'</ul>',
                    '</div>',
                  '</div>',
                '</div>',
          		));
      /* layout blog-image */
      $template['block-image'] = implode('', array(

      ));

      $template = apply_filters('vc_give_forms_slider:template', $template);

      return str_replace(array_keys($params), array_values($params), fw_akg($temp, $template));
    }

    // Element HTML
    public function vc_give_forms_slider_html( $atts ) {
      $atts['self'] = $this;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_give_forms_slider.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcGiveFormsSlider();
