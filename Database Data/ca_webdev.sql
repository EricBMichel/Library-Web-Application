-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ca_webdev
CREATE DATABASE IF NOT EXISTS `ca_webdev` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ca_webdev`;

-- Dumping structure for table ca_webdev.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ca_webdev.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
	(1, 'Admin', '$2y$10$H0vgul8S3ckl9f91O/WV5ekAZfdh7.abXxWd8/jIH.ZlN4RuqEbjy');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table ca_webdev.checkout
CREATE TABLE IF NOT EXISTS `checkout` (
  `cart_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table ca_webdev.checkout: ~4 rows (approximately)
/*!40000 ALTER TABLE `checkout` DISABLE KEYS */;
INSERT INTO `checkout` (`cart_id`, `student_id`, `book_id`) VALUES
	(117, 2016444, 10),
	(121, 2016555, 26),
	(123, 2016222, 6);
/*!40000 ALTER TABLE `checkout` ENABLE KEYS */;

-- Dumping structure for table ca_webdev.library
CREATE TABLE IF NOT EXISTS `library` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `isbn` int(10) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Available',
  `due_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table ca_webdev.library: ~29 rows (approximately)
/*!40000 ALTER TABLE `library` DISABLE KEYS */;
INSERT INTO `library` (`book_id`, `title`, `author`, `isbn`, `status`, `due_date`) VALUES
	(1, 'How To Train Your Dragon', 'Cressida Cowell', 1500111111, 'Available', NULL),
	(2, 'Harry Potter and the Chamber of Secrets', 'JK Rowling', 1500111222, 'Available', NULL),
	(3, 'Sherlock Holmes', 'Conan Doyle', 1500111333, 'Available', NULL),
	(4, 'How to Code in PHP', 'Sean Cahill', 1500111444, 'Available', NULL),
	(5, 'Lord of the Rings: The Fellowship of the Rings', 'JRR Tolkien', 1500111555, 'Available', NULL),
	(6, 'A Song of Ice and Fire: Game of Thrones', 'George RR Martin', 1500111666, 'Checked Out', '2017-12-05 14:28:48'),
	(7, 'A Song of Ice and Fire: Storm of Swords', 'George RR Martin', 1500111777, 'Available', NULL),
	(8, 'A Song of Ice and Fire: Clash of Kings', 'George RR Martin', 1500111888, 'Available', NULL),
	(9, 'A Song of Ice and Fire: Feast for Crows', 'George RR Martin', 1500111999, 'Available', NULL),
	(10, 'Harry Potter and the Prisoner of Azkaban', 'JK Rowling', 1500222111, 'Checked Out', '2017-11-27 10:39:39'),
	(11, 'Oliver Twist', 'Charles Dickens', 1500222222, 'Available', NULL),
	(12, 'Peter Rabbit', 'Beatrix Potter', 1500222333, 'Available', NULL),
	(13, 'Charlie and The Chocolate Factory', 'Roald Dahl', 1500222444, 'Available', NULL),
	(14, 'The BFG', 'Roald Dahl', 1500222555, 'Available', NULL),
	(15, 'The Da Vinci Code', 'Dan Brown', 1500222666, 'Available', NULL),
	(16, 'Ready Player One', 'Ernest Cline', 1500222777, 'Available', NULL),
	(17, 'The Passenger', 'Lisa Lutz', 1500222888, 'Available', NULL),
	(18, 'Animal Farm', 'George Orwell', 1500222999, 'Available', NULL),
	(19, 'Charlotte\'s Web', 'EB White', 1500333111, 'Available', NULL),
	(20, 'How Salt Your Passwords', 'Sean Cahill', 1500333222, 'Available', NULL),
	(21, 'Angels & Demons', 'Dan Brown', 1500333333, 'Available', NULL),
	(22, 'Digital Fortress', 'Dan Brown', 1500333444, 'Available', NULL),
	(23, 'Harry Potter and the Goblet of Fire', 'JK Rowling', 1500333555, 'Available', NULL),
	(25, 'Peter Rabbit', 'Beatrix Potter', 1500222333, 'Available', NULL),
	(26, 'The Hobbit', 'JRR Tolkien', 1500333666, 'Checked Out', '2017-12-05 11:45:20'),
	(27, 'The Kite Runner', 'Khalad Hossini', 1500333777, 'Available', NULL),
	(28, 'And the Mountains Echoed', 'Khalad Hossini', 1500333888, 'Available', NULL),
	(29, 'Moby Dick', 'Herman Melville', 1500333999, 'Available', NULL),
	(30, 'Matilda', 'Roald Dahl', 1500444111, 'Available', NULL),
	(31, 'Testing PHP', 'Eric Michel', 1500111111, 'Available', NULL);
/*!40000 ALTER TABLE `library` ENABLE KEYS */;

-- Dumping structure for table ca_webdev.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table ca_webdev.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `username`, `password`, `student_id`) VALUES
	(1, 'Kira', '$2y$10$4xjnrAkXO2UrpKGw4Em9GuQ4RpXb9iz6.wMM3jQlngPYMSMI3VCni', 2016222),
	(2, 'Aideen', '$2y$10$E3FztsBeA6YblpB7ecMZVe1Q8tt9OKEN0obUAC6S.IQjTL.lJ9Y0K', 2016333),
	(3, 'John', '$2y$10$/9VUMmrK6ZTGYC.k7xF1o.ZEgD.0vcuzedMSaESWku3.EcJ.rvtkS', 2016444),
	(4, 'RickyG', '$2y$10$mcOJJbQ802htIK3pVwPtu.ycybAriMXqdlt52JdAZ/QJJj7PoIfgy', 2016555),
	(5, 'Vilma', '$2y$10$UedAgQve9hsLKHnUqEETCuBfQmcWlytjCA0Z1j50kXSp1Gx4mPFvm', 2016111);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
