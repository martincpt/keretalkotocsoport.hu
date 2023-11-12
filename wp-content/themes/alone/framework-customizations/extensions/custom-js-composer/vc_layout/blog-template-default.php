<?php
  $count = 0;
  while ( $wp_query->have_posts() ) { $wp_query->the_post();
    if($count > 2) $count = 0;
    $thumb_size = (!empty($img_size))?$img_size:'full';
    $thumbnail_id = get_post_thumbnail_id();
    $thumbnail = wp_get_attachment_image_src( $thumbnail_id, $img_size, false );

    if($count == 0){
    ?>
      <div class="col-md-7">
        <div class="bt-item bt-first">
          <?php
            echo '<div class="bt-thumb">
                <div class="bt-poster" style="background-image: url('.esc_url($thumbnail[0]).');"></div>
              </div>';
          ?>
          <div class="bt-content">
            <div class="bt-term"><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></div>
            <h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php echo '<div class="bt-excerpt">'.wp_trim_words(get_the_excerpt(), $excerpt_limit, $excerpt_more).'</div>'; ?>
            <ul class="bt-meta">
              <li class="bt-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(get_option('date_format')); ?></a></li>
              <li><?php esc_html_e('By ', 'alone'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
            </ul>
          </div>
        </div>
      </div>
    <?php }else{ ?>
      <div class="col-md-5">
        <div class="bt-item">
          <?php
            echo '<div class="bt-thumb">
                <div class="bt-poster" style="background-image: url('.esc_url($thumbnail[0]).');"></div>
              </div>';
          ?>
          <div class="bt-content">
            <div class="bt-term"><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></div>
            <h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <ul class="bt-meta">
              <li class="bt-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(get_option('date_format')); ?></a></li>
              <li><?php esc_html_e('By ', 'alone'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
            </ul>
          </div>
        </div>
      </div>
    <?php
    }
    $count++;
  }
?>
