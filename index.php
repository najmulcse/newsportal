<?php
       include_once('php/allFunctions.php');
       include_once('php/indexModel.php');

        ob_start();
        session_start();
           
      
     $catresult = getCategory();

      $advertisement = getAdvertisement();
      $numAdd = count($advertisement);
      

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
     

      <div class="social_plus_search floatright">
        <div class="social">
          <ul>
            <li><a href="#" class="twitter"></a></li>
            <li><a href="#" class="facebook"></a></li>
            <li><a href="#" class="feed"></a></li>
          </ul>
        </div>
        <div class="search">
          <form action="#" method="post" id="search_form">
            <input type="text" value="Search news" id="s" />
            <input type="submit" id="searchform" value="search" />
            <input type="hidden" value="post" name="post_type" />
          </form>
        </div>
      </div>
    </div>

    <!-- Start Menu Area -->
     <div class="main_menu_area">
                <ul id="nav">
    <?php 
             while ($cat=mysqli_fetch_assoc($catresult)) {

                  printf('<li><a href="#">%s</a> 

                    <ul> ',$cat['name']);

                  $scatresult = getSubCategory($cat['id']);

                  while($scat=mysqli_fetch_assoc($scatresult)){
                      
                        printf('<li><a href="newsdetails.php?cname=%s&scname=%s&cid=%s&scid=%s">%s</a></li>',$cat['name'],$scat['name'],$cat['id'],$scat['id'], $scat['name']);
                    }
                      print('</ul>
                  </li>');
             }                     
        ?>
        <li><a href="#">Emni</a></li>
        <li><a href="#">Emni</a></li>
        <li><a href="#">Emni</a></li>
      </ul>
    </div>

<!--End of menu area-->


    <div class="slider_area">
      <div class="slider">
        <ul class="bxslider">

          <?php 

             $sliders=getSlider();
             $i=0;
            while( ($slider=mysqli_fetch_assoc($sliders)) && $i<10) {

                 printf('
                        <li><img src="%s" alt="" title="%s" /></li>
                  ', $slider['link'], $slider['description']);
                 $i++;
               
             }  
             
          ?>
          
        </ul>
      </div>
    </div>

    <!--Start of content area -->

    <div class="content_area">

            <!--Start of main content area (News and other article)-->
            <div class="main_content floatleft">

                  <!--Left column start -->

                  <div class="left_coloum floatleft">


                    <!--Start of From around the world-->
                    <div class="single_left_coloum_wrapper">

                          <h2 class="title">from   around   the   world</h2>

                          <a class="more" href="#">more</a>

                          <?php
                            $result = getFromAround();
                            $i=0;

                            while(($content=mysqli_fetch_assoc($result)) && $i<3) {

                              printf('
                                     <div class="single_left_coloum floatleft"> <img src="%s" alt="" />
                                       <h3>%s</h3>
                                       <p>%s</p>
                                      <a class="readmore" href="#">read more</a> 
                                      </div>
                               ', $content['image'], $content['head'], substr($content['body'], 0, 300));
                                

                               $i++;
                            }

                          
                       ?>

                          
                    </div>

                    <!--End of From around the world-->


                    <!--Latest Article Started here-->
                    <div class="single_left_coloum_wrapper">
                          <h2 class="title">latest  articles</h2>
                          <a class="more" href="#">more</a>



                          <?php

                            $result = getArticle();
                            $i=0;

                            while(($content=mysqli_fetch_assoc($result)) && $i<3) {

                              printf('
                                     <div class="single_left_coloum floatleft"> <img src="%s" alt="" />
                                      <h3>%s</h3>
                                      <p>%s</p>
                                      <a class="readmore" href="#">read more</a> 
                                      </div>
                               ', $content['link'], $content['head'], substr($content['body'], 0, 300));
                                

                               $i++;
                            }

                          
                       ?>

                          

                           
                    </div>
                    <!--End of Latest article -->


                    <!--Gallery Started -->
                    <div class="single_left_coloum_wrapper gallery">

                      <h2 class="title">gallery</h2>
                      <a class="more" href="#">more</a> 



                      <?php 

                          $result = getGallery();
                            $i=0;

                            while(($content=mysqli_fetch_assoc($result)) && $i<6) {

                              printf('
                                <img src="%s" alt="" />
                                ', $content['link']);
                                

                               $i++;
                            }


                      ?>
                      

                    </div>
                    <!--End of gallery-->

                    


                    <!--Start of tech news-->
                    <div class="single_left_coloum_wrapper single_cat_left">

                          <h2 class="title">tech news</h2>
                          <a class="more" href="#">more</a>

                          <?php 

                          $result = getTechnews();
                            $i=0;

                            while(($content=mysqli_fetch_assoc($result)) && $i<4) {

                              printf('
                                <div class="single_cat_left_content floatleft">
                                  <h3>%s</h3>
                                  <p>%s</p>
                                  <p class="single_cat_left_content_meta">by <span>SWOTTA</span> |  TECH SPOTLIGHT</p>
                                </div>

                                ', $content['head'], substr($content['body'], 0, 300) );
                                

                               $i++;
                            }


                      ?>
                          
                           

                    </div>
                    <!--End Of Tech News-->


                  </div>

                  <!--End of left column-->


                  <!--Start of Right Column-->
                  <div class="right_coloum floatright">


                          <!--Start of Middle column (From the desk)-->
                          <div class="single_right_coloum">
                            <h2 class="title">from the desk</h2>
                            <ul>


                                     <?php 

                                $result = getDesk();
                                  $i=0;

                                  while(($content=mysqli_fetch_assoc($result)) && $i<3) {

                                    printf('
                                      <li>
                                        <div class="single_cat_right_content">
                                          <h3>%s</h3>
                                          <p>%s</p>
                                          <p class="single_cat_right_content_meta"><a href="#"><span>read more</span></a> 3 hours ago</p>
                                        </div>
                                      </li>

                                      ', $content['head'], substr($content['body'], 0, 300) );
                                      

                                     $i++;
                                  }


                               ?>
                           </ul>

                            <a class="popular_more" href="#">more</a> 

                            </div>
                           <!--Start of Middle column-->


                          <!--Start of Middle column (Editorial)-->

                          <div class="single_right_coloum">

                            <h2 class="title">editorial</h2>

                            <?php 

                                $result = getEditorial();
                                  $i=0;

                                  while(($content=mysqli_fetch_assoc($result)) && $i<4) {

                                    printf('
                                      <div class="single_cat_right_content editorial"> <img src="%s" alt="" />
                                        <h3>%s</h3>
                                      </div>
                                    ', $content['link'], $content['head']);
                                      

                                     $i++;
                                  }


                               ?>
 

                          </div>

                          <!--End of Middle column (Editorial)-->
                  </div>


                  <!--End of Right column-->
            </div>
            <!--End of main content (Left newses)-->




            <!--Start of Sidebar-->
            <div class="sidebar floatright">
                  <!--First add -->
                  <?php
                                       
                     if($numAdd>0){
                      printf('<div class="single_sidebar"> <img src="%s" alt="" /> </div>', $advertisement[0]['link']);
                    }                  

                  ?>

                   

                  <!--End of first add -->

                  <!--Start of Sign up -->
                  <div class="single_sidebar">
                    <div class="news-letter">
                      <h2>Sign Up for Newsletter</h2>
                      <p>Sign up to receive our free newsletters!</p>
                      <form action="#" method="post">
                        <input type="text" value="Name" id="name" />
                        <input type="text" value="Email Address" id="email" />
                        <input type="submit" value="SUBMIT" id="form-submit" />
                      </form>
                      <p class="news-letter-privacy">We do not spam. We value your privacy!</p>
                    </div>
                  </div>
                  <!--End of sign up-->

                    
                    <!--Start of Popular -->
                     <div class="single_sidebar">
                    <div class="popular">
                      <h2 class="title">Popular</h2>
                      <ul>
                        <li>
                          <div class="single_popular">
                            <p>1st April 2017</p>
                            <h3>Greece farm shooting: Migrants win damages from state <a href="#" class="readmore">Read More</a></h3>
                          </div>
                        </li>
                        <li>
                          <div class="single_popular">
                            <p>6th April 2017</p>
                            <h3>Sylhet blasts kill six amid Bangladesh militant raid <a href="#" class="readmore">Read More</a></h3>
                          </div>
                        </li>
                        <li>
                          <div class="single_popular">
                            <p>11 April 2017</p>
                            <h3>The medics using drainpipes to help amputees <a href="#" class="readmore">Read More</a></h3>
                          </div>
                        </li>
                        <li>
                          <div class="single_popular">
                            <p>13th April 2017</p>
                            <h3>Males in rural Bangladeshi communities are more susceptible to chronic arsenic poisoning than females: analyses based on urinary arsenic. <a href="#" class="readmore">Read More</a></h3>
                          </div>
                        </li>
                        <li>
                          <div class="single_popular">
                            <p>16th April 2017</p>
                            <h3>Bangladeshi Immigrants in New York City: A Community Based Health Needs Assessment of a Hard to Reach Population <a href="#" class="readmore">Read More</a></h3>
                          </div>
                        </li>
                      </ul>
                      <a class="popular_more">more</a> </div>
                  </div>

                  <!--End Of popular -->


                  <!--Start of Second Add-->
                  <?php
                                       
                     if($numAdd>0){
                      printf('<div class="single_sidebar"> <img src="%s" alt="" /> </div>', $advertisement[0]['link']);
                    }                  

                  ?>
                  <!--End of second add -->

                   <!--Start Third add-->
                   <div class="single_sidebar">
                      <h2 class="title">ADD</h2>
                      <?php
                                       
                     if($numAdd>1){
                      printf('<img src="%s" alt="" /> ', $advertisement[1]['link']);
                    }                  

                  ?>
                   </div>

                
                  <!--End of third add-->

                   </div>
              
            <!--End of sidebar -->
    </div>
  <!--End of content area-->


    
    <!--Start of fourth add-->
    <div class="footer_top_area">
      <?php
                                       
                     if($numAdd>2){
                      printf('<div class="inner_footer_top"> <img src="%s" alt="" /> </div>', $advertisement[2]['link']);
                    } 
            ?>
      
    </div>
    <!--End of fourth add-->



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