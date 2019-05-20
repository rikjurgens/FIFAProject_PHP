<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    header('location: index.php');
    exit;
}

if ( $_POST['type'] === 'login' ) {

    require 'config.php';

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user_login_username_check_query = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $user_login_username_check_query->execute([$username]);
    $account = $user_login_username_check_query->fetch();
    if ($account) {
        // username has been found

        $sql = "SELECT * FROM users WHERE username = :username";
        $prepare = $pdo->prepare($sql);
        $prepare->execute([
            ':username' => $username
        ]);
        $account = $prepare->fetch(PDO::FETCH_ASSOC);
        $inputPassword = trim($_POST['password']);

        if ($account) {
//            $isThePasswordCorrect = password_verify($hashedPassword, PASSWORD_DEFAULT);
            $validPassword = password_verify($inputPassword, $account['password']);
            if ($validPassword){
                // everything is oke
                echo "everything is oke";
                session_start();

                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $account["id"];
                header( 'location: detail.php');
            }
            else {
                // wrong password try again.
                echo "wrong password try again.";
            }

        } else {
            // account not found redirect to register page.
            echo "password not found";
        }

    } else {
        // account not found redirect to register page.
        echo "username not found";
    }


    exit;
}

if ($_POST['type'] === 'register') {


    require 'config.php';


    $username = htmlentities(trim($_POST['username']));
    $password1 = htmlentities(trim($_POST['password']));
    $password2 = htmlentities(trim($_POST['password_confirm']));

    $uppercase = PREG_MATCH('@[A-Z]@', $password1);
    $lowercase = PREG_MATCH('@[a-z]@', $password1);
    $number = PREG_MATCH('@[0-9]@', $password1);

    $user_check_query = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $user_check_query->execute([$username]);
    $account = $user_check_query->fetch();
    if ($account) {

        ?>
        <script type="text/javascript">
            alert("this username is already in use");
            window.location.href = "register.php";
        </script>
        <?php


    } else {

        if (!filter_var($username))
        {
            echo("$username is not a valid username");
        }
        else
        {
            if($password1 === $password2)
            {
                if (!$uppercase || !$lowercase || !$number || !strlen($password1 < 5)) {

                    die('wachtwoord is niet goed');
                }
                if (isset($_POST['terms'])) {
                    $passwordHash = password_hash($password1, PASSWORD_BCRYPT);
                }

                $sql = "INSERT INTO users (username, password)
                    VALUES (:username, :passwordHash)";
                $prepare = $pdo->prepare($sql);
                $prepare->execute([
                    ':username' => $username,
                    ':passwordHash' => $passwordHash
                ]);

                ?>
                <script type="text/javascript">
                    alert("You have succesfully been registered");
                    window.location.href = "login.php";
                </script>
                <?php
            }
            else
            {
                ?>
                <script type="text/javascript">
                    alert("The passwords do not match");
                    window.location.href = "register.php";
                </script>
                <?php
            }
        }

    }
    exit;
}


require 'config.php';

if ($_POST['type'] == 'addteam') {
    $name = $_POST['name'];
    $creator = $_SESSION['id'];
    $players = $_POST['players'];

    $sql = "INSERT INTO teams ( name, creator, players ) 
        VALUES ( :name, :creator, :players )";
    $prepare = $pdo->prepare($sql);
    $prepare->execute([
        ':name'          => $name,
        ':creator'       => $creator,
        ':players'       => $players

    ]);

    header('Location: detail.php');

}

if ($_POST['type'] == 'editteam') {
    $sql = "UPDATE teams SET
    name     = :name,
    players  = :players
    WHERE id = :id";
    $prepare= $pdo->prepare($sql);
    $prepare->execute([
            ':name' => $_POST['name'],
            ':players'  => $_POST['players'],
            ':id' => $_POST['id']
    ]);
    $id = $_POST['id'];
    header("Location: information.php?id=$id");
    exit;
}

if($_POST['type'] == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM teams WHERE id= :id";
    $prepare = $pdo->prepare($sql);
    $prepare->execute([
        ':id' => $id
    ]);
    header('location: detail.php');
    exit;
}