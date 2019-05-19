<table class="table table-bordered table-hover">
                    <thead> 
                     <tr>
                            
                                <th>Id</th>
                                <th>Author</th>
                                <th>Email</th>
                                <th>Content</th>
                                
                                <th>Status</th>
                                <th>Date</th>
                                <th>In Response to</th>
                                 <th>Delete</th>
                                      
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Edit</th>
                                
                          
                        </tr>
                        </thead>    
                        
                        
                            <tbody>
                            <?php 
                           $query =  "SELECT * FROM comments";
                           $result = mysqli_query($connection, $query);
                           
                           while($row = mysqli_fetch_assoc($result)){
                               $comment_id  = $row['comment_id'];
                               $comment_post_id  = $row['comment_post_id'];
                               $comment_author  = $row['comment_author'];
                               $comment_email  = $row['comment_email'];
                               $comment_status  = $row['comment_status'];
                               $comment_date  = $row['comment_date'];
                               $comment_content = $row['comment_content'];
                               
                               
                                echo "<tbody>";
                               echo "<tr>";
                              echo "<td> $comment_id</td>";
                              echo "<td>$comment_author</td>"; 
                              echo "<td> $comment_email</td>";
                              echo "<td>  $comment_content</td>"; 
                              
                              echo "<td>$comment_status</td>";
                            
                               echo "<td> $comment_date</td>"; 
                            

                                $query = "SELECT * FROM POSTS WHERE post_id = $comment_post_id ";
                                $select_all_from_posts = mysqli_query($connection, $query);
                                if (!$select_all_from_posts) {
                                    die("connection failed " .mysqli_error($connection));
                                }
                            
                             while($row1 = mysqli_fetch_assoc($select_all_from_posts)){
                                 $post_title = $row1['post_title'];
                                 $post_id = $row1['post_id'];

                                 echo "<td><a href='../post.php?pid={$post_id}'>$post_title</a></td>";
                             }
                             
                               echo "<td><a href='comments.php?delete=${comment_id}'>Delete</a></td>";
                                echo "<td><a href='comments.php?approve=${comment_id}'>Approve</a></td>";
                                echo "<td><a href='comments.php?unapprove=${comment_id}'>Unapprove</a></td>";
                                echo "<td><a href='comments.php?edit_comments=${comment_id}'>Edit</a></td>";
                               echo "</tr>";
                               echo "</tbody>";
                          }
                          ?>                     
                            </tbody>
                        
                         <?php 
if (isset($_GET['unapprove'])) {
    $approve_comment =  $_GET['unapprove'];
    
 $query = "UPDATE comments set comment_status = 'unapproved' where comment_id = {$approve_comment}";
 $delete_query = mysqli_query($connection, $query);
 if (!$delete_query) {
     die("query has faild woefuly");
     
 }
 header("Location: comments.php");
}


 if (isset($_GET['approve'])) {
    $approve_comment =  $_GET['approve'];
    
 $query = "UPDATE comments set comment_status = 'approved' where comment_id = {$approve_comment}";
 $delete_query = mysqli_query($connection, $query);
 if (!$delete_query) {
     die("query has failed woefuly");
     
 }
 header("Location: comments.php");
 }

                         if (isset($_GET['delete'])) {
                            $delete_comment =  $_GET['delete'];
                            
                         $query = "DELETE FROM Comments WHERE comment_id = ${delete_comment}";
                         $delete_query = mysqli_query($connection, $query);
                         if (!$delete_query) {
                             die("query has faild woefuly");
                             
                         }
                         header("Location: comments.php");
                         }
                        
                        
                        ?> -->
                    </table>

                    