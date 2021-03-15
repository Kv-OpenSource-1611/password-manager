<?php require("classes/common.inc.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php
    require('components/css.php');
    ?>
</head>

<body>
    <?php require('components/nav.php'); ?>

    <main class="my-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>
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
                            <?php
                            if (isset($_SESSION['validaion_message_sucess'])) {
                            ?>
                                <div class="alert alert-success" role="alert">
                                    <ul>
                                        <li><?php echo $_SESSION['validaion_message_sucess']; ?></li>
                                    </ul>
                                </div>
                            <?php
                                unset($_SESSION['validaion_message_sucess']);
                            }
                            ?>
                            <form name="my-form" class="login" action="operation.php" method="post">
                                <input type="hidden" name="action" value="login" />
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right"> Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </form>
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
        $('form.login').on('submit', function() {

            var email = document.forms["my-form"]["email"].value;
            var password = document.forms["my-form"]["password"].value;

            if (email == null || email == "") {
                alert("Please Enter Your Email Address");
                return false;
            } else if (password == null || password == "") {
                alert("Please Enter Your Password");
                return false;
            }

        });
    </script>
</body>

</html>