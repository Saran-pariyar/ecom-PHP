<?php include("partials_front/_menu.php");
 ?> 
 <!-- search bar  -->
 <div class="container mx-auto my-4 ">
   <form action="<?php echo SITEURL; ?>item_search.php" class="d-flex justify-content-center " method="POST">
     <input name="search" class="form-control me-2" type="search" placeholder="Search items that you want" aria-label="Search" required>
     <input type="submit" name="submit" value="Search" class="btn btn-outline-success">
   </form>
 </div>
  <!-- search bar ends  -->



 <!-- ITEMS  -->
 <hr />
  <h1 class="text-center bg-success text-light">Explore Items :</h1>
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
//No Food Item Available
echo "<div class='text-success'> No Food Item Available </div>";
}

?>

      




    </div>
  </div>





<?php include("partials_front/_footer.php");
 ?>