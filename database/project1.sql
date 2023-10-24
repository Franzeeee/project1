-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for project1
CREATE DATABASE IF NOT EXISTS `project1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `project1`;

-- Dumping structure for table project1.enrolledstudents
CREATE TABLE IF NOT EXISTS `enrolledstudents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `subject_enrolled` int NOT NULL,
  `grade` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_enrolledstudents_students` (`student_id`),
  KEY `FK_enrolledstudents_instructor_subject` (`subject_enrolled`),
  CONSTRAINT `FK_enrolledstudents_instructor_subject` FOREIGN KEY (`subject_enrolled`) REFERENCES `instructor_subject` (`id`),
  CONSTRAINT `FK_enrolledstudents_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table project1.enrolledstudents: ~2 rows (approximately)
INSERT INTO `enrolledstudents` (`id`, `student_id`, `subject_enrolled`, `grade`) VALUES
	(2, 2, 5, 1.2),
	(3, 4, 5, 2);

-- Dumping structure for table project1.instructor
CREATE TABLE IF NOT EXISTS `instructor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table project1.instructor: ~10 rows (approximately)
INSERT INTO `instructor` (`id`, `lastname`, `firstname`, `middlename`) VALUES
	(1, 'Diaz', 'Franz', 'Pacheco'),
	(13, 'Doe', 'John', 'Mc'),
	(25, 'Michael ', 'John', 'Smith'),
	(26, 'Sarah', 'Johnson ', 'Jones'),
	(27, 'Roberts', 'Wilson', 'Collins'),
	(28, 'Sampaguita', 'Jonas', 'Bao'),
	(29, 'Simpson', 'Emilda', 'Cruz'),
	(30, 'Baug', 'Garry', 'Lee'),
	(31, 'Itim', 'Emily', 'Brown'),
	(32, 'Matatag', 'Akio', 'Ci');

-- Dumping structure for table project1.instructor_subject
CREATE TABLE IF NOT EXISTS `instructor_subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_id` int NOT NULL,
  `instructor_id` int NOT NULL,
  `schedule` varchar(50) NOT NULL DEFAULT 'TBA',
  `room` varchar(50) NOT NULL DEFAULT 'TBA',
  `totalStudents` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_instructor_subject_instructor` (`instructor_id`),
  KEY `FK_instructor_subject_subjects` (`subject_id`),
  CONSTRAINT `FK_instructor_subject_instructor` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`),
  CONSTRAINT `FK_instructor_subject_subjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table project1.instructor_subject: ~3 rows (approximately)
INSERT INTO `instructor_subject` (`id`, `subject_id`, `instructor_id`, `schedule`, `room`, `totalStudents`) VALUES
	(5, 7, 1, 'TF 1:00-2:00PM', 'ORC 15', 2),
	(10, 8, 13, '1', '1', 0),
	(11, 8, 1, 'W 7:30-9:30 AM', 'COMLAB 2', 0);

-- Dumping structure for table project1.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `student_id` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project1.students: ~2 rows (approximately)
INSERT INTO `students` (`id`, `lastname`, `firstname`, `student_id`) VALUES
	(2, 'Cormero', 'Jhon Vincent', 2100816),
	(4, 'Noveda', 'Francis Kyle', 2100862);

-- Dumping structure for table project1.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `unit` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project1.subjects: ~5 rows (approximately)
INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `unit`) VALUES
	(6, 'Math', '11TFF', 'Discuss Basic Math', 2),
	(7, 'Science', '23SD', 'Test', 1),
	(8, 'English', '32', 'Test Sub', 2),
	(9, 'GIS', '69', '69 Bungot', 69),
	(10, 'Mobile Dev', '2121fk', 'fjdskfsdf', 2);

-- Dumping structure for table project1.user_profile
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project1.user_profile: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
