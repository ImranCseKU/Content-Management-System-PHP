<?php include_once "includes/db.php"; ?>
<?php include_once "includes/header.php";  ?>

    <!-- Navigation -->
    <?php   include_once "includes/navigation.php";  ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                    if(isset($_POST['submit'])){
                        $search_key =  $_POST['search'];

                        // SQL query for search post_tags
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search_key%';";

                        $result = mysqli_query($connection, $query);
                        if(!$result){
                            die("SQL query Failed for search post_tags. ". mysqli_error($connection));
                        }

                        $count_row = mysqli_num_rows( $result);

                        if($count_row == 0){
                            echo "<h1> No Result Found.</h1>";
                        }
                        else{
                            //SQL query to fetch all posts using search key

                            while( $row = mysqli_fetch_assoc($result)){
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                                
                                ?> <!-- pause the loop -->
                                

                                <h1 class="page-header">
                                    Page Heading
                                    <small>Secondary Text</small>
                                </h1>

                                <!-- First Blog Post -->
                                <h2>
                                    <a href="#"><?php echo $post_title; ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="index.php"><?php echo $post_author; ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                                <hr>
                                <img class="img-responsive img-rounded" src="images/<?php echo $post_image; ?> " alt="">
                                <hr>
                                <p><?php echo $post_content; ?></p>
                                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>

                                <!-- resume the while loop -->
                                <?php

                                
                            }// end of while loop
                            
                            
                        }



                    }
  
                
                ?>

                

            </div>


            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";    ?>



        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"    ?>

        