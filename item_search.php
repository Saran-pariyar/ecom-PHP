<?php include("partials_front/_menu.php"); ?>
<div class="container">

<?php
                //Getting the search keyword insecure way :
                // $search = $_POST['search']; //insecure way 

                //getting data secure way:
                //we use the sql query below for protection from hackers
                //The query will make single and double quote saved as  string for avoiding error later
                $search =mysqli_escape_string($conn,$_POST['search']); //this stores the word that we input in the search bar
?>

<!-- search bar  -->
<div class="container mx-auto my-4 ">
    <form action="<?php echo SITEURL; ?>item_search.php" class="d-flex justify-content-center " method="POST">
      <input name="search" class="form-control me-2" type="search" placeholder="Search items that you want" aria-label="Search" required>
      <input type="submit" name="submit" value="Search" class="btn btn-outline-success">
    </form>
  </div>
  <!-- search bar ends  -->

<h2>Items on Your Search <a href="#" class="text-success">"<?php echo $search; ?>"</a></h2>
<br><br>

  <!-- Results  -->
  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4 text-center">
    <?php
        //Query to get food based on search keyword
        //This query will get the food that matches to the title or description of the food
        $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        //Execute the query
        $result = mysqli_query($conn, $sql);
        //Count rows
        $count = mysqli_num_rows($result);
        //check whether food is available or not
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                //Get data from DB
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];

                //the food item will be displayed from below
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
<?php include("partials_front/_footer.php");  ?>
