-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2016 at 07:18 PM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdcol`
--

-- --------------------------------------------------------

--
-- Table structure for table `cds`
--

CREATE TABLE IF NOT EXISTS `cds` (
  `titel` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `interpret` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `jahr` int(11) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cds`
--

INSERT INTO `cds` (`titel`, `interpret`, `jahr`, `id`) VALUES
('Beauty', 'Ryuichi Sakamoto', 1990, 1),
('Goodbye Country (Hello Nightclub)', 'Groove Armada', 2001, 4),
('Glee', 'Bran Van 3000', 1997, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cds`
--
ALTER TABLE `cds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cds`
--
ALTER TABLE `cds`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;--
-- Database: `nienluan`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdathang`
--

CREATE TABLE IF NOT EXISTS `chitietdathang` (
  `STTDDH` int(11) NOT NULL,
  `MASP` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKH` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `SOLUONG` int(11) DEFAULT NULL,
  `DONGIA` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `chitietdathang`
--

INSERT INTO `chitietdathang` (`STTDDH`, `MASP`, `TENKH`, `SOLUONG`, `DONGIA`) VALUES
(2, 'DT02', 'Ngô Thành Bắc', 1, 16000000),
(3, 'DT01', 'Ngô Thành Bắc', 1, 15000000),
(4, 'X01', 'Tran Thanh Tai', 1, 49000000);

-- --------------------------------------------------------

--
-- Table structure for table `chitiethd`
--

CREATE TABLE IF NOT EXISTS `chitiethd` (
  `STTHD` int(11) NOT NULL,
  `MASP` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKH` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `STTDDH` int(11) NOT NULL,
  `SOLUONG` int(11) NOT NULL,
  `DONGIA` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `chitiethd`
--

INSERT INTO `chitiethd` (`STTHD`, `MASP`, `TENKH`, `STTDDH`, `SOLUONG`, `DONGIA`) VALUES
(1, 'X01', 'Tran Thanh Tai', 4, 1, 49000000);

-- --------------------------------------------------------

--
-- Table structure for table `dangky`
--

CREATE TABLE IF NOT EXISTS `dangky` (
  `TENTK` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKH` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `NGAYDK` date DEFAULT NULL,
  `TINHTRANG` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `dangky`
--

INSERT INTO `dangky` (`TENTK`, `TENKH`, `NGAYDK`, `TINHTRANG`) VALUES
('', 'Nguyen Thanh Tân', '2016-11-04', NULL),
('', 'Tran Thanh Tai', '2016-11-04', 'DA CAP'),
('admin', 'Ngô Văn Lâm', '2016-11-04', 'DA CAP');

-- --------------------------------------------------------

--
-- Table structure for table `dangsanpham`
--

CREATE TABLE IF NOT EXISTS `dangsanpham` (
  `MASP` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKH` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `NGAYDANG` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `dangsanpham`
--

INSERT INTO `dangsanpham` (`MASP`, `TENKH`, `NGAYDANG`) VALUES
('DT05', 'Tran Thanh Tai', '2016-11-04'),
('IP5S', 'Ngô Văn Lâm', '2016-11-05'),
('SS01', 'Ngô Văn Lâm', '2016-11-05'),
('X01', 'Tran Thanh Tai', '2016-11-04'),
('XE005', 'Ngô Thành Bắc', '2016-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `dondathang`
--

CREATE TABLE IF NOT EXISTS `dondathang` (
  `STTDDH` int(11) NOT NULL,
  `NGAYDH` date DEFAULT NULL,
  `TRIGIA` float DEFAULT NULL,
  `TINHTRANG` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `dondathang`
--

INSERT INTO `dondathang` (`STTDDH`, `NGAYDH`, `TRIGIA`, `TINHTRANG`) VALUES
(2, '2016-11-04', 14400000, 'chua giao'),
(3, '2016-11-04', 13500000, 'chua giao'),
(4, '2016-11-04', 49000000, 'DA GIAO');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE IF NOT EXISTS `hoadon` (
  `STTHD` int(11) NOT NULL,
  `NGAYGH` date DEFAULT NULL,
  `TONGTIEN` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`STTHD`, `NGAYGH`, `TONGTIEN`) VALUES
(1, '2016-11-04', 49000000);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE IF NOT EXISTS `khachhang` (
  `MAKH` int(11) NOT NULL,
  `TENKH` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '',
  `DIACHI` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `EMAIL` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `SOTAIKHOAN` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `SDT` varchar(30) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MAKH`, `TENKH`, `DIACHI`, `EMAIL`, `SOTAIKHOAN`, `SDT`) VALUES
(0, 'Ngô Văn Lâm', 'Vị Thanh,Hậu Giang ', 'ngovanlam@ctu.edu.vn ', '12345678', '0933123456'),
(0, 'Nguyen Thanh Tân', 'Cái Bè, Tiền Giang ', 'thanhtan@gmail.com.vn ', NULL, '0122450450'),
(0, 'Tran Thanh Tai', 'Cao Lãnh,Đồng Tháp ', 'thanhtai@gmail.com ', 'thanhtai', '0933110110');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE IF NOT EXISTS `nguoidung` (
  `MATK` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENTK` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '',
  `QUYENSD` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `TINHTRANG` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`MATK`, `TENTK`, `QUYENSD`, `TINHTRANG`) VALUES
('admin', 'admin', 'Administrator', 'da cap'),
('nhanvien', 'nhanvien', 'Nhan Vien', 'da cap'),
('nhanvien', 'NhanVienBH', 'Nhan Vien', 'da cap');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE IF NOT EXISTS `sanpham` (
  `MASP` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENSP` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `DONGIA` float DEFAULT NULL,
  `MOTA` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `TINHTRANG` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `HINHANH` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `KHUYENMAI` float NOT NULL DEFAULT '0',
  `MOTAKM` varchar(1024) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MASP`, `TENSP`, `DONGIA`, `MOTA`, `TINHTRANG`, `HINHANH`, `KHUYENMAI`, `MOTAKM`) VALUES
('DT01', ' Điện thoại Sony XZ', 15000000, 'Ram 3g, chip Snapdragron 820 4 nhân 64bit, bộ nhớ trong 64Gb. Màn hình 5,2".', NULL, 'sonyZX.jpg', 0.1, 'Tặng miếng dán cường lực,phiếu mua hàng 300,000đ, áo thun thời trang. Hỗ trợ mua sạc dự phòng chính hãng Sony 10000mAh với giá 350,000đ'),
('DT02', 'Điện thoại SamSung S7', 16000000, 'Ram 3Gb,hip Exynos 8890,Bộ nhớ trong 32Gb, màn hình 5.1 inch (1440 x 2560 pixels), Chất liệu nhôm cao cấp.', NULL, 'samsung-galaxy-s7-dai-loan.png', 0.1, 'Tặng phiếu mua hàng 300,000đ, Sạc dự phòng 6600mAh, Miếng dán cường lực, dây sạc chính hãng SamSung.'),
('DT03', 'Điện thoại iphone 6s 64Gb(Đen)', 19900000, 'Màn hình Retina 4.7 inch (1334 x 750 pixels), Chip A9, Camera chính 12Mpx, phụ 5Mpx. Chạy IOS 9.', NULL, 'iphone.png', 0.2, 'Tặng miếng dán cường lực cao cấp, ốp lưng, tặng áo thun Apple.'),
('DT05', 'Điện thoại Sony Z3 Trắng 99%', 7000000, 'Máy đã qua sử dụng còn mới 99%, Còn hộp đầy đủ phụ kiện: sạc,cáp,tai phone,', NULL, 'sony-xperia-z3.jpg', 0, 'Tặng kèm 1 sạc dự phòng 6600mAh.'),
('IP5S', 'Điện thoại iphone 5s 32Gb 99%', 6500000, 'Điện thoại đã qua sử dụng, còn mới 99%, còn bảo hành tơi 6/2017', NULL, 'iphone 5s.jpg', 0, ''),
('LT01', 'Laptop Asus Transformer Book Flip', 15000000, 'Chip Intel core i5,Ram 4Gb, Đĩa cứng HDD 500Gb,Vỏ kim loại, Màn hình cảm ứng.', NULL, 'laptopasus.png', 0.15, 'Tặng bộ vệ sinh laptop 7 món, 2usb 16Gb, tặng phiếu mua hàng 300k, balo sinh viên thời trang.'),
('LT02', 'Laptop Dell Inspiron', 12490000, 'Màn hình 14 inch, HD (1366 x 768 pixels).Chip Intel core i3, Ram 4GB, Bộ nhớ trong HDD 1 TB.', NULL, 'DELL Inspiron 5547-bk.png', 0.15, 'Tặng bộ vệ sinh Laptop 7 món, phiếu mua hàng 300,000đ, 2usb 16Gb, Win 8 bản quyền. '),
('LT03', 'Laptop Sony Vaio Hồng', 19500000, 'Màn hình 14inch, CPU intel core i5 tốc độ 2,6Ghz,Ram 8Gb, Bộ nhớ trong HDD 500Gb. Bảo hành 12 tháng.Win bản quyền.', NULL, 'laptopvaio.jpg', 0.1, 'Tặng bộ vệ sinh lap top, Giao hàng tận nơi, tặng sạc chính hãng Sony.Phiếu mua hàng 300,00đ, Hỗ trợ mua điên thoại Sony giảm 5%.'),
('MA01', 'Máy ảnh Cannon', 4900000, 'Hệ thống chống rung quang học, Độ phân giải Camera 16Mpx. ', NULL, 'canon.png', 0.3, 'Tặng kèm ống kính zoom hỗ trợ chụp ảnh, bảo hành chính hãng 12 tháng.'),
('SS01', 'Điện Thoại SamSung A8 2016', 9000000, 'Sản phẩm mới 100%, nguyên Seal chưa khui hộp, đầy đủ phụ kiện', NULL, 'Galaxy-A8-2016.png', 0, ''),
('TN01', 'Tai nghe Chất lượng cao Company Wins', 350000, 'tai nghe chính hãng, bảo hành 12 tháng', NULL, 'headfone company wins.png', 0, 'Tặng áo thun Company Wins'),
('X01', 'Xe máy Exciter 150cc (Xanh GP)', 49000000, 'Dung tích xilanh 149cc, 4 thì.Làm mát bằng dung dịch.Phun xăng điện tử, Công suất tối đa 15,7 mã lực tại 8500 vòng/phút.', 'da ban', 'ex150.jpg', 0, ''),
('XE005', 'Xe Máy Honda Cup 50cc 99%', 13500000, 'Xe mới 99%, đã sử dụng 1 tháng, máy còn nguyên chưa qua sửa chữa.', NULL, '188201613566Cup81_Com.png', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`STTDDH`,`MASP`,`TENKH`);

--
-- Indexes for table `chitiethd`
--
ALTER TABLE `chitiethd`
  ADD PRIMARY KEY (`STTHD`,`MASP`,`TENKH`,`STTDDH`);

--
-- Indexes for table `dangky`
--
ALTER TABLE `dangky`
  ADD PRIMARY KEY (`TENTK`,`TENKH`);

--
-- Indexes for table `dangsanpham`
--
ALTER TABLE `dangsanpham`
  ADD PRIMARY KEY (`MASP`,`TENKH`);

--
-- Indexes for table `dondathang`
--
ALTER TABLE `dondathang`
  ADD PRIMARY KEY (`STTDDH`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`STTHD`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`TENKH`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`TENTK`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MASP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  MODIFY `STTDDH` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `chitiethd`
--
ALTER TABLE `chitiethd`
  MODIFY `STTHD` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dondathang`
--
ALTER TABLE `dondathang`
  MODIFY `STTDDH` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `STTHD` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;--
-- Database: `phplabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(0, 'user1', 'user1');
--
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `pma_bookmark`
--

CREATE TABLE IF NOT EXISTS `pma_bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma_column_info`
--

CREATE TABLE IF NOT EXISTS `pma_column_info` (
  `id` int(5) unsigned NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma_designer_coords`
--

CREATE TABLE IF NOT EXISTS `pma_designer_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `v` tinyint(4) DEFAULT NULL,
  `h` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma_history`
--

CREATE TABLE IF NOT EXISTS `pma_history` (
  `id` bigint(20) unsigned NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma_navigationhiding`
--

CREATE TABLE IF NOT EXISTS `pma_navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma_pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma_pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) unsigned NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma_recent`
--

CREATE TABLE IF NOT EXISTS `pma_recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma_recent`
--

INSERT INTO `pma_recent` (`username`, `tables`) VALUES
('root', '[{"db":"nienluan","table":"chitietdathang"},{"db":"nienluan","table":"sanpham"},{"db":"nienluan","table":"dangsanpham"},{"db":"nienluan","table":"khachhang"},{"db":"phplabs","table":"user"},{"db":"nienluan","table":"dondathang"},{"db":"nienluan","table":"chitiethd"},{"db":"nienluan","table":"hoadon"},{"db":"nienluan","table":"nguoidung"},{"db":"nienluan","table":"chitethd"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma_relation`
--

CREATE TABLE IF NOT EXISTS `pma_relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma_savedsearches`
--

CREATE TABLE IF NOT EXISTS `pma_savedsearches` (
  `id` int(5) unsigned NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma_table_coords`
--

CREATE TABLE IF NOT EXISTS `pma_table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float unsigned NOT NULL DEFAULT '0',
  `y` float unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma_table_info`
--

CREATE TABLE IF NOT EXISTS `pma_table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma_table_uiprefs`
--

CREATE TABLE IF NOT EXISTS `pma_table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma_table_uiprefs`
--

INSERT INTO `pma_table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'nienluan', 'khachhang', '[]', '2016-10-23 14:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `pma_tracking`
--

CREATE TABLE IF NOT EXISTS `pma_tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma_userconfig`
--

CREATE TABLE IF NOT EXISTS `pma_userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma_userconfig`
--

INSERT INTO `pma_userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2016-10-20 05:37:46', '{"collation_connection":"utf8mb4_unicode_ci"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma_usergroups`
--

CREATE TABLE IF NOT EXISTS `pma_usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma_users`
--

CREATE TABLE IF NOT EXISTS `pma_users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma_bookmark`
--
ALTER TABLE `pma_bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma_column_info`
--
ALTER TABLE `pma_column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma_designer_coords`
--
ALTER TABLE `pma_designer_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma_history`
--
ALTER TABLE `pma_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma_navigationhiding`
--
ALTER TABLE `pma_navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma_pdf_pages`
--
ALTER TABLE `pma_pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma_recent`
--
ALTER TABLE `pma_recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma_relation`
--
ALTER TABLE `pma_relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma_savedsearches`
--
ALTER TABLE `pma_savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma_table_coords`
--
ALTER TABLE `pma_table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma_table_info`
--
ALTER TABLE `pma_table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma_table_uiprefs`
--
ALTER TABLE `pma_table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma_tracking`
--
ALTER TABLE `pma_tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma_userconfig`
--
ALTER TABLE `pma_userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma_usergroups`
--
ALTER TABLE `pma_usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma_users`
--
ALTER TABLE `pma_users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma_bookmark`
--
ALTER TABLE `pma_bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma_column_info`
--
ALTER TABLE `pma_column_info`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma_history`
--
ALTER TABLE `pma_history`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma_pdf_pages`
--
ALTER TABLE `pma_pdf_pages`
  MODIFY `page_nr` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma_savedsearches`
--
ALTER TABLE `pma_savedsearches`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT;--
-- Database: `test`
--
--
-- Database: `webauth`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_pwd`
--

CREATE TABLE IF NOT EXISTS `user_pwd` (
  `name` char(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pass` char(32) COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user_pwd`
--

INSERT INTO `user_pwd` (`name`, `pass`) VALUES
('xampp', 'wampp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_pwd`
--
ALTER TABLE `user_pwd`
  ADD PRIMARY KEY (`name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
