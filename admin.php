
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

if(isset($_POST['addadmn'])){
     $name = $_POST['name'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $confirmpass = $_POST['confirmpass'];

     $message = addAdmin($email, $password, $confirmpass, $name);

 }

 if(isset($_POST['changepass'])){
     $old = $_POST['old'];
     $new = $_POST['newpass'];
     $newcof = $_POST['newconfirmpass'];

     $message = changeAdminPass($_SESSION['email'], $old, $new, $newcof);
 }


 $catresult = getCategory();

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

   function deleteContentExtra(id, name, sid){
      var xmlhttp;
    
       
          if (window.XMLHttpRequest){

                                  xmlhttp = new XMLHttpRequest();

                                  }

                                   else{ 
                                     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                  }

                               xmlhttp.onreadystatechange = function(){
                                 
                                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        document.getElementById('cBody').innerHTML = xmlhttp.responseText;
                                    }

                               }

                              xmlhttp.open("GET", "deleteExtra.php?id="+id+"&name="+name+"&sid="+sid, true);
                              xmlhttp.send();
                            
                    return;  
  }

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
            </div>

            <div class="panel-body">
               <div>

                 <!-- Nav tabs -->
                 <ul class="nav nav-tabs" role="tablist">
                   <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab" data-toggle="tab">Category</a></li>
                   <li role="presentation" ><a href="#content" aria-controls="profile" role="tab" data-toggle="tab">Content</a></li>
                   <li role="presentation" ><a href="#article" aria-controls="profile" role="tab" data-toggle="tab">Article</a></li>
                   <li role="presentation" ><a href="#editorial" aria-controls="profile" role="tab" data-toggle="tab">Editorial</a></li>
                   <li role="presentation" ><a href="#desk" aria-controls="profile" role="tab" data-toggle="tab">News Desk</a></li>
                   <li role="presentation" ><a href="#gallery" aria-controls="profile" role="tab" data-toggle="tab">Gallery</a></li>
                   <li role="presentation" ><a href="#advertisement" aria-controls="profile" role="tab" data-toggle="tab">Add</a></li>

                    <li role="presentation" ><a href="#slider" aria-controls="profile" role="tab" data-toggle="tab">Slider</a></li>
                   

                   <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>

                   
                 </ul>

                 <!-- Tab panes -->
                 <div class="tab-content">




                    <!-- Category panes -->
                   <div role="tabpanel" class="tab-pane fade-in active" id="category">
                                    
                                       <div style="border-top: 5px dashed black"></div>
                                        
                                         
                                             <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                  <span> <h2>All Categories</h2></span>
                                                   
                                                
                                            
                                                </div>

                                                <div class="panel-body" id="pBody">
                                                    <table class="table table-striped">
                                                        <thead>
                                                           <tr>
                                                            <th>Name(Click to Update)</th>

                                                            <th><span pull-right">Subcategories</span></th>
                                                           </tr>
                                                        </thead>
                               

                                                          <tbody id="cBody">

                                                              <?php 

                                                                    getContentBody();
                                                               ?>

                                                          </tbody>

                                                         
                                                    </table>


                                                                
                                                  </div>
                                            </div>


                        <!--Other articles-->

                             
        </div>

             

                                      
                     <!--end other articles-->


                    <!--Content pane -->
                   <div role="tabpanel" class="tab-pane" id="content">
                   <div style="border-top: 5px dashed black"></div>

                              <div class="row">  

                               <div class="col-md-7">
                                  <div class="panel panel-info">
                                      <div class="panel-heading">
                                          <span class="contactHead"><h2 class="active">Add Contents </h2></span>
                                         <!--   <a style="float:right;" href="editContents.php"> <span class="small"> Edit Contents</span></a> -->
                                      </div>
                                      
                                      <div class="panel-body">
                                          <form action="addsubc.php" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
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
                                              <label for="inputEmail3" class="col-sm-3 control-label">Image</label>
                                              <div class="col-sm-9">
                                                <input type="file" accept=".jpg,.png,.gif" class="form-control" id="imgInp"  name="image">

                                              </div>
                                        </div>
                                        <div class="form-group">
                                              <label for="title" class="col-sm-3 control-label">Article Title</label>
                                              <div class="col-sm-9">
                                                <input type="text" name="title" class="form-control" required placeholder="Title">
                                              </div>
                                        </div>
                                        <div class="form-group">
                                              <label for="inputEmail3" class="col-sm-3 control-label">Article</label>
                                              <div class="col-sm-9">
                                                <textarea  name="article" type="text" class="form-control" id="inputtext" placeholder="Write article" rows="8" required> </textarea>
                                              </div>
                                        </div>
                                         <div class="form-group">
                                              <div class="col-sm-3"></div>
                                              <div class="col-sm-9">
                                                  <button  type="submit" class="btn btn-success form-control" name="add_content">Add Content</button>
                                              </div>
                                        </div>

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
                                                  <img src="" id="previewimage" style="min-width: 100%; min-height: 300px; max-height: 300px;">
                                             </div>

                                        </div>
                                     
                                   </div>
                                   <!--End image preview--> 
                                   
                               </div>

                                 
                            </div>
                          
                         
                     
                   

                   </div>
                   <!-- ENd of content pane -->
                    

                    <!--Article pane started-->
                    <div role="tabpanel" class="tab-pane" id="article">
                    <div style="border-top: 5px dashed black"></div>
                        <div class="row">
                            <div class="col-md-6">


                                <div class="panel panel-success">
                                     <div class="panel-heading">
                                          <h2>Write Article</h2>
                                     </div>
                                     <div class="panel-body">
                                          <form action="addarticle.php" method="post" role="form" enctype="multipart/form-data">
                                              <label for="articlehead">Title</label>
                                              <input type="text" class="form-control" name="articlehead" id="articlehead" placeholder="Title" required>

                                              <label for="articlebody">Article</label>
                                              <textarea class="form-control" name="articlebody" id="articlebody" required  placeholder="Article"  rows="8"></textarea> 

                                              <label>Image</label>
                                              <input type="file" accept=".jpg,.png,.gif" id="articleimageselect" class="form-control" name="articleimage">

                                              <input type="submit" class="btn btn-primary form-control" name="addarticle" value="Add">
                                          </form>
                                     </div>
                                </div> 

                            </div>
                            <!--Image preview-->
                            <div class="col-md-6">
                                 <div class="panel panel-default">

                                        <div class="panel-heading">
                                           <h2>Image Preview</h2>
                                        </div>


                                        <div class="panel-body" id="articleimprev">
                                            
                                            <div style="min-width: 100%; min-height: 340px;">
                                                  <img src="" id="articlepreviewimage" style="min-width: 100%; min-height: 300px; max-height: 300px;">
                                             </div>

                                        </div>
                                     
                                   </div>
                            </div>
                            <!--End image preview-->
                        </div>




                                        
                                         
                                             <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                  <span> <h2>All articles </h2></span>
                                                   
                                                
                                            
                                                </div>

                                                <div class="panel-body" id="pBody">
                                              <table class="table-striped table">
                                               <thead>
                                                    <tr>
                                                    <th><h2>Heading</h2></th>
                                                    <th><h2>Image </h2></th>
                                                    <th><h2 class="pull-right">Options</h2></th>
                                                  </tr>
                                                </thead>
                                                               

                                                    <tbody id="cBody">

                                                  <?php 
                                                    getArticleBody("article");
                                                   ?>
                                                    </tbody>

                                                         
                                                    </table>


                                                                
                                                  </div>

                                             </div>
                      
                    </div>
                    <!--End of article pane-->




                    <!--Editorial pane started-->
                    <div role="tabpanel" class="tab-pane" id="editorial">
                    <div style="border-top: 5px dashed black"></div>

                         <div class="row">
                             <div class="col-md-6">


                                 <div class="panel panel-success">
                                      <div class="panel-heading">
                                           <h2>Write Editorial</h2>
                                      </div>
                                      <div class="panel-body">
                                           <form action="addeditorial.php" method="post" role="form" enctype="multipart/form-data">

                                               <label for="editorialhead">About</label>
                                               <input type="text" class="form-control" name="editorialhead" id="editorialhead" placeholder="Heading" required>

                                               <label for="editorialbody">Editorial</label>
                                               <textarea class="form-control" name="editorialbody" id="editorialbody" required  placeholder="Editorial"  rows="8"></textarea> 

                                               <label>Image</label>
                                               <input type="file" accept=".jpg,.png,.gif" id="editorialimageselect" class="form-control" name="editorialimage">

                                               <input type="submit" class="btn btn-primary form-control" name="addeditorial" value="Publish">
                                           </form>
                                      </div>
                                 </div> 

                             </div>
                             <!--Image preview-->
                             <div class="col-md-6">
                                  <div class="panel panel-default">

                                         <div class="panel-heading">
                                            <h2>Image Preview</h2>
                                         </div>


                                         <div class="panel-body" id="editorialimprev">
                                             
                                             <div style="min-width: 100%; min-height: 340px;">
                                                   <img src="" id="editorialpreviewimage" style="min-width: 100%; min-height: 300px; max-height: 300px;">
                                              </div>

                                         </div>
                                      
                                    </div>
                             </div>
                             <!--End image preview-->
                         </div>
                      
                                 <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                  <span> <h2>All Editorials </h2></span>
                                                   
                                                
                                            
                                                </div>

                                                <div class="panel-body" id="pBody">
                                              <table class="table-striped table">
                                               <thead>
                                                    <tr>
                                                    <th><h2>Heading</h2></th>
                                                    <th><h2>Image </h2></th>
                                                    <th><h2 class="pull-right">Options</h2></th>
                                                  </tr>
                                                </thead>
                                                               

                                                    <tbody id="cBody">

                                                  <?php 
                                                    getArticleBody("editorial");
                                                   ?>
                                                    </tbody>

                                                         
                                                    </table>


                                                                
                                                  </div>

                                             </div>
                    </div>
                    <!--End of editorial pane-->

    


                    <!--Start of news desk-->
                    <div role="tabpanel" class="tab-pane" id="desk">
                    <div style="border-top: 5px dashed black"></div>
                        <div class="row">
                             
                             <!--Image preview-->
                             <div class="col-md-6">
                                  <div class="panel panel-default">

                                         <div class="panel-heading">
                                            <h2>Image Preview</h2>
                                         </div>


                                         <div class="panel-body" id="deskimprev">
                                             
                                             <div style="min-width: 100%; min-height: 340px;">
                                                   <img src="" id="deskpreviewimage" style="min-width: 100%; min-height: 300px; max-height: 300px;">
                                              </div>

                                         </div>
                                      
                                    </div>
                             </div>
                             <!--End image preview-->

                             <div class="col-md-6">


                                 <div class="panel panel-success">
                                      <div class="panel-heading">
                                           <h2>Current News</h2>
                                      </div>
                                      <div class="panel-body">
                                           <form action="addedesknews.php" method="post" role="form" enctype="multipart/form-data">

                                               <label for="editorialhead">Headline</label>
                                               <input type="text" class="form-control" name="deskhead" id="deskhead" placeholder="Headline" required>

                                               <label for="editorialbody">News</label>
                                               <textarea class="form-control" name="deskbody" id="deskbody" required  placeholder="News"  rows="8"></textarea> 

                                               <label>Image</label>
                                               <input type="file" accept=".jpg,.png,.gif" id="desknewsimageselect" class="form-control" name="desknewsimage">

                                               <input type="submit" class="btn btn-primary form-control" name="adddesknews" value="Publish">
                                           </form>
                                      </div>
                                 </div> 

                             </div>

                         </div>

                         <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                  <span> <h2>All News Desk </h2></span>
                                                   
                                                
                                            
                                                </div>

                                                <div class="panel-body" id="pBody">
                                              <table class="table-striped table">
                                               <thead>
                                                    <tr>
                                                    <th><h2>Heading</h2></th>
                                                    <th><h2>Image </h2></th>
                                                    <th><h2 class="pull-right">Options</h2></th>
                                                  </tr>
                                                </thead>
                                                               

                                                    <tbody id="cBody">

                                                  <?php 
                                                    getArticleBody("desk");
                                                   ?>
                                                    </tbody>

                                                         
                                                    </table>


                                                                
                                                  </div>

                                             </div>
                      
                    </div>
                    <!--End of news desk-->



                    <!--Start of gallery-->
                    <div role="tabpanel" class="tab-pane" id="gallery">
                            <div style="border-top: 5px dashed black"></div>

                            <div class="row">
                             
                             <!--Image preview-->
                             <div class="col-md-6">
                                  <div class="panel panel-default">

                                         <div class="panel-heading">
                                            <h2>Image Preview</h2>
                                         </div>


                                         <div class="panel-body" id="galleryimprev">
                                             
                                             <div style="min-width: 100%; min-height: 340px;">
                                                   <img src="" id="gallerypreviewimage" style="min-width: 100%; min-height: 300px; max-height: 300px;">
                                              </div>

                                         </div>
                                      
                                    </div>
                             </div>
                             <!--End image preview-->

                             <div class="col-md-6">
                              
                                 <div class="panel panel-success">
                                      <div class="panel-heading">
                                           <h2>Add Image to Gallery</h2>
                                      </div>
                                      <div class="panel-body">
                                           <form action="addimagetogallery.php" method="post" role="form" enctype="multipart/form-data">

                                               <label for="imagedescription">Description</label>
                                               <textarea class="form-control" name="imagedescription" id="imagedescription" required  placeholder="About this photo"  rows="10"></textarea> 

                                               <label>Image</label>
                                               <input type="file" accept=".jpg,.png,.gif" id="galleryimageselect" class="form-control" name="galleryimage">

                                               <input type="submit" class="btn btn-primary form-control" name="addimage" value="Add">
                                           </form>
                                      </div>
                                 </div> 

                             </div>

                         </div>
                      
                    </div>
                    <!--End of gallery pane-->



                    <!--start of add pane-->
                    <div role="tabpanel" class="tab-pane" id="advertisement">
                     <div style="border-top: 5px dashed black"></div>

                        <div class="row">

                         <div class="col-md-6">
                          
                             <div class="panel panel-success">
                                  <div class="panel-heading">
                                       <h2>Advertisement Management</h2>
                                  </div>
                                  <div class="panel-body">
                                       <form action="advertisement.php" method="post" role="form" enctype="multipart/form-data">

                                           <label for="adddescription">Description</label>
                                           <textarea class="form-control" name="adddescription" id="adddescription" required  placeholder="About the organisation"  rows="10"></textarea> 

                                           <label>Image</label>
                                           <input type="file" accept=".jpg,.png,.gif" id="advertisementimageselect" class="form-control" name="advertisementimage">

                                           <input type="submit" class="btn btn-primary form-control" name="advertisement" value="Publish">
                                       </form>
                                  </div>
                             </div>
                            </div>

                        <!--Image preview-->
                         <div class="col-md-6">
                              <div class="panel panel-default">

                                     <div class="panel-heading">
                                        <h2>Image Preview</h2>
                                     </div>


                                     <div class="panel-body" id="addimprev">
                                         
                                         <div style="min-width: 100%; min-height: 340px;">
                                               <img src="" id="advertisementpreviewimage" style="min-width: 100%; min-height: 300px; max-height: 300px;">
                                          </div>

                                     </div>
                                  
                                </div>
                         </div>
                         <!--End image preview--> 

                         

                     </div>



                    </div>
                    <!--end of add pane.-->




                    <!--Slider -->

                      <div role="tabpanel" class="tab-pane" id="slider">
                       <div style="border-top: 5px dashed black"></div>

                          <div class="row">

                           <div class="col-md-6">
                            
                               <div class="panel panel-success">
                                    <div class="panel-heading">
                                         <h2>Slider Management</h2>
                                    </div>
                                    <div class="panel-body">
                                         <form action="addSlider.php" method="post" role="form" enctype="multipart/form-data">

                                             <label for="sliderdescription">Description</label>
                                             <textarea class="form-control" name="sliderdescription" id="sliderdescription" required  placeholder="About the Image"  rows="10"></textarea> 

                                             <label>Image</label>
                                             <input type="file" accept=".jpg,.png,.gif" id="sliderimageselect" class="form-control" name="sliderimage">

                                             <input type="submit" class="btn btn-primary form-control" name="saveslider" value="Add Slider">
                                         </form>
                                    </div>
                               </div>
                              </div>

                          <!--Image preview-->
                           <div class="col-md-6">
                                <div class="panel panel-default">

                                       <div class="panel-heading">
                                          <h2>Image Preview</h2>
                                       </div>


                                       <div class="panel-body" id="sliderimprev">
                                           
                                           <div style="min-width: 100%; min-height: 340px;">
                                                 <img src="" id="sliderpreviewimage" style="min-width: 100%; min-height: 300px; max-height: 300px;">
                                            </div>

                                       </div>
                                    
                                  </div>
                           </div>
                           <!--End image preview--> 

                           

                       </div>



                      </div>

                    <!--End slider -->



                   <!--setting pane -->
                   <div role="tabpanel" class="tab-pane" id="settings">
                     <div style="border-top: 5px dashed black"></div>
                      <div class="panel panel-primary">

                            <div class="panel-heading">
                              <h2>Profile Settings</h2>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                <!--Add admin column -->
                                <div class="col-md-6">

                                     <!--Add admin --> 
                                        <div class="panel panel-info">
                                            <div class="panel-heading"><h3>Add Admin</h3></div>
                                            <div class="panel-body">
                                              <form id="addadmin" action="admin.php" method="post">
                                                  <label for="name">Name</label>
                                                  <input class="form-control" type="text" name="name" placeholder="Admin Name" required>

                                                  <label for="name">Email</label>
                                                  <input class="form-control" type="email" name="email" placeholder="Email" required>

                                                  <label for="name">Password</label>
                                                  <input class="form-control" type="password" name="password" placeholder="Password" required>

                                                  <label for="name">Re-type Password</label>
                                                  <input class="form-control" type="password" name="confirmpass" placeholder="Confirm Password" required>

                                                  <input type="submit"  class="form-control btn btn-primary" name="addadmn" value="Add">

                                              </form>
                                            </div>
                                        </div>
                                     <!-- End Add admin -->

                                 </div>
                                 <!-- End add admin column -->

                                 <!--Account  Setting -->
                                 <div class="col-md-6">

                                        <div class="panel panel-info">
                                            <div class="panel-heading"><h3>Change Password</h3></div>
                                            <div class="panel-body">
                                              <form  action="admin.php" method="post">
                                                  <label for="name">Old Password</label>
                                                  <input class="form-control" type="password" name="old" placeholder="Old Password" required>

                                                  <label for="name">New Password</label>
                                                  <input class="form-control" type="password" name="newpass" placeholder="New Password" required>

                                                  <label for="name">Confirm Password</label>
                                                  <input class="form-control" type="password" name="newconfirmpass" placeholder="Re-type Password" required>
                                                 
                                                  <input type="submit"  class="form-control btn btn-primary" name="changepass" value="Change">

                                              </form>
                                            </div>
                                        </div>
                                   
                                 </div>
                                 <!-- Account Setting end -->

                                </div>
                            </div>
                          
                        </div>
                   </div>

                   <!--End of settings pane -->

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