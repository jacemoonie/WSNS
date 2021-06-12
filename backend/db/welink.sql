-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 01:07 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `welink`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profileImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstName`, `lastName`, `email`, `username`, `password`, `profileImage`) VALUES
(1, 'Admin', 'Welink', 'adminwelink@gmail.com', 'adminwelink', '$2y$10$DInBAdwAnny/rc9mR7GVH./qVmeFyCYnK65j5kT41Yf/w/Kf0twau', 'frontend/profileImage/adminProfilePic1.png');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `announcement_description` text NOT NULL,
  `announcementOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `announcement_description`, `announcementOn`) VALUES
(4, 'In today’s modern world, much of our conversation happens through the medium of email. Whether it is for marketing purposes or for personal use, utilizing email’s power has proven to work better and be more efficient than other communication channels for a multitude of reasons.\r\n\r\n', '2021-06-04 23:13:08'),
(8, 'Announcement emails that have the purpose of introducing a new business, allow a company to reach out to an existing customer base instantly, instead of relying on other media sources, such as TV advertisements or printed media. ', '2021-06-05 00:10:11'),
(10, 'Attention to all Mall visitors, for those who feel they have lost a black women’s bag with the Gocca brand, please go to the security room on the 1st floor. Thank you', '2021-06-05 00:13:16'),
(11, 'Attention to all LionKing passengers with flight number DS224 from Jakarta to Surabaya, we have just been informed that the flight must be delayed for 30 minutes. Please take the snacks that we have provided at the reception desk. Thank you', '2021-06-05 01:32:47'),
(12, 'Announcement is a proclamation or declaration of some happening, future event or something that has taken place. Thus letter announces a special event or an occasion that people need to be aware of. Announcement letter can be written under various topics, it could be an announcement of bad weather, a civil emergency, budget surplus, business anniversary, policy or fee amount, savings plan, change of company’s name, work schedule, job opening, new business location, store or branch opening, special meeting, achievement, a new policy, concert, birthday party, wedding ceremony, musical night or an admission schedule.', '2021-06-05 15:42:33'),
(14, 'I am pleased to announce Michael Nolan has earned a well-deserved promotion to Customer Service Manager effective October 1.\r\n\r\nMichael brings extensive experience in customer service, customer solutions, and communications to his position, along with several years of experience with our company.\r\n\r\nI would appreciate you welcoming him on board as he transitions to this new role.\r\n\r\nIf you have any questions moving forward, please don\'t hesitate to ask.', '2021-06-07 22:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL,
  `commentBy` int(11) NOT NULL,
  `commentOn` int(11) NOT NULL,
  `comment` text NOT NULL,
  `commentAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventID` int(11) NOT NULL,
  `eventName` varchar(255) NOT NULL,
  `eventDescription` text NOT NULL,
  `eventDate` date NOT NULL,
  `eventCreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `eventBy` int(11) NOT NULL,
  `eventImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `eventName`, `eventDescription`, `eventDate`, `eventCreatedOn`, `eventBy`, `eventImage`) VALUES
