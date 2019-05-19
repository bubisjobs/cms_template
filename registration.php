<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    <?php 
    
    if (isset($_POST['submit'])) {
    
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
       

if(!empty($username) && !empty($password) && !empty($email)){
    

$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);
$email = mysqli_real_escape_string($connection, $email);

// $query = "SELECT randsalt from users ";
// $select = mysqli_query($connection, $query);

// while($row = mysqli_fetch_assoc($select)){
//   $salt =  $row['randsalt'];
// }
// ///encrypting the password

//  $password = crypt($password, $salt);
// $password = password_hash('$password', PASSWORD_BCRYPT, array('cost' => 12));


$query = "INSERT INTO USERS (username, user_password, user_email, user_role) VALUES ";
$query.= " ('{$username}', '{$password}', '{$email}', 'subcriber' )";

$register = mysqli_query($connection, $query);
$message = "Your Registration is Successfully Submitted";
// if (!$register) {
//     die(" Query Failed. ". mysqli_error($connection) ." ". mysqli_errorno($connection) );
// }

    }else{
        $message = "Fields cannot be empty";
    }
   
}else {
    $message = "";
}

    ?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 style="text-align: center">Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                        <b><h5 class="text-center" ><?php echo $message; ?></h5></b>
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

   

<?php include "includes/footer.php";?>
