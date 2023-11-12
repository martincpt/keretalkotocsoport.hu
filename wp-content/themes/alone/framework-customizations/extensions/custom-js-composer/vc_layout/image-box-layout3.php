<?php
if($title){
	if(!empty($title_link_attributes)){
		echo '<h3 class="bt-title"><a '.implode(' ', $title_attributes).' '.implode(' ', $title_link_attributes).'>'.$title.'</a></h3>';
	}else{
		echo '<h3 class="bt-title" '.implode(' ', $title_attributes).'>'.$title.'</h3>';
	}
}
?>
<div class="bt-image-wrap">
	<?php if($img) echo '<div class="bt-image">'.$img.'</div>'; ?>
	<div class="bt-overlay">
		<?php  if($content) echo '<div class="bt-desc" '.implode(' ', $desc_attributes).'>'.$content.'</div>'; ?>
	</div>
</div>
<?php if($link_text) echo '<a class="bt-readmore" '.implode(' ', $link_attributes).'>'.$link_text.'</a>'; ?>
