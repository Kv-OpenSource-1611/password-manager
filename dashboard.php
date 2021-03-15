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
    $dbo = new DBO();

    $user_credential = new UserCredential();
    $user_passwords =  $user_credential->select('*', 'user_id =' . $_SESSION['userID']);
    $user_password_fields = [];
    if (isset($_GET['id'])) {

        $user_password_fields =  $user_credential->select('*', 'id =' . $_GET['id']);
    }
    ?>
</head>

<body>
    <?php require('components/nav.php'); ?>

    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-5 mt-5">
                <div class="card">
                    <div class="card-header">Add Your Credential</div>
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
                        <form name="my-form" class="credential" action="operation.php" method="post">
                            <?php
                            if (isset($user_password_fields[0]['id'])) {
                            ?>
                                <input type="hidden" name="id" value="<?php echo $user_password_fields[0]['id']; ?>">
                                <input type="hidden" name="action" value="update_credential" />
                            <?php
                            } else { ?>
                                <input type="hidden" name="action" value="save_credential" />
                            <?php
                            }
                            ?>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control" name="name" value="<?php echo (isset($user_password_fields[0]['name'])) ? $user_password_fields[0]['name'] : ''; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right">URL</label>
                                <div class="col-md-6">
                                    <input type="url" id="url" class="form-control" name="url" value="<?php echo (isset($user_password_fields[0]['url'])) ? $user_password_fields[0]['url'] : ''; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="user_name" class="form-control" name="user_name" value="<?php echo (isset($user_password_fields[0]['user_name'])) ? $user_password_fields[0]['user_name'] : ''; ?>">
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo (isset($user_password_fields[0]['password'])) ? base64_decode($user_password_fields[0]['password']) : ''; ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="showPassword()">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your Credentials</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Site Name</th>
                                    <th>URL</th>
                                    <th>User Name</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($user_passwords as $key => $user_password) {
                                ?>
                                    <tr>
                                        <td><?php echo $user_password['name']; ?></td>
                                        <td><?php echo $user_password['url']; ?></td>
                                        <td><?php echo $user_password['user_name']; ?></td>
                                        <td><?php echo base64_decode($user_password['password']); ?></td>
                                        <td>
                                            <a href="dashboard.php?id=<?php echo $user_password['id']; ?>">Edit</a>
                                            <a href="operation.php?action=delete_credential&id=<?php echo $user_password['id']; ?>">Delete</a>
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require('components/scripts.php');
    ?>
    <script>
        $('form.credential').on('submit', function() {

            var name = document.forms["my-form"]["name"].value;
            var url = document.forms["my-form"]["url"].value;
            var userName = document.forms["my-form"]["user_name"].value;
            var password = document.forms["my-form"]["password"].value;

            if (name == null || name == "") {
                alert("Please Enter Your Name");
                return false;
            } else if (url == null || url == "") {
                alert("Please Enter Your Site Url");
                return false;
            } else if (userName == null || userName == "") {
                alert("Please Enter Your User Name");
                return false;
            } else if (password == null || password == "") {
                alert("Please Enter Password");
                return false;
            }

        });

        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>