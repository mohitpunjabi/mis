<?php
/**
 * Created by PhpStorm.
 * User: nishant
 * Date: 28/3/15
 * Time: 7:22 PM
 */
$ui = new UI();
$test_row = $ui->row()->classes('modal fade')->id('approve_dialog_fade')->open();
$test_col = $ui->col()->classes('modal-dialog')->id('approve_dialog_dialog')->open();
$test_box = $ui->box()->classes('modal-content')->id('approve_dialog_content')->open();
?>
<div class="modal-header">
</div>
<div class="modal-body">
    <?php
    $ui->alert()->title('<h2>Sorry This Function is under development . Please Check Later</h2>')->uiType('danger')->id('first_alert_leave')->show();
    ?>
</div>
<div class="modal-footer">
    <a href="<?php echo site_url("leave/leave_station/adminLeaveHistory"); ?>">
        <?php
        $ui->button()->width(4)->id('dialog_approve')->name('dialog_approve')->uiType('success')->value('Close')->show();
        ?>
    </a>
</div>
<?php
$test_box->close();
$test_col->close();
$test_row->close();
$row = $ui->row()->open();

$margin_col = $ui->col()->width(2)->open();
$margin_col->close();

$col = $ui->col()->width(8)->open();
$input_row = $ui->row()->id('admin_input_row')->open();
$ui->select()->width(6)->id('designation')
    ->options(array($ui->option()->value('""')->text('Select Employee Name')->selected()))->show();
$ui->select()->width(6)->id('emp_id_dept')
    ->options(array($ui->option()->value('""')->text('Select Employee Name')->selected()))->show();
$input_row->close();
$col->close();
$row->close();
$super_row = $ui->row()->open();
$margin = $ui->col()->width(1)->open();
$margin->close();
$table_col = $ui->col()->width(10)->open();
$table_row = $ui->row()->id('leave_table_row')->open();
$table_row->close();
$table_col->close();
$super_row->close();
?>
<script charset="utf-8">
    $(document).ready(function () {
        var dept = '<?php echo $dept ;?>';
        $.ajax({
            url: site_url("leave/leave_ajax/get_designation/" + dept),
            success: function (result) {
                $('#designation').html(result);
            }
        });
        $.ajax({
            url: site_url("leave/leave_ajax/get_all_station_leave_by_emp"),
            success: function (result) {
                $('#leave_table_row').html(result);
            }
        });
        $('#designation').on('change', function () {
            $.ajax({
                url: site_url("leave/leave_ajax/get_emp_name/" + $(this).val() + "/" + dept),
                success: function (result) {
                    $('#emp_id_dept').html(result);
                }
            });
        });
        $('#emp_id_dept').on('change', function () {
            $("#approve_dialog_fade").modal('show');
        });
    })
</script>