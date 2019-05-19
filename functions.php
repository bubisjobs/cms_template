<?php 






function insert_categories(){
global $connection;
                    
if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
   if($cat_title == ""  || empty($cat_title) ){
       echo "This field cannot be empty";
   } else {
       $query = "INSERT INTO categories (cat_title) VALUES ('{$cat_title}')";
       $result = mysqli_query($connection, $query);
       if(!$result){
           die("query falied"). mysqli_error($connection);
       }
   }

}


}
 function delete_categories(){

    global $connection;              
                        
    if (isset($_GET['delete'])) {
     $cat_delete = $_GET['delete'];
     
    $query = "DELETE FROM categories where cat_id = ${cat_delete}";
    $result = mysqli_query($connection, $query);
      header('Location: categories.php');
    }
    
    
    
 }


?>