<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UI {
	function row()		{	return new Row();		}
	function col()		{	return new Column();	}
	function box()		{	return new Box();		}
	function table()	{	return new Table();		}
	function form()		{	return new Form();		}
	function input()	{	return new Input();		}
	function radio()	{	return new Radio();		}
	function checkbox()	{	return new Checkbox();	}
	function textarea()	{	return new Textarea();	}
	function select()	{	return new Select();	}
	function option()	{	return new Option();	}
	function button()	{	return new Button();	}
	function alert()	{	return new Alert();		}
	function callout()	{	return new Callout();	}
	function datePicker()	{	return new DatePicker();	}
	function upload_image()	{	return new Upload_image();	}
}











class Element {
	var $properties = array(
					'id'		=>	'' ,
					'name'		=>	'' ,
					'value' 	=>	'' ,
					'class' 	=>	'' ,
					'disabled'	=>	'' ,
					'extras' 	=>	'' );

	var $containerProps = array(
					'class' 	=> '',
					'extras' 	=> '',
					'style'		=> '',
					'id'		=> ''
					);

	var $width = 0;
	var $t_width = 0;
	var $m_width = 0;
	var $ld_width = 0;

	public function __construct() {
		$this->properties['id'] = md5(uniqid(rand(), true));
	}

	function id( $id = '' ) {
		$this->properties['id'] = $id;
		return $this;
	}

	function containerId( $id = '' ) {
		$this->containerProps['id'] = $id;
		return $this;
	}

	function name( $name = '' ) {
		$this->properties['name'] = $name;
		return $this;
	}

	function value( $value = '' ) {
		$this->properties['value'] = $value;
		return $this;
	}

	function classes( $classes = '' ) {
		$this->properties['class'] .= ($this->properties['class'] == '')?	$classes:' '.$classes;
		return $this;
	}

	function containerClasses( $classes = '' ) {
		$this->containerProps['class'] .= ($this->containerProps['class'] == '')?	$classes: ' '.$classes;
		return $this;
	}

	function width($w = 6) {
		//desktop width..........(md)
		$this->width = $w;
		
		// Temporarily setting large width equal to the width
		$this->ld_width = $w;
		return $this;
	}

	function t_width($w = 6) {
		//tablet width...........(sm)
		$this->t_width = $w;
		return $this;
	}

	function m_width($w = 6) {
		//mobile width...........(xs)
		$this->m_width = $w;
		return $this;
	}

	function ld_width($w = 6) {
		//large desktop width....(lg)
		$this->ld_width = $w;
		return $this;
	}

	function style( $style = '' ) {
		$style .= ($style[strlen($style)-1] == ';')?	'':';';
		$this->containerProps['style'] .= $style;
		return $this;
	}

	function disabled( $disabled = true ) {
		$this->properties['disabled'] = ($disabled)? 'disabled':'';
		return $this;
	}

	function extras( $extras = '' ) {
		$this->properties['extras'] .= ($this->properties['extras'] == '')?	$extras:' '.$extras;
		return $this;
	}

	function containerExtras( $extras = '' ) {
		$this->containerProps['extras'] .= ($this->containerProps['extras'] == '')?	$extras:' '.$extras;
		return $this;
	}

	function _parse_attributes() {
		$att = '';
		foreach ($this->properties as $key => $val) {
			if($key == 'extras')
				$att .= $val . ' ';
			else if($val != '')
				$att .= $key . '="'. $val . '" ';
		}

		return $att;
	}

	function _parse_container_attributes() {
		$att = '';
		
		if($this->width > 0) $this->containerClasses('col-md-' . $this->width);
		if($this->width > 0) $this->containerClasses('col-sm-' . $this->t_width);
		if($this->width > 0) $this->containerClasses('col-xs-' . $this->m_width);
		if($this->width > 0) $this->containerClasses('col-lg-' . $this->ld_width);
		
		foreach ($this->containerProps as $key => $val) {
			if($key == 'extras')
				$att .= $val . ' ';
			else if($val != '')
				$att .= $key . '="'. $val . '" ';
		}

		return $att;
	}

}













class Row extends Element {
	
	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Row Class Initialized");
	}

	function open() {
		// Adding UI class row to the div element.
		$this->containerClasses('row');
		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';
        return $this;
	}

	function close() {
		echo '</div>';
	}
}










class Column extends Element {

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Column Class Initialized");
		$this->width = 12;
		$this->m_width = 12;
		$this->t_width = 12;
		$this->ld_width = 12;
	}

	function open() {
		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';
        return $this;
	}

	function close() {
		echo '</div>';
	}
}









class Box extends Element {

