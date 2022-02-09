<?php
//Authorization - Access Control
//Check whether user is logged in or not
include("../config/constants.php");
if(!isset($_SESSION['user'])){
  /*   $_SESSION['not_logged_in'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
     <strong>Login required!</strong> Please login first!
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>'; */

    //redirect to login page
    header("location:".SITEURL."/admin/login.php");
}
?>