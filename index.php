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

                    //count number of post
                    $countQuery = "SELECT * FROM posts";
                    $countPost = mysqli_query($connection, $countQuery);
                    $total_posts = mysqli_num_rows($countPost);

                    $count = ceil($total_posts/5); // show 5 posts per page
                    
                    $pageNumber = isset($_GET['page']) ? $_GET['page'] : "" ;

                    if($pageNumber =='' or $pageNumber==1){
                        $paginateFrom = 0;
                    }
                    else{
                        $paginateFrom = ($pageNumber * 5 ) - 5;
                    }

                    //SQL query to fetch all Data from Post Table...
                    $query = "SELECT * FROM `posts` LIMIT $paginateFrom, 5";
                    $result = mysqli_query($connection,$query) or die(mysqli_error($connection));

                    
                    while( $row = mysqli_fetch_assoc($result)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,120) . "...";
                        $post_status = $row['post_status'];

                        if( $post_status == 'published'){

                            ?> <!-- pause the while loop -->

                            <!-- Show All Blog Post -->
                            <h2 class="entry-title">
                                <a href="post_details.php?p_id=<?php echo $post_id;?>" > <?php echo $post_title; ?> </a>
                            </h2>
                            <p class="lead">
                                by <a href="author_posts.php?author=<?php echo $post_author;?>" > <?php echo ucwords($post_author);?>
                            </p>
                            <p> <span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </p>
                            
                            <hr>

                            <a href="post_details.php?p_id=<?php echo $post_id;?>" > <img class="img-responsive img-rounded" src="images/<?php echo $post_image; ?> " alt="posts"> </a>
                              
                            <hr>
                            <p> <?php echo $post_content; ?> </p>
                            <a class="btn btn-primary" href="post_details.php?p_id=<?php echo $post_id;?>" > Read More <span class="glyphicon glyphicon-chevron-right"></span> </a>

                            <hr>

                            <!-- resume the while loop -->
                            <?php
                        }

                        
                    } // End of while loop
                    
                
                ?> <!-- End of PHP section -->
                        
                
                        
                    </div>
                    
                    
                    <!-- Blog Sidebar Widgets Column -->
                    <?php include "includes/sidebar.php";    ?>
                    
                    
                    
                </div>
                <!-- /.row -->
                
                <!-- pager/pagination         -->
                <ul class="pager">
                    <?php 
                        for($i= 1; $i<= $count; $i++){ 
                        
                            if( $i == $pageNumber){
                                echo "<li><a class='active-page' href='index.php?page=$i'> $i </a></li>";
                            }
                            else{
                                echo "<li><a href='index.php?page=$i'> $i </a></li>";
                            }
                            
                        }
                    ?>
                    <!-- <li><a href="#">Next</a></li>   -->
                </ul>

                <hr>
                



                <?php include "includes/footer.php";   ?>
                
        