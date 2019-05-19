<table class="table table-bordered table-hover">
                    <thead> 
                     <tr>
                            
                                <th>Id</th>
                                <th>Username</th>
                                <th>User firstname</th>
                                <th>User Lasttname</th>
                                <th>User Password</th>
                                <th>User Email</th>
                                <th>User Images</th>
                                <th>User role</th>
                                <th>Admin</th>
                                <th>Subscriber</th>
                                <th>Delete</th>
                                <th>Edit</th>
                        </tr>
                        </thead>    
                        
                      
                            <tbody>
                            <?php 
                           $query =  "SELECT * FROM USERS";
                           $result = mysqli_query($connection, $query);
                           
                           while($row = mysqli_fetch_assoc($result)){
                               $user_id  = $row['user_id'];
                               $username  = $row['username'];
                               $user_firstname  = $row['user_firstname'];
                               $user_lastname  = $row['user_lastname'];
                               $user_password  = $row['user_password'];
                               $user_email  = $row['user_email'];
                               $user_image  = $row['user_image'];
                               $user_role  = $row['user_role'];
                               
                               $user_password = password_hash($user_password, PASSWORD_BCRYPT,  array('cost' => 12 ));
                              
                               
                                echo "<tbody>";
                               echo "<tr>";
                              echo "<td> $user_id</td>";
                             
                               echo "<td>$username</td>"; 
                               echo "<td>$user_firstname</td>"; 
                               echo "<td>$user_lastname</td>"; 
                               echo "<td>$user_password</td>"; 


                              echo "<td> $user_email</td>"; 
                           
                               echo " <td> <img width='100px' src='./images/$user_image'</td>";
                               
                               
                               echo "<td> $user_role</td>";
                                
                               echo "<td><a href='users.php?change_to_admin=${user_id}'>Admin</a></td>";
                               echo "<td><a href='users.php?change_to_sub=${user_id}'>Subscriber</a></td>";
                               echo "<td><a href='users.php?delete=${user_id}'>Delete</a></td>";
                               echo "<td><a href='users.php?source=edit_user&p_id=${user_id}'>Edit</a></td>";
                               echo "</tr>";
                               echo "</tbody>";
                          } 
                          
                         
                          ?>          
                            </tbody>
                        



<?php 


if (isset($_GET['change_to_admin'])) {
    $user_admin=  $_GET['change_to_admin'];
    
 $query = "UPDATE users set user_role = 'Admin' where user_id = {$user_admin}";
 $delete_query = mysqli_query($connection, $query);
 if (!$delete_query) {
     die("query has faild woefuly");
     
 }
 header("Location: users.php");
}





if (isset($_GET['change_to_sub'])) {
    $user_admin=  $_GET['change_to_sub'];
    
 $query = "UPDATE users set user_role = 'Subscriber' where user_id = {$user_admin}";
 $delete_query = mysqli_query($connection, $query);
 if (!$delete_query) {
     die("query has faild woefuly");
     
 }
 header("Location: users.php");
}
?>

                       
                        <?php 
                        if (isset($_GET['delete'])) {
                            $delete =  $_GET['delete'];

                        
                        
                        $query = "DELETE FROM users where user_id =  $delete";
                        $delete_all = mysqli_query($connection, $query);

                        if(!$delete_all){
                            die("query failed". mysqli_error($connection));
                        }
                        header("Location: users.php");
                    }
                        ?>
                        
                    
                    </table>