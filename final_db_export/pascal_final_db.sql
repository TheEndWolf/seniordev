-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2017 at 11:16 PM
-- Server version: 5.5.52-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pascal_final_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `assessment_id` int(11) NOT NULL,
  `date_data_recieved` datetime DEFAULT NULL,
  `course_assessment_item` varchar(45) DEFAULT NULL,
  `expected_percent_achieved` int(11) DEFAULT NULL,
  `percent_students_achieved_obj` int(11) DEFAULT NULL,
  `over_this` int(11) DEFAULT NULL,
  `assessment_notes` varchar(500) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `complete` tinyint(1) DEFAULT '0',
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`assessment_id`, `date_data_recieved`, `course_assessment_item`, `expected_percent_achieved`, `percent_students_achieved_obj`, `over_this`, `assessment_notes`, `deadline`, `complete`, `section_id`) VALUES
(1, NULL, 'Final Exam', 60, 84, 70, NULL, '2017-05-20', 1, 1),
(3, NULL, 'Final Presentation', 60, 69, 85, NULL, '2017-05-20', 1, 2),
(5, NULL, 'Project: Beer Service', 60, 82, 70, NULL, '2017-05-20', 1, 3),
(7, '2017-05-03 00:31:36', 'Final Exam', 75, NULL, 70, NULL, '2017-05-20', 0, 13),
(8, '2017-05-03 17:28:20', 'Final Project', 65, 67, 70, NULL, '2017-05-20', 1, 14),
(9, '2017-05-03 17:47:37', 'Final Exam', 60, 40, 80, NULL, '2017-05-20', 1, 15),
(11, '2017-05-03 21:36:27', 'Marketing Plan', 80, NULL, 75, NULL, '2017-05-20', 0, 16),
(12, '2017-05-03 21:38:18', 'Final Project', 80, NULL, 80, NULL, '2017-05-20', 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(45) DEFAULT NULL,
  `course_number` int(11) DEFAULT NULL,
  `flag` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `course_coOrdinator` int(11) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_number`, `flag`, `course_coOrdinator`, `program_id`) VALUES
(1, 'Intro to DB and Data Modeling', 230, NULL, 7, 1),
(2, 'DB Connectivity and Access', 330, NULL, 2, 1),
(3, 'DB App Development', 432, NULL, 3, 1),
(4, 'DB Management Systems', 320, NULL, 4, 1),
(5, 'Web Server Development and Administration', 444, NULL, 6, 1),
(6, 'Web and Mobile I', 140, NULL, 6, 1),
(7, 'Web and Mobile II', 240, NULL, 5, 1),
(8, 'Client Programming', 340, NULL, 8, 1),
(9, 'Computer Problem Solving Info Domain II', 121, NULL, 8, 1),
(10, 'Intro to Software Engineering', 261, NULL, 10, 1),
(11, 'Global Marketing', 320, NULL, 1, 2),
(12, 'International Marketing', 320, NULL, 2, 2),
(13, 'Management Accounting', 210, NULL, 1, 2),
(14, 'Financial Management', 220, NULL, 4, 2),
(15, 'Cross Cultural Management', 300, NULL, 7, 2),
(16, 'Global Business Environment', 225, NULL, 6, 2),
(17, 'The World of Business', 150, NULL, 7, 2),
(20, 'Wearables and Ubiquitous Computing', 358, NULL, 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `course_Notes`
--

CREATE TABLE `course_Notes` (
  `idcourse_Notes` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `noteWrittenBy` varchar(45) DEFAULT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_Notes`
--

INSERT INTO `course_Notes` (`idcourse_Notes`, `notes`, `noteWrittenBy`, `course_id`) VALUES
(1, 'this is the first comment', 'niksa', 1),
(2, 'this is the secone comment', 'ben', 2),
(3, 'this is the third comment', 'john', 3),
(4, 'this is the fourth comment', 'mario', 4),
(6, 'Wearables are awesome.', NULL, 20);

-- --------------------------------------------------------

--
-- Table structure for table `course_section`
--

CREATE TABLE `course_section` (
  `course_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_section`
--

INSERT INTO `course_section` (`course_id`, `section_id`) VALUES
(1, 1),
(1, 13),
(1, 14),
(2, 2),
(2, 15),
(9, 3),
(10, 4),
(11, 16),
(20, 17);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `grade_id` int(11) NOT NULL,
  `charGrade` char(2) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`grade_id`, `charGrade`, `grade`) VALUES
(1, 'A', 90),
(2, 'B', 80),
(3, 'C', 70),
(4, 'D', 60),
(5, 'F', 59),
(6, 'D', 68),
(7, 'F', 58),
(8, 'D', 68),
(9, 'A', 97),
(10, 'B', 86),
(11, 'C', 75),
(12, 'A', 99),
(13, 'F', 54),
(14, 'D', 65),
(15, 'C', 78),
(16, 'A', 98),
(17, 'B', 85);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `description`, `permission`) VALUES
(1, 'Admin', 666),
(2, 'Coordinator', 644),
(3, 'Professor', 611);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(45) DEFAULT NULL,
  `program_objective` varchar(500) DEFAULT NULL,
  `program_CoOrdinator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program_name`, `program_objective`, `program_CoOrdinator`) VALUES
