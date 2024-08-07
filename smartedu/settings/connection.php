<?php
// Declare constant variables to store the database connection parameters
$HOST = 'localhost'; 
$USERNAME = 'root';
$PASSWORD = '';
$NAME = 'khapdb';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$HOST;dbname=$NAME;charset=utf8mb4", $USERNAME, $PASSWORD);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, throw an exception with the error message
    die("Connection failed: " . $e->getMessage());
}
?>
