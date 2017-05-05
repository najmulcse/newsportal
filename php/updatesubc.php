<?php
include_once('dbConnection.php');

         ob_start();
        session_start();
        
         if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])){
            header("Location: php/error.php");
        }


global $connection;
$old = $_GET['old'];
$new = $_GET['new'];

$query = "UPDATE subcategory  SET name='$new' WHERE name='$old'";

$result = mysqli_query($connection, $query);

if($result)
printf('<span>%s</span>', $new);
else
printf('<span>%s</span>', $old);

?>