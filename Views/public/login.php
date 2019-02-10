<?php
// require_once('../../autoload.php'); //for debugging
// session_start(); //for debugging
$errors = array();

if (isset($_POST["submit"])) {
    if (!isset($_POST["username"]) && empty($_POST["username"])) {
        $errors[] = "Please, enter your username";
    }

    if (!isset($_POST["password"]) && empty($_POST["password"])) {
        $errors[] = "Please, enter your password";
    }
    if (count($errors) === 0) {
        $login = new UserOperations();
        if (!$login->login_user(trim($_POST["username"]), trim($_POST["password"]))) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oh something went wrong!</strong> Check your username and password again.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        } else {
            header("Location: http://localhost/TinyHR/index.php");
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oh!</strong>';
        foreach ($errors as $error) {
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

    <title>login</title>

    <style>
   html,
   body {
       height: 100%;
   }

   body {
       /* display: -ms-flexbox; */
       /* display: flex; */
       /* -ms-flex-align: center; */
       align-items: center;
       padding-top: 40px;
       padding-bottom: 40px;
       background-color: #f5f5f5;
   }

   .form-container{
    margin-top:15%;
   }

   .form-signin {
       width: 100%;
       max-width: 330px;
       padding: 15px;
       margin: auto;
   }

   .form-signin .checkbox {
       font-weight: 400;
   }

   .form-signin .form-control {
       position: relative;
       box-sizing: border-box;
       height: auto;
       padding: 10px;
       font-size: 16px;
   }

   .form-signin .form-control:focus {
       z-index: 2;
   }

   .form-signin input[type="text"] {
       margin-bottom: -1px;
       border-bottom-right-radius: 0;
       border-bottom-left-radius: 0;
   }

   .form-signin input[type="password"] {
       margin-bottom: 10px;
       border-top-left-radius: 0;
       border-top-right-radius: 0;
}

/* button{
    background-color: black;
} */
    </style>
</head>



<body class="text-center container">
<div class="form-container">
    <form class="form-signin"action="" method="POST" enctype="multipart/form-data">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" class="form-control" name="username" placeholder="Username" required autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-dark btn-block" type="submit" name="submit">Sign in</button>
        <a role="button" class="btn btn-link" href="<?php echo $_SERVER['PHP_SELF'] . "?signup"; ?>">New user? Create and account NOW!</a></button>
    </form>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
</body>

</html>