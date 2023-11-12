<?php
class WPBakeryShortCode_bt_events_table extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'show_pagination' => 0,
			'css_animation' => '',
			'el_id' => '',
			'el_class' => '',

			'category' => '',
			'post_ids' => '',
			'posts_per_page' => 10,
			'orderby' => 'none',
			'order' => 'none',

			'css' => ''

		), $atts));

		$css_class = array(
			$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
			'bt-element',
			'bt-events-table-element',
			apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts )
		);

		$wrapper_attributes = array();
		if ( ! empty( $el_id ) ) {
			$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
		}
		
		/* Query */
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

		$args = array(
			'posts_per_page' => $posts_per_page,
			'paged' => $paged,
			'orderby' => $orderby,
			'order' => $order,
			'post_type' => 'tribe_events',
			'post_status' => 'publish');
		if (isset($category) && $category != '') {
			$cats = explode(',', $category);
			$taxonomy = array();
			foreach ((array) $cats as $cat){
				$taxonomy[] = trim($cat);
			}
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'tribe_events_cat',
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

		ob_start();
		if ( $wp_query->have_posts() ) {
		?>
			<div class="<?php echo esc_attr(implode(' ', $css_class)); ?>"  <?php echo esc_attr(implode(' ', $wrapper_attributes)); ?>>
				<div class="bt-head-wrap">
					<ul class="bt-head">
						<li class="bt-title"><?php esc_html_e('Event', 'alone'); ?></li>
						<li class="bt-location"><?php esc_html_e('Location', 'alone'); ?></li>
						<li class="bt-date"><?php esc_html_e('Date', 'alone'); ?></li>
						<li class="bt-author"><?php esc_html_e('Author', 'alone'); ?></li>
					</ul>
				</div>
				<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
					<div class="bt-item-wrap">
						<ul class="bt-item">
							<li class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<li class="bt-location"><?php echo tribe_get_full_address(get_the_ID()); ?></li>
							<li class="bt-date"><?php echo date_i18n(get_option('date_format'), strtotime(get_post_meta( get_the_ID(), '_EventStartDateUTC', true ))); ?></li>
							<li class="bt-author"><?php echo tribe_get_organizer(get_the_ID()); ?></li>
						</ul>
					</div>
				<?php } ?>
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
	'name' => esc_html__('Events Table', 'alone'),
	'base' => 'bt_events_table',
	'category' => esc_html__('BT Elements', 'alone'),
	'icon' => 'bt-icon',
	'params' => array(
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
			'taxonomy' => 'tribe_events_cat',
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
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'alone' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'alone' ),
		)
	)
));
