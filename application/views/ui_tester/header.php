
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>UI TESTING</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?= base_url() ?>assets/bootstrap-3.3.2/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Theme style -->
        <link href="<?= base_url() ?>assets/adminLTE/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    	<link href="<?= base_url() ?>assets/datepicker/bootstrap-datepicker.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap-3.3.2/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?= base_url() ?>assets/datepicker/bootstrap-datepicker.js"></script>

        <!-- AdminLTE App -->
        <script src="<?= base_url() ?>assets/adminLTE/js/AdminLTE/app.js" type="text/javascript"></script>
    </head>


    <body>
    <?php
        $ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
		

            $column1 = $ui->col()->width(6)->t_width(6)->m_width(12)->open();
			
                echo 'In Column 1';
                $box = $ui->box()->uiType('danger')->title('box 1')->open();
                    echo 'In box 1<br><br>';

                    $ui->alert()
                        ->uiType('danger')
                        ->title('Danger Alert')
                        ->desc('It is a Danger Alert')
                        ->show();

                    $ui->alert()
                        ->uiType('success')
                        ->title('Success Alert')
                        ->desc('Alert was successfully created ..... ')
                        ->show();

                    $ui->alert()
                        ->uiType('info')
                        ->title('Info Alert')
                        ->desc('Please find the information regarding .... here ...........')
                        ->show();

                    $ui->alert()
                        ->uiType('warning')
                        ->title('Warning Alert')
                        ->desc('Warning : Please stick to the helper regarding the new UI .....')
                        ->show();

                $box->close();



                $formbox =  $ui->box()->id('form_box')->title('Form')->open();
                    $form=$ui->form()->multipart()->open();
													
                        $ui->input()
                            ->placeholder('input text')
                            ->label('Enter the username')
                            ->uiType('warning')
                            ->id('input_ele')
                            ->name('name')
                            ->show();

                        $ui->input()
                            ->placeholder('input password')
                            ->label('Incorrect Password')
                            ->uiType('error')
                            ->type('password')
                            ->id('input_pass')
                            ->name('pass')
                            ->show();

                        $ui->radio()
                            ->name('radio')
                            ->label('radio 1')
                            ->show();

                        $ui->radio()
                            ->name('radio')
                            ->label('radio 2')
                            ->show();

                        $ui->checkbox()
                            ->name('check')
                            ->label('checkbox 1')
                            ->show();

                        $ui->textarea()
                            ->label('Textarea label')
                            ->id('textarea_id')
                            ->value('It is value')
                            ->name('txt')
                            ->show();

                        $ui->select()
                            ->label('select box')
                            ->name('select_box')
                            ->options(array($ui->option()->value('0')->text('Select')->disabled(),
                                            $ui->option()->value('1')->text('One'),
                                            $ui->option()->value('2')->text('Two'),
                                            $ui->option()->value('3')->text('Three'),
                                            $ui->option()->value('4')->text('Four')->selected(),
                                            $ui->option()->value('5')->text('Five')))
                            ->show();

                        $ui->select()
                            ->label('Multiple select box')
                            ->name('multiple_select_box')
                            ->multiple()
                            ->options(array($ui->option()->value('0')->text('Select')->disabled(),
                                            $ui->option()->value('1')->text('One'),
                                            $ui->option()->value('2')->text('Two'),
                                            $ui->option()->value('3')->text('Three'),
                                            $ui->option()->value('4')->text('Four')->selected(),
                                            $ui->option()->value('5')->text('Five')))
                            ->show();
						
						//date picker
						$ui->datePicker()
							->label('Date Picker')
							->name('date1')
							->placeholder("Enter the date")
							->dateFormat('dd-mm-yyyy')
							->show();
							
                        $ui->button()
                            ->value('Submit')
                            ->uiType('primary')
                            ->flat()
                            ->submit()
                            ->name('submit')
                            ->show();

                        $ui->button()
                            ->value('Button')
                            ->uiType('success')
                            ->mini()
                            ->name('button')
                            ->show();

                    $form->close();
                $formbox->close();
            $column1->close();

            $column2 = $ui->col()->m_width(12)->open();
                echo "In Column 2";
                $box2 = $ui->box()->uiType('success')->title('box 2')->open();
                    echo 'In box 2';

                    $ui->callout()
                        ->uiType('danger')
                        ->title('Danger Callout')
                        ->desc('There is a problem that we need to fix.')
                        ->show();

                    $ui->callout()
                        ->uiType('info')
                        ->title('Info Callout')
                        ->desc('Please follow the instructions.')
                        ->show();


                $box2->close();

                $box3 = $ui->box()->title('Table')->open();
                    echo 'In Box 3';
                    //$table = $ui->table()->open();
                    $table = $ui->table()->responsive()->hover()->bordered()->open();

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
                $box3->close();

                $solidbox = $ui->box()
                                ->solid()
                                ->uiType('success')
                                ->title('Solid Box')
                                ->open();
                    echo 'Its a solid success box';
                $solidbox->close();

                $bgbox = $ui->box()
                                ->solid()
                                ->background('blue')
                                ->title(' Blue Box')
                                ->open();
                    echo 'Its a solid blue box';
                $bgbox->close();
				
				//image upload
				$upload_img = $ui->upload_image()
								->id('xyzzy')
								->show();
				
            $column2->close();
        $outer_row->close();


/*        echo mis_div_row_open();
        echo mis_div_col_open(6,'md');
        echo mis_form_open('','','','New Form open');
        echo mis_form_password('name','password','','Password');
        echo mis_form_email('name','email','','Email');
        echo mis_form_upload('name','','','Upload File');
        echo mis_form_textarea('name','its text area','','Textarea');
        echo mis_div_row_open();
        echo mis_div_col_open(6);
        echo mis_form_checkbox('name','Yes','','','Checkbox 1');
        echo mis_form_checkbox('name','Yes','','','Checkbox 2');
        echo mis_div_close();
        echo mis_div_col_open(6);
        echo mis_form_radio('name','Yes','','','Radio Button 1');
        echo mis_form_radio('name','Yes','','','Radio Button 2');
        echo mis_div_close();
        echo mis_div_close();
        echo mis_form_dropdown('name',array('1'=>'one','2'=>'two','3'=>'three'),'','','Select');
        echo mis_form_close();
        echo mis_box_open('new box','success');
        echo mis_table_open('bordered');
        echo '<tr><th>frfr</th><th>frfr</th><th>frfr</th></tr>';
        echo '<tr><td>frfr</td><td>frfr</td><td>frfr</td></tr>';
        echo '<tr><td>frfr</td><td>frfr</td><td>frfr</td></tr>';
        echo '<tr><td>frfr</td><td>frfr</td><td>frfr</td></tr>';
        echo mis_table_close();
        echo mis_box_close();
        echo mis_box_open('new box','success');
        echo mis_box_close();
        echo mis_div_close();

        echo mis_div_col_open(6,'md');
        echo mis_form_open('','','','Form open');
        echo mis_form_input('name','value');
        echo mis_form_input('name','value','');
        echo mis_form_input('name','value','','');
        echo mis_form_input('name','value','','label');
        echo mis_form_input('name','value','','label','');
        echo mis_form_input('name','value','','label','success');
        echo mis_form_input('name','value','','label','error');
        echo mis_form_input('name','value','','label','warning');
        echo mis_form_input('name','value','','','success');
        echo mis_form_input('name','value','','','');
        echo mis_form_submit('name','value');
        echo mis_form_close();
        echo mis_div_close();
        echo mis_div_close();
*/    ?>



    </body>
</html>
