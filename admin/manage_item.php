<?php include("partials/_menu.php"); ?>
<div class="container">

    <br>

    <h1>Manage Items</h1>
    <br>
    <a href="<?php echo SITEURL; ?>admin/add_item.php" class="btn btn-primary">Add Item</a>
    <br>
    <br>
    <?php
    //This came from add_food.php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }

    //This came from delete_item.php
    if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    //This came from delete_item.php when we failed to upload image of food 
    if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    //This came from delete_item.php when we don't get id and image_name from the URL
    if (isset($_SESSION['unauthorized'])) {
        echo $_SESSION['unauthorized'];
        unset($_SESSION['unauthorized']);
    }

    //This is from update item
    if (isset($_SESSION['no_category_found'])) {
        echo $_SESSION['no_category_found'];
        unset($_SESSION['no_category_found']);
    }
    //This is from update item
    if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }

    //This is from update item
    if (isset($_SESSION['failed_remove'])) {
        echo $_SESSION['failed_remove'];
        unset($_SESSION['failed_remove']);
    }

    //This is from update item
    if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }


    ?>

    <!-- //starts  -->
    <!-- //table starts  -->

    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Category</th>
                <th scope="col">Featured</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tbl_item";
            $result = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($result);

            //create variable for serial number
            $sn = 1;

            if ($count > 0) {
                //We have data in DB
                //Get the data and display 

                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    $category = $row['category_id'];

                    //checking if image is available or not
                    //displaying the items
            ?>
                    <tr>
                        <td scope="col"><?php echo $sn++;  ?></td>
                        <td scope="col"><?php echo $title;   ?></td>
                        <td scope="col"><?php echo $price;   ?></td>
                        <td scope="col"><?php
                                        if ($image_name != "") {
                                            //Image is available
                                            // $image_name = "<img src='../images/category/'".$image_name.">";
                                            echo "<img src='../images/item/" . $image_name . "' width='100px' />";
                                        } else {
                                            //give error message if not available
                                            echo "<div class='text-danger'>Image not available</div>";
                                        }
                                        ?></td>
                        <td scope="col"><?php
                                        //getting category name from tbl_category 
                                        $sql4 = "SELECT * FROM tbl_category WHERE id=$category";
                                        $result4 = mysqli_query($conn, $sql4);
                                        $count = mysqli_num_rows($result4);
                                        if ($count == 1) {
                                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                                $category_name = $row4['title'];
                                            }
                                        }

                                        echo $category_name;      ?></td>
                        <td scope="col"><?php echo $featured;      ?></td>
                        <td scope="col"><?php echo $active;      ?></td>
                        <td scope="col"><a href="<?php echo SITEURL; ?>admin/update_item.php?id='<?php echo $id; ?>'" class="btn btn-success">Update Item</a>
                            <a href="<?php echo SITEURL; ?>admin/delete_item.php?id='<?php echo $id; ?>'&image_name=<?php echo $image_name; ?>" class="btn btn-danger">Delete Item</a>
                        </td>
                    </tr>
                <?php
                    //we used the ID in the links to later use it to recognize the category to update or delete
                    //We used the image_name in link to update or delete it from its location (i.e images/item/)
                }
            } else {
                //We do not have data in DB
                //breaking the php so that we can display message
                ?>
                <tr>
                    <td colspan="6">
                        <div class="text-danger">No Items Added</div>
                    </td>
                </tr>
            <?php

            }

            ?>
        </tbody>
    </table>
</div>




<?php include("partials/_footer.php"); ?>