<?php

require_once "autoload.php";
define("_ALLOW_ACCESS", 1);
session_start();
session_regenerate_id();

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
        require_once "Views/public/login.php";
    }
}
