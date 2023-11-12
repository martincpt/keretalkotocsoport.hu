<?php
class WPBakeryShortCode_bt_resource_grid extends WPBakeryShortCode {
	
	protected function content( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'layout_type' => 'bt-grid-auto',
			'columns' =>  '',
			'space' =>  30,
			'show_pagination' => 0,
			'css_animation' => '',
			'el_id' => '',
			'el_class' => '',
			
			'category' => '',
			'post_ids' => '',
			'posts_per_page' => 10,
			'orderby' => 'none',
			'order' => 'none',
			
			'layout' => 'default',
			'image_type' => 'auto',
			'img_size' => '',
			'img_ratio' => '',
			'excerpt_limit' => 20,
			'excerpt_more' => '.',
			'readmore_text' => 'Read More',
			
			'columns_md' => '',
			'columns_sm' => '',
			'columns_xs' => '',
			
			
			'css' => ''
			
		), $atts));
		
		$css_class = array(
			$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
			'bt-element',
			'bt-resource-grid-element',
			$layout_type,
			$layout,
			apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts )
		);
		
		$wrapper_attributes = array();
		if ( ! empty( $el_id ) ) {
			$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
		}
		
		/* Space */
		$item_style = array();
		$item_style[] = 'padding-left: '.($space/2).'px;';
		$item_style[] = 'padding-right: '.($space/2).'px;';
		$item_style[] = 'margin-bottom: '.$space.'px;';
		
		$item_attributes = array();
		if ( ! empty( $item_style ) ) {
			$item_attributes[] = 'style="' . esc_attr( implode(' ', $item_style) ) . '"';
		}
		
		/* Columns */
		$column_class = array();
		$column_class[] = (!empty($columns)) ? $columns: 'col-lg-3';
		if($columns != 'col-lg-12'){
			$column_class[] = (!empty($columns_md)) ? $columns_md : 'col-md-4';
			$column_class[] = (!empty($columns_sm)) ? $columns_sm : 'col-sm-6';
			$column_class[] = (!empty($columns_xs)) ? $columns_xs : 'col-xs-12';
		}
		
		if ( ! empty( $column_class ) ) {
			$item_attributes[] = 'class="' . esc_attr( implode(' ', $column_class) ) . '"';
		}
		
		/* Query */
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		
		$args = array(
			'posts_per_page' => $posts_per_page,
			'paged' => $paged,
			'orderby' => $orderby,
			'order' => $order,
			'post_type' => 'bt_resource',
			'post_status' => 'publish');
		if (isset($category) && $category != '') {
			$cats = explode(',', $category);
			$taxonomy = array();
			foreach ((array) $cats as $cat){
				$taxonomy[] = trim($cat);
			}
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'bt_resource_category',
					'field' => 'slug',
					'terms' => $taxonomy
				)
			);
		}
		if (isset($post_ids) && $post_ids != '') {
			$ids = explode(',', $post_ids);
			$p_ids = array();
			foreach ((array) $ids as $id){
				$p_ids[] = trim($id);
			}
			$args['post__in'] = $p_ids;
		}
		$wp_query = new WP_Query($args);
		
		$custom_script = "jQuery(document).ready(function($) {
							$('.bt-grid-masonry .row').isotope();
						});";
		
		wp_add_inline_script( 'alone-theme-script', $custom_script );
		
		ob_start();
		if ( $wp_query->have_posts() ) {
		?>
			<div class="<?php echo esc_attr(implode(' ', $css_class)); ?>"  <?php echo esc_attr(implode(' ', $wrapper_attributes)); ?>>
				<div class="row">
					<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
						<div <?php echo implode(' ', $item_attributes); ?>>
							<?php require get_template_directory().'/framework-customizations/extensions/custom-js-composer/vc_layout/resource-'.$layout.'.php'; ?>
						</div>
					<?php } ?>
				</div>
				<?php if ($show_pagination) alone_paginate_links($wp_query); ?>
			</div>
		<?php
		} else {
			esc_html_e('Post not found!', 'alone');
		}
		wp_reset_query();
		return ob_get_clean();
	}
}

