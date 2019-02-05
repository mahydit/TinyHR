<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("autoload.php");
define("_ALLOW_ACCESS", 1);
session_start();
session_regenerate_id();

//********************************************//
//Routing
if (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] === true) {
    //admin views should be required here
    require_once("Views/admin/users.php");
} elseif (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] === false) {
    //members views should be required here
    require_once("Views/member/view_my_profile.php");
} else {
    //public views should be required here
    if(isset($_GET["signup"]))
    {
        require_once("Views/public/signup.php");
    }
    elseif(isset($_GET['logout']))
    {
        require_once("Views/logout.php");
    }
    else
    {
        require_once("Views/public/login.php");
        var_dump($_SESSION);
    }
}
//********************************************//



