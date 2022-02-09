<?php include("partials_front/_menu.php"); ?>

<center>
    <div class=" m-5">
        <?php
        if (isset($_SESSION['mail'])) {
            echo $_SESSION['mail'];
            unset($_SESSION['mail']);
        }

        ?>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <h1 class="m-2">Contact Us: </h1>
                        <div class="card-body">

                            <form action="" method="POST">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>
                                            <label for="name" class="col-form-label">Name:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="name" required name="name" class="form-control" placeholder="Enter your full name" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <label for="email" class="col-form-label">Email:</label>
                                        </td>
                                        <td>
                                            <input type="email" id="email" required name="email" class="form-control" placeholder="Enter your email" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <label for="contact" class="col-form-label">Phone No:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="contact" name="contact" class="form-control" placeholder="Enter your email" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <label for="message" class="col-form-label">Message:</label>
                                        </td>
                                        <td>
                                            <textarea name="message" class="form-control" placeholder="Enter your message" id="message" style="height: 100px"></textarea>

                                        </td>
                                    </tr>

                                </table>
                                <div class="text-center mt-3 m-3">
                                    <input type="submit" name="submit" value="Send message" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];
    $date = date('Y-m-d H:i:s'); //Getting current date and time
    $sql = "INSERT INTO tbl_contact SET name='$name', email='$email',contact='$contact',message='$message',date = '$date'";
    $result = mysqli_query($conn, $sql);




    if ($result) {
        $_SESSION['mail'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sent!</strong> We will reply soon!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
        $_SESSION['mail'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Failed</strong> Unable to send message!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
?>

<?php include("partials_front/_footer.php"); ?>