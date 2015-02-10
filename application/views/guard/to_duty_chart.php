<div id="print">
<?php
if (count($details_of_guards_at_a_date_A))
	$ans = $details_of_guards_at_a_date_A;
else if (count($details_of_guards_at_a_date_B))
	$ans = $details_of_guards_at_a_date_B;
else if (count($details_of_guards_at_a_date_C))
	$ans = $details_of_guards_at_a_date_C;

foreach($ans as $key => $duty) { 
	$date = date('d M Y',strtotime($duty->date)+19800);
	break;
}
$ui = new UI();
	$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Details of Guards on '.$date.' ( '.$day.' )')
				 ->solid()
				 ->open();
		$boxesRow = $ui->row()
					   ->open();
			
			$aBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
		   
				$aBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift A')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$aCol = $ui->col()
								   ->open();
						  
		    				$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Guard</center></th>
												<th><center>Photo</center></th>
												<th><center>Post</center></th>
											</tr>';
									foreach ($details_of_guards_at_a_date_A as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$row->postname.'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
											
						$aCol->close();
											
					 $guardRow->close();
				$aBox->close();
			$aBoxCol->close();
			
			$bBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();
			   
			   $bBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift B')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$bCol = $ui->col()
								   ->open();
						  
		    				$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Guard</center></th>
												<th><center>Photo</center></th>
												<th><center>Post</center></th>
											</tr>';
									foreach ($details_of_guards_at_a_date_B as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$row->postname.'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
											
						$bCol->close();
											
					 $guardRow->close();
				$bBox->close();
			$bBoxCol->close();
			
            $cBoxCol = $ui->col()
					   ->width(4)
					   ->t_width(8)
					   ->m_width(12)
					   ->open();			
				
				$cBox = $ui->box()
						 ->uiType('info')
						 ->title('Shift C')
						 ->width(4)
						 ->solid()
						 ->open();

					$guardRow = $ui->row()
										->id('guardRow')
										->open();
							
						$cCol = $ui->col()
								   ->open();
						  
		    				$table = $ui->table()->responsive()->hover()->bordered()->striped()->open();

								echo '<tbody>
											<tr>
												<th><center>Guard</center></th>
												<th><center>Photo</center></th>
												<th><center>Post</center></th>
											</tr>';
									foreach ($details_of_guards_at_a_date_C as $row)
									{
										 
														   echo '<tr>
																	<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
																	<td style="height: 60px; 
																				width: 40px;
																				background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
																				background-size: auto 100%;
																				background-position: 50% 50%;
																				background-repeat: no-repeat;
																			" class="print-no-display"></td>
																	<td><center>'.$row->postname.'</center></td>	
																</tr>';
									}
								echo '</tbody>';
							$table->close();
											
						$cCol->close();
											
					 $guardRow->close();
								
				$cBox->close();
			$cBoxCol->close();
		$boxesRow->close();			
			
	$headingBox->close();
   

?>
</div>