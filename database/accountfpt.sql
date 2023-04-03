-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 03, 2023 lúc 01:03 AM
-- Phiên bản máy phục vụ: 5.7.33
-- Phiên bản PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `accountfpt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `money` varchar(225) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 active, 0 ban',
  `ip_login` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `name`, `email`, `phone`, `money`, `role_id`, `status`, `ip_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'administrator', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'Administrator', 'administrator@gmail.com', '0987654321', '2000', 3, 1, '127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1', '2023-04-01 07:13:44', '2023-04-02 13:20:59', NULL),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Test đăng ký', 'admin@gmail.com', '0986543211', '100', 1, 1, '', '2023-04-01 07:27:13', '2023-04-01 07:27:13', NULL),
(4, 'code', 'fb9ed1b8a27eb20854efe6e23e297683', 'code', 'code@gmail.com', '0985656565', '0', 1, 1, '', '2023-04-01 07:27:41', '2023-04-01 07:27:41', NULL),
(5, 'asdsdsd', '9bc0dae398a8e8e86cfc727a2d6ed7ba', 'test dang ky', 'asdsdsd@asdsdsd.com', '0987654535', '0', 1, 1, '', '2023-04-01 07:34:10', '2023-04-01 07:34:10', NULL),
(6, 'member123', 'a510166163833c79aa703646f59c04bb', 'member123', 'member123@gmail.com', '0987652324', '0', 1, 1, '', '2023-04-01 07:35:59', '2023-04-01 07:35:59', NULL),
(7, 'cuadev291', '50215646322060d740b125f7b81cb8c0', 'cuadev', 'cuadev291@gmail.com', '0987654333', '0', 1, 1, '', '2023-04-01 07:48:36', '2023-04-01 07:48:36', NULL),
(8, 'trananhtuan', 'e6b436132ccdf7b2a0f056f740c140bb', 'Trần anh tuấn', 'trananhtuan@gmail.com', '0985632147', '0', 1, 1, '127.0.0.1,127.0.0.1,127.0.0.1,127.0.0.1', '2023-04-01 07:58:01', '2023-04-02 06:25:49', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Member', '2023-04-01 04:41:28', '2023-04-01 04:41:28'),
(2, 'CTV', '2023-04-01 04:41:34', '2023-04-01 04:41:34'),
(3, 'Administrator', '2023-04-01 04:41:42', '2023-04-01 04:41:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
