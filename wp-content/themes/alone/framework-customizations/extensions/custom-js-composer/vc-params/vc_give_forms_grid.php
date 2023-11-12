<?php
/*
Element Description: VC Give Forms Grid
*/

// Element Class
class vcGiveFormsGrid extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        //global $__VcShadowWPBakeryVisualComposerAbstract;
        $this->vc_give_forms_grid_mapping();
        add_shortcode( 'vc_give_forms_grid', array( $this, 'vc_give_forms_grid_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_give_forms_grid', array( $this, 'vc_give_forms_grid_html' ));
    }

    // Element Mapping
    public function vc_give_forms_grid_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Give Forms Grid', 'alone'),
            'base' => 'vc_give_forms_grid',
            'description' => __('Give forms grid', 'alone'),
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
                  'style1' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-default.jpg',
                  'style2' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-default.jpg',
                  'style3' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-default.jpg',
                ),
                'std' => 'default',
                'description' => __('Select a layout display', 'alone'),
                'group' => 'Layout',
              ),
              /*** grid Options ***/
              array(
                'type' => 'textfield',
                'heading' => __('Items', 'alone'),
                'param_name' => 'items',
                'value' => '3',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the screen.', 'alone'),
                'group' => 'Grid Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Space', 'alone'),
                'param_name' => 'space',
                'value' => '30',
                'admin_label' => false,
                'description' => __('The number of space you want to see on the screen.', 'alone'),
                'group' => 'Grid Options',
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
  		$css_class = apply_filters( 'vc_give_forms_grid_filter_class', 'wpb_theme_custom_element wpb_give_forms_grid ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

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

	  $terms = get_the_terms( $form_id, 'give_forms_category' );
	  if ( $terms && ! is_wp_error( $terms ) ){
		$term = array_pop($terms);
		$ft_term_name = $term->name;
		$ft_term_link = get_term_link($term->slug, 'give_forms_category');
	  }else{
		$ft_term_name = esc_html__('Uncategory', 'alone');
		$ft_term_link = '#!';
	  }

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

      $variable = array(
        '{post_excerpt}' => get_the_excerpt($form_id),
        '{class_none}'=>$class_none,
        '{id}' => $form_id,
        '{form_title}' => get_the_title($form_id),
        '{form_link}' => get_permalink($form_id),
        '{form_featured_image}' => get_template_directory_uri() . '/assets/images/image-default-2.jpg',
        '{color}' => $color,
        '{ft_term_name}' => $ft_term_name,
        '{ft_term_link}' => $ft_term_link,
        '{author_name}' => get_the_author(),
      	'{date}' => get_the_date('d M, Y',$form_id),
        '{donors_count}' => $form->get_sales(),
		    '{raised_layout}' => $income ,
		    '{goal_layout}' => $goal ,

        '{pricing_text}' => sprintf(
          __('%1$s of %2$s raised', 'alone'),
          '<span class="income">' . apply_filters( 'raised_output', give_currency_filter( $income ) ) . '</span>',
          '<span class="goal-text">' . apply_filters( 'give_goal_amount_target_output', give_currency_filter( $goal ) ) . '</span>'),
        '{percentage_text}' => sprintf(
          __( '%s%%', 'alone' ),
          '<span class="give-percentage">' . apply_filters( 'percentage_output', round( $progress ) ) . '</span>'),

        '{goal_progress_bar_default}' => '',
        '{button_donate}' => $button_donate,
        '{none}' =>'',
        '{left_percent}' => apply_filters( 'percentage_output', round( $progress ) ),
      );

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
            'strokeWidth' => 7,
            //'trailColor' => hex2rgba( $color, 0.3 ),
            'trailWidth' => 7,
            'easing' => 'easeInOut',
            'duration' => 1800,
            'textSetings' => '',
            'animateTransformSettings' => 'show',
            'delay' => 300,
            'colorTransform' => $color,
            'strokeWidthTransform' => 7,
          )),
        );
        $variable['{goal_progress_bar_default}'] = '<div '. html_build_attributes($progressbar_style_default_attr) .'></div>';
        $variable['{goal_progress_bar_style_1}'] = '<div '. html_build_attributes($progressbar_style_1_attr) .'></div>';

      }
      /* check featured image exist */
      if ( has_post_thumbnail($form_id) ) {
        $variable['{form_featured_image}'] = get_the_post_thumbnail_url($form_id, $atts['image_size']);
      }

      return $variable;
    }

    public function _template($temp = 'default', $form_id = null, $atts = array()) {
      $params = $this->_variables($form_id, $atts);

      $output = '';
      $template = array();

      /* layout default */
      $template['default'] = implode('', array(
        '<div class="item-inner give-forms-grid-layout-default">',
          '<div class="featured-image">',
            '<img src="{form_featured_image}" alt="#">',
          '</div>',
          '<div class="entry-content">',
            '<div class="form-category"><a style="color:{color}" href="{ft_term_link}">{ft_term_name}</a></div>',
            '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
            '<div class="extra-meta">',
              '<div class="meta-item meta-author">By {author_name}</div>',
              '<div class="give-price-wrap"><sup>$</sup>{goal_layout} <span>Collected</span></div>',
            '</div>',
          '</div>',
          '<div class="give-goal-progress-wrap {class_none}">',
            '{goal_progress_bar_style_1}<div class="form-percent" style="background:{color};left: calc({left_percent}%);"><span class="bt-arrow" style="background:{color}"></span>{percentage_text}</div>',
          '</div>',
        '</div>',
      ));
      /* layout blog-image */
      $template['style1'] = implode('', array(
        '<div class="item-inner give-forms-grid-layout-style1">',
          '<div class="featured-image">',
            '<img src="{form_featured_image}" alt="#">',
          '</div>',
          '<div class="entry-content">',
            '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
            '<div class="extra-meta">',
              '<div class="meta-excerpt">{post_excerpt}</div>',
            '</div>',
            '<div class="form-category"><a href="{ft_term_link}"><i class="fa fa-bookmark-o" aria-hidden="true"></i> {ft_term_name}</a></div>',
          '</div>',
        '</div>',
      ));
      /* layout 2 */
      $template['style2'] = implode('', array(
        '<div class="item-inner give-forms-grid-layout-style2">',
          '<div class="featured-image">',
            '<img src="{form_featured_image}" alt="#">',
      			'<div class="form-category"><a href="{ft_term_link}">{ft_term_name}</a></div>',
                '</div>',
                '<div class="entry-content">',
                  '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
      			'<div class="give-price">${goal_layout}</div>',
      			'<div class="give-colectted">{percentage_text} '.esc_html__('Donation Collected', 'alone').'</div>',
      			'<div class="give-progress">',
      				'<span></span><span></span><span></span>',
      				'<span></span><span></span><span></span>',
      				'<span></span><span></span><span></span>',
      				'<div class="give-percent" style="width: {left_percent}%"></div>',
      			'</div>',
          '</div>',
        '</div>',
        ));
		/* layout 3 */
      $template['style3'] = implode('', array(
        '<div class="item-inner give-forms-grid-layout-style3">',
          '<div class="featured-image">',
            '<img src="{form_featured_image}" alt="#">',
      			'<div class="form-category"><a href="{ft_term_link}">{ft_term_name}</a></div>',
                '</div>',
                '<div class="entry-content">',
                  '<a href="{form_link}" class="title-link"><h4 class="title">{form_title}</h4></a>',
      			'<div class="give-price"><span>${raised_layout}</span> '.esc_html__('Raised', 'alone').'</div>',
      			'<div class="give-progress">',
      				'<div class="give-percent" style="width: {left_percent}%"></div>',
      			'</div>',
				'<div class="give-colectted">{percentage_text} '.esc_html__('Donation Collected', 'alone').'</div>',
      			'<a href="{form_link}" class="readmore-link">'.esc_html__('Donate Now', 'alone').'</a>',
          '</div>',
        '</div>',
        ));
      $template = apply_filters('vc_give_forms_grid:template', $template);

      return str_replace(array_keys($params), array_values($params), fw_akg($temp, $template));
    }

    // Element HTML
    public function vc_give_forms_grid_html( $atts ) {
      $atts['self'] = $this;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_give_forms_grid.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcGiveFormsGrid();
