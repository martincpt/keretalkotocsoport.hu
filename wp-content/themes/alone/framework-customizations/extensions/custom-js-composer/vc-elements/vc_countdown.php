<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $vcCountDown_self;
global $vcCountDown_content;
// Params extraction
extract( shortcode_atts( array(
    'self'              => '',
    'content'           => '',
    /* Source */
	  'count_down' => __('2020', 'alone'),
    /* Style */
		'tpl'      => 'tpl1',
    'el_id'             => '',
    'el_class'          => '',
    'css'               => '',
  ), $atts ) );
$self = $vcCountDown_self;
$content = $vcCountDown_content;

/**
 * @var $css_class
 */
extract( $self->getStyles( $el_class, $css, $atts ) );


/** elm ID **/
$layout                 = $tpl;
$count_down             = $count_down;
$attr_id = '';
if ( ! empty( $el_id ) ) {
	$attr_id = "id='{$el_id}'";
}
?>
<div <?php echo esc_attr( $attr_id ); ?> class="<?php echo esc_attr( $css_class ); ?>">
	<div class="vc-custom-inner-wrap">
			<?php
					echo sprintf( '<div class="item layout-' . $layout . '">%s</div>', $self->_template( $layout, $atts ) );
			 ?>
       <script type="text/javascript">
       (function($){
				$(document).ready(function(){
          // Set the date we're counting down to
          var countDownDate = new Date("<?php echo $count_down; ?>").getTime();

          // Update the count down every 1 second
          var x = setInterval(function() {

              // Get todays date and time
              var now = new Date().getTime();

              // Find the distance between now and the count down date
              var distance = countDownDate - now;

              // Time calculations for days, hours, minutes and seconds
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);

              // Output the result in an element with id="demo"
              document.getElementById("getting-started").innerHTML = "<div class='bt-day'>" + days + "<span>Days</span>" + "</div>" + "<div class='bt-hours'>" + hours + "<span>Hours</span>" + "</div>"
              + "<div class='bt-min'>" + minutes + "<span>Minutes</span>" + "</div>" + "<div class='bt-sec'>" + seconds + "<span>Seconds</span>" + "</div>";

              // If the count down is over, write some text
              if (distance < 0) {
                  clearInterval(x);
                  document.getElementById("getting-started").innerHTML = "EXPIRED";
              }
          }, 1000);
          })
        })(jQuery)
        </script>
	</div>
</div>
