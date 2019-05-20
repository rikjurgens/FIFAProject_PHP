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
$sql = "SELECT * FROM schedule";
$query = $pdo->query($sql);
$schedule = $query->fetchAll(PDO::FETCH_ASSOC);
?>

    <h1>Teams</h1>

    <div class="teams-container">

    <?php
    echo '<ul>';

    foreach ($teams as $team) {
        $name = htmlentities($team['name']);
        echo "<li><a href='information.php?id={$team['id']}'> $name </a></li>";
    }
    echo '</ul>';
    ?>
    </div>

    <?php
        if ($user['admin'] == 0){
        echo "<form action='addteam.php' method='post'>
        <input type='submit' value='Create team'>
        </form>";
        }
    ?>

<?php

if (!empty($schedule)) {
    echo "<br><a href='scheduleoverview.php'><button>Schedule overview</button></a>";
    }

?>

    <?php
        if ($user['admin'] == 1 && empty($schedule)) {
        echo "<form action='createschedule.php' method='post'>
            <input type='hidden' name='type' value='createcompetition'>
            <br>
            <input type='submit' value='Create competition'>
        </form>";
        }

        ?>