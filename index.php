
<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php' ;?>



    <?php include 'includes/navigation.php'; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php 

///pager details
    $query = "SELECT * FROM POSTS";
    $select_pager_count = mysqli_query($connection, $query);
    if (!$select_pager_count) {
    die("connection failed". mysqli_error($connection));
    }
    // $pager_count = mysqli_num_rows($select_pager_count);

   
    // pager detsials

   $query = "SELECT * FROM POSTS";
   $select_pager_count = mysqli_query($connection, $query);
   $find_count = mysqli_num_rows($select_pager_count);
    $find_count = ceil($find_count/5);
    // echo $find_count;
     // $pager_count = ceil($pager_count / 5);
    
     
    $per_page = 5;

    if (isset($_GET['pager'])) {
        $pager = $_GET['pager'];
    }else {
        $pager = "";
    }
    if ($pager == "" || $pager == 1) {
      $page_1 = 0;
    }else {
        $page_1 = ($page * $per_page) - $per_page;
    }

//   

   $query = "SELECT * FROM posts LIMIT $page_1, $per_page ";
   $select_all_from_post = mysqli_query($connection, $query);
       

     while($row = mysqli_fetch_assoc($select_all_from_post)){
      $post_id = $row['post_id'];
      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
      $post_status = $row['post_status'];
  
      if ($post_status == 'published') {
         
      
    ?>
    <!-- <h1 class="page-header">
    Page Heading
    <small>Secondary Text</small>
</h1> -->

<!-- First Blog Post -->
<h2>
    <a href="post.php?pid=<?php echo $post_id ?>"> <?php  echo $post_title ;?> </a>
</h2>
<p class="lead">
    by <a href="author.php?author=<?php  echo $post_author?>&pid=<?php  echo $post_id;?>"> <?php  echo $post_author;?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> <?php  echo $post_date ;?></p>
<hr>
<img class="img-responsive" src="../CMS_TEMPLATE/admin/images/<?php echo $post_image ;?>" alt="">
<hr>
<p> <?php echo $post_content; ?></p>
<a class="btn btn-primary" href="post.php?source=edit_post&pid=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>

      

       
    <?php }   }  ?>



                
            </div>
    
        
            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'  ?>

        <hr>
       </div>
        
        <ul class="pager">
        <?php 
        for ($i=1; $i <=$find_count ; $i++) { 
           
                echo "<li><a class='active_link' href='index.php?pager={$i}'>{$i}</a></li>";
           
            
        }
        
        // for ($i=1;  $i<=$pager_count; $i++) { 
        //     if ($i == $pager) {
        //         echo "<li class='pager'><a class='active_link' href='index.php?pager={$i}'>{$i}</a></li>";
        //     }
            
        // }
        
        ?>
        
        </ul>
       <?php include 'includes/footer.php'; ?>