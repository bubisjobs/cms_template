




<form action="" method="post" enctype="multipart/form-data">

<?php 
///we are tring to get the id ofthe edit button
//that is we are slecting by id
// we are trying to get the values inorderfor it to be edited
if (isset($_GET['pid'])) {
    $edit_post = $_GET['pid'];

$query = "SELECT * FROM POSTS where post_id = '{$edit_post}'";
     $update_result = mysqli_query($connection, $query);
     
     while($row = mysqli_fetch_assoc($update_result)){
         $post_id = $row['post_id'];
     $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_author = $row['post_author'];
    $post_status = $row['post_status'];
    $post_content = $row['post_content'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
         

     }

    }    
// UPDATING THE POST
if(isset($_POST['update_post'])){
    
    
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_content = $_POST['post_content'];
    $post_image = $_FILES['image']['name'];
    $post_tmp_image = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    
    
    $post_date = date('d-m-y');
    move_uploaded_file($post_tmp_image, "./images/$post_image");
    $post_author = mysqli_real_escape_string($connection, $post_author);
    $post_title = mysqli_real_escape_string($connection, $post_title);
     $post_category_id = mysqli_real_escape_string($connection, $post_category_id);
     $post_status = mysqli_real_escape_string($connection, $post_author);
     $post_content = mysqli_real_escape_string($connection, $post_content);
     $post_status = mysqli_real_escape_string($connection, $post_status);
     $post_tags = mysqli_real_escape_string($connection, $post_tags);

    //we want our image to e displyed on the edit page before sending
    //thhis is because it diesnt display after we have clciked the update buttob
    if(empty($post_image)){
    $select_image = " SELECT * FROM POSTS WHERE post_id = {$edit_post} ";
    $result_image = mysqli_query($connection, $select_image);
    while($row = mysqli_fetch_assoc($result_image)){
        $post_image = $row['post_image'];
    }
        
    }

  $query = "UPDATE posts set post_title = '{$post_title}',  ";
  $query .= "post_category_id = '{$post_category_id}',  ";
  $query .= "post_author = '{$post_author}',  ";
  $query .= "post_status = '{$post_status}',  ";
  $query .= "post_content = '{$post_content}',  ";
  $query .= "post_image = '{$post_image}',  ";
  $query .= "post_tags = '{$post_tags}',  ";
  $query .= "post_date = now()  ";
  $query .= "WHERE post_id = '{$edit_post}' ";

  
  $result = mysqli_query($connection, $query);
  echo "<p class='bg-success' style='text-algn: center'> Post Updated: <a href='posts.php'>View Posts</a></p>";
  if (!$result) {
      die("failed" .mysqli_error($connection));
  }


}




?>
<div class="form-group">
<label for="title">Post Title</label>
<input value="<?php if (isset($post_title)) {
    echo $post_title;
} ?>" type="text" class="form-control" name="title">
</div>

<div class="form-group">
<label for="post_category">Post Category Id</label> <br>
<!-- <input 
} ?>" type="text" class="form-control" name="post_category_id"> -->
<select name="post_category_id" id="post_category_id">
    <?php
     $query = "SELECT * FROM categories where cat_id = $post_category_id ";
     $result = mysqli_query($connection , $query);
    
     while($row = mysqli_fetch_assoc($result)){
         $cat_id = $row['cat_id'];
         $cat_title = $row['cat_title'];


    echo "<option value='{$cat_id}'> $cat_title </option>"; 
     }
     
    ?>
    
</select>
</div>



<div class="form-group">
<label for="post_author">Post Author</label>
<input type="text"  value="<?php if (isset($post_author)) {
    echo $post_author;
} ?>"class="form-control" name="post_author">
</div>
<div class="form-group">
<label for="post_status">Post Status</label>
<!-- <input type="text"  value="<?php if (isset($post_status)) {
   
} ?>" class="form-control" name="post_status"> -->
<select name="post_status" id="" class="input-group">
  <option value="draft">Draft</option>
  <option value="published">published</option>


</select>
</div>

<div class="form-group">
<!-- <label for="image">Image</label> -->
 <input type="file"  value="" name="image"> <br>
<img  width ="100px" src="./images/<?php echo $post_image; ?>">
</div>
<div class="form-group">
<label for="post_Tags">Post Tags</label>
<input type="text"  value="<?php if (isset($post_tags)) {
    echo $post_tags;
} ?>" class="form-control" name="post_tags">
</div>
<div class="form-group">
<label for="post_content">Post Content</label>
<textarea name="post_content"  id="" cols="30" rows="10" class="form-control"><?php 
echo $post_content;
   ?>
</textarea>
</div>

<div class="form-group">

<input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
</div>
</form>

<?php 




?>