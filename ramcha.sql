-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2022 at 11:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ramcha`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `idArticle` int(11) NOT NULL,
  `nomArticle` varchar(255) DEFAULT NULL,
  `marqueArticle` varchar(255) DEFAULT NULL,
  `typeArticle` varchar(255) DEFAULT NULL,
  `disponibiliteArticle` varchar(255) DEFAULT NULL,
  `couleurArticle` varchar(255) DEFAULT NULL,
  `prixArticle` float DEFAULT NULL,
  `tailleArticle` varchar(255) DEFAULT NULL,
  `descriptionArticle` mediumtext DEFAULT NULL,
  `screenshot` varchar(255) DEFAULT NULL,
  `IdidMagasin` int(11) DEFAULT NULL,
  `idCategorieArticle` int(11) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `magasin` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`idArticle`, `nomArticle`, `marqueArticle`, `typeArticle`, `disponibiliteArticle`, `couleurArticle`, `prixArticle`, `tailleArticle`, `descriptionArticle`, `screenshot`, `IdidMagasin`, `idCategorieArticle`, `image_name`, `note`, `magasin`, `categorie`) VALUES
(114, 'Imprimante', 'Canon', 'Multifonction', 'disponible', 'Noir', 163.5, NULL, 'Une imprimante simple et abordable avec une connectivité intelligente.', NULL, NULL, NULL, '2-63999f08d146e226013054.jpg', NULL, 'Carrefour', 'Informatique'),
(115, 'vivobook', 'Asus', 'Pc portable', 'disponible', 'Silver', 1299, '14\" HD', 'Processeur: Intel Core i3-10110U (2,10 GHz up to 4.10 GHz Turbo max, 4 Mo de mémoire cache, Dual-Cor', NULL, NULL, NULL, '1-63999f6c98218136082676.jpg', NULL, 'Mytek', 'Informatique'),
(116, 'Sweat', 'Heni', 'Capuche', 'disponible', 'Blanc', 39.9, 'S  M  L  XL  XXL', 'Capuche  de couleur  Noir à manches longues.Les sweats à capuche sont parfaits pour un look urbain .', NULL, NULL, NULL, '1-1-63999fd8418b7701090543.jpg', NULL, 'HENI_Collection', 'Mode'),
(117, 'Doudoune', 'Heni', 'imperméable', 'disponible', 'Noir', 29.9, 'M  L  XL  XXL', 'Idéale pour tenir au chaud entre deux saisons, voire durant l\'hiver, elle vous procure un confort in', NULL, NULL, NULL, '1-2-6399a023bace8134346182.jpg', NULL, 'HENI_Collection', 'Mode'),
(118, 'Tablette', 'Lenovo', 'Full Hd Plus', 'disponible', 'Grey', 769, '10.3\"', 'La Tab M10 TB-X606 Full HD dispose d’un écran impressionnant de 26,2 cm (10,3\") à grand angle de vis', NULL, NULL, NULL, '1-3-6399a0567ef38722648201.jpg', NULL, 'Mytek', 'Téléphone_Tablette'),
(119, 'Galaxy A03', 'Samsung', 'Smartphones', 'disponible', 'Bleu', 428.99, '6.5\"', 'Le Samsung Galaxy A03 Core (SM-A032F/DS) est un bon portable Android avec processeur de 1.6GHz', NULL, NULL, NULL, '2-1-6399a09d5cf8f737024232.jpg', NULL, 'Mytek', 'Téléphone_Tablette'),
(120, 'Eyeliner', 'Eveline', 'Waterproof', 'disponible', 'Ultra Black', 16.5, '7ml', 'Variete Eyeliner donne tout ce que vous avez toujours attendu d\'un eyeliner et peut-être même plus!', NULL, NULL, NULL, '1-4-6399a0dd80694710578161.jpg', NULL, 'Fatales', 'Santé_Beauté'),
(121, 'Maybelline', 'Fit Me', 'Fond de Teint', 'disponible', 'Matte', 29.99, '238', 'Fit Me, une formule en parfaite affinité avec votre peau. Une large gamme de teinte pour s\'accorder', NULL, NULL, NULL, '1-5-6399a11002faa285416071.jpg', NULL, 'Fatales', 'Santé_Beauté'),
(122, 'Jus', 'Monin', 'boisson', 'disponible', 'rouge', 29.58, '1L', 'Monin Purée lichi 1L   Ajoutez une touche rafraîchissante et exotique à vos boissons et desserts', NULL, NULL, NULL, 'jus.jpg', NULL, 'Monoprix', 'Produits_Alimentaires'),
(123, 'tribal', 'pensan', 'Pochette', 'disponible', 'multi', 9, '8', 'Feutre d\'\'écriture pointe superfine baguée métal en Forme triangulaire ergonomique', NULL, NULL, NULL, '1-8-6399a1c105206429988699.jpg', NULL, 'Monoprix', 'Autres'),
(124, 'Prince', 'Prince', 'mini gâteau', 'disponible', 'chocolat', 20.5, '28 pièces', 'Une génoise moelleuse agrémentée d’un fin enrobage au bon goût de chocolat, pour savourer un joli mo', NULL, NULL, NULL, '1-7-6399a1fe9dd6c772225958.jpg', NULL, 'Carrefour', 'Produits_Alimentaires'),
(125, 'testsym', 'testsym', 'testsym', 'disponible', 'jaune', 1, 'small', 'testcvfd', NULL, NULL, NULL, '2373655-bonne-fille-arrosage-plantes-gratuit-vectoriel-639ae84ca34a7110521981.jpg', NULL, 'Monoprix', 'Produits_Alimentaires');

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `idAvis` int(11) NOT NULL,
  `detailAvisService` varchar(255) NOT NULL,
  `noteService` int(11) NOT NULL,
  `idArticle` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`idAvis`, `detailAvisService`, `noteService`, `idArticle`, `idUser`) VALUES
(4, 'bien bien', 4, 114, NULL),
(5, 'bnpopo', 1, 114, NULL),
(6, 'bnpopo', 5, 116, NULL),
(7, 'bnpopo', 1, 116, NULL),
(8, 'bien bien', 1, 116, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aviscours`
--

