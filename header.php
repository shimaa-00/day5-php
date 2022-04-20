<?php

if(  isset($_SESSION['username']) ) {
    $userId = $_SESSION['id'];
    // Get user img
    $user = Users::getUser( $userId);

}
?>
<!Doctype>
<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/file.css"/>
</head>
<body>
    <?php 
    if( isset($_SESSION['username'])){ 
    ?>
    <header>
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="#">Brand</a>
                <ul class="list-unstyled navbar-nav me-auto ms-5    ">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Checks</a>
                    </li>
                </ul>
                <a href="#" class="avatar">
                    <img src="<?= !empty( $user->img) ? "./img/{$user->img}" : "./img/unknown.jpg"?>" width="50"/>
                </a>
                <button class="toggle" id="toggle-menu" data-nav="navbar-submenu">
                    <a class="username"><?= $_SESSION['username']?> </a>
                    <i class="fas fa-chevron-down"></i>
                    <ul class="list-unstyled navbar-submenu">
                        <li><a href="#">profile</a></li>
                        <li><a href="#">edit</a></li>
                        <li><a href="logout.php">logout</a></li>
                    </ul>
                </button>

            </div>
        </nav>
    </header>
<?php } ?>