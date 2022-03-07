-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table chs_strategy.activities
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `objective_id` int(11) NOT NULL,
  `strategy_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT 1,
  `expected_start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `date_started` date DEFAULT NULL,
  `date_completed` date DEFAULT NULL,
  `completion_note` varchar(500) NOT NULL DEFAULT '',
  `status` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_activities_objectives` (`objective_id`),
  KEY `FK_activities_users` (`user_id`),
  CONSTRAINT `FK_activities_objectives` FOREIGN KEY (`objective_id`) REFERENCES `objectives` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_activities_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table chs_strategy.activities: ~17 rows (approximately)
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT IGNORE INTO `activities` (`id`, `user_id`, `name`, `description`, `objective_id`, `strategy_id`, `weight`, `expected_start_date`, `due_date`, `date_started`, `date_completed`, `completion_note`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Hr Policy Update', 'Update the existing HR policy to be in tandem with the existing and future trends.', 3, 4, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-23 14:44:59', '2021-06-23 14:44:59'),
	(2, 1, 'Hr Policy Update 1', 'Update the existing HR policy to be in tandem with the existing and future trends.', 4, 4, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-23 15:03:30', '2021-06-23 15:03:30'),
	(3, 1, 'See', 'Update lets see what happens................', 4, 4, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-23 15:03:30', '2021-06-23 15:03:30'),
	(4, 1, 'Hr Policy Update', 'Update the existing HR policy to be in tandem with the existing and future trends.', 5, 5, 7, '2021-05-05', '2022-07-30', '2021-05-24', '2021-07-15', 'Hello, We did this and that', 'Completed', '2021-06-28 08:58:51', '2021-07-15 14:09:08'),
	(5, 1, 'ICT Enhancement', 'Enhance existing ICT infrastructure to enable remote access.', 5, 5, 1, '2021-05-01', '2024-02-14', '2021-06-15', NULL, '', 'Ongoing', '2021-06-28 08:58:51', '2021-07-15 14:43:21'),
	(6, 3, 'Online Boarding Module', 'Develop and implement an engaging online on-boarding module.', 5, 6, 1, '2022-01-01', '2022-10-18', NULL, NULL, '', 'Not Started', '2021-06-28 08:58:51', '2021-07-15 09:58:50'),
	(7, 3, 'Innovation Supporty', 'Develop a policy supporting a culture of innovation which will recognize and reward innovators.', 6, 7, 1, '2021-05-01', '2021-07-01', NULL, NULL, '', 'Not Started', '2021-06-28 08:58:51', '2021-07-16 11:46:29'),
	(8, 3, 'Strategic Skills database', 'Develop a database of strategic skills and competencies', 6, 8, 1, '2021-05-01', '2023-10-17', '0000-00-00', '0000-00-00', '', 'Not Started', '2021-06-28 08:58:51', '2021-07-14 13:38:15'),
	(9, 3, 'Recruitment module', 'Develop and deploy a recruitment module for online job application.', 7, 9, 1, '2021-05-01', '2021-08-01', '2021-07-01', '2021-07-15', '', 'Completed', '2021-06-28 08:58:51', '2021-07-16 09:14:12'),
	(10, 1, 'Internship and Volunteership policy', 'To update the internship and volunteership policy.', 7, 10, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(11, 1, 'Mentorship and coaching', 'Develop a framework to guide on mentorship & coaching.', 7, 11, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(12, 1, 'Brand ambassadorship', 'Develop a framework to guide on brand ambassadorship', 8, 12, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(13, 3, 'Brand ambassadorship policy ', 'Develop and disseminate brand ambassadorship policy documents to staff. ', 8, 12, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(14, 1, 'consultative forums', 'Develop a criteria for employees to demonstrate how they perceive  the brand and recommendation for improvements: consultative forums', 8, 12, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(15, 3, 'Virtual Tours', 'Create a repository of virtual tours of staff experiences in their line of duty using the various digital media platforms.', 8, 12, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(16, 1, 'Friends and Alumni', 'Develop a framework to guide on identification and engagement of friends of CHS and her alumni.', 8, 12, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(17, 3, 'Standardized brief/ profile', 'Develop a standardized brief/ profile of CHS for regular dissemination by staff to different audiences.', 8, 12, 1, '2021-05-01', '2021-08-01', NULL, NULL, '', '', '2021-06-28 08:58:51', '2021-06-28 08:58:51');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;

-- Dumping structure for table chs_strategy.activity_assignments
CREATE TABLE IF NOT EXISTS `activity_assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table chs_strategy.activity_assignments: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity_assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_assignments` ENABLE KEYS */;

-- Dumping structure for table chs_strategy.activity_pis
CREATE TABLE IF NOT EXISTS `activity_pis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__activities` (`activity_id`),
  CONSTRAINT `FK__activities` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Progress indicators for activities';

-- Dumping data for table chs_strategy.activity_pis: ~25 rows (approximately)
/*!40000 ALTER TABLE `activity_pis` DISABLE KEYS */;
INSERT IGNORE INTO `activity_pis` (`id`, `name`, `activity_id`, `created_at`, `updated_at`) VALUES
	(1, ' Updated HR policy ( On flexibility)', 1, '2021-06-23 14:44:59', '2021-06-23 14:44:59'),
	(2, ' Updated HR policy ( On flexibility)', 2, '2021-06-23 15:03:30', '2021-06-23 15:03:30'),
	(3, ' Hot thang.... Lets see what happens', 2, '2021-06-23 15:03:30', '2021-06-23 15:03:30'),
	(4, 'Updated HR policy ( On flexibility)', 4, '2021-06-28 08:58:51', '2021-07-04 16:35:12'),
	(5, 'Utilization of updated Policy (Number of staff on flexible work arrangement)', 4, '2021-06-28 08:58:51', '2021-07-04 16:35:57'),
	(6, 'Number of ICT platforms being accessed remotely( Navision, CRIS, Fleet Management, Host to Host etc)', 5, '2021-06-28 08:58:51', '2021-07-04 19:03:53'),
	(7, 'Availability of the online on boarding module (On boarding Curriculum)', 6, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(8, 'Number of new staff oriented through on boarding module', 6, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(9, 'Availability of the innovation policy', 7, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(10, 'Number of products and initiatives developed.  ', 7, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(11, 'Number of products and initiatives developed.', 7, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(12, ' Availability of a skills and competence database.                             ', 8, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(13, 'Availability of online recruitment module', 9, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(14, 'Number of applications done through the online module', 9, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(15, 'Availabilty of updated internship and volunteership policy.', 10, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(16, ' Number of interns and volunteers engaged.', 10, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(17, 'Availability and roll-out of the coaching and mentorship policy.', 11, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(18, 'Number of active mentors and mentees within the organization.', 11, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(19, 'Availability of the policy on CHS brand ambassadorship.', 12, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(20, 'Number of staff who have read the brand ambassadorship policy and responded to  the related survey', 13, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(21, 'Number of staff brand engagement opportunities created', 14, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(22, 'Document and publicize experiences and testimonials from beneficiaries, staff, and other stakeholders.', 15, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(23, 'Availability  of the framework for identification and engagement of friends of CHS and her alumni. ', 16, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(24, 'Number of identified and engaged ‘Friends of CHS’ and CHS alumni.', 16, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(25, 'Number of sensitized staff, friends and alumni.', 17, '2021-06-28 08:58:51', '2021-06-28 08:58:51');
/*!40000 ALTER TABLE `activity_pis` ENABLE KEYS */;

-- Dumping structure for table chs_strategy.activity_progresses
CREATE TABLE IF NOT EXISTS `activity_progresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `increment` double NOT NULL,
  `note` varchar(500) NOT NULL DEFAULT '',
  `added_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_activity_progresses_activities` (`activity_id`),
  CONSTRAINT `FK_activity_progresses_activities` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Saves gradual progresses for pis';

