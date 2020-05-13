<!-- this page include into posts.php -->

<?php
    if(isset($_GET['p_id'])){
        $edited_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id=$edited_post_id";
    $get_post = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($get_post)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_content = $row['post_content'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment_count'];
        $post_date = $row['post_date'];
    }

    if(isset($_POST['update_post'])){
        $post_author = mysqli_real_escape_string($connection,$_POST['author']);
        $post_title = mysqli_real_escape_string($connection,$_POST['title']);
        $post_category_id = $_POST['post_category_id'];
        $post_status = ($_POST['status']) ? $_POST['status']: 'draft';

        $post_images = $_FILES['img']['name'];
        $post_image_unique_name = time().'_'.$post_images;
        $post_image_temp = $_FILES['img']['tmp_name'];


        $post_tags = mysqli_real_escape_string($connection,$_POST['tags']);
        $post_content = mysqli_real_escape_string($connection,$_POST['content']);
        
        
        
        //MOVE image to the destination
        //move_uploaded_file( $temp_file_in_server, $target_dir_location)
        move_uploaded_file($post_image_temp, "../images/$post_image_unique_name");

        //if image not set..set it privious
        if(empty($post_images)){
            $post_image_unique_name = $post_image;
        }

        $query_for_update = "UPDATE posts SET ";
        $query_for_update .= "post_category_id='$post_category_id',";
        $query_for_update .= "post_title='$post_title',";
        $query_for_update .= "post_author='$post_author',";
        $query_for_update .= "post_date= now(),";
        $query_for_update .= "post_image='$post_image_unique_name',";
        $query_for_update .= "post_content='$post_content',";
        $query_for_update .= "post_tags='$post_tags',";
        $query_for_update .= "post_status='$post_status' ";
        $query_for_update .= "WHERE post_id=$edited_post_id";

        $post_update = mysqli_query($connection, $query_for_update) or die("sql error: ".mysqli_error($connection));
        // header("Location:posts.php");
        header("Location:../post_details.php?p_id=$post_id");
    }

    


?>

<form action="" method="post" enctype = "multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="post_catagory_id">Post Catagory</label>
        <select name="post_category_id" id="post_category" class="form-control">
            <?php
                $query = "SELECT * FROM categories;";
                $get_category = mysqli_query($connection , $query) or die(mysqli_error($connection));

                while($row = mysqli_fetch_assoc($get_category)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    if( $cat_id === $post_category_id){
                        echo "<option value='$cat_id' selected>$cat_title</option>";
                    }
                    else{
                        echo "<option value='$cat_id'>$cat_title</option>";
                    }

                    
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status" id="post_status" class="form-control">
                <option value="<?php echo $post_status; ?>"> <?php echo ucfirst($post_status); ?> </option>
                <?php
                    if( $post_status === 'draft'){
                        echo "<option value='published'> Published </option>";
                    }
                    else{
                        echo "<option value='draft'> Draft </option>";
                    }
                ?>
        </select>
        <!-- <input type="text" class="form-control" name="status" value="<?php echo $post_status; ?>"> -->
    </div>
    <div class="form-group">
        <label for="title">Post Image</label></br>
        <img src="../images/<?php echo $post_image; ?>" width="100px" alt="">
        <input type="file" class="form-control" name="img">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea name="content" class="form-control" id="content" cols="30" rows="4"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="UPDATE">
    </div>


</form>