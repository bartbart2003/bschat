CREATE TABLE IF NOT EXISTS `chattable` (
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `time` text NOT NULL,
  `type` text NOT NULL,
  `name` text CHARACTER SET utf8,
  `content` text CHARACTER SET utf8,
  `formatting` text NOT NULL,
  PRIMARY KEY (`messageID`)
);
