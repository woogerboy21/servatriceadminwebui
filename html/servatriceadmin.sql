CREATE TABLE IF NOT EXISTS `cockatrice_usermessages` (
  `id` int(7) unsigned zerofill NOT NULL auto_increment,
  `beenread` tinyint(1) NOT NULL,
  `userfrom` varchar(35) NOT NULL,
  `userto` varchar(35) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(65535) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cockatrice_cocreports` (
  `id` int(7) unsigned zerofill NOT NULL auto_increment,
  `userfrom` varchar(35) NOT NULL,
  `userabout` varchar(35) NOT NULL,
  `aboutreguser` tinyint(1) NOT NULL,
  `dtofproblem` varchar(35) NOT NULL,
  `gamenumber` varchar(35) NOT NULL,
  `briefdescription` varchar(35) NOT NULL,
  `screenshoturl` varchar(1024) NOT NULL,
  `message` varchar(65535) NOT NULL,
  `datereported` datetime NOT NULL,
  `moderator` varchar(35) NOT NULL,
  `modnotes` varchar(65535) NOT NULL,
  `dateresolved` datetime NOT NULL,
  `closingmod` varchar(35) NOT NULL,
  `closingverdict` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
