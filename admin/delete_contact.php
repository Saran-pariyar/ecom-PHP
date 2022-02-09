<?php
ob_start();
include("../config/constants.php");
?>

<?php
//check whether ID is set or not
if (isset($_GET['id'])) {
    //Get the contact details
    $id = $_GET['id'];

    //Delete data from DB
    $sql = "DELETE FROM `tbl_contact` WHERE `tbl_contact`.`id` = $id";
    // $result = mysqli_query($conn, $sql); //UNCOMMENT
    $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;


    //Checking if the item is deleted from the DB or not
    if ($result) {
        $_SESSION['delete_contact'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> contact removed successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
        header("location:" . SITEURL . "/admin/manage_contact.php");
        ob_end_flush();
    } else {
        $_SESSION['delete_contact'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> Unable to delete contact!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

        header("location:" . SITEURL . "/admin/manage_contact.php");
        ob_end_flush();
    }
} else {
    //if we didn't get ID  from URL, then redirect to manage_contact.php
    $_SESSION['unauthorized'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Failed!</strong> Unauthorized access!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    header("location:" . SITEURL . "/admin/manage_contact.php");
    ob_end_flush();
}
