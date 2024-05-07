<?php 
    session_start();
    require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Backend Forum</title>
</head>
<body>
    <div class="body-container">
        <div class="forum-header">
            <a href="index.php" style="text-decoration: none; color: #333;"><h1>UST Forum</h1></a>
            <div class="search-bar">
               <form action="/search" method="get">
                <input type="text" name="query" placeholder="Search...">
               </form>
            </div>
            <?php
            
                            /*
                This code shows that if the user has logged in the website it replaces
                the anchor tags saying "Welcome <name of user> and the Log out. Otherwise
                Sign up and Sign in are displayed
                */ 
                if(isset($_SESSION['username'])) {
            ?>      
                    <div class="dropdown">
                       <p>Welcome, <?php echo " " . $_SESSION['username']; ?></p>
                        <div class="dropdown-content">
                            <a href="profile.php">Profile Dashboard</a>
                            <a href="logout.php">Logout</a>
                            <div><?php $_SESSION['username']?></div>
                        </div>
                    </div>
            <?php } else { ?>
                <div class="buttons">
                    <a href="register.php">Sign Up</a>
                    <a href="login.php">Sign In</a>
                </div>
            <?php }?>
            
        </div>
