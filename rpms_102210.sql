-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2010 at 03:27 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rpms`
--

CREATE DATABASE 'rpms';

-- --------------------------------------------------------

--
-- Table structure for table `admin_infrastructure_status`
--

DROP TABLE IF EXISTS `admin_infrastructure_status`;
CREATE TABLE IF NOT EXISTS `admin_infrastructure_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `infrastructure_status` text NOT NULL,
  `infrastructure_modified_by` text NOT NULL,
  `infrastructure_modified_date` int(20) unsigned NOT NULL,
  `infrastructure_comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `admin_infrastructure_status`
--

INSERT INTO `admin_infrastructure_status` (`id`, `projectid`, `infrastructure_status`, `infrastructure_modified_by`, `infrastructure_modified_date`, `infrastructure_comments`) VALUES
(1, 1, 'Waiting for Approval', 'System', 0, ''),
(2, 2, 'Waiting for Approval', 'System', 0, ''),
(3, 2, 'Infrastructure set-up completed', 'arp', 1286035179, ''),
(4, 2, 'Infrastructure set-up completed', 'arp', 1286035179, ''),
(5, 1, 'Infrastructure set-up in process', 'arp', 1285732800, ''),
(6, 1, 'Infrastructure set-up in process', 'arp', 1285732800, ''),
(7, 1, 'Infrastructure set-up completed', 'arp', 1285819200, ''),
(8, 1, 'Infrastructure set-up completed', 'arp', 1285819200, ''),
(9, 1, 'Infrastructure set-up completed', 'arp', 1285819200, ''),
(10, 1, 'Infrastructure set-up completed', 'arp', 1285819200, ''),
(11, 1, 'Infrastructure set-up completed', 'arp', 1285819200, ''),
(12, 1, 'Infrastructure set-up completed', 'arp', 1285819200, ''),
(13, 1, 'Infrastructure set-up completed', 'arp', 1285819200, ''),
(14, 1, 'Infrastructure set-up completed', 'arp', 1286035179, ''),
(15, 1, 'Infrastructure set-up completed', 'arp', 1286251200, ''),
(23, 7, 'Waiting for Approval', 'System', 0, ''),
(22, 6, 'Waiting for Approval', 'System', 0, ''),
(21, 5, 'Infrastructure set-up completed', 'arp', 1285113600, ''),
(24, 8, 'Waiting for Approval', 'System', 0, ''),
(25, 9, 'Waiting for Approval', 'System', 0, ''),
(26, 10, 'Waiting for Approval', 'System', 0, ''),
(27, 8, 'Waiting for Approval', 'System', 1286907921, ''),
(28, 9, 'Waiting for Approval', 'System', 1286908018, ''),
(29, 9, 'Waiting for Approval', 'System', 1286908072, ''),
(30, 10, 'Waiting for Approval', 'System', 1286908793, ''),
(31, 9, 'Infrastructure set-up on hold', 'System', 1286909240, 'system switch failed; service order is in progress.'),
(32, 8, 'Infrastructure to be prepared', 'System', 1286909321, 'Will have setup completed by COB 10/14/2010.'),
(33, 11, 'Waiting for Approval', 'System', 0, ''),
(34, 1, 'Infrastructure set-up completed', 'arp', 1287414361, 'testing'),
(35, 1, 'Infrastructure set-up on hold', 'arp', 1287414655, 'testing'),
(36, 1, 'Infrastructure set-up on hold', 'arp', 1287414777, 'testing'),
(37, 1, 'Infrastructure set-up on hold', 'arp', 1287415063, 'testing'),
(38, 1, 'Infrastructure set-up completed', 'arp', 1284076800, 'testing'),
(39, 12, 'Waiting for Approval', 'System', 0, ''),
(40, 13, 'Waiting for Approval', 'System', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_project_status`
--

DROP TABLE IF EXISTS `admin_project_status`;
CREATE TABLE IF NOT EXISTS `admin_project_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `project_status` text NOT NULL,
  `project_modified_by` text NOT NULL,
  `project_modified_date` int(20) unsigned NOT NULL,
  `project_comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `admin_project_status`
--

