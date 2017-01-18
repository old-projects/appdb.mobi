CREATE TABLE `logofon_operators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `label` varchar(20) NOT NULL,
  `tld` varchar(2) NOT NULL,
  `country` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country` (`country`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `logofon_ranges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operator_id` int(10) unsigned NOT NULL,
  `start` bigint(20) unsigned NOT NULL,
  `end` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `operator_id` (`operator_id`),
  KEY `start` (`start`),
  KEY `end` (`end`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
