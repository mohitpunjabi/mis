<?php
	require_once("../../Includes/Auth.php");
    require_once('../../Includes/ConfigSQL.php');
    require_once('')
   	require_once(SERVER_ROOT.'/../../utils/util_functions.php');
   	auth();
   	// echo vardump($mysqli);
   	function checkStr($str){
   		return true;
   	}
   	class Module {
	   	function getCourses($mysqli) {
	   		$query = "SELECT name, id, duration FROM courses WHERE 1;";
	   		$data = array();
	   		if($rs = $mysqli->query($query)){
	   			if($rs->num_rows){
	   				$rs->data_seek(0);
					while($row = $rs->fetch_assoc()){
					    $data[$row['id']] = array($row['name'], $row['duration']);
					}
	   			} else {
	   				echo 'no course';
	   			}
	   		} else{
	   			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	   		}
	   		// echo "<pre>";var_dump($data);echo "</pre>";
	   		echo json_encode($data);
	   	}

		function getBranch($mysqli) {
			$courses = $_POST['courses'];
			// echo vardump($courses);
			// return;
			$course = '(';
			foreach ($courses as $course_id) {
				$course .= "'$course_id', ";
			}
			$course = substr_replace($course, ')', -2);
	   		$query = "SELECT DISTINCT name, id FROM branches INNER JOIN course_branch ON branches.id=course_branch.branch_id WHERE course_id IN ".$course;
	   		// echo $query;
	   		// return;
	   		$data = array();
	   		if($rs = $mysqli->query($query)){
	   			if($rs->num_rows){
	   				$rs->data_seek(0);

					while($row = $rs->fetch_assoc()){
					    array_push($data, array($row['id'], $row['name']));
					}
	   			} else {
	   				echo json_encode(NULL);
	   			}
	   		} else{
	   			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	   		}
	   		echo json_encode($data);
	   	}
		function insertMessage(){
			// echo "insertMessage()";
			if(isset($_GET['msg_type'])){
				if($_GET['msg_type']=='bl'){
					if(isset($_GET['course'], $_GET['branch'], $_GET['sem'])){
						$error = 0;
						if(!checkStr($_GET['course']))
							$error = $error or 1;

						if(!checkStr($_GET['branch']))
							$error = $error or 2;

						if(!checkStr($_GET['sem']))
							$error = $error or 4;

						if(!$error){
							$course = $_GET['course'];
							$branch = $_GET['branch'];
							$sem = $_GET['sem'];
							echo vardump_block($branch);
							echo vardump_block($course.$sem);
							$branch = bindec($branch);
							$course_sem = bindec($course.$sem);
							$data['branch'] = decbin($branch);
							$data['course_sem'] = decbin($course_sem);
							$message = $_GET['msg'];
							$data['content'] = $message;
							$data['flag'] = 0;
							$data['sender_id'] = $_SESSION['SESS_USERNAME'];
							$data['sender_name'] = $_SESSION['SESS_NAME'];
							$data['msg_id'] = md5(time());
							echo vardump($data);
						} else {
							echo 'Error in data';
						}
					} else {
						echo 'Insufficient data.';
					}


				} else if($_GET['msg_type']=='sl'){
					echo 'Selective messages not implemented.';
				}
			} else{
				echo 'Type of message not specified.';
			}
		}
		function searchPeople($mysqli){
			if(!isset($_POST['parstring']))
				$_POST['parstring'] = $_GET['keyword'];
			$query="SELECT id, CONCAT(IFNULL(salutation, ''), ' ',IFNULL(name, '')) as name FROM (SELECT id, salutation, CONCAT(IFNULL(first_name, ''), ' ',IFNULL(middle_name, ''), ' ',IFNULL(last_name, '')) AS name FROM user_details where 1)  as u WHERE u.name LIKE '%".$_POST['parstring']."%'";
			//echo vardump($query);
			$data = array();
			if($rs = $mysqli->query($query)){
	   			if($rs->num_rows){
	   				$rs->data_seek(0);

					while($row = $rs->fetch_assoc()){
					    $data[$row['id']] = $row['name'];
					}
	   			} else {
	   				// echo 'no data';
	   			}
	   		} else{
	   			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	   		}
	   		echo json_encode($data);
		}
		function insertMsg($mysqli){
			$names = json_decode($_POST['names']);
			echo vardump($names);
		}
	}
	$module = new Module();
	if(isset($_GET['a'])){
		if(method_exists($module, $_GET['a'])){
				$module->$_GET['a']($mysqli);
		}
	}

?>