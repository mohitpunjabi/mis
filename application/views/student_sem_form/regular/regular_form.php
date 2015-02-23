<div class="row">
<div class="col-sm-12">
<?php echo form_open_multipart('student_sem_form/regular_form'); ?>

	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
<?php echo validation_errors(); ?>
</div>
	<?php } ?>
	
		<div class="box box-solid box-primary">
<div class="box-header"> 
		<h3 class="box-title">Semester Registration For <b>REGULAR</b> Student</h3>
		</div>
<div class="box-body">
			
 		<table class="table table-bordered">
<tr>
<td width="224"><strong>Semester Registering for :</strong></td>
<td width="254"> <strong><?php echo $this->session->userdata('semester')+1; ?></strong></td>
<th width="72">Session:</th>
<td width="232"><strong> <?php
$d = date('Y');
$d1 = $d+1;
 echo $d."-".$d1." ";
 echo(($this->session->userdata('semester')+1)%2 == 0)?'Winter':'Monsoon'; ?></strong></td>
</tr>
</table>
				
<h2 class="page-header">Choose Elective Subject</h2>
		
		
<?php if(!empty($subjects)){ ?>
		 <table class="table table-bordered">
		
		<?php //print_r($subjects);
					function get_numeric($val) {
						if (is_numeric($val)) {
							return $val + 0;
						}
						return 0;
					}
		
				//print_r($subjects);
				$k=0; $count = 0;
				for($j=0; $j<count($subjects); $j++){

					if($j==0){
						$d ='<tr><th > Elective '.(int)$subjects[$j]['sequence'].form_hidden('elvs'.$j, (int)$subjects[$j]['sequence']).'</th><td><select name="ele'.(int)get_numeric($subjects[$j]['sequence']).'" class="form-control"><option value="'.$subjects[$j]['id'].'">'.$subjects[$j]['subject_id'].' '.$subjects[$j]['name'].'</option>';
						$count++;
						$subjectss=(int)get_numeric($subjects[$j]['sequence']);
					}else if(((int)get_numeric($subjects[$j-1]['sequence'])) == ((int)get_numeric($subjects[$j]['sequence']))) {
						$d .='<option value="'.$subjects[$j]['id'].'">'.$subjects[$j]['subject_id'].' '.$subjects[$j]['name'].'</option>';
					}else{
						$d.='</select></td></tr><tr><th > Elective '.(int)$subjects[$j]['sequence'].form_hidden('elvs'.$j, (int)$subjects[$j]['sequence']).'</th><td><select name="ele'.(int)get_numeric($subjects[$j]['sequence']).'" class="form-control"><option value="'.$subjects[$j]['id'].'">'.$subjects[$j]['subject_id'].' '.$subjects[$j]['name'].'</option>';
						$count++;
					}if($j+1 == count($subjects)){
						$d.='</select></td></tr>';
						echo $d;
						echo form_hidden('scount',$count);
					}
				}

				?>
		</table>
		 
<?php } ?>
		
	<h2 class="page-header">Details of Fee Deposite through Internet Banking</h2>
	
		 <table class="table table-bordered">
		<tr>
		<td >Date of Payment </th>
		<td><?php echo form_input(array('name'=>'dateofPayment','id'=>'dateofPayment','value'=>$this->input->post('dateofPayment'),'placeholder'=>'Enter Date','class'=>'form-control', 'data-date-format'=>'d M yyyy',)) ?></td>
	</tr>
		<tr>
		<td>Amount Paid</th>
		<td><?php echo form_input(array('name'=>'amount','id'=>'amount','value'=>$this->input->post('amount'),'placeholder'=>'Amount','class'=>'form-control',)) ?></td>
	</tr>
		<tr>
		<td>Transaction id / Reference No. </th>
		<td><?php echo form_input(array('name'=>'transId','id'=>'transId','value'=>$this->input->post('transId'),'placeholder'=>'Transaction Id','class'=>'form-control',)) ?></td>
	</tr>
		<tr>
		<td>Pay Slip Upload </td>
		<td><?php echo form_upload(array('name'=>'slip','id'=>'slip',)) ?></td>
		
    </tr>
    <?php if($dates[0]->type == 2){  ?>
   		 <tr>
    	<td>Late Fee Slip Upload </td>
        <td><?php echo form_upload(array('name'=>'slip1','id'=>'slip1',)); ?></td>
       
        </tr>
         <?php }?>
	</table>
		 
		 <div class="box-footer">
		 <?php
		 	echo form_hidden('flg',$flg);
		  echo form_submit('submit','Next >>','class="btn btn-primary"'); ?>
	 </div>
 
</div>
 </div>
</div>
<?php echo form_close(); ?>
 <script>
$(function() {
$( "#dateofPayment" ).datepicker({
	endDate: '+0d',
     autoclose: true
	});
});
</script>