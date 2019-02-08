<?php
//set access
// echo "member user";
$member = new Member($_SESSION["user_id"]);
$data = $member->get_member_information();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    <title>Profile</title>
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

        /* button:hover, a:hover {
        opacity: 0.7;
        } */

        /* body{
            background-color: #f5f5f5;
        } */
</style>
</head>
<body>
<br>
    <h2 style="text-align:center">Profile</h2>

    <div class="card">
    <!-- <img src="/w3images/team2.jpg" alt="John" style="width:100%"> -->
    <?php $photo = $data["image"];
echo "<img src='../TinyHR/images/" . $photo . "' style='width:100%'>";
?>
    <br><h1><?php echo $data['name']; ?></h1>
    <p class="title"><?php echo $data['job']; ?></p>
    <p><?php $cv = $data["cv"];
echo "<a class='download-link' href='../TinyHR/cv/" . $cv . "'>Download CV</a>";
?></p>
    <!-- <div style="margin: 24px 0;"> -->
        <!-- <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a> -->
    <!-- </div> -->
    <hr>
    <p><button  type="button"class="btn btn-dark">Edit</button></p>
    <p><a role="button" class="btn btn-dark" href="<?php echo $_SERVER['PHP_SELF']."?logout";?>">Logout</a></p>
    </div>

</body>
</html>
