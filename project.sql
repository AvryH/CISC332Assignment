-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2018 at 10:13 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `complex`
--

CREATE TABLE `complex` (
  `name` varchar(100) NOT NULL,
  `numTheaters` int(11) DEFAULT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pc` char(6) NOT NULL,
  `phoneNum` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complex`
--

INSERT INTO `complex` (`name`, `numTheaters`, `street`, `city`, `pc`, `phoneNum`) VALUES
('Kingston AMC Theater', 3, '256 Princess Street', 'Kingston', 'K7L1B2', '6135552020'),
('Kingston Cineplex', 2, '512 Princess Street', 'Kingston', 'K7L1B2', '6135551010'),
('The Kingston Grand Theater', 4, '1024 Princess Street', 'Kingston', 'K7L1B2', '6135302050');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `acctNum` int(11) NOT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL,
  `phoneNum` char(10) DEFAULT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pc` char(6) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `CCNum` char(16) DEFAULT NULL,
  `CCExp` char(4) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `administrator` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`acctNum`, `fName`, `lName`, `phoneNum`, `street`, `city`, `pc`, `email`, `CCNum`, `CCExp`, `password`, `administrator`) VALUES
(213142, 'Admin', 'Istrator', '9999999999', '123 Street St', 'Home Town', 'H0N507', 'root', 'root', '1234', '$2y$10$ehzAeELmEwn9HsrOX7out.mHeRYJwwyeHSodnV8Y7S3.n8zRifGdK', 1),
(10189321, 'Avry', 'Harris', '6135551234', '99 University Ave', 'Kingston', 'K7L3P5', 'avry29@gmail.com', '1234567891011121', '0119', '$2y$10$68WOtEXjkG64ju6SimrwheNGVe8p5E0IC9phNNqIVgnd1F1TzXeQi', 0),
(15528057, 'Harry', 'Potter', NULL, 'Hogwarts', 'England', 'H0C1SP', 'usemyowl@owl.wiz', NULL, NULL, '$2y$10$7oVdvRsT8V0ifsrRxH9ITeb7lmd5nZLmIxyVllbRROiWw2o4H805O', 0),
(15661148, 'Billy', 'Bob', '8675309122', 'Delta Road', 'Kingston', 'K7L2R3', 'billybillybilly@billy.billy', '3333333333333333', '0317', '$2y$10$ynAHfaTpSFOA6X2Dhi6kV.BOCzw6dGEREgxUW.Aray71nccPqn2su', 0),
(19912165, 'Harold', 'Martin', '3939394959', 'Foxtrot Road', 'Kingston', 'K7L3P9', 'h.martin@gmail.com', '6868686868686868', '0722', '$2y$10$GGvkMhxWmKS9Uo3GUX40we9vizRX8lW1Ap.oRitrkycbzQi9TM8jy', 0),
(23456789, 'Edward', 'Luetchford', '2893565551', 'Beta Road', 'Bowmanville', 'L1C2R8', 'eddie123@gmail.com', '1231231231231231', '0421', '$2y$10$5eg36LaHulTnYL86vYWFjO//xxt5k..MTcYmUOr1SzbXsqroVQCza', 0),
(36177382, 'James', 'Cornwell', '1122233334', 'Echo Road', 'Kingston', 'k7L8R5', 'jamesMaxCorn@hotmail.com', '4545454545454545', '0635', '$2y$10$P8Ci7Fuw1RFRE8e.4dIa2Ovm551CddF.fAc0upWcsWK6lGWlWDh7e', 0),
(52794068, 'Nick', 'Cage', '4949494949', 'Charlie Road', 'Kingston', 'k7L5B4', 'feelthecagerage@hotmail.com', '9999999999999999', '0209', '$2y$10$y1SzyGUKY1VvQbqSBWIz8en6.7olFzXOJB5ofpWjNSJUhaPypziAK', 0),
(58029388, 'Gilbert', 'Marx', '4444445355', 'Golf Road', 'Kingston', 'K7L1E4', 'ggggilbert123@gmail.com', '7373737373737474', '0719', '$2y$10$Hz30tBVRd8CTmzWPi746quUzXnFJLfL7dh/IzVrT.BKG7pb1qnJ/e', 0),
(87654321, 'Jane', 'Smith', '1234567890', 'Alpha Road', 'Kingston', 'K7L1E5', 'janeSmith@gmail.com', '1212121212121212', '0119', 'janespassword', 0),
(938955803, 'Abra', 'Kadabra', '5140539613', '215 Route.', 'Veilstone', '123456', 'kadabra@spoon.info', '3910249234123467', '0522', '$2y$10$dPqyEocKyTW9Z37GDx97SedtSM9KBnfzm.y9mm0iZoQHZhMjIc6Ca', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mainactors`
--

CREATE TABLE `mainactors` (
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `MovieTitle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mainactors`
--

INSERT INTO `mainactors` (`FName`, `LName`, `MovieTitle`) VALUES
('Joan', 'Allen', 'Face/Off'),
('John', 'Travolta', 'Face/Off'),
('Nicolas', 'Cage', 'Face/Off'),
('Eva', 'Mendes', 'Ghost Rider'),
('Nicolas', 'Cage', 'Ghost Rider'),
('Cassi', 'Thompson', 'Left Behind'),
('Lea', 'Thompson', 'Left Behind'),
('Nicolas', 'Cage', 'Left Behind'),
('Alison', 'Lohman', 'Matchstick Men'),
('Nicolas', 'Cage', 'Matchstick Men'),
('Sam', 'Rockwell', 'Matchstick Men'),
('Diane', 'Kruger', 'National Treasure: Book of Secrets'),
('Justin', 'Bartha', 'National Treasure: Book of Secrets'),
('Nicolas', 'Cage', 'National Treasure: Book of Secrets'),
('Jessica', 'Biel', 'Next'),
('Juliane', 'Moore', 'Next'),
('Nicolas', 'Cage', 'Next'),
('Ed', 'Harris', 'The Rock'),
('Nicolas', 'Cage', 'The Rock'),
('Sean', 'Connery', 'The Rock'),
('Hope', 'Davis', 'The Weather Man'),
('Nicholas', 'Hoult', 'The Weather Man'),
('Nicolas', 'Cage', 'The Weather Man');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `title` varchar(50) NOT NULL,
  `runtime` int(11) NOT NULL,
  `rating` varchar(4) DEFAULT NULL,
  `plotSyn` varchar(200) DEFAULT NULL,
  `director` varchar(100) DEFAULT NULL,
  `prodComp` varchar(100) DEFAULT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`title`, `runtime`, `rating`, `plotSyn`, `director`, `prodComp`, `startDate`, `endDate`, `genre`, `supplier`, `thumbnail`) VALUES
('Face/Off', 148, 'R', 'In order to foil an extortion plot, an FBI agent undergoes a facial transplant surgery and assumes the identity and physical appearance of a terrorist, but the plan turns from bad to worse.', 'John Woo', 'Sony Pictures', '2018-03-01', '2018-04-20', 'Action', 'Reel to Reel', 'http://2.bp.blogspot.com/-8hVWqtGlSPc/Uo0JxHrKWFI/AAAAAAAAA4o/hGb-LB17sB4/s1600/face_off_ver6_xlg.jpg'),
('Ghost Rider', 114, 'PG13', 'Stunt motorcyclist Johnny Blaze gives up his soul to become a hellblazing vigilante, to fight against power hungry Blackheart, the son of the devil.', 'Mark Steven Johnson', 'Sam Elliott', '2018-03-04', '2018-05-15', 'Action', 'Action', 'http://static.tvgcdn.net/rovi/showcards/movie/285896/thumbs/16835779_899x1199.jpg'),
('Left Behind', 110, 'PG13', 'A small group of survivors are left behind after millions of people suddenly vanish and the world is plunged into chaos and destruction.', 'Vic Armstrong', 'Stoney Lake Entertainment', '2018-02-28', '2018-04-18', 'Drama', 'Reel to Reel', 'https://www.dvdsreleasedates.com/posters/800/L/Left-Behind-2014-movie-poster.jpg'),
('Matchstick Men', 116, 'PG13', 'A phobic con artist and his protÃ©gÃ© are on the verge of pulling off a lucrative swindle when the former\'s teenage daughter arrives unexpectedly.', 'Ridley Scott', 'Warner Bros.', '2018-03-02', '2018-05-11', 'Comedy', 'Cinema Supplies', 'https://www.dvdsreleasedates.com/posters/800/M/Matchstick-Men-2003-movie-poster.jpg'),
('National Treasure: Book of Secrets', 124, 'PG', 'Benjamin Gates must follow a clue left in John Wilkes Booth\'s diary to prove his ancestor\'s innocence in the assassination of Abraham Lincoln.', 'Jon Turteltaub', 'Walt Disney Pictures', '2018-02-25', '2018-04-25', 'Action', 'Action', 'http://3.bp.blogspot.com/_EuHEDwCmE1I/TCABTX0fR8I/AAAAAAAACOk/n2okZPa9sfI/s1600/91-national.treasure.book.of.secrets.2007-.jpg'),
('Next', 93, 'R', 'A Las Vegas magician who can see into the future is pursued by FBI agents seeking to use his abilities to prevent a nuclear terrorist attack.', 'Lee Tamahori', 'Paramount Pictures', '2018-03-02', '2018-05-01', 'Action', 'Reel to Reel', 'https://derricklferguson.files.wordpress.com/2012/08/next.jpg'),
('The Rock', 136, 'PG13', 'A mild-mannered chemist and an ex-con must lead the counterstrike when a rogue group of military men, led by a renegade general, threaten a nerve gas attack from Alcatraz against San Francisco.', 'Michael Bay', 'Hollywood Pictures', '2018-02-13', '2018-03-25', 'Action', 'Cinema Supplies', 'https://mindreels.files.wordpress.com/2013/09/rock.jpg'),
('The Weather Man', 102, 'R', 'A Chicago weather man, separated from his wife and children, debates whether professional and personal success are mutually exclusive.', 'Gore Verbinski', 'Paramount Pictures', '2018-03-04', '2018-05-10', 'Comedy', 'Action', 'https://upload.wikimedia.org/wikipedia/en/c/cb/Weather_man.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `accountNum` int(11) NOT NULL,
  `showingID` int(11) NOT NULL,
  `numTicketsReserved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`accountNum`, `showingID`, `numTicketsReserved`) VALUES
(213142, 1, 5),
(213142, 9, 4),
(938955803, 1, 2),
(938955803, 2, 1),
(938955803, 4, 2),
(938955803, 5, 2),
(938955803, 6, 2),
(938955803, 10, 3),
(938955803, 11, 1),
(938955803, 12, 42);

-- --------------------------------------------------------

--
-- Table structure for table `showing`
--

CREATE TABLE `showing` (
  `showingID` int(11) NOT NULL,
  `movieTitle` varchar(50) NOT NULL,
  `complexName` varchar(100) NOT NULL,
  `theaterNum` int(11) NOT NULL,
  `startTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showing`
--

INSERT INTO `showing` (`showingID`, `movieTitle`, `complexName`, `theaterNum`, `startTime`) VALUES
(1, 'Face/Off', 'The Kingston Grand Theater', 2, '2018-03-28 10:30:00'),
(2, 'Ghost Rider', 'The Kingston Grand Theater', 2, '2018-03-28 12:30:00'),
(3, 'National Treasure: Book of Secrets', 'Kingston AMC Theater', 1, '2018-03-28 18:30:00'),
(4, 'Matchstick Men', 'Kingston Cineplex', 4, '2018-03-29 00:30:00'),
(5, 'Left Behind', 'Kingston Cineplex', 3, '2018-03-28 19:00:00'),
(6, 'Next', 'Kingston Cineplex', 2, '2018-03-28 23:05:00'),
(7, 'The Rock', 'Kingston Cineplex', 1, '2018-03-28 20:30:00'),
(8, 'The Weather Man', 'Kingston Cineplex', 1, '2018-03-28 23:00:00'),
(9, 'Face/Off', 'Kingston AMC Theater', 2, '2018-03-28 14:30:00'),
(10, 'National Treasure: Book of Secrets ', 'Kingston AMC Theater', 2, '2018-03-28 16:30:00'),
(11, 'The Weather Man ', 'Kingston AMC Theater', 2, '2018-03-28 19:00:00'),
(12, 'The Rock', 'Kingston AMC Theater', 1, '2018-03-28 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `companyName` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pc` char(6) NOT NULL,
  `phoneNum` char(10) NOT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`companyName`, `street`, `city`, `pc`, `phoneNum`, `fName`, `lName`) VALUES
('Action', '123 Alfred Street', 'Kingston', 'K7K5H8', '6132267435', 'Robert', 'Williams'),
('Cinema Supplies', '333 Bay Street', 'Toronto', 'M5A1N1', '4168651833', 'Amy', 'Brookes'),
('Reel to Reel', '873 York Street', 'Toronto', 'M5H2R0', '6477502054', 'Tim', 'Smith');

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `complexName` varchar(100) NOT NULL,
  `theaterNum` int(11) NOT NULL,
  `maxNumOfSeat` int(11) NOT NULL,
  `screenSize` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`complexName`, `theaterNum`, `maxNumOfSeat`, `screenSize`) VALUES
