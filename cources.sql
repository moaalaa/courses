-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2016 at 11:43 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cources`
--
CREATE DATABASE IF NOT EXISTS `cources` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cources`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL COMMENT 'this is admin id',
  `frist_name` varchar(100) NOT NULL COMMENT 'this is the admin frist name',
  `last_name` varchar(100) NOT NULL COMMENT 'this is the admin last name',
  `user_name` varchar(250) NOT NULL COMMENT 'this is the admin username',
  `password` varchar(82) NOT NULL COMMENT 'password',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `img` varchar(250) NOT NULL COMMENT 'Admin Image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `frist_name`, `last_name`, `user_name`, `password`, `email`, `img`) VALUES
(1, 'hamza', 'mohamed', 'hamzaomar', 'darkman1992', 'hamza@live.com', '13558927_10206424083578635_6021589863807057415_o.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `ArtID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `Image` varchar(150) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cat_id` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`ArtID`, `Title`, `content`, `Image`, `Time`, `cat_id`, `AdminID`) VALUES
(28, 'Create an Exceptional Customer Journey ', 'Each and every day we take journeys. We embark on customer journeys in both the physical and digital worlds. Years ago our journeys were limited to store fronts and physical goods. Today we live in a multimedia world of websites, social media, chat sessions, newsletters, email, and call centers. These digital journeys have changed the way we interact with companies and products. Last week I decided I was going to try shopping at a new grocery store. I was on my way home from the ortho ..', 'create_an.PNG', '2016-08-07 17:46:57', 11, 1),
(29, 'Buying a Website is Like Buying a Car, But Worse', 'You walk into a car dealership with high hopes of purchasing a new vehicle. The dealership you picked is an amazing store that comes highly recommended and sells everything from economical Ford and GM cars, trucks, and minivans to luxury brands like Jaguar, Infiniti, and Ferrari. Everything under one roof! What could be better? As you walk through the door, you approach the salesperson and ask him or her to provide you a quick quote on a new vehicle. It’s a realistic request right? No not ...', 'buyingAcar.PNG', '2016-08-07 15:50:26', 13, 1),
(30, 'A Peek Inside Our Recent Website Redesign', 'If I said it has been a busy couple of months inside of Web Savvy Marketing, it would be an understatement at best. While summer is traditionally our slow period, we started a website redesign  and it has been a major undertaking for me and my team. I never do anything half way and this website redesign is a perfect example of my inability to go “minor” in anything I do. Add in the fact that there are client websites builds to manage and it’s summer in Michigan and well, I feel like I’ve been ...\r\n', 'A_peek_inside.PNG', '2016-08-07 15:50:26', 10, 1),
(31, 'Say Goodbye to the Fold & Say Hello to a Posit', 'Each and every day we take journeys. We embark on customer journeys in both the physical and digital worlds. Years ago our journeys were limited to store fronts and physical goods. Today we live in a multimedia world of websites, social media, chat sessions, newsletters, email, and call centers. These digital journeys have changed the way we interact with companies and products. Last week I decided I was going to try shopping at a new grocery store. I was on my way home from the ortho ..', 'fold.PNG', '2016-08-07 15:53:12', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categoury`
--

CREATE TABLE `categoury` (
  `cat_id` int(11) NOT NULL COMMENT 'the cat id',
  `name` varchar(50) NOT NULL COMMENT 'the cat name',
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'added time',
  `AdminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoury`
--

INSERT INTO `categoury` (`cat_id`, `name`, `date_time`, `AdminID`) VALUES
(10, 'web Developmenty', '2016-08-23 09:19:29', 1),
(11, 'Web Design', '2016-07-27 20:43:56', 1),
(13, 'Mobile App', '2016-07-27 20:43:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ContactID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `subject` varchar(100) NOT NULL,
  `massge` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ContactID`, `name`, `email`, `subject`, `massge`) VALUES
(1, 'mohamed alaa', 'mohamed_naser95@hotmail.com', 'web design', 'We Are The Holol Training Team, The Team Consists Of (Hamza, Alaa, Zayed, Mahmoud)\r\n\r\nPhoneNumber: 01127946754\r\nAdress: AinShams, Cairo'),
(2, 'mohamed alaa', 'zayedzayed709@yahoo.com', 'web design', 'We Are The Holol Training Team, The Team Consists Of (Hamza, Alaa, Zayed, Mahmoud)We Are The Holol Training Team, The Team Consists Of (Hamza, Alaa, Zayed, Mahmoud)We Are The Holol Training Team, The Team Consists Of (Hamza, Alaa, Zayed, Mahmoud)We Are The Holol '),
(3, 'Mohamed Zayed', 'zayedzayed709@yahoo.com', 'web design', 'The Masterstudy Education Center is complete and an integral part of Local Education in Washington!\r\n\r\nThe Masterstudy Education Center is complete and an integral part of Local Education in Washington!\r\n\r\n'),
(4, 'Mohamed Zayed', 'zayedzayed709@yahoo.com', 'web design', 'The Masterstudy Education Center is complete and an integral part of Local Education in Washington!\r\n\r\nThe Masterstudy Education Center is complete and an integral part of Local Education in Washington!\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `cources`
--

CREATE TABLE `cources` (
  `CourceID` int(11) NOT NULL COMMENT 'The Cource id',
  `Name` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Hours` int(11) NOT NULL,
  `Image` varchar(150) NOT NULL,
  `Describtion` text NOT NULL,
  `Seats` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cources`
--

INSERT INTO `cources` (`CourceID`, `Name`, `Price`, `Hours`, `Image`, `Describtion`, `Seats`, `cat_id`, `AdminID`) VALUES
(21, 'HTML', 200, 50, 'html.png', 'This course introduces students to basic web design using HTML (Hypertext Markup Language) and CSS (Cascading Style Sheets). The course does not require any prior knowledge of HTML or web design. Throughout the course students are introduced to planning and designing effective web pages; implementing web pages by writing HTML and CSS code; enhancing web pages with the use of page layout techniques, text formatting, graphics, images, and multimedia; and producing a functional, multi-page website.', 45, 11, 1),
(22, 'PHP', 300, 82, 'php1.jpg', 'This course introduces students to basic web design using HTML (Hypertext Markup Language) and CSS (Cascading Style Sheets). The course does not require any prior knowledge of HTML or web design. Throughout the course students are introduced to planning and designing effective web pages; implementing web pages by writing HTML and CSS code; enhancing web pages with the use of page layout techniques, text formatting, graphics, images, and multimedia; and producing a functional, multi-page website.', 12, 10, 1),
(23, 'web Design', 250, 40, 'webDesign.jpg', 'This course introduces students to basic web design using HTML (Hypertext Markup Language) and CSS (Cascading Style Sheets). The course does not require any prior knowledge of HTML or web design. Throughout the course students are introduced to planning and designing effective web pages; implementing web pages by writing HTML and CSS code; enhancing web pages with the use of page layout techniques, text formatting, graphics, images, and multimedia; and producing a functional, multi-page website.', 12, 11, 1),
(24, 'java', 200, 35, 'java.png', 'This course introduces students to basic web design using HTML (Hypertext Markup Language) and CSS (Cascading Style Sheets). The course does not require any prior knowledge of HTML or web design. Throughout the course students are introduced to planning and designing effective web pages; implementing web pages by writing HTML and CSS code; enhancing web pages with the use of page layout techniques, text formatting, graphics, images, and multimedia; and producing a functional, multi-page website.', 12, 13, 1),
(25, 'Android ', 300, 35, 'android.png', 'This course introduces students to basic web design using HTML (Hypertext Markup Language) and CSS (Cascading Style Sheets). The course does not require any prior knowledge of HTML or web design. Throughout the course students are introduced to planning and designing effective web pages; implementing web pages by writing HTML and CSS code; enhancing web pages with the use of page layout techniques, text formatting, graphics, images, and multimedia; and producing a functional, multi-page website.', 5, 13, 1),
(26, 'asp.Net', 200, 42, 'asp.net2.jpg', 'This course introduces students to basic web design using HTML (Hypertext Markup Language) and CSS (Cascading Style Sheets). The course does not require any prior knowledge of HTML or web design. Throughout the course students are introduced to planning and designing effective web pages; implementing web pages by writing HTML and CSS code; enhancing web pages with the use of page layout techniques, text formatting, graphics, images, and multimedia; and producing a functional, multi-page website.', 10, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `onlinecources`
--

CREATE TABLE `onlinecources` (
  `OCourceID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Instructor` varchar(100) NOT NULL,
  `Date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `course_img` varchar(500) NOT NULL,
  `Links` varchar(500) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `onlinecources`
--

INSERT INTO `onlinecources` (`OCourceID`, `Name`, `Description`, `Instructor`, `Date_time`, `course_img`, `Links`, `cat_id`, `AdminID`) VALUES
(1, '[ PHP Examples In Arabic ] Deal With Checkboxes Insert With PHP ', 'If you want to take your website to the next level, the ability to incorporate interactivity is a must.    But adding some of these types of capabilities requires a stronger programming language than mobile app or android, and JavaScript can provide just what you need.  With just a basic understanding of the language, you can create a page that will react to common events such as page loads, mouse clicks & movements, and even keyboard input.      ', 'Osama EL zero', '2016-08-07 19:33:28', 'asp.net2.jpg', '<iframe width="560" height="315" src="https://www.youtube.com/embed/-u9_T_CLZHY?list=PLDoPjvoNmBAzH72MTPuAAaYfReraNlQgM" frameborder="0" allowfullscreen></iframe>', 10, 1),
(2, '[ Arabic ] Virtualization Install Multiple OS On The Same Machine', 'diploma for web development you should have a general background in using a computer, managing files, and a basic knowledge of the Internet. Students should also be able to navigate to and within a website using a web browser such as Chrome, Firefox, Internet Explorer, or Safari. Students do not need to purchase any software for this course.', 'Jason David', '2016-08-01 22:03:09', 'php2.jpg', '<iframe width="560" height="315" src="https://www.youtube.com/embed/r7IxZzX9J8k" frameborder="0" allowfullscreen></iframe>', 10, 1),
(3, 'Insert Checkbox values in Database using Ajax, Jquery in PHP ', 'The instructor helped my son learn how to independently complete the course successfully. She gave helpful and timely feedback and guidance to me and my son. By the end of the course, my son was corresponding with the instructor and managing the course all on his own-- what a great skill to learn above and beyond material she helped him through, which he loved.', 'Osama El zero', '2016-08-01 22:03:14', 'php1.jpg', '<iframe width="560" height="315" src="https://www.youtube.com/embed/3bUodTUDvTY?list=PLDoPjvoNmBAzH72MTPuAAaYfReraNlQgM" frameborder="0" allowfullscreen></iframe>', 11, 1),
(4, 'Laravel 5.2 PHP - Build a Shopping Cart - #11 Stripe Credit Card Verification', 'professional java diploma for mobile application ', 'Abdalla Eid', '2016-08-01 22:11:05', 'php_code.jpg', '<iframe width="560" height="315" src="https://www.youtube.com/embed/fUlq0xlzxgA?list=PLDoPjvoNmBAzH72MTPuAAaYfReraNlQgM" frameborder="0" allowfullscreen></iframe>', 13, 1),
(5, '[ Learn PHP 5 In Arabic ] #06 - Variables', 'Students should have a general background in using a computer, managing files, and a basic knowledge of the Internet. Students should also be able to navigate to and within a website using a web browser such as Chrome, Firefox, Internet Explorer, or Safari. Students do not need to purchase any software for this course.', 'Amjad Ali', '2016-08-01 22:03:30', 'php2.jpg', '<iframe width="560" height="315" src="https://www.youtube.com/embed/seUI9Fpqf8Q?list=PLDoPjvoNmBAzH72MTPuAAaYfReraNlQgM" frameborder="0" allowfullscreen></iframe>', 13, 1),
(6, '[ Learn PHP 5 In Arabic ] #02 - What I Need', 'This course introduces students to basic web design using HTML (Hypertext Markup Language) and CSS (Cascading Style Sheets). The course does not require any prior knowledge of HTML or web design. Throughout the course students are introduced to planning and designing effective web pages; implementing web pages by writing HTML and CSS code; enhancing web pages with the use of page layout techniques, text formatting, graphics, images, and multimedia; and producing a functional, multi-page website.', 'Mohamed El Kofy', '2016-08-07 19:32:51', 'asp.net2.jpg', '<iframe width="560" height="315" src="https://www.youtube.com/embed/vsXpy4aUbZA?list=PLDoPjvoNmBAzH72MTPuAAaYfReraNlQgM" frameborder="0" allowfullscreen></iframe>', 11, 1),
(7, 'Java Tutorial ', 'Java Tutorial For Beginners 1 - Introduction and Installing the java (JDK) Step by Step Tutorial', 'Jon smith', '2016-08-07 19:30:53', 'java.png', '<iframe width="560" height="315" src="https://www.youtube.com/embed/r59xYe3Vyks?list=PLS1QulWo1RIbfTjQvTdj8Y6yyq4R7g-Al" frameborder="0" allowfullscreen></iframe>', 13, 1),
(8, 'Android Development ', 'Android Development - 1 - Installing Android Studio\r\n', 'Justin Rolly', '2016-08-01 22:05:09', 'php_code.jpg', '<iframe width="560" height="315" src="https://www.youtube.com/embed/bJ_2_AQboc0?list=PLc7fMPfZwlVjb9N5jOyqI73nlJ_ETXpER" frameborder="0" allowfullscreen></iframe>', 10, 1),
(9, 'eCommerce Website', 'eCommerce Website In Arabic #119 - Make Sub Categories + Ideas Part 3', 'Jason ', '2016-08-01 22:05:19', 'php2.jpg', '<iframe width="560" height="315" src="https://www.youtube.com/embed/hYOlidgcuks" frameborder="0" allowfullscreen></iframe>', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registered_courses`
--

CREATE TABLE `registered_courses` (
  `Reg_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `CourceID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registered_courses`
--

INSERT INTO `registered_courses` (`Reg_ID`, `Date`, `CourceID`, `UserID`) VALUES
(1, '0000-00-00', 24, 8),
(2, '0000-00-00', 24, 8),
(3, '0000-00-00', 22, 8),
(4, '0000-00-00', 21, 6),
(5, '0000-00-00', 21, 7),
(6, '0000-00-00', 21, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'this is user id',
  `frist_name` varchar(100) NOT NULL COMMENT 'this is the user frist name',
  `last_name` varchar(100) NOT NULL COMMENT 'this is the user last name',
  `user_name` varchar(250) NOT NULL COMMENT 'this is the user username',
  `password` varchar(82) NOT NULL COMMENT 'password',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `img` varchar(250) NOT NULL COMMENT 'user Image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `frist_name`, `last_name`, `user_name`, `password`, `email`, `img`) VALUES
(6, 'alaa', 'eldin', 'alaa_dragneel', '123', 'moaalaa@yahoo.com', 'doc3.jpg'),
(7, 'alaa', 'aaaa', 'ahmed', '123', 'aaa@xxx.com', '480px-Des.png'),
(8, 'omar', 'hamza', 'hamza', 'darkman1992', 'omar@hamza.com', '13558927_10206424083578635_6021589863807057415_o.jpg'),
(12, 'alaa', 'zayed', 'hamzaOmar', '123', 'aaa@xxx.com', '357b4495f6fc8d9717e0db95c1e3be9e.jpg'),
(14, 'alaa', 'hamza', 'zayed', 'ssssss', 'aaa@xxx.com', '1044_1092643174092349_1756376243938499730_n.jpg'),
(19, 'ahmed', 'nour', 'nurAhmed', '123', 'ahmed@live.com', 'hk.jpg'),
(20, '    ', '    ', '015547', '111', 'hamza_omar@Live.com', 'pic2.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `users_cources`
--

CREATE TABLE `users_cources` (
  `UserID` int(11) NOT NULL,
  `CourceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_onlinecources`
--

CREATE TABLE `user_onlinecources` (
  `UserID` int(11) NOT NULL,
  `OCourceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ArtID`),
  ADD KEY `AdminID` (`AdminID`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `cat_id_2` (`cat_id`),
  ADD KEY `AdminID_2` (`AdminID`);

--
-- Indexes for table `categoury`
--
ALTER TABLE `categoury`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `AdminID` (`AdminID`),
  ADD KEY `AdminID_2` (`AdminID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ContactID`);

--
-- Indexes for table `cources`
--
ALTER TABLE `cources`
  ADD PRIMARY KEY (`CourceID`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `AdminID` (`AdminID`),
  ADD KEY `cat_id_2` (`cat_id`),
  ADD KEY `AdminID_2` (`AdminID`);

--
-- Indexes for table `onlinecources`
--
ALTER TABLE `onlinecources`
  ADD PRIMARY KEY (`OCourceID`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `AdminID` (`AdminID`),
  ADD KEY `cat_id_2` (`cat_id`),
  ADD KEY `AdminID_2` (`AdminID`);

--
-- Indexes for table `registered_courses`
--
ALTER TABLE `registered_courses`
  ADD PRIMARY KEY (`Reg_ID`),
  ADD KEY `CourceID` (`CourceID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `users_cources`
--
ALTER TABLE `users_cources`
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CourceID` (`CourceID`);

--
-- Indexes for table `user_onlinecources`
--
ALTER TABLE `user_onlinecources`
  ADD KEY `UserID` (`UserID`),
  ADD KEY `OCourceID` (`OCourceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this is admin id', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `ArtID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `categoury`
--
ALTER TABLE `categoury`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'the cat id', AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cources`
--
ALTER TABLE `cources`
  MODIFY `CourceID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The Cource id', AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `onlinecources`
--
ALTER TABLE `onlinecources`
  MODIFY `OCourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `registered_courses`
--
ALTER TABLE `registered_courses`
  MODIFY `Reg_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this is user id', AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `categoury` (`cat_id`);

--
-- Constraints for table `categoury`
--
ALTER TABLE `categoury`
  ADD CONSTRAINT `categoury_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `cources`
--
ALTER TABLE `cources`
  ADD CONSTRAINT `cources_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`),
  ADD CONSTRAINT `cources_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `categoury` (`cat_id`);

--
-- Constraints for table `onlinecources`
--
ALTER TABLE `onlinecources`
  ADD CONSTRAINT `onlinecources_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`),
  ADD CONSTRAINT `onlinecources_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `categoury` (`cat_id`);

--
-- Constraints for table `registered_courses`
--
ALTER TABLE `registered_courses`
  ADD CONSTRAINT `registered_courses_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `registered_courses_ibfk_2` FOREIGN KEY (`CourceID`) REFERENCES `cources` (`CourceID`);

--
-- Constraints for table `users_cources`
--
ALTER TABLE `users_cources`
  ADD CONSTRAINT `users_cources_ibfk_1` FOREIGN KEY (`CourceID`) REFERENCES `cources` (`CourceID`),
  ADD CONSTRAINT `users_cources_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `user_onlinecources`
--
ALTER TABLE `user_onlinecources`
  ADD CONSTRAINT `user_onlinecources_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `user_onlinecources_ibfk_2` FOREIGN KEY (`OCourceID`) REFERENCES `onlinecources` (`OCourceID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
