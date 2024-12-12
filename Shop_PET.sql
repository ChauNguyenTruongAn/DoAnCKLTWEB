-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 13, 2024 at 12:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Shop_PET`
--

-- --------------------------------------------------------

--
-- Table structure for table `ANH`
--

CREATE TABLE `ANH` (
  `Ma_anh` int(11) NOT NULL,
  `Duong_dan_anh` varchar(255) NOT NULL,
  `Ma_bo_sat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ANH`
--

INSERT INTO `ANH` (`Ma_anh`, `Duong_dan_anh`, `Ma_bo_sat`) VALUES
(1, 'https://cdn.pixabay.com/photo/2014/07/30/19/28/king-cobra-405623_640.jpg', 1),
(2, 'https://cdn.pixabay.com/photo/2019/05/05/15/06/snake-4180800_640.jpg', 1),
(3, 'https://cdn.pixabay.com/photo/2013/10/11/07/26/snake-charming-193966_640.jpg', 1),
(4, 'https://cdn.pixabay.com/photo/2023/06/28/12/32/chameleon-8094345_640.jpg', 2),
(5, 'https://cdn.pixabay.com/photo/2019/05/07/09/29/chameleon-4185364_640.jpg', 2),
(6, 'https://cdn.pixabay.com/photo/2024/04/22/17/03/ai-generated-8713076_640.png', 2),
(7, 'https://cdn.pixabay.com/photo/2017/10/04/08/42/turtle-2815539_640.png', 3),
(8, 'https://cdn.pixabay.com/photo/2022/08/18/03/08/sea-turtle-7393867_640.png', 3),
(9, 'https://cdn.pixabay.com/photo/2016/05/13/04/37/box-turtle-1389243_640.jpg', 3),
(10, 'https://media.gettyimages.com/id/179207914/photo/indian-cobra.jpg?s=612x612&w=0&k=20&c=j3xI2N3aOVJlmgsdm8_jHi-Ja057-oYrj5eonHu_fyo=', 4),
(11, 'https://media.gettyimages.com/id/522603930/photo/albino-monacled-cobra.jpg?s=612x612&w=0&k=20&c=LDymyoztMYL46RLVaxgImqxPfQXxxZhA2x-bEHAwL_k=', 4),
(12, 'https://media.gettyimages.com/id/1473294016/photo/close-up-of-a-javanese-spitting-cobra-ready-to-strike-indonesia.jpg?s=612x612&w=0&k=20&c=EoJ5CizsgOyizqm91KV6JZ2UaP_PxSW2Y8wJ3Of1X8g=', 4),
(13, 'https://media.gettyimages.com/id/1298772937/photo/purple-spotted-pit-viper.jpg?s=612x612&w=0&k=20&c=Jf3jlrp3wZj0bZw7GMp6hG77MCy3WWnaQpajCUY3z2c=', 5),
(14, 'https://media.gettyimages.com/id/124828421/photo/brightly-coloured-parrot-snake.jpg?s=612x612&w=0&k=20&c=9T5dH4BT6uUVDo__KIg8QlaRzV8EVCTNYHgfeXWdZFg=', 5),
(15, 'https://media.gettyimages.com/id/1463843606/photo/close-up-of-viper-on-tree-bekasi-barat-indonesia.jpg?s=612x612&w=0&k=20&c=aWYoxdqu0ljq5NX9JpFUwZ_cuCESFOl19kBBIdgKaVg=', 5),
(16, 'https://media.gettyimages.com/id/574901555/photo/eastern-brown-snake-flicking-tongue.jpg?s=612x612&w=0&k=20&c=2apmlsxaRT9cNx0_c5XVgQoATCQcr29h5yTcUKZWPW0=', 6),
(17, 'https://media.gettyimages.com/id/624626136/photo/grass-snake.jpg?s=612x612&w=0&k=20&c=ALJjWcmpb5PjZRTl_Wrh4hSF8Ip3fZh42SdMXrFMmhQ=', 6),
(18, 'https://media.gettyimages.com/id/1452744515/photo/close-up-of-grass-snake-on-field-liberec-czech-republic.jpg?s=612x612&w=0&k=20&c=oyOGiIrJ7yDplPHCoQZiMQhUv03a0TxogSLGpZv-EF8=', 6),
(19, 'https://media.gettyimages.com/id/522261292/photo/eublepharis-macularius.jpg?s=612x612&w=0&k=20&c=LhEojgMhOSGIIYmUgyVpY8697fBzsTe9FSdUWBd7G8E=', 7),
(20, 'https://media.gettyimages.com/id/655868466/photo/animal-with-bucketful-and-cleaning-equipment-standing-in-a-domestic-room.jpg?s=612x612&w=0&k=20&c=toJVZndTixXlg0x2KO4MSy4TXEtOk-f8v01yQdyBymo=', 7),
(21, 'https://media.gettyimages.com/id/957195932/photo/crazy-in-love.jpg?s=612x612&w=0&k=20&c=lfny6g90yOzuol6A4Q-TwYZIfuMlBlDQWDFoyP2fxjI=', 7);

-- --------------------------------------------------------

--
-- Table structure for table `BO_SAT`
--

CREATE TABLE `BO_SAT` (
  `Ma_bo_sat` int(11) NOT NULL,
  `Ten_bo_sat` varchar(100) NOT NULL,
  `Gia` decimal(10,2) NOT NULL,
  `Mo_ta` text DEFAULT NULL,
  `Ngay_nhap` date NOT NULL,
  `Ma_danh_muc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `BO_SAT`
