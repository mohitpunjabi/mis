<section class="content invoice">
		<div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> Semester Registration Form</h2>
        	</div>
        </div>
        <div class="row invoice-info">
        	<div class="col-sm-3 invoice-col" style="background:#F4F4F4;"><strong>Name of student</strong></div>
            <div class="col-sm-9 invoice-col"><span style="text-transform:capitalize;"><?php echo $student[0]->salutation." ".$student[0]->first_name." ".$student[0]->middle_name." ".$student[0]->last_name; ?></span> / <?php echo $student[0]->name_in_hindi; ?></div>
            <div class="col-sm-3 invoice-col" style="background:#F4F4F4;"><strong>Admission No.</strong></div>
            <div class="col-sm-3 invoice-col"><?php echo $student[0]->admn_no; ?></div>
            <div class="col-sm-3 invoice-col" style="background:#F4F4F4;"><strong>Name of Course / Branch.</strong></div>
            <div class="col-sm-3 invoice-col"><?php echo  $this->sbasic_model->getCourseById($student[0]->course_id)->name; ?> / <?php echo $this->sbasic_model->getBranchById($student[0]->branch_id)->name; ?></div>
            <div class="col-sm-3 invoice-col" style="background:#F4F4F4;"><strong>Registering Semester / Session.</strong></div>
            <div class="col-sm-3 invoice-col"><?php echo $student[0]->semester+1; ?></div>
             <div class="col-sm-3 invoice-col" style="background:#F4F4F4;"><strong>Form Date:</strong></div>
            <div class="col-sm-3 invoice-col"><?php echo $student[0]->timestamp; ?></div>
        </div>
        
        <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> GPA &amp; Result all previous Year</h2>
        	</div>
        </div>
         <div class="row">
         	<div class="col-xs-12">
             <?php 
				for($p=1; $p<=(int)$student[0]->semester; $p++){
						$q=$this->get_results->getGPAperSemester($student[0]->admn_no,$p);
						echo "<div class='col-sm-1'><a href='#'>$p. ".$q."</a></div>";	
				}
				?>
            </div>
         </div>
         <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> Subject Registered for Current Semester </h2>
        	</div>
        </div>
          <div class="row">
          <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
          <thead>
              <th>Sl N.</th>
              <th>SUbject Code</th>
              <th>SUbject Name</th>
          </thead>
          <tbody>
          	  <?php
			  	print_r($subjects);
				$i=0;
			   foreach($subjects as $subject) {
				  	
				   ?>
              <tr>
                <td><?php echo $subject[0][$i]['sequence']; ?></td>
                <td><?php echo $subject[0][$i]['subject_id']; ?></td>
                <td><?php echo $subject[0][$i]['name'];  $i++;?></td>
              </tr>
    	  <?php } foreach($confirm['ele'] as $s) { ?>
      <tr>
        <td><?php echo $s['sub_seq']; ?></td>
        <td><?php echo $s['sub_seq']; ?></td>
        <td><?php echo $s['name']; ?></td>
      </tr>
      <?php } ?>
          </tbody>
          </table>
          </div>
          </div>
        <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> Details of Fee Deposite. </h2>
        	</div>
        </div>
        <div class="row invoice-info">
        <div class="col-sm-6">
        	<div class="col-sm-6 invoice-col" style="background:#F4F4F4;"><strong>Date of Payment</strong></div>
            <div class="col-sm-6 invoice-col"><?php echo $student[0]->fee_date; ?></div>
             <div class="col-sm-6 invoice-col" style="background:#F4F4F4;"><strong>Amount Paid</strong></div>
            <div class="col-sm-6 invoice-col"><?php echo $student[0]->fee_amt; ?></div>
             <div class="col-sm-6 invoice-col" style="background:#F4F4F4;"><strong>Tras. ID / Ref. ID</strong></div>
            <div class="col-sm-6 invoice-col"><?php echo $student[0]->transaction_id; ?></div>
           </div>
          <div class="col-sm-6">
          <div class="col-sm-6 invoice-col"><img src="<?php echo base_url()."assets/sem_slip/".$student[0]->recipt_path; ?>" alt="" width="200" /> <img src="<?php echo base_url().$student[0]->photopath ?>" alt="<?php echo $student[0]->salutation." ".$student[0]->first_name." ".$student[0]->middle_name." ".$student[0]->last_name; ?>" width="200" /></div>
          </div>
         </div>
         <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> form status </h2>
        	</div>
        </div>
        <div class="row">
        <div class="col-sm-3" style="background:#F4F4F4;"><strong>Department Status:</strong></div>
        <div class="col-sm-3" ><?php echo ($student[0]->hod_status == 0 ? '<span class="label label-warning">Pending</span>' :($student[0]->hod_status == 2 ? '<span class="label label-danger">Rejected</span>' :'<span class="label label-success">Approved</span>')); ?></div>
        <div class="col-sm-3" style="background:#F4F4F4;"><strong>Acdmic Status:</strong></div>
        <div class="col-sm-3" >
		<?php echo ($student[0]->acdmic_status == 0 ? '<span class="label label-warning">Pending</span>' :($student[0]->acdmic_status == 2 ? '<span class="label label-danger">Rejected</span>' :'<span class="label label-success">Approved</span>')); ?></div>
        </div>
        <div class="row">
			<div class="col-xs-12">
				<h2 class="page-header"><i class="fa fa-user"></i> Set Department Side Status </h2>
        	</div>
        </div>
        <div class="row">
          <?php 
		if($student[0]->hod_status ==0){
			
		echo form_open_multipart('student_sem_form/regular_check/updatehod'); ?>
      	 <div class="col-sm-6" style="background:#F4F4F4;">Approve:
               <div class="btn-group" data-toggle="buttons-radio">
           <button type="button" id='ap'  class="btn btn-primary">Approve</button>
           <button type="button" id='rej' class="btn btn-warning">Reject</button>
           <input type='hidden' id="rf" name="hods" value='0'>
        </div>
        <?php echo form_textarea(array('name'=>'hodRemark','id'=>'re','style'=>"height:60px; width:200px;",'value'=>"")); ?>
         </div>
        
        		
                <div class="col-sm-6" >
               		 <?php
						echo form_hidden('formId',$student[0]->sem_form_id);
						echo form_hidden('stuId',$student[0]->admn_no);
						echo form_submit('submit','Submit','class="btn btn-primary" '); ?>
                </div>
               <?php echo form_close(); ?>
        <?php } else {?>
        <div class="col-sm-12" >
        The From was <?php echo ($student[0]->hod_status == 0 ? '<span class="label label-warning">Pending</span>' :($student[0]->hod_status == 2 ? '<span class="label label-danger">Rejected</span>' :'<span class="label label-success">Approved</span>')); ?> From Department side Since <?php echo date('d M Y / H:i',strtotime($student[0]->hod_time)) ?>
        </div>
        <?php } ?>	
       </div>
      

	
</scetion>
<?php //print_r($student) ?>


<script type="text/javascript">
	$(function(){
		$('#re').hide();
		$('#ap').click(function(){
				$('#rf').val('1');
				$('#re').hide();
			});
			$('#rej').click(function(){
				$('#rf').val('2');
				$('#re').show();
			});
		 
		
		});
 		 window.onunload = refreshParent;
        function refreshParent() {
           // window.opener.location.reload();
		//	self.close();
        }
</script>
<?php //print_r($student) ?>