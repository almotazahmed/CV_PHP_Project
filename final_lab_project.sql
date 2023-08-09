-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 09:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_lab_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` char(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number_of_hours` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `institution` varchar(255) NOT NULL,
  `attachment_type` enum('URL','File') NOT NULL,
  `attachment_value` varchar(1000) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `user_id` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `name`, `number_of_hours`, `start_date`, `end_date`, `institution`, `attachment_type`, `attachment_value`, `notes`, `user_id`) VALUES
('37211066', 'php', 24, '2023-04-30', '2023-06-08', 'At Home/Self-Learning', 'File', '../images/attachment.png', 'Code readability is a crucial aspect of software development. Writing clean, well-organized, and easily understandable code offers several benefits. First and foremost, it enhances collaboration among team members. When code is readable, it becomes easier for multiple developers to work on the same project, review each other&#039;s code, and understand the overall logic and functionality. This improves efficiency and reduces the likelihood of introducing bugs or errors during development.', '20201685'),
('94513469', 'C++', 55, '2023-04-30', '2023-05-26', 'At Home/Self-Learning', 'File', '../images/attachment.png', 'Code readability is a crucial aspect of software development. Writing clean, well-organized, and easily understandable code offers several benefits. First and foremost, it enhances collaboration among team members. When code is readable, it becomes easier for multiple developers to work on the same project, review each other&#039;s code, and understand the overall logic and functionality. This improves efficiency and reduces the likelihood of introducing bugs or errors during development.', '20201685');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `experience_id` char(8) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `institution` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` char(8) NOT NULL,
  `number_of_hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`experience_id`, `course_name`, `start_date`, `end_date`, `institution`, `notes`, `user_id`, `number_of_hours`) VALUES
('67230632', 'C#', '2023-05-01', '2023-06-08', 'At Home/Self-Learning', 'Code readability is a crucial aspect of software development. Writing clean, well-organized, and easily understandable code offers several benefits. First and foremost, it enhances collaboration among team members. When code is readable, it becomes easier for multiple developers to work on the same project, review each other&#039;s code, and understand the overall logic and functionality. This improves efficiency and reduces the likelihood of introducing bugs or errors during development.', '20201685', 5),
('78660616', 'php', '2023-05-01', '2023-05-31', 'elzero web school', 'Code readability is a crucial aspect of software development. Writing clean, well-organized, and easily understandable code offers several benefits. First and foremost, it enhances collaboration among team members. When code is readable, it becomes easier for multiple developers to work on the same project, review each other&#039;s code, and understand the overall logic and functionality. This improves efficiency and reduces the likelihood of introducing bugs or errors during development.', '20201685', 7),
('79817914', 'C++', '2023-05-01', '2023-06-01', 'At Home/Self-Learning', 'Code readability is a crucial aspect of software development. Writing clean, well-organized, and easily understandable code offers several benefits. First and foremost, it enhances collaboration among team members. When code is readable, it becomes easier for multiple developers to work on the same project, review each other&#039;s code, and understand the overall logic and functionality. This improves efficiency and reduces the likelihood of introducing bugs or errors during development.', '20201685', 22);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` char(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `date_of_birth` date NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `year_of_experience` int(11) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `profile_picture` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `gender`, `date_of_birth`, `nationality`, `job_title`, `year_of_experience`, `place_of_birth`, `profile_picture`) VALUES
('20201685', 'Al-Motaz Bellah Adel Ahmed', 'Male', '2023-04-13', 'Palestinian', 'Software Engineer', 2, 'Palestine, Gaza', '../Images/personal.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`experience_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
