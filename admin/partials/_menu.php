<?php
//display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../config/constants.php");
include("_logincheck.php");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/admin_style.css?v=<?php echo time(); //code to make css page load too ?>">
    <title>Hello Admin!</title>
  </head>
  <body>
<!-- Navbar starts  -->
<!-- Navbar starts  -->
<nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-success fw-bold" style="min-width:100vw ;" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Ecom</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mx-auto mb-2 mb-lg-0">
        <li class="nav-item mx-3">
          <a class="nav-link active" aria-current="page" href="<?php echo SITEURL; ?>/admin/index.php">Home</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link" href="<?php echo SITEURL; ?>/admin/manage_admin.php">Admin</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link" href="<?php echo SITEURL; ?>/admin/manage_category.php">Categories</a>
        </li>

        <li class="nav-item mx-3">
          <a class="nav-link" href="<?php echo SITEURL; ?>/admin/manage_item.php">All Items</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link" href="<?php echo SITEURL; ?>/admin/manage_order.php">Orders</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link" href="<?php echo SITEURL; ?>/admin/version.php">Version Info</a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link" href="<?php echo SITEURL; ?>/admin/manage_contact.php">Contact</a>
        </li>
      </ul>
      <div class="d-flex">
        <a class="btn btn-outline-light" href="<?php echo SITEURL; ?>/admin/logout.php">Log Out</a>
      </div>
    </div>
  </div>
</nav>
<!-- navbar ends  -->
