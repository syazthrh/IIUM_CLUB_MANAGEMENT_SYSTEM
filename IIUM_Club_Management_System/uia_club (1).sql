-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 06:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uia_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `AdvisorID` int(11) NOT NULL,
  `StaffID` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `ClubID` int(11) DEFAULT NULL,
  `ClubName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`AdvisorID`, `StaffID`, `Password`, `ClubID`, `ClubName`) VALUES
(1, '2634', '123', 1, 'Titian Asli Club'),
(2, '2314', '1234', 2, 'Akhi Club'),
(3, '1233', '1234', 3, 'Caring Club'),
(4, '4316', '1234', 4, 'Comrade Club'),
(5, '3242', '1234', 5, 'Jasa Club'),
(6, '1406', '1234', 6, 'Inspire Club'),
(7, '1409', '1234', 7, 'STUFF Club'),
(8, '1231', '1234', 8, 'IIUM English Club'),
(9, '5422', '1234', 9, 'IIUM Nasyeed'),
(10, '1235', '1234', 10, 'IIUM Rakan Siswa Yadim');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `ClubID` int(11) NOT NULL,
  `ClubName` varchar(255) DEFAULT NULL,
  `NumOfMembers` int(11) DEFAULT NULL,
  `EstablishmentDate` year(4) DEFAULT NULL,
  `AdvisorName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`ClubID`, `ClubName`, `NumOfMembers`, `EstablishmentDate`, `AdvisorName`) VALUES
(1, 'Titian Asli Club', 300, '2000', 'Anas bin Shamsuddin'),
(2, 'Akhi Club', 200, '2001', 'Muhammad Ashaf'),
(3, 'Caring Club', 443, '1994', 'Dr. Haslinda Jamaludin'),
(4, 'Comrade Club', 700, '1992', 'Dr. Yusuf Haslam'),
(5, 'Jasa Club', 323, '2001', 'Prof. Suhairie'),
(6, 'Inspire Club', 120, '2001', 'Prof. Nasha Zulaikha'),
(7, 'IIUM Student Facilitating Front (Stuff)', 62, '2003', 'Dr. Irdina'),
(8, 'IIUM English Club', 770, '1990', 'Prof. Dr. Balqis'),
(9, 'IIUM Nasyeed', 100, '1995', 'Prof. Haziq'),
(10, 'IIUM Rakan Siswa Yadim', 75, '2019', 'Dr. Shahida');

-- --------------------------------------------------------

--
-- Table structure for table `mainboard`
--

CREATE TABLE `mainboard` (
  `MemberID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `ClubID` int(11) DEFAULT NULL,
  `JoinDate` date DEFAULT NULL,
  `Position` varchar(50) DEFAULT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mainboard`
--

INSERT INTO `mainboard` (`MemberID`, `StudentID`, `ClubID`, `JoinDate`, `Position`, `Password`) VALUES
(1, 2019554, 1, '2021-11-13', 'President', '1234'),
(2, 2013211, 2, '2022-01-01', 'Vice President', '1234'),
(3, 1234567, 1, '2022-01-10', 'Vice President 1', 'password1'),
(4, 2345678, 2, '2022-02-15', 'Vice President', 'password2'),
(5, 3456789, 3, '2022-03-20', 'Secretary', 'password3'),
(6, 4567890, 4, '2022-04-25', 'Treasurer', 'password4'),
(7, 5678901, 5, '2022-05-30', 'Financial Controller 2', 'password5'),
(8, 6789012, 6, '2022-06-05', 'President', 'password6'),
(9, 7890123, 7, '2022-07-10', 'Secretary 2', 'password7'),
(10, 8901234, 8, '2022-08-15', 'Vice President 2', 'password8');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `ProgramID` int(11) NOT NULL,
  `ClubID` int(11) DEFAULT NULL,
  `ProgramName` varchar(255) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Venue` varchar(255) DEFAULT NULL,
  `Details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`ProgramID`, `ClubID`, `ProgramName`, `StartDate`, `EndDate`, `Venue`, `Details`) VALUES
