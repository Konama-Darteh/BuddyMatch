<?php
session_start();
require '../settings/connection.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $roleID = $_POST['role']; // Directly using the value as role ID

        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            exit;
        }

        // Check if email exists
        $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            echo "Email already exists.";
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, roleID) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $passwordHash, $roleID])) {
            header('Location: ../html/register.php');
            exit;
        } else {
            echo "Registration failed.";
        }
    } elseif (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT userID, name, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['name'] = $user['name'];
            header('Location: ../index.php?');
            exit;
        } else {
            echo "Invalid login credentials.";
        }
    }
}
?>
