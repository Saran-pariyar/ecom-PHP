<?php
include("partials/_menu.php");
?>


<div class="container">
    <?php
    //this came from add admin
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }

    //this mesage will run when we delete Admin
    if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete']; //this session variable is made in delete_admin.php file
        unset($_SESSION['delete']);
    }

    //this mesage will run when we update Admin
    if (isset($_SESSION['update'])) {
        echo $_SESSION['update']; //this session variable is made in update_admin.php file
        unset($_SESSION['update']);
    }

    //this mesage will run when user not found to change password
    if (isset($_SESSION['user_not_found'])) {
        echo $_SESSION['user_not_found']; //this session variable is made in update_password.php file
        unset($_SESSION['user_not_found']);
    }
    //if the password is changed successfully
    if (isset($_SESSION['pwd_changed'])) {
        echo $_SESSION['pwd_changed']; //this session variable is made in update_password.php file
        unset($_SESSION['pwd_changed']);
    }
    ?>
    <h1 class="m-4 text-center ">Manage Admins</h1>
    <hr>

    <br><a href="<?php echo SITEURL; ?>admin/add_admin.php" class="m-1 btn btn-primary">Add Admin</a>




    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Full Name</th>
                <th scope="col">Username</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //display the admins 
            $sql = "SELECT * FROM tbl_admin";
            $result = mysqli_query($conn, $sql);

            //checking whether query is executed or not and performing other actions
            if ($result) {
                //counting the number of rows
                $row = mysqli_num_rows($result); //func to get number of rows

                $sn = 1; //for S.No and it will increment with loop
                //checking the number of rows
                if ($row > 0) {
                    //the while loop will run till we have the value in DB
                    //the loop will get all rows value 
                    while ($row = mysqli_fetch_assoc($result)) {
                        //getting values from the DB
                        $id         = $row['id'];
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                        //display value from the DB
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name;  ?> </td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="btn btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn btn-success">Update Admin</a>
                                <!-- with the code below, we can get id of the admin to delete  -->
                                <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete Admin</a>
                            </td>
                        </tr>

            <?php
                    }
                }
            } else {
            }
            ?>
        </tbody>
    </table>

</div>


<?php include("partials/_footer.php"); ?>