(1, 'IT', 'To become a IT specialist', 5),
(2, 'IB', 'To become a business manager', 3),
(3, 'WMC', 'To teach Web and Mobile Computing', 12);

-- --------------------------------------------------------

--
-- Table structure for table `program_user`
--

CREATE TABLE `program_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `user_password` char(32) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `userEmail` varchar(45) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_user`
--

INSERT INTO `program_user` (`user_id`, `username`, `user_password`, `first_name`, `last_name`, `userEmail`, `role_id`) VALUES
(1, 'James.Herbermans', 'jamesPass', 'James', 'Herbermans', 'james@gmail.com', 5),
(2, 'Michael.Floeser', 'michaelPass', 'Michael', 'Floeser', 'michael@gmail.com', 3),
(3, 'Lin.Saiwu', 'linPass', 'Lin', 'Saiwu', 'lin@gmail.com', 5),
(4, 'Daniel.Kennedy', 'danielPass', 'Daniel', 'Kennedy', 'daniel@gmail.com', 5),
(5, 'Catherine.Beaton', 'catherinePass', 'Catherine', 'Beaton', 'james@gmail.com', 5),
(6, 'James.Vallino', 'vallinoPass', 'James', 'Vallino', 'james@gmail.com', 5),
(7, 'Peter.Lutz', 'peterPass', 'Peter', 'Lutz', 'peter@gmail.com', 2),
(8, 'Jennifer.Wilson', 'JenniferPass', 'Jennifer', 'Wilson', 'Jennifer@gmail.com', 5),
(10, 'Robert.Barbato', 'robertPass', 'Robert', 'Barbato', 'robert@gmail.com', 1),
(11, 'mxs9224', 'mitchPass', 'Mitchell', 'Steenburgh', 'mitch@gmail.com', 1),
(12, 'Bryan.French', 'bryanPass', 'Bryan', 'French', 'Bryan.French@rit.edu', 4),
(13, 'dgo3015', 'test1234', 'Dave', 'Olejniczak', 'dgo3015@rit.edu', 1),
(14, 'yxg2464', 'pass', 'Yuqing', 'Guo', 'yxg2464@rit.edu', 1),
(15, 'Stephen.Zilora', 'stephenPass', 'Stephen', 'Zilora', 'sjzics@rit.edu', 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(45) DEFAULT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `permission_id`) VALUES
(1, 'Administrator', 1),
(2, 'Course Coordinator', 2),
(3, 'Assessment Coordinator', 2),
(4, 'Program Coordinator', 2),
(5, 'Instructor', 3);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_number` int(11) DEFAULT NULL,
  `term` varchar(45) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_number`, `term`, `notes`, `date_created`, `user_id`) VALUES
