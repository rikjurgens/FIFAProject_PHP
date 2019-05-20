<?php
session_start();

require 'config.php';
$sql = "SELECT * FROM teams where id = :id";
$prepare = $pdo->prepare($sql);
$prepare->execute([
    ':id' => $_POST['id']
]);
$team = $prepare->fetch(PDO::FETCH_ASSOC);
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
    <h1>Edit team: <?=$team['name']?></h1>
    <form class="addteam-form" action="controller.php" method="post">

        <input type="hidden" name="type" value="editteam">
        <input type="hidden" name="id" value="<?=$team['id']?>">

        <div>
            <input type="text" name="name" id="name" required value="<?=$team['name']?>">
        </div>

        <br>

        <div>
            <input type="text" name="players" id="players" required value="<?=$team['players']?>">
        </div>

        <br>

        <div class="addteam-form-group">

            <input type="submit" value="Edit Team">
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>