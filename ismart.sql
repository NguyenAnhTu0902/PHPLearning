-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 02, 2024 lúc 10:41 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ismart`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_img`
--

CREATE TABLE `tbl_img` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_list_order`
--

CREATE TABLE `tbl_list_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_code` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `img_thumb` varchar(255) DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `num_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_list_order`
--

INSERT INTO `tbl_list_order` (`id`, `user_id`, `order_code`, `product_id`, `img_thumb`, `product_title`, `price`, `sub_total`, `num_order`) VALUES
(1, 1, 'Order 1', 1, 'public/uploads/unnamed-Copy', 'Sản phẩm 2', '145555', '145555', 1),
(2, 1, 'Order 1', 2, 'public/uploads/A_party_tray_of_sliders_at_a_restaurant-Copy(0).jpg', 'Sản phẩm 1', '12000', '12000', 1),
(3, 2, 'Order 2', 1, '	\r\npublic/uploads/unnamed-Copy', 'Sản phẩm 2', '145555', '145555', 1),
(4, 2, 'Order 2', 2, 'public/uploads/A_party_tray_of_sliders_at_a_restaurant-Copy(0).jpg', 'Sản phẩm 1', '12000', '12000', 1),
(5, 2, 'Order 2', 3, 'public/uploads/A_party_tray_of_sliders_at_a_restaurant-Copy(1).jpg', 'Sản phẩm 2', '12222222', '12222222', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `num_order` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `order_date` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_code`, `full_name`, `num_order`, `total`, `status`, `order_date`, `address`, `payment_method`, `note`) VALUES
(1, 'Order 1', 'Nguyen Anh A', 2, 157555, 1, '25/03/2024', '124 Nguyen Xien', 1, NULL),
(2, 'Order 2', 'Nguyen Anh B', 3, 1490888, 1, '25/03/2024', '125 Nguyen Xien', 2, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `img_thumb` varchar(255) DEFAULT NULL,
  `product_desc` varchar(255) DEFAULT NULL,
  `product_content` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `del_price` varchar(255) DEFAULT NULL,
  `created_date` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_title`, `price`, `img_thumb`, `product_desc`, `product_content`, `status`, `created_by`, `del_price`, `created_date`) VALUES
(1, 'Sản phẩm 2', '145555', 'public/uploads/unnamed-Copy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis.&nbsp;</p>\r\n', 2, 'kinganhtu', '123333', '30/03/24'),
(2, 'Sản phẩm 1', '12000', 'public/uploads/A_party_tray_of_sliders_at_a_restaurant-Copy(0).jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis.&nbsp;</p>\r\n', 3, 'kinganhtu', '11000', '29/03/24'),
(3, 'Sản phẩm 2', '12222222', 'public/uploads/A_party_tray_of_sliders_at_a_restaurant-Copy(1).jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis.&nbsp;</p>\r\n', 2, 'kinganhtu', '1333333', '30/03/24'),
(4, 'Sản phẩm 3', '1333333', 'public/uploads/A_party_tray_of_sliders_at_a_restaurant-Copy(2).jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis.&nbsp;</p>\r\n', 2, 'kinganhtu', '1222222', '30/03/24'),
(5, 'Sản phẩm 4', '1444444', 'public/uploads/A_party_tray_of_sliders_at_a_restaurant-Copy(3).jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum diam sed ullamcorper aliquet. Integer vitae justo et tellus auctor aliquet. Praesent facilisis a urna eget condimentum. Nulla sagittis quis urna et facilisis.&nbsp;</p>\r\n', 2, 'kinganhtu', '1222222', '30/03/24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL COMMENT '0. notactive 1.Admin 2.Supperadmin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `fullname`, `email`, `address`, `phone_number`, `gender`, `role`) VALUES
(3, 'kinganhtu1', 'hoangthai11', 'Nguyễn Anh Tú', 'klinganhtuas@gmail.com', '122 Nguyễn Xiển', '0978374632', 'Nam', 3),
(5, 'anhtu2', 'hoangthai11', 'Nguyen Anh Tú', 'anhtu2@gmail.com', '123 Nguyen Xien', '097823983', 'Nữ', 3),
(9, 'kinganhtu', 'hoangthai11', 'hoangthai', 'kinganhtu09022001wwwwww@gmail.com', '123 Nguyen Xien', '0785738929', 'Nam', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_img`
--
ALTER TABLE `tbl_img`
  ADD PRIMARY KEY (`img_id`);

--
-- Chỉ mục cho bảng `tbl_list_order`
--
ALTER TABLE `tbl_list_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_list_order`
--
ALTER TABLE `tbl_list_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
