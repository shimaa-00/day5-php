<?php
include 'config.php';
session_start();
include 'model/users.php';
include 'header.php';

// view user data
$userid = isset($_GET['id']) ? $_GET['id'] :  header('location:./users.php');
!isset($_SESSION['username']) ? header('index.php') : '';

//Get user data
$userData = Users::getUser($userid);
// Check if there is user with this id
if( !empty( $userData )){
?>
    <div class="container-list">
        <h2 class="title">User Info</h2>
        <ul class="list">
            <li><span class="label-info">Firstname:</span><span class="label-data"><?= $userData->firstname?> </span></li>
            <li><span class="label-info">Lastname:</span><span class="label-data"><?= $userData->lastname?> </span></li>
            <li><span class="label-info">Address:</span><span class="label-data"><?= $userData->address ?> </span></li>
            <li><span class="label-info">Gender:</span><span class="label-data"><?= $userData->gender?> </span></li>
        </ul>
        <a href="users.php" class="btn btn-primary">view users</a>
    </div>

<?php

} else {
    header('location:users.php');
}
include 'footer.php';