INSERT INTO `admin_project_status` (`id`, `projectid`, `project_status`, `project_modified_by`, `project_modified_date`, `project_comments`) VALUES
(1, 1, 'Submitted to Team', 'System', 0, ''),
(2, 2, 'Submitted to Team', 'System', 0, ''),
(3, 2, 'Approved by Team', 'arp', 1285732800, ''),
(4, 2, 'Approved by Team', 'arp', 1284595200, ''),
(5, 1, 'Approved by Team', 'arp', 1285732800, ''),
(6, 1, 'Approved by Team', 'arp', 1285732800, ''),
(7, 1, 'Approved by Team', 'arp', 1285819200, ''),
(8, 1, 'Approved by Team', 'arp', 1285819200, ''),
(9, 1, 'Approved by Team', 'arp', 1285819200, ''),
(10, 1, 'Approved by Team', 'arp', 1285819200, ''),
(11, 1, 'Approved by Team', 'arp', 1285819200, ''),
(12, 1, 'Approved by Team', 'arp', 1285819200, ''),
(13, 1, 'Approved by Team', 'arp', 1285819200, ''),
(14, 1, 'Approved by Team', 'arp', 1286164800, ''),
(15, 1, 'Approved by Team', 'arp', 1283904000, ''),
(23, 7, 'Submitted to Team', 'System', 0, ''),
(22, 6, 'Submitted to Team', 'System', 0, ''),
(21, 5, 'Approved by Team', 'arp', 1286409600, ''),
(24, 8, 'Submitted to Team', 'System', 0, ''),
(25, 9, 'Submitted to Team', 'System', 0, ''),
(26, 10, 'Submitted to Team', 'System', 0, ''),
(27, 8, 'Submitted to Team', 'System', 1286907921, ''),
(28, 9, 'Submitted to Team', 'System', 1286908018, ''),
(29, 9, 'Submitted to Team', 'System', 1286908072, ''),
(30, 10, 'Submitted to Team', 'System', 1286908793, ''),
(31, 9, 'Submitted to Team', 'System', 1286909240, ''),
(32, 8, 'Submitted to Team', 'System', 1286909321, ''),
(33, 11, 'Submitted to Team', 'System', 1287100800, ''),
(34, 1, 'Under Review by Team', 'arp', 1287414019, 'test'),
(35, 1, 'Approved by Team', 'arp', 1287414038, 'test'),
(36, 1, 'Approved by Team', 'arp', 1287416050, 'test'),
(37, 1, 'Approved by Team', 'arp', 1287416113, 'test'),
(38, 1, 'Approved by Team', 'arp', 1287416161, 'test'),
(39, 1, 'Approved by Team', 'arp', 1287421482, 'test'),
(40, 1, 'Approved by Team', 'arp', 1287421560, 'test'),
(43, 12, 'Submitted to Team', 'System', 0, ''),
(42, 11, 'On hold', 'arp', 1287446400, ''),
(44, 11, 'Under Review by Team', 'arp', 1287426878, ''),
(45, 13, 'Submitted to Team', 'System', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `connectivity`
--

DROP TABLE IF EXISTS `connectivity`;
CREATE TABLE IF NOT EXISTS `connectivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `outside_access` varchar(3) NOT NULL,
  `custom_network_config` varchar(3) NOT NULL,
  `outside_agency` varchar(3) NOT NULL,
  `inside_agency` varchar(3) NOT NULL,
  `additional_info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `connectivity`
--

INSERT INTO `connectivity` (`id`, `projectid`, `outside_access`, `custom_network_config`, `outside_agency`, `inside_agency`, `additional_info`) VALUES
(1, 1, '', '', '', '', ''),
(2, 2, 'Yes', 'No', 'Yes', 'No', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(10, 7, '', '', '', '', ''),
(11, 8, 'No', 'Yes', 'No', 'No', ''),
(12, 9, 'No', 'Yes', 'No', 'No', ''),
(13, 10, '', '', '', '', ''),
(14, 11, 'No', 'No', 'No', 'No', ''),
(15, 12, '', '', '', '', ''),
(16, 13, '', '', '', '', ''),
(9, 6, '', '', '', '', ''),
(8, 5, 'Yes', 'No', 'Yes', 'No', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_of_request` int(20) unsigned NOT NULL,
  `start_date` int(20) unsigned NOT NULL,
  `end_date` int(20) unsigned NOT NULL,
  `num_personnel` int(2) NOT NULL,
  `project_summary` text NOT NULL,
  `summary_status` varchar(3) NOT NULL,
  `project_type` varchar(255) NOT NULL,
  `project_use` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `userid`, `title`, `date_of_request`, `start_date`, `end_date`, `num_personnel`, `project_summary`, `summary_status`, `project_type`, `project_use`) VALUES
(1, 1, 'Burrito Machine3', 1283299200, 1283745600, 1284609600, 0, 'summary2', '', 'Evaluation', 'Internal CDC use'),
(2, 2, 'Project Test 1', 1284163200, 1284264000, 1285560000, 2, '', '', 'Prototype', 'Internal CDC use'),
(6, 9, 'Project Test 2', 1284940800, 1285041600, 1285646400, 0, '', '', 'Hybrid', 'Internal CDC use'),
(5, 8, 'Project Test 3', 1286337600, 1287374400, 1287720000, 2, '', '', '', ''),
(7, 10, 'Project Test 4', 1285891200, 1286164800, 1288238400, 0, '', '', 'Prototype', 'External CDC use'),
(8, 11, 'DM Test1', 1286856000, 1287115200, 1291093200, 5, '', '', 'Prototype', 'External CDC use'),
(9, 12, 'DM Test3', 1286856000, 1287115200, 1291093200, 5, '', '', 'Hybrid', 'External CDC use'),
(10, 13, 'DM Test2', 1286856000, 1287979200, 1292389200, 4, '', '', 'Prototype', 'External CDC use'),
(11, 14, 'DM Test4', 1286856000, 1287979200, 1290661200, 2, '', '', 'Evaluation', 'Internal CDC use'),
(12, 15, '', 1287374400, 0, 0, 0, '', '', '', ''),
(13, 16, '', 1287374400, 0, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_output`
--

DROP TABLE IF EXISTS `project_output`;
CREATE TABLE IF NOT EXISTS `project_output` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `outcome_summary` text NOT NULL,
  `publications` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `project_output`
--

INSERT INTO `project_output` (`id`, `projectid`, `outcome_summary`, `publications`) VALUES
(1, 1, '', ''),
(2, 2, '', ''),
(10, 7, '', ''),
(9, 6, '', ''),
(8, 5, '', ''),
(11, 8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', ''),
(12, 9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', ''),
(13, 10, '', ''),
(14, 11, '', ''),
(15, 12, '', ''),
(16, 13, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_resources`
--

DROP TABLE IF EXISTS `project_resources`;
CREATE TABLE IF NOT EXISTS `project_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `consultation` varchar(3) NOT NULL,
  `developer_resources` varchar(3) NOT NULL,
  `lab` varchar(3) NOT NULL,
  `lab_start_date` int(20) unsigned NOT NULL,
  `length` varchar(50) NOT NULL,
  `workstations` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `project_resources`
--

INSERT INTO `project_resources` (`id`, `projectid`, `consultation`, `developer_resources`, `lab`, `lab_start_date`, `length`, `workstations`) VALUES
(1, 1, '', '', '', 1286596800, '', 0),
(2, 2, 'Yes', 'Yes', 'Yes', 1285819200, '2 days', 2),
(11, 8, 'Yes', 'Yes', 'Yes', 1287374400, '1 month', 3),
(10, 7, '', '', '', 1286337600, '', 0),
(9, 6, '', '', '', 1285300800, '', 0),
(8, 5, 'Yes', 'Yes', 'Yes', 1287374400, '5 days', 3),
(12, 9, 'Yes', 'Yes', 'Yes', 1287374400, '1 month', 3),
(13, 10, 'No', 'No', 'Yes', 1287979200, '2 months', 3),
(14, 11, 'No', 'No', 'No', 1288324800, '30 days', 2),
(15, 12, '', '', '', 0, '', 0),
(16, 13, '', '', 'Yes', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_summary`
--

DROP TABLE IF EXISTS `project_summary`;
CREATE TABLE IF NOT EXISTS `project_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `motivation` text NOT NULL,
  `vision` text NOT NULL,
  `stakeholder1` varchar(100) NOT NULL,
  `role1` varchar(100) NOT NULL,
  `stakeholder2` varchar(100) NOT NULL,
  `role2` varchar(100) NOT NULL,
  `stakeholder3` varchar(100) NOT NULL,
  `role3` varchar(100) NOT NULL,
  `stakeholder4` varchar(100) NOT NULL,
  `role4` varchar(100) NOT NULL,
  `stakeholder5` varchar(100) NOT NULL,
  `role5` varchar(100) NOT NULL,
  `stakeholder6` varchar(100) NOT NULL,
  `role6` varchar(100) NOT NULL,
  `datasources` text NOT NULL,
  `steps` text NOT NULL,
  `metrics` text NOT NULL,
  `project_additional_info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `project_summary`
--

INSERT INTO `project_summary` (`id`, `projectid`, `motivation`, `vision`, `stakeholder1`, `role1`, `stakeholder2`, `role2`, `stakeholder3`, `role3`, `stakeholder4`, `role4`, `stakeholder5`, `role5`, `stakeholder6`, `role6`, `datasources`, `steps`, `metrics`, `project_additional_info`) VALUES
(1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'CDC/OSELS/PHITPO', 'User', '', '', '', '', '', '', '', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(10, 7, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 8, 'This is an initiative from the State and Local Health Department', 'provide efficiency and accurate output of data reporting', 'Alabama Dept of Health', 'user; report receipent', 'Jackson Hospital', 'data supplier', 'Baptist Medical Ctr', 'data supplier', '', '', '', '', '', '', 'State health Dept can provide use cases and guide lines', 'Will be provided along with use cases', 'Will be provided along with use cases', ''),
(12, 9, 'This is an initiative from the State and Local Health Department', 'provide efficiency and accurate output of data reporting', 'Alabama Dept of Health', 'user; report receipent', 'Jackson Hospital', 'data supplier', 'Baptist Medical Ctr', 'data supplier', '', '', '', '', '', '', 'State health Dept can provide use cases and guide lines', 'Will be provided along with use cases', 'Will be provided along with use cases', ''),
(14, 11, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', 'user1', 'data supplier, report recipient', 'user2', 'user', '', '', '', '', '', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n'),
(13, 10, 'to improve project manaegement across OSELS and at the enterprise level', 'to provide a robust enterprise system that is a one stop shop for project management', 'OD Director', 'governing body', 'ODPEO Director', 'stakeholder', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 6, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'CIO', 'User', '', '', '', '', '', '', '', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(15, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 13, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tr_desktop`
--

DROP TABLE IF EXISTS `tr_desktop`;
CREATE TABLE IF NOT EXISTS `tr_desktop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `dt_qty` int(2) NOT NULL,
  `dt_operating_system` varchar(100) NOT NULL,
  `dt_memory` varchar(5) NOT NULL,
  `dt_disk` varchar(5) NOT NULL,
  `dt_vm` varchar(3) NOT NULL,
  `dt_software` varchar(100) NOT NULL,
  `dt_notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `tr_desktop`
--

INSERT INTO `tr_desktop` (`id`, `projectid`, `dt_qty`, `dt_operating_system`, `dt_memory`, `dt_disk`, `dt_vm`, `dt_software`, `dt_notes`) VALUES
(1, 1, 5, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(2, 1, 5, 'Windows XP', '', '', 'Yes', '', ''),
(3, 1, 0, '', '', '', '--', '', ''),
(4, 1, 0, '', '', '', '--', '', ''),
(5, 1, 0, '', '', '', '--', '', ''),
(6, 1, 0, '', '', '', '--', '', ''),
(7, 2, 1, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(8, 2, 2, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(9, 2, 3, 'Linux', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(10, 2, 0, '', '', '', '--', '', ''),
(11, 2, 0, '', '', '', '--', '', ''),
(12, 2, 0, '', '', '', '--', '', ''),
(55, 7, 1, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(54, 6, 0, '', '', '', '--', '', ''),
(53, 6, 0, '', '', '', '--', '', ''),
(52, 6, 0, '', '', '', '--', '', ''),
(51, 6, 0, '', '', '', '--', '', ''),
(48, 5, 0, '', '', '', '--', '', ''),
(49, 6, 0, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(50, 6, 0, '', '', '', '--', '', ''),
(47, 5, 0, '', '', '', '--', '', ''),
(46, 5, 0, '', '', '', '--', '', ''),
(45, 5, 0, '', '', '', '--', '', ''),
(44, 5, 0, '', '', '', '--', '', ''),
(43, 5, 1, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(56, 7, 0, '', '', '', '--', '', ''),
(57, 7, 0, '', '', '', '--', '', ''),
(58, 7, 0, '', '', '', '--', '', ''),
(59, 7, 0, '', '', '', '--', '', ''),
(60, 7, 0, '', '', '', '--', '', ''),
(61, 8, 1, 'Windows XP', '2GB', '10GB', 'Yes', 'MS Office Suite', 'Default desktop image'),
(62, 8, 1, 'Windows XP, 7', '4GB', '20GB', 'Yes', 'MS Office Suite, Google', 'Google Apps needed'),
(63, 8, 0, '', '', '', '--', '', ''),
(64, 8, 0, '', '', '', '--', '', ''),
(65, 8, 0, '', '', '', '--', '', ''),
(66, 8, 0, '', '', '', '--', '', ''),
(67, 9, 1, 'Windows XP', '2GB', '10GB', 'Yes', 'MS Office Suite', 'Default desktop image'),
(68, 9, 1, 'Windows XP, 7', '4GB', '20GB', 'Yes', 'MS Office Suite, Google', 'Google Apps needed'),
(69, 9, 0, '', '', '', '--', '', ''),
(70, 9, 0, '', '', '', '--', '', ''),
(71, 9, 0, '', '', '', '--', '', ''),
(72, 9, 0, '', '', '', '--', '', ''),
(73, 10, 0, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(74, 10, 0, '', '', '', '--', '', ''),
(75, 10, 0, '', '', '', '--', '', ''),
(76, 10, 0, '', '', '', '--', '', ''),
(77, 10, 0, '', '', '', '--', '', ''),
(78, 10, 0, '', '', '', '--', '', ''),
(79, 11, 2, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(80, 11, 0, '', '', '', '--', '', ''),
(81, 11, 0, '', '', '', '--', '', ''),
(82, 11, 0, '', '', '', '--', '', ''),
(83, 11, 0, '', '', '', '--', '', ''),
(84, 11, 0, '', '', '', '--', '', ''),
(85, 12, 0, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(86, 12, 3, '', '', '', '--', '', ''),
(87, 12, 0, '', '', '', '--', '', ''),
(88, 12, 0, '', '', '', '--', '', ''),
(89, 12, 0, '', '', '', '--', '', ''),
(90, 12, 0, '', '', '', '--', '', ''),
(91, 13, 0, 'Windows XP', '2GB', '10GB', 'Yes', 'Default', 'Default desktop image'),
(92, 13, 0, '', '', '', '--', '', ''),
(93, 13, 0, '', '', '', '--', '', ''),
(94, 13, 0, '', '', '', '--', '', ''),
(95, 13, 0, '', '', '', '--', '', ''),
(96, 13, 0, '', '', '', '--', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tr_server`
--

DROP TABLE IF EXISTS `tr_server`;
CREATE TABLE IF NOT EXISTS `tr_server` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `server_qty` int(2) NOT NULL,
  `server_operating_system` varchar(100) NOT NULL,
  `server_memory` varchar(5) NOT NULL,
  `server_disk` varchar(5) NOT NULL,
  `server_vm` varchar(3) NOT NULL,
  `server_software` varchar(100) NOT NULL,
  `server_notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `tr_server`
--

INSERT INTO `tr_server` (`id`, `projectid`, `server_qty`, `server_operating_system`, `server_memory`, `server_disk`, `server_vm`, `server_software`, `server_notes`) VALUES
(1, 1, 0, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(2, 1, 0, '', '', '', '--', '', ''),
(3, 1, 0, '', '', '', '--', '', ''),
(4, 1, 0, '', '', '', '--', '', ''),
(5, 1, 0, '', '', '', '--', '', ''),
(6, 1, 0, '', '', '', '--', '', ''),
(7, 2, 3, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(8, 2, 0, '', '', '', '--', '', ''),
(9, 2, 0, '', '', '', '--', '', ''),
(10, 2, 0, '', '', '', '--', '', ''),
(11, 2, 0, '', '', '', '--', '', ''),
(12, 2, 0, '', '', '', '--', '', ''),
(43, 5, 1, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(56, 7, 0, '', '', '', '--', '', ''),
(54, 6, 0, '', '', '', '--', '', ''),
(55, 7, 1, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(53, 6, 0, '', '', '', '--', '', ''),
(52, 6, 0, '', '', '', '--', '', ''),
(51, 6, 0, '', '', '', '--', '', ''),
(50, 6, 0, '', '', '', '--', '', ''),
(49, 6, 0, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(48, 5, 0, 'Windows 2003 Server', '2GB', '16GB', '--', 'Default', 'Default server image'),
(47, 5, 0, '', '', '', '--', '', ''),
(46, 5, 0, '', '', '', '--', '', ''),
(45, 5, 0, '', '', '', '--', '', ''),
(44, 5, 0, '', '', '', '--', '', ''),
(57, 7, 0, '', '', '', '--', '', ''),
(58, 7, 0, '', '', '', '--', '', ''),
(59, 7, 0, '', '', '', '--', '', ''),
(60, 7, 0, '', '', '', '--', '', ''),
(61, 8, 1, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(62, 8, 0, '', '', '', '--', '', ''),
(63, 8, 0, '', '', '', '--', '', ''),
(64, 8, 0, '', '', '', '--', '', ''),
(65, 8, 0, '', '', '', '--', '', ''),
(66, 8, 0, '', '', '', '--', '', ''),
(67, 9, 1, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(68, 9, 0, '', '', '', '--', '', ''),
(69, 9, 0, '', '', '', '--', '', ''),
(70, 9, 0, '', '', '', '--', '', ''),
(71, 9, 0, '', '', '', '--', '', ''),
(72, 9, 0, '', '', '', '--', '', ''),
(73, 10, 0, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(74, 10, 0, '', '', '', '--', '', ''),
(75, 10, 0, '', '', '', '--', '', ''),
(76, 10, 0, '', '', '', '--', '', ''),
(77, 10, 0, '', '', '', '--', '', ''),
(78, 10, 0, '', '', '', '--', '', ''),
(79, 11, 1, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(80, 11, 0, '', '', '', '--', '', ''),
(81, 11, 0, '', '', '', '--', '', ''),
(82, 11, 0, '', '', '', '--', '', ''),
(83, 11, 0, '', '', '', '--', '', ''),
(84, 11, 0, '', '', '', '--', '', ''),
(85, 12, 0, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(86, 12, 0, '', '', '', '--', '', ''),
(87, 12, 0, '', '', '', '--', '', ''),
(88, 12, 0, '', '', '', '--', '', ''),
(89, 12, 0, '', '', '', '--', '', ''),
(90, 12, 0, '', '', '', '--', '', ''),
(91, 13, 0, 'Windows 2003 Server', '2GB', '16GB', 'Yes', 'Default', 'Default server image'),
(92, 13, 0, '', '', '', '--', '', ''),
(93, 13, 0, '', '', '', '--', '', ''),
(94, 13, 0, '', '', '', '--', '', ''),
(95, 13, 0, '', '', '', '--', '', ''),
(96, 13, 0, '', '', '', '--', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `organization` varchar(50) NOT NULL,
  `method_of_contact` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phone`, `organization`, `method_of_contact`) VALUES
(1, 'sdf', 'sdf', '', '', '', 'Phone'),
(2, 'John', 'Doe', 'abc@cdc.gov', '404-555-5555', 'CDC/OSELS/PHITPO', 'Phone'),
(11, 'Jane', 'Doe', 'jane@site.com', '404-555-5555', 'CDC/OSELS/PHITPO', 'Phone'),
(10, '', '', '', '', '', 'Phone'),
(9, '', '', '', '', '', 'Phone'),
(8, 'Jane', 'Doe', 'jane@site.com', '404-555-5555', 'CDC/OSELS/PHITPO', 'Phone'),
(12, '', '', '', '', '', 'Phone'),
(14, 'John ', 'Doe', 'ABC1@CDC.GOV', '404-498-1111', 'CDC/PEO/OD', 'E-mail'),
(13, 'john', '', '', '', '', 'Phone'),
(15, '', '', '', '', '', 'Phone'),
(16, '', '', '', '', '', 'Phone');
