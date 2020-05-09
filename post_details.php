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

                    if(isset($_GET['p_id'])){
                        $the_post_id= $_GET['p_id'];

                        //SQL query to fetch all Data for the specific $id from Post Table...
                        $query = "SELECT * FROM `posts` WHERE post_id=$the_post_id;";
                        $res = mysqli_query($connection,$query);
                        if(!$res){
                            die(mysqli_error($connection));
                        }

                        while( $row = mysqli_fetch_assoc($res)){
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                            
                            ?> <!-- pause the loop -->
                            

                            
                            <!-- First Blog Post -->
                            <h2>
                                <p style="font-weight:bold; background:#1fc8db; padding:25px;"> <?php echo $post_title; ?> </p>
                            </h2>
                            <p class="lead">
                                by <a href="author_posts.php?author=<?php echo $post_author;?>" > <?php echo ucwords($post_author); ?> </a>
                            </p>
                            <p> <span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </p>
                            <hr>
                            <img class="img-responsive img-rounded" src="images/<?php echo $post_image; ?> " alt="">
                            <hr>
                            <p><?php echo $post_content; ?></p><br>

                            <!-- show Edit button -->
                            <?php 

                                if( isset($_SESSION['user_role'] )){

                                    if( $_SESSION['user_role'] == 'admin' ){

                                        echo "<a class='btn btn-primary' href='admin/posts.php?source=edit_post&p_id=$the_post_id' > Edit Post <span class='glyphicon glyphicon-chevron-right'></span> </a>";
            
                                    }
                                    
                                    
                                }
                            
                            ?>

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
        
        <!-- comments Sectiom -->
        <div class="col-md-8">
            
            <?php
                if( isset($_POST['create_comment'])){

                    $comment_author =  mysqli_real_escape_string($connection,$_POST['comment_author']);
                    $comment_email =  mysqli_real_escape_string($connection,$_POST['comment_email']);
                    $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);

                    if( !empty($comment_author) and !empty($comment_email) and !empty($comment_content)){
                        //store comment
                        $query = "INSERT INTO `comments`(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES($the_post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now() );";

                        $create_comment_result = mysqli_query($connection, $query) or die( mysqli_error($connection));

                        // Increment post_comment_count of the Posts Table 
                        $query = "UPDATE posts SET post_comment_count= post_comment_count +1 ";
                        $query .= "WHERE post_id = $the_post_id";
                        $post_comment_count_increment = mysqli_query($connection, $query) or die( mysqli_error($connection));
                        
                        header("Location:post_details.php?p_id=$the_post_id");
                    }
                    else{
                        echo "<script> alert('Fields Can\'t be empty') </script>";
                    }
                    
                    

                }
            ?>
            <!-- Comments Write Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">

                    <div class="form-group">
                        <label for="">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="">Your Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>


            
            <!-- Comments Show -->
            <?php 
                $comments_query = "SELECT * FROM comments WHERE comment_post_id= $the_post_id ";
                $comments_query .= "AND comment_status= 'approved' ";
                $comments_query .= "ORDER BY comment_id DESC;"; //that means latest comment comes first

                // mysqli_insert_id($connection) gives last record id

                $comments = mysqli_query($connection, $comments_query ) or die( mysqli_error($connection) );

                while( $comment = mysqli_fetch_assoc($comments) ){
                    $comment_author = $comment['comment_author'];
                    $comment_content = $comment['comment_content'];
                    $comment_date = $comment['comment_date'];

                    ?>
                    
                    <!-- 1st Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"> <?php echo $comment_author; ?>
                                <small> <?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>

                    <?php
                }
            
            ?>

            
           

            <hr>

        </div>
        
    <?php include "includes/footer.php"    ?>

    