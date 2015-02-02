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
					'style'		=>	'' ,
					'extras' 	=>	'' );

	public function __construct()
	{
		log_message('debug', "UI_helper > Element Class Initialized");
	}

	function id( $id = '' )
	{
		$this->properties['id'] = $id;
		return $this;
	}

	function name( $name = '' )
	{
		$this->properties['name'] = $name;
		return $this;
	}

	function value( $value = '' )
	{
		$this->properties['value'] = $value;
		return $this;
	}

	function classes( $classes = '' )
	{
		$this->properties['class'] .= ($this->properties['class'] == '')?	$classes:' '.$classes;
		return $this;
	}

	function style( $style = '' )
	{
		$style .= ($style[strlen($style)-1] == ';')?	'':';';
		$this->properties['style'] .= $style;
		return $this;
	}

	function disabled( $disabled = true )
	{
		$this->properties['disabled'] = ($disabled)? 'disabled':'';
		return $this;
	}

	function extras( $extras = '' )
	{
		$this->properties['extras'] .= ($this->properties['extras'] == '')?	$extras:' '.$extras;
		return $this;
	}

	function _parse_attributes()
	{
		$att = '';
		foreach ($this->properties as $key => $val)
		{
			if($key == 'extras')
			{
				$att .= $val . ' ';
			}
			else if($val != '')
			{
				$att .= $key . '="'. $val . '" ';
			}
		}

		return $att;
	}
}

class Row extends Element {

	public function __construct()
	{
		log_message('debug', "UI_helper > Row Class Initialized");
	}

	function open()
	{
		// Adding UI class row to the div element.
		$this->classes('row');
		echo '<div '.$this->_parse_attributes().' >';
        return $this;
	}

	function close()
	{
		echo '</div>';
	}
}

class Column extends Element {

	var $width = 6;
	var $t_width = 0;
	var $m_width = 0;
	var $ld_width = 0;

	public function __construct()
	{
		log_message('debug', "UI_helper > Column Class Initialized");
	}

	function width($w = 6)
	{
		//desktop width..........(md)
		$this->width = $w;
		return $this;
	}

	function t_width($w = 6)
	{
		//tablet width...........(sm)
		$this->t_width = $w;
		return $this;
	}

	function m_width($w = 6)
	{
		//mobile width...........(xs)
		$this->m_width = $w;
		return $this;
	}

	function ld_width($w = 6)
	{
		//large desktop width....(lg)
		$this->ld_width = $w;
		return $this;
	}

	function open()
	{
		if($this->width != 0)		$this->classes('col-md-'.$this->width);
		if($this->t_width != 0)		$this->classes('col-sm-'.$this->t_width);
		if($this->m_width != 0)		$this->classes('col-xs-'.$this->m_width);
		if($this->ld_width != 0)	$this->classes('col-lg-'.$this->ld_width);

		echo '<div '.$this->_parse_attributes().' >';
        return $this;
	}

	function close()
	{
		echo '</div>';
	}
}

class Box extends Element {

	var $title = '';
	var $uiType = '';
	var $solid = false;
	var $background = '';

	public function __construct()
	{
		log_message('debug', "UI_helper > Box Class Initialized");
	}

	function uiType($uiType = '')
	{
		//uiType ..... (primary/success/warning/danger/info)
		$this->uiType = $uiType;
		return $this;
	}

	function solid($solid = true)
	{
		$this->solid = $solid;
		return $this;
	}

	function background($background = '')
	{
		$this->background = $background;
		return $this;
	}

	function title($title = '')
	{
		$this->title = $title;
		return $this;
	}

	function open()
	{
		$this->classes('box');
		if($this->uiType != '')		$this->classes('box-'.$this->uiType);
		if($this->solid)			$this->classes('box-solid');
		if($this->background != '')	$this->classes('bg-'.$this->background);
		if($this->solid)			$this->classes('box-solid');

		echo '<div '.$this->_parse_attributes().' >
                    <div class="box-header">
                        <h3 class="box-title">'.$this->title.'</h3>
                    </div>
        			<div class="box-body">';
        return $this;
	}

	function close()
	{
		echo '</div></div>';
	}
}

class Table extends Element {

	var $bordered	= false;
	var $condensed	= false;
	var $striped	= false;
	var $hover		= false;
	var $responsive	= false;

	public function __construct()
	{
		log_message('debug', "UI_helper > Table Class Initialized");
	}

	function bordered($type = true)
	{
		$this->bordered = $type;
		return $this;
	}

	function condensed($type = true)
	{
		$this->condensed = $type;
		return $this;
	}

	function striped($type = true)
	{
		$this->striped = $type;
		return $this;
	}

	function hover($type = true)
	{
		$this->hover = $type;
		return $this;
	}

	function responsive($type = true)
	{
		$this->responsive = $type;
		return $this;
	}

	function open()
	{
		$this->classes('table');
		if($this->bordered)			$this->classes('table-bordered');
		if($this->condensed)		$this->classes('table-condensed');
		if($this->striped)			$this->classes('table-striped');
		if($this->hover)			$this->classes('table-hover');

		if($this->responsive)		echo '<div class="table-responsive">';
		echo '<table '.$this->_parse_attributes().' >';
        return $this;
	}

	function close()
	{
		echo '</table>';
		if($this->responsive)	echo '</div>';
	}
}

class Form extends Element {

	var $action = '';
	var $hidden = array();
	var $multipart = false;

	public function __construct()
	{
		log_message('debug', "UI_helper > Form Class Initialized");
	}

	function action($action = '')
	{
		$this->action = $action;
		return $this;
	}

	function hidden($hidden = array())
	{
		$this->hidden = $hidden;
		return $this;
	}

	function multipart($multipart = true)
	{
		$this->multipart = $multipart;
		return $this;
	}