(101, 1, 'Future Leaders 3.0', '2023-12-08', '2023-12-10', 'SMK Betau, Pahang', 'Sharing future paths to aborigines student in the school'),
(102, 2, 'Bright Future Project', '2023-11-25', '2023-11-25', 'SK Bandar Sri Damansara', 'BFP is a training-based programme that aims to enhance the communication skills among mentors'),
(103, 3, 'Mentoring : Young Scientist', '2023-12-09', '2023-12-09', 'Pusat Sains Negara Kuala Lumpur', 'Caring Club organized a visit to Pusat Sains Negara with Rumah Penyayang Darul Ilmi through this program.'),
(104, 1, 'Wellbeing and Advancement through Knowledge and Education', '2023-11-25', '2023-11-27', 'Kampung Orang Asli Kuala Boh', 'mega outreach focus on the wellbeing of aborigines'),
(105, 5, 'JASA\'s Mensino Little Explorers', '2023-12-09', '2023-12-09', 'Kidzania, Kuala Lumpur', 'In this programme, we are bringing students from SK(A) Bukit Kemandol to Kidzania to provide them exposure to the job market'),
(107, 5, 'STUFF Sports Day', '2022-06-25', '2022-06-25', 'Female Sport Centre', 'Stuff sportsd ay to ighten gap of the members and the mainboads'),
(108, 9, 'Teater Amal: Dari Pintu Spital', '2023-12-31', '2023-12-31', 'Main Auditorium', 'a theater that full of nilai murni'),
(109, 3, 'Career Talk: Coaching and Analyst', '2023-11-03', '2023-11-03', 'GamesMY', 'careet talk for iium students'),
(110, 7, 'Virtual Book Expo', '2022-04-18', '2022-04-18', 'Microsoft Team', 'lots of books and jurnal will be sold there'),
(111, 10, 'Fateh Mentoring Camp', '2022-03-10', '2022-03-10', 'SMK Banting', 'for anak yatim');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentID` int(11) NOT NULL,
  `ProgramName` varchar(50) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Cont_Num` varchar(15) DEFAULT NULL,
  `Kulliyyah` varchar(255) DEFAULT NULL,
  `Committee` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `ProgramName`, `Name`, `Email`, `Cont_Num`, `Kulliyyah`, `Committee`) VALUES
(1234567, 'JASA\'s Mensino Little Explorers', 'John Doe', 'john.doe@example.com', '1234567890', 'KICT', 'catering'),
(2013214, 'Bright Future Project', 'Jane Doe', 'jane@example.com', '9876543210', 'Business', 'Graduate'),
(2014823, 'Career Talk: Coaching and Analyst', 'Syahmi Irdina binti Suhair', 'dina@gmail.com', '01213223123', 'KENMS', 'Publication and Promotion'),
(2019554, 'Future Leaders 3.0', 'Tengku Muhammad Aiman bin Tengku Norazmi', 'athirah.amin@live.iium.edu.my', '0182826834', 'kict', 'Assistant Program Manager'),
(2024111, 'Future Leaders 3.0', 'shahida', 'qainies@gmail.com', 'erfef', 'efwef', 'Assistant Program Manager'),
(2024112, 'Future Leaders 3.0', 'Qurratul Aini binti Mohd Shamsuddin', 'qainies@gmail.com', '0182826834', 'kict', 'Programme Manager'),
(2211415, 'Future Leaders 3.0', 'Tengku Muhammad Aiman bin Tengku Norazmi', 'aiman@gmail.com', '01114436616', 'KAED', 'Assistant Program Manager'),
(3456789, 'STUFF Sports Day', 'Bob Johnson', 'bob.johnson@example.com', '5678901234', 'KOE', 'Secretary'),
(5678901, 'Career Talk: Coaching and Analyst', 'Charlie Wilson', 'charlie.wilson@example.com', '8765432109', 'KBS', 'Publication and Promotion');

-- --------------------------------------------------------

--
-- Table structure for table `student_program`
--

CREATE TABLE `student_program` (
  `ParticipantID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `ProgramID` int(11) DEFAULT NULL,
  `ClubID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_program`
--

INSERT INTO `student_program` (`ParticipantID`, `StudentID`, `ProgramID`, `ClubID`) VALUES
(1, 2019554, 101, 1),
(3, 2024111, 101, 1),
(4, 2211415, 101, 1),
(5, 2019554, 104, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`AdvisorID`),
  ADD UNIQUE KEY `StaffID` (`StaffID`),
  ADD KEY `ClubID` (`ClubID`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`ClubID`);

--
-- Indexes for table `mainboard`
--
ALTER TABLE `mainboard`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`ProgramID`),
  ADD KEY `ClubID` (`ClubID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `student_program`
--
ALTER TABLE `student_program`
  ADD PRIMARY KEY (`ParticipantID`),
  ADD UNIQUE KEY `unique_student_program` (`StudentID`,`ProgramID`),
  ADD KEY `ProgramID` (`ProgramID`),
  ADD KEY `ClubID` (`ClubID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advisor`
--
ALTER TABLE `advisor`
  MODIFY `AdvisorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `ClubID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mainboard`
--
ALTER TABLE `mainboard`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `ProgramID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `student_program`
--
ALTER TABLE `student_program`
  MODIFY `ParticipantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisor`
--
ALTER TABLE `advisor`
  ADD CONSTRAINT `advisor_ibfk_1` FOREIGN KEY (`ClubID`) REFERENCES `club` (`ClubID`);

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`ClubID`) REFERENCES `club` (`ClubID`);

--
-- Constraints for table `student_program`
--
ALTER TABLE `student_program`
  ADD CONSTRAINT `student_program_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`),
  ADD CONSTRAINT `student_program_ibfk_2` FOREIGN KEY (`ProgramID`) REFERENCES `program` (`ProgramID`),
  ADD CONSTRAINT `student_program_ibfk_3` FOREIGN KEY (`ClubID`) REFERENCES `club` (`ClubID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
