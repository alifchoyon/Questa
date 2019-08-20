-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2018 at 09:34 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `name` varchar(100) NOT NULL,
  `about` varchar(512) NOT NULL,
  `type` varchar(100) NOT NULL,
  `views` int(11) NOT NULL,
  `creationDate` datetime NOT NULL,
  `tid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`name`, `about`, `type`, `views`, `creationDate`, `tid`) VALUES
('aa', 'aa', 'aa', 0, '2018-09-11 00:00:00', 29),
('Another test', ' lol', 'Technology', 0, '2018-09-27 10:41:50', 29),
('asdas', ' asdasd', 'Technology', 0, '2018-09-27 10:42:52', 29),
('ff', ' ff', 'Technology', 0, '2018-09-26 12:45:07', 29),
('GLONASS', 'GLONASS (Russian: ???????, IPA: [????nas]; ?????????? ????????????? ??????????? ???????; transliteration Globalnaya navigatsionnaya sputnikovaya sistema), or \"Global Navigation Satellite System\", is a space-based satellite navigation system operating in the radionavigation-satellite service. It provides an alternative to GPS and is the second navigational system in operation with global coverage and of comparable precision.\r\n\r\nManufacturers of GPS navigation dev', 'Technology', 0, '2018-09-12 00:00:00', 29),
('Hands on', ' The Lobby will use the funds to build out its finance job marketplace, which founder and CEO Deepak Chhugani says is like a \"personalized Glassdoor.\"', 'Technology', 0, '2018-09-27 09:32:40', 29),
('Schema', ' The database schema of a database system is its structure described in a formal language supported by the database management system (DBMS). The term \"schema\" refers to the organization of data as a blueprint of how the database is constructed (divided into database tables in the case of relational databases). The formal definition of a database schema is a set of formulas (sentences) called integrity constraints imposed on a database.[citation needed] These integrity constraints ensure compatibility betwe', 'Database', 0, '2018-09-28 13:29:07', 29),
('test', ' Testing', 'Technology', 0, '2018-09-27 10:39:40', 29),
('Time', 'what is time ?', 'Technology', 0, '2018-09-27 10:37:11', 29),
('undefined', 'undefined', 'undefined', 0, '2018-09-26 12:37:38', 29);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `joiningDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `password`, `phone`, `type`, `gender`, `joiningDate`) VALUES
(0, '', '', '', '', '', 'Male', '2018-09-27 14:12:24'),
(11142002, 'alif choyon', 'jj', '11', '11', '11', 'Male', '2018-09-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `studentcommentsarticle`
--

CREATE TABLE `studentcommentsarticle` (
  `sid` int(11) NOT NULL,
  `articleName` varchar(100) NOT NULL,
  `comment` varchar(512) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentcommentsarticle`
--

INSERT INTO `studentcommentsarticle` (`sid`, `articleName`, `comment`, `date`) VALUES
(0, 'asdas', ' lol', '2018-09-28 13:19:12'),
(11142002, 'aa', 'cc', '2018-09-27 00:00:00'),
(11142002, 'asdas', ' what is it', '2018-09-27 10:51:00'),
(11142002, 'GLONASS', 'nice', '2018-09-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `joiningDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `password`, `phone`, `type`, `gender`, `joiningDate`) VALUES
(29, 'sigmacomplex', 'sigmacomplexcubed@gmail.com', '12345', '23542355555', 'Undergrad', 'Female', '2018-09-09 08:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `teachercommentsarticle`
--

CREATE TABLE `teachercommentsarticle` (
  `tid` int(11) NOT NULL,
  `articleName` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachercommentsarticle`
--

INSERT INTO `teachercommentsarticle` (`tid`, `articleName`, `comment`, `date`) VALUES
(29, 'Another test', ' sdfsd', '2018-09-27 10:42:12'),
(29, 'asdas', ' ntohing man chill', '2018-09-27 10:51:27'),
(29, 'GLONASS', ' sorry for spelling mistake thanks..', '2018-09-27 10:33:31'),
(29, 'GLONASS', 'thabks', '2018-09-27 00:00:00'),
(29, 'Hands on', ' does it work ?', '2018-09-27 10:32:58'),
(29, 'Hands on', ' what is it ?', '2018-09-27 10:31:39'),
(29, 'Time', ' lol', '2018-09-27 14:53:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`name`),
  ADD KEY `Article_fk0` (`tid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentcommentsarticle`
--
ALTER TABLE `studentcommentsarticle`
  ADD PRIMARY KEY (`sid`,`articleName`,`comment`),
  ADD KEY `StudentCommentsArticle_fk1` (`articleName`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachercommentsarticle`
--
ALTER TABLE `teachercommentsarticle`
  ADD PRIMARY KEY (`tid`,`articleName`,`comment`),
  ADD KEY `TeacherCommentsArticle_fk1` (`articleName`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `Article_fk0` FOREIGN KEY (`tid`) REFERENCES `teacher` (`id`);

--
-- Constraints for table `studentcommentsarticle`
--
ALTER TABLE `studentcommentsarticle`
  ADD CONSTRAINT `StudentCommentsArticle_fk0` FOREIGN KEY (`sid`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `StudentCommentsArticle_fk1` FOREIGN KEY (`articleName`) REFERENCES `article` (`name`);

--
-- Constraints for table `teachercommentsarticle`
--
ALTER TABLE `teachercommentsarticle`
  ADD CONSTRAINT `TeacherCommentsArticle_fk0` FOREIGN KEY (`tid`) REFERENCES `teacher` (`id`),
  ADD CONSTRAINT `TeacherCommentsArticle_fk1` FOREIGN KEY (`articleName`) REFERENCES `article` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
