<?php
session_start();  // Start the session at the beginning of the script

// Check if session variable is set and not empty
if (!isset($_SESSION['matching_results']) || empty($_SESSION['matching_results'])) {
    echo "No matches found or session expired.";
    exit;
}

// Retrieve the results from the session
$results = $_SESSION['matching_results'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Buddy Results</title>
    <link rel="stylesheet" href="../css/displayResult.css"> <!-- Ensure the path to your CSS is correct -->
</head>
<body>
    <div class="container">
        <h1>Matching Buddies</h1>
        <?php if (!empty($results)): ?>
            <div id="results">
                <?php foreach ($results as $buddy): ?>
                    <div class="result">
                        <strong>Name:</strong> <?= htmlspecialchars($buddy['name']); ?><br>
                        <strong>Major:</strong> <?= htmlspecialchars($buddy['major'] ?? 'N/A'); ?><br>
                        <strong>Hours to Study:</strong> <?= htmlspecialchars($buddy['hoursToStudy'] ?? 'N/A'); ?><br>
                        <strong>Stress Level:</strong> <?= htmlspecialchars($buddy['stressLevel'] ?? 'N/A'); ?><br>
                        <strong>Interest:</strong> <?= htmlspecialchars($buddy['interest'] ?? 'N/A'); ?><br>
                        <strong>Date:</strong> <?= htmlspecialchars($buddy['date'] ?? 'N/A'); ?><br>
                        <a href="rating.php?buddy=<?= urlencode($buddy['name']); ?>">Rate this Buddy</a>
                        <a href="chat.php?buddy=<?= urlencode($buddy['name']); ?>">Chat with <strong>Buddy</strong
                   </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No matching results found.</p>
        <?php endif; ?>
        <a href="../index.php" class="home-link">Back to Home</a>
    </div>
</body>
</html>
