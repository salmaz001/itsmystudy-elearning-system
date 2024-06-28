-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2023 at 05:48 PM
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

--
-- Dumping data for table `tbl_exercise`
--

INSERT INTO `tbl_exercise` (`ex_id`, `ex_name`, `ex_desc`, `ex_noQuest`, `tch_id`, `status`, `created_at`) VALUES
(14, 'jjj', 'jjj', 3, 'IMS23TC51341', 1, '2023-06-13 02:28:52'),
(15, 'exercise 1', 'no desc', 3, 'IMS23TC54326', 1, '2023-06-13 02:58:07');

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

--
-- Dumping data for table `tbl_ex_opt`
--

INSERT INTO `tbl_ex_opt` (`opt_id`, `options`, `ques_id`, `ex_id`, `correct_ans`) VALUES
(90, 'a', 31, 14, 1),
(91, 'b', 31, 14, 0),
(92, 'c', 31, 14, 0),
(93, 'b', 32, 14, 0),
(94, 'she', 32, 14, 1),
(95, 'he', 32, 14, 0),
(96, 'no', 33, 14, 0),
(97, '7 colours', 33, 14, 1),
(98, 'one', 33, 14, 0),
(99, 'blue', 34, 15, 0),
(100, 'blue', 34, 15, 0),
(101, 'a', 34, 15, 1),
(102, '1', 35, 15, 1),
(103, '2', 35, 15, 0),
(104, '3', 35, 15, 0),
(105, 'h', 36, 15, 1),
(106, 'b', 36, 15, 0),
(107, 'c', 36, 15, 0);

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

--
-- Dumping data for table `tbl_ex_ques`
--

