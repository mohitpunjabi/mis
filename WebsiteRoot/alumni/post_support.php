<?php
	require_once("../Includes/Auth.php");
	auth();
	if(isset($_POST['course']))
	{
		if($res = $mysqli->query("SELECT DISTINCT course_id, branch_id, br.name AS branch_name
										FROM course_branch AS a INNER JOIN courses AS b INNER JOIN branches AS br
										WHERE a.course_id = b.id AND a.branch_id = br.id
												AND a.year >= ((YEAR(NOW()) - (MONTH(NOW())<7)) + 1 - (duration/2))
												AND a.course_id = '".$_POST['course']."'"))
		{
			echo '{"branches" : [';
			$row = $res->fetch_assoc();
			if($row){
				echo '{"id" : "'.$row["branch_id"].'", "name" : "'.$row["branch_name"].'"}';
				while($row = $res->fetch_assoc()){
					echo ',{"id" : "'.$row["branch_id"].'", "name" : "'.$row["branch_name"].'"}';
				}
			}
			echo ']}';
		}
		else
			echo "Problem encountered".$mysqli->error;
	}
	else if(isset($_POST['allorfew'])){
		
		$post_id = md5($_SESSION['id'].''.time());
		$heading = strclean($_POST['heading'].' isHeading');
		$content = strclean($_POST['content']);
		$posttime = time();
		switch($_POST['allorfew']){
			case 'all':
				if(!($res = $mysqli->query("INSERT INTO alu_post_rec VALUES ('".$post_id."', 'all', 'all', 'all')")))
					echo 'Problem occured'.$mysqli->error;
			break;
			case 'few':
				$courses = $_POST['courses'];
				if(is_array($_POST['courses'])){
					foreach($courses as $coursevalue){
						if(!($res = $mysqli->query("INSERT INTO alu_post_rec VALUES ('".$post_id."', '".$coursevalue."', 'all', 'all')")))
							echo 'Problem Encountered: '.$mysqli->error;
					}
				}
				else{
					$branches = $_POST['branches'];
					$years = $_POST['years'];
					if(in_array('all', $branches))
						$branches = array('all');
					if(in_array('all', $years))
						$years = array('all');
					var_dump($branches);
					var_dump($years);
					foreach($branches as $branchval){
						foreach($years as $yearval){
							if(!($res = $mysqli->query("INSERT INTO alu_post_rec VALUES ('".$post_id."', '".$courses."', '".$branchval."', '".$yearval."')")))
								echo 'Problem encountered'.$mysqli->error;
						}
					}
				}
			break;
		}
		if(!($res = $mysqli->query("INSERT INTO alu_post (post_id, sender_id, heading, content)
									VALUES ('".$post_id."', '".$_SESSION['id']."', '".$heading."', '".$content."')")))
			echo 'Problem occured'.$mysqli->error;
		else
			header("Location: post.php?success=1");
	}
?>