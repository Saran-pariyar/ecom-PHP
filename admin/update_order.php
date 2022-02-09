<?php
ob_start();
include('partials/_menu.php'); ?>

<div class="container">
    <h2>Update Order</h2><br><br>

    <?php
    //check whether ID is set or not
    if (isset($_GET['id'])) {
        //Get the order details
        $id = $_GET['id'];

        //Get all the details based on this id
        //SQL query to get the order details
        $sql = "SELECT * FROM tbl_order WHERE id=$id";
        //Execute the query
        $result = mysqli_query($conn, $sql);
        //count the number of rows
        $count = mysqli_num_rows($result);
        //Check whether the order is available or not
        if ($count == 1) { //because one Id will have only 1 data
            $row = mysqli_fetch_assoc($result);
            //Details available
            $id = $row['id'];
            $item = $row['item'];
            $price = $row['price'];
            $qty = $row['qty'];
            $status = $row['status']; //Ordered, On Delivery, Delivered,Cancelled
            $customer_name = $row['customer_name'];
            $customer_contact = $row['customer_contact'];
            $customer_email = $row['customer_email'];
            $customer_address = $row['customer_address'];
        } else {
            //Details not available
            //Redirect to manage_order.php
            header("location:" . SITEURL . 'admin/manage_order.php');
            ob_end_flush();
        }
    } else {
        //Redirect to manage_order.php
        header("location:" . SITEURL . 'admin/manage_order.php');
        ob_end_flush();
    }
    ?>

    <!-- //form -->

    <form action="" method="post" class="bg-light">
        <table class="table ">

            <tr>
                <td>
                    <label class="col-form-label">Item Name:</label>
                </td>
                <td>
                    <b><?php echo $item; ?></b>
                </td>
            </tr>


            <tr>
                <td>
                    <label class="col-form-label">Price:</label>
                </td>
                <td>
                    <b><?php echo $price; ?></b>
                    <input type="hidden" name="price" value="<?php echo $price; ?>" >
                </td>
            </tr>

            <tr>
                <td>
                    <label for="qty" class="col-form-label">Qty:</label>
                </td>
                <td>
                    <input type="number" id="qty" required name="qty" class="form-control" value="<?php echo $qty ?>" placeholder="Enter quantity eg.1,2,3" aria-describedby="passwordHelpInline">

                </td>
            </tr>

            <tr>
                <td>
                    <label for="status" class="col-form-label">Status:</label>
                </td>
                <td>
                    <select name="status" id="status" class="form-control">
                        <option <?php if ($status == "Ordered") {
                                    echo 'selected';
                                } ?> value="Ordered">Ordered</option>
                        <option <?php if ($status == "On Delivery") {
                                    echo 'selected';
                                } ?> value="On Delivery">On Delivery</option>
                        <option <?php if ($status == "Delivered") {
                                    echo 'selected';
                                } ?> value="Delivered">Delivered</option>
                        <option <?php if ($status == "Cancelled") {
                                    echo 'selected';
                                } ?> value="Cancelled">Cancelled</option>


                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="customer_name" class="col-form-label">Customer Name:</label>
                </td>
                <td>
                    <input type="text" id="customer_name" required name="customer_name" class="form-control" value="<?php echo $customer_name; ?>" aria-describedby="passwordHelpInline">

                </td>
            </tr>

            <tr>
                <td>
                    <label for="customer_contact" class="col-form-label">Customer Contact:</label>
                </td>
                <td>
                    <input type="text" id="customer_contact" required name="customer_contact" class="form-control" value="<?php echo $customer_contact; ?>" aria-describedby="passwordHelpInline">

                </td>
            </tr>

            <tr>
                <td>
                    <label for="customer_email" class="col-form-label">Customer Email:</label>
                </td>
                <td>
                    <input type="text" id="customer_email" required name="customer_email" class="form-control" value="<?php echo $customer_email; ?>" aria-describedby="passwordHelpInline">

                </td>
            </tr>

            <tr>
                <td>
                    <label for="customer_address" class="col-form-label">Customer Address:</label>
                </td>
                <td>
                    <textarea name="customer_address" class="form-control" placeholder="Enter customer address" id="customer_address" style="height: 100px"><?php echo $customer_address; ?></textarea>
                </td>
            </tr>





        </table>
        <div class="text-center mt-3 m-3">
            <input type="submit" name="submit" value="Update Order" class="btn btn-primary">
        </div>
    </form>


    <?php
    //Check whether submit button is clicked or not
    if (isset($_POST['submit'])) {
        //Get all the values from form
        $item = $_POST['item'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty; // total = price * quantity
        $status = $_POST['status']; //Ordered, On Delivery, Delivered,Cancelled
        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];
        //Update the value
        //Create query to update data 
        $sql2 = "UPDATE tbl_order SET
        qty=$qty,
        total=$total,
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address' WHERE id=$id ";

        //Execute the query
        $result2 = mysqli_query($conn, $sql2) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);

        //Check whether query executed successfully or not
        if ($result2) {
            //Query executed and order saved
            $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> Order updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            //redirect to manage_order.php
            header("location:" . SITEURL . 'admin/manage_order.php');
            ob_end_flush();
        } else {
            //Failed to save order into the DB
            $_SESSION['update'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Failed</strong> Unable to update order!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            //redirect to manage_order.php
            header("location:" . SITEURL . 'admin/manage_order.php');
            ob_end_flush();
        }

        //Redirect to manage_order.php

    }

    ?>



</div>



<?php include('partials/_footer.php'); ?>