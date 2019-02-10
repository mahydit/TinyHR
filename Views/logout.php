<?php
if (isset($_SESSION["user_id"])) {
    $logout = new UserOperations();
    $logout->logout($_SESSION["user_id"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["is_admin"]);
    session_destroy();
}
header("Location: http://localhost/TinyHR/index.php");
?>
