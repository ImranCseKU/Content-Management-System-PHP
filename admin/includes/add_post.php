<!-- this page is included into admin/posts.php -->
<?php
    if( isset($_POST['create_post']) ){

        
        $post_author = mysqli_real_escape_string($connection,$_POST['author']);
        $post_title = mysqli_real_escape_string($connection,$_POST['title']);
        $post_category_id = mysqli_real_escape_string($connection,$_POST['post_category_id']);
        $post_status = ($_POST['status']) ? mysqli_real_escape_string($connection,$_POST['status']) : 'draft';

        $post_image = $_FILES['img']['name'];
        $post_image_unique_name = time().'_'.$post_image;
        $post_image_temp = $_FILES['img']['tmp_name'];


        $post_tags = mysqli_real_escape_string($connection,$_POST['tags']);
        $post_content = mysqli_real_escape_string($connection,$_POST['content']);
        $post_date = date('d-m-y');
        
        
        //MOVE image to the destination folder
        //move_uploaded_file( $temporary_file_in_server, $target_dir_location)
        move_uploaded_file($post_image_temp, "../images/$post_image_unique_name");
		
		
		//store only image name in the database
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image,post_content, post_tags , post_status) ";
        $query .= "VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image_unique_name', '$post_content', '$post_tags', '$post_status')"; 

        $make_post = mysqli_query($connection, $query) or die(mysqli_error($connection));
        // header("Location:posts.php");
        if( $make_post ){
            echo "<div class='alert alert-success font-weight-bold col-md-10'>Successfully Post Created</div>";
        }
    }


?>

<div class="col-md-10 well" >
    <form action="" method="post" enctype = "multipart/form-data">
        
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
        </div>

        <div class="form-group">
            <label for="post_catagory">Post Catagory ID</label>
            <select name="post_category_id" id="post_category" class="form-control">
                <?php
                    $query = "SELECT * FROM categories;";
                    $get_category = mysqli_query($connection , $query) or die(mysqli_error($connection));

                    while($row = mysqli_fetch_assoc($get_category)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<option value='$cat_id'>$cat_title</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="author">Post Author</label>
            <input type="text" class="form-control" name="author">
        </div>
        <div class="form-group">
            <label for="status">Post Status</label>
            <select name="status" id="post_status" class="form-control">
                <option value=""> Choose Option... </option>
                <option value="published"> Published </option>
                <option value="draft"> Draft </option>
            </select>
            <!-- <input type="text" class="form-control" name="status"> -->
        </div>
        <div class="form-group">
            <label for="title">Post Image</label>
            <input type="file" class="form-control" name="img">
        </div>

        <div class="form-group">
            <label for="tags">Post Tags</label>
            <input type="text" class="form-control" name="tags">
        </div>
        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea name="content" class="form-control" id="content" cols="30" rows="4"></textarea>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
        </div>

    </form>
</div>