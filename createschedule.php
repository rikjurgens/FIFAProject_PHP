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
    <h1>Create a schedule</h1>
    <form class="addschedule-form" action="schedulecontroller.php" method="post">

        <input type="hidden" name="type" value="generate">

        <div>
            <label for="matchtime">How long is the match duration?</label>
            <input type="text" name="matchtime" id="matchtime" required placeholder="Match duration">
        </div>

        <br>

        <div>
            <label for="breaktime">How long is the break time between two matches?</label>
            <input type="text" name="breaktime" id="breaktime" required placeholder="Break time">
        </div>

        <br>

        <div>
            <label for="resttime">Is there a rest time in the match?</label>
            <input type="checkbox" name="resttimecheck" id="resttimecheck" placeholder="Rest time">
            <input type="text" name="resttime" id="resttime" placeholder="Rest time">
        </div>

        <br>

        <div class="addteam-form-group">

        <a href="schedulecontroller.php"><button>Generate schedule</button></a>

        </div>
    </form>

    <br>

    <a href="detail.php">Go Back</a>

</div>

<?php require 'footer.php'; ?>


