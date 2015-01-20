-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2014 at 01:52 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `coderity`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brief` text NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `top_show` tinyint(1) NOT NULL,
  `top_order` int(11) DEFAULT NULL,
  `bottom_show` tinyint(1) NOT NULL,
  `bottom_order` int(11) DEFAULT NULL,
  `element` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `lft`, `rght`, `name`, `sub_title`, `meta_title`, `meta_description`, `meta_keywords`, `content`, `slug`, `route`, `view`, `class`, `top_show`, `top_order`, `bottom_show`, `bottom_order`, `element`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, 'Home', NULL, '', '', '', '<p>Coming Soon</p>', 'home', '/', '', '', 0, NULL, 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `modified`) VALUES
(NULL, 'site_name', '', NULL);

INSERT INTO `settings` (`id`, `name`, `value`, `modified`) VALUES
(NULL, 'site_email', '', NULL);

INSERT INTO `settings` (`id`, `name`, `value`, `modified`) VALUES
(NULL, 'google_analytics', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--

ALTER TABLE `pages` CHANGE `route` `route` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ;


--
-- Table structure for table `redirects`
--

CREATE TABLE IF NOT EXISTS `redirects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `redirect` varchar(255) NOT NULL,
  `created` datetime NULL,
  `modified` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `redirects`
--

INSERT INTO `redirects` (`id`, `url`, `redirect`, `created`, `modified`) VALUES
(1, 'index.html', '', NULL, NULL),
(2, 'index.htm', '', NULL, NULL),
(3, 'default.html', '', NULL, NULL),
(4, 'default.htm', '', NULL, NULL),
(5, 'index.php', '', NULL, NULL),
(6, 'index.shtml', '', NULL, NULL),
(7, 'index.asp', '', NULL, NULL),
(8, 'default.asp', '', NULL, NULL),
(10, 'index.cfm', '', NULL, NULL),
(11, 'index.pl', '', NULL, NULL);

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Table structure for table `revisions`
--

CREATE TABLE IF NOT EXISTS `revisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `revision` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Added 1st Jan 2015

ALTER TABLE `pages` ADD `new_window` TINYINT( 1 ) NOT NULL AFTER `bottom_order` ;
ALTER TABLE `pages` ADD `post_route` VARCHAR( 255 ) NOT NULL AFTER `route` ;

ALTER TABLE `pages` CHANGE `post_route` `post_route` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ;

-- Added 9th Jan 2015

ALTER TABLE `articles` ADD `route` VARCHAR( 255 ) NULL AFTER `image` ,
ADD `new_window` TINYINT( 1 ) NOT NULL AFTER `route` ;

-- Added 16th Jan 2015

INSERT INTO `settings` (`id`, `name`, `value`, `modified`) VALUES (NULL, 'site_emails_cc', '', NULL);