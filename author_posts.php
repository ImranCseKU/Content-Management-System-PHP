<?php ob_start();   ?>
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

                    if(isset($_GET['author'])){
                        $the_post_author= $_GET['author'];

                        //SQL query to fetch all Data for the specific $id from Post Table...
                        $query = "SELECT * FROM `posts` WHERE post_author='$the_post_author';";
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
                            <h2 class="entry-title">
                                <a href="post_details.php?p_id=<?php echo $post_id;?>" > <?php echo $post_title; ?> </a>
                            </h2>
                            <p class="lead">
                                by <?php echo ucwords($post_author);?>
                            </p>
                            <p> <span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </p>
                            <hr>
                            <img class="img-responsive img-rounded" src="images/<?php echo $post_image; ?> " alt="">
                            <hr>
                            <p><?php echo $post_content; ?></p><br>
                            <a class="btn btn-primary" href="post_details.php?p_id=<?php echo $post_id;?>" > Read More <span class="glyphicon glyphicon-chevron-right"></span> </a>

                        
                            <hr>

                            <!-- resume the while loop -->
                            <?php

                            
                        } // End of while loop
                    }   // End of if
                    
                    
                
                ?>

                

            </div>


            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";    ?>



        </div><!-- /.row -->
        
        
    <?php include "includes/footer.php"    ?>

    