--

INSERT INTO `BO_SAT` (`Ma_bo_sat`, `Ten_bo_sat`, `Gia`, `Mo_ta`, `Ngay_nhap`, `Ma_danh_muc`) VALUES
(1, 'Rắn hổ mang', 2000000.00, 'Rắn độc, cần người có kinh nghiệm', '2023-11-22', 4),
(2, 'Thằn lằn tắc kè', 5000000.00, 'Thằn lằn đổi màu, dễ nuôi', '2023-11-20', 5),
(3, 'Rùa hộp vàng', 800000.00, 'Rùa nước ngọt, màu sắc bắt mắt', '2023-11-23', 6),
(4, 'Rắn hổ mang', 1500000.00, 'Rắn hổ mang có độc, cần nuôi cẩn thận.', '2024-12-01', 4),
(5, 'Rắn lục đuôi đỏ', 2000000.00, 'Rắn lục có đuôi đỏ, sống trong rừng rậm.', '2024-12-02', 4),
(6, 'Rắn cạp nong', 1700000.00, 'Rắn có màu đen vàng xen kẽ, rất đẹp.', '2024-12-03', 4),
(7, 'Thằn lằn da báo', 250000.00, 'Thằn lằn da báo có màu sắc độc đáo, dễ nuôi.', '2024-12-04', 5),
(8, 'Thằn lằn xanh', 300000.00, 'Thằn lằn màu xanh lá cây, thường thấy trong rừng.', '2024-12-05', 5),
(9, 'Thằn lằn sa mạc', 500000.00, 'Thằn lằn sống ở môi trường khô hạn.', '2024-12-06', 5),
(10, 'Rùa cạn châu Phi', 2500000.00, 'Rùa lớn, sống ở cạn, thích ăn rau củ.', '2024-12-07', 6),
(11, 'Rùa nước ngọt', 700000.00, 'Rùa nhỏ, sống trong nước ngọt, dễ nuôi.', '2024-12-08', 6),
(12, 'Rùa núi vàng', 1200000.00, 'Rùa quý hiếm, có màu vàng nhạt trên mai.', '2024-12-09', 6),
(13, 'Kỳ đà', 3000000.00, 'Kỳ đà lớn, thích hợp nuôi trong khuôn viên rộng.', '2024-12-10', 7),
(14, 'Tắc kè hoa', 150000.00, 'Tắc kè hoa có khả năng đổi màu, rất thú vị.', '2024-12-11', 7),
(15, 'Cá sấu nhỏ', 5000000.00, 'Cá sấu con, thích hợp nuôi làm cảnh.', '2024-12-12', 7),
(16, 'Rắn vua', 2200000.00, 'Rắn không độc, rất đẹp và được yêu thích.', '2024-12-13', 4),
(17, 'Rắn ri cá', 1100000.00, 'Rắn ri cá sống trong nước, dễ nuôi.', '2024-12-14', 4),
(18, 'Thằn lằn mào', 350000.00, 'Thằn lằn có mào độc đáo trên đầu.', '2024-12-15', 5),
(19, 'Rùa hộp', 850000.00, 'Rùa có khả năng rút mình vào trong mai.', '2024-12-16', 6),
(22, 'Rồng đất', 3200000.00, 'Rồng đất có vẻ ngoài kỳ bí, thích hợp làm cảnh.', '2024-12-19', 7);

