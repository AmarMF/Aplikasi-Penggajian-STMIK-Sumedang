/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 50729
 Source Host           : localhost:3306
 Source Schema         : gaji

 Target Server Type    : MySQL
 Target Server Version : 50729
 File Encoding         : 65001

 Date: 22/12/2020 23:08:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jabatan
-- ----------------------------
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gaji_pokok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tunjangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport_pagi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport_malam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_malam` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jabatan
-- ----------------------------
BEGIN;
INSERT INTO `jabatan` VALUES (1, 'Ketua Yayasan', '2020-12-09 09:05:08', '2020-12-09 09:05:08', '15000000', '10000000', '50000', NULL, 0);
INSERT INTO `jabatan` VALUES (6, 'Satpam', '2020-12-09 20:54:44', '2020-12-09 20:54:44', '5000000', '1000000', '30000', '50000', 1);
COMMIT;

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_rekening` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `karyawan_nik_index` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
BEGIN;
INSERT INTO `karyawan` VALUES (2, '006.11.07', 'Sudharmono', '$2y$10$42maJSWidKECg8I715Oq8.j8LC3nBQVWEAXklio5JKuGF6dOvI42W', '2020-11-21 13:09:52', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (3, '007.09.08', 'Nanang Somantri', '$2y$10$JyFgX/x5i13XK/aXaRUKpe5Y0jIzxLtW/U9saCmos5j08bIvJS/sO', '2020-11-21 13:09:52', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (4, '008.09.08', 'Indra Kusuma', '$2y$10$EgQfvnebSGdxBROCWa8/VeNaYQ/7gZYHNvtgS6kHhC40W8LLgaq5K', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (5, '009.07.08', 'Elvin Mudhita', '$2y$10$JF2tYZWDynyxVSChgA0ASepjUoZ/uciUEtJpcdRBjJuXyhC6VpgUm', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (6, '005.11.07', 'Bagus Winarmo', '$2y$10$ZgftDOSW9xW/BsSRDWTuNOeSSABYDzLElmXvFlHuxxQl93vOGiZfi', '2020-11-21 13:09:53', '2020-12-22 23:01:43', 6, 'Sumedang', '08191819');
INSERT INTO `karyawan` VALUES (7, '021.12.08', 'Amiruddin Basyari', '$2y$10$Flzy.pvSiOQHerAUzKBuLeh.Q4ibYA22LChr/jJPWUm.OYWqHnply', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (8, '022.12.08', 'Subardjo', '$2y$10$3QR5eQBWTdCpnGsZRrPiIurFqiFCJVae7PaVqVPqF02KRA/M8rM6m', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (9, '028.12.08', 'Abdullah Ma\'arif', '$2y$10$VKuHTFJMDX/ph8a.jiQ9u.dk4omlNOSkMuStzrjhumFt1TCeuTvpa', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (10, '036.07.09', 'Kamaluddin Ramadhan', '$2y$10$FfDS3VJENLI6RWa3yIluyeISFwvKZeQaL1Yj3YutpIMz4bZlhcOUi', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (11, '038.09.09', 'Bayu Nugraha', '$2y$10$xYEutZamBCibLQXFcHuhduaxU1nvgftVzB05X/u59X.v6EIm3TPcG', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (12, '041.05.10', 'Dadi Musthapa', '$2y$10$baFTXXfD7MHV.vQfNLEmD.bFKWEFdajyrXs2joqucjmOWKFCGqlf.', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (13, '042.05.10', 'Eko Prasetyo', '$2y$10$XozZRBmtGDU7yg4MVKVC6ueIJ1BTMh4nSvbdDGzkJcEwuKfLuY9zG', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (14, '043.12.10', 'Heriyanto Lesmono', '$2y$10$FKbUCxcqg.QFYnby0/tVC.BGb.SKaDbLZjRG6ZHf19PJpbSDkVGj6', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (15, '045.09.11', 'Wuryanto', '$2y$10$u1nVFzkd/0OOwWj7u/crfuppp.Hvy90RZJ3FcfYFNXpbvKWWh5Tja', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (16, '047.04.12', 'Didik Setyobudi', '$2y$10$odQEZiz3Sv.OsGTvrz2tJObNHk8JfgUYiFZwPjjp8p2zIZGQfHXeW', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (17, '048.05.12', 'Puji Trilaksono', '$2y$10$//ADaJh2k9ySo85iXi9/RetBh8/QWqAsXI4nyAxwtrzAToINt.mhe', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (18, '049.05.12', 'Yusuf Rosadi', '$2y$10$bb/o3tQk6Nat71UUPbzIy.ID0s9rMSfG1O35oGKgLIil8tVI4ujfS', '2020-11-21 13:09:53', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (19, '056.06.12', 'A.J. Messak', '$2y$10$AcXHoVpPx8gHco7SYcEbgeFbz.95p6CoOFY3PdA2G3nOzVL11/aLC', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (20, '054.11.12', 'Ade Komar', '$2y$10$ou7wrHpexHwSqMFptQaXBuWE3B4lJdfes9bfpIyx57rVnJ5cCZhhy', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (21, '055.12.12', 'Suryana', '$2y$10$9zs3HICg8vLdPaJI7dIhseDv5JHVyQOeBP9rZdzY5eMjKRrqdPwZK', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (22, '056.12.12', 'Hendrik Timotius', '$2y$10$MvEcjgLc0fx9YNh3iuYYXOfxlzxoPvbkpMNASPcjnrbH327ee5GLW', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (23, '059.03.13', 'Dodik Mailairi', '$2y$10$Q0ZNUa2/mO0Gq8WtyMBjnO8UytYdlSjwnVFeeZvM89Y3lrlwytgwC', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (24, '060.03.11', 'Triana Putra Aprijanto', '$2y$10$Op3/vlA4yW7f/gglnakL8.QSxI.ThxVeXHmuk9mOH8I4PrhiqjvNK', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (25, '061.04.13', 'Yudha Wangsamenggala', '$2y$10$/qiwMifQYcMV8ITxciJlPOjQDzU3JwhLZzNxR0JT53JJwA.1TkAX.', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (26, '063.05.13', 'Nenah Rosmini', '$2y$10$lqJoUWvj8l/ERouqN2vyzewlVmuPSUdw.DJwM8VjmVqvoWNs.J.fq', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (27, '064.05.13', 'Edo Ahmad Murtado', '$2y$10$vWXq/v42bcFosRQsT2pmtO7AfhZgP8l.7l9WKadpBRxTARh0A7xOa', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (28, '065.05.13', 'Wawan Setiawan', '$2y$10$nxjet1VF.uguOhk6BQjpCOmcWjHjPk3l8PqZszWULwkEy.1h5VFYm', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (29, '069.09.13', 'Rully Shara Monica', '$2y$10$EI1QspqQ8kdxKyP76WBGieJmX/xX2MOY0WYvY.1Rsxiax7bdFywrS', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (30, '070.11.13', 'M. Hamzah', '$2y$10$n0QMtMloKHEtveoLF7d0HuwkIKWKaizzOeynb/mfSTBddeVPqaE8m', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (31, '071.02.14', 'Budiharto', '$2y$10$SORpqVThAykDJHQdNJaAZOfbjlMtWdeIAVzLpv7Kmrvelou84wnqi', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (32, '072.02.14', 'Gatot Eko S Wibowo', '$2y$10$Dx34SvJFlX.fMUABRyF/h.rlQoI8K8rIw5u5QXanKwjyB4vwQCJH6', '2020-11-21 13:09:54', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (33, '077.06.14', 'Hafidz Faizal', '$2y$10$Yxq/f3qWoESVdBPCgyfTMuLQlME0SN27jH07Vu.g.GjHbvnp.Tz3.', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (34, '079.08.14', 'Soleh', '$2y$10$CS597X4B7K9gVVjC/llEXOX0eWYPNeXgva7XsBkEKHzLB5PvXu0cW', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (35, '080.08.14', 'Dinar Tiara', '$2y$10$4nQvmaODYuaoipkVCEfnNewE7Ab7WANShc9UQULG78e7AfwhI/cvm', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (36, '081.02.15', 'Asep Abdurohman', '$2y$10$pVcvsj/wxMyIKr.xxvs.2uU7h8p4HotX4MYqMuAEraC4ZflIDCniu', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (37, '082.02.15', 'Ahmad Siswanto', '$2y$10$KRoUYsSfFNWwEqBoHG9OXOfvsMUWzjnE0cD7.z6S7C3uVNGxUQBju', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (38, '084.06.15', 'Andri Krisna Senjaya', '$2y$10$rlOPWvNUbmtf2vVIurdR9OEw0EwfjlsI39Dwqx9MXHKIDkriZ3KFe', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (39, '085.06.15', 'Dhira Ramadhan R', '$2y$10$cGvu6JcawXMOYpRUTNjNzuEZ81egkt8T1QlbUjcZRe2.QmrIrArKe', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (40, '086.06.15', 'Feri Ferdiana Setiasaputra', '$2y$10$UVnbDBbsMsd4Q3NXAzCfIebK/OZljJhvIb/VMtYbE9gONiARgfn4u', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (41, '087.06.15', 'Ela Nurhayati', '$2y$10$onSaf.iGorcL0Y8.wvvTKejuKA3qF4gkLhW4EBP78WFL3Vk3OEyLG', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (42, '088.06.15', 'Heri Hermawan', '$2y$10$WeE5U9lHQvS4HZmTvB0ugeQyyO09r89MYMMyGS.ixrOg9h1GdR7C2', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (43, '090.09.15', 'Agus Hermawan', '$2y$10$sXCIVu3LdQk/BwciDaUVO..KcU79MSPiprZ/iCcoJdEm2V./aJTGa', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (44, '091.01.15', 'Nisa Fusti Manikam', '$2y$10$gCBLFKpnd8eeedwUJmFyxef51p7a6eoOueJOppFNS.rtKIRBNhHZu', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (45, '092.10.15', 'Dede Sutaryat', '$2y$10$TD3xl5PeljRGqe/2d5zGd.X1l4CJG/FFr5Vx9nV/p8Xk00vaXgQ2i', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (46, '093.03.16', 'Dani Gunawan', '$2y$10$ZIDLnEa8A.fPAMp/XKWkUOthBbzLWxBNxsJA.HJVsH6uUcX.NP7fW', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (47, '079.08.14', 'Fitra Susanto', '$2y$10$2AWBpjG3Ki2mhqCUZbH8/eP9qkCYMg7M/gu437oUrT/uNrIvwUwfm', '2020-11-21 13:09:55', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (48, '097.10.16', 'Trisnandi', '$2y$10$PXQKf3ZDP8LIYa6M6Jw0COLh/CN5eS4oRf3QI3xhU.TcAsqVatWTu', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (49, '083.04.15', 'Sopian', '$2y$10$S83Hkj8wpxHAm0lIx3PXluntIuECm389Uy68yRPPrbfYJvX5Ia1kW', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (50, '099.12.16', 'Adi Sulaiman', '$2y$10$gnVXVDAvVgMARCNdWO5/rOwgLZqk7AHrGqLTqVwtrCNyI4kaNhCve', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (51, '100.02.17', 'Sinta Noviana', '$2y$10$BJsUOIvhRzVzcSONhFsx8eauPI2M4NBCVa5RDViQQgSy.JzabEWu6', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (52, '102.03.17', 'Herman', '$2y$10$4AnEcnBCA.wiSOwEENonW.GfxISznPdiwJUAE8HK7p/v0DoQu/qpS', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (53, '103.05.17', 'Dani Setiawan', '$2y$10$IuW5rJcvOMa19Y6Ae8pLme3GQmNgQT9jnfXngEGtiaI6R9zkhRLbW', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (54, '104.07.17', 'Yudha Dwi Pangestu', '$2y$10$LIGNyXensrhNLcKutMTX2uLD9p2adF5Qf/RX27zzDuddOI4sNqyMi', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (55, '105.07.17', 'Randi Pramayuda', '$2y$10$nqqBcuE.b7AZUt/P8OcSa.cG4c5IAuQklGCF9/GAgN/Us/6GnLuRS', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (56, '095.10.16', 'Dadi Mulyadi', '$2y$10$1d61HoCUNRrSFA0ZniD73OgWdB5ez7bNEnjSrD2aveqAranbRx8Aq', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (57, '096.10.16', 'Marga Sanjaya', '$2y$10$mAm4ojkuEMESWUm5eIlhE.uNGYlmy.f0WSmRaaZO52wyDplgO7Fba', '2020-11-21 13:09:56', NULL, 1, NULL, NULL);
INSERT INTO `karyawan` VALUES (58, '009.6969.69', 'Trisna Narayana', '$2y$10$zL1A3ZpVrTHm3NsfswWSD.nXWEIQBTIZkE0BY2aWCL6MSkfAj7lZW', '2020-12-01 06:28:14', '2020-12-01 06:28:14', 3, NULL, NULL);
INSERT INTO `karyawan` VALUES (59, '123.123.123', 'Farid', '$2y$10$X.swi.AKW.hqP48gZrpCzuFGEpWk.o8q/lwH7k04S7TrHG3op00Ou', '2020-12-01 06:46:58', '2020-12-01 06:46:58', 3, NULL, NULL);
INSERT INTO `karyawan` VALUES (60, '123.123', 'asdad', '$2y$10$ik74aghOwZfZCc07ERy5EewarTyKOBG76FP5iRGLw/lIV9kUv3Fxq', '2020-12-01 20:36:58', '2020-12-01 20:36:58', 4, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2018_01_23_124012_create_karyawan_table', 1);
INSERT INTO `migrations` VALUES (2, '2018_01_24_032058_create_penggajian_table', 1);
INSERT INTO `migrations` VALUES (3, '2018_01_28_102655_create_absensi_table', 1);
INSERT INTO `migrations` VALUES (4, '2018_02_02_233853_create_pengguna_table', 1);
INSERT INTO `migrations` VALUES (5, '2018_02_23_090902_create_upload_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_11_30_204628_create_table_jabatan', 2);
INSERT INTO `migrations` VALUES (7, '2020_11_30_205253_create_table_tunjangan', 2);
INSERT INTO `migrations` VALUES (8, '2020_11_30_205259_create_table_transport', 2);
COMMIT;

-- ----------------------------
-- Table structure for penggajian
-- ----------------------------
DROP TABLE IF EXISTS `penggajian`;
CREATE TABLE `penggajian` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaji_pokok` text COLLATE utf8mb4_unicode_ci,
  `periode` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `penggajian` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tunjangan` text COLLATE utf8mb4_unicode_ci,
  `jumlah_jam_pagi` int(11) DEFAULT NULL,
  `per_jam_pagi` text COLLATE utf8mb4_unicode_ci,
  `jumlah_jam_malam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_jam_malam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of penggajian
-- ----------------------------
BEGIN;
INSERT INTO `penggajian` VALUES (5, '005.11.07', '5000000', '2020-12-01 00:00:00', 0, '2020-12-01 00:00:00', '2020-12-22 21:56:43', '2020-12-22 21:56:43', '1000000', 9, '30000', '9', '50000', NULL);
INSERT INTO `penggajian` VALUES (6, '006.11.07', '15000000', '2020-12-01 00:00:00', 0, '2020-12-01 00:00:00', '2020-12-22 21:57:33', '2020-12-22 21:57:33', '10000000', 18, '50000', '0', NULL, NULL);
INSERT INTO `penggajian` VALUES (7, '105.07.17', '15000000', '2020-12-01 00:00:00', 0, '2020-12-01 00:00:00', '2020-12-22 23:07:31', '2020-12-22 23:07:31', '10000000', 9, '50000', '0', NULL, '100000');
COMMIT;

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
BEGIN;
INSERT INTO `pengguna` VALUES (1, 'Finance Department', 'admin@gmail.com', '$2y$10$QKOrnldU3lpSQhPFbwzyWOL84ubBnhBKm/qcubUyQFmIPpTEEQEZK', '2020-11-21 13:09:56', '2020-11-21 13:09:56');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