('Kingston AMC Theater', 1, 200, 'M'),
('Kingston AMC Theater', 2, 100, 'S'),
('Kingston Cineplex', 1, 200, 'M'),
('Kingston Cineplex', 2, 300, 'L'),
('Kingston Cineplex', 3, 250, 'M'),
('Kingston Cineplex', 4, 400, 'L'),
('The Kingston Grand Theater', 1, 50, 'S'),
('The Kingston Grand Theater', 2, 300, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `watched`
--

CREATE TABLE `watched` (
  `acctNum` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `customerRating` int(11) DEFAULT NULL,
  `customerReview` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `watched`
--

INSERT INTO `watched` (`acctNum`, `title`, `customerRating`, `customerReview`) VALUES
(213142, 'Face/Off', 3, 'Truly one of the movies I\'ve seen this year.'),
(213142, 'The Rock', 5, 'I liked the part with rocks in it.'),
(10189321, 'The Rock', 5, 'The acting by Sean Connery is simply the best acting ever.'),
(938955803, 'National Treasure: Book of Secrets', 4, 'I like secrets');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complex`
--
ALTER TABLE `complex`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`acctNum`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `email_3` (`email`);

--
-- Indexes for table `mainactors`
--
ALTER TABLE `mainactors`
  ADD PRIMARY KEY (`MovieTitle`,`FName`,`LName`) USING BTREE;

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`title`),
  ADD KEY `supplier` (`supplier`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`accountNum`,`showingID`),
  ADD KEY `showingID` (`showingID`);

--
-- Indexes for table `showing`
--
ALTER TABLE `showing`
  ADD PRIMARY KEY (`showingID`),
  ADD KEY `complexName` (`complexName`,`theaterNum`),
  ADD KEY `movieTitle` (`movieTitle`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`companyName`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`complexName`,`theaterNum`);

--
-- Indexes for table `watched`
--
ALTER TABLE `watched`
  ADD PRIMARY KEY (`acctNum`,`title`),
  ADD KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `showing`
--
ALTER TABLE `showing`
  MODIFY `showingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mainactors`
--
ALTER TABLE `mainactors`
  ADD CONSTRAINT `mainactors_ibfk_1` FOREIGN KEY (`MovieTitle`) REFERENCES `movie` (`title`);

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`companyName`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`accountNum`) REFERENCES `customer` (`acctNum`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`showingID`) REFERENCES `showing` (`showingID`);

--
-- Constraints for table `showing`
--
ALTER TABLE `showing`
  ADD CONSTRAINT `showing_ibfk_1` FOREIGN KEY (`complexName`,`theaterNum`) REFERENCES `theater` (`complexName`, `theaterNum`),
  ADD CONSTRAINT `showing_ibfk_2` FOREIGN KEY (`movieTitle`) REFERENCES `movie` (`title`);

--
-- Constraints for table `theater`
--
ALTER TABLE `theater`
  ADD CONSTRAINT `theater_ibfk_1` FOREIGN KEY (`complexName`) REFERENCES `complex` (`name`);

--
-- Constraints for table `watched`
--
ALTER TABLE `watched`
  ADD CONSTRAINT `watched_ibfk_1` FOREIGN KEY (`title`) REFERENCES `movie` (`title`),
  ADD CONSTRAINT `watched_ibfk_2` FOREIGN KEY (`acctNum`) REFERENCES `customer` (`acctNum`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
