<?php
$current_index = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
// $admin = new Admin();
$items = $admin->get_member_information($current_index);
// $items = $db->get_record_by_id($current_index, 'user_id');

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">

  <title>User Profile</title>
  <style>
  .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
        font-family: arial;
        background-color: white;
        padding: auto;
        }

        .title {
        color: grey;
        font-size: 18px;
        }

        button ,a{
        border: none;
        outline: 0;
        display: inline-block;
        padding:8px;
        text-align: center;
        cursor: pointer;
        width: 80%;
        font-size: 22px;
        margin-bottom:10px;
        padding: 5px;
        }

        .download-link {
        text-decoration: none;
        font-size: 28px;
        color: black;
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
  </style>
</head>

<body>
<br>
    <h2 style="text-align:center">Profile</h2>

    <div class="card">
      <?php
foreach ($items as $item) {
    $photo = $item["image"];
    echo "<img src='../TinyHR/images/" . $photo . "'style='width:100%'>";
    echo "<h1>" . $item["name"] . "</h1>";
    echo "<p class = 'title'>" . $item["job"] . "</p>";
    $cv = $item["cv"];
    echo "<p><a role='button' class='btn btn-dar' href='../TinyHR/cv/" . $cv . "'>Download CV</a></p>";
    echo "<p><a role='button' class='btn btn-dar' href = '" . $_SERVER['PHP_SELF'] . "'>Back</a></p>";

}
?>
    </table>
  </div>
</body>

</html>
