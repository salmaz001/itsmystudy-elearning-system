-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2023 at 05:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itsmystudy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exercise`
--

CREATE TABLE `tbl_exercise` (
  `ex_id` int(15) NOT NULL,
  `ex_name` varchar(255) NOT NULL,
  `ex_desc` text DEFAULT NULL,
  `ex_noQuest` int(15) NOT NULL,
  `tch_id` varchar(15) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1-active, 0 - deleted',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ex_opt`
--

CREATE TABLE `tbl_ex_opt` (
  `opt_id` int(15) NOT NULL,
  `options` tinytext NOT NULL,
  `ques_id` int(15) NOT NULL,
  `ex_id` int(15) NOT NULL,
  `correct_ans` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ex_ques`
--

CREATE TABLE `tbl_ex_ques` (
  `ques_id` int(15) NOT NULL,
  `ques` text NOT NULL,
  `ex_id` int(11) NOT NULL,
  `image` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL,
  `test_id` int(15) NOT NULL,
  `stud_test_id` int(11) NOT NULL,
  `stud_review` text DEFAULT NULL,
  `tch_review` text DEFAULT NULL,
  `tch_id` varchar(15) DEFAULT NULL,
  `stud_id` varchar(15) NOT NULL,
  `stud_dateAdded` datetime DEFAULT NULL,
  `tch_dateAdded` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material`
--

CREATE TABLE `tbl_material` (
  `sm_id` int(11) NOT NULL,
  `sm_tchId` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sm_chapter` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sm_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sm_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sm_fileLoc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1-active, 0 - deleted',
  `sm_dateUpdated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_options`
--

CREATE TABLE `tbl_options` (
  `opt_id` int(15) NOT NULL,
  `options` tinytext NOT NULL,
  `ques_id` int(15) NOT NULL,
  `test_id` int(15) NOT NULL,
  `correct_ans` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_reset`
--

CREATE TABLE `tbl_password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ques`
--

CREATE TABLE `tbl_ques` (
  `ques_id` int(15) NOT NULL,
  `ques` text NOT NULL,
  `test_id` int(11) NOT NULL,
  `image` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `ic_no` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `tch_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `user_id`, `ic_no`, `dob`, `age`, `gender`, `tch_id`) VALUES
(10, 'IMS23ST98204', '9811199902920', '1997-10-09', 26, 'male', 'IMS23TC51341');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stud_material`
--

CREATE TABLE `tbl_stud_material` (
  `id` int(15) NOT NULL,
  `material_id` int(15) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `stud_id` varchar(15) NOT NULL,
  `tch_id` varchar(15) NOT NULL,
  `dateEnrolled` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stud_test`
--

CREATE TABLE `tbl_stud_test` (
  `id` int(11) NOT NULL,
  `test_id` int(15) NOT NULL,
  `stud_id` varchar(15) NOT NULL,
  `tch_id` varchar(15) NOT NULL,
  `marks` int(11) NOT NULL,
  `totCorrectAns` int(11) NOT NULL,
  `feedback_done` int(11) NOT NULL DEFAULT 0 COMMENT '0 - not yet, 1 - done',
  `dateTaken` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teachers`
--

CREATE TABLE `tbl_teachers` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `ic_no` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_teachers`
--

INSERT INTO `tbl_teachers` (`id`, `user_id`, `ic_no`, `dob`, `age`, `gender`) VALUES
(2, 'IMS23TC51341', '931010101922', '1993-03-08', 30, 'female'),
(3, 'IMS23TC54326', '8710100810299', '1987-10-10', 36, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE `tbl_test` (
  `test_id` int(15) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `test_desc` text DEFAULT NULL,
  `test_noQuest` int(15) NOT NULL,
  `tch_id` varchar(15) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1-active, 0 - deleted',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topic`
--

CREATE TABLE `tbl_topic` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_topic`
--

INSERT INTO `tbl_topic` (`id`, `topic`) VALUES
(1, 'Algebraic Expressions and Equations'),
(2, 'Functions and Their Properties'),
(3, 'Sequences and Series'),
(4, 'Trigonometry'),
(5, 'Analytic Geometry'),
(6, 'Geometry'),
(7, 'Mathematical Reasoning and Proof'),
(8, 'Calculus'),
(9, 'Probability and Statistics'),
(10, 'Mathematical Modeling and Optimization');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `u_recid` int(11) NOT NULL COMMENT 'Record ID - Autoincrement',
  `u_id` varchar(15) NOT NULL COMMENT 'User ID - Program Generate',
  `u_type` char(1) NOT NULL COMMENT 'User Role : 1 - ADMIN    2 - Teacher    3 - Student   ',
  `u_fullname` varchar(200) NOT NULL COMMENT 'User Fullname',
  `u_email` varchar(100) NOT NULL COMMENT 'User Email ',
  `u_pwd` tinytext NOT NULL COMMENT 'User Password',
  `u_hash` varchar(255) NOT NULL,
  `u_mobileNo` varchar(15) NOT NULL COMMENT 'User Mobile Tel. No.',
  `u_status` char(1) NOT NULL COMMENT 'Record Status : A - Active   N - Inactive   X - Deleted',
  `u_createdAt` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Date Record created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`u_recid`, `u_id`, `u_type`, `u_fullname`, `u_email`, `u_pwd`, `u_hash`, `u_mobileNo`, `u_status`, `u_createdAt`) VALUES
(2, 'adm0001', '1', 'Admin', 'admin@gmail.com', '78f40b794551da68bba3b5e38d365e531fcf1df9deba959ddc389c4550bdb84f', '2f94e0531884ce6426e7422422848693', '0190091122', 'A', '2023-04-20 01:05:07'),
(10, 'IMS23TC51341', '2', 'Marissa Ong', 'marissa@gmail.com', '72da53d1d5c8b85dd796979e39c420ce755072ed8d301f18634c785f62789e3f', '520bde329264c56b530baf84e2f34de0', '01112332422', 'A', '2023-04-27 07:16:04'),
(11, 'IMS23TC54326', '2', 'Aliya Humaira', 'aliya@gmail.com', 'd74eb35b17cfdc4168ce8e11f75bd41af35f2d01a9f6caccb68c086db967d866', 'b93ee817fc5b76dc800bd2c8cca22151', '0198898899', 'A', '2023-04-27 07:25:03'),
(18, 'IMS23ST98204', '3', 'adam mark', 'adam@gmail.com', '0ee45cfa3afe0bff84f0a059605eb20ad12673788d162eb6214369d59810c5a2', 'b9ac996c30127440e66580888f94be31', '0111223049', 'A', '2023-06-11 20:57:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_exercise`
--
ALTER TABLE `tbl_exercise`
  ADD PRIMARY KEY (`ex_id`),
  ADD KEY `tch_id` (`tch_id`);

--
-- Indexes for table `tbl_ex_opt`
--
ALTER TABLE `tbl_ex_opt`
  ADD PRIMARY KEY (`opt_id`),
  ADD KEY `ques_id` (`ques_id`),
  ADD KEY `ex_id_FK` (`ex_id`);

--
-- Indexes for table `tbl_ex_ques`
--
ALTER TABLE `tbl_ex_ques`
  ADD PRIMARY KEY (`ques_id`),
  ADD KEY `ex_id` (`ex_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_fbStudID` (`stud_id`),
  ADD KEY `FK_fbSTchID` (`tch_id`),
  ADD KEY `FK_fbTestId` (`test_id`),
  ADD KEY `FK_stud_test_id` (`stud_test_id`);

--
-- Indexes for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`sm_id`),
  ADD KEY `fk_tchId` (`sm_tchId`);

--
-- Indexes for table `tbl_options`
--
ALTER TABLE `tbl_options`
  ADD PRIMARY KEY (`opt_id`),
  ADD KEY `ques_id` (`ques_id`),
  ADD KEY `test_id_FK` (`test_id`);

--
-- Indexes for table `tbl_password_reset`
--
ALTER TABLE `tbl_password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ques`
--
ALTER TABLE `tbl_ques`
  ADD PRIMARY KEY (`ques_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `FK_teacherId` (`tch_id`);

--
-- Indexes for table `tbl_stud_material`
--
ALTER TABLE `tbl_stud_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stud_id` (`stud_id`),
  ADD KEY `fk_tch_id` (`tch_id`),
  ADD KEY `fk_material_id` (`material_id`),
  ADD KEY `FK_topic_stud_material` (`topic_id`);

--
-- Indexes for table `tbl_stud_test`
--
ALTER TABLE `tbl_stud_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_stStudId` (`stud_id`),
  ADD KEY `FK_stTchId` (`tch_id`),
  ADD KEY `FK_stTestId` (`test_id`);

--
-- Indexes for table `tbl_teachers`
--
ALTER TABLE `tbl_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `tch_id` (`tch_id`);

--
-- Indexes for table `tbl_topic`
--
ALTER TABLE `tbl_topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`u_recid`) USING BTREE,
  ADD UNIQUE KEY `ndx_email` (`u_email`) USING BTREE,
  ADD UNIQUE KEY `ndx_userId` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_exercise`
--
ALTER TABLE `tbl_exercise`
  MODIFY `ex_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ex_opt`
--
ALTER TABLE `tbl_ex_opt`
  MODIFY `opt_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ex_ques`
--
ALTER TABLE `tbl_ex_ques`
  MODIFY `ques_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_options`
--
ALTER TABLE `tbl_options`
  MODIFY `opt_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_password_reset`
--
ALTER TABLE `tbl_password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ques`
--
ALTER TABLE `tbl_ques`
  MODIFY `ques_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_stud_material`
--
ALTER TABLE `tbl_stud_material`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_stud_test`
--
ALTER TABLE `tbl_stud_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_teachers`
--
ALTER TABLE `tbl_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_test`
--
ALTER TABLE `tbl_test`
  MODIFY `test_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_topic`
--
ALTER TABLE `tbl_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `u_recid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Record ID - Autoincrement', AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ex_ques`
--
ALTER TABLE `tbl_ex_ques`
  ADD CONSTRAINT `ex_id` FOREIGN KEY (`ex_id`) REFERENCES `tbl_exercise` (`ex_id`);

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `FK_fbSTchID` FOREIGN KEY (`tch_id`) REFERENCES `tbl_users` (`u_id`),
  ADD CONSTRAINT `FK_fbStudID` FOREIGN KEY (`stud_id`) REFERENCES `tbl_users` (`u_id`),
  ADD CONSTRAINT `FK_fbTestId` FOREIGN KEY (`test_id`) REFERENCES `tbl_test` (`test_id`),
  ADD CONSTRAINT `FK_stud_test_id` FOREIGN KEY (`stud_test_id`) REFERENCES `tbl_stud_test` (`id`);

--
-- Constraints for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD CONSTRAINT `fk_tchId` FOREIGN KEY (`sm_tchId`) REFERENCES `tbl_users` (`u_id`);

--
-- Constraints for table `tbl_options`
--
ALTER TABLE `tbl_options`
  ADD CONSTRAINT `ques_id` FOREIGN KEY (`ques_id`) REFERENCES `tbl_ques` (`ques_id`),
  ADD CONSTRAINT `test_id_FK` FOREIGN KEY (`test_id`) REFERENCES `tbl_test` (`test_id`);

--
-- Constraints for table `tbl_ques`
--
ALTER TABLE `tbl_ques`
  ADD CONSTRAINT `test_id` FOREIGN KEY (`test_id`) REFERENCES `tbl_test` (`test_id`);

--
-- Constraints for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD CONSTRAINT `FK_teacherId` FOREIGN KEY (`tch_id`) REFERENCES `tbl_users` (`u_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`u_id`);

--
-- Constraints for table `tbl_stud_material`
--
ALTER TABLE `tbl_stud_material`
  ADD CONSTRAINT `FK_topic_stud_material` FOREIGN KEY (`topic_id`) REFERENCES `tbl_topic` (`id`),
  ADD CONSTRAINT `fk_material_id` FOREIGN KEY (`material_id`) REFERENCES `tbl_material` (`sm_id`),
  ADD CONSTRAINT `fk_stud_id` FOREIGN KEY (`stud_id`) REFERENCES `tbl_users` (`u_id`),
  ADD CONSTRAINT `fk_tch_id` FOREIGN KEY (`tch_id`) REFERENCES `tbl_users` (`u_id`);

--
-- Constraints for table `tbl_stud_test`
--
ALTER TABLE `tbl_stud_test`
  ADD CONSTRAINT `FK_stStudId` FOREIGN KEY (`stud_id`) REFERENCES `tbl_users` (`u_id`),
  ADD CONSTRAINT `FK_stTchId` FOREIGN KEY (`tch_id`) REFERENCES `tbl_users` (`u_id`),
  ADD CONSTRAINT `FK_stTestId` FOREIGN KEY (`test_id`) REFERENCES `tbl_test` (`test_id`);

--
-- Constraints for table `tbl_teachers`
--
ALTER TABLE `tbl_teachers`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`u_id`);

--
-- Constraints for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD CONSTRAINT `tch_id` FOREIGN KEY (`tch_id`) REFERENCES `tbl_users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
