<?php

class WPBakeryShortCode_bt_info_box extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'layout' => 'post',
			'css_animation' => '',
			'el_id' => '',
			'el_class' => '',

			'title' => '',
			'title_font_size' => '',
			'title_line_height' => '',
			'title_letter_spacing' => '',
			'title_color' => '',
			'title_space' => '',

			'desc_font_size' => '',
			'desc_line_height' => '',
			'desc_letter_spacing' => '',
			'desc_color' => '',
			'desc_space' => '',

			'post_icon' => '',
			'post_name' => '',
			'post_date' => '',
			
			'sermon_video' => '#',
			'sermon_audio' => '#',
			'sermon_download' => '#',
			'sermon_file' => '#',
			'sermon_share' => '#',
			'sermon_like' => '#',
			
			'contact_list' => '',

			'css' => ''

		), $atts));

		$content = wpb_js_remove_wpautop($content, true);

		$css_class = array(
			$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
			'bt-element',
			'bt-info-box-element',
			$layout,
			apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts )
		);

		$wrapper_attributes = array();
		if ( ! empty( $el_id ) ) {
			$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
		}

		/* Title */
		$style_title = array();
		if($title_font_size) $style_title[] = 'font-size: '.$title_font_size.';';
		if($title_line_height) $style_title[] = 'line-height: '.$title_line_height.';';
		if($title_letter_spacing) $style_title[] = 'letter-spacing: '.$title_letter_spacing.';';
		if($title_color) $style_title[] = 'color: '.$title_color.';';
		if($title_space) $style_title[] = 'margin-bottom: '.$title_space.';';

		$title_attributes = array();
		if ( ! empty( $style_title ) ) {
			$title_attributes[] = 'style="' . esc_attr( implode(' ', $style_title) ) . '"';
		}

		$title_link = isset($atts['title_link'])?vc_build_link( $atts['title_link'] ):array();
		$title_link_attributes = array();
		if(!empty($title_link)){
			if ( ! empty( $title_link['url'] ) ) {
				$title_link_attributes[] = 'href="' . esc_attr( $title_link['url'] ) . '"';
			}

			if ( ! empty( $title_link['target'] ) ) {
				$title_link_attributes[] = 'target="' . esc_attr( $title_link['target'] ) . '"';
			}

			if ( ! empty( $title_link['rel'] ) ) {
				$title_link_attributes[] = 'rel="' . esc_attr( $title_link['rel'] ) . '"';
			}

			if ( ! empty( $title_link['title'] ) ) {
				$title_link_attributes[] = 'title ="'.esc_attr($title_link['title']).'"';
			}
		}

		/* Description */
		$style_desc = array();
		if($desc_font_size) $style_desc[] = 'font-size: '.$desc_font_size.';';
		if($desc_line_height) $style_desc[] = 'line-height: '.$desc_line_height.';';
		if($desc_letter_spacing) $style_desc[] = 'letter-spacing: '.$desc_letter_spacing.';';
		if($desc_color) $style_desc[] = 'color: '.$desc_color.';';
		if($desc_space) $style_desc[] = 'margin-bottom: '.$desc_space.';';

		$desc_attributes = array();
		if ( ! empty( $style_desc ) ) {
			$desc_attributes[] = 'style="' . esc_attr( implode(' ', $style_desc) ) . '"';
		}
		
		

		ob_start();
		?>
		<div class="<?php echo esc_attr(implode(' ', $css_class)); ?>" <?php echo esc_attr(implode(' ', $wrapper_attributes)); ?>>
			<?php require get_template_directory().'/framework-customizations/extensions/custom-js-composer/vc_layout/info-box-'.$layout.'.php'; ?>
		</div>
		<?php
		return ob_get_clean();
	}
}

