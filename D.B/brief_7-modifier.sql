
CREATE TABLE IF NOT EXISTS `projects` (
  `id_project` int NOT NULL AUTO_INCREMENT,
  `image` text,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `scrumMasterID` int DEFAULT NULL,
  `productOwnerID` int DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `statut` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_project`),
  KEY `ProductID` (`productOwnerID`),
  KEY `ScrumID` (`scrumMasterID`)
);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--


CREATE TABLE IF NOT EXISTS `question` (
  `id_question` int NOT NULL AUTO_INCREMENT,
  `tittre` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `datecreation` date NOT NULL,
  `ID_User` int DEFAULT NULL,
  `Archif` tinyint DEFAULT NULL,
  `ProjectID` int DEFAULT NULL,
  PRIMARY KEY (`id_question`),
  KEY `fk_IDUser` (`ID_User`),
  KEY `fk_ProjectID` (`ProjectID`)
);

-- --------------------------------------------------------

--
-- Structure de la table `reaction`
--


CREATE TABLE IF NOT EXISTS `reaction` (
  `id_reaction` int NOT NULL AUTO_INCREMENT,
  `reaction` tinyint(1) NOT NULL,
  `id_question` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_reponse` int DEFAULT NULL,
  PRIMARY KEY (`id_reaction`),
  KEY `fk_idquestion` (`id_question`),
  KEY `fk_idreponse` (`id_reponse`),
  KEY `fk_iduserreaction` (`id_user`)
);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--


CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int NOT NULL AUTO_INCREMENT,
  `reponse` varchar(255) NOT NULL,
  `datecreation` date NOT NULL,
  `user_id_reponse` int DEFAULT NULL,
  `id_qst` int DEFAULT NULL,
  `archife` tinyint DEFAULT NULL,
  PRIMARY KEY (`id_reponse`),
  KEY `fk_idqst` (`id_qst`),
  KEY `fk_iduserres` (`user_id_reponse`)
);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--


CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tag`)
);

-- --------------------------------------------------------

--
-- Structure de la table `tagquetion`
--


CREATE TABLE IF NOT EXISTS `tagquetion` (
  `ID_Question` int DEFAULT NULL,
  `ID_Tag` int DEFAULT NULL,
  KEY `ID_Question` (`ID_Question`),
  KEY `ID_Tag` (`ID_Tag`)
);

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--
CREATE TABLE IF NOT EXISTS `teams` (
  `id_team` int NOT NULL AUTO_INCREMENT,
  `image` text,
  `description` varchar(255) DEFAULT NULL,
  `teamName` varchar(50) DEFAULT NULL,
  `projectID` int DEFAULT NULL,
  `scrumMasterID` int DEFAULT NULL,
  PRIMARY KEY (`id_team`),
  KEY `fk_projectid` (`projectID`),
  KEY `fkcsrum` (`scrumMasterID`)
);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `image` text,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `phoneNum` int DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `equipeID` int DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_equipe` (`equipeID`)
);