CREATE TABLE `aviscours` (
  `IdAvisCours` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aviscours`
--

INSERT INTO `aviscours` (`IdAvisCours`, `rate`, `idUtilisateur`, `commentaire`) VALUES
(10, 10, 5, 'not bad'),
(11, 12, 5, 'moyen');

-- --------------------------------------------------------

--
-- Table structure for table `categoriearticle`
--

CREATE TABLE `categoriearticle` (
  `idCategorie` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `discription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoriearticle`
--

INSERT INTO `categoriearticle` (`idCategorie`, `libelle`, `discription`) VALUES
(10, 'Informatique', 'Ramcha vous propose toute une panoplie d’ordinateur portable et de matériels informatique Tunisie au meilleur prix du marché. En effet, nous choisissons nos vendeurs avec précautions pour vous offrire le meilleur de ce qui se trouve en Tunisie .'),
(11, 'Produits_Alimentaires', 'Les produits alimentaires sont primordiaux et essentiels, ils font partie de nos besoins primaires, c\'est pourquoi nous ne pouvons pas nous en passer, et comme chacun le sait, nous devons faire régulièrement nos courses.'),
(12, 'Téléphone_Tablette', 'L\'apparition de la tablette à révolutionner le monde du multimédia, à la pointe de la technologie, elles nous ont permis d\'avoir une autre approche de l\'utilisation qu\'on pouvait faire d\'un ordinateur.'),
(13, 'Santé_Beauté', 'Il existe une multitude de produits de beauté et d\'hygiène sur le marché en , et ceux-ci ne s\'adresse pas seulement aux femmes, mais il y\'a de plus en plus de produits pour les hommes.'),
(14, 'Mode', 'La mode, et plus précisément la mode vestimentaire, désigne la manière de se vêtir, conformément au goût d\'une époque dans une région donnée.'),
(15, 'Autres', '...');

-- --------------------------------------------------------

--
-- Table structure for table `categorieservice`
--

CREATE TABLE `categorieservice` (
  `idCategorieService` int(11) NOT NULL,
  `nomCategorieService` varchar(255) NOT NULL,
  `descriptionCategorieService` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorieservice`
--

INSERT INTO `categorieservice` (`idCategorieService`, `nomCategorieService`, `descriptionCategorieService`) VALUES
(1, 'Travaux manuelles', 'Vos travaux à la maison, nous prenons soin d\'eux'),
(2, 'E-Shop', 'Achetez toutes vos fournitures, obtenez-les avec RAMCHA'),
(3, 'Garde d\'enfant', 'Faire garder tes enfants à domicile avec RAMCHA'),
(4, 'Ménage à domicile', 'Avec Ramcha , bénéficiez de l\'aide d\'un homme ou d\'une femme de ménage sans contraintes !');

-- --------------------------------------------------------

--
-- Table structure for table `chapitre`
--

CREATE TABLE `chapitre` (
  `IdChapitre` int(11) NOT NULL,
  `nomChapitre` varchar(255) NOT NULL,
  `langueChapitre` varchar(255) NOT NULL,
  `typeChapitre` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `idfirst_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapitre`
--

INSERT INTO `chapitre` (`IdChapitre`, `nomChapitre`, `langueChapitre`, `typeChapitre`, `image_name`, `idfirst_id`) VALUES
(4, 'Initiation', 'Francais', 'Vidéo', '2373655-bonne-fille-arrosage-plantes-gratuit-vectoriel-639a33714f673858312974.jpg', 6),
(6, 'Alimentation', 'Francais', 'PDF', '5520564-dessin-anime-d-une-baby-sitter-vectoriel-639a33cd87306333444074.jpg', 10),
(8, 'Symfony', 'Francais', 'aaaaaaaa', '5520564-dessin-anime-d-une-baby-sitter-vectoriel-639ae94e2ef02839639490.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `commandearticle`
--

CREATE TABLE `commandearticle` (
  `idCommande` int(11) NOT NULL,
  `modeLivraison` varchar(255) NOT NULL,
  `statusLivraison` varchar(255) NOT NULL,
  `dateCommande` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commandearticle`
--

INSERT INTO `commandearticle` (`idCommande`, `modeLivraison`, `statusLivraison`, `dateCommande`) VALUES
(2, 'Confirmation par télephone', 'En cours de livraison', '2022-12-14'),
(3, 'Confirmation par télephone', 'En cours de traitement', '2022-12-14'),
(4, 'Confirmation par télephone', 'En cours de traitement', '2022-12-14'),
(5, 'Confirmation par télephone', 'En cours de traitement', '2022-12-14'),
(6, 'A domicile', 'En cours de traitement', '2022-12-14'),
(7, 'A domicile', 'Deja traité', '2022-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `commandearticle_article_utilisateur`
--

CREATE TABLE `commandearticle_article_utilisateur` (
  `idCommande` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commandearticle_article_utilisateur`
--

INSERT INTO `commandearticle_article_utilisateur` (`idCommande`, `idArticle`, `idUtilisateur`) VALUES
(2, 118, 17),
(3, 118, 19),
(4, 118, 24),
(5, 119, 17),
(6, 119, 23),
(7, 115, 17);

-- --------------------------------------------------------

--
-- Table structure for table `commandeservice`
--

CREATE TABLE `commandeservice` (
  `idCommandeService` int(11) NOT NULL,
  `dateRequis` date NOT NULL,
  `dateCommandeService` date NOT NULL DEFAULT current_timestamp(),
  `statusCommande` varchar(255) NOT NULL,
  `nbjour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commandeservice`
--

INSERT INTO `commandeservice` (`idCommandeService`, `dateRequis`, `dateCommandeService`, `statusCommande`, `nbjour`) VALUES
(1, '2024-06-14', '2022-12-14', 'En cours de traitement', 2),
(2, '2024-06-14', '2022-12-14', 'En cours de traitement', 2),
(3, '2024-06-14', '2022-12-14', 'En cours de traitement', 4),
(4, '2022-12-30', '2022-12-15', 'Deja traité', 3);

-- --------------------------------------------------------

--
-- Table structure for table `commandeservice_service_utilisateur`
--

CREATE TABLE `commandeservice_service_utilisateur` (
  `idService` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idCommandeService` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commandeservice_service_utilisateur`
--

INSERT INTO `commandeservice_service_utilisateur` (`idService`, `idUtilisateur`, `idCommandeService`) VALUES
(1, 17, 4),
(2, 17, 1),
(2, 17, 3),
(2, 21, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cours_chapitre`
--

CREATE TABLE `cours_chapitre` (
  `IdCours` int(11) NOT NULL,
  `IdChapitre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cours_chapitre`
--

INSERT INTO `cours_chapitre` (`IdCours`, `IdChapitre`) VALUES
(6, 4),
(13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cours_first`
--

CREATE TABLE `cours_first` (
  `Idfirst` int(11) NOT NULL,
  `nomCours` varchar(255) NOT NULL,
  `categoriecours` varchar(255) NOT NULL,
  `sujetcours` varchar(255) NOT NULL,
  `niveaucours` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cours_first`
--

INSERT INTO `cours_first` (`Idfirst`, `nomCours`, `categoriecours`, `sujetcours`, `niveaucours`, `image_name`) VALUES
(6, 'Jardinage', 'plante', 'arrosage plante', 'Debutant', '2373655-bonne-fille-arrosage-plantes-gratuit-vectoriel-639a2d3452b2c525578725.jpg'),
(8, 'Peinture', 'Bricolage', 'peinture', 'Expert', 'comment-peindre-bande-peinture-639a2d7dc7ca5784196782.jpg'),
(9, 'Ménage', 'Ménage', 'Ménage', 'Debutant', '1945374-menage-couple-travailleurs-avec-aspirateur-appareils-vectoriel-639a2dbb21412811966757.jpg'),
(10, 'Enfants', 'baby sitting', 'bebes', 'Debutant', '5520564-dessin-anime-d-une-baby-sitter-vectoriel-639a2e0127dfe070077229.jpg'),
(12, 'Electricite', 'Bricolage', 'prises', 'Debutant', 'shutterstock-133467950-e1518528837441-400x400-639a2e42cec0d267560827.jpg'),
(13, 'Porte', 'Menuisier', 'Menuisier', 'Debutant', 'menuisier-639a2e760d0f3458568717.jpg'),
(14, 'test', 'test', 'test', 'test', '1945374-menage-couple-travailleurs-avec-aspirateur-appareils-vectoriel-639ae904d0438640193862.jpg'),
(15, 'java', 'Travaux manuelles', 'java', 'Level 2', 'shutterstock-133467950-e1518528837441-400x400-639ae9e400780861775500.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `devis`
--

CREATE TABLE `devis` (
  `idDevis` int(11) NOT NULL,
  `dateDevis` date NOT NULL DEFAULT current_timestamp(),
  `totalHT` float NOT NULL,
  `total` float NOT NULL,
  `idCommande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `devisservice`
--

CREATE TABLE `devisservice` (
  `idDevisService` int(11) NOT NULL,
  `dateDevis` date NOT NULL DEFAULT current_timestamp(),
  `total` float NOT NULL,
  `idCommandeSevice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `idFacture` int(11) NOT NULL,
  `dateFacture` date NOT NULL DEFAULT current_timestamp(),
  `facturePDF` varchar(255) DEFAULT NULL,
  `idDevis` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`idFacture`, `dateFacture`, `facturePDF`, `idDevis`, `idCommande`, `total`) VALUES
(1, '2022-12-14', '2641640772', 16, 2, 807.45),
(2, '2022-12-14', '6422515610', 16, 3, 807.45),
(3, '2022-12-14', '8621352563', 16, 4, 807.45),
(4, '2022-12-14', '7861407950', 16, 5, 450.44),
(5, '2022-12-14', '98767782', 16, 6, 450.44);

-- --------------------------------------------------------

--
-- Table structure for table `factureservice`
--

CREATE TABLE `factureservice` (
  `idFactureService` int(11) NOT NULL,
  `factureServicePDF` varchar(255) NOT NULL,
  `dateFacture` date NOT NULL DEFAULT current_timestamp(),
  `idCommandeService` int(11) NOT NULL,
  `idDevisService` int(11) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `factureservice`
--

INSERT INTO `factureservice` (`idFactureService`, `factureServicePDF`, `dateFacture`, `idCommandeService`, `idDevisService`, `total`) VALUES
(1, '6007711177', '2022-12-14', 1, 2, 246),
(2, '2191200504', '2022-12-14', 2, 2, 246),
(3, '223127761', '2022-12-14', 3, 2, 492),
(4, '3357677986', '2022-12-15', 3, 2, 492),
(5, '9386485874', '2022-12-15', 4, 1, 360);

-- --------------------------------------------------------

--
-- Table structure for table `magasin`
--

CREATE TABLE `magasin` (
  `IdMagasin` int(11) NOT NULL,
  `nomMagasin` varchar(255) DEFAULT NULL,
  `adresseMagasin` varchar(255) DEFAULT NULL,
  `emailMagasin` varchar(255) DEFAULT NULL,
  `telMagasin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `magasin`
--

INSERT INTO `magasin` (`IdMagasin`, `nomMagasin`, `adresseMagasin`, `emailMagasin`, `telMagasin`) VALUES
(11, 'Carrefour', 'Tunis', 'contact@carrefour.tn', 70248248),
(12, 'Monoprix', 'Bizerte', 'contact@monoprix.tn', 80103456),
(13, 'Fatales', 'tunis', 'contact@fatales.com', 70130840),
(14, 'HENI_Collection', 'bizerte', 'HENI@collection.com', 23151152),
(15, 'Mytek', 'charguia', 'info@mytek.tn', 36010010);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reclamation`
--

CREATE TABLE `reclamation` (
  `idReclamation` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `screenshot` varchar(255) NOT NULL,
  `numero_mobile` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `date_traitement` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `nomServcie` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reclamation`
--

INSERT INTO `reclamation` (`idReclamation`, `nom`, `prenom`, `email`, `screenshot`, `numero_mobile`, `date_creation`, `date_traitement`, `description`, `status`, `nomServcie`, `image_name`) VALUES
(34, 'Zitoun', 'Achref', 'achref@gmail.com', 'dddd', 56575859, '2017-01-01', '2017-01-01', 'je reclame le service livraison', 'Non traitée', 'Shopping', 'en-retard-639a1ef819fa9356302704.png'),
(35, 'chalghoumi', 'kais', 'kais@esprit.tn', 'dddd', 56565757, '2017-01-01', '2017-01-01', 'pas de nouveaux plantes', 'Non traitée', 'Jardinage', '21v-66bb6a3167924c025b4981611e6ef02db6cb6440419e52390d1de3942f5356b5-6399f97355fc6805818438-639a214063734369014385.png'),
(38, 'chalghoumi', 'kais', 'kais@esprit.tn', '', 56565656, '0000-00-00', '0000-00-00', 'pas de nouveaux plantes', '', 'jardinage', '21v-66bb6a3167924c025b4981611e6ef02db6cb6440419e52390d1de3942f5356b5-6399f97355fc6805818438-639a218024cec025443444.png'),
(40, 'Zitoun', 'Achref', 'achref@gmail.com', '', 56565656, '0000-00-00', '0000-00-00', 'je reclame le service de bricolage', '', 'Bricolage', 'lentrepot-du-bricolage-reclamation-639a286531302506063060.jpg'),
(41, 'test', 'test', 'test@test.cv', '', 22222222, '0000-00-00', '0000-00-00', 'grhgdfhdfh', '', 'jardinage', 'menuisier-639aeb4646a1f391634512.jpg'),
(42, 'sgsdg', 'sdgds', 'achref@gmail.com', 'file:/C:/Users/chalg/Downloads/1945374-menage-couple-travailleurs-avec-aspirateur-appareils-vectoriel.jpg', 33223322, '2022-02-15', '2022-02-25', 'bfdxvFDXBDFgv', 'Non traité', 'Jardinage', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE `reponse` (
  `idReponse` int(11) NOT NULL,
  `Text` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `idReclamation` int(11) NOT NULL,
  `daterep` date NOT NULL,
  `prenom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`idReponse`, `Text`, `status`, `idReclamation`, `daterep`, `prenom`) VALUES
(41, 'votre reclamation est en cours de traitement !!!', NULL, 40, '2022-12-14', 'admin'),
(42, 'merci d\'ajouter plus d\'informations SVP', NULL, 40, '2022-12-14', 'admin'),
(43, 'l\'ouvrier n\'est pas ponctuel !!!', NULL, 40, '2022-12-14', 'Achref'),
(44, 'fjdshfkdsfldslfmds', NULL, 40, '2022-12-15', 'Achref'),
(45, 'en cours edeerz', NULL, 40, '2022-12-15', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `idService` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `nomService` varchar(255) NOT NULL,
  `nbreOuvrier` int(11) DEFAULT NULL,
  `prixService` float NOT NULL,
  `descriptionService` text DEFAULT NULL,
  `dateDebutService` date DEFAULT NULL,
  `dateFinService` date DEFAULT NULL,
  `disponibiliteService` varchar(255) DEFAULT NULL,
  `idCategorieService` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`idService`, `image_name`, `nomService`, `nbreOuvrier`, `prixService`, `descriptionService`, `dateDebutService`, `dateFinService`, `disponibiliteService`, `idCategorieService`) VALUES
(1, '21v-66bb6a3167924c025b4981611e6ef02db6cb6440419e52390d1de3942f5356b5-6399f97355fc6805818438.png', 'Jardinage', 4, 120, 'Réservez vos services de jardinage ponctuels ou récurrents', '2022-01-01', '2025-01-01', 'Disponible', 1),
(2, '20v-4ef73a5957354b4ddaa03b95915c5f75386c19991db01d2373e84865d11d8684-6399f9c93184c889579785.png', 'Bricolage', 5, 123, 'Réservez vos services de bricolage et de petits travaux', '2022-01-01', '2025-01-01', 'Disponible', 1),
(3, 'ddd-6399fa29b4e62659236399.png', 'Déménagement', 2, 120, 'Réservez des pros ou des gros bras pour votre déménagement', '2022-01-01', '2023-01-01', 'Disponible', 1),
(4, '23v-e4720078d40da7d5df6bb7d5a61f742186f5f67aaac4cf03548eeddf1b5687db-6399fac2d8776310303348.png', 'Ménage', 4, 120, 'Réservez vos services de ménage ponctuels ou récurrents', '2022-01-01', '2024-01-01', 'Disponible', 4),
(5, 'arezrez.png', 'Enfants', 2, 123, 'Découvrez tous nos services de baby sitting', '2022-01-01', '2026-01-01', 'Découvrez tou', 3),
(6, 'aze-6399fc3dd6921897699083.png', 'Shopping', 2, 12, 'Réservez des services d’aide à domicile pour vous ou vos proches', '2022-01-01', '2025-01-01', 'Disponible', 2),
(7, NULL, 'test', 1, 12, 'test', '2023-01-06', '2023-01-29', 'null', 1),
(8, 'menuisier-639ae80827909718272432.jpg', 'testok', 1, 12, 'testok', '2023-01-06', '2023-01-29', 'Disponible', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUser` int(11) NOT NULL,
  `nomUser` varchar(255) NOT NULL,
  `prenomUser` varchar(255) NOT NULL,
  `adressUser` varchar(255) NOT NULL,
  `passwUser` varchar(255) NOT NULL,
  `numUser` varchar(255) NOT NULL,
  `ddnUser` date NOT NULL,
  `codePostalUser` int(11) NOT NULL,
  `cinUser` varchar(255) NOT NULL,
  `loginUser` varchar(255) NOT NULL,
  `libelleDemande` varchar(255) DEFAULT NULL,
  `dispoP` varchar(255) DEFAULT NULL,
  `experP` varchar(255) DEFAULT NULL,
  `diplomeP` varchar(255) DEFAULT NULL,
  `posteP` varchar(255) DEFAULT NULL,
  `salaireP` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user',
  `image_name` varchar(255) DEFAULT NULL,
  `verify` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUser`, `nomUser`, `prenomUser`, `adressUser`, `passwUser`, `numUser`, `ddnUser`, `codePostalUser`, `cinUser`, `loginUser`, `libelleDemande`, `dispoP`, `experP`, `diplomeP`, `posteP`, `salaireP`, `role`, `image_name`, `verify`) VALUES
(17, 'Zitoun', 'Achref', 'Ben arus', '$2y$13$JqKrXYfV4RPl7K4BKgbVXumtsd3A9Z7oLxrRLJBsp5JRxatD09RT.', '26977557', '1999-11-03', 7407, '07240679', 'achref@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'avatar-homme-brune-portrait-jeune-homme-illustration-vectorielle-visage-217290-1035-6390d07f26b6f804493933.webp', '408387683'),
(18, 'Chalghoumi', 'Kais', 'Marsa', '$2y$13$E78OIYJ6y3K/Gt1xRU1jZOtkU1cIN1rURiVs2fsbSoryiTfkd3m8e', '56181794', '1991-03-30', 2405, '07540076', 'kais@gmail.com', NULL, 'Non disponible', '2ans', 'Technicien', 'Sous-Responsable', '450', 'prestateur', 'avatar-homme-brune-portrait-jeune-homme-illustration-vectorielle-visage-217290-1035-6390d07f26b6f804493933.webp', NULL),
(19, 'Zioud', 'Chourouk', 'Bizerte', '$2y$13$aqzHv891g.bvJqN8C411HOZcqnynWB/15SDdeevdKLIIV1C6x7aAq', '51207280', '1999-05-02', 7080, '11422848', 'chourouk@gmail.com', NULL, 'Non disponible', '2ans', 'Technicien', 'Responsable', '400', 'prestateur', '1000-f-116244459-pywr1e0t3h7fpk3ltmjg6jsl3uchdpht-6390d30f301a1024595298.jpg', NULL),
(20, 'Tizaoui', 'Eya', 'Bizerte', '$2y$13$uFb2p3/tXuMQG9Z5mNqUU.vLEsDydpaMuc9v4g9cF4HL87RXoGGI6', '26789456', '1998-04-30', 7080, '11409908', 'eya@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '1000-f-116244459-pywr1e0t3h7fpk3ltmjg6jsl3uchdpht-6390d30f301a1024595298.jpg', '2436933548'),
(21, 'Bensoltane', 'Ghofrane', 'Hammem lif', '$2y$13$OAflf427wVdjdyIhfefEH.cAqKIUUVWoHZQ51l.nc/K6sH6MA3zp.', '55678543', '1998-10-17', 4580, '07986543', 'ghofrane@gmail.com', 'Produit', NULL, NULL, NULL, NULL, NULL, 'demandeur', '1000-f-116244459-pywr1e0t3h7fpk3ltmjg6jsl3uchdpht-6390d30f301a1024595298.jpg', NULL),
(22, 'Hadjkacem', 'Chaima', 'Mourouj', '$2y$13$Hj8drU8wpdQOhrYh3Zr.3.vSdwHqEG9j2Ow7rsxZu8U37loMuQNY.', '20542959', '2000-01-01', 7074, '07240005', 'chaima@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '1000-f-116244459-pywr1e0t3h7fpk3ltmjg6jsl3uchdpht-6390d30f301a1024595298.jpg', '1757136725'),
(23, 'Hajji', 'Rany', 'Sfax', '$2y$13$p4nkJ6HU11imsSC5JZ3xhe0mHXi3oM0PdLIdrE6hnrALsDN5nxFnG', '90876543', '1990-01-11', 9805, '07654321', 'ranya@gmail.com', NULL, 'Disponible', '1an', 'ouvrier', 'Ouvrier', '500', 'prestateur', '1000-f-116244459-pywr1e0t3h7fpk3ltmjg6jsl3uchdpht-6390d30f301a1024595298.jpg', NULL),
(24, 'Kaabi', 'Yacine', 'Klibia', '$2y$13$cnPPWs2MXFHmI/UfrB6/0uKduNwGdGgixwP023aO0329O66wHnX4a', '98765432', '1997-01-20', 8976, '11409876', 'yacine@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'avatar-homme-brune-portrait-jeune-homme-illustration-vectorielle-visage-217290-1035-6390d07f26b6f804493933.webp', '6184276876'),
(25, 'Taoui', 'Ahmed', 'Gabes', '$2y$13$MG901jk.zdXTcqPV/gpejOfyrs0Y9q5UIThlJ27zeic7ZK5jUYiYC', '98765432', '2001-01-15', 9879, '09876543', 'ahmed@gmail.com', 'Produit', NULL, NULL, NULL, NULL, NULL, 'demandeur', 'avatar-homme-brune-portrait-jeune-homme-illustration-vectorielle-visage-217290-1035-6390d07f26b6f804493933.webp', NULL),
(26, 'Hakim', 'Rasem', 'Mourouj', '$2y$13$e1tTTPdm8yLjxDbghqHqKOEHk5hc7NmBNH3YWlk.Y6QXzkSWRebeS', '23456789', '2004-12-21', 1234, '07987654', 'hakim@gmail.com', NULL, 'Non disponible', '2ans', 'Technicien', 'Sous-Responsable', '400', 'prestateur', 'avatar-homme-brune-portrait-jeune-homme-illustration-vectorielle-visage-217290-1035-6390d07f26b6f804493933.webp', NULL),
(27, 'Kaabi', 'Hazem', 'Mouroouj', '$2y$13$53d3UuYDmbRRpD0pByq37u7pwxEnZAOz2uvFHRn3whdTTHPtjePUu', '23456789', '1969-01-01', 4567, '09876544', 'kabi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'avatar-homme-brune-portrait-jeune-homme-illustration-vectorielle-visage-217290-1035-6390d07f26b6f804493933.webp', '8317234165'),
(29, 'ahmed', 'ahmed', 'Marsa', '$2y$13$RqJmaTlNuQQIVAyW5z83lOhbAaHIgTB7zi8D.zILsFnO6TVq/1/66', '98763332', '2004-01-01', 2222, '12121212', 'ahmedddd@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '5520564-dessin-anime-d-une-baby-sitter-vectoriel-639ae78277c8c140712500.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `article_ibfk_1` (`IdidMagasin`),
  ADD KEY `article_ibfk_2` (`idCategorieArticle`);

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`idAvis`);

--
-- Indexes for table `aviscours`
--
ALTER TABLE `aviscours`
  ADD PRIMARY KEY (`IdAvisCours`);

--
-- Indexes for table `categoriearticle`
--
ALTER TABLE `categoriearticle`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Indexes for table `categorieservice`
--
ALTER TABLE `categorieservice`
  ADD PRIMARY KEY (`idCategorieService`);

--
-- Indexes for table `chapitre`
--
ALTER TABLE `chapitre`
  ADD PRIMARY KEY (`IdChapitre`);

--
-- Indexes for table `commandearticle`
--
ALTER TABLE `commandearticle`
  ADD PRIMARY KEY (`idCommande`);

--
-- Indexes for table `commandearticle_article_utilisateur`
--
ALTER TABLE `commandearticle_article_utilisateur`
  ADD PRIMARY KEY (`idCommande`,`idArticle`,`idUtilisateur`),
  ADD KEY `commandearticle_article_utilisateur_ibfk_3` (`idUtilisateur`),
  ADD KEY `commandearticle_article_utilisateur_ibfk_4` (`idArticle`),
  ADD KEY `commandearticle_article_utilisateur_ibfk_2` (`idCommande`);

--
-- Indexes for table `commandeservice`
--
ALTER TABLE `commandeservice`
  ADD PRIMARY KEY (`idCommandeService`);

--
-- Indexes for table `commandeservice_service_utilisateur`
--
ALTER TABLE `commandeservice_service_utilisateur`
  ADD PRIMARY KEY (`idService`,`idUtilisateur`,`idCommandeService`),
  ADD KEY `commandeservice_service_utilisateur_ibfk_3` (`idUtilisateur`),
  ADD KEY `idService` (`idService`),
  ADD KEY `idCommandeService` (`idCommandeService`);

--
-- Indexes for table `cours_chapitre`
--
ALTER TABLE `cours_chapitre`
  ADD PRIMARY KEY (`IdCours`,`IdChapitre`),
  ADD KEY `IdChapitre` (`IdChapitre`);

--
-- Indexes for table `cours_first`
--
ALTER TABLE `cours_first`
  ADD PRIMARY KEY (`Idfirst`);

--
-- Indexes for table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`idDevis`);

--
-- Indexes for table `devisservice`
--
ALTER TABLE `devisservice`
  ADD PRIMARY KEY (`idDevisService`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`idFacture`);

--
-- Indexes for table `factureservice`
--
ALTER TABLE `factureservice`
  ADD PRIMARY KEY (`idFactureService`);

--
-- Indexes for table `magasin`
--
ALTER TABLE `magasin`
  ADD PRIMARY KEY (`IdMagasin`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`idReclamation`);

--
-- Indexes for table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`idReponse`),
  ADD KEY `reponse_ibfk_1` (`idReclamation`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idService`),
  ADD KEY `3zedr3tyhuj` (`idCategorieService`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `idAvis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `aviscours`
--
ALTER TABLE `aviscours`
  MODIFY `IdAvisCours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categoriearticle`
--
ALTER TABLE `categoriearticle`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categorieservice`
--
ALTER TABLE `categorieservice`
  MODIFY `idCategorieService` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chapitre`
--
ALTER TABLE `chapitre`
  MODIFY `IdChapitre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `commandearticle`
--
ALTER TABLE `commandearticle`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `commandeservice`
--
ALTER TABLE `commandeservice`
  MODIFY `idCommandeService` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cours_first`
--
ALTER TABLE `cours_first`
  MODIFY `Idfirst` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `devis`
--
ALTER TABLE `devis`
  MODIFY `idDevis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `devisservice`
--
ALTER TABLE `devisservice`
  MODIFY `idDevisService` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `idFacture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `factureservice`
--
ALTER TABLE `factureservice`
  MODIFY `idFactureService` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `magasin`
--
ALTER TABLE `magasin`
  MODIFY `IdMagasin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `idReclamation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `idReponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `idService` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`IdidMagasin`) REFERENCES `magasin` (`IdMagasin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`idCategorieArticle`) REFERENCES `categoriearticle` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commandearticle_article_utilisateur`
--
ALTER TABLE `commandearticle_article_utilisateur`
  ADD CONSTRAINT `commandearticle_article_utilisateur_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commandearticle` (`idCommande`) ON UPDATE CASCADE,
  ADD CONSTRAINT `commandearticle_article_utilisateur_ibfk_3` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commandearticle_article_utilisateur_ibfk_4` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commandeservice_service_utilisateur`
--
ALTER TABLE `commandeservice_service_utilisateur`
  ADD CONSTRAINT `commandeservice_service_utilisateur_ibfk_3` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commandeservice_service_utilisateur_ibfk_4` FOREIGN KEY (`idCommandeService`) REFERENCES `commandeservice` (`idCommandeService`),
  ADD CONSTRAINT `commandeservice_service_utilisateur_ibfk_5` FOREIGN KEY (`idService`) REFERENCES `service` (`idService`);

--
-- Constraints for table `cours_chapitre`
--
ALTER TABLE `cours_chapitre`
  ADD CONSTRAINT `cours_chapitre_ibfk_1` FOREIGN KEY (`IdChapitre`) REFERENCES `chapitre` (`IdChapitre`),
  ADD CONSTRAINT `cours_chapitre_ibfk_2` FOREIGN KEY (`IdCours`) REFERENCES `cours_first` (`Idfirst`);

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`idReclamation`) REFERENCES `reclamation` (`idReclamation`) ON DELETE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `cvxcvc` FOREIGN KEY (`idCategorieService`) REFERENCES `categorieservice` (`idCategorieService`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
