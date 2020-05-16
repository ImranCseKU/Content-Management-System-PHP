<!-- this page include into Admin/users.php -->

<?php
    if(isset($_GET['u_id'])){

        //only admin can change user details
        if($_SESSION['user_role'] != 'admin'){
            header("Location: users.php");
        }
        else{
            $edited_user_id = mysqli_real_escape_string($connection,$_GET['u_id']) ;

            $query = "SELECT * FROM users WHERE user_id=$edited_user_id;";
            $get_user = mysqli_query($connection, $query);
            
            $row = mysqli_fetch_assoc($get_user);

            $user_id = $row['user_id'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $db_user_img = $row['user_image'];
            $username = $row['username'];
            $user_password = $row['user_password'];
        }
              
    }

    

    if(isset($_POST['update_user'])){
        $user_firstname = mysqli_real_escape_string($connection,$_POST['user_firstname']);
        $user_lastname= mysqli_real_escape_string($connection,$_POST['user_lastname']);
        $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
        $user_role = mysqli_real_escape_string($connection,$_POST['user_role']);

        $user_image = $_FILES['img']['name'];
        $user_image_unique_name = time().'_'.$user_image;
        $user_image_temp = $_FILES['img']['tmp_name'];

        
        //MOVE image to the destination folder
        //move_uploaded_file( $temporary_file_in_server, $target_dir_location)
        move_uploaded_file($user_image_temp, "../images/$user_image_unique_name");
        
        
        //if image not set..set it privious
        if(empty($user_image)){
            $user_image_unique_name = $db_user_img;
        }
		
        $query_for_update = "UPDATE users SET ";
        $query_for_update .= "user_firstname='$user_firstname',";
        $query_for_update .= "user_lastname= '$user_lastname' ,";
        $query_for_update .= "user_email='$user_email',";
        $query_for_update .= "user_image='$user_image_unique_name',";
        $query_for_update .= "user_role='$user_role' ";
        $query_for_update .= "WHERE user_id= $edited_user_id";

        $user_update = mysqli_query($connection, $query_for_update) or die(mysqli_error($connection));
        header("Location:users.php");
    }

    


?>

<div class="col-md-10 well" >
    <form action="" method="post" enctype = "multipart/form-data">
                                
        <div class="form-group">
            <label for="">First Name</label>
            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="">Last Name</label>
            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
        </div>

        <div class="form-group">
            <label for="user_role">Role</label></br>
            <select name="user_role" id="user_role" class="form-control">
                <?php 
                    
                    if($user_role == 'admin')
                    {
                        ?>
                        <option value='admin' selected>Admin</option>
                        <option value='subscriber'>Subscriber</option>
                        <?php
                    }
                    else{
                        ?>
                        <option value='admin'>Admin</option>
                        <option value='subscriber' selected>Subscriber</option>
                        <?php
                    }
                ?>
                
            </select>
        </div>

        <div class="form-group">
            <label for="">User Image</label></br>
            <img src="../images/<?php echo $db_user_img; ?>" width="50px" height='60px' alt="">
            <input type="file" class="form-control" name="img">
        </div>

    
        <div class="form-group mt-2">
            <input class="btn btn-primary font-weight-bold" type="submit" name="update_user" value="Update">
        </div>

    </form>
</div>