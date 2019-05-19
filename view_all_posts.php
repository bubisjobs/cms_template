<?php 

if (isset($_POST['checkBoxArray'])) {
    $checkBox = $_POST['checkBoxArray'];



    foreach ($checkBox as $checkBox_Item) {
      
    
 $bulkOption = $_POST['bulkOption'];

 switch ($bulkOption ) {
     case 'published':
 $query = "UPDATE posts set post_status = '{$bulkOption}' where post_id = {$checkBox_Item} ";
 $select_publish_post = mysqli_query($connection, $query);
 if (!$select_publish_post) {
     die("query failed. ".mysqli_error($connection));
 }
      break;

      case 'draft':
 $query = "UPDATE posts set post_status = '{$bulkOption}' where post_id = {$checkBox_Item} ";
 $select_draft_post = mysqli_query($connection, $query);
 if (!$select_draft_post) {
     die("query failed. ".mysqli_error($connection));
 }
      break;
     

      case 'delete':
      $query = "DELETE  from posts where post_id = {$checkBox_Item} ";
      $select_draft_post = mysqli_query($connection, $query);
      if (!$select_draft_post) {
          die("query failed. ".mysqli_error($connection));
      }
           break;

           

     default:
         # code...
         break;
 }

    }
    
}

?>
<form action="" method="post">
<table class="table table-bordered table-hover">
<div id="bulkOptionContainer" class="col-xs-4">
 <select name="bulkOption" id="" class="form-control">
<option value="">Select Options</option>
<option value="draft">Draft</option>
<option value="published">Published</option>
<option value="delete">Delete</option>
<option value="clone">Clone</option>
</select> <br>
</div>
<div class="col-xs-4">
  <input type="submit" class="btn btn-success" name="submit"  value="Apply">
  <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
</div>

                    <thead> 
                     <tr>
                            <th><input type="checkbox" name="" id="checkbox"></th>

                                <th>Id</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Images</th>
                               
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>Content</th>
                                <th>View Post</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th> View Count</th>
                                <th>Reset Views</th>
                                <th>Post User</th>
                          
                        </tr>
                        </thead>    
                        
                        
                            <tbody>
                            <?php 
                           $query =  "SELECT * FROM POSTS";
                           $result = mysqli_query($connection, $query);
                           
                           while($row = mysqli_fetch_assoc($result)){
                               $post_id  = $row['post_id'];
                               $post_author  = $row['post_author'];
                               $post_title  = $row['post_title'];
                               $post_category_id  = $row['post_category_id'];
                               $post_status  = $row['post_status'];
                               $post_image  = $row['post_image'];
                               $post_content = $row['post_content'];
                               $post_comment_count  = $row['post_comment_count'];
                               $post_tags = $row['post_tags'];
                               $post_date = $row['post_date'];
                               $post_view_count = $row['view_count'];
                               $post_user =$row['post_user'];
                               $post_author = mysqli_real_escape_string($connection, $post_author);
     $post_title = mysqli_real_escape_string($connection, $post_title);
     $post_category_id = mysqli_real_escape_string($connection, $post_category_id);
     $post_status = mysqli_real_escape_string($connection, $post_author);
     $post_content = mysqli_real_escape_string($connection, $post_content);
     $post_status = mysqli_real_escape_string($connection, $post_status);
     $post_tags = mysqli_real_escape_string($connection, $post_tags);
                               
                                echo "<tbody>";
                               echo "<tr>";
                               ?>
                             <td>  <input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value="<?php echo $post_id?>"></td>
                               <?php
                              echo "<td> $post_id</td>";
                             
                               echo "<td>$post_author</td>"; 
                               echo "<td>$post_title</td>"; 

                               $query = "SELECT * FROM CATEGORIES WHERE cat_id = {$post_category_id}";
                                $result_cat = mysqli_query($connection, $query);
                                while ($row_cat = mysqli_fetch_assoc($result_cat))
                                 {
                                   $cat_title = $row_cat['cat_title'];
                                    $cat_id = $row_cat['cat_id'];

                              echo "<td> {$cat_title}</td>"; }
                               echo "<td> $post_status</td>";
                               echo " <td> <img width='100px' src='./images/$post_image'</td>";

                               echo "<td> $post_tags</td>";

                               //weare getting the post_comment count
                      $query = "SELECT * FROM comments where  comment_post_id = $post_id ";
                      $select_past_comment_count = mysqli_query($connection, $query);
                      if (!$select_past_comment_count) {
                          die("connection failed ".mysqli_error($connection));
                      }
                      $count_post_comment = mysqli_num_rows($select_past_comment_count);
                        
                       $query = "SELECT * FROM POSTS Where post_id = $post_id ";
                       $goto_the_particular_post = mysqli_query($connection, $query);
                       while ($row = mysqli_fetch_assoc($goto_the_particular_post)){
                           $the_post_id = $row['post_id'];
                       }
                               echo "<td><a href='../post.php?pid=$the_post_id'>$count_post_comment</a></td>"; 
                               echo "<td>$post_date</td>"; 
                               echo "<td>$post_content</td>";
                               echo "<td><a href='../post.php?pid=${post_id}'>View post</a></td>  ";       
                               echo "<td><a onClick=\" javascript: confirm('Are you sure you want to delete this record?')\" href='posts.php?delete=${post_id}'>Delete</a></td>";
                               echo "<td><a href='posts.php?source=edit_post&pid=${post_id}'>Edit</a></td>";
                               echo "<td>$post_view_count</td>";   
                               echo "<td><a href= posts.php?reset=${post_id}>Reset Views</a></td>"; 
                            //    if(isset($_SESSION['username'])){
                            //         $username = $_SESSION['username'];
                                  
                            //    }  
                            
                            //     $query = "SELECT * from USERS where username = '$post_user'";
                            //     $query .= " AND user_id = $post_id";
                            //     $select_post_user = mysqli_query($connection, $query);
                            //     if (!$select_post_user) {
                            //        die("connection failed ".mysqli_error($connection));
                            //     }
                            // while($row = mysqli_fetch_assoc($select_post_user)){
                            //     $user_id = $row['user_id'];
                            //     $user_post = $row['username'];

                            //     echo "<td> $user_post</td>";    
                            // }
                            // echo "<td> $post_user</td>";             
                                echo "</tr>";

                               echo "</tbody>";
                          } 
                          
                         
                          ?>                     
                            </tbody>
                            <?php 
                            if (isset($_GET['reset'])) {
                                $reset = $_GET['reset'];


                                $query = "UPDATE posts set view_count = 0 ";
                            $query .= "where post_id = $reset";
                            $refresh_view_count = mysqli_query($connection, $query);
                            if (!$refresh_view_count) {
                                die("failed". mysqli_error($connection));
                            }
                            header("Location: posts.php");
                            }
                            
                            
                            
                            ?>
                        
                        <?php 
                         if (isset($_GET['delete'])) {
                            $delete_post =  $_GET['delete'];
                            
                         $query = "DELETE FROM POSTS WHERE post_id = ${delete_post}";
                         $delete_query = mysqli_query($connection, $query);
                         if (!$delete_query) {
                             die("query has faild woefuly");
                             
                         }
                         header("Location: posts.php");
                         }
                        
                        
                        ?>
                    </table>
                    </form>