-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 04:01 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricket`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `team_one` int(11) NOT NULL,
  `team_two` int(11) NOT NULL,
  `win_team` int(11) NOT NULL DEFAULT '0',
  `match_status` enum('0','1','2','3','4') DEFAULT '0' COMMENT '0-not played,1-played,2-tie,3-cancel, 4-postpone',
  `play_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `team_one`, `team_two`, `win_team`, `match_status`, `play_at`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 2, 1, '1', '2020-05-01 09:00:00', '2020-05-30 10:29:50', '0000-00-00 00:00:00', 1),
(2, 3, 4, 0, '3', '2020-05-02 10:00:00', '2020-05-30 11:30:27', '2020-05-30 11:30:27', 1),
(3, 1, 4, 0, '2', '2020-05-03 08:00:00', '2020-05-30 11:44:08', '2020-05-30 11:44:08', 1),
(4, 2, 5, 5, '1', '2020-05-06 15:00:00', '2020-05-30 11:44:54', '2020-05-30 11:44:54', 1),
(5, 5, 1, 1, '1', '2020-05-08 10:00:00', '2020-05-30 11:45:17', '2020-05-30 11:45:17', 1),
(6, 1, 2, 1, NULL, '2020-05-12 10:00:00', '2020-05-30 11:46:23', '2020-05-30 11:46:23', 1),
(7, 5, 6, 6, '1', '2020-05-15 10:00:00', '2020-05-30 11:46:50', '2020-05-30 11:46:50', 1),
(8, 2, 4, 4, '1', '2020-05-19 23:00:00', '2020-05-30 11:48:15', '2020-05-30 11:48:15', 1),
(9, 6, 2, 0, '0', '2020-06-03 10:00:00', '2020-05-30 11:48:42', '2020-05-30 11:48:42', 1),
(10, 1, 6, 0, '0', '2020-06-10 07:00:00', '2020-05-30 11:49:14', '2020-05-30 11:49:14', 1),
(11, 3, 1, 0, '0', '2020-06-11 00:00:00', '2020-05-30 11:49:36', '2020-05-30 11:49:36', 1),
(12, 9, 10, 0, '3', '0000-00-00 00:00:00', '2020-05-31 12:00:30', '2020-05-31 12:00:30', 1),
(13, 9, 7, 0, '0', '0000-00-00 00:00:00', '2020-05-31 13:32:59', '2020-05-31 13:32:59', 1),
(14, 1, 6, 6, '1', '0000-00-00 00:00:00', '2020-05-31 13:33:26', '2020-05-31 13:33:26', 1),
(15, 1, 3, 0, '3', '0000-00-00 00:00:00', '2020-05-31 18:11:22', '2020-05-31 18:11:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `player_type` enum('1','2','3','4','0') NOT NULL DEFAULT '0' COMMENT '1-B,2-Bl,3-A,4-w',
  `is_captain` tinyint(1) NOT NULL DEFAULT '0',
  `jersey_number` int(11) NOT NULL DEFAULT '0',
  `country` varchar(255) NOT NULL DEFAULT 'India',
  `team_id_fk` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='list of players along with team ';

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `first_name`, `last_name`, `avatar`, `player_type`, `is_captain`, `jersey_number`, `country`, `team_id_fk`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Virat', 'Kohli', 'viratkohli.png', '1', 1, 18, 'India', 1, 1, '2020-05-30 07:40:31', '2020-05-30 07:40:31'),
(2, 'Rohit', 'Sharma', 'rohitsharma.png', '1', 0, 45, 'India', 1, 1, '2020-05-30 07:41:43', '2020-05-30 07:41:43'),
(3, 'Fakhar', 'Zaman', 'fakhar-zaman.png', '1', 0, 39, 'Pakistan', 2, 1, '2020-05-30 14:15:00', '2020-05-30 14:15:00'),
(4, 'Shikhar', 'Dhawan', 'shikhar-dhawan.png', '1', 0, 25, 'India', 1, 1, '2020-05-30 16:50:05', '2020-05-30 16:50:05'),
(5, 'Sarfaraz', 'Ahmed', 'sarfaraz-ahmed.png', '3', 1, 54, 'Pakistan', 2, 1, '2020-05-30 19:27:42', '2020-05-30 19:27:42'),
(6, 'Dimuth', 'Karunaratne', 'dimuth-karunaratne.png', '1', 1, 16, 'Srilanka', 3, 1, '2020-05-30 19:31:30', '2020-05-30 19:31:30'),
(7, 'Faf du ', 'Plessis', 'fafduplessis.png', '1', 1, 18, 'South Africa', 5, 1, '2020-05-30 19:34:23', '2020-05-30 19:34:23'),
(8, 'Eoin ', 'Morgan', 'eoin-morgan.png', '1', 1, 16, 'England', 4, 1, '2020-05-30 19:36:54', '2020-05-30 19:36:54'),
(9, 'Kane ', 'Williamson', 'kane-williamson.png', '1', 1, 21, 'England', 6, 1, '2020-05-30 19:38:58', '2020-05-30 19:38:58'),
(10, 'Vijay', 'Shankar', 'vijay-shankar.png', '4', 0, 35, 'India', 1, 1, '2020-05-30 19:46:05', '2020-05-30 19:46:05'),
(11, 'Hardik', 'Pandya', 'hardik-pandya.png', '4', 0, 90, 'India', 1, 1, '2020-05-30 19:46:05', '2020-05-30 19:46:05'),
(12, 'ravindra', 'jadeja', 'ravindra-jadeja.png', '4', 0, 60, 'India', 1, 1, '2020-05-30 19:47:28', '2020-05-30 19:47:28'),
(13, 'Ms', 'Dhoni', 'ms-dhoni.png', '3', 0, 7, 'India', 1, 1, '2020-05-30 19:47:28', '2020-05-30 19:47:28'),
(14, 'dinesh', 'karthik', 'dinesh-karthik.png', '3', 0, 60, 'India', 1, 1, '2020-05-30 19:48:21', '2020-05-30 19:48:21'),
(15, 'lokesh', 'rahul', 'lokesh-rahul.png', '3', 0, 33, 'India', 1, 1, '2020-05-30 19:49:41', '2020-05-30 19:49:41'),
(16, 'mohammed', 'shami', 'mohammed-shami.png', '2', 0, 66, 'India', 1, 1, '2020-05-30 19:50:41', '2020-05-30 19:50:41'),
(17, 'jasprit', 'bumrah', 'jasprit-bumrah.png', '2', 0, 100, 'India', 1, 1, '2020-05-30 19:50:41', '2020-05-30 19:50:41'),
(18, 'kuldeep', 'yadav', 'kuldeep-yadav.png', '2', 0, 56, 'India', 1, 1, '2020-05-30 19:51:09', '2020-05-30 19:51:09'),
(19, 'yuzvendra', 'chahal', 'yuzvendra-chahal.png', '2', 0, 300, 'India', 1, 1, '2020-05-30 19:51:35', '2020-05-30 19:51:35'),
(20, 'babar', 'azam', 'babar-azam.png', '1', 0, 12, 'Pakistan', 2, 1, '2020-05-30 20:14:15', '2020-05-30 20:14:15'),
(21, 'asif', 'ali', 'asif-ali.png', '1', 0, 16, 'Pakistan', 2, 1, '2020-05-30 20:14:16', '2020-05-30 20:14:16'),
(22, 'haris', 'sohail', 'haris-sohail.png', '1', 0, 56, 'Pakistan', 2, 1, '2020-05-30 20:14:16', '2020-05-30 20:14:16'),
(23, 'mohammad', 'hafeez', 'mohammad-hafeez.png', '4', 0, 89, 'Pakistan', 2, 1, '2020-05-30 20:14:16', '2020-05-30 20:14:16'),
(24, 'shoaib', 'malik', 'shoaib-malik.png', '4', 0, 112, 'Pakistan', 2, 1, '2020-05-30 20:14:16', '2020-05-30 20:14:16'),
(25, 'shadab', 'khan', 'shadab-khan.png', '4', 0, 598, 'Pakistan', 2, 1, '2020-05-30 20:14:16', '2020-05-30 20:14:16'),
(26, 'imad', 'wasim', 'imad-wasim.png', '4', 0, 124, 'Pakistan', 2, 1, '2020-05-30 20:14:16', '2020-05-30 20:14:16'),
(27, 'wahab', 'riaz', 'wahab-riaz.png', '4', 0, 126, 'Pakistan', 2, 1, '2020-05-30 20:14:16', '2020-05-30 20:14:16'),
(28, 'hasan', 'ali', 'hasan-ali.png', '3', 0, 7, 'Pakistan', 2, 1, '2020-05-30 20:17:02', '2020-05-30 20:17:02'),
(29, 'mohammad', 'hasnain', 'mohammad-hasnain.png', '3', 0, 5, 'Pakistan', 2, 1, '2020-05-30 20:17:02', '2020-05-30 20:17:02'),
(30, 'mohammad', 'amir', 'mohammad-amir.png', '3', 0, 66, 'Pakistan', 2, 1, '2020-05-30 20:17:02', '2020-05-30 20:17:02'),
(34, 'lahiru', 'thirimanne', 'lahiru-thirimanne.png', '1', 0, 124, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(35, 'avishka', 'fernando', 'avishka-fernando.png', '1', 0, 15, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(36, 'kusal', 'mendis', 'kusal-mendis.png', '1', 0, 164, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(37, 'angelo', 'mathews', 'angelo-mathews.png', '4', 0, 56, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(38, 'dhananjaya', 'de silva', 'dhananjaya-de-silva.png', '4', 0, 55, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(39, 'milinda', 'siriwardana', 'milinda-siriwardana.png', '4', 0, 57, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(40, 'thisara', 'perera', 'thisara-perera.png', '4', 0, 58, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(41, 'isuru', 'udana', 'isuru-udana.png', '4', 0, 59, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(42, 'jeevan', 'mendis', 'jeevan-mendis.png', '4', 0, 60, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(43, 'kusal', 'perera', 'kusal-perera.png', '3', 0, 61, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(44, 'suranga', 'lakmal', 'suranga-lakmal.png', '2', 0, 69, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(45, 'lasith', 'malinga', 'lasith-malinga.png', '2', 0, 74, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(46, 'jeffrey', 'vandersay', 'jeffrey-vandersay.png', '2', 0, 80, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(47, 'nuwan', 'pradeep', 'nuwan-pradeep.png', '2', 0, 98, 'Srilanka', 3, 1, '2020-05-30 20:32:11', '2020-05-30 20:32:11'),
(48, 'joe', 'root', 'joe-root.png', '1', 0, 12, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(49, 'jason', 'roy', 'jason-roy.png', '1', 0, 24, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(50, 'james', 'vince', 'james-vince.png', '1', 0, 36, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(51, 'moeen', 'ali', 'moeen-ali.png', '4', 0, 40, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(52, 'ben', 'stokes', 'ben-stokes.png', '4', 0, 18, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(53, 'chris', 'woakes', 'chris-woakes.png', '4', 0, 15, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(54, 'tom', 'curran', 'tom-curran.png', '4', 0, 68, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(55, 'liam', 'dawson', 'liam-dawson.png', '4', 0, 70, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(56, 'jofra', 'archer', 'jofra-archer.png', '4', 0, 99, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(57, 'jonny', 'bairstow', 'jonny-bairstow.png', '3', 0, 44, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(58, 'jos', 'buttler', 'jos-buttler.png', '3', 0, 46, 'England', 4, 1, '2020-05-30 20:42:36', '2020-05-30 20:42:36'),
(59, 'liam', 'plunkett', 'liam-plunkett.png', '2', 0, 456, 'England', 4, 1, '2020-05-30 20:42:37', '2020-05-30 20:42:37'),
(60, 'adil', 'rashid', 'adil-rashid.png', '2', 0, 152, 'England', 4, 1, '2020-05-30 20:42:37', '2020-05-30 20:42:37'),
(61, 'mark', 'wood', 'mark-wood.png', '2', 0, 200, 'England', 4, 1, '2020-05-30 20:42:37', '2020-05-30 20:42:37'),
(62, 'david', 'miller', 'david-miller.png', '1', 0, 3, 'South Africa', 5, 1, '2020-05-30 20:58:00', '2020-05-30 20:58:00'),
(63, 'aiden', 'markram', 'aiden-markram.png', '1', 0, 5, 'South Africa', 5, 1, '2020-05-30 20:58:00', '2020-05-30 20:58:00'),
(64, 'rassie', 'van der dussen', 'rassie-van-der-dussen.png', '1', 0, 7, 'South Africa', 5, 1, '2020-05-30 20:58:00', '2020-05-30 20:58:00'),
(65, 'jean paul', 'duminy', 'jean-paul-duminy.png', '4', 0, 45, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(66, 'andile', 'phehlukwayo', 'andile-phehlukwayo.png', '4', 0, 89, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(67, 'dwaine', 'pretorius', 'dwaine-pretorius.png', '4', 0, 66, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(68, 'chris', 'morris', 'chris-morris.png', '4', 0, 85, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(69, 'quinton', 'de kock', 'quinton-de-kock.png', '3', 0, 85, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(70, 'imran', 'tahir', 'imran-tahir.png', '2', 0, 98, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(71, 'kagiso', 'rabada', 'kagiso-rabada.png', '2', 0, 59, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(72, 'lungi', 'ngidi', 'lungi-ngidi.png', '2', 0, 47, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(73, 'tabraiz', 'shamsi', 'tabraiz-shamsi.png', '2', 0, 11, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(74, 'beuran', 'hendricks', 'beuran-hendricks.png', '2', 0, 49, 'South Africa', 5, 1, '2020-05-30 20:58:01', '2020-05-30 20:58:01'),
(75, 'martin', 'guptill', 'martin-guptill.png', '1', 0, 45, 'New Zealand', 6, 1, '2020-05-30 21:10:27', '2020-05-30 21:10:27'),
(76, 'ross', 'taylor', 'ross-taylor.png', '1', 0, 68, 'New Zealand', 6, 1, '2020-05-30 21:10:27', '2020-05-30 21:10:27'),
(77, 'henry', 'nicholls', 'henry-nicholls.png', '1', 0, 78, 'New Zealand', 6, 1, '2020-05-30 21:10:27', '2020-05-30 21:10:27'),
(78, 'james', 'neesham', 'james-neesham.png', '4', 0, 59, 'New Zealand', 6, 1, '2020-05-30 21:10:27', '2020-05-30 21:10:27'),
(79, 'colin de', 'grandhomme', 'colin-de-grandhomme.png', '4', 0, 69, 'New Zealand', 6, 1, '2020-05-30 21:10:27', '2020-05-30 21:10:27'),
(80, 'colin', 'munro', 'colin-munro.png', '4', 0, 77, 'New Zealand', 6, 1, '2020-05-30 21:10:27', '2020-05-30 21:10:27'),
(81, 'mitchell', 'santner', 'mitchell-santner.png', '4', 0, 998, 'New Zealand', 6, 1, '2020-05-30 21:10:27', '2020-05-30 21:10:27'),
(82, 'tom', 'latham', 'tom-latham.png', '3', 0, 43, 'New Zealand', 6, 1, '2020-05-30 21:10:28', '2020-05-30 21:10:28'),
(83, 'tom', 'blundell', 'tom-blundell.png', '3', 0, 7, 'New Zealand', 6, 1, '2020-05-30 21:10:28', '2020-05-30 21:10:28'),
(84, 'trent', 'boult', 'trent-boult.png', '2', 0, 6, 'New Zealand', 6, 1, '2020-05-30 21:10:28', '2020-05-30 21:10:28'),
(85, 'matt', 'henry', 'matt-henry.png', '2', 0, 65, 'New Zealand', 6, 1, '2020-05-30 21:10:28', '2020-05-30 21:10:28'),
(86, 'tim', 'southee', 'tim-southee.png', '2', 0, 91, 'New Zealand', 6, 1, '2020-05-30 21:10:28', '2020-05-30 21:10:28'),
(87, 'ish', 'sodhi', 'ish-sodhi.png', '2', 0, 655, 'New Zealand', 6, 1, '2020-05-30 21:10:28', '2020-05-30 21:10:28'),
(88, 'lockie', 'ferguson', 'lockie-ferguson.png', '2', 0, 499, 'New Zealand', 6, 1, '2020-05-30 21:10:28', '2020-05-30 21:10:28'),
(89, 'Test', 'User', 'default_avatar.png', '1', 1, 123, '1', 7, 1, '2020-05-31 11:10:07', '2020-05-31 11:10:07'),
(90, 'User', 'Two', 'default_avatar.png', '3', 0, 22, '3', 7, 1, '2020-05-31 11:14:05', '2020-05-31 11:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `match_id_fk` int(11) NOT NULL,
  `player_id_fk` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `wicket_by` int(11) NOT NULL DEFAULT '0',
  `team_id_fk` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `match_id_fk`, `player_id_fk`, `score`, `wicket_by`, `team_id_fk`) VALUES
(1, 1, 1, 100, 0, 1),
(2, 1, 2, 40, 20, 1),
(3, 3, 1, 90, 0, 1),
(4, 1, 3, 10, 11, 2),
(5, 14, 9, 12, 4, 6),
(6, 14, 17, 6, 76, 1),
(7, 14, 1, 100, 0, 1),
(8, 14, 77, 200, 0, 6),
(9, 14, 13, 7, 0, 1),
(10, 1, 13, 7, 28, 1),
(11, 1, 14, 50, 28, 1),
(12, 1, 20, 5, 4, 2),
(13, 1, 28, 5, 17, 2),
(14, 1, 12, 50, 21, 1),
(15, 1, 4, 10, 28, 1),
(16, 1, 18, 44, 28, 1),
(17, 1, 22, 1, 4, 2),
(18, 1, 23, 1, 4, 2),
(19, 1, 21, 54, 17, 2),
(20, 1, 26, 4, 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_logo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(255) DEFAULT 'India'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='list of teams ';

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_logo`, `status`, `created_at`, `updated_at`, `location`) VALUES
(1, 'India', 'india.png', 1, '2020-05-29 23:01:17', '2020-05-29 23:01:17', 'India'),
(2, 'Pakistan', 'pakistan.png', 1, '2020-05-29 23:02:34', '2020-05-29 23:02:34', 'Pakistan'),
(3, 'Sri Lanka', 'srilanka.png', 1, '2020-05-29 23:04:01', '2020-05-29 23:04:01', 'Sri Lanka'),
(4, 'England', 'england.png', 1, '2020-05-29 23:04:01', '2020-05-29 23:04:01', 'England'),
(5, 'South Africa', 'southafrica.png', 1, '2020-05-29 23:04:41', '2020-05-29 23:04:41', 'South Africa'),
(6, 'New Zealand', 'newzealand.png', 1, '2020-05-29 23:05:19', '2020-05-29 23:05:19', 'New Zealand'),
(7, 'Team A', 'team_1590896859.png', 1, '2020-05-31 09:17:39', '2020-05-31 09:17:39', 'India'),
(8, 'Team B', 'team_1590897328.png', 1, '2020-05-31 09:25:28', '2020-05-31 09:25:28', 'India'),
(9, 'Team C', 'team_1590897499.png', 1, '2020-05-31 09:28:19', '2020-05-31 09:28:19', 'India'),
(10, 'Team D', 'team_1590897632.png', 1, '2020-05-31 09:30:32', '2020-05-31 09:30:32', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `status`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `match_status` (`match_status`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jersey_number` (`jersey_number`),
  ADD KEY `team_id_fk` (`team_id_fk`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
