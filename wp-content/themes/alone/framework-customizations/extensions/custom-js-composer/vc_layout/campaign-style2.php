<?php
  if($sub_title) echo '<div class="bt-sub-title" '.implode(' ', $sub_title_attributes).'>'.$sub_title.'</div>';
  if($title) echo '<h3 class="bt-title" '.implode(' ', $title_attributes).'>'.$title.'</h3>';
  if($content) echo '<div class="bt-desc" '.implode(' ', $desc_attributes).'>'.$content.'</div>';
?>
<div class="bt-give">
  <?php if($goal && $raised && ($goal > $raised)){ ?>
    <div class="bt-progress">
      <?php echo '<div class="bt-percent" style="width: '.esc_attr($percent).'%;"><span>'.$percent.'%</span></div>';?>

    </div>
    <div class="bt-price">
      <?php
        echo '<div class="bt-raised"><span>'.esc_html__('Raised: ', 'alone').'</span>$' . $price_raised.'</div>'.
          '<div class="bt-goal"><span>'.esc_html__('Goal: ', 'alone').'</span>$' . $price_goal.'</div>';
      ?>
    </div>
  <?php } ?>
</div>
<?php if($link_text) echo '<a class="bt-readmore" '.implode(' ', $link_attributes).'>'.$link_text.'</a>'; ?>
