<?php
if (isset($_SESSION["user_id"])) {
    $logout = new UserOperations();
    $logout->logout($_SESSION["user_id"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["is_admin"]);
    session_destroy();
}

if(isset($_COOKIE["login_attempts"])){
    setcookie("login_attempts", "", time() - 3600);
}
header("Location: http://localhost/TinyHR/index.php");
?>
