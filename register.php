<?php
/**
 * Created by PhpStorm.
 * User: rjurg
 * Date: 15-4-2019
 * Time: 10:36
 */
?>
<?php require 'header.php'; ?>

<link rel="stylesheet" href="css/main.css">

<header>
    <h1>Register</h1>    
</header>

<div class="loginindex-split">

<div class="splitone"></div>

<div class="loginsplittwo">

    <div class="login-info">

        <form class="register-form" action="controller.php" method="post">

            <input type="hidden" name="type" value="register">

            <div>
                <input type="username" name="username" id="username" required placeholder="Username">
            </div>
            <br>
            <div>
                <input type="password" name="password" id="password" required placeholder="Password">
            </div>
            <br>
            <div>
                <input type="password" name="password_confirm" id="password_confirm" required placeholder="confirm password">
            </div>
            <br>
            <div>
                <input class="terms" type="checkbox" name="terms" id="terms">
                <label for="terms"><a href="terms.php">I Agree With The Terms And Conditions</label>
            </div>
            <br>
            <div class="register-form-group">

                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</div>

<div class="splitthree"></div>

</div>
<footer>
    <p>©team 2</p>
</footer>

<?php require 'footer.php'; ?>