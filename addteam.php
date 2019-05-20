<?php
session_start();

require 'config.php';
$sql = "SELECT * FROM teams";
$query = $pdo->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);
require 'header.php';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $sql = "SELECT * FROM users WHERE id = :id";
    $prepare = $pdo->prepare($sql);
    $prepare->execute([
        ':id' => $_SESSION["id"]
    ]);
    $user = $prepare->fetch(PDO::FETCH_ASSOC);
    echo "Welkom: {$user['username']}<br>";
}
else {
    header("Location: index.php");
}

?>

<div>
    <h1>Create a Team!</h1>
    <form class="addteam-form" action="controller.php" method="post">

        <input type="hidden" name="type" value="addteam">

        <div>
            <input type="text" name="name" id="name" required placeholder="Name">
        </div>

        <br>

        <div>
            <input type="text" name="players" id="players" required placeholder="Players">
        </div>

        <br>

        <div class="addteam-form-group">

            <input type="submit" value="Add Team">
        </div>
    </form>

    <a href="detail.php">Go Back</a>

</div>

<?php require 'footer.php'; ?>


