-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 15, 2023 at 03:06 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cios`
--

-- --------------------------------------------------------

--
-- Table structure for table `datetime`
--

CREATE TABLE `datetime` (
  `datetime_id` int(11) NOT NULL,
  `weekday` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `datetime`
--

INSERT INTO `datetime` (`datetime_id`, `weekday`, `time`) VALUES
(1, 'Maandag', '9:00'),
(2, 'Maandag', '11:00'),
(3, 'Maandag', '13:00'),
(4, 'Maandag', '15:00'),
(5, 'Dinsdag', '9:00'),
(6, 'Dinsdag', '11:00'),
(7, 'Dinsdag', '13:00'),
(8, 'Dinsdag', '15:00'),
(9, 'Woensdag', '9:00'),
(10, 'Woensdag', '11:00'),
(11, 'Woensdag', '13:00'),
(12, 'Woensdag', '15:00'),
(13, 'Donderdag', '9:00'),
(14, 'Donderdag', '11:00'),
(15, 'Donderdag', '13:00'),
(16, 'Donderdag', '15:00'),
(17, 'Vrijdag', '9:00'),
(18, 'Vrijdag', '11:00'),
(19, 'Vrijdag', '13:00'),
(20, 'Vrijdag', '15:00');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `role_id`, `email`, `password`) VALUES
(1, 1, 'admin@rijnijssel.nl', '$2y$10$F8rnjC3b0RBdEEPAy1X4au6R6EYthdi6RH9C8Hoe29./F5Zi0ieIS'),
(4, 1, 'burlu@rijnijssel.nl', '$2y$10$bAZpiHiwyCyK3hYLLVQGguRLUmqEfLPq/hloPXM5l9cdaAKtd.Nlu'),
(5, 1, 'woupa@rijnijssel.nl', '$2y$10$f4QVv5B2wGwt2B1hupuln.m2TjxA82lkmmO/GHP1x3LdotCHWyVDu'),
(6, 2, 'piet@rijnijssel.nl', '$2y$10$ocD.LhM83cHWnPHNiQr3EODpSaxBsDLQA3ZUflo1xT.Gk4kMfr1.m'),
(8, 2, 'henk@rijnijssel.nl', '$2y$10$s.lr8ACYZtW82mYSXYCpxerRHlM9MHeAz16kNa6f/MIgGRZ/DiJCy'),
(9, 2, 'eric@rijnijssel.nl', '$2y$10$eJvHLyPDgrllXsbVXjyW9uMbUw3T9JwKWx.4el2OAmNYmhkHOeNt.'),
(10, 2, 'emma@rijnijssel.nl', '$2y$10$QVPSdl/aS33GY1gsVbN9l.JNAx6DRi4m.uBx/3ioAKpVsVIPWGIBK'),
(11, 2, 'bram@rijnijssel.nl', '$2y$10$fiRSDWAhwa8XGgYuxWSvh.OoDKDSJ6brwk16ZIVe7M93UsBfpZeGe'),
(12, 2, 'jaap@rijnijssel.nl', '$2y$10$9I3oOan6s49cdlkXdscwsuVkDAY5NyxNeh4/owP0mjaSUheH1.uA2'),
(13, 2, 'teun@rijnijssel.nl', '$2y$10$GH.NmywrjE4/JXvke6AgB.7RL3/FyOWLrDl9AwoeSbIp6Q8ou6jLa'),
(14, 2, 'Jan@rijnijssel.nl', '$2y$10$ekRQj9ZDNiFhdc1SlzOetO/yFKwR6flt1PrxzMT5doNUtOpwF58Gm'),
(15, 1, 'menno@rijnijssel.nl', '$2y$10$39Gzxzh4vxGCUMRzWM0d9.dtZGsxNPuipEZgO9E9rNU0H68qUOg8K'),
(16, 2, 'pietje@rijnijssel.nl', '$2y$10$LPxh/BjaAJLJNkQbQSiL5.c.Hio40NFdTDnIWoYTIMMVt/qBxefBG');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'teacher'),
(2, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `sport_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `datetime_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `maximum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`sport_id`, `teacher_id`, `datetime_id`, `name`, `description`, `maximum`) VALUES
(1, 6, 2, 'Voetbal', 'Lekker potje voetbal', 4),
(2, 1, 11, 'Basketbal', 'Lebronjames', 20),
(7, 1, 16, 'Bowlen', 'ik wil BOWLEN', 24),
(8, 6, 18, 'Hardlopen', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sport_students`
--

CREATE TABLE `sport_students` (
  `ss_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sport_students`
--

INSERT INTO `sport_students` (`ss_id`, `sport_id`, `student_id`) VALUES
(2, 1, 1),
(3, 1, 3),
(4, 1, 5),
(5, 1, 4),
(6, 2, 7),
(8, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `login_id`, `firstname`, `middlename`, `lastname`) VALUES
(1, 6, 'Piet', '', 'Hein'),
(3, 8, 'Henk', '', 'Janssen'),
(4, 9, 'Eric', '', 'Foreman'),
(5, 10, 'Emma', 'de', 'Ruiter'),
(6, 11, 'Bram', '', 'Krikke'),
(7, 12, 'Jaap', '', 'Bovenkamp'),
(8, 13, 'Teun', 'de', 'Lange'),
(9, 14, 'Jan', '', 'Jansen'),
(10, 16, 'Pietje', 'de', 'Wit');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `login_id`, `firstname`, `middlename`, `lastname`) VALUES
(1, 1, 'Tommy', 'van', 'Wijhe'),
(4, 4, 'Luuk', '', 'Burgers'),
(6, 5, 'Pascal', '', 'Wouters'),
(7, 15, 'Menno', '', 'Butt');

-- --------------------------------------------------------

--
-- Table structure for table `votingdate`
--

CREATE TABLE `votingdate` (
  `votingdate_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `votingdate`
--

INSERT INTO `votingdate` (`votingdate_id`, `start_date`, `end_date`) VALUES
(3, '2023-03-05 00:00:00', '2023-03-19 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datetime`
--
ALTER TABLE `datetime`
  ADD PRIMARY KEY (`datetime_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `FK_login_role_id` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`sport_id`),
  ADD KEY `FK_sports_teacher_id` (`teacher_id`),
  ADD KEY `FK_sports_datetime_id` (`datetime_id`);

--
-- Indexes for table `sport_students`
--
ALTER TABLE `sport_students`
  ADD PRIMARY KEY (`ss_id`),
  ADD KEY `FK_ss_sport_id` (`sport_id`),
  ADD KEY `FK_ss_student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `FK_students_login_id` (`login_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `FK_teachers_login_id` (`login_id`);

--
-- Indexes for table `votingdate`
--
ALTER TABLE `votingdate`
  ADD PRIMARY KEY (`votingdate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datetime`
--
ALTER TABLE `datetime`
  MODIFY `datetime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sport_students`
--
ALTER TABLE `sport_students`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `votingdate`
--
ALTER TABLE `votingdate`
  MODIFY `votingdate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `FK_login_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sports`
--
ALTER TABLE `sports`
  ADD CONSTRAINT `FK_sports_datetime_id` FOREIGN KEY (`datetime_id`) REFERENCES `datetime` (`datetime_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sports_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sport_students`
--
ALTER TABLE `sport_students`
  ADD CONSTRAINT `FK_ss_sport_id` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ss_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK_students_login_id` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `FK_teachers_login_id` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
