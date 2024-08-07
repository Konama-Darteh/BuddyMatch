<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate Peer Tutor Hours</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #fce4ec;
            color: #880e4f;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #f8bbd0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 600px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .time-log {
            background: #f48fb1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: left;
        }

        button {
            background: #d81b60;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #ad1457;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Validate Peer Tutor Hours</h1>

        <div id="validationLogs">
            <!-- Logs will be inserted here by JavaScript -->
        </div>
    </div>

    <script>
        const timeSheet = [
            { id: 'T001', name: 'John Doe', course: 'Calculus 1', date: '2024-07-29', hours: 5, comments: 'Covered integration techniques', status: 'Pending' },
            { id: 'T002', name: 'Jane Smith', course: 'Physics 2', date: '2024-07-30', hours: 3, comments: 'Reviewed homework problems', status: 'Pending' }
            // Sample data, in reality, fetch from a server or database
        ];

        function validateHours(index, status) {
            timeSheet[index].status = status;
            displayLogs();
        }

        function displayLogs() {
            const logsContainer = document.getElementById('validationLogs');
            logsContainer.innerHTML = '';

            timeSheet.forEach((entry, index) => {
                const logDiv = document.createElement('div');
                logDiv.className = 'time-log';
                logDiv.innerHTML = `<strong>ID:</strong> ${entry.id}<br>
                                    <strong>Name:</strong> ${entry.name}<br>
                                    <strong>Course:</strong> ${entry.course}<br>
                                    <strong>Date:</strong> ${entry.date}<br>
                                    <strong>Hours:</strong> ${entry.hours}<br>
                                    <strong>Comments:</strong> ${entry.comments}<br>
                                    <strong>Status:</strong> ${entry.status}<br>
                                    <button onclick="validateHours(${index}, 'Approved')">Approve</button>
                                    <button onclick="validateHours(${index}, 'Rejected')">Reject</button>`;
                logsContainer.appendChild(logDiv);
            });
        }

        displayLogs();
    </script>
</body>
</html>