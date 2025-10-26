-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 08:16 PM
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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` char(1) NOT NULL,
  `explanation` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `explanation`, `created_at`) VALUES
(1, 'What does HTML stand for?', 'Hyperlinks and Text Markup Language', 'Home Tool Markup Language', 'Hyper Text Markup Language', 'Hyper Transfer Markup Language', 'C', 'HTML stands for Hyper Text Markup Language.', '2025-10-20 21:32:51'),
(2, 'Which tag is used to create a hyperlink in HTML?', '<a>', '<link>', '<href>', '<url>', 'A', 'The <a> tag defines a hyperlink.', '2025-10-20 21:32:51'),
(3, 'What does CSS stand for?', 'Creative Style Sheets', 'Cascading Style Sheets', 'Computer Style Sheets', 'Colorful Style Sheets', 'B', 'CSS stands for Cascading Style Sheets.', '2025-10-20 21:32:51'),
(4, 'Inside which HTML element do we put JavaScript code?', '<js>', '<scripting>', '<javascript>', '<script>', 'D', 'The <script> tag is used for JavaScript.', '2025-10-20 21:32:51'),
(5, 'Which property in CSS is used to change the text color?', 'font-color', 'text-color', 'color', 'fgcolor', 'C', 'The color property sets the text color.', '2025-10-20 21:32:51'),
(6, 'Which language runs in a web browser?', 'Java', 'C', 'Python', 'JavaScript', 'D', 'JavaScript runs in browsers.', '2025-10-20 21:32:51'),
(7, 'Which symbol is used for comments in JavaScript?', '//', '#', '/* */', '<!-- -->', 'A', 'Single-line comments use //.', '2025-10-20 21:32:51'),
(8, 'What does PHP stand for?', 'Personal Home Page', 'Private Hypertext Processor', 'PHP: Hypertext Preprocessor', 'Programming Homepage', 'C', 'PHP stands for PHP: Hypertext Preprocessor.', '2025-10-20 21:32:51'),
(9, 'Which MySQL statement is used to extract data from a database?', 'GET', 'OPEN', 'SELECT', 'EXTRACT', 'C', 'SELECT retrieves data from a table.', '2025-10-20 21:32:51'),
(10, 'Which of the following is not a programming language?', 'HTML', 'Python', 'C++', 'Java', 'A', 'HTML is a markup language, not a programming language.', '2025-10-20 21:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `score` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `percentage` decimal(5,2) GENERATED ALWAYS AS (`score` / `total` * 100) STORED,
  `answers` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `username`, `score`, `total`, `answers`, `submitted_at`) VALUES
(1, 'Akinnawo Tomiwa', 6, 10, NULL, '2025-10-21 12:24:41'),
(2, 'SMARTIAN X', 1, 10, NULL, '2025-10-22 11:12:01'),
(3, 'Vera', 6, 10, NULL, '2025-10-23 08:29:49'),
(4, 'Tomiwa', 6, 10, NULL, '2025-10-23 09:36:27'),
(5, 'Tomiwa', 8, 10, NULL, '2025-10-25 11:40:28'),
(7, 'michael praise', 8, 10, NULL, '2025-10-26 18:14:21'),
(8, 'olumide', 6, 10, NULL, '2025-10-26 18:42:24'),
(9, 'SMARTIAN X', 7, 10, NULL, '2025-10-26 18:43:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
