<?php include_once "../includes/db.php"; ?>
<?php include_once "includes/admin_header.php"; ?>

<?php
    
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id=$user_id;";
        $get_user_details = mysqli_query($connection, $query);

        $row = mysqli_fetch_assoc($get_user_details);
        $username = $row['username'];
        $user_db_password = $row['user_password'];      

    }


    if ( count($_POST) > 0 ){
        $current_password= mysqli_real_escape_string($connection, $_POST['currentPassword']);
        $new_password= mysqli_real_escape_string($connection, $_POST['newPassword']);

        $reset_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        if (password_verify($current_password, $user_db_password)) {
            $reset_password_query = "UPDATE users SET user_password = '$reset_password' WHERE username= '$username';";
            $reset_user_password = mysqli_query($connection, $reset_password_query) or die(mysqli_error($connection));

            $message = "<div class='message alert alert-success'><p style='font-weight:bold;'> Password Changed </p></div>";
        }
        else{
            $message = "<div class='message alert alert-danger'><p style='font-weight:bold;'> Current Password is not correct </p></div>";
        }
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

                        <div class="col-md-10" >
                            <?php if(isset($message)) { echo $message; } ?>
                            <h3>Change Password</h3>
                            <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
                                <div class="form-group">
                                    <label for="">Current Password</label>
                                    <input type="password" class="form-control txtField" name="currentPassword">
                                    <span id="currentPassword" class="required"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input type="password" name="newPassword" class="form-control txtField" />
                                    <span id="newPassword" class="required"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirmPassword" class="form-control txtField" />
                                    <span id="confirmPassword" class="required"></span>
                                </div>
                                <input type="submit" name="submit" value="Submit" class="btnSubmit">
                            </form>
                        
                        </div> <!-- class.well -->

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>

    </div>
 

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

<script>
    function validatePassword() {
    var currentPassword,newPassword,confirmPassword,output = true;

    currentPassword = document.frmChange.currentPassword;
    newPassword = document.frmChange.newPassword;
    confirmPassword = document.frmChange.confirmPassword;

    if(!currentPassword.value) {
        currentPassword.focus();
        document.getElementById("currentPassword").innerHTML = "required";
        output = false;
    }
    else if(!newPassword.value) {
        newPassword.focus();
        document.getElementById("newPassword").innerHTML = "required";
        output = false;
    }
    else if(!confirmPassword.value) {
        confirmPassword.focus();
        document.getElementById("confirmPassword").innerHTML = "required";
        output = false;
    }
    if(newPassword.value != confirmPassword.value) {
        newPassword.value="";
        confirmPassword.value="";
        newPassword.focus();
        document.getElementById("confirmPassword").innerHTML = "not same";
        output = false;
    } 	
    return output;
    }
</script>
