<?php 
ob_start();
include("partials/_menu.php"); ?>

<div class="container">
<?php
//this came from this page
if (isset($_SESSION['version_add'])) {
    echo $_SESSION['version_add'];
    unset($_SESSION['version_add']);
}
?>
    <h2 class="m-3">Add version and info</h2>
    <form action="" method="POST" class="m-3">
        <div class="mb-3">
            <label for="version" class="form-label">Version:</label>
            <input type="text" name="version" class="form-control" id="version" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="feature" class="form-label">Feature:</label>
            <input type="text" name="feature" class="form-control" id="feature" aria-describedby="emailHelp">
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="submit" value="Add Version" class="btn btn-primary">
        </div>
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    //getting data from form
    $version = $_POST['version'];
    $feature = $_POST['feature'];
    $version_date = date('Y-m-d H:i:s'); //Getting current date and time

    $sql = "INSERT INTO tbl_version SET version='$version', feature = '$feature', date='$version_date'";

    $result = mysqli_query($conn, $sql);

    if($result){
        $_SESSION['version_add'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Version detail added!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header("location:".SITEURL."/admin/version.php");
        ob_end_flush();
    }
    else{
        $_SESSION['version_add'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Unable to add version details!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header("location:".SITEURL."/admin/add_version.php");
        ob_end_flush();
    }

}

?>
<?php include("partials/_footer.php"); ?>