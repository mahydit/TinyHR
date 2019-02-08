<?php
$current_index = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
$admin = new Admin();
$items = $admin->get_member_information($current_index);
// $items = $db->get_record_by_id($current_index, 'user_id');

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Profile</title>
    <style>
        .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
        font-family: arial;
        }

        .title {
        color: grey;
        font-size: 18px;
        }

        button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
        }

        a.button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 95%;
        font-size: 18px;
        }

        a {
        text-decoration: none;
        font-size: 22px;
        color: black;
        }

        button:hover, a:hover, a.button:hover {
        opacity: 0.7;
        }
</style>
</head>
<body>
    <div style="margin: 24px 0;">
        <!-- <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a> -->
    </div>


<h2 style="text-align:center">Profile</h2>

<div class="card">

  <?php
foreach ($items as $item) {
    $photo = $item["image"];
    echo "<img src='../TinyHR/images/" . $photo . "'style='width:100%'>";
    echo "<h1>" . $item["name"] . "</h1>";
    echo "<p class = 'title'>" . $item["job"] . "</p>";
    $cv = $item["cv"];
    echo "<p><a href='../TinyHR/cv/" . $cv . "'>Download CV</a></p>";
    echo "<p><a class = 'button' href = '" . $_SERVER['PHP_SELF'] . "'>Back</a></p>";

}
?>
</div>
</html>

