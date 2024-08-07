<?php
session_start();
require '../settings/connection.php';  // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect input data from the form
    $className = $_POST['className'];
    $name = $_POST['name'];
    $major = $_POST['major'];
    $timeToStudy = floatval($_POST['timeToStudy']);
    $stressed = intval($_POST['stressed']);
    $interest = $_POST['interest'];
    $date = $_POST['date'];
    $yearGroup = $_POST['yearGroup'];

    // Validate inputs
    if (!$className || !$name || !$major || !$timeToStudy || !$stressed || !$interest || !$date || !$yearGroup) {
        die("All fields are required.");
    }

    // Fetch users who are students and whose graduation year, major, courses, and availability match the input criteria
    $stmt = $pdo->prepare("
        SELECT u.userID, u.name, u.major, up.studyHabits, up.interests, up.gradYear, up.stressLevel, up.availableDate,
               c.courseName
        FROM users u
        JOIN userProfiles up ON u.userID = up.userID
        JOIN usercourses uc ON u.userID = uc.userID
        JOIN courses c ON uc.courseID = c.courseID
        WHERE u.major = ? AND up.gradYear = ? AND c.courseName = ? AND up.availableDate = ?"
    );
    $stmt->execute([$major, $yearGroup, $className, $date]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process matching considering the date and interests
    $potentialStudyBuddies = array_filter($users, function ($user) use ($date) {
        return $user['availableDate'] === $date;
    });

    if (empty($potentialStudyBuddies)) {
        die("No study buddies are available on the selected date with the selected course and major.");
    }

    // Scoring and sorting based on time to study, stress level, and interest
    $scoreList = [];
    foreach ($potentialStudyBuddies as $buddy) {
        $timeDiff = abs($timeToStudy - $buddy['timeToStudy']);
        $stressDiff = abs($stressed - $buddy['stressLevel']);
        $interestDiff = ($interest === $buddy['interests']) ? 0 : 1;
        $score = (1 - $timeDiff / 10) * 0.4 + (1 - $stressDiff / 5) * 0.3 + (1 - $interestDiff) * 0.3;
        $scoreList[] = ['name' => $buddy['name'], 'score' => $score];
    }

    usort($scoreList, function ($a, $b) {
        return $b['score'] <=> $a['score'];
    });

    // Store results in session
    $_SESSION['matching_results'] = $scoreList;
    
    // Redirect to the display results page
    header('Location: ../html/displayResults.php');
    exit();
}
?>
