<?php include 'includes/admin_header.php' ?>


    <div id="wrapper">
    <?php include 'includes/admin_navigation.php' ?>
        <div id="page-wrapper">
         
        
        
       

           
           
            <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Welcome Admin
            <small>Author</small>
           </h1>

           <?php 
           if(isset($_SESSION['username'])) {
               
            $username = $_SESSION['username'];

            $query = "SELECT * FROM users where username = '{$username}'";
            $select_all_from_users =  mysqli_query($connection, $query);
         while( $row = mysqli_fetch_assoc($select_all_from_users) ){
             $username_db_user = $row['username'];
             $userlastname_db_user = $row['user_lastname'];
             $password_db_user = $row['user_password'];
             $firstname_db_user = $row['user_firstname'];
             $email_db_user = $row['user_email'];
             $image_db_user = $row['user_image'];
             $user_role_db_user = $row['user_role'];
            //  $username_db_user = $row['user_image'];
           
         }    

        }
           ?>



       
           
<div class="form-group">
<label for="title">Firstname</label>
<input type="text" value="<?php echo $username_db_user ?>" class="form-control" name="user_firstname">
</div>






<div class="form-group">
<label for="user_lastname">Lastname</label>
<input type="text"  value="<?php echo $userlastname_db_user ?>"class="form-control" name="user_lastname">
</div>

<div class="form-group">
<label for="user_role">User Role</label> <br>

<select name="user_role" id="">
    <?php
     echo "<option value='${user_role_db_user}'>Admin</option>";
     echo "<option value='${user_role_db_user}'>Subscriber</option>";
    ?>
    
</select>
</div>



<div class="form-group">
<label for="post_status">Username</label>
<input type="text"  value="<?php echo $username ?>" class="form-control" name="username">
</div>


<div class="form-group">
<label for="password">Email</label>
<input type="text"  value="<?php echo $email_db_user?>" class="form-control" name="email">
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" name="password" value="<?php 
echo $password_db_user?>" class="form-control">
   
</textarea>
</div>
<div class="form-group">
<!-- <label for="image">Image</label> -->






<input type="file"  value="" name="user_image"> <br>
<img  width ="100px" src="./images/<?php echo $image_db_user; ?>">
</div>
<div class="form-group">

<input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
</div>
</form>

 </div>
    </div>
</div>
<!-- /.row -->

</div>


<!-- /.container-fluid -->

<?php include 'includes/admin_footer.php' ?>