<!DOCTYPE html>
<html>
<head>
    <title>Rating System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f0f0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select, input {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        button {
            background: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #45a049;
        }
        .report-form {
            display: none;
            background: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .report-form label {
            margin-bottom: 5px;
            display: block;
        }
        .report-form select {
            margin-bottom: 10px;
        }
        .home-link{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href="../index.php" class="home-link">Home</a>
    <div class="container">
        <h1>Rate Your Study Partner</h1>
        <label for="partner">Partner</label>
        <select id="partner">
            <!-- Dynamic list of partners -->
            <option value="Partner 1">Patricia</option>
            <option value="Partner 2">Ato</option>
            <!-- Add more options as needed -->
        </select>
        <label for="rating">Rating (1-5)</label>
        <select id="rating" onchange="checkRating()">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button onclick="submitRating()">Submit Rating</button>
        
        <div class="report-form" id="report-form">
            <h2>Report Issue</h2>
            <label for="reason">Reason</label>
            <select id="reason">
                <option value="Did not show up">Did not show up</option>
                <option value="Improper behavior">Improper behavior</option>
                <option value="Assault">Assault</option>
                <option value="Bully">Bully</option>
                <option value="Other">Other</option>
            </select>
            <button onclick="submitReport()">Submit Report</button>
        </div>
    </div>
    <script>
        function checkRating() {
            const rating = document.getElementById('rating').value;
            const reportForm = document.getElementById('report-form');
            if (rating < 3) {
                reportForm.style.display = 'block';
            } else {
                reportForm.style.display = 'none';
            }
        }

        function submitRating() {
            const partner = document.getElementById('partner').value;
            const rating = document.getElementById('rating').value;

            // Send rating data to the server (replace with actual server URL and logic)
            console.log(`Rating submitted: Partner - ${partner}, Rating - ${rating}`);

            alert('Rating submitted successfully');
        }

        function submitReport() {
            const partner = document.getElementById('partner').value;
            const reason = document.getElementById('reason').value;

            // Send report data to the admin (replace with actual server URL and logic)
            console.log(`Report submitted: Partner - ${partner}, Reason - ${reason}`);

            alert('Report submitted successfully');
        }
    </script>
</body>
</html>