vc_map(array(
	'name' => esc_html__('Resource Grid', 'alone'),
	'base' => 'bt_resource_grid',
	'category' => esc_html__('BT Elements', 'alone'),
	'icon' => 'bt-icon',
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'alone'),
			'param_name' => 'layout_type',
			'value' => array(
				esc_html__('Auto', 'alone') => 'bt-grid-auto',
				esc_html__('Fixed Row', 'alone') => 'bt-grid-fixed',
				esc_html__('Masonry', 'alone') => 'bt-grid-masonry'
			),
			'admin_label' => true,
			'description' => esc_html__('Select layout display in this element.', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'alone'),
			'param_name' => 'columns',
			'value' => array(
				'4 Columns' => 'col-lg-3',
				'3 Columns' => 'col-lg-4',
				'2 Columns' => 'col-lg-6',
				'1 Column' => 'col-lg-12'
			),
			'description' => esc_html__('Select columns display in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Item Space', 'alone'),
			'param_name' => 'space',
			'value' => 30,
			'description' => esc_html__('Please, enter number space in this element.', 'alone')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show Pagination', 'alone'),
			'param_name' => 'show_pagination',
			'value' => '',
			'description' => esc_html__('Show or not pagination in this element.', 'alone')
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
		array (
			'type' => 'bt_taxonomy',
			'taxonomy' => 'bt_resource_category',
			'heading' => esc_html__('Categories', 'alone'),
			'param_name' => 'category',
			'group' => esc_html__('Data Setting', 'alone'),
			'description' => esc_html__('Note: By default, all your posts will be displayed. If you want to narrow output, select category(s) above. Only selected categories will be displayed.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Post IDs', 'alone'),
			'param_name' => 'post_ids',
			'group' => esc_html__('Data Setting', 'alone'),
			'description' => esc_html__('Enter post IDs to be excluded (Note: separate values by commas (,)).', 'alone'),
		),
		array (
			'type' => 'textfield',
			'heading' => esc_html__('Count', 'alone'),
			'param_name' => 'posts_per_page',
			'value' => '10',
			'group' => esc_html__('Data Setting', 'alone'),
			'description' => esc_html__('The number of posts to display on each page. Set to "-1" for display all posts on the page.', 'alone')
		),
		array (
			'type' => 'dropdown',
			'heading' => esc_html__('Order by', 'alone'),
			'param_name' => 'orderby',
			'value' => array (
					esc_html__('None', 'alone') => 'none',
					esc_html__('Title', 'alone') => 'title',
					esc_html__('Date', 'alone') => 'date',
					esc_html__('ID', 'alone') => 'ID'
			),
			'group' => esc_html__('Data Setting', 'alone'),
			'description' => esc_html__('Select order type.', 'alone')
		),
		array (
			'type' => 'dropdown',
			'heading' => esc_html__('Order', 'alone'),
			'param_name' => 'order',
			'value' => Array (
					esc_html__('None', 'alone') => 'none',
					esc_html__('ASC', 'alone') => 'ASC',
					esc_html__('DESC', 'alone') => 'DESC'
			),
			'group' => esc_html__('Data Setting', 'alone'),
			'description' => esc_html__('Select sorting order.', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'alone'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Default', 'alone') => 'default',
			),
			'admin_label' => true,
			'group' => esc_html__('Item Setting', 'alone'),
			'description' => esc_html__('Select layout of items display in this element.', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Image Type', 'alone'),
			'param_name' => 'image_type',
			'value' => array(
				esc_html__('Auto', 'alone') => 'auto',
				esc_html__('Ratio', 'alone') => 'ratio'
			),
			'group' => esc_html__('Item Setting', 'alone'),
			'description' => esc_html__('Select media type of items display in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Image size', 'alone'),
			'param_name' => 'img_size',
			'value' => 'full',
			'group' => esc_html__('Item Setting', 'alone'),
			'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full sizes defined by current theme. Leave empty to use "full" size.', 'alone'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Image ratio', 'alone'),
			'param_name' => 'img_ratio',
			'value' => '66%',
			'dependency' => array(
				'element'=>'image_type',
				'value'=> 'ratio'
			),
			'group' => esc_html__('Item Setting', 'alone'),
			'description' => esc_html__('Enter image ration with % or px. Leave empty to use "66%" size.', 'alone'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Excerpt Limit', 'alone'),
			'param_name' => 'excerpt_limit',
			'value' => 20,
			'group' => esc_html__('Item Setting', 'alone'),
			'description' => esc_html__('Please, Enter number excerpt limit of post in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Excerpt More', 'alone'),
			'param_name' => 'excerpt_more',
			'value' => '.',
			'group' => esc_html__('Item Setting', 'alone'),
			'description' => esc_html__('Please, Enter text excerpt more of post in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Readmore Text', 'alone'),
			'param_name' => 'readmore_text',
			'value' => 'Read More',
			'group' => esc_html__('Item Setting', 'alone'),
			'description' => esc_html__('Please, Enter text of label button readmore in this element.', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns Medium Screen', 'alone'),
			'param_name' => 'columns_md',
			'value' => array(
				esc_html__('Auto', 'alone') => '',
				esc_html__('4 Columns', 'alone') => 'col-md-3',
				esc_html__('3 Columns', 'alone') => 'col-md-4',
				esc_html__('2 Columns', 'alone') => 'col-md-6',
				esc_html__('1 Column', 'alone') => 'col-md-12'
			),
			'group' => esc_html__('Responsive', 'alone'),
			'description' => esc_html__('Select columns display in this element (Screen width >=992px and <1199px).', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns Small Screen', 'alone'),
			'param_name' => 'columns_sm',
			'value' => array(
				esc_html__('Auto', 'alone') => '',
				esc_html__('4 Columns', 'alone') => 'col-sm-3',
				esc_html__('3 Columns', 'alone') => 'col-sm-4',
				esc_html__('2 Columns', 'alone') => 'col-sm-6',
				esc_html__('1 Column', 'alone') => 'col-sm-12'
			),
			'group' => esc_html__('Responsive', 'alone'),
			'description' => esc_html__('Select columns display in this element (Screen width >=768px and <992px).', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns Extra Screen', 'alone'),
			'param_name' => 'columns_xs',
			'value' => array(
				esc_html__('Auto', 'alone') => '',
				esc_html__('4 Columns', 'alone') => 'col-xs-3',
				esc_html__('3 Columns', 'alone') => 'col-xs-4',
				esc_html__('2 Columns', 'alone') => 'col-xs-6',
				esc_html__('1 Column', 'alone') => 'col-xs-12'
			),
			'group' => esc_html__('Responsive', 'alone'),
			'description' => esc_html__('Select columns display in this element (Screen <768px).', 'alone')
		),
		
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'alone' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'alone' ),
		)
	)
));