(1, 'Huawei mobile services (hms) ecosystem testing', 'HUAWEI and FCSIT would like to invite all faculty students to attend this online talk about HUAWEI Mobile Services (HMS) Ecosystem and its benefits. Speakers will also be promoting their student developer program and upcoming HUAWEI AppsUp Contest that is exciting and has amazing prizes!  We are also proud to have Mr Tan Wei Cong, FCSIT alumnus who graduated in 2017, majored in Software Engineering, in this event. All faculty students are highly encouraged to attend as HUAWEI will be offering an intensive 5-week app development program exclusively to UNIMAS students. Do not miss this opportunity to get to know the experts.  Meeting link: https://welink-meeting.zoom.us/j/809192490 Date: Wednesday, 9 June 2021 Time: 8pm-10pm Visit our online events page for more details: https://www.fcsit.unimas.my/online-events TESTING', '2021-06-18', '2021-06-07 14:03:56', 0, 'frontend/eventImage/eventPic1.jpeg'),
(3, 'Testing event', 'TESTING EVENT', '2021-06-25', '2021-06-09 17:02:14', 32, ''),
(5, 'TESTiNG EVENT 1.0 ', 'Cuba kalau working OH YESH lasgiiiiiiii', '2021-07-26', '2021-06-09 23:33:24', 32, 'frontend/eventImage/eventPic5.jpg'),
(6, 'EVENT TESTING LAGI', 'dnszjfdbhuadsfff', '2021-06-24', '2021-06-10 00:18:39', 32, 'frontend/eventImage/eventPic6.jpeg'),
(7, 'BANANANANA', 'BANANANA', '2021-06-17', '2021-06-10 00:22:27', 32, ''),
(8, 'apaini', 'apaini', '2021-06-23', '2021-06-10 00:24:51', 32, ''),
(9, 'tets', 'test', '2021-06-29', '2021-06-10 00:27:02', 32, ''),
(10, 'I JUST DONT KMOW', 'I DOMT KNOW', '2021-06-29', '2021-06-10 00:42:17', 32, 'frontend\\assets\\images\\defaultPic.svg');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_one`, `user_two`) VALUES
(1, 32, 31),
(2, 40, 32),
(3, 41, 32);

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`id`, `sender`, `receiver`) VALUES
(4, 32, 33),
(5, 40, 33);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `groupID` int(11) NOT NULL,
  `groupName` varchar(255) NOT NULL,
  `groupDescription` text NOT NULL,
  `groupCreatedBy` int(11) NOT NULL,
  `groupCreatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `groupImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`groupID`, `groupName`, `groupDescription`, `groupCreatedBy`, `groupCreatedAt`, `groupImage`) VALUES
(1, 'Moonie', 'This is a group chat for moonies only', 31, '2021-06-03 20:51:38', 'frontend\\assets\\images\\default_profile.png'),
(2, 'Banana', 'pisang', 31, '2021-06-04 00:27:52', 'frontend\\assets\\images\\default_profile.png'),
(3, 'Jalai2carimakan', 'Just a group', 32, '2021-06-05 23:17:01', 'frontend\\assets\\images\\default_profile.png'),
(4, 'pisangggg', 'afdasfdsfgsdfsdfsd', 32, '2021-06-06 16:50:03', 'frontend\\assets\\images\\default_profile.png'),
(5, 'WAKANDA', 'YOU KNOW WHAT', 32, '2021-06-06 16:51:44', 'frontend\\assets\\images\\default_profile.png'),
(6, 'LET CREATE GROUP', 'YOU KNOWWWWWWWWWWW', 32, '2021-06-06 16:53:27', 'frontend\\assets\\images\\default_profile.png'),
(7, 'LAGII BAUKKK', 'PENAT SISIIIII', 32, '2021-06-06 16:55:07', 'frontend\\assets\\images\\default_profile.png'),
(8, 'ONEOKROCK', 'ohohohohohohohohoh', 32, '2021-06-06 17:27:15', 'frontend\\assets\\images\\default_profile.png'),
(9, 'LAST SUDAH KEMON', 'TESTING FOR  100TH', 32, '2021-06-06 17:30:17', 'frontend\\assets\\images\\default_profile.png'),
(10, 'THE REAL ONE', 'You know I know what I know', 32, '2021-06-06 19:11:05', 'frontend\\assets\\images\\default_profile.png'),
(11, 'THE ROCK BABAEEEE', 'BRUNO MARS IS REAL', 32, '2021-06-06 19:17:29', 'frontend\\assets\\images\\default_profile.png'),
(12, 'KIMCHIII', 'ALL is AWESOME', 32, '2021-06-07 01:05:42', 'frontend\\assets\\images\\default_profile.png'),
(14, 'MOONIE BABIEYY', 'OH YEAH BABY', 41, '2021-06-07 20:06:42', 'frontend\\assets\\images\\default_profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `groupmembers`
--

CREATE TABLE `groupmembers` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupmembers`
--

INSERT INTO `groupmembers` (`ID`, `user_id`, `group_id`) VALUES
(1, 33, 9),
(2, 31, 9),
(3, 33, 10),
(4, 40, 10),
(7, 32, 11),
(9, 40, 12),
(10, 31, 12),
(11, 33, 12),
(12, 39, 12),
(13, 32, 12),
(26, 40, 11),
(27, 33, 11),
(28, 31, 11),
(30, 40, 14),
(31, 31, 14),
(32, 41, 14),
(33, 32, 14);

-- --------------------------------------------------------

--
-- Table structure for table `groupmessage`
--

