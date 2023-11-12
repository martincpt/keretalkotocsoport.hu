<?php
if($title){
	if(!empty($title_link_attributes)){
		echo '<h3 class="bt-title"><a '.implode(' ', $title_attributes).' '.implode(' ', $title_link_attributes).'>'.$title.'</a></h3>';
	}else{
		echo '<h3 class="bt-title" '.implode(' ', $title_attributes).'>'.$title.'</h3>';
	}
}
if($content) echo '<div class="bt-excerpt" '.implode(' ', $desc_attributes).'>'.$content.'</div>';
if($post_icon || $post_name || $post_date){
	echo '<div class="bt-meta">';
		if($post_icon) echo '<div class="bt-icon"><i class="'.esc_attr($post_icon).'"></i></div>';
		if($post_name) echo '<div class="bt-name">'.esc_html($post_name).'</div>';
		if($post_date) echo '<h5 class="bt-date">'.esc_html($post_date).'</h5>';
	echo '</div>';
}
