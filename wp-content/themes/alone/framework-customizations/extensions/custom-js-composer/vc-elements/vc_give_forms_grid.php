<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Params extraction
$atts = shortcode_atts(
  array(
    'self'              => '',
    /* Source */
    'number_posts_show' => 5,
    'data_type'         => 'p_date',
		'order'							=>	'DESC',
    'forms_id'          => '',
    /* Layout Options */
    'image_size'				=> 'alone-image-medium',
    'layout'						=> 'default',
    /* grid Options */
    'items'             => 3,
		'space'             => 30,
    /* Style */
    'el_id'             => '',
    'el_class'          => '',
    'css'               => '',
  ),
  $atts
);
extract($atts);
//var_dump($order);

$_args_query = array(
  'post_type'           => 'give_forms',
  'sort'                => $data_type,
  'items'               => $number_posts_show,
	'space'               => $space,
  'post_by_id'          => explode(',', $forms_id),
);
switch ($data_type) {
	case 'p_date':
		$_args_query['sort'] = 'p_date';
		$_args_query['order'] = $order;
		break;

	case 'po_title':
		$_args_query['sort'] = 'po_title';
		$_args_query['order'] = $order;
		break;

	case 'by_id':
		$_args_query['sort'] = 'by_id';
		$_args_query['post_by_id'] = explode(',', $forms_id);
		# code...
		break;
}
/**
 * @ result $posts_data is array post data
 * Innter item
 *    @var post_img [array]
 *    @var post_date_post
 *    @var post_id
 *    @var $post_class
 *    @var $post_title
 *    @var $post_link
 *    @var $post_author_link
 *    @var $post_author_name
 *    @var $post_comment_numb
 *    @var $post_excerpt
 */
$posts_data = alone_get_posts($_args_query);

/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css, $atts ) );


/** elm ID **/
$attr_id = '';
if(! empty($el_id)) { $attr_id = "id='{$el_id}'"; }
?>
<div <?php echo esc_attr($attr_id); ?> class="<?php echo esc_attr($css_class); ?>">
  <div class="vc-custom-inner-wrap">
    <div class="give-grid" data-bears-masonryhybrid='{"col": <?php echo esc_attr($items); ?>, "space": <?php echo esc_attr($space); ?>}'>
			<div class="grid-sizer"></div>
			<div class="gutter-sizer"></div>
      <?php
      if(count($posts_data) > 0):
        foreach($posts_data as $item) {
          echo sprintf('<div class="item grid-item">%s</div>', $self->_template($layout, $item['post_id'], $atts));
        }
      else :
        echo sprintf('<div class="item">%s</div>', __('There are no posts to display!', 'alone'));
      endif;
      ?>
    </div>
  </div>
</div>
