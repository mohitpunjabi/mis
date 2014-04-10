<?php
	require_once('../Includes/Auth.php');
	
	drawHeader("Personal Profile");
?>

<?php
	$fetch_detail_res=$mysqli->query("SELECT * 
									FROM user_details AS a INNER JOIN user_other_details AS b 
									WHERE a.id = b.id AND a.id='".$_SESSION['id']."'");
	if($fetch_detail_res){
		$fetch_detail_arr=$fetch_detail_res->fetch_assoc();
		if(!$fetch_detail_arr)
			die("Problem encountered");
	} else die("Problem encountered");
	// var_dump($fetch_detail_arr);
?>
	<script>
		var basdet = new Array();
		var adddet = new Array();
		var edudet = new Array();
		<?php
			$det = $mysqli->query("SELECT * FROM user_details WHERE id=".$_SESSION['id']);
			$row = $det->fetch_assoc();
			foreach($row as $key=>$value)
				echo "basdet['".$key."']='".$value."';";
			
			$det = $mysqli->query("SELECT * FROM user_other_details WHERE id=".$_SESSION['id']);
			$row = $det->fetch_assoc();
			foreach($row as $key=>$value)
				echo "adddet['".$key."']='".$value."';";
			
			$det = $mysqli->query("SELECT * FROM alu_ism_acad WHERE id=".$_SESSION['id']);
			$row = $det->fetch_assoc();
			foreach($row as $key=>$value)
				echo "edudet['".$key."']='".$value."';";
		?>
		$(document).ready(function(){
			$("input[name=username]").attr('value',basdet['salutation']+' '+basdet['first_name']+((basdet['middle_name']=='')?' ':' '+basdet['middle_name']+' ')+''+basdet['last_name']);
			$("input[name=sex]").attr('value',((basdet['sex'] == 'm')?'Male':'Female'));
			$("input[name=dob]").attr('value',basdet['dob']);
			$("input[name=email]").attr('value',basdet['email']);
			$("input[name=marry]").attr('value',basdet['marital_status']);
			$("input[name=handicap]").attr('value',basdet['physically_challenged']);
			$("input[name=religion]").attr('value',adddet['religion']);
			$("input[name=nation]").attr('value',adddet['nationality']);
			$("input[name=kashmir]").attr('value',adddet['kashmiri_immigrant']);
			$("input[name=birthplace]").attr('value',adddet['birth_place']);
			$("input[name=contact]").attr('value',adddet['mobile_no']);
			$("input[name=father]").attr('value',adddet['father_name']);
			$("input[name=mother]").attr('value',adddet['mother_name']);
			$("input[name=course]").attr('value',edudet['course_id']);
			$("input[name=branch]").attr('value',edudet['branch_id'].toUpperCase());
			$("input[name=batch]").attr('value',edudet['pass_year']);
			$("input[type=text].inp").each(function(){
				$(this).attr("disabled","disabled");
			});
		});
		
		function exchange(){
			var basic = {};
			var addit = {};
			var edu = {};
			var c=0;
			var sending;
			var but = document.getElementById("edit");
			switch(but.textContent){
				case 'Edit':
					$("input[type=text].inp, input[type=date].inp").each(function(){
						$(this).removeAttr("disabled");
					});
					$(but).html("Save");
				break;
				case 'Save':
					error = 0;
					$("input[type=text].inp, input[type=date].inp").each(function(index){
						if($(this).hasClass("basic"))
							basic[this.name] = this.value;
						if($(this).hasClass("addit"))
							addit[this.name] = this.value;
						if($(this).hasClass("edu"))
							edu[this.name] = this.value;
					});
					sexcheck = basic['sex'].toUpperCase();
					marrycheck = basic['marry'].toUpperCase();
					handicheck = basic['handicap'].toUpperCase();
					dobarr = basic['dob'].split('-');
					yearcheck = parseInt(edu['batch']) - dobarr[0];
					if(basic['username'].match("\\d") != null)
						error = 1;
					else if(basic['username'].match("[!-/:-@{-~\[-`]") != null)
						error = 2;
					else if(sexcheck != 'MALE' && sexcheck != 'FEMALE' && sexcheck!='')
						error = 3;
					else if(marrycheck != 'UNMARRIED' && marrycheck != 'MARRIED' && marrycheck != 'BACHELOR' && marrycheck != 'BACHELORETTE' && marrycheck != 'WIDOW' && marrycheck != 'WIDOWER')
						error = 4;
					else if(handicheck != 'NO' && handicheck != 'YES')
						error = 5;
					else if(yearcheck > 70)
						error = 6;
					if(error){
						switch(error){
							case 1:
								alert('Name should not have number');
							break;
							case 2:
								alert('sp symbol');
							break;
							case 3:
								alert("Sex attribute can only have two values: Male or Female");
							break;
							case 4:
								alert("One of the appropriate values for Marital Status is: Married, Unamrried, Bachelor, Bachelorette, Widow, Widower");
							break;
							case 5:
								alert("Physically Handicapped: Yes or No");
							break;
							case 6:
								alert("Recheck DoB");
						}
					}
					else{
						$("input[type=text].inp, input[type=date].inp").each(function(index){
							$(this).attr("disabled","disabled");
						});
						$(but).html("Edit");
						basicstr = JSON.stringify(basic);
						additstr = JSON.stringify(addit);
						edustr = JSON.stringify(edu);
						$.post("profile_personal_edit.php",{bas:basicstr,add:additstr,edu:edustr},function(data){
							$("#results").html(data);
						});
					}
				break;
			}
		}
	</script>
	<style>
		[hide]{
			visibility:hidden;
		}
		td{
			width:25%;
		}
		input[type=text].inp, input[type=date].inp{
			background-color:transparent;
			color:#000;
			border:0;
			border-bottom:thin dotted #000;
			padding-top:0;
			padding-bottom:0;
		}
		input[type=text].inp:focus, input[type=date].inp:focus{
			box-shadow:none;
			background-color:#A94A38;
			color:#fff;
		}
		#edit{
			margin-left:50%;
		}
	</style>
	<button id="edit" onclick="exchange()">Edit</button>
	<p id="results"></p>
	<table width="80%" frame="border"  style="padding:20px; margin-left:10%; margin-top:5%;" nozebra>
		<tr>
			<th colspan="5">Personal Record</th>
		</tr>
		<tr >
			<td hide>blank</td>
			<th hide></th>
			<td hide></td>
			<td hide></td>
			<td rowspan="6" style=" width:20%;">
				<img src="<?php echo WEBSITE_ROOT."/alumni/Images/".$_SESSION['id']."/".$_SESSION['photopath']; ?>" width="150px"/>
			</td>
		</tr>
		<tr hide>
			<td>blank</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Alumni</td>
			<td colspan="2">
				<input class="inp basic" type="text" name="username" value="" placeholder="Name - No Record"/>
			</td>
			<td hide>blank</td>
		</tr>
		<tr>
			<td hide>blank</td>
			<td colspan="2">
				<input size="20" class="inp edu" type="text" name="course" value="" placeholder="Course - No Record"/>
				in
				<input style="text-align:right;" size="20" class="inp edu" type="text" name="branch" value="" placeholder="Branch - No Record"/>
			</td>
			<td hide>blank</td>
		</tr>
		<tr>
			<td hide>blank</td>
			<td colspan="2">
				Batch of <input size="23" class="inp edu" type="text" name="batch" value="" placeholder="PassingYear - No Record"/>
			</td>
			<td hide>blank</td>
		</tr>
		<tr>
			<td>
				<input class="inp basic"  type="text" name="sex" placeholder="Sex - No Record" />
			</td>
			<td>
				<input class="inp basic"  type="text" name="dob" value="" placeholder="DoB - No Record" onfocus="(this.type='date')"/>
			</td>
			<td>
				<input class="inp addit" type="text" name="contact" value="" placeholder="ContactInfo No Record"/>
			</td>
			<td>
				<input class="inp basic"  type="text" name="email" value="" placeholder="Email - No Record"/>
			</td>
		</tr>
		<tr>
			<th colspan="4">Additional Info</th>
		</tr>
		<tr hide>
			<td>blank</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Father's Name</td>
			<td><input class="inp addit" type="text" name="father" value="" placeholder="No Record"/></td>
			<td>Mother's Name</td>
			<td><input class="inp addit" type="text" name="mother" value="" placeholder="No Record"/></td>
		</tr>
		<tr>
			<td>Marital Status</td>
			<td><input class="inp basic"  type="text" name="marry" value="" placeholder="No Record"/></td>
			<td>Physically Challenged</td>
			<td><input class="inp basic" type="text" name="handicap" value="" placeholder="No Record"/></td>
		</tr>
		<tr>
			<td>Religion</td>
			<td><input class="inp addit" type="text" name="religion" value="" placeholder="No Record"/></td>
			<td>Kashmiri Immigrant</td>
			<td><input class="inp addit" type="text" name="kashmir" value="" placeholder="No Record"/></td>
		</tr>
		<tr>
			<td>Nationality</td>
			<td><input class="inp addit" type="text" name="nation" value="" placeholder="No Record"/></td>
			<td>Birth Place</td>
			<td><input class="inp addit" type="text" name="birthplace" value="" placeholder="No Record"/></td>
		</tr>
		<tr hide>
			<th>blank</th>
			<td></td>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th colspan="2">Hobbies</th>
			<th colspan="2">Favourite Past Time</th>
		</tr>
		<tr>
			<td colspan="2">
				<textarea rows="4" cols="50"></textarea>
			</td>
			<td colspan="2">
				<textarea rows="4" cols="50"></textarea>
			</td>
		</tr>
	</table>
	
<?php
	drawFooter();
?>