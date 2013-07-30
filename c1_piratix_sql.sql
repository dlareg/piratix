-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 30 Juillet 2013 à 09:58
-- Version du serveur: 5.5.31
-- Version de PHP: 5.3.10-1ubuntu3.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `c1_piratix_sql`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `idcat` int(11) NOT NULL,
  `nomcat` varchar(80) NOT NULL,
  `descripcat` mediumtext NOT NULL,
  `urlcat` varchar(180) NOT NULL,
  `imagecat` varchar(100) NOT NULL,
  PRIMARY KEY (`idcat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`idcat`, `nomcat`, `descripcat`, `urlcat`, `imagecat`) VALUES
(1, 'Gnu/Linux', 'Linux, ou GNU/Linux, est un système d''exploitation compatible POSIX. Linux est basé sur le noyau Linux, logiciel libre créé en 1991 par Linus Torvalds pour ordinateur compatible PC.\r\n\r\nDéveloppé sur Internet par des milliers d''informaticiens bénévoles et salariés, Linux fonctionne maintenant sur du matériel allant du téléphone portable au supercalculateur. Il existe de nombreuses distributions Linux indépendantes, destinées aux ordinateurs personnels et serveurs informatiques, pour lesquels Linux est très populaire. Elles incluent des milliers de logiciels, notamment ceux du projet GNU, d''où la dénomination GNU/Linux. Linux est également populaire sur système embarqué[1]. La mascotte de Linux est le manchot Tux.', 'http://fr.wikipedia.org/wiki/Linux', 'linux.png'),
(2, 'xBSD', 'Berkeley Software Distribution, abrégé en BSD, désigne en informatique une famille de systèmes d''exploitation Unix, développés à l''Université de Californie (Berkeley) entre 1977 et 1995 par un groupe de programmeurs : Bill Joy, Marshall Kirk McKusick, Kenneth Thompson etc.\r\n\r\nA l''origine, BSD intégrait du code développé par l''université de Berkeley, code qui sera porté sous licence libre (licence BSD) à la fin des années 1980, et du code propriétaire développé par la société AT&T.\r\n\r\nEntre la fin des années 1980 et le début des années 1990, le code AT&T (qui impliquait le paiement de licences) a été remplacé par du code libre, faisant de BSD un des premiers systèmes d''exploitation entièrement libres, parallèlement à Linux, autre variante d''UNIX, qui a cependant connu une utilisation plus large.\r\nUne des premières réécritures libre (open source) fut celle des couches réseaux, publiée pour la première fois en juin 1989, et qui sera rapidement utilisée par le projet GNU puis par Linux.\r\n\r\nLes systèmes BSD sont très orientés serveurs, même s''il existe quelques variantes pour PC.\r\n\r\nLes systèmes BSD sont réputés pour leur organisation et leurs performances dans leurs domaines de prédilection : la fiabilité en tant que serveur pour FreeBSD, la portabilité pour NetBSD et la sécurité pour OpenBSD.\r\n\r\nLeur stabilité exceptionnelle leur permet de fonctionner sans s''arrêter ni redémarrer durant des périodes extrêmement longues (plusieurs années)[1].\r\n\r\nLes descendants encore utilisés de cette famille sont :\r\n\r\n    * NetBSD, descendant de 386BSD 0.1 et de 4.3BSD NET/2. Projet séparé lancé en 1993 (logiciel libre).\r\n          o OpenBSD dérivé de NetBSD. Projet séparé lancé en 1995 (logiciel libre), avec une version CD aujourd''hui arrêtée, OliveBSD.\r\n    * FreeBSD, descendant de 386BSD. Projet séparé lancé en 1993 (logiciel libre)\r\n          o Les variantes d''utilisation de FreeBSD\r\n                + DesktopBSD. Lancé en 2004, c''est une version de FreeBSD pour les PC de bureau.\r\n                + FreeSBIE, dérivé de FreeBSD 5. Lancé en 2003, c''est une version Live-CD de FreeBSD, dont le développement est arrêté.\r\n                + PC-BSD, basé sur FreeBSD 7, version avec interface graphique très facile à installer et utiliser. Projet lancé en 2005.\r\n                + PicoBSD, dérivé de FreeBSD 3. Une version très légère, aujourd''hui arrêtée.\r\n          o Les Fork (projets séparés et divergents) de FreeBSD\r\n                + DragonFly BSD, dérivé de FreeBSD 4. Projet séparé lancé en 2003 (logiciel libre)\r\n    * SunOS/Solaris\r\n          o OpenSolaris\r\n\r\nDarwin, le noyau de Mac OS X, comporte lui une API de type BSD au-dessus d''un micro-noyau Mach.\r\n\r\nDans le monde Unix, on oppose souvent les paradigmes BSD aux paradigmes Système V (POSIX), plus suivis, notamment par Linux.\r\n\r\nComme Linux avec Tux, la famille BSD possède une mascotte : le Démon BSD.', 'http://www.freebsd.org/fr/', 'freebsd_24x24.png'),
(4, 'Windows', 'Windows  (littéralement « Fenêtres » en anglais) est une gamme de systèmes d’exploitation produite par Microsoft, principalement destinés aux ordinateurs  compatibles PC. C’est le successeur de MS-DOS. Depuis les années 1990, et notamment la sortie de Windows 95, son succès commercial pour équiper les ordinateurs personnels est tel qu’il possède un statut de quasi-monopole.\r\n\r\nLa gamme Windows est composée de plusieurs branches (voir la section Branches techniques de Windows) :\r\n\r\n    * La première branche, dite branche 16 bits, couvre Windows 1 à 3.11 (3.2 en chinois). Elle est apparue en 1985 et fonctionnait uniquement sur compatibles PC, en mode 16 bits.\r\n    * La deuxième branche, dite branche Windows NT (Windows NT 3.1, NT 4.0, puis Windows 2000), est apparue en 1993. C’est un développement repartant de zéro, destiné aux ordinateurs personnels, aux serveurs et à des ordinateurs non compatibles PC. Elle a d’abord été utilisée dans les entreprises. Avec Windows XP, sorti en 2001, qui continue la branche Windows NT cette branche est désormais aussi grand public, et se poursuit avec Windows Vista et Windows 7.\r\n    * La troisième branche, parfois appelée branche Windows 9x, est apparue en 1995 et a existé parallèlement avec la branche NT. Cette branche a débuté avec Windows 95, suivi de Windows 98 et Windows Me. Elle était plus connue du grand public et avait pour vocation de remplacer la première branche. C’est la première branche grand public 32 bits.\r\n    * La quatrième branche, dite branche Windows CE, apparue en 1996 avec Windows CE 1.0. Elle est destinée aux systèmes embarqués et matériels légers et portables (assistant personnel, téléphone portable). C’est la base de Windows Mobile et Pocket PC.', 'http://www.microsoft.com', 'win_24x24.png'),
(5, 'Audio', 'Toute musique, document sonore, ...', '', 'musique_24x24.png'),
(6, 'Documents - Revues', 'Revues techniques, tutoriels, ...', '', 'ebooks2_24x24.png'),
(7, 'Livres', 'Romans, nouvelles, technique, ...', '', 'romans-nouvelles_24x24.png'),
(9, 'Films - Videos', 'Films et vidéos', '', 'movies_24x24.png'),
(10, 'Images - Photos', 'Images et photos ...', '', 'images_24x24.png'),
(11, 'Applis', 'Applications et scripts ...', '', 'web_24x24.png');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cid_torrent` int(10) NOT NULL,
  `cadded` datetime NOT NULL,
  `ctext` text NOT NULL,
  `cuser` varchar(25) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`cid`, `cid_torrent`, `cadded`, `ctext`, `cuser`) VALUES
(2, 74, '2013-07-17 16:22:37', 'Sympa ! Vraiment trÃ¨s utile et hyper pratique !', 'mumbly'),
(3, 80, '2013-07-19 18:07:31', 'Petit soft indispensable !!!', 'olivier'),
(4, 75, '2013-07-19 18:09:27', 'Assez dÃ©Ã§u par Scribus. Il me semble assez complexe et brouillon je trouve. N''atteint pas les sommets des softs proprios d''Adobe, par exemple... Dommage ... mais le projet reste trÃ¨s prometteur.', 'olivier'),
(5, 91, '2013-07-30 09:41:57', '<p>Epat&eacute; par cette "petite" distrib. Je la trouve bien miuex que Manjaro qui m''a plant&eacute; 2 x dans les mains. A suivre de pr&egrave;s !</p>', 'mumbly'),
(6, 91, '2013-07-30 09:43:26', '<p>Effectivement <span style="text-decoration: underline;"><strong>excellent</strong></span> !</p>', 'shadrak');

-- --------------------------------------------------------

--
-- Structure de la table `compteur`
--

