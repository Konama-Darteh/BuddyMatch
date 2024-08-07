<?php
require '../settings/connection.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $major = $_POST['major'];
    $classes = $_POST['classes']; // This needs to be an array or handled as a string
    $timeToStudy = $_POST['timeToStudy'];
    $stressed = $_POST['stressed'];
    $interest = $_POST['interest'];
    $date = $_POST['date'];

    // Assuming you have a table structure to handle this data
    $stmt = $conn->prepare("INSERT INTO students (name, major, classes, timeToStudy, stressed, interest, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $name, $major, $classes, $timeToStudy, $stressed, $interest, $date);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Student added successfully.";
    } else {
        echo "Failed to add student.";
    }
}
?>
