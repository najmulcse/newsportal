
<?php
        include "php/dbConnection.php";
        include "php/allFunctions.php";
        include_once('content.php');

        ob_start();
        session_start();

         if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])){
            header("Location: index.php");
        }  

      if(isset($_POST['signup']))
      {
        $msg = registration();
      }


      $message=null;



 $catresult = getCategory();

 if(isset($_POST['find_content']))
   {
      $category_id=$_POST['category'];
      $subcategory_id=$_POST['subcategory'];
      
       $result = getContents($category_id,$subcategory_id);

      if(!$result){

       $msg= "Not found !!";
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


</script>


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

$(function(){
   $("#articleimageselect").change(function(event){
       var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#articlepreviewimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
   });
});

  $(function(){
     $('#editorialimageselect').change(function(event){

        var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#editorialpreviewimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
     });
  });

  $(function(){
     $('#desknewsimageselect').change(function(event){

        var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#deskpreviewimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
     });
  });

  $(function(){
     $('#galleryimageselect').change(function(event){

        var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#gallerypreviewimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
     });
  });

  $(function(){
     $('#advertisementimageselect').change(function(event){

        var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#advertisementpreviewimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
     });
  });

  $(function(){
     $('#sliderimageselect').change(function(event){

        var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#sliderpreviewimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
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
        
        <div class="panel panel-primary">

            <div class="panel-header">
              <center><h2>Dashboard</h2></center>
              
            </div>

            <div class="panel-body">
              <div class="col-md-6">
                  <form action="editContents.php" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                               <div class="form-group">
                                              <label for="exampleInputEmail1" class="col-sm-3 control-label">Category Name</label>
                                              <div class="col-sm-9">
                                                  <select required name="category" id="category" onchange="selectsubc(this.value)" class="form-control">
                                                      <option>Select Category</option>  
                                                      <?php 
                                                          
                                                          while($data=mysqli_fetch_assoc($catresult))
                                                          {
                                                             printf('
                                                                  <option value="%s">%s</option>
                                                              ', $data['id'], $data['name']);

                                                       } ?>
                                                  </select>
                                              </div>
                                               </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1" class="col-sm-3 control-label">Subcategory Name</label>
                                                  <div class="col-sm-9">
                                                  <select required name="subcategory" id="subcategory" class="form-control">


                                                  </select>
                                                  </div>
                                              </div> 
                                        
                                         <div class="form-group">
                                              <div class="col-sm-3"></div>
                                              <div class="col-sm-9">
                                                  <button  type="submit" class="btn btn-success form-control" name="find_content">Find Contents</button>
                                              </div>
                                        </div>

                                       </form>
              </div>   
              <div class="col-md-6">
                
                <table class="table table-striped">
                <thead>
                <?php 

              if(isset($message)){
                 printf('
                  <div class="alert alert-info">
                      <center>
                        %s
                      </center>
                  </div>

                  ', $message);
              }

              ?>
                    <tr>
                    <th><h2>Contents List</h2></th>
                    <th><h2 class="pull-right">Options</h2></th>
                  </tr>
                </thead>
                <tbody>
              <?php
              if(isset($result)){
                while ($row=mysqli_fetch_assoc($result)) {
                   print("<tr>");
                    printf('<td>
                      <div id="%s">

                        <span>%s</span>

                      </div>
                      </td>', $row['cid'], $row['head']);

                    printf('<td>
                                            <span class="pull-right">
                      <button class="btn btn-primary" onclick="editSubc(\'%s\', \'%s\')">Edit</button>
                      <a type="button" class="btn btn-danger" href="php/deletesubc.php?id=%s">Delete</a></span>
                      </td>',$row['head'],$row['cid'], $row['cid']);
                   print("</tr>");
                }

              }
              ?>
              </tbody>
              </table>
              </div>
           </div>
                           <!--End image preview--> 

                           

           
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