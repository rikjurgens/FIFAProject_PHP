<?php
/**
 * Created by PhpStorm.
 * User: rjurg
 * Date: 15-4-2019
 * Time: 10:36
 */
?>

<?php require 'header.php';

?>

<link rel="stylesheet" href="css/main.css">

<header>
    <h1>Login</h1>   
</header>
    
<div class="loginindex-split">

    <div class="splitone"></div>

    <div class="loginsplittwo">

        <div class="login-info">

        <form action="controller.php" method="post">
            <input type="hidden" name="type" value="login">

                <div>
                    <input type="username" name="username" id="username" placeholder="Username">
                </div>
                <br>
                <div>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <br>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>

    <div class="splitthree"></div>
</div>

<footer>
    <p>©team 2</p>
</footer>

<?php require 'footer.php'; ?>