<?php include("partials_front/_menu.php");
 ?>
  
  <?php
//check either we got category_id from URL or not
if (isset($_GET['category_id'])) {
    //We got the category_id from URL
    $category_id = $_GET['category_id'];
    //Get the category title based on category_id
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    //Execute the query
    $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;
    //Get the value from the DB
    $row = mysqli_fetch_assoc($result);
    //Get the title
    $title = $row['title'];
} else {
    //We did not got category_id 
    //Redirect to homepage
    header("location:" . SITEURL);
}

?>

<div class="container">
<br><h2 >Items on <span  class="text-success"><?php echo $title; ?></span></h2><br>

<!-- Results  -->
<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4 text-center">
    <?php
        //SQL query to display food of the selected category
        $sql2 = "SELECT * FROM tbl_item WHERE category_id=$category_id";
        //Execute the query
        $result2 = mysqli_query($conn, $sql2) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;
        //Count the rows
        $count2 = mysqli_num_rows($result2);
        //Check whether item is available or not
        if ($count2 > 0) {
            //Food available
            while ($row2 = mysqli_fetch_assoc($result2)) {
                //Get data from DB
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
                //Display the data below
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
        echo " <h2 class='m-2 text-success text-center'> No food item found</h2>";
    }
    ?>







</div>


<?php include("partials_front/_footer.php");
 ?>