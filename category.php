
<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php' ;?>



    <?php include 'includes/navigation.php'; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php 
  if(isset($_GET['category'])){
                        $the_category = $_GET['category'];
                        
                    }

   $query = "SELECT * FROM posts where post_category_id = $the_category";
   $select_all_from_post = mysqli_query($connection, $query);
       

     while($row = mysqli_fetch_assoc($select_all_from_post)){
    $post_id = $row['post_id'];
      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = substr($row['post_content'], 0, 100);
      
  
      

      
?>
 <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?pid=<?php echo $post_id ?>"> <?php  echo $post_title ;?> </a>
                </h2>
                <p class="lead">
                    by <a href="index.php"> <?php  echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php  echo $post_date ;?></p>
                <hr>
                <img class="img-responsive" src="../CMS_TEMPLATE/admin/images/<?php echo $post_image ;?>" alt="">
                <hr>
                <p> <?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?source=edit_post&pid=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

    <?php }?>



                
            </div>
    
        
            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'  ?>

        <hr>

       <?php include 'includes/footer.php'; ?>