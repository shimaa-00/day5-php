<?php
require_once 'config.php';
session_start();
require_once 'model/users.php';
// check if user not logged in
!isset($_SESSION['username']) ? header('location:index.php') : '';
require_once 'header.php';

// Fetch users data from database
$users = Users::getAlluser(true, $_SESSION['id']);

?>
<div class='container-table'>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>
    <table class='table'>
        <?php
        if (!empty($users)) {
        ?>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Controll</th>
            </tr>
            <?php

            foreach ($users as $user) {
            ?>
                <tr>
                    <td><?= $user->firstname ?> </td>
                    <td><?= $user->lastname  ?> </td>
                    <td><?= $user->address   ?> </td>
                    <td><?= $user->gender  ?> </td>
                    <td>
                        <a class="btn btn-primary" href="./viewuser.php?id=<?= $user->id ?>"> View</a>
                        <a class="btn btn-success" href="./edit.php?id=<?= $user->id ?>">Edit</a>
                        <a class="btn btn-danger" href="./delete.php?id=<?= $user->id ?>">Delete</a>
                    </td>

                </tr>
            <?php

            }
            ?>
            <tr>
                <td colspan="7"><a class="btn btn-primary ms-auto mt-4 d-block" style="width:120px;" href="adduser.php">Add user</a></td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td>
                    <div class="alert alert-warning">Sorry no user found</div>
                </td>
            </tr>
            <tr>
                <td colspan="7"><a class="btn btn-primary ms-auto mt-4 d-block" style="width:120px;" href="adduser.php">Add user</a></td>
            </tr>

        <?php
        }

        ?>
    </table>
</div>


<?php


include 'footer.php';
?>