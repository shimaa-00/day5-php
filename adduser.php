<?php

include 'config.php';
session_start();
require_once 'model/users.php';
require_once 'header.php';

//!isset($_SESSION['usernamre'])  ? header('location:index.php') : '';
// Check if there error with query string or old data
$error   = isset($_GET['error']) ? json_decode( $_GET['error'] ) : '';
$oldData = isset($_GET['olddata']) ? json_decode( $_GET['olddata'] ) : "";


?>

<div class="container-form">
    <?php
    if( isset($_SESSION['message'])  ) {
        echo "<div class='alert alert-danger'>".$_SESSION['message']."</div>";
        unset($_SESSION['message']);
    }
    ?>
    <h2 class="title">Add user</h2>
    <form method="post" action="validateuser.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>First name</label>
            <input class="form-style" type="text" name="firstname" value = "<?= isset($oldData->firstname) ? $oldData->firstname: '' ?>"/>
            <span class="error"><?= isset( $error->firstname ) ? $error->firstname : '' ?></span>
        </div>
        <div class="form-group">
            <label>Last name</label>
            <input class="form-style" ="text" name="lastname" value = "<?= isset($oldData->lastname) ? $oldData->lastname : '' ?>"/>
            <span class="error"><?= isset( $error->lastname ) ? $error->lastname : '' ?></span>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input class="form-style" type="text" name="address" value="<?= isset( $oldData->address ) ? $oldData->address : '' ?>"/>
            <span class="error"><?= isset( $error->address ) ? $error->address : '' ?></span>
        </div>

        <!-- Gender-->
        <div class="form-group">
            <label>Gender</label>
            <div class="gender-inline">
                <input  type="radio" name="gender" value="male" id="male" checked />
                <label for="male">Male</label>
            </div>
            <div class="gender-inline">
                <input type="radio" name="gender" value="female" id="female"/>
                <label for="female">Female</label>
            </div>
        </div>
        <!-- End gender -->



        <div class="form-group">
            <label>Username</label>
            <input class="form-style" type="text" name="username" value = "<?= isset($oldData->username) ? $oldData->username : ''?>" />
            <span class="error"><?= isset( $error->username ) ? $error->username : '' ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-style" type="password" name="password" value = "<?= isset($oldData->password) ? $oldData->password: '' ?>"/>
            <span class="error"><?= isset( $error->password ) ? $error->password : '' ?> </span>
        </div>
        <div class="form-group">
            <label>Upload image</label>
            <input type="file" name="userimg"/>
            <span class="error"><?= isset( $error->badimg ) ? $error->badimg : '' ?> </span>
        </div>

        <div class="form-group">
            <input type="submit" class="button"/>
        </div>
    </form>
</div>
<?php include 'footer.php' ?>