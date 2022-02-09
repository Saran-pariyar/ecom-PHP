<?php
include("../config/constants.php");

session_unset(); 
session_destroy(); //will destroy all the session variables

header("location:".SITEURL."admin/login.php");

?>