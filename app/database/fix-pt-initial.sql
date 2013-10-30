-- phpMyAdmin SQL Dump
-- version 4.0.5deb1.quantal~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 25, 2013 at 11:13 AM
-- Server version: 5.6.14-1+debphp.org~quantal+1
-- PHP Version: 5.4.6-1ubuntu1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fix-pt`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fix_request_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `promotion_page_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fix_request_id` (`fix_request_id`,`answer_id`,`post_id`),
  KEY `answer_id` (`answer_id`),
  KEY `post_id` (`post_id`),
  KEY `promotion_page_id` (`promotion_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `direct_fix_requests`
--

CREATE TABLE IF NOT EXISTS `direct_fix_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `promotion_page_id` int(11) DEFAULT NULL,
  `accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`,`promotion_page_id`),
  KEY `promotion_page_id` (`promotion_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fix_offers`
--

CREATE TABLE IF NOT EXISTS `fix_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fix_request_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fix_request_id` (`fix_request_id`,`post_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fix_requests`
--

CREATE TABLE IF NOT EXISTS `fix_requests` (
  `state` varchar(100) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `location_id` (`location_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `fix_requests_tags`
--

CREATE TABLE IF NOT EXISTS `fix_requests_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fix_request_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fix_request_id` (`fix_request_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requester_id` int(11) DEFAULT NULL,
  `fixer_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `rate_id` int(11) DEFAULT NULL,
  `notifiable_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requester_id` (`requester_id`),
  KEY `fixer_id` (`fixer_id`),
  KEY `post_id` (`post_id`),
  KEY `rate_id` (`rate_id`),
  KEY `notifiable_id` (`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifiables`
--

CREATE TABLE IF NOT EXISTS `notifiables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `notifiable_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `notifiable_id` (`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notifiable_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`notifiable_id`),
  KEY `notifiable_id` (`notifiable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_pages`
--

CREATE TABLE IF NOT EXISTS `promotion_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `location_id` (`location_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_pages_tags`
--

CREATE TABLE IF NOT EXISTS `promotion_pages_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promotion_page_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promotion_page_id` (`promotion_page_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `score` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` enum('Standard','Premium') COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_email_unique` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `username`, `full_name`, `email`, `password`, `confirmation_code`, `confirmed`, `created_at`, `updated_at`) VALUES
(1, 'Standard', 'admin', '', 'admin@example.org', '$2y$08$7bhGRiPb5fDTGMpO3hxtQum2XBDXJPWmRwp5itYHZwm.3NNTAaC4K', '21decf7e079962e67bcc27e2fc92283c', 1, '2013-10-15 19:43:33', '2013-10-15 19:43:33'),
(2, 'Standard', 'user', '', 'user@example.org', '$2y$08$kQmDSOENtKqJr9Zdn5mFaOPHBgojJ2l0ufVVJYczs4XDimJSZp1Ry', '7891ef0422cb1171185aaafa7cc3b5cc', 1, '2013-10-15 19:43:33', '2013-10-15 19:43:33'),
(3, 'Standard', 'sylwia', '', 'syl-via@go2.pl', '$2y$08$XErTdfLeUC3XeOlHtww7UuRg7dAzJ7szUfpQk3pENirdrO1oknCNa', '2ef930e70665e1e44b95bd13777dc7bf', 1, '2013-10-15 20:41:15', '2013-10-15 20:41:15'),
(4, 'Standard', 'christopher.pitt', '', 'chris@example.com', '$2y$08$ncn5BzoDGyKdI5nHjcCDKOUh8aEtup381Y9Rbrm5nczZk5jd7QkjC', NULL, 0, '2013-10-21 20:59:33', '2013-10-21 20:59:33'),
(11, 'Standard', 'sbugla', '', 'syl-via@dcc.fc.up.pt', '$2y$08$KwKte5y1d.NT2F8pw52cie0D8F.Cgvxjk72R5JkuqZgo5nHl.oksG', NULL, 0, '2013-10-24 23:06:26', '2013-10-24 23:06:26');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`fix_request_id`) REFERENCES `fix_requests` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `comments` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`promotion_page_id`) REFERENCES `promotion_pages` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `direct_fix_requests`
--
ALTER TABLE `direct_fix_requests`
  ADD CONSTRAINT `direct_fix_requests_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `fix_offers`
--
ALTER TABLE `fix_offers`
  ADD CONSTRAINT `fix_offers_ibfk_1` FOREIGN KEY (`fix_request_id`) REFERENCES `fix_requests` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fix_offers_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `fix_requests`
--
ALTER TABLE `fix_requests`
  ADD CONSTRAINT `fix_requests_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fix_requests_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fix_requests_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `fix_requests_tags`
--
ALTER TABLE `fix_requests_tags`
  ADD CONSTRAINT `fix_requests_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fix_requests_tags_ibfk_1` FOREIGN KEY (`fix_request_id`) REFERENCES `fix_requests` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`fixer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `jobs_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `jobs_ibfk_4` FOREIGN KEY (`notifiable_id`) REFERENCES `notifiables` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `jobs_ibfk_5` FOREIGN KEY (`rate_id`) REFERENCES `rates` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;


--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`notifiable_id`) REFERENCES `notifiables` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`notifiable_id`) REFERENCES `notifiables` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `promotion_pages`
--
ALTER TABLE `promotion_pages`
  ADD CONSTRAINT `promotion_pages_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `promotion_pages_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `promotion_pages_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `promotion_pages_tags`
--
ALTER TABLE `promotion_pages_tags`
  ADD CONSTRAINT `promotion_pages_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `promotion_pages_tags_ibfk_1` FOREIGN KEY (`promotion_page_id`) REFERENCES `promotion_pages` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
