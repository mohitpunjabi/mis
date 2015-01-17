<?php
	if($emp_validation_details)
    {
        if($emp_validation_details->profile_pic_status=='pending')
            $this->notification->drawNotification("Pending : Profile Picture","Profile picture is not yet validated.");
        else if($emp_validation_details->profile_pic_status=='rejected')
        {
            $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 0));
            $this->notification->drawNotification("Rejected : Profile Picture","Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""),"error");
        }
    }
    echo '<center><img src="'.base_url().'assets/images/employee/'.$user_details->id.'/'.$user_details->photopath.'" width="145" height="150" /></center>';
?>