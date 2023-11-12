<?php
if($title){
	if(!empty($title_link_attributes)){
		echo '<h3 class="bt-title"><a '.implode(' ', $title_attributes).' '.implode(' ', $title_link_attributes).'>'.$title.'</a></h3>';
	}else{
		echo '<h3 class="bt-title" '.implode(' ', $title_attributes).'>'.$title.'</h3>';
	}
}
if($content) echo '<div class="bt-excerpt" '.implode(' ', $desc_attributes).'>'.$content.'</div>';

?>
<div class="bt-action">
	<ul class="bt-left-icon">
		<?php
			echo '<li><a href="'.esc_url($sermon_video).'"><i class="fa fa-video-camera"></i></a></li>
				<li><a href="'.esc_url($sermon_download).'"><i class="fa fa-cloud-download"></i></a></li>
				<li><a href="'.esc_url($sermon_file).'"><i class="fa fa-file-text"></i></a></li>';
		?>
	</ul>
	<ul class="bt-right-icon">
		<?php
			echo '<li><a href="'.esc_url($sermon_share).'"><i class="fa fa-share-alt"></i></a></li>
				<li><a href="'.esc_url($sermon_like).'"><i class="fa fa-heart-o"></i></a></li>';
		?>
	</ul>
</div>
<?php echo '<audio controls="controls" src="'.esc_url($sermon_audio).'"></audio>';
