<?php
    include_once('php/dbConnection.php');
    include_once('php/allFunctions.php');
    
    ob_start();
        session_start();
        
         if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])){
            header("Location: php/error.php");
        }

	$id =  $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$sid = $_REQUEST['sid'];

    global $connection ;
        
	  $queryLink="SELECT * from $name where id='$id'";
    $result=mysqli_query($connection,$queryLink);
    $row=mysqli_fetch_assoc($result);
    $link=$row['link'];
    $query = "DELETE FROM $name WHERE id='$id'";

    mysqli_query($connection, $query);
    if(file_exists($link))
    unlink($link);

     $contents=getAllArticle($name);

     while ($row=mysqli_fetch_assoc($contents)) {
                                     printf("<tr id='%s'>", $row['id']);
                                      printf('<td>
                                        <div id="%s">

                                          <span>%s</span>

                                        </div>
                                        </td>', $row['head'], $row['head']);
                                       printf('<td>
                                        <div class="image_position">
                                          <div id="print"></div>

                                          <img src="%s" class="img img-responsive image_size_compression" >


                                        </div>
                                        </td>',$row['link']);

                                      printf('<td>
                                                              <span class="pull-right">
                                        <a type="button" class ="btn btn-primary" href="editContentsDetails.php?id=%s&name=%s">Edit </a>
                                         <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">Delete </button>
                                       </span>
                                        </td>


                                        <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                  <h4 class="modal-title">Delete Parmanently</h4>
                                                </div>
                                                <div class="modal-body">
                                                  <p>Are you sure about this ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    
                                                    <button type="button" class="btn btn-danger" id="confirm"  onclick=deleteContent(\'%s\', \'%s\', \'%s\')>Delete</button>
                                                 </div>
                                              </div>
                                            </div>
                                          </div>

                                        ',$row['id'],$name,$row['id'],$name, "2");
                                     print("</tr>");
                                  }
?>
