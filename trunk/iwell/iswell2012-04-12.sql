/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.0.51b-community-nt : Database - iwell_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`iwell_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `iwell_db`;

/*Table structure for table `pro_admin` */

DROP TABLE IF EXISTS `pro_admin`;

CREATE TABLE `pro_admin` (
  `id` int(15) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL,
  `password` char(33) NOT NULL,
  `allow_1` int(11) NOT NULL default '0',
  `allow_2` int(11) NOT NULL default '0',
  `post` varchar(20) NOT NULL,
  `phone` int(20) NOT NULL,
  `utime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `pro_admin` */

insert  into `pro_admin`(`id`,`username`,`password`,`allow_1`,`allow_2`,`post`,`phone`,`utime`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3',1,0,'',0,0),(2,'xinyun','e6a21aebd647db0101a87d09a05b6ee6',1,0,'',0,0),(30,'李君羡','996e2f8f7af09914f8482af7b9ebfa8f',3,0,'总经理',2147483647,1309610032);

/*Table structure for table `pro_brand` */

DROP TABLE IF EXISTS `pro_brand`;

CREATE TABLE `pro_brand` (
  `id` int(11) NOT NULL auto_increment,
  `b_name` varchar(20) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `b_url` varchar(60) NOT NULL,
  `is_show` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `pro_brand` */

insert  into `pro_brand`(`id`,`b_name`,`logo`,`b_url`,`is_show`) values (3,'诺基亚','20110703201313_345.jpg','http://shop.nokia.com',1),(4,'三星电子','20110703221045_442.jpg','http://www.samsung.com/cn/',1),(5,'摩托罗拉','20110703221230_901.jpg','http://www.motorola.com/',1),(6,'索尼爱立信','20110706095446_260.jpg','http://',1),(7,'黑莓','20120406195327_828.jpg','http://',1),(8,'苹果','20120406204225_691.jpg','http://',1);

/*Table structure for table `pro_cat` */

DROP TABLE IF EXISTS `pro_cat`;

CREATE TABLE `pro_cat` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `c_name` varchar(50) NOT NULL,
  `c_path` varchar(50) NOT NULL,
  `c_desn` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `pro_cat` */

insert  into `pro_cat`(`id`,`pid`,`c_name`,`c_path`,`c_desn`) values (1,0,'手机/配件','0','手机手机手机手机手机手机手机1'),(2,0,'电脑/办公','0','笔记本，交换机，投影仪'),(3,0,'数码/配件','0','相机 镜头等'),(4,0,'时尚影音','0','MP3 MP4'),(5,1,'诺基亚','0-1','nokia'),(6,5,'诺基亚电池','0-1-5',''),(10,1,'CDMA手机','0-1',''),(9,1,'GSM手机','0-1',''),(11,1,'移动3G手机','0-1',''),(12,2,'笔记本','0-2','笔记本'),(13,2,'平板电脑','0-2',''),(14,2,'台式机','0-2',''),(15,3,'单反相机','0-3',''),(16,3,'专业镜头','0-3',''),(17,3,'数码相框','0-3',''),(18,3,'镜头附件','0-3',''),(19,4,'MP3/MP4','0-4',''),(20,4,'音箱','0-4',''),(21,4,'耳机/耳麦','0-4',''),(22,4,'电子书','0-4',''),(24,0,'生活用品','0',''),(26,24,'个性化妆','0-24',''),(29,24,'钟表首饰','0-24',''),(30,1,'音乐手机','0-1','快乐大本营指定专业音乐手机'),(31,1,'多功能数据线','0-1','能连接各种类型的借口'),(32,0,'三星手机','0','三星爱你看'),(33,0,'摩托罗拉','0','摩托罗拉专业3G手机'),(34,2,'office组件','0-2','专业办公套件'),(35,2,'办公桌','0-2','专业办公桌，宽敞明亮'),(36,2,'多功能座椅','0-2','可躺可做，专业舒服'),(37,3,'摄像头','0-3','高像素摄像头'),(38,3,'游戏键盘','0-3','强大的功能'),(39,24,'牙膏牙刷','0-24','包您健康'),(40,24,'床上用品','0-24','床单套件'),(41,24,'baby霜','0-24','专业保护baby!'),(42,24,'洗发膏','0-24','去屑止痒'),(43,4,'PSP','0-4','超级好玩的产品'),(44,4,'光盘','0-4','高清正版'),(45,4,'DVD','0-4','电影人士必备');

/*Table structure for table `pro_comment` */

DROP TABLE IF EXISTS `pro_comment`;

CREATE TABLE `pro_comment` (
  `id` int(11) NOT NULL auto_increment,
  `com_uid` int(20) NOT NULL,
  `com_wid` int(11) NOT NULL,
  `com_conntent` text NOT NULL,
  `com_time` int(11) NOT NULL,
  `com_score` int(2) default '5' COMMENT '评分',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `pro_comment` */

insert  into `pro_comment`(`id`,`com_uid`,`com_wid`,`com_conntent`,`com_time`,`com_score`) values (1,1,2,'这个很不错呢',1310205476,5);

/*Table structure for table `pro_content` */

DROP TABLE IF EXISTS `pro_content`;

CREATE TABLE `pro_content` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(33) NOT NULL,
  `content` text NOT NULL,
  `ntime` varchar(30) NOT NULL,
  `is_show` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Data for the table `pro_content` */

insert  into `pro_content`(`id`,`title`,`content`,`ntime`,`is_show`) values (10,'民生真情15年，送彩金啦','在中国民生银行成立15周年之际，民生银行联合、易宝支付、心云商城举办用户回馈活动。活动期间，凡使用易宝支付并选择民生银行网银支付成功的用户，单笔消费金额满15元，可获赠由民生银行指定福彩公司赠送的10元彩金。每日消费金额排名前100名的用户，还将特别获赠由心云商城提供的20元现金抵用券。\r\n    \r\n     点击查看详情：http://www.yeepay.com/html/huodong/ms1106\r\n','',0),(11,'注册送好礼','即日起至2011年6月17日止，凡在心云商城注册成为会员的用户，均可获得心云商城提供的价值20元优惠券（有效期为2011年5月17日至2011年6月17日），您在购物结账时只需输选择使用20元优惠券，即可立即节省20元，还在等什么？马上点击注册参加吧！\r\n \r\n祝大家购物愉快！\r\n','',0),(24,'开业酬宾','凡在开业期间购买商品超过20元者，即可领取精美礼品一份。','',0),(22,'支持各种银行','网上支付，更有超多几分相送','',0),(23,'会员制度','凡注册心云商城者，即刻送积分100，相当于100元人民币','',0),(13,'“心云商城”正式运营','在通用技术集团的大力支持下，在集团各部门和兄弟单位的积极配合和广大通用员工的热情参与下，邮电器材集团旗下的B2C购物网站——“心云商城” (www.ptacmall.com)经过5个月的试运营，在前期试运行的基础上，经过改版和调试，取得了阶段性的成果，于2011年5月17日正式上线运营。\r\n','',0);

/*Table structure for table `pro_gift` */

DROP TABLE IF EXISTS `pro_gift`;

CREATE TABLE `pro_gift` (
  `id` int(11) NOT NULL auto_increment,
  `g_name` varchar(50) NOT NULL,
  `g_num` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `pro_gift` */

insert  into `pro_gift`(`id`,`g_name`,`g_num`) values (1,'BL-5K 充电器',1),(2,'BL-5K 原装充电电池',2),(3,'屏幕贴膜',1),(4,'擦拭布',1);

/*Table structure for table `pro_link` */

DROP TABLE IF EXISTS `pro_link`;

CREATE TABLE `pro_link` (
  `id` int(10) NOT NULL auto_increment,
  `linkname` varchar(255) NOT NULL,
  `linkurl` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `pro_link` */

insert  into `pro_link`(`id`,`linkname`,`linkurl`) values (1,'中国邮电器材集团','http://www.sina1.com/'),(2,'中国通用技术集团','http://www.general.com/'),(3,'信息产业部','http://www.baidu.com/'),(4,'普泰通信','http://www.protect.com/'),(5,'英特达','http://www.enterdate.com/'),(6,'国资委','http://www.guoziwei.com/'),(7,'中国足彩网','http://www.zucai.com/'),(8,'新浪222','http://www.sina.cn222');

/*Table structure for table `pro_order` */

DROP TABLE IF EXISTS `pro_order`;

CREATE TABLE `pro_order` (
  `id` int(11) NOT NULL auto_increment,
  `order_id` varchar(100) NOT NULL,
  `order_time` int(11) NOT NULL,
  `consignee` varchar(10) NOT NULL,
  `dh` varchar(20) default NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `postal` int(7) NOT NULL,
  `remark` text NOT NULL,
  `price` varchar(50) NOT NULL,
  `meetprice` varchar(50) NOT NULL,
  `sendtime` varchar(10) NOT NULL,
  `ok` int(11) NOT NULL default '0',
  `pay` int(11) NOT NULL default '0',
  `consignment` int(11) NOT NULL default '0',
  `city1` char(15) NOT NULL,
  `city2` char(15) default NULL,
  `city3` char(15) default NULL,
  `retu` int(11) NOT NULL default '0',
  `sale` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

/*Data for the table `pro_order` */

insert  into `pro_order`(`id`,`order_id`,`order_time`,`consignee`,`dh`,`phone`,`address`,`email`,`postal`,`remark`,`price`,`meetprice`,`sendtime`,`ok`,`pay`,`consignment`,`city1`,`city2`,`city3`,`retu`,`sale`) values (1,'1302231221',2011,'张鑫宇',NULL,'13581661551','海淀区西三旗沁春家园1号楼1307','655406@qq.com',100000,'调一个质量好点的 谢谢','5000','5000','周末',0,0,0,'',NULL,NULL,0,0),(5,'XY_201107091200371396',0,'zxyzxy','1123323323','13581661551','沁春家园1号楼1307','',100000,'','4760','','工作日',0,0,0,'吉林省','吉林市','昌邑区',0,0),(6,'XY_201107091714171693',0,'李龙贵','','131111111','沁春家园1号楼1307','',0,'','7650','','工作日',0,0,0,'海南省','海口市','市辖区',0,0),(7,'XY_201107091757561643',1310205476,'李龙贵','','131111111','沁春家园1号楼1307','',0,'','7650','','工作日',0,0,0,'海南省','海口市','市辖区',0,0),(8,'XY_201107091758191026',1310205499,'李龙贵','','131111111','沁春家园1号楼1307','',0,'','7650','','工作日',0,0,0,'海南省','海口市','市辖区',0,0),(9,'XY_201107091800211157',1310205621,'李龙贵','','131111111','沁春家园1号楼1307','',0,'','7650','','工作日',0,0,0,'海南省','海口市','市辖区',0,0),(10,'XY_201107091800521427',1310205652,'李龙贵','','131111111','沁春家园1号楼1307','',0,'','7650','','工作日',0,0,0,'海南省','海口市','市辖区',0,0),(11,'XY_201107091805121347',1310205912,'李龙贵','','131111111','沁春家园1号楼1307','',0,'','7650','','工作日',0,0,0,'海南省','海口市','市辖区',0,0),(12,'XY_201107091805381685',1310205938,'李龙贵','','131111111','沁春家园1号楼1307','',0,'','7650','','工作日',0,0,0,'海南省','海口市','市辖区',0,0),(13,'XY_201107091806401930',1310206000,'李龙贵','','131111111','沁春家园1号楼1307','',0,'','7650','','工作日',0,0,0,'海南省','海口市','市辖区',0,0),(14,'XY_201107092303411381',1310223821,'凯歌','11111','111111','撒旦','655406@qq.com',1111,'','4760','','工作日',0,0,0,'贵州省','贵阳市','南明区',0,0),(15,'XY_201107101425261254',1310279126,'a','a','a','a','a',0,'','4760','','工作日',0,0,0,'云南省','昆明市','盘龙区',0,0),(16,'XY_201107101427141274',1310279234,'a','a','a','a','a',0,'','4760','','工作日',0,0,0,'云南省','昆明市','盘龙区',0,0),(17,'XY_201107101437021458',1310279822,'萧峰','111111','1323','丐帮','xiaofeng@qq.com',12323,'','9759','','工作日',0,0,0,'四川省','自贡市','市辖区',0,0),(18,'XY_201107101441091251',1310280069,'慕容复','','','','fdsadssd',0,'','4760','','工作日',0,0,0,'贵州省','六盘水市','水城县',0,0),(19,'XY_201107101441381962',1310280098,'asdf','asdf','asdf','asdf','asdf',0,'','4760','','工作日',0,0,1,'四川省','自贡市','自流井区',0,0),(28,'XY_201107112213261272',1310393606,'a','a','a','a','a',0,'','30077','','工作日',0,0,0,'四川省','自贡市','贡井区',0,0),(29,'XY_201107112243591961',1310395439,'a','a','a','a','a',0,'','30077','','工作日',0,0,0,'四川省','自贡市','贡井区',0,0),(24,'XY_201107101452041797',1310280724,'a','a','a','a','asdf',0,'','4999','','工作日',0,0,0,'贵州省','六盘水市','六枝特区',0,0),(25,'XY_201107101954151857',1310298855,'张鑫宇','11111','13581661551','沁春家园1号楼1307','655406@qq.com',1000111,'','5638','','工作日',1,0,1,'吉林省','吉林市','昌邑区',0,0),(26,'XY_201107102020171680',1310300417,'abc','abc','ddddd','abc','abc',0,'','1718','','工作日',1,0,1,'贵州省','遵义市','汇川区',0,0),(27,'XY_201107111324091627',1310361849,'zhangshuan','11111111111','111111111111','hehhhh','a757248228@sina.com',0,'','9759','','工作日',1,0,0,'河北省','唐山市','路北区',0,0),(74,'XY_201107121028181890',1310437698,'张鑫宇','11111111','1111','模压','651016236@qq.com',111,'','24517','','工作日',1,0,0,'吉林省','吉林市','昌邑区',0,0);

/*Table structure for table `pro_order_operate` */

DROP TABLE IF EXISTS `pro_order_operate`;

CREATE TABLE `pro_order_operate` (
  `id` int(11) NOT NULL auto_increment,
  `operater` varchar(20) NOT NULL,
  `operate_time` int(11) NOT NULL,
  `ok` int(11) NOT NULL,
  `pay` int(11) NOT NULL,
  `consignment` int(11) NOT NULL,
  `desn` text NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `pro_order_operate` */

insert  into `pro_order_operate`(`id`,`operater`,`operate_time`,`ok`,`pay`,`consignment`,`desn`,`order_id`) values (9,'admin',1310356803,1,0,1,'',26),(10,'admin',1310357062,1,0,0,'',25),(8,'admin',1310355913,1,0,0,'确认',26),(11,'admin',1310357069,1,0,1,'',25),(12,'admin',1310437999,1,0,0,'',74);

/*Table structure for table `pro_order_ware` */

DROP TABLE IF EXISTS `pro_order_ware`;

CREATE TABLE `pro_order_ware` (
  `id` int(11) NOT NULL auto_increment,
  `order_id` varchar(100) NOT NULL,
  `wid` int(11) NOT NULL,
  `wnum` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

/*Data for the table `pro_order_ware` */

insert  into `pro_order_ware`(`id`,`order_id`,`wid`,`wnum`) values (1,'XY_201107091755051931',1,1),(2,'XY_201107091755051931',3,1),(17,'XY_201107092303411381',1,1),(18,'XY_201107101425261254',1,1),(19,'XY_201107101427141274',1,1),(20,'XY_201107101437021458',1,1),(21,'XY_201107101437021458',2,1),(22,'XY_201107101441091251',1,1),(23,'XY_201107101441381962',1,1),(32,'XY_201107102020171680',9,2),(31,'XY_201107101954151857',10,1),(30,'XY_201107101954151857',7,1),(29,'XY_201107101954151857',3,1),(28,'XY_201107101452041797',2,1),(33,'XY_201107111324091627',1,1),(34,'XY_201107111324091627',2,1),(35,'XY_201107112213261272',4,1),(36,'XY_201107112213261272',6,1),(37,'XY_201107112213261272',1,3),(38,'XY_201107112213261272',2,1),(39,'XY_201107112243591961',4,1),(40,'XY_201107112243591961',6,1),(41,'XY_201107112243591961',1,3),(42,'XY_201107112243591961',2,1),(43,'XY_201107112244241252',4,1),(44,'XY_201107112244241252',6,1),(45,'XY_201107112244241252',1,3),(46,'XY_201107112244241252',2,1),(47,'XY_201107112244381741',4,1),(48,'XY_201107112244381741',6,1),(49,'XY_201107112244381741',1,3),(50,'XY_201107112244381741',2,1),(51,'XY_201107112245531281',4,1),(52,'XY_201107112245531281',6,1),(53,'XY_201107112245531281',1,3),(54,'XY_201107112245531281',2,1),(55,'XY_201107112246191709',4,1),(56,'XY_201107112246191709',6,1),(57,'XY_201107112246191709',1,3),(58,'XY_201107112246191709',2,1),(59,'XY_201107112250321698',4,1),(60,'XY_201107112250321698',6,1),(61,'XY_201107112250321698',1,3),(62,'XY_201107112250321698',2,1),(63,'XY_201107112255391604',4,1),(64,'XY_201107112255391604',6,1),(65,'XY_201107112255391604',1,3),(66,'XY_201107112255391604',2,1),(67,'XY_201107112257361275',4,1),(68,'XY_201107112257361275',6,1),(69,'XY_201107112257361275',1,3),(70,'XY_201107112257361275',2,1),(71,'XY_201107112258301187',1,1),(72,'XY_201107112259031490',1,1),(73,'XY_201107112259331958',1,1),(74,'XY_201107112301401595',1,1),(75,'XY_201107112303511315',1,1),(76,'XY_201107112303581314',1,1),(77,'XY_201107112309131328',1,1),(78,'XY_201107112310071063',1,1),(79,'XY_201107112310501431',1,1),(80,'XY_201107112311141073',1,1),(81,'XY_201107112312161022',1,1),(82,'XY_201107112312241747',1,1),(83,'XY_201107112313111145',1,1),(84,'XY_201107112315501971',1,1),(85,'XY_201107112319361101',1,1),(86,'XY_201107112321451958',1,1),(87,'XY_201107112323061423',1,1),(88,'XY_201107112323221094',1,1),(89,'XY_201107112324031704',1,1),(90,'XY_201107112324171737',1,1),(91,'XY_201107112325261668',1,1),(92,'XY_201107112327201364',1,1),(93,'XY_201107112333331954',1,1),(94,'XY_201107112334491649',1,1),(95,'XY_201107112340331444',1,1),(96,'XY_201107112341151529',1,1),(97,'XY_201107112342591055',1,1),(98,'XY_201107112346101722',1,1),(99,'XY_201107112347231003',1,1),(100,'XY_201107112349161204',1,1),(101,'XY_201107112350301378',1,1),(102,'XY_201107112353211560',1,1),(103,'XY_201107112353571576',1,1),(104,'XY_201107120849581039',1,1),(105,'XY_201107120850411837',1,1),(106,'XY_201107120850491274',1,1),(107,'XY_201107120850581635',0,0),(108,'XY_201107121028181890',2,3),(109,'XY_201107121028181890',1,2);

/*Table structure for table `pro_pay` */

DROP TABLE IF EXISTS `pro_pay`;

CREATE TABLE `pro_pay` (
  `id` int(10) NOT NULL auto_increment,
  `p_name` varchar(63) NOT NULL,
  `p_url` varchar(80) NOT NULL,
  `p_pic` varchar(255) NOT NULL,
  `is_bank` varchar(55) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `pro_pay` */

insert  into `pro_pay`(`id`,`p_name`,`p_url`,`p_pic`,`is_bank`) values (1,'中国建设银行','','ccb.gif','1'),(2,'中国农业银行','','ABC.GIF','1'),(3,'北京银行','','BCCB.gif','1'),(4,'北京农村商业银行','','BJRCB.GIF','1'),(5,'中国银行','','BOC.GIF','1'),(6,'交通银行','','BOCO.GIF','1'),(8,'中国光大银行','','CEB.GIF','1'),(9,'e路阳光','','CEB.jpg','1'),(10,'兴业银行','','CIB.GIF','1'),(11,'中国民生银行','','CMBC.GIF','1'),(12,'招商银行','','CMBCHINA.GIF','1'),(13,'浙商银行','','CZ.GIF','1'),(14,'中信银行','','ECITIC.GIF','1'),(15,'广东发展银行','','GDB.GIF','1'),(16,'宁波银行','','NBCB.GIF','1'),(17,'上海浦东发展银行','','SPDB.GIF','1');

/*Table structure for table `pro_tuan` */

DROP TABLE IF EXISTS `pro_tuan`;

CREATE TABLE `pro_tuan` (
  `t_id` int(11) NOT NULL auto_increment,
  `t_name` varchar(50) NOT NULL,
  `t_price` int(11) NOT NULL,
  `t_pic` varchar(50) NOT NULL,
  `t_count` int(11) NOT NULL,
  `t_desc` text NOT NULL,
  PRIMARY KEY  (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ucs2;

/*Data for the table `pro_tuan` */

/*Table structure for table `pro_user` */

DROP TABLE IF EXISTS `pro_user`;

CREATE TABLE `pro_user` (
  `id` int(11) NOT NULL auto_increment,
  `reg_username` varchar(10) NOT NULL,
  `reg_password` char(33) NOT NULL,
  `reg_email` varchar(20) NOT NULL,
  `reg_time` int(11) NOT NULL,
  `reg_ip` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `p_username` (`reg_username`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `pro_user` */

insert  into `pro_user`(`id`,`reg_username`,`reg_password`,`reg_email`,`reg_time`,`reg_ip`) values (1,'xinyun','e6a21aebd647db0101a87d09a05b6ee6','yushan_523@163.com',0,'127.0.0.1'),(15,'沈万三','d65a74b34c2ad4c56ab7c1a588e0a867','655406@qq.com',1309255475,'127.0.0.1'),(14,'admin','7fef6171469e80d32c0559f88b377245','admin@qq.com',1309255408,'127.0.0.1'),(19,'小风','cd7181a8bf09534690efaa59bcaae62e','yushan_523@163.com',1309490927,'127.0.0.1');

/*Table structure for table `pro_ware` */

DROP TABLE IF EXISTS `pro_ware`;

CREATE TABLE `pro_ware` (
  `id` int(11) NOT NULL auto_increment,
  `w_name` varchar(100) NOT NULL,
  `w_code` varchar(20) NOT NULL,
  `w_price` int(11) NOT NULL,
  `w_buyprice` int(11) NOT NULL,
  `w_pic` varchar(50) NOT NULL,
  `w_num` int(11) NOT NULL,
  `w_type` varchar(10) default 't',
  `w_cat` int(11) default '0',
  `w_brand` int(11) default '0',
  `is_show` int(11) default '1',
  `is_up` int(11) default '0',
  `ad_pic` varchar(50) default 'error.jpg',
  `keywords` varchar(50) default NULL,
  `sale` int(11) default '0',
  `sale_begin` varchar(30) default NULL,
  `sale_end` varchar(30) default NULL,
  `add_time` varchar(30) default NULL,
  `edit_time` varchar(30) default NULL,
  `w_integral` int(11) default NULL COMMENT '购买该商品时最多可以使用多少钱的积分',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `pro_ware` */

insert  into `pro_ware`(`id`,`w_name`,`w_code`,`w_price`,`w_buyprice`,`w_pic`,`w_num`,`w_type`,`w_cat`,`w_brand`,`is_show`,`is_up`,`ad_pic`,`keywords`,`sale`,`sale_begin`,`sale_end`,`add_time`,`edit_time`,`w_integral`) values (1,'三星 SAMSUNGI9093G双模手机（黑色）','859873',4760,1000,'681_G_1299781892572.jpg',500,'tj',0,0,0,0,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL),(2,'苹果（APPLE）iPhone 4 16G版','917110',4999,0,'738_G_1303407690589.jpg',50,'tj',2,8,1,0,NULL,NULL,300,'2012-04-06 20:46','2012-04-14 20:46','1333720149332','1333720149332',NULL),(3,'夏普SH803T（双网双待）桃粉色','301245',2890,0,'627_G_1298668616595.jpg',1003,'tj',3,3,1,0,NULL,NULL,0,'2012-04-04 13:52','2012-04-13 13:52','1333720119421','1333720119421',NULL),(4,'索尼爱立信（Sony Ericsson）MT15i 3G手机 （','917146',3298,0,'717_G_1301536277210.jpg',1004,'tj',0,0,1,0,NULL,NULL,0,'2012-04-02 13:52','2012-04-27 13:52',NULL,NULL,NULL),(5,'惠普（hp）4321S（XY389PA）13.3英寸笔记本电脑i3-390','301264',4888,0,'684_G_1300332421641.jpg',1005,'tj',5,3,1,0,NULL,NULL,0,'2012-04-07 22:15','2012-04-21 22:15','1333721732785','1333721732785',NULL),(6,'华硕（ASUS）B53J 15.6寸商务笔记本','301270',7500,0,'889_G_1305454008104.jpg',1006,'tj',6,3,1,0,NULL,NULL,10,'2012-04-08 22:34','2012-04-18 22:34','1333722879711','1333722879711',NULL),(7,'诺基亚（NOKIA）C6-00 3G手机WCDMA/GSM （黑色）','',1899,0,'344_G_1305428217358.jpg',1007,'pj',0,0,1,0,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL),(9,'诺基亚（NOKIA）X3 滑盖GSM手机 (黑红) ','301278',859,0,'376_G_1305428755276.jpg',1008,'pj',9,3,1,0,NULL,NULL,22,'2012-04-09 22:34','2012-04-20 22:34','1333722891533','1333722891533',NULL),(10,'诺基亚（NOKIA）C3 直板GSM 手机 (黑蓝)','778890',849,0,'378_G_1305425790329.jpg',1009,'pj',10,3,1,0,NULL,NULL,3,'2012-04-10 14:08','2012-04-24 14:08',NULL,'1333778881047',NULL),(11,'诺基亚 （NOKIA）5250 直板GSM手机 （红色）','917319',959,0,'413_G_1305427245795.jpg',1010,'pj',11,3,1,0,NULL,NULL,0,'2012-04-09 22:35','2012-04-27 22:35','1333722911579','1333722911579',NULL),(12,'夏普SH806T（双网双待）白色','775081',3200,0,'626_G_1298669345544.jpg',1011,'pj',12,3,1,0,NULL,NULL,2,'2012-04-10 13:04','2012-04-27 13:04','1333775070375','1333775070375',NULL),(13,'三星I9003时尚大屏智能机 ','778854',3498,0,'851_P_1306437727752.jpg',2001,'r',13,3,1,0,'ad_right_4.jpg',NULL,0,'2012-04-11 14:07','2012-04-28 14:07',NULL,'1333778847265',NULL),(14,'三星（SAMSUNG）ST100数码相机 ','301275',1398,0,'852_P_1305513896695.jpg',2002,'r',14,3,1,0,'ad_right_5.jpg',NULL,3,'2012-04-08 14:07','2012-04-28 14:07',NULL,'1333778857673',NULL),(15,'三星ES28数码相机','775092',499,0,'853_P_1305514265891.png',2003,'r',15,3,1,0,'ad_right_6.jpg',NULL,0,'2012-04-10 13:04','2012-04-26 13:04',NULL,'1333775084067',NULL),(16,'富士（FUJIFILM）S2900HD 数码相机（黑色）长焦机王','778901',1360,0,'728_P_1303424044905.jpg',2004,'r',16,3,1,0,'ad_right_1.jpg',NULL,0,'2012-04-12 14:08','2012-04-27 14:08',NULL,'1333778893637',NULL),(17,'夏普（SHARP）806T时尚手机 ','778877',2688,0,'809_P_1306434189104.jpg',2005,'r',17,3,1,0,'ad_right_2.jpg',NULL,5,'2012-04-10 14:07','2012-04-26 14:07',NULL,'1333778870037',NULL),(18,'华硕笔记本PRO8FEI46JC-SL \r\n','',5800,0,'813_P_1305449515726.jpg',2006,'r',0,0,1,0,'ad_right_3.jpg',NULL,0,NULL,NULL,NULL,NULL,NULL),(22,'n95','746377',5000,500,'20110704102617_680.jpg',15,'',0,0,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(20,'夏新T51','745673',2888,1500,'20110708225623_528.jpg',10,'',0,0,1,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(23,'三星笔记本','749700',4000,5000,'20110704114750_959.jpg',60,'',0,0,1,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(24,'摩托罗拉L7','836849',2000,1000,'20110705113409_413.gif',10,'',0,0,1,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(25,'N88','856113',2000,1000,'20110705165513_379.jpg',50,'',0,0,1,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(26,'E71','856857',1000,500,'20110705170737_558.jpg',1,'',0,0,1,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(27,'E72','857051',2000,1000,'20110705171051_304.jpg',100,'',0,0,1,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(28,'N6020','nokia6020',1399,1199,'20110711091300_242.jpg',120,'',0,0,1,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(29,'苹果iPad','摩托罗拉',4999,3999,'20120406200634_883.jpg',1200,'',0,0,1,0,NULL,NULL,0,'2012-04-07 20:10','2012-04-27 20:11',NULL,NULL,NULL),(30,'苹果iPad','719102',1200,1000,'a.jpg',411,'t',0,0,1,0,'error.jpg',NULL,0,'2012-04-06 21:27','2012-04-27 20:31','1333718854429','1333718854429',NULL);

/*Table structure for table `pro_ware_attribute` */

DROP TABLE IF EXISTS `pro_ware_attribute`;

CREATE TABLE `pro_ware_attribute` (
  `id` int(11) NOT NULL auto_increment,
  `wid` int(11) NOT NULL,
  `t_pic` varchar(50) NOT NULL,
  `b_pic` varchar(50) NOT NULL,
  `desn` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `pro_ware_attribute` */

insert  into `pro_ware_attribute`(`id`,`wid`,`t_pic`,`b_pic`,`desn`) values (1,1,'851_thumb_P_1305446129400.jpg','851_P_1305446129127.jpg',''),(2,1,'851_thumb_P_1305446129897.jpg','851_P_1305446129538.jpg',''),(3,1,'851_thumb_P_1305446130308.jpg','851_P_1305446130168.jpg',''),(4,1,'851_thumb_P_1305446130639.jpg','851_P_1305446130782.jpg',''),(5,1,'851_thumb_P_1306437727461.jpg','851_P_1306437727752.jpg',''),(6,14,'852_thumb_P_1305513896296.jpg','852_P_1305513896695.jpg',''),(7,14,'852_thumb_P_1305513896421.jpg','852_P_1305513896578.jpg',''),(8,14,'852_thumb_P_1305513897509.jpg','852_P_1305513897362.jpg',''),(9,2,'738_thumb_P_1305443706727.jpg','738_P_1305443706566.jpg',''),(10,2,'738_thumb_P_1305448510743.jpg','738_P_1305448510387.jpg',''),(11,2,'738_thumb_P_1305443707416.jpg','738_P_1305443707317.jpg',''),(12,2,'738_thumb_P_1305443707774.jpg','738_P_1305443707088.jpg',''),(13,2,'738_thumb_P_1305443707554.jpg','738_P_1305443707963.jpg',''),(14,2,'738_thumb_P_1305443707554.jpg','738_P_1305443707963.jpg','');

/*Table structure for table `pro_ware_introduction` */

DROP TABLE IF EXISTS `pro_ware_introduction`;

CREATE TABLE `pro_ware_introduction` (
  `id` int(11) NOT NULL auto_increment COMMENT '自增长编号',
  `wid` int(11) NOT NULL COMMENT '商品编号',
  `type` int(11) default NULL COMMENT '介绍类型(1:商品介绍,2:商品属性,3:包装清单,4:售后服务)',
  `content` text character set latin1 COMMENT '介绍内容',
  `add_time` int(11) default NULL COMMENT '增加时间',
  `edit_time` int(11) default NULL COMMENT '修改时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `pro_ware_introduction` */

insert  into `pro_ware_introduction`(`id`,`wid`,`type`,`content`,`add_time`,`edit_time`) values (1,1,1,'i am a tester',NULL,NULL),(2,1,2,'CREATE TABLE pro_ware_introduction(\r\n	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT \'?????\',\r\n	wid INT NOT NULL COMMENT \'????\',\r\n	TYPE INT COMMENT \'????(1:????,2:????,3:????,4:????)\',\r\n	content TEXT COMMENT \'????\',\r\n	add_time INT COMMENT \'????\',\r\n	edit_time INT COMMENT \'????\'\r\n)',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
