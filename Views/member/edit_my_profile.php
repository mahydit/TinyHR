<?php
$data = $member->get_member_information();
$errorsI = array();
$errorsC = array();
$max_size = 1000000;
$allowed_img_extension = array(
    "jpg",
    "jpeg",
);
$allowed_cv_extension = array("pdf");
if (isset($_POST["update"]) ) {
    // var_dump($_FILES);
    // echo empty($_FILES["img"]);
    // if (empty($_FILES["cv"]))
        // echo "true";
    // else
    // echo "false";
    // var_dump($_POST);
    if (file_exists($_FILES['img']['tmp_name']) || is_uploaded_file($_FILES['img']['tmp_name'])) {
        if (($_FILES["img"]['size'] > $max_size) || ($_FILES["img"]["size"] == 0)) {
            $errorsI[] = 'Please re-upload your image and remember that max size is 1mb.<br>';
        }

        if (!in_array($_FILES["img"]["type"], $allowed_img_extension) && (empty($_FILES["img"]["type"]))) {
            $errorsI[] = 'Invalid image type, only jpg is acceptable.<br>';
        }
        if(count($errorsI) === 0){
            if(file_exists( $_SERVER['DOCUMENT_ROOT']."/TinyHR/images/" . $data['username']. ".jpg" )){ 
                unlink($_SERVER['DOCUMENT_ROOT']."/TinyHR/images/" . $data['username']. ".jpg");
            }
            move_uploaded_file($_FILES["img"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/TinyHR/images/" . $data['username']. ".jpg");
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oh!</strong>';
            foreach ($errorsI as $errorI) {
                echo $errorI;
            }
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';  
        }
    }

    if (file_exists($_FILES['cv']['tmp_name']) || is_uploaded_file($_FILES['cv']['tmp_name'])){

        if (($_FILES["cv"]['size'] > $max_size) || ($_FILES["cv"]["size"] == 0)) {
            $errorsC[] = ' Please re-upload your CV and remember that max size is 1mb.<br>';
        }

        if (!in_array($_FILES["cv"]["type"], $allowed_cv_extension) && (empty($_FILES["cv"]["type"]))) {
            $errorsC[] = 'Invalid CV type, only pdf is acceptable.<br>';
        }

        if(count($errorsC) === 0){
            if(file_exists( $_SERVER['DOCUMENT_ROOT']."/TinyHR/cv/" . $data['username'] . ".pdf")){ 
                unlink( $_SERVER['DOCUMENT_ROOT']."/TinyHR/cv/" . $data['username']. ".pdf");
            }
            move_uploaded_file($_FILES["cv"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/TinyHR/cv/" . $data['username'] . ".pdf");
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oh!</strong>';
            foreach ($errorsC as $errorC) {
                echo $errorC;
            }
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';  
        }
    }
    

    if (isset($_POST['name']) && isset($_POST['job']) && count($errorsC) === 0 && count($errorsI) === 0 ) {
        $user_info = array(
            'name' => trim($_POST['name']),
            'job' => trim($_POST['job'])
        );
        if($member->update_member_information($user_info)){
            header("Location: http://localhost/TinyHR/index.php");
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oh!</strong>Something went wrong. Please, try again later.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }
    
}
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
        }

        .title {
        color: grey;
        font-size: 18px;
        }
        form{
            width:90%;
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
        
        body{
            background-color: #f5f5f5;
        }

    div.show-image {
    position: relative;
    float:left;
    width:100%;
    margin-top:5px;
}
div.show-image:hover img{
    opacity:0.5;
}
div.show-image:hover input {
    display: block;
}
div.show-image input {
    position:absolute;
    display:none;
}
div.show-image input.update {
    top:90%;
    left:0;
}
.show-image{
    margin:0;
    padding:0;
}
     
</style>
</head>
<body>
<br>
    <h2 style="text-align:center">Update Profile</h2>
<br>
    <div class="card">
    <form class="needs-validation mx-auto" novalidate="" action="" method="POST" enctype="multipart/form-data">
    
    <div class="show-image mb-3">
    <img src=<?php 
    $photo = $data["image"];
    echo "'../TinyHR/images/" . $photo . "'"; ?> 
    style='width:100%'>
    <input class="update" class="form-control-file" type="file" name="img">
</div>
            <div class="mb-3">
                <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" max="100" value="<?php echo $data["name"]; ?>" required>
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="job" id="job" placeholder="Job Position" value="<?php echo $data["job"]; ?>" max="25" required>
                    <div class="invalid-feedback" style="width: 100%;">
                        Your job is required.
                    </div>
                </div>
            </div> 
            <!-- <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern=".{8,16}"
                    required>
                <div class="invalid-feedback" style="width: 100%;">
                    Your password length must be 8-16.
                </div>
            </div> <br> -->
            <!-- <div class="mb-3">
                <div class="form-group">
                    <label for="uploadImg">Upload Image</label>
                    <input type="file" class="form-control-file" id="img" name="img" required >
                </div>
            </div> <br> -->
            <div class="mb-3">
                <div class="form-group">
                    <label for="uploadCV" style="font-size: 24px;"><b>Upload CV</b></label>
                    <input type="file" class="form-control-file" id="CV" name="cv">
                </div>
            </div>

    <hr>
            <p> <button class="btn btn-lg btn-dark btn-block" type="submit" name="update">Update</button></p>
        </form>
    </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation')

                // Loop over them and prevent submission
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            }, false)
        }())
    </script>
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
</body>
</html>