CREATE TABLE `groupmessage` (
  `groupMessageID` int(11) NOT NULL,
  `groupMsgFrom` int(11) NOT NULL,
  `groupMessage` text NOT NULL,
  `groupMsgTo` int(11) NOT NULL,
  `groupMessageOn` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupmessage`
--

INSERT INTO `groupmessage` (`groupMessageID`, `groupMsgFrom`, `groupMessage`, `groupMsgTo`, `groupMessageOn`, `status`) VALUES
(1, 33, 'Hi guys what\'s uppp', 11, '2021-06-06 20:32:16', 0),
(2, 40, 'Yoooooooooooooooooooooo', 11, '2021-06-06 20:32:16', 0),
(3, 33, 'Hiii', 11, '2021-06-06 20:33:15', 0),
(4, 32, 'HIIIIIIIIIIIII astagaaa', 11, '2021-06-06 23:18:16', 0),
(5, 32, 'HIIIIIIIIIIIII astagaaa', 11, '2021-06-06 23:18:28', 0),
(6, 32, 'Hiiii\n', 11, '2021-06-06 23:38:02', 0),
(7, 32, 'Hiiiiiii\n', 11, '2021-06-06 23:39:24', 0),
(8, 32, 'yo yo wazzuuu\n', 11, '2021-06-07 00:02:15', 0),
(9, 32, 'cuba lagi\n', 11, '2021-06-07 00:10:02', 0),
(10, 40, 'hi\n', 11, '2021-06-07 00:17:12', 0),
(11, 40, 'ingat sayakah?\n', 11, '2021-06-07 00:17:31', 0),
(12, 40, 'Hi\n', 10, '2021-06-07 00:23:39', 0),
(13, 32, 'ingattt astaga\n', 11, '2021-06-07 00:27:01', 0),
(14, 32, 'hi\n', 12, '2021-06-07 01:08:56', 0),
(15, 32, 'yoooooooooooooo\n', 12, '2021-06-07 01:25:39', 0),
(16, 40, 'uihhhhhhh\n', 12, '2021-06-07 01:26:53', 0),
(17, 32, 'hi\n', 11, '2021-06-07 05:45:09', 0),
(18, 32, 'yooooo\n', 11, '2021-06-07 05:53:17', 0),
(19, 40, 'haluu\n', 11, '2021-06-07 05:53:33', 0),
(20, 41, 'Hi guys\n', 14, '2021-06-07 20:08:03', 0),
(21, 40, 'ui hiiii\n', 14, '2021-06-07 20:23:10', 0),
(22, 32, 'hiiiii\n', 14, '2021-06-07 20:24:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeID` int(11) NOT NULL,
  `likeOn` int(11) NOT NULL,
  `likeBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeID`, `likeOn`, `likeBy`) VALUES
(56, 57, 30);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `message` text NOT NULL,
  `messageTo` int(11) NOT NULL,
  `messageFrom` int(11) NOT NULL,
  `messageOn` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `message`, `messageTo`, `messageFrom`, `messageOn`, `status`) VALUES
