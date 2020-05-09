<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php 

    if(isset($_POST['register'])){
        $username =  mysqli_real_escape_string($connection, $_POST['username']);
        $user_email = mysqli_real_escape_string($connection, $_POST['email']);
        $user_password = mysqli_real_escape_string($connection, $_POST['password']);

        $user_password = password_hash($user_password, PASSWORD_DEFAULT);

        if(!empty($username) && !empty($user_email) && !empty($user_password)){

            $query = "INSERT INTO users(username, user_email, user_password, user_role) VALUES('$username', '$user_email', '$user_password', 'subscriber');";
            $registration = mysqli_query($connection, $query) or die(mysqli_error($connection));
            if($registration){
                $message = "<div class='alert alert-success'><h3>Registration Successfull</h3></div>";
            }
        }
        else{
            $message = "<h5 class='text-danger'> *Fields can not be empty</h5>";
        }
    }
    else{
        $message="";
    }


?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                        <h1>Register</h1>
                            <?php echo $message; ?>
                            <form role="form" action="registration.php" method="post" id="login-form">
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                </div>
                        
                                <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                            </form>
                        
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <hr>



<?php include "includes/footer.php";?>
