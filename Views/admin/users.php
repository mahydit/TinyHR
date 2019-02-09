<?php
// echo "Admin: Users list";
$current_index = isset($_GET["current"]) && is_numeric($_GET["current"]) ? $_GET["current"] : 0;
$next_index = ($current_index + __RECORD_PER_PAGE__) ? $current_index + __RECORD_PER_PAGE__ : 0;
$previous_index = ($current_index - __RECORD_PER_PAGE__ > 0) ? $current_index - __RECORD_PER_PAGE__ : 0;
// $rowcount = $db->get_data_count();
$admin = new Admin();
?>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">

  <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

  table td a {
    display: inline-block;
    /*Behaves like a div, but can be placed inline*/
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

}
    a:link, a:visited {
  background-color: black;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.dot {
  height: 10px;
  width: 10px;
  background-color: green;
  border-radius: 50%;
  display: inline-block;
}

</style>

<body>
  <div class="w3-sidebar w3-light-grey w3-bar-block col-2" style="width:15%">
    <h3 class="w3-bar-item">Online users</h3>
    <?php

$items = $admin->get_online();
foreach ($items as $item) {
    echo "<span class='dot'></span>";
    echo "<span> " . $item['name'] . "</span><br>";
}
?>

  </div>


  <!-- Page Content -->
  <div style="margin-left:15%">

    <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">

      <input type="text" name="keyword">
      <input type="submit" name="search" value="Search">
      <input type="submit" name="showall" value="Show All">
      <table cellspacing="10">

        <?php
if (isset($_POST["showall"])) {
    // $items = $db->get_full_data();
    $items = $admin->get_all_members();
} else if (isset($_POST["search"])) {
    $keyword = (isset($_POST["keyword"])) ? $_POST["keyword"] : -1;
    // $items = $db->search('name', trim($keyword));
    $items = $admin->search_member($keyword);
} else {
    $items = $db->get_data(array(), $current_index);
    // $items = $admin->get_all_members();
}

echo "<tr>
    <th>Image</th>
    <th>ID</th>
    <th>Name</th>
    <th>Job</th>
    <th>More Details</th>
    </tr>";
foreach ($items as $item) {
    $photo = $item["image"];
    // $src = str_replace(".jpg", "-thumb.jpg", $photo);
    echo "<tr><td><img src='../TinyHR/images/" . $photo . "' width = 60px height=60px></td>";
    $id = $item["user_id"];
    echo "<td>" . $id . "</td>";
    echo "<td>" . $item["name"] . "</td>";
    echo "<td>" . $item["job"] . "</td>";
    // echo "<td>" . $item["CV"] . "</td>";
    echo "<td><a role='button' class='btn btn-dar' href='" . $_SERVER['PHP_SELF'] . "?id=$id'>More</a></td></tr>";
}

if (!(isset($_POST['showall']) || isset($_POST['search']))) {
    echo "<tr><td colspan=3><a role='button' class='btn btn-dar' href='" . $_SERVER['PHP_SELF'] . "?current=$previous_index'> << Previous  </a></td>";
    echo "<td colspan=3><a role='button' class='btn btn-dar' href='" . $_SERVER['PHP_SELF'] . "?current=$next_index'> Next >> </a></td></tr>";
}
?>
</table>
<input type='submit' name ='export' value='Export'>
<a role="button" class="btn btn-dark" href="<?php echo $_SERVER['PHP_SELF'] . "?logout"; ?>">Logout</a>
<?php

if (isset($_POST["export"])) {
    $admin->export_excel();
}

?>
</div>
</body>

</html>

</table>
</div>
</body>

</html>
