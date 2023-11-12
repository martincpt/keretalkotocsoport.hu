<?php
class WPBakeryShortCode_bt_partner_box extends WPBakeryShortCode {
	
	protected function content( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'layout' => 'default',
			'css_animation' => '',
			'el_id' => '',
			'el_class' => '',
			
			'logo' => '',
			'logo_size' => '',
			'logo_space' => '',
			
			'video_link' => '',
			
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
			
			'css' => ''
			
		), $atts));
		
		$content = wpb_js_remove_wpautop($content, true);
		
		$css_class = array(
			$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
			'bt-element',
			'bt-partner-box-element',
			$layout,
			apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts )
		);
		
		$wrapper_attributes = array();
		if ( ! empty( $el_id ) ) {
			$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
		}
		
		/* Logo */
		$style_logo = array();
		if($logo_space) $style_logo[] = 'margin-bottom: '.$logo_space.';';
		
		$logo_attributes = array();
		if ( ! empty( $style_logo ) ) {
			$logo_attributes[] = 'style="' . esc_attr( implode(' ', $style_logo) ) . '"';
		}
		
		$logo_size_style = $logo_size?'width: '.$logo_size.'; height: auto;':'';
		$attachment_image = wp_get_attachment_image_src($logo, 'full', false);
		$logo = $attachment_image[0]?'<img src="'.esc_url($attachment_image[0]).'" style="'.esc_attr($logo_size_style).'" alt="'.esc_attr__('Logo', 'alone').'"/>':'';
		
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
			<div class="bt-logo" <?php echo implode(' ', $logo_attributes); ?>>
				<?php
					if($logo) echo '<div class="bt-logo-inner">'.$logo.'</div>';
					if($video_link) echo '<a href="'.esc_url($video_link).'" target="_blank" class="bt-video-icon"><i class="fa fa-play"></i></a>';
				
				?>
			</div>
			<div class="bt-content">
				<?php 
					if($title){
						if(!empty($title_link_attributes)){
							echo '<h3 class="bt-title"><a '.implode(' ', $title_attributes).' '.implode(' ', $title_link_attributes).'>'.$title.'</a></h3>';
						}else{
							echo '<h3 class="bt-title" '.implode(' ', $title_attributes).'>'.$title.'</h3>';
						}
					}
					if($content) echo '<div class="bt-desc" '.implode(' ', $desc_attributes).'>'.$content.'</div>';
				?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}

vc_map(array(
	'name' => esc_html__('Partner Box', 'alone'),
	'base' => 'bt_partner_box',
	'category' => esc_html__('BT Elements', 'alone'),
	'icon' => 'bt-icon',
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'alone'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Default', 'alone') => 'default'
			),
			'description' => esc_html__('Select layout display in this element.', 'alone')
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
			'type' => 'attach_image',
			'heading' => esc_html__('Logo', 'alone'),
			'param_name' => 'logo',
			'value' => '',
			'group' => esc_html__('Logo', 'alone'),
			'description' => esc_html__('Select logo in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Logo Size', 'alone'),
			'param_name' => 'logo_size',
			'value' => '',
			'group' => esc_html__('Logo', 'alone'),
			'description' => esc_html__('Please, enter number size logo in this element. Ex: 60px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Space', 'alone'),
			'param_name' => 'logo_space',
			'value' => '',
			'group' => esc_html__('Logo', 'alone'),
			'description' => esc_html__('Please, enter number with px space between logo and content in this element. Ex: 30px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Video Link', 'alone'),
			'param_name' => 'video_link',
			'value' => '',
			'group' => esc_html__('Video', 'alone'),
			'description' => esc_html__('Please, enter video link in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'alone'),
			'param_name' => 'title',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'admin_label' => true,
			'description' => esc_html__('Please, enter title in this element.', 'alone')
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'alone'),
			'param_name' => 'title_link',
			'group' => esc_html__('Title', 'alone'),
			'description' => esc_html__('Add custom link of the title in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Font Size', 'alone'),
			'param_name' => 'title_font_size',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'description' => esc_html__('Please, enter number  with px font size title in this element. Ex: 20px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Line Height', 'alone'),
			'param_name' => 'title_line_height',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'description' => esc_html__('Please, enter number with px line height title in this element. Ex: 24px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Letter Spacing', 'alone'),
			'param_name' => 'title_letter_spacing',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'description' => esc_html__('Please, enter number with px letter spacing title in this element. Ex: 1.2px', 'alone')
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Color', 'alone'),
			'param_name' => 'title_color',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'description' => esc_html__('Select color title in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Space', 'alone'),
			'param_name' => 'title_space',
			'value' => '',
			'group' => esc_html__('Title', 'alone'),
			'description' => esc_html__('Please, enter number with px space between title and description in this element. Ex: 15px', 'alone')
		),
		array(
			'type' => 'textarea_html',
			'heading' => esc_html__('Description', 'alone'),
			'param_name' => 'content',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'description' => esc_html__('Please, enter description in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Font Size', 'alone'),
			'param_name' => 'desc_font_size',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'description' => esc_html__('Please, enter number  with px font size description in this element. Ex: 14px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Line Height', 'alone'),
			'param_name' => 'desc_line_height',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'description' => esc_html__('Please, enter number with px line height description in this element. Ex: 24px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Letter Spacing', 'alone'),
			'param_name' => 'desc_letter_spacing',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'description' => esc_html__('Please, enter number with px letter spacing description in this element. Ex: 1px', 'alone')
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Color', 'alone'),
			'param_name' => 'desc_color',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'description' => esc_html__('Select color description in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Space', 'alone'),
			'param_name' => 'desc_space',
			'value' => '',
			'group' => esc_html__('Description', 'alone'),
			'description' => esc_html__('Please, enter number with px space between description and read more in this element. Ex: 15px', 'alone')
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'alone'),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'alone'),
		)
	)
));
