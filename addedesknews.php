<?php
include_once('php/allFunctions.php');

if(isset($_POST['adddesknews']))
   {
    	$title = $_POST['deskhead'];
    	$body = $_POST['deskbody'];
    	 
    	$desknews = nl2br(htmlentities($body, ENT_QUOTES, 'UTF-8'));
      $title = htmlentities($title, ENT_QUOTES, 'UTF-8');
    	
      $filetmp = $_FILES["desknewsimage"]["tmp_name"];
      $filename = $_FILES["desknewsimage"]["name"];

      $filepath = "";
      if(!empty($filename)){
      $count=checkCountImage();

      $filepath = "images/desk/".$count.$filename;  
      }
      

           $message = null;

      $r = addDeskNews($title, $desknews,  $filepath, $filetmp);
      if($r){
        $message= "News Saved Successfully !!";
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