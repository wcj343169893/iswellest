/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.0.51b-community-nt : Database - food
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`food` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `food`;

/*Table structure for table `carts` */

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` char(36) collate utf8_unicode_ci NOT NULL default '',
  `sessionid` varchar(255) collate utf8_unicode_ci default NULL,
  `product_id` char(36) collate utf8_unicode_ci default NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `weight` decimal(6,2) default NULL,
  `price` decimal(6,2) default NULL,
  `quantity` int(11) default NULL,
  `weight_total` decimal(6,2) default NULL,
  `subtotal` decimal(6,2) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `carts` */

insert  into `carts`(`id`,`sessionid`,`product_id`,`name`,`weight`,`price`,`quantity`,`weight_total`,`subtotal`,`created`,`modified`) values ('51bdc462-477c-46fa-8dc0-13902c83eaf2','54f5456908237a35aaad5aad58fe381c','65','Basa',NULL,'5.50',1,'0.00','5.50','2013-06-16 13:57:54','2013-06-16 13:58:43'),('51c68dd3-5ea4-4cb9-9cf0-10982c83eaf2','e9ae6b68919af0490c433851738adce9','57','Japanese spider crab','2.00','9.80',1,'2.00','19.60','2013-06-23 05:55:31','2013-06-23 05:55:36'),('51c68dd4-9664-4d8d-880c-10982c83eaf2','e9ae6b68919af0490c433851738adce9','56','Cuttlefish','1.00','3.98',1,'1.00','3.98','2013-06-23 05:55:32','2013-06-23 05:55:32'),('51d41ba7-c9e4-4287-8c37-10642c83eaf2','f80be4cba0c86ff53e8913847a05186f','65','Basa','1.00','5.50',1,'1.00','5.50','2013-07-03 12:40:07','2013-07-03 12:40:07'),('51d41efa-1a04-4ce6-a8d7-10642c83eaf2','6663f843ef6818af85aca561e15faa0d','65','Basa','3.00','5.50',1,'3.00','16.50','2013-07-03 12:54:18','2013-07-03 12:54:18'),('51d41f64-4b98-47f2-87fb-10642c83eaf2','6663f843ef6818af85aca561e15faa0d','57','Japanese spider crab','1.00','9.80',1,'1.00','9.80','2013-07-03 12:56:04','2013-07-03 12:56:04'),('51d41f66-24d0-46da-aa0d-10642c83eaf2','6663f843ef6818af85aca561e15faa0d','58','Octopus','1.00','1.28',1,'1.00','1.28','2013-07-03 12:56:06','2013-07-03 12:56:06');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`) values (2,'Fish'),(3,'Shellfish'),(4,'Invertebrates');

