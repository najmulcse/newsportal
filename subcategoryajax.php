<?php 
include_once('php/allFunctions.php');

$categoryId = $_REQUEST['q'];

 
 $subcresult = getSubCategory($categoryId); 

        while($data=mysqli_fetch_assoc($subcresult))
        {
          printf('<option value="%s">%s</option>', $data['id'], $data['name']);
        }

?>