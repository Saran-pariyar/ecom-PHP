<?php include("partials_front/_menu.php");
 ?>
  <hr />
  <h1 class="text-center bg-success text-light">Our  Categories :</h1>
  <hr />

  <!-- next card -->
  <div class="row text-center container-fluid">
    <!-- //card starts  -->
    
  <?php
        //Create SQL query to display categories from DB
        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
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
      <div class="card border border-success bg-light m-1">
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

          <h3 class="my-1 card-title">
          <?php echo $title; ?>
          </h3>
          <a href="<?php echo SITEURL; ?>category_items.php?category_id=<?php echo $id; ?>" class="btn btn-success m-1 ">Explore</a>
        </div>
      </div>
      </div>

<?php 
      }
    }
      else{
//No Categories Available
echo "<div class='text-success'> No Categories Available </div>";
      }
      ?>


    <!-- card ends  -->
    
  </div>




<?php include("partials_front/_footer.php");
 ?>