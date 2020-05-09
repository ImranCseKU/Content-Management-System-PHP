<?php
    // if(isset($_GET['edit'])){
        

        //SQL query to fetch specific catagories to Update...
        $query = "SELECT * FROM `categories` WHERE cat_id='{$updated_cat_id}'";
        $query_result = mysqli_query($connection, $query);
        if(!$query_result){
            die("Query failed to fetch specific catagories to Update!!");
        }

        while( $row = mysqli_fetch_assoc($query_result)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="cat_name">Edit Category</label>
                    <input value="<?php  if(isset($cat_title)){ echo $cat_title;}   ?>" type="text" class="form-control" name="edit_cat_title" id="cat_name">   
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="update">Update Category</button>
                </div>
            </form>
        

        <?php
        }   // end of while loop   

    // }
?>



<?php
    if(isset($_POST['update'])){
        $updated_cat_title  = mysqli_real_escape_string($connection,$_POST['edit_cat_title']);
        //SQL query to update categories to the admin panel
        $query_to_update = "UPDATE categories SET cat_title = '{$updated_cat_title}' WHERE cat_id='{$updated_cat_id}'";
        $query_result_to_update = mysqli_query($connection, $query_to_update);
        if(!$query_result_to_update){
            die("Query failed to delete category item".mysqli_error($connection));
        }
        else{
            header("Location:categories.php");
        }
    }

?>