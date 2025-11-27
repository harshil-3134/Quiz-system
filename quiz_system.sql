-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 07:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'harshil', 'harshil@123', 'admin', '2025-10-22', '2025-10-23'),
(2, 'peter', 'peter@123', 'creator', '2025-10-19', '2025-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `creator` varchar(30) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `creator`, `updated_at`, `created_at`) VALUES
(1, 'coding', 'admin', '2025-10-30', '2025-10-30'),
(3, 'Maths', 'admin', '2025-10-30', '2025-10-30'),
(4, 'Ui Quiz', 'admin', '2025-10-30', '2025-10-30'),
(5, 'devops', 'admin', '2025-10-30', '2025-10-30'),
(6, 'bank exam', 'admin', '2025-10-31', '2025-10-31'),
(7, 'civil engineering', 'harshil', '2025-10-31', '2025-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `mcqs`
--

CREATE TABLE `mcqs` (
  `id` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `a` varchar(200) NOT NULL,
  `b` varchar(200) NOT NULL,
  `c` varchar(200) NOT NULL,
  `d` varchar(200) NOT NULL,
  `correct_ans` varchar(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mcqs`
--

INSERT INTO `mcqs` (`id`, `question`, `a`, `b`, `c`, `d`, `correct_ans`, `admin_id`, `quiz_id`, `category_id`, `updated_at`, `created_at`) VALUES
(1, 'what is react', 'Framework', 'Programming language', 'Library', 'None of above', 'a', 1, 1, 1, '2025-11-03', '2025-11-03'),
(2, 'where it used', 'front end', 'back end', 'both', 'None of above', 'c', 1, 1, 1, '2025-11-03', '2025-11-03'),
(3, 'Which command in Git is used to upload your local commits to a remote repository?', 'git push', 'git pull', 'git add', 'git commit', 'b', 1, 3, 5, '2025-11-04', '2025-11-04'),
(4, 'What is Docker mainly used for?', 'Hosting websites directly', 'Creating and managing virtual machines', 'Packaging applications into containers for consistent environments', 'Monitoring network traffic', 'c', 1, 3, 5, '2025-11-04', '2025-11-04'),
(5, 'In DevOps, what does “Infrastructure as Code (IaC)” mean?', 'Writing code to manage infrastructure automatically', 'Writing infrastructure documentation', 'Deploying code without servers', 'Creating UI using HTML and CSS', 'a', 1, 3, 5, '2025-11-04', '2025-11-04'),
(6, 'Which of the following tools is commonly used for CI/CD (Continuous Integration/Continuous Deployment)?', 'Jenkins', 'Photoshop', 'Visual Studio Code', 'Postman', 'a', 1, 3, 5, '2025-11-04', '2025-11-04'),
(7, 'What is the main goal of DevOps?', 'To separate development and operations teams', 'To automate infrastructure and enable continuous delivery', 'To focus only on testing software', 'To replace developers with automation', 'b', 1, 3, 5, '2025-11-04', '2025-11-04'),
(8, 'Which command in Git is used to upload your local commits to a remote repository?', 'git push', 'git pull', 'git add', 'git commit', 'b', 1, 4, 5, '2025-11-04', '2025-11-04'),
(9, 'Which command in Git is used to upload your local commits to a remote repository?', 'git push', 'git pull', 'git add', 'git commit', 'b', 1, 5, 1, '2025-11-04', '2025-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_records`
--

CREATE TABLE `mcq_records` (
  `id` int(10) NOT NULL,
  `record_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `mcq_id` int(10) NOT NULL,
  `select_answer` varchar(10) NOT NULL,
  `is_correct` int(10) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `category_id` int(10) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `category_id`, `updated_at`, `created_at`) VALUES
(1, 'reactjs', 1, '2025-11-03', '2025-11-03'),
(2, 'reactjs', 1, '2025-11-03', '2025-11-03'),
(3, '5 basic devops quiz', 5, '2025-11-04', '2025-11-04'),
(4, '5 basic devops quiz', 5, '2025-11-04', '2025-11-04'),
(5, '5 basic devops quiz', 1, '2025-11-04', '2025-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `updated_at` date NOT NULL,
  `created_At` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` int(10) DEFAULT 1,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcqs`
--
ALTER TABLE `mcqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_records`
--
ALTER TABLE `mcq_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mcqs`
--
ALTER TABLE `mcqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mcq_records`
--
ALTER TABLE `mcq_records`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
