<?php include("partials/_menu.php"); ?>
<?php
//getting ID from the url
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

?>
<div class="login-body">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow">
                    <?php
                    //This will be executed if new password and confirm password did not match
                    if (isset($_SESSION['pwd_not_match'])) {
                        echo $_SESSION['pwd_not_match'];
                        unset($_SESSION['pwd_not_match']);
                    }
                    ?>
                    <h3 class="m-1 text-center">Update Admin </h3>
                    <div class="card-body">
                        <form action="" method="POST">
                            <label for="current_password" class="mx-1 ">Current Password</label>
                            <input type="password" name="current_password" required id="current_password" class="form-control my-3 py-2" placeholder="Enter your current password">

                            <label for="new_password" class="mx-1 ">New Password</label>
                            <input type="password" name="new_password" required id="new_password" class="form-control my-3 py-2" placeholder="Enter your new password">

                            <label for="confirm_password" class="mx-1 ">Confirm Password</label>
                            <input type="password" name="confirm_password" required id="confirm_password" class="form-control my-3 py-2" placeholder="Re-enter new password">

                            <!-- we need this hidden input to get the ID of the row -->
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update admin" class="btn btn-primary">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
//checking whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    //step to change password

    //1. Get the value from the form
    $id = $_POST['id'];
    //we always need to get the password as encrypted for security
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);


    //2. Check if the admin exist or not
    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $count = mysqli_num_rows($result);
        // if there is 1 admin with the following values, below code will run
        if ($count == 1) {
            // user exist and password can be changed 
            //checking whether new password and current password are matched or not
            if ($new_password == $confirm_password) {
                //update password
                // echo 'password matched';

                //sql to update password
                $sql2 = "UPDATE tbl_admin SET password = '$new_password' WHERE id = $id";

                //execute the query
                $result2 = mysqli_query($conn, $sql2);
                //checking whether the password is changed or not
                if ($result2) {
                    //display success message
                    $_SESSION['pwd_changed'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Password Changed successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    header("location:" . SITEURL . "admin/manage_admin.php");
                } else {
                    //display error message
                    $_SESSION['pwd_changed'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong> Failed to change password!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    header("location:" . SITEURL . "admin/manage_admin.php");
                }
            } else {
                //redirect to manage_admin page with error message
                $_SESSION['pwd_not_match'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Failed!</strong> Password did not match!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                header("location:" . SITEURL . "admin/update_password.php");
            }
        } else {

            //user does not exist, send error message and redirect
            $_SESSION['user_not_found'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> User Not found!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            header("location:" . SITEURL . "admin/manage_admin.php");
        }
    }
    //3. Check whether new_password and confirm_password is equal or not

    //4. Change password
}


?>


<?php include("partials/_footer.php"); ?>