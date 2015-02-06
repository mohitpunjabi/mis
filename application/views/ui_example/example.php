<?php
	$ui = new UI();
	
	$ui->callout()
	   ->title("This is just a small example")
	   ->uiType("warning")
	   ->desc('This example shows only a handful of the UI options. ' .
	   		  'See the <a href="http://172.16.8.5/wiki/index.php/UI_Library">UI Library wiki</a> for a detailed list of options. ' .
			  'Help us build this page by adding more example codes.')
	   ->show();

?><h2 class="page-header">Different box types</h2><?

$boxTypesRow = $ui->row()->open();
	$col = $ui->col()->width(4)->open();
		$box = $ui->box()
				  ->title("Default Box")
				  ->open();
?><p>This is the default box. It is the simplest box you can create. Use the following to create this:</p>
<pre>
$box = $ui->box()
          ->title("Default Box")
          ->open();
</pre><?
		$box->close();
	$col->close();		


	$col = $ui->col()->width(4)->open();
		
		$box = $ui->box()
				  ->title("A different UI type")
				  ->uiType("success")
				  ->open();
?><p>You can add some UI types to boxes based on their uses:</p>
<pre>
$box = $ui->box()
          ->title("A different UI type")
          ->uiType("success")
          ->open();
</pre><?
		$box->close();
	$col->close();
	
	$col = $ui->col()->width(4)->open();
		
		$box = $ui->box()
				  ->title("Add an awesome icon")
				  ->uiType("info")
				  ->icon($ui->icon('star'))
				  ->open();
				  
		?><p>Add icons to boxes. Here are a few icons: </p>
        
        <h4><? 
			$iconSamples = array("user", "tags", "edit", "check-circle", "upload", "key", "book", "camera");
			for($i = 0; $i < sizeof($iconSamples); $i++)  {
				$ui->icon($iconSamples[$i])->show(); 
				echo " ";
			}
		?></h4>
        
        <p>Choose from over 400 icons. <a href="http://fontawesome.io/icons/" target="_blank">See the full list</a>.</p>
<pre>
$box = $ui->box()
          ->title("Add an awesome icon")
          ->icon($ui->icon('star'))
          ->open();
</pre><?
		$box->close();
	$col->close();

$boxTypesRow->close();

$boxTypesRow = $ui->row()->open();
	$col = $ui->col()->width(6)->open();
		$box = $ui->box()
				  ->title("Add tooltips")
				  ->tooltip("You can also add a tooltip for additional help.")
				  ->solid()
				  ->icon($ui->icon("info-circle"))
				  ->uiType("primary")
				  ->open();
				?><p>You can add tooltips, make the box solid and use different colors. Use the following to create this:</p>
<pre>
$box = $ui->box()
          ->tooltip("You can also add a tooltip for additional help.")
          ->solid()
          ->uiType("primary")
          ->open();
</pre><?
		$box->close();
	$col->close();		

	$col = $ui->col()->width(3)->open();
		$box = $ui->box()
				  ->title("Here's another color")
				  ->tooltip("See the wiki for a lists of UI types.")
				  ->solid()
				  ->uiType("info")
				  ->open();
				?><p>You can add tooltips, make the box solid and use different colors. Use the following to create this:</p>
<pre>
$box = $ui->box()
          ->solid()
          ->uiType("info")
          ->open();
</pre><?
		$box->close();
	$col->close();		

	$col = $ui->col()->width(3)->open();
		$box = $ui->box()
				  ->title("And another color")
				  ->tooltip("See the wiki for a lists of UI types.")
				  ->solid()
				  ->uiType("warning")
				  ->open();
				?><p>You can add tooltips, make the box solid and use different colors. Use the following to create this:</p>
<pre>
$box = $ui->box()
          ->solid()
          ->uiType("warning")
          ->open();
</pre><?
		$box->close();
	$col->close();		
$boxTypesRow->close();


?><h2 class="page-header">Alerts and callouts</h2><?


