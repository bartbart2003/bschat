CREATE TABLE IF NOT EXISTS `chatconfig` (
  `confid` int(11) NOT NULL AUTO_INCREMENT,
  `confkey` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`confid`)
);
