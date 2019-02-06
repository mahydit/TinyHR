<?php
// require_once('../autoload.php'); //for debugging
// session_start();
if (isset($_SESSION["user_id"])) {
    $logout = new UserOperations();
    $logout->logout($_SESSION["user_id"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["is_admin"]);
}
// (isset($_SESSION["user_id"]))?unset($_SESSION["user_id"]) ;//REVIEW:
// (isset($_SESSION["is_admin"]))?unset($_SESSION["is_admin"]);//REVIEW:
session_destroy();
// header("Location: index.php");
header("Location: http://localhost/TinyHR/index.php");
// require_once "../index.php";
