
<?php include 'includes/admin_header.php' ?>

    <div id="wrapper">
    <?php include 'includes/admin_navigation.php' ?>
        <div id="page-wrapper">

        <!-- users online setup -->
 <?php
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM USERS_ONLINE where session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);
    // echo  "<h1>Users Online:  $count</h2>";
if ($count == null) {
    $query = "INSERT INTO USERS_ONLINE (session, time) values ('$session', $time)";
    $query_confirm = mysqli_query($connection, $query);
}else {
    $query = "UPDATE USERS_ONLINE set session = '$session' where time = $time";
  $query_confirm = mysqli_query($connection, $query);
}
$users_online = mysqli_query($connection, "SELECT * FROM USERS_ONLINE WHERE time > '$time_out'");
$count_users_online = mysqli_num_rows($users_online);
echo  "<h1>Users Online:  $count_users_online </h2>";

        ?>
        <?php 
            global $connection;
            if(!$connection){
            echo 'false connection'.mysqli_error();
            }
        
        ?>

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    
                </div>
            </div>
            

                   
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <?php
            $query = "SELECT * FROM Posts";
            $select = mysqli_query($connection, $query);
            $count_post = mysqli_num_rows($select)
    
                
                        ?>
                    <div class="col-xs-9 text-right">
                  <div class='huge'><?php echo $count_post?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <?php
            $query = "SELECT * FROM Comments";
            $select = mysqli_query($connection, $query);
            $count_com = mysqli_num_rows($select)
    
                
                        ?>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?php echo $count_com?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php  
                    
        $query = "SELECT * FROM USERS";
        $select = mysqli_query($connection, $query);
        $count_users = mysqli_num_rows($select)

            
                    ?>
                    <div class='huge'><?php echo $count_users?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <?php
            $query = "SELECT * FROM Categories";
            $select = mysqli_query($connection, $query);
            $count_cat = mysqli_num_rows($select)
    
                
                        ?>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $count_cat?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
          
            
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
<?php 
$query = "SELECT * FROM posts where post_status = 'published'";
$select_post_published = mysqli_query($connection, $query);
$count_post_published = mysqli_num_rows($select_post_published);

 $query = "SELECT * FROM posts where post_status = 'draft'";
 $select_post_draft = mysqli_query($connection, $query);
 $count_post_draft = mysqli_num_rows($select_post_draft);

 $query = "SELECT * FROM comments where comment_status = 'unapproved'";
 $select_unapproved_comments = mysqli_query($connection, $query);
 $count_unapproved_comments = mysqli_num_rows($select_unapproved_comments);


 $query = "SELECT * FROM users where user_role = 'Subscriber'";
 $select_user_subcriber = mysqli_query($connection, $query);
 $count_subscriber_user = mysqli_num_rows($select_user_subcriber);


 
?>
                

                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
           ['Data', 'Count'],
           
           <?php 
            
            $elements_name = ['Active Posts','Draft Posts', 'Published Post' , 'Comments','Unapproved Comments', 'Categories', 'Users','User Subcribers'];
            $elements_count = [ $count_post, $count_post_draft, $count_post_published , $count_com,$count_unapproved_comments , $count_cat ,$count_users, $count_subscriber_user ];

      for($i =0; $i < 8; $i++){
       echo "['{$elements_name[$i]}'"  . "," . "{$elements_count[$i]}],";
    }
            ?>
        //   ['Data', 'Count'],
        //   ['Posts', 1000]
        
        ]);

        var options = {
          chart: {
            title: 'Barchat of your session',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>



        </div>
        <div class="container">
        <div class="row">
        <div id="columnchart_material" style="width: 'auto'; height: 600px; text-align:center;" class="col"></div>
        
        </div>
        </div>
<?php include 'includes/admin_footer.php' ?>