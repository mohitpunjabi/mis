<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
  <?php 
 // echo "Number of course subjects = ".$CS_session['aggr_id'];
   //echo "duration from session ".var_dump($CS_session);
   echo "<h3>".$CS_session['course_name']." (".$CS_session['branch'].") for Session "."20".$CS_session['session'][0].$CS_session['session'][1]."-20".$CS_session['session'][2].$CS_session['session'][3]."</h3>"; 
   echo form_open('course_structure/add/AddCoreSubjects'); 
   if($CS_session['count_core']>0)
   {
  ?>
  <h3>
 	 Add Core Subjects for Semester 
  <?php 
    echo $CS_session['sem'];
  ?>
  </h3>
  <table class="table table-condensed" style="width: auto">
      <tr>
        <th>Order</th>
        <th>Subject ID</th>
        <th>Subject Name</th>
        <th>Lecture</th>
        <th>Tutorial</th>
        <th>Practical</th>
		<th>Credit Hours</th>
        <th>Type</th>
      </tr>
      <?php for($counter = 1;$counter<=$CS_session['count_core'];$counter++){ ?> 
      <tr> 
        <td>
          <select name="sequence<?php echo $counter; ?>"/>
            <?php for($i=1;$i<=$CS_session['count_core']+$CS_session['count_elective'];$i++) {?>
            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
            <?php } ?>
          </select>
        </td>      
        <td> 
          <input type="text" name="id<?php echo $counter;?>"/>
        </td>
        <td> 
          <input type="text" name="name<?php echo $counter;?>"/>
        </td> 
        <td>
          <select name="L<?php echo $counter;?>">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </td>
        <td>
          <select name="T<?php echo $counter;?>">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </td>
        <td>
          <select name="P<?php echo $counter;?>">
            <?php for($i = 0; $i<=5; $i+=0.5){ ?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option> 
            <?php } ?>
          </select>
        </td>
        <td>
          <input type="text" name="credit_hours<?php echo $counter;?>"/>
        </td>
        <td>
          <select name="type<?php echo $counter; ?>">
            <option value="0">Theory</option>
            <option value="1">Practical</option>
            <option value="2">Sessional</option>
            <option value="3">Non-Contact</option>
          </select>
        </td>
        </tr>  
        <?php }
   			}
        ?>
    </table>
    <?php 
		if($CS_session['count_elective']>0)
		{
	?>
    <h3>
  Add Details for Elective Subjects of Semester 
  <?php 
    echo $CS_session['sem'];
  ?>
  </h3>
    <table id="elective_table">
      <?php if($CS_session['count_elective'] > 1) {?>
      <tr>
        <td>Please Select the type for Elective list</td>
        <td>
          <select name="list_type" id="list-type">
            <option>Please select</option>
            <option value="1">Same List For All Electives</option>
            <option value="2">Seperate list for Electives</option>
          </select>
        </td>
      </tr>
      <?php 
        } //end of if statement $count_elective 
        if($CS_session['count_elective'] == 1){//Display the normal fields if only 1 elective
      ?>
        <tr>
          <td>
          Enter number of options for Elective 1
          </td>
          <td>
          <input type="text" name="options1" id = "options1" />
          </td>
          <td>
            <select name="seq_e1"/>
              <?php for($j=1;$j<=$CS_session['count_core']+$CS_session['count_elective'];$j++) {?>
              <option value="<?php echo $j; ?>"><?php echo $j;?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
      <?php 
		}
	  }//end of if statement ?> 
    </table>
      
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <?php
    echo form_close(); 
  ?>  
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
<script>
  var core_count = <?php echo $CS_session['count_core']; ?>;  
  var elective_count = <?php echo $CS_session['count_elective']; ?>;
  $(document).ready(function(){
    var $list_type = $('#list-type');
    var $elective_table = $('#elective_table');
    $list_type.on('change',function(d){
      //console.log(d);
      $list_type.val();
      if(parseInt($list_type.val()) === 1){
        //console.log(elective_count,"Hello");
        //$list_type.delete();
        $('tr.diff_options').remove();
        var base_str = "<tr class=\"same_options\"><td>Please Enter the Number of Options</td>";
        base_str += "<td><input type=\"text\" name=\"options1\" /></td></tr>";
        for(i=1;i<=elective_count;i++){
          base_str += "<tr class=\"same_options\"> <td> Select order of Elective "+i+" </td>";
          base_str += "<td><select name=\"seq_e"+i+"\">";
          for(j=1;j<= elective_count + core_count;j++){
            base_str += "<option value="+j+">"+j+"</option>";
          }
          base_str += "</select></td></tr>";
        }
        $elective_table.append(base_str);
      }
      else{
        $('tr.same_options').remove();
        var base_str;
        for(i=1;i<=elective_count;i++){
          base_str += "<tr class=\"diff_options\"><td>Please Enter the Number of Options for Elective "+i+"</td>";
          base_str += "<td><input type=\"text\" name=\"options"+i+"\" /></td>";
          base_str += "<td><select name=\"seq_e"+i+"\">";
          for(j=1;j<= elective_count + core_count;j++){
            base_str += "<option value="+j+">"+j+"</option>";
          }
          base_str += "</select></td></tr>";
        }
        $elective_table.append(base_str);  
      }
    });

  });  
</script>

