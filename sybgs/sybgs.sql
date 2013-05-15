/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.1.36-community-log : Database - sybgs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `sybgs_admin` */

CREATE TABLE `sybgs_admin` (
  `name` char(11) NOT NULL,
  `paw` char(64) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `sybgs_admin` */

LOCK TABLES `sybgs_admin` WRITE;

insert  into `sybgs_admin`(`name`,`paw`) values ('admin','d033e22ae348aeb5660fc2140aec35850c4da997');

UNLOCK TABLES;

/*Table structure for table `sybgs_category` */

CREATE TABLE `sybgs_category` (
  `caid` int(11) NOT NULL AUTO_INCREMENT,
  `caname` char(255) DEFAULT NULL,
  `upcaid` int(11) DEFAULT NULL,
  `cabz` char(255) DEFAULT NULL,
  PRIMARY KEY (`caid`),
  KEY `upcaid` (`upcaid`),
  CONSTRAINT `upcaid` FOREIGN KEY (`upcaid`) REFERENCES `sybgs_category` (`caid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sybgs_category` */

LOCK TABLES `sybgs_category` WRITE;

UNLOCK TABLES;

/*Table structure for table `sybgs_score` */

CREATE TABLE `sybgs_score` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `caid` tinyint(1) DEFAULT NULL,
  `wid` int(11) DEFAULT NULL,
  `score1` float(5,2) DEFAULT NULL,
  `score2` float(5,2) DEFAULT NULL,
  `score3` float(5,2) DEFAULT NULL,
  `score4` float(5,2) DEFAULT NULL,
  `score5` float(5,2) DEFAULT NULL,
  `score6` float(5,2) DEFAULT NULL,
  `score7` float(5,2) DEFAULT NULL,
  `iswin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`sid`),
  KEY `uid` (`uid`),
  KEY `wid` (`wid`),
  CONSTRAINT `uid` FOREIGN KEY (`uid`) REFERENCES `sybgs_users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wid` FOREIGN KEY (`wid`) REFERENCES `sybgs_works` (`wid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

/*Data for the table `sybgs_score` */

LOCK TABLES `sybgs_score` WRITE;

insert  into `sybgs_score`(`sid`,`uid`,`caid`,`wid`,`score1`,`score2`,`score3`,`score4`,`score5`,`score6`,`score7`,`iswin`) values (3,9,2,67,60.00,70.00,60.00,80.00,80.00,0.00,69.00,0),(4,9,2,66,60.00,80.00,70.00,60.00,60.00,0.00,66.50,0),(5,9,2,44,60.00,60.00,60.00,60.00,70.00,0.00,61.50,0),(6,9,2,42,90.00,90.00,90.00,80.00,90.00,0.00,88.00,1),(7,9,2,41,80.00,80.00,70.00,90.00,90.00,0.00,81.00,1),(8,9,2,33,90.00,90.00,70.00,90.00,80.00,0.00,83.50,1),(9,9,2,29,90.00,80.00,85.00,90.00,90.00,0.00,86.75,1),(10,9,2,26,85.00,90.00,90.00,90.00,90.00,0.00,89.00,1),(11,11,2,67,85.00,80.00,82.00,90.00,85.00,0.00,84.25,0),(12,11,2,66,90.00,95.00,93.00,92.00,88.00,0.00,91.85,1),(13,11,2,44,75.00,75.00,70.00,75.00,70.00,0.00,73.00,0),(14,11,2,42,90.00,85.00,75.00,80.00,82.00,0.00,82.05,0),(15,11,2,41,87.00,85.00,85.00,90.00,90.00,0.00,87.15,1),(16,11,2,33,82.00,80.00,75.00,80.00,82.00,0.00,79.45,0),(17,11,2,29,90.00,85.00,75.00,88.00,80.00,0.00,83.35,0),(18,11,2,26,88.00,95.00,93.00,95.00,93.00,0.00,92.80,1),(19,10,2,29,90.00,98.00,90.00,95.00,95.00,0.00,93.35,1),(20,10,2,26,95.00,98.00,93.00,96.00,97.00,0.00,95.60,1),(21,10,2,67,90.00,95.00,90.00,90.00,90.00,0.00,91.00,0),(22,10,2,66,85.00,90.00,90.00,80.00,80.00,0.00,85.50,0),(23,10,2,44,70.00,90.00,85.00,70.00,70.00,0.00,77.75,0),(24,10,2,42,90.00,95.00,90.00,85.00,89.00,0.00,89.85,1),(25,10,2,41,90.00,85.00,85.00,80.00,80.00,0.00,84.25,0),(26,10,2,33,90.00,85.00,85.00,85.00,85.00,0.00,86.00,0),(27,6,1,75,96.00,92.00,96.00,85.00,90.00,0.00,92.10,1),(28,6,1,74,88.00,86.00,92.00,78.00,92.00,0.00,87.20,0),(29,6,1,73,96.00,96.00,96.00,90.00,88.00,0.00,93.60,1),(30,6,1,72,86.00,92.00,88.00,82.00,80.00,0.00,86.00,0),(31,6,1,68,86.00,88.00,76.00,90.00,86.00,0.00,84.70,0),(32,6,1,64,80.00,88.00,84.00,80.00,88.00,0.00,83.80,0),(33,6,1,63,80.00,92.00,82.00,80.00,78.00,0.00,82.60,0),(34,6,1,62,92.00,95.00,90.00,90.00,92.00,0.00,91.70,1),(35,6,1,61,92.00,92.00,86.00,85.00,80.00,0.00,87.30,0),(36,6,1,60,94.00,92.00,92.00,88.00,90.00,0.00,91.30,1),(37,6,1,58,80.00,82.00,84.00,70.00,86.00,0.00,80.30,0),(38,8,1,75,75.00,65.00,80.00,70.00,75.00,0.00,73.25,0),(39,6,1,57,90.00,90.00,86.00,85.00,82.00,0.00,86.80,0),(40,8,1,74,75.00,80.00,75.00,70.00,75.00,0.00,75.00,0),(41,6,1,56,95.00,90.00,90.00,92.00,92.00,0.00,91.70,1),(42,6,1,55,94.00,92.00,88.00,88.00,90.00,0.00,90.30,0),(43,8,1,73,85.00,90.00,90.00,85.00,80.00,0.00,86.50,1),(44,6,1,40,86.00,85.00,82.00,78.00,80.00,0.00,82.30,0),(45,6,1,32,90.00,92.00,88.00,80.00,80.00,0.00,86.40,0),(46,6,1,30,94.00,92.00,92.00,88.00,86.00,0.00,90.70,1),(47,6,1,27,96.00,92.00,94.00,92.00,90.00,0.00,93.00,1),(48,6,1,23,88.00,86.00,90.00,86.00,88.00,0.00,87.70,0),(49,6,1,18,88.00,92.00,88.00,86.00,82.00,0.00,87.50,0),(50,8,1,72,85.00,95.00,80.00,90.00,80.00,0.00,86.00,1),(51,8,1,68,85.00,85.00,80.00,90.00,80.00,0.00,84.00,1),(52,6,1,17,86.00,88.00,82.00,82.00,80.00,0.00,83.70,0),(53,8,1,64,70.00,85.00,70.00,90.00,75.00,0.00,77.75,0),(54,6,1,14,92.00,92.00,86.00,90.00,90.00,0.00,89.80,0),(55,6,1,13,94.00,95.00,92.00,90.00,92.00,0.00,92.60,1),(56,6,1,12,93.00,94.00,90.00,92.00,92.00,0.00,92.10,1),(57,6,1,11,92.00,94.00,90.00,90.00,90.00,0.00,91.20,1),(58,8,1,63,75.00,85.00,70.00,80.00,75.00,0.00,76.75,0),(59,8,1,62,75.00,80.00,70.00,70.00,75.00,0.00,73.75,0),(60,8,1,61,80.00,85.00,80.00,85.00,80.00,0.00,82.00,1),(61,8,1,60,80.00,85.00,75.00,80.00,75.00,0.00,79.00,0),(62,8,1,58,75.00,80.00,75.00,70.00,70.00,0.00,74.25,0),(63,8,1,57,80.00,75.00,75.00,75.00,75.00,0.00,76.00,0),(64,8,1,56,75.00,75.00,75.00,75.00,75.00,0.00,75.00,0),(65,8,1,55,80.00,80.00,85.00,85.00,75.00,0.00,81.50,1),(66,8,1,40,75.00,85.00,80.00,75.00,75.00,0.00,78.25,0),(67,8,1,32,80.00,85.00,85.00,80.00,80.00,0.00,82.25,1),(68,8,1,30,80.00,85.00,80.00,85.00,80.00,0.00,82.00,1),(69,8,1,27,85.00,85.00,85.00,80.00,80.00,0.00,83.25,1),(70,8,1,23,80.00,85.00,80.00,75.00,75.00,0.00,79.25,0),(71,8,1,18,85.00,90.00,85.00,80.00,80.00,0.00,84.25,1),(72,8,1,17,75.00,80.00,75.00,70.00,75.00,0.00,75.00,0),(73,8,1,14,85.00,90.00,80.00,90.00,80.00,0.00,85.00,1),(74,8,1,13,80.00,80.00,80.00,80.00,80.00,0.00,80.00,1),(75,8,1,12,85.00,85.00,80.00,85.00,80.00,0.00,83.00,1),(76,8,1,11,80.00,65.00,85.00,70.00,75.00,0.00,75.50,0),(77,5,1,11,85.00,80.00,90.00,90.00,95.00,0.00,87.75,0),(78,5,1,12,95.00,95.00,85.00,95.00,95.00,0.00,92.50,0),(79,5,1,13,92.00,90.00,80.00,90.00,92.00,0.00,88.20,0),(80,5,1,14,90.00,95.00,80.00,90.00,90.00,0.00,88.50,0),(81,5,1,17,80.00,75.00,95.00,80.00,80.00,0.00,82.75,0),(82,5,1,18,80.00,85.00,60.00,80.00,90.00,0.00,77.50,0),(83,5,1,23,95.00,90.00,95.00,90.00,90.00,0.00,92.25,1),(84,5,1,27,96.00,90.00,95.00,95.00,95.00,0.00,94.20,1),(85,5,1,30,90.00,80.00,70.00,80.00,85.00,0.00,80.25,0),(86,5,1,32,90.00,85.00,90.00,90.00,90.00,0.00,89.00,0),(87,5,1,40,90.00,95.00,90.00,95.00,95.00,0.00,92.75,1),(88,5,1,55,95.00,80.00,95.00,90.00,90.00,0.00,90.25,0),(89,5,1,56,96.00,96.00,95.00,90.00,90.00,0.00,93.65,1),(90,5,1,57,80.00,70.00,85.00,90.00,80.00,0.00,81.25,0),(91,5,1,58,85.00,90.00,80.00,60.00,85.00,0.00,79.75,0),(92,5,1,60,80.00,75.00,60.00,70.00,80.00,0.00,72.00,0),(93,5,1,61,90.00,90.00,65.00,70.00,85.00,0.00,79.00,0),(94,5,1,62,90.00,90.00,85.00,85.00,85.00,0.00,87.00,0),(95,5,1,63,90.00,90.00,70.00,70.00,85.00,0.00,80.25,0),(96,5,1,64,95.00,96.00,95.00,90.00,90.00,0.00,93.45,1),(97,5,1,68,95.00,96.00,95.00,92.00,95.00,0.00,94.60,1),(98,5,1,72,90.00,90.00,80.00,90.00,80.00,0.00,86.00,0),(99,5,1,73,95.00,95.00,95.00,90.00,90.00,0.00,93.25,1),(100,5,1,74,80.00,80.00,90.00,80.00,90.00,0.00,84.00,0),(101,5,1,75,85.00,80.00,75.00,75.00,80.00,0.00,78.75,0);

UNLOCK TABLES;

/*Table structure for table `sybgs_users` */

CREATE TABLE `sybgs_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) DEFAULT NULL,
  `paw` char(64) DEFAULT NULL,
  `email` char(64) DEFAULT NULL,
  `tel` char(13) DEFAULT NULL,
  `qx1` tinyint(1) DEFAULT '0',
  `qx2` tinyint(1) DEFAULT '0',
  `role` int(1) DEFAULT '0' COMMENT '角色（0：教师；1：学生）',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `sybgs_users` */

LOCK TABLES `sybgs_users` WRITE;

insert  into `sybgs_users`(`uid`,`name`,`paw`,`email`,`tel`,`qx1`,`qx2`,`role`) values (5,'王敬国','c984aed014aec7623a54f0591da07a85fd4b762d','','',1,0,0),(6,'范义荣','7c4a8d09ca3762af61e59520943dc26494f8941b','','',1,0,0),(7,'谢德体','c984aed014aec7623a54f0591da07a85fd4b762d','','',1,0,0),(8,'张盼月','c984aed014aec7623a54f0591da07a85fd4b762d','','',1,0,0),(9,'宋魁彦','0b15455cee33c112ce1df7fdf3fc76db7c1ef45f','','13904653748',0,1,0),(10,'杨吉华','7c4a8d09ca3762af61e59520943dc26494f8941b','','',0,1,0),(11,'李文彬','c984aed014aec7623a54f0591da07a85fd4b762d','','',0,1,0),(15,'马征','7c4a8d09ca3762af61e59520943dc26494f8941b','','',0,0,1);

UNLOCK TABLES;

/*Table structure for table `sybgs_works` */

CREATE TABLE `sybgs_works` (
  `wid` int(11) NOT NULL AUTO_INCREMENT,
  `caid` int(11) DEFAULT NULL,
  `wname` char(255) DEFAULT NULL,
  `wauthor` char(60) DEFAULT NULL,
  `wfile` text,
  `wftype` char(10) DEFAULT NULL,
  `wbz` char(255) DEFAULT '无备注说明~',
  `uid` int(11) DEFAULT '0' COMMENT '用户编号',
  PRIMARY KEY (`wid`),
  KEY `caid` (`caid`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 10240 kB; (`caid`) REFER `jwc/sybgs_category`(`';

/*Data for the table `sybgs_works` */

LOCK TABLES `sybgs_works` WRITE;

insert  into `sybgs_works`(`wid`,`caid`,`wname`,`wauthor`,`wfile`,`wftype`,`wbz`,`uid`) values (11,1,'城市净化光源“树”','沈阳农大','20130326012514_5431.swf',NULL,'',0),(12,1,'沈阳市东陵公园森林生态系统服务功能价值评价','沈阳农大','20130326055838_6336.swf',NULL,'',0),(13,1,'多尺度星载遥感数据的森林动态变化监测','华中农大','20130326061709_5972.swf',NULL,'',15),(14,1,'河岸林对农田氮磷的吸收作用及河岸带植物布局研究','华中农大','20130326061811_8176.swf',NULL,'',0),(17,1,'森林防火刺猬球','北京农学院','20130326064459_3761.swf',NULL,'',0),(18,1,'树木的重生','北京农学院','20130326064537_7319.swf',NULL,'',0),(23,1,'纤维素裹淀粉基可食用一次性筷子的研发','华南农大','20130326084310_1095.swf',NULL,'',0),(26,2,'3D环形出水智能节水水龙头','华南农大','20130327064946_1042.swf||20130327064946_1108.wmv',NULL,'',15),(27,1,'小型太阳能辅助供电无人机森林防火预警平台','华南农大','20130327070517_2623.swf',NULL,'',0),(29,2,'基于Zigbee无线传感器网络的滴灌系统','华南农大','20130327072756_3420.swf||20130327072755_6239.mpg',NULL,'',0),(30,1,'澄迈部分地区林下经济现状调查及新模式探究','海南大学','20130327073544_8377.swf',NULL,'',0),(32,1,'林木蛀干害虫生物电监测技术初探','海南大学','20130327074048_6006.swf',NULL,'',0),(33,2,'废旧报纸回收纤维/聚乳酸生物可降解复合新材料','中南林','20130327074816_9780.swf|| 20130327074819_1769.wmv',NULL,'',15),(40,1,'环保杯口设计','北林大','20130327081050_3961.swf',NULL,'',0),(41,2,'iTree•爱树——基于ipad的树木知识科普软件','北林大','20130327081200_2224.swf|| 20130327081201_8538.WMV',NULL,'',0),(42,2,'无电源自适应式智能节水阀门','北林大','20130327081315_1225.swf|| 20130327081317_2732.wmv',NULL,'',15),(44,2,'木质手表','北京农学院','20130327082744_4309.swf|| 20130327082745_2055.mp4',NULL,'',0),(55,1,'马尾松松材线虫病的PCR分子诊断技术及推广','华南农大','20130401021510_9718.swf|| 20130401021536_7705.swf',NULL,'',0),(56,1,'沼渣回用生产瓦楞原纸试验设计','华南农大','20130401021708_5336.swf|| 20130401021726_7360.swf',NULL,'',0),(57,1,'简易移栽器','安徽农大','20130401022134_2356.swf|| 20130401022241_9066.jpg|| 20130401022242_1270.jpg',NULL,'',0),(58,1,'大麦秸秆与马尾松枯落叶混合制作猪饲料的开发研究','安徽农大','20130401022402_6524.swf',NULL,'',0),(60,1,'绿色情结——森林资源保护方略','青岛农大','20130401025538_2299.swf',NULL,'',0),(61,1,'海南农村人工湿地污水处理技术研究','海南大学','20130401030950_3474.swf',NULL,'',0),(62,1,'微生物絮凝剂与三氯化铁复合对造纸黑液处理及处理后滤液回用工艺设计','天津农学院','20130401031620_1646.swf',NULL,'',0),(63,1,'化学农药对森林生态系统影响评价','天津农学院','20130401031728_1568.swf',NULL,'',0),(64,1,'高校纸资源回收利用体系构建','天津农学院','20130401031806_2988.swf',NULL,'',0),(66,2,'太阳能智能垃圾桶','北林大','20130401032528_5122.swf|| 20130401032642_1224.wmv',NULL,'',0),(67,2,'森林树木追肥器','青岛农大','20130401033145_1449.swf',NULL,'',0),(68,1,'青岛市丘陵区生态农业园的景观设计','青岛农大','20130401062257_2612.swf',NULL,'',0),(72,1,'基于pm2.5源汇调控的城市林业新模式构建','北林大','20130401063217_7732.swf',NULL,'',0),(73,1,'户外清洁能源充电“树”','北林大','20130401063820_7500.jpg|| 20130401063821_8144.jpg|| 20130401063822_6208.jpg|| 20130401063822_4788.jpg|| 20130401063823_6334.jpg|| 20130401063824_5401.jpg|| 20130401063824_9252.jpg|| 20130401063825_6431.jpg|| 20130401063826_5925.jpg|| 20130401063826_4046.jpg|| 20130401063828_1661.jpg|| 20130401063834_9884.jpg|| 20130401063914_4864.swf',NULL,'',0),(74,1,'森林的眼泪','北京农学院','20130401064316_1317.swf',NULL,'',0),(75,1,'利用基因技术实现林业资源生态循环设计','青岛农大','20130402010510_2750.pdf',NULL,'',0),(76,1,'sss','ddd','20130515135726_7831.ppt',NULL,'ccccccccccc',15),(77,1,'kjkjhk','hjk','20130515140022_1891.jpg',NULL,'sdfsdf',15);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;