CREATE TABLE IF NOT EXISTS `cp_vfp_sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `votename` varchar(25) NOT NULL,
  `voteurl` varchar(255) NOT NULL,
  `voteinterval` int(11) NOT NULL,
  `votepoints` int(11) NOT NULL,
  `imgname` varchar(255) DEFAULT NULL,
  `imgurl` varchar(255) DEFAULT NULL,
  `datetime_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

ALTER TABLE `cp_createlog` ADD `votepoints` int(11) NOT NULL DEFAULT '0';