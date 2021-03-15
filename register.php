<?php require("classes/common.inc.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php
    require('components/css.php');
    ?>
</head>

<body>
    <?php
    require('components/nav.php');
    ?>

    <main class="my-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['validaion_messages'])) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <?php
                                        foreach ($_SESSION['validaion_messages'] as $message_key => $message) {
                                            echo '<li>' . $message . '</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php
                                unset($_SESSION['validaion_messages']);
                            }
                            ?>
                            <form name="my-form" class="register" action="operation.php" method="post">
                                <input type="hidden" name="action" value="register_user" />
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="full_name" class="form-control" name="full_name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email_address" class="form-control" name="email">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="confirm-password" class="form-control" name="confirm_password">
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
    <?php
    require('components/scripts.php');
    ?>
    <script>
        $('form.register').on('submit', function() {

            var fullName = document.forms["my-form"]["full_name"].value;
            var email = document.forms["my-form"]["email"].value;
            var password = document.forms["my-form"]["password"].value;
            var confirmPassword = document.forms["my-form"]["confirm-password"].value;

            if (fullName == null || fullName == "") {
                alert("Please Enter Your Full Name");
                return false;
            } else if (email == null || email == "") {
                alert("Please Enter Your Email Address");
                return false;
            } else if (password == null || password == "") {
                alert("Please Enter Your Password");
                return false;
            } else if (confirmPassword == null || confirmPassword == "") {
                alert("Please Enter Confirm Password");
                return false;
            } else if (confirmPassword !== password) {
                alert("Password & Confirm Password does not Match.");
                return false;
            }

        });
    </script>
</body>

</html>