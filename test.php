<?php
$hour = time() + 60 * 30 ;
echo $hour ;
setcookie("login_attempts",1, $hour);
// setcookie("login_time",time(), $hour);
var_dump($_COOKIE);
$_COOKIE["login_attempts"]+= 1;
var_dump($_COOKIE);


?>