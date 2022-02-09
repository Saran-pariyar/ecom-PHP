<?php 
ob_start();
include("partials/_menu.php");  ?>

<?php
//Checking whether ID is set or not
if (isset($_GET['id'])) {
    //Get ID and other details
    $id = $_GET['id'];

    //SQL query to get other details
    $sql = "SELECT * FROM tbl_category WHERE id = $id";

    //Execute the query 
    $result = mysqli_query($conn, $sql);
    //Count the rows to check whether the ID is valid or not
    $count = mysqli_num_rows($result);

    //checking whether there is rows with the matching ID or not
    if ($count == 1) {
        //get all data from DB
        $row = mysqli_fetch_assoc($result);

        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        //error message
        $_SESSION['no_category_found'] = "<div class='error'>No Category Found</div>";
        header("location:" . SITEURL . "manage_category.php");
    }
} else {
    //Redirect to manage_category.php\
    header("location:" . SITEURL . "manage_category.php");
}

?>

<div class="m-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow">
                    <h3 class="m-1 text-center">Update Category </h3>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <label for="title" class="mx-1 ">Title:</label>
                            <input type="text" name="title" required id="title" class="form-control my-3 py-2" value="<?php echo $title; ?>" placeholder="Enter your Full Name">
                            <label for="image" class="mx-1 ">Current Image:</label>
                            <?php
                        //checking whether image is available or not
                        if($current_image != ""){
                            //Display the image by using img tag with html
                            ?>

                            <img src="../images/category/<?php echo $current_image; ?>" width="150px">

                            <?php
                        }
                        else{
                            //display error message that image is not available
                            echo "<div class='text-danger'>Image not available </div>";
                        }
                        ?>
                            <br>
                            
                            <label for="image" class="mx-1 ">Select Image:</label>
                            <input type="file" name="image"  id="image" class="form-control my-3 py-2">
                            <br>
                            <label class="mx-3">Featured:</label>
                            <div class="form-check form-check-inline">
                                <input <?php if($featured == "Yes"){echo "checked";} ?> class="form-check-input" type="radio" id="inlineRadio1" value="Yes" name="featured">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input <?php if($featured == "No"){echo "checked";} ?> class="form-check-input" type="radio" id="inlineRadio2" value="No" name="featured">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                            <br><br>
                            <label class="mx-3">Active:</label>
                            <div class="form-check form-check-inline">
                                <input <?php if($active == "Yes"){echo "checked";} ?> class="form-check-input" type="radio" id="inlineRadio1" value="Yes" name="active">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input <?php if($active == "No"){echo "checked";} ?> class="form-check-input" type="radio" id="inlineRadio2" value="No" name="active">
                                <label  class="form-check-label" for="inlineRadio2">No</label>
                            </div>


                            <div class="text-center mt-3">
                                <!-- this hidden input is used to get the current_image in case we don't give new image, then the current image will be saved  -->
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <!-- we need ID for below php code to know the row to update  -->
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Update Category" class="btn btn-primary">
                            </div>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //1. Update New Image if new image is given
    //checking if new image is given or not

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        //checking if new image is given
        if ($image_name != "") {
            //then image is available

            //A. upload the new image
            $split = explode('.', $image_name);
            $ext = end($split);


            //Now renaming the image
            $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; //this will be new name of our image


            $source_path = $_FILES['image']['tmp_name']; // this is location of the image

            // $destination_path is the location that we want our image to be stored 
            $destination_path = "../images/category/" . $image_name;

            //finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether image is uploaded or not
            //if image not uploaded, we will stop process and redirect with an error message
            if (!$upload) {
                //Set message
                $_SESSION['upload'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Failed!</strong> Failed to upload image!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                die("Upload failed with error code " . $_FILES['image']['error']);
                //redirect to add_category.php
                header("location:" . SITEURL . "admin/manage_category.php");
                //stop the process 
                die();
            }
            //B. Remove the image if current image is available
            if ($current_image != "") {
                $remove_path = "../images/category/" . $current_image;
                $remove = unlink($remove_path);

                //checking if image is removed or not 
                if (!$remove) {
                    //Failed to remove
                    $_SESSION['failed_remove'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Failed!</strong> Failed to remove current image!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    header("location:" . SITEURL . "admin/manage_category.php");
                    die(); // to stop the process
                }
            } else {
            }
        } else {
            //If image is still not given
            $image_name = $current_image;
        }
    } else {
        //letting the current_image to be saved 
        $image_name = $current_image;
    }

    //2.Update to the DB


    $sql2 = "UPDATE tbl_category SET 
            title =  '$title', 
            image_name = '$image_name',
            featured = '$featured', 
            active = '$active' 
            WHERE id = $id ";

    //3. Execute the query
    $result = mysqli_query($conn, $sql2) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;;

    //4.Redirect to manage_category.php with message
    if ($result) {
        //category updated
        $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Category updated!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header('location:' . SITEURL . 'admin/manage_category.php');
        ob_end_flush();
    } else {
        //Failed to update category
        $_SESSION['update'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Failed to update category!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        header('location:' . SITEURL . 'admin/manage_category.php');
        ob_end_flush();

    }
}

?>



</div>
</div>

<?php include("partials/_footer.php");  ?>