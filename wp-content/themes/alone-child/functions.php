<?php



function redirect_categories()
{
    $redirect_category_to_site_url = [
        ['category' => 'eloadasok', 'site_url' => '/eloadasok'],
        ['category' => 'galeria', 'site_url' => '/galeria'],
    ];
    foreach ($redirect_category_to_site_url as &$value) {
        if ( is_category( $value['category'] ) ) {
            $url = site_url( $value['site_url'] );
            wp_safe_redirect( $url, 301 );
            exit();
        }
    }
    
}
add_action( 'template_redirect', 'redirect_categories' );


function wpse_setup_theme() {
   add_theme_support( 'post-thumbnails' );
   add_image_size( 'eloadasok', 555, 370, true );
}

add_action( 'after_setup_theme', 'wpse_setup_theme' );




add_action( 'widgets_init', 'custom_register_plugin_widget' );

function custom_register_plugin_widget() {
    register_widget( 'Widget_Custom_Tax_Tag_Cloud' );
}

/**
 * New "best practice" is to extend the built-in WP_Widget class
 *
 * Class Widget_Custom_tax_tag_cloud
 */
class Widget_Custom_Tax_Tag_Cloud extends WP_Widget {
    function __construct() {
        parent::__construct( 'custom_tax_tag_cloud', 'Custom Taxonomy Tag Cloud', array( 'description' => 'Display a tag cloud for a custom taxonomy.' ) );
    }

    /**
     * Allows for manipulation, calculation, etc. when saving the widget instance in the dashboard.
     *
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    /**
     * Echos the widget contents in a sidebar
     *
     * @param array $args - the general widget arguments
     * @param array $instance - the settings for this specific widget
     */
    function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        echo $args['before_title'] . $instance['title'] . $args['after_title'];
        $cloud_args = array( 'taxonomy' => 'fw-portfolio-category' );
        echo '<div class="widget_tag_cloud">';
        echo '<div class="tagcloud">';
        wp_tag_cloud( $cloud_args );
        echo '</div>';
        echo '</div>';
        echo $args['after_widget'];
    }

    /**
     * Render the "Controls" in the dashboard menu under Appearance => Widgets
     *
     * @param array $instance - the settings for this instance of the widget
     *
     * @return null
     */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'taxonomy' => 'post_tag' ) );

        // Load the list of taxonomies available
        $taxonomies = get_taxonomies( array( 'public' => TRUE , 'show_tagcloud' => TRUE), 'objects' );

        echo '<p><label>Title</label><input name="' . $this->get_field_name( 'title' ) . '" id="' . $this->get_field_id( 'title' ) . '" value="' . esc_attr( $instance['title'] ) . '" /></p>';
        echo '<p><label>Taxonomy</label><select name="' . $this->get_field_name('taxonomy') . ' id="' . $this->get_field_id('taxonomy') . '">';
        echo '<option value="">Select Taxonomy...</option>';
        foreach($taxonomies AS $tax) {
            echo '<option value="' . $tax->name . '"';
            echo ($tax->name == $instance['taxonomy']) ? ' selected' : '';
            echo '>';
            echo ( ! empty($tax->labels->singular_name)) ? $tax->labels->singular_name : $tax->label;
            echo '</option>';
        }
        echo '</select></p>';
    }
}


function overwrite_shortcode() {
    require_once("framework-customizations/extensions/custom-js-composer/vc-params/vc_events_grid.php");
}

add_action('wp_loaded', 'overwrite_shortcode');



add_action( 'wp_footer', function () { ?>
	
    <!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-EDVMCM9SJV"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-EDVMCM9SJV');
	</script>

	<!-- lightGallery for gutenberg galleries -->
	<script>
	jQuery(document).ready(function($){
		if ($('.blocks-gallery-grid').length > 0) $('.blocks-gallery-grid').lightGallery({thumbnail: true, selector: 'a'});
	});
	</script>
    
    <?php });


