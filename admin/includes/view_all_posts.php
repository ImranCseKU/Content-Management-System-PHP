<!-- this page is included into Admin/posts.php -->

<?php 
    if( isset($_POST['check_list'])){

        foreach( $_POST['check_list'] as $checked_id ){
            
            $bulk_option = $_POST['bulk_option'];
            
            switch($bulk_option){
                case 'published': 
                    $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $checked_id;";
                    $update_status = mysqli_query($connection, $query) or die( mysqli_error($connection));

                break;
                case 'draft': 
                    $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $checked_id;";
                    $update_status = mysqli_query($connection, $query) or die( mysqli_error($connection));
                break;
                case 'delete': 
                    
                    $query = "DELETE FROM posts WHERE post_id = $checked_id;";
                    $delete_post = mysqli_query($connection, $query) or die( mysqli_error($connection));    
                break;
                case 'reset': 
                    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $checked_id;";
                    $reset_views = mysqli_query($connection, $query) or die( mysqli_error($connection));
                break;

            }
        }
    }

?>

<form action="" method="POST">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <!-- Bult Post Option -->
            <div id="bulkOptionContainer" class="col-xs-4" style="margin-left: -15px;">
                <select name="bulk_option" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="reset">Reset Views</option>
                </select>
            </div>

            <div class="clo-xs-4">
                <input type="submit" class="btn btn-success" name="option_submit" value="Apply">
                <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
            </div>

            <thead>
                <tr>
                    <th><input type="checkbox" id="bulkOptionId"></th>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    
                    //sql query to fetch all data from posts table... 
                    $query = "SELECT * FROM posts";
                    $get_post_data = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($get_post_data)){
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_comments = $row['post_comment_count'];
                        $post_date = $row['post_date'];
                        $post_views = $row['post_views_count'];

                        //get category name from categories table using category id from post table
                        $category_name_query = "SELECT * FROM categories WHERE cat_id=$post_category_id";
                        $get_category_details= mysqli_query($connection, $category_name_query) or die(mysqli_error($connection));
                        
                        $row = mysqli_fetch_assoc($get_category_details);
                        $category_title = $row['cat_title'];
                        


                        echo "<tr>";
                            ?>

                            <td><input type='checkbox' class='bulkOptionClass' name='check_list[]' value='<?php echo $post_id; ?>'></td>

                            <?php

                            echo "<td>$post_id</td>";
                            echo "<td>$post_author</td>";
                            echo "<td>$post_title</td>";
                            echo "<td>$category_title</td>";
                            echo "<td>$post_status</td>";
                            echo "<td><a href='../post_details.php?p_id=$post_id' > <img src='../images/$post_image' alt='images' width='100px'> </a></td>";
                            echo "<td>$post_tags</td>";
                            echo "<td>$post_comments</td>";
                            echo "<td>$post_date</td>";
                            echo "<td>$post_views</td>";
                            echo "<td> <a href='posts.php?source=edit_post&p_id=$post_id' class='btn btn-sm btn-block btn-warning'>Edit</a> </td>";
                            echo "<td> <a href='posts.php?delete=$post_id' onclick=\"return confirm('are you sure you want to delete');\" class='btn btn-sm btn-block btn-danger'>Delete</a> </td>";
                            echo "</tr>";
                    }

                    
                    
                
                ?>
            
            </tbody>

        </table>
    </div>
</form>

<?php
    if(isset($_GET['delete'])){

        if( isset($_SESSION['user_role']) ){
            if( $_SESSION['user_role'] == 'admin' ){
                
                $deleted_post_id = mysqli_real_escape_string($connection,$_GET['delete']) ;

                $query = "DELETE FROM posts WHERE `post_id`=$deleted_post_id";

                $delete_post = mysqli_query($connection, $query);
                header("Location:posts.php");
            }
        }

        
    }
?>