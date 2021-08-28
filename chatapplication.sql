-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 28, 2021 at 12:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapplication`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `groupid` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `members` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `groupid`, `group_name`, `creator`, `members`, `avatar`, `creationdate`) VALUES
(1, '14804023901628159785610bbf29be080', 'Chess Virtuoso', '2051224492162685558060f7d89cbcb6f', 4, '15.svg', '2021-08-05 12:36:25'),
(2, '5998036171628159910610bbfa6e92eb', 'ComputerScience', '2051224492162685558060f7d89cbcb6f', 9, '11.svg', '2021-08-05 12:38:30'),
(3, '17011685781628159941610bbfc539b67', 'Music Geek', '2051224492162685558060f7d89cbcb6f', 5, '16.svg', '2021-08-05 12:39:01'),
(4, '211205068316284990596110ec73b98fb', 'Black_SHoe', '139299587116284978316110e7a7aff23', 6, '17.svg', '2021-08-09 10:50:59'),
(5, '4161656101629192298611b806ab4119', 'sd', '2051224492162685558060f7d89cbcb6f', 3, '1.svg', '2021-08-17 11:24:58'),
(6, '1797935323162995595361272771ccb8f', 'Kigali Chess', '2051224492162685558060f7d89cbcb6f', 5, 'pawner.svg', '2021-08-26 07:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `groupid` varchar(255) NOT NULL,
  `unique_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `groupid`, `unique_id`) VALUES
