<?php
$current_index = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
$items = $db->get_record_by_id($current_index, 'user_id');

?>
<html>
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

@media (max-width: 600px) {
  section {
    -webkit-flex-direction: column;
    flex-direction: column;
  }
}
</style>
<table cellspacing="10">
  <?php
foreach ($items as $item) {
    echo "<header>" . $item["name"] . "</header>";
    $photo = $item["image"];
    echo "<section> <nav><img src='../TinyHR/images/" . $photo . "'></nav>";
    echo "<article><h1>" . $item["job"] . "<h1>";
    echo "<p></p></article>";
    echo "</section><footer></footer>";

}
?>
</table>
</html>

