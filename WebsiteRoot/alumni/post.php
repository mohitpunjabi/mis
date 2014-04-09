<?php
	require_once('../Includes/Auth.php');
	require_once('../Includes/Layout.php');
	auth();
	drawHeader($_SESSION['name']);
?>
<script>
	var courses = new Array();
	<?php
		$i = 0;
		if($res = $mysqli->query("SELECT *
								FROM courses"
								)){
				while($arr = $res->fetch_assoc()){
					echo 'courses['.$i.'] = 
								{"id" : "'.$arr['id'].'", 
								"name" : "'.$arr['name'].'",
								"years" : "'.$arr['duration'].'"
								};
					';
					$i++;
				}
		}
	?>
	
	function drawcourses(count){
		var kli = courses.length;
		var tb = document.getElementById("coursechecktable");
		for(i=0;i<kli;i+=4){
			tr = document.createElement("TR");
			for(j=0;j<4;j++){
				ip = document.createElement("INPUT");
				lb = document.createElement("LABEL");
				if(count == 'one'){
					ip.type = "radio";
					ip.name = "courses";
				}
				else if(count == 'many'){
					ip.type = "checkbox";
					ip.name = "courses[]";
				}
				ip.value = courses[i+j].id;
				ip.id = courses[i+j].id;
				lb.htmlFor = ip.id;
				td = document.createElement("TD");
				td.style.textAlign = "center";
				txt = document.createTextNode(courses[i+j].id);
				td.appendChild(ip);
				lb.appendChild(txt);
				td.appendChild(lb);
				tr.appendChild(td);
				if(i+j+1 == kli)
					break;
			}
			tb.appendChild(tr);
		}
	}
	function drawBranches(data){
		var obj = JSON.parse(data);
		var kli = obj.branches.length;
		var tb = document.getElementById("branchchecktable");
		if(kli>0){
			for(i=0;i<kli;i+=3){
				tr = document.createElement("TR");
				for(j=0;j<3;j++){
					ip = document.createElement("INPUT");
					lb = document.createElement("LABEL");
					ip.type = "checkbox";
					ip.name = "branches[]";
					ip.value = obj.branches[i+j].id;
					ip.id = obj.branches[i+j].id;
					lb.htmlFor = ip.id;
					td = document.createElement("TD");
					td.style.textAlign = "center";
					txt = document.createTextNode(obj.branches[i+j].name);
					td.appendChild(ip);
					lb.appendChild(txt);
					td.appendChild(lb);
					tr.appendChild(td);
					if(i+j+1 == kli)
						break;
				}
				tb.appendChild(tr);
			}
			if(kli>1){
				tr = document.createElement("TR");
				ip = document.createElement("INPUT");
				lb = document.createElement("LABEL");
				ip.type = "checkbox";
				ip.name = "branches[]";
				ip.value = 'all';
				ip.id = 'allb';
				lb.htmlFor = ip.id;
				td = document.createElement("TD");
				td.colSpan = "3";
				td.style.textAlign = "center";
				txt = document.createTextNode('All');
				td.appendChild(ip);
				lb.appendChild(txt);
				td.appendChild(lb);
				tr.appendChild(td);
				tb.appendChild(tr);
			}
		}
		else if(kli == 0){
			tr = document.createElement("TR");
			td = document.createElement("TD");
			td.colSpan = "3";
			td.style.textAlign = "center";
			txt = document.createTextNode("No Branches Found");
			td.appendChild(txt);
			tr.appendChild(td);
			tb.appendChild(tr);
		}
	}
	function drawYear(cour){
		var name = new Array();
		name[0] = "First";
		name[1] = "Second";
		name[2] = "Third";
		name[3] = "Fourth";
		name[4] = "Fifth";
		for(i=0;i<courses.length;i++){
			if(courses[i].id == cour)
			break;
		}
		tb = document.getElementById('yearchecktable');
		tr = document.createElement("TR");
		var yr = parseInt(courses[i].years)/2;
		for(i=0;i<yr;i++){
			ip = document.createElement("INPUT");
			lb = document.createElement("LABEL");
			ip.type = "checkbox";
			ip.name = "years[]";
			ip.value = i+1;
			ip.id = i;
			lb.htmlFor = ip.id;
			td = document.createElement("TD");
			td.style.textAlign = "center";
			txt = document.createTextNode(name[i]);
			td.appendChild(ip);
			lb.appendChild(txt);
			td.appendChild(lb);
			tr.appendChild(td);
		}
		tb.appendChild(tr);
		if(yr>1){
			tr = document.createElement("TR");
			ip = document.createElement("INPUT");
			lb = document.createElement("LABEL");
			ip.type = "checkbox";
			ip.name = "years[]";
			ip.value = 'all';
			ip.id = 'ally';
			lb.htmlFor = ip.id;
			td = document.createElement("TD");
			td.colSpan = "3";
			td.style.textAlign = "center";
			txt = document.createTextNode('All');
			td.appendChild(ip);
			lb.appendChild(txt);
			td.appendChild(lb);
			tr.appendChild(td);
			tb.appendChild(tr);
		}
	}
	
	
	$(document).ready(function(){
		var coursedeftb = document.getElementById("coursechecktable").innerHTML;
		var branchdeftb = document.getElementById("branchchecktable").innerHTML;
		var yeardeftb = document.getElementById("yearchecktable").innerHTML;
		$("input[name='allorfew']").change(function(){
			switch(this.value){
				case 'all':
					$("#fewcourse").hide();
					$("#fewbranch").hide();
					$("#fewyear").hide();
					$("#selectby").hide();
				break;
				case 'few':
					$("#fewcourse").hide();
					$("#fewbranch").hide();
					$("#selectby").show();
					$("input[name=selectby]").change(function(){
						switch(this.value){
							case 'course':
								document.getElementById("coursechecktable").innerHTML = coursedeftb;
								drawcourses('many');
								$("#fewcourse").show();
							break;
							case 'coursebranch':
								document.getElementById("coursechecktable").innerHTML = coursedeftb;
								drawcourses('one');
								$("#fewcourse").show();
								$("input[name=courses]").change(function(){
									var cour = this.value;
									$.post("post_support.php",{course:this.value},function(data){
										document.getElementById("branchchecktable").innerHTML = branchdeftb;
										drawBranches(data);
										var yearshow = JSON.parse(data).branches.length;
										if (yearshow){
											document.getElementById("yearchecktable").innerHTML = yeardeftb;
											drawYear(cour);
											$("#fewyear").show();
										}
										$("#fewbranch").show();
									});
								});
							break;
						}
					});
				break;
			}
		});
	});
	</script>
