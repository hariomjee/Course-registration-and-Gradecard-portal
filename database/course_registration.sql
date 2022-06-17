-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2022 at 08:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `uid` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`uid`, `uname`, `pwd`, `role`) VALUES
(1, 'Admin', 'Admin', 'admin'),
(2, 'rcb', 'rcb', 'faculty'),
(3, 'Hariom144', 'Hariom144', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `department_details`
--

CREATE TABLE `department_details` (
  `d_id` int(11) NOT NULL,
  `d_code` varchar(255) NOT NULL,
  `d_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_details`
--

INSERT INTO `department_details` (`d_id`, `d_code`, `d_name`) VALUES
(1, 'CH', 'Chemical science'),
(2, 'ME', 'Mechanical engineering'),
(3, 'PH', 'Physics'),
(4, 'MS', 'Mathematical science'),
(5, 'CS', 'Computer science and Engineering'),
(6, 'CE', 'Civil Engineering'),
(7, 'EN', 'Energy'),
(8, 'DS', 'Design'),
(9, 'AS', 'Applied Science'),
(10, 'FET', 'Food Engineering and Technology'),
(11, 'BA', 'Bussiness Administration'),
(12, 'COM', 'Commerce'),
(13, 'CDM', 'Centre For Disaster Management'),
(14, 'ASM', 'Assamese'),
(15, 'CSt', 'Cultural Studies'),
(17, 'ENG', 'English'),
(19, 'MCJ', 'Mass Comm and Journalism'),
(20, 'ECE', 'electronics and communication engineering');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_details`
--

CREATE TABLE `faculty_details` (
  `f_name` varchar(250) NOT NULL,
  `designation` varchar(250) NOT NULL,
  `d_id` int(50) NOT NULL,
  `f_id` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_details`
--

INSERT INTO `faculty_details` (`f_name`, `designation`, `d_id`, `f_id`) VALUES
('Admin', 'Admin', 0, 1),
('Dr. Ram Charan Bhaishya', 'Assistant Professor(guest)', 5, 2),
('Dr. ROSY', 'ASSISTANT PROFESSOR', 5, 3),
('rahul bora', 'Assistant', 10, 4),
('Prof B NATH', 'Professor', 3, 10),
('Prof K N DAS', 'Professor', 4, 11),
('Prof D K DAS', 'Assistent Professor', 17, 12);

-- --------------------------------------------------------

--
-- Table structure for table `master_course_details`
--

CREATE TABLE `master_course_details` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `titile` varchar(200) NOT NULL,
  `l` int(11) NOT NULL,
  `t` int(11) NOT NULL,
  `p` int(11) NOT NULL,
  `cr` int(11) NOT NULL,
  `offered_by_dept` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_course_details`
--

INSERT INTO `master_course_details` (`id`, `code`, `titile`, `l`, `t`, `p`, `cr`, `offered_by_dept`) VALUES
(1, 'cs231', 'c++', 0, 2, 1, 2, '17'),
(21, 'cs218', 'ml', 3, 3, 1, 4, 'Computer science and Engineering'),
(23, 'cs210', 'wb', 1, 2, 1, 4, 'Computer science and Engineering'),
(30, 'cs213', 'image processing', 1, 2, 0, 3, 'Computer science and Engineering'),
(32, 'cs101', 'ds', 1, 2, 1, 4, 'Computer science and Engineering'),
(33, 'cs103', 'computer fundamental', 1, 2, 0, 3, 'Computer science and Engineering'),
(36, 'CS401', 'HTML', 1, 2, 2, 5, 'Computer science and Engineering'),
(38, 'CS220', 'CSS', 1, 2, 1, 4, 'Computer science and Engineering'),
(39, 'cs111', 'Bootstrap', 1, 1, 1, 3, 'Computer science and Engineering'),
(43, 'cs501', 'Major project', 0, 0, 0, 16, 'Computer science and Engineering'),
(44, 'cs321', 'computer network', 0, 3, 1, 4, 'Computer science and Engineering'),
(46, 'm210', 'Set theory', 0, 3, 0, 3, 'Mathematical science'),
(54, 'cr123', 'es', 1, 4, 2, 7, 'Computer science and Engineering'),
(61, 'cs301', 'iot', 0, 2, 2, 4, 'Computer science and Engineering'),
(62, 'cs333', 'uu', 1, 0, 3, 5, 'Computer science and Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `offered_courses`
--

CREATE TABLE `offered_courses` (
  `sem` varchar(200) NOT NULL,
  `program_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offered_courses`
--

INSERT INTO `offered_courses` (`sem`, `program_id`, `course_id`, `category`) VALUES
('1', '1', 'cs101', 'E'),
('1', '1', 'cs103', 'A'),
('1 ', '1', 'cs220', 'A'),
('1 ', '1', 'cs231', 'E'),
('2 ', '1', 'cs111', 'E'),
('2', '1', 'cs213', 'A'),
('2 ', '1', 'cs301', 'A'),
('2 ', '3', 'm210', 'C'),
('3 ', '1', 'cr123', 'E'),
('3 ', '1', 'cs111', 'E'),
('3 ', '1', 'cs112', 'E'),
('3 ', '1', 'cs401', 'E'),
('4', '1', 'cs231', 'E'),
('4', '1', 'cs501', 'E'),
('8 ', '2', 'cs501', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `program_details`
--

CREATE TABLE `program_details` (
  `p_id` int(11) NOT NULL,
  `p_code` varchar(200) NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `d_id` int(11) NOT NULL,
  `no_of_sem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_details`
--

INSERT INTO `program_details` (`p_id`, `p_code`, `p_name`, `d_id`, `no_of_sem`) VALUES
(1, 'csm', 'MCA', 5, 4),
(2, 'csb', 'b.tect', 5, 8),
(3, 'msm', 'M.sc Maths', 4, 4),
(4, 'phc', 'phd.civil', 6, 10),
(5, 'mcs', 'M.tech(cse)', 5, 4),
(6, 'mit', 'M.tech(it)', 5, 4),
(7, 'ENE', 'M.tech', 7, 4),
(8, 'ENE', 'B.tech', 7, 8),
(9, 'FEB', 'B.tech', 10, 8),
(10, 'FEB', 'M.tech', 10, 4),
(11, 'CH', 'M.Sc', 1, 4),
(12, 'CH', ' intergrated M.Sc', 1, 4),
(13, 'CH', ' B.Tech', 1, 8),
(14, 'PHI', 'M.Sc', 3, 8),
(15, 'PHI', ' int. M.Sc', 3, 6),
(16, 'APP', ' B.Tech', 9, 8),
(17, 'CIB', ' B.Tech', 6, 8),
(18, 'CIB', ' M.Tech', 6, 4),
(19, 'MDs', ' M.DS', 8, 4),
(20, 'ELB', ' B.Tech', 20, 8),
(21, 'ELB', ' M.Tech', 20, 4),
(22, 'FET', ' M.Tech', 10, 4),
(23, 'FET', ' B.Tech', 10, 8),
(24, 'ASM', ' M.A', 14, 4),
(25, 'CTM', ' M.A', 15, 4),
(26, 'MCJ', ' M.A', 19, 4),
(27, 'EN', ' M.A', 17, 4),
(28, 'EN', ' int.M.A', 17, 6);

-- --------------------------------------------------------

--
-- Table structure for table `session_details`
--

CREATE TABLE `session_details` (
  `s_id` int(11) NOT NULL,
  `term_year` int(11) NOT NULL,
  `term_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session_details`
--

INSERT INTO `session_details` (`s_id`, `term_year`, `term_type`) VALUES
(1, 2017, 'spring'),
(2, 2017, 'autumn'),
(3, 2018, 'spring'),
(4, 2018, 'autumn'),
(5, 2019, 'spring'),
(6, 2019, 'autumn'),
(7, 2020, 'spring'),
(8, 2020, 'autumn'),
(9, 2021, 'spring'),
(10, 2021, 'autumn'),
(11, 2022, 'spring');

-- --------------------------------------------------------

--
-- Table structure for table `student_course_registration`
--

CREATE TABLE `student_course_registration` (
  `std_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `course_id` varchar(200) NOT NULL,
  `category` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `graded_by_faculty` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_course_registration`
--

INSERT INTO `student_course_registration` (`std_id`, `s_id`, `course_id`, `category`, `grade`, `graded_by_faculty`) VALUES
(1, 10, 'cs101', 'E', 'A', ''),
(1, 11, 'cs101', 'E', '', ''),
(1, 11, 'cs111', 'E', 'A', 'Dr. Ram Charan Bhaishya'),
(1, 11, 'cs213', 'A', '', ''),
(1, 11, 'CS220', 'A', 'O', ''),
(1, 11, 'cs231', 'E', 'P', 'Dr. Ram Charan Bhaishya'),
(2, 9, 'cs101', 'E', 'O', ''),
(2, 10, 'cs111', 'E', 'B+', ''),
(2, 11, 'cs111', 'E', 'B', 'Dr. Ram Charan Bhaishya'),
(2, 11, 'cs231', 'E', 'B', 'Dr. Ram Charan Bhaishya'),
(2, 11, 'cs501', 'E', 'O', 'Dr. Ram Charan Bhaishya');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `std_id` int(11) NOT NULL,
  `roll_no` varchar(11) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `admitted_on` int(11) NOT NULL,
  `completed_on` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`std_id`, `roll_no`, `s_name`, `admitted_on`, `completed_on`, `p_id`, `password`) VALUES
(1, 'csm20010', 'hari om', 8, 900, 1, 'csm20010'),
(2, 'csm20007', 'ananya', 8, 78, 1, 'csm20007'),
(3, 'csm20041', 'harshita', 8, 456, 1, 'csm20041'),
(4, 'csm21006', 'vishal', 10, 13, 1, 'csm21006'),
(5, 'csm21008', 'sunita', 10, 13, 1, 'csm21008'),
(8, 'csm20043', 'himanshu chauhan', 8, 800, 1, 'csm20043'),
(9, 'csm20055', 'nitumoni neog', 8, 234, 1, 'csm20055'),
(10, 'csm20047', 'Rajnandinee biswas', 6, 500, 1, 'csm20047'),
(11, 'csm20030', 'Ishika sharma', 6, 500, 1, 'csm20030'),
(12, 'csm20051', 'Ram nivas', 6, 768, 1, 'csm20051'),
(13, 'csm20046', 'aditi gogoi', 6, 600, 1, 'csm20046'),
(14, 'csm20004', 'Prachurjya gogoi', 8, 400, 1, 'csm20004'),
(15, 'csm20006', 'Mintu kurmi', 7, 500, 1, 'csm20006'),
(16, 'csm20014', 'ojosmita goswami', 7, 600, 1, 'csm20014'),
(17, 'csm20018', 'kaushik borah', 7, 600, 1, 'csm20018'),
(18, 'csb20001', 'radhika sharma', 5, 509, 2, 'csb20001'),
(19, 'csb20002', 'Ashit singh', 5, 509, 2, 'csb20002'),
(20, 'csb20003', 'Prince  singh', 5, 509, 2, 'csb20003'),
(21, 'csb20004', 'Risabh Rastogi', 5, 400, 2, 'csb20004'),
(22, 'csb20005', 'Vivek jaiswal', 5, 400, 2, 'csb20005'),
(24, 'csb20006', 'Hansika Rastogi', 5, 300, 2, 'csb20006'),
(25, 'csb20007', 'Priyanka Joshi', 4, 400, 2, 'csb20007'),
(26, 'csb20008', 'Toofan', 4, 400, 2, 'csb20008'),
(27, 'csb20009', 'Rohini kashyap', 5, 500, 2, 'csb20009'),
(28, 'csb20010', 'vikas mehrotra', 6, 800, 2, 'csb20010'),
(29, 'csb20011', 'Nihar kashyap', 5, 500, 2, 'csb20011'),
(30, 'csb20012', 'vinod', 4, 500, 2, 'csb20012'),
(31, 'csb20014', 'Rashmi gogoi', 5, 600, 2, 'csb20014'),
(32, 'csb20015', 'saheli dey', 5, 600, 2, 'csb20015'),
(33, 'csb20016', 'vansh ahoja', 5, 600, 2, 'csb20016'),
(34, 'csb20017', 'himanshu', 4, 400, 2, 'csb20017'),
(36, 'csb20018', 'shamsher rajpoot', 4, 400, 2, 'csb20018'),
(37, 'csb20019', 'Manab saha', 4, 400, 2, 'csb20019'),
(38, 'csb20020', 'sanjeev', 4, 400, 2, 'csb20020'),
(39, 'csb20021', 'Harsh ', 4, 400, 2, 'csb20021'),
(40, 'csb20022', 'vishaka ', 4, 400, 2, 'csb20022'),
(41, 'csb20023', 'nikhil  ', 4, 400, 2, 'csb20023'),
(42, 'csb20024', 'sumit   ', 4, 400, 2, 'csb20024'),
(44, 'msm20001', 'aishwarya', 5, 600, 3, 'msm20001'),
(45, 'msm20002', 'anubhav singh', 7, 800, 3, 'msm20002'),
(46, 'msm20003', 'Ifrah', 3, 500, 3, 'msm20003'),
(47, 'msm20004', 'Muneeb', 3, 400, 3, 'msm20004'),
(48, 'msm20005', 'ashit kapoor', 3, 444, 3, 'msm20005'),
(49, 'msm20006', 'niharika', 3, 400, 3, 'msm20006'),
(50, 'msm20007', 'Rohit', 6, 400, 3, 'msm20007'),
(51, 'msm20008', 'Nivas kumar', 6, 200, 3, 'msm20008'),
(52, 'msm20009', 'neha kumari', 6, 200, 3, 'msm20009'),
(53, 'msm20010', 'kasturi', 4, 230, 3, 'msm20010'),
(54, 'msm20011', 'preeti nsaikia', 4, 230, 3, 'msm20011'),
(55, 'APP20001', 'Sree Bhattacherjee', 3, 555, 16, 'APP20001'),
(56, 'APP20002', 'Sitakanta Panda', 3, 555, 16, 'APP20002'),
(57, 'APP20003', 'Chayanika Pathak', 3, 589, 16, 'APP20003'),
(58, 'APP20004', 'Jharna Kalita', 3, 599, 16, 'APP20004'),
(59, 'APP20005', 'Tanmay Halder', 3, 599, 16, 'APP20005'),
(60, 'CIB20002', 'SANGITA SAIKIA', 8, 599, 17, 'CIB20002'),
(61, 'CIB20003', 'RITURAJ SARMAH', 8, 66, 17, 'CIB20003'),
(62, 'CIB20004', 'SUKANYA GOSWAMI', 4, 66, 17, 'CIB20004'),
(63, 'CIB20005', 'SOURAV BANERJEE', 4, 66, 17, 'CIB20005'),
(64, 'CIB18001', 'PRERANA SARMAH', 4, 66, 18, 'CIB18001'),
(65, 'CIB18002', 'PREeei', 8, 77, 18, 'CIB18002'),
(66, 'CIB19002', 'PAKHI PRIYAM', 7, 77, 18, 'CIB19002'),
(67, 'CIB20018', ' PRIYAM', 6, 77, 18, 'CIB200018'),
(68, 'CIB20055', ' sheshank gupta', 9, 79, 18, 'CIB200055'),
(69, 'CIB21011', ' kabir singh', 4, 74, 18, 'CIB21011'),
(70, 'CIB22018', ' ananya gupta', 8, 44, 18, 'CIB22018'),
(71, 'CIB22015', ' hari sharma', 4, 333, 18, 'CIB22015'),
(72, 'mds18001', ' upaasna', 6, 31, 19, 'mds18001'),
(73, 'mds18002', ' rachna saikia', 4, 231, 19, 'mds18002'),
(74, 'mds18046', 'narottam', 7, 23, 19, 'mds18046'),
(75, 'mds18064', 'sweety sharma', 8, 24, 19, 'mds18064'),
(76, 'mds19023', 'sakshi yadav', 8, 24, 19, 'mds19023'),
(77, 'mds19024', 'Ashwin ', 6, 53, 19, 'mds19024'),
(78, 'mds20001', 'Sunny deol', 5, 99, 19, 'mds20001'),
(79, 'mds21001', 'virat kohli', 3, 66, 19, 'mds21001'),
(80, 'mds22001', 'Anushka singh', 5, 77, 19, 'mds22001'),
(81, 'ELB18004', 'BHARGAB  DAS', 6, 88, 20, 'ELB18004'),
(82, 'ELB18003', 'BHARGAB  DAS', 5, 200, 20, 'ELB18003'),
(83, 'ELB18006', 'MRINAL   GUPTA', 5, 20, 20, 'ELB18006'),
(84, 'ELB18017', 'SAGARIKA  PAUL', 7, 100, 20, 'ELB18017'),
(85, 'ELB19011', 'RITUSHREE  SAHUL', 5, 100, 20, 'ELB19011'),
(86, 'ELB12001', 'RITU rathi ', 5, 190, 20, 'ELB12001'),
(87, 'ELB12004', 'abhay rathi ', 2, 140, 20, 'ELB12004'),
(88, 'ELB12009', 'vikas ', 7, 77, 20, 'ELB12009'),
(89, 'ELB12109', 'NONU SINGH ', 5, 80, 20, 'ELB12109'),
(90, 'ELB12209', 'shobhit verma ', 6, 80, 20, 'ELB12209'),
(91, 'ELB12208', 'DINESH  SHAW ', 2, 55, 20, 'ELB12208'),
(92, 'ELB122019', 'ABHISHEK  KUMAR ', 2, 88, 21, 'ELB122019'),
(93, 'ELB18019', 'ABHISHEK   ', 2, 66, 21, 'ELB18019'),
(94, 'ELB18020', 'vinod singh  ', 2, 66, 21, 'ELB18020'),
(95, 'ELB19009', 'happy singh  ', 6, 99, 21, 'ELB19009'),
(96, 'ELB20009', 'hansika rastogi  ', 2, 44, 21, 'ELB20009'),
(97, 'ELB21009', 'Hrishav Das  ', 6, 60, 21, 'ELB21009'),
(98, ' ENE22001', 'Biswajit Das  ', 4, 44, 7, 'ENE22001'),
(99, ' ENE22005', 'Nayan Jyoti Mahapurushia', 7, 33, 7, 'ENE22005'),
(100, ' ENE22007', 'Nilotpal Baishya', 6, 19, 7, 'ENE22007'),
(101, ' ENE21017', 'Prachujya Borah', 6, 19, 7, 'ENE21017'),
(102, ' ENE21014', 'Tanmoy Saikia', 5, 55, 7, 'ENE21014'),
(103, ' ENE20004', 'vivek Saikia', 6, 77, 7, 'ENE20004'),
(104, ' ENE19004', 'Shyamantak Raj Barman', 6, 80, 7, 'ENE19004'),
(105, ' ENE19009', ' Raj Barman', 6, 80, 7, 'ENE19009'),
(106, ' ENE18003', ' Raj Barman', 6, 80, 7, 'ENE18003'),
(107, ' ENE18004', ' Raj ', 6, 80, 7, 'ENE18004'),
(108, '	FEB21006', ' AMITRAJ  SORAM ', 5, 90, 9, 'FEB21006'),
(109, '	FEB21008', 'HARSHADEEP  HAZARIKA ', 3, 66, 9, 'FEB21008'),
(110, '	FEB20008', 'HARSHADEEP  HAZARIKA ', 3, 56, 9, 'FEB20008'),
(111, '	FEB20002', 'MIZANUR  RAHMAN ', 4, 59, 9, 'FEB20002'),
(112, '	FEB19002', 'AMLAN  CHETIA ', 6, 9, 9, 'FEB19002'),
(113, '	FEB18002', 'Priyanshu CHETIA ', 6, 9, 9, 'FEB18002'),
(114, '	FEB18004', 'Rinky CHETIA ', 6, 9, 10, 'FEB18004'),
(115, '	FEB18009', 'Priyanka ', 6, 9, 10, 'FEB18009'),
(116, '	FEB18010', 'chinky  ', 6, 9, 10, 'FEB18010'),
(117, '	ASM18001', 'saheli Dey  ', 6, 9, 24, 'ASM18001'),
(118, '	ASM18002', 'Priyanjima  ', 6, 9, 24, 'ASM18002'),
(119, '	ASM19002', 'Archana biswas ', 6, 9, 24, 'ASM19002'),
(120, '	ASM19008', 'Raj biswas ', 6, 9, 24, 'ASM19008'),
(121, '	ASM20007', 'shilpa shetty ', 6, 9, 24, 'ASM20007'),
(122, '	ASM20012', 'Raj Kundra', 6, 9, 24, 'ASM20012'),
(123, '	ASM21012', 'yogesh singh', 6, 9, 24, 'ASM21012'),
(124, '	ASM21064', 'hariom singh', 6, 9, 24, 'ASM21064'),
(125, '	ASM22064', 'Rachna ', 6, 9, 24, 'ASM22064'),
(126, '	CTM18016', 'Sidharth nigam ', 6, 9, 25, 'CTM18016'),
(127, '	CTM18019', 'hiranmoyi das ', 6, 9, 25, 'CTM18019'),
(128, '	CTM19019', 'Himanshu nigam ', 6, 9, 25, 'CTM19019'),
(129, '	CTM19045', 'Harshita Singh ', 6, 9, 25, 'CTM19045'),
(130, '	CTM20001', 'Harshit Tyagi ', 6, 9, 25, 'CTM20001'),
(131, '	CTM20008', 'Neha Das ', 6, 9, 25, 'CTM20008'),
(132, '	CTM2107', 'Pankhuri Medhi ', 6, 9, 25, 'CTM2107'),
(133, '	CTM21003', 'vinay saikia ', 6, 9, 25, 'CTM21003'),
(134, '	CTM21014', 'vinnie jee ', 6, 9, 25, 'CTM21014'),
(135, '	CTM22003', 'Abhishek Bachan ', 6, 9, 25, 'CTM22003'),
(136, '	PHI20003', 'Abhishek Bachan ', 8, 900, 14, 'PHI20003'),
(137, '	PHI20007', 'lavish yadav ', 3, 56, 14, 'PHI20007'),
(138, '	PHI21007', 'babita kalita', 3, 56, 14, 'PHI21007'),
(139, '	PHI19007', ' Hiran kalita', 3, 56, 14, 'PHI19007'),
(140, '	PHI18007', ' nitu kalita', 3, 56, 14, 'PHI18007'),
(141, '	PHI18006', ' nitu ', 3, 56, 15, 'PHI18006'),
(142, '	PHI19018', ' Nitish Nath ', 3, 56, 15, 'PHI190018'),
(143, '	PHI19045', ' nitu Nath ', 3, 56, 15, 'PHI19045'),
(144, '	PHI20001', ' Ananya Medhi ', 3, 56, 15, 'PHI20001'),
(145, '	PHI21001', ' nivas singh ', 3, 56, 15, 'PHI21001'),
(11153, 'rini', 'csm19005', 900, 0, 1, ''),
(11154, 'mini', 'csm19006', 900, 0, 1, ''),
(11155, 'jumi', 'csm19007', 900, 0, 1, ''),
(11156, 'sumi', 'csm19008', 900, 0, 1, ''),
(11157, 'moni', 'csm19009', 900, 0, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- Indexes for table `department_details`
--
ALTER TABLE `department_details`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `faculty_details`
--
ALTER TABLE `faculty_details`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `master_course_details`
--
ALTER TABLE `master_course_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `offered_courses`
--
ALTER TABLE `offered_courses`
  ADD PRIMARY KEY (`sem`,`program_id`,`course_id`);

--
-- Indexes for table `program_details`
--
ALTER TABLE `program_details`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `session_details`
--
ALTER TABLE `session_details`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `student_course_registration`
--
ALTER TABLE `student_course_registration`
  ADD PRIMARY KEY (`std_id`,`s_id`,`course_id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`std_id`),
  ADD UNIQUE KEY `roll_no` (`roll_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department_details`
--
ALTER TABLE `department_details`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `faculty_details`
--
ALTER TABLE `faculty_details`
  MODIFY `f_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_course_details`
--
ALTER TABLE `master_course_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `program_details`
--
ALTER TABLE `program_details`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `session_details`
--
ALTER TABLE `session_details`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11158;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