-- --------------------------------------------------------

--
-- Table structure for table `chinh_sach`
--

CREATE TABLE `chinh_sach` (
  `id` int(11) NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `mo_ta` text NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `lien_ket` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chinh_sach`
--

INSERT INTO `chinh_sach` (`id`, `tieu_de`, `mo_ta`, `hinh_anh`, `lien_ket`, `created_at`) VALUES
(1, 'Chính Sách Bảo Hành', 'Chúng tôi cung cấp bảo hành cho tất cả các sản phẩm trong vòng 6 tháng kể từ ngày mua.', 'https://media.gettyimages.com/id/1329897496/photo/engineer-and-inspector-had-written-in-the-clipboard-and-discussed-in-working-area-of.jpg?s=612x612&w=0&k=20&c=i-8eu7Zq9BOaKpD4gmNRWd6gCKvTEJL-v_qtT9lk3k4=', 'chinh_sach.php?id=1', '2024-12-12 22:44:04'),
(2, 'Chính Sách Đổi Trả', 'Quý khách có thể đổi trả sản phẩm trong vòng 30 ngày nếu không hài lòng.', 'https://media.gettyimages.com/id/1608041127/photo/woman-shopping-online-using-digital-tablet-at-home.jpg?s=612x612&w=0&k=20&c=xIjHV7Cy6XN4-2so9nQZCDWbL_zDAdVPbgIiCu75N2Q=', 'chinh_sach.php?id=2', '2024-12-12 22:44:04'),
(3, 'Chính Sách Giao Hàng', 'Giao hàng miễn phí cho đơn hàng từ 500.000 VND trong phạm vi nội thành.', 'https://media.gettyimages.com/id/1434715649/photo/parcel-delivery-for-senior.jpg?s=612x612&w=0&k=20&c=OX81ZQI64AmtLdflUFEw4G3UsRnrfkkjLRhHH3OTrBY=', 'chinh_sach.php?id=3', '2024-12-12 22:44:04'),
(4, 'Chính Sách Thanh Toán', 'Chúng tôi hỗ trợ nhiều hình thức thanh toán như thẻ tín dụng, chuyển khoản và thanh toán khi nhận hàng.', 'https://media.gettyimages.com/id/1371481913/photo/this-has-become-the-standard-way-of-paying.jpg?s=612x612&w=0&k=20&c=zfFM2BoGHFAR7Cw4co1LBSRH1BVv94JIhvbnf5_trO4=', 'chinh_sach.php?id=4', '2024-12-12 22:44:04'),
(5, 'Chính Sách Bảo Mật', 'Chúng tôi cam kết bảo mật thông tin khách hàng 100% trong suốt quá trình giao dịch.', 'https://media.gettyimages.com/id/1431662905/photo/cropped-hand-of-woman-using-mobile-device-with-two-factor-authentication-security-while.jpg?s=612x612&w=0&k=20&c=bNpgWHdZM53wgprffmBPITjEKc8sH3qc0fp9By4AMy0=', 'chinh_sach.php?id=5', '2024-12-12 22:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `CHI_TIET_GIO_HANG`
--

CREATE TABLE `CHI_TIET_GIO_HANG` (
  `Ma_bo_sat` int(11) NOT NULL,
  `Ma_gio_hang` int(11) NOT NULL,
  `So_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CHI_TIET_GIO_HANG`
--

INSERT INTO `CHI_TIET_GIO_HANG` (`Ma_bo_sat`, `Ma_gio_hang`, `So_luong`) VALUES
(1, 1, 2),
(2, 1, 2),
(2, 4, 4),
(3, 1, 2),
(3, 4, 1),
(7, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `DANH_GIA`
--

CREATE TABLE `DANH_GIA` (
  `Ma_danh_gia` int(11) NOT NULL,
  `Sao` int(11) NOT NULL,
  `Chi_tiet` text DEFAULT NULL,
  `Ma_bo_sat` int(11) NOT NULL,
  `Ma_khach_hang` int(11) NOT NULL,
  `Ngay` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DANH_GIA`
--

INSERT INTO `DANH_GIA` (`Ma_danh_gia`, `Sao`, `Chi_tiet`, `Ma_bo_sat`, `Ma_khach_hang`, `Ngay`) VALUES
(3, 5, 'Thiết kế sản phẩm đẹp mắt.', 3, 1, '2024-12-12 00:00:00'),
(4, 5, 'Dịch vụ chăm sóc khách hàng tốt.', 2, 1, '2024-12-12 00:00:00'),
(5, 5, 'Dịch vụ chăm sóc khách hàng tốt.', 2, 2, '2024-12-12 00:00:00'),
(6, 1, 'Giao hàng nhanh chóng.', 1, 3, '2024-12-12 00:00:00'),
(7, 2, 'Giao hàng nhanh chóng.', 2, 4, '2024-12-12 00:00:00'),
(8, 4, 'Sản phẩm chất lượng, đáng đồng tiền bát gạo.', 2, 7, '2024-12-12 00:00:00'),
(9, 3, 'Dịch vụ chăm sóc khách hàng tốt.', 2, 2, '2024-12-12 00:00:00'),
(10, 3, 'Dịch vụ chăm sóc khách hàng tốt.', 3, 4, '2024-12-12 00:00:00'),
(11, 2, 'Sản phẩm chất lượng, đáng đồng tiền bát gạo.', 1, 3, '2024-12-12 00:00:00'),
(12, 2, 'Giao hàng nhanh chóng.', 1, 1, '2024-12-12 00:00:00'),
(13, 4, 'Thiết kế sản phẩm đẹp mắt.', 2, 3, '2024-12-12 00:00:00'),
(14, 2, 'Giao hàng nhanh chóng.', 2, 2, '2024-12-12 00:00:00'),
(15, 1, 'Sản phẩm chất lượng, đáng đồng tiền bát gạo.', 2, 2, '2024-12-12 00:00:00'),
(16, 4, 'Dịch vụ chăm sóc khách hàng tốt.', 1, 4, '2024-12-12 00:00:00'),
(17, 1, 'Sản phẩm tuyệt vời, rất hài lòng!', 3, 0, '2024-12-12 00:00:00'),
(18, 4, 'Giao hàng nhanh chóng.', 3, 1, '2024-12-12 00:00:00'),
(19, 4, 'Giao hàng nhanh chóng.', 1, 0, '2024-12-12 00:00:00'),
(20, 1, 'Dịch vụ chăm sóc khách hàng tốt.', 3, 0, '2024-12-12 00:00:00'),
(21, 1, 'Dịch vụ chăm sóc khách hàng tốt.', 2, 8, '2024-12-12 00:00:00'),
(22, 4, 'Sản phẩm chất lượng, đáng đồng tiền bát gạo.', 2, 0, '2024-12-12 00:00:00'),
(23, 5, 'Thiết kế sản phẩm đẹp mắt.', 3, 0, '2024-12-12 00:00:00'),
(24, 5, 'Dịch vụ chăm sóc khách hàng tốt.', 2, 0, '2024-12-12 00:00:00'),
(25, 5, 'Dịch vụ chăm sóc khách hàng tốt.', 2, 0, '2024-12-12 00:00:00'),
(26, 1, 'Giao hàng nhanh chóng.', 1, 0, '2024-12-12 00:00:00'),
(27, 2, 'Giao hàng nhanh chóng.', 2, 0, '2024-12-12 00:00:00'),
(28, 4, 'Sản phẩm chất lượng, đáng đồng tiền bát gạo.', 2, 0, '2024-12-12 00:00:00'),
(29, 3, 'Dịch vụ chăm sóc khách hàng tốt.', 2, 0, '2024-12-12 00:00:00'),
(30, 3, 'Dịch vụ chăm sóc khách hàng tốt.', 3, 0, '2024-12-12 00:00:00'),
(31, 2, 'Sản phẩm chất lượng, đáng đồng tiền bát gạo.', 1, 0, '2024-12-12 00:00:00'),
(32, 2, 'Giao hàng nhanh chóng.', 1, 0, '2024-12-12 00:00:00'),
(33, 4, 'Thiết kế sản phẩm đẹp mắt.', 2, 0, '2024-12-12 00:00:00'),
(34, 2, 'Giao hàng nhanh chóng.', 2, 0, '2024-12-12 00:00:00'),
(35, 1, 'Sản phẩm chất lượng, đáng đồng tiền bát gạo.', 2, 0, '2024-12-12 00:00:00'),
(36, 4, 'Dịch vụ chăm sóc khách hàng tốt.', 1, 0, '2024-12-12 00:00:00'),
(37, 1, 'Sản phẩm tuyệt vời, rất hài lòng!', 3, 0, '2024-12-12 00:00:00'),
(38, 4, 'Giao hàng nhanh chóng.', 3, 0, '2024-12-12 00:00:00'),
(39, 4, 'Giao hàng nhanh chóng.', 1, 0, '2024-12-12 00:00:00'),
(40, 1, 'Dịch vụ chăm sóc khách hàng tốt.', 3, 0, '2024-12-12 00:00:00'),
(41, 1, 'Dịch vụ chăm sóc khách hàng tốt.', 2, 0, '2024-12-12 00:00:00'),
(42, 4, 'Sản phẩm chất lượng, đáng đồng tiền bát gạo.', 2, 0, '2024-12-12 00:00:00'),
(43, 4, 'An đã xem và đánh giá', 1, 0, '2024-12-12 00:00:00'),
(44, 2, 'Không bán hàng cho khách', 1, 0, '2024-12-12 00:00:00'),
(45, 2, 'An không xem và đánh giá', 1, 0, '2024-12-12 00:00:00'),
(46, 1, 'An Đã xem và Chê', 1, 0, '2024-12-12 00:00:00'),
(47, 2, 'Đẹp được ấy chứ', 1, 7, '2024-12-12 00:00:00'),
(48, 2, 'Hehe', 1, 7, '2024-12-12 13:35:00'),
(49, 5, 'Được 6 sao nha', 1, 7, '2024-12-12 13:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `DANH_MUC`
--

CREATE TABLE `DANH_MUC` (
  `Ma_danh_muc` int(11) NOT NULL,
  `Ten_danh_muc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DANH_MUC`
--

INSERT INTO `DANH_MUC` (`Ma_danh_muc`, `Ten_danh_muc`) VALUES
(4, 'Rắn'),
(5, 'Thằn lằn'),
(6, 'Rùa'),
(7, 'Bò sát khác');

-- --------------------------------------------------------

--
-- Table structure for table `GIO_HANG`
--

CREATE TABLE `GIO_HANG` (
  `Ma_gio_hang` int(11) NOT NULL,
  `Ma_khach_hang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `GIO_HANG`
--

INSERT INTO `GIO_HANG` (`Ma_gio_hang`, `Ma_khach_hang`) VALUES
(1, 7),
(2, 2),
(3, 3),
(4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `HOA_DON`
--

CREATE TABLE `HOA_DON` (
  `Tong_tien` decimal(10,2) NOT NULL,
  `Ma_hoa_don` int(11) NOT NULL,
  `Ngay_tao` date NOT NULL,
  `Ma_khach_hang` int(11) NOT NULL,
  `Ma_gio_hang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `HOA_DON`
--

INSERT INTO `HOA_DON` (`Tong_tien`, `Ma_hoa_don`, `Ngay_tao`, `Ma_khach_hang`, `Ma_gio_hang`) VALUES
(2500000.00, 2, '2023-11-25', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `KHACH_HANG`
--

CREATE TABLE `KHACH_HANG` (
  `Ma_khach_hang` int(11) NOT NULL,
  `Ten` varchar(100) NOT NULL,
  `Dia_chi` varchar(255) NOT NULL,
  `So_dien_thoai` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `KHACH_HANG`
--

INSERT INTO `KHACH_HANG` (`Ma_khach_hang`, `Ten`, `Dia_chi`, `So_dien_thoai`, `Email`) VALUES
(1, 'Nguyễn Văn A', '123 Đường Trần Hưng Đạo', '0987654321', 'nva@example.com'),
(2, 'Lê Thị B', '456 Đường Lê Lợi', '0987654322', 'ltb@example.com'),
(3, 'Nguyễn Văn Nam', '123 Đường Lê Thánh Tông', '0987654321', 'namnv@reptileshop.com'),
(4, 'Trần Thị Mai', '456 Đường Hai Bà Trưng', '0978901234', 'mai@reptileshop.com'),
(7, 'Nguyễn Thị Định', '321 Đường Tôn Đảng', '0987903123', 'soicodon@codon.com'),
(8, 'Châu Nguyễn Trường An', '', '', ''),
(9, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `TAI_KHOAN`
--

CREATE TABLE `TAI_KHOAN` (
  `Ten_dang_nhap` varchar(50) NOT NULL,
  `Mat_khau` varchar(100) NOT NULL,
  `Quyen` tinyint(1) NOT NULL,
  `Ma_khach_hang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TAI_KHOAN`
--

INSERT INTO `TAI_KHOAN` (`Ten_dang_nhap`, `Mat_khau`, `Quyen`, `Ma_khach_hang`) VALUES
('Customer123', '$2y$10$vlfLtD.dsbDdcJCgCVpBg.MS4nuuNzHnu4Pa530UErn.W.BAZsudm', 0, 9),
('Felton_Wolf35', '$2y$10$wPe54lNr6kMtRvvQXoF2VefsWQKYzBwNKUfd8fWQBrNbqUjpsO2qu', 0, 7),
('TruongAn', '$2y$10$jfXvT.Mr1UdL2ylza.FfQudYOdW9yWtVOs4lWCRTPas.6dAtXEvqa', 0, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ANH`
--
ALTER TABLE `ANH`
  ADD PRIMARY KEY (`Ma_anh`),
  ADD KEY `Ma_bo_sat` (`Ma_bo_sat`);

--
-- Indexes for table `BO_SAT`
--
ALTER TABLE `BO_SAT`
  ADD PRIMARY KEY (`Ma_bo_sat`),
  ADD KEY `Ma_danh_muc` (`Ma_danh_muc`);

--
-- Indexes for table `chinh_sach`
--
ALTER TABLE `chinh_sach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CHI_TIET_GIO_HANG`
--
ALTER TABLE `CHI_TIET_GIO_HANG`
  ADD PRIMARY KEY (`Ma_bo_sat`,`Ma_gio_hang`),
  ADD KEY `Ma_gio_hang` (`Ma_gio_hang`);

--
-- Indexes for table `DANH_GIA`
--
ALTER TABLE `DANH_GIA`
  ADD PRIMARY KEY (`Ma_danh_gia`),
  ADD KEY `Ma_bo_sat` (`Ma_bo_sat`),
  ADD KEY `Ma_khach_hang` (`Ma_khach_hang`);

--
-- Indexes for table `DANH_MUC`
--
ALTER TABLE `DANH_MUC`
  ADD PRIMARY KEY (`Ma_danh_muc`);

--
-- Indexes for table `GIO_HANG`
--
ALTER TABLE `GIO_HANG`
  ADD PRIMARY KEY (`Ma_gio_hang`);

--
-- Indexes for table `HOA_DON`
--
ALTER TABLE `HOA_DON`
  ADD PRIMARY KEY (`Ma_hoa_don`),
  ADD KEY `Ma_khach_hang` (`Ma_khach_hang`),
  ADD KEY `Ma_gio_hang` (`Ma_gio_hang`);

--
-- Indexes for table `KHACH_HANG`
--
ALTER TABLE `KHACH_HANG`
  ADD PRIMARY KEY (`Ma_khach_hang`);

--
-- Indexes for table `TAI_KHOAN`
--
ALTER TABLE `TAI_KHOAN`
  ADD PRIMARY KEY (`Ten_dang_nhap`),
  ADD KEY `Ma_khach_hang` (`Ma_khach_hang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ANH`
--
ALTER TABLE `ANH`
  MODIFY `Ma_anh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `BO_SAT`
--
ALTER TABLE `BO_SAT`
  MODIFY `Ma_bo_sat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `chinh_sach`
--
ALTER TABLE `chinh_sach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `DANH_GIA`
--
ALTER TABLE `DANH_GIA`
  MODIFY `Ma_danh_gia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `DANH_MUC`
--
ALTER TABLE `DANH_MUC`
  MODIFY `Ma_danh_muc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `GIO_HANG`
--
ALTER TABLE `GIO_HANG`
  MODIFY `Ma_gio_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `HOA_DON`
--
ALTER TABLE `HOA_DON`
  MODIFY `Ma_hoa_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `KHACH_HANG`
--
ALTER TABLE `KHACH_HANG`
  MODIFY `Ma_khach_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ANH`
--
ALTER TABLE `ANH`
  ADD CONSTRAINT `ANH_ibfk_1` FOREIGN KEY (`Ma_bo_sat`) REFERENCES `BO_SAT` (`Ma_bo_sat`);

--
-- Constraints for table `BO_SAT`
--
ALTER TABLE `BO_SAT`
  ADD CONSTRAINT `BO_SAT_ibfk_1` FOREIGN KEY (`Ma_danh_muc`) REFERENCES `DANH_MUC` (`Ma_danh_muc`);

--
-- Constraints for table `CHI_TIET_GIO_HANG`
--
ALTER TABLE `CHI_TIET_GIO_HANG`
  ADD CONSTRAINT `CHI_TIET_GIO_HANG_ibfk_1` FOREIGN KEY (`Ma_bo_sat`) REFERENCES `BO_SAT` (`Ma_bo_sat`),
  ADD CONSTRAINT `CHI_TIET_GIO_HANG_ibfk_2` FOREIGN KEY (`Ma_gio_hang`) REFERENCES `GIO_HANG` (`Ma_gio_hang`);

--
-- Constraints for table `DANH_GIA`
--
ALTER TABLE `DANH_GIA`
  ADD CONSTRAINT `DANH_GIA_ibfk_1` FOREIGN KEY (`Ma_bo_sat`) REFERENCES `BO_SAT` (`Ma_bo_sat`);

--
-- Constraints for table `HOA_DON`
--
ALTER TABLE `HOA_DON`
  ADD CONSTRAINT `HOA_DON_ibfk_1` FOREIGN KEY (`Ma_khach_hang`) REFERENCES `KHACH_HANG` (`Ma_khach_hang`),
  ADD CONSTRAINT `HOA_DON_ibfk_2` FOREIGN KEY (`Ma_gio_hang`) REFERENCES `GIO_HANG` (`Ma_gio_hang`);

--
-- Constraints for table `TAI_KHOAN`
--
ALTER TABLE `TAI_KHOAN`
  ADD CONSTRAINT `TAI_KHOAN_ibfk_1` FOREIGN KEY (`Ma_khach_hang`) REFERENCES `KHACH_HANG` (`Ma_khach_hang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
