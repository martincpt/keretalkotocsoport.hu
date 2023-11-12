<?php
class WPBakeryShortCode_bt_sermon_template extends WPBakeryShortCode {
	
	protected function content( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'template' => 'default',
			'img_size' => '',
			'excerpt_limit' => 20,
			'excerpt_more' => '.',
			'css_animation' => '',
			'el_id' => '',
			'el_class' => '',
			
			'tax_topic' => '',
			'tax_book' => '',
			'tax_series' => '',
			'tax_speaker' => '',
			'post_ids' => '',
			'posts_per_page' => 10,
			'orderby' => 'none',
			'order' => 'none',
			
			'css' => ''
			
		), $atts));
		
		$css_class = array(
			$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
			'bt-element',
			'bt-sermon-template-element',
			$template,
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
			'post_type' => 'ctc_sermon',
			'post_status' => 'publish');
		if (isset($tax_topic) && $tax_topic != '') {
			$cats = explode(',', $tax_topic);
			$taxonomy = array();
			foreach ((array) $cats as $cat){
				$taxonomy[] = trim($cat);
			}
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'ctc_sermon_topic',
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
			$rand_id = rand(9, 99999);
		?>
			<div class="<?php echo esc_attr(implode(' ', $css_class)); ?>"  <?php echo esc_attr(implode(' ', $wrapper_attributes)); ?>>
				<div class="row">
					<?php
						$count = 0;
						while ( $wp_query->have_posts() ) { $wp_query->the_post();
							$thumb_size = (!empty($img_size))?$img_size:'full';
							$thumbnail_id = get_post_thumbnail_id();
							$thumbnail = wp_get_attachment_image_src( $thumbnail_id, $img_size, false );
								
							if($count == 0){
							?>
								<div class="col-md-6">
									<div class="bt-item bt-first">
										<?php
											echo '<div class="bt-thumb">
													<div class="bt-poster" style="background-image: url('.esc_url($thumbnail[0]).');"></div>
												</div>';
										?>
										<div class="bt-content">
											<ul class="bt-meta">
												<li class="bt-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(get_option('date_format')); ?></a></li>
												<li><?php esc_html_e('Posted by ', 'alone'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
											</ul>
											<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<?php
												echo '<div class="bt-excerpt">'.wp_trim_words(get_the_excerpt(), $excerpt_limit, $excerpt_more).'</div>';
												echo '<a class="sermon-media" href="#sm-modal-media-'.esc_attr($rand_id).'" data-semon-trigger-modal data-semon-id="'.get_the_ID().'" data-toggle="modal">
														<span class="video"><i class="fa fa-video-camera"></i></span>
														<span class="audio"><i class="fa fa-volume-up"></i></span>
														<span class="cloud"><i class="fa fa-cloud-download"></i></span>
														<span class="book"><i class="fa fa-file-text-o"></i></span>
													</a>';
											?>
										</div>
									</div>
								</div>
							<?php }else{ ?>
								<div class="col-md-6">
									<div class="bt-item">
										<?php
											echo '<div class="bt-thumb">
													<div class="bt-poster" style="background-image: url('.esc_url($thumbnail[0]).');"></div>
												</div>';
										?>
										<div class="bt-content">
											<ul class="bt-meta">
												<li class="bt-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(get_option('date_format')); ?></a></li>
												<li><?php esc_html_e('Posted by ', 'alone'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
											</ul>
											<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<?php
												echo '<div class="bt-excerpt">'.wp_trim_words(get_the_excerpt(), $excerpt_limit, $excerpt_more).'</div>';
												echo '<a class="sermon-media" href="#sm-modal-media-'.esc_attr($rand_id).'" data-semon-trigger-modal data-semon-id="'.get_the_ID().'" data-toggle="modal">
														<span class="video"><i class="fa fa-video-camera"></i></span>
														<span class="audio"><i class="fa fa-volume-up"></i></span>
														<span class="cloud"><i class="fa fa-cloud-download"></i></span>
														<span class="book"><i class="fa fa-file-text-o"></i></span>
													</a>';
											?>
										</div>
									</div>
								</div>
							<?php 
							}
							$count++; 
						}
					?>
				</div>
				<div class="modal fade" id="<?php echo sprintf('sm-modal-media-%s', esc_attr($rand_id)); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-semon-modal>
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body" data-semon-modal-content>
							Loading...
							</div>
						</div>
					</div>
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
	'name' => esc_html__('Sermon Template', 'alone'),
	'base' => 'bt_sermon_template',
	'category' => esc_html__('BT Elements', 'alone'),
	'icon' => 'bt-icon',
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Template', 'alone'),
			'param_name' => 'template',
			'value' => array(
				esc_html__('Default', 'alone') => 'default',
			),
			'admin_label' => true,
			'description' => esc_html__('Select layout of items display in this element.', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Image size', 'alone'),
			'param_name' => 'img_size',
			'value' => 'full',
			'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full sizes defined by current theme. Leave empty to use "full" size.', 'alone'),
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
			'taxonomy' => 'ctc_sermon_topic',
			'heading' => esc_html__('Topic Categories', 'alone'),
			'param_name' => 'tax_topic',
			'group' => esc_html__('Data Setting', 'alone'),
			'description' => esc_html__('Note: By default, all your posts will be displayed. If you want to narrow output, select category(s) above. Only selected categories will be displayed.', 'alone')
		),
		array (
			'type' => 'bt_taxonomy',
			'taxonomy' => 'ctc_sermon_book',
			'heading' => esc_html__('Book Categories', 'alone'),
			'param_name' => 'tax_book',
			'group' => esc_html__('Data Setting', 'alone'),
			'description' => esc_html__('Note: By default, all your posts will be displayed. If you want to narrow output, select category(s) above. Only selected categories will be displayed.', 'alone')
		),
		array (
			'type' => 'bt_taxonomy',
			'taxonomy' => 'ctc_sermon_series',
			'heading' => esc_html__('Book Series', 'alone'),
			'param_name' => 'tax_series',
			'group' => esc_html__('Data Setting', 'alone'),
			'description' => esc_html__('Note: By default, all your posts will be displayed. If you want to narrow output, select category(s) above. Only selected categories will be displayed.', 'alone')
		),
		array (
			'type' => 'bt_taxonomy',
			'taxonomy' => 'ctc_sermon_speaker',
			'heading' => esc_html__('Book Speaker', 'alone'),
			'param_name' => 'tax_speaker',
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
