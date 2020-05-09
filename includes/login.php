<?php ob_start(); ?>
<?php include_once "db.php"; ?>
<?php session_start(); ?>

<?php 

if(isset($_POST['login'])){
    $username= $_POST['username'];
    $password= $_POST['password'];
    
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username='$username';";

    $check_credential = mysqli_query($connection, $query) or die( mysqli_error($connection));
    
    $row = mysqli_fetch_assoc($check_credential);

    $db_user_id = $row['user_id'];
    $db_username = $row['username'];
    $db_user_password = $row['user_password'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_role = $row['user_role'];


    
    if( password_verify ( $password , $db_user_password )){

        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        // echo "username:".$_SESSION['username']."<br>";
        // echo "firstname:".$_SESSION['firstname']."<br>";
        // echo "lastname:".$_SESSION['lastname']."<br>";
        // echo "user_role:".$_SESSION['user_role']."<br>";

        header("Location: ../admin");
    }
    else{
        header("Location: ../index.php");
    }
}
?>