(1, 1, '2165', 'Good class', NULL, 1),
(2, 2, '2165', 'Difficult', NULL, 2),
(3, 3, '2155', 'Test comment', NULL, 3),
(4, 4, '2155', 'Should be easier', NULL, 1),
(13, 2, '2165', 'I wrote this.', '2017-05-03 00:31:36', 2),
(14, 3, '2165', 'Mitch is teaching this.', '2017-05-03 17:28:20', 11),
(15, 1, '2165', 'Mitch is also teaching this', '2017-05-03 17:47:37', 11),
(16, 1, '2165', 'Marketing rules.', '2017-05-03 21:36:27', 11),
(17, 1, '2165', 'This course is amazing', '2017-05-03 21:38:18', 12);

-- --------------------------------------------------------

--
-- Table structure for table `section_grade`
--

CREATE TABLE `section_grade` (
  `section_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section_grade`
--

INSERT INTO `section_grade` (`section_id`, `grade_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 5),
(2, 2),
(2, 3),
(2, 5),
(14, 7),
(14, 8),
(14, 9),
(14, 10),
(14, 11),
(14, 12),
(15, 13),
(15, 14),
(15, 15),
(15, 16),
(15, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`assessment_id`,`section_id`),
  ADD KEY `fk_assessment_section1_idx` (`section_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`,`course_coOrdinator`,`program_id`),
  ADD KEY `fk_course_program1_idx` (`program_id`),
  ADD KEY `fk_course_program_user1_idx` (`course_coOrdinator`);

--
-- Indexes for table `course_Notes`
--
ALTER TABLE `course_Notes`
  ADD PRIMARY KEY (`idcourse_Notes`,`course_id`),
  ADD KEY `fk_course_Notes_course1_idx` (`course_id`);

--
-- Indexes for table `course_section`
--
ALTER TABLE `course_section`
  ADD PRIMARY KEY (`course_id`,`section_id`),
  ADD KEY `fk_course_has_section_section1_idx` (`section_id`),
  ADD KEY `fk_course_has_section_course1_idx` (`course_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`,`program_CoOrdinator`),
  ADD KEY `fk_program_program_user1_idx` (`program_CoOrdinator`);

--
-- Indexes for table `program_user`
--
ALTER TABLE `program_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `fk_user_role1_idx` (`role_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `fk_role_permission1_idx` (`permission_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`,`user_id`),
  ADD KEY `fk_section_program_user1_idx` (`user_id`);

--
-- Indexes for table `section_grade`
--
ALTER TABLE `section_grade`
  ADD PRIMARY KEY (`section_id`,`grade_id`),
  ADD KEY `fk_section_has_grade_grade1_idx` (`grade_id`),
  ADD KEY `fk_section_has_grade_section1_idx` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `assessment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `course_Notes`
--
ALTER TABLE `course_Notes`
  MODIFY `idcourse_Notes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `program_user`
--
ALTER TABLE `program_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessment`
--
ALTER TABLE `assessment`
  ADD CONSTRAINT `fk_assessment_section1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_course_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_course_program_user1` FOREIGN KEY (`course_coOrdinator`) REFERENCES `program_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `course_Notes`
--
ALTER TABLE `course_Notes`
  ADD CONSTRAINT `fk_course_Notes_course1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `course_section`
--
ALTER TABLE `course_section`
  ADD CONSTRAINT `fk_course_has_section_course1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_course_has_section_section1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `fk_program_program_user1` FOREIGN KEY (`program_CoOrdinator`) REFERENCES `program_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `program_user`
--
ALTER TABLE `program_user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `fk_role_permission1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `fk_section_program_user1` FOREIGN KEY (`user_id`) REFERENCES `program_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `section_grade`
--
ALTER TABLE `section_grade`
  ADD CONSTRAINT `fk_section_has_grade_section1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_section_has_grade_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`grade_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
