<?php
class WPBakeryShortCode_bt_blog_carousel extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'css_animation' => '',
			'el_id' => '',
			'el_class' => '',

			'rows' => 1,
			'items' => '',
			'margin' => '',
			'loop' => '',
			'autoplay' => '',
			'autoplayhoverpause' => '',
			'smartspeed' => '',
			'nav' => '',
			'dots' => '',

			'category' => '',
			'post_ids' => '',
			'posts_per_page' => 10,
			'orderby' => 'none',
			'order' => 'none',

			'layout' => 'default',
			'image_type' => 'auto',
			'img_size' => '',
			'img_ratio' => '66%',
			'excerpt_limit' => 20,
			'excerpt_more' => '.',
			'readmore_text' => 'Read More',

			'items_md' => '',
			'items_sm' => '',
			'items_xs' => '',
			'nav_xs' => '',
			'dots_xs' => '',

			'css' => ''

		), $atts));

		$space_class = ( ! empty( $margin ) ) ? 'space'.$margin : 'space0';

		$css_class = array(
			$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
			'bt-element',
			'bt-blog-carousel-element',
			$layout,
			$space_class,
			apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts )
		);

		$wrapper_attributes = array();
		if ( ! empty( $el_id ) ) {
			$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
		}

		/* Owl */
		$owl_attributes = array();
		$owl_attributes['items'] = ( ! empty( $items ) ) ? $items : 4;
		$owl_attributes['margin'] = ( ! empty( $margin ) ) ? (int)$margin : 0;
		$owl_attributes['loop'] = ( ! empty( $loop ) ) ? true : false;
		$owl_attributes['autoplay'] = ( ! empty( $autoplay ) ) ? true : false;
		$owl_attributes['autoplayHoverPause'] = ( ! empty( $autoplayhoverpause ) ) ? true : false;
		$owl_attributes['smartSpeed'] = ( ! empty( $smartspeed ) ) ? (int)$smartspeed : 500;
		$owl_attributes['nav'] = ( ! empty( $nav ) ) ? true : false;
		if ( ! empty( $nav ) ) $owl_attributes['navText'] = array('<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>');
		$owl_attributes['dots']= ( ! empty( $dots ) ) ? true : false;

		if($items != 1){
			$items_md = ( ! empty( $items_md ) ) ? $items_md : 3;
			$items_sm = ( ! empty( $items_sm ) ) ? $items_sm : 2;
			$items_xs = ( ! empty( $items_xs ) ) ? $items_xs : 1;
		}else{
			$items_md = $items_sm = $items_xs = 1;
		}

		if(! empty( $nav )){
			$nav_xs = ( ! empty( $nav_xs ) ) ? false : true;
		}else{
			$nav_xs = false;
		}

		if(! empty( $dots )){
			$dots_xs = ( ! empty( $dots_xs ) ) ? false : true;
		}else{
			$dots_xs = false;
		}

		$owl_attributes['responsive'] = array(
			1200 => array(
				'items' => $items
			),
			992 => array(
				'items' => $items_md
			),
			768 => array(
				'items' => $items_sm
			),
			0 => array(
				'items' => $items_xs,
				'nav' => $nav_xs,
				'dots' => $dots_xs
			),
		);


		$owl_json = json_encode($owl_attributes);


		/* Query */
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

		$args = array(
			'posts_per_page' => $posts_per_page,
			'paged' => $paged,
			'orderby' => $orderby,
			'order' => $order,
			'post_type' => 'post',
			'post_status' => 'publish');
		if (isset($category) && $category != '') {
			$cats = explode(',', $category);
			$taxonomy = array();
			foreach ((array) $cats as $cat){
				$taxonomy[] = trim($cat);
			}
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
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
							setTimeout( function() {
								$('.bt-blog-carousel-element .owl-carousel').each(function() {
									$(this).owlCarousel($(this).data('owl'));
								});
							}, 1000 );
						});";

		wp_add_inline_script( 'alone-theme-script', $custom_script );

		ob_start();
		if ( $wp_query->have_posts() ) {
		?>
			<div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
				<div class="owl-carousel" data-owl="<?php echo esc_attr($owl_json); ?>">
					<?php
						if($rows == 1){
							while ( $wp_query->have_posts() ) { $wp_query->the_post();
								require get_template_directory().'/framework-customizations/extensions/custom-js-composer/vc_layout/post-'.$layout.'.php';
							}
						}else{
							$post_count = $wp_query->post_count;
							$count = 0;
							while ( $wp_query->have_posts() ) { $wp_query->the_post();
								if($count == 0 || $count%$rows == 0) echo '<div class="bt-items">';
									require get_template_directory().'/framework-customizations/extensions/custom-js-composer/vc_layout/post-'.$layout.'.php';
									$count++;
								if($count == $post_count || $count%$rows == 0) echo '</div>';
							}
						}
					?>
				</div>
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
	'name' => esc_html__('Blog Carousel', 'alone'),
	'base' => 'bt_blog_carousel',
	'category' => esc_html__('BT Elements', 'alone'),
	'icon' => 'bt-icon',
    'params' => array(
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
			'taxonomy' => 'category',
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
			'value' => 10,
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
			'heading' => esc_html__('Items', 'alone'),
			'param_name' => 'rows',
			'value' => array(
				esc_html__('1 Row', 'alone') => 1,
				esc_html__('2 Rows', 'alone') => 2,
				esc_html__('3 Rows', 'alone') => 3

			),
			'group' => esc_html__('Owl Setting', 'alone'),
			'description' => esc_html__('The number of rows you want to see on the screen.', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Items', 'alone' ),
			'param_name' => 'items',
			'value' => array(
				esc_html__('4 Items', 'alone') => 4,
				esc_html__('3 Items', 'alone') => 3,
				esc_html__('2 Items', 'alone') => 2,
				esc_html__('1 Item', 'alone') => 1
			),
			'group' => esc_html__('Owl Setting', 'alone'),
			'description' => esc_html__('The number of items you want to see on the screen.', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Margin', 'alone'),
			'param_name' => 'margin',
			'value' => array(
				esc_html__('0px', 'alone') => 0,
				esc_html__('10px', 'alone') => 10,
				esc_html__('20px', 'alone') => 20,
				esc_html__('30px', 'alone') => 30
			),
			'group' => esc_html__('Owl Setting', 'alone'),
			'description' => esc_html__('Margin-right(px) on item.', 'alone')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Loop', 'alone'),
			'param_name' => 'loop',
			'value' => '',
			'group' => esc_html__('Owl Setting', 'alone'),
			'description' => esc_html__('Infinity loop. Duplicate last and first items to get loop illusion.', 'alone')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Autoplay.', 'alone'),
			'param_name' => 'autoplay',
			'value' => '',
			'group' => esc_html__('Owl Setting', 'alone'),
			'description' => esc_html__('Autoplay.', 'alone')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('AutoplayHoverPause', 'alone'),
			'param_name' => 'autoplayhoverpause',
			'value' => '',
			'group' => esc_html__('Owl Setting', 'alone'),
			'description' => esc_html__('Pause on mouse hover.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('SmartSpeed', 'alone'),
			'param_name' => 'smartspeed',
			'value' => 500,
			'group' => esc_html__('Owl Setting', 'alone'),
			'description' => esc_html__( 'Speed Calculate.', 'alone' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Nav', 'alone'),
			'param_name' => 'nav',
			'value' => '',
			'group' => esc_html__('Owl Setting', 'alone'),
			'description' => esc_html__('Show next/prev buttons.', 'alone')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Dots', 'alone'),
			'param_name' => 'dots',
			'value' => '',
			'group' => esc_html__('Owl Setting', 'alone'),
			'description' => esc_html__('Show dots navigation.', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'alone'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Default', 'alone') => 'default',
				esc_html__('Layout 1', 'alone') => 'layout1',
				esc_html__('Layout 2', 'alone') => 'layout2',
				esc_html__('Layout 3', 'alone') => 'layout3',
				esc_html__('Layout 4', 'alone') => 'layout4',
				esc_html__('Layout 5', 'alone') => 'layout5',
				esc_html__('Layout 6', 'alone') => 'layout6'
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
			'heading' => esc_html__('Items Medium Screen', 'alone'),
			'param_name' => 'items_md',
			'value' => array(
				esc_html__('Auto', 'alone') => '',
				esc_html__('4 Items', 'alone') => 4,
				esc_html__('3 Items', 'alone') => 3,
				esc_html__('2 Items', 'alone') => 2,
				esc_html__('1 Item', 'alone') => 1
			),
			'group' => esc_html__('Responsive', 'alone'),
			'description' => esc_html__('The number of items you want to see on the screen(>=992px and <1199px).', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Small Screen', 'alone'),
			'param_name' => 'items_sm',
			'value' => array(
				esc_html__('Auto', 'alone') => '',
				esc_html__('4 Items', 'alone') => 4,
				esc_html__('3 Items', 'alone') => 3,
				esc_html__('2 Items', 'alone') => 2,
				esc_html__('1 Item', 'alone') => 1
			),
			'group' => esc_html__('Responsive', 'alone'),
			'description' => esc_html__('The number of items you want to see on the screen(>=768px and <992px).', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Extra Screen', 'alone'),
			'param_name' => 'items_xs',
			'value' => array(
				esc_html__('Auto', 'alone') => '',
				esc_html__('4 Items', 'alone') => 4,
				esc_html__('3 Items', 'alone') => 3,
				esc_html__('2 Items', 'alone') => 2,
				esc_html__('1 Item', 'alone') => 1
			),
			'group' => esc_html__('Responsive', 'alone'),
			'description' => esc_html__('The number of items you want to see on the screen(<768px).', 'alone')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Disable Nav On Extra Screen', 'alone'),
			'param_name' => 'nav_xs',
			'value' => '',
			'group' => esc_html__('Responsive', 'alone'),
			'description' => esc_html__('Disable next/prev buttons on the screen(<768px).', 'alone')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Disable Dots On Extra Screen', 'alone'),
			'param_name' => 'dots_xs',
			'value' => '',
			'group' => esc_html__('Responsive', 'alone'),
			'description' => esc_html__('Disable dots navigation on the screen(<768px).', 'alone')
		),

		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'alone' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'alone' ),
		)
	)
));
