DROP TABLE IF EXISTS `splendor_card`;

CREATE TABLE `splendor_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prestige` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `emeraldTokens` int(11) NOT NULL,
  `sapphireTokens` int(11) NOT NULL,
  `rubyTokens` int(11) NOT NULL,
  `diamondTokens` int(11) NOT NULL,
  `onyxTokens` int(11) NOT NULL,
  `bonus` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `splendor_card` VALUES(1, 0, 1, 0, 1, 1, 1, 1, 'Green');
INSERT INTO `splendor_card` VALUES(2, 0, 1, 0, 1, 1, 1, 2, 'Green');
INSERT INTO `splendor_card` VALUES(3, 0, 1, 0, 1, 2, 0, 2, 'Green');
INSERT INTO `splendor_card` VALUES(4, 0, 1, 1, 3, 0, 1, 0, 'Green');
INSERT INTO `splendor_card` VALUES(5, 0, 1, 0, 1, 0, 2, 0, 'Green');
INSERT INTO `splendor_card` VALUES(6, 0, 1, 0, 2, 2, 0, 0, 'Green');
INSERT INTO `splendor_card` VALUES(7, 0, 1, 0, 0, 3, 0, 0, 'Green');
INSERT INTO `splendor_card` VALUES(8, 1, 1, 0, 0, 0, 0, 4, 'Green');
INSERT INTO `splendor_card` VALUES(9, 0, 1, 1, 0, 1, 1, 1, 'Blue');
INSERT INTO `splendor_card` VALUES(10, 0, 1, 1, 0, 2, 1, 1, 'Blue');
INSERT INTO `splendor_card` VALUES(11, 0, 1, 2, 0, 2, 1, 0, 'Blue');
INSERT INTO `splendor_card` VALUES(12, 0, 1, 3, 1, 1, 0, 0, 'Blue');
INSERT INTO `splendor_card` VALUES(13, 0, 1, 0, 0, 0, 1, 2, 'Blue');
INSERT INTO `splendor_card` VALUES(14, 0, 1, 2, 0, 0, 0, 2, 'Blue');
INSERT INTO `splendor_card` VALUES(15, 0, 1, 0, 0, 0, 0, 3, 'Blue');
INSERT INTO `splendor_card` VALUES(16, 1, 1, 0, 0, 4, 0, 0, 'Blue');
INSERT INTO `splendor_card` VALUES(17, 0, 1, 1, 1, 0, 1, 1, 'Red');
INSERT INTO `splendor_card` VALUES(18, 0, 1, 1, 1, 0, 2, 1, 'Red');
INSERT INTO `splendor_card` VALUES(19, 0, 1, 1, 0, 0, 2, 2, 'Red');
INSERT INTO `splendor_card` VALUES(20, 0, 1, 0, 0, 1, 1, 3, 'Red');
INSERT INTO `splendor_card` VALUES(21, 0, 1, 1, 2, 0, 0, 0, 'Red');
INSERT INTO `splendor_card` VALUES(22, 0, 1, 0, 0, 2, 2, 1, 'Red');
INSERT INTO `splendor_card` VALUES(23, 0, 1, 0, 0, 0, 3, 0, 'Red');
INSERT INTO `splendor_card` VALUES(24, 1, 1, 0, 0, 0, 4, 0, 'Red');
INSERT INTO `splendor_card` VALUES(25, 0, 1, 1, 1, 1, 0, 1, 'White');
INSERT INTO `splendor_card` VALUES(26, 0, 1, 2, 1, 1, 0, 1, 'White');
INSERT INTO `splendor_card` VALUES(27, 0, 1, 2, 2, 0, 0, 1, 'White');
INSERT INTO `splendor_card` VALUES(28, 0, 1, 0, 1, 0, 3, 1, 'White');
INSERT INTO `splendor_card` VALUES(29, 0, 1, 0, 0, 2, 0, 1, 'White');
INSERT INTO `splendor_card` VALUES(30, 0, 1, 0, 2, 0, 0, 2, 'White');
INSERT INTO `splendor_card` VALUES(31, 0, 1, 0, 3, 0, 0, 0, 'White');
INSERT INTO `splendor_card` VALUES(32, 1, 1, 4, 0, 0, 0, 0, 'White');
INSERT INTO `splendor_card` VALUES(33, 0, 1, 1, 1, 1, 1, 0, 'Black');
INSERT INTO `splendor_card` VALUES(34, 0, 1, 1, 2, 1, 1, 0, 'Black');
INSERT INTO `splendor_card` VALUES(35, 0, 1, 0, 2, 1, 2, 0, 'Black');
INSERT INTO `splendor_card` VALUES(36, 0, 1, 1, 0, 3, 0, 1, 'Black');
INSERT INTO `splendor_card` VALUES(37, 0, 1, 2, 0, 1, 0, 0, 'Black');
INSERT INTO `splendor_card` VALUES(38, 0, 1, 2, 0, 0, 2, 0, 'Black');
INSERT INTO `splendor_card` VALUES(39, 0, 1, 3, 0, 0, 0, 0, 'Black');
INSERT INTO `splendor_card` VALUES(40, 1, 1, 0, 4, 0, 0, 0, 'Black');
INSERT INTO `splendor_card` VALUES(41, 1, 2, 2, 0, 3, 3, 0, 'Green');
INSERT INTO `splendor_card` VALUES(42, 1, 2, 0, 3, 0, 2, 2, 'Green');
INSERT INTO `splendor_card` VALUES(43, 2, 2, 0, 2, 0, 4, 1, 'Green');
INSERT INTO `splendor_card` VALUES(44, 2, 2, 3, 5, 0, 0, 0, 'Green');
INSERT INTO `splendor_card` VALUES(45, 2, 2, 5, 0, 0, 0, 0, 'Green');
INSERT INTO `splendor_card` VALUES(46, 3, 2, 6, 0, 0, 0, 0, 'Green');
INSERT INTO `splendor_card` VALUES(47, 1, 2, 2, 2, 3, 0, 0, 'Blue');
INSERT INTO `splendor_card` VALUES(48, 1, 2, 3, 2, 0, 0, 3, 'Blue');
INSERT INTO `splendor_card` VALUES(49, 2, 2, 0, 3, 0, 5, 0, 'Blue');
INSERT INTO `splendor_card` VALUES(50, 2, 2, 0, 0, 1, 2, 4, 'Blue');
INSERT INTO `splendor_card` VALUES(51, 2, 2, 0, 5, 0, 0, 0, 'Blue');
INSERT INTO `splendor_card` VALUES(52, 3, 2, 0, 6, 0, 0, 0, 'Blue');
INSERT INTO `splendor_card` VALUES(53, 1, 2, 0, 0, 2, 2, 3, 'Red');
INSERT INTO `splendor_card` VALUES(54, 1, 2, 0, 3, 2, 0, 3, 'Red');
INSERT INTO `splendor_card` VALUES(55, 2, 2, 2, 4, 0, 1, 0, 'Red');
INSERT INTO `splendor_card` VALUES(56, 2, 2, 0, 0, 0, 3, 5, 'Red');
INSERT INTO `splendor_card` VALUES(57, 2, 2, 0, 0, 0, 0, 5, 'Red');
INSERT INTO `splendor_card` VALUES(58, 3, 2, 0, 0, 6, 0, 0, 'Red');
INSERT INTO `splendor_card` VALUES(59, 1, 2, 3, 0, 2, 0, 2, 'White');
INSERT INTO `splendor_card` VALUES(60, 1, 2, 0, 3, 3, 2, 0, 'White');
INSERT INTO `splendor_card` VALUES(61, 2, 2, 1, 0, 4, 0, 2, 'White');
INSERT INTO `splendor_card` VALUES(62, 2, 2, 0, 0, 5, 0, 3, 'White');
INSERT INTO `splendor_card` VALUES(63, 2, 2, 0, 0, 5, 0, 0, 'White');
INSERT INTO `splendor_card` VALUES(64, 3, 2, 0, 0, 0, 6, 0, 'White');
INSERT INTO `splendor_card` VALUES(65, 1, 2, 2, 2, 0, 3, 1, 'Black');
INSERT INTO `splendor_card` VALUES(66, 1, 2, 3, 0, 0, 3, 2, 'Black');
INSERT INTO `splendor_card` VALUES(67, 2, 2, 4, 1, 2, 0, 0, 'Black');
INSERT INTO `splendor_card` VALUES(68, 2, 2, 5, 0, 3, 0, 0, 'Black');
INSERT INTO `splendor_card` VALUES(69, 2, 2, 0, 0, 0, 5, 0, 'Black');
INSERT INTO `splendor_card` VALUES(70, 3, 2, 0, 0, 0, 0, 6, 'Black');
INSERT INTO `splendor_card` VALUES(71, 3, 3, 0, 3, 3, 5, 3, 'Green');
INSERT INTO `splendor_card` VALUES(72, 4, 3, 0, 7, 0, 0, 0, 'Green');
INSERT INTO `splendor_card` VALUES(73, 4, 3, 3, 6, 0, 3, 0, 'Green');
INSERT INTO `splendor_card` VALUES(74, 5, 3, 3, 7, 0, 0, 0, 'Green');
INSERT INTO `splendor_card` VALUES(75, 3, 3, 3, 0, 3, 3, 5, 'Blue');
INSERT INTO `splendor_card` VALUES(76, 4, 3, 0, 0, 0, 7, 0, 'Blue');
INSERT INTO `splendor_card` VALUES(77, 4, 3, 0, 3, 0, 6, 3, 'Blue');
INSERT INTO `splendor_card` VALUES(78, 5, 3, 0, 3, 0, 7, 0, 'Blue');
INSERT INTO `splendor_card` VALUES(79, 3, 3, 3, 5, 0, 3, 3, 'Red');
INSERT INTO `splendor_card` VALUES(80, 4, 3, 7, 0, 0, 0, 0, 'Red');
INSERT INTO `splendor_card` VALUES(81, 4, 3, 6, 3, 3, 0, 0, 'Red');
INSERT INTO `splendor_card` VALUES(82, 5, 3, 7, 0, 3, 0, 0, 'Red');
INSERT INTO `splendor_card` VALUES(83, 3, 3, 3, 3, 5, 0, 3, 'White');
INSERT INTO `splendor_card` VALUES(84, 4, 3, 0, 0, 0, 0, 7, 'White');
INSERT INTO `splendor_card` VALUES(85, 4, 3, 0, 0, 3, 3, 6, 'White');
INSERT INTO `splendor_card` VALUES(86, 5, 3, 0, 0, 0, 3, 7, 'White');
INSERT INTO `splendor_card` VALUES(87, 3, 3, 5, 3, 3, 3, 0, 'Black');
INSERT INTO `splendor_card` VALUES(88, 4, 3, 0, 0, 7, 0, 0, 'Black');
INSERT INTO `splendor_card` VALUES(89, 4, 3, 3, 0, 6, 0, 3, 'Black');
INSERT INTO `splendor_card` VALUES(90, 5, 3, 0, 0, 7, 0, 3, 'Black');
INSERT INTO `splendor_card` VALUES(91, 3, 0, 4, 0, 4, 0, 0, 'Noble');
INSERT INTO `splendor_card` VALUES(92, 3, 0, 0, 0, 3, 3, 3, 'Noble');
INSERT INTO `splendor_card` VALUES(93, 3, 0, 0, 4, 0, 4, 0, 'Noble');
INSERT INTO `splendor_card` VALUES(94, 3, 0, 0, 0, 0, 4, 4, 'Noble');
INSERT INTO `splendor_card` VALUES(95, 3, 0, 4, 4, 0, 0, 0, 'Noble');
INSERT INTO `splendor_card` VALUES(96, 3, 0, 3, 3, 3, 0, 0, 'Noble');
INSERT INTO `splendor_card` VALUES(97, 3, 0, 3, 3, 0, 3, 0, 'Noble');
INSERT INTO `splendor_card` VALUES(98, 3, 0, 0, 0, 4, 0, 4, 'Noble');
INSERT INTO `splendor_card` VALUES(99, 3, 0, 0, 3, 0, 3, 3, 'Noble');
INSERT INTO `splendor_card` VALUES(100, 3, 0, 3, 0, 3, 0, 3, 'Noble');