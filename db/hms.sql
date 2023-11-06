CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
);

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cpassword` varchar(30) NOT NULL
);

CREATE TABLE `appointment` (
  `pid` int(11) NOT NULL,
  `AppID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `doctor` varchar(30) NOT NULL,
  `docFees` int(5) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `userStatus` int(5) NOT NULL,
  `doctorStatus` int(5) NOT NULL,
  FOREIGN KEY (`pid`) REFERENCES `patient`(`pid`)
);

CREATE TABLE `doctor` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `spec` varchar(50) NOT NULL,
  `docFees` int(10) NOT NULL
);

CREATE TABLE `prescriptiontable` (
  `doctor` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `AppID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `disease` varchar(250) NOT NULL,
  `allergy` varchar(250) NOT NULL,
  `prescription` varchar(1000) NOT NULL,
  FOREIGN KEY (`pid`) REFERENCES `patient`(`pid`),
  FOREIGN KEY (`AppID`) REFERENCES `appointment`(`AppID`)
);
