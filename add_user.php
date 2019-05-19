




<?php 





 if (isset($_POST['submit'])) {
  
     $username  = $_POST['username'];
     
    $user_firstname  = $_POST['user_firstname'];
    $user_lastname  = $_POST['user_lastname'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $user_password = password_hash('$user_tmp_image', PASSWORD_BCRYPT,  array('cost' => 12 ));
    $user_role  = $_POST['user_role'];
    $user_image = $_FILES['user_image']['name'];
     $user_tmp_image = $_FILES['user_image']['tmp_name'];

    
    move_uploaded_file($user_tmp_image, "./images/$user_image");

    $query = "INSERT INTO USERS (username, user_firstname, user_lastname, user_password, user_email, user_role, user_image) ";
    $query .= "VALUES ('{$username}', '{$user_firstname}','{$user_lastname}', '{$user_password}', '{$user_email}', '{$user_role}', '{$user_image}') ";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("failed to connect ".mysqli_error($connection));
    }
    
   echo "<p class='bg-success' style='text-algn: center'> User Created: <a href='users.php'>View User</a></p>";
 }


?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">Firstname</label>
<input type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
<label for="post_author">Lastname</label>
<input type="text" class="form-control" name="user_lastname">
</div>

<div class="form-group">
<label for="post_category">User role</label><br>

<select name="user_role" id=""> 
 

// $query_user_role = "SELECT * FROM users";
//  $result_user_role = mysqli_query($connection, $query_user_role);

//  while($row = mysqli_fetch_assoc($result_user_role)){
//    $user_role = $row['user_role'];  
//    $user_id = $row['cat_id'];
//    echo "

 <option value="select">Select Options</option>
 <option value="Admin">Admin</option>
 <option value="Subscriber">Subscriber</option>
</select>



</div>



<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username">
</div>

<div class="form-group">
<label for="email">Email</label>
<input type="email" class="form-control" name="email">
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" name="password">
</div>
<div class="form-group">
<label for="image">User Image</label>
<input type="file" name="user_image">
</div>

</div>
<div class="form-group">

<input type="submit" class="btn btn-primary" name="submit" value="Add User">
</div>
</form>

