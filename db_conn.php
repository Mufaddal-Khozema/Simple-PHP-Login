<?php
require '../../db.php';
try {
    $conn = new PDO("mysql:host=$hostname;db_name=$db_name", $username, $password);
    $conn->exec("USE e_commerce");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed : " . $e->getMessage();
}