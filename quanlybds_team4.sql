-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 19, 2023 lúc 05:49 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlybds_team4`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `ID` int(11) NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Full_Name` varchar(50) DEFAULT NULL,
  `Role` varchar(30) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`ID`, `Username`, `Password`, `Full_Name`, `Role`, `IsActive`) VALUES
(1, 'lythihuyenchau', '123456', 'Lý Thị Huyền Châu', 'ADMIN', b'1'),
(2, 'nguyenvantuan', '123456', 'Nguyễn Văn Tuấn', 'SALE', b'1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `city`
--

CREATE TABLE `city` (
  `ID` int(11) NOT NULL,
  `City_Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `city`
--

INSERT INTO `city` (`ID`, `City_Name`) VALUES
(1, 'Hồ Chí Minh'),
(2, 'Hà Nội'),
(3, 'Đà Nẵng'),
(4, 'Bình Dương'),
(5, 'Vũng Tàu'),
(6, 'Bắc Giang'),
(7, 'Đồng Nai'),
(8, 'Cà Mau'),
(9, 'Long An'),
(10, 'Cần Thơ'),
(11, 'Hồ Chí Minh'),
(12, 'Hà Nội'),
(13, 'Đà Nẵng'),
(14, 'Bình Dương'),
(15, 'Vũng Tàu'),
(16, 'Bắc Giang'),
(17, 'Đồng Nai'),
(18, 'Cà Mau'),
(19, 'Long An'),
(20, 'Cần Thơ'),
(21, 'Hồ Chí Minh'),
(22, 'Hà Nội'),
(23, 'Đà Nẵng'),
(24, 'Bình Dương'),
(25, 'Vũng Tàu'),
(26, 'Bắc Giang'),
(27, 'Đồng Nai'),
(28, 'Cà Mau'),
(29, 'Long An'),
(30, 'Cần Thơ'),
(31, 'Hồ Chí Minh'),
(32, 'Hà Nội'),
(33, 'Đà Nẵng'),
(34, 'Bình Dương'),
(35, 'Vũng Tàu'),
(36, 'Bắc Giang'),
(37, 'Đồng Nai'),
(38, 'Cà Mau'),
(39, 'Long An'),
(40, 'Cần Thơ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contracts`
--

CREATE TABLE `contracts` (
  `contract_id` int(11) NOT NULL,
  `contract_name` varchar(50) NOT NULL,
  `contract_value` decimal(18,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contracts`
--

INSERT INTO `contracts` (`contract_id`, `contract_name`, `contract_value`) VALUES
(1, 'Khang', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `district`
--

CREATE TABLE `district` (
  `ID` int(11) NOT NULL,
  `City_ID` int(11) NOT NULL,
  `District_Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `district`
--

INSERT INTO `district` (`ID`, `City_ID`, `District_Name`) VALUES
(1, 1, 'Quận Bình Tân'),
(2, 1, 'Quận Bình Thạnh'),
(3, 1, 'Quận 1'),
(4, 1, 'Quận 2'),
(5, 1, 'Quận 3'),
(6, 1, 'Quận 4'),
(7, 1, 'Quận 5'),
(8, 1, 'Quận 6'),
(9, 1, 'Quận 7'),
(10, 1, 'Quận 8'),
(11, 9, 'Huyện Bến Lức'),
(12, 9, 'Huyện Đức Hòa'),
(13, 9, 'Huyện Đức Huệ'),
(14, 4, 'Huyện Bến Cát'),
(15, 4, 'Huyện Dầu Tiếng'),
(16, 4, 'Huyện Thuận An'),
(17, 4, NULL),
(18, 1, 'Quận Bình Tân'),
(19, 1, 'Quận Bình Thạnh'),
(20, 1, 'Quận 1'),
(21, 1, 'Quận 2'),
(22, 1, 'Quận 3'),
(23, 1, 'Quận 4'),
(24, 1, 'Quận 5'),
(25, 1, 'Quận 6'),
(26, 1, 'Quận 7'),
(27, 1, 'Quận 8'),
(28, 9, 'Huyện Bến Lức'),
(29, 9, 'Huyện Đức Hòa'),
(30, 9, 'Huyện Đức Huệ'),
(31, 4, 'Huyện Bến Cát'),
(32, 4, 'Huyện Dầu Tiếng'),
(33, 4, 'Huyện Thuận An'),
(34, 4, NULL),
(35, 1, 'Quận Bình Tân'),
(36, 1, 'Quận Bình Thạnh'),
(37, 1, 'Quận 1'),
(38, 1, 'Quận 2'),
(39, 1, 'Quận 3'),
(40, 1, 'Quận 4'),
(41, 1, 'Quận 5'),
(42, 1, 'Quận 6'),
(43, 1, 'Quận 7'),
(44, 1, 'Quận 8'),
(45, 9, 'Huyện Bến Lức'),
(46, 9, 'Huyện Đức Hòa'),
(47, 9, 'Huyện Đức Huệ'),
(48, 4, 'Huyện Bến Cát'),
(49, 4, 'Huyện Dầu Tiếng'),
(50, 4, 'Huyện Thuận An'),
(51, 4, NULL),
(52, 1, 'Quận Bình Tân'),
(53, 1, 'Quận Bình Thạnh'),
(54, 1, 'Quận 1'),
(55, 1, 'Quận 2'),
(56, 1, 'Quận 3'),
(57, 1, 'Quận 4'),
(58, 1, 'Quận 5'),
(59, 1, 'Quận 6'),
(60, 1, 'Quận 7'),
(61, 1, 'Quận 8'),
(62, 9, 'Huyện Bến Lức'),
(63, 9, 'Huyện Đức Hòa'),
(64, 9, 'Huyện Đức Huệ'),
(65, 4, 'Huyện Bến Cát'),
(66, 4, 'Huyện Dầu Tiếng'),
(67, 4, 'Huyện Thuận An'),
(68, 4, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `full_contract`
--

CREATE TABLE `full_contract` (
  `ID` int(11) NOT NULL,
  `Full_Contract_Code` varchar(15) DEFAULT NULL,
  `Customer_Name` varchar(50) NOT NULL,
  `Year_Of_Birth` int(11) DEFAULT NULL,
  `SSN` varchar(15) NOT NULL,
  `Customer_Address` varchar(100) DEFAULT NULL,
  `Mobile` varchar(15) DEFAULT NULL,
  `Property_ID` int(11) NOT NULL,
  `Date_Of_Contract` date DEFAULT NULL,
  `Price` decimal(18,0) DEFAULT NULL,
  `Deposit` decimal(18,0) DEFAULT NULL,
  `Remain` decimal(18,0) DEFAULT NULL,
  `Status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `full_contract`
--

INSERT INTO `full_contract` (`ID`, `Full_Contract_Code`, `Customer_Name`, `Year_Of_Birth`, `SSN`, `Customer_Address`, `Mobile`, `Property_ID`, `Date_Of_Contract`, `Price`, `Deposit`, `Remain`, `Status`) VALUES
(1, 'FC22110001', 'Lý Thị Huyền Châu', 1990, '301198908', '45 Trần Hưng Đạo, Quận 5, Thành phố Hồ Chí Minh', '0919686576', 1, '2022-11-18', 1000000000, 100000000, 900000000, b'1'),
(2, 'FC22110002', 'Trần Công Anh', 1989, '404948494', '36 Lê Văn Sỹ, Quận 3, TP.HCM', '0967686878', 2, '2022-11-18', 2000000000, 200000000, 1800000000, b'1'),
(14, 'FC22110003', 'khang', 2003, '352648959', 'tp hcm', '0949958573', 3, '2023-11-19', 10000000, 10000000, 0, b'1'),
(18, 'FC22110005', 'thịnh', 2003, '76343782374', 'tp hcm', '45345345', 4, '2023-11-19', 10000000, 10000000, 0, b'1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `installment_contract`
--

CREATE TABLE `installment_contract` (
  `ID` int(11) NOT NULL,
  `Installment_Contract_Code` varchar(15) NOT NULL,
  `Customer_Name` varchar(50) NOT NULL,
  `Year_Of_Birth` int(11) NOT NULL,
  `SSN` varchar(15) NOT NULL,
  `Customer_Address` varchar(100) NOT NULL,
  `Mobile` varchar(15) NOT NULL,
  `Property_ID` int(11) NOT NULL,
  `Date_Of_Contract` date NOT NULL,
  `Installment_Payment_Method` varchar(50) NOT NULL,
  `Payment_Period` int(11) NOT NULL,
  `Price` decimal(18,0) NOT NULL,
  `Deposit` decimal(18,0) NOT NULL,
  `Loan_Amount` decimal(18,0) NOT NULL,
  `Taken` int(11) NOT NULL,
  `Remain` decimal(18,0) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `installment_contract`
--

INSERT INTO `installment_contract` (`ID`, `Installment_Contract_Code`, `Customer_Name`, `Year_Of_Birth`, `SSN`, `Customer_Address`, `Mobile`, `Property_ID`, `Date_Of_Contract`, `Installment_Payment_Method`, `Payment_Period`, `Price`, `Deposit`, `Loan_Amount`, `Taken`, `Remain`, `Status`) VALUES
(1, 'IC22110001', 'Lâm Bá Thắng', 1980, '123467647', '1 Lê Lợi, Quận 1, TP.HCM', '0918273378', 3, '2022-01-01', 'Tháng', 12, 5000000000, 500000000, 4500000000, 0, 4500000000, 1),
(2, 'IC22110001', 'Lâm Bá Thắng', 1980, '123467647', '1 Lê Lợi, Quận 1, TP.HCM', '0918273378', 3, '2022-01-01', 'Tháng', 12, 5000000000, 500000000, 4500000000, 0, 4500000000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `property`
--

CREATE TABLE `property` (
  `ID` int(11) NOT NULL,
  `Property_Code` varchar(15) NOT NULL,
  `Property_Name` varchar(50) NOT NULL,
  `Property_Type_ID` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `District_ID` int(11) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Area` int(11) DEFAULT NULL,
  `Bed_Room` int(11) DEFAULT NULL,
  `Bath_Room` int(11) DEFAULT NULL,
  `Price` decimal(18,0) DEFAULT NULL,
  `Installment_Rate` float DEFAULT NULL,
  `Avatar` text DEFAULT NULL,
  `Album` text DEFAULT NULL,
  `Property_Status_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `property`
--

INSERT INTO `property` (`ID`, `Property_Code`, `Property_Name`, `Property_Type_ID`, `Description`, `District_ID`, `Address`, `Area`, `Bed_Room`, `Bath_Room`, `Price`, `Installment_Rate`, `Avatar`, `Album`, `Property_Status_ID`) VALUES
(1, 'P220001', 'NHÀ PHỐ GARDEN KHANG ĐIỀN', 3, 'Nhà xây 1 trệt, 2 lầu, hoàn thiện bên ngoài kính cường lực, sơn nước chống rêu mốc chất lượng, có cửa kính cường lực, gara ô tô để xe thoải mái.', 1, 'Dự án Melosa Garden, Quận 9, Hồ Chí Minh', 80, 2, 2, 1000000000, 7.99, 'ppc0001.jpg', 'ppc0002.jpg;ppc0003.jpg;', 6),
(2, 'P220002', 'NHÀ 4 TẦNG 3 MẶT THOÁNG TRẦN HƯNG ĐẠO Q1', 3, 'Bán nhà trung tâm Quận 1 đoạn đẹp nhất đường Trần Hưng Đạo.', 1, 'Đường Trần Hưng Đạo, Quận 1, Hồ Chí Minh', 78, 2, 2, 2000000000, 7.99, 'ppc0004.jpg', 'ppc0005.jpg;ppc0006.jpg', 6),
(3, 'P220003', 'LAVITA CHARM', 2, 'Trong làn gió mát rượi, hương thơm cỏ cây tại Lavita Charm hòa theo từng bước chân sẽ đưa bạn trở về với không gian sống bình yên, tách biệt khỏi sự huyên náo của chốn phồn hoa. Lavita Charm như một nốt trầm yên ả của điệu nhạc du dương cho cảm xúc thăng hoa và nuôi dưỡng đam mê bất tận, đem đến nguồn vui, nguồn cảm hứng mới cho cuộc sống mỗi ngày.', 2, 'Dự án Lavita Charm, Đường 1, Phường Trường Thọ, Thủ Đức, Hồ Chí Minh', 120, 4, 4, 5000000000, 7.99, 'ppc0007.jpg', 'ppc0008.jpg;', 7),
(4, 'P220004', 'Văn Lang', 1, NULL, 1, 'https://www.facebook.com/lythi.huyenchau', NULL, NULL, NULL, NULL, NULL, '91446ppc0006.jpg', '43227ppc0003.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `property_service`
--

CREATE TABLE `property_service` (
  `ID` int(11) NOT NULL,
  `Service_ID` int(11) NOT NULL,
  `Property_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `property_service`
--

INSERT INTO `property_service` (`ID`, `Service_ID`, `Property_ID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 1, 2),
(6, 2, 2),
(7, 1, 3),
(8, 3, 3),
(9, 4, 3),
(10, 1, 11),
(11, 2, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `property_status`
--

CREATE TABLE `property_status` (
  `ID` int(11) NOT NULL,
  `Property_Status_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `property_status`
--

INSERT INTO `property_status` (`ID`, `Property_Status_Name`) VALUES
(1, 'Đang bán'),
(2, 'Đã bán thanh toán một lần'),
(3, 'Đã bán trả góp'),
(4, 'Không hiển thị'),
(5, 'Hết hạn để bán'),
(6, 'Đang cọc đầy đủ'),
(7, 'Đang cọc trả góp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `property_type`
--

CREATE TABLE `property_type` (
  `ID` int(11) NOT NULL,
  `Property_Type_Name` varchar(50) NOT NULL,
  `Property_Amount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `property_type`
--

INSERT INTO `property_type` (`ID`, `Property_Type_Name`, `Property_Amount`) VALUES
(1, 'Chung cư', 1),
(2, 'Căn hộ dịch vụ', 1),
(3, 'Nhà riêng', 1),
(4, 'Villa', 0),
(5, 'Studio', 0),
(6, 'Office', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service`
--

CREATE TABLE `service` (
  `ID` int(11) NOT NULL,
  `Service_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `service`
--

INSERT INTO `service` (`ID`, `Service_Name`) VALUES
(1, 'Ban công'),
(2, 'Thang máy'),
(3, 'Nhà bếp'),
(4, 'Hồ bơi'),
(5, 'Wifi'),
(6, 'Chỗ đậu xe');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contract_id`);

--
-- Chỉ mục cho bảng `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `City_ID` (`City_ID`);

--
-- Chỉ mục cho bảng `full_contract`
--
ALTER TABLE `full_contract`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `installment_contract`
--
ALTER TABLE `installment_contract`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `property_service`
--
ALTER TABLE `property_service`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `property_status`
--
ALTER TABLE `property_status`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `city`
--
ALTER TABLE `city`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `district`
--
ALTER TABLE `district`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `full_contract`
--
ALTER TABLE `full_contract`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `installment_contract`
--
ALTER TABLE `installment_contract`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `property`
--
ALTER TABLE `property`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `property_service`
--
ALTER TABLE `property_service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `property_status`
--
ALTER TABLE `property_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `property_type`
--
ALTER TABLE `property_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `service`
--
ALTER TABLE `service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`City_ID`) REFERENCES `city` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
