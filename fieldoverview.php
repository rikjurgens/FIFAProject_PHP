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
    <h1>Fields</h1>
    <form class="fields-form" action="fieldcontroller.php" method="post">

        <input type="hidden" name="type" value="generate">

        <h2>Add a field:</h2>
        <div>
            <label for="fieldadd">Field to be added:</label>
            <input type="text" name="fieldadd" id="fieldadd" required placeholder="Field number">
        </div>

        <br>

        <div class="addfield-form-group">

            <a href="schedulecontroller.php"><button>Add Field</button></a>

        </div>
    </form>

    <br>

    <h2>Already available Fields:</h2>

    <br>

    <a href="detail.php">Go Back</a>

</div>

<?php require 'footer.php'; ?>


