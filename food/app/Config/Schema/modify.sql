
DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) default '0' COMMENT '父级编号',
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '' COMMENT '角色名称',
  `desc` varchar(200) collate utf8_unicode_ci default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`pid`,`name`,`desc`) values (1,0,'Administrator',''),(2,0,'Member',''),(3,0,'Customer','');

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
  `role_id` int(11) default '3' COMMENT '角色编号',
  `role` varchar(50) NOT NULL default 'user',
  `active` enum('active','inactive') NOT NULL default 'inactive' COMMENT '状态',
  `zip` int(10) default NULL COMMENT '邮编',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`birth_date`,`gender`,`join_date`,`city`,`state`,`country`,`address`,`phone`,`username`,`password`,`email`,`role_id`,`role`,`active`,`zip`) values (7,'admin','admin','2013-05-14','M','2013-05-14','','','','123123','123123','admin','401c7f240363db8580b058f5b152013f943a9cc9','admin@admin.com',1,'admin','active',NULL),(17,'test','test','1987-06-05','M','2013-06-12','aa','cc','bb','afaefew','12341234','test','fa454a094993a04e68f1f49180630b297b76a7da','test@test.com',2,'user','active',12345),(18,'123','456','2013-05-21','M','2033-01-01','','','','1234','1234123','hello','e66266486881a80243da969523c0299861700f10','hello@hello.com',2,'user','active',NULL),(19,'minh','minh','2013-05-21','M','0000-00-00','','','','minh','1234','minh','e74affcde599151214c27926a037bd1c60a11874','minh@minh.com',3,'user','active',NULL),(20,'smith','Jone','1987-06-05','M','2013-06-12','aa','cc','bb','afaefew','13698546584','testa','74614a02ea5a992260ca0e890ec22e936b3b4894','350681421@qq.com',3,'user','inactive',12345);