$alertsRow = $ui->row()->open();
	$col = $ui->col()->width(6)->open();
		$box = $ui->box()
				  ->title("Alerts")
				  ->icon($ui->icon("exclamation-triangle"))
				  ->open();

			$ui->alert()
			   ->uiType("danger")
			   ->title("Some error occured!")
			   ->desc("An error occured that you might want to know about. Could be important - pay attention!")
			   ->show();

			$ui->alert()
			   ->uiType("info")
			   ->title("Useful information!")
			   ->desc('This alert was created using <code>uiType("info")</code>. Just FYI.')
			   ->show();

			$ui->alert()
			   ->uiType("success")
			   ->title("Success!")
			   ->desc('Alert box created successfully using <code>uiType("success")</code>.')
			   ->show();

			$ui->alert()
			   ->uiType("warning")
			   ->title("I dare you! I double dare you!")
			   ->desc('Use <code>uiType("warning")</code> to create this alert. You have been warned!')
			   ->show();

		?><p>You can make closable alert boxes. Here's how:</p>
<pre>
$box = $ui->alert()
          ->title("...")
          ->desc("...")
          ->uiType("danger")
          ->show();
</pre><?
		$box->close();
	$col->close();

	$col = $ui->col()->width(6)->open();
		$box = $ui->box()
				  ->title("Callouts")
				  ->icon($ui->icon("bullhorn"))
				  ->open();

			$ui->callout()
			   ->uiType("danger")
			   ->title("Some error occured!")
			   ->desc("An error occured that you might want to know about. Could be important - pay attention!")
			   ->show();

			$ui->callout()
			   ->uiType("info")
			   ->title("Useful information!")
			   ->desc('This callout was created using <code>uiType("info")</code>. Just FYI.')
			   ->show();

			$ui->callout()
			   ->uiType("warning")
			   ->title("I dare you! I double dare you!")
			   ->desc('Use <code>uiType("warning")</code> to create this callout. You have been warned!')
			   ->show();

		?><p>You can make callouts. Here's how:</p>
<pre>
$box = $ui->callout()
          ->title("...")
          ->desc("...")
          ->uiType("danger")
          ->show();
</pre><?
		$box->close();
	$col->close();		
$alertsRow->close();


?><?

?><h2 class="page-header">General Elements</h2><?

$buttonsRow = $ui->row()->open();
	$col = $ui->col()->width(7)->open();
		$buttonBox = $ui->box()
				  ->title("Buttons")
		          ->open();
		
			$btnTable = $ui->table()->bordered()->open();
			?>
            <tr>
            	<th>Normal</th>
                <th>Large<br /><code>large()</code></th>
                <th>Mini<br /><code>mini()</code></th>
                <th>Disabled<br /><code>disabled()</code></th>
            </tr>
            <tr>
            	<td><? $ui->button()->value("Default")->show() ?></td>
            	<td><? $ui->button()->value("Default")->large()->show() ?></td>
            	<td><? $ui->button()->value("Default")->mini()->show() ?></td>
            	<td><? $ui->button()->value("Default")->disabled()->show() ?></td>
            </tr>

			<? $btnTypes = array("primary", "success", "info", "danger", "warning") ?>

			<? foreach($btnTypes as $key => $type) { ?>
            <tr>
            	<td><? $ui->button()->value(ucwords($type))->uiType($type)->show() ?></td>
            	<td><? $ui->button()->value(ucwords($type))->uiType($type)->large()->show() ?></td>
            	<td><? $ui->button()->value(ucwords($type))->uiType($type)->mini()->show() ?></td>
            	<td><? $ui->button()->value(ucwords($type))->uiType($type)->disabled()->show() ?></td>
            </tr>
            <? } ?>
            <?
			$btnTable->close();
		$buttonBox->close();
		
		$labelBox = $ui->box()
				  ->title("Labels")
		          ->open();

			?><p>Create labels to show status messages, like the following:</p>

			<p><?
			$ui->label()
			   ->uiType("success")
			   ->text("Complete")
			   ->show();

			echo " ";

			$ui->label()
			   ->uiType("danger")
			   ->text("Rejected")
			   ->show();
			   
			echo " ";
			
			$ui->label()
			   ->uiType("warning")
			   ->text("Pending")
			   ->show();
			
			echo " ";
			   
			$ui->label()
			   ->uiType("info")
			   ->text("Ongoing")
			   ->show();
			?></p>
<pre>
$ui->label()
   ->uiType("info")
   ->text("Ongoing")
   ->show();
