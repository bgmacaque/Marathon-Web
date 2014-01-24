-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 23 Janvier 2014 à 22:48
-- Version du serveur: 5.5.34
-- Version de PHP: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `CCD`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_plat` int(11) NOT NULL,
  `valeur_note` int(11) NOT NULL,
  `date_comment` datetime NOT NULL,
  `content_comment` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_plat` (`id_plat`),
  KEY `id_note` (`valeur_note`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_plat`, `valeur_note`, `date_comment`, `content_comment`) VALUES
(1, 27, 3, '0000-00-00 00:00:00', 'a'),
(2, 1, 3, '0000-00-00 00:00:00', 'Yooo'),
(3, 2, 3, '0000-00-00 00:00:00', 'frtgyhuj'),
(4, 3, 3, '0000-00-00 00:00:00', 'Yoo'),
(5, 4, 3, '0000-00-00 00:00:00', 'J''aime beaucoup'),
(6, 53, 3, '0000-00-00 00:00:00', 'frg'),
(7, 54, 3, '0000-00-00 00:00:00', 'd'),
(8, 55, 3, '0000-00-00 00:00:00', 's'),
(9, 56, 3, '0000-00-00 00:00:00', 'z'),
(10, 57, 3, '0000-00-00 00:00:00', 'sefrgb'),
(11, 57, 3, '0000-00-00 00:00:00', 'sefrgb'),
(12, 57, 3, '0000-00-00 00:00:00', 'J''aime les sushis\n'),
(13, 57, 3, '0000-00-00 00:00:00', 'J''aime beaucoup les sushis\n'),
(14, 58, 2, '0000-00-00 00:00:00', 'J''aime les sushis aux anguilles!'),
(15, 58, 5, '0000-00-00 00:00:00', 'J''aime les sushis aux anguilles!'),
(16, 58, 4, '0000-00-00 00:00:00', 'J''aime les sushis aux anguilles!'),
(17, 58, 4, '0000-00-00 00:00:00', 'J''aime les sushis aux anguilles!'),
(18, 1, 2, '0000-00-00 00:00:00', 'Yeah'),
(19, 55, 1, '0000-00-00 00:00:00', 'afg'),
(20, 53, 4, '0000-00-00 00:00:00', 'J''aime beaucoup les maquis'),
(21, 26, 5, '0000-00-00 00:00:00', 'J''adore!'),
(22, 26, 5, '0000-00-00 00:00:00', 'Vraiment bon!'),
(23, 84, 5, '0000-00-00 00:00:00', 'Yeah'),
(24, 85, 4, '0000-00-00 00:00:00', 'J''aime le paté!'),
(25, 146, 5, '0000-00-00 00:00:00', 'Yeah');

-- --------------------------------------------------------

--
-- Structure de la table `favplat`
--

CREATE TABLE IF NOT EXISTS `favplat` (
  `id_plat` int(11) NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_plat`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `favresto`
--

CREATE TABLE IF NOT EXISTS `favresto` (
  `id_favresto` int(11) NOT NULL AUTO_INCREMENT,
  `id_resto` int(11) NOT NULL,
  `id_user` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_favresto`),
  KEY `id_resto` (`id_resto`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `favresto`
--

INSERT INTO `favresto` (`id_favresto`, `id_resto`, `id_user`) VALUES
(3, 1, 6),
(4, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id_note` int(11) NOT NULL AUTO_INCREMENT,
  `id_plat` int(11) NOT NULL,
  `valeur_note` int(11) NOT NULL,
  PRIMARY KEY (`id_note`),
  KEY `id_plat` (`id_plat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

CREATE TABLE IF NOT EXISTS `plat` (
  `id_plat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_plat` varchar(128) NOT NULL,
  `description_plat` text NOT NULL,
  `prix_plat` float NOT NULL,
  `photo_plat` varchar(256) NOT NULL,
  `id_resto` int(11) NOT NULL,
  PRIMARY KEY (`id_plat`),
  KEY `id_resto` (`id_resto`),
  KEY `id_resto_2` (`id_resto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=159 ;

--
-- Contenu de la table `plat`
--

INSERT INTO `plat` (`id_plat`, `nom_plat`, `description_plat`, `prix_plat`, `photo_plat`, `id_resto`) VALUES
(1, 'Classique', 'Tomate, Mozarella, Olives', 8, 'pizza_classique.jpg', 1),
(2, 'Koop-izz-a', 'Tomate, Mozarella, Olives noires.', 10, 'pizza_koopa.jpg', 1),
(3, 'Pizza Peach', 'CrÃ¨me FraÃ®che, Mozzarella, Brocoli, Pepperoni, Artichaud.', 11, 'pizza_peach.jpg', 1),
(4, 'Donkey Kong Pizza ', 'Sauce Barbecue, mozzarella, Tomate, Chorizo, Pepperoni.', 12, 'Pizza_donkey.jpg', 1),
(26, 'Boeuf aux Champignons Noirs', 'Boeuf aux Champignons Noirs', 6.2, 'boeufChampignonsNoirs.jpg', 2),
(27, 'Boeuf au Curry', 'Du Boeuf avec du Curry', 6, 'BoeufCurry.jpg', 2),
(28, 'Poulet Ananas', 'Poulet A l''ananas Sauce Aigre Douce', 7.1, 'PouletAnanas.jpg', 2),
(29, 'Porc aux legumes', 'Porc aux legumes Ã  la Sauce piquante', 6.8, 'Porcauxlegumes.jpg', 2),
(30, 'Riz Cantonais', 'Il ne faut pas s''y cantoner.', 3, 'RizCantonais.jpg', 2),
(31, 'Nouilles sautÃ©s au poulet', 'Nouilles sautÃ©s au poulet', 6, 'NouillesPoulet.jpg', 2),
(32, 'LÃ©gumes Chop-Suey', 'LÃ©gumes Chop-Suey', 5, 'LegumesChop-Suey.jpg', 2),
(53, 'Maki Concombre', 'Maki Concombre', 4, 'MakiConcombre.jpg', 3),
(54, 'Maki Saumon', 'Maki Saumon', 4.5, 'MakiSaumon.jpg', 3),
(55, 'Maki California Saumon Avocat', 'Maki California Saumon Avocat', 5, 'MakiCalifornia.jpg', 3),
(56, 'Sushi Crevette (2 piÃ¨ces)', 'Sushi Ã  la Crevette ', 4, 'SushiCrevette.jpg', 3),
(57, ' Sushi Thon (2 piÃ¨ces)', 'Sushi Thon', 4.5, 'SushiThon.jpg', 3),
(58, 'Sushi Anguille', 'Une occasion comme cela, il ne faut pas la laisser filer.', 7, 'SushiAnguille.jpg', 3),
(59, 'Yakitori Boulettes de Poulet', 'Yakitori Boulettes de Poulet', 3, 'YakitoriPoulet.jpg', 3),
(60, 'Yakitori Boeuf au Fromage', 'Les traditionnelles !!', 4.3, 'YakitoriBoeufFromage.jpg', 3),
(61, 'Yakitori Champignons', 'Yakitori Champignons', 3, 'YakitoriChampignons.jpg', 3),
(62, 'Perle de Coco', 'Perle de Coco', 3, 'PerledeCoco.jpg', 3),
(81, 'Nougat chinois', 'Nougat chinois', 3, 'Nougat.jpg', 3),
(82, 'El chili de los golosos', 'Haricots rouges, boeuf mijotÃ©, riz, fromage, concombre, crÃ¨me fraÃ®che.', 10.9, 'Elchilidelosgolosos.jpg', 4),
(83, 'Enchilado de queso', 'galette de blÃ© roulÃ©e, farcie au fromage, et sa sauce chili.', 9.5, 'Enchilado.jpg', 4),
(84, 'Burrito poulet', 'tortillas de maÃ¯s, boeuf, chili, fromage, concombre et sa sauce verte.', 11.2, 'BurritoPoulet.jpg', 4),
(85, 'Burrito boeuf', 'galette croustillante de maÃ¯s, boeuf, fromage', 9.9, 'Burritoboeuf.jpg', 4),
(86, 'Fajitas boeuf', 'Fajitas boeuf', 13.5, 'Fajitasboeuf.jpg', 4),
(87, 'Fajitas gambas', 'Fajitas gambas', 17, 'Fajitasgambas.jpg', 4),
(88, 'Las tostadas de la casa', 'EntrÃ©e: galettes de maÃ¯s croustillantes, boeuf ou poulet, sauce chili, salade', 6, 'Lastostadasdelacasa.jpg', 4),
(89, 'Nachos', 'chips de maÃ¯s nappÃ©es de fromage fondu avec haricots rouges et jalapenos', 6.5, 'Nachos.jpg', 4),
(130, 'Jambon Champignon', 'Sauce Tomate, Mozzarella, Jambon, Champignon.', 12.5, 'pizza_Champi.jpg', 7),
(131, 'ProvenÃ§ale', 'Sauce tomate, mozzarella, tomates fraÃ®ches, ail, basilic, olives', 12.5, 'Pizza_Provencale.jpg', 7),
(132, 'Recursive', 'Sauce tomate, pizzas variÃ©es.', 11, 'pizza_recursive.jpeg', 7),
(133, 'Aubergina', 'Sauce tomate, mozzarella, aubergines, tomates fraÃ®ches', 13, 'Pizza_Aubergina.jpg', 7),
(134, 'Schtroumpf', 'Mini pizzas au bleu.', 13, 'pizza_schroumpf.jpg', 7),
(135, 'Mexicaine', 'Sauce tomate, sauce barbecue, mozzarella, viande hachÃ©e, chorizo, champignons, piments forts', 12, 'Pizza_Mexicaine.jpg', 7),
(136, 'Chorizone', 'CrÃ¨me fraÃ®che, Chorizo, Fromage.', 11, 'pizza_chorizon.jpg', 7),
(137, 'CyclopÃ©enne', 'CrÃ¨me fraÃ®che, Mozzarella, Poivron, Olives, Oeuf.', 12, 'pizza_oeuf.jpg', 7),
(138, 'PoulÃ©gume', 'CrÃ¨me fraÃ®che, Poulet, Poivrons, Oignons doux.', 14, 'pizza_poulegume.jpg', 7),
(140, 'Sushi Poulpe', 'Sushi Poulpe', 5.5, 'SushiPoulpe.jpg', 8),
(142, 'Sushi Avocat', 'Sushi Avocat', 3.8, 'SushiAvocat.jpg', 8),
(143, 'Sushi Oeufs de Saumon', 'Sushi Oeufs de Saumon', 5, 'SushiOeufsdeSaumon.jpg', 8),
(144, 'Temaki Saumon Avocat', 'Du Saumon et de l''avocat enroulÃ©s dans une feuille d''algue.', 4.5, 'TemakiSaumonAvocat.jpg', 8),
(145, 'Temaki Oeuf de Saumon', 'Temaki Oeuf de Saumon', 6, 'TemakiOeuf.jpg', 8),
(146, 'California Saumon Avocat', 'California Saumon Avocat', 4.5, 'CaliforniaSaumonAvocat.jpg', 8),
(149, 'Maki Homard', 'Avocat, Mayonnaise Ã  l''Estragon', 7.6, 'MakiHomard.jpg', 8),
(150, 'Maki Wasabi', 'Il ne vous restera que les yeux pour pleurer', 6, 'MakiWasabi.jpg', 8),
(153, 'Brochette Boulettes de Poulet', 'Brochette Boulettes de Poulet', 3.5, 'BrochetteBoulettesdePoulet.jpg', 8),
(154, 'Brochette Boeuf', 'Brochette Boeuf', 4, 'BrochetteBoeuf.jpg', 8),
(155, 'Brochette Boeuf au Fromage', 'Brochette Boeuf au Fromage', 4, 'BrochetteBoeufFromage.jpg', 8),
(156, 'Sushi Thon', 'Sushi Thon', 4.5, 'SushiThon.jpg', 8),
(157, 'Aloo Gobi', 'Ca se gobe bien.', 12.95, 'Aloo_gobi.jpg', 9),
(158, 'Poulet Tandoori ', 'TrÃ¨s tendre.', 13.75, 'TandooriChicken.jpg', 10);

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `id_resto` int(11) NOT NULL AUTO_INCREMENT,
  `nom_resto` varchar(128) NOT NULL,
  `description_resto` text NOT NULL,
  `adresse_resto` text NOT NULL,
  `contact_resto` varchar(128) NOT NULL,
  `id_theme` int(11) NOT NULL,
  PRIMARY KEY (`id_resto`),
  KEY `id_theme` (`id_theme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `restaurant`
--

INSERT INTO `restaurant` (`id_resto`, `nom_resto`, `description_resto`, `adresse_resto`, `contact_resto`, `id_theme`) VALUES
(1, 'Chez Mario et Luigi', 'Les pizzaiolos du jeu video !!', '8 rue sous le tuyau.\r\nMarioLand', 'mario@marioland', 4),
(2, 'Fu Mange Tout', 'Le meilleur restaurant chinois de toute la ville.', 'Shangai', 'Fu@MangTout', 1),
(3, 'Les sushis sont secs', 'Une tradition directement venue du Japon. Tous les sushis de vos souhaits !', '32 Rue de Totoro\r\nNancy', 'Sushi@sonsecs', 3),
(4, 'SMSexicain', 'Le meilleur restaurant de TextMex. Tapas et Fajitas Ã  volontÃ© (et plus encore).\r\n\r\nPour ceux qui n''ont pas froid aux yeux', '14 rue de la grand place\r\nLaxouVille\r\n', 'sms@xicain', 2),
(7, 'Pizza the Hut', 'La seule pizzeria qui possÃ¨de l''achtusse.', '2 impasse de la galaxie\r\nLuxembourgVille', 'pizza@thehut', 4),
(8, 'Yamazaki', 'De nombreux sushis fait avec amour et avec le poisson le plus frais du marchÃ©.', '5 Grand Rue\r\nMalzÃ©ville', 'yama@saki', 3),
(9, 'Little Pakistan', 'DÃ©lices du Pakistan', '12 rue du Faubour des Trois Maison, 54000, nancy', 'little@pakistan', 5),
(10, 'Le Taj Mahal', 'On aime les Ã©pices', '45 rue des Fabrique, 54000 Nancy', 'taj@mahal', 5);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `nom_theme` varchar(128) NOT NULL,
  `description_theme` text NOT NULL,
  `image_theme` text NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `nom_theme`, `description_theme`, `image_theme`) VALUES
(1, 'Chinois', 'Les saveurs asiatiques prÃ©s de chez vous', 'drapeau-chine.jpg'),
(2, 'Mexicain', 'Ayaya, Caramba !', 'mexique_drapeau.png'),
(3, 'Japonais', 'Les livraisons, cela ne pose pas de sushi.', 'japon_drapeau.jpg'),
(4, 'Pizza', 'Une catÃ©gorie a part (!) entiÃ¨re. ', 'drapeau_italie.jpg'),
(5, 'Indien', 'Cuisine Indienne et pakistanaise.', 'inde_drapeau.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo_user` varchar(70) NOT NULL,
  `password_user` text NOT NULL,
  `email_user` varchar(500) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `pseudo_user` (`pseudo_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo_user`, `password_user`, `email_user`) VALUES
(6, 'Kaced', 'jrpV1vNslhTcI6nP1P1j5umwam/Wym2d8/3lETvaab7nFjp5d7Ta7XUndYRVV/V221m5+aF5g+0bndR3R8KZTQ==', 'a@a.a'),
(7, 'dftgyhuj', 'oQ8oXrCS3bwJkb4YopSFElJemq/aSufs1h3z+oamnEtRO6jaJFbXwUfBKUCOqo+6R7C3i6Zrdzg8sOz+7Dvvaw==', 'a@a.a'),
(8, 'hgjkp', 'fxjpRKYMsGd7pXnEwW/k5HLM3UdPvczuRwX9JLEyhUPJ6KRVqWq9sEaphOjFOowGDUvmJqh7BKK2YeMC/PXusg==', 'a@a.a'),
(9, 'hgjkpz', 'R92mKulmHsPiUzeKPLg9tdnCBEEwqBdPK8XKI3bSmSSCWF491goZfZJlQ5DUXDxz08tjeo2IppB8Pl1vTM4bPg==', 'a@a.a'),
(10, 'fgyhjkl', 'zCD8g5M8VirqDQtOxAoejcCgDSf8eNF/ALahyjq6K1Hsbhac18GuM0ZQBFtGKejn86KoPGwE+XVBKZyD/4wjRw==', 'a@a.a');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_plat`) REFERENCES `plat` (`id_plat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `favplat`
--
ALTER TABLE `favplat`
  ADD CONSTRAINT `favplat_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favplat_ibfk_1` FOREIGN KEY (`id_plat`) REFERENCES `plat` (`id_plat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `favresto`
--
ALTER TABLE `favresto`
  ADD CONSTRAINT `favresto_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favresto_ibfk_1` FOREIGN KEY (`id_resto`) REFERENCES `restaurant` (`id_resto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`id_plat`) REFERENCES `plat` (`id_plat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `plat`
--
ALTER TABLE `plat`
  ADD CONSTRAINT `resto_plat` FOREIGN KEY (`id_resto`) REFERENCES `restaurant` (`id_resto`);

--
-- Contraintes pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `resto_theme` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id_theme`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;