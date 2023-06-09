-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 15 juin 2023 à 17:47
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(30) NOT NULL,
  `acc_surname` varchar(30) NOT NULL,
  `acc_address` varchar(120) NOT NULL,
  `acc_addressbox` int(11) DEFAULT NULL,
  `acc_city` varchar(20) NOT NULL,
  `acc_codepostal` mediumint(9) NOT NULL,
  `acc_id_country` int(11) NOT NULL,
  `acc_phone` varchar(20) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_password` varchar(128) NOT NULL,
  `acc_code_activation` varchar(32) NOT NULL,
  `acc_admin` tinyint(1) NOT NULL,
  `acc_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`acc_id`, `acc_name`, `acc_surname`, `acc_address`, `acc_addressbox`, `acc_city`, `acc_codepostal`, `acc_id_country`, `acc_phone`, `acc_email`, `acc_password`, `acc_code_activation`, `acc_admin`, `acc_active`) VALUES
(1, 'TEST', 'Admin', 'Rue du Paradis', 3, 'Bruxelles', 0, 25, '+32496112233', 'admin@admin.be', '966602fd329284404b6b297914a16478f736207e5690c0ac4e5cba726e9c49350156f0d95cf54ce28ec194684d79c9a5497b841818695f071e01ac0b466619b2', 'e9d8e487b5827a0f8e7eb70a06b0ebf2', 1, 1),
(2, '1', 'Client', 'Rue du Palais 4', 0, 'Bruxelles', 1000, 25, '+32496359742', 'client@client.be', '966602fd329284404b6b297914a16478f736207e5690c0ac4e5cba726e9c49350156f0d95cf54ce28ec194684d79c9a5497b841818695f071e01ac0b466619b2', 'a9064fd0dbdaf71e45b32e966c1ef29a', 0, 1),
(3, '2', 'Client', 'Rue du Palais 4', 0, 'Bruxelles', 1100, 25, '+32496359742', 'client2@client.be', '966602fd329284404b6b297914a16478f736207e5690c0ac4e5cba726e9c49350156f0d95cf54ce28ec194684d79c9a5497b841818695f071e01ac0b466619b2', '88b0288f166198cee5163e9d5ba53320', 0, 1),
(4, '3', 'Client', 'Rue du Paradis', 0, 'Bruxelles', 1000, 25, '+32496359742', 'client3@client.be', '966602fd329284404b6b297914a16478f736207e5690c0ac4e5cba726e9c49350156f0d95cf54ce28ec194684d79c9a5497b841818695f071e01ac0b466619b2', '3695e272f4cfb6b28b19387c04b10aec', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `bedroom`
--

CREATE TABLE `bedroom` (
  `bedroom_id` int(11) NOT NULL,
  `bedroom_name` varchar(40) NOT NULL,
  `bedroom_description` text NOT NULL,
  `bedroom_bed` enum('double','twin','single') NOT NULL,
  `bedroom_priceday` int(11) NOT NULL,
  `id_roomcategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bedroom`
--

INSERT INTO `bedroom` (`bedroom_id`, `bedroom_name`, `bedroom_description`, `bedroom_bed`, `bedroom_priceday`, `id_roomcategory`) VALUES
(1, 'Chambre Confort Printemps', 'Splendide chambre de 26 m² donnant sur une grande terrasse privative couverte pour profiter, en toute tranquillité, de votre séjour chez nous! </br>\r\nComme son nom l’indique, le confort est au rendez-vous ! La chambre est équipée d’un lit king size (180 x 200) avec literie haut de gamme, d’un mini-bar, d’un coffre-fort, d’une tv connectée, d’une douche italienne, …</br>\r\nVotre bien-être, notre priorité! Des peignoirs et chaussons seront gratuitement mis à disposition. Un plateau de courtoisie ainsi qu’une capsule Skinjay vous seront gracieusement offerts. </br>\r\nL’originalité de notre chambre confort « Printemps »? Un aménagement et une décoration aux essences de bois de platane vous emmenant au coeur d’une nature qui s’éveille.</br>\r\nLa chambre « Printemps » peut être communicante avec la chambre été.\r\n\r\n                                                                                     ', 'double', 180, 1),
(2, 'Chambre confort Soleil', 'Splendide chambre de 26 m² donnant sur une grande terrasse privative couverte pour profiter, en toute tranquillité, de votre séjour chez nous! </br>\r\nComme son nom l’indique, le confort est au rendez-vous ! La chambre est équipée d’un lit king size (180 x 200) avec literie haut de gamme, d’un mini-bar, d’un coffre-fort, d’une tv connectée, d’une douche italienne, …</br>\r\n\r\nVotre bien-être, notre priorité! Des peignoirs et chaussons seront gratuitement mis à disposition. Un plateau de courtoisie ainsi qu’une capsule Skinjay vous seront gracieusement offerts. </br>\r\n\r\nL’originalité de notre chambre confort été ? Un aménagement et une décoration aux essences de bois d’acacia apportant toute la fraîcheur et la délicatesse pour un séjour lumineux et ressourçant. </br>\r\n\r\nLa chambre « été » peut être communicante avec la chambre « printemps« .</br>', 'double', 190, 1),
(3, 'Chambre confort Hiver', 'Splendide chambre de 26 m² donnant sur une grande terrasse privative couverte pour profiter, en toute tranquillité, de votre séjour chez nous! </br>\r\nComme son nom l’indique, le confort est au rendez-vous ! La chambre est équipée d’un lit king size (180 x 200) avec literie haut de gamme, d’un mini-bar, d’un coffre-fort, d’une tv connectée, d’une douche italienne, …</br>\r\n\r\nVotre bien-être, notre priorité! Des peignoirs et chaussons seront gratuitement mis à disposition. Un plateau de courtoisie ainsi qu’une capsule Skinjay vous seront gracieusement offerts.</br>\r\n\r\nL’originalité de notre chambre confort « Hiver »? Un aménagement et une décoration aux essences de bois de mélèze vous procurant tout le réconfort et la chaleur pour des moments cocoon à deux. </br>', 'double', 190, 1),
(4, 'Deluxe Automne (avec Jacuzzi)', 'La Suite est équipée d’un lit king size (200 x 200) avec literie haut de gamme, d’un canapé, d’un mini-bar, d’un coffre-fort, d’une tv connectée, d’une douche italienne, d’une baignoire (faisant face à une télévision) ainsi que d’un évier double vasques …</br>\r\n\r\nVotre bien-être, notre priorité! Des peignoirs et chaussons seront gratuitement mis à disposition. Un plateau de courtoisie ainsi qu’une capsule Skinjay vous seront gracieusement offerts en plus d’autres attentions surprises !</br>\r\n\r\nVous auriez la possibilitée de vous relaxer dans le Jacuzzi qui sera disponible sur votre terrasse.\r\nL’originalité de notre Suite? Un aménagement et une décoration aux essences de bois de chêne apportant tout le luxe pour un séjour plus que réussi !</br>', 'double', 300, 2),
(5, 'La Suite «Vilvadi» (avec Jacuzzi)', 'La Suite est équipée d’un lit king size (200 x 200) avec literie haut de gamme, d’un canapé, d’un mini-bar, d’un coffre-fort, d’une tv connectée, d’une douche italienne, d’une baignoire (faisant face à une télévision) ainsi que d’un évier double vasques …</br>\r\n\r\nVotre bien-être, notre priorité! Des peignoirs et chaussons seront gratuitement mis à disposition. Un plateau de courtoisie ainsi qu’une capsule Skinjay vous seront gracieusement offerts en plus d’autres attentions surprises !</br>\r\n\r\nL’originalité de notre Suite? Un aménagement et une décoration aux essences de bois de chêne apportant tout le luxe pour un séjour plus que réussi !</br>\r\n\r\n', 'double', 300, 4);

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `id_bedroom` int(11) NOT NULL,
  `id_acc` int(11) NOT NULL,
  `cus_gender` varchar(2) NOT NULL,
  `booking_date_begin` date NOT NULL,
  `booking_arrival_time` time NOT NULL,
  `booking_date_end` date NOT NULL,
  `booking_price_total` float NOT NULL,
  `booking_comments` text NOT NULL,
  `cus_name` varchar(30) NOT NULL,
  `cus_surname` varchar(30) NOT NULL,
  `cus_address` varchar(120) NOT NULL,
  `cus_addressbox` varchar(10) DEFAULT NULL,
  `cus_city` varchar(20) NOT NULL,
  `cus_codepostal` mediumint(9) NOT NULL,
  `cus_id_country` int(11) NOT NULL,
  `cus_phone` varchar(20) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `booking_cancelation` tinyint(1) NOT NULL DEFAULT 0,
  `booking_validation` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `category_bedroom`
--

CREATE TABLE `category_bedroom` (
  `roomcategory_id` int(11) NOT NULL,
  `roomcategory_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category_bedroom`
--

INSERT INTO `category_bedroom` (`roomcategory_id`, `roomcategory_name`) VALUES
(1, 'Chambre Standard'),
(2, 'Chambre Supérieure'),
(3, 'Suite Deluxe'),
(4, 'Suite Haut-niveau');

-- --------------------------------------------------------

--
-- Structure de la table `category_restaurant`
--

CREATE TABLE `category_restaurant` (
  `restocategory_id` int(11) NOT NULL,
  `restocategory_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category_restaurant`
--

INSERT INTO `category_restaurant` (`restocategory_id`, `restocategory_name`) VALUES
(1, 'Entrées'),
(2, 'Plats (Viandes)'),
(3, 'Plats (Poissons)'),
(4, 'Desserts'),
(5, 'Boissons Alcoolisés'),
(6, 'Boissons Chaudes'),
(7, 'Boissons Froides');

-- --------------------------------------------------------

--
-- Structure de la table `category_spa`
--

CREATE TABLE `category_spa` (
  `spacategory_id` int(11) NOT NULL,
  `spacategory_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category_spa`
--

INSERT INTO `category_spa` (`spacategory_id`, `spacategory_name`) VALUES
(1, 'Massages'),
(2, 'Soins du visage'),
(3, 'Soins du corps'),
(4, 'Soins des mains et des pieds'),
(5, 'Autres soins');

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `country_fr` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `country_en` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`country_id`, `country_code`, `country_fr`, `country_en`) VALUES
(1, 'AF', 'Afghanistan', 'Afghanistan'),
(2, 'ZA', 'Afrique du Sud', 'South Africa'),
(3, 'AL', 'Albanie', 'Albania'),
(4, 'DZ', 'Algérie', 'Algeria'),
(5, 'DE', 'Allemagne', 'Germany'),
(6, 'AD', 'Andorre', 'Andorra'),
(7, 'AO', 'Angola', 'Angola'),
(8, 'AI', 'Anguilla', 'Anguilla'),
(9, 'AQ', 'Antarctique', 'Antarctica'),
(10, 'AG', 'Antigua-et-Barbuda', 'Antigua & Barbuda'),
(11, 'AN', 'Antilles néerlandaises', 'Netherlands Antilles'),
(12, 'SA', 'Arabie saoudite', 'Saudi Arabia'),
(13, 'AR', 'Argentine', 'Argentina'),
(14, 'AM', 'Arménie', 'Armenia'),
(15, 'AW', 'Aruba', 'Aruba'),
(16, 'AU', 'Australie', 'Australia'),
(17, 'AT', 'Autriche', 'Austria'),
(18, 'AZ', 'Azerbaïdjan', 'Azerbaijan'),
(19, 'BJ', 'Bénin', 'Benin'),
(21, 'BH', 'Bahreïn', 'Bahrain'),
(22, 'BD', 'Bangladesh', 'Bangladesh'),
(23, 'BB', 'Barbade', 'Barbados'),
(24, 'PW', 'Belau', 'Palau'),
(25, 'BE', 'Belgique', 'Belgium'),
(26, 'BZ', 'Belize', 'Belize'),
(27, 'BM', 'Bermudes', 'Bermuda'),
(28, 'BT', 'Bhoutan', 'Bhutan'),
(29, 'BY', 'Biélorussie', 'Belarus'),
(30, 'MM', 'Birmanie', 'Myanmar (ex-Burma)'),
(31, 'BO', 'Bolivie', 'Bolivia'),
(32, 'BA', 'Bosnie-Herzégovine', 'Bosnia and Herzegovina'),
(33, 'BW', 'Botswana', 'Botswana'),
(34, 'BR', 'Brésil', 'Brazil'),
(35, 'BN', 'Brunei', 'Brunei Darussalam'),
(36, 'BG', 'Bulgarie', 'Bulgaria'),
(37, 'BF', 'Burkina Faso', 'Burkina Faso'),
(38, 'BI', 'Burundi', 'Burundi'),
(39, 'CI', 'Côte d\'Ivoire', 'Ivory Coast (see Cote d\'Ivoire)'),
(40, 'KH', 'Cambodge', 'Cambodia'),
(41, 'CM', 'Cameroun', 'Cameroon'),
(42, 'CA', 'Canada', 'Canada'),
(43, 'CV', 'Cap-Vert', 'Cape Verde'),
(44, 'CL', 'Chili', 'Chile'),
(45, 'CN', 'Chine', 'China'),
(46, 'CY', 'Chypre', 'Cyprus'),
(47, 'CO', 'Colombie', 'Colombia'),
(48, 'KM', 'Comores', 'Comoros'),
(49, 'CG', 'Congo', 'Congo'),
(50, 'KP', 'Corée du Nord', 'Korea, Demo. People\'s Rep. of'),
(51, 'KR', 'Corée du Sud', 'Korea, (South) Republic of'),
(52, 'CR', 'Costa Rica', 'Costa Rica'),
(53, 'HR', 'Croatie', 'Croatia'),
(54, 'CU', 'Cuba', 'Cuba'),
(55, 'DK', 'Danemark', 'Denmark'),
(56, 'DJ', 'Djibouti', 'Djibouti'),
(57, 'DM', 'Dominique', 'Dominica'),
(58, 'EG', 'Égypte', 'Egypt'),
(59, 'AE', 'Émirats arabes unis', 'United Arab Emirates'),
(60, 'EC', 'Équateur', 'Ecuador'),
(61, 'ER', 'Érythrée', 'Eritrea'),
(62, 'ES', 'Espagne', 'Spain'),
(63, 'EE', 'Estonie', 'Estonia'),
(64, 'US', 'États-Unis', 'United States'),
(65, 'ET', 'Éthiopie', 'Ethiopia'),
(66, 'FI', 'Finlande', 'Finland'),
(67, 'FR', 'France', 'France'),
(68, 'GE', 'Géorgie', 'Georgia'),
(69, 'GA', 'Gabon', 'Gabon'),
(70, 'GM', 'Gambie', 'Gambia, the'),
(71, 'GH', 'Ghana', 'Ghana'),
(72, 'GI', 'Gibraltar', 'Gibraltar'),
(73, 'GR', 'Grèce', 'Greece'),
(74, 'GD', 'Grenade', 'Grenada'),
(75, 'GL', 'Groenland', 'Greenland'),
(76, 'GP', 'Guadeloupe', 'Guinea, Equatorial'),
(77, 'GU', 'Guam', 'Guam'),
(78, 'GT', 'Guatemala', 'Guatemala'),
(79, 'GN', 'Guinée', 'Guinea'),
(80, 'GQ', 'Guinée équatoriale', 'Equatorial Guinea'),
(81, 'GW', 'Guinée-Bissao', 'Guinea-Bissau'),
(82, 'GY', 'Guyana', 'Guyana'),
(83, 'GF', 'Guyane française', 'Guiana, French'),
(84, 'HT', 'Haïti', 'Haiti'),
(85, 'HN', 'Honduras', 'Honduras'),
(86, 'HK', 'Hong Kong', 'Hong Kong, (China)'),
(87, 'HU', 'Hongrie', 'Hungary'),
(88, 'BV', 'Ile Bouvet', 'Bouvet Island'),
(89, 'CX', 'Ile Christmas', 'Christmas Island'),
(90, 'NF', 'Ile Norfolk', 'Norfolk Island'),
(91, 'KY', 'Iles Cayman', 'Cayman Islands'),
(92, 'CK', 'Iles Cook', 'Cook Islands'),
(93, 'FO', 'Iles Féroé', 'Faroe Islands'),
(94, 'FK', 'Iles Falkland', 'Falkland Islands (Malvinas)'),
(95, 'FJ', 'Iles Fidji', 'Fiji'),
(96, 'GS', 'Iles Géorgie du Sud et Sandwich du Sud', 'S. Georgia and S. Sandwich Is.'),
(97, 'HM', 'Iles Heard et McDonald', 'Heard and McDonald Islands'),
(98, 'MH', 'Iles Marshall', 'Marshall Islands'),
(99, 'PN', 'Iles Pitcairn', 'Pitcairn Island'),
(100, 'SB', 'Iles Salomon', 'Solomon Islands'),
(101, 'SJ', 'Iles Svalbard et Jan Mayen', 'Svalbard and Jan Mayen Islands'),
(102, 'TC', 'Iles Turks-et-Caicos', 'Turks and Caicos Islands'),
(103, 'VI', 'Iles Vierges américaines', 'Virgin Islands, U.S.'),
(104, 'VG', 'Iles Vierges britanniques', 'Virgin Islands, British'),
(105, 'CC', 'Iles des Cocos (Keeling)', 'Cocos (Keeling) Islands'),
(106, 'UM', 'Iles mineures éloignées des États-Unis', 'US Minor Outlying Islands'),
(107, 'IN', 'Inde', 'India'),
(108, 'ID', 'Indonésie', 'Indonesia'),
(109, 'IR', 'Iran', 'Iran, Islamic Republic of'),
(110, 'IQ', 'Iraq', 'Iraq'),
(111, 'IE', 'Irlande', 'Ireland'),
(112, 'IS', 'Islande', 'Iceland'),
(113, 'IL', 'Israël', 'Israel'),
(114, 'IT', 'Italie', 'Italy'),
(115, 'JM', 'Jamaïque', 'Jamaica'),
(116, 'JP', 'Japon', 'Japan'),
(117, 'JO', 'Jordanie', 'Jordan'),
(118, 'KZ', 'Kazakhstan', 'Kazakhstan'),
(119, 'KE', 'Kenya', 'Kenya'),
(120, 'KG', 'Kirghizistan', 'Kyrgyzstan'),
(121, 'KI', 'Kiribati', 'Kiribati'),
(122, 'KW', 'Koweït', 'Kuwait'),
(123, 'LA', 'Laos', 'Lao People\'s Democratic Republic'),
(124, 'LS', 'Lesotho', 'Lesotho'),
(125, 'LV', 'Lettonie', 'Latvia'),
(126, 'LB', 'Liban', 'Lebanon'),
(127, 'LR', 'Liberia', 'Liberia'),
(128, 'LY', 'Libye', 'Libyan Arab Jamahiriya'),
(129, 'LI', 'Liechtenstein', 'Liechtenstein'),
(130, 'LT', 'Lituanie', 'Lithuania'),
(131, 'LU', 'Luxembourg', 'Luxembourg'),
(132, 'MO', 'Macao', 'Macao, (China)'),
(133, 'MG', 'Madagascar', 'Madagascar'),
(134, 'MY', 'Malaisie', 'Malaysia'),
(135, 'MW', 'Malawi', 'Malawi'),
(136, 'MV', 'Maldives', 'Maldives'),
(137, 'ML', 'Mali', 'Mali'),
(138, 'MT', 'Malte', 'Malta'),
(139, 'MP', 'Mariannes du Nord', 'Northern Mariana Islands'),
(140, 'MA', 'Maroc', 'Morocco'),
(141, 'MQ', 'Martinique', 'Martinique'),
(142, 'MU', 'Maurice', 'Mauritius'),
(143, 'MR', 'Mauritanie', 'Mauritania'),
(144, 'YT', 'Mayotte', 'Mayotte'),
(145, 'MX', 'Mexique', 'Mexico'),
(146, 'FM', 'Micronésie', 'Micronesia, Federated States of'),
(147, 'MD', 'Moldavie', 'Moldova, Republic of'),
(148, 'MC', 'Monaco', 'Monaco'),
(149, 'MN', 'Mongolie', 'Mongolia'),
(150, 'MS', 'Montserrat', 'Montserrat'),
(151, 'MZ', 'Mozambique', 'Mozambique'),
(152, 'NP', 'Népal', 'Nepal'),
(153, 'NA', 'Namibie', 'Namibia'),
(154, 'NR', 'Nauru', 'Nauru'),
(155, 'NI', 'Nicaragua', 'Nicaragua'),
(156, 'NE', 'Niger', 'Niger'),
(157, 'NG', 'Nigeria', 'Nigeria'),
(158, 'NU', 'Nioué', 'Niue'),
(159, 'NO', 'Norvège', 'Norway'),
(160, 'NC', 'Nouvelle-Calédonie', 'New Caledonia'),
(161, 'NZ', 'Nouvelle-Zélande', 'New Zealand'),
(162, 'OM', 'Oman', 'Oman'),
(163, 'UG', 'Ouganda', 'Uganda'),
(164, 'UZ', 'Ouzbékistan', 'Uzbekistan'),
(165, 'PE', 'Pérou', 'Peru'),
(166, 'PK', 'Pakistan', 'Pakistan'),
(167, 'PA', 'Panama', 'Panama'),
(168, 'PG', 'Papouasie-Nouvelle-Guinée', 'Papua New Guinea'),
(169, 'PY', 'Paraguay', 'Paraguay'),
(170, 'NL', 'Pays-Bas', 'Netherlands'),
(171, 'PH', 'Philippines', 'Philippines'),
(172, 'PL', 'Pologne', 'Poland'),
(173, 'PF', 'Polynésie française', 'French Polynesia'),
(174, 'PR', 'Porto Rico', 'Puerto Rico'),
(175, 'PT', 'Portugal', 'Portugal'),
(176, 'QA', 'Qatar', 'Qatar'),
(177, 'CF', 'République centrafricaine', 'Central African Republic'),
(178, 'CD', 'République démocratique du Congo', 'Congo, Democratic Rep. of the'),
(179, 'DO', 'République dominicaine', 'Dominican Republic'),
(180, 'CZ', 'République tchèque', 'Czech Republic'),
(181, 'RE', 'Réunion', 'Reunion'),
(182, 'RO', 'Roumanie', 'Romania'),
(183, 'GB', 'Royaume-Uni', 'Saint Pierre and Miquelon'),
(184, 'RU', 'Russie', 'Russia (Russian Federation)'),
(185, 'RW', 'Rwanda', 'Rwanda'),
(186, 'SN', 'Sénégal', 'Senegal'),
(187, 'EH', 'Sahara occidental', 'Western Sahara'),
(188, 'KN', 'Saint-Christophe-et-Niévès', 'Saint Kitts and Nevis'),
(189, 'SM', 'Saint-Marin', 'San Marino'),
(190, 'PM', 'Saint-Pierre-et-Miquelon', 'Saint Pierre and Miquelon'),
(191, 'VA', 'Saint-Siège ', 'Vatican City State (Holy See)'),
(192, 'VC', 'Saint-Vincent-et-les-Grenadines', 'Saint Vincent and the Grenadines'),
(193, 'SH', 'Sainte-Hélène', 'Saint Helena'),
(194, 'LC', 'Sainte-Lucie', 'Saint Lucia'),
(195, 'SV', 'Salvador', 'El Salvador'),
(196, 'WS', 'Samoa', 'Samoa'),
(197, 'AS', 'Samoa américaines', 'American Samoa'),
(198, 'ST', 'Sao Tomé-et-Principe', 'Sao Tome and Principe'),
(199, 'SC', 'Seychelles', 'Seychelles'),
(200, 'SL', 'Sierra Leone', 'Sierra Leone'),
(201, 'SG', 'Singapour', 'Singapore'),
(202, 'SI', 'Slovénie', 'Slovenia'),
(203, 'SK', 'Slovaquie', 'Slovakia'),
(204, 'SO', 'Somalie', 'Somalia'),
(205, 'SD', 'Soudan', 'Sudan'),
(206, 'LK', 'Sri Lanka', 'Sri Lanka (ex-Ceilan)'),
(207, 'SE', 'Suède', 'Sweden'),
(208, 'CH', 'Suisse', 'Switzerland'),
(209, 'SR', 'Suriname', 'Suriname'),
(210, 'SZ', 'Swaziland', 'Swaziland'),
(211, 'SY', 'Syrie', 'Syrian Arab Republic'),
(212, 'TW', 'Taïwan', 'Taiwan'),
(213, 'TJ', 'Tadjikistan', 'Tajikistan'),
(214, 'TZ', 'Tanzanie', 'Tanzania, United Republic of'),
(215, 'TD', 'Tchad', 'Chad'),
(216, 'TF', 'Terres australes françaises', 'French Southern Territories - TF'),
(217, 'IO', 'Territoire britannique de l\'Océan Indien', 'British Indian Ocean Territory'),
(218, 'TH', 'Thaïlande', 'Thailand'),
(219, 'TL', 'Timor Oriental', 'Timor-Leste (East Timor)'),
(220, 'TG', 'Togo', 'Togo'),
(221, 'TK', 'Tokélaou', 'Tokelau'),
(222, 'TO', 'Tonga', 'Tonga'),
(223, 'TT', 'Trinité-et-Tobago', 'Trinidad & Tobago'),
(224, 'TN', 'Tunisie', 'Tunisia'),
(225, 'TM', 'Turkménistan', 'Turkmenistan'),
(226, 'TR', 'Turquie', 'Turkey'),
(227, 'TV', 'Tuvalu', 'Tuvalu'),
(228, 'UA', 'Ukraine', 'Ukraine'),
(229, 'UY', 'Uruguay', 'Uruguay'),
(230, 'VU', 'Vanuatu', 'Vanuatu'),
(231, 'VE', 'Venezuela', 'Venezuela'),
(232, 'VN', 'Vietnam', 'Viet Nam'),
(233, 'WF', 'Wallis-et-Futuna', 'Wallis and Futuna'),
(234, 'YE', 'Yémen', 'Yemen'),
(235, 'YU', 'Yougoslavie', 'Saint Pierre and Miquelon'),
(236, 'ZM', 'Zambie', 'Zambia'),
(237, 'ZW', 'Zimbabwe', 'Zimbabwe'),
(238, 'MK', 'ex-République yougoslave de Macédoine', 'Macedonia, TFYR');

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE `gallery` (
  `id_picture` int(11) NOT NULL,
  `id_bedroom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gallery`
--

INSERT INTO `gallery` (`id_picture`, `id_bedroom`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 5),
(28, 5),
(29, 5),
(30, 5),
(31, 5),
(32, 5);

-- --------------------------------------------------------

--
-- Structure de la table `lnk_services_reservation`
--

CREATE TABLE `lnk_services_reservation` (
  `id_booking` int(11) NOT NULL,
  `id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `picture_id` int(11) NOT NULL,
  `picture_name` varchar(50) NOT NULL,
  `picture_url` varchar(100) NOT NULL,
  `picture_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`picture_id`, `picture_name`, `picture_url`, `picture_description`) VALUES
(1, 'printemps ', 'public/assets/images/chambres/printemps/printemps.jpg', 'Photos chambres printemps'),
(2, 'printemps 1', 'public/assets/images/chambres/printemps/printemps1.jpg', 'Photos chambres printemps'),
(3, 'printemps 2', 'public/assets/images/chambres/printemps/printemps2.jpg', 'Photos chambres printemps'),
(4, 'printemps 3', 'public/assets/images/chambres/printemps/printemps3.jpg', 'Photos chambres printemps'),
(5, 'printemps 4', 'public/assets/images/chambres/printemps/printemps4.jpg', 'Photos chambres printemps'),
(6, 'printemps 5', 'public/assets/images/chambres/printemps/printemps5.jpg', 'Photos chambres printemps'),
(7, 'ete', 'public/assets/images/chambres/ete/ete.jpg', 'Chambre confort Soleil'),
(8, 'ete1', 'public/assets/images/chambres/ete/ete1.jpg', 'Chambre confort Soleil'),
(9, 'ete 2', 'public/assets/images/chambres/ete/ete2.jpg', 'Chambre confort Soleil'),
(10, 'ete 3', 'public/assets/images/chambres/ete/ete3.jpg', 'Chambre confort Soleil'),
(11, 'ete 4', 'public/assets/images/chambres/ete/ete4.jpg', 'Chambre confort Soleil'),
(12, 'ete5', 'public/assets/images/chambres/ete/ete5.jpg', 'Chambre confort Soleil'),
(13, 'hiver', 'public/assets/images/chambres/hiver/hiver.jpg', 'Chambre confort Hiver'),
(14, 'hiver 1', 'public/assets/images/chambres/hiver/hiver1.jpg', 'Chambre confort Hiver'),
(15, 'Hiver 2 ', 'public/assets/images/chambres/hiver/hiver2.jpg', 'Chambre confort Hiver'),
(16, 'Hiver 3 ', 'public/assets/images/chambres/hiver/hiver3.jpg', 'Chambre confort Hiver'),
(17, 'public/assets/images/chambres/hiver/hiver4.jpg', 'public/assets/images/chambres/hiver/hiver4.jpg', 'Chambre confort Hiver'),
(18, 'hiver5', 'public/assets/images/chambres/hiver/hiver5.jpg', 'Chambre confort Hiver'),
(19, 'Hiver 6 ', 'public/assets/images/chambres/hiver/hiver6.jpg', 'Chambre confort Hiver'),
(20, 'automne ', 'public/assets/images/chambres/automne/automne.jpg', 'Deluxe Automne (avec Jacuzzi)'),
(21, 'automne 1', 'public/assets/images/chambres/automne/automne1.jpg', 'Deluxe Automne (avec Jacuzzi)'),
(22, 'automne 2', 'public/assets/images/chambres/automne/automne2.jpg', 'Deluxe Automne (avec Jacuzzi)'),
(23, 'automne 3', 'public/assets/images/chambres/automne/automne3.jpg', 'Deluxe Automne (avec Jacuzzi)'),
(24, 'automne 4', 'public/assets/images/chambres/automne/automne4.jpg', 'Deluxe Automne (avec Jacuzzi)'),
(25, 'automne 5', 'public/assets/images/chambres/automne/automne5.jpg', 'Deluxe Automne (avec Jacuzzi)'),
(26, 'automne 6', 'public/assets/images/chambres/automne/automne6.jpg', 'Deluxe Automne (avec Jacuzzi)'),
(27, 'vivaldi ', 'public/assets/images/chambres/vivaldi/vivaldi.jpg', 'La Suite «Vilvadi» (avec Jacuzzi)'),
(28, 'vivaldi 1', 'public/assets/images/chambres/vivaldi/vivaldi1.jpg', 'La Suite «Vilvadi» (avec Jacuzzi)'),
(29, 'vivaldi 2', 'public/assets/images/chambres/vivaldi/vivaldi2.jpg', 'La Suite «Vilvadi» (avec Jacuzzi)'),
(30, 'vivaldi 3 ', 'public/assets/images/chambres/vivaldi/vivaldi3.jpg', 'La Suite «Vilvadi» (avec Jacuzzi)'),
(31, 'vivaldi 4 ', 'public/assets/images/chambres/vivaldi/vivaldi4.jpg', 'La Suite «Vilvadi» (avec Jacuzzi)'),
(32, 'vivaldi 5', 'public/assets/images/chambres/vivaldi/vivaldi5.jpg', 'La Suite «Vilvadi» (avec Jacuzzi)');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `id_restocategory` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `restaurant`
--

INSERT INTO `restaurant` (`product_id`, `product_title`, `id_restocategory`, `product_price`, `product_active`) VALUES
(1, 'Salade d&#039;endives aux noix', 1, 10, 1),
(2, 'Croquettes aux crevettes grises', 1, 12, 1),
(3, 'Terrine de campagne maison', 1, 9, 1),
(4, 'Tomates aux crevettes', 1, 10.5, 1),
(5, 'Moules marinières', 1, 11.5, 1),
(6, 'Carbonade flamande accompagnée de frites maison', 2, 16.5, 1),
(7, 'Waterzooi de poulet aux légumes de saison', 2, 15, 1),
(8, 'Boulettes à la liégeoise avec stoemp aux carottes', 2, 14, 1),
(9, 'Filet de saumon bio grillé avec purée de céleri-rav', 3, 18, 1),
(10, 'Truite meunière aux amandes et pommes de terre vapeu', 3, 17.5, 1),
(11, 'Dame Blanche', 4, 9, 1),
(12, 'Gaufre de Liège avec chantilly et fruits frais ', 4, 9, 1),
(13, 'Crème brûlée à la vanille bourbon', 4, 9, 1),
(14, 'Mousse au chocolat belge', 4, 7, 1),
(15, 'Bières belges sélectionnées', 5, 7, 1),
(16, 'Sélection de vins de la région (verre)', 5, 5, 1),
(17, 'Sélection de vins de la région (Bouteille)\r\n', 5, 25, 1),
(18, 'Café', 6, 2.5, 1),
(19, 'Cappucinno', 6, 3, 1),
(20, 'Thé', 6, 2.5, 1),
(21, 'Chocolat chaud', 6, 3, 1),
(22, 'Eau minérale plate ou gazeuse ', 7, 2.5, 1),
(23, 'Jus de fruits bio', 7, 3.5, 1),
(24, 'Limonade artisanale', 7, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `services_bedroom`
--

CREATE TABLE `services_bedroom` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(200) NOT NULL,
  `service_price` int(11) NOT NULL,
  `service_active` tinyint(1) NOT NULL,
  `service_picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `services_bedroom`
--

INSERT INTO `services_bedroom` (`service_id`, `service_name`, `service_price`, `service_active`, `service_picture`) VALUES
(1, 'Petit-déjeuner', 35, 1, 'public/assets/images/services/dejeuner.png'),
(2, 'Bouteille de champagne en Chambre', 50, 1, 'public/assets/images/services/champagne.png'),
(3, 'Boite de chocolat Darcis', 18, 1, 'public/assets/images/services/chocolat.png'),
(4, 'Bouteille de Cava en Chambre', 25, 1, 'public/assets/images/services/champagne.png');

-- --------------------------------------------------------

--
-- Structure de la table `spa`
--

CREATE TABLE `spa` (
  `spa_id` int(11) NOT NULL,
  `id_spacategory` int(11) NOT NULL,
  `spa_title` varchar(255) DEFAULT NULL,
  `spa_time` int(11) DEFAULT NULL,
  `spa_price` decimal(10,2) DEFAULT NULL,
  `spa_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `spa`
--

INSERT INTO `spa` (`spa_id`, `id_spacategory`, `spa_title`, `spa_time`, `spa_price`, `spa_active`) VALUES
(1, 1, 'Massage relaxant', 30, '50.00', 1),
(2, 1, 'Massage relaxant', 60, '85.00', 1),
(3, 1, 'Massage relaxant', 90, '120.00', 1),
(4, 1, 'Massage suédois', 60, '95.00', 1),
(5, 1, 'Massage suédois', 90, '130.00', 1),
(6, 1, 'Massage profond des tissus', 60, '100.00', 1),
(7, 1, 'Massage profond des tissus', 90, '140.00', 1),
(8, 1, 'Massage aux pierres chaudes', 60, '110.00', 1),
(9, 1, 'Massage aux pierres chaudes', 90, '150.00', 1),
(10, 1, 'Massage thaï', 60, '110.00', 1),
(11, 1, 'Massage thaï', 90, '150.00', 1),
(12, 1, 'Massage pour enfants', 30, '45.00', 1),
(13, 2, 'Soin du visage hydratant', 60, '85.00', 1),
(14, 2, 'Soin du visage anti-âge', 60, '95.00', 1),
(15, 2, 'Soin du visage éclaircissant', 60, '90.00', 1),
(16, 2, 'Soin du visage purifiant', 60, '85.00', 1),
(17, 2, 'Soin du visage aux acides de fruits', 60, '95.00', 1),
(18, 2, 'Soin du visage pour homme', 60, '80.00', 1),
(19, 3, 'Soin du corps hydratant', 60, '100.00', 1),
(20, 3, 'Soin du corps exfoliant', 60, '100.00', 1),
(21, 3, 'Soin du corps minceur', 90, '140.00', 1),
(22, 3, 'Enveloppement corporel &agrave; l&#039;argile', 60, '110.00', 1),
(23, 3, 'Enveloppement corporel aux algues', 60, '110.00', 1),
(24, 3, 'Enveloppement corporel au chocolat', 60, '120.00', 1),
(25, 3, 'Gommage corporel à la noix de coco', 30, '60.00', 1),
(26, 4, 'Manucure classique', 45, '50.00', 1),
(27, 4, 'Manucure française', 60, '60.00', 1),
(28, 4, 'Pédicure classique', 45, '60.00', 1),
(29, 4, 'Pédicure française', 60, '70.00', 1),
(30, 4, 'Pose de vernis simple', 15, '20.00', 1),
(31, 4, 'Pose de vernis semi-permanent', 45, '50.00', 1),
(32, 5, 'Réflexologie plantaire', 45, '70.00', 1),
(33, 5, 'Séance de yoga privée', 60, '90.00', 1),
(34, 5, 'S&eacute;ance de m&eacute;ditation guid&eacute;e', 30, '45.00', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`),
  ADD KEY `FK_account_acc_country` (`acc_id_country`);

--
-- Index pour la table `bedroom`
--
ALTER TABLE `bedroom`
  ADD PRIMARY KEY (`bedroom_id`),
  ADD KEY `FK_category_beedroom` (`id_roomcategory`);

--
-- Index pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `FK_account_bookings` (`id_acc`),
  ADD KEY `FK_bedroom_bookings` (`id_bedroom`),
  ADD KEY `cus_id_country` (`cus_id_country`);

--
-- Index pour la table `category_bedroom`
--
ALTER TABLE `category_bedroom`
  ADD PRIMARY KEY (`roomcategory_id`);

--
-- Index pour la table `category_restaurant`
--
ALTER TABLE `category_restaurant`
  ADD PRIMARY KEY (`restocategory_id`);

--
-- Index pour la table `category_spa`
--
ALTER TABLE `category_spa`
  ADD PRIMARY KEY (`spacategory_id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Index pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD KEY `FK_Picture_bedroom` (`id_bedroom`),
  ADD KEY `FK_Picture_id` (`id_picture`);

--
-- Index pour la table `lnk_services_reservation`
--
ALTER TABLE `lnk_services_reservation`
  ADD PRIMARY KEY (`id_booking`,`id_service`),
  ADD KEY `id_service` (`id_service`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`picture_id`);

--
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `id_restocategory` (`id_restocategory`);

--
-- Index pour la table `services_bedroom`
--
ALTER TABLE `services_bedroom`
  ADD PRIMARY KEY (`service_id`);

--
-- Index pour la table `spa`
--
ALTER TABLE `spa`
  ADD PRIMARY KEY (`spa_id`),
  ADD KEY `index_category` (`id_spacategory`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `bedroom`
--
ALTER TABLE `bedroom`
  MODIFY `bedroom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT pour la table `category_bedroom`
--
ALTER TABLE `category_bedroom`
  MODIFY `roomcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `category_restaurant`
--
ALTER TABLE `category_restaurant`
  MODIFY `restocategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `category_spa`
--
ALTER TABLE `category_spa`
  MODIFY `spacategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `services_bedroom`
--
ALTER TABLE `services_bedroom`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `spa`
--
ALTER TABLE `spa`
  MODIFY `spa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `FK_account_acc_country` FOREIGN KEY (`acc_id_country`) REFERENCES `country` (`country_id`);

--
-- Contraintes pour la table `bedroom`
--
ALTER TABLE `bedroom`
  ADD CONSTRAINT `FK_category_beedroom` FOREIGN KEY (`id_roomcategory`) REFERENCES `category_bedroom` (`roomcategory_id`);

--
-- Contraintes pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `FK_account_bookings` FOREIGN KEY (`id_acc`) REFERENCES `account` (`acc_id`),
  ADD CONSTRAINT `FK_bedroom_bookings` FOREIGN KEY (`id_bedroom`) REFERENCES `bedroom` (`bedroom_id`),
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`cus_id_country`) REFERENCES `country` (`country_id`);

--
-- Contraintes pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `FK_Picture_bedroom` FOREIGN KEY (`id_bedroom`) REFERENCES `bedroom` (`bedroom_id`),
  ADD CONSTRAINT `FK_Picture_id` FOREIGN KEY (`id_picture`) REFERENCES `picture` (`picture_id`);

--
-- Contraintes pour la table `lnk_services_reservation`
--
ALTER TABLE `lnk_services_reservation`
  ADD CONSTRAINT `lnk_services_reservation_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `services_bedroom` (`service_id`),
  ADD CONSTRAINT `lnk_services_reservation_ibfk_2` FOREIGN KEY (`id_booking`) REFERENCES `bookings` (`booking_id`);

--
-- Contraintes pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`id_restocategory`) REFERENCES `category_restaurant` (`restocategory_id`);

--
-- Contraintes pour la table `spa`
--
ALTER TABLE `spa`
  ADD CONSTRAINT `spa_ibfk_1` FOREIGN KEY (`id_spacategory`) REFERENCES `category_spa` (`spacategory_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
