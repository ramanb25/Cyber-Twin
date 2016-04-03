CREATE DATABASE IF NOT EXISTS cyber_twin;
USE cyber_twin;
--
-- Database: `cyber_twin`
--

-- --------------------------------------------------------

--
-- Table structure for table `buttons`
--

CREATE TABLE IF NOT EXISTS `buttons` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `under` int(11) DEFAULT NULL,
  `show_name` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buttons`
--



-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `job_type` varchar(255) DEFAULT NULL,
  `component` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id_login` int(11) NOT NULL,
  `name_login` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type_login` int(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--



-- --------------------------------------------------------

--
-- Table structure for table `lunch_tea`
--

CREATE TABLE IF NOT EXISTS `lunch_tea` (
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `machine_failure`
--

CREATE TABLE IF NOT EXISTS `machine_failure` (
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `failed_unit` varchar(255) DEFAULT NULL,
  `failure_mode` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operator_unavailability`
--

CREATE TABLE IF NOT EXISTS `operator_unavailability` (
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `cause` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pm`
--

CREATE TABLE IF NOT EXISTS `pm` (
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `precautionary_check`
--

CREATE TABLE IF NOT EXISTS `precautionary_check` (
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_stoppage`
--

CREATE TABLE IF NOT EXISTS `production_stoppage` (
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `cause` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setup_change`
--

CREATE TABLE IF NOT EXISTS `setup_change` (
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `old_setup` varchar(255) DEFAULT NULL,
  `new_setup` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buttons`
--
ALTER TABLE `buttons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buttons`
--
ALTER TABLE `buttons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;



INSERT INTO `login` (`id_login`, `name_login`, `username`, `password`, `type_login`) VALUES
(17, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(18, 'operator', 'operator', '4b583376b2767b923c3e1da60d10de59', 0);

INSERT INTO `buttons` (`id`, `name`, `under`, `show_name`) VALUES
(3, 'production_stoppage', NULL, 'Production Stoppage'),
(4, 'lunch_tea', NULL, 'Lunch/Tea'),
(5, 'machine_failure', NULL, 'Machine Failure'),
(6, 'job', NULL, 'Job'),
(7, 'precautionary_check', NULL, 'Precautionary Check'),
(8, 'operator_unavailability', NULL, 'Operator Unavailability');
