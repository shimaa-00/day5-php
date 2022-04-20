<?php
include 'config.php';
session_start();
include 'model/users.php';
include 'header.php';
$userId = isset($_GET['id']) ? intval($_GET['id']) : header('location:users.php');
$error = isset($_GET['error']) ? json_decode($_GET['error']) : '';

// Fetch user data from database
echo "<pre>";
$userData = Users::getUser($userId);
print_r($userData);
echo "</pre>";
if( !empty($userData )) {
  ?>
    <div class="container-form">
        <form method="post" action="validateuser.php?id=<?= $userId ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>First name</label>
                <input class="form-style" type="text" name="firstname"
                       value="<?= $userData->firstname ?> "/>
                <span class="error"><?= isset($error->firstname) ? $error->firstname : '' ?></span>
            </div>
            <div class="form-group">
                <label>Last name</label>
                <input class="form-style" ="text" name="lastname" value="<?= $userData->lastname ?>" />
                <span class="error"><?= isset($error->lastname) ? $error->lastname : '' ?></span>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input class="form-style" type="text" name="address" value="<?= $userData->address  ?>"/>
                <span class="error"><?= isset($error->address) ? $error->address : '' ?></span>
            </div>

            <!-- Gender-->
            <div class="form-group">
                <label>Gender</label>
                <div class="gender-inline">
                    <input type="radio" name="gender" value="male" id="male" <?= ($userData->gender == 'male') ? 'checked' : ''  ?> />
                    <label for="male">Male</label>
                </div>
                <div class="gender-inline">
                    <input type="radio" name="gender" value="female" id="female" <?= ($userData->gender == 'female') ? 'checked' : ''  ?>/>
                    <label for="female">Female</label>
                </div>
            </div>
            <!-- End gender -->

            <div class="form-group">
                <label>Username</label>
                <input class="form-style" type="text" name="username"
                       value="<?= $userData->username ?>"/>
                <span class="error"><? echo isset($error->username) ? $error->username : '' ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-style" type="password" name="password"
                       value="<?= $userData->password ?>"/>
                <span class="error"><? echo isset($error->password) ? $error->password : '' ?></span>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input class="form-style" type="file" name="userimg">
                <span class="error"><?=  isset($error->img) ? $error->img : '' ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="button" value="update"/>
            </div>
        </form>
    </div>

    <?php
} else {
    echo "no found user";
}
include 'footer.php';
?>

