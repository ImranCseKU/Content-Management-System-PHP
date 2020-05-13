<!-- this page is included into Admin/comments.php -->

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Releted Post</th>
            <th>Status</th>
            <th>Date</th>
            <th>Approve</th>
            <th>UnApprove</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
            
            //sql query to fetch all data from comments table... 
            $query = "SELECT * FROM comments";
            $get_comment_data = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($get_comment_data)){
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                //get Post Title from Posts table using comment_post_id from comments table
                $post_detailes_query = "SELECT * FROM Posts WHERE post_id=$comment_post_id";
                $get_post_detailes = mysqli_query($connection, $post_detailes_query) or die(mysqli_error($connection));
                
                while($row = mysqli_fetch_assoc($get_post_detailes)){
                    $post_title = $row['post_title'];
                }
                

                echo "<tr>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$comment_author</td>";
                    echo "<td>$comment_content</td>";
                    echo "<td>$comment_email</td>";
                    echo "<td> <a href='../post_show.php?p_id=$comment_post_id'>$post_title </a> </td>";
                    echo "<td>$comment_status</td>";
                    echo "<td>$comment_date </td>";
                    echo "<td> <a href='comments.php?approve=$comment_id' class='btn btn-sm btn-success'>Approve</a> </td>";
                    echo "<td> <a href='comments.php?unapprove=$comment_id' class='btn btn-sm btn-danger'>UnApprove</a> </td>";
                    echo "<td>
                            <a href='comments.php?delete=$comment_id' onclick=\"return confirm('are you sure you want to delete');\" class='btn btn-sm btn-danger'>Delete</a>
                        </td>";
                echo "</tr>";
            }

            
            
        
        ?>
    
    </tbody>

</table>

<?php
    if(isset($_GET['delete'])){

        if( isset($_SESSION['user_role']) ){
            if( $_SESSION['user_role'] == 'admin' ){

                $deleted_comment_id = mysqli_real_escape_string($connection,$_GET['delete']);
                $query = "DELETE FROM comments WHERE `comment_id`=$deleted_comment_id";

                $delete_comment = mysqli_query($connection, $query);
                header("Location: comments.php");
            }
        }


        
    }
?>

<?php
    if(isset($_GET['unapprove'])){
        $unapprove_comment_id = $_GET['unapprove'];
        $query = "UPDATE `comments` SET `comment_status`= 'unapproved' WHERE comment_id = $unapprove_comment_id; ";

        $unapprove_comment = mysqli_query($connection, $query);
        header("Location: comments.php");
    }
?>

<?php
    if(isset($_GET['approve'])){
        $approve_comment_id = $_GET['approve'];
        $query = "UPDATE `comments` SET `comment_status`= 'approved' WHERE comment_id = $approve_comment_id; ";

        $approve_comment = mysqli_query($connection, $query);
        header("Location: comments.php");
    }
?>