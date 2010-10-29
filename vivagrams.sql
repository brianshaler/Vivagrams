-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 29, 2010 at 07:07 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vivagrams`
--

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE IF NOT EXISTS `commands` (
  `user_id` int(11) NOT NULL,
  `command` varchar(10) NOT NULL,
  `action` varchar(25) NOT NULL,
  `note` varchar(155) NOT NULL,
  UNIQUE KEY `user_id_command` (`user_id`,`command`),
  KEY `user_id` (`user_id`),
  KEY `command` (`command`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grams`
--

CREATE TABLE IF NOT EXISTS `grams` (
  `gram_id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `time_of_day` int(11) NOT NULL,
  `message` varchar(160) NOT NULL,
  `response_type` varchar(10) NOT NULL,
  PRIMARY KEY (`gram_id`),
  KEY `plan_id` (`plan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `event_time` datetime NOT NULL,
  `event_type` varchar(10) NOT NULL,
  `controller` varchar(15) NOT NULL,
  `method` varchar(20) NOT NULL,
  `info` text NOT NULL,
  KEY `event_time` (`event_time`),
  KEY `event_type` (`event_type`),
  KEY `controller` (`controller`),
  KEY `controller_2` (`controller`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gram_id` int(11) NOT NULL,
  `message` varchar(160) NOT NULL,
  `send` datetime NOT NULL,
  `sent` datetime NOT NULL,
  `response` datetime NOT NULL,
  `response_text` varchar(140) NOT NULL,
  PRIMARY KEY (`message_id`),
  UNIQUE KEY `user_id` (`user_id`,`gram_id`,`send`),
  KEY `send_gram_user` (`send`,`gram_id`,`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`plan_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `session_data` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `password` varchar(155) NOT NULL,
  `oauth` varchar(155) NOT NULL,
  `email` varchar(120) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `forgotten_password_code` varchar(50) DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_FI_1` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL,
  `display_name` varchar(55) NOT NULL,
  `confirmed` tinyint(4) NOT NULL,
  `notifications` tinyint(4) NOT NULL,
  `welcome_message_seen` tinyint(4) NOT NULL,
  `confirmed_number` tinyint(4) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_temp`
--

CREATE TABLE IF NOT EXISTS `user_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `activation_code` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_FI_1` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
