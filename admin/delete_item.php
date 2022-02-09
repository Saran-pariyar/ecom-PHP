<?php
include("../config/constants.php");
//Checking if we got image_name and Id from URL or not
if (isset($_GET['id']) && isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  if ($image_name != "") {
    //Image_name does not equals to blank, that means image is available

    $path = "../images/item/" . $image_name;
    //remove the image using unlink() func

    $remove = unlink($path); //if it removed the image, it will return true else false
    //if failed to remove image, add error message and stop the process
    if (!$remove) {
      //SET session message

      $_SESSION['upload'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> Failed to remove Item Image!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
      //Redirect to manage_category.php page
      header("location:" . SITEURL . "/admin/manage_item.php");

      //Stop the process
      die(); //if image is not available, the below code will not run and it will stop 
    }
  }  //Delete data from DB
  $sql = "DELETE FROM `tbl_item` WHERE `tbl_item`.`id` = $id";
  // $result = mysqli_query($conn, $sql); //UNCOMMENT
  $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;


  //Checking if the item is deleted from the DB or not
  if ($result) {
    $_SESSION['delete'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Item Removed successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    header("location:" . SITEURL . "/admin/manage_item.php");
  } else {
    $_SESSION['delete'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> Unable to remove item!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    header("location:" . SITEURL . "/admin/manage_item.php");
  }
} else {
  //if we didn't get ID and image_name from URL, then redirect to manage_item.php
  $_SESSION['unauthorized'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>Failed!</strong> Unauthorized access!
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  header("location:" . SITEURL . "/admin/manage_item.php");
}
