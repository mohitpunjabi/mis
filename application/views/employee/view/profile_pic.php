<?php $ui = new UI();
    $row = $ui->row()->open();
        $col = $ui->col()->width(12)->open();
            $box = $ui->box()->title('Profile Picture')->solid();
                if($emp_validation_details)
                {
                    if($emp_validation_details->profile_pic_status=='pending')
                    {
                        $box->uiType('warning')->open();
                        $ui->alert()
                            ->uiType('warning')
                            ->title('Pending')
                        ->desc('Profile picture is not yet validated.')
                        ->show();
                    }
                    else if($emp_validation_details->profile_pic_status=='rejected')
                    {
                        $box->uiType('danger')->open();
                        $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 0));
                        $ui->callout()
                            ->uiType('danger')
                            ->title('Rejected')
                            ->desc("Please contact the Establishment Section for the same.".(($reject)? "<br><b>Reason behind rejection :</b> ".$reject->reason : ""))
                            ->show();
                    }
                    else
                        $box->uiType('primary')->open();
                }
                else
                    $box->uiType('primary')->open();
                echo '<center><img src="'.base_url().'assets/images/'.$emp->photopath.'"  height="150" /></center>';
            $box->close();
        $col->close();
    $row->close();
?>