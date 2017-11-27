-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: stock
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `User_Name` varchar(20) NOT NULL,
  `Active` bit(1) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `User_Role` varchar(20) NOT NULL,
  PRIMARY KEY (`User_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES ('admin','','123456','ROLE_ADMIN'),('member','','123','ROLE_MEMBER');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `ID` varchar(50) NOT NULL,
  `Amount` double NOT NULL,
  `Price` double NOT NULL,
  `Quanity` int(11) NOT NULL,
  `ORDER_ID` varchar(50) NOT NULL,
  `PRODUCT_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ORDER_DETAIL_PROD_FK` (`PRODUCT_ID`),
  CONSTRAINT `ORDER_DETAIL_PROD_FK` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `products` (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `ID` varchar(50) NOT NULL,
  `Amount` double NOT NULL,
  `Customer_Address` varchar(255) NOT NULL,
  `Customer_Email` varchar(128) NOT NULL,
  `Customer_Name` varchar(255) NOT NULL,
  `Customer_Phone` varchar(128) NOT NULL,
  `Order_Date` datetime NOT NULL,
  `Order_Num` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `Code` varchar(20) NOT NULL,
  `Create_Date` datetime NOT NULL,
  `Image` longblob,
  `Name` varchar(255) NOT NULL,
  `Price` double NOT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('S001','2017-11-27 16:40:13',NULL,'Core Java',100),('S002','2017-11-27 16:39:56',NULL,'Spring for Beginners',50),('S003','2017-11-27 16:39:45',NULL,'Swift for Beginners',120),('S004','2017-11-27 16:39:29',NULL,'Oracle XML Parser',120),('S005','2017-11-27 09:54:43','ÿ\Øÿ\à\0JFIF\0\0H\0H\0\0ÿ\Û\0C\0ÿ\Û\0Cÿ\Â\0\0\È\0\È\"\0ÿ\Ä\0\0\0\0\0\0\0\0\0\0\0\0\0\0	\nÿ\Ä\0\0\0\0\0\0\0\0\0\0\0\0\0ÿ\Ú\0\0\0\0\ï\ì’!\"!\"!\"!\"!\" 	‰\0\0\0\0\0i54\É-\Z‰i\ZšD´S\0 –‘©o\\c5‘\Õõ/ßƒ>ø8²ñ\Øv\Ë\0t£:(XYð­ó.‡Ÿv\Ë/¦!\ì<öö<\ÆV;v\Õ1 \0\0tß·‘W®J½óö\ÞÓª\æ\Ý\ëµ\Ôu\éò\ä=‡M\Îñ\Õ“)\Ú.—‰m\Þ[´ù®‡†­{¢öùI\ëÙ?¯w1 \0& p·Ž¿Cž}÷~c\Ï\Ì\ì£\î_%\ç\ëÃn#u…;]¾;nW¬¯·g=l\î°q…©yYü\ßsŒ}“u}\è¯\à_D\îý©Š\é‰\0!?3\Ìÿ\0_;»C¬\Ôó\Ç?aõ\ßõ~µ\ÌM\Ç\r\æ×Ÿ¿\èT?ŸA£©\Ð~¾{®ªXšøŒ\ê8÷\Ø_‘¿t_\í®0&$\0‡Š†cð6\0\áB\Ý0}y~Ëµiuû;c\ì\Ã\Í7G\\û(\é\ÅÊ–\ÛÍ\Ô\Î \Þ{+~ñ5\ÑÇº_Ntû\0ó\Í\ès‘\ÚÀ\ÃK§¼œ~ó\Ý\Âv¿v§\×w\Æ/Ê´;V¾m\Ú.Ü¡\Ú7=´§Æ‡XÙ«fQ¯úb8\ß\áÈ´v;M_\Úº\îó=;ös\Å|¨@-?=þŽ­“\ÈFL}\\\Û\'Y.D\ã¿\Æá´©\Ç(nø£{]\Øüö•Ÿ‡\Ë}JM:•_¡\ìXþ\ÛgÉ»F ú·ÂŽ\ç\ë\Ù€&$ŠtcZ\Û\Ó%õ\ì\0\ío?zò¯fw\Ô\êœž\Ö\ï\Ø\ÖmÝ•ó–F+dÿ\0b½#­|ú\Ë{‚)d\Þú¤\0˜\0#aPƒŠðÏ±ÿ\0™\æOý¡R&|]dO«\n\äOOýˆ\ä\ÕZEZd\0\0 	‰\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0ÿ\Ä\0,\0\0\0\0\0\0\0\0\00! 1`\"2@ÿ\Ú\0\0þ·\×Á\×\É)&\Ò\Z:g‘Ö³,Ÿ\"vi•¹òdÁœ\ÜÁÛ£Ÿ«}Î¶/\Ê\ÍÖŠ‡\å^\æ>“»˜ùú–\Ü\Ø~GnSaù¹Où¹‘[Gm2\í:‘s\áF‘´=\È\\º\å•Ò¶|\Üøøh)G\áƒð0cœ†{f«½:\ç`~;]xùK`÷W“\Î\Ý \Çb\Ã= aš¦¦(\×o’Šaš’\0+\Z\ß\Ä9´\ìƒf\Ø\r\Zbh \ÇON¨m“£\ä(Í…‚‡@\äÁ ,UYš‹k\ÈQ±Ü’Lˆ§\â\Ø\ÖU¨±ž·nK hj“9\ëSK$››Ê–\Ë5¥\Z…9{c§´W,Ú»I2š^%\Ü+\ÕC.J(>\âM\åö§—\Ö ‹\×\Ô\Ä\äH?\ZR2B\Ç\\”Š$Í­\âôª=\ß\\‚A\í†6UŒ«X‰”¬ª1ZÄ¨—Ÿ¶‰„L<+¯ö!<|É²ûûôC³¶jƒ°6Qo4Y\Ú\Îò¯¡`¹L\Úer\Üøe3¼rî€¸›,Š&”Iž9\×þ\Þ\Ô^#¤»R\Ã÷~\ÌEn˜ƒ¢\âN\\GN¹\Ü2˜eÀ1E“W¶9<p\ë	¬´´DzQ1~-Ÿ>5}\ÔM…URa$žŸU<F\Æ\Û›l®{\ïP{ÀÁy‡\\p\ëdŠ¢«¾7W¾\á\Û~\Ò1ñˆ\Îomu\nInL®±\î;›aX¢×®².+ô€£g	\\¯/\Ún\êþR|§90²/	0¶U1Àz˜\Í\ê7\n«ýÙ\ØcBÁµ(ƒ\Øy;\Ìó{·d\Ë\Ü\é\ä\\÷D¨ƒ t£…f\Êô\\\Ã\Ú)\Õv\í”\Å#\Z›‹pP:+\'ŸŸ¯È®f`¡\âm\â5W\ÒõtŒ \×\çy7ly“{\áb‰„ª¼j+<hb\Â\ÏD\âRb\Î ¸X“\Ð\Í\Ñ1\ïv»¥[\Ó\ë\ÈeŽg‰\á\Ônlö\í‹µ\ê\Ð­´ªúu:¯\Òj26b.\é£\ì®],\â5qW (ðCó¡\ïC%,\à¸W\r‰€¥€f¡\Ô3\ÐCŒ»”\Ì$.*\0S›u9\Ä{(úÅ¯¯\ZUœ\n:SZ\×it\ï¯@u\ÝÀZ5¬,\ê6\Þ<¨\Ôf«\Z\ê†*ŸP7¨¸—w©Û¨¦ô‚I‹ˆó&¹ND—1RjD\0‡8\']Xº“\Çg§¶\Ím®#N\é¹‰~\ç\\\')L$¹qò-\Ø\Ùuª¼a\0õÿ\0®³ù\Å[¤¦{URvrËµ\\Hª\å;\n›\ÇÆƒ£¨®@j³»Z[´hV0\Z§…VˆªµV	t\Ñð“E´i‹e|\ë	\Ù,ø\é‚\\1z‹’¿^µFUûjÎ¡2ƒ¯Y2±›\n\åUºj\äq«²\Ûu$<\ÒVmò(ò±\Óð+‡qr\Õ5uªxi:%„i!¨\ì#Ê‹$Q/ü\"@3V\Ç\Å!bW`0bžÕ¿ÿ\Ä\00\0\0\0\0\0\0\0\0\0! \"AQ1P02R±Áb‘¡ÿ\Ú\0?öLAi±+j–ú–\×+õ-¢U\ãB\êš\æ¼i¾\ãf\ÝOÕ™,K‰Ssµxr¯Œ\ØgzõL\í‡!H\Ö\áL\nƒ\Ä\nI˜KúœS\nM\ÅBk\æ{E;P.q\ê@\Ðkh–…\Ñ\à\Æ\ä]ÐžŸsm?‘\è¤\ä)1i‚\äºþG\ëýM¦yKòk²\Èòû\ßð©¯s\Úƒ\0ßª†¾i\nn\ÑE‡v¼zª²Õ©\Éq	\Ñ8/\Ù\êT¿g\æ3\ã*F‹\âj¦\ÓÛµ4ƒ å¿DrNþ¡>•(þH\Ñ!·\å+\Ë^Â¤`¹‘	\"\Ý\à]`ƒµ‚º°*È\ë¬\ÖK%’¾\æ)\Ö\Þ\\-u\Ñ\"\ß\n\èŸaÿ\Ä\04\0\0\0\0\0\0\0\0\0!Q1A 02q\"PSa‘#3BC¡²ÿ\Ú\0?øTùÇ‘™(¸cU~QcU~QƒI©\Û0i\ÓÃ‹fÓ([¾„9\Å&Œ\\i)\ä\"]\Ì>©\Æ\å\Ë\Ã2ølu·XViC\Ý:\Ä\ålD?/Õˆ®/5ECnþ–\íufÓ¶¿h«9\Øð»¹NBl3l	±þ \Ê\ÉL¼\Èm	.+(F\àrVöúó\Ê-\æ1;V®3UP\0†yiô#ýXúzÄl\ÖE#%\ãüe\×ï¥¸úEL%»«h}Þ¹õ/s\ßÂŠ\ê_S—úC ô©e\á™\n \Å!š”Ò¦oñÏ­À\r€…\ÕXH\Ò\'*®¯\Êm‚¬´Rœ¸\Ô\é\08C9ùo\"\Ì3‹*­ù\á¼dµ~b!8–A\ï\Õh\Ä¦eÒ–\Õ~ž1–-\Óux7‹\Þ,\"\Ý\Ûoß¼_ À‹\ÅüŸÿ\Ä\0M\0\n\0\0\0\0\0!\"12AQaq#03BRr‘¡ Cb’Á\Ñ$6S¢±²\Â5`‚4@DTsƒ“”\á\âÿ\Ú\0\0?ÿ\0\Î\Õg\ÜFd\ä%\ÉÉƒû)žP\è\Ã.®ZYª£Ç‰C¤•9ú 5Ô½e¬&I\Â$øÄ‡‹\Û\Ñ\å	¡<J\í=Kwù£$Ñ¡\ëñGÿ\0PZ©K%\ì4ü\áZz¥Fh\Ñ8|Jý÷Mr	¬í‡¹O\Ö\Óÿ\0\Ã\Ê?]gGþ\\¸~QúýYtA?m\ïôò¬ö¬¯ª}\0€»R\Ð5\'\Ú+\ì\ÖZuS‰;m\çš LW\êM²|\Ôl¿–Te\Íõ\0E\"DD\î÷\ï¤J 0²\ë,Erq\ÛïŒ•¯½\Ú\ëÛ‹®¬×¥N8ûñÀ~8\ïG\0üaH…ÁR¬’Xô†ºd=m²˜Gø¯œ¡P„®\ÍŒO<‚»ž}rýÐ‡ŸT¾±Ï”p\Ç\n]Stpö\å£tnÑº7E¹\Ì\áJ\×$\à\í\r£( ;-DhŸ²}a¦%¿\Ç\Îi}T»O\Ö\r‰[~Í½„þU²F\å[®H)\Z--Pt$*\ÚW:‰!G\Õcy©!K¹2\ï³dæ„¬HT\n³CÆƒ0óŒ\á~]Wr•·¤vF\ëö}†›OU»ªF‹\ÐDüe^—Þ¦;—\î‰Cm6˜[hA:“w›Òªñ®Ñž \Ï\×T°ü\Õ!½b\â<\Üvþ\Ú\ïù¯\ê\ÍX@©\Z-+\Ê^GS\É\ë½KöX—º\Óp™•nB©-0©)7-u— K¯§\Åê«¥»¦*”jÌ%(õMš}†\Ú$~N_ý\ßX·¶\"\Ê•	‘“nF–s3N\rð ¦\îø\ÑyšŒô•<t¥&j\âŒ6ˆ×®	\áU¶\ßhZ|÷\'Ya·’\Ì#£„\Òé´œþt\ÄÁt9d\î‰ZÙ R\æ&¯\Ð\â\Øù‹\ÎI\Ñ\0ð¿¤Õ¦ÁQ{-mô\Ã\Ó‡lðú£Õ1Ñª\\\ë.\Ô*^7y\Ã]g‹öµˆÝ½e\Ý\ß\è\ët¬\Õg^jb·J§M 7/C–[JJ!®\å5\Ú(ª»Z\Õ7¦¿\Úß—•l±ry~`Kz 6H“	ÉŒ.OÕŒ\ëM«K³&\ÛE«nüøÈ£\Æ\ÎÓžoDfA‰54\\s³Aûð†tm‰:!J†™R\é”É™FD^pk\ã¤\ç:.è®.]©ZwŸI)vx±+%¾½;\Òwy6\Õ`\Ë;•ó-\ÒS\çg™“`\Õ=V‡[½\Ï9F\ÑÖ\É\èý	ð¿\×=Ÿò\á†DK&kqé¡N\èj¹K³»\'¤œ\à˜i}U\èŠõT\èóU]0\ÒJ‰½;0ûˆÜ»aõM\n\ï\Â)\Ö+³\Í>\ê\Ø›h9„:¡lxK¡\é:DžÊ”	¶D$<$eH\ÚE\íXô¢+\×(˜‘¼H	e„N¾ud›ÀýJ\\\çf;]+\î\áójK¸R\ë\Z[ZC\Ö37]teW\êAp·òŽ·QBm¨ö¤&\Ð/\Ê7|#cr$oŒ\Ö=UŒ²†\ZNk©E6˜\È\âv¡<\Ó-Šs©’$Sil\"#4\ÉeÛ·²\0ˆŸ\Ã\Í\é}tQ\Ù\nÁK\Ûö˜l?5…%º©-Ëµca\Ç«q¡{\ãx\ÛdK\Ü[F\Ò:\×u\ãfi;m’\éÔ±\Åxµ¾ö\è\áï…¾Pyð¥£EZ \Æ\Í:`\ç_Ä™Y„º|ü\Ê\ÌTgd\ä%\Ó{ó³\"\Ð|V‚§3Z!+(\Ð\äI\äOóðü\à¥ô{G…­Œ\\¢yý~\ÏN÷|b¥FY\ÊB‹X’6*2/JYpü*™¢Â >óEl‘\ì\â\ío\ÙX\ÛeÁT\ê\Ê3\ß©Š\Û&ý!™±Zƒ 7U\Îx™›\Ñ\éf\åiº–\ÄQ¹mP™Øù]ca\Âp­>¥\ïG”lÝŒõÓ•\ÒQ\à[%\í~\ÒÆ—i+\Ü$¤Y”–s \Ü\\eò·Ñ¹*\n\'9F¢­¤ôÐœ¾Ì„«ºù…\ìlsEFjO\ë=\rB¶\\–_\á\Çò‡+4\Êu-s\Õ\è\Ê <?õ\\‡\ßr¦ýIMW[3¦s*ð§»ž\Æó,6\'œ\Óf©$=Œ¦ø#“ª€4©®™^B–ö|7‡—¥Õ¶¹¤\ä‰\Õt\ßƒ(\Ô\é*\\Mp¶=7U€qu§ds%D\íƒ`þ\ÛÚ+,7ö†<“\Ä\Úô8™E\Ã©öV6€¼?Œ$‘Œ±²‰\äÈ˜LcØ±dÞ«hb¢M¨?¤UG\æVü\í¢\áo\äž!«Ë²\í8\r¶Ä¨\\\Â\áN®\Ø ¢R©´F¹}yCß”*\Ö4Ž¥4õ2­µ÷(Åƒoõ¨¸Ný°E+6ŠEÄ³M¡qÀ„\Å9$\\Ç‰Úª¸sK\Ý \çŒe6B}\Ü÷Gñ…ze©¦Bò,\Ë4‹.gy%Y\ÒôR-¹»£…!zf Ãª^B˜`ª\Òv\Ýa§gFPÛ¶Ì­=\Ä\ï‡\0\ßY1•uµU.øEn_“2)…_d¶:\àe\å0)zi ²§|bÂ™\'\Z\ß\\#R\Ï.\"]•\á¼š\Ø\Ê+œY\éU¶\Üy9ŒN\r M_\"\ÜžP®–¦JY¬S\è´\Ö\Üvry\äA¡\ÄW\ìÑ–•0\Ñi,±—9\nf¿\í6±&\ÍB7.¡7(ø\ÜLbboD¿I¥\ãUf<xˆ ü\ã’Vd¦\èów¶ªq½•^£\Ýºa·(¸4nõ¢FÉ£=(\ÚgÃ·\í\n\à_”[\\Ž\'³4ŸÔ‘¬q¢“?Û´¿\Ô?ŒÄ»\ÒÓ˜‘n\åG\Ê|\á\ç\\n`¦Ó\Ù!Di;\Ò9[\ï12ª{\rÌ»šF¶`]`ú´e­•XÕ¡0\Òd„ˆ‹	¨m\ÆS\Ê8^..#©\Ó²mšÂ‡J\Â\ä\Ô\Åò\Âgl\áe³”Ä‹g5kh\Ã.ªóŠ¾‰>\Ø\å•-sRÃ–®]¼n—E’(Q$\å\ëótÁr¡R&?H%<ó.l•7}ù÷\Â\ì¢/ZCOSØ˜\ç6¯\Ìh\ã\ç*¿ðª˜›^\è ©\Ó_`\0­\Êe‡]\é\Í\nXE\Ñý£_”y2®3EN¨»xƒ­\Æ\0w¹X-t\ëQE\Úm\Û\rƒ2\Ä\Ü\Ö;œ\Ó\î\áù\Ãj\ä\ãNbO@…o\á\r¡J° \ä\á$¡\ÒRõñ\"Y{#i¢E\Í\Þh+8\Ø\Ûrf°\r£FNªd%\ÕV	\çù9dkˆ\ïÔ­=\çœ\Â(\Ùd¥\ÒE¯\é¿(y§™“ ý5×ž\0É„w&\äúkpK\Ú–“=ˆrjš#3{\ë%¶~P\â»\'\ã)p_õ‰a\Â\å»![U!tw³08O\á\á\ê\\£óðf\ëH\Å,vT\è\ßœmÇ¬–\r«Y`TÉ©l	ž©3X—%z\ë`\ß\Ý\ZÙ»IµÎ‚›K\r3K– Û»\Ój\Õñ\'Eù–ù†n«\ê\nXw\ê\Æ\È\n\"d(™$0\î²y«(Á#\"õC†R-£«õÍ¦øÃ®S\r*\Òb»2³)g:¡eª2\Ó4É„[j§\ÉÜ±{¥—r\ß/2\Â7ld{šº¯t8Ê›,\êB\î6‰ˆ»:–$ù&b]÷›¼ü\ÍAsÅ’7nkZÉ¶\Éó\Ë\Ò&\Ï\ÂI¡\É7\"e€Ø¥º£$ó»Iò‚»B·\éH0™‘e\ë¢ñ·?@šz\\Rê’m\ãSW¦4\ÓBª+	©=a/2\Ì.%„7@©Nñƒ~”“¬·\ÃD²ˆ¤›\ÜtwÀù[&WHDD·B±fˆ½Ñ·.Á{\Í\"Å¤\ÓN‡$\0¿»t*3k\Ò\Ý1´ü#\É\ÉJ¹.)øFB)ØŸ\áoÿ\Ä\0*\0\0\0\0\0\0!1AQaq‘0¡Á±ð \Ñ@P`\áÿ\Ú\0\0?!ÿ\0\Í_\Äö™–\ßû>—ý©™oilË­xûlr`]ƒx9]ü\\*Å”@SÝ¡\ê‘\\ ^¨Ù²2)=\É \"n¹ún\Ë\Ý\Ï\íTXJ¯¤[\Ê8wB\ç—Š.7H›\ßqŠM–fff~™†d¡[µ=Ü¶\ë^2B4SYõJ\ß\ØE:h‚\ç\ÙS~\áK\"\èj\ÎS\îN\Ë\é>£¿Ëœ­2æƒ–¨\ê\Çs½œ+¾\ã]øhm\ÜO˜*¬W6u0\Ú>\"/0/…\Âfž\É\Ð?D\Ù$tx(lÁpk¨13ýb`\Ê\Ï\Ýö\èp^’\ÛÕ‡\í“\Û\0Èªô„-\ÔX«uA\Ëi7Žˆ\Ý\rZJ-\ê\ZÁ\\Y©oƒ«8”\Ú\ÝSp›€\ëø ®\Ó\âs0j®f\ÝIK ÿ\0£0\Óô•:\ÚZ.{u§òišN÷ydO±„]»\Î\à\à\0·iõ\ßrFü-…¡\\c0»M´µ•ª¢Sû¼Bª\ØZff—\ÔZ\Çs\nå°‚\Ø8FŸjP\Ù\Ä\í\Ån†U6\0NF\Ñ\ì˜µüR¶¿ae±\îbc,¤\Ñ\Ò\ØP‡|»,cOFs¸u×‡\rž¨%c>ªŒ\0r\Ãôˆ§pøql¡þ\Èu|”\ç\×Á¾\à´K<ö¦‘Œõ…w[A	S\ÎHgZ.\"rVZIÌ²x”|}·O\ê]bd\ÄW\ç6²À¥ºXp\ë\re9G©\Þ\ã2ll\\R³\n»>\æí¶¦õr¯3\Éô\Ç8?f4š{ó}\"[…¢a«½þ ¼.10U\â©Uö\ìRS n:-\â„\Ä5I\0SU\â,<\è¬l/\è\Ì-œ]C—\Å`Ë»Qú\ryˆQ\ÈCž¶\Ä6Á\å\é\Ñ<·ør\àM	„¾ÙœogøH­o[—’üÜ­ñ­&I‚7¬Œ÷Wú\"Á~±\0WµœˆŠ^!~i\â:Q\äN8‘_\ïxAk6¯–Npý‹­Pö„òrz\á^ò\Ü‚#‹Á\í\äcŸ«\Ê{’g«¯Pxº\Æ#«¤Î¬±møFB§I\æ\Ü\îSµ\æ9P¤°+Á}\æ^VEpÀ²Vùb3Dñß¶\\?·Ö \í\"\Ø\ã\çø“M\×j˜\Ñ:–§¥˜6…´\Èw6 N7ü2nžƒy.‘af¸tñ¾a\ÛŠ\å\Õ^\ì¦\nú\èw¸3m\Ý\á\Ýji²ª\ãŒH.*\nž OùŸqùO..X†?z²m›÷1\ÇÐ…\ë*\ßeó)[Ja5\'ŽrúúC\å\Ø\à(\å‚X¡»ª½þ±	Š\æ¥0Ú°\è\çPrG7Zû¹=\Ç;ŒPTxJ*¸‡Ož\ášSôb\\¿$LLqI\ÐB.	\ÊdXê¬‰kD\ÑB\ßjH])0ó\åyg\Ü\ÂLÐº\î\â$>bjVT\ëyñ\ÒBÕ6.J~\Û\Ì\ã(\Íú9\Ø\ê`1ˆnœ„\Ë7;`Ú¸\Â\Ñ\â\'º\ß[<\Ú 5\Ù\è\ì\â<¡_3l©x\Õ|¥T•‚ùð†«9˜J±@}\ÇY2¬\Ýa¨6½Ç­\áòB{\æ»\ãý\Ä[€qþ?R5·\0­ù\×\à€	 Ž^v1[I*Ô­~Š”—È¿€_\ê$_\î9\ë÷S¦•z\â.©°\Êm\â7æˆ©\ÔXd\å²r_2\Ë,qEß’\r#.Q\Äpð\Ð\è\ÝB\Õ[[Ú®p•IFè¾¿Tˆ<\ËqSVKûA£Ô‹ž\ë{\ê?ú&U\Ö ··^v!ö»zo\ÄKN\ã\àzB\ß\Â,»¢2™;4–(Ä©\érv\Ê_;Jpq¹\Ä\Ù,n\ã?2Ãˆº\áÑ¬Nc\Í5:.5û”cžH\î‘ñÿ\0\Ùh^`\Ç\à\Ý`ˆ¦Œ²\ä;\á\Ä\'(€\è8ƒüw“£2$R\æ]!ù\ëGAð{Ò™e¾JW¢˜Œ\0hg¥¥\ÚÅ¢jªq¤n[Ë›®> M[E\nô\Õ-ó\Zf(µxµP‹µ\Z[†¦Û´[ô?:\Ãt¾ˆ¶·A\Æ)\ÙA¾«Kˆb*rŽ\Õ¤§°—\ïˆ\È\Å\åCp$+\Æ\áI©PK\Åóv=ËŒ,û~ ,\ì¼1¿#\âf1G™˜c	X‡t«µ«iº0}Z!¸«¶\Ò\æ\Øg…´ˆ³Ä´#‡	Õ‡©ž¿n X—†0¼³šb\Ê\Ôðñ<!õº5Öžq\ÄW•{b\ê`Ò©^Ÿø†%…»_T•š\nÇ¹V]¨\0hÿ\0OYƒò\ÆV;ÿ\0Y\Zºñ\ÌU\Ó\Ä\Ð`{\'\Äit\â5ÿ\0{r\åË—.\\¹r\åË—.\\¹r\åË—._\Óÿ\Ú\0\0\0\0\0\0c0\Ã0\Ã02€\0\0\0\0\0\0\n\0\0Á(lüÚ‹\0(\0\0\0¢-a`*\0 \0\0BAƒr*3ò€\0BIú›.³\Ê\0\0•tM8º\Ö#£\èDc@<\Õù>f£+€€ò€.MË‡s|\Ê\0C9ž\0\0(\0\0\0\0\0\0\0\0<s\Ï<ó\Ï<ó\Ï<ÿ\Ä\0\"\0\0\0\0\0\0\0\0\0\0!1A Qa0Pq±ÿ\Ú\0?ú\nq\ãÁ°R\Ã_³Á–…g[7d\ÊB\â\ÅÔ›ÀA\Éw¶ks’)ƒy†\Û?°eûõ7¬@Ô«ÛOB	\Ñ/°¦\éX([\Ç3K²­\ï¸\Ð9±\Äzq\êÍ–)½‘\ä\æx\ëµ\0\Äõ[Ef[\ç¶y¢¬r¬hÁø\Ýú¨\'™kZ¼N^Va\Úb±6Fv\ÄB\èõ\à\à)\ßW“<±,“Q‚ñ\ã/Q5˜\n\Ô¥\\¢QwÄ£M¤\n\Ò )s†ÿ\0‰lUúÿ\Ä\0)\0\0\0\0\0\0\0\0\0!1 AQa‘q¡Á\Ñð0@P±ñÿ\Ú\0?ýý„¤\é>‡\ÓÏŽ\'\ÚBë¿©B2¸`ž™\×\Þf Œ£!E0±m\á²C©9kS\Úþw\ïC\nþŸ\ê#\Ò\ÏG¥u>ºbx*`\\ÁSAuV-i¢,q„7@Cƒyº‰Jef	‹+­ZŸnx>wô€;\ëñ	Epa?9J\0\Ð]Pfð\0\r\04œupE¥ù+)\n6\ãOI¦û÷«¼Ò—{þ\î7€úS\íõ,\ì\Ô\Z”žgÎ \Ít\r Å¢\Ãe¤7Ü´€\Øñ6‚À$jñº)¬A„%8\Äp\"Ÿ\Òÿ\Ä\0)\0\0\0\0\0\0!1AQq‘a¡ ±\Ñ0ð@Á\áñÿ\Ú\0\0?Œ\Z\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\êQ\Ñ\ê!N\ru\r?\ä:|CGùŸ\Ñ\ãüõ¶\Â‡\0¸\Å\àžv€\äÿ\0\Ò[ñU–V\ê\ß\Ãù‹Š\"pkó>\Ç\Å\ÎÁ|òP\navû†\âH(Z&x\Út.Â„\Äs¦¥rƒlÐž\'.0e¤.«‰£se.‹/\\\ÄPi~\É~³^\Õ\ÛcL‚®wú\ÄO\Ë±õi+ÿ\0‘ôD\'\Â\Û\Éq\Z|À_\ç\Ã$4xý¯@—Ô—Ô‡`\Ö7®pÞ\à!:¶ž\Æ\Ñ\0/\Ã)ù7=(°\0(k)K—3?X\ÜC|\Z‰Õ§4ZL…ôja~-ÿ\0R\Êöôþ¢‰H1F7²f…\Çc‘Á:ž¾@Z³Eu\r?\Ä\äD±22\Ü\Î%O\áý\ç7\æ à³‚X‹\Ó\ìb\r§É‰\ÅCaÁ>\Æ\"mjÖˆ`	›¿\îr¾\Ô\ÜªRÃ¡£šù®!!4KX2¿õ)k¤\n~A÷>ù´€&,|CGñ! ­”•…v\Ãx‚<Uù%F€\Í8÷lB\\\0Y@•h—µÙ…¶\ê–h6\Ã\Ý(Hioi¹ˆÕ¶\Ï\Ë<¼\ÑËµ³n#DU­c¥»>¡\ÍL\\]c\Ö\Ó.ò)¯÷S“ýFdŒ,C:Ï\'€!£\ÇøAƒ0\ÃŽµ[ô\Z¼\ÙS›°\î\ã‹m)Ÿ‰F…»¡\\-#\Ì:±\Ø‚T‹‰z”u:{T\ØA{«x3(W¤\0‚D(*°)A±tfÔŠ\ä@%\n\0›X`£FË¸ Qh¾õÿ\0PXµMÀ+ù%¬ŒYÈl)\ç\Ô\È\ã?\Ñ\ã÷¡U\ÐKRŒ‘\ãV{,\\®M»À\è?7U›)B,$‹V(w—\ä€`Œ¯©úE+Q›²2…S€<¥!«£<´…\ã\ÕR\æ‡\è@H6j.\Þ\áw2\\õY_\'™¾E‘\é\Æ9.·ñ;0-–þ\àqYŠn\ÇS\rzŽŸ\Ñ\ã÷«Áp^JûŽ‘Rˆ\ZŽ±\Å[†\ÎÅ¾¡Ò®ñ”P8\0r|‰œo\\‰]k0Œ˜–û6\Ìy[a\ã»ñôh»¼š„q›Ô±‹‹o•\ÔL/o¦†‹)\åe\r\ä\åÓŸ>\ç!¼•w\äñ¦²×Ê»&Š\éú &3V>ƒ\à#§\Ä4xÿ\0	\æ`xV½\Ë(.Ü¬\Ñs…–À\åŸ­Nµô0cÎ¿JDGþH%9?\"P ¸©e²~ø\ÄPdþS@‰\Ì}F.B¢\Î|\ËV\0‡À¾ó\ì\0@2\å8_$‘áŽŸ\Ñ\ã÷_<w.\\ë§€´x\æ\Æ\\\Â]\âüÂ£z_HU\Â*[\í¿\Ê$cŒª•H¬úø×ˆ@Á\Ñ\äÌ®d\ä\ßó\n\×¬·\Ü\ÑyW\Ú”Òz\ê\0g–~?õ5M\È#ø`³¶pQ·%ùŽŸ\Ñ\ã÷h€ÁB\Þ;Že•\Äºµ\âˆúˆúŽ\î\Êé¦®g¾ƒˆmpv\ÓV `(\Îe¨º“JøÌ§ºRž\È=\Ò\äš±­9\Z”š	‰x%4\Â\ä¾\Å1–\É÷[ù­\çm_\æU,\â^.XPò\Èx¸\0\ÆB­pRR\Ú ²/ú…\ç‰3\È?GOˆhñúh9SjÐ¨\ÛC@¬\äw:®c Có¥%‰CmEü,\Ä\n¸:`c	n\æ!›ÁŠa,@/^á´¡ðù¨®’ù›C\Ð\ä\n4¢Èƒ¨Mg\æ80E«¸L@hªA7K\ì\Â8jš˜w‡1\Ç/ó&6\çIk*û`f\è(ru\Þ<\\\\\Í$ƒJ^[X0ÅŽcOÃŽIEá“ƒN\Ñ4ó\Ñ\Ó\âž¦\ÅN$\r!\Û_só\ÖÁLfù¬ŠfYú*o\Ö\Ë\äjð\Ê\r«Ë\âmPVÀ€8\Ï\ÇE³zy#–ß™}À ¾\0ZM$b\Ñ\èbr\r†e\ÚW±\È0!‹\Ä\Î3œðX¼\Ä kz$”:cp.Ð¥BŸ\ÌbÍ¯\Ì4(Y1\Û”Q\Ã\n©Gø]‘b\ÔÁŠ$\Î19/+Œ\Ý\Ë-\ìx#T	»\Å\ÐV>\â¦\Ç\åMq†q3$\Ú)¨©¾ÆŒiK\n\0\'Pmi`2_6o›¿\Ñ\Ó\ây\r‘ë¾”1U\Úf‹C\0u•¸P—q_Ž*/R²7é§ž\'z‰\Ô\0;¶Ï©»õ\'AõQÚ½bSÁ\Û\É	»ªS\é\ë¸\î\Ã(²\ã \ï>B$a\Ø\0R\Õa\Åù¥(,”¶\Âpª \Ë\r\Ó\Ð\áEaò\"F…9.`e\Z[#†\Øk‹¨g)ú`l~I…¯¨ ½ó+n¨s\Üt3#Œ \Ô‡û$¤¬\á4<\Îj\"\ìH-\â\à\Ð\àJ \Å$\r§€Ï¿\Ñ\Ó\âaª\åg”\Æ\à\Ð\àzŸÓ®’¬–ö8¬r\Æ7©\â_`_Ê±\Ô&£\n|®\Û\áZ\Î?(!!p€igÎŽ¸ˆ\ã`0¯–J`\Í%˜Ä½‘‰£OFe÷X´;¾\Ó,e\é\Ú:GP6ÁBQm¤„þe\Ô\Ù\å\Ë\0€aTq\Ó\å˜O`\Õe¾e®(C\Ò\rò*PÓ¨ ¸XP‘Z/\0X\0\04«§\Ä4xŸ˜\"ÀdÔ„	°ˆ³6¯Fo7Ãƒ’¡\ä˜h!\Ê,\×A2:FƒµG²8Èµz?¿©Qµ\áG^#z\ÓU°—­6Bœüi®™®*’\Ç\ÑP\ïF\á²0ªHÀ@Û¶\æ¾Fªø+>`c\ìÁ\Ãù„\'¹`\ïM\Ý$\Ï\ÄJ32K—KÁ:±Ú¨ù9ŠD\í\Ý%C\Z\èP~§Oˆhñû\Ãi·±\ì‚DJK.Lq4\Èx#\Ë\à`€_¤„3J(\ã>\å	€?\Õ.al\Å\à,~r\åÈš\Ú\r›\ì‡ dd±h\Ë\Ñ\Ð&’®X\n•“av|r¬n	>3Q\ÐÌ¨ò\Åc\îDV*+ÿ\0‡\ìtø†¹·8v$R8\Ò\'\Î%\æµey\Ò-\å\ÔL\ÎL³©¥\Ï\Ù&‚=¨/S ”%ù|\"\é`&sÄ¾e˜\á†PÎ¸¡>a)0¼ý\ï\îiÁ®	œ\ßxýÎŸ\Ñ\ã÷ \ì\Â\\\n•\Çö¢ úm½\Æ\ÜÀ‹{±a\ç >cjcG\èP8 ’†\\\n\0+\ãüŸ\Ñ\ãþC§\Ä4xÿ\0\éñ£&¥;=\Êv{”\ì÷)\Ù\îS³Ü§g¹N\Ïrž\å;=\Êv{”\ì÷)\Ù\îS³Ü§g¹N\Ïrž\å;=\Êv{”\ì÷)\Ù\îS³Ü§g¹N\ÏqJrjÿ\Ù','CSharp Tutorial for Beginers',110);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-27 18:10:44
