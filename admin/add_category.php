<?php
ob_start();
include("partials/_menu.php"); ?>
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
                            <input type="text" name="title" required id="title" class="form-control my-3 py-2" placeholder="Enter your Full Name">
                            <label for="image" class="mx-1 ">Select Image:</label>
                            <input type="file" name="image" required id="image" class="form-control my-3 py-2">
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
                                <input type="submit" name="submit" value="Add admin" class="btn btn-primary">
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
            $title = $_POST['title'];

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; 
            }

            //for active radio input
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            if (isset(($_FILES['image']['name']))) {
                //to upload image, we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                //uploading the image only if image is available by checking whether image_name is empty of not
                //If $image_name is not empty, that means image is available to upload
                if ($image_name != "") {

                    //Auto renaming image
                    //Getting the extension of our image (.jpg, .jpeg)
                    $split = explode('.',$image_name);
                    $ext = end($split);
                    
                    // it will break the image name after '.'(splitting into two words)
                    //the end() func gets the last value of the $image_name after splitting with '.'
                    //in the $ext, extension value of image is saved (eg. .jpeg, .png, etc)



                    //Now renaming the image
                    $image_name = "Item_Category_" . rand(000, 999) . '.' . $ext; //this will be new name of our image


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
                        header("location:".SITEURL."admin/add_category.php");
                        ob_end_flush();
                        //stop the process 
                        die();
                    }
                }
            } else {
                //set image name value as blank
                $image_name = "";
            }

            //2. Create a sql query to insert to DB
            $sql = "INSERT INTO tbl_category SET
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active' ";

            //3. Execute the query
            //the code after 'or' will display errors of our query
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;


            //4. Checking whether query is successfully executed or not
            if ($result) {
                //Category inserted
                $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Category added successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                //redirect to manage_category.php
                header("location:".SITEURL."admin/manage_category.php");
                ob_end_flush();
            } else {
                //failed to insert category
                $_SESSION['add'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Failed!</strong> Failed to add category!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';;

                //redirect to manage_category.php
                header("location:".SITEURL."admin/manage_category.php");
                ob_end_flush();
            }
        }

        ?>


<!-- footer starts  -->
<?php include("partials/_footer.php"); ?>