<?php include_once("classes/common.inc.php");
$dbo = new DBO();
if (isset($_GET['action']) || isset($_POST['action'])) {
    $posted    = ($_SERVER['REQUEST_METHOD'] == "POST") ? true : false;
    $data = array();
    $_SESSION['Reg_error'] = array();
    if (!empty($_GET)) {
        $data = $_GET;
    } else if (!empty($_POST)) {
        $data = $_POST;
    }

    switch ($data['action']) {
        case "register_user":
            $data['password'] = md5($data['password']);
            $user = new User("INSERT", $data);
            if ($user) {
                $_SESSION['validaion_message_sucess'] = "Registerd Successfully";
                header("location: index.php");
            } else {
                header("location: register.php");
            }
            break;

        case "login":
            $user = new User();
            $data['password'] = md5($data['password']);
            $res = $user->select("*", "email='" . $data['email'] . "' && password='" . $data['password'] . "'");
            if (!empty($res)) {
                $_SESSION['userID'] = $res[0]['id'];
                $_SESSION['full_name'] = $res[0]['full_name'];
                $_SESSION['pwd_error'] = '0';
                $_SESSION['validaion_message_sucess'] = "Login Successfully";
                header("location:dashboard.php");
            } else {
                $_SESSION['status'] = '0';
                $_SESSION['pwd_error'] = '1';
                $_SESSION['validaion_messages'][] = "invalid email or password.";
                header("location:index.php");
            }
            break;

        case "logout":
            unset($_SESSION['userID']);
            unset($_SESSION['full_name']);
            unset($_SESSION['pwd_error']);
            session_destroy();
            $user = new User();
            $user->logout();
            $_SESSION['validaion_message_sucess'] = "Logout Successfully";
            header("location:index.php");
            break;

        case "save_credential":

            $data['password'] = base64_encode($data['password']);
            $data['user_id'] = $_SESSION['userID'];
            $userCredential = new UserCredential("INSERT", $data);
            if ($userCredential) {
                $_SESSION['validaion_message_sucess'] = "Saved Successfully";
            } else {
                $_SESSION['validaion_messages'][] = "some thing went wrong.";
            }
            header("location: dashboard.php");
            break;

        case "update_credential":

            $data['password'] = base64_encode($data['password']);
            $userCredential = new UserCredential("UPDATE", $data);
            if ($userCredential) {
                $_SESSION['validaion_message_sucess'] = "Saved Successfully";
            } else {
                $_SESSION['validaion_messages'][] = "some thing went wrong.";
            }
            header("location: dashboard.php");
            break;

        case "delete_credential":
            $userCredential = new UserCredential("DELETE", $data['id']);
            if ($userCredential) {
                $_SESSION['validaion_message_sucess'] = "Deleted Successfully";
            } else {
                $_SESSION['validaion_messages'][] = "some thing went wrong.";
            }
            header("location: dashboard.php");
            break;
    }
}
