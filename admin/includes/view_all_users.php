<!-- this page is included into Admin/users.php -->

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email </th>
            <th>Image</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>

        <?php
            
            //sql query to fetch all data from users table... 
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_users)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];

                //get Post Title from Posts table using comment_post_id from comments table
                // $post_detailes_query = "SELECT * FROM Posts WHERE post_id=$comment_post_id";
                // $get_post_detailes = mysqli_query($connection, $post_detailes_query) or die(mysqli_error($connection));
                
                // while($row = mysqli_fetch_assoc($get_post_detailes)){
                //     $post_title = $row['post_title'];
                // }
                

                echo "<tr>";
                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$user_firstname</td>";
                    echo "<td>$user_lastname</td>";
                    echo "<td>$user_email</td>";
                    echo "<td> <img src='../images/$user_image' alt='images' height='60px' width='50px'> </td>";
                    echo "<td>$user_role</td>";
                    
                    echo "<td> <a href='users.php?change_to_admin=$user_id' class='btn btn-sm btn-success'>Admin</a> </td>";
                    echo "<td> <a href='users.php?change_to_sub=$user_id' class='btn btn-sm btn-info'>Subscriber</a> </td>";
                    echo "<td>
                            <a href='users.php?source=edit_user&u_id=$user_id' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='users.php?delete=$user_id' onclick=\"return confirm('are you sure you want to delete');\" class='btn btn-sm btn-danger'>Delete</a>
                        </td>";
                echo "</tr>";
            }

            
            
        
        ?>
    
    </tbody>

</table>

<?php
    if(isset($_GET['delete'])){
        $deleted_user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE `user_id`=$deleted_user_id";

        $delete_comment = mysqli_query($connection, $query);
        header("Location: users.php");
    }
?>

<?php
    if(isset($_GET['change_to_admin'])){
        $admin_id = $_GET['change_to_admin'];
        $query = "UPDATE `users` SET `user_role`= 'admin' WHERE user_id = $admin_id; ";

        $set_admin = mysqli_query($connection, $query);
        header("Location: users.php");
    }
?>

<?php
    if(isset($_GET['change_to_sub'])){
        $subscriber_id = $_GET['change_to_sub'];
        $query = "UPDATE `users` SET `user_role`= 'subscriber' WHERE user_id = $subscriber_id; ";

        $set_subscriber = mysqli_query($connection, $query);
        header("Location: users.php");
    }
?>