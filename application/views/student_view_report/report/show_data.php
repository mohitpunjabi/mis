
	<?php
if(isset($show_details) && is_array($show_details))
{
	
$ui = new UI();
$stuRow = $ui->row()->open();
			$col1 = $ui->col()->width(12)->open();
				$box = $ui->box()
						->title('Report')
						->solid()	
						->uiType('primary')
						->open();
                    
					// Table First Row start
					$stuRow1 = $ui->row()->open();
					$col2 = $ui->col()->width(12)->open();
					//$table = $ui->table()->responsive()->hover()->bordered()->id('state')->open();
					
					
					?>
					<table class="table table-bordered" id="state_repo">
								<thead>
								<tr>
									<th>Admission No</th>
									<th>Name</th>
									<th>Mobile No.</th>
									<th>Email-ID</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $i=1; foreach($show_details as $b){ 
								 if($b->middle_name="Na")
								 {
									 $mname=" ";
								 }
								 else
								 {
									 $mname=$b->middle_name;
								 }
								?>
								<tr>
									<td><?php echo $b->admn_no; ?></td>
									<td><?=($b->first_name ." ". $mname." ". $b->last_name) ?></td>
									<td><?php echo $b->mobile_no; ?></td>
									<td><?php echo $b->email; ?></td>
									<td><span onclick="my_fun_gen('<?php echo $b->admn_no; ?>')">View Profile</span></td>
								</tr>
								<?php $i++; } ?>
												
					</tbody>
					</table>
					<?php  //$table->close();
				
						$col2->close();
						$stuRow1->close();
					// Table first row end	
					
					$box->close();
									
			$col1->close();
$stuRow->close();




}
else
{
echo "No Record Found";
}

?>
<link href="<?php echo base_url(); ?>assets/core/adminLTE/css/datatables/dataTables.bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/core/adminLTE/js/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/core/adminLTE/js/plugins/datatables/dataTables.bootstrap.js"></script>
<script>
$(function(){
	
	$('#state_repo').dataTable();
})
function my_fun_gen(id)
{
	
	window.open("<?Php echo base_url(); ?>index.php/student_view_report/reports/viewtest/"+id,"_blank","toolbar=no, scrollbar=yes, width=800 height=600, top=50, left=100" );
	
}
</script>