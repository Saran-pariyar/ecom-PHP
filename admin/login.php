<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin_style.css">
    <title>Hello Admin!</title>
  </head>
  <body >
    <?php
    //display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    include("../config/constants.php");
    
    ?>
  <center>
      <div class="login-body">
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-0 shadow">
                <h1 class="m-2">Ecom - Admin Panel </h1>
                <?php
//this will run if login failed
if(isset($_SESSION['login'])){
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

//if the user is not logged in but still try to go to dashboard
if(isset( $_SESSION['not_logged_in'])){
    echo  $_SESSION['not_logged_in'];
    unset( $_SESSION['not_logged_in']);
}
?>

                <div class="card-body">
                    <svg  xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle mx-auto my-2" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                      </svg>
                    <form action="" method="POST">
                        <input type="text" name="username" id="username" class="form-control my-3 py-2" placeholder="Enter your username">
                        <input type="password" name="password" id="" class="form-control my-3 py-2" placeholder="Enter your password">
                        <div class="text-center mt-3">
                        <input type="submit" name="submit" value="Login" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
      </div>
    
      </center>
    
<?php
if(isset($_POST['submit'])){
//process for login

//1. Get the data from the form
//using sql query to get value more secured way
 $username =mysqli_real_escape_string($conn, $_POST['username']);
 $raw_password = md5($_POST['password']);
 $password =mysqli_real_escape_string($conn,$raw_password );

//2. Checking if user exist or not
$sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

//3. Executing the query
$result = mysqli_query($conn,$sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;;

//4. counting rows to check if user exist or not
$count = mysqli_num_rows($result);

if($count == 1){
    //user available and login success
    $_SESSION['login'] ='<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Login Successful!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    $_SESSION['user'] = $username; //this will be set only if user is logged in and logout will destroy it
    //redirect to homepage/dashboard
    header("location:".SITEURL."admin/index.php");
}
else{
    //user not found and failed to login
    $_SESSION['login'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> Username or password did not match!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  $_SESSION['user'] = false; //This will confirm that we are not logged in, this will be used in _logincheck.php
    //redirect to login.php
    header("location:".SITEURL."admin/login.php");
}
}

?>
    <?php include("partials/_footer.php"); ?>