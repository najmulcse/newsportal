<?php
include_once('php/allFunctions.php');

function getContentBody(){


     $result = getCategory();

     while ($row = mysqli_fetch_assoc($result)) {
     	$cid = $row['id'];
          $cname=$row['name'];
     	$res = getSubCategory($cid);
     	print('<tr>');

     			print('<td>');
     			printf('<a href="categorydetails.php?id=%s&name=%s" target="_blank">%s</a>
					   
					 </td> ',$row['id'], $row['name'], $row['name']);

     			 

     			print('<td>');
     			print('<ul>');
     			while($rw = mysqli_fetch_assoc($res)){
     				printf('<li> <a href="findContents.php?cid=%s&cname=%s&sid=%s&sname=%s" target="_blank">%s</a>
							
     					</li>', $cid,$cname,$rw['id'] ,$rw['name'],$rw['name']);
     			}
     			print('</ul>');
     			print('</td>');

     	print('</tr>');
     }

}



          function getArticleBody($name){
               switch ($name){
               case 'article':
                    $result=getAllArticle($name);
                               if(isset($result)){
                                    while ($row=mysqli_fetch_assoc($result)) {
                                     printf("<tr>");
                                      printf('<td>
                                        <div id="%s">

                                          <span>%s</span>
                                          <div id="print"></div>

                                        </div>
                                        </td>', $row['head'], $row['head']);
                                       printf('<td>
                                        <div class="image_position">
                                          

                                          <img src="%s" class="img img-responsive image_size_compression" >


                                        </div>
                                        </td>',$row['link']);

                                      printf('<td>
                                                              <span class="pull-right">
                                        <a type="button" class ="btn btn-primary" href="extraContentsDetails.php?aid=%s&name=%s">Edit </a>
                                         <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this contents ?">Delete </button>
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
                                                    
                                                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="confirm"  onclick=deleteContentExtra(\'%s\',\'%s\',\'%s\')>Delete</button>
                                                 </div>
                                              </div>
                                            </div>
                                          </div>

                                        ',$row['id'],$name, $row['id'],$name, "2");
                                     print("</tr>");
                                  }

                       } 

                       break;


                       case 'editorial':
                       
                    $result=getAllArticle($name);
                               if(isset($result)){
                                    while ($row=mysqli_fetch_assoc($result)) {
                                     printf("<tr>");
                                      printf('<td>
                                        <div id="%s">

                                          <span>%s</span>
                                          <div id="print"></div>

                                        </div>
                                        </td>', $row['head'], $row['head']);
                                       printf('<td>
                                        <div class="image_position">
                                          

                                          <img src="%s" class="img img-responsive image_size_compression" >


                                        </div>
                                        </td>',$row['link']);

                                      printf('<td>
                                                              <span class="pull-right">
                                        <a type="button" class ="btn btn-primary" href="extraContentsDetails.php?aid=%s&name=%s">Edit </a>
                                         <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDeleteEditorial" data-title="Delete User" data-message="Are you sure you want to delete this user ?">Delete </button>
                                       </span>
                                        </td>


                                        <div class="modal fade" id="confirmDeleteEditorial" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
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
                                                    
                                                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="confirm"  onclick=deleteContentExtra(\'%s\',\'%s\',\'%s\')>Delete</button>
                                                 </div>
                                              </div>
                                            </div>
                                          </div>

                                        ',$row['id'],$name, $row['id'], $name, "2");
                                     print("</tr>");
                                  }

                       } 

                       break; 

                        case 'desk':
                    $result=getAllArticle($name);
                               if(isset($result)){
                                    while ($row=mysqli_fetch_assoc($result)) {
                                     printf("<tr>");
                                      printf('<td>
                                        <div id="%s">

                                          <span>%s</span>
                                          <div id="print"></div>

                                        </div>
                                        </td>', $row['head'], $row['head']);
                                       printf('<td>
                                        <div class="image_position">
                                          

                                          <img src="%s" class="img img-responsive image_size_compression" >


                                        </div>
                                        </td>',$row['link']);

                                      printf('<td>
                                                              <span class="pull-right">
                                        <a type="button" class ="btn btn-primary" href="extraContentsDetails.php?aid=%s&name=%s">Edit </a>
                                         <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDeleteDesk" data-title="Delete User" data-message="Are you sure you want to delete this user ?">Delete </button>
                                       </span>
                                        </td>


                                        <div class="modal fade" id="confirmDeleteDesk" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
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
                                                    
                                                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="confirm"  onclick=deleteContentExtra(\'%s\',\'%s\',\'%s\')>Delete</button>
                                                 </div>
                                              </div>
                                            </div>
                                          </div>

                                        ',$row['id'],$name, $row['id'],$name, "2");
                                     print("</tr>");
                                  }

                       } 

                       break;   
}
}




?>