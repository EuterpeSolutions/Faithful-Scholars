# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.22)
# Database: FaithfulScholars
# Generation Time: 2018-06-23 18:44:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table eoy
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eoy`;

CREATE TABLE `eoy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) unsigned NOT NULL,
  `initial_1` varchar(11) NOT NULL DEFAULT '',
  `initial_2` varchar(11) NOT NULL DEFAULT '',
  `initial_3` varchar(11) NOT NULL DEFAULT '',
  `initial_4` varchar(11) NOT NULL DEFAULT '',
  `initial_5` varchar(11) NOT NULL DEFAULT '',
  `initial_6` varchar(11) NOT NULL DEFAULT '',
  `initial_7` varchar(11) NOT NULL DEFAULT '',
  `submitted_worksheet` tinyint(1) NOT NULL,
  `dual_enrollment` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  CONSTRAINT `eoy_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table family
# ------------------------------------------------------------

DROP TABLE IF EXISTS `family`;

CREATE TABLE `family` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `zip` varchar(255) NOT NULL DEFAULT '',
  `county` varchar(255) NOT NULL DEFAULT '',
  `new` tinyint(1) DEFAULT NULL,
  `mom_cell` varchar(10) DEFAULT NULL,
  `dad_cell` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(20) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `family` WRITE;
/*!40000 ALTER TABLE `family` DISABLE KEYS */;

INSERT INTO `family` (`id`, `father_name`, `mother_name`, `address`, `city`, `zip`, `county`, `new`, `mom_cell`, `dad_cell`, `email`, `phone`, `first_name`, `last_name`, `district`)
VALUES
	(1,'Steve','Carol','123 Test Street','Test Cityzzz','12345','YORK',0,'1234567891','1234567891','pmatt42@gmail.com','1234567891','Steve','Rogers','York 01'),
	(2,'Abe','Beta','1234 Who?','Whereverville','12345','',NULL,NULL,NULL,'beta@email.com','1231231233','Test','Beta','YORK2'),
	(63,NULL,NULL,'P.O. Box 224, 8377 Faucibus. Rd.','Lidköping','9862','Västra Götalands län',NULL,NULL,NULL,'et.lacinia.vitae@non.com','1-721-847-7646','Graiden','Bates','YORK1'),
	(64,NULL,NULL,'205-6709 Nec, Road','Brugge Bruges','51022','West-Vlaanderen',NULL,NULL,NULL,'a.auctor.non@lobortisrisusIn.com','1-456-767-4065','Brandon','Oneil',NULL),
	(65,NULL,NULL,'P.O. Box 922, 9598 Orci. Rd.','Jaén','52024-095','AN',NULL,NULL,NULL,'eu.accumsan.sed@semutcursus.net','1-638-721-4054','Alexandra','Sanchez',NULL),
	(66,NULL,NULL,'409-9691 Nullam Rd.','Pointe-du-Lac','441501','QC',NULL,NULL,NULL,'dis.parturient.montes@Pellentesquehabitantmorbi.edu','1-690-788-0287','Macey','Bruce',NULL),
	(67,NULL,NULL,'P.O. Box 164, 3172 Aliquam Street','Lo Prado','44767','Metropolitana de Santiago',NULL,NULL,NULL,'elit.Etiam@Phasellusdolorelit.ca','1-331-287-9611','Paul','Boyle',NULL),
	(68,NULL,NULL,'239 Dolor St.','Okene','30608','Kogi',NULL,NULL,NULL,'dignissim@metusfacilisis.edu','1-155-655-1398','Farrah','Briggs',NULL),
	(69,NULL,NULL,'P.O. Box 326, 4558 Interdum Rd.','Kirkland','42549','QC',NULL,NULL,NULL,'Suspendisse@turpis.net','1-728-616-4386','Jael','Moreno',NULL),
	(70,NULL,NULL,'P.O. Box 533, 1732 Dapibus Avenue','Galway','4275','C',NULL,NULL,NULL,'adipiscing@dolor.com','1-338-372-0573','Warren','Wade',NULL),
	(71,NULL,NULL,'624-1012 Nunc Avenue','Bremerhaven','U51 7TD','Bremen',NULL,NULL,NULL,'vel.vulputate@mifringilla.ca','1-299-530-5815','Eleanor','Graham',NULL),
	(72,NULL,NULL,'Ap #171-4073 Libero Avenue','Katsina','177430','Katsina',NULL,NULL,NULL,'a.malesuada@lobortis.co.uk','1-190-902-0171','Basil','Holloway',NULL),
	(73,NULL,NULL,'7653 Justo. Rd.','Aartrijke','76369','West-Vlaanderen',NULL,NULL,NULL,'a.mi@facilisis.co.uk','1-128-276-5658','Derek','Webb',NULL),
	(74,NULL,NULL,'Ap #885-3989 Fermentum St.','Nova Iguaçu','5002','RJ',NULL,NULL,NULL,'id.erat@at.net','1-198-905-2499','Zephania','Trevino',NULL),
	(75,NULL,NULL,'4998 Ullamcorper, Rd.','Istanbul','678071','Ist',NULL,NULL,NULL,'Mauris.non@blanditcongue.net','1-505-420-4883','Thor','Valenzuela',NULL),
	(76,NULL,NULL,'P.O. Box 808, 7501 Fermentum St.','Swan Hill','8542','VIC',NULL,NULL,NULL,'arcu.vel.quam@nisiMauris.co.uk','1-859-372-8445','Zachary','Blankenship',NULL),
	(77,NULL,NULL,'7488 Eleifend Ave','Florenville','34353','LX',NULL,NULL,NULL,'a.tortor.Nunc@orciin.edu','1-608-430-9698','Rachel','Adkins',NULL),
	(78,NULL,NULL,'Ap #371-5747 Posuere Avenue','Zierikzee','8384','Zeeland',NULL,NULL,NULL,'metus.sit@sem.co.uk','1-532-403-1077','Madeson','Franklin',NULL),
	(79,NULL,NULL,'8053 Sem Road','Tarnów','69-249','Małopolskie',NULL,NULL,NULL,'tristique.pellentesque.tellus@convallis.edu','1-842-838-4673','Xena','Franco',NULL),
	(80,NULL,NULL,'P.O. Box 771, 1152 Phasellus Rd.','Huissen','382997','Gelderland',NULL,NULL,NULL,'Phasellus.in.felis@duiCumsociis.edu','1-792-841-9572','Francesca','Stein',NULL),
	(81,NULL,NULL,'232-1618 Lacus. St.','Słupsk','3491','PM',NULL,NULL,NULL,'fringilla.porttitor.vulputate@malesuada.net','1-890-425-6392','Hakeem','Marsh',NULL),
	(82,NULL,NULL,'P.O. Box 677, 6901 Ut Rd.','Dandenong','4262','Victoria',NULL,NULL,NULL,'odio@pretiumetrutrum.net','1-333-340-8507','Karyn','Reeves',NULL),
	(83,NULL,NULL,'615-1888 Erat Street','Castelló','341360','Comunitat Valenciana',NULL,NULL,NULL,'adipiscing@nullaat.com','1-122-962-6696','Maite','Douglas',NULL),
	(84,NULL,NULL,'7810 Molestie Av.','Pilibhit','423378','Uttar Pradesh',NULL,NULL,NULL,'diam@egestasAliquamfringilla.co.uk','1-771-917-8597','Karen','Puckett',NULL),
	(85,NULL,NULL,'P.O. Box 514, 1847 Nisi Rd.','Aisén','K89 8GX','XIV',NULL,NULL,NULL,'Phasellus.fermentum@non.co.uk','1-469-939-4475','Gil','Robles',NULL),
	(86,NULL,NULL,'1674 Ligula Avenue','Green Bay','85970','Wisconsin',NULL,NULL,NULL,'Nulla.tincidunt@porttitor.com','1-310-883-4333','Katell','Vasquez',NULL),
	(87,NULL,NULL,'975 Non Rd.','Cork','TG4I 8NV','M',NULL,NULL,NULL,'dignissim@Suspendissealiquet.net','1-331-540-5089','Xyla','Nolan',NULL),
	(88,NULL,NULL,'Ap #284-1275 Risus. St.','Leamington','50612','Ontario',NULL,NULL,NULL,'ante.Vivamus.non@ipsumPhasellusvitae.edu','1-843-154-0944','Desiree','Hahn',NULL),
	(89,NULL,NULL,'P.O. Box 506, 5303 At Rd.','Santa Maria','GQ4 1MC','Rio Grande do Sul',NULL,NULL,NULL,'ac@turpisnon.edu','1-464-338-2648','Octavius','Sullivan',NULL),
	(90,NULL,NULL,'1323 Interdum. Street','Wellington','4515','North Island',NULL,NULL,NULL,'semper@ac.net','1-736-422-3228','Zephr','Miller',NULL),
	(91,NULL,NULL,'Ap #241-2861 Et Av.','Providencia','382561','Metropolitana de Santiago',NULL,NULL,NULL,'venenatis.a.magna@vitaealiquameros.org','1-999-975-1326','Hall','Vaughn',NULL),
	(92,NULL,NULL,'Ap #712-9646 Nunc Rd.','Devonport','3435','Tasmania',NULL,NULL,NULL,'amet@egestashendrerit.co.uk','1-389-943-7695','Iliana','Callahan',NULL),
	(93,NULL,NULL,'340-7392 Gravida. Avenue','Stourbridge','36872','Worcestershire',NULL,NULL,NULL,'ligula@atfringillapurus.edu','1-812-122-3064','Lani','Rogers',NULL),
	(94,NULL,NULL,'Ap #391-9309 Rhoncus. Street','Wellington','20968','North Island',NULL,NULL,NULL,'at.auctor@arcuCurabiturut.edu','1-854-830-4403','Wynne','Burton',NULL),
	(95,NULL,NULL,'938-4168 Cum Ave','Sasaram','387781','BR',NULL,NULL,NULL,'malesuada.vel.venenatis@Donec.edu','1-679-484-6977','Levi','Vance',NULL),
	(96,NULL,NULL,'P.O. Box 896, 2617 Dolor. Ave','Qutubullapur','P7W 8X9','Andhra Pradesh',NULL,NULL,NULL,'Nunc.sed.orci@luctus.co.uk','1-728-164-1119','Jasper','Mcintosh',NULL),
	(97,NULL,NULL,'5412 Magna. St.','Vienna','1054','Vienna',NULL,NULL,NULL,'consectetuer.rhoncus@Morbivehicula.org','1-879-741-2437','Jenna','Bennett',NULL),
	(98,NULL,NULL,'P.O. Box 249, 9258 Odio. St.','Bath','016593','ON',NULL,NULL,NULL,'mauris.Suspendisse.aliquet@feugiat.net','1-719-534-9067','Ezekiel','Cote',NULL),
	(99,NULL,NULL,'Ap #947-2266 Velit. Street','Waalwijk','52594','Noord Brabant',NULL,NULL,NULL,'ut.nisi@fames.co.uk','1-177-890-9302','Barrett','Cash',NULL),
	(100,NULL,NULL,'Ap #694-6423 Aliquet Street','San Marcello Pistoiese','99967','Toscana',NULL,NULL,NULL,'erat.nonummy.ultricies@ultricesDuisvolutpat.org','1-436-959-7067','Janna','Giles',NULL),
	(101,NULL,NULL,'Ap #740-2376 Arcu Road','Rochester','8181','Minnesota',NULL,NULL,NULL,'et.netus.et@arcu.com','1-891-874-4388','Cecilia','Jones',NULL),
	(102,NULL,NULL,'763-3340 Blandit. Av.','Iowa City','93925-657','IA',NULL,NULL,NULL,'nulla.magna@egestaslacinia.org','1-101-353-0003','Octavia','Hatfield',NULL),
	(103,NULL,NULL,'P.O. Box 333, 5275 Egestas, Road','Wodonga','S6 9UY','VIC',NULL,NULL,NULL,'quam@eget.ca','1-129-477-2689','Tyrone','Farley',NULL),
	(104,NULL,NULL,'149-579 Est Ave','Juneau','6168 AN','Alaska',NULL,NULL,NULL,'vestibulum.Mauris@aptent.org','1-414-536-3036','Haley','Mcgee',NULL),
	(105,NULL,NULL,'908-3983 Cum St.','Tauranga','45387','North Island',NULL,NULL,NULL,'aliquet.metus@euultrices.edu','1-742-522-6097','Sigourney','Kirkland',NULL),
	(106,NULL,NULL,'P.O. Box 668, 4634 Dictum Road','Moulins','171466','Auvergne',NULL,NULL,NULL,'commodo.tincidunt@egetdictumplacerat.org','1-992-783-1669','Heather','Boyd',NULL),
	(107,NULL,NULL,'P.O. Box 999, 1781 Accumsan Avenue','Trollhättan','756921','O',NULL,NULL,NULL,'cursus.a.enim@quisdiam.org','1-950-718-9898','Salvador','Morton',NULL),
	(108,NULL,NULL,'Ap #545-6680 Semper Avenue','Tumba','46206','Stockholms län',NULL,NULL,NULL,'Donec.tempus.lorem@Donecfelis.edu','1-128-851-7598','Chaim','Hardin',NULL),
	(109,NULL,NULL,'Ap #615-7266 Egestas. Ave','Merthyr Tydfil','V2P 4M4','Glamorgan',NULL,NULL,NULL,'ut.cursus@nonummyipsum.ca','1-221-518-6430','Ann','Irwin',NULL),
	(110,NULL,NULL,'P.O. Box 670, 9680 Non, Avenue','Hull','15774','Quebec',NULL,NULL,NULL,'adipiscing.elit@ametmetus.ca','1-689-782-9137','Wynter','Michael',NULL),
	(111,NULL,NULL,'Ap #661-4660 Enim, Road','Pelluhue','9634','VII',NULL,NULL,NULL,'et.libero.Proin@euelit.net','1-495-415-4659','Aaron','Melton',NULL),
	(112,NULL,NULL,'Ap #278-399 Hendrerit Avenue','Souvret','18-473','HE',NULL,NULL,NULL,'feugiat.non.lobortis@libero.org','1-966-988-4770','Maxine','Cooper',NULL),
	(113,NULL,NULL,'292-4571 Duis Av.','Cambrai','Y5A 8G6','NO',NULL,NULL,NULL,'Donec.feugiat@neccursus.co.uk','1-303-728-0099','Rylee','Webb',NULL),
	(114,NULL,NULL,'P.O. Box 355, 7606 Nascetur Av.','Springdale','1747','AK',NULL,NULL,NULL,'commodo.at@amet.com','1-563-688-6135','Elmo','Moore',NULL),
	(115,NULL,NULL,'744-6692 Ligula. Av.','Raipur','7791','CT',NULL,NULL,NULL,'at.auctor.ullamcorper@Craslorem.com','1-232-871-5522','Chase','Potter',NULL),
	(116,NULL,NULL,'189-6839 Posuere Avenue','Przemyśl','74500-528','Podkarpackie',NULL,NULL,NULL,'lacus.Quisque@elitpharetra.org','1-684-914-5083','Kai','Jefferson',NULL),
	(117,NULL,NULL,'P.O. Box 225, 3494 Consectetuer Street','Aachen','737194','NW',NULL,NULL,NULL,'magna@imperdietnon.org','1-643-160-6679','Malik','Walter',NULL),
	(118,NULL,NULL,'501-2877 Ultrices, St.','Cobourg','17681','Ontario',NULL,NULL,NULL,'Suspendisse.sagittis@facilisis.ca','1-177-707-6927','Desiree','Kirkland',NULL),
	(119,NULL,NULL,'8021 Mauris, Ave','Mont-de-Marsan','24-616','Aquitaine',NULL,NULL,NULL,'Nunc.ullamcorper.velit@ac.net','1-769-720-3130','Sebastian','Phillips',NULL),
	(120,NULL,NULL,'P.O. Box 880, 4702 Risus Rd.','Overland Park','57198','KS',NULL,NULL,NULL,'ipsum.dolor.sit@cursuspurusNullam.co.uk','1-166-358-2558','Ila','Albert',NULL),
	(121,NULL,NULL,'4311 Nec, Ave','Maranguape','X1K 1W7','Ceará',NULL,NULL,NULL,'metus@Nulla.edu','1-200-416-6675','Tara','Leonard',NULL),
	(122,NULL,NULL,'186-8331 Mauris St.','Whyalla','64548','South Australia',NULL,NULL,NULL,'Donec@acmattissemper.net','1-903-118-7308','Pearl','Henderson',NULL),
	(123,NULL,NULL,'Ap #238-1873 Proin Av.','Berlin','5616','BE',NULL,NULL,NULL,'vitae@porttitorscelerisqueneque.ca','1-857-697-4949','Shaeleigh','Rice',NULL),
	(124,NULL,NULL,'416-5215 Tincidunt St.','Tokoroa','44498','NI',NULL,NULL,NULL,'posuere.cubilia.Curae@Duisa.org','1-383-885-8724','Olivia','Frye',NULL),
	(125,NULL,NULL,'P.O. Box 587, 487 Dolor Rd.','Rothesay','47366','Buteshire',NULL,NULL,NULL,'molestie@aliquameros.org','1-822-950-6421','Levi','Boone',NULL),
	(126,NULL,NULL,'Ap #590-4798 Id St.','Upplands Väsby','33619','AB',NULL,NULL,NULL,'metus@etmalesuada.com','1-271-615-1666','Perry','Galloway',NULL),
	(127,NULL,NULL,'2400 Cras Rd.','Croydon','4035','Surrey',NULL,NULL,NULL,'vitae@imperdietnon.edu','1-203-648-7323','Wanda','Maddox',NULL),
	(128,NULL,NULL,'Ap #982-625 Egestas. St.','Vienna','DI1 6MS','Wie',NULL,NULL,NULL,'pretium@Mauris.edu','1-197-888-2459','Derek','Collier',NULL),
	(129,NULL,NULL,'P.O. Box 327, 6533 Nonummy. Rd.','Modakeke','96894','OS',NULL,NULL,NULL,'Aliquam.tincidunt@mollisDuissit.edu','1-831-834-6758','Linus','Olsen',NULL),
	(130,NULL,NULL,'Ap #138-7062 Sed Rd.','San Rafael','113399','Cartago',NULL,NULL,NULL,'molestie.tortor@enimEtiam.ca','1-866-635-1477','Michael','Crawford',NULL),
	(131,NULL,NULL,'Ap #495-454 Metus Street','Belfast','3774 ER','U',NULL,NULL,NULL,'scelerisque@anteipsum.org','1-237-400-6105','Axel','Garcia',NULL),
	(132,NULL,NULL,'9047 Donec St.','Lexington','548009','KY',NULL,NULL,NULL,'Donec.consectetuer.mauris@lobortisrisus.com','1-681-449-7140','Melyssa','Stuart',NULL),
	(133,NULL,NULL,'Ap #968-7066 Est. Av.','Lourdes','R7G 0H7','MB',NULL,NULL,NULL,'Ut.nec.urna@etnetuset.net','1-679-690-2318','Lillian','Leach',NULL),
	(134,NULL,NULL,'P.O. Box 621, 972 Orci St.','Bonavista','62713','Newfoundland and Labrador',NULL,NULL,NULL,'malesuada@amet.org','1-661-650-1854','Keane','Buckner',NULL),
	(135,NULL,NULL,'P.O. Box 192, 4265 Pellentesque Av.','San Juan de Dios','761647','San José',NULL,NULL,NULL,'orci.luctus.et@nibhenim.org','1-661-944-5267','Uriel','Dickerson',NULL),
	(136,NULL,NULL,'Ap #416-6935 Ut, St.','New Plymouth','S8A 5B2','North Island',NULL,NULL,NULL,'ante.blandit@gravidamolestie.ca','1-891-385-0222','Daquan','Waller',NULL),
	(137,NULL,NULL,'4894 Quisque Street','Hyères','32093','PR',NULL,NULL,NULL,'ipsum.non.arcu@Duis.edu','1-785-709-6564','Todd','Britt',NULL),
	(138,NULL,NULL,'Ap #232-2019 Aliquam Street','San Isidro de El General','06892','San José',NULL,NULL,NULL,'Quisque.libero.lacus@massalobortisultrices.ca','1-432-713-8960','Cairo','Knight',NULL),
	(139,NULL,NULL,'7329 Nulla. Rd.','Cork','01523','M',NULL,NULL,NULL,'lacus@arcuVivamus.ca','1-453-237-4206','Colorado','Davidson',NULL),
	(140,NULL,NULL,'P.O. Box 692, 4791 Eu Ave','Suwałki','92718','PD',NULL,NULL,NULL,'Maecenas.libero.est@blanditcongue.edu','1-950-541-0367','Ulysses','Cross',NULL),
	(141,NULL,NULL,'Ap #522-7014 Metus. Rd.','Beaumaris','8277','Anglesey',NULL,NULL,NULL,'a.odio@et.net','1-627-350-4034','Peter','Morris',NULL),
	(142,NULL,NULL,'Ap #137-6087 Sit St.','Kano','3577','Kano',NULL,NULL,NULL,'mi.lorem.vehicula@volutpatNullafacilisis.org','1-411-973-7377','May','Wade',NULL),
	(143,NULL,NULL,'2808 Inceptos Ave','Fort Smith','51445','AK',NULL,NULL,NULL,'Donec.elementum.lorem@fringillaDonec.co.uk','1-987-556-5246','Alana','Nicholson',NULL),
	(144,NULL,NULL,'P.O. Box 441, 5662 Sollicitudin Rd.','San José','791664','San José',NULL,NULL,NULL,'montes.nascetur.ridiculus@varius.ca','1-215-425-2866','Salvador','Herman',NULL),
	(145,NULL,NULL,'Ap #231-9055 Adipiscing Ave','Wanaka','87157','SI',NULL,NULL,NULL,'enim.consequat.purus@nisiaodio.ca','1-376-866-1968','Nicholas','Freeman',NULL),
	(146,NULL,NULL,'3815 Vitae Avenue','Berlin','43600','BE',NULL,NULL,NULL,'libero.lacus@eusemPellentesque.com','1-877-328-6508','Amery','Mcguire',NULL),
	(147,NULL,NULL,'P.O. Box 340, 3542 Adipiscing Rd.','Blenheim','5490','South Island',NULL,NULL,NULL,'dis.parturient@diam.net','1-895-310-6287','Lisandra','Hancock',NULL),
	(148,NULL,NULL,'5023 Eleifend. Street','Istanbul','87513','Istanbul',NULL,NULL,NULL,'aliquet@odio.com','1-602-797-3116','Alyssa','Snow',NULL),
	(149,NULL,NULL,'Ap #994-3745 Quis Rd.','Jette','64-909','BU',NULL,NULL,NULL,'Pellentesque.habitant.morbi@ut.ca','1-287-772-2592','Holmes','Stout',NULL),
	(150,NULL,NULL,'1063 Elementum Rd.','Porirua','51322','NI',NULL,NULL,NULL,'eget.tincidunt@lectusNullam.org','1-891-698-1050','Paula','Mathews',NULL),
	(151,NULL,NULL,'Ap #132-1903 Convallis Ave','San Cristóbal de la Laguna','716931','Canarias',NULL,NULL,NULL,'accumsan@feugiatSednec.co.uk','1-483-884-7098','Alden','Hoffman',NULL),
	(152,NULL,NULL,'P.O. Box 212, 2489 Ultrices Rd.','İzmit','44141','Koc',NULL,NULL,NULL,'Aliquam.auctor.velit@lacinia.edu','1-640-229-4296','MacKensie','Walker',NULL),
	(153,NULL,NULL,'P.O. Box 318, 9078 Sed Road','Pali','18681','RJ',NULL,NULL,NULL,'enim.diam.vel@sem.com','1-229-841-0433','Cody','Spencer',NULL),
	(154,NULL,NULL,'562 Et Rd.','Allappuzha','67347','Kerala',NULL,NULL,NULL,'ipsum.Donec@pellentesquea.ca','1-657-590-0175','Evelyn','Carey',NULL),
	(155,NULL,NULL,'6502 Tempor St.','Wigtown','14326','Wigtownshire',NULL,NULL,NULL,'convallis.in.cursus@hendrerita.com','1-423-161-1103','Berk','Whitney',NULL),
	(156,NULL,NULL,'P.O. Box 493, 6129 Hymenaeos. Avenue','Poitiers','18-954','Poitou-Charentes',NULL,NULL,NULL,'adipiscing.elit.Aliquam@sollicitudin.org','1-536-892-6118','Aladdin','Chapman',NULL),
	(157,NULL,NULL,'P.O. Box 363, 7474 Mauris Road','Tiel','75702','Gelderland',NULL,NULL,NULL,'id@metusfacilisis.com','1-559-144-1417','Halla','Mckinney',NULL),
	(158,NULL,NULL,'P.O. Box 378, 5787 Euismod St.','Waiheke Island','60820','NI',NULL,NULL,NULL,'ut@Proin.edu','1-754-950-3075','Maryam','Pugh',NULL),
	(159,NULL,NULL,'673-3169 Vivamus Av.','Curacaví','28413','Metropolitana de Santiago',NULL,NULL,NULL,'In.lorem@Maecenasmi.net','1-226-802-8663','Lillian','Koch',NULL),
	(160,NULL,NULL,'714-5501 Imperdiet Road','Kungälv','754218','Västra Götalands län',NULL,NULL,NULL,'Donec.vitae.erat@Integeraliquamadipiscing.org','1-342-253-0463','Willa','Eaton',NULL),
	(161,NULL,NULL,'P.O. Box 666, 7209 Risus Rd.','Gloucester','27473','Ontario',NULL,NULL,NULL,'mattis@seddictumeleifend.edu','1-110-523-0722','Guinevere','Jefferson',NULL),
	(162,NULL,NULL,'P.O. Box 353, 907 Fringilla Avenue','Galway','71205','C',NULL,NULL,NULL,'vitae.semper.egestas@ridiculusmus.edu','1-391-130-3414','Scarlet','Short',NULL),
	(163,NULL,NULL,'','','','',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),
	(164,'Clive','Barbra','1234 Peachtree Ln','Fort Mill','29708','York',0,'','','test@email.com','8037922216',NULL,'Solomon',NULL),
	(165,NULL,NULL,'','','','',NULL,NULL,NULL,'',NULL,NULL,'Test',NULL),
	(166,'Test','test','','','','',NULL,NULL,NULL,'',NULL,NULL,'Test',NULL),
	(167,'Test','test','test','test','12345','test',NULL,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(168,'Test','test','test','test','12345','test',NULL,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(169,'Test','test','test','test','12345','test',NULL,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(170,'Test','test','test','test','12345','test',NULL,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(171,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(172,'','','','','','',0,'','','','',NULL,'',NULL),
	(173,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(174,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(175,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(176,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(177,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(178,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(179,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(180,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(181,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(182,'Test','test','test','test','12345','test',0,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(183,'','','','','','',0,'','','','',NULL,'',NULL),
	(184,'','','','','','',0,'','','','',NULL,'',NULL),
	(185,'','','','','','',0,'','','','',NULL,'',NULL),
	(186,'','','','','','',0,'','','','',NULL,'',NULL),
	(187,'','','','','','',0,'','','','',NULL,'',NULL),
	(188,'','','','','','',0,'','','','',NULL,'',NULL),
	(189,'','','','','','',0,'','','','',NULL,'',NULL),
	(190,'','','','','','',0,'','','','',NULL,'',NULL),
	(191,'','','','','','',0,'','','','',NULL,'',NULL),
	(192,'','','','','','',0,'','','','',NULL,'',NULL),
	(193,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(194,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(195,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(196,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(197,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(198,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(199,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(200,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(201,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(202,'','','','','','',0,'','','','',NULL,'',NULL),
	(203,'','','','','','',0,'','','','',NULL,'',NULL),
	(204,'','','','','','',0,'','','','',NULL,'',NULL),
	(205,'','','','','','',0,'','','','',NULL,'',NULL),
	(206,'','','','','','',0,'','','','',NULL,'',NULL),
	(207,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(208,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(209,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(210,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(211,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(212,'Test','test','test','test','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'Test',NULL),
	(213,NULL,NULL,'123 Test Street','Test City','12345','YORK',NULL,NULL,NULL,'pmatt42@gmail.com','1234567891','Steve','Rogers',NULL),
	(214,'Andrew','Debbie','1355 Lurecliff Pl','Fort Mill','29708','York',0,'','','moon.tyler@gmail.com','8037922216',NULL,'Moon',NULL),
	(215,'Andrew','Debbie','1355 Lurecliff Pl','Fort Mill','29708','York',1,'','','','8037922216',NULL,'Moon',NULL),
	(216,'','','','','','',1,'','','','',NULL,'',NULL),
	(217,'test','test','123 test st','test city','12345','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'test',NULL),
	(218,'test','test','test 123','test city','1234','test',1,'1231231234','1231231234','test@test.com','1231231234',NULL,'test',NULL),
	(219,'','','','','','',0,'','','','',NULL,'',NULL),
	(220,'','','','','','',0,'','','','',NULL,'',NULL),
	(221,'','','','','','',0,'','','','',NULL,'',NULL),
	(222,'','','','','','',0,'','','','',NULL,'',NULL),
	(223,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'t',NULL),
	(224,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(225,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(226,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(227,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(228,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(229,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(230,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(231,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(232,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(233,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(234,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(235,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL),
	(236,'t','t','t','t','t','t',1,'t','t','t','t',NULL,'test',NULL);

/*!40000 ALTER TABLE `family` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table homeschool
# ------------------------------------------------------------

DROP TABLE IF EXISTS `homeschool`;

CREATE TABLE `homeschool` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) unsigned NOT NULL,
  `school_start_date` varchar(255) DEFAULT NULL,
  `school_end_date` varchar(255) DEFAULT NULL,
  `new_homeschool` tinyint(1) DEFAULT NULL,
  `years_homeschooling` int(255) DEFAULT NULL,
  `primary_instructor` varchar(25) DEFAULT NULL,
  `removing_public_school` varchar(255) DEFAULT NULL,
  `referred_by` varchar(255) DEFAULT NULL,
  `school_district` varchar(255) DEFAULT NULL,
  `school_fax` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `familyId` (`family_id`),
  CONSTRAINT `homeschool_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `homeschool` WRITE;
