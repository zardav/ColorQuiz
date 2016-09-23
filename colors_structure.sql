-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2016 at 09:25 PM
-- Server version: 5.5.47-0+deb8u1
-- PHP Version: 5.6.19-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `colors`
--

-- --------------------------------------------------------

--
-- Table structure for table `AnswersA`
--

CREATE TABLE `AnswersA` (
  `aid` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `color_a` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `color_b` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `answer` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `AnswersB`
--

CREATE TABLE `AnswersB` (
  `aid` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `globals`
--

CREATE TABLE `globals` (
  `v_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `v_value` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `globals`
--

INSERT INTO `globals` (`v_name`, `v_value`) VALUES
('seed', '0'),
('q2_offset', '0');

-- --------------------------------------------------------

--
-- Table structure for table `QuestionsB`
--

CREATE TABLE `QuestionsB` (
  `qid` int(11) NOT NULL,
  `c1` varchar(6) NOT NULL,
  `c2` varchar(6) NOT NULL,
  `c3` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Sessions`
--

CREATE TABLE `Sessions` (
  `session_id` int(11) NOT NULL,
  `php_session` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AnswersA`
--
ALTER TABLE `AnswersA`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `aid` (`aid`);

--
-- Indexes for table `globals`
--
ALTER TABLE `globals`
  ADD UNIQUE KEY `name` (`v_name`);

--
-- Indexes for table `QuestionsB`
--
ALTER TABLE `QuestionsB`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `Sessions`
--
ALTER TABLE `Sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AnswersA`
--
ALTER TABLE `AnswersA`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47326;
--
-- AUTO_INCREMENT for table `QuestionsB`
--
ALTER TABLE `QuestionsB`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52131;
--
-- AUTO_INCREMENT for table `Sessions`
--
ALTER TABLE `Sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
