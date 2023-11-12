<?php
  $count = 0;
  while ( $wp_query->have_posts() ) { $wp_query->the_post();
    if($count > 4) $count = 0;
    $thumb_size = (!empty($img_size))?$img_size:'full';
    $thumbnail_id = get_post_thumbnail_id();
    $thumbnail = wp_get_attachment_image_src( $thumbnail_id, $img_size, false );
    $user = wp_get_current_user();

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
              <li class="bt-date"><?php echo get_the_date(get_option('date_format')); ?></li>
              <li class="bt-term"><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></li>
            </ul>
            <h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="bt-author">
              <?php
              if ( $user ) :
                  ?>
                  <img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" />
              <?php endif; ?>
              <?php esc_html_e('Posted By ', 'alone'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></div>
          </div>
        </div>
      </div>
    <?php }else{ ?>
      <div class="col-md-6">
        <div class="bt-item">
          <div class="bt-content">
            <ul class="bt-meta">
              <li class="bt-date"><?php echo get_the_date(get_option('date_format')); ?></li>
              <li class="bt-term"><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></li>
            </ul>
            <h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          </div>
        </div>
      </div>
    <?php
    }
    $count++;
  }
?>
