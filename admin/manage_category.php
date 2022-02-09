<?php include("partials/_menu.php"); ?>
<div class="container ">
    <h1>Manage Category</h1>
    <br>
    <a href="<?php echo SITEURL; ?>admin/add_category.php" class="btn btn-primary">Add Category</a>
    <br>
    <?php
    if (isset($_SESSION['add'])) {
        echo  $_SESSION['add'];
        unset($_SESSION['add']); //the message will be gone when we reload the page
    }
    //This is from delete_category.php to check if image is removed or not
    if (isset($_SESSION['remove'])) {
        echo $_SESSION['remove'];
        unset($_SESSION['remove']);
    }

    //This is from delete_category.php, it will display if the category is removed or not
    if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }

    //This is from update category
    if (isset($_SESSION['no_category_found'])) {
        echo $_SESSION['no_category_found'];
        unset($_SESSION['no_category_found']);
    }

    //This is from update category
    if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }

    //This is from update category
    if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }

    //This is from update category
    if (isset($_SESSION['failed_remove'])) {
        echo $_SESSION['failed_remove'];
        unset($_SESSION['failed_remove']);
    }

    ?>

    <!-- //table starts  -->
    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Featured</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            //Getting all categories from DB
            $sql = "SELECT * FROM tbl_category";
            //Execute the query 
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
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    //checking if image is available or not
                    //displaying the categories 
            ?>
                    <tr>
                        <td scope="col"><?php echo $sn++;  ?></td>
                        <td scope="col"><?php echo $title;   ?></td>
                        <td scope="col"><?php
                                        if ($image_name != "") {
                                            //Image is available
                                            // $image_name = "<img src='../images/category/'".$image_name.">";
                                            echo "<img src='../images/category/" . $image_name . "' width='100px' />";
                                        } else {
                                            //give error message if not available
                                            echo "<div class='text-danger'>Image not available</div>";
                                        }
                                        ?></td>
                        <td scope="col"><?php echo $featured;      ?></td>
                        <td scope="col"><?php echo $active;      ?></td>
                        <td scope="col"><a href="<?php echo SITEURL; ?>admin/update_category.php?id='<?php echo $id; ?>'" class="btn btn-success">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete_category.php?id='<?php echo $id; ?>'&image_name=<?php echo $image_name; ?>" class="btn btn-danger">Delete Category</a>
                        </td>
                    </tr>
                <?php
                    //we used the ID in the links to later use it to recognize the category to update or delete
                    //We used the image_name in link to update or delete it from its location (i.e images/category/)
                }
            } else {
                //We do not have data in DB
                //breaking the php so that we can display message
                ?>
                <tr>
                    <td colspan="6">
                        <div class="text-danger">No Category Added</div>
                    </td>
                </tr>
            <?php

            }

            ?>
        </tbody>
    </table>
</div>


<?php include("partials/_footer.php"); ?>