<?php
$host = "localhost";
$db_name = "beskerm_sellersol";
$username = "beskerm_sellersol";
$password = "S()16t4GNp";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