INSERT INTO `tbl_ex_ques` (`ques_id`, `ques`, `ex_id`, `image`) VALUES
(31, 'one', 14, 'files/ex_ques/43407_Screenshot 2023-06-13 at 1.56.28 AM.png'),
(32, 'hello is who', 14, 'files/ex_ques/77432_kaen-co-9566-5737592-5.jpg'),
(33, 'rainbow colour', 14, '-'),
(34, 'whats colour is sky', 15, 'files/ex_ques/44780_download.jpeg'),
(35, 'one', 15, '-'),
(36, 'hello', 15, '-');

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

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id`, `test_id`, `stud_test_id`, `stud_review`, `tch_review`, `tch_id`, `stud_id`, `stud_dateAdded`, `tch_dateAdded`) VALUES
(1, 13, 1, 'asda', 'asdsa aaa', 'IMS23TC51341', 'IMS23ST98204', '2023-06-14 20:16:22', '2023-06-14 21:27:03'),
(2, 13, 4, 'nothing, everything good', 'okay nice', 'IMS23TC51341', 'IMS23ST98204', '2023-06-16 15:48:07', '2023-06-16 15:52:36'),
(3, 11, 5, 'asda ', NULL, NULL, 'IMS23ST98204', '2023-06-16 23:44:44', NULL);

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

--
-- Dumping data for table `tbl_material`
--

INSERT INTO `tbl_material` (`sm_id`, `sm_tchId`, `sm_chapter`, `sm_title`, `sm_desc`, `sm_fileLoc`, `status`, `sm_dateUpdated`) VALUES
(1, 'IMS23TC51341', '1', 'qdqdq asdasd', 'dqdqdq cccd', 'files/Korean Folk Tales.pdf', 1, '2023-05-07 21:58:13'),
(5, 'IMS23TC51341', '1', 'chapter 1 asa adas', 'trying  asdsada', 'files/99972_News In Korean.pdf', 1, '2023-06-16 22:26:37'),
(6, 'IMS23TC51341', '1', ' aas 111 hello 11', 'helo kaka', 'files/99972_News In Korean.pdf', 1, '2023-06-16 22:24:59'),
(7, 'IMS23TC54326', '1', 'try try jee', 'hello', 'files/59015_promocodes.sql', 1, '2023-06-11 21:10:31'),
(8, 'IMS23TC51341', '1', 'try try try', 'sdkana dasknda', 'files/83155_Parenting Phrases In Korean.pdf', 0, '2023-06-11 22:05:54'),
(9, 'IMS23TC54326', '3', 'Sequence 1', 'description', 'files/99972_News In Korean.pdf', 1, '2023-06-16 15:39:21');

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

--
-- Dumping data for table `tbl_options`
--

INSERT INTO `tbl_options` (`opt_id`, `options`, `ques_id`, `test_id`, `correct_ans`) VALUES
(66, 'blue', 23, 11, 1),
(67, 'white', 23, 11, 0),
(68, 'black', 23, 11, 0),
(69, 'male', 24, 11, 1),
(70, 'female', 24, 11, 0),
(71, 'unknown', 24, 11, 0),
(72, 'meow', 25, 11, 1),
(73, 'bbekk', 25, 11, 0),
(74, 'rawrr', 25, 11, 0),
(75, 'mac', 26, 11, 1),
(76, 'samsung', 26, 11, 0),
(77, 'android', 26, 11, 0),
(78, 'yes', 27, 11, 0),
(79, 'no ', 27, 11, 0),
(80, 'not sure', 27, 11, 1),
(81, 'blue', 28, 13, 0),
(82, 'red', 28, 13, 1),
(83, 'black', 28, 13, 0),
(84, 'hello', 29, 13, 1),
(85, 'h', 29, 13, 0),
(86, 'b', 29, 13, 0),
(87, 'h', 30, 13, 1),
(88, 'a', 30, 13, 0),
(89, 'b', 30, 13, 0);

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

--
-- Dumping data for table `tbl_password_reset`
--

INSERT INTO `tbl_password_reset` (`id`, `email`, `key`, `expDate`) VALUES
(1, 'hello@gmail.com', '2282bbdcbaf9cada2aceb28aac9df5a1355b4970af3f7326c68405390e11fe30', '2023-05-02 22:24:26');

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

--
-- Dumping data for table `tbl_ques`
--

INSERT INTO `tbl_ques` (`ques_id`, `ques`, `test_id`, `image`) VALUES
(23, 'whats colour is sky', 11, 'files/ques/51047_tick.png'),
(24, 'who is ahmad', 11, '-'),
(25, 'how cat sound?', 11, 'files/ques/70079_profile-female.png'),
(26, 'which one is from Apple', 11, '-'),
(27, 'do you like coffee', 11, 'files/ques/23072_profile.png'),
(28, 'whats colour is sky', 13, '-'),
(29, 'dada', 13, 'files/ques/57858_profile.png'),
(30, 'helloo', 13, '-');

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
(10, 'IMS23ST98204', '9811199902920', '1997-10-09', 26, 'male', 'IMS23TC51341'),
(11, 'IMS23ST24943', '9811199902929', '1999-01-01', 24, 'female', 'IMS23TC54326'),
(12, 'IMS23ST76290', '991010102233', '1999-10-10', 24, 'female', 'IMS23TC51341'),
(13, 'IMS23ST29720', '9811199902929', '1998-11-19', 25, 'male', 'IMS23TC54326');

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

--
-- Dumping data for table `tbl_stud_material`
--

INSERT INTO `tbl_stud_material` (`id`, `material_id`, `topic_id`, `stud_id`, `tch_id`, `dateEnrolled`) VALUES
(7, 6, 1, 'IMS23ST98204', 'IMS23TC51341', '2023-06-12'),
(8, 8, 1, 'IMS23ST98204', 'IMS23TC51341', '2023-06-16'),
(9, 1, 1, 'IMS23ST98204', 'IMS23TC51341', '2023-06-16'),
(10, 5, 1, 'IMS23ST98204', 'IMS23TC51341', '2023-06-16');

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

--
-- Dumping data for table `tbl_stud_test`
--

INSERT INTO `tbl_stud_test` (`id`, `test_id`, `stud_id`, `tch_id`, `marks`, `totCorrectAns`, `feedback_done`, `dateTaken`) VALUES
(1, 13, 'IMS23ST98204', 'IMS23TC51341', 0, 0, 1, '2023-04-05 19:50:43'),
(2, 13, 'IMS23TC51341', 'IMS23TC51341', 67, 2, 0, '2023-06-14 20:44:00'),
(3, 13, 'IMS23ST98204', 'IMS23TC51341', 67, 2, 0, '2023-06-14 20:44:15'),
(4, 13, 'IMS23ST98204', 'IMS23TC51341', 34, 1, 1, '2023-06-16 15:47:49'),
(5, 11, 'IMS23ST98204', 'IMS23TC51341', 40, 2, 1, '2023-06-16 23:44:11');

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
(3, 'IMS23TC54326', '8710100810299', '1987-10-10', 36, 'female'),
(7, 'IMS23TC90408', '991010102233', '2023-06-08', 0, 'female');

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

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`test_id`, `test_name`, `test_desc`, `test_noQuest`, `tch_id`, `status`, `created_at`) VALUES
(11, 'test 1', 'try try', 5, 'IMS23TC51341', 1, '2023-05-21 00:46:22'),
(13, 'test 1', 'test 1 name', 3, 'IMS23TC51341', 1, '2023-05-22 21:23:09');

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
(1, '123', '3', 'Adam Mark', 'hello@gmail.com', '6b67fc1931c784d76150c257830c20330c01b0f32eab5cb8600738f5ba16e121', 'fc8d07645196f5e09661d188113628bb', '0119191911', 'A', '2023-04-01 14:08:56'),
(2, 'adm0001', '1', 'Admin', 'admin@gmail.com', '78f40b794551da68bba3b5e38d365e531fcf1df9deba959ddc389c4550bdb84f', '2f94e0531884ce6426e7422422848693', '0190091122', 'A', '2023-04-20 01:05:07'),
(10, 'IMS23TC51341', '2', 'Marissa Ong', 'marissa@gmail.com', '72da53d1d5c8b85dd796979e39c420ce755072ed8d301f18634c785f62789e3f', '520bde329264c56b530baf84e2f34de0', '01112332422', 'A', '2023-04-27 07:16:04'),
(11, 'IMS23TC54326', '2', 'Aliya Humaira', 'aliya@gmail.com', 'd74eb35b17cfdc4168ce8e11f75bd41af35f2d01a9f6caccb68c086db967d866', 'b93ee817fc5b76dc800bd2c8cca22151', '0198898899', 'A', '2023-04-27 07:25:03'),
(18, 'IMS23ST98204', '3', 'adam mark', 'adam@gmail.com', '0ee45cfa3afe0bff84f0a059605eb20ad12673788d162eb6214369d59810c5a2', 'b9ac996c30127440e66580888f94be31', '0111223049', 'A', '2023-06-11 20:57:08'),
(19, 'IMS23ST24943', '3', 'Aishah Sumayyah', 'aishah@gmail.com', '410a01a6bc375e95ec6fbd3a0ee2240c6f52bb78e2c2a9fbce4240d818cc1fa9', '1706b31fda44f859b117b40de96183dd', '0198897788', 'A', '2023-06-11 21:05:23'),
(20, 'IMS23ST76290', '3', 'Irdina Walina', 'irdina@gmail.com', '7dda2321b76dd79c758090f256ba3a8d55149cb7cf435ac55ae63e668beec687', '42bc235a2c0969bcab86fa6f919b0a4c', '0190092211', 'A', '2023-06-12 23:03:41'),
(21, 'IMS23ST29720', '3', 'Yuri', 'yuri@gmail.com', '331aedca6daab996865b0760c10a41acfcb95d5a76199b1dfc987c00788ade55', '32c752f7fe39848c90599499bde62f22', '0192221122', 'X', '2023-06-16 15:36:10'),
(22, 'IMS23TC90408', '2', 'try try ', 'try@gmail.com', '9f711b16b27d04edafd76a9bc26e1fc0f711d21d17a8804c112d44437f5e7c9d', '8c884e5ab176dc84af26154ab40756d3', '0111223049', 'X', '2023-06-16 21:58:08');

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
  MODIFY `ex_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_ex_opt`
--
ALTER TABLE `tbl_ex_opt`
  MODIFY `opt_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_ex_ques`
--
ALTER TABLE `tbl_ex_ques`
  MODIFY `ques_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_options`
--
ALTER TABLE `tbl_options`
  MODIFY `opt_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `tbl_password_reset`
--
ALTER TABLE `tbl_password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_ques`
--
ALTER TABLE `tbl_ques`
  MODIFY `ques_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_stud_material`
--
ALTER TABLE `tbl_stud_material`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_stud_test`
--
ALTER TABLE `tbl_stud_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_teachers`
--
ALTER TABLE `tbl_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_test`
--
ALTER TABLE `tbl_test`
  MODIFY `test_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
