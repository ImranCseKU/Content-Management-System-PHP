<?php include_once "../includes/db.php"; ?>
<?php include_once "includes/admin_header.php"; ?>

<?php 

    if(isset($_SESSION['user_id'])){
        $the_user_id = $_SESSION['user_id'];

        //get user details information
        $query = "SELECT * FROM users WHERE user_id=$the_user_id;";
        $get_user_details = mysqli_query($connection, $query) or die(mysqli_error($connection));

        $row = mysqli_fetch_assoc($get_user_details);
        
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $db_user_img = $row['user_image'];
        $username = $row['username'];
        $user_password = $row['user_password'];
    }

    


    if(isset($_POST['update_profile'])){
        $user_firstname = mysqli_real_escape_string($connection,$_POST['user_firstname']);
        $user_lastname= mysqli_real_escape_string($connection,$_POST['user_lastname']);
        $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
        // $user_role = mysqli_real_escape_string($connection,$_POST['user_role']);

        $user_image = $_FILES['img']['name'];
        $user_image_unique_name = time().'_'.$user_image;
        $user_image_temp = $_FILES['img']['tmp_name'];


        $username = mysqli_real_escape_string($connection,$_POST['username']);

        $new_password = mysqli_real_escape_string($connection, $_POST['user_password']);
        //hash password
        $user_password = ($new_password) ? password_hash($new_password, PASSWORD_DEFAULT) : $user_password;

        
        //MOVE image to the destination folder
        //move_uploaded_file( $temporary_file_in_server, $target_dir_location)
        move_uploaded_file($user_image_temp, "../images/$user_image_unique_name");
        
        
        //if image not set..set it privious
        if(empty($user_image)){
            $user_image_unique_name = $db_user_img;
        }
		
        $query_for_update = "UPDATE users SET ";
        $query_for_update .= "username='$username',";
        $query_for_update .= "user_password='$user_password',";
        $query_for_update .= "user_firstname='$user_firstname',";
        $query_for_update .= "user_lastname= '$user_lastname' ,";
        $query_for_update .= "user_email='$user_email',";
        $query_for_update .= "user_image='$user_image_unique_name' ";
        $query_for_update .= "WHERE user_id= $user_id ;";

        $user_update = mysqli_query($connection, $query_for_update) or die(mysqli_error($connection));
        header("Location:users.php");

        
    }

?>

<body>

    <div id="wrapper">


        <!-- Navigation -->
        <?php include_once "includes/admin_navigation.php"?>




        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin Panel
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                       
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

                                <!-- <div class="form-group">
                                    <label for="user_role">Role</label></br>
                                    <select name="user_role" id="user_role" class="form-control">
                                        <?php 
                                            /*
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
                                            }*/
                                        ?>
                                        
                                    </select>
                                </div> -->

                                <div class="form-group">
                                    <label for="">User Image</label></br>
                                    <img src="../images/<?php echo $db_user_img; ?>" width="50px" height='60px' alt="">
                                    <input type="file" class="form-control" name="img">
                                </div>

                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" autocomplete="off" id="pass" class="form-control" name="user_password" placeholder="you can set new password">
                                    <input type="checkbox" id="show_password">Show Password
                                </div>
                            
                                <div class="form-group mt-2">
                                    <input class="btn btn-primary font-weight-bold" type="submit" name="update_profile" value="Update">
                                </div>

                            </form>
                        </div> <!-- class.well -->

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

<script>
    $(document).ready( function(){

        $('#show_password').change( function(){
            
            if($('#show_password').prop( "checked" ) )
            {
                $('#pass').prop('type', 'text');
            }
            else{
                $('#pass').prop('type', 'password');
            }
            
        });


    });
</script>