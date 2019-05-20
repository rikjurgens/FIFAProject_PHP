<?php
session_start();
require 'config.php';
$id = $_GET['id'];
$sql = "SELECT * FROM teams WHERE id = :id";
$prepare = $pdo->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$team = $prepare->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM users WHERE id = :id";
$prepare = $pdo->prepare($sql);
$prepare->execute([
    ':id' => $team['creator']
]);
$creator = $prepare->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $sql = "SELECT * FROM users WHERE id = :id";
    $prepare = $pdo->prepare($sql);
    $prepare->execute([
        ':id' => $_SESSION["id"]
    ]);
    $user = $prepare->fetch(PDO::FETCH_ASSOC);
    echo "Welkom: {$user['username']}<br>";
}
require 'header.php'
?>

    <h1> <?php echo $team['name']?></h1>
    <p>Creator: <?php echo htmlentities($creator['username']) ?></p>
    <p> Players: <?php echo htmlentities($team['players']) ?></p>
        <?php
        if ($user['id'] == $team['creator'] || $user['admin'] == 1){
            echo "<form action='edit.php' method='post'>
                <input type='hidden' name='type' value='edit'>
                <input type='hidden' name='id' value='{$team['id']}'>
                <input type='submit' value='Edit'>
            </form>";
        }
        if ($user['admin'] == 1) {
            echo "<form action='controller.php' method='post'>";
            echo "<input type='hidden' name='type' value='delete'>";
            echo "<input type='hidden' name='id' value='{$team['id']}'>";
            echo "<input type='submit' value='Delete'>";
            echo "</form>";
        }
        ?>

<a href="detail.php">Go Back</a>


<?php
require 'footer.php';
?>
