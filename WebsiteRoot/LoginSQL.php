<?php
	session_start();
	//error_reporting('E_ALL'); ini_set('display_errors', 'On'); 
	//Include database connection details
	require_once('Includes/ConfigSQL.php');
	//('AccountFunctions.php');	
	//Array to store validation error
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}

	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$username = clean($_POST['username']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($username == '') {
		$errmsg_arr = 'Username missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		//die($_SESSION['ERRMSG_ARR']);
		session_destroy();
		header("location: Login.php?error=".$errmsg_arr);
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM feedback_users INNER JOIN feedback_authtypes WHERE username='".$username."' AND feedback_users.auth_id = feedback_authtypes.auth_id";
	//echo $qry;
	//die();
	$result=mysql_query($qry);
	
	/*$qry="SELECT COUNT(*) c FROM feedback_users WHERE auth_id = 'ST' ";
	$result=mysql_query($qry);
	
	$qry="SELECT COUNT(*) c FROM feedback_users WHERE auth_id = 'ST' ";
	$result=mysql_query($qry);
	$t = mysql_fetch_array($result);*/
	//die ($t['c']);
	//die( mysql_error($result));
	
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) >= 1) 
		{
			//Login Successful
			session_regenerate_id();
			$user = mysql_fetch_assoc($result);
			$_SESSION['SESS_USERNAME'] = $user['username'];
			$_SESSION['SESS_AUTH'] = $user['auth_id'];
			$_SESSION['SESS_AUTHFULL'] = $user['auth_type'];
			$_SESSION['SESS_LASTLOGIN'] = $user['last_login'];
            //die( $_SESSION['SESS_AUTH']);
            if($_SESSION['SESS_AUTH']=='TE')
            {
                $_SESSION['SESS_TEST']='TRUE';
                $_SESSION['SESS_AUTH']='ST';
                $_SESSION['SESS_DEPT']='--';
            }
            
			$date = strtotime((string)$user['created_date']);
			//echo $date; 
			//die($date);
			$year = date('Y',$date);
			$salt = 'ISM';
			//die($year);
			//echo $year;
			
			//$tempHash = $user['password'].(string)$date.(string)$salt;
			//	echo $tempHash."<br />";
			$tempHash = $password.(string)$date.(string)$salt;
			//die($tempHash);
			for($i=0;$i<$year;$i++)
			{
				$tempHash = md5($tempHash);
			}
			//die($tempHash."==".$user['password']);
			//Chiranjeev - Line to not make all passwords work if(!($tempHash == $user['password']))
			if(($tempHash == $user['password']) && false)
				{
				$_SESSION['ERRMSG_ARR'] = "Wrong Password";	
				//echo $tempHash.' '.$user['password'];				
				session_destroy();
				header("location: Login.php?error="."Wrong Password");
				exit;
				}
			else
				{
					//echo $_SESSION['SESS_AUTH'];
					//echo 'Success : Username and Passwords match ';
					switch($_SESSION['SESS_AUTH'])
					{
						case 'DS' :
						case 'FT' :
						case 'FA' :
						//Added by Shubham
						case 'TF' :
						case 'TA' :
						case 'HD' :
						case 'PA' :
						//Till here
						case 'DO' :
						case 'AD' : $qry2 = "SELECT * FROM feedback_users INNER JOIN feedback_faculty ON username = emp_id WHERE username = '".$_SESSION['SESS_USERNAME']."'";
									break;
						case 'ST' : $qry2 = "SELECT a.email email,a.branch_id branch_id,a.course_id course_id,a.first_name first_name,a.last_name last_name,b.semester semester,b.gpa gpa,c.noofsemesters noofsemesters,a.photopath photopath FROM feedback_studentpersonal a INNER JOIN feedback_studentacademic b ON a.admn_no = b.admn_no INNER JOIN feedback_course c ON (c.course_id=a.course_id) WHERE a.admn_no = '".$_SESSION['SESS_USERNAME']."' ";
									break;
					}
				
			
			//$qry2 = "SELECT * FROM feedback_users INNER JOIN ".$table." ON username = emp_id WHERE username = '".$_SESSION['SESS_USERNAME']."'";
			//$qry2="SELECT * FROM ".$_SESSION['SESS_AUTH']." WHERE `index`='".$_SESSION['SESS_USERNAME']."'";
			//echo $qry2;
			$result2=mysql_query($qry2);
			//die(mysql_error($qry2));
			if($result2) {
				$user2 = mysql_fetch_assoc($result2);
				switch($_SESSION['SESS_AUTH'])
					{
						case 'TA' :
						case 'FA' : $q = "SELECT a.branch_id branch_id,a.course_id course_id,a.semester semester,c.noofsemesters noofsemesters FROM feedback_users INNER JOIN feedback_facultyadvisor a ON(feedback_users.username = a.emp_id) INNER JOIN feedback_course c on (a.course_id=c.course_id) WHERE feedback_users.username = '".$_SESSION['SESS_USERNAME']."' ";
						//die($q);
									$r = mysql_query($q);
									if(!$r)
                                    {
                                        echo "Error : Getting Faculty Advisor Details";
                                    }
                                    else
                                    {
                                        $u = mysql_fetch_array($r);
									    $_SESSION['SESS_BRANCH']=$u['branch_id'];
									    $_SESSION['SESS_COURSE']=$u['course_id'];
									    $_SESSION['SESS_SEMESTER']=$u['semester'];
									    //die($_SESSION['SESS_BRANCH'].$_SESSION['SESS_COURSE'].$_SESSION['SESS_SEMESTER']);
									    if(($u['semester']*1)==($u['noofsemesters']*1))
									    {
										    $_SESSION['SESS_EXITFEEDBACK']=1;
										
									    }
									    else
										    $_SESSION['SESS_EXITFEEDBACK']=0;
                                    }
						case 'TF' : 
						case 'HD' :
						case 'FT' :
						case 'DS' :
						case 'DO' :
						case 'PA' :
						case 'AD' : $_SESSION['SESS_NAME'] = $user2['salutation'].' '.$user2['first_name'].' '.$user2['last_name'];
									$_SESSION['SESS_DESIGN'] = $user2['design'];
									$_SESSION['SESS_DEPT'] = $user2['dept_id'];
									//echo $_SESSION['SESS_NAME']." ".$_SESSION['SESS_DESIGN']." ".$_SESSION['SESS_DEPT'];
									
									break;
						case 'ST' : $_SESSION['SESS_NAME'] = $user2['first_name'].' '.$user2['last_name'];
									//$_SESSION['SESS_GPA'] = $user2['gpa'];
									$_SESSION['SESS_DESIGN'] = "N/A";
									$_SESSION['SESS_BRANCH'] = $user2['branch_id'];
									$_SESSION['SESS_COURSE'] = $user2['course_id'];
									$_SESSION['SESS_GPA'] = $user2['gpa'];
									$_SESSION['SESS_SEMESTER'] = $user2['semester'];
									$_SESSION['SESS_COMMENT'] = array();
									//Added by Shubham
									$q = "SELECT * FROM feedback_course WHERE feedback_course.course_id = '".$_SESSION['SESS_COURSE']."' ";
									$r = mysql_query($q);
									$u = mysql_fetch_array($r);
									if($u['noOfSemesters']-$_SESSION['SESS_SEMESTER']<=3)
									{
										$_SESSION['SESS_PLACEMENT'] = 1;
									}
									else
									{
										$_SESSION['SESS_PLACEMENT'] = 0;
									}
									//$_SESSION['SESS_PLACEMENT'] = 1;
									
                                    $q = "SELECT COUNT(*) c FROM feedback_subjectdetails WHERE branch_id = '".$_SESSION['SESS_BRANCH']."' AND course_id = '".$_SESSION['SESS_COURSE']."' AND semester = ".$_SESSION['SESS_SEMESTER'];
									$q2="SELECT noofsemesters FROM feedback_course WHERE course_id='".$_SESSION['SESS_COURSE']."'";
                                    //die($q."<br />".var_dump($user2));
									//echo $q."<br />";
                                    $r = mysql_query($q);
                                    if(!$r)
                                    {
                                        echo "Error : Getting Student Details";
                                    }
                                    else
                                    {
                                        $u = mysql_fetch_array($r);
										//var_dump($u);
										//die();
                                        if(($u['c']*1)>0)
                                        {
                                            $_SESSION['SESS_SEMFEEDBACK']=1;
                                            
                                        }
                                        else
                                            $_SESSION['SESS_SEMFEEDBACK']=0;
										
										$r2 = mysql_query($q2);
                                        $u2 = mysql_fetch_array($r2);
										//var_dump($u);
										//echo '<br />';
										//var_dump($u2);
										//echo '<br />'.($_SESSION['SESS_SEMESTER']*1).'=='.($u2['noofsemesters']*1).'<br />';
                                        if(($_SESSION['SESS_SEMESTER']*1)==($u2['noofsemesters']*1))
									    {
											//echo 'true';
										    $_SESSION['SESS_EXITFEEDBACK']=1;
                                            
									    }
									    else
										{
											//echo 'false';
										    $_SESSION['SESS_EXITFEEDBACK']=0;
										}
											//var_dump($_SESSION);
                                    }
                                        
                                    $q = "SELECT fb_".$_SESSION['SESS_SEMESTER']." sem,fb_exit ex FROM feedback_studentfeedback WHERE admn_no = '".$_SESSION['SESS_USERNAME']."'";
                                    //die($q);
                                    $r = mysql_query($q);
                                    if(!$r)
                                    {
                                        echo "Error : Getting Student Details - Feedback Submission status : ".$q;
                                        die();
                                    }
                                    else
                                    {
                                        $u = mysql_fetch_array($r);
                                        if($u['sem']==0)
                                        {
                                            $_SESSION['SESS_SEMFEEDBACKSUBMITTED']=0;
                                            
                                        }
                                        else
                                            $_SESSION['SESS_SEMFEEDBACKSUBMITTED']=1;
                                        
                                        if($u['ex']==1)
									    {
										    $_SESSION['SESS_EXITFEEDBACKSUBMITTED']=1;
                                            
									    }
									    else
										    $_SESSION['SESS_EXITFEEDBACKSUBMITTED']=0;
                                    }
									break;
					}
					$_SESSION['SESS_EMAIL'] = $user2['email'];
					$_SESSION['SESS_PHOTOPATH'] = $user2['photopath'];
					//var_dump($_SESSION);
					//die();
				
				//echo $_SESSION['SESS_NAME'];	
				$qry3="UPDATE feedback_users SET  `last_login` =  CURRENT_TIMESTAMP WHERE  `username`='".$_SESSION['SESS_USERNAME']."'";
				$result3=mysql_query($qry3);
				if(!$result3)
				{
					die("Updating Last login time for current user failed : ".$result3);
				}			
			}//if(result2)
			
		
			
			else {
			die("Retriving personal details failed : ".$result2);			
			}
//			echo 'redirecting to AccountFunctions';	
			session_write_close();
			header("location: AccountFunctions.php");
//			echo 'hello';
			}//else-- passwords match
			//echo 'Username found';
		}//username found
		
		else 
		{
			//echo 'Login failed';
			$_SESSION['ERRMSG_ARR'] = 'Username not found ';
			session_destroy();
			header("location: Login.php?error=".'Username not found');
			exit();
		}
	}else {
		die("Query failed New: ".mysql_errno()."".$qry.DB_DATABASE);
	}
?>