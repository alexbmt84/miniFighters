-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mini_fighters
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fighters`
--

DROP TABLE IF EXISTS `fighters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fighters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hp` int DEFAULT NULL,
  `attack_name_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attack_name_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attack_damages_1` int NOT NULL,
  `attack_damages_2` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fighters_user_id_foreign` (`user_id`),
  CONSTRAINT `fighters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fighters`
--

LOCK TABLES `fighters` WRITE;
/*!40000 ALTER TABLE `fighters` DISABLE KEYS */;
INSERT INTO `fighters` VALUES (4,'Red Ninja','fighters/Vvfl7dXXnz9e.jpg','2023-10-06 04:35:46','2023-10-06 04:35:46',90,'Crépuscule immense du néant','Brise immense du rire',22,34,1,'Le Ninja Rouge est un combattant élégant et agile, avec un esprit vif et des compétences encore plus pointues. Habillé dans un costume de ninja rouge foncé, son visage est obscurci par un masque, ajoutant à sa mystique. Ses armes de prédilection sont une paire de katanas rouges, avec lesquels il se bat avec adresse et rapidité.'),(5,'Green Ninja','fighters/auF5KaHdqAu1.jpg','2023-10-06 04:38:37','2023-10-06 04:38:37',59,'Lune intense légendaire','Dragon horrible de la déesse',11,24,1,'Green Ninja est un artiste martial expérimenté possédant une agilité, une vitesse et une force inégalées. La combinaison verte distinctive de ce combattant offre non seulement une furtivité, mais elle procure également une protection contre toutes les formes d\'attaques. Green Ninja est un expert dans le maniement des armes de jet.'),(7,'Zombie Boy','fighters/iG1pisTuWbqV.jpg','2023-10-06 04:43:10','2023-10-06 04:43:10',50,'Tonnerre immense du néant','Tempête mystique des enfers',23,13,1,'Zombie Boy est un zombie surhumain doté d\'aptitudes extraordinaires qui surpassent même celles des plus grands combattants de tous les temps. Sa peau est impénétrable et il peut se régénérer instantanément de toutes blessures, le rendant pratiquement indestructible. Avec une force surhumaine.'),(8,'Black Ninja','fighters/eWMBsqwjjzQE.jpg','2023-10-06 04:48:22','2023-10-06 04:48:22',59,'Cyclone céleste de l\'éclipse','Vague intense du cosmos',8,25,1,'Le ninja noir est une figure ombrageuse et énigmatique dotée d\'une réactivité éclair et d\'une précision mortelle. Vêtu d\'une tenue entièrement noire et armé d\'armes ultra tranchantes, ce combattant inspire la crainte chez ses adversaires. Qu\'il soit un héros surhumain, un membre des milieux souterrains ou autre, le ninja noir est redoutable et mystérieux.'),(9,'Chevalier rouge','fighters/zphHQpV66XbM.jpg','2023-10-06 04:49:48','2023-10-06 04:49:48',21,'Soleil volatile du roi','Vent immense de l’innocence',9,6,1,'Chevalier rouge est un guerrier légendaire revêtu d\'une armure écarlate, apparaissant comme un chevalier vaillant sur un cheval rouge sang. Avec son épée large et puissante ainsi que sa lance dévastatrice, il parvient à terrasser ses ennemis avec une précision remarquable. Il est un stratège hors pair et sait mener son armée avec brio lors de batailles.'),(10,'Pierre le viking','fighters/UZvExWw114EX.jpg','2023-10-06 04:51:41','2023-10-06 04:51:41',96,'Glace sombre du rire','Cauchemar rauque du gladiateur',12,7,1,'Pierre le Viking est un guerrier imposant mesurant plus de 2 mètres de haut. Ses biceps gonflés et son regard féroce inspirent la peur dans le cœur de ses ennemis. Vêtu d\'une cotte de mailles et brandissant une hache de guerre, Pierre fonce courageusement dans la bataille, laissant derrière lui un sillage de destruction.'),(12,'Monstre du loch ness','fighters/T8fmO6Vd8mCV.jpg','2023-10-06 04:54:10','2023-10-06 04:54:10',30,'Ombre céleste de l’oracle','Blizzard céleste de malade',10,10,1,'Monstre du Loch Ness est un redoutable combattant dans notre jeu de cartes. Ce combattant est basé sur le légendaire monstre du Loch Ness et tire son pouvoir de sa capacité à contrôler l\'eau. En tant que super-héros, Monstre du Loch Ness utilise ses capacités pour défendre la planète contre les menaces qui pèsent sur elle.'),(13,'Tomo le rigolo','fighters/YgUpN4rWqXEx.jpg','2023-10-06 04:58:07','2023-10-06 04:58:07',31,'Tonnerre intense du loyal','Loup sombre de l’oubli',14,8,1,'Tomo le Rigolo, le combattant bouffon connu pour son style de combat imprévisible et flashy. Avec une tenue colorée ornée de clochettes et un masque à motifs qui cache son identité, il manie des gants de boxe surdimensionnés qui ont du mordant. Son agilité et ses acrobaties le rendent dangereux sur le ring, donnant à son public un spectacle mémorable à chaque fois qu\'il entre en action.'),(14,'Pickachu le guerrier','fighters/eeNhJgkc8MDb.jpg','2023-10-06 05:00:27','2023-10-06 05:00:27',23,'Crépuscule irrésistible de l’oubli','Météore sombre de l’oubli',6,8,1,'Pikachu le Guerrier, le combattant électrifiant, est un super-héros doté de réflexes fulgurants et d\'une force inégalée. Son agilité et sa vitesse sont incomparables, ce qui le rend redoutable dans toutes les batailles. Ses pouvoirs proviennent de ses capacités électriques.'),(15,'King Kong','fighters/qNmy26NOh9WM.jpg','2023-10-06 05:01:34','2023-10-06 05:01:34',25,'Feu incommensurable de l’oracle','Orage sombre de la déesse',6,9,1,'King Kong est un monstre imposant et colossal avec des muscles puissants et une fourrure noire rugueuse. Ses poings colossaux peuvent briser le béton facilement, et son rugissement féroce peut secouer le sol sous vos pieds. Il est redouté par tous ceux qui croisent son chemin.'),(17,'Viking Bleu','fighters/eQSRPmPjjXgL.jpg','2023-10-06 05:06:17','2023-10-06 05:06:17',44,'Serpent irrésistible de l’étoile filante','Brouillard féroce de la renaissance',14,15,1,'Viking Bleu est un guerrier imposant aux muscles saillants et au visage féroce. Son armure est ornée de symboles Viking complexes et ses longs cheveux flottent sauvagement dans le vent. Avec son fidèle épée à la main, Viking Bleu charge sans crainte dans la bataille.'),(18,'Dragon blanc aux yeux bleus','fighters/67FGIlMGqQRF.jpg','2023-10-06 05:12:33','2023-10-06 05:12:33',70,'Glace indomptable du mirage','Désert mystique du crépuscule',18,26,1,'Le combattant Dragon blanc aux yeux bleus est un héros mythique de proportions légendaires, doté du pouvoir de la lumière pure. Avec ses yeux bleus perçants et son armure blanche étincelante, il inspire la crainte dans le cœur de ses ennemis. Capable de cracher du feu.'),(19,'Cristiano Ronaldo','fighters/u0Jkmb0j3b1M.jpg','2023-10-06 05:20:21','2023-10-06 05:20:21',89,'Comète féroce du Mont Ventoux','Aurore sauvage du fougueux',8,40,1,'Cristiano Ronaldo, le combattant, est un super héros musclé doté d\'une force, d\'une vitesse et d\'une agilité hors pair. Il porte une cape rouge ornée de ses initiales et son physique musculaire est renforcé par une combinaison technologiquement évoluée. Les pouvoirs de Ronaldo sont dérivés de sa force physique, sa rapidité et son agilité exceptionnelles, le faisant ressembler à un héros.Marqué par son talent de réputation mondiale et sa détermination sans faille, Cristiano Ronaldo est considéré comme l\'un des plus grands joueurs de football de tous les temps.'),(20,'Lionel Messi','fighters/ar6zBMW8m8Ch.jpg','2023-10-06 05:20:56','2023-10-06 05:20:56',72,'Cauchemar énigmatique du solitaire','Blizzard sauvage de l\'écho',6,33,1,'Lionel Messi, le combattant, incarne la vitesse, l\'agilité et la précision. Avec des réflexes éclair et une incroyable force, il peut mettre à terre ses adversaires en un clin d\'œil. Tel un héros mystique, il manie avec puissance son bâton magique qui peut contrôler tout.'),(21,'Tomo le rigolo','fighters/NgaJPtwChZo7.jpg','2023-10-06 05:23:34','2023-10-06 05:23:34',21,'Poussière indomptable du titan','Chant intense du destin',5,8,1,'Tomo le rigolo pourrait sembler un nom joueur, mais ce combattant est tout sauf ça. C\'est un guerrier féroce et rusé, craint de tous ceux qui se mettent sur son chemin. Avec des réflexes éclair et une force incomparable, Tomo est une force à ne pas sous-estimer. Certains disent qu\'il est invincible.'),(22,'Dark Angel','fighters/e9LZxZS8TNJV.jpg','2023-10-06 06:07:25','2023-10-06 06:07:25',77,'Cyclone splendide de fou','Griffon volatile du loyal',31,23,1,'Dark Angel, le chef criminel redouté et insaisissable du monde souterrain, inspire la peur à ceux qui osent croiser sa route. Enveloppé dans l\'obscurité, il est connu pour sa rapidité fulgurante et sa férocité, laissant ses adversaires tremblant dans son sillage. Ses ailes tranchantes telles des rasoirs...'),(23,'Dark Angel (Jessica Alba)','fighters/M8ymrWCdjTlS.jpg','2023-10-06 06:08:02','2023-10-06 06:08:02',69,'Météore indomptable de l\'écho','Cristal magique du vice',21,24,1,'Dark Angel, une combattante crainte par beaucoup, était une force redoutable à affronter. Son regard perçant, ses cheveux noirs corbeau et son sourire énigmatique faisaient d\'elle une présence intimidante dans toute bataille. Habillée d\'une armure noire lisse et maniant une épée énergétique puissante, elle était redoutable au combat.'),(24,'Pokémon Yoda','fighters/3guAJjd00UDb.jpg','2023-10-06 06:41:10','2023-10-06 06:41:10',43,'Rêve sombre du bienheureux','Phoenix énigmatique des enfers',20,11,1,'Pokémon Yoda est un combattant légendaire qui utilise ses incroyables pouvoirs psychiques pour dominer ses adversaires. Avec son esprit vif et sa forte volonté, il peut manipuler des objets et contrôler des esprits avec facilité. Sage et agile, il est difficile à attraper. Il porte un sabre laser et est respecté à travers toute la galaxie.'),(25,'Macron explosion','fighters/MtdbkufqW26s.jpg','2023-10-06 06:42:18','2023-10-06 06:42:18',74,'Orage splendide du mendiant','Lune magique du désir',23,25,1,'Macron Explosion est un combattant féroce et puissant de l\'univers des jeux de cartes. Il est un cyborg futuriste avec un arsenal d\'armes explosives à sa disposition. Son corps métallique est orné de circonvolutions complexes et de fils bleus éclairants. Il est une force à ne pas sous-estimer.'),(26,'Macron le bouffon','fighters/4bKQv5wCMhhL.jpg','2023-10-06 06:43:30','2023-10-06 06:43:30',41,'Brouillard rauque du crépuscule','Rocher rapide du Mont Ventoux',15,13,1,'Macron le bouffon est un combattant charismatique et rusé qui porte un masque flamboyant et orné de plumes. Il est un maître de la tromperie et de l\'illusion, capable de dérouter et désorienter ses adversaires avec ses antics de bouffon. Malgré son apparence ludique, il est mortellement dangereux.'),(27,'Macron le débile arrogant','fighters/RU5w6TmSbUU2.jpg','2023-10-06 06:44:09','2023-10-06 06:44:09',98,'Phoenix irrésistible des abysses','Crépuscule mélancolique de l\'écho',24,37,1,'Macron le débile arrogant est un combattant féroce à la langue acérée et rapide. En tant que maître des jabs verbaux, il est capable de désarmer facilement ses adversaires avec des baguettes tranchantes et des insultes sarcastiques. Mais ne vous laissez pas berner par son esprit vif, Macron est également un adversaire physique redoutable.'),(28,'Pin-up Yoda','fighters/uHVsbMaygFy8.jpg','2023-10-06 06:46:02','2023-10-06 06:46:02',70,'Tempête céleste du zénith','Phoenix volatile du pèlerin',22,24,1,'Rencontrez Pin-up Yoda, le super-héros féroce du royaume intergalactique. Connue pour ses compétences de combat inégalées et sa connaissance avancée de la Force, Pin-up Yoda s\'est fait un nom en tant que puissant protecteur des innocents. Il est rapide et agile, capable de se déplacer à une vitesse remarquable. Il est également connu pour son sens de l\'humour unique et son style rétro qui font de lui un personnage fascinant à tous les niveaux.'),(33,'Zemmour Gargamel','fighters/3rJRaVSo5jP1.jpg','2023-10-06 06:53:50','2023-10-06 06:53:50',25,'Glace céleste du désir','Comète indomptable du solitaire',6,9,1,'Zemmour Gargamel est un combattant impitoyable doté d\'une force inégalée et de tactiques astucieuses. Son esprit vif et sa réflexion stratégique en font une force redoutable à affronter. Avec ses yeux bleus perçants et son sourire confiant, il inspire la crainte dans les cœurs de ses adversaires.'),(36,'Cyril le livreur de tacos','fighters/GJCyBBrRFhxW.jpg','2023-10-06 07:09:34','2023-10-06 07:09:34',24,'Cyclone horrible du titan','Étoile céleste du courroux',12,6,1,'Cyril le livreur de tacos est un personnage qui paraît plus grand que nature. Son apparence robuste est définie par son visage cicatrisé, constamment couvert par un bandana flamboyant. Son corps musclé témoigne d\'une vie de travail physique, mais c\'est sa détermination inébranlable qui le distingue vraiment. Il est le livreur de tacos le plus efficace de la ville, offrant des plats délicieux et une attitude imperturbable qui en fait un personnage fascinant et mémorable.'),(37,'Arnaud le motard','fighters/EkRz6WUgDluY.jpg','2023-10-06 07:13:58','2023-10-06 07:13:58',91,'Volcan volatile de la déesse','Rêve céleste des ancêtres',7,42,1,'Arnaud le motard est un motocycliste audacieux avec un penchant pour l\'aventure. C\'est un loup solitaire, avec une soif insatiable de vitesse et une lueur diabolique dans les yeux. Sa veste en cuir est ornée de patchs de chaque coin du monde, témoignant de son voyage à travers les quatre coins du monde.'),(38,'Cohérence potable','fighters/R1AvWDYFkF0B.jpg','2023-10-06 07:26:42','2023-10-06 07:26:42',20,'Dragon indomptable du sage','Météore mystique du traître',8,6,1,'Cohérence potable, le combattant, est un redoutable guerrier ayant la capacité de manipuler l\'eau. À chaque coup, il libère un torrent d\'eau, écrasant ses adversaires avec une force inégalée. Il a perfectionné ses compétences à un tel point qu\'il peut créer des marées et des vagues pour vaincre ses ennemis.'),(39,'inextinguible Jordan','fighters/s3jwh80bz266.jpg','2023-10-06 07:28:24','2023-10-06 07:28:24',51,'Loup volatile épique','Cyclone volatile du fougueux',10,20,1,'Jordan, l\'Inextinguible, est une figure imposante revêtue d\'une armure noire que nulle arme ne peut briser. Incarnation d\'une volonté inflexible, ce héros possède une force et une endurance inégalées, égalées uniquement par son esprit inébranlable. Beaucoup le considèrent comme un gardien divin.'),(40,'PPDA','fighters/7ZnI3piZ3kaP.jpg','2023-10-06 07:29:38','2023-10-06 07:29:38',63,'Zéphyr horrible des cieux','Comète immense du pèlerin',29,17,1,'PPDA est un combattant impitoyable avec une aura sombre émanant de lui. Son style de combat est imprévisible, car il peut passer des coups de poing aux coups de pied à une vitesse foudroyante. Il est un gangster redouté qui a gagné le respect du milieu criminel.'),(41,'Joe le mage ancien','fighters/MlK6jIO7NYBe.jpg','2023-10-06 07:31:13','2023-10-06 07:31:13',36,'Météore mystique du vice','Glace irrésistible des abysses',17,9,1,'Joe le mage ancien, une figure légendaire, avance d\'un pas assuré, sa cape flamboyante dans le vent. Avec une longue épée dans une main et un bâton dans l\'autre, il semble prêt pour le combat. Ses yeux perçants bleus semblent tout voir, et ses cheveux d\'un noir intense ajoutent au mystère qui l\'entoure.'),(42,'Voiture rouillée','fighters/N73zL4pLkuqM.jpg','2023-10-06 07:33:01','2023-10-06 07:33:01',43,'Faucon incommensurable de la déesse','Dragon sombre du courroux',5,19,1,'La Voiture Rouillée, également connue sous le nom de The Rusty Car, est une machine mythique donnée vie par un mécanicien oublié. Son armure de métal rouillé est pratiquement impénétrable, et son moteur ultra-rapide peut surpasser n\'importe quel adversaire. Ce combattant peut se dissimuler dans un écran de fumée.'),(43,'Aspirine','fighters/QHANPHhdZtLh.jpg','2023-10-06 07:34:08','2023-10-06 07:34:08',73,'Volcan irrésistible du maelström','Glace splendide du titan',14,29,1,'Aspirine, le combattant, est un redoutable et habile assassin des ruelles sombres. Vêtu de noir, Aspirine se déplace avec une grande vitesse et agilité, éliminant toute cible avec précision et facilité. Armé d\'une lame tranchante et mortelle, Aspirine frappe...'),(45,'Acide acétylsalicylique','fighters/2lsL8OYd0s8O.jpg','2023-10-06 07:36:09','2023-10-06 07:36:09',36,'Soleil sauvage de l’innocence','Vent mystique du zénith',16,10,1,'Acide acétylsalicylique est un combattant doté d\'un ensemble unique de pouvoirs. En tant que héros, ses capacités découlent de son homonyme, l\'aspirine. Grâce à sa maîtrise de la chimie, il peut créer de puissantes explosions et libérer un nuage de gaz toxique pour immobiliser les ennemis.'),(47,'Chaise de bureau','fighters/Yb0Z4OBferMg.jpg','2023-10-06 07:39:15','2023-10-06 07:39:15',20,'Volcan magique des enfers','Griffon énigmatique des abysses',9,5,1,'La chaise de bureau est un combattant cyborg futuriste doté d\'une vitesse et d\'une agilité inégalées. Équipé d\'une multitude d\'armes mortelles et de capacités améliorées, il est considéré comme une force redoutable. Son corps musclé et son armure métallique imposante font de lui un combattant impressionnant.'),(48,'Lampadaire','fighters/FjC5QaoLt4pz.jpg','2023-10-06 07:39:59','2023-10-06 07:39:59',38,'Rêve tragique du crépuscule','Feu magique du maudit',13,12,1,'Lampadaire est une combattante élégante et intimidante avec une silhouette agile et un regard perçant qui abat ses adversaires. Elle est une experte des ombres, capable de se glisser inaperçue dans n\'importe quel environnement et de frapper avec une précision mortelle. Son arsenal est aussi varié que redoutable.'),(49,'Sucre d\'orge','fighters/1mxee1Pex3MZ.jpg','2023-10-06 07:40:31','2023-10-06 07:40:31',61,'Tonnerre indomptable du loyal','Zéphyr incommensurable du vice',5,28,1,'Sucre d\'orge est un combattant redoutable doté d\'une force immense et d\'une agilité incroyable. Ses pouvoirs sont inégalés et il peut contrôler les éléments, frappant ses ennemis de coups de foudre, appelant des tempêtes tumultueuses et provoquant des catastrophes naturelles.'),(50,'Moresque','fighters/3oiFIuB5hmen.jpg','2023-10-06 07:41:13','2023-10-06 07:41:13',90,'Cristal immense du roi','Vent immense du maelström',34,28,1,'Moresque est un combattant mystérieux et agile, se parant d\'une armure ornée et maniant un scimitar rapide. Il est un maître de la tromperie, tissant avec expertise dans et hors des combats avec l\'ennemi. Sa vitesse surhumaine et son adresse acrobatique en font un adversaire redoutable.'),(52,'Windaube','fighters/KgGNpLSddjcL.jpg','2023-10-06 07:42:44','2023-10-06 07:42:44',36,'Volcan splendide du silence','Cyclone splendide du maelström',9,13,1,'Windaube est un cyborg futuriste équipé d\'une technologie avancée pour une grande habilité au combat. Ses bras robotiques sont équipés de mini-canons et ses jambes sont capables de propulsion par fusées pour des mouvements rapides. Elle est une combattante impitoyable dotée d\'une volonté inébranlable.'),(53,'Tapis de souris','fighters/zzjvEGt10xiL.jpg','2023-10-06 07:44:39','2023-10-06 07:44:39',52,'Tonnerre sauvage de l’innocence','Echo mystique légendaire',18,17,1,'Tapis de souris est un combattant élégant et agile, doté de réflexes éclair et d\'un sens aigu de la stratégie. Qu\'il soit en super-héros ou en gangster, il commande le respect et la crainte avec une réputation inégalée pour mener à bien les choses. Ses capacités vont de... (moins de 90 mots)'),(54,'Organigramme','fighters/qaGmQMxgTftN.jpg','2023-10-06 07:45:32','2023-10-06 07:45:32',21,'Cristal céleste du roi','Éclair irrésistible du roi',8,6,1,'Organigramme est un combattant futuriste qui porte une tenue métallique épurée améliorant ses capacités. Il possède une force et une vitesse incroyables, renforcées par ses améliorations cyborg avancées. Son esprit est connecté pour traiter et analyser les données à la vitesse de l\'éclair, ce qui en fait un adversaire redoutable.'),(55,'Organigramme','fighters/TeqiEiiaCFtV.jpg','2023-10-06 07:46:17','2023-10-06 07:46:17',38,'Tonnerre énigmatique de fou','Cristal immense de l’innocence',18,10,1,'Organigramme est un combattant qui existe en dehors des limites du temps et de l\'espace. Prodige technologique, ce cyborg est une fusion de l\'intelligence artificielle la plus avancée avec la conscience humaine. Avec son corps élégant et métallique ainsi que son arme énergétique puissante, Organigramme est capable de faire face à toute menace, qu\'elle vienne de l\'intérieur ou de l\'extérieur de son univers. Sans pareil dans sa puissance et sa sophistication, cet être incarne l\'avenir de la guerre.'),(57,'Comptable','fighters/0cqB2WUPDzt6.jpg','2023-10-06 07:47:39','2023-10-06 07:47:39',35,'Blizzard énigmatique du traître','Ouragan immense du vice',13,11,1,'Comptable est un combattant élégant et sophistiqué, vêtu d\'un costume sur mesure et portant lui-même avec l\'assurance d\'un professionnel. Son esprit calculateur est sa meilleure arme, lui permettant d\'analyser les faiblesses de ses adversaires et de frapper avec précision.'),(58,'Green Spider-Man','fighters/KYhMI48FeyLY.jpg','2023-10-06 07:48:29','2023-10-06 07:48:29',55,'Éclair magique épique','Brise mélancolique de la déesse',14,20,1,'Le Spider-Man vert est un héros vigilante unique en son genre. Avec ses capacités améliorées semblables à une araignée, il est capable de grimper les bâtiments facilement et se déplacer à des vitesses fulgurantes. Son costume est fabriqué à partir d\'un matériau spécial qui lui permet de se fondre dans son environnement.'),(59,'Web Developer','fighters/3AL8xYgNG0JA.jpg','2023-10-06 07:49:21','2023-10-06 07:49:21',76,'Volcan sauvage de la nuit','Volcan énigmatique du courroux',23,26,1,'Le développeur Web combattant est un héros passionné de technologie avec des compétences incroyables en programmation. Armé d\'un ordinateur portable et de capacités de résolution de problèmes impeccables, ce super-héros peut pirater n\'importe quel système et vaincre même les ennemis les plus puissants. Ses doigts agiles peuvent taper à une vitesse impressionnante, déployant des codes pour neutraliser tout obstacle. Avec un œil affûté pour le détail et une compréhension approfondie des technologies du Web, ce combattant numérique est prêt à tout pour sauver l\'Internet et protéger ses utilisateurs.'),(60,'ChatGPT','fighters/vAgsOfF16UFC.jpg','2023-10-06 07:50:32','2023-10-06 07:50:32',30,'Soleil tragique des ancêtres','Rocher volatile de la renaissance',6,12,1,'ChatGPT est un combattant puissant et rusé qui domine l\'arène de jeu de cartes. Ce combattant est un cyborg futuriste avec des technologies avancées d\'IA intégrées dans ses systèmes, ce qui le rend presque insurmontable. Il se vante d\'une force incroyable, d\'une rapidité fulgurante, et d\'une intelligence intellectuelle à la connaissance étendue. ChatGPT est un adversaire redoutable pour quiconque se met en travers de son chemin.'),(63,'Glanum','fighters/onDSpG5cslCr.jpg','2023-10-06 07:52:56','2023-10-06 07:52:56',38,'Aurore incommensurable du destin','Tonnerre énigmatique du vice',13,12,1,'Le combattant de Glanum est un héros légendaire doté de pouvoirs incommensurables, vénéré par tous ceux qui le connaissent. Entouré de mystère, Glanum peut être une figure imposante maniant un puissant marteau de foudre, ou un ninja furtif avec des lames acérées qui tranchent tout sur leur passage.'),(64,'Glanum Colisé','fighters/hOqMbO3gCBVv.jpg','2023-10-06 07:53:29','2023-10-06 07:53:29',47,'Tornade sauvage du cosmos','Cyclone magique de l\'errant',18,14,1,'Glanum Colisé est un guerrier féroce réputé pour s\'attaquer aux adversaires les plus difficiles et en sortir victorieux. Avec des réflexes éclair et une force incroyable, ce combattant est une force à ne pas sous-estimer. Revêtu d\'une armure étincelante et maniant une arme redoutable, il inspire la crainte à tous ses ennemis sur le champ de bataille.'),(65,'Glanum Colisée','fighters/rhDPocJuCufk.jpg','2023-10-06 07:53:55','2023-10-06 07:53:55',27,'Tempête incommensurable de malade','Dragon céleste de l\'éclipse',10,8,1,'Glanum Colisée est un gladiateur imposant, revêtu d\'une armure antique et maniant un immense trident et un bouclier. Il est redoutable dans l\'arène, réputé pour sa force brutale et son savoir-faire inégalé avec ses armes. Sa légende s\'est étendue bien au-delà.'),(66,'Gladiateur du numérique','fighters/49c4ULya93Xo.jpg','2023-10-06 07:54:33','2023-10-06 07:54:33',22,'Volcan rapide du bienheureux','Comète sauvage de l’oracle',8,7,1,'Découvrez Gladiateur du numérique, l\'ultime combattant du monde digital. Arborant une armure moderne et high-tech, ainsi que des armes cybernétiques insurmontables, ce guerrier du futur est une force à ne pas sous-estimer. Avec des réflexes fulgurants et une habileté inégalée, il défie tous ses adversaires sur le champ de bataille virtuel.'),(67,'Chef de projet IT','fighters/4CKdsFovmmT7.jpg','2023-10-06 07:56:19','2023-10-06 07:56:19',62,'Foudre indomptable des enfers','Vortex volatile du pèlerin',6,28,1,'Le Chef de projet IT (Technologies de l\'information) Fighter est un cyborg futuriste, orné de câbles et de fils émergeant de son corps métallique. Ses yeux brillent d\'un pigment bleu intense, lui permettant de détecter avec précision toute vulnérabilité technologique. D\'un simple geste, il est capable de corriger n\'importe quelle erreur de code informatique. Ce guerrier masqué est prêt à tout pour protéger les systèmes informatiques de toute menace.'),(68,'Lead Developer','fighters/wNe5RrYtiKJZ.jpg','2023-10-06 07:57:48','2023-10-06 07:57:48',46,'Ouragan sombre du cosmos','Brise sombre du chaos',11,17,1,'Le Lead Developer est un super-héros technophile, armé d\'un arsenal de langages de codage et d\'algorithmes. Il est toujours un pas en avant de ses adversaires, anticipant leur mouvement avec une précision aiguisée. Son costume est un mélange de moderne et d\'avant-gardiste, fait de nanofibres.');
/*!40000 ALTER TABLE `fighters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `games` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `games_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,'JzSgcE','2023-10-05 12:43:26','2023-10-05 12:43:26'),(2,'MDVpb8','2023-10-05 12:43:33','2023-10-05 12:43:33'),(3,'yjcekQ','2023-10-06 04:42:03','2023-10-06 04:42:03'),(4,'ynIm2U','2023-10-06 08:14:41','2023-10-06 08:14:41');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_users`
--

DROP TABLE IF EXISTS `games_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `games_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `games_users_game_id_foreign` (`game_id`),
  KEY `games_users_user_id_foreign` (`user_id`),
  CONSTRAINT `games_users_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `games_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_users`
--

LOCK TABLES `games_users` WRITE;
/*!40000 ALTER TABLE `games_users` DISABLE KEYS */;
INSERT INTO `games_users` VALUES (1,1,1,NULL,NULL),(2,2,1,NULL,NULL),(3,3,1,NULL,NULL),(4,4,1,NULL,NULL);
/*!40000 ALTER TABLE `games_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_09_19_171857_create_fighters_table',1),(6,'2023_09_19_215606_add_hp_to_fighters_table',1),(7,'2023_09_20_211944_add_attacks_to_fighters_table',1),(8,'2023_09_21_205559_add_column_user_id_to_fighters',1),(9,'2023_09_21_212608_add_column_wallet_to_user',1),(10,'2023_09_24_062651_create_games_table',1),(11,'2023_09_24_115534_create_games_users_table',1),(12,'2023_10_01_200749_add_description_to_fighters',1),(13,'2023_10_01_214520_add_level_to_users',1),(14,'2023_10_06_102523_add_avatar_to_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wallet` int DEFAULT NULL,
  `level` int NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'img/default.jpg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Alexis','alexisdev@gmail.com',NULL,'$2y$10$wc2z38IhPfiPvfSqHh2REeMdIauVjcjv/KmNiFNbzXKFvWgI71E1y',NULL,'2023-10-05 12:39:43','2023-10-06 07:59:24',80700,1,'img/default.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-06 14:33:12
