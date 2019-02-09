<?php
if(file_exists( $_SERVER['DOCUMENT_ROOT']."\TinyHR\images\llll.jpg"  )){ 
    unlink($_SERVER['DOCUMENT_ROOT']."\TinyHR\images\llll.jpg");
}

echo $_SERVER['DOCUMENT_ROOT'];

?>