	var $title = '';
	var $uiType = '';
	var $solid = false;
	var $background = '';

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Box Class Initialized");
		$this->containerClasses('box');
	}

	function uiType($uiType = '') {
		//uiType ..... (primary/success/warning/danger/info)
		$this->containerClasses('box-'.$uiType);
		return $this;
	}

	function solid($solid = true) {
		$this->containerClasses('box-solid');
		return $this;
	}

	function background($background = '') {
		$this->containerClasses('bg-' . $background);
		return $this;
	}

	function title($title = '') {
		$this->title = $title;
		return $this;
	}

	function open() {
		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>
                    <div class="box-header">
                        <h3 class="box-title">'.$this->title.'</h3>
                    </div>
        			<div class="box-body">';
        return $this;
	}

	function close() {
		echo '</div></div>';
	}
}










class Table extends Element {

	var $bordered	= false;
	var $condensed	= false;
	var $striped	= false;
	var $hover		= false;
	var $responsive	= false;

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Table Class Initialized");
		$this->containerClasses("table");
	}

	function bordered($type = true) {
		$this->containerClasses('table-bordered');
		return $this;
	}

	function condensed($type = true) {
		$this->containerClasses('table-condensed');
		return $this;
	}

	function striped($type = true) {
		$this->containerClasses('table-striped');
		return $this;
	}

	function hover($type = true) {
		$this->containerClasses('table-hover');
		return $this;
	}

	function responsive($type = true) {
		$this->responsive = $type;
		return $this;
	}

	function open() {
		if($this->responsive)		echo '<div class="table-responsive">';
		echo '<table '.$this->_parse_attributes().' '.$this->_parse_container_attributes().' >';
        return $this;
	}

	function close() {
		echo '</table>';
		if($this->responsive)	echo '</div>';
	}
}












class Form extends Element {

	var $action = '';
	var $hidden = array();
	var $multipart = false;

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Form Class Initialized");
	}

	function action($action = '') {
		$this->action = $action;
		return $this;
	}

	function hidden($hidden = array()) {
		$this->hidden = $hidden;
		return $this;
	}

	function multipart($multipart = true) {
		$this->multipart = $multipart;
		return $this;
	}

	function open() {
		if($this->multipart)
			echo form_open_multipart($this->action, $this->_parse_attributes(), $this->hidden);
		else
			echo form_open($this->action, $this->_parse_attributes(), $this->hidden);
		return $this;
	}

	function close() {
		echo form_close();
	}
}















class Input extends Element {

	var $type = 'text';
	var $placeholder = '';
	var $label = '';
	var $uiType = '';

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Input Class Initialized");
		$this->containerClasses("form-group");
		$this->classes('form-control');
		$this->width = 0;
		$this->ld_width = 0;
		$this->m_width = 0;
		$this->t_width = 0;
	}

	function type($type = '') {
		$this->properties["type"] = $type;
		return $this;
	}

	function label($label = '') {
		$this->label = $label;
		return $this;
	}

	function placeholder($placeholder = '') {
		$this->properties["placeholder"] = $placeholder;
		return $this;
	}

	function uiType($uiType = '') {
		$this->containerClasses("has-" . $uiType);
		return $this;
	}
	
	function show() {
		//form-group div
		echo '<div '.$this->_parse_container_attributes().'>';

			//label element
			if($this->label != '') {
				$ip_label = new Label();
				$ip_label->forId($this->properties['id'])
						 ->text($this->label)
						 ->uiType($this->uiType)
						 ->show();
			}

			//input element
			echo "<input type=\"".$this->type."\" ";
			echo $this->_parse_attributes()." />";
		echo "</div>";
	}
}











class Radio extends Input {

	var $checked = false;

	public function __construct() {
		parent::__construct();
		$this->containerClasses('radio');
		$this->properties['type'] = 'radio';
		log_message('debug', "UI_helper > Radio Class Initialized");
	}

	function checked($check = true) {
		$this->properties['checked'] = 'checked';
		return $this;
	}

	function show() {
		echo '<div '.$this->_parse_container_attributes().'>';
		echo '<label>';
		echo '<input ';
		echo $this->_parse_attributes().' /> '
			.(($this->label != '')?	$this->label:'').
			 '</label>
			 </div>';
	}
}

class Checkbox extends Radio {

	var $checked = false;

	public function __construct() {
		parent::__construct();
		$this->properties['type'] = 'checkbox';
		$this->containerClasses('checkbox');
		log_message('debug', "UI_helper > Radio Class Initialized");
	}
}













