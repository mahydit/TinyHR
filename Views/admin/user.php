<?php
$current_index = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
$admin = new Admin();
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
    header {
      background-color: #666;
      padding: 30px;
      text-align: center;
      font-size: 35px;
      color: white;
    }

    section {
      display: -webkit-flex;
      display: flex;
    }

    nav {
      -webkit-flex: 1;
      -ms-flex: 1;
      flex: 1;
      background: #ccc;
      padding: 20px;
    }

    nav ul {
      list-style-type: none;
      padding: 0;
    }

    article {
      -webkit-flex: 3;
      -ms-flex: 3;
      flex: 3;
      background-color: #f1f1f1;
      padding: 10px;
    }

    footer {
      background-color: #777;
      padding: 10px;
      text-align: center;
      color: white;
    }

    /* body{
  background-color: #f5f5f5;
} */

    @media (max-width: 600px) {
      section {
        -webkit-flex-direction: column;
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <table cellspacing="10">
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
    </table>
  </div>
</body>

</html>