-- Dumping data for table chs_strategy.activity_progresses: ~3 rows (approximately)
/*!40000 ALTER TABLE `activity_progresses` DISABLE KEYS */;
INSERT IGNORE INTO `activity_progresses` (`id`, `activity_id`, `date`, `increment`, `note`, `added_by`, `created_at`, `updated_at`) VALUES
	(1, 4, '2021-07-12', 40, 'The work well done', 1, '2021-07-12 11:31:54', '2021-07-12 11:31:54'),
	(2, 4, '2021-07-12', 4, 'Next', 1, '2021-07-12 12:17:25', '2021-07-12 12:17:25'),
	(5, 4, '2021-07-13', 20, 'New Progress', 1, '2021-07-13 16:18:39', '2021-07-13 16:18:39');
/*!40000 ALTER TABLE `activity_progresses` ENABLE KEYS */;

-- Dumping structure for table chs_strategy.activity_reports
CREATE TABLE IF NOT EXISTS `activity_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `completed_tasks` varchar(250) NOT NULL,
  `pending_tasks` varchar(250) NOT NULL,
  `recommendations` varchar(250) NOT NULL,
  `challenges` varchar(250) NOT NULL,
  `lead_comment` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_activity_reports_activities` (`activity_id`),
  KEY `FK_activity_reports_users` (`user_id`),
  CONSTRAINT `FK_activity_reports_activities` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_activity_reports_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table chs_strategy.activity_reports: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity_reports` DISABLE KEYS */;
INSERT IGNORE INTO `activity_reports` (`id`, `activity_id`, `user_id`, `completed_tasks`, `pending_tasks`, `recommendations`, `challenges`, `lead_comment`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
	(1, 4, 1, 'I completed this', 'I pended that', 'i recommend such', '', '', '2021-07-01', '2021-07-14', '2021-07-14 11:04:29', '2021-07-14 11:04:29');
/*!40000 ALTER TABLE `activity_reports` ENABLE KEYS */;

-- Dumping structure for table chs_strategy.goals
CREATE TABLE IF NOT EXISTS `goals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `lead` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='goals for chs';

