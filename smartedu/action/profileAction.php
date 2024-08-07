<?php
session_start();
require '../settings/connection.php';  // Ensure this path is correctly linked to your database connection settings

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profilePicture'])) {
    $profilePicture = $_FILES['profilePicture'];
    $major = $_POST['major'];
    $studyHabits = $_POST['studyHabits'];
    $interests = $_POST['interests'];
    $gradYear = $_POST['gradYear'];
    $userID = $_SESSION['userID'];  // Assuming userID is stored in session upon login

    // Handling file upload
    $fileExt = strtolower(end(explode('.', $profilePicture['name'])));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileExt, $allowed)) {
        if ($profilePicture['error'] === 0) {
            if ($profilePicture['size'] < 5000000) {  // less than 5MB
                $fileNameNew = uniqid('', true) . "." . $fileExt;
                $fileDestination = '../uploads/' . $fileNameNew;
                move_uploaded_file($profilePicture['tmp_name'], $fileDestination);
                
                // Insert into database
                $stmt = $pdo->prepare("INSERT INTO userProfiles (userID, major, profilePicture, gradYear, studyHabits, interests) VALUES (?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([$userID, $major, $fileDestination, $gradYear, $studyHabits, $interests])) {
                    header("Location: profileCreatedSuccess.php");  // Redirect on success
                } else {
                    echo "There was an error saving your profile.";
                }
            } else {
                echo "Your file is too large.";
            }
        } else {
            echo "There was an error uploading your file.";
        }
    } else {
        echo "You cannot upload files of this type.";
    }
} else {
    echo "Please fill in all fields.";
}
?>
