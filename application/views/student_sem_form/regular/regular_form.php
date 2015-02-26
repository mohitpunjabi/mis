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
	 <?php if(($this->session->userdata('semester')+1) > 2){ ?>
		 <h2 class="page-header">Do you have Any Carry Over <input type="checkbox" name="cenable" /></h2>
         <div class="col-sm-12" id="cyes">
         <label> Select Semester Where you Have Carryover</label>
         	<div class="row">
            
         	<?php
					if(($this->session->userdata('semester')+1) % 2 == 1){
						$i = 1;
						}else{
							$i=2;
						}
					
			 for($i; $i<($this->session->userdata('semester')+1); $i++){ ?>
            	<div class="col-sm-1">
                	<label for="semester".<?=$i ?>><?=$i ?></label>&nbsp;
                    <input type="checkbox" name="sem[<?=$i ?>]" class="rs" value="<?=$i ?>" />
                </div>	
			<?php $i++;} ?>
            </div>
            <div id="cresult">
            </div>
         
         <br />

	<h2 class="page-header">Details of Fee Deposite for Carryover through Internet Banking</h2>
	
		 <table class="table table-bordered">
		<tr>
		<td >Date of Payment </th>
		<td><?php echo form_input(array('name'=>'cdateofPayment','id'=>'cdateofPayment','value'=>$this->input->post('cdateofPayment'),'placeholder'=>'Enter Date','class'=>'form-control', 'data-date-format'=>'d M yyyy',)) ?></td>
	</tr>
		<tr>
		<td>Amount Paid</th>
		<td><?php echo form_input(array('name'=>'camount','id'=>'camount','value'=>$this->input->post('camount'),'placeholder'=>'Amount','class'=>'form-control',)) ?></td>
	</tr>
		<tr>
		<td>Transaction id / Reference No. </th>
		<td><?php echo form_input(array('name'=>'ctransId','id'=>'ctransId','value'=>$this->input->post('ctransId'),'placeholder'=>'Transaction Id','class'=>'form-control',)) ?></td>
	</tr>
		<tr>
		<td>Pay Slip Upload </td>
		<td><?php echo form_upload(array('name'=>'cslip','id'=>'cslip',)) ?></td>
		
    </tr>
  	</table>
    </div>
    <?php } ?> 
 
<div style="clear:both;"></div>
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
	$('#cyes').hide();
$( "#dateofPayment,#cdateofPayment" ).datepicker({
	endDate: '+0d',
     autoclose: true
	});
	$('.rs').on('ifChecked', function(event){
		
				for(i=1; i<=$('.rs').length; i++){
				if($('input[name="sem['+i+']"]:checked').val()){
							//alert($('input[name="sem['+i+']"]:checked').val());
							$('#cresult').html("<i class='icon-spinner icon-spin icon-large'></i>");
							$.ajax({
									url: '<?=base_url()?>index.php/student_sem_form/regular_form/getAsub/'+$('input[name="sem['+i+']"]:checked').val()+'/<?=$this->session->userdata('id'); ?>/<?=$this->session->userdata('dept_id'); ?>/<?=$this->session->userdata('course_id'); ?>/<?=$this->session->userdata('branch_id'); ?>',
									type: "GET",
									
								}).done(function(data) {
										$('#cresult').append(data);
									});
					}
				}
	
	});
	$('.rs').on('ifUnchecked',function(event){
			for(i=1; i<=$('.rs').length; i++){
				if($('input[name="sem['+i+']"]:checked').val()){
					
					}else{
						$('#cesub-'+i).remove();
						}
			}
		});
	$('input[name="cenable"]').on('ifChecked',function(){
			$('#cyes').show('slow');
		});
		$('input[name="cenable"]').on('ifUnchecked',function(){
			$('#cyes').hide('slow');
		});
		
});
</script>
