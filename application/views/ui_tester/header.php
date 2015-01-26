
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>UI TESTING</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?= base_url() ?>assets/bootstrap-3.3.2/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?= base_url() ?>assets/adminLTE/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap-3.3.2/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="<?= base_url() ?>assets/adminLTE/js/AdminLTE/app.js" type="text/javascript"></script>
    </head>


    <body>
    <?php
        echo mis_div_row_open();
        echo mis_div_col_open(6,'md');
        echo mis_form_open('','','','New Form open');
        echo mis_form_password('name','password','','Password');
        echo mis_form_email('name','email','','Email');
        echo mis_form_upload('name','','','Upload File');
        echo mis_form_textarea('name','its text area','','Textarea');
        echo mis_div_row_open();
        echo mis_div_col_open(6);
        echo mis_form_checkbox('name','Yes','','','Checkbox 1');
        echo mis_form_checkbox('name','Yes','','','Checkbox 2');
        echo mis_div_close();
        echo mis_div_col_open(6);
        echo mis_form_radio('name','Yes','','','Radio Button 1');
        echo mis_form_radio('name','Yes','','','Radio Button 2');
        echo mis_div_close();
        echo mis_div_close();
        echo mis_form_dropdown('name',array('1'=>'one','2'=>'two','3'=>'three'),'','','Select');
        echo mis_form_close();
        echo mis_box_open('new box','success');
        echo mis_table_open('bordered');
        echo '<tr><th>frfr</th><th>frfr</th><th>frfr</th></tr>';
        echo '<tr><td>frfr</td><td>frfr</td><td>frfr</td></tr>';
        echo '<tr><td>frfr</td><td>frfr</td><td>frfr</td></tr>';
        echo '<tr><td>frfr</td><td>frfr</td><td>frfr</td></tr>';
        echo mis_table_close();
        echo mis_box_close();
        echo mis_box_open('new box','success');
        echo mis_box_close();
        echo mis_div_close();

        echo mis_div_col_open(6,'md');
        echo mis_form_open('','','','Form open');
        echo mis_form_input('name','value');
        echo mis_form_input('name','value','');
        echo mis_form_input('name','value','','');
        echo mis_form_input('name','value','','label');
        echo mis_form_input('name','value','','label','');
        echo mis_form_input('name','value','','label','success');
        echo mis_form_input('name','value','','label','error');
        echo mis_form_input('name','value','','label','warning');
        echo mis_form_input('name','value','','','success');
        echo mis_form_input('name','value','','','');
        echo mis_form_submit('name','value');
        echo mis_form_close();
        echo mis_div_close();
        echo mis_div_close();
    ?>
    </body>
</html>
