<?php 
include "php/dbConnection.php";
	
	function signin_checking($email, $password){

	    global $connection;
       //Admin checking
       $pass=sha1($password);
       $query = "SELECT * FROM admin WHERE email='$email' AND password='$pass'";
       $result = mysqli_query($connection, $query);

       if(mysqli_num_rows($result)==1){
            return "admin";
       }

         //User checking 
		      $error=false;
          $msg="";
		       
         $email = mysqli_real_escape_string($connection,$email);
         $password = mysqli_real_escape_string($connection,$password);

         if(empty($email)){
                
                return "Please enter your  username.";

            }


            if (empty($password)){
                 
                return "Please enter password.";
            }

             
            	  $hashFormat = "$2y$10$";
                $salt = "iusesomecrazystrings22";
                $hashF_and_salt = $hashFormat . $salt;
                $password = crypt($password, $hashF_and_salt);
                $query = "SELECT email,password from users where email='$email'";
                $query_email_result = mysqli_query($connection,$query);
                $row=mysqli_fetch_array($query_email_result);
                $count_user =mysqli_num_rows($query_email_result);

                   if($count_user==1 && $row['password']==$password){
                            
                            return "ok";
                            
                      }
              else  return "Wrong username or password, Try again...";
                       

                        
	}



	function registration()
	{
		// Signup form action is here
    global $connection;
        $error=false;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);
		$confirm_password = mysqli_real_escape_string($connection,$confirm_password);
          // check username exist or not

            if(empty($email)){
                $error=true;
                $emailError = "Please enter your  email.";

            }
            else {

                $query = "SELECT email from users where email='$email'";
                $query_email_result = mysqli_query($connection,$query);
                $check_email =mysqli_num_rows($query_email_result);
                if($check_email!=0){
                    
                    return "Provided Email is already in use.";
                }

            }

      // password validation
          if (empty($password)){
              
             return "Please enter password.";
          } else if(strlen($password) < 6) {
               
              return "Password must have atleast 6 characters.";
          }
        if (empty($confirm_password)){
            
            return "Please retype password.";
        } else if($password != $confirm_password) {
             
            return "Password does not match";
        }

             



                        $hashFormat = "$2y$10$";
                        $salt = "iusesomecrazystrings22";
                        $hashF_and_salt = $hashFormat . $salt;
                        $password = crypt($password, $hashF_and_salt);
                        $query="INSERT INTO users(email,password)";
                        $query.="values('$email','$password')";
                        $query_insert_result = mysqli_query($connection,$query);
                        if($query_insert_result)
                        {
                             
                            $_SESSION['email'] = $email;                            
                            header("Location: index.php");
                        }
                        else
                        {
                            
                            return "Something went wrong, try again later...";
                        }
 
	}


  function addAdmin($email, $password, $conf, $name){
    global $connection;
    $query = "SELECT * FROM admin where email='$email'";
    $result = mysqli_query($connection, $query);

    
    if($password!=$conf){
      return "Password don't match !!";
    }

    if(mysqli_num_rows($result)>=1){
      return "Already assigned as an admin !";
    }

    
    $password = sha1($password);

    $query = "INSERT INTO admin(email, password, name) VALUES('$email', '$password', '$name')";
    $result = mysqli_query($connection, $query);

    if($result){
      return "Admin registered successfully !!";
    }
    else{
      return "Something wrong, please try again !";
    }

  }


  function changeAdminPass($email, $old, $new, $newcof){
    global $connection;

    if($new!=$newcof){
      return "Password don't match!!";
    }


    $pass = sha1($old);
    $newpass = sha1($new);
    $query = "SELECT * FROM admin WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result)==1){
           if($old == $new){
          return "Password same as old password, pick a new one!";
        }
      $query = "UPDATE admin SET password='$newpass' WHERE email='$email'";
      $result = mysqli_query($connection, $query);

      if($result){
        return "Password changed successfully!!";
      }
      return "Something went wrong, please try again !";
    }
  }


  function getAllArticle($name){

    global $connection;
    $query = "SELECT * FROM $name";

    $result = mysqli_query($connection, $query);
    return $result;
  }



  function getArticleExtra($id,$name){

    global $connection;
    $query = "SELECT * FROM $name where id='$id'";

    $result = mysqli_query($connection, $query);
    if(!$result)
      echo "Failed";
    return $result;
  }

