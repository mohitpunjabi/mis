<?php $ui = new UI();

if($error!="")
    $ui->alert()->uiType('danger')->title('ERROR')->desc($error)->show();

$form = $ui->form()->id('basic_details')->multipart()->action('employee/add/insert_basic_details')->open();
    $row = $ui->row()->open();
        $col = $ui->col()->width(12)->open();

            $basic_box = $ui->box()->uiType('primary')->solid()->title('Personal Details')->open();
            echo 'Fields marked with <span style= "color:red;">*</span> are mandatory.<br><br> ';
                $row1 = $ui->row()->open();
                            $ui->input()->width(3)->name('emp_id')
                                        ->required()
                                        ->addonRight($ui->button()->value('Go')->id('fetch_id_btn')->uiType('primary'))
                                        ->label('Employee Id<span style= "color:red;"> *</span>')
                                        ->show();
                            echo '<i class="loading" id="empIdIcon" ></i>';
                $row1->close();

                $row2 = $ui->row()->open();
                    $col1 = $ui->col()->width(3)->open();
                        echo '<label>Gender<span style= "color:red;"> *</span></label>';
                        $ui->radio()->name('sex')->value('male')->label('Male')->checked()->show();
                        $ui->radio()->name('sex')->value('female')->label('Female')->show();
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

                $row3 = $ui->row()->open();
                        $ui->select()->width(3)->name('salutation')
                                    ->label('Salutation<span style= "color:red;"> *</span>')
                                    ->options(array($ui->option()->value('Dr')->text('Dr'),
                                                    $ui->option()->value('Prof')->text('Prof'),
                                                    $ui->option()->value('Mr')->text('Mr'),
                                                    $ui->option()->value('Mrs')->text('Mrs'),
                                                    $ui->option()->value('Ms')->text('Ms')))
                                    ->show();
                        $ui->input()->width(3)->name('firstname')
                                    ->required()
                                    ->label('First Name<span style= "color:red;"> *</span>')
                                    ->show();
                        $ui->input()->width(3)->name('middlename')
                                        ->label('Middle Name')
                                        ->show();
                        $ui->input()->width(3)->name('lastname')
                                        ->label('Last Name')
                                        ->show();
                $row3->close();

                $row4 = $ui->row()->open();
                    $ui->select()->width(3)->name('mstatus')
                                    ->label('Marital Status<span style= "color:red;"> *</span>')
                                    ->options(array($ui->option()->value('married')->text('Married'),
                                                    $ui->option()->value('unmarried')->text('Unmarried'),
                                                    $ui->option()->value('widow')->text('Widow'),
                                                    $ui->option()->value('widower')->text('Widower'),
                                                    $ui->option()->value('separated')->text('Separated'),
                                                    $ui->option()->value('divorced')->text('Divorced')))
                                    ->show();

                    $ui->datePicker()
                        ->label('DOB<span style= "color:red;"> *</span>')
                        ->id('dob')
                        ->name('dob')
                        ->required()
                        ->dateFormat('dd-mm-yyyy')
                        ->width(3)
                        ->addonRight($ui->icon("calendar"))
                        ->value(date("d-m-Y"))
                        ->extras('max="'.date("d-m-Y").'"') //max not working
                        ->show();

                    $ui->input()->width(3)->name('pob')
                                    ->required()
                                    ->label('Place of Birth<span style= "color:red;"> *</span>')
                                    ->show();
                $row4->close();

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
                    ->required()
                    ->dateFormat('dd-mm-yyyy')
                    ->addonRight($ui->icon("calendar"))
                    ->show();
            $emp_box->close();

            $pay_box = $ui->box()->uiType('primary')->solid()->title('Payment Details')->open();

                $options = array($ui->option()->value("")->text("Select a Pay Band")->disabled()->selected());
                //Not Working
                /*if($pay_bands === FALSE)
                    array_push($options,$ui->option()->value("")->text("No pay band found")->disabled());
                else
                    foreach($pay_bands as $row)
                    {
                        array_push($options,$ui->option()->value($row->pay_band)->text(strtoupper($row->pay_band).' ('.$row->pay_band_description.')'));
                    }
*/
                $ui->select()->name('payscale')->id('payscale')->label('Pay Details<span style= "color:red;"> *</span>')
                            ->options($options)->required()->show();

                $ui->select()->name("gradepay")->id("gradepay")->style("visibility:hidden")->required()->show();

                $ui->input()->name("basicpy")->id("basicpay")->style("visibility:hidden")->placeholder("Basic Pay")->required()->show();
            $pay_box->close();
        $col->close();

        $col = $ui->col()->width(8)->open();
            $addr_box = $ui->box()->uiType('primary')->solid()->title('Address Details')->open();
            $row1 = $ui->row()->open();
                $col1 = $ui->col()->width(6)->t_width(6)->open();
                echo 'Present Address';
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
                echo 'Permanent Address';
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
        $col->close();
    $row->close();
$form->close();
?>




