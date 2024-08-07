<?php
session_start();
require '../settings/connection.php'; // Ensure you have this file to connect to your database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $senderID = $_SESSION['userID']; // Assuming you store userID in session upon login
    $receiverID = $_POST['receiverID']; // You need to manage receiver ID dynamically
    $message = $_POST['message'];

    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (senderID, receiverID, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $senderID, $receiverID, $message);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Message sent successfully.";
        } else {
            echo "Failed to send message.";
        }
    }
}
?>
