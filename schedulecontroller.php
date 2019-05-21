<?php
session_start();
require 'config.php';
require 'header.php';


$sql = "SELECT * FROM teams";
$query = $pdo->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_POST['type'] === 'generate'){
    if (count($teams) <= 1){
        echo "Je hebt niet genoeg teams om een schema te maken";
        ?> <br>
        <a href="detail.php">Go back</a>
        <?php
        exit;
    }
    if (isset($_POST['matchtime']) && !empty($_POST['matchtime'])){
        $matchTime = htmlentities(trim($_POST['matchtime']));
    }
    else {
        echo "niks ingevuld bij matchtime";
        exit;
    }
    if (isset($_POST['breaktime']) && !empty($_POST['breaktime'])){
        $breakTime = htmlentities(trim($_POST['breaktime']));
    }
    else {
        echo "niks ingevuld bij breakTime";
        exit;
    }
    if (isset($_POST['resttimecheck']) && !empty($_POST['resttimecheck'])){
        if (isset($_POST['resttime']) && !empty($_POST['resttime'])) {
            $restTime = htmlentities(trim($_POST['resttime']));
        }
        else {
            echo "niks ingevuld bij resttime";
            exit;
        }
    }
    else {
        $restTime = 0;
    }
    // Retrieve all teams
    $sql = "SELECT * FROM teams";
    $query = $pdo->query($sql);
    $teams = $query->fetchAll(PDO::FETCH_ASSOC);
    $shedule1 = array();
    $shedule2 = array();
    $teamsCount = count($teams);
    for ($i = 0; $i < $teamsCount; $i++){
        $allTeams[$i] = $teams[$i]['id'];
    }
    $allTeamsCount = count($allTeams);
    for ($i = 0; $i < $allTeamsCount; $i++){
        $team1 = array_shift($allTeams);
        $currentTeamsCount = count($allTeams);
        for ($x = 0; $x < $currentTeamsCount; $x++){
            //echo $team1 . " vs " . $allTeams[$x] . "<br>";
            array_push($shedule1,$team1);
            array_push($shedule2,$allTeams[$x]);
        }
    }
    $shedule1Count = count($shedule1);
    for ($i = 0; $i < $shedule1Count; $i++){
        $sql = "INSERT INTO schedule (team1, team2, matchtime, breaktime, resttime, field, team1score, team2score)
    VALUES ( :team1, :team2, :matchtime, :breaktime, :resttime, :field, :team1score, :team2score)";
        $prepare = $pdo->prepare($sql);
        $prepare->execute([
            ':team1'      => $shedule1[$i],
            ':team2'      => $shedule2[$i],
            ':matchtime'  => $matchTime,
            ':breaktime'  => $breakTime,
            ':resttime'   => $restTime,
            ':field'      => 1,
            ':team1score' => 0,
            ':team2score' => 0
        ]);
    }
    header ('Location: scheduleoverview.php');
}

if ($_POST['type'] === 'scoreInput'){
    $team1score = trim(htmlentities($_POST['team1score']));
    $team2score = trim(htmlentities($_POST['team2score']));
    $id = $_POST['id'];
    if (empty($team1score)){
        $team1score = 0;
    }
    if (empty($team2score)){
        $team1score = 0;
    }
    $sql = "UPDATE schedule SET 
        team1score   = :team1score,
        team2score   = :team2score
        WHERE id = :id";
    $prepare= $pdo->prepare($sql);
    $prepare->execute([
        ':team1score'  => $team1score,
        ':team2score'  => $team2score,
        ':id'          => $id
    ]);
    header('Location: scheduleoverview.php');
}
if ($_POST['type'] === 'delete'){
    $sql = "DELETE FROM schedule";
    $query = $pdo->query($sql);
    $sql = "TRUNCATE schedule";
    $query = $pdo->query($sql);
    header('Location: detail.php');
}


?>