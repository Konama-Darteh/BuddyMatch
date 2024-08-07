<!DOCTYPE html>
<html>
<head>
    <title>Peer Tutor Time Sheet</title>
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
            width: 400px;
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

        input, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        button {
            background: #d81b60;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #ad1457;
        }

        .time-log {
            background: #f48fb1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Peer Tutor Time Sheet</h1>

        <label for="tutorName">Peer Tutor Name</label>
        <input type="text" id="tutorName" placeholder="Enter your name">

        <label for="startDate">Start Date</label>
        <input type="date" id="startDate">

        <label for="endDate">End Date</label>
        <input type="date" id="endDate">

        <label for="hours">Hours</label>
        <input type="number" id="hours" placeholder="Enter hours" step="0.1">

        <button onclick="logHours()">Log Hours</button>

        <div id="timeSheet" style="margin-top: 20px;">
            <h2>Logged Hours</h2>
            <div id="logs"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('startDate').setAttribute('min', today);
            document.getElementById('endDate').setAttribute('min', today);
        });

        const timeSheet = [];

        function logHours() {
            const tutorName = document.getElementById('tutorName').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const hours = parseFloat(document.getElementById('hours').value);

            if (!tutorName || !startDate || !endDate || isNaN(hours) || hours < 0) {
                alert("Please fill in all fields correctly");
                return;
            }

            if (endDate < startDate) {
                alert("End Date must be after Start Date");
                return;
            }

            const logEntry = { name: tutorName, startDate: startDate, endDate: endDate, hours: hours, status: 'Pending' };
            timeSheet.push(logEntry);
            displayLogs();
        }

        function displayLogs() {
            const logsContainer = document.getElementById('logs');
            logsContainer.innerHTML = '';

            timeSheet.forEach((entry) => {
                const logDiv = document.createElement('div');
                logDiv.className = 'time-log';
                logDiv.innerHTML = `<strong>Name:</strong> ${entry.name}<br>
                                    <strong>Start Date:</strong> ${entry.startDate}<br>
                                    <strong>End Date:</strong> ${entry.endDate}<br>
                                    <strong>Hours:</strong> ${entry.hours}<br>
                                    <strong>Status:</strong> ${entry.status}`;
                logsContainer.appendChild(logDiv);
            });
        }
    </script>
</body>
</html>