</pre>
<?
		$labelBox->close();
	$col->close();

	$col = $ui->col()->width(5)->open();
		$box = $ui->box()
				  ->title("It's easy to create buttons")
				  ->uiType("info")
				  ->solid()
				  ->open();

			$ui->callout()
			   ->uiType("info")
			   ->desc('You can also set the <code>id</code>, <code>name</code> and other attributes. ' . 
			   		  'See the <a href="http://172.16.8.5/wiki/index.php/UI_Library">wiki</a> for full details.')
			   ->show();
	  
?>
<p>Here's how you create a basic button. Use the properties shown to style the buttons:
<pre>
$ui->button()
   ->value("Some text")
   ->uiType("someType")
   ->show();
</pre>

<h4>A <code>block()</code> button</h4>
<p>A block button spans the whole box (or the parent):</p>
<? 
			$ui->button()
			   ->value("Block button")
			   ->block()
			   ->show();

			$ui->button()
			   ->value("Large block primary button")
			   ->block()
			   ->large()
			   ->uiType("primary")
			   ->show();
?>
<h4>Button with an <code>icon()</code></h4>
<p>Add an icon to the button using the <code>icon()</code> property:</p>
<pre>
$ui->button()
   ...
   ->icon($ui->icon('some-icon'))
   ->show();
</pre>
<? 
			$ui->button()
			   ->value("Edit")
			   ->icon($ui->icon('pencil'))
			   ->show();

			echo ' ';

			$ui->button()
			   ->value("Delete")
			   ->uiType("danger")
			   ->icon($ui->icon('trash-o'))
			   
			   ->show();

		$box->close();
	$col->close();
$buttonsRow->close();


$tablesRow = $ui->row()->open();
	$col = $ui->col()->open();
		$box = $ui->box()
				  ->title("Tables")
				  ->open();

?>
<p>You can use different combinations of the following options to create <code>Table</code>s:</p>
<pre>
$table = $ui->table()
            ->hover()
            ->bordered()
            ->striped()
            ->responsive()
            ->condensed()
            ->open();
    ...
$table->close();
</pre>
<?

			$table = $ui->table()->hover()->bordered()->open();
			
			echo '<tbody>
						<tr>
							<th>ID</th>
							<th>User</th>
							<th>Date</th>
							<th>Status</th>
							<th>Reason</th>
						</tr>
						<tr>
							<td>183</td>
							<td>John Doe</td>
							<td>11-7-2014</td>
							<td><span class="label label-success">Approved</span></td>
							<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
						</tr>
						<tr>
							<td>219</td>
							<td>Jane Doe</td>
							<td>11-7-2014</td>
							<td><span class="label label-warning">Pending</span></td>
							<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
						</tr>
						<tr>
							<td>657</td>
							<td>Bob Doe</td>
							<td>11-7-2014</td>
							<td><span class="label label-primary">Approved</span></td>
							<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
						</tr>
						<tr>
							<td>175</td>
							<td>Mike Doe</td>
							<td>11-7-2014</td>
							<td><span class="label label-danger">Denied</span></td>
							<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
						</tr>
					</tbody>';
			$table->close();
		$box->close();
	$col->close();
$tablesRow->close();


?><h2 class="page-header">Form Elements</h2><?


