-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2021 at 06:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `contact_description` text NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `surname`, `contact_description`, `department_id`, `date`) VALUES
(13, 'Bravo', 'Kastrati', 'mila mila', 5, '2021-02-14 18:30:16'),
(16, 'Filiza', 'Kastrati', 'Termini', 2, '2021-02-13 00:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `description`, `create_date`, `photo`) VALUES
(2, 'Neurology', 'Neurologists in the Medical Clinic have a reputation for finding and diagnosing problems that have confused others in the medical field. They can now treat almost every disease to some point.', '2021-02-14 18:04:27', '/medical-clinic/photos/Neurology.png'),
(3, 'Orthopedics', 'Our orthopedists are highly-trained experts and leaders in their field, committed to delivering orthopedic excellence and personalized care. Each doctor has gone beyond general orthopedic training to specialize in a specific part of the body.', '2021-02-14 18:04:33', '/medical-clinic/photos/Orthopedics.png'),
(5, 'Cardiology', 'Our Cardiologists are highly-trained experts and leaders in their field, committed to delivering orthopedic excellence and personalized care. Each doctor has gone beyond general orthopedic training to specialize in a specific part of the body.	', '2021-02-14 18:22:54', '/medical-clinic/photos/Cardiology.png');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `bio` text DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `surname`, `bio`, `department_id`, `photo`) VALUES
(1, 'Dr.Andrew', 'Khan', 'Dr Andrew Khan is absolutely amaizing very professional, kind and takes his time with his patient. Dr.Khan works in medical Clinic and specializes in Emergency Medicine.                                ', 5, '/medical-clinic/photos/Andrew Khan.png'),
(2, 'Dr.Amelia', 'Write', 'Dr Amelia Amelia is absolutely amaizing very professional, kind and takes his time with his patient. Dr.Khan works in medical Clinic and specializes in Emergency Medicine.	', 2, '/medical-clinic/photos/Amelia Write.png'),
(3, 'Dr.Anthony ', 'Robins', 'Dr Anthony Robins is absolutely amaizing very professional, kind and takes his time with his patient. Dr.Khan works in medical Clinic and specializes in Emergency Medicine.	', 3, '/medical-clinic/photos/Anthony Robins.png');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `create_date`) VALUES
(1, 'gg@gg.ccc', '2021-02-12 20:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `date`, `photo`) VALUES
(1, 'About the Medical Clinic Lixa', '           Welcome to My Medical Clinic, We specialize in providing \r\n             care for working adults with a full spectrum of Occupational\r\n             Health Services including ON SITE services.For your convenience,\r\n             our care plans are optimized to take care of both \r\n            Employer and Employee health clinic needs. We perform Immigration   Medical Exam, DOT physical exam, Pre employment drug test, \r\n            agility testing, drug screening,random testing, DOT exam, asbestos \r\n            testing, Silica physical exam, and more. Chiropractic care is also\r\n            conveniently available at the medical clinic to provide care overseen\r\n             by the MD. We can also take care of your non-work related medical \r\n             conditions.Visit us to experience the full benefits of having Board Certified         ', '2021-02-14 18:03:03', '/medical-clinic/photos/aboutus.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `surname` varchar(60) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `user_role` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `user_role`, `password`) VALUES
(2, 'Filiza', 'Kastrati', 'filizakastrati1@gmail.com', 'admin', 'd41d8cd98f00b204e9800998ecf8427e'),
(24, 'GetoarT', 'Kastrati', 'getoarkastrati1@gmail.com', 'super_admin', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_department_id_fk` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_department_id_fk` (`department_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletter_email_uindex` (`email`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_users_email_uindex` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `contact_department_id_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_department_id_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