(1, 'Hi', 31, 32, '2021-06-02 00:00:00', 0),
(2, 'Hello', 32, 31, '2021-06-02 00:00:00', 0),
(3, 'how are you?', 32, 31, '2021-06-02 00:00:00', 0),
(4, 'im\' good', 31, 32, '2021-06-02 00:00:00', 0),
(5, 'saranghaeyoooo\n', 32, 31, '2021-06-03 18:00:46', 0),
(6, 'uinah bossku\n', 31, 32, '2021-06-03 18:01:26', 0),
(7, 'hi\n', 32, 31, '2021-06-03 18:13:28', 0),
(8, 'kenapa bah kau berubah\n', 32, 31, '2021-06-03 18:13:44', 0),
(9, 'kaulah segalahnya\n', 32, 31, '2021-06-03 18:17:20', 0),
(10, 'iy a kamu juga\n', 31, 32, '2021-06-03 18:18:24', 0),
(11, 'hi tom\n', 33, 31, '2021-06-03 18:19:05', 0),
(12, 'hi miaw\n', 31, 33, '2021-06-03 18:22:15', 0),
(13, 'Hiiiii\n', 33, 31, '2021-06-03 18:32:04', 0),
(14, 'how are u\n', 32, 31, '2021-06-03 18:41:31', 0),
(15, 'hi\n', 31, 33, '2021-06-03 18:42:02', 0),
(16, 'yo wazzupppp\n', 33, 31, '2021-06-03 18:42:11', 0),
(17, 'ap kabo\n', 33, 31, '2021-06-03 18:44:00', 0),
(18, 'baik seja\n', 31, 33, '2021-06-03 18:44:11', 0),
(19, 'betul ker?\n', 33, 31, '2021-06-03 18:45:55', 0),
(20, 'betul ni tom?\n', 33, 31, '2021-06-03 18:48:06', 0),
(21, 'betullah wkwkkw\n', 31, 33, '2021-06-03 18:59:31', 0),
(22, 'astaga chiil bah\n', 31, 33, '2021-06-03 18:59:51', 0),
(23, 'tipulah\n', 33, 31, '2021-06-03 19:00:08', 0),
(24, 'manada\n', 31, 33, '2021-06-03 19:00:28', 0),
(25, 'tipuuuu\n', 33, 31, '2021-06-03 19:00:38', 0),
(26, 'hi\n', 40, 32, '2021-06-05 20:02:02', 0),
(27, 'hi tom\n', 33, 32, '2021-06-07 00:14:09', 0),
(28, 'hi\n', 32, 40, '2021-06-07 00:24:50', 0),
(29, 'Hiiiii\n', 40, 32, '2021-06-07 00:26:10', 0),
(30, 'astagaaaa\n', 32, 40, '2021-06-07 00:26:19', 0),
(31, 'tomm\n', 33, 32, '2021-06-07 00:26:40', 0),
(32, 'Hiii\n', 32, 41, '2021-06-07 18:19:13', 0),
(33, 'hiii moonie\n', 41, 32, '2021-06-07 18:21:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postID` int(11) NOT NULL,
  `status` text NOT NULL,
  `postBy` int(11) NOT NULL,
  `postImage` text NOT NULL,
  `postedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `postPrivacy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postID`, `status`, `postBy`, `postImage`, `postedOn`, `postPrivacy`) VALUES
(62, 'cuba dahh', 31, '', '2021-05-31 21:11:54', 0),
(63, 'aku sedang', 31, '', '2021-05-31 21:12:00', 0),
(64, 'bertanya', 31, '', '2021-05-31 21:12:04', 0),
(65, 'apa', 31, '', '2021-05-31 21:12:07', 0),
(66, 'bah', 31, '', '2021-05-31 21:12:10', 0),
(67, 'sy mo tanya', 31, '', '2021-05-31 21:12:17', 0),
(68, 'tapi ini smeua bauu', 31, '', '2021-05-31 21:12:25', 0),
(69, 'kemonlah', 31, '', '2021-05-31 21:12:30', 0),
(70, 'odoi dogo', 31, '', '2021-05-31 21:12:35', 0),
(71, 'vavie nokopio', 31, '', '2021-05-31 21:12:40', 0),
(72, 'tipu jak kau tu', 31, '', '2021-05-31 21:13:00', 0),
(73, 'kononlah', 31, '', '2021-05-31 21:13:04', 0),
(74, 'Cuba try testing post dulu bossku', 32, '', '2021-06-01 13:10:52', 0),
(75, 'babababababbaba', 32, '', '2021-06-01 13:29:09', 0),
(76, 'you know what', 32, '', '2021-06-01 13:29:15', 0),
(77, 'yesterday', 32, '', '2021-06-01 13:29:20', 0),
(78, 'i went to penampang', 32, '', '2021-06-01 13:29:26', 0),
(79, 'then i saw him omagoat', 32, '', '2021-06-01 13:29:36', 0),
(80, 'he\'s so damn amejing', 32, '', '2021-06-01 13:29:44', 0),
(81, 'kotigok my heart', 32, '', '2021-06-01 13:29:50', 0),
(82, 'almost faint yaw', 32, '', '2021-06-01 13:29:56', 0),
(83, 'but yeah what can he do he already taken', 32, '', '2021-06-01 13:30:16', 0),
(85, 'Hiii chuuu', 31, '', '2021-06-01 16:42:09', 0),
(86, 'Hii cintaaaa', 32, '', '2021-06-01 16:42:30', 0),
(87, 'Hi everyone, I\'m tom', 33, '', '2021-06-02 15:50:11', 0),
(88, 'hi saya tom apa khabar', 33, '', '2021-06-02 15:53:25', 0),
(90, 'hi', 32, '', '2021-06-04 22:21:35', 0),
(91, 'Hi everyone i\'m new here', 40, '', '2021-06-05 15:45:07', 0),
(92, 'Ice cream chillinnnnnn wrawww wrawww', 40, '', '2021-06-05 15:46:28', 0),
(96, 'hi pa kahabar', 40, '', '2021-06-05 16:03:37', 0),
(97, 'Uiiii haiiii astagaaa', 33, '', '2021-06-05 16:04:09', 0),
(98, 'uiii cuba lagi dah', 33, '', '2021-06-05 16:15:33', 0),
(99, 'This is a post  from Aoi Kuro.', 40, '', '2021-06-05 19:42:01', 0),
(100, 'This a second post.', 40, '', '2021-06-05 20:09:19', 0),
(101, 'Guys please visit this link : https://www.socialtables.com/blog/event-planning/event-company-names/', 32, '', '2021-06-07 13:59:34', 0),
(102, 'hiiiiiiiiii\n', 41, '', '2021-06-07 16:38:59', 0),
(104, 'hi', 41, '', '2021-06-07 16:44:45', 0),
(105, 'asdasdasd', 41, '', '2021-06-07 17:11:33', 1),
(106, 'wahhahahahahhahahhaha', 32, '', '2021-06-08 11:14:08', 1),
(107, 'wahhahahahahhahahhaha', 32, '', '2021-06-08 11:14:11', 1),
(108, 'hiiiii sy lagi', 40, '', '2021-06-08 14:26:28', 0),
(109, 'cuba try test', 32, '', '2021-06-08 14:55:16', 0),
(110, 'hiiii', 32, '', '2021-06-08 14:57:38', 0),
(111, 'x tolak y, y jatuh minta tolong', 32, '', '2021-06-08 14:59:17', 0),
(112, 'watermelon juices', 32, '', '2021-06-08 15:00:27', 0),
(113, 'testing', 32, '', '2021-06-08 16:11:19', 1),
(114, 'testing friend only', 32, '', '2021-06-08 16:18:07', 0),
(115, 'testing friend only again', 32, '', '2021-06-08 16:20:56', 0),
(116, 'testing lagi', 32, '', '2021-06-08 16:23:03', 0),
(117, 'asdasdasdas', 32, '', '2021-06-08 16:28:50', 0),
(118, 'testing', 32, '', '2021-06-08 16:33:00', 1),
(119, 'FRIEND ONLY', 32, '', '2021-06-08 16:34:01', 1),
(120, 'A WHOLE NEW WORLD', 32, '', '2021-06-08 16:34:22', 0),
(121, 'TEST BUTTON FRIEND ONLY', 32, '', '2021-06-08 16:34:54', 1),
(122, 'TEST BUTTON THE WHOLE WORLD', 32, '', '2021-06-08 16:35:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profileImage` varchar(255) NOT NULL,
  `profileCover` varchar(255) NOT NULL,
  `friend` int(11) NOT NULL,
  `bio` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT current_timestamp(),
  `profileEdit` enum('0','1') NOT NULL,
  `userStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstName`, `lastName`, `username`, `email`, `password`, `profileImage`, `profileCover`, `friend`, `bio`, `country`, `website`, `signUpDate`, `profileEdit`, `userStatus`) VALUES
