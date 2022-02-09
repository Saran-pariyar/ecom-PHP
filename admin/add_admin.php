<?php include("partials/_menu.php"); ?>

<div class="login-body">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow">
                    <h3 class="m-1 text-center">Add Admin </h3>
                    <?php
                    if (isset($_SESSION['add'])) { //checking if session is set or not 
                        echo $_SESSION['add']; //display the session message
                        unset($_SESSION['add']); //the message will be gone when we reload the page
                    }
                    ?>
                    <div class="card-body">
                        <form action="" method="POST">
                            <label for="full_name" class="mx-1 ">Full Name</label>
                            <input type="text" name="full_name" required id="full_name" class="form-control my-3 py-2" placeholder="Enter your Full Name">
                            <label for="username" class="mx-1 ">Username</label>
                            <input type="text" name="username" required id="username" class="form-control my-3 py-2" placeholder="Enter your username">
                            <label for="password" class="mx-1 ">Password</label>
                            <input type="password" name="password" required id="password" class="form-control my-3 py-2" placeholder="Enter your password">
                            <div class="text-center mt-3">
                                <input type="submit" name="submit" value="Add admin" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("partials/_footer.php"); ?>



<?php
//process value and save it to database
//checking if the submit button is clicked or not 

if (isset($_POST['submit'])) {
    //button clicked
    //1. getting value from form

    $full_name  = $_POST['full_name'];
    $username  = $_POST['username'];
    $password = md5($_POST['password']); //password encrypted with MD5

    //2. inserting admin to database
    $sql = "INSERT INTO `tbl_admin` SET
    full_name = '$full_name',
    username = '$username',
    password = '$password' ";

    //3. Execute query and save to database
    $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;
    //4. checking if data is inserted or not
    if ($result) {
        $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> Admin added successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        // the 'SITEURL'  below is a constant from constants.php
        header("location:" . SITEURL . "admin/manage_admin.php"); //now we will be redirected to manage_admin.php page
    } else {
        $_SESSION['add'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> Failed to add admin.Please try again!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        //if add admin failed, we will be redirected to 
        header("location:" . SITEURL . "admin/add_admin.php");
    }
}
?>