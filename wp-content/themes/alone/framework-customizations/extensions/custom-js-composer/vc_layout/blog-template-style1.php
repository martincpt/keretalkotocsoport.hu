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
            echo '<div class="bt-poster" style="background-image: url('.esc_url($thumbnail[0]).');">';
          ?>
            <div class="bt-content">
              <div class="bt-date"><?php echo get_the_date( '\<\s\p\a\n\>d\<\/\s\p\a\n\> M, Y',$post->ID ); ?></div>
              <h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <ul class="bt-meta">
                <li><i class="fa fa-user" aria-hidden="true"></i> <?php esc_html_e(' By ', 'alone'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
                <li class="bt-cmt"><i class="fa fa-comment" aria-hidden="true"> </i> <?php echo get_comments_number($post->ID); ?><?php esc_html_e(' Comments', 'alone'); ?></li>
              </ul>
            </div>
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
            <div class="bt-date"><?php echo get_the_date( '\<\s\p\a\n\>d\<\/\s\p\a\n\> M, Y',$post->ID ); ?></div>
            <h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <ul class="bt-meta">
              <li><i class="fa fa-user" aria-hidden="true"></i> <?php esc_html_e(' By ', 'alone'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
              <li class="bt-cmt"><i class="fa fa-comment" aria-hidden="true"> </i> <?php echo get_comments_number($post->ID); ?><?php esc_html_e(' Comments', 'alone'); ?></li>
            </ul>
          </div>
        </div>
      </div>
    <?php
    }
    $count++;
  }
?>
