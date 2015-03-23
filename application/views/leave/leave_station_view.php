<?php

/* 
 * Author :- Nishant Raj
 */
$ui = new UI();

if (isset($is_notification_on)) {
    // if notifications are on
    if ($is_notification_on == TRUE) {

        // if leave application has some errors show them
        if (isset($errors)) {
            $ui->alert()
                    ->uiType('danger')
                    ->desc($error)
                    ->show();
        }

        // if successful leave application
        else if (isset($success_msg)) {
       //     $this->notification->drawNotification('', $success_msg, 'success');
             $ui->alert()
                    ->uiType('success')
                    ->desc($success_msg)
                    ->show();
            
        }
    }
}
$row = $ui->row()->open();
$margin = $ui->col()->width(2)->open();
$margin->close();

$column = $ui->col()->width(8)->open();

$box = $ui->box()
        ->title('Station Leave Details')
        ->solid()
        ->uiType('primary')
        ->open();
$form = $ui->form()->action('leave/leave_station')->open();
$inputRow1 = $ui->row()->open();
$ui->datePicker()
        ->required()
        ->label('Proposed Date Of Leaving Station ')
        ->name('leave_st_date')
        ->placeholder("Enter the date")
        ->dateFormat('dd-mm-yyyy')
        ->value("")
        ->width(6)
        ->show();
$ui->datePicker()
        ->required()
        ->label('Proposed Date Of Reurning Station')
        ->name('return_st_date')
        ->placeholder("Enter the date")
        ->dateFormat('dd-mm-yyyy')
        ->width(6)
        ->value("")
        ->show();
$inputRow1->close();

$inputRow2 = $ui->row()
        ->open();
$ui->datePicker()
        ->required()
        ->label('Proposed time Of Leaving Station ')
        ->name('leave_st_time')
        ->placeholder("Enter the time")
        ->dateFormat('dd-mm-yyyy')
        ->value("")
        ->width(6)
        ->show();
$ui->datePicker()
        ->required()
        ->label('Proposed time Of Reurning Station')
        ->name('return_st_time')
        ->placeholder("Enter the time")
        ->dateFormat('dd-mm-yyyy')
        ->width(6)
        ->value("")
        ->show();
$inputRow2->close();

$inputRow3 = $ui->row()
        ->open();
$ui->textarea()
        ->required()
        ->placeholder('Purpose Of Leaving station')
        ->type('text')
        ->value("")
        ->label('Purpose Of Leaving station')
        ->name('purpose')
        ->width(6)
        ->show();
$ui->textarea()
        ->required()
        ->placeholder(' Address During Absence From Station')
        ->type('text')
        ->value("")
        ->label('Address During Absence From Station')
        ->name('address')
        ->width(6)
        ->show();
$inputRow3->close();

$ui->button()
        ->value('Submit Station Leave request')
        ->name('submit')
        ->submit(true)
        ->uiType('primary')
        ->show();

$form->close();
$box->close();
$column->close();
$row->close();