function updateArticle($id, $title, $filepath, $filetmp, $article,$tableName)
  {
                  global $connection;
                          $zerro=0;
                            
                           $filepath = mysqli_real_escape_string($connection,$filepath);

                       

                           $query="UPDATE $tableName SET  head='$title',";

                           if(!empty($filepath)){
                            $query.="link='$filepath',";
                           }

                           $query.="body='$article' WHERE id='$id'";


                           $result = mysqli_query($connection, $query);
                           if($result){
                            move_uploaded_file($filetmp, $filepath);
                            }
                            else
                                return $result;
                        
                          

                          return true;

  }

  function getAllCategory(){

    global $connection;

    $query = "SELECT 
    c.id,
    c.name,
    sc.id,
    sc.name
    FROM category as c left outer join subcategory as sc 
    on c.id=sc.cid";


    $result = mysqli_query($connection, $query);

    while($row=mysqli_fetch_assoc($result)){

    }

  }

  function getCategory(){
    global $connection;
    $query = "SELECT * FROM category";

    $result = mysqli_query($connection, $query);

    return $result;
  }


  function getSubCategory($cid){
    global $connection;
    $query = "SELECT 
    sc.id,
    sc.name
    FROM subcategory as sc where sc.cid='$cid'";

    $result = mysqli_query($connection, $query);

    return $result;
  }

  function addSubcategory($name,$cid)
  {

    global $connection;
    $query = "SELECT * FROM subcategory WHERE name='$name'";
    $result = mysqli_query($connection,$query);

   
    if(mysqli_num_rows($result)==0){
       $query = "INSERT into subcategory(cid,name) values('$cid','$name')";
       $result = mysqli_query($connection,$query);

       if(!$result){
        return "Something wrong ! Please try again !";
       }

       return "Subcategory Added Successfully!!";
       
    }
    else{
      return "Subcategory already exist ! Add new one.";
    }

  
  }

  function updateContentes($id, $title, $filepath, $filetmp, $article)
  {
                  global $connection;
                          $zerro=0;
                            
                           $filepath = mysqli_real_escape_string($connection,$filepath);

                       

                           $query="UPDATE content SET  head='$title',";

                           if(!empty($filepath)){
                            $query.="image='$filepath',";
                           }

                           $query.="body='$article', readcount='$zerro' WHERE id='$id'";


                           $result = mysqli_query($connection, $query);
                           if($result){
                            move_uploaded_file($filetmp, $filepath);
                            }
                            else
                                return $result;
                        
                          

                          return true;

  }


  function getAllcontentsDetails($id)
  {
    global $connection;
    $query = "SELECT * FROM content WHERE id='$id'";

    return mysqli_query($connection, $query);

  }


  function getContents($cid, $scid){
    global $connection;
    $query = "SELECT * FROM content WHERE cid='$cid' AND scid='$scid' ORDER BY createdat DESC";

    return mysqli_query($connection, $query);
  }


  function addContentes($category_id, $subcategory_id, $title, $filepath, $filetmp, $article){ 
                      
                          global $connection;
                          $zerro=0;
                           // $filetmp = mysqli_real_escape_string($connection,$filetmp);
                           $filepath = mysqli_real_escape_string($connection,$filepath);
                        

                           $query="INSERT INTO content (cid, scid, head, image, body, readcount) VALUES('$category_id','$subcategory_id','$title','$filepath','$article', '$zerro')";

                           $result = mysqli_query($connection, $query);
                           if($result && !empty($filepath) && !empty($filetmp)){
                            move_uploaded_file($filetmp, $filepath);
                            }
                            
                           
                          
                            if(!$result)
                              return $result;

                          return true;
                          
                    }


 function checkCountImage(){
      global $connection;
       $query = "SELECT * FROM photon ";
       $result=mysqli_query($connection, $query);
       $row= mysqli_fetch_assoc($result);
       $count= $row['count'];  
       $old=$count;
       $count=$count+1;
       $queryU="UPDATE photon SET count='$count' WHERE id=1";
       mysqli_query($connection,$queryU);
       return $old;

 } 


function addNewArticle($title, $article,  $filepath, $filetmp){

  global $connection;

  $query = "INSERT INTO article (head, body, link) VALUES('$title','$article','$filepath')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;

}


function addNewEditorial($title, $editorial,  $filepath, $filetmp){
     global $connection;

  $query = "INSERT INTO editorial (head, body, link) VALUES('$title','$editorial','$filepath')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;
}


function addDeskNews($title, $editorial,  $filepath, $filetmp){
    global $connection;

  $query = "INSERT INTO desk (head, body, link) VALUES('$title','$editorial','$filepath')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;
}



function addImagetoGallery($description, $filepath, $filetmp){

  global $connection;

  $query = "INSERT INTO gallery (description, link) VALUES('$description', '$filepath')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;

}


function addImagetoSlider($description, $filepath, $filetmp){
   global $connection;

  $query = "INSERT INTO slider (description, link, type) VALUES('$description', '$filepath', 0)";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;
}

function addImageforAdd($description, $filepath, $filetmp){

   global $connection;

  $query = "INSERT INTO addimage (description, link) VALUES('$description', '$filepath')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;
}

 

?>