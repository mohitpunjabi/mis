<?php
/**
 * Created by PhpStorm.
 * User: nishant
 * Date: 29/3/15
 * Time: 1:17 AM
 */
$ui1 = new UI();
$tabBox1 = $ui1->tabBox()
    ->title('Station Leave')
    ->tab("approved_station_leave", "Approved Leave", true)
    ->tab("rejected_station_leave", "Rejected Leave", false)
    ->tab("forwarded_station_leave", "Forwarded Leave", false)
    ->open();
$tab1 = $ui1->tabPane()->id("approved_station_leave")->active()->open();
$approve_table = $ui1->table()->hover()->bordered()->sortable()->searchable()->paginated()->open();
?>
    <thead>
    <tr>
        <th>
            <center>Number</center>
        </th>
        <th>
            <center>Name</center>
        </th>
        <th>
            <center>Applying Date</center>
        </th>
        <th>
            <center>Station Leaving Date</center>
        </th>
        <th>
            <center>Station Leaving Time</center>
        </th>
        <th>
            <center>Station Returning Date</center>
        </th>
        <th>
            <center>Station Returning Time</center>
        </th>
        <th>
            <center>Period</center>
        </th>
        <th>
            <center>Purpose</center>
        </th>
        <th>
            <center>Address During Absence</center>
        </th>
    </tr>
    </thead>
<?php

$i = 0;
if ($approved['leave_details'] != NULL)
//    var_dump($approved['leave_details']);
    foreach ($approved['leave_details'] as $row) {

        $st_applying_date = $row['applying_date'];
        $st_lv_date = $row['leaving_date'];
        $st_lv_time = $row['leaving_time'];
        $st_rt_date = $row['arrival_date'];
        $st_rt_time = $row['arrival_time'];
        $period = $row['period'];
        $purpose = $row['purpose'];
        $addr = $row['addr'];
        $name = $row['name'];
        $i++;
        echo "<tr><td><center>$i</center></td>"
            . "<td><center>$name</center></td>"
            . "<td><center>$st_applying_date</center></td>"
            . "<td><center>$st_lv_date</center></td>"
            . "<td><center>$st_lv_time</center></td>"
            . "<td><center>$st_rt_date</center></td>"
            . "<td><center>$st_rt_time</center></td>"
            . "<td><center>$period</center></td>"
            . "<td><center>$purpose</center></td>"
            . "<td><center>$addr</center></td></tr>";
    }
//var_dump($i);
$approve_table->close();
$tab1->close();
$tab2 = $ui1->tabPane()->id("rejected_station_leave")->open();
$reject_table = $ui1->table()->hover()->bordered()->sortable()->searchable()->paginated()->open();
?>
    <thead>
    <tr>
        <th>
            <center>Number</center>
        </th>
        <th>
            <center>Name</center>
        </th>
        <th>
            <center>Applying Date</center>
        </th>
        <th>
            <center>Station Leaving Date</center>
        </th>
        <th>
            <center>Station Leaving Time</center>
        </th>
        <th>
            <center>Station Returning Date</center>
        </th>
        <th>
            <center>Station Returning Time</center>
        </th>
        <th>
            <center>Period</center>
        </th>
        <th>
            <center>Purpose</center>
        </th>
        <th>
            <center>Address During Absence</center>
        </th>
    </tr>
    </thead>
<?php

$i = 0;
if ($rejected['leave_details'] != NULL)
//    var_dump($rejected['leave_details']);
    foreach ($rejected['leave_details'] as $row) {
        $st_applying_date = $row['applying_date'];
        $st_lv_date = $row['leaving_date'];
        $st_lv_time = $row['leaving_time'];
        $st_rt_date = $row['arrival_date'];
        $st_rt_time = $row['arrival_time'];
        $period = $row['period'];
        $purpose = $row['purpose'];
        $addr = $row['addr'];
        $name = $row['name'];
        $i++;
        echo "<tr><td><center>$i</center></td>"
            . "<td><center>$name</center></td>"
            . "<td><center>$st_applying_date</center></td>"
            . "<td><center>$st_lv_date</center></td>"
            . "<td><center>$st_lv_time</center></td>"
            . "<td><center>$st_rt_date</center></td>"
            . "<td><center>$st_rt_time</center></td>"
            . "<td><center>$period</center></td>"
            . "<td><center>$purpose</center></td>"
            . "<td><center>$addr</center></td></tr>";
    }
$reject_table->close();
$tab2->close();

$tab3 = $ui1->tabPane()->id("forwarded_station_leave")->open();
$forward_table = $ui1->table()->hover()->bordered()->sortable()->searchable()->paginated()->open();
?>
    <thead>
    <tr>
        <th>
            <center>Number</center>
        </th>
        <th>
            <center>Name</center>
        </th>
        <th>
            <center>Applying Date</center>
        </th>
        <th>
            <center>Station Leaving Date</center>
        </th>
        <th>
            <center>Station Leaving Time</center>
        </th>
        <th>
            <center>Station Returning Date</center>
        </th>
        <th>
            <center>Station Returning Time</center>
        </th>
        <th>
            <center>Period</center>
        </th>
        <th>
            <center>Purpose</center>
        </th>
        <th>
            <center>Address During Absence</center>
        </th>
    </tr>
    </thead>
<?php

$i = 0;
if ($forwarded['leave_details'] != NULL)
    foreach ($forwarded['leave_details'] as $row) {
        $st_applying_date = $row['applying_date'];
        $st_lv_date = $row['leaving_date'];
        $st_lv_time = $row['leaving_time'];
        $st_rt_date = $row['arrival_date'];
        $st_rt_time = $row['arrival_time'];
        $period = $row['period'];
        $purpose = $row['purpose'];
        $addr = $row['addr'];
        $name = $row['name'];
        $i++;
        echo "<tr><td><center>$i</center></td>"
            . "<td><center>$name</center></td>"
            . "<td><center>$st_applying_date</center></td>"
            . "<td><center>$st_lv_date</center></td>"
            . "<td><center>$st_lv_time</center></td>"
            . "<td><center>$st_rt_date</center></td>"
            . "<td><center>$st_rt_time</center></td>"
            . "<td><center>$period</center></td>"
            . "<td><center>$purpose</center></td>"
            . "<td><center>$addr</center></td></tr>";
    }
$forward_table->close();
$tab3->close();
$tabBox1->close();