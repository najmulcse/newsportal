
<?php
  include "php/dbConnection.php";
  include "php/allFunctions.php";

 ob_start();
 session_start();

if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])){
            header("Location: index.php");
    }  

if(isset($_POST['update_article']))
   {
      $tableName=$_POST['tableName'];
      $id=$_POST['contentid'];
      $title=$_POST['title'];
      $article=$_POST['article'];

      $article = nl2br(htmlentities($article, ENT_QUOTES, 'UTF-8'));
      $title = htmlentities($title, ENT_QUOTES, 'UTF-8');
      
      $filetmp = "";
      $filename = "";
      $filepath = "";

      $filetmp = $_FILES["image"]["tmp_name"];
      $filename = $_FILES["image"]["name"];
      // $filetmp = mysqli_real_escape_string($connection,$filetmp);
      

      if(!empty($filename)){

      $count=checkCountImage();
      $filepath = "images/article/".$count.$filename;  

      }
      

           $message = null;
           

       $r = updateArticle($id, $title, $filepath, $filetmp, $article,$tableName);

      if($r){

        $message = "Updated Successfully !!";
       

    }
        else{

            $message = "Something wrong!!! Please try again!!";
      }

   }




if(isset($_GET['aid']) && isset($_GET['name'])){

  

     $id=$_GET['aid'];
     $name=$_GET['name'];
     $contents = getArticleExtra($id,$name); 

	
		while($row=mysqli_fetch_assoc($contents))
		{
			$head=$row['head'];
      $body=$row['body'];
      $created_date=$row['createdat'];
      $image=$row['link'];
    
		}


}



 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SWOTTA - A Community News Portal</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script type="text/javascript" src="assets/js/jquery-min.js"></script> 
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="assets/js/selectnav.min.js"></script>
<script type="text/javascript" src="assets/js/myJs.js"></script>


<link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/font/font.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/myStyle.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />



<script type="text/javascript">
   function selectsubc(id){

    var xmlhttp;
    
     
           if (window.XMLHttpRequest){

                                  xmlhttp = new XMLHttpRequest();

                                  }

                                   else{ 
                                     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                  }

                               xmlhttp.onreadystatechange = function(){
                                 
                                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        document.getElementById("subcategory").innerHTML = xmlhttp.responseText;
                                    }

                               }

                              xmlhttp.open("GET", "subcategoryajax.php?q=" + id, true);
                              xmlhttp.send();
                            
                    return; 
   }

   $(function(){

    $("#imgInp").change(function(event){
         var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#previewimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));

    });
});

 
</script>

 
</head>

<body>


<div class="body_wrapper">
  <div class="center">

    <div class="header_area">
      <div class="logo floatleft"><a href="#"><img src="images/logo12.png" alt="" /></a></div>
       <br>
       <br>
       <br>
       <br>
      <span class="top_menu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact us</a></li>
          <li><a href="#">Subscribe</a></li>
            <?php 
          if(isset($_SESSION['email'])){
                $email=$_SESSION['email'];

                if(isset($_SESSION['admin'])){
                  print('<li><a href="admin.php">Admin</a></li>');
                }
                 
                  print('<li><a href="logout.php">Logout</a></li>');
                 

              }

               else { 
                print('<li><a href="login.php">Login</a></li>');
             }

        ?>
        </ul>
      </span>
   </div>
          
           
          
      <section>
        
                  
           
                    <!--Content pane -->
                   <div role="tabpanel" class="tab-pane" id="content">
                   <div style="border-top: 5px dashed black"></div>
                   <div  >
                    

                    <?php 

                       if(isset($message)){

                        printf('<div class="alert alert-info">%s</div>', $message);

                       }

                    ?>
                  </div>

                              <div class="row">  

                               <div class="col-md-7">
                                  <div class="panel panel-info">
                                      <div class="panel-heading">
                                          <span class="contactHead"><h2 class="active">Edit Contents </h2></span>
                                            
                                      </div>
                                      
                                      <div class="panel-body">
                                          <?php 
                                          printf('<form action="extraContentsDetails.php?aid=%s&name=%s" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">',$id,$name);
                                          ?>
                                                
                                          <div class="form-group">
                                              <label for="inputEmail3" class="col-sm-3 control-label">Image</label>
                                              <div class="col-sm-9">
                                                <input type="file" accept=".jpg,.png,.gif" class="form-control" id="imgInp" value="<?php  echo $image ;?>" name="image" >

                                              </div>
                                        </div>
                                        <div class="form-group">
                                              <label for="title" class="col-sm-3 control-label">Article Title</label>
                                              <div class="col-sm-9">
                                                <input type="text" name="title" class="form-control" required value='<?php echo $head ; ?>'>
                                              </div>
                                        </div>
                                        <div class="form-group">
                                              <label for="inputEmail3" class="col-sm-3 control-label">Article</label>
                                              <div class="col-sm-9">
                                                <textarea  name="article" type="text" class="form-control" id="inputtext"  rows="8" required><?php echo  $body ; ?></textarea>
                                              </div>
                                        </div>
                                         <div class="form-group">
                                              <div class="col-sm-3"></div>
                                              <div class="col-sm-9">
                                                  <button  type="submit" class="btn btn-success form-control" name="update_article">Update Content</button>
                                              </div>
                                        </div>
                                         <input type="hidden" name="contentid" value="<?php echo $id ;?>">
                                          <input type="hidden" name="tableName" value="<?php echo $name ;?>">
                                       </form>
                                      </div>
                                   
                                                 

                                  </div>
                                                                               
                              </div>

                              <div class="col-md-5">
                                   <!--Image Preview-->
                                    <div class="panel panel-default">

                                        <div class="panel-heading">
                                           <h2>Image Preview</h2>
                                        </div>


                                        <div class="panel-body" id="imprev">
                                            
                                            <div style="min-width: 100%; min-height: 450px;">
                                                  <img src='<?php echo $image ;?>' id="previewimage" style="min-width: 100%; min-height: 300px; max-height: 300px;">
                                             </div>

                                        </div>
                                     
                                   </div>
                                   <!--End image preview--> 
                                   
                               </div>

</div>
</div>
 
        </div>

           
      </section>

     </div>
  </div>

<script type="text/javascript">
  
selectnav('nav', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
selectnav('f_menu', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
$('.bxslider').bxSlider({
    mode: 'fade',
    captions: true
});
</script>
</body>
</html>