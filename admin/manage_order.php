<?php
ob_start();
include('partials/_menu.php'); ?>

<div class="container">
    <h2>Manage Orders</h2>
    <br>
    <?php
        //this came from update_order.php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
//This came from delete_order.php
if (isset($_SESSION['delete_order'])) {
    echo $_SESSION['delete_order'];
    unset($_SESSION['delete_order']);
}
        ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Item </th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Total</th>
                <th scope="col">Order Date</th>
                <th scope="col">Status</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Contact </th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            //Getting all the orders from the DB
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //This will show the latest order first
            $result = mysqli_query($conn, $sql);
            //counting the rows
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                //Order is available
                $sn = 1; //for serial number
                while ($row = mysqli_fetch_assoc($result)) {

                    //Get all the order details from the DB
                    $id = $row['id'];
                    $item = $row['item'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status']; //Ordered, On Delivery, Delivered,Cancelled
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                    //Now displaying the data
            ?>
                    <tr>
                        <td scope="col"><?php echo $sn++; ?> </td>
                        <td scope="col"><?php echo $item; ?> </td>
                        <td scope="col"><?php echo $price; ?> </td>
                        <td scope="col"><?php echo $qty; ?> </td>
                        <td scope="col"><?php echo $total; ?> </td>
                        <td scope="col"><?php echo $order_date; ?> </td>
                        <td scope="col">
                            <?php
                            //Make different colors on different status
                            //Ordered, On Delivery , Delivered , Cancelled
                            if ($status == "Ordered") {
                                echo "<label>$status</label>";
                            } elseif ($status == "On Delivery") {
                                echo "<label style='color:#FFA500;'>$status</label>";
                            } elseif ($status == "Delivered") {
                                echo "<label style='color:#00FF00;'>$status</label>";
                            } elseif ($status == "Cancelled") {
                                echo "<label style='color:#FF0000;'>$status</label>";
                            }

                            ?>
                        </td>
                        <td scope="col"><?php echo $customer_name; ?> </td>
                        <td scope="col"><?php echo $customer_contact; ?> </td>
                        <td scope="col"><?php echo $customer_email; ?> </td>
                        <td scope="col"><?php echo $customer_address; ?> </td>
                        <td scope="col">
                            
                        <a href="<?php echo SITEURL; ?>admin/update_order.php?id=<?php echo $id; ?>" class="my-1 btn btn-success">Update Order</a>
                        <a href="<?php echo SITEURL; ?>admin/delete_order.php?id=<?php echo $id; ?>" class="my-1 btn btn-danger">Delete Order</a>
                    
                    
                    </td>

                    </tr>
            <?php
                }
            } else {
                //No Order available
                echo "<tr><td class='text-danger' colspan='12'>No orders available</td></tr>";
            }

            ?>
        </tbody>
    </table>
</div>

<?php include('partials/_footer.php'); ?>