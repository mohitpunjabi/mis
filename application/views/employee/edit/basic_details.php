<?php $ui = new UI();

$form = $ui->form()->id('basic_details')->multipart()->action('employee/edit/update_basic_details/'.$emp_id)->open();
$row = $ui->row()->open();
    $col = $ui->col()->width(12)->open();
        $basic_box = $ui->box()->uiType('primary')->solid()->title('Personal Details')->open();
        echo 'Fields marked with <span style= "color:red;">*</span> are mandatory.<br><br> ';

            $row3 = $ui->row()->open();
                    $ui->select()->width(2)->name('salutation')
                                ->label('Salutation<span style= "color:red;"> *</span>')
                                ->options(array($ui->option()->value('Dr')->text('Dr')->selected($user_details->salutation == 'Dr'),
                                                $ui->option()->value('Prof')->text('Prof')->selected($user_details->salutation == 'Prof'),
                                                $ui->option()->value('Mr')->text('Mr')->selected($user_details->salutation == 'Mr'),
                                                $ui->option()->value('Mrs')->text('Mrs')->selected($user_details->salutation == 'Mrs'),
                                                $ui->option()->value('Ms')->text('Ms')->selected($user_details->salutation == 'Ms')))
                                ->show();
                    $ui->input()->width(3)->name('firstname')
                                ->required()
                                ->placeholder("First Name")
                                ->value($user_details->first_name)
                                ->label('First Name<span style= "color:red;"> *</span>')
                                ->show();
                    $ui->input()->width(3)->name('middlename')
                                    ->label('Middle Name')
                                    ->value($user_details->middle_name)
                                    ->placeholder("Middle Name")
                                    ->show();
                    $ui->input()->width(3)->name('lastname')
                                ->value($user_details->last_name)
                                ->placeholder("Last Name")
                                ->label('Last Name')
                                ->show();
            $row3->close();

            $row4 = $ui->row()->open();
                $ui->select()->width(3)->name('mstatus')
                                ->label('Marital Status<span style= "color:red;"> *</span>')
                                ->options(array($ui->option()->value('married')->text('Married')->selected($user_details->marital_status == 'married'),
                                                $ui->option()->value('unmarried')->text('Unmarried')->selected($user_details->marital_status == 'unmarried'),
                                                $ui->option()->value('widow')->text('Widow')->selected($user_details->marital_status == 'widow'),
                                                $ui->option()->value('widower')->text('Widower')->selected($user_details->marital_status == 'widower'),
                                                $ui->option()->value('separated')->text('Separated')->selected($user_details->marital_status == 'separated'),
                                                $ui->option()->value('divorced')->text('Divorced')->selected($user_details->marital_status == 'divorced')))
                                ->show();

                $ui->datePicker()
                    ->label('DOB<span style= "color:red;"> *</span>')
                    ->id('dob')
                    ->name('dob')
                    ->required()
                    ->dateFormat('dd-mm-yyyy')
                    ->width(3)
                    ->addonRight($ui->icon("calendar"))
                    ->value(date("d-m-Y",strtotime($user_details->dob)))
                    ->extras('max="'.date("d-m-Y").'"')
                    ->show();

                $ui->input()->width(3)->name('pob')
                                ->required()
                                ->value($user_other_details->birth_place)
                                ->label('Place of Birth<span style= "color:red;"> *</span>')
                                ->show();
            $row4->close();



            $row2 = $ui->row()->open();
                $col1 = $ui->col()->width(3)->open();
                    echo '<label>Gender<span style= "color:red;"> *</span></label>';
                    $ui->radio()->name('sex')->value('m')->label('Male')->checked(true)->show();
                    $ui->radio()->name('sex')->value('f')->label('Female')->checked(false)->show();
                $col1->close();

                $col2 = $ui->col()->width(3)->open();
                    echo '<label>Physically Challenged<span style= "color:red;"> *</span></label>';
                    $ui->radio()->name('pd')->value('Yes')->label('Yes')->show();
                    $ui->radio()->name('pd')->value('No')->label('No')->checked()->show();
                $col2->close();

                $col3 = $ui->col()->width(3)->open();
                    echo '<label>Kashmiri Immigrant<span style= "color:red;"> *</span></label>';
                    $ui->radio()->name('kashmiri')->value('yes')->label('Yes')->show();
                    $ui->radio()->name('kashmiri')->value('no')->label('No')->checked()->show();
                $col3->close();
            $row2->close();





            $row5 = $ui->row()->open();
                $ui->input()->width(3)->name('father')
                                ->required()
                                ->label('Father\'s Name<span style= "color:red;"> *</span>')
                                ->show();
                $ui->input()->width(3)->name('mother')
                                ->required()
                                ->label('Mother\'s Name<span style= "color:red;"> *</span>')
                                ->show();
            $row5->close();

            $row6 = $ui->row()->open();
                $ui->select()->width(3)->name('category')
                                ->label('Category<span style= "color:red;"> *</span>')
                                ->options(array($ui->option()->value('General')->text('GEN'),
                                                $ui->option()->value('OBC')->text('OBC'),
                                                $ui->option()->value('SC')->text('SC'),
                                                $ui->option()->value('ST')->text('ST'),
                                                $ui->option()->value('Others')->text('Others')))
                                ->show();
                $ui->input()->width(3)->name('nationality')
                                ->required()
                                ->value('Indian')
                                ->label('Nationality<span style= "color:red;"> *</span>')
                                ->show();
                $ui->input()->width(3)->name('religion')
                                ->required()
                                ->label('Religion<span style= "color:red;"> *</span>')
                                ->show();
                $ui->imagePicker()->width(12)->label("Photograph<span style= \"color:red;\"> *</span>")->required()->id('photo')->name('photo')->show();
            $row6->close();





        $basic_box->close();

    $col->close();
    $col = $ui->col()->width(4)->open();
        $emp_box = $ui->box()->uiType('primary')->solid()->title('Employment Details')->open();
            $ui->select()->name('tstatus')
                            ->id('tstatus')
                            ->label('Employee Type<span style= "color:red;"> *</span>')
                            ->options(array($ui->option()->value('ft')->text('Faculty')->selected(),
                                            $ui->option()->value('nfta')->text('Non Faculty (Academic)'),
                                            $ui->option()->value('nftn')->text('Non Faculty (Non Academic)')))
                            ->show();

            $ui->datePicker()
                ->label('Date of Joining<span style= "color:red;"> *</span>')
                ->name('entrance_age')
                ->required()
                ->dateFormat('dd-mm-yyyy')
                ->addonRight($ui->icon("calendar"))
                ->value(date("d-m-Y"))
                ->show();

            $ui->select()->name('designation')
                        ->label('Designation<span style= "color:red;"> *</span>')
                        ->id('des')
                        ->show();

            $ui->select()->name('department')
                        ->label('Department/Section<span style= "color:red;"> *</span>')
                        ->id('depts')
                        ->show();

            $ui->input()->name('research_int')
                            ->id('res_int_id')
                            ->label('Research Interest')
                            ->show();

            $ui->select()->name('empnature')
                            ->label('Nature of Employment<span style= "color:red;"> *</span>')
                            ->options(array($ui->option()->value('permanent')->text('Permanent'),
                                            $ui->option()->value('temporary')->text('Temporary'),
                                            $ui->option()->value('probation')->text('Probation'),
                                            $ui->option()->value('contract')->text('Contract'),
                                            $ui->option()->value('others')->text('Others')))
                            ->show();

            $ui->datePicker()
                ->label('Date of Retirement<span style= "color:red;"> *</span>')
                ->id('retire')
                ->name('retire')
                ->value($emp->retirement_date)
                ->required()
                ->dateFormat('dd-mm-yyyy')
                ->addonRight($ui->icon("calendar"))
                ->show();
        $emp_box->close();

        $pay_box = $ui->box()->uiType('primary')->solid()->title('Payment Details')->open();

            $options = array($ui->option()->value("")->text("Choose One")->disabled()->selected());
            array_push($options,$ui->option()->value('pb1')->text('ewdfew'));
            //Not Working
            /*if($pay_bands === FALSE)
                array_push($options,$ui->option()->value("")->text("No pay band found")->disabled());
            else
                foreach($pay_bands as $row)
                {
                    array_push($options,$ui->option()->value($row->pay_band)->text(strtoupper($row->pay_band).' ('.$row->pay_band_description.')'));
                }
*/
            $ui->select()->name('payscale')->id('payscale')->label('Pay Band<span style= "color:red;"> *</span>')
                        ->options($options)->required()->show();

            $ui->select()->name("gradepay")->id("gradepay")->label('Grade Pay<span style= "color:red;"> *</span>')
                            ->addonLeft($ui->icon('rupee'))
                            ->addonRight('.00')
                            ->options(array($ui->option()->value("")->text("Choose One")->disabled()->selected()))
                            ->disabled()->required()->show();

            $ui->input()->name("basicpay")
                        ->id("basicpay")
                        ->label('Basic Pay<span style= "color:red;"> *</span>')
                        ->disabled()
                        ->addonLeft($ui->icon('rupee'))
                        ->addonRight('.00')
                        ->required()->show();
        $pay_box->close();
    $col->close();

    $col = $ui->col()->width(8)->open();
        $addr_box = $ui->box()->uiType('primary')->solid()->title('Address Details')->open();
            $row1 = $ui->row()->open();
            $col1 = $ui->col()->width(6)->t_width(6)->open();
            echo '<h3 class="page-header">Present Address</h3>';
                $ui->textarea()->name('line11')
                                ->required()
                                ->label('Address Line 1<span style= "color:red;"> *</span>')
                                ->show();
                $ui->input()->name('line21')
                                ->label('Address Line 2')
                                ->show();
                $ui->input()->name('city1')
                                ->label('City<span style= "color:red;"> *</span>')
                                ->required()
                                ->show();
                $ui->input()->name('state1')
                                ->label('State<span style= "color:red;"> *</span>')
                                ->required()
                                ->show();
                $ui->input()->name('pincode1')
                                ->label('Pin Code<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->required()
                                ->show();
                $ui->input()->name('country1')
                                ->label('Country<span style= "color:red;"> *</span>')
                                ->value('India')
                                ->required()
                                ->show();
                $ui->input()->name('contact11')
                                ->label('Contact No<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->required()
                                ->show();
            $col1->close();

            $col2 = $ui->col()->width(6)->t_width(6)->open();
            echo '<h3 class="page-header">Permanent Address</h3>';
                $ui->textarea()->name('line12')
                                ->required()
                                ->label('Address Line 1<span style= "color:red;"> *</span>')
                                ->show();
                $ui->input()->name('line22')
                                ->label('Address Line 2')
                                ->show();
                $ui->input()->name('city2')
                                ->label('City<span style= "color:red;"> *</span>')
                                ->required()
                                ->show();
                $ui->input()->name('state2')
                                ->label('State<span style= "color:red;"> *</span>')
                                ->required()
                                ->show();
                $ui->input()->name('pincode2')
                                ->label('Pin Code<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->required()
                                ->show();
                $ui->input()->name('country2')
                                ->label('Country<span style= "color:red;"> *</span>')
                                ->value('India')
                                ->required()
                                ->show();
                $ui->input()->name('contact12')
                                ->label('Contact No<span style= "color:red;"> *</span>')
                                ->type('tel')
                                ->required()
                                ->show();
            $col2->close();
            $row1->close();
        $addr_box->close();

        $other_box = $ui->box()->uiType('primary')->open();
            $row1 = $ui->row()->open();
                $ui->input()->name('hobbies')->width(4)->t_width(6)->label('Hobbies')->show();
                $ui->input()->name('favpast')->width(4)->t_width(6)->label('Favourite Past Time')->show();
                $ui->input()->name('fax')->width(4)->t_width(6)->label('Fax')->type('tel')->show();
                $ui->input()->name('office')->width(4)->t_width(6)->label('Office No')->type('tel')->show();
                $ui->input()->name('email')->width(4)->t_width(6)->label('Email')->type('email')->addonLeft($ui->icon('envelope'))->show();
                $ui->input()->name('mobile')->width(4)->t_width(6)->addonLeft('+91')->label('Mobile No')->type('tel')->show();
            $row1->close();
        $other_box->close();
    $col->close();
    echo '</div>';
$row->close();

$nextRow = $ui->row()->open();
    $ui->button()->submit()->classes("pull-right")->value('Next')->name('submit')->large()->uiType('primary')->icon($ui->icon("arrow-right"))->show();
    echo "<br />";
$nextRow->close();
$form->close();
?>


<table width='90%'>
	<tr><th colspan=4></th></tr>
    <tr>
    	<td width='20%'>
        	Employee Id<span style= "color:red;"> *</span>
        </td>
        <td width='28%'>
        	<input type="text" name="emp_id" id="emp_id" readonly value="<?= $emp_id ?>"  >
        </td>
        <td width='22%'>
        	Physically Challenged<span style= "color:red;"> *</span>
        </td>
        <td width='30%'>
            <input type="radio" name="pd" value="yes" <?php if($user_details->physically_challenged=="yes") echo 'checked="checked"'; ?>  />Yes
            <input type="radio" name="pd" value="no" <?php if($user_details->physically_challenged=="no") echo 'checked="checked"'; ?> />No
        </td>
    </tr>
	<tr>
    	<td>
        	Salutation<span style= "color:red;"> *</span>
        </td>
        <td>
			<select name="salutation" >
            	<option value="Dr" <?php if($user_details->salutation=="Dr")echo "selected"; ?> >Dr</option>
                <option value="Prof"  <?php if($user_details->salutation=="Prof")echo "selected"; ?> >Prof</option>
                <option value="Mr"  <?php if($user_details->salutation=="Mr")echo "selected"; ?> >Mr</option>
                <option value="Mrs"  <?php if($user_details->salutation=="Mrs")echo "selected"; ?> >Mrs</option>
                <option value="Ms"  <?php if($user_details->salutation=="Ms")echo "selected"; ?> >Ms</option>
             </select>
        </td>
        <td>
        	First Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input  type="text" name = "firstname" required value="<?= $user_details->first_name ?>" >
        </td>
    </tr>
   	<tr>
    	<td>
        	Middle Name
        </td>
        <td>
        	<input type="text" name = "middlename" value=<?= $user_details->middle_name ?> >
        </td>
        <td>
        	Last Name
        </td>
        <td>
        	<input type="text" name = "lastname" value= <?= $user_details->last_name ?> >
        </td>
   </tr>
   <tr>
    	<td>
        	Gender<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="radio" name="sex" value="m" <?php if($user_details->sex=='male' || $user_details->sex=='m') echo 'checked="checked"'; ?> >Male</input>
            <input type="radio" name="sex" value="f" <?php if($user_details->sex=='female' || $user_details->sex=='f') echo 'checked="checked"';?> >Female</input>
        </td>
        <td>
        	Nationality<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="nationality" required value=<?= $user_other_details->nationality ?> >
        </td>
   </tr>
   <tr>
    	<td>
        	Father's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="father" required value="<?= $user_other_details->father_name ?>" >
        </td>
        <td>
			Mother's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="mother" required value="<?= $user_other_details->mother_name ?>" >
        </td>
   </tr>
   <tr>
    	<td>
			Employee Type<span style= "color:red;"> *</span>
       	</td>
        <td>
        	<select name="tstatus" onChange="teaching_handler(this.value);" id="teaching" >
            	<option value="ft" <?php if($emp->auth_id=="ft")echo "selected"; ?> >Faculty</option>
                <option value="nfta" <?php if($emp->auth_id=="nfta")echo "selected"; ?> >Non Faculty (Academic)</option>
                <option value="nftn" <?php if($emp->auth_id=="nftn")echo "selected"; ?> >Non Faculty (Non Academic)</option>
             </select>
        </td>
   		<td>
        	Research Interest
        </td>
        <td>
        	<?php
				if($emp->auth_id=='ft')
				{
					echo '<input type="text" name="research_int" id="res_int_id" value="'.$ft->research_interest.'" >';
				}
				else
					echo '<input type="text" name="research_int" id="res_int_id"  disabled >';
             ?>
        </td>
   </tr>
   <tr>
	   	<td>
        	Marital Status<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="mstatus" >
            	<option value="married" <?php if($user_details->marital_status=="married")echo "selected"; ?> >Married</option>
                <option value="unmarried" <?php if($user_details->marital_status=="unmarried")echo "selected"; ?> >Unmarried</option>
                <option value="widow" <?php if($user_details->marital_status=="widow")echo "selected"; ?> >Widow</option>
                <option value="widower" <?php if($user_details->marital_status=="widower")echo "selected"; ?> >Widower</option>
                <option value="separated" <?php if($user_details->marital_status=="separated")echo "selected"; ?> >Separated</option>
                <option value="divorced" <?php if($user_details->marital_status=="divorced")echo "selected"; ?> >Divorced</option>
             </select>
        </td>
    	<td>
        	Kashmiri Immigrant<span style= "color:red;"> *</span>
        </td>
    	<td>
			<input type="radio" name="kashmiri" value="yes" <?php if($user_other_details->kashmiri_immigrant=='yes') echo 'checked="checked"'; ?>  />Yes
            <input type="radio" name="kashmiri" value="no" <?php if($user_other_details->kashmiri_immigrant=='no') echo 'checked="checked"'; ?>  />No
        </td>
    </tr>
    <tr>
       	<td>
        	Date of Joining<span style= "color:red;"> *</span>
        </td>
    	<td>
			<input type="date" name="entrance_age" value="<?php echo $emp->joining_date;?>" required  >
        </td>
    	<td>
        	Designation<span style= "color:red;"> *</span>
        </td>
    	<td>
	        <select name="designation" id="des"  >
            	<?php
					$designations=$this->designations_model->get_designations("type in ('".(($emp->auth_id == 'ft')? 'ft':'nft')."','others')");
					if($designations === FALSE)
                        echo '<option value="" disabled="disabled">No designation found</option>';
                    else
						foreach($designations as $row)
                        {
							echo '<option value="'.$row->id.'" ';
							if($row->id == $emp->designation)	echo 'selected';
							echo ' >'.ucwords($row->name).'</option>';
                        }
				?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>
            Category<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="category" >
				<option value="General" <?php if($user_details->category=="General")echo "selected"; ?> >GEN</option>
                <option value="OBC" <?php if($user_details->category=="OBC")echo "selected"; ?> >OBC</option>
                <option value="SC" <?php if($user_details->category=="SC")echo "selected"; ?> >SC</option>
                <option value="ST" <?php if($user_details->category=="ST")echo "selected"; ?> >ST</option>
                <option value="Others" <?php if($user_details->category=="Others")echo "selected"; ?> >Others</option>
             </select>
        </td>
    	<td>
        	Religion<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="religion" value="<?php echo $user_other_details->religion; ?>" required >
        </td>
    </tr>
    <tr>
    	<td>
        	DOB<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="date" name="dob" onChange="retirement_handler()"  value=<?= $user_details->dob ?> max=<?php echo date("Y-m-d", time()); ?> >
        </td>
    	<td>
        	Place of Birth<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="pob" value=<?= $user_other_details->birth_place ?> required >
        </td>
    </tr>
    <tr>
    	<td>
        	Pay Scale<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="payscale" tabindex="26"  required onChange="payband_handler(this.value);" >
            	<option value="" readonly disabled >Pay Band </option>
				<?php
                    if($pay_bands === FALSE)
                        echo '<option value="" disabled="disabled">No pay band found</option>';
                    else
                        foreach($pay_bands as $row)
                        {
                            echo '<option value="'.$row->pay_band.'" ';
                        	if($row->pay_band == $emp_pay_details->pay_band) echo 'selected';
                        	echo ' >'.strtoupper($row->pay_band).' ('.$row->pay_band_description.')</option>';
                        }
                ?>
            </select>
            <select name="gradepay" required tabindex="26" >
				<?php
					$gradepay=$this->pay_scales_model->get_grade_pay($emp_pay_details->pay_band);
					foreach($gradepay as $row)
                        {
                            echo '<option value="'.$row->pay_code.'" ';
                        	if($row->grade_pay == $emp_pay_details->grade_pay) echo 'selected';
                        	echo ' >'.$row->grade_pay.'</option>';
                        }
                ?>
            </select>
            <input type="text" name="basicpay" required id="basicpay" size="10"  placeholder="Basic Pay" value="<?= $emp_pay_details->basic_pay ?>" />
        </td>
        <td>Nature of Employment<span style= "color:red;"> *</span></td>
       	<td>
            <select name="empnature" >
            	<option value="permanent" <?php if($emp->employment_nature=="permanent")echo "selected"; ?> >Permanent</option>
                <option value="temporary" <?php if($emp->employment_nature=="temporary")echo "selected"; ?> >Temporary</option>
                <option value="probation" <?php if($emp->employment_nature=="probation")echo "selected"; ?> >Probation</option>
                <option value="contract" <?php if($emp->employment_nature=="contract")echo "selected"; ?> >Contract</option>
                <option value="others" <?php if($emp->employment_nature=="others")echo "selected"; ?> >Others</option>
            </select>
        </td>
   </tr>
   <tr>
   		<td>
        	Department/Section<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<select name="department" id="depts" >
            	<?php
            		if($emp->auth_id == 'ft')
            			$departments=$this->departments_model->get_departments('academic');
            		else if($emp->auth_id == 'nftn')
            			$departments=$this->departments_model->get_departments('nonacademic');
            		else
            			$departments=$this->departments_model->get_departments();

					if($departments === FALSE)
                    	echo '<option value="" disabled="disabled">No academic department found</option>';
                	else
                    	foreach($departments as $row)
                    	{
	                        echo '<option value="'.$row->id.'" ';
	                        if($row->id == $user_details->dept_id) echo 'selected';
	                        echo '>'.$row->name.'</option>';
                    	}
				?>
            </select>
        </td>
		<td>
        	Date of Retirement
        </td>
        <td>
        	<input type="date" name="retire" id="retire" value="<?= $emp->retirement_date;?>" />
        </td>
    </tr>
    <tr>
    	<th width="50%" colspan=2>
        	Present Address
        </th>
        <th width="50%" colspan=2>
        	Permanent Address
        </th>

    </tr>
    <tr>
        <td>
        	Address Line 1<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<textarea type="text" name="line11" required ><?= $present_address->line1 ?> </textarea>
        </td>
        <td>
        	Address Line 1<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<textarea type="text" name="line12" readonly disabled ><?= $permanent_address->line1 ?> </textarea>
        </td>
    </tr>
     <tr>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line21" value="<?= $present_address->line2 ?>" >
        </td>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line22" readonly disabled value="<?= $permanent_address->line2 ?>" >
        </td>
    </tr>
	<tr>
    	<td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city1" required value="<?= $present_address->city ?>" >
        </td>
        <td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city2" readonly disabled value="<?= $permanent_address->city ?>" >
        </td>
    </tr>
    <tr>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state1" required value="<?= $present_address->state ?>" >
        </td>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state2" value="<?= $permanent_address->state ?>" readonly disabled >
        </td>
    </tr>
    <tr>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode1" value="<?= $present_address->pincode ?>" >
        </td>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode2" value="<?= $permanent_address->pincode ?>" readonly disabled >
        </td>
    </tr>
    <tr>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country1" value="<?= $present_address->country ?>" required />
        </td>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country2" value="<?= $permanent_address->country ?>" readonly disabled />
        </td>
    </tr>
    <tr>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact1" value="<?= $present_address->contact_no ?>" required >
        </td>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact2" value="<?= $permanent_address->contact_no ?>" readonly disabled >
        </td>
    </tr>
	<tr><th colspan=4></th></tr>
		<tr><td>Hobbies</td>
        	<td><input type="text" name="hobbies" value="<?= $user_other_details->hobbies ?>" ></td>
            <td>Favourite Past Time</td>
        	<td><input type="text" name="favpast" value="<?= $user_other_details->fav_past_time ?>" ></td>
        </tr>
        <tr>
            <td>Fax</td>
        	<td><input type="tel" name="fax" value="<?= $emp->fax ?>" ></td>
            <td>Office No</td>
        	<td><input type="tel" name="office" value="<?= $emp->office_no ?>" ></td>
        </tr>
		<tr><td>Email</td>
        	<td><input type="email" name="email" value="<?= $user_details->email ?>" ></td>
            <td>Mobile No</td>
        	<td><input type="tel" name="mobile" value="<?= $user_other_details->mobile_no ?>" ></td>
        </tr>
</table>
<input type = "submit" value="Save"/>
<?php echo form_close(); ?>
<a href= <?= site_url('employee/edit')?> ><button>Back</button></a>