/*!40000 ALTER TABLE `homeschool` DISABLE KEYS */;

INSERT INTO `homeschool` (`id`, `family_id`, `school_start_date`, `school_end_date`, `new_homeschool`, `years_homeschooling`, `primary_instructor`, `removing_public_school`, `referred_by`, `school_district`, `school_fax`)
VALUES
	(1,1,'5/24/2018','5/25/2018',0,3,'Steve Roger','',NULL,NULL,NULL),
	(2,172,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(3,176,'1/1/12','3/23/13',NULL,4,'TT','yes','TT','TT',''),
	(4,177,'1/1/12','3/23/13',NULL,4,'TT','yes','TT','TT',''),
	(5,178,'1/1/12','3/23/13',NULL,4,'TT','yes','TT','TT',''),
	(6,179,'1/1/12','3/23/13',0,4,'TT','yes','TT','TT',''),
	(7,180,'1/1/12','3/23/13',0,4,'TT','yes','TT','TT',''),
	(8,181,'1/1/12','3/23/13',0,4,'TT','yes','TT','TT',''),
	(9,182,'1/1/12','3/23/13',0,4,'TT','yes','TT','TT',''),
	(10,193,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(11,194,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(12,195,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(13,196,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(14,197,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(15,198,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(16,199,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(17,200,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(18,201,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(19,207,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(20,208,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(21,209,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(22,210,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(23,211,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(24,212,'12/1/17','12/1/17',1,4,'TT','no','TT','TT','12345'),
	(25,214,'8/20/18','4/14/19',0,2,'Debbie','no','','York 1',''),
	(26,215,'8/20/18','4/14/19',1,2,'Debbie','no','','York 1',''),
	(27,217,'10/10/10','10/10/11',1,1,'','no','','',''),
	(28,218,'12/12/12','12/12/13',1,1,'test','no','','',''),
	(29,223,'t','t',1,1,'','no','','','');

/*!40000 ALTER TABLE `homeschool` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL DEFAULT '',
  `psalt` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT '',
  `family_id` int(11) NOT NULL,
  `admin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`id`, `username`, `psalt`, `password`, `email`, `family_id`, `admin`)
VALUES
	(1,'john','s*vl%/?s8b*b4}b/w%w4','75b4e8e5ecccdf843df41a32077707eb6b97981f5d3ab6c235f1158bf4950145','pmatt42@gmail.com',1,1),
	(2,'tmoon','0e07cf830957701d43c183f1515f63e6b68027e528f43ef52b1527a520ddec82','6ca2088fa4d6db9ed2fcaba78c508c3568cf0fea0bec5420404e0d5f76297d85','t',235,0);

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table membership
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membership`;

CREATE TABLE `membership` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) unsigned NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `highschool` int(11) DEFAULT NULL,
  `replacement_card` tinyint(1) DEFAULT NULL,
  `schea` tinyint(1) DEFAULT NULL,
  `enchanted_learning` tinyint(1) DEFAULT NULL,
  `expedited` tinyint(1) DEFAULT NULL,
  `initial_1` varchar(11) NOT NULL DEFAULT '',
  `initial_2` varchar(11) NOT NULL DEFAULT '',
  `initial_3` varchar(11) NOT NULL DEFAULT '',
  `initial_4` varchar(11) NOT NULL DEFAULT '',
  `initial_5` varchar(11) NOT NULL DEFAULT '',
  `initial_6` varchar(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`),
  CONSTRAINT `membership_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `membership_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `membership` WRITE;
/*!40000 ALTER TABLE `membership` DISABLE KEYS */;

INSERT INTO `membership` (`id`, `family_id`, `type_id`, `highschool`, `replacement_card`, `schea`, `enchanted_learning`, `expedited`, `initial_1`, `initial_2`, `initial_3`, `initial_4`, `initial_5`, `initial_6`)
VALUES
	(1,1,1,0,1,1,1,1,'t','SR','SR','SR','t','t'),
	(2,196,1,75,3,15,10,20,'TE','TE','TE','TE','TE','TE'),
	(3,197,1,75,3,15,10,1,'TE','TE','TE','TE','TE','TE'),
	(4,198,1,75,3,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(5,199,1,75,1,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(6,200,1,75,1,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(7,201,1,75,1,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(9,207,1,75,1,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(10,208,1,75,0,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(11,209,1,75,1,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(12,210,1,75,1,1,1,0,'TE','TE','TE','TE','TE','TE'),
	(13,211,1,75,1,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(14,212,1,75,1,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(15,213,1,0,0,0,0,0,'t','','','','t','t'),
	(16,214,1,150,1,1,0,0,'DM','DM','DM','DM','DM','DM'),
	(17,215,1,150,1,1,1,1,'DM','DM','DM','DM','DM','DM'),
	(18,216,1,0,1,0,0,0,'','','','','',''),
	(19,217,1,75,1,0,0,0,'TE','TE','TE','TE','TE','TE'),
	(20,218,1,75,1,1,1,1,'TE','TE','TE','TE','TE','TE'),
	(21,223,1,0,1,1,1,1,'TE','TE','TE','TE','t','t'),
	(22,224,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(23,225,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(24,226,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(25,227,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(26,228,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(27,229,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(28,230,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(29,231,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(30,232,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(31,233,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(32,234,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(33,235,1,0,1,1,1,1,'t','t','t','t','t','t'),
	(34,236,1,0,1,1,1,1,'t','t','t','t','t','t');

/*!40000 ALTER TABLE `membership` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table membership_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membership_types`;

CREATE TABLE `membership_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `membership_types` WRITE;
/*!40000 ALTER TABLE `membership_types` DISABLE KEYS */;

INSERT INTO `membership_types` (`id`, `name`, `price`)
VALUES
	(1,'kindergarten',25),
	(2,'single-student',35),
	(3,'multi-student',60);

/*!40000 ALTER TABLE `membership_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table student
# ------------------------------------------------------------

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `grade` int(11) NOT NULL,
  `age` int(11) NOT NULL DEFAULT '0',
  `birthday` varchar(11) NOT NULL DEFAULT '',
  `curriculum_desc` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;

INSERT INTO `student` (`id`, `family_id`, `name`, `grade`, `age`, `birthday`, `curriculum_desc`)
VALUES
	(1,1,'Kevin',11,7,'11/01/2011','Whatever he wants :)'),
	(3,2,'Test',10,0,'11',''),
	(4,63,'John',11,0,'10/10/2012',''),
	(5,1,'Bobby',12,4,'12/12/12',''),
	(6,211,'TestStudent',12,12,'','121121212'),
	(7,1,'TestStudent',12,12,'12','121121212'),
	(8,214,'Tyler',12,17,'08/21/1996','Some cool stuff'),
	(9,214,'Dalton',10,15,'06/15/1998','Other cool stuff'),
	(10,215,'Tyler',12,17,'08/21/1996','Some cool stuff'),
	(11,215,'Dalton',10,15,'06/15/1998','Other cool stuff'),
	(12,217,'Test Kid',1,1,'12/12/12','test test test test test test'),
	(13,218,'Test Kid 2',12,1,'12','12sljdfkldsfjlkdfsljkdfsljkdfsjlkdfsjkdfs'),
	(14,223,'t',1,1,'ttt','1t');

/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
