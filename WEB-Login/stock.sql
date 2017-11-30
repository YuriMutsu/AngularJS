-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: stock
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
  `username` varchar(45) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `user_role` varchar(45) NOT NULL DEFAULT '',
  `first_name` varchar(45) NOT NULL DEFAULT '',
  `last_name` varchar(45) NOT NULL DEFAULT '',
  `birthday` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `address` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(45) NOT NULL DEFAULT '',
  `phone` varchar(45) NOT NULL DEFAULT '',
  `gender` varchar(45) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES ('admin','$2a$10$hJ0/eW5phSKH4JiHdHyDeuryGXYUJko22Sa8nV7XID33uYSHdn6Ge','ROLE_ADMIN','Administrator','Yuri','1995-04-09 00:00:00','TP. HCM','admin@gmail.com','0898133817','Male',1),('member','$2a$10$bYUr16uKY0C.UtVMLwsZwOk6CYD4IJXXpCGh7vqE1RkngaL7dLT2i','ROLE_MEMBER','Member','Yuri','1995-04-09 00:00:00','TP. HCM','member@gmail.com','0898133817','Male',1);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `content` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `image` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
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
-- Table structure for table `product_details`
--

DROP TABLE IF EXISTS `product_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_details` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(20) NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `image_view_before` longblob,
  `image_view_center` longblob,
  `image_view_after` longblob,
  `image_function` longblob,
  `cpu_technology` varchar(255) NOT NULL DEFAULT '',
  `cpu_type` varchar(255) NOT NULL DEFAULT '',
  `cpu_speed` varchar(255) NOT NULL DEFAULT '',
  `cpu_speed_max` varchar(255) NOT NULL DEFAULT '',
  `cpu_bus_speed` varchar(255) NOT NULL DEFAULT '',
  `ram` varchar(255) NOT NULL DEFAULT '',
  `ram_type` varchar(255) NOT NULL DEFAULT '',
  `ram_bus_speed` varchar(255) NOT NULL DEFAULT '',
  `ram_max` varchar(255) NOT NULL DEFAULT '',
  `hard_drive` varchar(255) NOT NULL DEFAULT '',
  `screen_size` varchar(255) NOT NULL DEFAULT '',
  `resolution` varchar(255) NOT NULL DEFAULT '',
  `screen_technology` varchar(255) NOT NULL DEFAULT '0',
  `screen_touch` varchar(255) NOT NULL DEFAULT '',
  `card_design` varchar(255) NOT NULL DEFAULT '',
  `card_graphics` varchar(255) NOT NULL DEFAULT '',
  `audio_technology` varchar(255) NOT NULL DEFAULT '',
  `connector` varchar(255) NOT NULL DEFAULT '',
  `wireless_connectivity` varchar(255) NOT NULL DEFAULT '',
  `memory_card_reader` varchar(255) NOT NULL DEFAULT '',
  `optical_drive` varchar(255) NOT NULL DEFAULT '',
  `webcam` varchar(255) NOT NULL DEFAULT '0',
  `keyboad_light` varchar(255) NOT NULL DEFAULT '',
  `orther_function` varchar(255) NOT NULL DEFAULT '',
  `operating_system` varchar(255) NOT NULL DEFAULT '',
  `pin` varchar(255) NOT NULL DEFAULT '',
  `size` varchar(255) NOT NULL DEFAULT '',
  `weight` varchar(255) NOT NULL DEFAULT '',
  `meterial` varchar(255) NOT NULL DEFAULT '',
  `trademark` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `PROD_DETAIL_PROD_FK` (`product_id`),
  CONSTRAINT `PROD_DETAIL_PROD_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_details`
--

