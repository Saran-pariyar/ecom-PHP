<?php
include("config/constants.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />

  <title>Ecom</title>
</head>

<body>
  <!-- Navbar starts  -->
  <nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-success fw-bold">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Ecom</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mx-auto mb-2 mb-lg-0">
          <li class="nav-item mx-3">
            <a class="nav-link active" aria-current="page" href="<?php  echo SITEURL; ?>">Home</a>
          </li>
          <li class="nav-item dropdown mx-3">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Explore
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?php  echo SITEURL; ?>categories.php">All Categories</a></li>
              <li><a class="dropdown-item" href="<?php  echo SITEURL; ?>items.php">All Items</a></li>
              
            </ul>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" href="<?php  echo SITEURL; ?>contactus.php">Contact us</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
