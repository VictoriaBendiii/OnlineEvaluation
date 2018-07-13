-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2018 at 08:59 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peerpal`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseCode` varchar(45) NOT NULL,
  `courseName` varchar(240) NOT NULL,
  `courseNo` varchar(240) DEFAULT NULL,
  `schedule` varchar(45) NOT NULL,
  `status` enum('Active','Archived') NOT NULL,
  `courseStatus` enum('First Semester','Second Semester','Short Term') NOT NULL,
  `sy` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseCode`, `courseName`, `courseNo`, `schedule`, `status`, `courseStatus`, `sy`) VALUES
('9358A', 'Web Technologies Lecture', 'IT 324', '3:00 - 4:00 WS', 'Active', 'First Semester', '2017-2018'),
('9358B', 'Web Technologies Laboratory', 'IT 322L', '4:00 - 5:30 TF', 'Active', 'First Semester', '2017-2018'),
('9360', 'Information Assurance and Security', 'IT 324', '8:00 - 9:00 TTHS', 'Active', 'First Semester', '2017-2018'),
('9361', 'Theology', 'TH301', '9:00 - 11:00 TTHS', 'Active', 'First Semester', '2017-2018');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(255) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Block'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `start_date`, `end_date`, `created`, `status`) VALUES
(1, 'This is a special events about web development', '', '2018-02-12 00:00:00', '2018-02-16 00:00:00', '2018-07-13 08:21:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `formID` int(11) NOT NULL,
  `formName` varchar(140) NOT NULL,
  `formDesc` varchar(1000) DEFAULT 'No description available',
  `due` date NOT NULL,
  `path` varchar(240) NOT NULL,
  `expTime` time NOT NULL,
  `type` enum('form1','form2') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`formID`, `formName`, `formDesc`, `due`, `path`, `expTime`, `type`) VALUES
(1, 'Web Technology Peer Eval Prelims', 'This is the peer evaluation form for Web Technology Prelims', '2018-07-04', '9358A-Jam', '21:30:00', 'form1'),
(2, 'Midterms Evaluation Form', 'Please make sure to fill the form properly and honestly.', '2018-07-08', '9358B-Midterms Evaluation Form', '24:00:00', 'form1'),
(3, 'This is a form', 'This is a form', '2018-07-08', '9360-This is a form', '24:00:00', 'form1'),
(4, 'Project Evaluation form', 'Please make sure to follow the guidelines', '2018-07-10', '9358A-Project Evaluation form', '24:00:00', 'form1'),
(5, 'Prelims Evaluation', 'Please fill up accordingly', '2018-08-01', '9361-Prelims Evaluation', '24:00:00', 'form1'),
(6, 'dfdsf', '', '1970-01-01', '-dfdsf', '00:00:00', 'form1'),
(7, 'fdf', '', '1970-01-01', '-fdf', '00:00:00', 'form1');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `groupID` int(11) NOT NULL,
  `groupNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`groupID`, `groupNo`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `group_form`
--

CREATE TABLE `group_form` (
  `groupID` int(11) NOT NULL,
  `courseCodeForm` varchar(45) NOT NULL,
  `formID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_form`
--

INSERT INTO `group_form` (`groupID`, `courseCodeForm`, `formID`) VALUES
(1, '9358A', 1),
(2, '9358A', 1),
(1, '9358B', 2),
(1, '9358A', 4),
(1, '9361', 5);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `resultID` int(11) NOT NULL,
  `score` varchar(1000) DEFAULT NULL,
  `formID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `courseCode` varchar(45) NOT NULL,
  `evaluator` varchar(100) NOT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  `userID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`resultID`, `score`, `formID`, `groupID`, `courseCode`, `evaluator`, `remarks`, `userID`) VALUES
(1, 'Excellent', 2, 1, '9358B', '2160052', NULL, '5'),
(2, 'Fair', 2, 1, '9358B', '2160052', NULL, '6'),
(3, 'Excellent', 2, 1, '9358B', '2160052', NULL, '5'),
(4, 'Fair', 2, 1, '9358B', '2160052', NULL, '6'),
(5, 'Excellent', 2, 1, '9358B', '2160052', NULL, '5'),
(6, 'Fair', 2, 1, '9358B', '2160052', NULL, '6'),
(7, 'Excellent', 2, 1, '9358B', '2160052', NULL, '5'),
(8, 'Fair', 2, 1, '9358B', '2160052', NULL, '6'),
(9, 'Good', 2, 1, '9358B', '2160051', NULL, '6'),
(10, 'Excellent', 2, 1, '9358B', '2160051', NULL, '7'),
(11, 'Good', 2, 1, '9358B', '2160051', NULL, '6'),
(12, 'Excellent', 2, 1, '9358B', '2160051', NULL, '7'),
(13, 'Good', 2, 1, '9358B', '2160051', NULL, '6'),
(14, 'Excellent', 2, 1, '9358B', '2160051', NULL, '7'),
(15, 'Good', 2, 1, '9358B', '2160051', NULL, '6'),
(16, 'Excellent', 2, 1, '9358B', '2160051', NULL, '7'),
(17, '3-3', 5, 1, '9361', '2160051', 'Hard worker', '4'),
(18, '2-2', 5, 1, '9361', '2160316', 'Good at communicating.', '5'),
(19, NULL, 4, 1, '9358A', '2160051', 'She gets the work done very early.', '4'),
(20, NULL, 4, 1, '9358A', '2160051', 'He is very lazy.', '6'),
(21, NULL, 4, 1, '9358A', '2160051', 'She is independent and needs no further instructions.', '7'),
(22, NULL, 4, 1, '9358A', '2160051', 'Yes', '4'),
(23, NULL, 4, 1, '9358A', '2160051', 'No, he says he always experience traffic.', '6'),
(24, NULL, 4, 1, '9358A', '2160051', 'Yes', '7'),
(25, NULL, 4, 1, '9358A', '2160051', 'She is a productive member of the group. She may sometimes need instruction. But overall, she is very productive.', '4'),
(26, NULL, 4, 1, '9358A', '2160051', 'He is lazy. He does not do his assigned task. He is not productive.', '6'),
(27, NULL, 4, 1, '9358A', '2160051', 'She is a good leader. She is very reliable. She is always able to answer queries.', '7'),
(35, NULL, 4, 1, '9358A', '2160316', 'She is reliable.', '5'),
(36, NULL, 4, 1, '9358A', '2160316', 'He is unproductive.', '6'),
(37, NULL, 4, 1, '9358A', '2160316', 'She schedules work efficiently.', '7'),
(38, NULL, 4, 1, '9358A', '2160316', 'Yes', '5'),
(39, NULL, 4, 1, '9358A', '2160316', 'No. He is always stuck in traffic or so he says.', '6'),
(40, NULL, 4, 1, '9358A', '2160316', 'Yes', '7'),
(41, NULL, 4, 1, '9358A', '2160316', 'She is reliable. She is productive. She uses her time well.', '5'),
(42, NULL, 4, 1, '9358A', '2160316', 'He is unreliable. He is dependent. He does not do his own work.', '6'),
(43, NULL, 4, 1, '9358A', '2160316', 'She leads well. She organizes task well. She is a good leader.', '7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `identification` enum('student','teacher') NOT NULL,
  `profilepicture` varchar(45) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `identification`, `profilepicture`) VALUES
