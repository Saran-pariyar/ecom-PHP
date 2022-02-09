<?php  
ob_start();
include("partials_front/_menu.php"); ?>


<?php
if (isset($_GET['item_id'])) {
    //Get the details of the selected item
    $item_id = $_GET['item_id'];

    //Get the details of the selected item
    $sql = "SELECT * FROM tbl_item WHERE id=$item_id";
    //Execute the query
    $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
    //Counting the rows of the item to see if it is available or not
    $count = mysqli_num_rows($result);
    //Checking whether data is available or not
    if ($count == 1) { //Because there can only be one item of that id
        //We have the details
        //Get the data from DB
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
        $image_name = $row['image_name'];
    } else {
        //item not available, redirect to homepage
        header("location:" . SITEURL);
        ob_end_flush();
    }
} else {
    //Redirect to homepage
    header("location:" . SITEURL);
    ob_end_flush();
}

?>
<div class="container-fluid  text-light my-4 text-center ">
    <div class="container ">
        <h1 class="text-dark">Please fill the form to confirm the order:</h1>
        <form action="" method="POST">
        <div class=" d-flex justify-content-center align-items-center flex-column" style="background-color: #009900;">
            <h4>Selected Item:</h4>

            <div class="card mb-3 text-dark" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <?php
                        //Check whether image is available or not
                        if ($image_name == "") {
                            //Image is not available
                            echo "<div class='text-danger'> Image not Available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>/images/item/<?php echo $image_name; ?>" class="img-fluid rounded-start" alt="...">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <input type="hidden" name="item" value="<?php echo $title; //we need item name when submitting the form?>">
                            <h5 class="card-title text-success"><?php echo $title; ?></h5>
                            <h5 class="card-title "><ins>$<?php echo $price; ?></ins></h5>
                            <input type="hidden" name="price" value="<?php echo $price; //we need item name when submitting the form?>">

                            <p class="card-text"><?php echo $description;  ?></p>
                        </div>
                    </div>
                </div>


            </div>
            <h3>Enter details:</h3>

                <!--  form  -->
                <div class="row g-3 align-items-center m-1">
                    <div class="col-auto my-2 ">
                    </div>
                    <div class="col-auto">


                    </div>
                </div>


                <table class="table table-borderless text-light">
                    <tr>
                        <td>
                            <label for="qty" class="col-form-label">Enter Quantity:</label>
                        </td>
                        <td>
                            <input type="number" value="1" id="qty" required name="qty" class="form-control" placeholder="Enter quantity eg.1,2,3" aria-describedby="passwordHelpInline">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="full_name" class="col-form-label">Full Name:</label>
                        </td>
                        <td>
                            <input type="text" id="full_name" required name="full_name" class="form-control" aria-describedby="passwordHelpInline">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="contact" class="col-form-label">Phone Number:</label>
                        </td>
                        <td>
                            <input type="number" id="contact" required name="contact" class="form-control" aria-describedby="passwordHelpInline" placeholder="Enter your phone number">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="email" class="col-form-label">Email:</label>
                        </td>
                        <td>
                            <input type="email" id="email" name="email" class="form-control" aria-describedby="passwordHelpInline" placeholder="Enter your email address">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="contact" class="col-form-label">Address:</label>
                        </td>
                        <td>
                            <textarea name="address" class="form-control" placeholder="Enter your address" id="address" style="height: 100px"></textarea>
                        </td>
                    </tr>
                </table>
                <div class="text-center mt-3 m-3">
                    <input type="submit" name="submit" value="Order Now" class="btn btn-primary">
                </div>
        </div>
        </form>
    </div>
    <?php
//Checking whether submit button is clicked or not
if(isset($_POST['submit'])){
    //Getting all the details from the form
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty; // total = price * quantity
    $order_date = date('Y-m-d H:i:s');; //Getting current date and time
    $status = "Ordered"; //Ordered, On Delivery, Delivered,Cancelled
    $customer_name = $_POST['full_name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];


//Save the order in DB
//Create query to save data 
$sql2="INSERT INTO tbl_order SET
        item='$item',
        price=$price,
        qty=$qty,
        total=$total,
        order_date='$order_date',
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address' ";

         //Execute the query
         $result2 = mysqli_query($conn, $sql2) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);

         //Check whether query executed successfully or not
         if($result2){
             //Query executed and order saved
             $_SESSION['order']='<div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>Successful!</strong> Your order is placed!
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
             //redirect to homepage
             header("location:".SITEURL);
             ob_end_flush();
         }
         else{
             //Failed to save order into the DB
             $_SESSION['order']='<div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>Failed!</strong> Failed to place your order!
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
             //redirect to homepage
             header("location:".SITEURL);
             ob_end_flush();
         }
 
 }
?>



    <?php include("partials_front/_footer.php"); ?>