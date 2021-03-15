<?php @session_start();
spl_autoload_register(function ($className) {
    require_once "classes/{$className}.class.php";
});

$url = basename($_SERVER['REQUEST_URI']);

// if (!($url === "index.php" || $url === "reset.php")) {
//     if (!isset($_SESSION['userID']))
//         header("location:index.php");
// }
