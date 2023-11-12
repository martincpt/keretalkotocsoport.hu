<?php
	$contact_list = vc_param_group_parse_atts( $atts['contact_list'] );
	if(!empty($contact_list)){
		foreach($contact_list as $contact_item){
			echo '<h3 class="bt-title">'.$contact_item['title'].'</h3>
				<div class="bt-info">'.$contact_item['desc'].'</div>';
		}
	}