LOCK TABLES `product_details` WRITE;
/*!40000 ALTER TABLE `product_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_details` ENABLE KEYS */;
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
INSERT INTO `products` VALUES ('S001','2017-11-29 12:00:00','ÿ\Øÿ\à\0JFIF\0\0\0\0\0\0ÿ\Û\0„\0	 \"\" $(4,$&1\'%2-1,.000#+4@?.749/-\n\n\n\r+%+877+7--7+77-++-+77-7+++7-++-++-7-+++++-++++++++++ÿÀ\0\0\È\0\È\"\0ÿ\Ä\0\0\0\0\0\0\0\0\0\0\0\0\0\0ÿ\Ä\0?\0\0\0\0\0\0!1AQa\"q‘2B¡#±Á\ÑCRr‚\á3Sbc’¢ğñ4ÿ\Ä\0\0\0\0\0\0\0\0\0\0\0\0\0\0ÿ\Ä\0#\0\0\0\0\0\0\0\0\0!1A\"BQaÿ\Ú\0\0\0?\0\î(ˆ€ˆˆˆ€ˆˆˆ€ˆˆˆ€ˆˆˆ€ˆˆˆ€ˆˆˆ€ˆˆˆ€ˆˆ¨™U5]tQ4¾YF÷=Á¥k8‡iXLWj¸pˆ:_¨\Ó\êƒoTº\åµı³@4‚’Gõ‘ÍŒ{jV¹[\Ú\Î\"û÷l†C#½\ÉA\İ.©œ^\×\å\Æ\Ë\æê¥\Ä\ê.W;Áı\Âboûl°©ûúiYT\Ğ[+\\~\"\ïñ \î*ñ\ÓˆSı)½Lòú€*¬z\Z¦\Ër°İk\\\Óş.B¢\â\" \"\"\" \"\"\" !Vª&kùCX\Ğ\\\âwrWÇ»kŸ3\ÛILÖ°\Z\én^z\åv\åni\ÚÀ\\÷4qq\r\æO´\Ü^kŞ¬\Æ9D\Ö\Æ=\íª‹ƒ\r­­!Ö±Ûƒ­$ş…\Æ\à{©\Ò6ú;\í	ƒG\Ö\Æó\Ê#\ßö\İjØ‡mtmÿ\0ç§šc\Ì\Ú!ù­\ì»}‹¡lœ½›uµaİ\Ú\Æz­\Û\ÄM·Ô©ñVrV=£q\Øq	4†`\İyù-r³lñY\ÎW\×Kwnd_t}2êº½g8tV&#1dq?AaôSÔ¸d0Œ°\ÂÈ‡&5¬Eh¦\Ø\Û\äDu\Ë\×T8<\Ó\Ê\çk³\ß6ªn³Ú“c#\Ù\â\ŞW`|[ú«/ƒzÚ¸«\í\Ïo•’x\êŸ`\ám»\É!\ä<gG³´ñ\Û$-¿23»Ü©¬G¥†q\Ò62EËœlÁ}\×<=V\Ò\Ì\'x¹o˜-\'.<~™\Æ<\Ù{òj>–\n/\Ãó\Æö\ä\Ô.“‹a$µ\Íkš\Ö‘¦Zm\ît\Î%£\å\Ê~}=\×E>UmI†ø–­\âc\Óe\ì—\ï°ø\Û{˜‰f¿»½¿CoEº®E\Ù{YWWL\×6õ±\á\è\å\×W•=½ºõ\n¢\"„ˆˆ€ˆˆˆ€ˆˆ1\ëi[,rDñvH\×5Ã›\\,óN\rƒ\Æ\ìQ”•.k\ÜX\ë]Ÿz.¡sO¸_O/Ÿ;^¡u6\"Ê˜ô.-•‡üÁù]£Ü©„Lp\ëXF\Å\á´ö1Q\Ä79\Í\ï7\\­€1[\Ã*\Ù<QNÏ‚V5\íòp¿\æ²ò§“?	ö\Ç,^L]U•\ny+8¡ˆ\èÕ·3ş”^\Ğ\í,T\âÍ´’\0\Üz\ÙhûC$„\Ì\é²<\0\ÒZ\ï¢Ú•›1´D:]CšÀ\\\â\Z\0\'U\Î1m¼•¦ G³\0sFRã›€UF \\\Æ\ÔTLÙ€\â—%¡\Ö\í\r<r™»‘ÀŒ±œ­şc\Ç\Õ^Õš\ÆöŒU‹OIš¬^¢¦¦	 ñ=\ì-s˜[I¡\Ğ¯\æz.›C‹?¹kªrg›£½‡\ï¿Eó\ìûU)XÖ€…Àex\ät\ã öW\éöÊ´:F¸\Şù¿\ËE”xo—E«}}®‰·[pe¸–‘\à==Ö“[´H\×Ç¸¹­a¹\âJ×±,ri\í\Şmº\ÂÖº\Ã’/ğ\ßwT´×ª¯J\Ú#\î\íºl. ®§z\\\Ú\r\ÆC‘\Ş|¯Eô\Ø_\ÑL\Ãm¡¸=W\Ö;)‰}¦šs«Áš\ß\Ş\rõe+¦3\í\Ë	2RG;E\ÌN7\0_C¨ü-\êºbŠÚŒ3\í4•\0Ã–ÿ\0x5i÷«Ø¶*&\Ã\Û7t-\ßsøš~¤z-ıpn\Å1v\Ó\ÖML÷dd­ğ\æ\Ó\Ä\İZ\\§\èW`\Åö’–˜\å–Oü­ñ?úz¨\Ö\Í\é1u¬m<\Èb|lxï¥»š8“\ËEÏ¶Óµ	3>*cİ³(!ßµ\Í‡¥\Â\ç8¶Ò¹\à€K7\Ó~õz\×ö¥¦f5\r¾¯\Èndµ‡;\é\È-j»h¹\Ê\ëZš½\æû\ÍøV=œNºW¹ö[NhÖª¤`ı³\åÆ¤;¼·¨\æ\êMõ\â}\Öe.\ç9 \Ø\\€-\Ì\îR5\'+M„Œu·\ëk*ød·-<©N““}œª\nWM#\"Œf‘\æÀš¡\ÂiEû\ê†f\0‘m\Ç__¢›Â«\é!sK s™ñ‹¹·¾ıwkÿ\0jò˜É¾!—…öpó`ó\Ç\â\Ê\ØÁ\Îû–\\»ø\\\ì¯û­\Å\ä\Ú\Úq[şyM\rC\ÚOf|qslEÁ6\Z›ZıV¶SF\ì\Â)nÀ\rš\Æ’\î[YM/¹Ö¸…f³®ùkx\íe4\r1­k?\ÄB\ëˆ\â\å$°“s\î?…\Âö û¯jf.qvš\îp\éı…b\â:¶\Ä\ãa+\\\Ï\æ\ZÀª\ŞşS\ÂÕ¦£—\ĞÈˆª‘Pª¡AóWh˜{¨ñ9{»³3»\ÆÁ\Ä\æÜŸe©T\ã3¾ù¤<¶+±võ…øi\êÀøNRzË®V\Z×‘®º\ÙL#[{k\î5$¯/6¶¶ó¶«\Õ\r,“\È\È`a|6kFò}Wv\Ø]‚¤£k*&Œ¾¨µ¦\Ò\åtş6¶„õ\à¦gfâ¼¸°Àj\ÄM¨t\Ç·Hæ–²\Ü\ï×‡²…+bm\È £¾Cê¾‹¬\Ä\íb \ë+ÀE€\ä4\ËLuş9¯\Æ#¦y\É\ÃË€9€Í¥­\Ëx[d;m\ä|„]\ã6V“ø©ŒCß¯\Õk8†(u\ÕvÒ{\å›t‹\Ä0ˆ[(p\ÌøÈ±i:V\è9(\ÌB††3P\rÀ:…v²¸**Y\ÒÕ¤Clsy\Ö\å•|Œa`‘\á®\ÕÀ8\å\'\ËrŠ¨œ¸òÌ²j\ÛZI°•Å›\'\ã^”¯¹Q\ÅMl–$\êzˆ\æ\Ş75úo67 y‹……\Zó¼\åüT…5+#7\ãÌ¬*´¾º@\à\Óp@ ô^Ö›Ù¶;˜} {\Ã^\Ö\ä±;\ÃNQ¿ pº•^‘µ\Ú*(*Yk\Ò\à-s¦ûz\\z¯•\ë£6‘™·k¼Æ‹ì§€AP¾XÚŒ¹­Œ¿xI;µ\0ùS³z\å¹öa²¿fl©h\ï\Ü>\í§\âcHÔDı\ëU‰uPµ8–›\îT-f)¿U×\ÎÉ–fe5[ŠuZõ~)\ÕD\Ö\â{õPuU¤ñ]U¬V\Åf\Ì\ê\ìD*ª¬›\ê¬K1;µVş\ÎN¤\Ùg|\Ñªa\ÒÌ³]xdv¶°\æT\ä4\Ì\Ò\Ës`l\İ\ãÌ¬J\Úø\ï÷l\Ê-k_=WòÌº¢4Ç‡o\Ìoø+\æV3@@\è7«ôX=\\ö³KxŸ\0ıVÏ†\ìd·¼Ù€\ŞI\î\âYRÔ©„\Ó\ÆI\è/o>KmÁvi2ı ‹^\ä7Wú»‡¢Î“i)a\İ3šŠ?M.V(\Ú\äq\Ï7p\Â,l®ôO^:\ê©)£4\Ñk7]\ÚX~bC·Rµ\ÅÑ³\îZ@vı	\ÕirÙ¤\0:\Â\İ\ä¾E¹ğõ\İ\ä²!\0eq7.˜4:\ßåƒ©a{{š<9„hMˆõ[=%|R‹\Æğ\áĞ®ùZK]r\àt\Îò\Ö\0zH\Û^\çN*õ>%,g3evpl\íÁšñ\Ì=7\ë\Ñ\Ğ*«”\áû<y¬sË·“\äE\ÖõE´,p\Úcv—\Èó\ä‚q˜jñv8;\É^@DDDAB¸gnøa¢\Z°,\0$s\Z~‹º-µü$O‡¼\Û\Å½®lt?‘ôH„\ãš	:\ÙGUWõ\Ñk\ĞT8–·Q\Í_–F¶Ù\Ïú—g\Ô\ÄF¢¿O\Î\å~J‚okŸ¢´Y}N¾[•‰\ëùH=tW©pº©\Ï\ÂZ\ŞgÀ?R°¶[[¹oZEG\Î\ÆiÇÔ«q\Í$‡,L%\İ5?\Ñl\Øn\ÇF.d¼–\Ş€uR3â””\Í\reœxÅ™»K»r\ÎW@\áû\'3\È3;\'A\ã\è\ÅIHŸf¿M]y%<´\áôPµ{GQ(pŠ\Ñ7Cg\Ú\ÜÎ¾\ÊÄ»\ï/q>+ª³Ume¿°ˆ\Øh\\ñwMßŠƒ©¬’R\Ó4¦^V#8ò\å\éea–\Ê\Ãcet2\×cwş¸ º\ØlH€ZH\Ìó¦›¸©z<\Ì\Ü2†›¼‡ø\ÈÆ»½V\r9¼L/w]Ç¥Š‘¤qñ¼p¾g€	\Òş?.h3$Š\Ä\È\Z¾†fœ\à\î\Ò\Ã@EC>2şü‹›N=wª»\0FX÷<›\å½q\è‚÷ß§5?ÿ\0«\Ï;šj\ÆF\rÀh¼£¥ø¨ $\Zj÷—¾\ÄFÆ½\Ì\ß\Äo7ô\ê{Ù¹\ŞÖ—\å¦e¾¹¹«f\Ã0x)Á\î£\Ç\âqñHORuY\×AGƒ\Ç\r\ÛMŠÿ\0´hÏ™YñFCCK®ûY ù«\åxqS3´Dhkˆ\ÔafÁL\İ\ä<r;\Ô#ŠG»\İcÀoq=\Âe¬Y\ÜAû­ \Ì|\Ï\Ëø¨Ks\Ãk„\Ì\Î4\Ö\Äo±E\ë¡Š6(šÁÀjoÌ\äõ(ƒ-6!HÙ¢’\'\êÇµ\Í>DYdª%\ã»;UO4‘:3\Ş»\Â\İ^\ëo¼*\á\Û/+\ì\é\èt\Õ\ë\é-«\ÙZJ\Öı¹^\Û\Ê\ß#Q¯%\Éq54\ÏeE§ˆ¶¦1\ãşq\Äõú ˆ‹\n¥¦\ä-aßšCwŸ!¿\ÙY¨\ÚH˜my\Ï\ï8\ë\æ\Z?5Lc\0|€\Ï\ÍC.N‡\Å~W\ß\èV·,	»-6- ‡1\Ã\ÕJuøœ³74’\\pÏ…ƒùw~%b´?IZ,uy\Ô_şpH\Ûm@¸\"\×p\á\ÑQ¬mÃ‹Á\Ğ\áD½X‚-!6¸#+W±\Ìqs&›‹ªº\Îo‰\Ín]Í·‹\İ{m®\Ğ\Ö÷G÷®nT-e\ÚZ\ì±\å\Ö\æ\ízÈ…¤Ø±¥®ñ“pG’ò\Ï\í\03\É}2ø\Ş}8y­³\Ù)\ŞCªOr\Ï\î\Úo)ówE\"8³¸‚\ŞşC­ƒApı=V\ÕC²²\ÉcPDl¸9\0\Îı:ğ[&‡\År\Ã`\é¡õ<\ÖsT|/†œ	\Ş\ï‰\ç\Í\ÇU&ÉU€U[®–º¦¸zª\İb½\Ín®>Š·i.K)\Çz\í×¿İ·Ì Ÿª«dm.{€h\ŞI°Z\İV;,·m3l\ÓûW\åV+0\×\È\àú‡™¼7\äALS\Òò#hğÀ\Ş<™$?3µw\ä¶\\\ZY#p-$t\à¯\á¸CŸ¨\Zsà¶œ?\ndv6\Ì\îh3bq ,y*+¨€ˆˆ\n…UYª}˜\ã\Ó\ê‚µ\îy$›]-v\×Sn\n\ÓØƒ›W\ìü‘<\ËL\ã¸ğ8r!DVEMRDuQıšq ”h\ß~^z.­=0+_\Åğ\È-)C™c-D.\ÏSšx\0\Ñ\Ì;…´\'§\ÑD¶79¥Í³X4º\è5T\ÍF\Óğ‘c—’Â£\Â0\Ê\×\æ\rt2\ït ÷DŸ.>ˆ4šhs;»7K/¾7E¼aû%Q<q¶¶g5¬Ñ±4‹5œ¹-»\Âá™\"±M\ãÔ\ç\Õf´(K\n\Â §nX#lc˜#\æw•!\èöY0rT\0\Ş\Ö×’Éº‹\Å1øa°\'<‡s«\Ê	\ì\r^}.)´Q\Æ{¸’O\İf§\Ô\î\n*g\Ô\Ôœ÷1”‰Y”X{#cmúóA€i§¨7¨}£?³i³}O+MF\ZZ\Ğ\0\İeŸ\r!;\ÖÃ†\à$€]\áU. \0Iä¶Œ?\0\r\ÖOô…-MJ\Æ4[¯`À\0:/hˆˆ€ˆˆw†\Ü\ÖiQx›¼@r0l¨BöB¡-9ªÔ‘²l¨Z‚\"ªˆ8X…ªc›2\Ù¸jÓ•Àú.„\Êw8\Ø•b²€·\âo¨Üƒ›S\ãuT\Ç-KLğ\Ú\íG˜â¶¬>¾)›\'‡›Ç˜\à¯V\áa\×\Ò\ëXŸf^\Ç÷”\î0\ÉÍ»˜\âƒnG\âx\Ì0½\Âü\ÌO 8¨Ã‰øš\é#\0üÁ¦\ã¨Whğ°\çp2Hw½ÚŸNC\É™\ë\êªthû<^òù+ø~w ]\Ç{‰\Ì\âz*V*S\ËE!I†¹\ÆÀ\ä G\ÃM~\nk\rÁ\Üı\ÃNeM\áø[bıO ¦Z\Ğ4\Z4\\q\Ø\ØsYöUE ˆˆˆ€ˆˆˆ€¢jw¥J\Ä1 Áî“ºY\Âq”ÃŠöS“¸,¨h\Í\ìkZ\åTZÀ4ÁQñ‚,E\Âöˆ\"ªp\î-\ÔrXN£\è¶%iğ‚ƒ^4}Ÿüp<Áö`½²D\Ò\à\ãBt\nZ\ZÁf‹+¨‚–UD@DDD@DDD@DDL¨ˆ*ÿ\Ù','JAVA',120000),('S002','2017-11-29 12:00:00',NULL,'C++',100000),('S003','2017-11-29 12:00:00',NULL,'BASIC JAVA',110000),('S004','2017-11-29 12:00:00',NULL,'DESIGN PATTERN',180000),('S005','2017-11-29 12:00:00',NULL,'BASIC JAVA',120000),('S006','2017-11-29 12:00:00',NULL,'MULTI THREAD IN JAVA',100000),('S007','2017-11-29 12:00:00',NULL,'BASIC C++',100000),('S008','2017-11-29 12:00:00',NULL,'OOP IN JAVA',150000),('S009','2017-11-29 12:00:00',NULL,'HTML5',160000);
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

-- Dump completed on 2017-11-30  7:39:12