$formRow = $ui->row()->open();

	$col = $ui->col()->width(8)->open();
		$box = $ui->box()
				  ->title("General Elements")
				  ->open();

			$ui->callout()
			   ->uiType("info")
			   ->desc("See wiki for a detailed explanation of creating each type of element.")
			   ->show();


			$ui->input()->type("text")->label("Text")->placeholder("Text")->show();

			$ui->input()->type("text")->label("Text Disabled")->placeholder("Text Disabled")->disabled()->show();

			$ui->textarea()->label("Textarea")->placeholder("Textarea")->show();

			$ui->input()->type("text")->label("Input with success")->placeholder("Enter text")->uiType("success")->show();
			$ui->input()->type("text")->label("Input with warning")->placeholder("Enter text")->uiType("warning")->show();
			$ui->input()->type("text")->label("Input with error")->placeholder("Enter text")->uiType("error")->show();

			$ui->checkbox()->label("Checkbox")->show();
			$ui->checkbox()->label("Disabled Checkbox")->disabled()->show();

			$ui->radio()->label("Radio button")->name("sampleRadio")->checked()->show();
			$ui->radio()->label("Another Radio Button")->name("sampleRadio")->show();

			$ui->select()
				->label('Select Box')
				->name('select_box')
				->options(array($ui->option()->value('0')->text('Select')->disabled(),
								$ui->option()->value('1')->text('One'),
								$ui->option()->value('2')->text('Two'),
								$ui->option()->value('3')->text('Three'),
								$ui->option()->value('4')->text('Four')->selected(),
								$ui->option()->value('5')->text('Five')))
				->show();

			$sampleOptions = array($ui->option()->value('0')->text('Select')->disabled(),
								$ui->option()->value('1')->text('One'),
								$ui->option()->value('2')->text('Two'),
								$ui->option()->value('3')->text('Three'),
								$ui->option()->value('4')->text('Four')->selected(),
								$ui->option()->value('5')->text('Five'));

			$ui->select()
				->label('Multiple Select Box')
				->name('multiple_select_box')
				->multiple()
				->options($sampleOptions)
				->show();
		
			$ui->imagePicker()->label("An image picker")->show();	
			
			$ui->datePicker()->label("A date picker")->show();	

?>
<p>To create input elements with smaller widths, create a <code>Row</code> and place the inputs inside it with their <code>width()</code> property:</p>
<pre>
$inputsRow = $ui->row()->open();
    $ui->input()->type("text")->...->width(2)->show();
    $ui->select()->...->width(4)->show();
    $ui->input()->...->width(6)->show();
$inputsRow->close();
</pre>
<?
			$textRow = $ui->row()->open();
				$ui->input()->type("text")->label("Small")->placeholder("Enter text")->width(2)->show();
				$ui->select()->label("Medium")->placeholder("Enter text")->width(4)->options($sampleOptions)->show();
				$ui->input()->type("text")->label("Large input")->placeholder("Enter text")->width(6)->show();
			$textRow->close();

		$box->close();
	$col->close();


	$col = $ui->col()->width(4)->open();
		$box = $ui->box()
				  ->title("Quick example")
				  ->uiType("info")
				  ->solid()
				  ->open();
				  
			$quickForm = $ui->form()
							->action("#")
							->open();

?>
<pre>
$ui->input()
   ->type("someType")
   ->label("A label")
   ->placeholder("A nice placeholder")
   ->name("someName")
   ->id("someId")
   ->required()
   ->show();	
</pre>
<?			  
				  $ui->input()
				     ->type("text")
					 ->label("Username")
					 ->placeholder("Enter your username")
					 ->name("username")
					 ->show();

				  $ui->input()
				     ->type("password")
					 ->label("Password")
					 ->placeholder("Enter your password")
					 ->name("password")
					 ->show();	

				  ?><hr /><?				
				  $ui->button()
				     ->submit()
					 ->value("Submit")
					 ->large()
					 ->uiType("primary")
					 ->show();

				  $ui->checkbox()
				     ->label("Remember me")
					 ->width(6)
					 ->checked()
					 ->show();

			$quickForm->close();
				  
		$box->close();
		
		$box = $ui->box()
				  ->title("Addons")
				  ->uiType("info")
				  ->solid()
				  ->open();
				  
?>
<p>You can add <code>Button</code>s, <code>Icon</code>s or plain texts as an addon to the left or right (or both) as follows:</p>
<pre>
$ui->input()
   ->...
   ->addonLeft('someAddon')
   ->addonRight('someAddon')
   ->show();
</pre>
<?
		  $ui->input()
			 ->type("text")
			 ->label("Textbox with button addon.")
			 ->placeholder("Enter some text")
			 ->addonRight($ui->button()->value("Go")->uiType("primary"))
			 ->show();

		  $ui->select()
			 ->label("Select with left icon addon, and right text addon.")
			 ->options($sampleOptions)
			 ->addonLeft($ui->icon("usd"))
			 ->addonRight(".00")
			 ->show();

		  $ui->datePicker()
			 ->label("Date with left icon addon, right button addon")
			 ->addonLeft($ui->icon("calendar"))
			 ->addonRight($ui->button()->value("Choose")->uiType("success"))
			 ->uiType("success")
			 ->show();

		$box->close();
	$col->close();
$formRow->close();