-- Dumping data for table chs_strategy.goals: ~5 rows (approximately)
/*!40000 ALTER TABLE `goals` DISABLE KEYS */;
INSERT IGNORE INTO `goals` (`id`, `name`, `description`, `lead`, `created_at`, `updated_at`) VALUES
	(1, 'Goal 1', 'n a flexible work environment: Engaging inspired and multi-competent individuals i', '1', '2021-06-23 14:24:20', '2021-06-23 14:24:20'),
	(11, 'Goal 4', ' individuals in a flexible work: Engaging inspired and multi-competent environment', '1', '2021-06-23 14:44:59', '2021-06-23 14:44:59'),
	(13, 'Goal 3', 'Update individuals in a flexible work environment', '1', '2021-06-23 15:03:30', '2021-06-23 15:03:30'),
	(14, 'Goal 2', 'Engaging inspired and multi-competent individuals in a flexible work environment', '1', '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(15, 'Goal Paramount', 'This is a paramount goal', '1', '2021-07-09 12:04:22', '2021-07-09 12:04:22');
/*!40000 ALTER TABLE `goals` ENABLE KEYS */;

-- Dumping structure for table chs_strategy.objectives
CREATE TABLE IF NOT EXISTS `objectives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `description` varchar(500) NOT NULL DEFAULT '0',
  `goal_id` int(11) NOT NULL,
  `lead` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_objectives_goals` (`goal_id`),
  KEY `FK_objectives_users` (`lead`),
  CONSTRAINT `FK_objectives_goals` FOREIGN KEY (`goal_id`) REFERENCES `goals` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_objectives_users` FOREIGN KEY (`lead`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table chs_strategy.objectives: ~8 rows (approximately)
/*!40000 ALTER TABLE `objectives` DISABLE KEYS */;
INSERT IGNORE INTO `objectives` (`id`, `name`, `description`, `goal_id`, `lead`, `created_by`, `created_at`, `updated_at`) VALUES
	(3, 'Objective 1', 'Objective 1: To establish a flexible work arrangement that facilitates and responds to the novel and future work environment by 2021 ', 11, 1, 0, '2021-06-23 14:44:59', '2021-06-23 14:44:59'),
	(4, 'Objective 1', 'Objective 1: To establish a flexible work arrangement that facilitates and responds to the novel and future work environment by 2021 ', 13, 1, 0, '2021-06-23 15:03:30', '2021-06-23 15:03:30'),
	(5, 'Objective 1', 'To establish a flexible work arrangement that facilitates and responds to the novel and future work environment by 2021', 14, 1, 0, '2021-06-28 08:58:51', '2021-07-13 11:55:55'),
	(6, 'Objective 2', 'To promote a culture of innovations by optimizing multi-competent, inspired, and passionate individuals who will add value to the organization', 14, 1, 0, '2021-06-28 08:58:51', '2021-07-13 11:56:10'),
	(7, 'Objective 3', 'To recruit and retain 95% of a dynamic workforce that will help achieve organizational goals', 14, 1, 0, '2021-06-28 08:58:51', '2021-07-13 11:56:50'),
	(8, 'Objective 4', 'To engage people in positioning CHS as a brand', 14, 1, 0, '2021-06-28 08:58:51', '2021-07-13 11:56:37'),
	(9, 'Test 0', 'Test Objective', 1, 3, 0, '2021-07-09 11:30:46', '2021-07-13 11:56:22'),
	(10, 'Test 1', 'Test Objective erranda', 1, 3, 0, '2021-07-09 11:31:16', '2021-07-09 11:43:44');
/*!40000 ALTER TABLE `objectives` ENABLE KEYS */;

-- Dumping structure for table chs_strategy.pi_assignments
CREATE TABLE IF NOT EXISTS `pi_assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores users + activity(teams)';

-- Dumping data for table chs_strategy.pi_assignments: ~0 rows (approximately)
/*!40000 ALTER TABLE `pi_assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `pi_assignments` ENABLE KEYS */;

-- Dumping structure for table chs_strategy.strategies
CREATE TABLE IF NOT EXISTS `strategies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL DEFAULT '0',
  `objective_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table chs_strategy.strategies: ~12 rows (approximately)
/*!40000 ALTER TABLE `strategies` DISABLE KEYS */;
INSERT IGNORE INTO `strategies` (`id`, `name`, `objective_id`, `created_at`, `updated_at`) VALUES
	(1, 'Create flexible staff contracting arrangements to include: part-time, secondment, flexi hours, job sharing among others, and its applicable reward system. ', 3, '2021-06-23 14:44:59', '2021-06-23 14:44:59'),
	(2, 'Deepen adoption of technology solutions as an enabler of flexibility in the workplace. ', 3, '2021-06-23 14:44:59', '2021-06-23 14:44:59'),
	(3, 'Create flexible staff contracting arrangements to include: part-time, secondment, flexi hours, job sharing among others, and its applicable reward system. ', 4, '2021-06-23 15:03:30', '2021-06-23 15:03:30'),
	(4, 'Deepen adoption of technology solutions as an enabler of flexibility in the workplace. ', 4, '2021-06-23 15:03:30', '2021-06-23 15:03:30'),
	(5, 'Create flexible staff contracting arrangements to include: part-time, secondment, flexi hours, job sharing among others, and its applicable reward system. ', 5, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(6, 'Deepen adoption of technology solutions as an enabler of flexibility in the workplace. ', 5, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(7, 'Develop a reward system for innovations. ', 6, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(8, 'Match strategic competencies of the workforce to available jobs in the workplace to optimize productivity.', 6, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(9, 'Automate the recruitment process to include online job applications.', 7, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(10, 'Adopt a structured internship & volunteership program ', 7, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(11, 'Establish a mentorship culture to boost internal capacity amongst staff', 7, '2021-06-28 08:58:51', '2021-06-28 08:58:51'),
	(12, 'Develop a policy  to guide identification and engagement of CHS brand ambassadors:  ‘Friends of CHS’, CHS alumni', 8, '2021-06-28 08:58:51', '2021-06-28 08:58:51');
/*!40000 ALTER TABLE `strategies` ENABLE KEYS */;

-- Dumping structure for table chs_strategy.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','') NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL,
  `mobile` char(10) NOT NULL,
  `operation_base` int(11) NOT NULL DEFAULT 1,
  `designation` varchar(50) NOT NULL,
  `password` varchar(591) DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  `isAdmin` tinyint(2) NOT NULL DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table chs_strategy.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `gender`, `email`, `mobile`, `operation_base`, `designation`, `password`, `active`, `isAdmin`, `last_login`, `created_at`, `updated_at`) VALUES
	(1, 'kimani Joseph', 'Male', 'jkimani@chskenya.org', '0712345679', 1, 'admin', '$2y$10$hZjfkIAQ4XiVs.dSjzAJEuv/0fpbgPDcSh9VvtC2IIoYYF79hO8OK', 1, 0, '2021-07-18 12:51:00', '2021-06-23 13:58:50', '2021-07-18 12:51:01'),
	(3, 'Jemimah Wambui', 'Female', 'jwambui@chskenya.org', '0790992751', 2, 'Software Developer', '$2y$10$SpCCwxFLBylUghQU4e/MjO7kWNh4G6eGySEvfvoHPOKZ/GY4z2/Eq', 1, 0, '2021-07-01 12:30:46', '2021-07-01 11:11:45', '2021-07-01 12:30:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
