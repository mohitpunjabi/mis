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
													
						$tryRow = $ui->row()->open();
							$uCol = $ui->col()->width(4)->open();
								$ui->input()
									->placeholder('input text')
									->label('Enter the username')
									->uiType('warning')
									->id('input_ele')
									->name('name')
									->show();
							$uCol->close();

							$uCol = $ui->col()->width(6)->open();
								$ui->input()
									->placeholder('input text')
									->label('Enter the username')
									->uiType('danger')
									->id('input_ele')
									->name('name')
									->show();
							$uCol->close();

							$uCol = $ui->col()->width(2)->open();
								$ui->input()
									->placeholder('input text')
									->label('name')
									->uiType('success')
									->id('input_ele')
									->name('name')
									->show();
							$uCol->close();

						$tryRow->close();

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
		
		$newRow = $ui->row()->open();
			echo "Text";
		$newRow->close();