(1, '2165500', 'admin', 'Mary', 'Gelidon', 'teacher', 'default.jpg'),
(2, '0000', 'admin', 'test', 'test', 'teacher', 'default.jpg'),
(3, '2163054', '2163054', 'Juan', 'Cruz', 'student', 'default.jpg'),
(4, '2160316', 'password', 'Victoria', 'Buse', 'student', '2160316.jpg'),
(5, '2160051', '2160051', 'Nix', 'Andres', 'student', '2160051.jpg'),
(6, '2156789', '2156789', 'Bennie', 'Santos', 'student', 'default.jpg'),
(7, '2160052', '2160052', 'Erin', 'Villanueva', 'student', 'default.jpg'),
(8, '2160053', '2160053', 'Alfonso', 'Valdez', 'student', 'default.jpg'),
(9, 'teacher', 'teacher', 'Michael', 'Pinto', 'teacher', 'default.jpg'),
(10, '2000600', '12345', 'Michael', 'Pinto', 'student', 'default.jpg'),
(11, '2000600', '123', 'Michael', 'Pinto', 'teacher', 'default.jpg'),
(30, '20006001', '123', 'Michael', 'Pinto', 'teacher', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE `user_course` (
  `id` int(11) NOT NULL,
  `courseCode` varchar(45) NOT NULL,
  `groupID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`id`, `courseCode`, `groupID`) VALUES
(1, '9358A', NULL),
(3, '9358A', 2),
(4, '9358A', 1),
(5, '9358A', 1),
(6, '9358A', 1),
(1, '9360', NULL),
(1, '9358B', NULL),
(7, '9358A', 1),
(5, '9358B', 1),
(6, '9358B', 1),
(7, '9358B', 1),
(4, '9358B', 1),
(9, '9361', NULL),
(4, '9361', 1),
(5, '9361', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseCode`),
  ADD UNIQUE KEY `courseCode_UNIQUE` (`courseCode`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`formID`),
  ADD UNIQUE KEY `formID_UNIQUE` (`formID`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`groupID`),
  ADD UNIQUE KEY `groupID_UNIQUE` (`groupID`);

--
-- Indexes for table `group_form`
--
ALTER TABLE `group_form`
  ADD KEY `groupID_idx` (`groupID`),
  ADD KEY `groupIDForm_idx` (`groupID`),
  ADD KEY `courseCodeForm_idx` (`courseCodeForm`),
  ADD KEY `formID_idx` (`formID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`resultID`),
  ADD KEY `formID_idx` (`formID`),
  ADD KEY `formIDResult_idx` (`formID`),
  ADD KEY `groupIDResult_idx` (`groupID`),
  ADD KEY `courseCodeResult_idx` (`courseCode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_course`
--
ALTER TABLE `user_course`
  ADD KEY `id_idx` (`id`),
  ADD KEY `courseCode_idx` (`courseCode`),
  ADD KEY `groupID_idx` (`groupID`),
  ADD KEY `groupIDUser_idx` (`groupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `formID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `resultID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_form`
--
ALTER TABLE `group_form`
  ADD CONSTRAINT `courseCodeForm` FOREIGN KEY (`courseCodeForm`) REFERENCES `course` (`courseCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `formID` FOREIGN KEY (`formID`) REFERENCES `form` (`formID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `groupID` FOREIGN KEY (`groupID`) REFERENCES `group` (`groupID`) ON UPDATE CASCADE;

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `courseCodeResult` FOREIGN KEY (`courseCode`) REFERENCES `course` (`courseCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `formIDResult` FOREIGN KEY (`formID`) REFERENCES `form` (`formID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `groupIDResult` FOREIGN KEY (`groupID`) REFERENCES `group_form` (`groupID`) ON UPDATE CASCADE;

--
-- Constraints for table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `courseCode` FOREIGN KEY (`courseCode`) REFERENCES `course` (`courseCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `groupIDUser` FOREIGN KEY (`groupID`) REFERENCES `group` (`groupID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
