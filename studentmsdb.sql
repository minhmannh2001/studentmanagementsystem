-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2022 at 05:16 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `Challenges`
--

CREATE TABLE `Challenges` (
  `challenge_id` int(6) UNSIGNED NOT NULL,
  `challenge_title` varchar(100) NOT NULL,
  `challenge_content` blob NOT NULL,
  `challenge_creator_id` int(6) UNSIGNED NOT NULL,
  `challenge_no_participants` int(6) DEFAULT NULL,
  `challenge_creation_date` datetime DEFAULT current_timestamp(),
  `challenge_expiration_date` datetime NOT NULL,
  `challenge_participant_list_id` int(6) UNSIGNED DEFAULT NULL,
  `challenge_description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Challenges`
--

INSERT INTO `Challenges` (`challenge_id`, `challenge_title`, `challenge_content`, `challenge_creator_id`, `challenge_no_participants`, `challenge_creation_date`, `challenge_expiration_date`, `challenge_participant_list_id`, `challenge_description`) VALUES
(1, 'Challenge 1', 0x363261346539373961643439332d646f7261656d6f6e2e646f6378, 26, 0, '2022-06-12 02:14:01', '2022-06-16 00:00:00', 7, 'Đây là một bộ truyện tranh đến từ đất nước Nhật Bản. Truyện kể về một chú mèo máy đến từ tương lai. Bạn có biết đây là bộ truyện nào?'),
(3, 'Challenge 2', 0x363261346561393664643131322d6861727279706f747465722e646f6378, 26, 0, '2022-06-12 02:18:46', '2022-06-25 00:00:00', 9, 'Bộ truyện về thế giới phù thủy nào có nhân vật chính là Harry Potter?');

-- --------------------------------------------------------

--
-- Table structure for table `Classes`
--

CREATE TABLE `Classes` (
  `class_id` int(6) UNSIGNED NOT NULL,
  `class_name` varchar(20) NOT NULL,
  `class_homeroom_teacher_id` int(6) UNSIGNED DEFAULT NULL,
  `class_creation_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Classes`
--

INSERT INTO `Classes` (`class_id`, `class_name`, `class_homeroom_teacher_id`, `class_creation_date`) VALUES
(1, '12A', NULL, '2022-06-06 21:57:32'),
(3, '12E', 1, '2022-06-06 21:57:53'),
(4, '10B', 36, '2022-06-06 21:58:05'),
(5, '10N', 26, '2022-06-06 21:58:10'),
(6, '10A', NULL, '2022-06-06 21:58:16'),
(7, '12B', NULL, '2022-06-06 21:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `Contacts`
--

CREATE TABLE `Contacts` (
  `contact_owner_id` int(6) UNSIGNED DEFAULT NULL,
  `contact_guest_id` int(6) UNSIGNED DEFAULT NULL,
  `contact_id` int(6) UNSIGNED DEFAULT NULL,
  `contact_message` varchar(500) DEFAULT NULL,
  `contact_date` datetime DEFAULT NULL,
  `contact_status` varchar(10) DEFAULT NULL,
  `contact_is_modified` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Contacts`
--

INSERT INTO `Contacts` (`contact_owner_id`, `contact_guest_id`, `contact_id`, `contact_message`, `contact_date`, `contact_status`, `contact_is_modified`) VALUES
(20, 1, 0, 'hi', '2022-06-14 01:23:19', 'seen', NULL),
(20, 1, 1, 'Do you remember me?', '2022-06-14 02:17:25', 'seen', NULL),
(1, 20, 2, 'yes. Nice to meet you.', '2022-06-14 02:28:11', 'seen', NULL),
(20, 1, 3, 'How are you today?', '2022-06-14 02:32:02', 'seen', NULL),
(20, 27, 0, 'hi. can you check my score in the last test?', '2022-06-14 02:36:30', 'waiting', NULL),
(20, 1, 4, 'good morning', '2022-06-14 02:54:37', 'seen', NULL),
(20, 1, 5, 'where are you? why u don\'t reply me?', '2022-06-14 03:08:23', 'seen', NULL),
(1, 20, 6, 'i\'m here', '2022-06-14 03:09:59', 'seen', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Exams`
--

CREATE TABLE `Exams` (
  `exam_id` int(6) UNSIGNED NOT NULL,
  `exam_title` varchar(100) NOT NULL,
  `exam_class` varchar(20) NOT NULL,
  `exam_subject` blob NOT NULL,
  `exam_creator_id` int(6) UNSIGNED NOT NULL,
  `exam_creation_date` datetime DEFAULT current_timestamp(),
  `exam_expiration_date` datetime NOT NULL,
  `exam_participant_list_id` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Exams`
--

INSERT INTO `Exams` (`exam_id`, `exam_title`, `exam_class`, `exam_subject`, `exam_creator_id`, `exam_creation_date`, `exam_expiration_date`, `exam_participant_list_id`) VALUES
(2, 'Test 1 for class 12E', '12E', 0x363261343133306135306238652d746573742e646f6378, 26, '2022-06-11 10:59:06', '2022-06-13 00:00:00', 1),
(3, 'Test 2 for class 12E', '12E', 0x363261343462653962616133392d746573742e646f6378, 26, '2022-06-11 15:01:45', '2022-06-15 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantList`
--

CREATE TABLE `ParticipantList` (
  `list_id` int(6) UNSIGNED DEFAULT NULL,
  `participant_id` int(6) UNSIGNED DEFAULT NULL,
  `participant_score` int(6) UNSIGNED DEFAULT NULL,
  `participant_submit_date` datetime DEFAULT NULL,
  `exam_submission` varchar(255) DEFAULT NULL,
  `challenge_submission` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ParticipantList`
--

INSERT INTO `ParticipantList` (`list_id`, `participant_id`, `participant_score`, `participant_submit_date`, `exam_submission`, `challenge_submission`) VALUES
(0, 1, NULL, NULL, NULL, NULL),
(0, 20, NULL, NULL, NULL, NULL),
(1, 1, 8, '2022-06-11 08:06:01', '62a430c9b0043-mywork.docx', NULL),
(1, 20, 10, '2022-06-11 13:24:06', '62a43506d78fe-mywork.docx', NULL),
(2, 1, NULL, NULL, NULL, NULL),
(2, 20, 10, '2022-06-11 15:12:02', '62a44e5246d1c-mywork.docx', NULL),
(2, 41, NULL, NULL, NULL, NULL),
(3, 1, NULL, NULL, NULL, NULL),
(3, 20, NULL, NULL, NULL, NULL),
(3, 37, NULL, NULL, NULL, NULL),
(3, 41, NULL, NULL, NULL, NULL),
(4, 1, NULL, NULL, NULL, NULL),
(4, 20, NULL, NULL, NULL, NULL),
(4, 37, NULL, NULL, NULL, NULL),
(4, 41, NULL, NULL, NULL, NULL),
(5, 1, NULL, NULL, NULL, NULL),
(5, 20, NULL, NULL, NULL, NULL),
(5, 37, NULL, NULL, NULL, NULL),
(5, 41, NULL, NULL, NULL, NULL),
(6, 1, NULL, NULL, NULL, NULL),
(6, 20, NULL, NULL, NULL, NULL),
(6, 37, NULL, NULL, NULL, NULL),
(6, 41, NULL, NULL, NULL, NULL),
(7, 1, NULL, NULL, NULL, NULL),
(7, 20, NULL, NULL, NULL, NULL),
(7, 37, NULL, NULL, NULL, NULL),
(7, 41, NULL, NULL, NULL, NULL),
(8, 1, NULL, NULL, NULL, NULL),
(8, 20, NULL, NULL, NULL, NULL),
(8, 37, NULL, NULL, NULL, NULL),
(8, 41, NULL, NULL, NULL, NULL),
(9, 1, NULL, NULL, NULL, NULL),
(9, 20, NULL, NULL, NULL, NULL),
(9, 37, NULL, NULL, NULL, NULL),
(9, 41, NULL, NULL, NULL, NULL),
(10, 1, NULL, NULL, NULL, NULL),
(10, 20, NULL, NULL, NULL, NULL),
(10, 37, NULL, NULL, NULL, NULL),
(10, 41, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(6) UNSIGNED NOT NULL,
  `user_firstname` varchar(20) NOT NULL,
  `user_lastname` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone_number` varchar(20) NOT NULL,
  `user_class` varchar(10) DEFAULT NULL,
  `user_gender` varchar(10) DEFAULT NULL,
  `user_date_of_birth` datetime DEFAULT NULL,
  `user_photo` varchar(100) DEFAULT NULL,
  `user_account` varchar(30) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_position` varchar(10) NOT NULL,
  `user_start_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_phone_number`, `user_class`, `user_gender`, `user_date_of_birth`, `user_photo`, `user_account`, `user_password`, `user_position`, `user_start_date`) VALUES
(1, 'Harry', 'Potter', 'student1@gmail.com', '', '12E', '', NULL, '', 'student1', 'f83e69e4170a786e44e3d32a2479cce9', 'Student', '2022-06-04 19:56:53'),
(20, 'Manh', 'Nguyen', 'nguyenminhmannh2001@gmail.com', '', '12E', '', NULL, '62a7845fec41f.jpg', 'minhmannh2001', 'e10adc3949ba59abbe56e057f20f883e', 'Student', '2022-06-05 11:32:45'),
(26, 'Albus', 'Dumbledore', 'teacher1@gmail.com', '', '10N', '', NULL, '', 'teacher1', 'e10adc3949ba59abbe56e057f20f883e', 'Teacher', '2022-06-05 22:15:02'),
(27, 'Severus', 'Snape', 'teacher2@gmail.com', '', '', '', NULL, '', 'teacher2', 'e10adc3949ba59abbe56e057f20f883e', 'Teacher', '2022-06-05 22:15:58'),
(36, 'Sirius', 'Black', 'teacher3@gmail.com', '0941425436', '10B', 'male', '2022-05-30 00:00:00', '629e31626a582.jpg', 'teacher3', 'e10adc3949ba59abbe56e057f20f883e', 'Teacher', '2022-06-06 23:54:58'),
(37, 'Hermione', 'Granger', 'student2@gmail.com', 'Not Set', NULL, NULL, NULL, NULL, 'student2', 'f83e69e4170a786e44e3d32a2479cce9', 'Student', '2022-06-07 02:35:32'),
(41, 'Ron', 'Weasley', 'student4@gmail.com', '', '12E', '', NULL, '', 'student4', 'f83e69e4170a786e44e3d32a2479cce9', 'Student', '2022-06-07 15:52:59'),
(42, 'Lord', 'Voldemort', 'teacher4@gmail.com', 'Not Set', NULL, NULL, NULL, NULL, 'teacher4', 'e10adc3949ba59abbe56e057f20f883e', 'Teacher', '2022-06-07 22:49:30'),
(43, 'Luna', 'Lovegood', 'teacher5@gmail.com', 'Not Set', '12E', NULL, NULL, NULL, 'teacher5', 'e10adc3949ba59abbe56e057f20f883e', 'Teacher', '2022-06-08 00:16:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Challenges`
--
ALTER TABLE `Challenges`
  ADD PRIMARY KEY (`challenge_id`);

--
-- Indexes for table `Classes`
--
ALTER TABLE `Classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `Exams`
--
ALTER TABLE `Exams`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Challenges`
--
ALTER TABLE `Challenges`
  MODIFY `challenge_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Classes`
--
ALTER TABLE `Classes`
  MODIFY `class_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Exams`
--
ALTER TABLE `Exams`
  MODIFY `exam_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
