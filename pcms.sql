-- MySQL dump 10.13  Distrib 5.7.10, for Linux (x86_64)
--
-- Host: localhost    Database: pcms
-- ------------------------------------------------------
-- Server version	5.7.10

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tab_admin_auth`
--

DROP TABLE IF EXISTS `tab_admin_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_admin_auth` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL,
  `title` varchar(250) NOT NULL,
  `auth_action` varchar(250) NOT NULL,
  `auth_fun` varchar(250) NOT NULL,
  `menu_name` varchar(20) NOT NULL,
  `menu_url` varchar(200) NOT NULL,
  `orderid` mediumint(6) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_admin_auth`
--

LOCK TABLES `tab_admin_auth` WRITE;
/*!40000 ALTER TABLE `tab_admin_auth` DISABLE KEYS */;
INSERT INTO `tab_admin_auth` VALUES (1,0,'系统设置','','','系统设置','',0,1),(2,1,'查看后台角色','AdminRole','index,','角色管理','url:a=AdminRole',1,1),(3,1,'新增后台角色','AdminRole','add,insert,','','',2,1),(4,1,'编辑后台角色','AdminRole','edit,update,status,','','',3,1),(5,1,'删除后台角色','AdminRole','delete,','','',4,1),(6,1,'后台角色授权','AdminRole','auth,','','',5,1),(7,1,'查看后台用户','AdminUser','index,','用户管理','url:a=AdminUser',5,1),(8,1,'新增后台用户','AdminUser','add,insert,','','',6,1),(9,1,'编辑后台用户','AdminUser','edit,update,status,','','',7,1),(10,1,'删除后台用户','AdminUser','delete,','','',8,1),(11,1,'后台用户授权','AdminUser','auth,','','',9,1),(12,1,'查看权限列表','AdminAuth','index,','权限列表','url:a=AdminAuth',10,1),(13,1,'新增权限列表','AdminAuth','add,insert,','','',11,1),(14,1,'编辑权限列表','AdminAuth','edit,update,status,','','',12,1),(15,1,'删除权限列表','AdminAuth','delete,','','',13,1),(16,0,'其他','','','','',2,0),(17,16,'修改密码','AdminUser','changePwd,','','',1,1),(18,1,'PrinterManagement','PrinterManagement','index','打印机管理','url:a=PrinterManagement',0,1),(19,1,'AuditManagement','AuditManagement','index','审核管理','url:a=AuditManagement',0,1);
/*!40000 ALTER TABLE `tab_admin_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_admin_role`
--

DROP TABLE IF EXISTS `tab_admin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_admin_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `description` varchar(250) NOT NULL,
  `auth` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_admin_role`
--

LOCK TABLES `tab_admin_role` WRITE;
/*!40000 ALTER TABLE `tab_admin_role` DISABLE KEYS */;
INSERT INTO `tab_admin_role` VALUES (1,'系统管理员','系统管理员无需授权便拥有后台的全部管理权限。本角色是系统自带并且不可删除的。','',1),(2,'无权限用户组','本组不授权。用户属于本组的单独对该用户进行授权','',1);
/*!40000 ALTER TABLE `tab_admin_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_admin_user`
--

DROP TABLE IF EXISTS `tab_admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(40) NOT NULL,
  `pwd` varchar(40) NOT NULL,
  `description` varchar(250) NOT NULL,
  `role_id` int(11) unsigned NOT NULL,
  `auth` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_admin_user`
--

LOCK TABLES `tab_admin_user` WRITE;
/*!40000 ALTER TABLE `tab_admin_user` DISABLE KEYS */;
INSERT INTO `tab_admin_user` VALUES (1,'uadmin','e10adc3949ba59abbe56e057f20f883e','超级系统管理员',1,'',1),(2,'test','e10adc3949ba59abbe56e057f20f883e','测试用户',2,'2,7,12',1),(3,'admin','e10adc3949ba59abbe56e057f20f883e','',3,'',1),(4,'11111111','4297f44b13955235245b2497399d7a93','1111111111',1,'',0);
/*!40000 ALTER TABLE `tab_admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_print_log`
--

DROP TABLE IF EXISTS `tab_print_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_print_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `user_name` char(32) NOT NULL,
  `printer_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `options` varchar(255) NOT NULL,
  `copies` int(11) NOT NULL,
  `submit_time` datetime NOT NULL,
  `print_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_print_log`
--

LOCK TABLES `tab_print_log` WRITE;
/*!40000 ALTER TABLE `tab_print_log` DISABLE KEYS */;
INSERT INTO `tab_print_log` VALUES (1,0,'cww','CUPS-PDF','./pdf/test2.pdf','test2','options_123',3,'2016-05-13 15:49:43','2016-05-13 15:49:43'),(2,0,'root','CUPS-PDF','./pdf/test.c.pdf','test.c','options_33',3,'2016-05-13 15:50:48','2016-05-13 15:50:48');
/*!40000 ALTER TABLE `tab_print_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_user_printer`
--

DROP TABLE IF EXISTS `tab_user_printer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_user_printer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `printer_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_user_printer`
--

LOCK TABLES `tab_user_printer` WRITE;
/*!40000 ALTER TABLE `tab_user_printer` DISABLE KEYS */;
INSERT INTO `tab_user_printer` VALUES (6,'Cww','CUPS-PDF'),(8,'root','Brother HL1208'),(9,'root','CUPS-PDF');
/*!40000 ALTER TABLE `tab_user_printer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 21:25:13
