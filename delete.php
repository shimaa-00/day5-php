<?php
session_start();
include 'model/users.php';
!isset($_SESSION['username']) ? header('index.php') : '';
$userId = isset($_GET['id'])  ? intval($_GET['id']) : '' ;

//Delete user
$user = Users::getUser($userId);

if( $user->deleteUser()) {
    $_SESSION['message'] = "user delete successfully";
    header('location:users.php');
}