class Textarea extends Input {

	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Input Class Initialized");
		$this->properties['rows'] = 3;
		$this->properties['cols'] = 0;
	}

	function rows($rows = 3) {
		$this->properties['rows'] = $rows;
		return $this;
	}

	function cols($cols = 0) {
		$this->properties['cols'] = 0;
		return $this;
	}

	function show() {
		//form-group div
		echo '<div '.$this->_parse_container_attributes().'>';

			//label element
			if($this->label != '') {
				$ip_label = new Label();
				$ip_label->forId($this->properties['id'])
							->text($this->label)
							->uiType($this->uiType)
							->show();
			}

			//input element
			$this->classes('form-control');
			
			// textarea don't use the value attribute
			$value = $this->properties['value'];
			unset($this->properties['value']);
			
			echo "<textarea ";
			echo $this->_parse_attributes();
			echo ">".$value;
		echo "</textarea></div>";
	}
}

class Select extends Input {

	var $options = array();
	var $multiple = false;
	
	public function __construct() {
		parent::__construct();
		log_message('debug', "UI_helper > Select Class Initialized");
	}

	function options($options = array())
	{
		//options should be array of Option Objects
		$this->options = $options;
		return $this;
	}

	function multiple($multiple = true)
	{
		$this->multiple = $multiple;
		return $this;
	}

	function label($label = '')
	{
		$this->label = $label;
		return $this;
	}

	function uiType($uiType = '')
	{
		$this->uiType = $uiType;
		return $this;
	}
	function show()
	{
		echo '<div class="form-group ';
		if($this->uiType == 'danger')	$this->uiType = 'error';
		if($this->uiType !='')	echo 'has-'.strtolower($this->uiType);
		echo '">';

			//label element
			if($this->label != '')
			{
				$ip_label = new Label();
				$ip_label->forId($this->properties['id'])
							->text($this->label)
							->uiType($this->uiType)
							->show();
			}

			//input element
			$this->classes('form-control');
			echo "<select ";
			if($this->multiple)	echo "multiple=\"multiple\" ";
			// select don't use the value attribute
			unset($this->properties['value']);
			echo $this->_parse_attributes()." >";

			//options
			foreach($this->options as $option)
			{
				$option->show();
			}

		echo "</select></div>";
	}
}

class Button extends Element {

	var $submit = false;		//submit type button
	var $uiType = '';
	var $mini = false;
	var $large = false;
	var $flat = false;

	function submit($submit = true)
	{
		$this->submit = $submit;
		return $this;
	}

	function uiType($uiType = '')
	{
		$this->uiType = $uiType;
		return $this;
	}

	function mini($mini = true)
	{
		$this->mini = $mini;
		return $this;
	}

	function large($large = true)
	{
		$this->large = $large;
		return $this;
	}

	function flat($flat = true)
	{
		$this->flat = $flat;
		return $this;
	}

	function show()
	{
		$this->classes('btn');
		if($this->uiType == '')	$this->classes('btn-default');
		else 	$this->classes('btn-'.$this->uiType);

		if($this->mini)	$this->classes('btn-sm');
		else if($this->large)	$this->classes('btn-lg');

		if($this->flat)	$this->classes('btn-flat');

		if($this->properties['disabled'] != '')	$this->classes('disabled');

		if($this->submit)
			echo '<input type="submit" '.$this->_parse_attributes().' />';
		else
		{
			$val = $this->properties['value'];
			unset($this->properties['value']);
			echo '<button '.$this->_parse_attributes().' >'.$val.'</button>';
		}
	}
}

//date picker
class DatePicker extends Input
{
	var $label = '';
	var $dateFormat = 'dd-mm-yyyy';
	
	public function __construct()
	{
		log_message('debug', "UI_helper > DatePicker Class Initialized");
	}
	
	function label($label = '')
	{
		$this->label = $label;
		return $this; 
	}
	
	function dateFormat($dateFormat = 'dd-mm-yyyy')
	{
		$this->dateFormat = $dateFormat;
		return $this; 
	}
	
	function show()
	{
		$tempDivId = 'datepicker-' . $this->properties['id'].'-'.$this->properties['name'];
		echo '
			<div style="margin-bottom:10px;">
          	  <label>'.$this->label.'</label>
			  <div class="input-append date" id="'.$tempDivId.'" data-date-format="'.$this->dateFormat.'">
				<input size="16" type="text" '.$this->_parse_attributes().' >
				<span class="add-on" style="display:inline-block;"><i class="glyphicon glyphicon-calendar"></i></span>
			  </div>
          	</div>';
		echo "<script>$('#".$tempDivId."').datepicker({ format: '".$this->dateFormat."', autoclose: true, todayBtn: 'linked'});</script>";
	}
}

class Alert extends Element {

	var $uiType = '';
	var $desc = '';
	var $title = '';
	var $dismiss = true;

	public function __construct() {
		parent::__construct();
	}

	function uiType($uiType = '') {
		$this->uiType = $uiType;
		return $this;
	}

	function desc($desc = '') {
		$this->desc = $desc;
		return $this;
	}

	function title($title = '') {
		$this->title = $title;
		return $this;
	}

