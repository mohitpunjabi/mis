<?php
		require_once("../Includes/Auth.php");
		auth('deo','stu');
		require_once("connectDB.php");

		if(isset($_GET['t']))
		{
			if($_GET['t']=='ug')	
			{
				$qry=mysql_query("select id,name from departments where type='academic'");
				while($roww=mysql_fetch_row($qry))
				{
					?>
                     <option value= "<?php echo $roww[0];?>" 
								<?php  if(isset($_SESSION['EDIT_DEPT'])	&& $_SESSION['EDIT_DEPT']==$roww[0])echo 'selected="selected"';?> >
								<?php echo $roww[1];?>
								</option>;
						<?php
                }
			}
			if($_GET['t']=='pg')
	       	{
				$qry=mysql_query("select id,name from departments");
				while($roww=mysql_fetch_row($qry))
				{
					?>
              		<option value= "<?php echo $roww[0];?>"
								<?php  if(isset($_SESSION['EDIT_DEPT'])	&& $_SESSION['EDIT_DEPT']==$roww[0])echo 'selected="selected"';?> >
								<?php echo $roww[1];?>
								</option>;
					<?php
				}
			}
			if($_GET['t']=='jrf')	
			{
				$qry=mysql_query("select id,name from departments where type='nonacademic'");
				while($roww=mysql_fetch_row($qry))
				{
					?>
                     <option value= "<?php echo $roww[0];?>" 
								<?php  if(isset($_SESSION['EDIT_DEPT'])	&& $_SESSION['EDIT_DEPT']==$roww[0])echo 'selected="selected"';?> >
								<?php echo $roww[1];?>
								</option>;
					<?php
                }
			}
		}
		mysql_close();
?>
