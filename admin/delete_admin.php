<?php
//0. Including constants.php for DB
include("../config/constants.php");

//1. Getting the ID of admin to delete
 $id = $_GET['id'];

 //2. Create SQL query to delete
 $sql = "DELETE FROM tbl_admin WHERE id=$id";

 //3. Execute the query
 $result = mysqli_query($conn,$sql);

 //4. Checking if admin is deleted or not
 if($result){
//create session variable to show success message in admin page
$_SESSION['delete'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Holy guacamole!</strong> Admin Deleted successfully!
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

//redirect to manage admin
header("location:" . SITEURL . "admin/manage_admin.php"); //now we will be redirected to manage_admin.php page
}
 else{
$_SESSION['delete'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>Holy guacamole!</strong> Failed to delete admin.Please try again!
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';;
header("location:" . SITEURL . "admin/manage_admin.php"); //now we will be redirected to manage_admin.php page

 }
?>