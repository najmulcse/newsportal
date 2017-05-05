<?php 

//$connection=mysqli_connect('localhost','devel503_swotta','@%&mU0?T+C1?','devel503_swotta');//Server
$connection=mysqli_connect('localhost','root','','swottanews'); //Localhost



if(!$connection)
{
echo "Database connection Failed ". mysqli_connect_error();
}

?>