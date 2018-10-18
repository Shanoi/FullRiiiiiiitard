

drop table if exists enchere;

drop table if exists utilisateur;

drop table if exists objet;

CREATE TABLE `test`.`Utilisateur` (
  -- `idUtilisateur` INT NOT NULL AUTO_INCREMENT,
  `Pseudo` VARCHAR(40) NOT NULL ,
  `Nom` VARCHAR(40) NULL ,
  `Prenom` VARCHAR(40) NULL,
  `Adresse` MEDIUMTEXT NULL,
  `Numero` VARCHAR(15) NULL,
  `Email` VARCHAR(50) NULL,
  `Mdp` VARCHAR(45) NULL,
  PRIMARY KEY (`Pseudo`));
  
CREATE TABLE `test`.`Objet` (
  `idObjet` INT NOT NULL AUTO_INCREMENT,
  `ID_U` VARCHAR(40) NULL,
  `Nom` VARCHAR(50) NULL,
  `Date_deb` DATE NULL ,
  `Date_fin` DATE NULL ,
  `Description` VARCHAR(256) NULL,
  `Prix_actuel` FLOAT NULL,
  `Prix_base` FLOAT NULL,
  `Photo` VARCHAR(256) NULL,
  PRIMARY KEY (`idObjet`)
  );
    