(1, '14804023901628159785610bbf29be080', 'evariste'),
(2, '14804023901628159785610bbf29be080', 'nicolasi'),
(3, '14804023901628159785610bbf29be080', 'Nicky'),
(4, '14804023901628159785610bbf29be080', 'danielerat'),
(5, '5998036171628159910610bbfa6e92eb', 'evariste'),
(6, '5998036171628159910610bbfa6e92eb', 'nicolasi'),
(7, '5998036171628159910610bbfa6e92eb', 'Nicky'),
(8, '5998036171628159910610bbfa6e92eb', 'Mumberto!1'),
(9, '5998036171628159910610bbfa6e92eb', 'carle'),
(10, '5998036171628159910610bbfa6e92eb', 'jonathan'),
(11, '5998036171628159910610bbfa6e92eb', 'olsunmining'),
(12, '5998036171628159910610bbfa6e92eb', 'james'),
(13, '5998036171628159910610bbfa6e92eb', 'danielerat'),
(14, '17011685781628159941610bbfc539b67', 'evariste'),
(15, '17011685781628159941610bbfc539b67', 'nicolasi'),
(16, '17011685781628159941610bbfc539b67', 'Mumberto!1'),
(17, '17011685781628159941610bbfc539b67', 'carle'),
(18, '17011685781628159941610bbfc539b67', 'danielerat'),
(19, '17011685781628159941610bbfc539b67', 'james'),
(20, '211205068316284990596110ec73b98fb', 'danielerat'),
(21, '211205068316284990596110ec73b98fb', 'evariste'),
(22, '211205068316284990596110ec73b98fb', 'nicolasi'),
(23, '211205068316284990596110ec73b98fb', 'olsunmining'),
(24, '211205068316284990596110ec73b98fb', 'james'),
(25, '211205068316284990596110ec73b98fb', 'madiba'),
(26, '4161656101629192298611b806ab4119', 'nicolasi'),
(27, '4161656101629192298611b806ab4119', 'madiba'),
(28, '4161656101629192298611b806ab4119', 'danielerat'),
(29, '1797935323162995595361272771ccb8f', 'nicolasi'),
(30, '1797935323162995595361272771ccb8f', 'madiba'),
(31, '1797935323162995595361272771ccb8f', 'james'),
(32, '1797935323162995595361272771ccb8f', 'carle'),
(33, '1797935323162995595361272771ccb8f', 'danielerat');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sent_by` varchar(255) NOT NULL,
  `sent_to` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `delivered` varchar(10) NOT NULL DEFAULT 'false',
  `text_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sent_by`, `sent_to`, `msg`, `delivered`, `text_time`) VALUES
(1, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'How Was it in the 19s When it comes to shopping ?.', 'true', '2021-07-21 09:26:20'),
(3, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'Well, When I was your age, I used to go to the market with two Hundred and bring home soap, rice, milk, bread, face powder etc. ', 'true', '2021-07-21 09:27:16'),
(4, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'Nowadays it is difficult. There are CCTV cameras everywhere.', 'true', '2021-07-21 09:27:33'),
(5, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'OMG , are you actually seious ! , this is the funniest thing Ever !', 'true', '2021-07-25 08:39:02'),
(6, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'Hey Grand Pa , are you there?', 'true', '2021-07-26 05:01:28'),
(7, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'Hello ?, Are You dead ? It\'s been a while that i haven\'t heard of your news ', 'true', '2021-07-26 05:29:22'),
(8, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'What !you son of a cabbage farmer ! i am not dead of course.', 'true', '2021-07-26 06:09:38'),
(9, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'danielerat', 'true', '2021-07-27 21:45:04'),
(10, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'how are you doing?\r\n', 'true', '2021-07-27 21:45:14'),
(11, '2051224492162685558060f7d89cbcb6f', '1343114919162685591560f7d9eb731d5', 'Hello nicolas how are you doing ?', 'true', '2021-07-27 21:48:56'),
(12, '2051224492162685558060f7d89cbcb6f', '1343114919162685591560f7d9eb731d5', 'you good man ?\r\n', 'true', '2021-07-27 21:49:04'),
(13, '2051224492162685558060f7d89cbcb6f', '1343114919162685591560f7d9eb731d5', 'Been a while bro', 'true', '2021-07-27 21:49:14'),
(14, '1343114919162685591560f7d9eb731d5', '2051224492162685558060f7d89cbcb6f', 'no bro , go to hell seriously', 'true', '2021-07-27 21:50:02'),
(16, '1343114919162685591560f7d9eb731d5', '2051224492162685558060f7d89cbcb6f', 'so you think me i do haha\r\nyou must be dumb', 'true', '2021-07-27 21:50:33'),
(17, '2051224492162685558060f7d89cbcb6f', '1343114919162685591560f7d9eb731d5', 'alright bye\r\n', 'true', '2021-07-27 21:50:44'),
(18, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'what is wrong with you ? \r\n', 'true', '2021-07-28 07:19:30'),
(19, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'bondia ', 'true', '2021-07-28 07:19:43'),
(20, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hallo', 'true', '2021-07-28 07:21:49'),
(21, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'testing the shit', 'true', '2021-07-28 07:23:26'),
(22, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'holly shit', 'true', '2021-07-28 07:25:48'),
(23, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'what is going on ', 'true', '2021-07-28 07:25:57'),
(24, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello world', 'true', '2021-07-28 07:26:44'),
(25, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'what is happening', 'true', '2021-07-28 07:27:29'),
(26, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'yes', 'true', '2021-07-28 07:27:42'),
(27, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'what', 'true', '2021-07-28 07:28:32'),
(28, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'telephone', 'true', '2021-07-28 07:28:55'),
(29, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'may the peace of the', 'true', '2021-07-28 07:36:21'),
(30, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'may the peace', 'true', '2021-07-28 07:36:34'),
(31, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'fridayy', 'true', '2021-07-28 07:36:48'),
(32, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'test', 'true', '2021-07-28 07:37:19'),
(33, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'testing my shit', 'true', '2021-07-28 07:37:54'),
(34, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'bonjour', 'true', '2021-07-28 07:38:15'),
(35, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello there , how are you doing ?\r\n', 'true', '2021-07-28 08:18:25'),
(36, '1343114919162685591560f7d9eb731d5', '2051224492162685558060f7d89cbcb6f', 'hello\r\n', 'true', '2021-07-28 08:21:58'),
(37, '1343114919162685591560f7d9eb731d5', '2051224492162685558060f7d89cbcb6f', 'how are you doing ?', 'true', '2021-07-28 08:22:04'),
(38, '2051224492162685558060f7d89cbcb6f', '1343114919162685591560f7d9eb731d5', 'what do you want man , i am broke man , please \r\n', 'true', '2021-07-28 08:22:16'),
(39, '1343114919162685591560f7d9eb731d5', '2051224492162685558060f7d89cbcb6f', 'no i do not want you money please ', 'true', '2021-07-28 08:22:40'),
(40, '867310657162714709660fc4b58c78bc', '2051224492162685558060f7d89cbcb6f', 'hello', 'true', '2021-07-29 20:59:37'),
(41, '867310657162714709660fc4b58c78bc', '2051224492162685558060f7d89cbcb6f', 'how are you doing?', 'true', '2021-07-29 20:59:42'),
(42, '2051224492162685558060f7d89cbcb6f', '867310657162714709660fc4b58c78bc', 'great', 'true', '2021-07-29 21:00:04'),
(43, '867310657162714709660fc4b58c78bc', '2051224492162685558060f7d89cbcb6f', 'so', 'true', '2021-07-29 21:00:11'),
(44, '2051224492162685558060f7d89cbcb6f', '867310657162714709660fc4b58c78bc', 'so what', 'true', '2021-07-29 21:00:15'),
(45, '867310657162714709660fc4b58c78bc', '2051224492162685558060f7d89cbcb6f', 'what are you even talking about man?', 'true', '2021-07-29 21:00:28'),
(46, '2051224492162685558060f7d89cbcb6f', '867310657162714709660fc4b58c78bc', 'what', 'true', '2021-07-29 21:00:35'),
(47, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello there', 'true', '2021-08-02 18:35:42'),
(48, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'what happened\r\n', 'true', '2021-08-04 22:48:45'),
(49, '2051224492162685558060f7d89cbcb6f', '586509744162714762660fc4d6ad05fc', 'hello the chess guru , how are you doing ?\r\n', 'true', '2021-08-04 23:08:00'),
(50, '2051224492162685558060f7d89cbcb6f', '586509744162714762660fc4d6ad05fc', 'I would really Like to learn chess\r\nwould you please teach me?', 'true', '2021-08-04 23:08:16'),
(51, '2051224492162685558060f7d89cbcb6f', '190952265162685602860f7da5c174c3', 'nicolas i', 'true', '2021-08-04 23:50:48'),
(52, '2051224492162685558060f7d89cbcb6f', '190952265162685602860f7da5c174c3', 'biko aye?', 'true', '2021-08-04 23:50:54'),
(53, '2051224492162685558060f7d89cbcb6f', '1056106161162791739061080c4ed29da', 'hello please how are you', 'true', '2021-08-05 00:02:16'),
(54, '2051224492162685558060f7d89cbcb6f', '605595234162791769961080d83e3ba2', 'this is the greek geek groupp', 'true', '2021-08-05 00:02:31'),
(55, '2051224492162685558060f7d89cbcb6f', '1056106161162791739061080c4ed29da', 'really , i don\'t think i am on the right place man', 'true', '2021-08-05 05:39:03'),
(56, '1124238672162685569160f7d90bc1c47', '1056106161162791739061080c4ed29da', 'daniel , are you drunk again ?', 'true', '2021-08-05 05:42:08'),
(57, '1124238672162685569160f7d90bc1c47', '1056106161162791739061080c4ed29da', 'what are you trying to talk about ?', 'true', '2021-08-05 05:42:39'),
(58, '2051224492162685558060f7d89cbcb6f', '1056106161162791739061080c4ed29da', 'hahha , never mind\r\n', 'true', '2021-08-05 05:42:50'),
(59, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello \r\n', 'true', '2021-08-05 09:07:01'),
(60, '1124238672162685569160f7d90bc1c47', '17011685781628159941610bbfc539b67', '<b>Fade To Black -Metallica </b>\r\nLife, it seems, will fade away\r\nDrifting further, every day\r\nGetting lost within myself\r\nNothing matters, no one else\r\nI have lost the will to live\r\nSimply nothing more to give\r\nThere is nothing more for me\r\nNeed the end to set me free\r\nThings not what they used to be\r\nMissing one inside of me\r\nDeathly loss, this can\'t be real\r\nI cannot stand this hell I feel\r\nEmptiness is filling me\r\nTo the point of agony\r\nGrowing darkness, taking dawn\r\nI was me, but now he\'s gone\r\nNo one but me\r\nCan save myself\r\nBut it\'s too late\r\nNow I can\'t think\r\nThink why I should even try', 'true', '2021-08-05 10:42:27'),
(61, '2051224492162685558060f7d89cbcb6f', '17011685781628159941610bbfc539b67', 'Damn , So great , How About This one , \r\n\r\n', 'true', '2021-08-05 10:53:53'),
(62, '2051224492162685558060f7d89cbcb6f', '17011685781628159941610bbfc539b67', '<b>Sam Smith - Pray </b>\r\nI\'m young and I\'m foolish, I\'ve made bad decisions\r\nI block out the news, turn my back on religion\r\nDon\'t have no degree, I\'m somewhat naïve\r\nI\'ve made it this far on my own\r\nBut lately, that shit ain\'t been gettin\' me higher\r\nI lift up my head and the world is on fire\r\nThere\'s dread in my heart and fear in my bones\r\nAnd I just don\'t know what to say\r\nMaybe I\'ll pray, pray\r\nMaybe I\'ll pray\r\nI have never believed in you, no\r\nBut I\'m gonna pray\r\nYou won\'t find me in church (no) reading the Bible (no)\r\nI am still here and I\'m still your disciple\r\nI\'m down on my knees, I\'m beggin\' you, please\r\nI\'m broken, alone, and afraid\r\nI\'m not a saint, I\'m more of a sinner\r\nI don\'t wanna lose, but I fear for the winners\r\nWhen I tried to explain, the words ran away\r\nThat\'s why I am stood here today\r\nAnd I\'m gonna pray (Lord)\r\nPray (Lord), maybe I\'ll pray\r\nPray for a glimmer of hope\r\nMaybe I\'ll pray (Lord), pray (Lord), maybe I\'ll pray\r\nI\'ve never believed in you, no, but I\'m gonna\r\n', 'true', '2021-08-05 10:53:57'),
(63, '1447413916162762730461039f28998a5', '17011685781628159941610bbfc539b67', 'Damn, I think i like more the second one ! \r\n', 'true', '2021-08-05 10:58:49'),
(64, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hi', 'true', '2021-08-05 11:48:33'),
(65, '867310657162714709660fc4b58c78bc', '1343114919162685591560f7d9eb731d5', 'hey nigga\r\n', 'true', '2021-08-06 15:49:23'),
(66, '867310657162714709660fc4b58c78bc', '1124238672162685569160f7d90bc1c47', 'evariste stop your jokes man', 'true', '2021-08-06 15:49:50'),
(67, '867310657162714709660fc4b58c78bc', '285161929162714797160fc4ec336e24', 'Man, you really Look Like Freddie mercury, like so bad ! \r\n', 'true', '2021-08-06 15:52:21'),
(68, '2051224492162685558060f7d89cbcb6f', '1447413916162762730461039f28998a5', 'Hello James \r\nhow are you doing ? ', 'true', '2021-08-07 16:31:05'),
(69, '2051224492162685558060f7d89cbcb6f', '1447413916162762730461039f28998a5', 'hello there', 'true', '2021-08-07 16:33:35'),
(70, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'bla bla la', 'true', '2021-08-07 16:38:38'),
(71, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'we\r\n', 'true', '2021-08-07 16:57:19'),
(72, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'bite sha , umezute ? ', 'true', '2021-08-07 16:57:25'),
(73, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'ndabizi c ?', 'true', '2021-08-07 16:57:33'),
(74, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'hahahhha\r\ntoka', 'true', '2021-08-07 16:57:40'),
(75, '2051224492162685558060f7d89cbcb6f', '17011685781628159941610bbfc539b67', 'testing\r\n', 'true', '2021-08-09 07:51:41'),
(76, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'hello', 'true', '2021-08-09 08:20:02'),
(77, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'how are you doing today', 'true', '2021-08-09 08:20:10'),
(79, '1124238672162685569160f7d90bc1c47', '14804023901628159785610bbf29be080', 'hello\r\n', 'true', '2021-08-09 08:21:55'),
(80, '1124238672162685569160f7d90bc1c47', '5998036171628159910610bbfa6e92eb', 'is this computer', 'true', '2021-08-09 08:22:06'),
(81, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'bite sha', 'true', '2021-08-09 08:23:28'),
(82, '2051224492162685558060f7d89cbcb6f', '139299587116284978316110e7a7aff23', 'mumbere', 'true', '2021-08-09 08:31:37'),
(83, '139299587116284978316110e7a7aff23', '2051224492162685558060f7d89cbcb6f', 'musa bite', 'true', '2021-08-09 08:35:44'),
(85, '139299587116284978316110e7a7aff23', '1124238672162685569160f7d90bc1c47', 'daniel , ambgiye bite,', 'true', '2021-08-09 08:40:59'),
(86, '2051224492162685558060f7d89cbcb6f', '211205068316284990596110ec73b98fb', 'ziriya ngweto zirihe ra ?', 'true', '2021-08-09 08:51:26'),
(87, '139299587116284978316110e7a7aff23', '2051224492162685558060f7d89cbcb6f', 'yo man ', 'true', '2021-08-09 13:52:18'),
(88, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'musa , hey', 'true', '2021-08-09 13:52:52'),
(89, '1124238672162685569160f7d90bc1c47', '1343114919162685591560f7d9eb731d5', 'hey , first tiext', 'true', '2021-08-09 13:53:51'),
(90, '2051224492162685558060f7d89cbcb6f', '139299587116284978316110e7a7aff23', 'nobody knows', 'true', '2021-08-09 13:57:58'),
(91, '2051224492162685558060f7d89cbcb6f', '1447413916162762730461039f28998a5', 'last message for sure', 'true', '2021-08-09 14:05:22'),
(92, '2051224492162685558060f7d89cbcb6f', '1343114919162685591560f7d9eb731d5', 'very last of them all', 'true', '2021-08-09 14:19:47'),
(93, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'this is the last noneho', 'true', '2021-08-09 14:21:24'),
(94, '1124238672162685569160f7d90bc1c47', '139299587116284978316110e7a7aff23', 'who are you man ', 'true', '2021-08-09 14:21:38'),
(95, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'who are we', 'true', '2021-08-09 14:23:32'),
(96, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'we are who we want to be', 'true', '2021-08-09 14:23:45'),
(97, '1124238672162685569160f7d90bc1c47', '1447413916162762730461039f28998a5', 'daniel said who are we !', 'true', '2021-08-09 14:24:02'),
(98, '2051224492162685558060f7d89cbcb6f', '1815812960162685631160f7db77691d5', 'Hello Carlos , how are you doing?', 'true', '2021-08-10 13:11:26'),
(99, '2051224492162685558060f7d89cbcb6f', '1447413916162762730461039f28998a5', 'hey you', 'true', '2021-08-10 13:15:41'),
(100, '1447413916162762730461039f28998a5', '2051224492162685558060f7d89cbcb6f', 'how are you doing ?', 'true', '2021-08-10 13:15:52'),
(101, '1447413916162762730461039f28998a5', '2051224492162685558060f7d89cbcb6f', 'i am fine how abour you ', 'true', '2021-08-10 13:16:20'),
(102, '1447413916162762730461039f28998a5', '2051224492162685558060f7d89cbcb6f', 'i am cool too', 'true', '2021-08-10 13:16:25'),
(103, '2051224492162685558060f7d89cbcb6f', '1447413916162762730461039f28998a5', 'alright , happy that you are fine', 'true', '2021-08-10 13:16:37'),
(104, '2051224492162685558060f7d89cbcb6f', '1447413916162762730461039f28998a5', 'paprica', 'true', '2021-08-10 13:26:34'),
(105, '1447413916162762730461039f28998a5', '2051224492162685558060f7d89cbcb6f', 'papa where are you', 'true', '2021-08-10 13:30:30'),
(106, '1447413916162762730461039f28998a5', '2051224492162685558060f7d89cbcb6f', 'hello there', 'true', '2021-08-10 13:36:01'),
(107, '2051224492162685558060f7d89cbcb6f', '1447413916162762730461039f28998a5', 'so you are here with me ?', 'true', '2021-08-10 13:36:26'),
(109, '1447413916162762730461039f28998a5', '2051224492162685558060f7d89cbcb6f', 'or you are not', 'true', '2021-08-10 13:36:54'),
(110, '1447413916162762730461039f28998a5', '2051224492162685558060f7d89cbcb6f', 'adfsadf', 'true', '2021-08-10 13:36:59'),
(111, '1447413916162762730461039f28998a5', '2051224492162685558060f7d89cbcb6f', 'i think you slept', 'true', '2021-08-10 13:37:10'),
(112, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'hey you\r\n', 'true', '2021-08-10 16:52:29'),
(113, '1124238672162685569160f7d90bc1c47', '867310657162714709660fc4b58c78bc', 'hey carlos', 'false', '2021-08-10 16:53:29'),
(114, '867310657162714709660fc4b58c78bc', '2051224492162685558060f7d89cbcb6f', 'this is just a test you know ', 'true', '2021-08-10 16:54:24'),
(115, '2051224492162685558060f7d89cbcb6f', '867310657162714709660fc4b58c78bc', 'i know that it is just  atest bro\r\n', 'false', '2021-08-10 16:55:05'),
(116, '1124238672162685569160f7d90bc1c47', '867310657162714709660fc4b58c78bc', 'badge for messages', 'false', '2021-08-10 16:55:46'),
(117, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'badge for messages\r\n', 'true', '2021-08-10 16:56:34'),
(118, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'bite man ', 'true', '2021-08-11 12:05:36'),
(121, '2051224492162685558060f7d89cbcb6f', '17011685781628159941610bbfc539b67', 'fasdfdff\r\ndfa\r\ndf', 'false', '2021-08-12 11:38:42'),
(122, '2051224492162685558060f7d89cbcb6f', '17011685781628159941610bbfc539b67', 'hello\r\n', 'false', '2021-08-12 12:24:07'),
(123, '2051224492162685558060f7d89cbcb6f', '17011685781628159941610bbfc539b67', 'testing the sending', 'false', '2021-08-12 12:24:15'),
(124, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello there', 'true', '2021-08-12 12:42:05'),
(125, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'how are you ', 'true', '2021-08-12 12:42:17'),
(126, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello ', 'true', '2021-08-12 13:12:34'),
(127, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello', 'true', '2021-08-12 13:12:51'),
(128, '2051224492162685558060f7d89cbcb6f', '17011685781628159941610bbfc539b67', 'hello there', 'false', '2021-08-12 13:13:43'),
(129, '2051224492162685558060f7d89cbcb6f', '17011685781628159941610bbfc539b67', 'testing if wwfjwiefjif', 'false', '2021-08-17 15:51:23'),
(130, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello ', 'true', '2021-08-25 14:29:08'),
(131, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'how are you doing ?', 'true', '2021-08-25 14:29:20'),
(132, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello\r\n', 'true', '2021-08-25 14:58:39'),
(133, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'heello', 'true', '2021-08-25 14:58:43'),
(134, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'fdfadfd', 'true', '2021-08-25 15:22:21'),
(135, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hefewfe', 'true', '2021-08-25 15:22:26'),
(136, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'bite', 'true', '2021-08-25 15:22:33'),
(137, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'hello', 'true', '2021-08-25 19:24:24'),
(138, '2051224492162685558060f7d89cbcb6f', '1124238672162685569160f7d90bc1c47', 'how are you doing', 'true', '2021-08-25 19:24:34'),
(139, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'hey', 'true', '2021-08-25 19:44:24'),
(140, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'bonjourno', 'true', '2021-08-25 19:45:55'),
(141, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'paris', 'true', '2021-08-25 19:46:11'),
(142, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'pris', 'true', '2021-08-25 19:46:33'),
(143, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'without', 'true', '2021-08-25 19:46:37'),
(144, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'me', 'true', '2021-08-25 19:46:40'),
(145, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'petir', 'true', '2021-08-25 19:47:45'),
(146, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'nite', 'true', '2021-08-25 19:47:52'),
(147, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'uko', 'true', '2021-08-25 19:47:58'),
(148, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'bonjour', 'true', '2021-08-25 19:48:34'),
(149, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'hello there', 'true', '2021-08-25 19:53:33'),
(155, '1124238672162685569160f7d90bc1c47', '2051224492162685558060f7d89cbcb6f', 'Fade To Black -Metallica Life, it seems, will fade away Drifting further, every day Getting lost within myself Nothing matters, no one else I have lost the will to live Simply nothing more to give There is nothing more for me Need the end to set me free Things not what they used to be Missing one inside of me Deathly loss, this can\'t be real I cannot stand this hell I feel Emptiness is filling me To the point of agony Growing darkness, taking dawn I was me, but now he\'s gone No one but me Can save myself But it\'s too late Now I can\'t think Think why I should even try', 'true', '2021-08-25 22:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `online_status`
--

CREATE TABLE `online_status` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `last_login` varchar(250) NOT NULL,
  `online_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `online_status`
