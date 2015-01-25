<?php
	if($branches === FALSE)
        echo '<option value="none" disabled="disabled">No department found</option>';
    else
        foreach($branches as $row)
        {
            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
?>