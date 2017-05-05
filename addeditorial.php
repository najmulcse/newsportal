<?php
include_once('php/allFunctions.php');

if(isset($_POST['addeditorial']))
   {
    	$title = $_POST['editorialhead'];
    	$body = $_POST['editorialbody'];
    	 
    	$editorial = nl2br(htmlentities($body, ENT_QUOTES, 'UTF-8'));
      $title = htmlentities($title, ENT_QUOTES, 'UTF-8');
    	
      $filetmp = $_FILES["editorialimage"]["tmp_name"];
      $filename = $_FILES["editorialimage"]["name"];

      $filepath = "";
      if(!empty($filename)){
      $count=checkCountImage();

      $filepath = "images/editorial/".$count.$filename;  
      }
      

           $message = null;

      $r = addNewEditorial($title, $editorial,  $filepath, $filetmp);
      if($r){
        $message= "Article Saved Successfully !!";
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