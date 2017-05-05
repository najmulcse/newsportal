

<?php
        include "php/dbConnection.php";
        include "php/allFunctions.php";
        ob_start();
        session_start();

         if(isset($_SESSION['email'])){
            header("Location: index.php");       
        }  
      
      $msg=null;

      if(isset($_POST['login']))
      {
       $email = $_POST['email'];
       $password = $_POST['password'];

       $msg = signin_checking($email, $password);


       if($msg=='admin'){
        $_SESSION['admin']='admin';
        $_SESSION['email']=$email;
        header("Location: admin.php"); 
        
       }
       else if($msg=='ok'){
         $_SESSION['email']=$email;
        header("Location: index.php");
       }



      } 
       
      
      ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SWOTTA - A Community News Portal</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/font/font.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/myStyle.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />
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
          
          <div class="container" style="margin: 100px 0px 120px 0px">
            <div class="row">
                 <div class="col-md-3"> </div>

                  
                  <div class="col-md-6">
                        <div class="panel panel-primary">

                                 <div class="panel-heading">
                                    <h2 class="text-center login-title">Sign in </h2>
                                  </div>

                                  <div class="panel-body">

                                    
                                         <?php
                    if ( isset($msg) ) {
                        if($msg!='ok' && $msg!='admin'){

                         printf('<div class="form-group">
                            <div class="alert alert-danger" style="font-size: 16px">
                                 %s
                            </div>
                        </div>',$msg);
                       }
                       else{

                          print('<div class="form-group">
                            <div class="alert alert-success" style="font-size: 16px">
                              You are Logged In
                            </div>
                        </div>'); 
                       }


                    }

                        ?>
                                       
                                       <?php 
                                      if($msg!='ok' && $msg!='admin' && !isset($_SESSION['email'])){
                                      print('<form class="form-signin" action="login.php" method="post">
                                        <input type="email" class="form-control fc" name="email" placeholder="Email" required autofocus>
                                      <input type="password" class="form-control fc" name="password" placeholder="Password" required>

                                     

                                      <button  name="login" class="btn btn-primary btn-block" type="submit">Sign in</button>
                                      <label class="checkbox pull-left">
                                      <input type="checkbox" value="remember-me">Remember me</label>
                                        </form>
                                      <a href="https://www.google.com/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=what+is+online+address+book" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                                    

                                    <a href="createaccount.php" class="text-center new-account">Create an account </a>');
                                    }

                                    ?>
                                  </div>

                                </div>
                          </div>
                      </div>

                  <div class="col-md-3"> </div>

            </div>
          








    <div class="footer_top_area">
      <div class="inner_footer_top"> <img src="images/add3.png" alt="" /> </div>
    </div>
    <div class="footer_bottom_area">
      <div class="footer_menu">
        <ul id="f_menu">
          <li><a href="#">world news</a></li>
          <li><a href="#">Blogs</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Technology</a></li>
          <li><a href="#">Political</a></li>
          <li><a href="#">Study</a></li>
          <li><a href="#">Entertainment</a></li>
          <li><a href="#">Sports</a></li>
          <li><a href="#">Life&style</a></li>
        </ul>
      </div>
      <div class="copyright_text">
        <p>Copyright &copy; 2017. All rights reserved </p>
        <p>Trade marks and images used in the design are the copyright of their respective owners and are used for demo purposes only.</p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="assets/js/jquery-min.js"></script> 
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="assets/js/selectnav.min.js"></script> 
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