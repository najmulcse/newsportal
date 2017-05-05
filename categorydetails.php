<?php
 include_once('php/allFunctions.php');


   ob_start();
        session_start();
        
         if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])){
            header("Location: php/error.php");
        }

   $cid = $_GET['id'];
   $name = $_GET['name'];


   
   $result = getSubCategory($cid);
   

?>


<!DOCTYPE html>
<html>
<head>
	<title><?php echo $name?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script type="text/javascript" src="assets/js/jquery-min.js"></script> 
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="assets/js/selectnav.min.js"></script> 



<link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/font/font.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/myStyle.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />



<script type="text/javascript">
	
     function editSubc(name, id){
     	var xmlhttp;
                            
           if (window.XMLHttpRequest){

								  xmlhttp = new XMLHttpRequest();

								  }

								   else{ 
								     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						          }

						       xmlhttp.onreadystatechange = function(){
						         
						         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						                document.getElementById(name).innerHTML = xmlhttp.responseText;
						            }

						       }

						      xmlhttp.open("GET", "php/editsubcategory.php?q=" + name, true);
						      xmlhttp.send();
							
                    return;
     }

     function saveupdate(name){
     	var xmlhttp;
     	var id="inp"+name; 
        var up = document.getElementById(id).value;

        if(up=="")up=name;
          
                if (window.XMLHttpRequest){

								  xmlhttp = new XMLHttpRequest();

								  }

								   else{ 
								     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						          }

						       xmlhttp.onreadystatechange = function(){
						         
						         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						                document.getElementById(name).innerHTML = xmlhttp.responseText;
						            }

						       }

						      xmlhttp.open("GET", "php/updatesubc.php?old=" +name+"&new="+up, true);
						      xmlhttp.send();
							
                    return;
                    
     }


</script>





</head>


<body>


<div class="body_wrapper">
  <div class="center">
    <div class="header_area">
      <div class="logo floatleft"><a href="#"><img src="images/logo12.png" alt="" /></a></div>
      <div class="top_menu floatleft">
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
      </div>
   </div>
   
   <!--body part-->
   <section>
   	    

        <div class="panel panel-primary">
		    <div class="panel-heading">
			    <span> <h2><?php echo $name; ?></h2></span>
			</div>

		    <div class="panel-body" id="pBody">
				
				<div class="row">                                    
                 <div class="col-md-6">
   	   				<div class="panel panel-info">
	                    <div class="panel-heading">
	                    	<span class="contactHead"><h2>Add Sub Category</h2></span>
	                    </div>
	                    <div class="panel-body">
	                        <form action="addsubc.php" method="post">
	                                             
	                            <label for="subc" >Name</label>
	                            <input class="form-control" type="text" name="subc" id="subc" required>
	                            <?php printf('<input type="text" name="cat" hidden value="%s">',$cid);
	                             ?>
	                            
	                            <button name="add"  type="submit" class="form-control btn btn-primary" style="margin-top:5px">Add</button>

	                        </form>
	                    </div>
					 
						   	   	   

					</div>
				                                                 
		        </div>

		        <div class="col-md-6" style="max-height: 300px; overflow: auto;">
		            <table class="table table-striped">
		            <thead>
		                <tr>
			            	<th><h2>Subcategories</h2></th>
			            	<th><h2 class="pull-right">Options</h2></th>
		            	</tr>
		            </thead>
		            <tbody>
		        	<?php
		        		while ($row=mysqli_fetch_assoc($result)) {
		        			 print("<tr>");
		        			 	printf('<td>
		        			 		<div id="%s">

		        			 		  <span>%s</span>

		        			 		</div>
		        			 		</td>', $row['name'], $row['name']);

		        			 	printf('<td>
                                            <span class="pull-right">
											<button class="btn btn-primary" onclick="editSubc(\'%s\', \'%s\')">Edit</button>
											<a type="button" class="btn btn-danger" href="php/deletesubc.php?id=%s">Delete</a></span>
		        			 		</td>',$row['name'],$row['id'], $row['id']);
		        			 print("</tr>");
		        		}

		        	?>
		        	</tbody>
		        	</table>
		        </div>
		     </div> 

		</div>
				                     
				                      
  

	</div>
   	   		 
   	    
   </section>
   <!--End Body Part -->

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