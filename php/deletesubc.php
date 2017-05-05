<?php
    include_once('dbConnection.php');
    
    ob_start();
        session_start();
        
         if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])){
            header("Location: php/error.php");
        }
        
	$cid =  $_GET['id'];

    global $connection ;

    $query = "DELETE FROM subcategory WHERE id='$cid'";

    mysqli_query($connection, $query);

    header('Location: '. $_SERVER['HTTP_REFERER']);
?>