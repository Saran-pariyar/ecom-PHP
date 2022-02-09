<?php include("partials/_menu.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
<div class="container">
  <br>
  <div class="h2 text-center">Dashboard</div>
  <br>

  <div class="row row-cols-1 row-cols-md-3 g-4">

    <div class="col">
      <div class="card text-white bg-success mb-3 h-100 text-center" style="max-width: 18rem;">
        <?php
        //Query to get all category
        $sql = "SELECT * FROM tbl_category";
        //Execute
        $result = mysqli_query($conn, $sql);
        //Count rows
        $count = mysqli_num_rows($result);
        ?>
        <div class="card-body">
          <h3 class="card-title m-0"><?php echo $count; ?></h3>
          <h4 class="card-text">Categories</h4>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card text-white bg-success mb-3 h-100 text-center" style="max-width: 18rem;">
        <?php
        //Query to get all category
        $sql2 = "SELECT * FROM tbl_item";
        //Execute
        $result2 = mysqli_query($conn, $sql2);
        //Count rows
        $count2 = mysqli_num_rows($result2);
        ?>
        <div class="card-body">
          <h3 class="card-title m-0"><?php echo $count2; ?></h3>
          <h4 class="card-text">Items</h4>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card text-white bg-success mb-3 h-100 text-center" style="max-width: 18rem;">
        <?php
        //Query to get all category
        $sql3 = "SELECT * FROM tbl_contact";
        //Execute
        $result3 = mysqli_query($conn, $sql3);
        //Count rows
        $count3 = mysqli_num_rows($result3);
        ?>
        <div class="card-body">
          <h3 class="card-title m-0"><?php echo $count3; ?></h3>
          <h4 class="card-text">Contact</h4>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card text-white bg-success mb-3 h-100 text-center" style="max-width: 18rem;">
        <?php
        //Query to get all category
        $sql4 = "SELECT * FROM tbl_order";
        //Execute
        $result4 = mysqli_query($conn, $sql4);
        //Count rows
        $count4 = mysqli_num_rows($result4);
        ?>
        <div class="card-body">
          <h3 class="card-title m-0"><?php echo $count4; ?></h3>
          <h4 class="card-text">Orders</h4>
        </div>
      </div>
    </div>


    <div class="col">
      <div class="card text-white bg-success mb-3 h-100 text-center" style="max-width: 18rem;">
        <?php
        //Create SQL query to get Total revenue generated
            //Aggregate function in SQL
            $sql5 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";//This will add all the total of all rows  and will be saved in 'Total' that we will use below and we will only count it as revenue when we deliver the food and get paid
            //Execute
        $result5 = mysqli_query($conn, $sql5);
        //Get the value
        $row5 = mysqli_fetch_assoc($result5);
        $total_revenue = $row5['Total'];
        if($total_revenue <= 0){
          $total_revenue =0; //So that we can display 0 in below if there is no revenue
      }
        ?>
        <div class="card-body">
          <h3 class="card-title m-0">$<?php echo $total_revenue; ?></h3>
          <h4 class="card-text">Total Revenue</h4>
        </div>
      </div>
    </div>






  </div>

</div>


</div>
<?php include("partials/_footer.php"); ?>