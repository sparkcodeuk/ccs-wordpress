CREATE TABLE `ccs_frameworks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rm_number` varchar(255) DEFAULT NULL,
  `wordpress_id` varchar(255) DEFAULT NULL,
  `salesforce_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `pillar` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `tenders_open_date` date DEFAULT NULL,
  `tenders_close_date` date DEFAULT NULL,
  `expected_live_date` date DEFAULT NULL,
  `expected_award_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;