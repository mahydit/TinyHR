<?php
$current_index = isset($_GET["current"]) && is_numeric($_GET["current"]) ? $_GET["current"] : 0;
$next_index = ($current_index + __RECORD_PER_PAGE__) ? $current_index + __RECORD_PER_PAGE__ : 0;
$previous_index = ($current_index - __RECORD_PER_PAGE__ > 0) ? $current_index - __RECORD_PER_PAGE__ : 0;
// $rowcount = $db->get_data_count();

?>



<html>

        <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">

            <div class="row">
                <input id="keyword" class="input" name="keyword" type="text" value="" size="30" />

            </div>

            </div>

            <input id="submit" name="search" type="submit" value="Search" />
            <input id="submit" name="showall" type="submit" value="Show all" />
            <br><br><br><br>

        </form>

<style>
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }

    table td a
{
    display: inline-block; /*Behaves like a div, but can be placed inline*/
    align: center;
}
    a:link, a:visited {
  background-color: black;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: grey;
}

#contact_form input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

#contact_form input[type=submit] {
  float: left;
  width: 10%;
  padding: 10px;
  background: black;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

#contact_form input[type=submit]:hover {
  background: grey;
}

</style>

<table cellspacing="10">

<?php

if (isset($_POST["showall"])) {
    $items = $db->get_full_data();
} else if (isset($_POST["search"])) {
    $keyword = (isset($_POST["keyword"])) ? $_POST["keyword"] : -1;
    $items = $db->search('name', trim($keyword));
} else {
    $items = $db->get_data(array(), $current_index);
}

echo "<tr>
    <th>Image</th>
    <th>ID</th>
    <th>Name</th>
    <th>Job</th>
    </tr>";
foreach ($items as $item) {
    $photo = $item["image"];
    $src = str_replace(".jpg", "-thumb.jpg", $photo);
    echo "<tr><td><img src='../TinyHR/images/" . $src . "'></td>";
    $id = $item["user_id"];
    echo "<td>" . $id . "</td>";
    echo "<td>" . $item["name"] . "</td>";
    echo "<td>" . $item["job"] . "</td>";
    // echo "<td>" . $item["CV"] . "</td>";
    echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?id=$id'>More</a></td></tr>";
}

if (!(isset($_POST['showall']) || isset($_POST['search']))) {
    echo "<tr><td colspan=2><a href='" . $_SERVER['PHP_SELF'] . "?current=$next_index'> Next >> </a></td>";
    echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?current=$previous_index'> Previous << </a></td></tr>";
}
?>
</table>
</html>