vc_map(array(
	'name' => esc_html__('Info Box', 'alone'),
	'base' => 'bt_info_box',
	'category' => esc_html__('BT Elements', 'alone'),
	'icon' => 'bt-icon',
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'alone'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Post Card', 'alone') => 'post',
				esc_html__('Sermon Card', 'alone') => 'sermon',
				esc_html__('Contact Info', 'alone') => 'contact'
			),
			'admin_label' => true,
			'description' => esc_html__('Select layout style in this elment.', 'alone')
		),
		vc_map_add_css_animation(),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'alone'),
			'param_name' => 'el_id',
			'value' => '',
			'description' => esc_html__('Enter element ID (Note: make sure it is unique and valid).', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class', 'alone'),
			'param_name' => 'el_class',
			'value' => '',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'alone'),
			'param_name' => 'title',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter title in this element.', 'alone')
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'alone'),
			'param_name' => 'title_link',
			'group' => esc_html__('Title', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Add custom link of the title in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Font Size', 'alone'),
			'param_name' => 'title_font_size',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter number  with px font size title in this element. Ex: 20px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Line Height', 'alone'),
			'param_name' => 'title_line_height',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter number with px line height title in this element. Ex: 24px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Letter Spacing', 'alone'),
			'param_name' => 'title_letter_spacing',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter number with px letter spacing title in this element. Ex: 1.2px', 'alone')
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Color', 'alone'),
			'param_name' => 'title_color',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Select color title in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Space', 'alone'),
			'param_name' => 'title_space',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter number with px space between title and description in this element. Ex: 15px', 'alone')
		),
		array(
			'type' => 'textarea_html',
			'heading' => esc_html__('Description', 'alone'),
			'param_name' => 'content',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter description in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Font Size', 'alone'),
			'param_name' => 'desc_font_size',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter number  with px font size description in this element. Ex: 14px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Line Height', 'alone'),
			'param_name' => 'desc_line_height',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter number with px line height description in this element. Ex: 24px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Letter Spacing', 'alone'),
			'param_name' => 'desc_letter_spacing',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter number with px letter spacing description in this element. Ex: 1px', 'alone')
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Color', 'alone'),
			'param_name' => 'desc_color',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Select color description in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Space', 'alone'),
			'param_name' => 'desc_space',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> array('post', 'sermon')
			),
			'description' => esc_html__('Please, enter number with px space between description and extra link description in this element. Ex: 15px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Icon', 'alone'),
			'param_name' => 'post_icon',
			'value' => '',
			'group' => esc_html__('Meta', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'post'
			),
			'description' => esc_html__('Please, enter icon in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Name', 'alone'),
			'param_name' => 'post_name',
			'value' => '',
			'group' => esc_html__('Meta', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'post'
			),
			'description' => esc_html__('Please, enter name in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Date', 'alone'),
			'param_name' => 'post_date',
			'value' => '',
			'group' => esc_html__('Meta', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'post'
			),
			'description' => esc_html__('Please, enter date in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Video', 'alone'),
			'param_name' => 'sermon_video',
			'value' => '',
			'group' => esc_html__('Meta', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'sermon'
			),
			'description' => esc_html__('Please, enter video url in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Audio', 'alone'),
			'param_name' => 'sermon_audio',
			'value' => '',
			'group' => esc_html__('Meta', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'sermon'
			),
			'description' => esc_html__('Please, enter audio url in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Download', 'alone'),
			'param_name' => 'sermon_download',
			'value' => '',
			'group' => esc_html__('Meta', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'sermon'
			),
			'description' => esc_html__('Please, enter download url in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('File', 'alone'),
			'param_name' => 'sermon_file',
			'value' => '',
			'group' => esc_html__('Meta', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'sermon'
			),
			'description' => esc_html__('Please, enter file url in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Share', 'alone'),
			'param_name' => 'sermon_share',
			'value' => '',
			'group' => esc_html__('Meta', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'sermon'
			),
			'description' => esc_html__('Please, enter share url in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Like', 'alone'),
			'param_name' => 'sermon_like',
			'value' => '',
			'group' => esc_html__('Meta', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'sermon'
			),
			'description' => esc_html__('Please, enter like url in this element.', 'alone')
		),
		
		array(
			'type' => 'param_group',
			'heading' => esc_html__('Contact List', 'alone'),
			'param_name' => 'contact_list',
			'value' => '',
			'group' => esc_html__('Data Setting', 'alone'),
			'dependency' => array(
				'element'=> 'layout',
				'value'=> 'contact'
			),
			'description' => esc_html__('Please, enter item - contact_list.', 'alone'),
			'params' => array(
				array(
					'type' => 'textfield',
					'class' => '',
					'heading' => esc_html__('Title', 'alone'),
					'param_name' => 'title',
					'value' => '',
					'admin_label' => true,
					'description' => esc_html__('Please, enter title in this element.', 'alone')
					
				),
				array(
					'type' => 'textarea',
					'class' => '',
					'heading' => esc_html__('Description', 'alone'),
					'param_name' => 'desc',
					'value' => '',
					'description' => esc_html__('Please, enter description in this element.', 'alone')
				)
			)
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'alone'),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'alone'),
		)
	)
));
