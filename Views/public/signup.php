<?php
// require_once('../../autoload.php'); //for debugging
// session_start();
$errors =array();
$max_size = 1000000;
$allowed_img_extension = array(
    "jpg",
    "jpeg"
);
$allowed_cv_extension = array("pdf");
if(isset($_POST["submit"]))
{
    if(isset($_FILES["img"]) && isset($_FILES["cv"]))
    {
        if(($_FILES["img"]['size'] > $max_size) || ($_FILES["img"]["size"] == 0)) {
            $errors[] = 'Please re-upload your image and remember that max size is 1mb.<br>';
        }

        if(($_FILES["cv"]['size'] > $max_size) || ($_FILES["cv"]["size"] == 0)) {
            $errors[] = ' Please re-upload your CV and remember that max size is 1mb.<br>';
        }

        if(!in_array($_FILES["img"]["type"], $allowed_img_extension) && (empty($_FILES["img"]["type"]))) {
            $errors[] = 'Invalid image type, only jpg is acceptable.<br>';
        }

        if(!in_array($_FILES["cv"]["type"], $allowed_cv_extension) && (empty($_FILES["cv"]["type"]))) {
            $errors[] = 'Invalid CV type, only pdf is acceptable.<br>';
        }

    }
    else
    {
        $errors[] = 'Please, make sure to upload all required files.<br>';
    }

    if(count($errors)===0)
    {
        $signup = new UserOperations();
        $user_info = array(
            'name'=>trim($_POST['name']),
            'job' => trim($_POST['job']),
            'username'=>trim($_POST['username']),
            'user_password'=>password_hash(trim($_POST['password']), PASSWORD_DEFAULT),
            'CV'=>trim($_POST['username']).".pdf",
            'image'=>trim($_POST['username']).".jpg",
            'is_onlline'=>1,
        );
        if(!$signup->sign_up($user_info))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oh!</strong>You should choose another username. This one is not available.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
        else
        {
            // FIXME: file path
            move_uploaded_file($_FILES["img"]["tmp_name"], "C:\wamp64\www\TinyHR\images\\".trim($_POST['username']).".jpg");
            move_uploaded_file($_FILES["cv"]["tmp_name"], "C:\wamp64\www\TinyHR\cv\\".trim($_POST['username']).".pdf");
        }
    }
    else
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oh!</strong>';
        foreach($errors as $error) {
            echo $error;
        }
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">

    <title>Sign Up</title>
    <style>
    .container {
        max-width: 960px;
    }

    .lh-condensed {
        line-height: 1.25;
    }

    form {
        display: block;
        margin-top: 0em;
        width: 100%;
        padding: 15px;
        margin: auto;
    }

    </style>
</head>

<body class="bg-light container">
<br>
    <div class="col-md-12">
        <h4 class="mb-3">Personal Information</h4>
        <form class="needs-validation" novalidate="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" max="100" value="" required>
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </div>
            <div class="mb-3">
                <label for="job">Job</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="job" id="job" placeholder="Job Position" max="25" required>
                    <div class="invalid-feedback" style="width: 100%;">
                        Your job is required.
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="username">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" max="50" required>
                    <div class="invalid-feedback" style="width: 100%;">
                        Your username is required.
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern=".{8,16}"
                    required>
                <small id="passwordHelpInline" class="text-muted">
                    Must be 8-16 characters long.
                </small>
                <div class="invalid-feedback" style="width: 100%;">
                    Your password length must be 8-16.
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="uploadImg">Upload Image</label>
                    <input type="file" class="form-control-file" id="img" name="img" required >
                    <small id="passwordHelpInline" class="text-muted">
                    Max size is 1MB.
                </small>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="uploadCV">Upload CV</label>
                    <input type="file" class="form-control-file" id="CV" name="cv" required >
                    <small id="passwordHelpInline" class="text-muted">
                    Max size is 1MB.
                </small>
                </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Sign Up!</button>
            <button type="button" class="btn btn-link"><a href="<?php echo $_SERVER['PHP_SELF']."?login";?>">Already have an account? login!</a></button>

        </form>
    </div>

    <!-- Optional JavaScript -->
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