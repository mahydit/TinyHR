<?php
error_reporting(E_ERROR | E_PARSE);
require_once "autoload.php";
define("_ALLOW_ACCESS", 0);
session_start();
session_regenerate_id();

//to terminate the session after a period of time if user was not active
// if (!isset($_SESSION['EXPIRES']) || $_SESSION['EXPIRES'] < time() + 300) {
//     header("Location: http://localhost/TinyHR/index.php?logout");
// }
// $_SESSION['EXPIRES'] = time() + 300;

$db = new MYSQLHandler("user"); //Admin part

//Routing
if (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] === true && !isset($_GET['logout'])) {
    //admin views should be required here
    $admin = new Admin();

    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        require_once "Views/admin/user.php";
    } elseif (isset($_GET["export"])) {
        require_once "Views/admin/Export.php";
    } else {
        require_once "Views/admin/users.php";
    }
} elseif (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] === false && !isset($_GET['logout'])) {
    //members views should be required here
    $member = new Member($_SESSION["user_id"]);
    if (isset($_GET["edit"])) {
        require_once "Views/member/edit_my_profile.php";
    } else {
        require_once "Views/member/view_my_profile.php";
    }
} else {
    //public views should be required here
    if (isset($_GET["signup"])) {
        require_once "Views/public/signup.php";
    } elseif (isset($_GET['logout'])) {
        require_once "Views/logout.php";
    } else {
        if (!isset($_COOKIE["login_attempts"])) {
            $hour = time() + 60 * 30;
            setcookie("login_attempts", 0, $hour);
        }
        require_once "Views/public/login.php";
    }
}
