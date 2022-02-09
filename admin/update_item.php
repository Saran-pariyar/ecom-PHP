<?php
ob_start();
include("partials/_menu.php"); ?>



<?php
//Checking whether ID is set or not
if (isset($_GET['id'])) {
    //Get ID and other details
    $id = $_GET['id'];

    //SQL query to get other details
    $sql2 = "SELECT * FROM tbl_item WHERE id = $id";

    //Execute the query 
    $result2 = mysqli_query($conn, $sql2);
    //Count the rows to check whether the ID is valid or not
    $row2 = mysqli_fetch_assoc($result2);

    //Getting the individual value of the selected item
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    //Redirect to manage_item.php
    header("location:" . SITEURL . "/admin/manage_item.php");
    ob_end_flush();
}

?>


<!-- form startts  -->
<!-- ******************************************************************** -->




<div class="m-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow">
                    <h3 class="m-1 text-center">Add Item </h3>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <label for="title" class="mx-1 ">Title:</label>
                            <input type="text" value="<?php echo $title; ?>" name="title" required id="title" class="form-control my-3 py-2" placeholder="Enter title">

                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control" placeholder="Description of item" id="floatingTextarea2" style="height: 100px"><?php echo $description; ?></textarea>
                            <br>
                            <label for="image" class="mx-1 ">Current Image:</label>
                            <?php
                            //checking whether image is available or not
                            if ($current_image != "") {
                                //Display the image by using img tag with html
                            ?>

                                <img src="../images/item/<?php echo $current_image; ?>" width="150px">

                            <?php
                            } else {
                                //display error message that image is not available
                                echo "<div class='text-danger'>Image not available </div>";
                            }
                            ?>
                            <br>
                            <br>
                            <label for="image" class="mx-1 ">Select Image:</label>
                            <input type="file" name="image" id="image" class="form-control my-3 py-2">
                            <br>

                            <label for="price" class="mx-1 my-1 ">Price:</label>
                            <input type="number" value="<?php echo $price;  ?>" name="price" required id="price" class="form-control " placeholder="Enter item">



                            <label for="category" class="mx-1 my-1 ">Category:</label>
                            <select name="category" id="category" class="form-control">
                            <?php
                            //Create PHP code to display all the active categories in dropdown
                            //1. Create SQl query to get all the active categories from DB
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //2. Executing the query
                            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;

                            //3.Count the rows to check if we have any categories to display
                            $count = mysqli_num_rows($result);

                            if ($count > 0) {
                                //We have categories
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    //This will be shown in options in dropdown
                                    //the if condition in option selects the category that is already assigned to that food
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                                }
                            } else {
                                //We do not have any category 
                                echo  "<option value='0'>No Categories found</option>";
                            }
                            ?>
                        </select>
                            <br>
                            <label class="mx-3">Featured:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" <?php if ($featured == "Yes") {
                                                                    echo "checked";
                                                                } ?> type="radio" id="inlineRadio1" value="Yes" name="featured">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" <?php if ($featured == "No") {
                                                                    echo "checked";
                                                                } ?> type="radio" id="inlineRadio2" value="No" name="featured">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                            <br><br>
                            <label class="mx-3">Active:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" <?php if ($active == "Yes") {
                                                                    echo "checked";
                                                                } ?> type="radio" id="inlineRadio1" value="Yes" name="active">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" <?php if ($active == "No") {
                                                                    echo "checked";
                                                                } ?> type="radio" id="inlineRadio2" value="No" name="active">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>


                            <div class="text-center mt-3">
                                <!-- this hidden input is used to get the current_image in case we don't give new image, then the current image will be saved  -->
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <!-- we need ID for below php code to know the row to update  -->
                                <input type="hidden" name="id" value="<?php echo $id; ?>">

                                <input type="submit" name="submit" value="Update Item" class="btn btn-primary">
                            </div>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ******************************************************************** -->
<!-- footer starts  -->
<?php include("partials/_footer.php"); ?>



<?php

if (isset($_POST['submit'])) {
    //1. Get data from the form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //2. Upload the selected image
    //check whether upload button is clicked or not
    if (isset($_FILES['image']['name'])) {
        //Upload button clicked
        $image_name = $_FILES['image']['name']; //This is new image
        //Check whether file is available or not
        if ($image_name != "") {
            //Image is available 
            //A. Uploading the new image
            //splitting the name 
            $split = explode('.', $image_name);
            //Rename the image, first getting the image extension
            $ext = end($split); //this will save the word after '.' (i.e. extension) in this variable

            //getting a random value for new name of food
            $image_name = "Item-Name-" . rand(000, 999) . '.' . $ext; //This will rename the image

            //Get the source path and destination path
            $src_path = $_FILES['image']['tmp_name'];
            $dest_path = "../images/item/" . $image_name;

            //upload the image
            $upload = move_uploaded_file($src_path, $dest_path);

            //check whether image is uploaded or not
            //if image not uploaded, we will stop process and redirect with an error message
            if (!$upload) {
                //Set message
                $_SESSION['upload'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Failed!</strong> Unable to upload new image!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                die("Upload failed with error code " . $_FILES['image']['error']);
                //redirect to add_category.php
                header("location:" . SITEURL . "/admin/manage_item.php");
                ob_end_flush();
                //stop the process 
                die();
            }
            //B. Remove the current image is available
            if ($current_image != "") {
                //Current Image is available
                //Remove the image
                $remove_path = "../images/item/" . $current_image;
                $remove = unlink($remove_path);
                //checking if image is removed or not 
                if (!$remove) {
                    //Failed to remove
                    $_SESSION['failed_remove'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong> Failed to remove current image!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    header("location:".SITEURL."admin/manage_item.php");
                ob_end_flush();
                    die(); // to stop the process
                }
            }
        }
        else{
            $image_name = $current_image;
        }
    } else {
        //upload button not clicked
        $image_name = $current_image;
    }

    //Now update the food in the DB
    $sql3 = "UPDATE tbl_item SET 
     title = '$title',
    description = '$description',
    price = $price,
    image_name = '$image_name',
    category_id = $category,
    featured = '$featured',
    active = '$active' 
    WHERE id = $id";

    //Execute the sql query
    $result3 = mysqli_query($conn, $sql3) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
    //4.Redirect to manage_food.php with message 
    if ($result3) {
        //category updated
        $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Item updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header("location:".SITEURL."admin/manage_item.php");
        ob_end_flush();

    } else {
        //Failed to update category
        $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Unable to update Item!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header("location:".SITEURL."admin/manage_item.php");
        ob_end_flush();

    }
}
?>
