<div class="bt-item">
	<div class="bt-content">
		<h3 class="bt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php
			if($readmore_text) echo '<a class="bt-readmore" href="'.get_the_permalink().'">'.$readmore_text.'</a>';
		?>
	</div>
</div>
