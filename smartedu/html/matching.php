<!DOCTYPE html>
<html>
<head>
    <title>Study Buddy Finder</title>
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

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .result-container {
            margin-top: 20px;
            background: #f48fb1;
            padding: 10px;
            border-radius: 5px;
        }

        .result {
            margin-bottom: 10px;
            padding: 10px;
            background: #f06292;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        .chat-box {
            display: none;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <a href="../index.php" class="home-link">Home</a>
    <div class="container">
        <h1>Study Buddy Finder</h1>
    <form id="studyBuddyForm" method="POST" action="../action/matchingAction.php">
        <label for="className">Course Name</label>
        <select id="className" name="className">
            <option value="Precalculus 1">Precalculus 1</option>
            <option value="Precalculus 2">Precalculus 2</option>
            <option value="Calculus 1">Calculus 1</option>
            <option value="Calculus 2">Calculus 2</option>
            <option value="Applied Calculus">Applied Calculus</option>
            <option value="Engineering Calculus">Engineering Calculus</option>
            <option value="Python">Python</option>
            <option value="OOP">OOP</option>
            <option value="Data Structures">Data Structures</option>
            <option value="Algorithms">Algorithms</option>
            <option value="WebTech">WebTech</option>
            <option value="Research Methods">Research Methods</option>
            <option value="Hardware">Hardware</option>
            <option value="COA">COA</option>
            <option value="Software Engineering">Software Engineering</option>
            <option value="Intro to AI">Intro to AI</option>
        </select>

        
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter name">

        <label for="major">Major</label>
        <input type="text" id="major" name="major" placeholder="Enter major">
        
        <label for="timeToStudy">Hours to Study</label>
        <input type="number" id="timeToStudy" name="timeToStudy" placeholder="Enter hours willing to study">
        
        <label for="stressed">Stress Level (0-5)</label>
        <input type="number" id="stressed" name="stressed" placeholder="Enter stress level" min="0" max="5">
        
        
        <label for="interest">Interest</label>
        <input type="text" id="interest" name="interest" placeholder="Enter interest (e.g., video, discussions, etc.)">

        <label for="date">Date</label>
        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d');?>">

        <label for="yearGroup">Year Group</label>
            <select id="yearGroup" name="yearGroup">
                <option value="">Select Year Group</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
            </select>
        
        <button type="submit">Find Study Buddy</button>
    </form>

        
        
    <div class="result-container" id="result-container" style="display: none;">
        <h2>Matching Buddies:</h2>
        <div id="results"></div>
    </div>


    <div class="chat-box" id="chat-box">
        <h2>Chat with <span id="chat-buddy-name"></span></h2>
        <div id="chat-messages" style="height: 200px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <!-- Chat messages will appear here -->
        </div>
        <input type="text" id="chat-input" placeholder="Type a message..." style="width: 80%;">
        <button onclick="sendMessage()">Send</button>
    </div>

    <script>
        const existingUsers = [
            ['Sindhu', 'Computer Science', ['Precalculus 1', 'Calculus 1', 'Data Structures'], 2.5, 3, 'video', '2024-02-02','2024'],
            ['Tejal', 'IMS', ['Precalculus 2', 'Applied Calculus', 'Research Methods'], 3, 4, 'slides', '2024-06-14','2024'],
            ['Rhea', 'IMS', ['Calculus 1', 'Data Structures'], 4.5, 3, 'teaching', '2024-05-22','2025'],
            ['John', 'Computer Science', ['Python', 'OOP'], 6, 2, 'discussions', '2024-08-07','2026'],
            ['Anushka', 'Computer Engineering', ['Engineering Calculus', 'Software Engineering'], 7, 4, 'video', '2024-02-19','2025'],
            ['Stacy', 'IMS', ['WebTech', 'Research Methods'], 3, 3, 'teaching', '2024-07-22','2027'],
            ['James', 'Computer Science', ['Calculus 2', 'Hardware'], 5, 2, 'video', '2024-01-28','2026'],
            ['Amaya', 'Computer Science', ['COA', 'Intro to AI'], 5.5, 3, 'discussions', '2024-01-29','2026'],
            ['Saharya', 'Computer Science', ['Data Structures', 'Algorithms'], 6, 3, 'quiet time', '2024-01-30','2024'],
            ['Bob', 'IMS', ['Python', 'WebTech'], 5, 2, 'quiet time', '2024-01-31','2027'],
            ['Dylan', 'OOP', ['Applied Calculus'], 7, 3, 'teaching', '2024-11-14','2026'],
            ['Thomas', 'BA', ['Precalculus 1', 'Precalculus 2'], 8, 3, 'slides', '2024-01-15','2025'],
            ['Mike', 'Engineering Calculus', ['Python'], 4, 2, 'slides', '2024-10-22','2024'],
            ['Gamaya', 'Software Engineering', ['Intro to AI'], 6, 3, 'video', '2025-09-17','2025'],
            ['Lizzie', 'COA', ['WebTech'], 6, 3, 'teaching', '2024-10-22','2024'],
            ['Tara', 'Precalculus 1', ['Algorithms'], 3.5, 3, 'slides', '2024-10-02','2026'],
            ['Kelsie', 'Precalculus 2', ['Research Methods'], 4, 3, 'quiet time', '2025-08-02','2027']
        ];

        function findStudyBuddy() {
        const name = document.getElementById('name').value;
        const major = document.getElementById('major').value;
        const className = document.getElementById('className').value;
        const timeToStudy = parseFloat(document.getElementById('timeToStudy').value);
        const stressed = parseInt(document.getElementById('stressed').value);
        const interest = document.getElementById('interest').value;
        const date = document.getElementById('date').value;
        const yearGroup = document.getElementById('yearGroup').value;

        // Adding the event listener inside the function might not be ideal unless you specifically intend for it.
        // Typically, you'd attach event listeners outside of other functions to ensure they are registered after the DOM is fully loaded.
        document.getElementById('studyBuddyForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission behavior
            const formData = new FormData(this);

            fetch('../action/matchingAction.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to a new page, such as a results display page
                    window.location.href = 'displayResults.html'; // Make sure this points to the correct URL
                } else {
                    alert('No matches found.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error fetching results');
            });
        });
    }

    function startChat(buddyName) {
        document.getElementById('chat-buddy-name').textContent = buddyName;
        document.getElementById('chat-box').style.display = 'block';
    }

    function sendMessage() {
        const chatMessages = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input');
        const message = chatInput.value;
        const receiverID = document.getElementById('receiverID').value; // You need an input to hold this or manage it dynamically

        if (message.trim() === '') return;

        fetch('../action/chatAction.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `message=${encodeURIComponent(message)}&receiverID=${encodeURIComponent(receiverID)}`
        })
        .then(response => response.text())
        .then(text => {
            console.log(text);
            const messageDiv = document.createElement('div');
            messageDiv.textContent = `You: ${message}`;
            chatMessages.appendChild(messageDiv);
            chatInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;
        })
        .catch(error => console.error('Error:', error));
    }


    function addNewStudent(name, major, classes, timeToStudy, stressed, interest, date, yeargroup) {
        existingUsers.push([name, major, classes, timeToStudy, stressed, interest, date, yeargroup]);
    }

            // Example of how to add a new student using AJAX
    function saveNewStudent() {
        const name = prompt("Enter student's name");
        const major = prompt("Enter student's major");
        const classes = prompt("Enter student's classes, separated by commas");
        const timeToStudy = parseFloat(prompt("Enter hours willing to study"));
        const stressed = parseInt(prompt("Enter stress level (0-5)"));
        const interest = prompt("Enter study interest");
        const date = prompt("Enter date");
        const time = prompt("Enter yeargroup");

        fetch('../action/addStudent.php', {
            method: 'POST',
            headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `name=${encodeURIComponent(name)}&major=${encodeURIComponent(major)}&classes=${encodeURIComponent(classes)}&timeToStudy=${timeToStudy}&stressed=${stressed}&interest=${encodeURIComponent(interest)}&date=${date}`
        })
        .then(response => response.text())
        .then(text => console.log(text))
        .catch(error => console.error('Error:', error));
    }


    function joinMeeting() {
        const buddyName = document.getElementById('chat-buddy-name').innerText;
        const name = document.getElementById('name').value;
        if (buddyName && name) {
            const roomName = CryptoJS.SHA256(name + buddyName).toString();
            const meetingUrl = ` https://vidcnf.onrender.com/conference.html?data=${encodeURIComponent(data)}`;
            window.location.href = meetingUrl;
    } else {
            alert('Please find and select a study buddy first.');
        }
    }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
</body>
</html>


