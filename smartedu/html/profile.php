<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <div class="cont">
        <a class="home-link" href="../index.php">Home</a>
        <form action="../action/profileAction.php" method="POST" enctype="multipart/form-data">
            <label for="profile-picture">
                Profile Picture
                <input type="file" name="profilePicture" id="profile-picture" accept="image/*" required>
            </label>
            <label for="major">
                Major
                <input type="text" name="major" id="major" required>
            </label>
            <label for="study-habits">
                Study Habits
                <input type="text" name="studyHabits" id="study-habits" placeholder="nightowl, videos" required>
            </label>
            <label for="interests">
                Interests
                <input type="text" name="interests" id="interests" required>
            </label>
            <label for="grad-year">
                Graduation Year
                <select name="gradYear" id="grad-year" required>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                </select>
            </label>
            <label for="time-to-study">
                Hours to Study
                <input type="number" name="timeToStudy" id="time-to-study" required>
            </label>
            <label for="stress-level">
                Stress Level (1-5)
                <input type="number" name="stressLevel" id="stress-level" min="1" max="5" required>
            </label>
            <label for="available-date">
                Available Date
                <input type="date" name="availableDate" id="available-date" required>
            </label>
            <button type="submit">Create Profile</button>
        </form>
    </div>
</body>
</html>
