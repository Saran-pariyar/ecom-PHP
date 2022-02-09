<?php include("partials_front/_menu.php");
?>
<!-- Navbar ENDS  -->
<!-- Marquee starts -->
<h2 class="text-center m-0 text-success">
  <i>
    <marquee behavior="scroll" direction="left" scrollamount="10"> Welcome to our online store! Get books, electronics, arts and many more! </marquee>
  </i>
  </h1>
  <!-- Marquee ENDS -->
  <?php
  //this came from order.php
  if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
  }

  ?>
  <!-- search bar  -->
  <div class="container mx-auto my-4 ">
    <form action="<?php echo SITEURL; ?>item_search.php" class="d-flex justify-content-center " method="POST">
      <input name="search" class="form-control me-2" type="search" placeholder="Search items that you want" aria-label="Search" required>
      <input type="submit" name="submit" value="Search" class="btn btn-outline-success">
    </form>
  </div>
  <!-- search bar ends  -->


  <!-- carousel starts  -->
  <div class="slider">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/books_slider.jpg" class="slider-image d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h2>Buy Books</h2>
            <p>Get your favorite books from here!</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/electronics_slider.jpg" class="slider-image d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h2>Electronics</h2>
            <p>Buy your favorite electronic gadgets from here.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/art_slider.jpg" class="slider-image d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h2 class="text-light">Arts</h2>
            <p class="text-light">
              Some representative placeholder content for the third slide.
            </p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- carousel ENDS  -->

  <!-- categories  -->
  <hr />
  <h1 class="text-center bg-success text-light">Our Featured Categories :</h1>
  <hr />

  <!-- category starts -->
  <div class="row text-center container-fluid">
    <!-- //card starts  -->

    <?php
    //Create SQL query to display categories from DB
    //Now it will only show the categories which have both active and featured ='yes' in DB
    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3"; //this will only return 3 rows
    //Execute the query
    $result = mysqli_query($conn, $sql);
    //Counting the rows of the categories to see if it is available or not
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      //Categories Available
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
    ?>

        <div class="col-sm-4 ">
          <div class="card  bg-light m-1">
            <div class="card-body">
              <?php
              //checking whether image is available or not
              //if image is not available
              if ($image_name == "") {
                echo "<div class='text-success'> Image not Available</div>";
              } else {
                //Else the image will be displayed
              ?>
                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="category" class="card-img-top">
              <?php

              }
              ?>

              <h3 class="my-1 card-title ">
                <?php echo $title; ?>
              </h3>
              <a href="<?php echo SITEURL; ?>category_items.php?category_id=<?php echo $id; ?>" class="btn btn-success m-1 ">Explore</a>
            </div>
          </div>
        </div>

    <?php
      }
    } else {
      //No Categories Available
      echo "<div class='text-success'> No Categories Available </div>";
    }
    ?>


    <!-- card ends  -->

  </div>

  <!--category ends  -->

  <!-- ITEMS  -->
  <hr />
  <h1 class="text-center bg-success text-light">Featured Items :</h1>
  <hr />

  <!-- ITEMS CARDS  -->
  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4 text-center">

    <?php
$sql2 ="SELECT * FROM tbl_item WHERE featured = 'Yes' AND active = 'Yes'";
//Execute the query
$result2 = mysqli_query($conn, $sql2);
//Counting the rows of the item to see if it is available or not
$count2 = mysqli_num_rows($result2);

if ($count2 > 0) {
  while ($row = mysqli_fetch_assoc($result2)) {
      //Get data from DB
      $id = $row['id'];
      $title = $row['title'];
      $price = $row['price'];
      $description = $row['description'];
      $image_name = $row['image_name'];
      //The food items are displayed from below code

    ?>

      <div class="col " style="width: 17rem; margin-bottom:0.5rem;">
        <div class="card">
        <?php
                        //Check whether image is available or not
                        if ($image_name == "") {
                            //Image is not available
                            echo "<div class='error'> Image not Available</div>";
                        } else {
                        ?>
          <img src="<?php echo SITEURL; ?>/images/item/<?php echo $image_name; ?>" class="card-img-top" alt="..." style=" ">
          <?php
                        }
                        ?>
          <div class="card-body">
            <h5 class="card-title"><?php echo $title; ?></h5>
            <p class="card-text">$<?php echo $price; ?></p>
            <p class="card-text"><?php echo substr($description, 0, 20) ;  ?>..</p>
            <a href="<?php echo SITEURL; ?>order.php?item_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
          </div>
        </div>
      </div>
      <?php


}
} else {
//No  Item Available
echo "<div class='text-success'> No Item Available </div>";
}

?>

      




    </div>
  </div>

  <!-- //footer  -->
  <?php include("partials_front/_footer.php");
  ?>
