<?php
include 'config.php';
session_start();
include 'model/users.php';
include 'header.php';

// Redirect to homepage if he logging
isset($_SESSION['username']) ? header('location:homepage.php') : '';

// Handle login form data
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $username = filter_var( $_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $userexist= false;
    $errorMsg='';

    // check if user exist in database
    $userData = Users::auth($username,$password );
    var_dump($userData);
    if( !empty($userData) ) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $userData->id;
        header('location:homepage.php');

    } else {
        $errorMsg = "<div class='alert alert-danger'>sorry username or passowrd is wrong</div>";
    }

}


?>
<button style="top:20px; border:none; position: absolute ;right:31px; background-color:#dc3545 "><a style="color:#fff;text-decoration: none; padding:4px 13px; display:inline-block"  href="./adduser.php">Add new user</a></button>
<div style="color:red"><?= !empty($errorMsg) ? $errorMsg : ''?></div>
<div class="login-form">
    <h2 class="title">Login Form</h2>
    <form method="post" action = "<?= $_SERVER['PHP_SELF'] ?> ">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" class="form-control" autocomplete="off"/>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off"/>
        </div>
        <div class="form-group">
            <input type="submit" value="login" class="btn-login"/>
        </div>

    </form>
</div>






<?php include 'footer.php'; ?>

