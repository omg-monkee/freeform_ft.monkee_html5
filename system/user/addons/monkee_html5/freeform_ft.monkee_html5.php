<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monkee_html5_freeform_ft extends Freeform_base_ft {
	public 	$info 	= array(
		'name' 			=> 'Monk-ee HTML5 Inputs',
		'version' 		=> '3.0.0', //Modified Freeform Text 5.1.0
		'description' 		=> 'A fieldtype allowing for the output of the new HTML5 input types in Freeform.'
	);

	public $default_length 	= '150';

	public $field_content_types 	= array(
		'color',
		'date',
		'datetime-local',
		'email',
		'month',
		'number',
		'range',
		'tel',
		'time',
		'url',
		'week'
	);
	
	public $javascript_events = array(
		'none',
		'onblur',
		'onchange',
		'onclick',
		'oncontextmenu',
		'ondblclick',
		'onfocus',
		'onfocusin',
		'onfocusout',
		'oninput',
		'oninvalid',
		'onkeydown',
		'onkeypress',
		'onkeyup',
		'onmousedown',
		'onmouseenter',
		'onmouseleave',
		'onmousemove',
		'onmouseover',
		'onmouseout',
		'onmouseup',
		'onreset',
		'onsearch',
		'onselect',
		'onsubmit'
	);


	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	null
	 */

	public function __construct () {
		parent::__construct();

		$this->info['name'] 		= lang('monkhtml5_default_field_name');
		$this->info['description'] 	= lang('monkhtml5_default_field_desc');
	}
	//END __construct


	// --------------------------------------------------------------------

	/**
	 * Display Entry in the CP
	 *
	 * formats data for cp entry
	 *
	 * @access	public
	 * @param 	string 	data from table for email output
	 * @return	string 	output data
	 */

	public function display_entry_cp ($data) {
		if (isset($this->settings['disallow_html_rendering']) AND
			$this->settings['disallow_html_rendering'] == 'n')
		{
			return ee()->functions->encode_ee_tags($data, TRUE);
		}
		else
		{
			return $this->form_prep_encode_ee($data);
		}
	}
	//END display_entry_cp


	// --------------------------------------------------------------------

	/**
	 * Replace Tag
	 *
	 * @access	public
	 * @param	string 	data
	 * @param 	array 	params from tag
 	 * @param 	string 	tagdata if there is a tag pair
	 * @return	string
	 */

	public function replace_tag ($data, $params = array(), $tagdata = FALSE)
	{
		if (isset($this->settings['disallow_html_rendering']) AND
			$this->settings['disallow_html_rendering'] == 'n')
		{
			return ee()->functions->encode_ee_tags($data, TRUE);
		}
		else
		{
			return $this->form_prep_encode_ee($data);
		}
	}
	//END replace_tag


	// --------------------------------------------------------------------

	/**
	 * Display Field
	 *
	 * @access	public
	 * @param	string 	saved data input
	 * @param  	array 	input params from tag
	 * @param 	array 	attribute params from tag
	 * @return	string 	display output
	 */

	public function display_field ($data = '', $params = array(), $attr = array())
	{
		$field = array();
		
		$field['type'] = $this->settings['field_content_type'];
		
		$maxlength = isset($this->settings['field_length']) ? $this->settings['field_length'] : $this->default_length;
		
		if ($this->settings['field_title_text'] != '') { $field_options['title'] = $this->settings['field_title_text']; }
		
		$field['name'] = $this->field_name;
		$field['id'] = 'freeform_' . $this->field_name;
		
		if ($data == '' and !isset($params['default_value'])) {
			$field['value'] = $this->settings['default_value'];
		} else {
			$field['value'] = $data;
		}
		
		$field['maxlength'] = $maxlength;
		if (isset($title)) { $field['title'] = $title; }
		if ($this->settings['placeholder'] != '') { $field['placeholder'] = $this->settings['placeholder']; }
		if ($this->settings['enable_autofocus'] == 'true') { $field['autofocus'] = ''; }
		
		if ($field['type'] == 'number' or $field['type'] == 'range') {
			if (is_numeric($this->settings['min'])) { $field['min'] = $this->settings['min']; }
			if (is_numeric($this->settings['max'])) { $field['max'] = $this->settings['max']; }
		}
		
		if ($this->settings['css_content'] == "true" or $this->settings['css_name'] == "true" or $this->settings['css_type'] == "true" or $this->settings['css_custom'] != '') {
			$class = '';
			if ($this->settings['css_content'] == "true") {
				$class .= $this->settings['field_content_type']; 
			}
			if ($this->settings['css_name'] == "true") {
				if (isset($class) and $class != '') { $class .= ' '; }
				$class .= $this->field_name;
			}
			if ($this->settings['css_type'] == "true") {
				if (isset($class) and $class != '') { $class .= ' '; }
				$class .= lang('monkhtml5_default_field_type'); 
			}
			if ($this->settings['css_custom']!= '') {
				if (isset($class) and $class != '') { $class .= ' '; }
				$class .= $this->settings['css_custom']; 
			}
			$field['class'] = $class;
		}
		
		if ($this->settings['custom_param_1'] != '') { $field[$this->settings['custom_param_1']] = $this->settings['custom_value_1']; }
		if ($this->settings['custom_param_2'] != '') { $field[$this->settings['custom_param_2']] = $this->settings['custom_value_2']; }
		if ($this->settings['custom_param_3'] != '') { $field[$this->settings['custom_param_3']] = $this->settings['custom_value_3']; }
		if ($this->settings['custom_param_4'] != '') { $field[$this->settings['custom_param_4']] = $this->settings['custom_value_4']; }
		if ($this->settings['custom_param_5'] != '') { $field[$this->settings['custom_param_5']] = $this->settings['custom_value_5']; }
		
		if ($this->settings['js_confirm'] == "true" and $this->settings['js_event'] != "none" and $this->settings['js_action'] != '') { $field[$this->settings['js_event']] = stripslashes($this->settings['js_action']); }
		
		if ($field['type'] == 'range') { $field['onmousemove'] = "updateOutput()"; }
		
		$output = form_input(array_merge($field, $attr));
		
		if ($field['type'] == 'range') {
			$output .= "<output id=\"myOutput\">" . $this->settings['default_value'] . "</output>\n";
			$output .= "<script>function updateOutput() { document.getElementById('myOutput').value = document.getElementById('freeform_range').value } </script>\n";
		}
				
		return $output;
	}
	//END display_field


	// --------------------------------------------------------------------

	/**
	 * Display Field Settings
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */

	public function display_settings ($data = array())
	{
		$content_type 	= isset($data['field_content_type']) ?
							$data['field_content_type'] :
							'any';
		
		$output = "<select name=\"field_content_type\">\n";
		foreach ($this->field_content_types as $type)
		{
			$output .= "<option value=\"" . $type . "\"";
			if ($content_type == $type) { $output .= " selected"; }
			$output .= ">" . lang($type) . "</option>\n";
		}
		$output .= "</select>\n";
		
		ee()->table->add_row(
			lang('monkhtml5_field_content_type', 'field_content_type') .
				'<div class="subtext">' .
					lang('monkhtml5_field_content_type_desc') .
				'</div>',
			$output
		);

		ee()->table->add_row(
			lang('monkhtml5_field_length', 'field_length') .
				'<div class="subtext">' .
					lang('monkhtml5_field_length_desc') .
				'</div>',
			form_input(array(
				'name'		=> 'field_length',
				'id'		=> 'field_length',
				'value'		=> isset($data['field_length']) ?
								$data['field_length'] :
								$this->default_length,
				'maxlength'	=> '250',
				'size'		=> '50',
			))
		);

		$disallow_html_rendering	= ( ! isset($data['disallow_html_rendering']) OR
						$data['disallow_html_rendering'] == '') ?
							'y' :
							$data['disallow_html_rendering'];

		ee()->table->add_row(
			lang('monkhtml5_disallow_html_rendering', 'disallow_html_rendering') .
			'<div class="subtext">' .
				lang('monkhtml5_disallow_html_rendering_desc') .
			'</div>',
			form_hidden('disallow_html_rendering', 'n') .
			form_checkbox(array(
				'id'	=> 'disallow_html_rendering',
				'name'	=> 'disallow_html_rendering',
				'value'		=> 'y',
				'checked' 	=> $disallow_html_rendering == 'y'
			)) .
			'&nbsp;&nbsp;' .
			lang('monkhtml5_enable', 'disallow_html_rendering')
		);
			
		//placeholder
		$placeholder 		= ( ! isset($data['placeholder']) OR
						$data['placeholder'] == '') ?
						'' :
						$data['placeholder'];
							
		ee()->table->add_row(
			lang('monkhtml5_placeholder', 'placeholder') .
				'<div class="subtext">' .
					lang('monkhtml5_placeholder_desc') .
				'</div>',
			form_input(array(
				'name'		=> 'placeholder',
				'id'		=> 'placeholder',
				'value'		=> $placeholder,
				'maxlength'	=> '250',
				'size'		=> '50',
			))
		);
		
		//default value
		$default_value 		= ( ! isset($data['default_value']) OR
						$data['default_value'] == '') ?
						'' :
						$data['default_value'];
							
		ee()->table->add_row(
			lang('monkhtml5_default_value', 'default_value') .
				'<div class="subtext">' .
					lang('monkhtml5_default_value_desc') .
				'</div>',
			form_input(array(
				'name'		=> 'default_value',
				'id'		=> 'default_value',
				'value'		=> $default_value,
				'maxlength'	=> '250',
				'size'		=> '50',
			))
		);
		
		//min, max value
		$min 		= ( ! isset($data['min']) OR
						$data['min'] == '') ?
						'' :
						$data['min'];
						
		$max 		= ( ! isset($data['max']) OR
						$data['max'] == '') ?
						'' :
						$data['max'];
						
		$output = "<label>" . lang('monkhtml5_min') . "</label>&nbsp;";
		$output .= form_input(array(
				'name'		=> 'min',
				'id'		=> 'min',
				'value'		=> $min,
				'maxlength'	=> '32',
				'size'		=> '10',
			));
		
		$output .= "&nbsp;&nbsp;&nbsp;<label>" . lang('monkhtml5_max') . "</label>&nbsp;";
		$output .= form_input(array(
				'name'		=> 'max',
				'id'		=> 'max',
				'value'		=> $max,
				'maxlength'	=> '32',
				'size'		=> '10',
			));
							
		ee()->table->add_row(
			lang('monkhtml5_min_max', 'min_max') .
				'<div class="subtext">' .
					lang('monkhtml5_min_max_desc') .
				'</div>',
			$output
		);
		
		//autofocus
		$enable_autofocus 		= ( ! isset($data['enable_autofocus']) OR
						$data['enable_autofocus'] == '') ?
							'false' :
							$data['enable_autofocus'];
							
		ee()->table->add_row(
			lang('monkhtml5_enable_autofocus', 'enable_autofocus') .
			'<div class="subtext">' .
				lang('monkhtml5_enable_autofocus_desc') .
			'</div>',
			form_hidden('enable_autofocus', 'n') .
			form_checkbox(array(
				'id'	=> 'enable_autofocus',
				'name'	=> 'enable_autofocus',
				'value'		=> 'true',
				'checked' 	=> $enable_autofocus == 'true'
			)) .
			'&nbsp;&nbsp;' .
			lang('monkhtml5_enable', 'enable_autofocus')
		);
		
		//title field
		$title_value 		= ( ! isset($data['field_title']) OR
						$data['field_title'] == '') ? 'field_desc' : $data['field_title'];
						
		$title_custom_value 		= ( ! isset($data['field_title_text']) OR
						$data['field_title_text'] == '' OR $title_value != 'field_custom') ?
						'' :
						$data['field_title_text'];
						
		$output = form_radio(array('name' => 'field_title', 'id' => 'field_none', 'value' => 'none', 'checked' => ($title_value == 'none'), 'onclick' => "$('#field_title_custom').attr('disabled', '');"));
		$output .= NBS . NBS . lang('monkhtml5_field_none', 'field_none') . NBS . NBS . NBS . NBS . "\n";
		
		$output .= form_radio(array('name' => 'field_title', 'id' => 'field_label', 'value' => 'field_label', 'checked' => ($title_value == 'field_label'), 'onclick' => "$('#field_title_custom').attr('disabled', '');"));
		$output .= NBS . NBS . lang('monkhtml5_field_label', 'field_label') . NBS . NBS . NBS . NBS . "\n";
		
		$output .= form_radio(array('name' => 'field_title', 'id' => 'field_desc', 'value' => 'field_desc', 'checked' => ($title_value == 'field_desc'), 'onclick' => "$('#field_title_custom').attr('disabled', '');"));
		$output .= NBS . NBS . lang('monkhtml5_field_desc', 'field_desc') . NBS . NBS . NBS . NBS . "\n";
		
		$output .= form_radio(array('name' => 'field_title', 'id' => 'field_custom', 'value' => 'field_custom', 'checked' => ($title_value == 'field_custom'), 'onclick' => "$('#field_title_custom').removeAttr('disabled');"));
		$output .= NBS . NBS . lang('monkhtml5_field_custom', 'field_custom') . NBS . NBS . NBS . NBS . "\n";
		$output .= "<input type='text' name='field_title_custom' id='field_title_custom' placeholder='" . lang('monkhtml5_field_title_custom') . "' value='$title_custom_value'";
		if ($title_value != 'field_custom') { $output .= " disabled"; }
		$output .= " />\n";
		
		ee()->table->add_row(
			lang('monkhtml5_field_title', 'field_title') .
				'<div class="subtext">' .
					lang('monkhtml5_field_title_desc') .
				'</div>',
			$output
		);
		
		//css class
		$css_content 		= ( ! isset($data['css_content']) OR
						$data['css_content'] == '') ?
							'false' :
							$data['css_content'];
							
		$css_name 		= ( ! isset($data['css_name']) OR
						$data['css_name'] == '') ?
							'false' :
							$data['css_name'];
							
		$css_type 		= ( ! isset($data['css_type']) OR
						$data['css_type'] == '') ?
							'false' :
							$data['css_type'];
							
		$css_custom 		= ( ! isset($data['css_custom']) OR
						$data['css_custom'] == '') ?
						'' :
						$data['css_custom'];
							
		ee()->table->add_row(
			lang('monkhtml5_css_classes', 'css_classes') .
			'<div class="subtext">' .
				lang('monkhtml5_css_classes_desc') .
			'</div>',
			form_hidden('css_content', 'n') .
			form_checkbox(array(
				'id'	=> 'css_content',
				'name'	=> 'css_content',
				'value'		=> 'true',
				'checked' 	=> $css_content == 'true'
			)) .
			'&nbsp;&nbsp;' .
			lang('monkhtml5_css_content', 'css_content') .
			'&nbsp;&nbsp;&nbsp;&nbsp;' .
			form_hidden('css_name', 'n') .
			form_checkbox(array(
				'id'	=> 'css_name',
				'name'	=> 'css_name',
				'value'		=> 'true',
				'checked' 	=> $css_name == 'true'
			)) .
			'&nbsp;&nbsp;' .
			lang('monkhtml5_css_name', 'css_name') .
			'&nbsp;&nbsp;&nbsp;&nbsp;' .
			form_hidden('css_type', 'n') .
			form_checkbox(array(
				'id'	=> 'css_type',
				'name'	=> 'css_type',
				'value'		=> 'true',
				'checked' 	=> $css_type == 'true'
			)) .
			'&nbsp;&nbsp;' .
			lang('monkhtml5_css_type', 'css_type') .
			'&nbsp;&nbsp;&nbsp;&nbsp;' .
			form_input(array(
				'name'		=> 'css_custom',
				'id'		=> 'css_custom',
				'value'		=> $css_custom,
				'placeholder'	=> lang('monkhtml5_css_custom'),
				'maxlength'	=> '250',
				'size'		=> '50',
			))
		);
		
		//custom parameters
		$custom_param_1		= ( ! isset($data['custom_param_1']) OR
						$data['custom_param_1'] == '') ?
							'' :
							$data['custom_param_1'];
							
		$custom_value_1		= ( ! isset($data['custom_value_1']) OR
						$data['custom_value_1'] == '') ?
							'' :
							$data['custom_value_1'];					
							
		$custom_param_2		= ( ! isset($data['custom_param_2']) OR
						$data['custom_param_2'] == '') ?
							'' :
							$data['custom_param_2'];
		
		$custom_value_2		= ( ! isset($data['custom_value_2']) OR
						$data['custom_value_2'] == '') ?
							'' :
							$data['custom_value_2'];
												
		$custom_param_3		= ( ! isset($data['custom_param_3']) OR
						$data['custom_param_3'] == '') ?
							'' :
							$data['custom_param_3'];
		
		$custom_value_3		= ( ! isset($data['custom_value_3']) OR
						$data['custom_value_3'] == '') ?
							'' :
							$data['custom_value_3'];
												
		$custom_param_4		= ( ! isset($data['custom_param_4']) OR
						$data['custom_param_4'] == '') ?
							'' :
							$data['custom_param_4'];
		
		$custom_value_4		= ( ! isset($data['custom_value_4']) OR
						$data['custom_value_4'] == '') ?
							'' :
							$data['custom_value_4'];
												
		$custom_param_5		= ( ! isset($data['custom_param_5']) OR
						$data['custom_param_5'] == '') ?
							'' :
							$data['custom_param_5'];					
		
		$custom_value_5		= ( ! isset($data['custom_value_5']) OR
						$data['custom_value_5'] == '') ?
							'' :
							$data['custom_value_5'];	
		
		ee()->table->add_row(
			lang('monktext_custom_params', 'custom_params') .
			'<div class="subtext">' .
				lang('monktext_custom_params_desc') .
			'</div>',
			'<p>'.
			form_input(array(
				'name'		=> 'custom_param_1',
				'id'		=> 'custom_param_1',
				'value'		=> $custom_param_1,
				'placeholder'	=> lang('monktext_custom_place'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)) . '&nbsp;&nbsp;&nbsp;&nbsp;' .
			form_input(array(
				'name'		=> 'custom_value_1',
				'id'		=> 'custom_value_1',
				'value'		=> $custom_value_1,
				'placeholder'	=> lang('monktext_custom_value'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)) . '</p><p>' .
			form_input(array(
				'name'		=> 'custom_param_2',
				'id'		=> 'custom_param_2',
				'value'		=> $custom_param_2,
				'placeholder'	=> lang('monktext_custom_place'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)) . '&nbsp;&nbsp;&nbsp;&nbsp;' .
			form_input(array(
				'name'		=> 'custom_value_2',
				'id'		=> 'custom_value_2',
				'value'		=> $custom_value_2,
				'placeholder'	=> lang('monktext_custom_value'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)). '</p><p>' .
			form_input(array(
				'name'		=> 'custom_param_3',
				'id'		=> 'custom_param_3',
				'value'		=> $custom_param_3,
				'placeholder'	=> lang('monktext_custom_place'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)) . '&nbsp;&nbsp;&nbsp;&nbsp;' .
			form_input(array(
				'name'		=> 'custom_value_3',
				'id'		=> 'custom_value_3',
				'value'		=> $custom_value_3,
				'placeholder'	=> lang('monktext_custom_value'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)). '</p><p>' .
			form_input(array(
				'name'		=> 'custom_param_4',
				'id'		=> 'custom_param_4',
				'value'		=> $custom_param_4,
				'placeholder'	=> lang('monktext_custom_place'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)) . '&nbsp;&nbsp;&nbsp;&nbsp;' .
			form_input(array(
				'name'		=> 'custom_value_4',
				'id'		=> 'custom_value_4',
				'value'		=> $custom_value_4,
				'placeholder'	=> lang('monktext_custom_value'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)). '</p><p>' .
			form_input(array(
				'name'		=> 'custom_param_5',
				'id'		=> 'custom_param_5',
				'value'		=> $custom_param_5,
				'placeholder'	=> lang('monktext_custom_place'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)) . '&nbsp;&nbsp;&nbsp;&nbsp;' .
			form_input(array(
				'name'		=> 'custom_value_5',
				'id'		=> 'custom_value_5',
				'value'		=> $custom_value_5,
				'placeholder'	=> lang('monktext_custom_value'),
				'maxlength'	=> '250',
				'size'		=> '50',
			)) . '</p>'
		);
		
		//javascript
		$js_confirm	= ( ! isset($data['js_confirm']) OR
						$data['js_confirm'] == '') ?
							'false' :
							$data['js_confirm'];
							
		$js_event 	= isset($data['js_event']) ?
							$data['js_event'] :
							'none';
							
		$js_action 		= ( ! isset($data['js_action']) OR
						$data['js_action'] == '') ?
						'' :
						$data['js_action'];
		
		$output = "<select name=\"js_event\" id=\"js_event\"";
		if ($js_confirm == "false") { $output .= ' disabled'; }
		$output .= ">\n";
		foreach ($this->javascript_events as $event)
		{
			$output .= "<option value=\"" . $event . "\"";
			if ($js_confirm == "true") { if ($js_event == $event) { $output .= " selected"; } }
			$output .= ">" . $event . "</option>\n";
		}
		$output .= "</select>\n";
		
		$text_field = array(
			'name'		=> 'js_action',
			'id'		=> 'js_action',
			'value'		=> $js_action,
			'placeholder'	=> lang('monkhtml5_js_action'),
			'maxlength'	=> '250',
			'size'		=> '50'
		);
		
		if ($js_confirm == "false") { $text_field['disabled'] = ''; }
		
		ee()->table->add_row(
			lang('monkhtml5_js_event', 'js_event') .
				'<div class="subtext">' .
					lang('monkhtml5_js_event_desc') .
				'</div>',
			form_hidden('js_confirm', 'n') .
			form_checkbox(array(
				'id'	=> 'js_confirm',
				'name'	=> 'js_confirm',
				'value'		=> 'true',
				'checked' 	=> $js_confirm == 'true',
				'onclick'	=> "$('#js_event, #js_action').attr('disabled',!$('#js_event').attr('disabled'))"
			)) .
			'&nbsp;&nbsp;' .
			lang('monkhtml5_js_confirm', 'js_confirm') .
			'<br /><br />' .
			$output .
			'&nbsp;&nbsp;&nbsp;&nbsp;' .
			form_input($text_field)
		);
	}
	//END display_settings


	// --------------------------------------------------------------------

	/**
	 * Save Field Settings
	 *
	 * @access	public
	 * @return	string
	 */

	public function save_settings ($data = array())
	{
		//max field length
		$field_length 	= ee()->input->get_post('field_length');

		$field_length 	= (
			is_numeric($field_length) AND
			$field_length > 0 AND
			$field_length < 9999
		) ?	$field_length : $this->default_length;

		//field content type. only valid if in the list
		$field_content_type = ee()->input->get_post('field_content_type');
		$field_content_type = in_array(
			$field_content_type,
			$this->field_content_types) ?
				$field_content_type :
				'color';
				
		//min and max numbers, only valid if numeric
		$min = ee()->input->get_post('min');
		$max = ee()->input->get_post('max');
		
		$min 	= (
			is_numeric($min) AND
			$min < $max
		) ?	$min : '';
		
		$max 	= (
			is_numeric($max) AND
			$max > $min
		) ?	$max : '';
		
		$field_title = ee()->input->get_post('field_title');
		if ($field_title == 'field_label') {
			$title = ee()->input->get_post('field_label'); 
		} else if ($field_title == 'field_desc') {
			$title = ee()->input->get_post('field_description'); 
		} else if ($field_title == 'field_custom') {
			$title = ee()->input->get_post('field_title_custom');
		} else {
			$title = '';
		}

		return array(
			'field_length' 			=> $field_length,
			'field_content_type'	=> $field_content_type,
			'disallow_html_rendering'	=> (
				ee()->input->get_post('disallow_html_rendering') == 'n' ? 'n' : 'y'
			),
			'placeholder' => ee()->input->get_post('placeholder'),
			'default_value' => ee()->input->get_post('default_value'),
			'min' => $min,
			'max' => $max,
			'enable_autofocus'	=> (ee()->input->get_post('enable_autofocus') == 'n' ? 'false' : 'true'
			),
			'field_title' => ee()->input->get_post('field_title'),
			'field_title_text' => $title,
			'css_content'	=> (ee()->input->get_post('css_content') == 'n' ? 'false' : 'true'
			),
			'css_name'	=> (ee()->input->get_post('css_name') == 'n' ? 'false' : 'true'
			),
			'css_type'	=> (ee()->input->get_post('css_type') == 'n' ? 'false' : 'true'
			),
			'css_custom' => ee()->input->get_post('css_custom'),
			'custom_param_1' => ee()->input->get_post('custom_param_1'),
			'custom_value_1' => ee()->input->get_post('custom_value_1'),
			'custom_param_2' => ee()->input->get_post('custom_param_2'),
			'custom_value_2' => ee()->input->get_post('custom_value_2'),
			'custom_param_3' => ee()->input->get_post('custom_param_3'),
			'custom_value_3' => ee()->input->get_post('custom_value_3'),
			'custom_param_4' => ee()->input->get_post('custom_param_4'),
			'custom_value_4' => ee()->input->get_post('custom_value_4'),
			'custom_param_5' => ee()->input->get_post('custom_param_5'),
			'custom_value_5' => ee()->input->get_post('custom_value_5'),
			'js_confirm'	=> (ee()->input->get_post('js_confirm') == 'n' ? 'false' : 'true'
			),
			'js_event' => ee()->input->get_post('js_event'),
			'js_action' => ee()->input->get_post('js_action')
		);
	}
	//END save_settings


	// --------------------------------------------------------------------

	/**
	 * validate
	 *
	 * @access	public
	 * @param	string $data 	data to validate
	 * @return	bool  			validated?
	 */

	public function validate ($data)
	{
		if (is_array($data))
		{
			$data = implode("\n", $data);
		}

		$data = trim((string) $data);

		// -------------------------------------
		//	check field length
		// -------------------------------------

		if (isset($this->settings['field_length']) AND
			strlen($data) > $this->settings['field_length'])
		{
			$this->errors[] = str_replace(
				'%num%',
				$this->settings['field_length'],
				lang('monkhtml5_max_length_exceeded')
			);

			return $this->errors;
		}

		// -------------------------------------
		//	is the data worth futher checking?
		// -------------------------------------
		
		return TRUE;
	}
	//END validate
}
//END class Monkee_html5_freeform_ft
