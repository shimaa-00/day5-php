<?php
include 'config.php';
session_start();
include 'model/users.php';
include 'header.php';

// if user not login redirect to loginpage
!isset( $_SESSION['username']) ? header('location:index.php') : '';
?>
<div class="container">
    <h1>Welcome <?= $_SESSION['username'] ?></h1>
</div class="container">

<?php include 'footer.php' ?>;