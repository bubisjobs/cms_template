
<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php' ;?>



    <?php include 'includes/navigation.php'; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php 

if (isset($_GET['pid'])) {
    $the_post_id = $_GET['pid'];
}

   $query = "SELECT * FROM posts where post_id = $the_post_id";
   $select_all_from_post = mysqli_query($connection, $query);
       

     while($row = mysqli_fetch_assoc($select_all_from_post)){
     
      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
      
  
      

      
?>
 <h1 class="page-header">
                   
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?pid=<?php echo $the_post_id ?>"> <?php  echo $post_title ;?> </a>
                </h2>
                <p class="lead">
                    by <a href="author.php?author=<?php  echo $post_author?>&pid=<?php  echo $the_post_id;?>"> <?php  echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php  echo $post_date ;?></p>
                <hr>
                <img class="img-responsive" src="../CMS_TEMPLATE/admin/images/<?php echo $post_image ;?>" alt="">
                <hr>
                <p> <?php echo $post_content; ?></p>
                <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>

    <?php }?>

    <div class="well">
        <?php 
           if (isset($_POST['create_comment'])) {
               $the_post_id = $_GET['pid'];
         

               $comment_author = $_POST['comment_author'];
               
               $comment_email = $_POST['comment_email'];
               $comment_content = $_POST['comment_content'];
                $comment_author = mysqli_real_escape_string($connection, $comment_author);
                $comment_email = mysqli_real_escape_string($connection, $comment_email);
                $comment_content = mysqli_real_escape_string($connection, $comment_content);
            //  $post_comment_id = $_POST['post_comment_id'];
            //    $comment_date = date(d-m-y);

            if(empty($comment_author) && empty($comment_email) && empty($comment_content) ){
                echo "<p>The Fields Cannot be Empty..</p>";
            }else {
                $query = "INSERT INTO COMMENTS (comment_post_id, comment_author, comment_content, comment_email, comment_status, comment_date) values
             ('$the_post_id','$comment_author', '$comment_content)', '$comment_email', 'unapproved', now())";
            
            $newResult = mysqli_query($connection, $query);
            if(!$newResult){
                die('failed'.mysqli_error($connection));
            }
            

            }
            

           }


        $query = "SELECT * from posts where post_comment_count = $the_post_id ";
        $select_all_from_comments_post = mysqli_query($connection, $query);

        if(!$select_all_from_comments_post){
            die("query failed". mysqli_error($connection));
        }
        
        




        // $query = "UPDATE posts set post_comment_count = post_comment_count + 1 ";
        // $query .= "WHERE post_id = $the_post_id";

        $update_coment_count = mysqli_query($connection, $query);
        if (!$update_coment_count) {
            die("connection failed" .mysqli_error($connection));
        }
        ?>
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                    <label for="Author">Author</label>
                    <div class="form-group">
                            <input type="text" class="form-control" name="comment_author" id="">
                        </div>
                        <div class="form-group">
                        <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email" id="">
                        </div>
                        <div class="form-group">
                        <label for="content">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>
            
                <!-- Comment -->


                <?php //I AM TRYING TO CHECK THE NUMBER OF USERS THAT VIEWED A PARTICULAR POST;
$query = "UPDATE POSTS SET view_count = view_count + 1 ";
$query .= "where post_id = $the_post_id";
$select_view_count = mysqli_query($connection, $query);
if(!$select_view_count){
    die("connection failed ".mysqli_error($connection));
}?>
                


                
        


<div class="media">
<?php 
                $query = "SELECT * FROM comments where comment_post_id = {$the_post_id} ";
                //  $query .= "AND comment_status = 'approve' ";
                 $query .= "ORDER BY comment_id DESC ";
                
                
                $select_all_from_comments = mysqli_query($connection, $query);
              
                while($row = mysqli_fetch_assoc($select_all_from_comments)){
                
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
               
                
                ?>


                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment_author ?>          
                         <small> <?php echo $comment_date ?> </small>
                        </h4>
                        <?php echo $comment_content ?>
                       </div>
                       
                       <div></div>
                <?php
  
?>



                <br><br><br>
                
                        <?php }?>
                
        </div>
       
            </div>
        
    
                
        <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'  ?>

        <hr>

       <?php include 'includes/footer.php'; ?>