<?php
	if(isset($_GET['success']))
	drawNotification("Successful Post", "For more posts, bang on!", "success");
?>
<form method="post" action="post_support.php">
	<table width='90%' style="margin-left:50px;">
	<tr>
		<td style="visibility:hidden;" colspan="1"></td>
		<td colspan="2">
			<input style="width:97%; margin:0; text-align:center;" type="text" name="heading" placeholder="heading" autocomplete="off"/>
		</td>
		<td style="visibility:hidden;" colspan="1" width="25%"></td>
	</tr>
	<tr>
		<th colspan="4" style="font-family:courier new; font-size:1.4em;">Content</th>
	</tr>
	<tr>
		<td colspan="4">
			<textarea rows="10" cols="70" style="width:98%" name="content">
				Far over the misty mountains cold, to dungeons deep to caverns old, we must away er break of day to find our long forgotten gold.
			</textarea>
		</td>
	</tr>
	<tr>
		<th width="25%">Send to:</th>
		<td colspan="3" style="text-align:center;">
			<label for="allornot">All</label>
			<input id="allornot" type="radio" name="allorfew" value="all" checked/>
			<label style="margin-left:30%" for="fewornot">Selective</label>
			<input id="fewornot" type="radio" name="allorfew" value="few"/>
		</td>
	</tr>
	<tr id="selectby" style="display:none;">
		<td style="visibility:hidden;"></td>
		<td colspan="3" style="text-align:center;">
			<label for="bycourse">By Course</label>
			<input id="bycourse" type="radio" name="selectby" value="course"/>
			<label style="margin-left:30%;" for="bycourbran">By Course-Branch</label>
			<input id="bycourbran" type="radio" name="selectby" value="coursebranch"/>
		</td>
	</tr>
	<tr id="fewcourse" style="display:none">
		<td style="visibility:hidden;"></td>
		<td colspan="3">
			<table id="coursechecktable" width="95%" style="background-color:#eee;" nozebra>
				<tr>
					<td colspan="4" style="text-align:center;">Choose Course(s)</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr id="fewbranch" style="display:none;">
		<td style="visibility:hidden;"></td>
		<td colspan="3">
			<table id="branchchecktable" width="95%">
				<tr>
					<td colspan = "4" style="text-align:center;">Choose Branch(es)</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr id="fewyear" style="display:none;">
		<td colspan="1" style="visibility:hidden;"></td>
		<td colspan="3">
			<table id="yearchecktable" width="95%" style="background-color:#eee;">
				<tr>
					<td colspan="4" style="text-align:center;">Choose Year(s)</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="background-color:transparent;">
		<td colspan="1"><input type="submit" value="submit"/></td>
	</tr>
	</table>
</form>
<p id="det">
</p>
<?php
	drawFooter();
?>