CREATE TABLE IF NOT EXISTS `compteur` (
  `ip` varchar(15) CHARACTER SET latin1 NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compteur`
--

INSERT INTO `compteur` (`ip`, `timestamp`) VALUES
('82.244.12.40', 1375112428),
('192.168.0.254', 1373994987),
('66.249.72.111', 1321818145),
('184.72.174.233', 1319641946),
('221.194.134.181', 1320394154),
('221.194.134.185', 1319654792),
('221.194.134.183', 1319654888),
('50.17.131.34', 1319669812),
('173.230.147.144', 1319707056),
('184.72.7.123', 1319779912),
('89.151.116.53', 1321593527),
('50.17.22.169', 1319779913),
('209.114.34.158', 1319779997),
('174.142.114.100', 1319780040),
('173.254.216.69', 1319781047),
('72.44.46.124', 1319784656),
('184.107.58.71', 1319786297),
('80.11.161.235', 1319787045),
('184.73.0.22', 1319787035),
('157.55.39.91', 1319795024),
('46.137.131.104', 1319854767),
('67.195.111.236', 1319865903),
('193.252.149.15', 1323226700),
('221.194.134.182', 1320394359),
('66.249.71.149', 1320409121),
('74.125.78.87', 1320972926),
('90.4.25.47', 1320973020),
('88.167.136.152', 1321189657),
('66.249.68.240', 1321214632),
('66.249.71.152', 1321415616),
('209.85.238.203', 1373881264),
('91.121.8.202', 1373787907),
('91.121.8.202', 1373787907),
('66.249.78.164', 1373820238),
('66.249.81.164', 1373797078),
('157.56.92.147', 1373798686),
('66.249.72.222', 1373813897),
('65.19.138.34', 1373983326),
('157.55.32.153', 1373811159),
('5.135.166.58', 1374939767),
('81.19.188.229', 1373813804),
('46.236.24.48', 1373817847),
('199.59.148.209', 1375104135),
('74.112.131.244', 1375088216),
('98.137.207.110', 1373817848),
('74.112.131.245', 1375104134),
('65.52.244.238', 1375104142),
('54.248.15.10', 1374516384),
('184.73.14.223', 1374759065),
('188.165.199.157', 1375104161),
('184.72.71.29', 1375104486),
('54.226.24.77', 1373818115),
('208.184.81.30', 1375104400),
('88.162.52.68', 1373818381),
('173.255.237.12', 1374849144),
('157.55.36.36', 1373864210),
('74.112.131.241', 1375104139),
('198.100.152.13', 1373823531),
('100.43.81.8', 1375112433),
('100.43.81.7', 1375122492),
('157.56.93.153', 1373838502),
('69.171.224.114', 1374707339),
('198.2.192.53', 1373863290),
('184.73.184.70', 1373866479),
('72.14.199.180', 1374042185),
('65.19.138.33', 1373927592),
('177.221.140.2', 1373891574),
('66.249.78.80', 1374041902),
('66.249.72.100', 1373916360),
('74.112.131.246', 1375104135),
('74.112.131.243', 1375087165),
('98.137.207.104', 1375104136),
('184.72.175.172', 1374308530),
('176.34.78.244', 1374475552),
('79.125.93.190', 1373900562),
('69.164.221.186', 1375088601),
('54.226.83.109', 1373907116),
('198.50.152.84', 1373915626),
('109.190.18.252', 1374603585),
('50.18.75.204', 1373913010),
('142.4.213.49', 1373931335),
('178.255.215.67', 1373939243),
('204.236.153.140', 1373944023),
('82.246.161.47', 1374139684),
('107.23.45.127', 1373956887),
('217.128.220.235', 1373956894),
('92.129.0.150', 1373958262),
('37.161.94.27', 1373958919),
('89.30.124.147', 1373959092),
('62.39.9.251', 1373958990),
('81.57.0.238', 1373959844),
('217.167.26.97', 1373959976),
('193.248.154.195', 1373960304),
('82.225.227.245', 1373960684),
('37.161.188.229', 1373960644),
('176.180.137.169', 1373960721),
('82.220.1.206', 1373960772),
('212.166.57.66', 1373960803),
('90.22.104.219', 1373961001),
('150.70.97.115', 1373960963),
('217.109.5.119', 1373961041),
('217.136.6.86', 1373961191),
('82.245.141.197', 1373961254),
('203.69.196.37', 1373961260),
('109.190.46.145', 1373962745),
('78.236.59.152', 1373963034),
('66.249.81.80', 1373995845),
('213.173.167.170', 1373963231),
('80.14.110.36', 1373964239),
('78.230.214.75', 1373964509),
('150.70.75.212', 1373964803),
('82.66.239.188', 1373966185),
('82.225.158.36', 1373966897),
('85.31.218.189', 1373967446),
('78.115.182.36', 1373968789),
('80.236.214.208', 1373968718),
('213.213.228.188', 1373968993),
('37.160.60.22', 1373970655),
('90.40.80.247', 1373970413),
('90.47.86.34', 1373970669),
('85.69.186.156', 1373971006),
('92.141.128.177', 1373971283),
('193.202.66.244', 1374143833),
('83.196.217.242', 1373971432),
('50.18.134.9', 1373971831),
('78.120.149.33', 1373972413),
('199.59.148.211', 1375089937),
('184.169.226.107', 1373973445),
('23.20.161.232', 1373973566),
('69.171.234.116', 1373973972),
('37.59.18.46', 1373974816),
('194.250.98.243', 1373974907),
('195.101.137.28', 1373974978),
('82.241.120.249', 1373976202),
('2.3.56.89', 1373977054),
('193.48.145.121', 1373978182),
('193.57.110.171', 1373978415),
('217.108.237.81', 1373978834),
('167.1.176.4', 1373979583),
('80.12.100.3', 1373981667),
('78.112.159.111', 1373982200),
('83.206.101.50', 1373982325),
('88.171.119.231', 1373982543),
('82.225.96.210', 1373990085),
('80.216.91.226', 1374173204),
('79.89.146.193', 1373992285),
('37.160.42.210', 1373992911),
('82.230.232.35', 1374079848),
('109.190.33.15', 1373998344),
('93.23.89.60', 1373995548),
('82.228.211.200', 1373998539),
('82.244.12.8', 1375170671),
('88.172.216.80', 1374066323),
('197.225.29.124', 1374070514),
('65.55.213.67', 1374883117),
('90.44.223.86', 1374084966),
('96.43.235.35', 1374089347),
('194.254.59.226', 1374089718),
('72.14.199.14', 1374850524),
('66.249.78.107', 1374112832),
('66.249.72.134', 1374334875),
('5.10.83.82', 1374113431),
('86.73.110.166', 1374141262),
('109.142.203.130', 1374146138),
('109.190.50.164', 1375029417),
('69.30.238.18', 1374183993),
('46.193.128.125', 1374184532),
('46.255.116.84', 1374233317),
('108.59.8.70', 1374236586),
('178.154.164.250', 1375062520),
('46.236.24.50', 1374254105),
('65.52.16.83', 1374254117),
('50.17.38.26', 1374745397),
('78.234.216.142', 1374265103),
('54.224.249.16', 1374269538),
('144.76.95.231', 1374750563),
('208.107.30.29', 1374282149),
('65.52.241.183', 1374297572),
('46.236.24.54', 1374759055),
('46.236.7.250', 1374297613),
('92.130.171.39', 1374300466),
('31.13.97.117', 1374300466),
('78.214.232.110', 1374304335),
('69.164.211.100', 1374309153),
('79.88.63.64', 1374315249),
('144.76.95.39', 1374872000),
('54.224.135.172', 1374660152),
('100.43.81.12', 1375116547),
('46.165.197.142', 1374356672),
('82.243.222.228', 1374359775),
('54.226.213.66', 1375113475),
('62.147.128.71', 1374397179),
('66.249.73.58', 1374694165),
('78.225.213.213', 1374439944),
('46.236.23.248', 1374848135),
('78.198.224.56', 1374475298),
('50.17.105.104', 1375102364),
('184.72.46.160', 1374475453),
('173.192.79.101', 1374475454),
('198.199.14.58', 1374475460),
('46.137.37.234', 1374475554),
('50.116.49.209', 1374475602),
('80.215.9.112', 1374475615),
('80.215.1.15', 1374475659),
('62.244.105.83', 1374475723),
('50.16.123.221', 1374476091),
('80.215.9.41', 1374476149),
('88.163.84.160', 1374476165),
('54.215.52.197', 1374476316),
('94.23.220.79', 1374478978),
('69.164.211.110', 1374480253),
('193.49.124.107', 1374481187),
('100.43.81.11', 1374483134),
('93.189.158.66', 1374486134),
('65.52.244.220', 1374759069),
('97.107.142.195', 1374517134),
('199.195.140.229', 1374521226),
('90.58.212.233', 1374536360),
('15.185.110.49', 1374629832),
('66.249.81.107', 1375132250),
('66.249.85.58', 1374848436),
('78.251.122.237', 1374562244),
('109.74.87.2', 1374739813),
('54.226.14.213', 1374572458),
('86.221.58.250', 1374601734),
('176.34.154.236', 1374589711),
('46.236.24.51', 1375088203),
('82.242.100.107', 1374590523),
('97.107.140.44', 1374590192),
('90.33.197.160', 1374590741),
('69.164.217.210', 1374760174),
('88.177.96.125', 1374598014),
('88.183.13.166', 1374599901),
('54.226.31.171', 1374604005),
('86.73.175.163', 1374604891),
('66.249.83.134', 1375100154),
('89.227.126.56', 1374613605),
('80.57.78.214', 1374624194),
('88.112.57.160', 1374639288),
('199.59.148.210', 1375088204),
('74.112.131.242', 1374848141),
('50.18.101.227', 1374649566),
('37.59.16.202', 1375109234),
('23.20.106.243', 1374650267),
('173.255.228.74', 1374654223),
('97.107.142.176', 1374657451),
('54.227.62.165', 1374660157),
('77.84.79.87', 1374662352),
('77.84.12.101', 1374678603),
('81.220.59.158', 1374691044),
('15.185.100.174', 1374948057),
('46.165.197.141', 1374718059),
('54.235.8.78', 1374730869),
('23.20.109.146', 1374730870),
('50.18.238.120', 1374737268),
('54.227.3.67', 1374737277),
('54.225.22.37', 1374737882),
('37.160.3.53', 1374738275),
('46.236.24.49', 1374743697),
('54.241.64.29', 1374743699),
('37.59.16.161', 1374743775),
('97.107.138.192', 1374744670),
('23.22.120.96', 1374746500),
('69.171.224.118', 1374749494),
('50.18.150.207', 1374759057),
('92.153.240.6', 1374759185),
('37.59.18.35', 1374759249),
('23.22.56.93', 1374848989),
('37.160.35.67', 1374763433),
('78.237.104.116', 1374938319),
('204.236.155.168', 1374771708),
('77.207.73.244', 1374775095),
('100.43.81.9', 1374780630),
('86.6.184.214', 1374786381),
('69.171.224.119', 1375088639),
('54.227.26.191', 1375088337),
('217.73.208.71', 1374843434),
('184.72.1.89', 1374848137),
('54.225.58.239', 1375104144),
('37.59.16.158', 1374848474),
('75.101.190.190', 1374848990),
('62.147.201.204', 1374870755),
('54.234.55.165', 1374899796),
('41.137.57.128', 1374903956),
('66.249.75.134', 1375164761),
('168.63.78.43', 1375167303),
('79.92.156.166', 1374939962),
('85.168.75.141', 1374940399),
('83.134.119.246', 1374940511),
('82.244.211.21', 1374942940),
('90.0.209.25', 1374943763),
('96.127.210.62', 1374945019),
('82.241.130.121', 1374945110),
('54.226.138.23', 1374945890),
('109.24.196.95', 1374958645),
('89.91.171.44', 1374964615),
('5.10.83.24', 1374970454),
('92.147.73.121', 1374995240),
('5.10.83.55', 1375003160),
('92.151.205.121', 1374999713),
('78.232.186.80', 1375002299),
('78.237.198.85', 1375005378),
('85.169.84.198', 1375010781),
('5.10.83.68', 1375012459),
('77.84.27.102', 1375013431),
('31.38.240.167', 1375016083),
('5.10.83.83', 1375030201),
('5.10.83.9', 1375043367),
('5.10.83.2', 1375059805),
('5.10.83.84', 1375075400),
('92.103.142.82', 1375081470),
('5.10.83.29', 1375088082),
('91.121.138.176', 1375084937),
('147.171.64.129', 1375085761),
('54.241.193.24', 1375087163),
('46.236.24.47', 1375104134),
('37.59.18.45', 1375104545),
('184.72.25.205', 1375088206),
('37.59.18.34', 1375088225),
('78.236.228.221', 1375088235),
('178.32.99.62', 1375088272),
('54.224.77.12', 1375088338),
('23.29.122.198', 1375089937),
('184.169.252.0', 1375089939),
('50.17.90.137', 1375090076),
('88.136.253.197', 1375092721),
('72.14.199.134', 1375162544),
('5.10.83.25', 1375094857),
('174.129.140.14', 1375100511),
('184.72.211.188', 1375100513),
('78.222.192.58', 1375101746),
('184.169.254.96', 1375104137),
('50.17.63.24', 1375104345),
('54.234.147.19', 1375104346),
('69.171.224.116', 1375104410),
('66.249.82.134', 1375104508),
('173.255.232.252', 1375104843),
('5.10.83.75', 1375105668),
('66.249.84.216', 1375105793),
('109.190.26.111', 1375106854),
('144.76.95.232', 1375111020),
('92.145.169.84', 1375111392),
('91.121.18.31', 1375113166),
('109.11.228.189', 1375132122);

-- --------------------------------------------------------

--
-- Structure de la table `connectes`
--

CREATE TABLE IF NOT EXISTS `connectes` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `connectes`
--

INSERT INTO `connectes` (`ip`, `timestamp`) VALUES
('82.244.12.8', 1375170671);

-- --------------------------------------------------------

--
-- Structure de la table `cpt_connectes`
--

CREATE TABLE IF NOT EXISTS `cpt_connectes` (
  `pseudo` varchar(255) NOT NULL,
  `timestamp` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cpt_connectes`
--

INSERT INTO `cpt_connectes` (`pseudo`, `timestamp`) VALUES
('shadrak', '1375170671');

-- --------------------------------------------------------

--
-- Structure de la table `forum_reponses`
--

CREATE TABLE IF NOT EXISTS `forum_reponses` (
  `id_forum_reponse` int(6) NOT NULL AUTO_INCREMENT,
  `auteur_forum_reponse` varchar(30) NOT NULL,
  `message_forum_reponse` text NOT NULL,
  `date_reponse` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `correspondance_sujet` int(6) NOT NULL,
  PRIMARY KEY (`id_forum_reponse`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `forum_reponses`
--

INSERT INTO `forum_reponses` (`id_forum_reponse`, `auteur_forum_reponse`, `message_forum_reponse`, `date_reponse`, `correspondance_sujet`) VALUES
(13, 'mumbly', 'Bienvenue Ã  toutes et Ã  tous sur ce site de test !', '2013-07-14 09:32:39', 6),
(17, 'shadrak', 'Bonjour Ã  toutes et Ã  tous ! :D', '2013-07-15 17:42:27', 6),
(18, 'olivier', 'Je me prÃ©sente : olivier 37 ans, animateur socioculturel en centre social.\r\nBeau site : trÃ¨s intÃ©ressant ! :)', '2013-07-19 13:39:53', 7),
(19, 'olivier', 'La page upload est HS ?', '2013-07-19 18:10:01', 8),
(20, 'olivier', 'Ha non ! DÃ©solÃ© C bon !', '2013-07-19 18:12:14', 8);

-- --------------------------------------------------------

--
-- Structure de la table `forum_sujets`
--

CREATE TABLE IF NOT EXISTS `forum_sujets` (
  `id_forum` int(6) NOT NULL AUTO_INCREMENT,
  `auteur_forum` varchar(30) NOT NULL,
  `titre_forum` text NOT NULL,
  `date_derniere_reponse` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_forum`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `forum_sujets`
--

INSERT INTO `forum_sujets` (`id_forum`, `auteur_forum`, `titre_forum`, `date_derniere_reponse`) VALUES
(6, 'mumbly', 'Bienvenue !', '2013-07-15 17:42:27'),
(7, 'olivier', 'Salut c''est Olivier !', '2013-07-19 13:39:53'),
(8, 'olivier', 'Page upload ?', '2013-07-19 18:12:14');

-- --------------------------------------------------------

--
-- Structure de la table `licences`
--

CREATE TABLE IF NOT EXISTS `licences` (
  `lid` int(11) NOT NULL,
  `lnom` varchar(255) NOT NULL,
  `lurl` varchar(255) NOT NULL,
  `ldescription` mediumtext NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `licences`
--

INSERT INTO `licences` (`lid`, `lnom`, `lurl`, `ldescription`) VALUES
(1, 'GPL V2', 'http://www.gnu.org/licenses/gpl-2.0.html', ''),
(2, 'GPL V3', 'http://www.gnu.org/licenses/gpl-3.0.html', ''),
(3, 'LGPL V2', 'http://www.gnu.org/licenses/old-licenses/lgpl-2.0.html', ''),
(4, 'LGPL V3', 'http://www.gnu.org/licenses/lgpl.html', ''),
(5, 'Gnu FDL', 'http://www.gnu.org/licenses/fdl.html', ''),
(6, 'BSD license', 'http://fr.wikipedia.org/wiki/Licence_BSD', ''),
(7, 'MIT', 'http://opensource.org/licenses/MIT', ''),
(8, 'Art Libre (LAL)', 'http://artlibre.org/licence/lal', ''),
(9, 'C.C. By', 'http://creativecommons.fr/licences/les-6-licences/', ''),
(10, 'C.C. By-Nd', 'http://creativecommons.fr/licences/les-6-licences/', ''),
(11, 'C.C. By-Sa', 'http://creativecommons.fr/licences/les-6-licences/', ''),
(12, 'C.C. By-Nc', 'http://creativecommons.fr/licences/les-6-licences/', ''),
(13, 'C.C. By-Nc-Sa', 'http://creativecommons.fr/licences/les-6-licences/', ''),
(14, 'C.C. By-Nc-Nd', 'http://creativecommons.fr/licences/les-6-licences/', ''),
(15, 'Apache', 'http://www.apache.org/licenses/', ''),
(16, 'CeCILL', 'http://www.cecill.info/licences.en.html', ''),
(17, 'Pyhton', 'http://docs.python.org/2/license.html', ''),
(18, 'Autres', '', ''),
(19, 'AGPL', 'http://www.gnu.org/licenses/agpl.html', ''),
(20, ' Apache License V2.0', 'http://www.apache.org/licenses/LICENSE-2.0', ''),
(21, 'Original BSD license', 'http://www.xfree86.org/3.3.6/COPYRIGHT2.html#6', ''),
(22, 'FreeBSD license', 'http://www.freebsd.org/copyright/freebsd-license.html', ''),
(23, 'Gnu Verbatim', 'http://www.gnu.org/licenses/licenses.html#VerbatimCopying', ''),
(24, 'Domaine Public', 'http://www.gnu.org/licenses/license-list.fr.html', ''),
(25, 'C.C. 0', 'http://creativecommons.org/choose/zero/?lang=fr', '');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(11) NOT NULL DEFAULT '0',
  `id_destinataire` int(11) NOT NULL DEFAULT '0',
  `date_message` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `titre_message` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` int(6) NOT NULL AUTO_INCREMENT,
  `auteur_news` varchar(30) NOT NULL,
  `titre_news` text NOT NULL,
  `date_news` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `texte_news` text NOT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id_news`, `auteur_news`, `titre_news`, `date_news`, `texte_news`) VALUES
(8, 'mumbly', 'Site en dÃ©veloppement (2)', '2013-07-14 11:12:08', 'Je m''y remets depuis hier :) Dur de se replonger dans le code php : il est pas beau, pas propre. Les vacances approchent... On verra bien !'),
(7, 'mumbly', 'Site en dÃ©veloppement...', '2013-07-14 11:10:34', 'Ce site est en dÃ©veloppement depuis un long moment. J''essaie avec mes maigres compÃ©tences d''avancer pas-Ã -pas mais beaocup d''embuches parcourent mon chemin de "vieux" padawan du Web...\r\nLe site en lui mÃªme fonctionne sur 3 jambes : pas mal de bugs, d''erreurs de programmation, etc.\r\nLa rÃ©-Ã©criture "propre" en PDO pourrait Ãªtre un plus...\r\nJe manque de compÃ©tences. Si jamais vous passez par ici, au hazard de votre surf sur le Net, faites moi un coucou et, d''aventure, donnez moi un p''tit coup de main si le coeur vous en dit ... :D'),
(9, 'mumbly', 'How to Create a Torrent Tracker With PHP & XBTT', '2013-07-16 06:54:16', 'Paru Ã  l''origine sur valadilene.org (qui n''existe plus !), il s''agit de l''article qui m''a le plus aidÃ© Ã  m''y retrouver dans la "jungle" de php, Xbt, et le protocole bittorrent : \r\n\r\nPartie 1 : http://filesharefreak.com/2009/06/24/how-to-create-a-torrent-tracker-with-php-xbtt-part-1\r\nPartie 2 : http://filesharefreak.com/2009/07/15/how-to-create-a-torrent-tracker-part-2-upload-form/\r\nPartie 3 : http://filesharefreak.com/2009/08/17/how-to-create-a-tracker-part-3-torrent-user-details/\r\nPartie 4 : http://filesharefreak.com/2009/09/07/how-to-create-a-torrent-tracker-part-4-search-engine/\r\n\r\nHappy coding ! :)'),
(10, 'mumbly', 'Script d''upload buggÃ©', '2013-07-19 16:53:01', 'La page upload.php est actuellement buggÃ©e. J''y travaille ... :D'),
(11, 'mumbly', 'Page upload opÃ©rationnelle !', '2013-07-19 18:06:26', 'Le script d''upload semble "rÃ©parÃ©". AprÃ¨s plusieurs tests tout semble fonctionner...'),
(12, 'mumbly', 'Nouveau : tÃ©lÃ©chargement libre !', '2013-07-24 11:00:15', 'NOUVEAU : tout le monde peut tÃ©lÃ©charger des torrents sur Piratix. Seules les personnes dÃ©sirant uploader des torrents, Ã©crire sur le forum, disposer de stats + ratio, etc. doivent crÃ©er un compte.\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `key` varchar(45) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('sitename', 'tracker2.freetorrent.fr.nf'),
('siteurl', 'http://tracker2.freetorrent.fr.nf'),
('siteannounce', 'http://tracker2.freetorrent.fr.nf:64738/announce'),
('siteemail', 'olivierprieur@gmail.com'),
('torrentsdir', 'torrents'),
('sitelanguage', 'fr'),
('sitecharset', 'UTF-8'),
('max_torrents_per_page', '15'),
('forum', 'forum'),
('newslimit', '2'),
('forumlimit', '5'),
('lasttorrents', '10'),
('uploaddir', 'torrentimg/'),
('torrent_file_limit', '50'),
('img_file_limit', '100'),
('img_size_width', '200'),
('img_size_height', '200'),
('logo_site', 'images/logoFT.png'),
('siteversion', '0.0.9-b'),
('siteversiondate', '26/10/2011'),
('sitedefaultstyle', 'css/style.css'),
('commentslimit', '5'),
('mostseedtorrlimit', '8');

-- --------------------------------------------------------

--
-- Structure de la table `torrents`
--

CREATE TABLE IF NOT EXISTS `torrents` (
  `id_torr` int(11) NOT NULL AUTO_INCREMENT,
  `date_torr` datetime NOT NULL,
  `nom_torr` varchar(255) NOT NULL,
  `fichier_torr` varchar(255) NOT NULL,
  `description_torr` mediumtext NOT NULL,
  `pseudo_torr` varchar(255) NOT NULL,
  `url_torr` varchar(255) NOT NULL,
  `cat_torr` varchar(255) NOT NULL,
  `licence_torr` varchar(255) NOT NULL,
  `image_torr` varchar(100) NOT NULL,
  `taille_torr` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_torr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- Contenu de la table `torrents`
--

INSERT INTO `torrents` (`id_torr`, `date_torr`, `nom_torr`, `fichier_torr`, `description_torr`, `pseudo_torr`, `url_torr`, `cat_torr`, `licence_torr`, `image_torr`, `taille_torr`) VALUES
(71, '2013-07-17 15:41:23', 'npp.6.1.4.Installer.exe', 'npp.6.1.4.Installer.exe.torrent', 'Notepad++ est un Ã©diteur de code source qui prend en charge plusieurs langages.\r\nCe programme, codÃ© en C++ avec STL et win32 api, a pour vocation de fournir un Ã©diteur de code source de taille rÃ©duite mais trÃ¨s performant.\r\n\r\nEn optimisant de nombreuses fonctions tout en conservant une facilitÃ© d''utilisation et une certaine convivialitÃ©, Notepad++ contribue Ã  la limitation des Ã©missions de dioxyde de carbone dans le monde : en effet, en rÃ©duisant l''utilisation de CPU, la consommation d''Ã©nergie des ordinateurs chute considÃ©rablement, en consÃ©quence de quoi, la terre est plus verte.', 'mumbly', 'http://notepad-plus-plus.org/', 'Windows', 'GPL V2', 'notepad++.png', 5808917),
(72, '2013-07-17 15:45:53', 'voyager-13.04-desktop-64.iso', 'voyager-13.04-desktop-64.iso.torrent', 'Live Voyager 13.04 est complÃ¨tement inspirÃ© de Xubuntu 13.04 et de son bureau XFCE, un dÃ©rivÃ© d''Ubuntu Raring Ringtail 13.04.\r\nCette personnalisation complÃ¨te de 930 Mo est une distribution GNU/Linux libre et gratuite.\r\nVous pouvez graver Voyager sur DVD ou lâ€™installer sur une clÃ© USB.\r\n\r\nVoyager se veut multi-plateforme, Ã©purÃ©, rapide et souple avec une touche dâ€™esthÃ©tique afin que le temps passÃ© sur son systÃ¨me soit plus agrÃ©ableâ€¦\r\n\r\nPour la partie logiciels, on retrouvera Plank, Minitubes, Pitivi, FreetuxTv, Vlc, Parole, Darktable, Gimp, ClÃ©mentine, Covergloobus, RadioTray, a Ã©tÃ© intÃ©grÃ© une partie Terminal avec Ranger, Vim, Moc, Mplayerâ€¦ Thunderbird, Firefox, Luakit, Pidgin, Abiwordâ€¦ etc.', 'mumbly', 'http://voyager.legtux.org/', 'Gnu/Linux', 'Autres', 'live-voyager.jpg', 976138240),
(73, '2013-07-17 16:00:51', 'debian-7.1.0-amd64-netinst.iso', 'debian-7.1.0-amd64-netinst.iso.torrent', 'Le projet Debian est une association d''individus qui ont pour cause commune de crÃ©er un systÃ¨me d''exploitation libre. Ce systÃ¨me d''exploitation que nous avons crÃ©Ã© est appelÃ© Debian.\r\n\r\nUn systÃ¨me d''exploitation est l''ensemble des programmes et utilitaires de base qui permettent de faire fonctionner votre ordinateur. Au cÅ“ur d''un systÃ¨me d''exploitation se trouve le noyau. Le noyau est le programme le plus fondamental sur l''ordinateur, il fait toute la gestion de base des ressources et vous permet de lancer d''autres programmes.\r\n\r\nLes systÃ¨mes Debian utilisent actuellement le noyau Linux ou le noyau FreeBSD. Linux est un logiciel initiÃ© par Linus Torvalds et dÃ©veloppÃ© par des milliers de programmeurs de par le monde. FreeBSD est un systÃ¨me d''exploitation comprenant un noyau et d''autres logiciels.\r\n\r\nCependant, un travail est en cours pour donner d''autres noyaux Ã  Debian, principalement Hurd. Hurd est une collection de serveurs qui fonctionnent au-dessus d''un micronoyau (tel que Mach) pour implÃ©menter diffÃ©rentes fonctionnalitÃ©s. Hurd est un logiciel libre produit par le projet GNU.\r\n\r\nUne grande partie des utilitaires de base qui constituent le systÃ¨me d''exploitation vient du projet GNU ; d''oÃ¹ les noms : GNU/Linux, GNU/kFreeBSD et GNU/Hurd. Ces utilitaires sont libres eux aussi.\r\n\r\nBien sÃ»r, ce que veulent les gens ce sont des logiciels applicatifs : des logiciels pour les aider Ã  faire ce qu''ils souhaitent faire, depuis l''Ã©dition de documents jusqu''Ã  la gestion d''une entreprise en passant par les jeux et la rÃ©alisation d''autres logiciels. Debian est fourni avec plus de 37500 paquets (des logiciels prÃ©compilÃ©s mis dans un format sympathique pour une installation facile sur votre machine) â€” tout cela libre.\r\n\r\nC''est un peu comme une tour. Ã€ la base, le noyau, au-dessus les utilitaires fondamentaux, puis tous les logiciels que vous lancez sur l''ordinateur et au sommet de la tour, Debian â€” qui organise soigneusement l''ensemble afin que tout puisse fonctionner correctement. ', 'mumbly', 'http://www.debian.org', 'Gnu/Linux', 'GPL V2', 'debian-logo.png', 232783872),
(74, '2013-07-17 16:08:54', 'TortoiseSVN-1.8.0.24401-x64-svn-1.8.0.msi', 'TortoiseSVN-1.8.0.24401-x64-svn-1.8.0.msi.torrent', 'TortoiseSVN est un des logiciels client de SVN les plus populaires.\r\n\r\nC''est un logiciel libre distribuÃ© selon les termes de la licence GNU GPL, sous forme de PlugIn pour Microsoft Windows.\r\n\r\nEn s''intÃ©grant dans l''explorateur de Windows, il offre aux utilisateurs de Windows une interface graphique permettant de rÃ©aliser la plupart des tÃ¢ches qu''offre SVN en ligne de commande.\r\n\r\nL''explorateur Windows s''enrichit des fonctionnalitÃ©s suivantes :\r\n- Superposition d''icÃ´ne aux rÃ©pertoires et fichiers permettant de visualiser instantanÃ©ment l''Ã©tat (Ã  jour, modifiÃ©, en conflit...)\r\n- Menu contextuel permettant de committer ou d''updater, Ã  l''Ã©chelle d''un fichier, d''une sÃ©lection de fichiers ou encore d''un rÃ©pertoire\r\n- PossibilitÃ© d''ajouter en mode dÃ©tails de l''explorateur des colonnes de type numÃ©ro de rÃ©vision, Ã©tat\r\n\r\nIl est disponible en version 32 et 64 bits.\r\n40 packs langues sont actuellement en ligne.\r\nSon nom vient de l''anglais Tortoise, ''Tortue'', logo du logiciel.', 'shadrak', 'http://tortoisesvn.net/', 'Windows', 'GPL V2', 'tortoisesvn.png', 19312640),
(75, '2013-07-17 16:12:50', 'scribus_scribus_1.4.2_francais_18752.exe', 'scribus_scribus_1.4.2_francais_18752.exe.torrent', 'Scribus est un logiciel libre de PAO, distribuÃ© sous licence GNU GPL. Il est basÃ© sur le framework Qt, par consÃ©quent, il fonctionne nativement sur les systÃ¨mes UNIX, Linux, Mac OS X, Windows et OS/2.\r\n\r\nIl est connu pour son large Ã©ventail de fonctionnalitÃ©s de mise en page, comparable aux principales applications dans le domaine de la PAO, telles que Adobe PageMaker, PagePlus, QuarkXPress ou Adobe InDesign.\r\n\r\nScribus est conÃ§u pour une mise en page flexible et a la capacitÃ© de prÃ©parer des fichiers pour des Ã©quipements professionnels. Il peut Ã©galement crÃ©er des prÃ©sentations animÃ©es et interactives, et des formulaires PDF. Il peut servir Ã  rÃ©aliser des dÃ©pliants, des plaquettes, des livres et des magazines, et tout type de document destinÃ© Ã  Ãªtre imprimÃ© ou Ã  Ãªtre visualisÃ© sous forme numÃ©rique.\r\n\r\nLe magazine gÃ©nÃ©raliste Le Tigre est entiÃ¨rement rÃ©alisÃ© avec des logiciels libres dont Scribus.', 'shadrak', 'http://www.scribus.net', 'Windows', 'GPL V2', 'scribus.png', 70094500),
(76, '2013-07-17 16:39:07', 'lovecraft_dans_l_abime_du_temps.pdf', 'lovecraft_dans_l_abime_du_temps.pdf.torrent', 'Dans l''abÃ®me du temps (titre original : The Shadow Out of Time) est l''un des Grands Textes de l''Ã©crivain amÃ©ricain H. P. Lovecraft.\r\n\r\nRÃ©digÃ© en 1935 et publiÃ© dans l''Astounding Stories de juin 1936, il est Ã©ditÃ© en franÃ§ais dans le recueil de nouvelles du mÃªme nom.\r\n\r\nCette nouvelle, assez longue, fut rÃ©digÃ©e entre novembre 1934 et fÃ©vrier 1935 et fait partie des derniers textes de Lovecraft publiÃ©s de son vivant.\r\n\r\nDe vertigineuses plongÃ©es dans le monde terrifiant de Howard P. Lovecraft...\r\nL''humanitÃ© y est aux prises avec des Ãªtres surnaturels qui ont Ã©tÃ© les maÃ®tres de la Terre bien avant l''apparition de l''homme et qui tentent de recouvrer leur suprÃ©matie. Faisant appel eux images, aux mythes, aux rÃ©cits de toutes les traditions perdues, Lovecraft compose des philtres puissants qui laissent dans les esprits une empreinte indÃ©lÃ©bile.', 'mumbly', 'http://www.ebooksgratuits.com/ebooks.php?auteur=Lovecraft_Howard+Phillips', 'Documents - Revues', 'Domaine Public', 'hplovecraft-abime-du-temps.jpg', 240950),
(79, '2013-07-19 17:54:13', 'deluge-1.3.6-win32-setup.exe', 'deluge-1.3.6-win32-setup.exe.torrent', 'Client bittorrent lÃ©ger et libre.', 'mumbly', 'http://deluge-torrent.org/', 'Windows', 'GPL V2', 'deluge1.jpg', 12998543),
(80, '2013-07-19 17:58:07', 'putty.exe', 'putty.exe.torrent', 'PuTTY est un Ã©mulateur de terminal doublÃ© d''un client pour les protocoles SSH, Telnet, rlogin, et TCP brut. Il permet Ã©galement d''Ã©tablir des connexions directes par liaison sÃ©rie RS-232. Ã€ l''origine disponible uniquement pour Windows, il est Ã  prÃ©sent portÃ© sur diverses plates-formes Unix (et non-officiellement sur d''autres plates-formes). PuTTY est Ã©crit et maintenu principalement par Simon Tatham.\r\n\r\nC''est un logiciel libre distribuÃ© selon les termes de la licence MIT.', 'mumbly', 'http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html', 'Windows', 'MIT', 'putty1.png', 483328),
(81, '2013-07-20 10:29:58', 'Infrarecorder 0.5.3', 'ir053.exe.torrent', 'Infrarecorder : Excellent logiciel de gravure CD/DVD libre et gratuit !\r\n\r\nDans la lignÃ©e, dÃ©jÃ  longue, des logiciels de gravure gratuits (CDBurnerXP, Burnatonce, DeepBurner Free ...), Infra Recorder est un projet libre plutÃ´t prometteur et dÃ©jÃ  fonctionnel malgrÃ© son stade encore peu avancÃ©. Que propose-t-il par rapport Ã  ses concurrents ? Au niveau des fonctionnalitÃ©s, pas grand chose, mais c''est justement ce qu''on demande Ã  ce type de logiciel : proposer l''essentiel, sans fioritures.\r\n\r\nOn retrouve donc un logiciel de gravure tout ce qu''il y''a de plus classique avec une vue Ã  deux panneaux, des menus et icÃ´nes claires et des fonctionnalitÃ©s essentielles : crÃ©ation d''un disque de donnÃ©es ou d''un CD audio, crÃ©ation et gravure d''images ISO, copie de disque ou encore effacement d''un disque RW, bref tout ce dont on a besoin et rien de plus. L''interface est agrÃ©able, et les performances semblent au rendez vous, mÃªme si on se demande pourquoi le logiciel crÃ©e systÃ©matiquement une image ISO avant de graver un disque.', 'mumbly', 'http://infrarecorder.org/', 'Windows', 'GPL V2', 'infrarecorder.jpg', 4151536),
(82, '2013-07-21 09:58:27', 'Symheris-Winds_Of_Hope.mp3', 'Symheris-Winds_Of_Hope.mp3.torrent', 'rock metal instrumental\r\n\r\nJe suis tout simplement impressionnÃ©...\r\nUne parfaite maÃ®trise technique, une prod bien ficelÃ©e, des riffs accrocheurs, des mÃ©lodies retantissantes.\r\nA ce niveau, Ã§a devient du professionnalisme.\r\nCe garÃ§on a du talent, parlez en autour de vous!', 'mumbly', 'http://www.auboutdufil.com/index.php?id=295', 'Audio', 'C.C. By-Nd', 'cd_premier_projet.jpg', 4822546),
(83, '2013-07-21 18:54:55', 'archlinux-2013.07.01-dual.iso', 'archlinux-2013.07.01-dual.iso.torrent', 'Arch Linux a Ã©tÃ© conÃ§ue pour Ãªtre le systÃ¨me d''exploitation parfait pour les utilisateurs avancÃ©s.\r\n\r\nSa philosophie sans artifices ni outils de configuration est trÃ¨s proche de Slackware dans le sens oÃ¹ elle requiert un certain niveau de connaissances pour Ãªtre installÃ©e, mais elle reste toutefois simple Ã  maintenir.\r\nLa philosophie de Arch peut Ãªtre rÃ©sumÃ©e en trois points :\r\n\r\n- Rester simple et lÃ©gÃ¨re (selon le principe KISS) ;\r\n\r\n- Ã€ un moment ou Ã  un autre, un utilisateur aura besoin de comprendre comment fonctionne son systÃ¨me pour pouvoir le dÃ©panner. L''utilisation d''un environnement graphique masquant gÃ©nÃ©ralement le fonctionnement du systÃ¨me finit souvent par rendre l''utilisateur incapable de rÃ©soudre des problÃ¨mes qui y sont liÃ©s ;\r\n\r\n- Arch autorise les utilisateurs Ã  contribuer de la maniÃ¨re qu''ils le souhaitent tant que ces contributions ne vont pas Ã  l''encontre des idÃ©aux de conception ou de philosophie.\r\n\r\nArch Linux est une distribution en constante Ã©volution et de nouveaux paquets apparaissent chaque jour (on parle de rolling release). En utilisant le gestionnaire de paquets, les utilisateurs peuvent garder leur systÃ¨me Ã  jour trÃ¨s facilement. Contrairement Ã  certaines distributions qui encouragent leurs utilisateurs Ã  installer les nouvelles versions dÃ¨s qu''elles paraissent, les versions d''Arch Linux sont simplement des clichÃ©s pris Ã  un instant T qui incluent, parfois, un utilitaire d''installation rÃ©visÃ©.', 'mumbly', 'http://www.archlinux.org/', 'Gnu/Linux', 'GPL V2', 'arch-linux-logo.png', 547356672),
(84, '2013-07-22 19:29:20', 'Pioneer.One.S01E01.720p.x264-VODO', 'Pioneer.One.S01E01.720p.x264-VODO.torrent', 'Pioneer One est une web-sÃ©rie amÃ©ricaine crÃ©Ã©e par Josh Bernhard et Bracey Smith. Il s''agit de la premiÃ¨re sÃ©rie produite uniquement avec des dons (Via le site VODO) et prÃ©vue pour Ãªtre diffusÃ©e gratuitement au moyen de BitTorrent.\r\n\r\nDans Pioneer One, nous suivons lâ€™enquÃªte d''un agent de la sÃ©curitÃ© du territoire des Ã‰tats-Unis (Tom Taylor) au sujet de la chute d''un OVNI se trouvant Ãªtre une capsule spatiale soviÃ©tique contenant un jeune homme parlant russe. AprÃ¨s investigation auprÃ¨s d''un spÃ©cialiste (Zachary Walzer), on dÃ©couvre que la seule provenance possible de la capsule est Mars.\r\n\r\n\r\nDistribution\r\n\r\n- James Rich : Tom Taylor\r\n- Alexandra Blatt : Sofie Larson\r\n- Jack Haley : Dr. Zachary Walzer (interprÃ©tÃ© par Matthew Foster dans le premier Ã©pisode)\r\n- Guy Wegener : Vernon\r\n- E. James Ford : Dileo\r\n- Laurence Cantor : Norton\r\n- Kathleen O''Loughlin : Christa\r\n- Einar Gunn : McClellan\r\n\r\nÃ‰pisodes\r\n\r\n1 - Earthfall (Pilot)\r\n2 - The Man From Mars\r\n3 - Alone in the Night\r\n4 - Triangular Diplomacy\r\n5 - Sea Change\r\n6 - War of Worlds\r\n', 'mumbly', 'http://www.pioneerone.tv/', 'Films - Videos', 'C.C. By-Nc-Sa', 'Pioneer_One_first_banner.jpg', 1204449114),
(85, '2013-07-22 19:43:01', 'Pioneer.One.S01E02.720p.x264-VODO', 'Pioneer.One.S01E02.720p.x264-VODO.torrent', 'Pioneer One est une web-sÃ©rie amÃ©ricaine crÃ©Ã©e par Josh Bernhard et Bracey Smith. Il s''agit de la premiÃ¨re sÃ©rie produite uniquement avec des dons (Via le site VODO) et prÃ©vue pour Ãªtre diffusÃ©e gratuitement au moyen de BitTorrent.\r\n\r\nDans Pioneer One, nous suivons lâ€™enquÃªte d''un agent de la sÃ©curitÃ© du territoire des Ã‰tats-Unis (Tom Taylor) au sujet de la chute d''un OVNI se trouvant Ãªtre une capsule spatiale soviÃ©tique contenant un jeune homme parlant russe. AprÃ¨s investigation auprÃ¨s d''un spÃ©cialiste (Zachary Walzer), on dÃ©couvre que la seule provenance possible de la capsule est Mars.\r\n\r\n\r\nDistribution\r\n\r\n- James Rich : Tom Taylor\r\n- Alexandra Blatt : Sofie Larson\r\n- Jack Haley : Dr. Zachary Walzer (interprÃ©tÃ© par Matthew Foster dans le premier Ã©pisode)\r\n- Guy Wegener : Vernon\r\n- E. James Ford : Dileo\r\n- Laurence Cantor : Norton\r\n- Kathleen O''Loughlin : Christa\r\n- Einar Gunn : McClellan\r\n\r\nÃ‰pisodes\r\n\r\n1 - Earthfall (Pilot)\r\n2 - The Man From Mars\r\n3 - Alone in the Night\r\n4 - Triangular Diplomacy\r\n5 - Sea Change\r\n6 - War of Worlds', 'mumbly', 'http://www.pioneerone.tv/', 'Films - Videos', 'C.C. By-Nc-Sa', 'Pioneer_One_first_banner.jpg', 1211345325),
(86, '2013-07-22 20:01:59', 'Pioneer.One.S01E03.720p.x264-VODO', 'Pioneer.One.S01E03.720p.x264-VODO.torrent', 'Pioneer One est une web-sÃ©rie amÃ©ricaine crÃ©Ã©e par Josh Bernhard et Bracey Smith. Il s''agit de la premiÃ¨re sÃ©rie produite uniquement avec des dons (Via le site VODO) et prÃ©vue pour Ãªtre diffusÃ©e gratuitement au moyen de BitTorrent.\r\n\r\nDans Pioneer One, nous suivons lâ€™enquÃªte d''un agent de la sÃ©curitÃ© du territoire des Ã‰tats-Unis (Tom Taylor) au sujet de la chute d''un OVNI se trouvant Ãªtre une capsule spatiale soviÃ©tique contenant un jeune homme parlant russe. AprÃ¨s investigation auprÃ¨s d''un spÃ©cialiste (Zachary Walzer), on dÃ©couvre que la seule provenance possible de la capsule est Mars.\r\n\r\n\r\nDistribution\r\n\r\n- James Rich : Tom Taylor\r\n- Alexandra Blatt : Sofie Larson\r\n- Jack Haley : Dr. Zachary Walzer (interprÃ©tÃ© par Matthew Foster dans le premier Ã©pisode)\r\n- Guy Wegener : Vernon\r\n- E. James Ford : Dileo\r\n- Laurence Cantor : Norton\r\n- Kathleen O''Loughlin : Christa\r\n- Einar Gunn : McClellan\r\n\r\nÃ‰pisodes\r\n\r\n1 - Earthfall (Pilot)\r\n2 - The Man From Mars\r\n3 - Alone in the Night\r\n4 - Triangular Diplomacy\r\n5 - Sea Change\r\n6 - War of Worlds', 'mumbly', 'http://www.pioneerone.tv/', 'Films - Videos', 'C.C. By-Nc-Sa', 'Pioneer_One_first_banner.jpg', 1213439844),
(87, '2013-07-23 15:07:41', 'Pioneer.One.S01E04.720p.x264-VODO', 'Pioneer.One.S01E04.720p.x264-VODO.torrent', 'Pioneer One est une web-sÃ©rie amÃ©ricaine crÃ©Ã©e par Josh Bernhard et Bracey Smith. Il s''agit de la premiÃ¨re sÃ©rie produite uniquement avec des dons (Via le site VODO) et prÃ©vue pour Ãªtre diffusÃ©e gratuitement au moyen de BitTorrent.\r\n\r\nDans Pioneer One, nous suivons lâ€™enquÃªte d''un agent de la sÃ©curitÃ© du territoire des Ã‰tats-Unis (Tom Taylor) au sujet de la chute d''un OVNI se trouvant Ãªtre une capsule spatiale soviÃ©tique contenant un jeune homme parlant russe. AprÃ¨s investigation auprÃ¨s d''un spÃ©cialiste (Zachary Walzer), on dÃ©couvre que la seule provenance possible de la capsule est Mars.\r\n\r\n\r\nDistribution\r\n\r\n- James Rich : Tom Taylor\r\n- Alexandra Blatt : Sofie Larson\r\n- Jack Haley : Dr. Zachary Walzer (interprÃ©tÃ© par Matthew Foster dans le premier Ã©pisode)\r\n- Guy Wegener : Vernon\r\n- E. James Ford : Dileo\r\n- Laurence Cantor : Norton\r\n- Kathleen O''Loughlin : Christa\r\n- Einar Gunn : McClellan\r\n\r\nÃ‰pisodes\r\n\r\n1 - Earthfall (Pilot)\r\n2 - The Man From Mars\r\n3 - Alone in the Night\r\n4 - Triangular Diplomacy\r\n5 - Sea Change\r\n6 - War of Worlds', 'mumbly', 'http://www.pioneerone.tv/', 'Films - Videos', 'C.C. By-Nc-Sa', 'Pioneer_One_first_banner.jpg', 1217208422),
(88, '2013-07-23 16:06:30', 'Pioneer.One.S01E05.720p.x264-VODO', 'Pioneer.One.S01E05.720p.x264-VODO.torrent', 'Pioneer One est une web-sÃ©rie amÃ©ricaine crÃ©Ã©e par Josh Bernhard et Bracey Smith. Il s''agit de la premiÃ¨re sÃ©rie produite uniquement avec des dons (Via le site VODO) et prÃ©vue pour Ãªtre diffusÃ©e gratuitement au moyen de BitTorrent.\r\n\r\nDans Pioneer One, nous suivons lâ€™enquÃªte d''un agent de la sÃ©curitÃ© du territoire des Ã‰tats-Unis (Tom Taylor) au sujet de la chute d''un OVNI se trouvant Ãªtre une capsule spatiale soviÃ©tique contenant un jeune homme parlant russe. AprÃ¨s investigation auprÃ¨s d''un spÃ©cialiste (Zachary Walzer), on dÃ©couvre que la seule provenance possible de la capsule est Mars.\r\n\r\n\r\nDistribution\r\n\r\n- James Rich : Tom Taylor\r\n- Alexandra Blatt : Sofie Larson\r\n- Jack Haley : Dr. Zachary Walzer (interprÃ©tÃ© par Matthew Foster dans le premier Ã©pisode)\r\n- Guy Wegener : Vernon\r\n- E. James Ford : Dileo\r\n- Laurence Cantor : Norton\r\n- Kathleen O''Loughlin : Christa\r\n- Einar Gunn : McClellan\r\n\r\nÃ‰pisodes\r\n\r\n1 - Earthfall (Pilot)\r\n2 - The Man From Mars\r\n3 - Alone in the Night\r\n4 - Triangular Diplomacy\r\n5 - Sea Change\r\n6 - War of Worlds', 'mumbly', 'http://www.pioneerone.tv/', 'Films - Videos', 'C.C. By-Nc-Sa', 'Pioneer_One_first_banner.jpg', 1673928079),
(89, '2013-07-23 16:10:16', 'Pioneer.One.S01E06.720p.x264-VODO', 'Pioneer.One.S01E06.720p.x264-VODO.torrent', 'Pioneer One est une web-sÃ©rie amÃ©ricaine crÃ©Ã©e par Josh Bernhard et Bracey Smith. Il s''agit de la premiÃ¨re sÃ©rie produite uniquement avec des dons (Via le site VODO) et prÃ©vue pour Ãªtre diffusÃ©e gratuitement au moyen de BitTorrent.\r\n\r\nDans Pioneer One, nous suivons lâ€™enquÃªte d''un agent de la sÃ©curitÃ© du territoire des Ã‰tats-Unis (Tom Taylor) au sujet de la chute d''un OVNI se trouvant Ãªtre une capsule spatiale soviÃ©tique contenant un jeune homme parlant russe. AprÃ¨s investigation auprÃ¨s d''un spÃ©cialiste (Zachary Walzer), on dÃ©couvre que la seule provenance possible de la capsule est Mars.\r\n\r\n\r\nDistribution\r\n\r\n- James Rich : Tom Taylor\r\n- Alexandra Blatt : Sofie Larson\r\n- Jack Haley : Dr. Zachary Walzer (interprÃ©tÃ© par Matthew Foster dans le premier Ã©pisode)\r\n- Guy Wegener : Vernon\r\n- E. James Ford : Dileo\r\n- Laurence Cantor : Norton\r\n- Kathleen O''Loughlin : Christa\r\n- Einar Gunn : McClellan\r\n\r\nÃ‰pisodes\r\n\r\n1 - Earthfall (Pilot)\r\n2 - The Man From Mars\r\n3 - Alone in the Night\r\n4 - Triangular Diplomacy\r\n5 - Sea Change\r\n6 - War of Worlds', 'mumbly', 'http://www.pioneerone.tv/', 'Films - Videos', 'C.C. By-Nc-Sa', 'Pioneer_One_first_banner.jpg', 1622609917),
(90, '2013-07-24 08:55:02', 'PCBSD9.1-RELEASE-x64-DVD-latest.iso', 'PCBSD9.1-RELEASE-x64-DVD-latest.iso.torrent', 'PC-BSD est un systÃ¨me d''exploitation de bureau convivial basÃ© sur FreeBSD.\r\n\r\nLargement connu pour sa stabilitÃ© et sa sÃ©curitÃ© dans les environnements serveurs, FreeBSD fournit une excellente base sur laquelle construire un systÃ¨me d''exploitation de bureau.\r\n\r\nPC-BSD utilise un grand nombre de gestionnaires de bureau libre open source les plus populaires. En plus de compter sur un programme d''installation sur mesure qui offre Ã  portÃ©e de mains des utilisateurs les applications les plus populaires.', 'mumbly', 'http://www.pcbsd.org/fr/', 'xBSD', 'BSD license', 'pcbsd91a554.jpg', 4187922432),
(91, '2013-07-26 16:09:29', 'antergos-2013.05.30-x86_64.iso', 'antergos-2013.05.30-x86_64.iso.torrent', 'Cinnarch nâ€™est plus !!! En lieu et place, la distribution est devenue Antergos.\r\n\r\nBasÃ©e sur Archlinux (en direct, Ã  lâ€™inverse de Manjaro qui a plus ou moins un mois de retard par rapport Ã  Archlinux) et Gnome 3.8 (bien que Cinnamon, XFCE ou encore Razorqt soient disponibles sur lâ€™iso dâ€™installation), Antergos est une distribution Gnu/Linux de type "rolling release". Cela signifie que vous n''avez pas Ã  vous soucier des mises-Ã -jour majeures (nouvelle release) comme pour Ubuntu, fedora, etc.\r\n\r\nAvec une distribution de type "rolling release", vous aurez touours les derniÃ¨res mises-Ã -jour. Vous devez juste mettre Ã  jour rÃ©guliÃ¨rement votre systÃ¨me : tout ce dont vous avez besoin sera tÃ©lÃ©chargÃ© pour vous.\r\n\r\nAntergos est fournit avec PacmanXG (4.14.12 beta) qui vous permet d''effectuer Ã  peu prÃ¨s toutes les tÃ¢ches d''administration : synchro des mirroirs, mise Ã  jour du systÃ¨me, upgrade des packet AUR, installer des applis, trouver les 3 mirroirs les + rapides, trouver les paquets "orphelins", etc.\r\n\r\nSeul petit truc "Ã©trange" : le navigateur par dÃ©faut proposÃ© Ã  l''install est ... Chromium.\r\n\r\nPour l''installation, vous avez la possibilitÃ© de passer par un installateur "CLI" (en console assistÃ©) ou un installeur GUI (graphique) qui ressemble trait pour trait Ã  celui d''Ubuntu...', 'mumbly', 'http://antergos.com/', 'Gnu/Linux', 'GPL V2', 'antergos-logo.png', 719323136),
(92, '2013-07-29 10:53:07', 'Sintel-Full-720p-mkv-4kversion-ST-FR', 'Sintel.torrent', 'Sintel est le troisiÃ¨me court mÃ©trage libre de l''institut Blender, aprÃ¨s Elephants Dream et Big Buck Bunny.\r\nSous le nom de code Durian, il a Ã©tÃ© rÃ©alisÃ© en grande partie Ã  l''aide de logiciels open source (seule la partie sonore a utilisÃ© des logiciels propriÃ©taires), principalement Blender.\r\nLe film est disponible sur Internet depuis le 30 septembre 2010 sous licence Creative Commons Attribution 3.03 et l''Ã©quipe de production prÃ©voit de fournir en ligne les fichiers qui ont servi Ã  sa rÃ©alisation.\r\n\r\n<i><b>Synopsis :</b></i>\r\nUne jeune femme solitaire, Sintel, probablement orpheline, secourt et se lie d''amitiÃ© avec un dragonneau, qu''elle nomme Scales.\r\nMais lorsque celui-ci se fait enlever par un dragon adulte, Sintel dÃ©cide de se lancer dans une dangereuse quÃªte pour retrouver son compagnon...\r\n\r\n+ Sous-titres FR', 'mumbly', 'http://www.sintel.org', 'Films - Videos', 'C.C. By', 'Sintel_poster.jpg', 673937020),
(93, '2013-07-29 11:16:31', 'B. Crowell - Light and Matter (juin 2013)', 'lm.pdf.torrent', 'This is an introductory text intended for a one-year introductory course of the type typically taken by biology majors, or for AP Physics B. Algebra and trig are used, and there are optional calculus-based sections.\r\n\r\n<cite><b>B. Crowell</b> : "My text for physical science and engineering majors is Simple Nature. Topics covered are: Relativity, Rules of Randomness, Light as a Particle, Matter as a Wave, The Atom..."</cite>', 'mumbly', 'http://www.lightandmatter.com', 'Livres', 'C.C. By-Sa', 'light-matter.jpg', 82676292),
(94, '2013-07-29 14:51:34', 'Mouton 2.0 - La puce Ã  l''oreille', 'Mouton-lapucealoreille-internet.mp4.torrent', '<b>SYNOPSIS</b>\r\nLa modernisation de lâ€™agriculture dâ€™aprÃ¨s guerre portÃ©e au nom de la science et du progrÃ¨s ne sâ€™est pas imposÃ©e sans rÃ©sistances. Lâ€™Ã©levage ovin, jusque lÃ  Ã©pargnÃ© commence Ã  ressentir les premiers soubresauts dâ€™une volontÃ© dâ€™industrialisation.\r\n\r\nDepuis peu une nouvelle obligation oblige les Ã©leveurs ovins Ã  puÃ§er Ã©lectroniquement leurs bÃªtes. Ils doivent dÃ©sormais mettre une puce RFID, vÃ©ritable petit mouchard Ã©lectronique, pour identifier leurs animaux Ã  la place de lâ€™habituel boucle dâ€™oreille ou du tatouage. DerriÃ¨re la puce RFID, ses ordinateurs et ses machines il y a tout un monde qui se meurt, celui de la paysannerie.\r\n\r\nDans le monde machine, lâ€™animal nâ€™est plus quâ€™une usine Ã  viande et lâ€™Ã©leveur un simple exÃ©cutant au service de lâ€™industrie. Pourtant certains dâ€™entre eux sâ€™opposent Ã  tout cela â€¦\r\n\r\n\r\n<b>PRÃ‰SENTATION</b>\r\n                                                                    \r\nTITRE : MOUTONS 2.0 - La puce Ã  lâ€™oreille\r\n\r\nAUTEURS & RÃ‰ALISATEURS : Antoine Costa et Florian Pourchi\r\n\r\nAVEC : Jocelyne Porcher (Sociologue), Alain et Mathias Guibert, Jean-Louis et DaniÃ¨le Meurot, Antoine de Ruffray, SÃ©bastien Pelurson (eleveurs) â€“ Le collectif DrÃ´me contre le puÃ§age et le collectif PACA pour la libertÃ© de lâ€™Ã©levage, Jean-Michel Loubry (PÃ´le de traÃ§abilitÃ© de Valence) Edmond Ricard (INRA)\r\n\r\nMONTAGE : Viviana Robles Hatta\r\n\r\nMUSIQUE : Laurent Lefebvre\r\n\r\nMIXAGE SON : Matthieu Seignez\r\n\r\nÃ‰TALONNAGE : Nils Caneele\r\n\r\nSOUS TITRE : StÃ©phane Drouot\r\n\r\nPRODUCTION : SYNAPS Collectif Audiovisuel\r\n\r\nDURÃ‰E : 77 minutes\r\n\r\nLANGUES : FranÃ§ais + VOFR STENG\r\n\r\nIMAGE : Couleur\r\n\r\nFormat de prise de vue : DVcam\r\n\r\nFormat de diffusion : mp4\r\n\r\nRatio : 16 : 9\r\n\r\nSon : StÃ©rÃ©o\r\n\r\nPays de production : France\r\n\r\nDate dâ€™achÃ¨vement : Avril 2012\r\n', 'mumbly', 'http://synaps-audiovisuel.fr/mouton/?page_id=2', 'Films - Videos', 'C.C. By-Nc-Sa', 'mouton3.jpg', 1523157545),
(95, '2013-07-29 15:08:13', 'Chaos-A-mathematical-adventure-Multi-languages-720p-mkv', 'chaos-math_multi-language_720p_mkv.torrent', '<b>MULTI LANGUAGES RELEASE</b>\r\n\r\nCHAOS est un film mathÃ©matique constituÃ© de neuf chapitres de treize minutes chacun.\r\nIl s''agit d''un film tout public autour des systÃ¨mes dynamiques, de l''effet papillon et de la thÃ©orie du chaos.\r\nTout comme DIMENSIONS, ce film est diffusÃ© sous une licence Creative Commons et a Ã©tÃ© produit par Jos Leys, Ã‰tienne Ghys et AurÃ©lien Alvarez.\r\nCHAOS est disponible dans un large choix de langues et de sous-titres.\r\n\r\n<b>Ce torrent contient :</b>\r\n- les 9 Ã©pisodes\r\n- le gÃ©nÃ©rique en franÃ§ais, italien,  anglais, dutch\r\n- les sous-titres pour toutes les langues\r\n- README.txt\r\n- remux_langs.sh\r\n\r\n<i>UPDATE : au 29/07, le site web du projet est injoignable...</i>', 'mumbly', 'http://www.chaos-math.org/', 'Films - Videos', 'C.C. By-Nc-Nd', 'chaos_mathadventure.png', 2586396952);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `iduser` bigint(20) NOT NULL AUTO_INCREMENT,
  `nomuser` varchar(60) NOT NULL,
  `passuser` varchar(255) NOT NULL,
  `mailuser` varchar(100) NOT NULL,
  `dateuser` int(10) NOT NULL,
  `lastconnect` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activeuser` enum('0','1') NOT NULL DEFAULT '0',
  `activeuserkey` varchar(8) NOT NULL,
  `isadmin` enum('0','1') NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL,
  `pid` varchar(32) NOT NULL,
  `signature` text NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`iduser`, `nomuser`, `passuser`, `mailuser`, `dateuser`, `lastconnect`, `activeuser`, `activeuserkey`, `isadmin`, `avatar`, `pid`, `signature`) VALUES
(2, 'mumbly', 'fd68f1a7b9a2706eac11ee6c7bd93c4f9cd8ccb9', 'mumbly_58@yahoo.fr', 1311781363, '2013-07-30 08:41:29', '1', 'cde23468', '1', 'mumbly.gif', 'd393e450fc3465716c738f6aab95fd89', '&quot;... Et y''a des jours oÃ¹ Ã§a s''Ã©vapore ! ...&quot;'),
(3, 'shadrak', 'fd68f1a7b9a2706eac11ee6c7bd93c4f9cd8ccb9', 'olivierprieur@gmail.com', 1373796901, '2013-07-30 09:42:19', '1', 'cd013789', '0', 'tux_pirate_avatar.png', '2fa80d27814d0e9ac8b976ba3001293d', '&quot;Mais vous Ãªtes tous cintrÃ©s ?!!&quot; - Roi Athur, Kaamelott'),
(4, 'Clousiaelegag', '52a3eefe814106c3734482f3a096f85dcf4a2ab7', 'tonl93051@gmail.com', 1373863282, '0000-00-00 00:00:00', '0', 'bde03459', '0', '', '5a101decff906dcfc04b94fc465031fb', ''),
(5, 'elgrande71', '71b74bf62ec1b8766215744672094458fcbae163', 'elgrande71@free.fr', 1373953141, '0000-00-00 00:00:00', '1', 'abcd2368', '0', '', '2ea6696f7fa419236cf9ce18a2fd1eb2', ''),
(6, 'olivier', '98f8cee94137588e5de45e18e6d3687f40696e3e', 'mumbly58@live.fr', 1373955735, '2013-07-22 13:20:35', '1', 'abde2378', '0', '2.png', 'a9e8c8e3bbc94262a1d8de0829ab77a5', ''),
(7, 'zitoune', '98f8cee94137588e5de45e18e6d3687f40696e3e', 'tornzen@gmail.com', 1373965377, '2013-07-21 20:32:37', '1', 'aef01469', '0', '', '4f569a61961499ceb5025d44493ba273', ''),
(8, 'Marc', 'e4769e845877486d7709d103cdca8143a19ee4bb', 'pureos@free.fr', 1373971852, '0000-00-00 00:00:00', '1', 'acf13578', '0', '', '054e7667993a790d6216a2abd51e9e6e', ''),
(1, 'InvitÃ©', '', '', 0, '0000-00-00 00:00:00', '1', '', '0', '', '00000000000000000000000000000000', ''),
(9, 'directorcscsc', '98f8cee94137588e5de45e18e6d3687f40696e3e', 'olivierprieur@centresocialcosne.org', 1374396324, '2013-07-21 20:55:24', '1', 'abce1578', '0', '', '5c679d387708de2470276e29aead1335', '');

-- --------------------------------------------------------

--
-- Structure de la table `xbt_announce_log`
--

CREATE TABLE IF NOT EXISTS `xbt_announce_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipa` int(10) unsigned NOT NULL,
  `port` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `info_hash` binary(20) NOT NULL,
  `peer_id` binary(20) NOT NULL,
  `downloaded` bigint(20) unsigned NOT NULL,
  `left0` bigint(20) unsigned NOT NULL,
  `uploaded` bigint(20) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `xbt_config`
--

CREATE TABLE IF NOT EXISTS `xbt_config` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `xbt_config`
--

INSERT INTO `xbt_config` (`name`, `value`) VALUES
('redirect_url', ''),
('query_log', ''),
('pid_file', ''),
('offline_message', ''),
('column_users_uid', 'uid'),
('column_files_seeders', 'seeders'),
('column_files_leechers', 'leechers'),
('column_files_fid', 'fid'),
('column_files_completed', 'completed'),
('write_db_interval', '15'),
('scrape_interval', '0'),
('read_db_interval', '60'),
('read_config_interval', '60'),
('clean_up_interval', '60'),
('log_scrape', '0'),
('log_announce', '0'),
('log_access', '0'),
('gzip_scrape', '0'),
('full_scrape', '0'),
('debug', '1'),
('daemon', '1'),
('anonymous_scrape', '0'),
('announce_interval', '200'),
('torrent_pass_private_key', 'fU89bPMBZpDW1ePG3TltT9F2wMa'),
('table_announce_log', 'xbt_announce_log'),
('table_files', 'xbt_files'),
('table_files_users', 'xbt_files_users'),
('table_scrape_log', 'xbt_scrape_log'),
('table_users', 'xbt_users'),
('listen_ipa', '*'),
('listen_port', '9005'),
('anonymous_announce', '0'),
('auto_register', '0');

-- --------------------------------------------------------

--
-- Structure de la table `xbt_deny_from_hosts`
--

CREATE TABLE IF NOT EXISTS `xbt_deny_from_hosts` (
  `begin` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `xbt_files`
--

CREATE TABLE IF NOT EXISTS `xbt_files` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `info_hash` binary(20) NOT NULL,
  `leechers` int(11) NOT NULL DEFAULT '0',
  `seeders` int(11) NOT NULL DEFAULT '0',
  `completed` int(11) NOT NULL DEFAULT '0',
  `flags` int(11) NOT NULL DEFAULT '0',
  `mtime` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`fid`),
  UNIQUE KEY `info_hash` (`info_hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- Contenu de la table `xbt_files`
--

INSERT INTO `xbt_files` (`fid`, `info_hash`, `leechers`, `seeders`, `completed`, `flags`, `mtime`, `ctime`) VALUES
(76, 'z[H#e�L�/>,"�Ex2���', 0, 1, 5, 0, 1375171046, 1374071947),
(75, 'o6����9���|,E]DƧ', 0, 1, 1, 0, 1375171046, 1374070370),
(74, '�82..���&��C���о$�', 0, 1, 1, 0, 1375171046, 1374070134),
(73, '��dM��ܬ�	a�^�綼�', 0, 1, 1, 0, 1375171046, 1374069651),
(72, '�\r�?�f��z�mN!_���', 0, 1, 1, 0, 1375171046, 1374068753),
(71, 'w+o~J����_�B��Fڠ	m', 0, 1, 0, 0, 1375171046, 1374068483),
(79, '	eEq����-�X��t|J', 0, 1, 1, 0, 1375171046, 1374249253),
(80, 'ň�*�Z��]׎�� ��', 0, 1, 0, 0, 1375171046, 1374249487),
(81, '\Z/�N�J�a@֘���J�C/', 0, 1, 0, 0, 1375171046, 1374308998),
(82, '���\0�%4T�گ�O��q��+�', 0, 1, 0, 0, 1375171046, 1374393507),
(83, 'Δ_�=���x��[L�--`', 0, 1, 0, 0, 1375171046, 1374425695),
(84, '�ޗP�q�0.N�����', 0, 1, 1, 0, 1375171046, 1374514160),
(85, '����{��t��T��2�^', 0, 1, 0, 0, 1375171046, 1374514981),
(86, 'bgAP7��p���Lw$ �', 0, 1, 0, 0, 1375171046, 1374516119),
(87, '�ܠ_8��G��ɴQwyv2°C', 0, 1, 0, 0, 1375171070, 1374584861),
(88, 'a��V���wWr�/�a���', 0, 1, 0, 0, 1375171086, 1374588390),
(89, '\r_���n\n|���?��l�5	', 0, 1, 0, 0, 1375171107, 1374588616),
(90, '!2�s��(�oJ�~}�8�', 0, 1, 0, 0, 1375170856, 1374648902),
(91, '��]K���ɦ���)�>��\r��', 0, 1, 0, 0, 1375171107, 1374847769),
(92, '�;P8�h/��p��\\', 0, 1, 0, 0, 1375170881, 1375087987),
(93, 'G��5�&OB�mAR��N\0bĊ�', 0, 1, 0, 0, 1375171107, 1375089391),
(94, 'cJ�������z���+���', 0, 1, 0, 0, 1375171070, 1375102294),
(95, '�,\n3��Q�����}�=I��', 0, 1, 0, 0, 1375170962, 1375103293);

-- --------------------------------------------------------

--
-- Structure de la table `xbt_files_users`
--

CREATE TABLE IF NOT EXISTS `xbt_files_users` (
  `fid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `announced` int(11) NOT NULL,
  `completed` int(11) NOT NULL,
  `downloaded` bigint(20) unsigned NOT NULL,
  `left` bigint(20) unsigned NOT NULL,
  `uploaded` bigint(20) unsigned NOT NULL,
  `mtime` int(11) NOT NULL,
  UNIQUE KEY `fid` (`fid`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `xbt_files_users`
--

INSERT INTO `xbt_files_users` (`fid`, `uid`, `active`, `announced`, `completed`, `downloaded`, `left`, `uploaded`, `mtime`) VALUES
(71, 3, 0, 752, 0, 0, 0, 0, 1374219734),
(75, 6, 0, 585, 1, 70094500, 0, 0, 1374219767),
(72, 3, 0, 1342, 1, 976138240, 0, 976171008, 1374219830),
(72, 2, 1, 3541, 0, 0, 0, 0, 1375171026),
(73, 3, 0, 596, 0, 0, 0, 0, 1374219809),
(74, 3, 0, 154, 0, 0, 0, 0, 1374250631),
(76, 2, 1, 3392, 0, 0, 0, 1204750, 1375171026),
(71, 2, 1, 3424, 0, 0, 0, 0, 1375171026),
(76, 9, 0, 580, 0, 0, 0, 0, 1374219712),
(74, 6, 0, 585, 1, 19312640, 0, 0, 1374219784),
(75, 2, 1, 4130, 0, 0, 0, 70110884, 1375171026),
(75, 3, 0, 154, 0, 0, 0, 0, 1374250631),
(74, 2, 1, 4129, 0, 0, 0, 19312640, 1375171026),
(73, 2, 1, 3393, 0, 0, 0, 232783872, 1375171026),
(79, 2, 1, 3280, 0, 0, 0, 12998543, 1375171026),
(80, 2, 1, 3278, 0, 0, 0, 0, 1375171026),
(76, 3, 0, 6, 2, 481900, 0, 0, 1374678538),
(79, 3, 0, 3, 1, 12998543, 0, 0, 1374250794),
(76, 6, 0, 3, 1, 240950, 0, 0, 1374250840),
(76, 7, 0, 23, 1, 240950, 0, 0, 1374309163),
(81, 2, 1, 3039, 0, 0, 0, 0, 1375171026),
(82, 2, 1, 2708, 0, 0, 0, 0, 1375171026),
(83, 2, 1, 2582, 0, 0, 0, 0, 1375171026),
(84, 2, 1, 2225, 0, 0, 0, 727210538, 1375171026),
(85, 2, 1, 2221, 0, 0, 0, 0, 1375171026),
(86, 2, 1, 2216, 0, 0, 0, 0, 1375171026),
(87, 2, 1, 1942, 0, 0, 0, 0, 1375171055),
(88, 2, 1, 1942, 0, 0, 0, 0, 1375171071),
(89, 2, 1, 1942, 0, 0, 0, 1180107008, 1375171087),
(90, 2, 1, 1709, 0, 0, 0, 0, 1375170847),
(89, 1, 0, 5, 0, 1179910144, 442728448, 0, 1374656262),
(84, 1, 0, 399, 1, 1204449114, 0, 0, 1374848331),
(84, 3, 0, 2, 0, 0, 0, 0, 1374667297),
(76, 1, 0, 201, 1, 240950, 0, 0, 1374770569),
(90, 1, 0, 2, 0, 0, 4187922432, 0, 1374819000),
(91, 2, 1, 1078, 0, 0, 0, 0, 1375171091),
(73, 1, 0, 13, 1, 232783872, 0, 0, 1374946329),
(92, 2, 1, 277, 0, 0, 0, 0, 1375170856),
(93, 2, 1, 273, 0, 0, 0, 0, 1375171092),
(94, 2, 1, 229, 0, 0, 0, 0, 1375171060),
(95, 2, 1, 224, 0, 0, 0, 0, 1375170942);

-- --------------------------------------------------------

--
-- Structure de la table `xbt_scrape_log`
--

CREATE TABLE IF NOT EXISTS `xbt_scrape_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipa` int(10) unsigned NOT NULL,
  `info_hash` binary(20) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `xbt_users`
--

CREATE TABLE IF NOT EXISTS `xbt_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `torrent_pass_version` int(11) NOT NULL DEFAULT '0',
  `downloaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `uploaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `torrent_pass` char(32) CHARACTER SET latin1 NOT NULL,
  `torrent_pass_secret` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `xbt_users`
--

INSERT INTO `xbt_users` (`uid`, `torrent_pass_version`, `downloaded`, `uploaded`, `torrent_pass`, `torrent_pass_secret`) VALUES
(4, 0, 0, 0, '5a101decff906dcfc04b94fc465031fb', 0),
(3, 0, 33519826, 89423524, '2fa80d27814d0e9ac8b976ba3001293d', 0),
(2, 0, 1065545380, 3544752757, 'd393e450fc3465716c738f6aab95fd89', 0),
(5, 0, 726743, 0, '2ea6696f7fa419236cf9ce18a2fd1eb2', 0),
(6, 0, 240950, 0, 'a9e8c8e3bbc94262a1d8de0829ab77a5', 0),
(7, 0, 240950, 0, '4f569a61961499ceb5025d44493ba273', 0),
(8, 0, 0, 0, '054e7667993a790d6216a2abd51e9e6e', 0),
(9, 0, 0, 0, '5c679d387708de2470276e29aead1335', 0),
(1, 0, 2617384080, 0, '00000000000000000000000000000000', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
