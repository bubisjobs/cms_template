 <!-- editing and catching -->

 <form action="" method="POST">
                        
                        <div class="form-group">
                        
                        <label for="cat_title"> Edit Category</label>
                        </div>
                         <?php
 //                         if (isset($_GET['edit'])) {
 //                             $edit = $_GET['edit'];
 //                         $query = "SELECT * FROM categories WHERE cat_id = $edit";
 //                     $update_from_categories = mysqli_query($connection, $query);
                      
                     
                     
 //                     while($row = mysqli_fetch_assoc($update_from_categories)){
 //                         $cat_title = $row['cat_title'];
 //                         $cat_id = $row['cat_id'];
 
 
                                     if(isset($_GET['edit'])) {
                                  $cat_edit = $_GET['edit'];
                                     $query = "SELECT * FROM CATEGORIES WHERE cat_id = ${cat_edit}";
                                     $result = mysqli_query($connection, $query);
                                     while ($row = mysqli_fetch_assoc($result)) {
                                         $cat_title = $row['cat_title'];
                                         $cat_id = $row['cat_id'];
                                         $cat_title = mysqli_real_escape_string($connection, $cat_title);
                                         $cat_id = mysqli_real_escape_string($connection, $cat_id);
 
 ?>                                  
         <input type="text" value="<?php if(isset($cat_title)){ echo $cat_title;} ?>"  name="cat_title" class="form-control">
 
                                     
 
                                <?php }}?>
                    
                       <!-- updating it now -->
                     <?php 
                     if (isset($_POST['update'])) {
                        
                         $cat_updated = $_POST['cat_title'];
                        //  $cat_id = $_POST['cat_id'];
                           
 
                     $query = "UPDATE categories set cat_title = '{$cat_updated}' where cat_id = '{$cat_edit}'" ;
                     $result = mysqli_query($connection, $query);
                     if (!$result) {
                         die("failed". mysqli_error($connection));
                     }
                    header('Location: categories.php');
                     
                     }
                     
                     echo "<br>";
                     ?>
                        
                      
                        <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="update" value="Update Category">
                        
                        </div>
                        
                        
                        </form>