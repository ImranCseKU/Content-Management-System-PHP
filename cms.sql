-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 12:38 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(5) NOT NULL,
  `cat_title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'JavaScript'),
(3, 'JAVA'),
(6, 'React'),
(8, 'PHP'),
(10, 'CSS'),
(12, 'Vue');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(5) NOT NULL,
  `comment_post_id` int(5) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(2, 1, 'Muhammad Imran', 'example@gmail.com', 'First Comment!!', 'approved', '2020-04-30'),
(3, 2, 'Imran Hussain', 'im10@gmail.com', 'Its A Greate Tutorial..', 'approved', '2020-04-30'),
(6, 8, 'Imran Hussain', 'im10@gmail.com', 'Best tutorial for beginners..', 'approved', '2020-04-30'),
(8, 9, 'Moniruzzaman', 'monir27@gmail.com', 'Awesome tutorial.', 'approved', '2020-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(5) NOT NULL,
  `post_category_id` int(5) NOT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_author` varchar(200) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(200) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(200) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(1, 1, 'The Complete Bootstrap Bootcamp', 'Zubear Rayhan', '2020-05-09', 'bootstrap_images.jpg', '<p>In this complete Bootstrap Bootcamp Course students will learn how to create real time project with advanced admin panel</p>', 'zubear, rayhan, bootstrap,bootstrap 4', 2, 'published', 5),
(2, 2, 'JavaScript Crash Course', 'Md. Moniruzzaman', '2018-11-15', 'javascript_images.jpg', 'JavaScript is a dynamic language that is widely supported by modern web browsers.JavaScript is easy to learn.This tutorial will teach you JavaScript from basic to advanced.', 'Javascript, Moniruzzaman', 1, 'published', 2),
(3, 3, 'Learn Java from scratch', 'Shahidul Islam', '2020-05-16', '1589651357_java.jpg', '<p>Java is a high-level programming language originally developed by Sun Microsystems and released in 1995. Java runs on a variety of platforms, such as Windows, Mac OS, and the various versions of UNIX.</p>', 'JAVA, OOP JAVA', 0, 'published', 2),
(6, 10, 'Cascading Style Sheets', 'Abdul Hasib', '2020-02-19', 'css_story.jpg', 'CSS is a language that describes the style of an HTML document. CSS describes how HTML elements should be displayed. ', 'css,Cascading Style Sheets', 0, 'published', 0),
(7, 8, 'PHP Tutorial for Beginners: Learn in 7 Days', 'Zubear Rayhan', '2020-05-09', 'php.jpg', '<p>PHP is the most popular scripting language on the web. Without PHP Facebook, Yahoo, Google would not have exist. The course is geared to make you a PHP pro. Once you digest all basics, the course will help you create your very own Opinion Poll application.</p>', 'php,oop php', 0, 'published', 9),
(8, 8, 'Laravel Tutorial For Beginners', 'Muhammad Imran', '2020-04-30', 'laravel.png', 'Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the modelâ€“viewâ€“controller architectural pattern and based on Symfony.', 'Laravel, laravel framework, php framework', 1, 'published', 8),
(9, 6, 'React Crash Course for Beginners', 'Muhammad Imran', '2020-05-15', '1588546338_React.jpg', '<p>React is a JavaScript library for building user interfaces. It is maintained by Facebook and a community of individual developers and companies. React can be used as a base in the development of single-page or mobile applications.</p>', 'react, react js', 1, 'published', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT 'iamAprogrammer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(2, 'MUHAMMAD', '$2y$10$nabVunVoB.xzz3OSPzoXUuTBOOAuBmAwTsBhjq.LDh.JAjuz9zohW', 'MUHAMMAD', 'HUSSAIN', 'imran150240@gmail.com', '1588362028_IMRAN.jpg', 'admin', 'iamAprogrammer'),
(3, 'Raihan', '$2y$10$UAikAI68cAdjB5GovHDWfuM/8YVux5AZoekdvFbWU3d6mRu0xLvFi', 'Zubaer', 'Raihan', 'raihan08@gmail.com', '1588434223_Backfie.jpg', 'admin', 'iamAprogrammer'),
(4, 'Monir', '$2y$10$UAikAI68cAdjB5GovHDWfuM/8YVux5AZoekdvFbWU3d6mRu0xLvFi', 'MD', 'Moniruzzaman', 'monir27@gmail.com', '1589651147_IMG_20150902_175027.jpg', 'admin', 'iamAprogrammer'),
(5, 'tuhin', '$2y$10$UAikAI68cAdjB5GovHDWfuM/8YVux5AZoekdvFbWU3d6mRu0xLvFi', 'Tuhin', 'Ahmed', 'tuhin35@gmail.com', '1588549825_05m.jpg', 'subscriber', 'iamAprogrammer'),
(6, 'Ashik', '$2y$10$UAikAI68cAdjB5GovHDWfuM/8YVux5AZoekdvFbWU3d6mRu0xLvFi', 'Ashik', 'Sikdar', 'ashiksikdar@gmail.com', '1588703244_l L bd.jpg', 'subscriber', 'iamAprogrammer'),
(7, 'shamim', '$2y$10$UAikAI68cAdjB5GovHDWfuM/8YVux5AZoekdvFbWU3d6mRu0xLvFi', '', '', 'shamim.mail@gmail.com', '', 'subscriber', 'iamAprogrammer'),
(9, 'MUHAMMAD', '$2y$10$pOhv7yXFNroCV9q1mj3Dc.4an3b.ZcmOOgOrh.sUkoIn5UBFJ65qK', 'Shoron', 'Senti', 'senti@gmail.com', '1589651318_IMG_20150217_164048.jpg', 'admin', 'iamAprogrammer'),
(10, 'prince', '$2y$10$s7nAdYcOM2OD4Y2SfBlzwe9iFfP7.oMBj9WIKPGNBpL3L11ROomuS', 'Musfique', 'Arosh', 'prince10@gmail.com', '1589651214_2015-12-31-0708.jpg', 'admin', 'iamAprogrammer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