///'eventDisplay'=> 'custom' // ADDED BY MARTIN SO IT ALSO GRABS PAST EVENTS !!! $$$$%%%^^&&&!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
///'eventDisplay'=> 'custom' // ADDED BY MARTIN SO IT ALSO GRABS PAST EVENTS !!! $$$$%%%^^&&&!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
////'eventDisplay'=> 'custom' // ADDED BY MARTIN SO IT ALSO GRABS PAST EVENTS !!! $$$$%%%^^&&&!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if ( ! function_exists( 'alone_get_posts' ) ):

    /**
	 *  Generate array with: recent/popular/commented posts
	 *
	 * @param string $sort Sort type (recent/popular/most commented)
	 * @param integer $items Number of items to be extracted
	 * @param boolean $image_post Extract or no post image
	 * @param boolean $return_image_tag Return with tag <img
	 * @param boolean $return_for_alone_image Return for alone_image function
	 * @param integer $image_width Set width of post image
	 * @param integer $image_height Set height of post image
	 * @param string $image_class Set class of post image
	 * @param boolean $date_post Extract or no post date
	 * @param string $date_format Set date format
	 * @param string $post_type Set post type
	 * @param string $category Set category from where posts would be extracted
	 */
	function alone_get_posts( $args = null ) {
		$defaults = array(
			'sort'                => 'recent',
			'cat_ids'             => '',
			'items'               => 5,
			'post_by_id'					=> array(),
			'image_post'          => true,
			'return_image_tag'    => true,
			'return_for_alone_image' => false,
			'image_size'					=> 'large',
			'image_width'         => 54,
			'image_height'        => 54,
			'image_class'         => 'thumbnail',
			'date_post'           => true,
			'date_format'         => 'F jS, Y',
			'date_query'          => array(),
			'post_type'           => 'post',
			'category'            => '',
			'excerpt_length'      => 40,
			'offset'							=> 0,
		);

		extract( wp_parse_args( $args, $defaults ) );
		global $post;
		$fw_cat_ID = ( ! empty( $category ) ) ? $category : '';

		if ( $sort == 'recent' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'post_date',
				'order'          => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items,
				'date_query'     => $date_query,
				'offset'				 => $offset,
			) );
			$posts = $query->get_posts();
			//echo '<pre>'; print_r($query); echo '</pre>';
		} elseif ( $sort == 'p_date' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'post_date',
				'order'          => $order,
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items,
				'date_query'     => $date_query,
				'offset'				 => $offset,
			) );
			$posts = $query->get_posts();
		}elseif ( $sort == 'v_date' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby' 			 =>'meta_value',
				'meta_key' 			 => '_EventStartDate',
				'order'          => $order,
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items,
				'date_query'     => $date_query,
				'offset'				 => $offset,
				'eventDisplay'=> 'custom' // ADDED BY MARTIN SO IT ALSO GRABS PAST EVENTS !!! $$$$%%%^^&&&!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			) );
			$posts = $query->get_posts();
		}
		elseif ( $sort == 'popular' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'meta_value',
				'meta_key'       => 'fw_post_views',
				'order'         => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items,
				'date_query'     => $date_query,
				'offset'				 => $offset,
			) );
			$posts = $query->get_posts();
		} elseif ( $sort == 'commented' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'comment_count',
				'order'         => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items,
				'date_query'     => $date_query,
				'offset'				 => $offset,
			) );
			$posts = $query->get_posts();
		} elseif ( $sort == 'by_id' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'post_date',
				'order'         => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items,
				'date_query'     => $date_query,
				'offset'				 => $offset,
				'post__in'       => $post_by_id,
			) );
			$posts = $query->get_posts();
		}elseif ( $sort == 'cat_id' ) {
					$tax_query = [
						'relation' => 'OR',
					];

					$term_query = array_map( function( $term_id ) {
						return [
							'taxonomy' => 'tribe_events_cat',
							'field'    => 'id',
							'terms'    => $term_id,
						];
					}, explode( ',', $cat ) );

					//print_r( $tax_query + $term_query );
					$query = new WP_Query( array(
						'post_type'      => $post_type,
						'orderby'        => 'post_date',
						'order'         => 'DESC',
						'tax_query' => $tax_query + $term_query,
					) );
					$posts = $query->get_posts();
			} elseif ( $sort == 'po_title' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'title',
				'order'         => $order,
				'posts_per_page' => $items,
				'date_query'     => $date_query,
				'offset'				 => $offset,
				//'post__in'       => $post_by_id,
			) );
			$posts = $query->get_posts();
			//echo '<pre>'; print_r($query); echo '</pre>';
		} else {
			return false;
		}
		 //echo '<pre>'; print_r($cat); echo '</pre>';
		$fw_post_option = array();
		$alone_count          = 0;
		if ( ! empty( $posts ) ) {
			foreach ( $posts as $post_elm ) {
				setup_postdata( $post_elm );
				$img = '';

				if ( $image_post == true ) {
					$post_thumbnail_id 	= get_post_thumbnail_id( $post_elm->ID );
					$post_thumbnail    	= wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
					$image 							= $post_thumbnail[0];

					if ( ! empty( $post_thumbnail ) ) {
						$img = function_exists('fw_resize') ? fw_resize( $post_thumbnail[0], $image_width, $image_height, true ) : $post_thumbnail[0];
						if ( $return_for_alone_image ) {
							$img = array(
								'attachment_id' => $post_thumbnail_id,
								'url'           => $post_thumbnail[0],
							);
						} elseif ( $return_image_tag ) {
							$img = '<img src="' . $image . '" class="' . $image_class . '" alt="' . get_the_title( $post_thumbnail_id ) . '" width="' . $image_width . '" height="' . $image_height . '" />';
						}
					}
				}

				if ( ! empty( $img ) ) {
					$fw_post_option[ $alone_count ]['post_img'] = $img;
				} else {
					$fw_post_option[ $alone_count ]['post_img'] = '';
				}

				if ( $date_post ) {
					$time_format                                = apply_filters( '_filter_widget_time_format', $date_format );
					$fw_post_option[ $alone_count ]['post_date_post'] = get_the_time( $time_format, $post_elm->ID );
				} else {
					$fw_post_option[ $alone_count ]['post_date_post'] = '';
				}

				$fw_post_option[ $alone_count ]['post_id']        		= $post_elm->ID;
				$fw_post_option[ $alone_count ]['post_class']        = ( is_singular() && $post->ID == $post_elm->ID ) ? 'current-menu-item post_' . $sort : 'post_' . $sort;
				$fw_post_option[ $alone_count ]['post_title']        = get_the_title( $post_elm->ID );
				$fw_post_option[ $alone_count ]['post_link']         = get_permalink( $post_elm->ID );
				$fw_post_option[ $alone_count ]['post_author_link']  = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$fw_post_option[ $alone_count ]['post_author_name']  = get_the_author();
				$fw_post_option[ $alone_count ]['post_comment_numb'] = get_comments_number( $post_elm->ID );
				$fw_post_option[ $alone_count ]['post_excerpt']      = ( isset( $post ) ) ? get_the_excerpt() : '';
				$alone_count ++;
			}
			wp_reset_postdata();
		}

		return $fw_post_option;
	}

endif;