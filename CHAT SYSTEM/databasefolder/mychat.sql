-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2022 at 07:39 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mychat`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `emails` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` bigint(20) NOT NULL,
  `RECEIVED` bigint(20) DEFAULT NULL,
  `MASSAGEID` varchar(60) NOT NULL,
  `SENDER` bigint(20) NOT NULL,
  `RECEIVER` bigint(20) NOT NULL,
  `MESSAGE` text NOT NULL,
  `FILE` text DEFAULT NULL,
  `DATE` datetime NOT NULL,
  `SEEN` int(1) NOT NULL DEFAULT 0,
  `RECEIVERDEL` bigint(20) NOT NULL DEFAULT 0,
  `SENDERDEL` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `RECEIVED`, `MASSAGEID`, `SENDER`, `RECEIVER`, `MESSAGE`, `FILE`, `DATE`, `SEEN`, `RECEIVERDEL`, `SENDERDEL`) VALUES
(1, 1, 'vrzw4h44agnzg3s5mnmgrms', 794534681, 2387646457, 'hello', NULL, '2021-11-26 06:38:00', 1, 0, 0),
(2, 1, 'vrzw4h44agnzg3s5mnmgrms', 2387646457, 794534681, 'hello too', NULL, '2021-11-26 06:39:01', 1, 0, 0),
(3, 1, 'vrzw4h44agnzg3s5mnmgrms', 2387646457, 794534681, 'hi', NULL, '2021-12-14 16:30:26', 1, 0, 0),
(4, 1, 'vrzw4h44agnzg3s5mnmgrms', 2387646457, 794534681, 'hi', NULL, '2021-12-14 16:30:38', 1, 0, 0),
(5, 1, 'vrzw4h44agnzg3s5mnmgrms', 794534681, 2387646457, 'hi too', NULL, '2021-12-14 16:32:30', 1, 0, 0),
(6, 1, 'vrzw4h44agnzg3s5mnmgrms', 2387646457, 794534681, 'uko aje', NULL, '2021-12-14 16:32:48', 1, 0, 0),
(7, 1, 'vrzw4h44agnzg3s5mnmgrms', 794534681, 2387646457, 'niko poa', NULL, '2021-12-14 16:33:04', 0, 0, 0),
(8, NULL, 'uqwo0058Bub', 2387646457, 5173742738, 'mimimi', NULL, '2021-12-20 07:05:12', 0, 0, 0),
(9, NULL, 'je85fAy661jv1kskcr1wqsjiBe8fn92Anmc3didhAwdd', 5665981790, 7154058782, 'hellow', NULL, '2021-12-31 16:42:51', 0, 0, 0),
(10, NULL, 'lxAlrku0xgx1pimlsf0y99ky9iulpBqxxsx7k', 4796838048, 5665981790, 'hello', NULL, '2022-01-14 06:37:53', 0, 0, 0),
(11, NULL, 'r98ynl3fu78yudb', 1284491073, 5173742738, 'uuu', NULL, '2022-02-08 21:20:38', 0, 0, 0),
(12, NULL, 'r98ynl3fu78yudb', 1284491073, 5173742738, 'ff', NULL, '2022-02-08 21:21:02', 0, 0, 0),
(13, NULL, 'r1juc4lz9p3av3qd8ryhaq7rj8cwc', 1325251763, 7154058782, 'hello', NULL, '2022-02-22 07:58:20', 0, 0, 0),
(14, NULL, 'r1juc4lz9p3av3qd8ryhaq7rj8cwc', 1325251763, 7154058782, 'mkundu', NULL, '2022-02-22 08:01:43', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_chat`
--

CREATE TABLE `user_chat` (
  `ID` bigint(20) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `TIME` datetime NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `ONLINE` int(11) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `IMAGE` varchar(50) NOT NULL,
  `USERID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_chat`
--

INSERT INTO `user_chat` (`ID`, `USERNAME`, `EMAIL`, `TIME`, `PASSWORD`, `ONLINE`, `GENDER`, `IMAGE`, `USERID`) VALUES
(1, 'IAN', '1804189@students.kca.ac.ke', '2021-11-18 20:20:56', '12345', 0, 'Male', 'uploads/2019-11-19_10-08-21-364.png', 5173742738),
(2, 'MIKE', 'denismutemi84@gmail.com', '2021-11-18 20:21:31', '12345', 0, 'Female', 'uploads/Annotation 2019-04-18 110608.png', 2387646457),
(3, 'Dennis', 'denismutemi84@gmail.com', '2021-11-26 06:37:15', '12345', 0, 'Male', 'uploads/2019-08-20-08-58-11-050.jpg', 794534681),
(4, 'mike', 'mutemidenis26@gmail.com', '2021-12-14 16:29:27', '123456', 0, 'Male', '', 7154058782),
(5, 'shed', 'denismutemi84@gmail.com', '2021-12-31 16:42:25', '12345', 0, 'Female', '', 5665981790),
(6, 'slyvia', 'denismutemi84@gmail.com', '2022-01-14 06:37:30', '1234', 0, 'Female', 'uploads/2019-11-23_22-42-44-609 (1).png', 4796838048),
(7, 'claudia', 'claudia@kca.ac.ke', '2022-02-08 21:20:06', '1234', 0, 'Male', '', 1284491073),
(8, 'maryann', '1804189@students.kca.ac.ke', '2022-02-22 07:57:55', '1234', 0, 'Male', 'uploads/2019-08-20-08-57-44-671.jpg', 1325251763);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DATE_2` (`DATE`),
  ADD KEY `DATE` (`DATE`),
  ADD KEY `SENDER` (`SENDER`),
  ADD KEY `SEEN` (`SEEN`),
  ADD KEY `SENDERDEL` (`SENDERDEL`),
  ADD KEY `RECEIVERDEL` (`RECEIVERDEL`);

--
-- Indexes for table `user_chat`
--
ALTER TABLE `user_chat`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EMAIL` (`EMAIL`),
  ADD KEY `USERNAME` (`USERNAME`),
  ADD KEY `TIME` (`TIME`),
  ADD KEY `ONLINE` (`ONLINE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
