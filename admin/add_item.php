<?php 
ob_start();
include("partials/_menu.php"); ?>
<?php
//this came from last php code of this page when Image filed to upload
if (isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
?>
<!-- //form starts  -->



<div class="m-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow">
                    <h3 class="m-1 text-center">Add Category </h3>
                    <?php
                    if (isset($_SESSION['add'])) { //checking if session is set or not 
                        echo $_SESSION['add']; //display the session message
                        unset($_SESSION['add']); //the message will be gone when we reload the page
                    }
                    if (isset($_SESSION['upload'])) {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }            
                    ?>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <label for="title" class="mx-1 ">Title:</label>
                            <input type="text" name="title" required id="title" class="form-control my-3 py-2" placeholder="Enter item">
                            
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control" placeholder="Description of item" id="floatingTextarea2" style="height: 100px"></textarea>

                            <label for="price" class="mx-1 my-1 ">Price:</label>
                            <input type="number" name="price" required id="price" class="form-control " placeholder="Enter item">
                            


                            <label for="image" class="mx-1 my-1">Select Image:</label>
                            <input type="file" name="image"  id="image" class="form-control ">
                            <br>

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
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    //This will be shown in options in dropdown
                                    echo  "<option value='" . $id . "'>" . $title . "</option>";
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
                                <input class="form-check-input" type="radio" id="inlineRadio1" value="Yes" name="featured">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio2" value="No" name="featured">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                            <br><br>
                            <label class="mx-3">Active:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio1" value="Yes" name="active">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio2" value="No" name="active">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>


                            <div class="text-center mt-3">
                                <input type="submit" name="submit" value="Add Item" class="btn btn-primary">
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
//this code will run when we click submit
if (isset($_POST['submit'])) {
    //Adding the food in the DB

    //1. Get the DATA from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    //Checking if radio values for featured and active is set or not
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        //Setting default value as No
        $featured = "No";
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        //Setting default value as No
        $active = "No";
    }

    //2. Upload the image is selected
    //Checking whether the select_image button is clicked or not
    if (isset($_FILES['image']['name'])) {
        //Get the image data
        $image_name = $_FILES['image']['name'];

        //Check if Image is selected or not (We have to do this because user can just click the select image button and not select image)
        if ($image_name != "") {

            //If you don't understand this below code, watch from 46:00 in "https://www.youtube.com/watch?v=YsrPRRLfaG0&list=PLBLPjjQlnVXXBheMQrkv3UROskC0K1ctW&index=7" 
            //Image is selected
            //A. Rename the image
            //Getting the extension of our image (.jpg, .jpeg)
            $split = explode('.', $image_name);
            $ext = end($split); // it will break the image name after '.'(splitting into two words)
            //the end() func gets the last value of the $image_name after splitting with '.'
            //in the $ext, extension value of image is saved (eg. .jpeg, .png, etc)



            //Now renaming the image
            $image_name = "Item_Name_" . rand(0000, 9999) . '.' . $ext; //this will be new name of our image

            //B. Upload the Image
            $source_path = $_FILES['image']['tmp_name']; // this is location of the image

            // $destination_path is the location that we want our image to be stored 
            $destination_path = "../images/item/" . $image_name;

            //finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);


            //check whether image is uploaded or not
            //if image not uploaded, we will stop process and redirect with an error message
            if (!$upload) {
                //Set message
                $_SESSION['upload'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Failed</strong> Unable to upload image!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                die("Upload failed with error code " . $_FILES['image']['error']);
                //redirect to add_category.php
                header("location:".SITEURL."admin/add_item.php");
                ob_end_flush();
                //stop the process 
                die();
            }
        }
    } else {
        //Set default image value as blank if image is not selected
        $image_name = "";
    }

    //3.Insert into DB
    //Create SQL query to insert into DB
    $sql2 = "INSERT INTO tbl_item SET
    title = '$title',
    description = '$description',
    price = $price,
    image_name = '$image_name',
    category_id = $category,
    featured = '$featured',
    active = '$active' ";

    //3. Execute the query
    //the code after 'or' will display errors of our query
    $result2 = mysqli_query($conn, $sql2) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;

    //4. Checking whether query is successfully executed or not
    if ($result2) {
        //Food inserted
        $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Item added successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        //redirect to manage_food.php
        header("location:".SITEURL."/admin/manage_item.php");
        ob_end_flush();
    } else {
        //failed to insert food
        $_SESSION['add'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Unable to add item!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

        //redirect to manage_category.php
        header("location:".SITEURL."/admin/manage_item.php");
        ob_end_flush();
    }
    //4.Redirect to manage_food.php with message
}

?>



<!-- footer  -->
<?php include("partials/_footer.php"); ?>
