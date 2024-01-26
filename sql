CREATE TABLE IF NOT EXISTS `User` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `vorname` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `telnr` int(13) NOT NULL,
  `plz` varchar(30) NOT NULL,
  `strasse` varchar(30) NOT NULL,
  PRIMARY KEY (`username`),
  FOREIGN KEY (`plz`) REFERENCES PLZ(`plz`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `User` (`username`, `password`, `name`, `vorname`, `mail`, `telnr`, `plz`, `strasse`) VALUES
('Seppii', 'Ausland', 'Maier', 'Sepp', 'sepp@muenchen.de', '12' ,'88990', 'Lümmelweg 2'),
('Arbusto', 'Ballast7', 'Müller', 'Gerd', 'gerd@fcb.de','0117116' ,'99889', 'Rosa Luxemburg Allee 1'),
('BertisBohnen', 'passwort', 'Vogts', 'Berti', 'berti@bmg.de', '017694963369' ,'54543', 'Danziger Straße 154'),
('Kleinstein', 'Taubsi', 'Overath', 'Wolfgang', 'overarth@web.de', '234567890' ,'45455', 'Mopsweg 7'),
('Glumanda', 'Karpador2', 'Netzer', 'Günni', 'netzer@web.de', '123456789' ,'55555', 'Oberkaka 8');

CREATE TABLE IF NOT EXISTS `Autos` (
  `AID` int(10) NOT NULL AUTO_INCREMENT,
  `Hersteller` varchar(30) NOT NULL,
  `Model` varchar(30) NOT NULL,
  `Typ` varchar(30) NOT NULL,
  `Farbe` varchar(30) NOT NULL,
  `Zustand` varchar(30) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `Kilometer` varchar(30) NOT NULL,
  `Sprit` varchar(30) NOT NULL,
  `Preis` int(6) NOT NULL,
  `Username` varchar(30) NOT NULL,
  PRIMARY KEY (`AID`),
  FOREIGN KEY (`Username`) REFERENCES User(`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


INSERT INTO `Autos` (`AID`, `Hersteller`, `Model`, `Typ`, `Farbe`, `Zustand`, `Status`, `Kilometer`, `Sprit`, `Preis`, `Username`) VALUES
('1', 'Opel','Mijos Schrottkarre', 'Kombi', 'Braun mit Kratzer', 'Katastrophe', 'Verfügbar', '6788', 'Benzin', '20', 'Seppii');
('2', 'Audi', 'A4', 'Limousine', 'Silber', 'Neuartig', '14','Diesel', '9900', 'Arbusto');



CREATE TABLE IF NOT EXISTS `PLZ` (
  `PLZ` int(10) NOT NULL,
  `Stadt` varchar(30) NOT NULL,
  PRIMARY KEY (`Stadt`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `PLZ` (`PLZ`,`Stadt`) VALUES
  ('88990', 'Friedrichshafen'),
  ('99889', 'Tabarz'),
  ('54543', 'Montabaur'),
  ('45455','Mühlheim'),
  ('55555','Lippstadt');
  
