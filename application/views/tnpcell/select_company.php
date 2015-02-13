<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
			
				$formbox =  $ui->box()->id('box_form')->open();
                    $form=$ui->form()->id("add_course_form")->action("course_structure/add/EnterNumberOfSubjects")->multipart()->open();
						$array_options = array();
						array_push($array_options,$ui->option()->text("Select Company")->disabled()->selected());
						foreach($dept as $row)
							array_push($array_options,$ui->option()->text($row['name']
						$ui->select()
						   ->options($array_options)
						   ->show();
					$form->close();
				$formbox->close();
			$column1->close();
		$outer_row->close();
?>