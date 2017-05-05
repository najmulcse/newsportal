<?php

$name = $_REQUEST['q'];


printf('
	   <span>
	       <input  class="form-control" id="inp%s" type="text" value="%s">
	       <button class="btn btn-success" onclick="saveupdate(\'%s\')">Update</button>
       </span>
	', $name, $name, $name);

?>