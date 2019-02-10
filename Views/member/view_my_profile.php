<?php
defined("_ALLOW_ACCESS") or die ("Access not allowed.");
$data = $member->get_member_information();
?>

<!DOCTYPE html>
<html>

<head>
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

        button,
        a {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            text-align: center;
            cursor: pointer;
            width: 80%;
            font-size: 22px;
            margin-bottom: 10px;
            padding: 5px;
        }

        .download-link {
            text-decoration: none;
            font-size: 28px;
            color: black;
        }
</style>
</head>

<body>
    <br>
    <h2 style="text-align:center">Profile</h2>

    <div class="card">
        <?php 
        $photo = $data["image"];
        echo "<img src='../TinyHR/images/" . $photo . "' style='width:100%'>";
        ?>
        <br>
        <h1>
            <?php echo $data['name']; ?>
        </h1>
        <p class="title">
            <?php echo $data['job']; ?>
        </p>
        <p>
            <?php 
            $cv = $data["cv"];
            echo "<a class='download-link' href='../TinyHR/cv/" . $cv . "'> Download CV</a>";
            ?>
        </p>
        <hr>
        <p><a role="button" class="btn btn-dark" href="<?php echo $_SERVER['PHP_SELF']." ?edit";?>">Edit</a></p>
        <p><a role="button" class="btn btn-dark" href="<?php echo $_SERVER['PHP_SELF']." ?logout";?>">Logout</a></p>
    </div>

</body>

</html>
