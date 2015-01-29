<div id="print">
<h2><center>Details of all Current Posts</br>Switch to: <a href="<?= base_url()."index.php/guard/manage_post/view/archived"?>">Archived List</a></center></h2>
 <table align="center">
	<tr>
		<th>Post Name</th>
		<th>Shift A</th>
		<th>Shift B</th>
		<th>Shift C</th>
		<th>Total</th>
		<th>Links</th>
		<th style="visibility:hidden";></th>
		<th>Post Name</th>
		<th>Shift A</th>
		<th>Shift B</th>
		<th>Shift C</th>
		<th>Total</th>
		<th>Links</th>
	</tr>
	<?php
	$i=1;
	foreach($details_of_posts as $key => $post) { 
		$total = $post->number_a + $post->number_b + $post->number_c;
		if($i%2 !=0) echo '<tr>';
		echo '
				<td align="center">'.$post->postname.'</td>
				<td align="center">'.$post->number_a.'</td>
				<td align="center">'.$post->number_b.'</td>
				<td align="center">'.$post->number_c.'</td>
				<td align="center">'.$total.'</td>
				<td align="center">';
				?>
					  <a href="<?= base_url()."index.php/guard/manage_post/edit/".$post->post_id ?>" onclick="return confirm('Are you sure you want to edit?')">Edit</a>
					  <br>and</br>
					  <a href="<?= base_url()."index.php/guard/manage_post/remove/".$post->post_id ?>" onclick="return confirm('Are you sure you want to remove?')">Remove</a>
				</td>
			
	<?php
		if($i%2 ==0) echo '</tr>'; else echo '<td style="visibility:hidden";></td>';
		$i=$i+1;
	}
	?>
	</table>
	</div>