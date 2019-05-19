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
                            <small> <?php echo  $_SESSION['username']?></small>
                           </h1>
                            
                           <?php 
        
        if (isset($_GET['newsource'])) {
            $source = $_GET['newsource'];
            
        } else {
            $source  = "";

        }   
        
        switch($source){
            
            case "add_comments";
            echo "bubis";
            break;

            // case "edit_post";
            // include "includes/edit.php";
            // break;

            default:
            include "includes/view_all_comments.php";
            break;


        }
                ?>
                       
                       
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

<?php include 'includes/admin_footer.php' ?>