<?php
/**
 * Created by PhpStorm.
 * User: rjurg
 * Date: 15-4-2019
 * Time: 10:35
 */

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'fifa';

$pdo = new PDO(
    "mysql:host=$dbHost;dbname=$dbName",
    $dbUser,
    $dbPass
);




$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

