<?php if($img) echo '<div class="bt-image">'.$img.'</div>'; ?>
<div class="bt-overlay">
	<div class="bt-content">
		<?php 
			if($title){
				if(!empty($title_link_attributes)){
					echo '<h3 class="bt-title"><a '.implode(' ', $title_attributes).' '.implode(' ', $title_link_attributes).'>'.$title.'</a></h3>';
				}else{
					echo '<h3 class="bt-title" '.implode(' ', $title_attributes).'>'.$title.'</h3>';
				}
			}
			if($content) echo '<div class="bt-desc" '.implode(' ', $desc_attributes).'>'.$content.'</div>';
			if($link_text) echo '<a class="bt-readmore" '.implode(' ', $link_attributes).'>'.$link_text.'</a>';
		?>
	</div>
</div>