<?php
/* Extra field */
if (class_exists("WpbakeryShortcodeParams")){
	/*
	 * Taxonomy checkbox list field
	 */
	function alone_taxonomy_settings_field($settings, $value) {
		$dependency = function_exists('vc_generate_dependencies_attributes') ? vc_generate_dependencies_attributes($settings) : '';
		$terms_fields = array();
		$value_arr = $value;

		if (!is_array($value_arr)) {
			$value_arr = array_map('trim', explode(',', $value_arr));
		}

		if (!empty($settings['taxonomy'])) {
			$terms = get_terms($settings['taxonomy'], 'orderby=count&hide_empty=0');

			if ($terms && !is_wp_error($terms)) {
				foreach ($terms as $term) {
					$terms_fields[] = sprintf(
							'<label><input onclick="changeCategory(this);" id="%s" class="tb-check-taxonomy %s" type="checkbox" name="%s" value="%s" %s/>%s</label>', $settings['param_name'] . '-' . $term->slug, $settings['param_name'] . ' ' . $settings['type'], $settings['param_name'], $term->slug, checked(in_array($term->slug, $value_arr), true, false), $term->name
					);
				}
			}
		}

		return '<div class="tb-taxonomy-block">'
				. '<input type="hidden" name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-checkboxes ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" value="' . $value . '" ' . $dependency . ' />'
				. '<div class="tb-taxonomy-terms">'
				. implode($terms_fields)
				. '</div>'
				. '</div>';
	}
	WpbakeryShortcodeParams::addField('bt_taxonomy', 'alone_taxonomy_settings_field', get_template_directory_uri().'/assets/js/vc_taxonomy.js');

}

/* Display paginate links */
if ( ! function_exists( 'alone_paginate_links' ) ) {
	function alone_paginate_links($wp_query) {
		?>
		<nav class="bt-pagination" role="navigation">
			<?php
				$big = 999999999; // need an unlikely integer
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
					'prev_text' => '<i class="fa fa-angle-left"></i>'.esc_html__('Previous', 'alone'),
					'next_text' => esc_html__('Next', 'alone').'<i class="fa fa-angle-right"></i>',
				) );
			?>
		</nav>
		<?php
	}
}


/* Post thumbnail render function */
function alone_post_thumbnail_render($image_type = 'auto', $img_size = 'full', $img_ratio= '66%'){
	$thumbnail_id = get_post_thumbnail_id();
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, $img_size, false );

	$item_attributes = array();
	$item_attributes[] = 'class="bt-thumb '.esc_attr($image_type).'"';

	if($image_type == 'ratio'){
		$item_attributes[] = 'style="padding-bottom: '.esc_attr($img_ratio).';"';
	}

	$output = '<div '.implode(' ', $item_attributes).'>
				<div class="bt-poster" style="background-image: url('.esc_url($thumbnail[0]).');"></div>
				<img src="'.esc_url($thumbnail[0]).'" alt="'.esc_attr('Post Thumbnail', 'alone').'"/>
			</div>';

	return $output;
}

/**
 * alone_load_custom_elements
 *
 */
if(! function_exists('alone_vc_load_custom_elements')) :
  function alone_vc_load_custom_elements() {
    $path = get_template_directory() . '/framework-customizations/extensions/custom-js-composer/';
    $new_elements = array(
      'vc_posts_slider_2',
      'vc_base_carousel',
      'vc_featured_box',
      'vc_pricing_table',
      'vc_progressbar_svg',
      'vc_posts_grid_resizable',
      'vc_liquid_button',
      'vc_counter_up',
	    'vc_base_testimonial',
	    'vc_logo_carousel',
	    'vc_carousel_blog_card',
	    'vc_give_forms_listing',
	    'vc_service_box',
      'client_review',
      'vc_countdown',
      'vc_team',

			'vc_socials_media',
		  'vc_image_box',
			'vc_info_box',
			'vc_partner_box',
			'vc_campaign_box',
			'vc_donor_box',
		  'vc_blog_grid',
		  'vc_blog_template',
			'vc_blog_list',
	  	'vc_blog_carousel',
	  	'vc_resource_grid',
	  	'vc_resource_carousel',
	  	'vc_team_grid',
	  	'vc_team_carousel',
			'vc_portfolio_carousel',
	  	'vc_events_table',
			'vc_video_lightbox',
			'vc_sermons_template',
    );

    /* check plugin Give (donations) exist  */
    if (class_exists('Give')) :
      $new_elements[] = 'grid_builder_give_goal_progress';
      $new_elements[] = 'grid_builder_give_button_donate';
      $new_elements[] = 'vc_give_forms_slider';
      $new_elements[] = 'vc_give_forms_grid';
    endif;

    /* portfolio */
    if (function_exists('fw_ext') && fw_ext('portfolio')) {
      $new_elements[] = 'vc_portfolio_grid';
    }

    /* event */
    if ( is_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ) {
      $new_elements[] = 'vc_events_listing';
      $new_elements[] = 'vc_events_grid';
      $new_elements[] = 'vc_events_slider';
    }

	/* church */
	if (class_exists('Bears_Church')) :
      $new_elements[] = 'vc_events_church';
      $new_elements[] = 'vc_location_church_carousel';
      $new_elements[] = 'vc_sermon_slider';
    endif;

    foreach($new_elements as $item) :
      $dir = $path . 'vc-params/' . $item . '.php';
      if(file_exists($dir)) require $dir;
    endforeach;
  }
endif;

if(! function_exists('alone_vc_load_templates')) :
  /**
   * alone_vc_load_templates
   * @since 0.0.7
   */
  function alone_vc_load_templates($folder = 'default_templates') {
    $templates = array();

    //Load default tempaltes
    foreach (glob($folder) as $filename)
    {
      $template_params = alone_vc_get_template_data($filename);
      $filename_clean = basename($filename, '.php');

      $data = array();
      $data['name']         = $template_params['template_name'];
      $data['weight']       = 0;
      $data['custom_class'] = 'vc-default-temp-' . $filename_clean;
      $data['content']      = file_get_contents($filename);
      $templates[] = $data;
    }

    return $templates;
  }
endif;

if(! function_exists('alone_vc_get_template_data')) :
  /**
   * vctl_get_template_data
   * @since 0.0.7
   */
  function alone_vc_get_template_data($file) {
    $default_headers = array(
      'template_name' => 'Template Name',
      'preview_image' => 'Preview Image',
      'descriptions'  => 'Descriptions',
    );

    return get_file_data($file, $default_headers);
  }
endif;
