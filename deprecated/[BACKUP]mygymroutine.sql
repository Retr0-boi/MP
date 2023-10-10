-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2023 at 06:25 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mygymroutine`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `eq_id` int NOT NULL,
  `eq_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`eq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`eq_id`, `eq_name`) VALUES
(1, 'Barbell'),
(2, 'Dumbbell'),
(3, 'Machine'),
(4, 'Bodyweight'),
(5, 'Kettlebell');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

DROP TABLE IF EXISTS `exercises`;
CREATE TABLE IF NOT EXISTS `exercises` (
  `ex_id` int NOT NULL AUTO_INCREMENT,
  `mg_id` int DEFAULT NULL,
  `eq_id` int DEFAULT NULL,
  `ex_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ex_id`),
  KEY `mg_id` (`mg_id`),
  KEY `eq_id` (`eq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`ex_id`, `mg_id`, `eq_id`, `ex_name`) VALUES
(1, 1, 1, 'Bench Press'),
(2, 1, 1, 'Inclined Bench Press'),
(3, 1, 1, 'Decline Bench Press'),
(4, 1, 2, 'Dumbbell Chest Press'),
(5, 1, 2, 'Dumbbell Fly'),
(6, 1, 4, 'Chest Dips'),
(7, 1, 4, 'Push-Ups'),
(8, 1, 3, 'Cable Crossover'),
(9, 1, 2, 'Inclined Dumbbell Press'),
(10, 1, 2, 'Inclined Fly'),
(11, 1, 3, 'Pec Deck Machine'),
(12, 1, 4, 'Plyometric Push-Ups'),
(13, 1, 4, 'Wide Grip Push-Ups'),
(14, 1, 2, 'Dumbell Pullovers'),
(15, 2, 1, 'Barbell Rows'),
(16, 2, 1, 'T-Bar Rows'),
(17, 2, 1, 'Bent Over Rows'),
(18, 2, 2, 'One-Arm Dumbbell Rows'),
(19, 2, 3, 'Seated Cable Rows'),
(20, 2, 4, 'Chin-Ups'),
(21, 2, 4, 'Pull-Ups'),
(22, 2, 2, 'Dumbbell Rows'),
(23, 2, 2, 'Renegade Rows'),
(24, 2, 2, 'Bent Over Reverse Fly'),
(25, 2, 3, 'Wide Grip Lat Pulldowns'),
(26, 2, 3, 'Close Grip Lat Pulldowns'),
(27, 2, 3, 'Lat Pulldowns'),
(28, 2, 3, 'Machine Pullovers'),
(29, 2, 3, 'Straight Arm Pulldowns'),
(30, 2, 3, 'Assisted Pull-Ups'),
(31, 3, 1, 'Squats'),
(32, 3, 1, 'Front Squats'),
(33, 3, 3, 'Hack Squats'),
(34, 3, 3, 'Leg Press'),
(35, 3, 2, 'Barbell Lunges'),
(36, 3, 2, 'Step-Ups'),
(37, 3, 2, 'Dumbbell Lunges'),
(38, 3, 2, 'Goblet Squats'),
(39, 3, 2, 'Bulgarian Split Squats'),
(40, 3, 3, 'Leg Extensions'),
(41, 3, 3, 'Hamstring Curls'),
(42, 3, 3, 'Seated Leg Curl'),
(43, 3, 3, 'Leg Adduction Machine'),
(44, 4, 1, 'Close Grip Bench Press'),
(45, 4, 1, 'Skull Crushers'),
(46, 4, 4, 'Triceps Dips'),
(47, 4, 1, 'Overhead Triceps Extension'),
(48, 4, 3, 'Cable Pushdowns'),
(49, 4, 4, 'Diamond Push-Ups'),
(50, 4, 2, 'Dumbbell Triceps Extension'),
(51, 4, 2, 'Seated Triceps Press'),
(52, 4, 2, 'Triceps Kickbacks'),
(53, 4, 2, 'Dumbbell Skull Crushers'),
(54, 4, 3, 'Cable Rope Overhead Triceps Extension'),
(55, 4, 3, 'Triceps Pushdowns'),
(56, 4, 3, 'Triceps Rope Pushdowns'),
(57, 4, 3, 'Dip Machine'),
(58, 4, 3, 'V-Bar Pushdowns'),
(59, 5, 2, 'Barbell Curls'),
(60, 5, 2, 'Hammer Curls'),
(61, 5, 1, 'Preacher Curls'),
(62, 5, 2, 'Incline Dumbbell Curls'),
(63, 5, 2, 'Concentration Curls'),
(64, 5, 4, 'Chin-Ups'),
(65, 5, 2, 'Dumbbell Hammer Curls'),
(66, 5, 2, 'Spider Curls'),
(67, 5, 1, 'EZ Bar Curls'),
(68, 5, 3, 'Cable Curls'),
(69, 5, 2, 'Reverse Grip Barbell Curls'),
(70, 5, 3, 'Cable Preacher Curls'),
(71, 5, 3, 'Machine Bicep Curls'),
(72, 5, 3, 'Reverse Cable Curls'),
(73, 6, 1, 'Military Press'),
(74, 6, 2, 'Arnold Press'),
(75, 6, 1, 'Push Press'),
(76, 6, 2, 'Barbell Front Raise'),
(77, 6, 2, 'Barbell Upright Row'),
(78, 6, 2, 'Lateral Raises'),
(79, 6, 1, 'Barbell Shrugs'),
(80, 6, 2, 'Dumbbell Shoulder Press'),
(81, 6, 2, 'Bent-Over Dumbbell Reverse Fly'),
(82, 6, 2, 'Dumbbell Shrug'),
(83, 6, 3, 'Machine Shoulder Press'),
(84, 6, 3, 'Cable Lateral Raises'),
(85, 6, 3, 'Cable Face Pulls'),
(86, 7, 4, 'Crunches'),
(87, 7, 4, 'Russian Twists'),
(88, 7, 4, 'Leg Raises'),
(89, 7, 4, 'Plank'),
(90, 7, 5, 'Machine Crunches'),
(91, 7, 5, 'Cable Woodchoppers'),
(92, 7, 5, 'Decline Sit-Ups'),
(93, 8, 3, 'Standing Calf Raises'),
(94, 8, 3, 'Seated Calf Raises'),
(95, 8, 5, 'Machine Calf Raises'),
(96, 8, 5, 'Donkey Calf Raises'),
(97, 8, 4, 'Calf Raises'),
(98, 9, 2, 'Reverse Barbell Curls'),
(99, 9, 2, 'Wrist Curls'),
(100, 9, 2, 'Farmers Walk'),
(101, 9, 2, 'Dumbbell Wrist Curls'),
(102, 9, 2, 'Reverse Dumbbell Wrist Curls'),
(103, 9, 4, 'Reverse Push-Ups'),
(104, 9, 4, 'Finger Push-Ups');

-- --------------------------------------------------------

--
-- Table structure for table `musclegroup`
--

DROP TABLE IF EXISTS `musclegroup`;
CREATE TABLE IF NOT EXISTS `musclegroup` (
  `mg_id` int NOT NULL,
  `mg_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `musclegroup`
--

INSERT INTO `musclegroup` (`mg_id`, `mg_name`) VALUES
(1, 'Chest'),
(2, 'Back'),
(3, 'Legs'),
(4, 'Triceps'),
(5, 'Biceps'),
(6, 'Shoulders'),
(7, 'Abs'),
(8, 'Calves'),
(9, 'Forearms');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`UID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `username`, `email`, `password`) VALUES
(1, 'Ned', 'assassinsanu@gmail.com', '12345'),
(2, 'aaa', 'nevinjames420@gmail.com', '456123789');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`mg_id`) REFERENCES `musclegroup` (`mg_id`),
  ADD CONSTRAINT `exercises_ibfk_2` FOREIGN KEY (`eq_id`) REFERENCES `equipment` (`eq_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