CREATE TABLE `test`.`Enchere` (
  `ID_E` INT NOT NULL AUTO_INCREMENT,
  `ID_U` VARCHAR(40) NOT NULL,
  `ID_O` INT NOT NULL,
  `Prix_propose` FLOAT NULL,
  `Date` DATE NULL,
  /*`Vendeur` TINYINT(1) NULL,*/
  /*PRIMARY KEY (`ID_U`, `ID_O`),*/
  PRIMARY KEY (`ID_E`),
  INDEX `FK_ENCHERE_ASSOCIATI_OBJETS_idx` (`ID_O` ASC),
  CONSTRAINT `FK_ENCHERE_ASSOCIATI_UTILISAT`
    FOREIGN KEY (`ID_U`)
    REFERENCES `test`.`Utilisateur` (`Pseudo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_ENCHERE_ASSOCIATI_OBJETS`
    FOREIGN KEY (`ID_O`)
    REFERENCES `test`.`Objet` (`idObjet`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

  
-- Remplissage

INSERT INTO `test`.`Utilisateur` (`Pseudo`,`Nom`, `Prenom`, `Adresse`, `Numero`, `Email`, `Mdp`) VALUES ('Satan','Satan', 'Lucifere', 'Hell', '666', 'lmdlm1@get2mail.fr', '666');
INSERT INTO `test`.`Utilisateur` (`Pseudo`,`Nom`, `Prenom`, `Adresse`, `Numero`, `Email`, `Mdp`) VALUES ('Bob','Bob', 'Jean', 'Ici', '0', 'lmdlm2@yopmail.com', 'Lea');
INSERT INTO `test`.`Utilisateur` (`Pseudo`,`Nom`, `Prenom`, `Adresse`, `Numero`, `Email`, `Mdp`) VALUES ('Lea','Léa', 'Sansnom', 'LaBas', '1', 'lmdlm3@yopmail.com', 'Bob');
INSERT INTO `test`.`Utilisateur` (`Pseudo`,`Nom`, `Prenom`, `Adresse`, `Numero`, `Email`, `Mdp`) VALUES ('Flanby','Oland', 'Francois', 'Helise', '17', 'lmdlm4@yopmail.com', 'Flan');
INSERT INTO `test`.`Utilisateur` (`Pseudo`,`Nom`, `Prenom`, `Adresse`, `Numero`, `Email`, `Mdp`) VALUES ('Admin','JesuisAdmin', 'Lunique', '127.0.0.1', '80', 'lmdlm5@yopmail.com', 'admin');

INSERT INTO `test`.`objet` (`idObjet`, `ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('1', 'Satan', 'Epee', curdate(), curdate() + INTERVAL 7 DAY, 'C est pas un site pour Zelda ? Ah zut !', '349', '349','epee.png');
INSERT INTO `test`.`objet` (`idObjet`, `ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('2', 'Satan', 'Bouclier', curdate() - INTERVAL 2 DAY, curdate() + INTERVAL 5 DAY, 'Bouclier de Zelda', '200', '50','bouclier.png');
INSERT INTO `test`.`objet` (`idObjet`, `ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('3', 'Flanby', 'Superbe epee', curdate() - INTERVAL 2 DAY, curdate() + INTERVAL 5 DAY, 'Vend cette superbe epee a seulement 349 euro', '349', '349','flanby.jpg');

INSERT INTO `test`.`objet` (`idObjet`, `ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('4', 'Bob', 'Hache de gimli', curdate() - INTERVAL 10 DAY, curdate() - INTERVAL 7 DAY, 'Hache original de Gimli', '150', '150','hache.jpg');
INSERT INTO `test`.`objet` (`idObjet`, `ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('5', 'Bob', 'Costume Nazgul', curdate() - INTERVAL 10 DAY, curdate() - INTERVAL 7 DAY, 'Le Costume du  Roi-Sorcier Angmar, une offre a saisir !', '300', '300','Nazgul.jpg');
INSERT INTO `test`.`objet` (`idObjet`, `ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('6', 'Bob', 'Arc de Legolas', curdate() - INTERVAL 10 DAY, curdate() - INTERVAL 7 DAY, 'Arc officiel de Legolas !', '230', '230','arc.jpg');
INSERT INTO `test`.`objet` (`idObjet`, `ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('7', 'Bob', 'L Anneau', curdate() - INTERVAL 5 DAY, curdate() + INTERVAL 2 DAY, 'L anneau unique pour les gounerver tous !', '50000', '50000','anneau.jpg');

INSERT INTO `test`.`objet` (`idObjet`, `ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('8', 'Lea', 'Maison de Hobbit', curdate() - INTERVAL 5 DAY, curdate() + INTERVAL 2 DAY, 'Une magnifique maison de hobbit !', '100000', '100000','maison.jpg');

-- INSERT INTO `test`.`enchere` (`ID_U`, `ID_O`, `Prix_propose`, `Date`) VALUES ('Satan', '2', '900', now());

SELECT * FROM objet ORDER BY Date_fin ASC LIMIT 1;
SELECT * FROM objet ORDER BY Date_deb DESC LIMIT 1;
SELECT * FROM objet ORDER BY Prix_actuel DESC LIMIT 1;



INSERT INTO `test`.`objet` (`ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('Satan', 'Mordor', curdate() - INTERVAL 2 DAY, curdate() + INTERVAL 5 DAY, 'Une place magnifique', '2000000000', '2000000000','defaut.png');
INSERT INTO `test`.`objet` (`ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('Blake', 'Arbre', curdate() - INTERVAL 2 DAY, curdate() + INTERVAL 5 DAY, 'Un arbre', '5', '10','defaut.png');
INSERT INTO `test`.`objet` (`ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('Elaine', 'Pipe', curdate() - INTERVAL 2 DAY, curdate() + INTERVAL 5 DAY, 'La pipe de Gandalf', '500', '10000','pipe.gif');
INSERT INTO `test`.`objet` (`ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('Satan', 'Sauron', curdate() - INTERVAL 2 DAY, curdate() + INTERVAL 5 DAY, 'Le Seigneur des Ténèbres', '1', '2','defaut.png');
INSERT INTO `test`.`objet` (`ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('Hilel', 'Pied', curdate() - INTERVAL 2 DAY, curdate() + INTERVAL 5 DAY, 'Le pied d\' hobbit (mort...)', '200', '5000','defaut.png');
INSERT INTO `test`.`objet` (`ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES ('Unity', 'Fleche', curdate() - INTERVAL 2 DAY, curdate() + INTERVAL 5 DAY, 'Une flèche', '300', '1000','fleche.jpg');



INSERT INTO `test`.`Utilisateur` (`Pseudo`,`Nom`,`Prenom`,`Adresse`,`Numero`,`Email`,`Mdp`) VALUES ("Hoyt","Ramirez","Sylvia","560-4991 Cursus Road","08 83 75 46 99","Ut@orcilobortisaugue.net","diam."),("Burke","Mathis","Jana","Ap #947-9924 Accumsan St.","04 60 26 56 64","erat.neque.non@aliquamarcu.com","risus."),("Unity","Le","Iliana","Ap #445-7689 Nibh Rd.","07 58 17 47 82","a.purus.Duis@Nullamsuscipit.com","metus"),("Gretchen","Chaney","Lois","516-5831 Vel St.","06 56 81 71 30","ut.dolor.dapibus@Mauris.ca","at auctor"),("Kiayada","Baker","Dolan","Ap #591-1476 Suscipit Rd.","09 32 24 48 46","at@diamnuncullamcorper.ca","neque et"),("Aphrodite","Reid","Jocelyn","369-771 Tempus Av.","01 68 85 60 81","tempor.est.ac@magna.org","semper. Nam"),("Sawyer","Harvey","Kellie","P.O. Box 503, 7437 Aliquam Road","06 05 13 11 33","rhoncus@egetmetusIn.edu","interdum"),("Amena","Rush","Nash","2619 Eget Av.","07 67 74 47 44","augue.malesuada.malesuada@interdum.com","adipiscing"),("Gareth","Good","Tate","P.O. Box 337, 7588 Volutpat. Road","04 71 44 44 19","vitae@semNulla.ca","Curabitur egestas"),("Clinton","Joyner","Jemima","105-9889 Mauris Road","05 80 25 15 33","mauris@aliquetliberoInteger.co.uk","luctus sit amet,");
INSERT INTO `test`.`Utilisateur` (`Pseudo`,`Nom`,`Prenom`,`Adresse`,`Numero`,`Email`,`Mdp`) VALUES ("Lucy","Lancaster","Conan","599-902 Lorem, Street","02 58 42 82 25","Pellentesque@enimconsequatpurus.com","enim, condimentum"),("Blake","Boyd","Claudia","2877 Mi Ave","06 32 02 78 18","enim.Suspendisse@ac.net","tellus."),("Hilel","Delgado","John","165-2251 Class Av.","08 35 93 72 52","et@augueac.edu","consequat"),("Joshua","Greer","Barbara","Ap #394-1619 Ante, Av.","07 19 63 19 69","pharetra.felis@nostraperinceptos.co.uk","accumsan convallis,"),("Brenna","Patterson","Charde","190-8711 Metus Road","02 14 57 92 32","Suspendisse.non.leo@Quisquenonummyipsum.edu","aliquet magna a"),("Deborah","Erickson","Zenia","698-9419 Dolor Road","07 83 67 34 48","malesuada.fames.ac@Sed.co.uk","justo eu"),("Leigh","Hooper","Raymond","459-6044 Libero Rd.","01 24 94 31 75","lobortis@bibendumfermentum.co.uk","Nunc laoreet lectus"),("Elaine","Leach","Cheyenne","Ap #943-593 Lorem St.","05 80 53 48 59","tristique.neque@blanditmattis.com","sed dolor. Fusce"),("Darrel","Rocha","Jillian","6124 Turpis. Av.","07 99 22 38 77","mauris.eu.elit@euplacerat.com","Aliquam erat"),("Patricia","Joseph","Emi","P.O. Box 395, 7326 Velit. Street","04 40 87 69 02","lectus@pellentesqueSeddictum.edu","Nunc");


INSERT INTO `test`.`enchere` (`ID_E`, `ID_U`, `ID_O`, `Prix_propose`, `Date`) VALUES ('1', 'Admin', '1', '500', '2015-11-05');
INSERT INTO `test`.`enchere` (`ID_E`, `ID_U`, `ID_O`, `Prix_propose`, `Date`) VALUES ('2', 'Bob', '4', '1000', '2015-10-05');
INSERT INTO `test`.`enchere` (`ID_E`, `ID_U`, `ID_O`, `Prix_propose`, `Date`) VALUES ('3', 'Bob', '4', '1200', '2015-11-05');
INSERT INTO `test`.`enchere` (`ID_E`, `ID_U`, `ID_O`, `Prix_propose`, `Date`) VALUES ('4', 'Lea', '5', '10000', '2015-11-05');

-- SELECT idObjet FROM objet WHERE Date_fin < curdate();