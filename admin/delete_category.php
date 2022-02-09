<?php
include("../config/constants.php");

//check whether ID and image_name is set or not
//we will get this both value from the URL
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    //get and delete the value
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Checking if the image is available or not
    if ($image_name != "") {
        //image is available
        //getting the location of the image
        $path = "../images/category/" . $image_name;

        //remove the image using unlink() func

        $remove = unlink($path); //if it removed the image, it will return true else false

        //if failed to remove image, add error message and stop the process
        if (!$remove) {
            //SET session message

            $_SESSION['remove'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> Failed to remove image!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            //Redirect to manage_category.php page
            header("location:".SITEURL."admin/manage_category.php");

            //Stop the process
            die(); //if image is not available, the below code will not run and it will stop 
        }
    }
    //Delete data from DB
    $sql = "DELETE FROM `tbl_category` WHERE `tbl_category`.`id` = $id";
    // $result = mysqli_query($conn, $sql); //UNCOMMENT
    $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;


    //Checking if the category is deleted from the DB or not
    if ($result) {
        $_SESSION['delete'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Category deleted successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header("location:".SITEURL."admin/manage_category.php");
    } else {
        $_SESSION['delete'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Failed to remove category!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

        header("location:".SITEURL."admin/manage_category.php");
    }
    //Redirect to manage_category.php page with message

} 
else {
    //redirect to category page if we don't pass image_name and ID from the url
    header("location:".SITEURL."admin/manage_category.php");
}
