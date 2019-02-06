<?php
//set access
echo "member user";
$member = new Member($_SESSION["user_id"]);
$data = $member->get_member_information();
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

        a {
        text-decoration: none;
        font-size: 22px;
        color: black;
        }

        button:hover, a:hover {
        opacity: 0.7;
        }
</style>
</head>
<body>
    <h2 style="text-align:center">Profile</h2>

    <div class="card">
    <!-- <img src="/w3images/team2.jpg" alt="John" style="width:100%"> -->
    <?php $photo = $data["image"];
echo "<img src='../TinyHR/images/" . $photo . "' style='width:100%'>";
?>
    <h1><?php echo $data['name']; ?></h1>
    <p class="title"><?php echo $data['job']; ?></p>
    <p><?php $cv = $data["cv"];
echo "<a href='../TinyHR/cv/" . $cv . "'>Download CV</a>";
?></p>
    <div style="margin: 24px 0;">
        <!-- <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a> -->
    </div>
    <p><button>Edit</button></p>
    </div>

</body>
</html>
