-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2014 at 12:55 AM
-- Server version: 5.0.96-community
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `data_synd_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(64) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL default '0',
  `last_login` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `logins`, `last_login`) VALUES
(2, 'jnguyen', 'John', 'Nguyen', 'jnguyen@landhub.com', '547efbd26baf5c496b0fb6181709eedbe3e7ca8900785ee020f6f21c7d94bde5', 19, 1390789616),
(3, 'jeran', 'Jeran', 'Fraser', 'surfraser@gmail.com', 'a5ff75f4e657551a5548c6f657aa96da1bc228347aae8c863eb34b11379ced60', 1, 1389150431),
(4, 'frederick', 'Frederick', 'Sandalo', 'frederick.sandalo@ripeconcepts.com', 'abc2205e085ac56702309588d67bbaa69ebc45fe29108d805bf7bda201ca4a17', 7, 1390966037);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
         