(31, 'Jacinta', 'Justin', 'jacintajustin', 'jacellynjustinjuis@gmail.com', '$2y$10$DYwB8G8RIF/rNYaEr6zfa.4H93.TM/QoQX9C598gNoNnGQZgXVkh2', 'frontend/profileImage/userProfilePic31.png', 'frontend\\assets\\images\\backgroundCoverPic.svg', 0, '', '', '', '2021-05-31 21:07:28', '0', 0),
(32, 'Chuu', 'Ren', 'chuuren', 'renchuu24@gmail.com', '$2y$10$JsofVuZo6BdxdGEiwHemEOqKzBD6FMuMrKNH7mg.lcBxKCEQZ6lV.', 'frontend/profileImage/userProfilePic32.png', 'frontend\\assets\\images\\backgroundCoverPic.svg', 0, '', '', '', '2021-06-01 12:16:13', '0', 0),
(33, 'Tom', 'Holland', 'tomholland', 'tomholland@gmail.com', '$2y$10$tQGN54l6VauFrqrNqQnExeKAv4mMGcHW4uPikGyfwoG6B0zpruwcq', 'frontend/profileImage/userProfilePic33.png', 'frontend\\assets\\images\\backgroundCoverPic.svg', 0, '', '', '', '2021-06-02 15:49:01', '0', 0),
(37, 'Coconutpisang', 'Man', 'coconutpisangman', 'coconut@gmail.com', '$2y$10$LhZ4QL0drA8Zy5IbTe7wWuESqKq.8T9PROiesi4YHbC.1ZSAHfVw.', 'frontend/profileImage/userProfilePic37.png', 'frontend\\assets\\images\\backgroundCoverPic.svg', 0, '', '', '', '2021-06-05 12:35:53', '0', 0),
(39, 'Mike', 'Taylor', 'miketaylor', 'mike@gmail.com', '$2y$10$4mOLUWZOnTj6ovs5uIBXfObuA4JW0RnUcr.v2TxsXfDrLtiYfRutK', 'frontend\\assets\\images\\profilePic.jpeg', 'frontend\\assets\\images\\backgroundCoverPic.svg', 0, '', '', '', '2021-06-05 12:54:01', '0', 0),
(40, 'Aoi', 'Kuro', 'aoikuro', 'aoikuroneko1998@gmail.com', '$2y$10$cCxW1O1REalfku.XBHFu1ecvUMA2MUZO7MXTKc5HlrorKZt2x67BK', 'frontend\\assets\\images\\defaultProfilePic.png', 'frontend\\assets\\images\\backgroundCoverPic.svg', 0, '', '', '', '2021-06-05 15:12:24', '0', 0),
(41, 'Moonie pisang', 'Banana', 'moonie pisangbanana', '60983@siswa.unimas.my', '$2y$10$FM6r7Fmlh8nhwheZHUuO5.GSgbyTQ3wMy9ae4AbBanI/wFsHN02Ly', 'frontend\\assets\\images\\profilePic.jpeg', 'frontend\\assets\\images\\backgroundCoverPic.svg', 0, '', '', '', '2021-06-07 15:30:32', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `user_id`, `code`, `status`, `createdAt`) VALUES
(179, 31, '254514', '1', '2021-05-31 21:07:34'),
(180, 32, '990692', '1', '2021-06-01 12:16:17'),
(181, 33, '208176', '1', '2021-06-02 15:49:06'),
(182, 40, '985599', '1', '2021-06-05 15:12:29'),
(183, 40, '985599', '1', '2021-06-05 15:14:19'),
(184, 41, '581496', '1', '2021-06-07 15:30:37'),
(185, 41, '581496', '1', '2021-06-07 15:58:38'),
(186, 41, '581496', '1', '2021-06-07 16:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `views_id` int(11) NOT NULL,
  `views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`views_id`, `views_count`) VALUES
(1, 64);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `users_fk` (`eventBy`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`groupID`),
  ADD KEY `fk_foreign_group` (`groupCreatedBy`);

--
-- Indexes for table `groupmembers`
--
ALTER TABLE `groupmembers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `groupmessage`
--
ALTER TABLE `groupmessage`
  ADD PRIMARY KEY (`groupMessageID`),
  ADD KEY `user_id` (`groupMsgFrom`),
  ADD KEY `groupID` (`groupMsgTo`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `fk_foreign_post` (`postBy`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_verify` (`user_id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`views_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `groupmembers`
--
ALTER TABLE `groupmembers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `groupmessage`
--
ALTER TABLE `groupmessage`
  MODIFY `groupMessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `views_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `fk_foreign_group` FOREIGN KEY (`groupCreatedBy`) REFERENCES `users` (`User_id`) ON UPDATE CASCADE;

--
-- Constraints for table `groupmembers`
--
ALTER TABLE `groupmembers`
  ADD CONSTRAINT `group_id` FOREIGN KEY (`group_id`) REFERENCES `group` (`groupID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userID` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `groupmessage`
--
ALTER TABLE `groupmessage`
  ADD CONSTRAINT `groupID` FOREIGN KEY (`groupMsgTo`) REFERENCES `group` (`groupID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`groupMsgFrom`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_foreign_post` FOREIGN KEY (`postBy`) REFERENCES `users` (`User_id`) ON UPDATE CASCADE;

--
-- Constraints for table `verification`
--
ALTER TABLE `verification`
  ADD CONSTRAINT `fk_foreign_verify` FOREIGN KEY (`user_id`) REFERENCES `users` (`User_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
