<?php  'config.php';
/**
 * Created by PhpStorm.
 * User: rjurg
 * Date: 15-4-2019
 * Time: 10:35
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <?php

        if ( isset($_SESSION['id']) ) {
            echo "You are currently logged in. Want to <a href='logout.php'>logout?</a>";
        } else {
            echo "<a href='login.php'>Login</a> &nbsp; or &nbsp; <a href='register.php'>Register</a>";
        }
        ?>


    </nav>
</header>