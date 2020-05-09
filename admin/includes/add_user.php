<!-- this page is included into Admin/users.php -->
<?php
    if( isset($_POST['create_user']) ){

        $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
        $user_lastname= mysqli_real_escape_string($connection, $_POST['user_lastname']);
        $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
        $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);

        $user_image = $_FILES['img']['name'];
        $user_image_unique_name = time().'_'.$user_image;
        $user_image_temp = $_FILES['img']['tmp_name'];


        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
        //hash password
        $user_password = password_hash($user_password, PASSWORD_DEFAULT);
        
        //MOVE image to the destination folder
        //move_uploaded_file( $temporary_file_in_server, $target_dir_location)
        move_uploaded_file($user_image_temp, "../images/$user_image_unique_name");
		
		
		//store only image name in the database
        $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
        $query .= "VALUES ('$username', '$user_password', '$user_firstname', '$user_lastname' , '$user_email', '$user_image_unique_name', '$user_role');"; 

        $create_user = mysqli_query($connection, $query) or die(mysqli_error($connection));
        // header("Location:users.php");
        if($create_user){
            echo "<div class='alert alert-success font-weight-bold col-md-10'>Successfully User Created</div>";
        }
    }


?>

<div class="col-md-10 well" >
    <form action="" method="post" enctype = "multipart/form-data">
        
        <div class="form-group">
            <label for="">First Name</label>
            <input type="text" class="form-control" name="user_firstname">
        </div>
        <div class="form-group">
            <label for="">Last Name</label>
            <input type="text" class="form-control" name="user_lastname">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="user_email">
        </div>

        <div class="form-group">
            <label for="user_role">Role</label>
            <select name="user_role" id="user_role" class="form-control">
                <option value='subscriber'>Select Option</option>
                <option value='admin'>Admin</option>
                <option value='subscriber'>Subscriber</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">User Image</label>
            <input type="file" class="form-control" name="img">
        </div>

        <div class="form-group">
            <label for="">Username</label>
            <input type="text" class="form-control" name="username">
        </div>

        <div class="form-group">
            <label for="">Password</label>
            <input type="password" id="pass" class="form-control" name="user_password">
            <input type="checkbox" id="show_password">Show Password
        </div>
        

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
        </div>

    </form>
</div>