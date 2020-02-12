-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 10:29 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(10) NOT NULL,
  `temp` int(11) NOT NULL,
  `pr` int(11) NOT NULL,
  `rr` int(11) NOT NULL,
  `bp` int(11) NOT NULL,
  `complaints` text NOT NULL,
  `treatment` text NOT NULL,
  `brgy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=REDUNDANT;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient`, `doctor`, `date`, `time`, `temp`, `pr`, `rr`, `bp`, `complaints`, `treatment`, `brgy`) VALUES
(6, 2, '5', '2019-10-12', '03:15', 1, 1, 1, 1, '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n</p>', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n<br></p>', ''),
(7, 4, '5', '2019-10-12', '', 1, 1, 1, 1, '<p>egeg</p>', '<p>gege</p>', ''),
(8, 3, '5', '2019-10-03', '10:30', 1, 1, 1, 1, '<p>loerm ipsum</p>', '<p>lorem ipsum</p>', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`) VALUES
(2, 'Allergenics', 'Allergenics are used for allergen immunotherapy to decrease the immune response to allergens. The allergenic is administered to the patient as an injection or sublingually in increasing doses with the treatment plan taking three to five years.'),
(3, 'Antiacids', 'Antacids are a class of medicines that neutralize acid in the stomach. They contain ingredients such as aluminum, calcium, magnesium, or sodium bicarbonate which act as bases (alkalis) to counteract stomach acid and make its pH more neutral.'),
(4, 'Anti-infectives', 'Anti-infectives is a general term used to describe any medicine that is capable of inhibiting the spread of an infectious organism or by killing the infectious organism outright.\r\n\r\nThis term encompasses antibiotics, antifungals, anthelmintics, antimalarials, antiprotozoals, antituberculosis agents, and antivirals.'),
(5, 'Antibiotics/antineoplastics', 'Antibiotic antineoplastics are agents that have microbial origin, that is they are derived from microorganisms. The different antibiotic antineoplastic agents affect DNA replication by various cytotoxic actions. They are used as chemotherapy agents to treat many types of cancers.');

-- --------------------------------------------------------

--
-- Table structure for table `medicines_brgy`
--

CREATE TABLE `medicines_brgy` (
  `id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `genericname` varchar(100) NOT NULL,
  `mfr_date` varchar(15) NOT NULL,
  `expiry` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines_brgy`
--

INSERT INTO `medicines_brgy` (`id`, `brand`, `category`, `quantity`, `genericname`, `mfr_date`, `expiry`) VALUES
(14, 'lelong', 2, 50, 'lelong', '2019-10-10', '2021-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `medicines_hc`
--

CREATE TABLE `medicines_hc` (
  `id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `genericname` varchar(100) NOT NULL,
  `mfr_date` varchar(15) NOT NULL,
  `expiry` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines_hc`
--

INSERT INTO `medicines_hc` (`id`, `brand`, `category`, `quantity`, `genericname`, `mfr_date`, `expiry`) VALUES
(14, 'lelong', 2, 73, 'lelong2', '2019-10-10', '2021-06-15'),
(15, 'lolo', 0, 123, 'lolo', '0002-02-21', '2019-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `medicine` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `branch` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `medicine`, `qty`, `date`, `branch`, `status`) VALUES
(10, 14, 50, '2019-10-02', 'Baranggay', 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `bloodgroup` varchar(5) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `brgy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `email`, `password`, `address`, `phone`, `gender`, `birthdate`, `bloodgroup`, `profile`, `status`, `brgy`) VALUES
(1, 'Roberto Salinga III', '', 'sunita', 'Pampanga na putangina', '8482838002', 'Male', '2018-05-07', 'A+', 'redsalinga10@gmail.com.jpg', '1', 'Mabini'),
(2, ' Nikita', '', '', 'Vani', '8482838002', 'Female', '2018-05-08', 'B+', 'Tulips.jpg', '1', 'San Juan'),
(3, ' Dhanu', '', '', 'Nashik', '8482838002', 'Female', '2018-05-01', 'B+', 'Chrysanthemum.jpg', '1', 'Evangelista'),
(4, ' Yogita', '', '', 'Shivaji Nagar', '8482838002', 'Female', '2018-05-05', 'A+', 'Hydrangeas.jpg', '1', 'Evangelista'),
(7, 'Brendan Stephen S. Odiver', '', '', 'Unit 715 bldg 2C palmdale heights pinagbuhatan', '09056931926', 'Male', '2019-07-08', 'O+', 'bsodiver@gmail.com', '1', 'Conception'),
(8, 'Carl Justin Yanuario', '', '', 'Unit 908 bldg 2B palmdale heights', '09056931926', 'Male', '2019-10-15', 'A+', '', '1', 'Rizal');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(25) NOT NULL,
  `patient` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `medicine` int(11) NOT NULL,
  `dosage` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient`, `date`, `medicine`, `dosage`, `qty`) VALUES
(2, 1, '2019-09-30', 8, 500, 100);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `appointment` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Queued'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `appointment`, `date`, `status`) VALUES
(19, 7, '2019-10-12', 'Sent');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `brgy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `branch`, `profile`, `fname`, `lname`, `email`, `password`, `brgy`) VALUES
(1, 'Admin', 'Baranggay', 'admin@admin.com.', 'Admin', 'Admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 'Evangelista'),
(4, 'Nurse', 'Health Center', 'jane@gmail.com', 'Jane', 'Doe', 'jane@gmail.com', '25d55ad283aa400af464c76d713c07ad', ''),
(5, 'Doctor', 'Health Center', 'admin@gmail.com', 'Abegail', 'Daniac', 'abegaildaniac@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(10, 'Baranggay', 'Health Center', 'robert@gmail.com', 'Robert', 'Salinga', 'robert@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Conception'),
(11, 'Baranggay', 'Baranggay', 'linus@gmail.com', 'Linus', 'linus', 'linus@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Evangelista');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines_brgy`
--
ALTER TABLE `medicines_brgy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines_hc`
--
ALTER TABLE `medicines_hc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medicines_brgy`
--
ALTER TABLE `medicines_brgy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `medicines_hc`
--
ALTER TABLE `medicines_hc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
