<?php include("partials/_menu.php");  ?>
<?php

//1. Getting the ID of admin to update
$id = $_GET['id'];

//2. Create SQL query to update
$sql = "SELECT * FROM tbl_admin WHERE id=$id";

//3. Execute the query
$result = mysqli_query($conn, $sql);

//4. Check whether query is executed or not
if ($result) {
    //checking whether data is available or not
    $count = mysqli_num_rows($result);
    //checking whether we have admin or not
    if ($count == 1) {
        //we should do this if-else because the user may try to pass ID through the link directly which can cause error
        //check  video number 3 from time 30:00
        $row = mysqli_fetch_assoc($result);
        //we will use this to display these values in the input field to update
        $id = $row['id'];
        $full_name = $row['full_name'];
        $username = $row['username'];
    } else {
        header('location:manage_admin.php');
    }
}
?>

<div class="login-body">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow">
                    <h3 class="m-1 text-center">Update Admin </h3>
                    <div class="card-body">
                        <form action="" method="POST">
                            <label for="full_name" class="mx-1 ">Full Name</label>
                            <input type="text" value="<?php echo $full_name ?>" name="full_name" required id="full_name" class="form-control my-3 py-2" placeholder="Enter your Full Name">
                            <label for="username" class="mx-1 ">Username</label>
                            <input type="text" value="<?php echo $username; ?>" name="username" required id="username" class="form-control my-3 py-2" placeholder="Enter your username">
                            <div class="text-center mt-3">
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

//checking if submit button is clicked or not
if (isset($_POST['submit'])) {
    //1. get all value from the form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //2. query to update values
    $sql = "UPDATE `tbl_admin` SET
     full_name = '$full_name',
     username = '$username'
     WHERE id='$id'";

    //3. executing the query
    $result = mysqli_query($conn, $sql);

    //4. checking 
    if ($result) {
        //query executed and admin updated
        $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> Admin updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        //redirecting to manage_admin.php after success
        header("location:".SITEURL."/admin/manage_admin.php");
    } else {
        //failed to update admin
        $_SESSION['update'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> Failed to update admin!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        //redirecting to manage_admin.php after error
        header("location:".SITEURL."/admin/manage_admin.php");
    }
}

?>

<?php include("partials/_footer.php");  ?>