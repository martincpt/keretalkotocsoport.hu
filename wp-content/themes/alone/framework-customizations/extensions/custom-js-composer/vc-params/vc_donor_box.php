<?php
class WPBakeryShortCode_bt_donor_box extends WPBakeryShortCode {

	protected function content( $atts, $content = NULL ) {

		extract(shortcode_atts(array(
			'layout' => 'default',
			'css_animation' => '',
			'el_id' => '',
			'el_class' => '',

			'image' => '',
			'image_size' => '',
			'image_space' => '',

			'title' => '',
			'title_font_size' => '',
			'title_line_height' => '',
			'title_letter_spacing' => '',
			'title_color' => '',

			'donated' => '',
			'donated_font_size' => '',
			'donated_line_height' => '',
			'donated_letter_spacing' => '',
			'donated_color' => '',

			'css' => ''

		), $atts));

		$css_class = array(
			$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
			'bt-element',
			'bt-donor-box-element',
			$layout,
			apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts )
		);

		$wrapper_attributes = array();
		if ( ! empty( $el_id ) ) {
			$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
		}

		/* Image */
		$style_image = array();
		if($image_space) $style_image[] = 'margin-bottom: '.$image_space.';';

		$image_attributes = array();
		if ( ! empty( $style_image ) ) {
			$image_attributes[] = 'style="' . esc_attr( implode(' ', $style_image) ) . '"';
		}

		$image_size_style = $image_size?'width: '.$image_size.'; height: auto;':'';
		$attachment_image = wp_get_attachment_image_src($image, 'full', false);
		$image = $attachment_image[0]?'<img src="'.esc_url($attachment_image[0]).'" style="'.esc_attr($image_size_style).'" alt="'.esc_attr__('Logo', 'alone').'"/>':'';

		/* Title */
		$style_title = array();
		if($title_font_size) $style_title[] = 'font-size: '.$title_font_size.';';
		if($title_line_height) $style_title[] = 'line-height: '.$title_line_height.';';
		if($title_letter_spacing) $style_title[] = 'letter-spacing: '.$title_letter_spacing.';';
		if($title_color) $style_title[] = 'color: '.$title_color.';';

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

		/* Donated */
		$style_donated = array();
		if($donated_font_size) $style_donated[] = 'font-size: '.$donated_font_size.';';
		if($donated_line_height) $style_donated[] = 'line-height: '.$donated_line_height.';';
		if($donated_letter_spacing) $style_donated[] = 'letter-spacing: '.$donated_letter_spacing.';';
		if($donated_color) $style_donated[] = 'color: '.$donated_color.';';

		$donated_attributes = array();
		if ( ! empty( $style_donated ) ) {
			$donated_attributes[] = 'style="' . esc_attr( implode(' ', $style_donated) ) . '"';
		}

		ob_start();
		?>
		<div class="<?php echo esc_attr(implode(' ', $css_class)); ?>" <?php echo esc_attr(implode(' ', $wrapper_attributes)); ?>>
			<div class="bt-image" <?php echo implode(' ', $image_attributes); ?>>
				<?php
					if($image) echo '<div class="bt-image-inner">'.$image.'</div>';
					if($donated) echo '<div class="bt-overlay">
											<div class="bt-donated">
												<div class="bt-label">'.esc_html__('Donated', 'alone').'</div>
												<h4 class="bt-price" '.implode(' ', $donated_attributes).'>'.$donated.'</h4>
											</div>
										</div>';
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
				?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}

vc_map(array(
	'name' => esc_html__('Donor Box', 'alone'),
	'base' => 'bt_donor_box',
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
			'heading' => esc_html__('Image', 'alone'),
			'param_name' => 'image',
			'value' => '',
			'group' => esc_html__('Image', 'alone'),
			'description' => esc_html__('Select image in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Image Size', 'alone'),
			'param_name' => 'image_size',
			'value' => '',
			'group' => esc_html__('Image', 'alone'),
			'description' => esc_html__('Please, enter number size image in this element. Ex: 60px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Space', 'alone'),
			'param_name' => 'image_space',
			'value' => '',
			'group' => esc_html__('Image', 'alone'),
			'description' => esc_html__('Please, enter number with px space between image and content in this element. Ex: 30px', 'alone')
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
			'heading' => esc_html__('Donated', 'alone'),
			'param_name' => 'donated',
			'value' => '',
			'group' => esc_html__('Donated', 'alone'),
			'description' => esc_html__('Please, enter donated in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Font Size', 'alone'),
			'param_name' => 'donated_font_size',
			'value' => '',
			'group' => esc_html__('Donated', 'alone'),
			'description' => esc_html__('Please, enter number  with px font size donated in this element. Ex: 14px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Line Height', 'alone'),
			'param_name' => 'donated_line_height',
			'value' => '',
			'group' => esc_html__('Donated', 'alone'),
			'description' => esc_html__('Please, enter number with px line height donated in this element. Ex: 24px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Letter Spacing', 'alone'),
			'param_name' => 'donated_letter_spacing',
			'value' => '',
			'group' => esc_html__('Donated', 'alone'),
			'description' => esc_html__('Please, enter number with px letter spacing donated in this element. Ex: 1px', 'alone')
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Color', 'alone'),
			'param_name' => 'donated_color',
			'value' => '',
			'group' => esc_html__('Donated', 'alone'),
			'description' => esc_html__('Select color donated in this element.', 'alone')
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'alone'),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'alone'),
		)
	)
));
