<?php
class WPBakeryShortCode_bt_campaign_box extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'layout' => 'default',
			'css_animation' => '',
			'el_id' => '',
			'el_class' => '',

			'sub_title' => '',
			'sub_title_font_size' => '',
			'sub_title_line_height' => '',
			'sub_title_letter_spacing' => '',
			'sub_title_color' => '',
			'sub_title_space' => '',

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

			'unit' => '',
			'goal' => '',
			'raised' => '',

			'link_font_size' => '',
			'link_line_height' => '',
			'link_letter_spacing' => '',
			'link_color' => '',

			'css' => ''

		), $atts));

		$css_class = array(
			$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
			'bt-element',
			'bt-campaign-box-element',
			$layout,
			apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts )
		);

		$wrapper_attributes = array();
		if ( ! empty( $el_id ) ) {
			$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
		}

		/* Sub Title */
		$style_sub_title = array();
		if($sub_title_font_size) $style_sub_title[] = 'font-size: '.$sub_title_font_size.';';
		if($sub_title_line_height) $style_sub_title[] = 'line-height: '.$sub_title_line_height.';';
		if($sub_title_letter_spacing) $style_sub_title[] = 'letter-spacing: '.$sub_title_letter_spacing.';';
		if($sub_title_color) $style_sub_title[] = 'color: '.$title_color.';';
		if($sub_title_space) $style_sub_title[] = 'margin-bottom: '.$sub_title_space.';';
		$sub_title_attributes = array();
		if ( ! empty( $style_sub_title ) ) {
			$sub_title_attributes[] = 'style="' . esc_attr( implode(' ', $style_sub_title) ) . '"';
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

		/* Price */
		$num_goal = (int)$goal;
		$num_raised = (int)$raised;
		$price_goal = $unit.number_format($num_goal);
		$price_raised = $unit.number_format($num_raised);
		$percent = round(($num_raised / $num_goal) * 100, 0);

		/* Extra link */
		$link = isset($atts['link'])?vc_build_link( $atts['link'] ):array();
		$link_text = '';
		$link_attributes = array();

		if(!empty($link)){
			if ( ! empty( $link['url'] ) ) {
				$link_attributes[] = 'href="' . esc_attr( $link['url'] ) . '"';
			}

			if ( ! empty( $link['target'] ) ) {
				$link_attributes[] = 'target="' . esc_attr( $link['target'] ) . '"';
			}

			if ( ! empty( $link['rel'] ) ) {
				$link_attributes[] = 'rel="' . esc_attr( $link['rel'] ) . '"';
			}

			$style_link = array();
			if($link_font_size) $style_link[] = 'font-size: '.$link_font_size.';';
			if($link_line_height) $style_link[] = 'line-height: '.$link_line_height.';';
			if($link_letter_spacing) $style_link[] = 'letter-spacing: '.$link_letter_spacing.';';
			if($link_color) $style_link[] = 'color: '.$link_color.';';
			if ( ! empty( $style_link ) ) {
				$link_attributes[] = 'style="' . esc_attr( implode(' ', $style_link) ) . '"';
			}
			if ( ! empty( $link['title'] ) ) {
				$link_text = $link['title'];
			}
		}

		ob_start();
		?>
		<div class="<?php echo esc_attr(implode(' ', $css_class)); ?>" <?php echo esc_attr(implode(' ', $wrapper_attributes)); ?>>
			<?php require get_template_directory().'/framework-customizations/extensions/custom-js-composer/vc_layout/campaign-'.$layout.'.php'; ?>
		</div>
		<?php
		return ob_get_clean();
	}
}

vc_map(array(
	'name' => esc_html__('Campaign Box', 'alone'),
	'base' => 'bt_campaign_box',
	'category' => esc_html__('BT Elements', 'alone'),
	'icon' => 'bt-icon',
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'alone'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Default', 'alone') => 'default',
				esc_html__('Style1', 'alone') => 'style1',
				esc_html__('Style2', 'alone') => 'style2',
				esc_html__('Style3', 'alone') => 'style3',
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
			'type' => 'textfield',
			'heading' => esc_html__('Sub Title', 'alone'),
			'param_name' => 'sub_title',
			'value' => '',
			'group' => esc_html__('Sub Title', 'alone'),
			'admin_label' => true,
			'description' => esc_html__('Please, enter sub title in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Font Size', 'alone'),
			'param_name' => 'sub_title_font_size',
			'value' => '',
			'group' => esc_html__('Sub Title', 'alone'),
			'description' => esc_html__('Please, enter number  with px font size sub_title in this element. Ex: 20px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Line Height', 'alone'),
			'param_name' => 'sub_title_line_height',
			'value' => '',
			'group' => esc_html__('Sub Title', 'alone'),
			'description' => esc_html__('Please, enter number with px line height sub title in this element. Ex: 24px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Letter Spacing', 'alone'),
			'param_name' => 'sub_title_letter_spacing',
			'value' => '',
			'group' => esc_html__('Sub Title', 'alone'),
			'description' => esc_html__('Please, enter number with px letter spacing sub title in this element. Ex: 1.2px', 'alone')
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Color', 'alone'),
			'param_name' => 'sub_title_color',
			'value' => '',
			'group' => esc_html__('Sub Title', 'alone'),
			'description' => esc_html__('Select color sub title in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Space', 'alone'),
			'param_name' => 'sub_title_space',
			'value' => '',
			'group' => esc_html__('Sub Title', 'alone'),
			'description' => esc_html__('Please, enter number with px space between sub title and title in this element. Ex: 15px', 'alone')
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
			'description' => esc_html__('Please, enter number with px space between description and extra link description in this element. Ex: 15px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Unit', 'alone'),
			'param_name' => 'unit',
			'value' => '',
			'group' => esc_html__('Price', 'alone'),
			'description' => esc_html__('Please, enter price unit in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Goal', 'alone'),
			'param_name' => 'goal',
			'value' => '',
			'group' => esc_html__('Price', 'alone'),
			'description' => esc_html__('Please, enter number goal in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Raised', 'alone'),
			'param_name' => 'raised',
			'value' => '',
			'group' => esc_html__('Price', 'alone'),
			'description' => esc_html__('Please, enter number raised in this element.', 'alone')
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'alone'),
			'param_name' => 'link',
			'group' => esc_html__('Extra Link', 'alone'),
			'description' => esc_html__('Add extra link in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Font Size', 'alone'),
			'param_name' => 'link_font_size',
			'value' => '',
			'group' => esc_html__('Extra Link', 'alone'),
			'description' => esc_html__('Please, enter number  with px font size extra link in this element. Ex: 14px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Line Height', 'alone'),
			'param_name' => 'link_line_height',
			'value' => '',
			'group' => esc_html__('Extra Link', 'alone'),
			'description' => esc_html__('Please, enter number with px line height extra link in this element. Ex: 24px', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Letter Spacing', 'alone'),
			'param_name' => 'link_letter_spacing',
			'value' => '',
			'group' => esc_html__('Extra Link', 'alone'),
			'description' => esc_html__('Please, enter number with px letter spacing extra link in this element. Ex: 1px', 'alone')
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'alone'),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'alone'),
		)
	)
));
