<?php
ob_start();
include("partials/_menu.php"); ?>

<div class="container">
    <br>
    <?php
    //This is from this page when we delete a contact
    //This came from delete_contact.php
    if (isset($_SESSION['delete_contact'])) {
        echo $_SESSION['delete_contact'];
        unset($_SESSION['delete_contact']);
    }
    ?>
    <h2>Contact list:</h2>
    <br>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact</th>
                <th scope="col">Message</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM tbl_contact";
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
                    $name = $row['name'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $message = $row['message'];
                    $date = $row['date'];

            ?>
                    <tr>
                        <td scope="col"><?php echo $sn++;  ?></td>
                        <td scope="col"><?php echo $name;  ?></td>
                        <td scope="col"><?php echo $email;  ?></td>
                        <td scope="col"><?php echo $contact;  ?></td>
                        <td scope="col"><?php echo $message;  ?></td>
                        <td scope="col"><?php echo $date;  ?></td>
                        <td scope="col">
                            <a href="<?php echo SITEURL; ?>admin/delete_contact.php?id='<?php echo $id; ?>'" class="btn btn-danger">Delete Contact</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
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