	function open()
	{
		if($this->multipart)
			echo form_open_multipart($this->action, $this->_parse_attributes(), $this->hidden);
		else
			echo form_open($this->action, $this->_parse_attributes(), $this->hidden);
		return $this;
	}

	function close()
	{
		echo form_close();
	}
}

class Input extends Element {

	var $type = 'text';
	var $placeholder = '';
	var $label = '';
	var $uiType = '';

	public function __construct()
	{
		log_message('debug', "UI_helper > Input Class Initialized");
	}

	function type($type = '')
	{
		$this->type = $type;
		return $this;
	}

	function label($label = '')
	{
		$this->label = $label;
		return $this;
	}

	function placeholder($placeholder = '')
	{
		$this->placeholder = $placeholder;
		return $this;
	}

	function uiType($uiType = '')
	{
		$this->uiType = $uiType;
		return $this;
	}

	function show()
	{
		//form-group div
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
			echo "<input type=\"".$this->type."\" ";
			if($this->placeholder != '')
				echo "placeholder=\"".$this->placeholder."\" ";
			echo $this->_parse_attributes()." />";
		echo "</div>";
	}
}

class Radio extends Input {

	var $checked = false;

	public function __construct()
	{
		$this->type = 'radio';
		log_message('debug', "UI_helper > Radio Class Initialized");
	}

	function checked($check = true)
	{
		$this->checked = $check;
		return $this;
	}

	function show()
	{
		echo '<div class="radio">';
		echo '<label>';
		echo '<input type="radio" ';
		if($this->checked)	echo 'checked="checked" ';
		echo $this->_parse_attributes().' /> '
			.(($this->label != '')?	$this->label:'').
			 '</label></div>';
	}
}

class Checkbox extends Input {

	var $checked = false;

	public function __construct()
	{
		$this->type = 'checkbox';
		log_message('debug', "UI_helper > Radio Class Initialized");
	}

	function checked($check = true)
	{
		$this->checked = $check;
		return $this;
	}

	function show()
	{
		echo '<div class="checkbox">';
		echo '<label>';
		echo '<input type="checkbox" ';
		if($this->checked)	echo 'checked="checked" ';
		echo $this->_parse_attributes().' /> '
			.(($this->label != '')?	$this->label:'').
			 '</label></div>';
	}
}

class Textarea extends Element {

	var $placeholder = '';
	var $label = '';
	var $uiType = '';
	var $rows = 3;
	var $cols = 0;

	public function __construct()
	{
		log_message('debug', "UI_helper > Input Class Initialized");
	}

	function rows($rows = 3)
	{
		$this->rows = $rows;
		return $this;
	}

	function cols($cols = 0)
	{
		$this->cols = $cols;
		return $this;
	}

	function label($label = '')
	{
		$this->label = $label;
		return $this;
	}

	function placeholder($placeholder = '')
	{
		$this->placeholder = $placeholder;
		return $this;
	}

	function uiType($uiType = '')
	{
		$this->uiType = $uiType;
		return $this;
	}

	function show()
	{
		//form-group div
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
			echo "<textarea ";
			if($this->rows != 0)	echo "rows=\"".$this->rows."\" ";
			if($this->cols != 0)	echo "cols=\"".$this->cols."\" ";
			if($this->placeholder != '')	echo "placeholder=\"".$this->placeholder."\" ";

			// textarea don't use the value attribute
			$value = $this->properties['value'];
			unset($this->properties['value']);

			echo $this->_parse_attributes()." >".$value;
		echo "</textarea></div>";
	}
}

class Select extends Element {

	var $options = array();
	var $multiple = false;
	var $label = '';
	var $uiType = '';

	public function __construct()
	{
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
class DatePicker extends Element
{
	var $label = '';
	var $name = '';
	
	public function __construct()
	{
		log_message('debug', "UI_helper > DatePicker Class Initialized");
	}
	
	function label($label = '')
	{
		$this->label = $label;
		return $this;
	}
	
	function name($name = '')
	{
		$this->name = $name;
		return $this;
	}
	
	function show()
	{
		echo '
			<div>
          	  <label>'.$this->label.'</label>
			  <div class="input-append date date-picker" data-date-format="dd-mm-yyyy">
				<input size="16" type="text" name="'.$this->name.'">
				<span class="add-on" style="display:inline-block;"><i class="glyphicon glyphicon-calendar"></i></span>
			  </div>
          	</div><br>';
		echo "<script>$('.date-picker').datepicker({ format: 'dd-mm-yyyy', autoclose: true, todayBtn: 'linked'});</script>";
	}
}

class Alert {

	var $uiType = '';
	var $desc = '';
	var $title = '';
	var $dismiss = true;

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

	function dismiss($dismiss = true)
	{
		$this->dismiss = $dismiss;
		return $this;
	}

	function show()
	{
		$classes = 'alert ';
		if($this->uiType == 'error') $this->uiType = 'danger';
		if($this->uiType != '')	$classes .= 'alert-'.$this->uiType.' ';
		if($this->dismiss) $classes .= 'alert-dismissable ';

		echo '<div class="'.$classes.'" >';

		switch($this->uiType)
		{
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
	var $id = '';

	public function __construct()
	{
		log_message('debug', "UI_helper > Upload_image Class Initialized");
	}

	function action($action)
	{
		$this->action = $action;
		return $this;
	}
	function id($id)
	{
		$this->id = $id;
		return $this;
	}
	function show()
	{			
		echo '<div class="image_holder">
		<button id="imageDrop" onclick="document.getElementById(\'fileupload\').click()" title="Upload">Upload image</button>
		<input type="file" id="fileupload" />
		<hr />
		<div id="dvPreview" class="dvPreview"></div>';

	}

}