--

INSERT INTO `online_status` (`id`, `user_id`, `last_login`, `online_status`) VALUES
(2, '2051224492162685558060f7d89cbcb6f', '28 August 2021 11:37:41', 'true'),
(3, '1124238672162685569160f7d90bc1c47', '26 August 2021 06:38:21', 'true'),
(4, '1343114919162685591560f7d9eb731d5', '06 August 2021 16:43:03', 'false'),
(5, '190952265162685602860f7da5c174c3', '26 July 2021 10:42:43', 'true'),
(6, '1815812960162685631160f7db77691d5', '26 July 2021 10:42:49', 'false'),
(7, '867310657162714709660fc4b58c78bc', '10 August 2021 18:54:31', 'false'),
(8, '586509744162714762660fc4d6ad05fc', '26 July 2021 1:42:43', 'false'),
(9, '285161929162714797160fc4ec336e24', '26 July 2021 20:2:43', 'false'),
(10, '1447413916162762730461039f28998a5', '10 August 2021 18:51:38', 'false'),
(11, '139299587116284978316110e7a7aff23', '09 August 2021 15:52:24', 'false'),
(12, '36278080162995690561272b299fa35', '000000', 'false'),
(13, '1068532639162995702861272ba41b7c5', '000000', 'false'),
(14, '1098700369162995731661272cc4e05fa', '000000', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `theme` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `username`, `theme`) VALUES
(1, 'danielerat', 2),
(2, 'evariste', 1),
(3, 'nicolasi', 1),
(4, 'Nicky', 1),
(5, 'Mumberto!1', 1),
(6, 'carle', 1),
(7, 'jonathan', 1),
(8, 'olsunmining', 1),
(9, 'james', 1),
(10, 'madiba', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `first_name`, `last_name`, `username`, `email`, `hashed_password`, `avatar`) VALUES
(1, '2051224492162685558060f7d89cbcb6f', 'Daniel', 'Gisa Ilunga', 'danielerat', 'danielerat45@gmail.com', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '9.svg'),
(2, '1124238672162685569160f7d90bc1c47', 'Evariste', 'Twisenge', 'evariste', 'evaristetheman@gmail.com', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '12.svg'),
(3, '1343114919162685591560f7d9eb731d5', 'Ange', 'Uberewe', 'angella', 'nicolasi@nicolas.com', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '13.svg'),
(4, '190952265162685602860f7da5c174c3', 'Nicole', 'Bigir', 'Nicky', 'Nikcy@nick.com', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '2.svg'),
(5, '1815812960162685631160f7db77691d5', 'Mumberto', 'Carlos', 'Mumberto!1', 'dadada@dada.dada', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '6.svg'),
(6, '867310657162714709660fc4b58c78bc', 'Mumberto', 'Carlos', 'carle', 'carle1@gmail.com', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '1.svg'),
(7, '586509744162714762660fc4d6ad05fc', 'chess', 'Guru', 'jonathan', 'chess@guru.com', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '8.svg'),
(8, '285161929162714797160fc4ec336e24', 'olsun', 'Mining', 'olsunmining', 'olsunmining@olsun.com', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '1.svg'),
(9, '1447413916162762730461039f28998a5', 'james', 'Blunt', 'james', 'jamesblunt@blunt.com', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '14.svg'),
(10, '139299587116284978316110e7a7aff23', 'safi', 'MADIBA', 'madiba', 'safi@safi.com', '$2y$10$lz5ECgxqQUDbbVT0bh0Iz.9s/dVgM7dhr4woQ/5Hoa70kp794R8eW', '4.svg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `user_identification` (`sent_by`);

--
-- Indexes for table `online_status`
--
ALTER TABLE `online_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `unique_id` (`unique_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `online_status`
--
ALTER TABLE `online_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `user_identification` FOREIGN KEY (`sent_by`) REFERENCES `users` (`unique_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
