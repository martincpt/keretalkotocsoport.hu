<?php
/*
Element Description: VC Team Listing
*/

// Element Class
class vcTeamListing extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        //global $__VcShadowWPBakeryVisualComposerAbstract;
        //add_action( 'init', array( $this, 'vc_team_listing_mapping' ) );
        $this->vc_team_listing_mapping();
        add_shortcode( 'vc_team_listing', array( $this, 'vc_team_listing_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_team_listing', array( $this, 'vc_team_listing_html' ));
    }

    // Element Mapping
    public function vc_team_listing_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Team Listing', 'alone'),
            'base' => 'vc_team_listing',
            'description' => __('Team Listing', 'alone'),
            'category' => __('Theme Elements', 'alone'),
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
                'heading' => __('Team Type', 'alone'),
                'param_name' => 'type',
                'value' => array(
                  __('Recent', 'alone') => 'recent',
                  // __('By Taxonomy ID', 'alone') => 'taxonomy_id',
                //  __('By ID', 'alone') => 'team_id',
                ),
                'std' => 'recent',
                'description' => __( 'Select team type query.', 'alone' ),
                'group' => 'Source',
                'admin_label' => true,
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
          			'param_name' => 'team_columns',
          			'description' => __( '', 'alone' ),
                'group' => 'Layout',
              ),
              array(
                'type' => 'vc_image_picker',
                'heading' => __( 'Select Layout', 'alone' ),
                'param_name' => 'layout',
                'value' => array(
                  'default' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/team-default.jpg',
                  'simplify' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-4.jpg',
                  //'block-image' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-2.jpg',
                  //'style-1' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/post-skin-default.jpg',
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
  		$css_class = apply_filters( 'vc_team_listing_filter_class', 'wpb_theme_custom_element wpb_team_listing ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

    public function team_get_posts($atts = array()) {
      extract($atts);

      $args = array(
        'post_type' => 'team',
        'items' => $post_total_items,
        'image_class' => 'team-featured-image',
        'date_format' => 'l, j, M',
        'image_size' => $image_size,
        'cat' => $taxonomy_ids,
        'image_width' => '100%',
        'image_height' => 'auto',
        'image_post' => false,
      );

      switch ($type) {
        case 'recent':
          $args['sort'] = 'recent';
          $args['offset'] = $offset;
          break;

        case 'team_id':
          $args['sort'] = 'by_id';
          $args['post__in'] = explode(',', $team_ids);
          # code...
          break;
      }

      return  alone_get_posts($args);
    }

    public function get_facebook_html($pid) {
        $facebook = get_post_meta($pid,'tb_team_facebook',true);
        return ! empty($facebook) ? implode('', array(
          '<li><a href="'.esc_url($facebook).'"><i class="fa fa-facebook"></i></a></li>',
        )) : '';
    }
    public function get_twitter_html($pid) {
        $twitter = get_post_meta($pid,'tb_team_twitter',true);
        return ! empty($twitter) ? implode('', array(
          '<li><a href="'.esc_url($twitter).'"><i class="fa fa-twitter"></i></a></li>',
        )) : '';
    }
    public function get_linkedin_html($pid) {
        $linkedin = get_post_meta($pid,'tb_team_linkedin',true);
        return ! empty($linkedin) ? implode('', array(
          '<li><a href="'.esc_url($linkedin).'"><i class="fa fa-linkedin"></i></a></li>',
        )) : '';
    }
    public function get_pinterest_html($pid) {
        $pinterest = get_post_meta($pid,'tb_team_pinterest',true);
        return ! empty($pinterest) ? implode('', array(
          '<li><a href="'.esc_url($pinterest).'"><i class="fa fa-pinterest"></i></a></li>',
        )) : '';
    }
    public function get_google_plus_html($pid) {
        $google_plus = get_post_meta($pid,'tb_team_google_plus',true);
        return ! empty($google_plus) ? implode('', array(
          '<li><a href="'.esc_url($google_plus).'"><i class="fa fa-google-plus"></i></a></li>',
        )) : '';
    }
    public function get_tumblr_html($pid) {
        $tumblr = get_post_meta($pid,'tb_team_tumblr',true);
        return ! empty($tumblr) ? implode('', array(
          '<li><a href="'.esc_url($tumblr).'"><i class="fa fa-tumblr"></i></a></li>',
        )) : '';
    }
    public function get_instagram_html($pid) {
        $instagram = get_post_meta($pid,'tb_team_instagram',true);
        return ! empty($instagram) ? implode('', array(
          '<li><a href="'.esc_url($instagram).'"><i class="fa fa-instagram"></i></a></li>',
        )) : '';
    }
    public function get_flickr_html($pid) {
        $flickr = get_post_meta($pid,'tb_team_flickr',true);
        return ! empty($flickr) ? implode('', array(
          '<li><a href="'.esc_url($flickr).'"><i class="fa fa-flickr"></i></a></li>',
        )) : '';
    }

    public function variables($team_id, $item_data) {
      $team_options = fw_get_db_post_option($team_id);
      $share_ic = get_template_directory_uri() . '/assets/images/share-b.png';
      $limit_space = fw_akg('total_space', $team_options);

      $variables = array(
        '{ID}'                => $team_id,
        '{team_excerpt}' => get_the_excerpt($team_id),
        '{post_title}'        => fw_akg('post_title', $item_data),
        '{post_link}'         => fw_akg('post_link', $item_data),
        '{post_author_link}'  => fw_akg('post_author_link', $item_data),
        '{post_author_name}'  => fw_akg('post_author_name', $item_data),
        '{post_excerpt}'      => fw_akg('post_excerpt', $item_data),
        '{image_share}'    => '<img src="'. $share_ic .'" class="share-ic-p" alt="#">',
        '{post_featured_image}' => get_template_directory_uri() . '/assets/images/image-default-2.jpg',
        '{post_excerpt}'      => fw_akg('post_excerpt', $item_data),
        '{position}' => get_post_meta($team_id,'tb_team_position',true),
        '{facebook}' => $this->get_facebook_html($team_id),
        '{twitter}' => $this->get_twitter_html($team_id),
        '{linkedin}' => $this->get_linkedin_html($team_id),
        '{pinterest}' => $this->get_pinterest_html($team_id),
        '{google_plus}' => $this->get_google_plus_html($team_id),
        '{tumblr}' => $this->get_tumblr_html($team_id),
        '{instagram}' => $this->get_instagram_html($team_id),
        '{flickr}' => $this->get_flickr_html($team_id),
      );

      return $variables;
    }

    public function _template($temp = 'default', $item = array(), $atts = array()) {
      $output = '';
      $team_id = fw_akg('post_id', $item);
      $variables = $this->variables($team_id, $item);
      /* check featured image exist */
      if ( has_post_thumbnail($team_id) ) {
        $variables['{post_featured_image}'] = get_the_post_thumbnail_url($team_id, fw_akg('image_size', $atts));
      }

      $variables['{layout}'] = $atts['layout'];

      switch ($temp) {
        case 'default':
          $output = implode('', array(
            '<article class="bt-article layout-{layout}">',
            	'<div class="bt-thumb">',
                '<img src="{post_featured_image}" alt="{post_title}">',
            		'<div class="bt-overlay">',
            		'</div>',
            	'</div>',
            	'<div class="bt-content">',
            		'<h3 class="bt-title"><a href="{post_link}">{post_title}</a></h3>',
                '<div class="bt-excerpt">{post_excerpt}</div>',
                '<a class="bt-read" href="{post_link}">Learn more</a>',
            	'</div>',
            '</article>',
          ));
          break;
          case 'simplify':
            $output = implode('', array(
              '<article class="bt-article layout-{layout}">',
              	'<div class="bt-thumb" style="background: url({post_featured_image}) no-repeat center center / cover, #fafafa;">',
              		'<div class="bt-overlay">',
              		'</div>',
              	'</div>',
              	'<div class="bt-content">',
              		'<h3 class="bt-title"><a href="{post_link}">{post_title}</a></h3>',
                  '<div class="bt-excerpt">{team_excerpt}</div>',
              	'</div>',
              '</article>',
            ));
            break;
      }

      return str_replace(array_keys($variables), array_values($variables), $output);
    }

    // Element HTML
    public function vc_team_listing_html( $atts, $content ) {
      $atts['self'] = $this;
      $atts['content'] = $content;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_team.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcTeamListing();
