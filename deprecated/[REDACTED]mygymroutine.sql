-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 07:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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

CREATE TABLE `equipment` (
  `eq_id` int(11) NOT NULL,
  `eq_name` varchar(50) NOT NULL
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

CREATE TABLE `exercises` (
  `ex_id` int(11) NOT NULL,
  `ex_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`ex_id`, `ex_name`) VALUES
(1, 'Bench Press'),
(2, 'Push-ups'),
(3, 'Dumbbell Fly'),
(4, 'Pull-ups'),
(5, 'Lat Pulldown'),
(6, 'Deadlift'),
(7, 'Squats'),
(8, 'Leg Press'),
(9, 'Lunges'),
(10, 'Tricep Dips'),
(11, 'Tricep Pushdown'),
(12, 'Skull Crushers'),
(13, 'Bicep Curls'),
(14, 'Hammer Curls'),
(15, 'Barbell Shoulder Press'),
(16, 'Dumbbell Lateral Raise'),
(17, 'Plank'),
(18, 'Crunches'),
(19, 'Standing Calf Raises'),
(20, 'Seated Calf Raises'),
(21, 'Wrist Curls'),
(22, 'Incline Bench Press'),
(23, 'Decline Bench Press'),
(24, 'Cable Fly'),
(25, 'Dumbbell Bench Press'),
(26, 'Renegade Rows'),
(27, 'Seated Cable Row'),
(28, 'Barbell Rows'),
(29, 'Hack Squat'),
(30, 'Step-ups'),
(31, 'Leg Extensions'),
(32, 'Romanian Deadlift'),
(33, 'Overhead Tricep Extension'),
(34, 'Tricep Kickbacks'),
(35, 'Close Grip Bench Press'),
(36, 'Chin-ups'),
(37, 'EZ Bar Curls'),
(38, 'Preacher Curls'),
(39, 'Arnold Press'),
(40, 'Upright Rows'),
(41, 'Russian Twist'),
(42, 'Hanging Leg Raises'),
(43, 'Standing Calf Raises'),
(44, 'Single Leg Calf Raises'),
(45, 'Reverse Curls'),
(46, 'Chest Press'),
(47, 'Incline Push-ups'),
(48, 'Incline Dumbbell Fly'),
(49, 'Single Arm Rows'),
(50, 'Wide Grip Pulldowns'),
(51, 'T-Bar Rows'),
(52, 'Front Squats'),
(53, 'Hamstring Curls'),
(54, 'Bulgarian Split Squats'),
(55, 'Diamond Push-ups'),
(56, 'Tricep Rope Pushdown'),
(57, 'Lying Tricep Extensions'),
(58, 'Concentration Curls'),
(59, 'Reverse Curls'),
(60, 'Shoulder Press Machine'),
(61, 'Dumbbell Front Raise'),
(62, 'Sit-ups'),
(63, 'Leg Raises'),
(64, 'Donkey Calf Raises'),
(65, 'Box Jumps'),
(66, 'Hammer Strength Rows'),
(67, 'Sumo Deadlift'),
(68, 'Close Grip Pulldowns'),
(69, 'Hack Squat Machine'),
(70, 'Lunges with Dumbbells'),
(71, 'Goblet Squats'),
(72, 'Skull Crushers with Dumbbell'),
(73, 'Bench Dips'),
(74, 'EZ Bar Preacher Curls'),
(75, 'Seated Incline Dumbbell Curls'),
(76, 'Barbell Shrugs'),
(77, 'Dumbbell Shrugs'),
(78, 'Russian Twist with Medicine Ball'),
(79, 'Hanging Knee Raises'),
(80, 'Seated Calf Raises'),
(81, 'Farmers Walk'),
(82, 'Hammer Curls with Dumbbell'),
(83, 'Decline Bench Press with Barbell'),
(84, 'Dumbbell Pullover'),
(85, 'Cable Crossover'),
(86, 'Wide Grip Pull-ups'),
(87, 'One-Arm Dumbbell Rows'),
(88, 'Reverse Grip Pulldowns'),
(89, 'Front Squats with Dumbbell'),
(90, 'Leg Press Machine'),
(91, 'Box Squats'),
(92, 'Tricep Kickbacks with Dumbbell'),
(93, 'Close Grip Push-ups'),
(94, 'Skull Crushers with EZ Bar'),
(95, 'Hammer Curls with Barbell'),
(96, 'Spider Curls'),
(97, 'Arnold Press with Dumbbell'),
(98, 'Lateral Raises with Cable'),
(99, 'Side Plank'),
(100, 'Bicycle Crunches'),
(101, 'Seated Calf Raises with Barbell'),
(102, 'Jump Squats'),
(103, 'T-Bar Rows with Handle'),
(104, 'Single Arm Dumbbell Rows'),
(105, 'Sumo Squats'),
(106, 'Step-ups with Dumbbell'),
(107, 'Cable Crunches'),
(108, 'Hanging Leg Raises with Twist'),
(109, 'Seated Calf Raises with Dumbbell'),
(110, 'Donkey Kicks'),
(111, 'Wide Grip Cable Fly'),
(112, 'Incline Dumbbell Press'),
(113, 'Dumbbell Pullover'),
(114, 'Close Grip Pull-ups'),
(115, 'Bent Over Rows'),
(116, 'Step-ups with Barbell'),
(117, 'Romanian Deadlift with Dumbbell'),
(118, 'Leg Curl Machine'),
(119, 'Diamond Push-ups'),
(120, 'Close Grip Bench Press with Dumbbell'),
(121, 'Overhead Tricep Extension with Cable'),
(122, 'Hammer Curls with Dumbbell'),
(123, 'Wide Grip Barbell Curls'),
(124, 'Shoulder Press with Dumbbell'),
(125, 'Seated Military Press'),
(126, 'Oblique Crunches'),
(127, 'Mountain Climbers'),
(128, 'Single Leg Calf Raises with Dumbbell'),
(129, 'Calf Press Machine'),
(130, 'High Rows'),
(131, 'Reverse Grip Barbell Rows'),
(132, 'Goblet Squats with Kettlebell'),
(133, 'Jump Lunges'),
(134, 'Tricep Kickbacks with Cable'),
(135, 'Close Grip Push-ups with Band'),
(136, 'Hammer Curls with EZ Bar'),
(137, '21s'),
(138, 'Arnold Press with Barbell'),
(139, 'Dumbbell Front Raise with Twist'),
(140, 'Medicine Ball Russian Twist'),
(141, 'Hanging Windshield Wipers'),
(142, 'Single Leg Calf Raises with Barbell'),
(143, 'Seated Calf Raises with Machine'),
(144, 'Wide Grip Lat Pulldown'),
(145, 'Single Arm Cable Rows'),
(146, 'Bulgarian Split Squats with Dumbbell'),
(147, 'Sissy Squats'),
(148, 'Tricep Dips with Bands'),
(149, 'Close Grip Bench Press with EZ Bar'),
(150, 'Spider Curls with Dumbbell'),
(151, 'Chest Press Machine'),
(152, 'Incline Dumbbell Press'),
(153, 'Hammer Strength Chest Press'),
(154, 'Seated Cable Row'),
(155, 'Pullover Machine'),
(156, 'Wide Grip Rows'),
(157, 'Front Squats with Barbell'),
(158, 'Leg Extension Machine'),
(159, 'Dumbbell Lunges'),
(160, 'Tricep Rope Pushdowns'),
(161, 'Overhead Tricep Extensions with Dumbbell'),
(162, 'Close Grip Bench Press with Bands'),
(163, 'Concentration Curls with Dumbbell'),
(164, 'Hammer Curls with Kettlebell'),
(165, 'Arnold Press with Machine'),
(166, 'Seated Dumbbell Shoulder Press'),
(167, 'Russian Twist with Weighted Medicine Ball'),
(168, 'Hanging Leg Raises with Medicine Ball'),
(169, 'Donkey Calf Raises with Machine'),
(170, 'Standing Calf Raises with Kettlebell'),
(171, 'Lat Pulldown Machine'),
(172, 'Inverted Rows'),
(173, 'Smith Machine Squats'),
(174, 'Leg Curl Machine'),
(175, 'Walking Lunges'),
(176, 'Tricep Pushdowns with Bands'),
(177, 'Dumbbell Skull Crushers'),
(178, 'Close Grip Bench Press with Smith Machine'),
(179, 'Preacher Curls with Dumbbell'),
(180, 'Reverse Barbell Curls'),
(181, 'Seated Dumbbell Lateral Raises'),
(182, 'Behind the Neck Press'),
(183, 'Russian Twist with Weight Plate'),
(184, 'Hanging Knee Raises with Weighted Anklets'),
(185, 'Seated Calf Raises with Smith Machine'),
(186, 'Calf Raises with Weight Plate'),
(187, 'Machine Chest Fly'),
(188, 'Decline Push-ups'),
(189, 'Incline Dumbbell Fly'),
(190, 'Cable Rows'),
(191, 'Pulldowns with Bands'),
(192, 'Wide Grip Pull-ups with Weighted Belt'),
(193, 'Hack Squats with Machine'),
(194, 'Step-ups with Kettlebell'),
(195, 'Smith Machine Lunges'),
(196, 'Dips'),
(197, 'Overhead Tricep Extensions with Cable'),
(198, 'Close Grip Bench Press with Dumbbell'),
(199, 'Hammer Curls with Cable'),
(200, 'Zottman Curls'),
(201, 'Seated Military Press Machine'),
(202, 'Plate Front Raise'),
(203, 'Medicine Ball Crunches'),
(204, 'Hanging Windshield Wipers with Weighted Anklets'),
(205, 'Seated Calf Raises with Smith Machine'),
(206, 'Calf Raises with Dumbbell');

-- --------------------------------------------------------

--
-- Table structure for table `ex_mg`
--

CREATE TABLE `ex_mg` (
  `ex_id` int(11) DEFAULT NULL,
  `mg_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ex_mg`
--

INSERT INTO `ex_mg` (`ex_id`, `mg_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 2),
(7, 3),
(8, 3),
(9, 3),
(10, 4),
(11, 5),
(12, 4),
(13, 5),
(14, 5),
(15, 6),
(16, 6),
(17, 7),
(18, 7),
(19, 8),
(20, 8),
(21, 9),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 2),
(27, 2),
(28, 2),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 4),
(34, 4),
(35, 4),
(36, 5),
(37, 5),
(38, 5),
(39, 6),
(40, 6),
(41, 7),
(42, 7),
(43, 8),
(44, 8),
(45, 9),
(46, 1),
(47, 1),
(48, 1),
(49, 2),
(50, 2),
(51, 2),
(52, 3),
(53, 3),
(54, 3),
(55, 4),
(56, 5),
(57, 4),
(58, 5),
(59, 5),
(60, 6),
(61, 6),
(62, 7),
(63, 7),
(64, 8),
(65, 8),
(66, 2),
(67, 2),
(68, 2),
(69, 3),
(70, 3),
(71, 4),
(72, 4),
(73, 4),
(74, 5),
(75, 5),
(76, 6),
(77, 6),
(78, 7),
(79, 7),
(80, 8),
(81, 8),
(82, 9),
(83, 1),
(84, 1),
(85, 1),
(86, 2),
(87, 2),
(88, 2),
(89, 3),
(90, 3),
(91, 3),
(92, 4),
(93, 4),
(94, 4),
(95, 5),
(96, 5),
(97, 6),
(98, 6),
(99, 7),
(100, 7),
(101, 8),
(102, 8),
(103, 2),
(104, 2),
(105, 3),
(106, 3),
(107, 7),
(108, 7),
(109, 8),
(110, 8),
(111, 1),
(112, 1),
(113, 2),
(114, 2),
(115, 2),
(116, 3),
(117, 3),
(118, 3),
(119, 4),
(120, 4),
(121, 5),
(122, 5),
(123, 5),
(124, 6),
(125, 6),
(126, 7),
(127, 7),
(128, 8),
(129, 8),
(130, 2),
(131, 2),
(132, 3),
(133, 3),
(134, 4),
(135, 4),
(136, 5),
(137, 5),
(138, 6),
(139, 6),
(140, 7),
(141, 7),
(142, 8),
(143, 8),
(144, 2),
(145, 2),
(146, 3),
(147, 3),
(148, 4),
(149, 4),
(150, 5),
(151, 5),
(152, 1),
(153, 8),
(154, 2),
(155, 1),
(156, 2),
(157, 3),
(158, 3),
(159, 3),
(160, 4),
(161, 4),
(162, 4),
(163, 5),
(164, 4),
(165, 6),
(166, 6),
(167, 7),
(168, 7),
(169, 8),
(170, 8),
(171, 2),
(172, 2),
(173, 3),
(174, 3),
(175, 3),
(176, 4),
(177, 4),
(178, 4),
(179, 5),
(180, 5),
(181, 6),
(182, 6),
(183, 7),
(184, 7),
(185, 8),
(186, 8),
(187, 1),
(188, 1),
(189, 1),
(190, 2),
(191, 2),
(192, 2),
(193, 3),
(194, 3),
(195, 3),
(196, 4),
(197, 4),
(198, 4),
(199, 5),
(200, 5),
(201, 6),
(202, 6),
(203, 7),
(204, 7),
(205, 8),
(206, 8);

-- --------------------------------------------------------

--
-- Table structure for table `musclegroup`
--

CREATE TABLE `musclegroup` (
  `mg_id` int(11) NOT NULL,
  `mg_name` varchar(50) NOT NULL
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

CREATE TABLE `users` (
  `username` varchar(25) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('Ned', 'assassinsanu@gmail.com', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`eq_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `ex_mg`
--
ALTER TABLE `ex_mg`
  ADD KEY `ex_id` (`ex_id`),
  ADD KEY `mg_id` (`mg_id`);

--
-- Indexes for table `musclegroup`
--
ALTER TABLE `musclegroup`
  ADD PRIMARY KEY (`mg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ex_mg`
--
ALTER TABLE `ex_mg`
  ADD CONSTRAINT `ex_mg_ibfk_1` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`),
  ADD CONSTRAINT `ex_mg_ibfk_2` FOREIGN KEY (`mg_id`) REFERENCES `musclegroup` (`mg_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
