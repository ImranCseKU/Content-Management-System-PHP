<?php include_once "../includes/db.php"; ?>
<?php

    function insert_categories(){
        if(isset($_POST['submit'])){
            global $connection;
            $category = mysqli_real_escape_string($connection,$_POST['cat_title']);

            if( $category =="" || empty($category)){
                echo "<p style='color:Red'>*This field should not be empty.</p>";
            }
            else{
                //SQL query to add a element into categories table
                $query = "INSERT INTO categories(cat_title) VALUES ('$category')";
                $result = mysqli_query($connection, $query);
                if(!$result){
                    die("Query failed to add category.".mysqli_error($connection));
                }

            } 

        }
    }

    function findAllCategories(){

        global $connection;

        //SQL query to fetch all catagories and show into admin panel...
        $query = "SELECT * FROM `categories`";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Query failed to fetch all catagories and show into admin panel!!");
        }

        while( $row = mysqli_fetch_assoc($result)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td>
                    <a href='categories.php?delete={$cat_id}' onclick=\"return confirm('are you sure you want to delete');\" class='btn btn-sm btn-danger'>Delete</a>
                    <a href='categories.php?edit={$cat_id}' class='btn btn-sm btn-info'>Edit</a>
                  </td>";
            // echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
            echo "</tr>";
        }
    }


    function deleteCategories(){
        global $connection;
        
        if(isset($_GET['delete'])){

            if( isset($_SESSION['user_role']) ){

                if($_SESSION['user_role'] == 'admin'){
                    
                    $deleted_cat_id  = mysqli_real_escape_string($connection, $_GET['delete']);
                    //SQL query to delete category item... 
                    $query_to_delete = "DELETE FROM categories WHERE cat_id='{$deleted_cat_id}'";
                    $res = mysqli_query($connection, $query_to_delete) or die(mysqli_error($connection));
                    
                    header("Location:categories.php");
                    
                }
            }

            
        }
    }


    function countPosts(){
        global $connection;

        $query = "SELECT * FROM posts WHERE post_status = 'published';";
        $all_posts = mysqli_query($connection, $query) or die( mysqli_error($connection));
        return mysqli_num_rows($all_posts);

    }
    function countComments(){
        global $connection;

        $query = "SELECT * FROM comments;";
        $all_comments = mysqli_query($connection, $query) or die( mysqli_error($connection));
        return mysqli_num_rows($all_comments);

    }
    function countUsers(){
        global $connection;

        $query = "SELECT * FROM users;";
        $all_users = mysqli_query($connection, $query) or die( mysqli_error($connection));
        return mysqli_num_rows($all_users);

    }
    function countCategories(){
        global $connection;

        $query = "SELECT * FROM categories;";
        $all_categories = mysqli_query($connection, $query) or die( mysqli_error($connection));
        return mysqli_num_rows($all_categories);

    }

    function countDraftPosts(){
        global $connection;

        $query = "SELECT * FROM posts WHERE post_status='draft';";
        $DraftPosts = mysqli_query($connection, $query) or die( mysqli_error($connection));
        return mysqli_num_rows($DraftPosts);

    }

    function countUnapproveComments(){
        global $connection;

        $query = "SELECT * FROM comments WHERE comment_status='unapproved';";
        $UnapproveComments = mysqli_query($connection, $query) or die( mysqli_error($connection));
        return mysqli_num_rows($UnapproveComments);

    }
    function countSubscriber(){
        global $connection;

        $query = "SELECT * FROM users WHERE user_role='subscriber';";
        $all_subscribers = mysqli_query($connection, $query) or die( mysqli_error($connection));
        return mysqli_num_rows($all_subscribers);

    }


?>