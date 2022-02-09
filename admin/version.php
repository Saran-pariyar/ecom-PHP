<!-- 
    Thing to add :
1. Contact us page will save its data to database and dashboard will show if someone has contacted us or not
2. admin index that shows total contactus, orders, , categories, items,revenue generated -->
<!-- Pages added and modified :
    

-->

<?php include("partials/_menu.php"); ?>
<div class="container">
    <br>
    <?php
    //this came from add_version.php page
    if (isset($_SESSION['version_add'])) {
        echo $_SESSION['version_add'];
        unset($_SESSION['version_add']);
    }
    ?>

    <a href="<?php echo SITEURL; ?>admin/add_version.php" class="btn btn-primary">Add Version</a>
    <br>
    <?php

    $sql = "SELECT * FROM tbl_version ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        //Versions Available
        while ($row = mysqli_fetch_assoc($result)) {
            $version = $row['version'];
            $feature = $row['feature'];
            $date = $row['date'];
    ?>

            <div class="card text-center m-3">
                <div class="card-header  text-light bg-success">
                    <h5>
                        Version <?php echo $version; ?> </h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Features:</h5>
                    <p class="card-text">

                        <?php echo $feature; ?>
                    </p>
                    <div id="emailHelp" class="form-text">Added on <?php echo $date; ?>.</div>
                </div>

            </div>


    <?php
        }
    } else {
    echo "<h2 class='text-danger m-3'>No Version detail added</h2>";
    
    }

    ?>


</div>

<?php include("partials/_footer.php"); ?>