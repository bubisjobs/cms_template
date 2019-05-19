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
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
                       
                        <!-- adding to the category -->
                        <div class="col-xs-6">
                        <!-- <?php  insert_categories(); ?> -->
                        <form action="" method="post">
                       
                        <label for="cat_title"> Add Category</label>
                        <div class="form-group">
                        <input type="text" class="form-control" name="cat_title">
                        
                        </div>
                        <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                        
                        </div>
                        
                        
                        </form>
                    <?php 
                    
                    // this allows the edit to pop up afte

                    if (isset($_GET['edit'])) {
                        $cat_id = $_GET['edit'];
                        include "includes/update_categories.php";
                    }
                    
                    
                    
                    
                    
                    
                    ?>
                     
                        </div>
                        <?php
                    $query = "SELECT * FROM categories";
                    $select_from_categories = mysqli_query($connection, $query);
 ?>
                        <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                          <thead>
                           <tr>
                                <th>Id</th>
                                  <th>Category</th>
                                  <th>Delete</th>
                                  <th>Edit</th>
                           </tr>
                        
                          </thead>
                          <tbody>
                          
                          <?php 
                           while($row = mysqli_fetch_assoc($select_from_categories)){
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            $cat_title = mysqli_real_escape_string($connection, $cat_title);
                            $cat_id = mysqli_real_escape_string($connection, $cat_id);
                            echo "<tr>";
                            echo " <td> ${cat_id}</td>";
                            echo " <td> ${cat_title}</td>";
                            echo "<td><a href='categories.php?delete=${cat_id}'>Delete</a></td>";
                            echo "<td><a href='categories.php?edit=${cat_id}'>Edit</a></td>";
                            echo "</tr>";
                           }
                          ?>
                          <!-- deleting  -->
                          <?php  delete_categories()  ?>
                        
                    
                          
                          </tbody>
                        
                        </table>
                        
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

<?php include 'includes/admin_footer.php' ?>