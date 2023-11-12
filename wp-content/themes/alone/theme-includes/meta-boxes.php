<?php
class BearsthemesFiMetaboxes {
	public function __construct(){
		global $bearstheme_options;
		$this->data = $bearstheme_options;
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
		add_action('save_post', array($this, 'save_meta_boxes'));
		//add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
	}
	public function add_meta_boxes()
	{
		$post_types = get_post_types( array( 'public' => true ) );
		$this->add_meta_box('post_team', __('Team Settings','alone'), 'team');
	}
	public function save_meta_boxes($post_id)
	{
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		foreach($_POST as $key => $value) {
			if(strstr($key, 'tb_')) {
				update_post_meta($post_id, $key, $value);
			}
		}
	}
	public function add_meta_box($id, $label, $post_type)
	{
		add_meta_box(
		'tb_' . $id,
		$label,
		array($this, $id),
		$post_type
		);
	}
	public function post_team()
	{
		include get_template_directory() .'/theme-includes/post_team.php';
	}
	public function text($id, $label, $default, $desc = '')
	{
		global $post;
		$value = get_post_meta($post->ID, 'tb_' . $id, true);
		if (!$value){
			$value = $default;
		}
		$html = '';
		$html .= '<div id="tb_metabox_field_'.$id.'" class="tb_metabox_field">';
		$html .= '<label for="tb_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<input type="text" id="tb_' . $id . '" name="tb_' . $id . '" value="' . $value . '" />';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo ''.$html;
	}
	public function checkbox($id, $label, $default, $desc = '')
	{
		global $post;
		$value = get_post_meta($post->ID, 'tb_' . $id, true);
		if (!$value){
			$value = $default;
		}
		$html = '';
		$html .= '<div id="tb_metabox_field_'.$id.'" class="tb_metabox_field">';
		$html .= '<label for="tb_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field tb-checkbox">';
		$html .= '<input type="hidden" id="tb_' . $id . '" name="tb_' . $id . '" value="' . $value . '" />';
		$html .= '<input type="checkbox"/>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo ''.$html;
	}
	public function text_date($id, $label, $default, $desc = '')
	{
		global $post;
		$value = get_post_meta($post->ID, 'tb_' . $id, true);
		if (!$value){
			$value = $default;
		}
		$html = '';
		$html .= '<div id="tb_metabox_field_'.$id.'" class="tb_metabox_field">';
		$html .= '<label for="tb_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<input type="text" id="tb_' . $id . '" class="bt-date-picker" name="tb_' . $id . '" value="' . $value . '" />';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo ''.$html;
	}
	public function hidden($id){
		global $post;
		$html = '<input type="hidden" id="tb_' . $id . '" name="tb_' . $id . '" value="' . get_post_meta($post->ID, 'tb_' . $id, true) . '" />';
		echo ''.$html;
	}
	public function select($id, $label, $options,$default, $desc = '')
	{
		global $post;
		$html = null;
		$html .= '<div id="tb_metabox_field_'.$id.'" class="tb_metabox_field">';
		$html .= '<label for="tb_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<select id="tb_' . $id . '" name="tb_' . $id . '">';
		$value = get_post_meta($post->ID, 'tb_' . $id, true);
		$default = $value == '' ? $default ='global': $value;

		foreach($options as $key => $option) {
                    $selected = $default === (string)$key?'selected="selected"':null;
                    $html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo ''.$html;
	}

	public function multiple($id, $label, $options, $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div id="tb_metabox_field_'.$id.'" class="tb_metabox_field">';
		$html .= '<label for="tb_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<select multiple="multiple" id="tb_' . $id . '" name="tb_' . $id . '[]">';
		foreach($options as $key => $option) {
			if(is_array(get_post_meta($post->ID, 'tb_' . $id, true)) && in_array($key, get_post_meta($post->ID, 'tb_' . $id, true))) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}

			$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo ''.$html;
	}

	public function textarea($id, $label, $desc = '')
	{
		global $post;

		$html = '';
		$html = '';
		$html .= '<div id="tb_metabox_field_'.$id.'" class="tb_metabox_field">';
		$html .= '<label for="tb_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<textarea cols="30" rows="5" id="tb_' . $id . '" name="tb_' . $id . '">' . get_post_meta($post->ID, 'tb_' . $id, true) . '</textarea>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo ''.$html;
	}

	public function upload($id, $label, $desc = '')
	{
		global $post;
		$html = '';
		$html = '';
		$html .= '<div id="tb_metabox_field_'.$id.'" class="tb_metabox_field">';
		$html .= '<label for="tb_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<input name="tb_' . $id . '" class="upload_field" id="tb_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'tb_' . $id, true) . '" />';
		$html .= '<input class="tb_upload_button button button-primary button-large" type="button" value="Browse" />';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo ''.$html;
	}
}
$metaboxes = new BearsthemesFiMetaboxes();
