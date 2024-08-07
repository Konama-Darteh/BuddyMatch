-- Database: `khapdb`

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` INT(11) NOT NULL AUTO_INCREMENT,
  `roleName` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`) VALUES
(1, 'Admin'),
(2, 'Student'),
(3, 'Peer Tutor'),
(4, 'Faculty Intern');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `major` VARCHAR(17) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `roleID` INT(11) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`userID`),
  FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`name`, `email`, `major`, `password`, `roleID`) VALUES
('Alice Smith', 'alice@example.com', 'Computer Science', 'hashed_password1', 2),
('Bob Johnson', 'bob@example.com', 'Information Systems', 'hashed_password2', 2),
('Charlie Brown', 'charlie@example.com', 'Mechanical Engineering', 'hashed_password3', 2),
('Diana Ross', 'diana@example.com', 'Business Analytics', 'hashed_password4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userProfiles`
--

CREATE TABLE `userProfiles` (
  `profileID` INT(11) NOT NULL AUTO_INCREMENT,
  `userID` INT(11) NOT NULL,
  `major` VARCHAR(255) NOT NULL,
  `profilePicture` BLOB,
  `gradYear` ENUM('2024', '2025', '2026', '2027') NOT NULL,
  `studyHabits` TEXT,
  `interests` TEXT,
  `timeToStudy` DECIMAL(3,1) NOT NULL,
  `stressLevel` TINYINT NOT NULL,
  `availableDate` DATE NOT NULL,
  PRIMARY KEY (`profileID`),
  FOREIGN KEY (`userID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseID` VARCHAR(10) NOT NULL,
  `courseName` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `courseName`) VALUES
('CS101', 'Python'),
('CS102', 'OOP'),
('CS201', 'Data Structures'),
('CS202', 'Algorithms'),
('CS301', 'WebTech'),
('CS302', 'Research Methods'),
('CS311', 'Hardware'),
('CS321', 'COA'),
('CS331', 'Software Engineering'),
('CS341', 'Intro to AI'),
('MATH101', 'Precalculus 1'),
('MATH102', 'Precalculus 2'),
('MATH201', 'Calculus 1'),
('MATH202', 'Calculus 2'),
('MATH210', 'Applied Calculus'),
('MATH220', 'Engineering Calculus');

-- --------------------------------------------------------

--
-- Table structure for table `usercourses`
--

CREATE TABLE `usercourses` (
  `userCourseID` INT(11) NOT NULL AUTO_INCREMENT,
  `userID` INT(11) NOT NULL,
  `courseID` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`userCourseID`),
  FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `matchID` INT(11) NOT NULL AUTO_INCREMENT,
  `userOneID` INT(11) NOT NULL,
  `userTwoID` INT(11) NOT NULL,
  `status` ENUM('Pending', 'Accepted', 'Rejected') NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`matchID`),
  FOREIGN KEY (`userOneID`) REFERENCES `users` (`userID`),
  FOREIGN KEY (`userTwoID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conferences`
--

CREATE TABLE `conferences` (
  `conferenceID` INT(11) NOT NULL AUTO_INCREMENT,
  `userOneID` INT(11) NOT NULL,
  `userTwoID` INT(11) NOT NULL,
  `startTime` DATETIME NOT NULL,
  `endTime` DATETIME DEFAULT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`conferenceID`),
  FOREIGN KEY (`userOneID`) REFERENCES `users` (`userID`),
  FOREIGN KEY (`userTwoID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` INT(11) NOT NULL AUTO_INCREMENT,
  `senderID` INT(11) NOT NULL,
  `receiverID` INT(11) NOT NULL,
  `message` TEXT NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`messageID`),
  FOREIGN KEY (`senderID`) REFERENCES `users` (`userID`),
  FOREIGN KEY (`receiverID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `ratingID` INT(11) NOT NULL AUTO_INCREMENT,
  `raterID` INT(11) NOT NULL,
  `rateeID` INT(11) NOT NULL,
  `ratingVal` DECIMAL(2,1) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`ratingID`),
  FOREIGN KEY (`raterID`) REFERENCES `users` (`userID`),
  FOREIGN KEY (`rateeID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- User data insertion
--

-- Link users to courses (usercourses)
INSERT INTO `usercourses` (`userID`, `courseID`) VALUES
(1, 'CS101'), -- Alice takes Python
(1, 'CS201'), -- Alice also takes Data Structures
(2, 'CS102'), -- Bob takes OOP
(2, 'MATH101'), -- Bob also takes Precalculus 1
(3, 'CS301'), -- Charlie takes WebTech
(4, 'CS341'); -- Diana takes Intro to AI

COMMIT;
