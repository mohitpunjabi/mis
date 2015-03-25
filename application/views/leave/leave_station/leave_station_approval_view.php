<?php
/**
 * Created by PhpStorm.
 * User: nishant
 * Date: 25/3/15
 * Time: 8:16 PM
 */

$ui = new UI();
$test_row = $ui->row()->classes('modal fade')->id('approve_dialog_fade')->open();
$test_col = $ui->col()->classes('modal-dialog')->id('approve_dialog_dialog')->open();
$test_box = $ui->box()->classes('modal-content')->id('approve_dialog_content')->open();
?>
<div class="modal-header">
    <h1>Leave Approval/Forward/Cancel</h1>
</div>
<div class="modal-body">
    <?php
    $ui->alert()->title('Leave Has Been Approved')->uiType('success')->show();
    ?>
</div>
<div class="modal-footer">
    <a href="<?php echo site_url("leave/leave_station/pendingStationLeaveStatus"); ?>">
        <?php
        $ui->button()->width(4)->id('dialog_approve')->name('dialog_approve')->uiType('success')->value('Close')->show();
        ?>
    </a>
</div>
<?php
$test_box->close();
$test_col->close();
$test_row->close();

$test_row1 = $ui->row()->classes('modal fade')->id('forward_dialog_fade')->open();
$test_col1 = $ui->col()->classes('modal-dialog')->id('forward_dialog_dialog')->open();
$test_box1 = $ui->box()->classes('modal-content')->id('forward_dialog_content')->open();
?>
<div class="modal-header">
    <h1>Leave Approval/Forward/Cancel</h1>
</div>
<div class="modal-body">
    <?php
    $ui->alert()->title('Leave Has Been Forwarded to selected Employee')->uiType('success')->show();
    ?>
</div>
<div class="modal-footer">
    <a href="<?php echo site_url("leave/leave_station/pendingStationLeaveStatus"); ?>">
        <?php
        $ui->button()->width(4)->id('dialog_approve')->name('dialog_approve')->uiType('success')->value('Close')->show();
        ?>
    </a>
</div>
<?php
$test_box1->close();
$test_col1->close();
$test_row1->close();

$test_row2 = $ui->row()->classes('modal fade')->id('cancel_dialog_fade')->open();
$test_col2 = $ui->col()->classes('modal-dialog')->id('cancel_dialog_dialog')->open();
$test_box2 = $ui->box()->classes('modal-content')->id('cancel_dialog_content')->open();
?>
<div class="modal-header">
    <h1>Leave Approval/Forward/Cancel</h1>
</div>
<div class="modal-body">
    <?php
    $ui->alert()->title('Leave Has Been Canceled')->uiType('success')->show();
    ?>
</div>
<div class="modal-footer">
    <a href="<?php echo site_url("leave/leave_station/pendingStationLeaveStatus"); ?>">
        <?php
        $ui->button()->width(4)->id('dialog_approve')->name('dialog_approve')->uiType('success')->value('Close')->show();
        ?>
    </a>
</div>
<?php
$test_box2->close();
$test_col2->close();
$test_row2->close();


$row = $ui->row()->open();
$row1 = $ui->row()->open();
$margin = $ui->col()->width(1)->open();
$margin->close();
$column_left = $ui->col()->width(10)->open();
$box = $ui->box()->title('Leave Approval Page')->uiType('primary')->solid()->open();
echo '<center><img src="' . base_url() . 'assets/images/employee/' . $img_path . '"  height="150" /></center><br>';

$table = $ui->table()->hover()->bordered()->open();
$name = $this->employee_model->getNameById($emp->id);
$department = $this->departments_model->getDepartmentById($emp->dept_id)->name;
$designation = $this->designations_model->getDesignationById($emp->designation)->name;

?>
<tr>
    <th>Name</th>
    <td><?php echo $name; ?></td>
    <th>Gender</th>
    <td><?php echo ucwords($emp->sex); ?></td>
</tr>
<tr>
    <th>Date of Birth</th>
    <td><?php echo date('d M Y', strtotime($emp->dob)); ?></td>
    <th>Department</th>
    <td><?php echo $department; ?></td>
</tr>
<tr>
    <th>Designation</th>
    <td><?php echo $designation; ?></td>
    <th>Email</th>
    <td><?php echo $emp->email; ?></td>
</tr>
<tr>
    <th>Date of Joining</th>
    <td><?php echo date('d M Y', strtotime($emp->joining_date)); ?></td>
    <th>Mobile No.</th>
    <td><?php echo $emp->mobile_no; ?></td>
</tr>

<?php

$table->close();
$box->close();
$column_left->close();

$row1->close();
$leave_row = $ui->row()->open();
$margin1 = $ui->col()->width(1)->open();
$margin1->close();
$col_leave = $ui->col()->width(10)->open();
$box1 = $ui->box()->title('Leave Details')->uiType('primary')->solid()->open();
$table1 = $ui->table()->hover()->bordered()->id('lv_table_data')->open();
$applying_date = $leave_details['applying_date'];
$leaving_date = $leave_details['leaving_date'];
$leaving_time = $leave_details['leaving_time'];
$arrival_date = $leave_details['arrival_date'];
$arrival_time = $leave_details['arrival_time'];
$purpose = $leave_details['purpose'];
$addr = $leave_details['addr'];
$emp_id = $leave_details['emp_id'];
?>
<tr>
    <th>Employee ID</th>
    <td><?php echo $emp_id; ?></td>
    <th>Applying Date</th>
    <td><?php echo $applying_date; ?></td>
