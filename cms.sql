-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3325
-- Generation Time: Sep 17, 2020 at 04:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'php'),
(2, 'java'),
(3, 'python'),
(4, 'javascript'),
(5, 'c++'),
(6, 'c'),
(9, 'oop'),
(10, 'procedural'),
(14, 'AI');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `comment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 1, 'ahmed', 'test@test.com', 'this is example', 'approved', '2020-09-05 11:53:44'),
(3, 6, 'atef', 'test2@test.com', 'this is course is very poor', 'approved', '2020-09-05 13:01:20'),
(10, 14, 'elshazly', 'elshazly@elshazly.com', 'كورس جامد فشخ', 'unapproved', '2020-09-11 12:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(15, 4, 26),
(16, 1, 13),
(17, 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) DEFAULT 0,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL DEFAULT 0,
  `likes` int(11) NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`, `post_date`) VALUES
(1, 1, 'php course', '', 'saad', 'php.png', '<p>PHP is a general-purpose scripting language that is especially suited to web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994. the PHP reference implementation is now produced by The PHP Group. PHP originally stood for Personal Home Page, but it now stands for the recursive initialism PHP: Hypertext Preprocessor.</p>', 'php,saad', 1, 'published', 18, 0, '2020-09-12 10:32:40'),
(2, 4, 'nodejs course', '', 'ahmed', 'nodejs.png', '<p>Node.js is an open-source, cross-platform, JavaScript runtime environment (Framework) that executes JavaScript code outside a web browser. Node.js lets developers use JavaScript to write command line tools and for server-side scripting—running scripts server-side to produce dynamic web page content before the page is sent to the user web browser.</p>', 'js,node,nodejs,ahmed,atef', 0, 'published', 3, 0, '2020-09-10 01:29:19'),
(3, 2, 'java course', '', 'hala', 'java.png', 'Java is a set of computer software and specifications developed by James Gosling at Sun Microsystems, which was later acquired by the Oracle Corporation, that provides a system for developing application software and deploying it in a cross-platform computing environment.', 'java,hala', 0, 'published', 1, 0, '2020-09-01 13:07:40'),
(13, 3, 'python cousre', '', 'salma', 'python.png', '<p><strong>Python</strong> is an <a href=\"https://en.wikipedia.org/wiki/Interpreted_language\">interpreted</a>, <a href=\"https://en.wikipedia.org/wiki/High-level_programming_language\">high-level</a> and <a href=\"https://en.wikipedia.org/wiki/General-purpose_programming_language\">general-purpose programming language</a>. Created by <a href=\"https://en.wikipedia.org/wiki/Guido_van_Rossum\">Guido van Rossum</a> and first released in 1991, Python is design philosophy emphasizes <a href=\"https://en.wikipedia.org/wiki/Code_readability\">code readability</a> with its notable use of <a href=\"https://en.wikipedia.org/wiki/Off-side_rule\">significant whitespace</a>. Its <a href=\"https://en.wikipedia.org/wiki/Language_construct\">language constructs</a> and <a href=\"https://en.wikipedia.org/wiki/Object-oriented_programming\">object-oriented</a> approach aim to help <a href=\"https://en.wikipedia.org/wiki/Programmers\">programmers</a> write clear, logical code for small and large-scale projects</p>', 'python,salma,ai,ml', 0, 'published', 9, 1, '2020-09-09 20:39:32'),
(14, 4, 'Socket.IO course', '', 'ahmed', 'socketio.jpg', '<p><strong>Socket.IO</strong> is a <a href=\"https://en.wikipedia.org/wiki/JavaScript\">JavaScript</a> library for realtime <a href=\"https://en.wikipedia.org/wiki/Web_application\">web applications</a>. It enables realtime, bi-directional communication between web clients and servers. It has two parts: a <a href=\"https://en.wikipedia.org/wiki/Client-side\">client-side</a> library that runs in the <a href=\"https://en.wikipedia.org/wiki/Web_browser\">browser</a>, and a <a href=\"https://en.wikipedia.org/wiki/Server-side\">server-side</a> library for <a href=\"https://en.wikipedia.org/wiki/Node.js\">Node.js</a>. Both components have a nearly identical <a href=\"https://en.wikipedia.org/wiki/Application_programming_interface\">API</a>. Like <a href=\"https://en.wikipedia.org/wiki/Node.js\">Node.js</a>, it is <a href=\"https://en.wikipedia.org/wiki/Event-driven_architecture\">event-driven</a>.</p>', 'websocket,socketio,ahmed', 1, 'published', 12, 0, '2020-09-10 01:28:31'),
(26, 1, 'Laravel Course', '', 'hala', 'Laravel.jpg', '<p><strong>Laravel</strong> is a <a href=\"https://en.wikipedia.org/wiki/Free_software\">free</a>, open-source<a href=\"https://en.wikipedia.org/wiki/Laravel#cite_note-3\">[3]</a> <a href=\"https://en.wikipedia.org/wiki/PHP\">PHP</a> <a href=\"https://en.wikipedia.org/wiki/Web_framework\">web framework</a>, created by Taylor Otwell and intended for the development of web applications following the <a href=\"https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller\">model–view–controller</a> (MVC) <a href=\"https://en.wikipedia.org/wiki/Architectural_pattern\">architectural pattern</a> and based on <a href=\"https://en.wikipedia.org/wiki/Symfony\">Symfony</a>. Some of the features of Laravel are a modular <a href=\"https://en.wikipedia.org/wiki/Application-level_package_manager\">packaging system</a> with a dedicated dependency manager, different ways for accessing <a href=\"https://en.wikipedia.org/wiki/Relational_database\">relational databases</a>, utilities that aid in <a href=\"https://en.wikipedia.org/wiki/Application_deployment\">application deployment</a> and maintenance, and its orientation toward <a href=\"https://en.wikipedia.org/wiki/Syntactic_sugar\">syntactic sugar</a>.</p>', 'laravel,hala', 0, 'published', 123, 2, '2020-09-12 10:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` text NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `token` text DEFAULT NULL,
  `user_randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystring161',
  `user_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_firstname`, `user_lastname`, `user_image`, `user_role`, `token`, `user_randSalt`, `user_date`) VALUES
(1, 'ahmed', '$2y$10$NSgRpkd1QosEOTRg1UyNA.nD3Ebgk6/saAvRvR.7U64nEE3X9YxM.', 'test@test.com', 'ahmed', 'atef', '', 'admin', '', '$2y$10$iusesomecrazystring161', '2020-09-10 20:00:30'),
(2, 'atef', '$2y$10$TO24/EFrxalC8iALvPRX..f4pRzbn2Sa5KpjaEXRTbtDKTMfoRsGu', 'test2@test.com', 'atef', 'elshazly', '', 'admin', '', '$2y$10$iusesomecrazystring161', '2020-09-06 16:40:57'),
(4, 'saad', '$2y$10$TO24/EFrxalC8iALvPRX..f4pRzbn2Sa5KpjaEXRTbtDKTMfoRsGu', 'test3@test.com', 'saad', 'elshazly', '', 'admin', '', '$2y$10$iusesomecrazystring161', '2020-09-09 19:30:33'),
(5, 'hala', '$2y$10$CzXo9SjWhohGfDxwMAQ/MuFbY7NkMWdDI6azAq21nJGkb9ciGHvpy', 'test4@test.com', 'hala', 'abd elstar', '', 'admin', '', '$2y$10$iusesomecrazystring161', '2020-09-12 10:58:55'),
(15, 'salma', '$2y$10$DL5etyJuGSlAld3NgXBM8ePLq8lxGfecKIer/fiA6vYYJKSkPQqju', 'test5@test.com', 'salma', 'atef', '', 'admin', '', '$2y$10$iusesomecrazystring161', '2020-09-12 10:58:23'),
(16, 'amany', '$2y$10$JvXlGwMc4sFSTNwyjh9B/ef.AVEOjB4dvr8b6cfNnUnHlWBnfHDHK', 'test6@test.com', 'amany', 'atef', '', 'admin', '', '$2y$10$iusesomecrazystring161', '2020-09-10 19:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(4, '2f3qntag0jj1g1et2v6ptth4hi', 1599757916),
(8, '2j3pn2arreftnf7n71sell497t', 1599748207),
(9, '17aeo883nkcugl8gcshe65ee65', 1599759726),
(10, '59oabf5anfpj1a41keb1oiq27k', 1599773494),
(11, '99qen8udnemeimm4tgilo3nde3', 1599778455),
(12, '8gradaae46uajlmg83uk2lu658', 1599824852),
(13, '7ntct7av7aotl83rk68r81epml', 1599909596),
(14, 'kkmelqmo3agtm9n0vbslvgqcn4', 1599992086),
(15, 'j4up2j9dqdlp2s03s3kdtnj2bh', 1600195528),
(16, '947dc6339rc6icrkgnqo435bkf', 1600268436),
(17, 'pdvo71es8ldor6d3dfdnqvenfd', 1600308922),
(18, 'f2sb8p2knrnthqkf36v57gpstb', 1600293260);

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
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