	function dismiss($dismiss = true) {
		$this->dismiss = $dismiss;
		return $this;
	}

	function show() {
		$this->containerClasses('alert');
		if($this->uiType == 'error') $this->uiType = 'danger';
		if($this->uiType != '')		 $this->containerClasses('alert-' . $this->uiType);
		if($this->dismiss) 			 $this->containerClasses('alert-dismissable');

		echo '<div '.$this->_parse_attributes().' '.$this->_parse_container_attributes().'>';

		switch($this->uiType) {
			case 'danger': echo '<i class="fa fa-ban"></i>';break;
			case 'info'	: echo '<i class="fa fa-info"></i>';break;
			case 'warning': echo '<i class="fa fa-warning"></i>';break;
			case 'success': echo '<i class="fa fa-check"></i>';break;
		}

		if($this->dismiss)
			echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

		if($this->title != '')	echo '<b>'.$this->title.'</b><br>';
		if($this->desc != '')	echo $this->desc;

		echo '</div>';
	}
}


class Callout {

	var $uiType = '';
	var $title = '';
	var $desc = '';

	function uiType($uiType = '')
	{
		$this->uiType = $uiType;
		return $this;
	}

	function desc($desc = '')
	{
		$this->desc = $desc;
		return $this;
	}

	function title($title = '')
	{
		$this->title = $title;
		return $this;
	}

	function show()
	{
		$classes = 'callout ';
		if($this->uiType == 'error') $this->uiType = 'danger';
		if($this->uiType != '')	$classes .= 'callout-'.$this->uiType.' ';

		echo '<div class="'.$classes.'" >';

		if($this->title != '')	echo '<h4>'.$this->title.'</h4>';
		if($this->desc != '')	echo '<p>'.$this->desc.'</p>';

		echo '</div>';
	}
}

class Option {

	var $value = '';
	var $text = '';
	var $disabled = false;
	var $selected = false;

	public function __construct()
	{
		log_message('debug', "UI_helper > Option Class Initialized");
	}

	function value($value = '')
	{
		$this->value = $value;
		return $this;
	}

	function text($text = '')
	{
		$this->text = $text;
		return $this;
	}

	function disabled($disabled = true)
	{
		$this->disabled = $disabled;
		return $this;
	}

	function selected($selected = true)
	{
		$this->selected = $selected;
		return $this;
	}

	function show()
	{
		echo '<option value = "'.$this->value.'" ';
		if($this->selected)	echo 'selected="selected" ';
		if($this->disabled)	echo 'disabled="disabled" ';
		echo '>'.$this->text.'</option>';
	}
}

class Label {

	var $forId = '';
	var $text = '';
	var $uiType = '';

	public function __construct()
	{
		log_message('debug', "UI_helper > Label Class Initialized");
	}

	function forId($forId = '')
	{
		$this->forId = $forId;
		return $this;
	}

	function text($text = '')
	{
		$this->text = $text;
		return $this;
	}

	function uiType($uiType = '')
	{
		$this->uiType = $uiType;
		return $this;
	}

	function show()
	{
		echo '<label ';

		if($this->forId != '')	echo 'for = "'.$this->forId.'"';

		if($this->uiType != '')
		{
			echo ' class="control-label" >';
			switch(strtolower($this->uiType))
			{
				case "success":	echo '<i class="fa fa-check"></i> ';break;
				case "danger":
				case "error":	echo '<i class="fa fa-times-circle-o"></i> ';break;
				case "warning":	echo '<i class="fa fa-warning"></i> ';break;
			}
		}
		else
			echo '>';
		echo $this->text.'</label>';
	}
}

class Upload_image extends Element {

	var $action = '';
	public function __construct()
	{
		log_message('debug', "UI_helper > Upload_image Class Initialized");
	}
	function show()
	{
		$tempImgId = "thumbnail" . $this->properties['id'];
		
		$upload_img_ui = new UI();
		$upload_img_col = $upload_img_ui->col()->width(4)->open();//	Width???
		$upload_img_box = $upload_img_ui->box()->solid()->title('Upload Image')->uitype('primary')->open();
		echo '<div style="overflow:hidden;">
		<img id="'.$tempImgId.'" />
		<hr />
		<input type="file" accept="image/*" '. $this->_parse_attributes() .' onchange=\'openFile(event)\'><br>
		
		</div>
		<script type="text/javascript">
			var openFile = function(event) {
				var input = event.target;
				var reader = new FileReader();
				reader.onload = function(){
					var dataURL = reader.result;
					$(input).parent().find("#'.$tempImgId.'").attr("src", dataURL);
					// output.src = dataURL;
				};
				reader.readAsDataURL(input.files[0]);
			};
		</script>
		';
		$upload_img_box->close();
		$upload_img_col->close();
	}
}
