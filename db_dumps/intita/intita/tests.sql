-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-10 17:27:20
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.tests
DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `block_element` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8;

-- Dumping data for table intita.tests: ~170 rows (approximately)
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` (`id`, `block_element`, `author`, `title`) VALUES
	(35, 310, 2, 'hystjhytw'),
	(36, 311, 2, 'i578ik57'),
	(37, 349, 1, 'тест 1'),
	(38, 350, 1, 'тест'),
	(39, 353, 1, 'jfjhjkgkg'),
	(40, 358, 1, 'ghghghghghg'),
	(41, 386, 1, 'Основы алгоритмизации и языки программирования'),
	(42, 387, 1, ''),
	(43, 388, 1, ''),
	(44, 389, 1, ''),
	(45, 390, 1, ''),
	(46, 391, 1, ''),
	(47, 392, 1, '1'),
	(48, 393, 1, ''),
	(49, 394, 1, ''),
	(50, 397, 1, ''),
	(51, 399, 1, ''),
	(52, 401, 1, ''),
	(53, 402, 1, ''),
	(54, 403, 1, ''),
	(55, 404, 1, ''),
	(56, 405, 1, ''),
	(57, 406, 1, 'dddd'),
	(58, 407, 1, 'bgfg'),
	(59, 408, 1, ''),
	(60, 409, 1, 'rertfert'),
	(61, 415, 1, ''),
	(62, 418, 1, ''),
	(63, 436, 1, 'тест'),
	(64, 454, 1, ''),
	(65, 455, 1, ''),
	(66, 456, 1, ''),
	(67, 457, 1, ''),
	(68, 458, 1, ''),
	(69, 459, 1, ''),
	(70, 460, 1, ''),
	(71, 461, 1, ''),
	(72, 484, 1, ''),
	(73, 493, 1, ''),
	(74, 498, 1, 'yjrkjir7k'),
	(75, 504, 1, 'test'),
	(76, 505, 1, 'efer'),
	(77, 509, 1, '1'),
	(78, 471, 1, 'test'),
	(79, 492, 1, 'bhjb'),
	(80, 515, 1, 'ьтиптипситясбп'),
	(81, 524, 1, 'тест'),
	(82, 525, 1, ''),
	(83, 528, 1, ''),
	(84, 535, 1, '111111111'),
	(85, 536, 1, '123123'),
	(86, 538, 1, '11111111111111111111111111111111111111111111111111'),
	(87, 540, 1, 'ffff'),
	(88, 541, 1, 'QBASIC — это'),
	(89, 542, 1, 'QBASIC — это'),
	(90, 543, 1, 'QBASIC — это'),
	(91, 546, 1, NULL),
	(92, 547, 1, NULL),
	(93, 549, 1, NULL),
	(94, 552, 1, NULL),
	(95, 553, 1, NULL),
	(96, 494, 1, 'test'),
	(97, 494, 1, 'test'),
	(98, 555, 2, NULL),
	(99, 556, 2, NULL),
	(100, 557, 2, NULL),
	(101, 560, 2, NULL),
	(102, 564, 1, NULL),
	(103, 569, 2, NULL),
	(104, 571, 1, NULL),
	(105, 577, 1, NULL),
	(106, 578, 1, NULL),
	(107, 579, 1, NULL),
	(108, 580, 1, NULL),
	(109, 585, 1, NULL),
	(110, 586, 1, NULL),
	(111, 587, 1, NULL),
	(112, 531, 1, '2'),
	(113, 530, 1, 'bkj'),
	(114, 529, 1, 'nkl'),
	(115, 590, 1, NULL),
	(116, 591, 1, NULL),
	(117, 593, 1, NULL),
	(118, 594, 1, NULL),
	(119, 595, 1, NULL),
	(120, 596, 1, NULL),
	(121, 597, 1, NULL),
	(122, 601, 1, NULL),
	(123, 602, 1, NULL),
	(124, 603, 1, NULL),
	(125, 728, 1, NULL),
	(126, 732, 9, NULL),
	(127, 736, 9, NULL),
	(128, 739, 9, NULL),
	(129, 743, 9, NULL),
	(130, 747, 9, NULL),
	(131, 750, 9, NULL),
	(132, 751, 1, NULL),
	(133, 754, 9, NULL),
	(134, 757, 9, NULL),
	(135, 760, 9, NULL),
	(136, 765, 9, NULL),
	(137, 769, 9, NULL),
	(138, 773, 9, NULL),
	(139, 776, 9, NULL),
	(140, 780, 9, NULL),
	(141, 783, 9, NULL),
	(142, 789, 9, NULL),
	(143, 792, 9, NULL),
	(144, 795, 9, NULL),
	(145, 799, 9, NULL),
	(146, 802, 9, NULL),
	(147, 806, 9, NULL),
	(148, 809, 9, NULL),
	(149, 812, 9, NULL),
	(150, 815, 9, NULL),
	(151, 818, 9, NULL),
	(152, 822, 9, NULL),
	(153, 825, 9, NULL),
	(154, 828, 9, NULL),
	(155, 829, 1, NULL),
	(156, 830, 1, NULL),
	(157, 831, 1, NULL),
	(158, 832, 1, NULL),
	(159, 833, 1, NULL),
	(160, 836, 1, NULL),
	(161, 837, 1, NULL),
	(162, 838, 1, NULL),
	(163, 839, 1, NULL),
	(164, 840, 1, NULL),
	(165, 841, 1, NULL),
	(166, 842, 1, NULL),
	(167, 843, 1, NULL),
	(168, 844, 1, NULL),
	(169, 845, 1, NULL),
	(170, 846, 1, NULL),
	(171, 852, 11, NULL),
	(172, 857, 9, NULL),
	(173, 860, 9, NULL),
	(174, 867, 9, NULL),
	(175, 873, 9, NULL),
	(176, 874, 9, NULL),
	(177, 877, 9, NULL),
	(178, 880, 9, NULL),
	(179, 884, 9, NULL),
	(180, 899, 9, NULL),
	(181, 902, 9, NULL),
	(182, 905, 9, NULL),
	(183, 917, 9, NULL),
	(184, 918, 9, NULL),
	(185, 919, 9, NULL),
	(186, 920, 9, NULL),
	(187, 921, 9, NULL),
	(188, 924, 9, NULL),
	(189, 928, 9, NULL),
	(190, 932, 9, NULL),
	(191, 936, 9, NULL),
	(192, 939, 9, NULL),
	(193, 942, 9, NULL),
	(194, 945, 9, NULL),
	(195, 948, 9, NULL),
	(196, 951, 9, NULL),
	(197, 954, 9, NULL),
	(198, 956, 1, NULL),
	(199, 958, 1, NULL),
	(200, 963, 1, NULL),
	(201, 964, 1, NULL),
	(202, 968, 1, NULL),
	(203, 970, 1, NULL),
	(204, 976, 2, NULL);
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;