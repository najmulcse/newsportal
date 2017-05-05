<?php
include_once('php/allFunctions.php');



if(isset($_POST['advertisement']))
   {
    	 
    	$description = $_POST['adddescription'];
    	 
    	$description = nl2br(htmlentities($description, ENT_QUOTES, 'UTF-8'));
    	
      $filetmp = $_FILES["advertisementimage"]["tmp_name"];
      $filename = $_FILES["advertisementimage"]["name"];

      $filepath = "";
      if(!empty($filename)){
      $count=checkCountImage();

      $filepath = "images/add/".$count.$filename;  
      }
      

           $message = null;

      $r = addImageforAdd($description, $filepath, $filetmp);
      if($r){
        $message= "Add Saved Successfully !!";
    }
        else{

      			$message = "Something wrong!!! Please try again!!";
      }
   }

    else{
    header('Location: php/error.php');
   }


?>

<!DOCTYPE html>
<html>
<head>
  <title>Message | SWOTTA - A Community News Portal</title>


  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
</head>
<body>

  <div class="container">
        <center>
              <div class="jumbotron" >
                <?php 
                                 $back = $_SERVER['HTTP_REFERER'];

                  if(isset($message)){
                    printf('<div><strong class="alert alert-info">%s</strong></div>', $message);
                  }

                  printf('<div> 
                          <center>
                            <a class="btn btn-primary" href="%s">Back</a>
                          </center>
                    </div>', $back);

                ?>

              </div>

        </center>
  </div>

</body>
</html>