<!-- <p><?php if($error!="")
        $this->notification->drawNotification('',$error,'error'); ?></p>
    <h1>Step 1 :Fill up the details</h1>
    <?php  echo form_open_multipart('employee/add/insert_basic_details','onSubmit="return image_validation();"');   ?>
    Fields marked with <span style= "color:red;">*</span> are mandatory.
    <table width='90%'>
        <tr><th colspan=4></th></tr>
        <tr>
            <td width='20%' id="empId">
                Employee Id<span style= "color:red;"> *</span>
            </td>
            <td width='30%' id="empId">
                <input type="text" name="emp_id" required="required" tabindex="1" />
                <input type="button" value="Go" id="fetch_id_btn" onClick="fetch_details()" tabindex="1" />
                <i class="loading" id="empIdIcon" ></i>
            </td>
            <td width='20%'>
                Physically Challenged<span style= "color:red;"> *</span>
            </td>
            <td width='30%'>
                <input type="radio" name="pd" value="Yes" tabindex="2" />Yes
                <input type="radio" name="pd" checked value="No" tabindex="3" />No
            </td>
        </tr>
        <tr>
            <td>
                Salutation<span style= "color:red;"> *</span>
            </td>
            <td>
                <select name="salutation" tabindex="4" >
                    <option value="Dr" >Dr</option>
                    <option value="Prof">Prof</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms</option>
                </select>
            </td>
            <td>
                First Name<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="text" name = "firstname" required="required" tabindex="5"/>
            </td>
        </tr>
        <tr>
            <td>
                Middle Name
            </td>
            <td>
                <input type="text" name = "middlename" tabindex="6" />
            </td>
            <td>
                Last Name
            </td>
            <td>
                <input type="text" name = "lastname" tabindex="7" />
            </td>
        </tr>
        <tr>
            <td>
                Gender<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="radio" name="sex" checked value="male" tabindex="8">Male</input>
                <input type="radio" name="sex" value="female" tabindex="9">Female</input>
            </td>
            <td>
                Nationality<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="text" name="nationality" required="required" value="Indian" tabindex="10"/>
            </td>
        </tr>
        <tr>
            <td>
                Father's Name<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="text" name="father" required="required" tabindex="11" />
            </td>
            <td>
                Mother's Name<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="text" name="mother" required="required" tabindex="12" />
            </td>
        </tr>
        <tr>
            <td>
                Employee Type<span style= "color:red;"> *</span>
            </td>
            <td>
                <select name="tstatus" onchange="teaching_handler(this.value);" tabindex="13" >
                    <option value="ft" selected="selected" >Faculty</option>
                    <option value="nfta">Non Faculty (Academic)</option>
                    <option value="nftn">Non Faculty (Non Academic)</option>
                </select>
            </td>
            <td>
                Research Interest
            </td>
            <td>
                <input type="text" name="research_int" id="res_int_id" tabindex="14" />
            </td>
        </tr>
        <tr>
            <td>
                    Marital Status<span style= "color:red;"> *</span>
            </td>
            <td>
                    <select name="mstatus" tabindex="15" >
                            <option value="married">Married</option>
                            <option value="unmarried">Unmarried</option>
                            <option value="widow">Widow</option>
                            <option value="widower">Widower</option>
                            <option value="separated">Separated</option>
                            <option value="divorced">Divorced</option>
                    </select>
            </td>
            <td>
                Kashmiri Immigrant<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="radio" name="kashmiri" value="yes" tabindex="16"/>Yes
                <input type="radio" name="kashmiri" checked value="no" tabindex="17"/>No
            </td>
        </tr>
        <tr>
            <td>
                Date of Joining<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="date" name="entrance_age" value="<?php echo date("Y-m-d",time());?>" required="required" tabindex="18" >
            </td>
            <td>
                Designation<span style= "color:red;"> *</span>
            </td>
            <td>
                <select name="designation" id="des" tabindex="19">
                <?php
                    //Designation changes ..... fetched from designations table
                    //by default faculty designations are to be fetched
                    if($designations === FALSE)
                        echo '<option value="" disabled="disabled">No designation found</option>';
                    else
                        foreach($designations as $row)
                        {
                            echo '<option value="'.$row->id.'">'.ucwords($row->name).'</option>';
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
                <select name="category" tabindex="22">
                    <option value="General">GEN</option>
                    <option value="OBC">OBC</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                    <option value="Others">Others</option>
                </select>
            </td>
            <td>
                Religion<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="text" name="religion" required="required" tabindex="23"/>
            </td>
        </tr>
        <tr>
            <td>
               DOB<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="date" name="dob" value="<?php echo date("Y-m-d",time());?>" max=<?php echo date("Y-m-d", time()); ?>  required="required" tabindex="24" onchange="retirement_handler()" />
            </td>
            <td>
                Place of Birth<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="text" name="pob" required="required" tabindex="25" />
            </td>
        </tr>
         <tr>
            <td>
               Pay Details<span style= "color:red;"> *</span>
            </td>
            <td>
                <select name="payscale" tabindex="26"  onchange="payband_handler(this.value);" required >
                    <option value="" disabled selected>Pay Band </option>
                    <?php
                        if($pay_bands === FALSE)
                            echo '<option value="" disabled="disabled">No pay band found</option>';
                        else
                            foreach($pay_bands as $row)
                            {
                                echo '<option value="'.$row->pay_band.'">'.strtoupper($row->pay_band).' ('.$row->pay_band_description.')</option>';
                            }
                    ?>
                </select>
                <select name="gradepay" tabindex="26" onchange="javascript: document.getElementById('basicpay').style.visibility='visible'" style="visibility:hidden" required ></select>
                <input type="text" name="basicpay" tabindex="26" id="basicpay" style="visibility:hidden" size="10"  placeholder="Basic Pay" required />
            </td>
             <td>Nature of Employment<span style= "color:red;"> *</span></td>
            <td>
                <select name="empnature" tabindex="27" >
                    <option value="permanent">Permanent</option>
                    <option value="temporary">Temporary</option>
                    <option value="probation">Probation</option>
                    <option value="contract">Contract</option>
                    <option value="others">Others</option>
                </select>
            </td>
        </tr>
     <tr>
            <td>
                Department/Section<span style= "color:red;"> *</span>
            </td>
            <td>
                <select name="department" id="depts" tabindex="28" >
                <?php
                    if($academic_departments === FALSE)
                        echo '<option value="" disabled="disabled">No academic department found</option>';
                    else
                        foreach($academic_departments as $row)
                        {
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }
                ?>
                </select>
            </td>
            <?php
               $date = new DateTime(date("Y-m-d",time()));
               $date->modify('+65 year');
            ?>
            <td>
                Date of Retirement
            </td>
            <td>
               <input type="date" id="retire" name="retire" value="<?php    echo $date->format('Y-m-d'); ?>" tabindex="28" />
            </td>
        </tr>
         <tr>
            <th width='50%' colspan=2>
               Present Address
            </th>
            <th width='50%' colspan=2>
               Permanent Address
            </th>
        </tr>
        <tr>
            <td>
               Address Line 1<span style= "color:red;"> *</span>
            </td>
            <td>
                <textarea name="line11" required="required" tabindex="29"></textarea>
            </td>
            <td>
               Address Line 1<span style= "color:red;"> *</span>
            </td>
            <td>
                <textarea name="line12" required="required" tabindex="36"></textarea>
            </td>
        </tr>
        <tr>
               <td>
            Address Line 2
        </td>
        <td>
            <input type="text" name="line21" tabindex="30" />
        </td>
        <td>
            Address Line 2
        </td>
        <td>
            <input type="text" name="line22" tabindex="36" />
        </td>
    </tr>
    <tr>
        <td>
            City<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="text" name="city1" required="required" tabindex="31"/>
        </td>
        <td>
            City<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="text" name="city2" required="required" tabindex="37"/>
        </td>
    </tr>
    <tr>
        <td>
            State<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="text" name="state1" required="required" tabindex="32"/>
        </td>
        <td>
            State<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="text" name="state2" required="required" tabindex="38"/>
        </td>
    </tr>
    <tr>
        <td>
            Pin code<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="tel" name="pincode1" required="required" tabindex="33"/>
        </td>
        <td>
            Pin code<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="tel" name="pincode2" required="required" tabindex="39"/>
        </td>
    </tr>
        <tr>
        <td>
            Country<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="text" name="country1" value="India" required="required" tabindex="34"/>
        </td>
        <td>
            Country<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="text" name="country2" value="India" required="required" tabindex="40"/>
        </td>
    </tr>
    <tr>
        <td>
            Contact No<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="tel" name="contact1" required="required" tabindex="35"/>
        </td>
        <td>
            Contact No<span style= "color:red;"> *</span>
        </td>
        <td>
            <input type="tel" name="contact2" required="required" tabindex="41"/>
        </td>
    </tr>
 -->   <tr><th colspan=4></th></tr>
        <tr><td>Hobbies</td>
            <td><input type="text" name="hobbies" tabindex="42"></td>
            <td>Favourite Past Time</td>
            <td><input type="text" name="favpast" tabindex="43"></td>
        </tr>
        <tr>
            <td>Fax</td>
            <td><input type="tel" name="fax" tabindex="44"></td>
            <td>Office No</td>
            <td><input type="tel" name="office" tabindex="45"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" tabindex="46" ></td>
            <td>Mobile No</td>
            <td><input type="tel" name="mobile" tabindex="47" ></td>
        </tr>
    </table>
    <table width="90%">
        <tr><th colspan=2 >Photograph</th></tr><tr></tr>
        <tr  height="150">
            <td width="145" id="preview">
                <img src="<?php echo base_url(); ?>assets/images/employee/noProfileImage.png" id="view_photo" width="145" height="150"/>
            </td>
            <td align="center">Click on choose file to select picture<span style= "color:red;"> *</span><br>
                <input type="file" name="photo" id="photo" required="required" tabindex="48" ><br>
                <input type="button" value="preview" onClick="preview_pic();" tabindex="49">
            </td>
        </tr>
    </table>
    <input type = "submit" value="Next" tabindex="50"/>
<?php echo form_close(); ?>