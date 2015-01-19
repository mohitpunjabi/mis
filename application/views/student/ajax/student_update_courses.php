<?php

	// Ajax giving department options of a particular type

	if($courses === FALSE)
        echo '<option value="none" disabled="disabled">No department found</option>';
    else
        foreach($courses as $row)
        {
            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
?>