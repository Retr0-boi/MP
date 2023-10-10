-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 09:16 PM
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
-- Table structure for table `bodyweight`
--

CREATE TABLE `bodyweight` (
  `w_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bodyweight`
--

INSERT INTO `bodyweight` (`w_id`, `uid`, `weight`, `date`) VALUES
(1, 2, 20, '2023-09-03'),
(2, 2, 25, '2023-08-01'),
(3, 2, 30, '2023-07-01'),
(4, 2, 22, '2023-06-01'),
(5, 2, 68, '2023-09-05'),
(6, 2, 100, '2023-09-07'),
(7, 2, 50, '2023-09-09'),
(8, 2, 45, '2023-09-17'),
(9, 2, 80, '2023-09-23'),
(10, 2, 45, '2023-09-28'),
(11, 2, 50, '2023-09-30'),
(12, 2, 26, '2023-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `d_id` int(11) NOT NULL,
  `day` text NOT NULL,
  `d_full` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`d_id`, `day`, `d_full`) VALUES
(1, 'Mon', 'Monday'),
(2, 'Tue', 'Tuesday'),
(3, 'Wed', 'Wednesday'),
(4, 'Thu', 'Thursday'),
(5, 'Fri', 'Friday'),
(6, 'Sat', 'Saturday'),
(7, 'Sun', 'Sunday');

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
  `mg_id` int(11) DEFAULT NULL,
  `eq_id` int(11) DEFAULT NULL,
  `ex_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `goal_id` int(11) NOT NULL,
  `UID` int(11) DEFAULT NULL,
  `goal_description` varchar(400) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`goal_id`, `UID`, `goal_description`) VALUES
(30, 2, 'sskjdnsjdssadjkna'),
(28, 2, '5tg5ttgrtgrt'),
(29, 2, 'dfsdfsds');

-- --------------------------------------------------------

--
-- Table structure for table `logged_weights`
--

CREATE TABLE `logged_weights` (
  `weight_id` int(11) NOT NULL,
  `UID` int(11) DEFAULT NULL,
  `ex_id` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logged_weights`
--

INSERT INTO `logged_weights` (`weight_id`, `UID`, `ex_id`, `weight`, `date`) VALUES
(1, 2, 31, 65, '2023-09-30'),
(2, 2, 33, 51, '2023-09-30'),
(3, 2, 34, 57, '2023-09-30'),
(4, 2, 40, 57, '2023-09-30'),
(5, 2, 74, 75, '2023-09-30'),
(6, 2, 75, 58, '2023-09-30'),
(7, 2, 84, 58, '2023-09-30'),
(8, 2, 85, 58, '2023-09-30'),
(9, 2, 34, 23, '2023-10-03'),
(10, 2, 35, 220, '2023-10-03'),
(11, 2, 36, 430, '2023-10-03'),
(12, 2, 37, 23, '2023-10-03'),
(13, 2, 35, 220, '2023-10-03'),
(14, 2, 36, 430, '2023-10-03'),
(15, 2, 18, 34, '2023-10-03'),
(16, 2, 19, 54, '2023-10-03'),
(17, 2, 20, 43, '2023-10-03'),
(18, 2, 21, 54, '2023-10-03'),
(19, 2, 22, 23, '2023-10-03'),
(20, 2, 23, 12, '2023-10-03'),
(21, 2, 35, 23, '2023-10-04'),
(22, 2, 36, 43, '2023-10-04'),
(23, 2, 18, 23, '2023-10-04'),
(24, 2, 19, 54, '2023-10-04'),
(25, 2, 20, 53, '2023-10-04'),
(26, 2, 21, 23, '2023-10-04'),
(27, 2, 22, 12, '2023-10-04'),
(28, 2, 23, 54, '2023-10-04'),
(29, 2, 15, 21, '2023-10-05'),
(30, 2, 16, 23, '2023-10-05'),
(31, 2, 17, 43, '2023-10-05'),
(32, 2, 18, 54, '2023-10-05'),
(33, 2, 19, 65, '2023-10-05'),
(34, 2, 20, 23, '2023-10-05'),
(35, 2, 35, 12, '2023-10-11'),
(36, 2, 36, 32, '2023-10-11'),
(37, 2, 18, 34, '2023-10-11'),
(38, 2, 19, 54, '2023-10-11'),
(39, 2, 20, 12, '2023-10-11'),
(40, 2, 21, 33, '2023-10-11'),
(41, 2, 22, 55, '2023-10-11'),
(42, 2, 23, 43, '2023-10-11');

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
-- Table structure for table `previous_goals`
--

CREATE TABLE `previous_goals` (
  `pg_id` int(11) NOT NULL,
  `g_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `goal_desc` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `completed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `previous_goals`
--

INSERT INTO `previous_goals` (`pg_id`, `g_id`, `uid`, `goal_desc`, `date`, `completed`) VALUES
(6, 4, 2, 'AAAAAAAAAAAAAAAAAA', '2023-09-03', 1),
(10, 13, 2, 'asdsdvsd', '2023-09-05', 1),
(11, 10, 2, 'djfsdnfsjdnkj', '2023-09-07', 0),
(12, 11, 2, 'BBBBBBBBBBBB', '2023-09-07', 1),
(13, 14, 2, 'huefshkbdkhfsbkdhf', '2023-09-09', 0),
(14, 16, 2, 'x sc s ', '2023-09-09', 1),
(15, 15, 2, 'EEEEEEEEEEEEEEEEE', '2023-09-23', 1),
(16, 22, 2, 'eeeeeeeeeeeeeeeeeeeeeeee', '2023-09-23', 0),
(18, 20, 2, 'dffsdfsdfsd', '2023-09-23', 0),
(19, 17, 2, 'sddsgfsf', '2023-09-23', 0),
(20, 23, 2, 'DDDDDDDDDDDDDD', '2023-09-30', 0),
(21, 24, 2, ' c c', '2023-09-30', 0),
(23, 18, 2, '1231231', '2023-10-05', 1),
(24, 27, 2, 'CCCCCCCCCCC', '2023-10-05', 1),
(25, 19, 2, 'sdfsds', '2023-10-05', 0),
(26, 26, 2, 'tgrtg', '2023-10-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `reminder_id` int(11) NOT NULL,
  `UID` int(11) DEFAULT NULL,
  `reminder_text` varchar(400) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`reminder_id`, `UID`, `reminder_text`) VALUES
(8, 2, '123123123123132123'),
(9, 2, 'FFFFFFFFF'),
(11, 2, 'swsws');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `username`, `email`, `password`) VALUES
(1, 'Ned', 'assassinsanu@gmail.com', '12345'),
(2, 'aaa', 'nevinjames420@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

CREATE TABLE `workouts` (
  `w_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `ex_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `date` date NOT NULL,
  `Used` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`w_id`, `uid`, `ex_id`, `day`, `date`, `Used`) VALUES
(41, 2, 34, 1, '2023-09-17', 1),
(42, 2, 35, 1, '2023-09-17', 1),
(43, 2, 36, 1, '2023-09-17', 1),
(44, 2, 37, 1, '2023-09-17', 1),
(48, 2, 1, 3, '2023-09-26', 1),
(49, 2, 2, 3, '2023-09-26', 1),
(50, 2, 4, 3, '2023-09-26', 1),
(51, 2, 35, 2, '2023-09-26', 1),
(52, 2, 36, 2, '2023-09-26', 1),
(53, 2, 19, 5, '2023-09-29', 1),
(54, 2, 22, 5, '2023-09-29', 1),
(55, 2, 23, 5, '2023-09-29', 1),
(56, 2, 24, 5, '2023-09-29', 1),
(57, 2, 25, 5, '2023-09-29', 1),
(58, 2, 18, 2, '2023-10-03', 1),
(59, 2, 19, 2, '2023-10-03', 1),
(60, 2, 20, 2, '2023-10-03', 1),
(61, 2, 21, 2, '2023-10-03', 1),
(62, 2, 22, 2, '2023-10-03', 1),
(63, 2, 23, 2, '2023-10-03', 1),
(64, 2, 15, 4, '2023-10-05', 1),
(65, 2, 16, 4, '2023-10-05', 1),
(66, 2, 17, 4, '2023-10-05', 1),
(67, 2, 18, 4, '2023-10-05', 1),
(68, 2, 19, 4, '2023-10-05', 1),
(69, 2, 20, 4, '2023-10-05', 1),
(70, 2, 1, 7, '2023-10-05', 1),
(71, 2, 2, 7, '2023-10-05', 1),
(72, 2, 3, 7, '2023-10-05', 1),
(73, 2, 4, 7, '2023-10-05', 1),
(74, 2, 5, 7, '2023-10-05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bodyweight`
--
ALTER TABLE `bodyweight`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`eq_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`ex_id`),
  ADD KEY `mg_id` (`mg_id`),
  ADD KEY `eq_id` (`eq_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `logged_weights`
--
ALTER TABLE `logged_weights`
  ADD PRIMARY KEY (`weight_id`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `musclegroup`
--
ALTER TABLE `musclegroup`
  ADD PRIMARY KEY (`mg_id`);

--
-- Indexes for table `previous_goals`
--
ALTER TABLE `previous_goals`
  ADD PRIMARY KEY (`pg_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`reminder_id`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `ex_id` (`ex_id`),
  ADD KEY `day` (`day`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bodyweight`
--
ALTER TABLE `bodyweight`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `logged_weights`
--
ALTER TABLE `logged_weights`
  MODIFY `weight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `previous_goals`
--
ALTER TABLE `previous_goals`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bodyweight`
--
ALTER TABLE `bodyweight`
  ADD CONSTRAINT `bodyweight_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`UID`);

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`mg_id`) REFERENCES `musclegroup` (`mg_id`),
  ADD CONSTRAINT `exercises_ibfk_2` FOREIGN KEY (`eq_id`) REFERENCES `equipment` (`eq_id`);

--
-- Constraints for table `previous_goals`
--
ALTER TABLE `previous_goals`
  ADD CONSTRAINT `previous_goals_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`UID`);

--
-- Constraints for table `workouts`
--
ALTER TABLE `workouts`
  ADD CONSTRAINT `workouts_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`UID`),
  ADD CONSTRAINT `workouts_ibfk_2` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`),
  ADD CONSTRAINT `workouts_ibfk_3` FOREIGN KEY (`day`) REFERENCES `days` (`d_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