/*Table structure for table `order_items` */

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `order_id` char(36) collate utf8_unicode_ci NOT NULL,
  `product_id` char(36) collate utf8_unicode_ci NOT NULL,
  `name` varchar(255) character set utf8 NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` decimal(8,2) unsigned NOT NULL default '0.00',
  `price` decimal(8,2) unsigned NOT NULL,
  `subtotal` decimal(8,2) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

/*Data for the table `order_items` */

insert  into `order_items`(`id`,`order_id`,`product_id`,`name`,`quantity`,`weight`,`price`,`subtotal`,`created`,`modified`) values ('51c675ef-33c8-43a7-84db-10982c83eaf2','51c675ef-cb80-4dd1-8cd1-10982c83eaf2','59','Oysters',1,'1.00','2.60','2.60','2013-06-23 04:13:35','2013-06-23 04:13:35'),('51c675ef-6400-4962-a1ed-10982c83eaf2','51c675ef-cb80-4dd1-8cd1-10982c83eaf2','58','Octopus',1,'1.00','1.28','1.28','2013-06-23 04:13:35','2013-06-23 04:13:35'),('51c675ef-f988-44b2-abaa-10982c83eaf2','51c675ef-cb80-4dd1-8cd1-10982c83eaf2','56','Cuttlefish',1,'1.00','3.98','3.98','2013-06-23 04:13:35','2013-06-23 04:13:35'),('51c689a9-b638-4747-861c-10982c83eaf2','51c689a9-a350-4452-9b76-10982c83eaf2','56','Cuttlefish',1,'1.00','3.98','3.98','2013-06-23 05:37:45','2013-06-23 05:37:45'),('51c689a9-ce9c-4733-99bd-10982c83eaf2','51c689a9-a350-4452-9b76-10982c83eaf2','65','Basa',1,'1.00','5.50','5.50','2013-06-23 05:37:45','2013-06-23 05:37:45');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `phone` varchar(255) collate utf8_unicode_ci default NULL,
  `billing_address` varchar(255) collate utf8_unicode_ci NOT NULL,
  `billing_address2` varchar(255) collate utf8_unicode_ci NOT NULL,
  `billing_city` varchar(255) collate utf8_unicode_ci NOT NULL,
  `billing_zip` varchar(255) collate utf8_unicode_ci NOT NULL,
  `billing_state` varchar(255) collate utf8_unicode_ci NOT NULL,
  `billing_country` varchar(255) collate utf8_unicode_ci NOT NULL,
  `shipping_address` varchar(255) collate utf8_unicode_ci default NULL,
  `shipping_address2` varchar(255) collate utf8_unicode_ci default NULL,
  `shipping_city` varchar(255) collate utf8_unicode_ci default NULL,
  `shipping_zip` varchar(255) collate utf8_unicode_ci default NULL,
  `shipping_state` varchar(255) collate utf8_unicode_ci default NULL,
  `shipping_country` varchar(255) collate utf8_unicode_ci default NULL,
  `weight` decimal(8,2) unsigned NOT NULL default '0.00',
  `order_item_count` int(11) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `tax` decimal(8,2) default '0.00',
  `shipping` decimal(8,2) default '0.00',
  `total` decimal(8,2) unsigned default '0.00',
  `order_type` varchar(255) collate utf8_unicode_ci NOT NULL,
  `authorization` varchar(255) collate utf8_unicode_ci default NULL,
  `transaction` varchar(255) collate utf8_unicode_ci default NULL,
  `status` varchar(255) collate utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) collate utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

/*Data for the table `orders` */

insert  into `orders`(`id`,`first_name`,`last_name`,`email`,`phone`,`billing_address`,`billing_address2`,`billing_city`,`billing_zip`,`billing_state`,`billing_country`,`shipping_address`,`shipping_address2`,`shipping_city`,`shipping_zip`,`shipping_state`,`shipping_country`,`weight`,`order_item_count`,`subtotal`,`tax`,`shipping`,`total`,`order_type`,`authorization`,`transaction`,`status`,`ip_address`,`created`,`modified`) values ('51c6716a-1b24-45c5-804d-10982c83eaf2','buyer','lee','buyer_1349835293_per@163.com','888-888-8888','1 Main St','','San Jose','95131','CA','United States','1 Main St','','San Jose','95131','CA','United States','3.00',3,'16.58','0.00','0.00','16.58','paypal','Failure',NULL,'1','127.0.0.1','2013-06-23 03:54:18','2013-06-23 03:54:18'),('51c671c2-04b8-42b3-a3ab-10982c83eaf2','buyer','lee','buyer_1349835293_per@163.com','888-888-8888','1 Main St','','San Jose','95131','CA','United States','1 Main St','','San Jose','95131','CA','United States','3.00',3,'16.58','0.00','0.00','16.58','paypal','Failure',NULL,'1','127.0.0.1','2013-06-23 03:55:46','2013-06-23 03:55:46'),('51c671df-d724-497b-bde4-10982c83eaf2','buyer','lee','buyer_1349835293_per@163.com','888-888-8888','1 Main St','','San Jose','95131','CA','United States','1 Main St','','San Jose','95131','CA','United States','3.00',3,'16.58','0.00','0.00','16.58','paypal','Failure',NULL,'1','127.0.0.1','2013-06-23 03:56:15','2013-06-23 03:56:15'),('51c67345-ed64-497b-937c-10982c83eaf2','buyer','lee','buyer_1349835293_per@163.com','','1 Main St','','San Jose','95131','CA','United States','1 Main St','','San Jose','95131','CA','United States','3.00',3,'19.28','0.00','0.00','19.28','paypal','Success',NULL,'2','127.0.0.1','2013-06-23 04:02:13','2013-06-23 04:02:13'),('51c675ef-cb80-4dd1-8cd1-10982c83eaf2','buyer','lee','buyer_1349835293_per@163.com','','1 Main St','','San Jose','95131','CA','United States','1 Main St','','San Jose','95131','CA','United States','3.00',3,'7.86','0.00','0.00','7.86','paypal','Success',NULL,'2','127.0.0.1','2013-06-23 04:13:35','2013-06-23 04:13:35'),('51c689a9-a350-4452-9b76-10982c83eaf2','dfff','dfsdf','33333333@qq.com','13996565321','s','c','d','123456','123456','usa','s','c','d','123456','123456','usa','2.00',2,'9.48','0.00','0.00','9.48','creditcard',NULL,NULL,'1','127.0.0.1','2013-06-23 05:37:45','2013-06-23 05:37:45');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) default NULL,
  `excerpt` varchar(200) default '' COMMENT '简介',
  `description` longtext NOT NULL COMMENT '详细介绍',
  `cateID` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `photo_dir` varchar(500) NOT NULL,
  `active` int(1) default '1',
  `views` int(11) default '0',
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `cat_pro_FK` (`cateID`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`slug`,`excerpt`,`description`,`cateID`,`price`,`photo`,`photo_dir`,`active`,`views`,`created`,`modified`) values (59,'Oysters','oysters','Oysters are an excellent source of zinc, iron, calcium, and selenium, as well as vitamin A and vitamin B12. Oysters are low in food energy; one dozen raw oysters contains 110 kilocalories (460 kJ). Oy','Oysters are an excellent source of zinc, iron, calcium, and selenium, as well as vitamin A and vitamin B12. Oysters are low in food energy; one dozen raw oysters contains 110 kilocalories (460 kJ). Oysters are considered most nutritious when eaten raw.',3,2.60,'oyster.jpg','59',1,0,NULL,NULL),(65,'Basa','vasa','The basa fish, Pangasius bocourti, is a type of catfish in the family Pangasiidae. Basa are native to the Mekong River Delta in Vietnam and Chao Phraya basin in Thailand.','The basa fish, Pangasius bocourti, is a type of catfish in the family Pangasiidae. Basa are native to the Mekong River Delta in Vietnam and Chao Phraya basin in Thailand.',2,5.50,'basa.jpg','65',1,54,NULL,NULL),(62,'Tuna','tuna','A tuna is a saltwater finfish that belongs to the tribe Thunnini, a sub-grouping of the mackerel family which together with the tunas, also includes the bonitosaa, mackerels, and Spanish mackerels. ','A tuna is a saltwater finfish that belongs to the tribe Thunnini, a sub-grouping of the mackerel family which together with the tunas, also includes the bonitos, mackerels, and Spanish mackerels. ',2,1.90,'tuna.jpg','62',1,0,NULL,NULL),(60,'Salmon','salmon','A tuna is a saltwater finfish that belongs to the tribe Thunnini, a sub-grouping of the mackerel family which together with the tunas, also includes the bonitos,vv mackerels, and Spanish mackerels. ','Salmon is a popular food. Classified as an oily fish, salmon is considered to be healthy due to the fish\'s high protein, high omega-3 fatty acids, and high vitamin',2,2.99,'salmon.jpg','60',1,0,NULL,NULL),(56,'Cuttlefish','cuttlefish','A tuna is a saltwater finfish that belongs to the tribe Thunnini, a sub-grouping of the mackerel family which together with the tunas, also includes the bonitosdd, mackerels, and Spanish mackerels. ','Cuttlefish are caught for food in the Mediterranean, East Asia, the English Channel and elsewhere. Although squid is more popular as a restaurant dish all over the world, in East Asia, dried, shredded cuttlefish is a popular snack food.',4,3.98,'cuttlefish.jpg','56',1,9,NULL,NULL),(57,'Japanese spider crab','japanese-spider-crab','A tuna is a saltwater finfish that belongs to the tribe Thunnini, a sub-grouping of the mackerel family which together with the tunas, also includes the bonitos,ee mackerels, and Spanish mackerels. ','The Japanese spider crab, Macrocheira kaempferi, is a species of marine crab that lives in the waters around Japan. It has the largest leg span of any arthropod, reaching up to 3.8 metres and weighing up to 41 pounds.',3,9.80,'spidercarb.jpg','57',1,0,NULL,NULL),(58,'Octopus','octopus','A tuna is a saltwater finfish that belongs to the tribe Thunnini, a sub-grouping of the mackerel family which together with the tunas, also includes the bonitos, jjmackerels, and Spanish mackerels. ','Octopus is a common ingredient in Japanese cuisine, including sushi, takoyaki, and akashiyaki.\r\nIn Korea, some small species are sometimes eaten alive as a novelty food. A live octopus is usually sliced up, and it is eaten while still squirming.',4,1.28,'octopus.jpg','58',1,0,NULL,NULL);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) default '0' COMMENT '父级编号',
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '' COMMENT '角色名称',
  `desc` varchar(200) collate utf8_unicode_ci default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`pid`,`name`,`desc`) values (1,0,'Administrator',''),(2,0,'Teacher',''),(3,0,'Student',''),(4,1,'System Administrator',''),(5,1,'WebSite Administrator',''),(6,0,'Guest',''),(7,6,'Primary Guests',''),(8,6,'Senior Guests',''),(9,2,'Primary Teacher',''),(10,3,'Primary Student','');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `k` varchar(32) NOT NULL default '',
  `v` text NOT NULL,
  PRIMARY KEY  (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `settings` */

insert  into `settings`(`k`,`v`) values ('website_name','Blu Water Seafood'),('website_theme','theme');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `birth_date` date NOT NULL COMMENT '生日',
  `gender` enum('M','F') NOT NULL COMMENT '性别',
  `join_date` date NOT NULL COMMENT '注册日期',
  `city` varchar(100) default '' COMMENT '城市',
  `state` varchar(100) default '' COMMENT '省份',
  `country` varchar(100) default '' COMMENT '国家',
  `address` varchar(200) NOT NULL default '' COMMENT '街道',
  `phone` varchar(15) NOT NULL COMMENT '电话号码',
  `username` varchar(255) default '' COMMENT '登录名',
  `password` varchar(100) default NULL COMMENT '密码',
  `email` varchar(255) default '' COMMENT '邮箱',
  `role_id` int(11) default '0' COMMENT '角色编号',
  `role` varchar(50) NOT NULL default 'user',
  `active` enum('active','inactive') NOT NULL default 'inactive' COMMENT '状态',
  `zip` int(10) default NULL COMMENT '邮编',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`birth_date`,`gender`,`join_date`,`city`,`state`,`country`,`address`,`phone`,`username`,`password`,`email`,`role_id`,`role`,`active`,`zip`) values (7,'admin','admin','2013-05-14','M','2013-05-14','','','','123123','123123','admin','401c7f240363db8580b058f5b152013f943a9cc9','admin@admin.com',4,'admin','active',NULL),(17,'test','test','1987-06-05','M','2013-06-12','aa','cc','bb','afaefew','12341234','test','fa454a094993a04e68f1f49180630b297b76a7da','test@test.com',5,'user','active',12345),(18,'123','456','2013-05-21','M','2033-01-01','','','','1234','1234123','hello','e66266486881a80243da969523c0299861700f10','hello@hello.com',8,'user','active',NULL),(19,'minh','minh','2013-05-21','M','0000-00-00','','','','minh','1234','minh','e74affcde599151214c27926a037bd1c60a11874','minh@minh.com',9,'user','active',NULL),(20,'smith','Jone','1987-06-05','M','2013-06-12','aa','cc','bb','afaefew','13698546584','testa','74614a02ea5a992260ca0e890ec22e936b3b4894','350681421@qq.com',8,'user','inactive',12345);


CREATE TABLE `contacts` (
   `id` char(36) collate utf8_unicode_ci NOT NULL default '',
   `sessionid` varchar(255) collate utf8_unicode_ci default NULL,
   `product_id` int(11) default '0' COMMENT '产品编号',
   `name` varchar(255) collate utf8_unicode_ci default NULL,
   `email` varchar(100) collate utf8_unicode_ci default NULL,
   `subject` varchar(200) collate utf8_unicode_ci default NULL,
   `message` text collate utf8_unicode_ci,
   `created` datetime default NULL,
   `modified` datetime default NULL,
   PRIMARY KEY  (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
