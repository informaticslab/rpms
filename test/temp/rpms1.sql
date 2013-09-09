-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2013 at 07:49 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rpms`
--
CREATE DATABASE IF NOT EXISTS `rpms` DEFAULT CHARACTER SET ascii COLLATE ascii_general_ci;
USE `rpms`;

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `projectid` tinyint(5) NOT NULL,
  `first_name` char(100) NOT NULL,
  `last_name` char(100) NOT NULL,
  `title` char(100) NOT NULL,
  `organization` char(200) NOT NULL,
  `phone` char(50) NOT NULL,
  `email` char(100) NOT NULL,
  `primary` tinyint(1) NOT NULL,
  `need_login` tinyint(1) NOT NULL,
  `notify_user` tinyint(1) NOT NULL,
  `user_name` char(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `projectid` (`projectid`),
  KEY `projectid_2` (`projectid`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` tinyint(5) NOT NULL,
  `project_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_name` char(200) NOT NULL,
  `project_title` char(200) NOT NULL,
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `approved_start` date NOT NULL DEFAULT '0000-00-00',
  `approved_end` date NOT NULL DEFAULT '0000-00-00',
  `project_type` char(50) NOT NULL,
  `project_use` char(50) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `goals` varchar(1000) NOT NULL,
  `success` varchar(1000) NOT NULL,
  `outside_resources` tinyint(1) NOT NULL,
  `outside_notes` varchar(1000) NOT NULL,
  `test_data` tinyint(1) NOT NULL,
  `test_data_notes` varchar(1000) NOT NULL,
  `third_party` tinyint(1) NOT NULL,
  `third_party_notes` varchar(1000) NOT NULL,
  `additional_information` varchar(1000) NOT NULL,
  `project_outcome` varchar(1000) NOT NULL,
  `admin_change_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin_selection` char(50) NOT NULL,
  `admin_name` char(50) NOT NULL,
  `admin_notes` char(200) NOT NULL,
  `infra_change_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `infra_selection` char(50) NOT NULL,
  `infra_name` char(50) NOT NULL,
  `infra_notes` char(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --------------------------------------------------------

--
-- Table structure for table `project_date_history`
--

CREATE TABLE IF NOT EXISTS `project_date_history` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `projectid` tinyint(5) NOT NULL,
  `approved_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_start` date NOT NULL,
  `approved_end` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `projectid` (`projectid`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `projectid` tinyint(5) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resource_type` char(20) NOT NULL,
  `device_config` char(100) NOT NULL,
  `notes` varchar(1000) NOT NULL,
  `external_access` tinyint(1) NOT NULL,
  `subdomain` char(100) NOT NULL,
  `server_port` char(50) NOT NULL,
  `external_port` char(50) NOT NULL,
  `device_name` char(100) NOT NULL,
  `inventory` char(100) NOT NULL,
  `internal_notes` varchar(1000) NOT NULL,
  `proxy_from` char(50) NOT NULL,
  `proxy_to` char(50) NOT NULL,
  `start_name` char(50) NOT NULL,
  `end_name` char(50) NOT NULL,
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `projectid` (`projectid`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resources_history`
--

CREATE TABLE IF NOT EXISTS `resources_history` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `changed_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stakeholders`
--

CREATE TABLE IF NOT EXISTS `stakeholders` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `projectid` tinyint(5) NOT NULL,
  `name` char(100) NOT NULL,
  `role` char(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `projectid` (`projectid`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_history`
--

CREATE TABLE IF NOT EXISTS `status_history` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `projectid` tinyint(5) NOT NULL,
  `type_of_status` char(20) NOT NULL,
  `status_changed_date` datetime NOT NULL,
  `status_selection` char(50) NOT NULL,
  `status_name` char(50) NOT NULL,
  `status_notes` char(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `projectid` (`projectid`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/* create new users */
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'rpmsadmin'@'localhost' IDENTIFIED BY PASSWORD '*A111C6402B85EDA3E824418474DD823429C84C71';
GRANT SELECT, INSERT, UPDATE ON *.* TO 'rpmsuser'@'localhost' IDENTIFIED BY PASSWORD '*6D06C2CF3EA453AF458029B1A4E417A49CA56255';

