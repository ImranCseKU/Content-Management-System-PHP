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

                    if(isset($_GET['category'])){
                        $get_category_post = mysqli_real_escape_string($connection, trim($_GET['category']) );
                    }
                    //SQL query to fetch all Data from Post Table...
                    $query = "SELECT * FROM `posts` WHERE `post_category_id`=$get_category_post;";
                    $res = mysqli_query($connection,$query) or die(mysqli_error($connection));
                

                    while( $row = mysqli_fetch_assoc($res)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,120) . "...";
                        
                        ?> <!-- pause the loop -->
                        

                        
                        <!-- First Blog Post -->
                        <h2>
                            <a href="post_details.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="author_posts.php?author=<?php echo $post_author;?>" > <?php echo ucwords($post_author);?> </a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive img-rounded" src="images/<?php echo $post_image; ?> " alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="post_details.php?p_id=<?php echo $post_id;?>" >Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                        <!-- resume the while loop -->
                        <?php

                        
                    } // End of while loop
                    
                
                ?>

                

            </div>


            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";    ?>



        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"    ?>

        