</tr>
<tr>
    <th>Station Leaving Date</th>
    <td><?php echo $leaving_date; ?></td>
    <th>Station Leaving Time</th>
    <td><?php echo $leaving_time; ?></td>
</tr>
<tr>
    <th>Station Arriving Date</th>
    <td><?php echo $arrival_date; ?></td>
    <th>Station Arriving Time</th>
    <td><?php echo $arrival_time; ?></td>
</tr>
<tr>
    <th>Purpose</th>
    <td><?php echo $purpose; ?></td>
    <th>Address during Leave</th>
    <td><?php echo $addr; ?></td>
</tr>
<?php
$table1->close();
$box1->close();
$button_row = $ui->row()->id('button_row')->open();
$col1 = $ui->col()->width(4)->open();
?>
<center>
    <?php
    $ui->button()
        ->uiType('success')
        ->name('approve_button')
        ->id('approve_button')
        ->value('APPROVE')
        ->extras('onclick="incrementIndex()"')
        ->show();
    ?>
</center>
<?php
$col1->close();
$col2 = $ui->col()->width(4)->open();
?>
<center>
    <?php
    $ui->button()
        ->uiType('primary')
        ->name('forward_button')
        ->id('forward_button')
        ->extras('onclick="incrementIndex()"')
        ->value('FORWARD')
        ->show();
    ?>
</center>
<?php
$col2->close();
$col3 = $ui->col()->width(4)->open();
?>
<center>
    <?php
    $ui->button()
        ->uiType('danger')
        ->name('cancel_button')
        ->id('cancel_button')
        ->extras('onclick="incrementIndex()"')
        ->value('CANCEL')
        ->show();
    ?>
</center>
<?php
$col3->close();
$button_row->close();
$col_leave->close();
$leave_row->close();
$row2 = $ui->row()->open();
$margin2 = $ui->col()->width(1)->open();
$margin2->close();
$col_next_emp = $ui->col()->width(10)->open();
$box3 = $ui->box()
    ->title('Please Select Approving Employee')
    ->solid()
    ->id('approving_emp')
    ->uiType('primary')
    ->open();
$inputRow4 = $ui->row()->open();
$ui->select()
    ->label('Department Type')
    ->name('type')
    ->id('type')
    ->required()
    ->options(array($ui->option()->value('""')->text('Select')->selected(),
        $ui->option()->value('academic')->text('Academic'),
        $ui->option()->value('nonacademic')->text('Non Academic')))
    ->width(6)
    ->show();
$ui->select()
    ->label('Select Department')
    ->name('department_name')
    ->id('department_name')
    ->required()
    ->options(array($ui->option()->value('""')->text('Select')))
    ->width(6)
    ->show();
$inputRow4->close();

$inputRow5 = $ui->row()->open();
$ui->select()
    ->label('Designation')
    ->name('designation')
    ->id('designation')
    ->required()
    ->options(array($ui->option()->value('""')->text('Select')))
    ->width(6)
    ->show();
$ui->select()
    ->label('Employee Name')
    ->name('emp_name')
    ->id('emp_name')
    ->required()
    ->options(array($ui->option()->value('""')->text('Select')->selected()))
    ->width(6)
    ->show();
$inputRow5->close();
$inputRow6 = $ui->row()->open();
?>
<center>
    <?php
    $ui->button()->uiType('primary')
        ->name('forward_submit')
        ->id('forward_submit')
        ->width(4)
        ->value('SUBMIT')
        ->show();
    ?>
</center>
<?php
$inputRow6->close();
$box3->close();
$col_next_emp->close();
$row2->close();
$row->close();
?>
<script charset="utf-8">
    var leave_id = '<?php echo $leave_id;?>';
    var next_emp = '<?php echo $next_emp;?>';
    var approve = '<?php echo Leave_constants::$APPROVED ;?>';
    var cancel = '<?php echo Leave_constants::$CANCELED ;?>';
    var pending = '<?php echo Leave_constants::$PENDING ;?>';
    var forward = '<?php echo Leave_constants::$FORWARDED  ;?>';
    var loc = '<?php echo site_url("leave/leave_station/pendingStationLeaveStatus");?>';
    var index = 0;
    $("#approve_button").on('click', function () {
        if (index === 1) {
            var ins = insertLeaveStatus(leave_id, next_emp, next_emp, approve);
            $("#approve_dialog_fade").modal('show');
        }
        else
            window.location = loc;
    });
    $("#forward_button").on('click', function () {
        if (index === 1) {
            $('#approving_emp').show();
            $('#button_row').hide();
        }
        else
            window.location = loc;
    });
    $("#forward_submit").on('click', function () {
        if (index === 1) {
            insertLeaveStatus(leave_id, next_emp, $('#emp_name').val(), forward);
            $("#forward_dialog_fade").modal('show');
        }
        else
            window.location = loc;
    });
    $('#cancel_button').on('click', function () {
        if (index === 1) {
            insertLeaveStatus(leave_id, next_emp, next_emp, cancel);
            $("#cancel_dialog_fade").modal('show');
        }
        else
            window.location = loc;
    });
    function incrementIndex() {
        index = index + 1;
    }

    function insertLeaveStatus(leave_id, current_emp, next_emp, status) {
        $.ajax({
            url: site_url("leave/leave_station/insert_station_leave_status/" + leave_id + "/" + current_emp + "/" + next_emp + "/" + status),
            success: function (result) {
                $('#').html(result);
            }
        });
    }
    $(window).load(function () {
        $('#approving_emp').hide();
        $('#approve_dialog_fade').hide();
        $('#forward_dialog_fade').hide();
        $('#cancel_dialog_fade').hide();
    });
    //$("#date")
</script>