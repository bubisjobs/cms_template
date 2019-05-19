

<?php 
///we are tring to get the id ofthe edit button
//that is we are slecting by id
// we are trying to get the values inorderfor it to be edited
if (isset($_GET['p_id'])) {
    $edit_user = $_GET['p_id'];
   

    
$query = " SELECT * FROM USERS where user_id = '{$edit_user}' ";
     $query_user = mysqli_query($connection, $query);
   
   
     
     while($row = mysqli_fetch_assoc($query_user)){
      
     $username  = $row['username'];
     
     $user_firstname  = $row['user_firstname'];
     $user_lastname  = $row['user_lastname'];
     $user_email = $row['user_email'];
     $user_password = $row['user_password'];
 
     $user_role  = $row['user_role'];
    $user_image = $row['user_image'];
         

    }


    }    


?>
<form action="" method="post" enctype="multipart/form-data">

 <!-- UPDATING THE POST -->
 <?php
 if(isset($_POST['update_user'])){
    
    $username  = $_POST['username'];
     
    $user_firstname  = $_POST['user_firstname'];
    $user_lastname  = $_POST['user_lastname'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    $user_role  = $_POST['user_role'];
    $user_image = $_FILES['user_image']['name'];
     $user_tmp_image = $_FILES['user_image']['tmp_name'];
    
    move_uploaded_file($user_tmp_image, "./images/$user_image");
    

     //we want our image to e displyed on the edit page before sending
     //thhis is because it diesnt display after we have clciked the update buttob
     if(empty($user_image)){
     $select_image = " SELECT * FROM users WHERE user_id = {$edit_user} ";
     $result_image = mysqli_query($connection, $select_image);
     while($row = mysqli_fetch_assoc($result_image)){
         $user_image = $row['user_image'];
     }
        
    }
 ///this willmake the shorter password be dispalyed when an date button is clciked;

//  $query_randsalt= "SELECT randsalt from users ";
//  $result = mysqli_query($connection, $query_randsalt);

//  while($row = mysqli_fetch_assoc($result)){
//      $salt = $row['randsalt'];

//  };
//  $hashed_password = crypt($user_password, $salt);
 
$user_password = password_hash('$user_password', PASSWORD_BCRYPT, array('cost' => 12));

   $query = "UPDATE users set user_firstname = '{$user_firstname}',  ";
   $query .= "user_lastname = '{$user_lastname}',  ";
   $query .= "user_email = '{$user_email}',  ";
   $query .= "user_password = '{$user_password}',  ";
   $query .= "user_image = '{$user_image}',  ";
   $query .= "user_role = '{$user_role}',  ";
   $query .= "username = '{$username}'  ";
   $query .= "WHERE user_id = '{$edit_user}' ";

   $result = mysqli_query($connection, $query);

   echo "<p class='bg-success' style='text-algn: center'>User Updated: <a href='users.php'> View User</a></p>";
   if (!$result) {
       die("failed" .mysqli_error($connection));
   }


}




?> 


<div class="form-group">
<label for="title">Firstname</label>
<input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
</div>






<div class="form-group">
<label for="user_lastname">Lastname</label>
<input type="text"  value="<?php echo $user_lastname ?>"class="form-control" name="user_lastname">
</div>

<div class="form-group">
<label for="user_role">User Role</label> <br>

<select name="user_role" id="">
    <?php
     echo "<option value='${user_role}'>Admin</option>";
     echo "<option value='${user_role}'>Subscriber</option>";
    ?>
    
</select>
</div>



<div class="form-group">
<label for="post_status">Username</label>
<input type="text"  value="<?php echo $username ?>" class="form-control" name="username">
</div>


<div class="form-group">
<label for="password">Email</label>
<input type="text"  value="<?php echo $user_email?>" class="form-control" name="email">
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" name="password" value="<?php 
echo $user_password?>" class="form-control">
   
</textarea>
</div>
<div class="form-group">
<!-- <label for="image">Image</label> -->






<input type="file"  value="" name="user_image"> <br>
<img  width ="100px" src="./images/<?php echo $user_image; ?>">
</div>
<div class="form-group">

<input type="submit" class="btn btn-primary" name="update_user" value="Update User">
</div>
</form>

<?php 





?>