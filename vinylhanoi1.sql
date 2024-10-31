-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 05, 2024 lúc 10:10 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vinylhanoi1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `MaBinhLuan` int(11) NOT NULL,
  `TenDangNhap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MaSanPham` int(11) NOT NULL,
  `NgayBinhLuan` date NOT NULL,
  `NoiDung` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`MaBinhLuan`, `TenDangNhap`, `MaSanPham`, `NgayBinhLuan`, `NoiDung`) VALUES
(16, 'tuananh', 74, '2023-05-22', '?????????'),
(17, 'tuananh', 69, '2023-05-22', 'alo lao');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_dondat`
--

CREATE TABLE `ct_dondat` (
  `MaDonDat` int(11) NOT NULL,
  `MaSanPham` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_dondat`
--

INSERT INTO `ct_dondat` (`MaDonDat`, `MaSanPham`, `SoLuong`) VALUES
(11, 70, 6),
(11, 71, 1),
(12, 69, 3),
(12, 72, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dondat`
--

CREATE TABLE `dondat` (
  `MaDonDat` int(11) NOT NULL,
  `TenDangNhap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MaNhanVien` int(11) NOT NULL,
  `TrangThai` text COLLATE utf8_unicode_ci NOT NULL,
  `NoiGiao` text COLLATE utf8_unicode_ci NOT NULL,
  `NgayDat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dondat`
--

INSERT INTO `dondat` (`MaDonDat`, `TenDangNhap`, `MaNhanVien`, `TrangThai`, `NoiGiao`, `NgayDat`) VALUES
(11, 'tuananh', 1, '0', 'Hà Nội', '2023-05-22'),
(12, 'tuananh', 1, '1', 'Hà Nội', '2023-05-22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoaiSP` int(11) NOT NULL,
  `TenLoai` text COLLATE utf8_unicode_ci NOT NULL,
  `MoTa` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`MaLoaiSP`, `TenLoai`, `MoTa`) VALUES
(1, 'Đĩa Than ', 'Vinyl Record album '),
(2, 'Spakers ', 'Loa bookshelf passive, active '),
(3, 'Mâm Đĩa ', 'Thiết bị đọc đĩa '),
(4, 'Phụ Kiện', 'Dây blabla ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` int(11) NOT NULL,
  `HoTen` text COLLATE utf8_unicode_ci NOT NULL,
  `TenDangNhap` text COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` text COLLATE utf8_unicode_ci NOT NULL,
  `NgaySinh` date NOT NULL,
  `GioiTinh` text COLLATE utf8_unicode_ci NOT NULL,
  `DienThoai` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `HoTen`, `TenDangNhap`, `MatKhau`, `NgaySinh`, `GioiTinh`, `DienThoai`) VALUES
(1, 'admin', 'admin', '123456', '1998-01-01', 'M', '0911234567');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSanPham` int(11) NOT NULL,
  `TenSanPham` text COLLATE utf8_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `Anh` text COLLATE utf8_unicode_ci NOT NULL,
  `DonGia` decimal(10,0) NOT NULL,
  `ThongTin` text COLLATE utf8_unicode_ci NOT NULL,
  `TrangThai` text COLLATE utf8_unicode_ci NOT NULL,
  `MaLoaiSP` int(11) NOT NULL,
  `Anh2` text COLLATE utf8_unicode_ci NOT NULL,
  `Anh3` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSanPham`, `TenSanPham`, `SoLuong`, `Anh`, `DonGia`, `ThongTin`, `TrangThai`, `MaLoaiSP`, `Anh2`, `Anh3`) VALUES
(69, 'The Beatles - Abbey Road', 10, 'dia1.jpg', '1250000', 'Album the beatles ', 'Còn Hàng ', 1, 'dia1.jpg', 'dia1.jpg'),
(70, 'DiaThan2', 10, 'dia2.2.jpg', '850000', 'blabla', 'Còn Hàng ', 1, 'dia2.2.jpg', 'dia2.2.jpg'),
(71, 'DiaThan3', 5, 'dia2.jpg', '900000', 'album 122345', 'Còn Hang', 1, 'dia2.jpg', 'dia2.jpg'),
(72, 'Loa1 ', 6, 'loa1.jpg', '15000000', 'loa1 lofi cuc chill ', 'Còn Hàng', 2, 'loa1.2.jfif', 'loa1.2.jfif'),
(73, 'MamDia1', 3, 'mamdia1.1.jpg', '8000000', 'Mamdia nghe nhac ', 'Còn Hàng', 3, 'mamdia1.jfif', 'mamdia1.1.jpg'),
(74, 'Dayloa1', 5, 'loudspeaker-Heimdall-2-1.jpg', '60390000', 'Hemdail 2 ', 'Còn Hàng', 4, 'loudspeaker-Heimdall-2-1.jpg', 'loudspeaker-Heimdall-2-1.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhvien`
--

CREATE TABLE `thanhvien` (
  `TenDangNhap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` text COLLATE utf8_unicode_ci NOT NULL,
  `HoTen` text COLLATE utf8_unicode_ci NOT NULL,
  `NgaySinh` date NOT NULL,
  `GioiTinh` text COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` text COLLATE utf8_unicode_ci NOT NULL,
  `DienThoai` text COLLATE utf8_unicode_ci NOT NULL,
  `Email` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhvien`
--

INSERT INTO `thanhvien` (`TenDangNhap`, `MatKhau`, `HoTen`, `NgaySinh`, `GioiTinh`, `DiaChi`, `DienThoai`, `Email`) VALUES
('hung1', '123456', 'Nguyễn Thành Hưng', '2000-05-15', 'M', 'hà lội', '09112267885', 'hung1@gmail.com'),
('mthai', '123456', 'Mai Thu Hải', '1111-11-11', 'M', 'Hà Nội', '231654987', 'mthai@outlook.com'),
('tuananh', '123456', 'Nguyễn Tuấn Anh', '0000-00-00', 'M', 'Hà Nội', '0123456789', 'anh@gmail.com'),
('tung', '123456', 'Hà Đức Tùng', '2222-02-22', 'M', 'Hà Nội', '5486432186', 'tung@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBinhLuan`),
  ADD KEY `TenDangNhap` (`TenDangNhap`),
  ADD KEY `MaSanPham` (`MaSanPham`);

--
-- Chỉ mục cho bảng `ct_dondat`
--
ALTER TABLE `ct_dondat`
  ADD PRIMARY KEY (`MaDonDat`,`MaSanPham`),
  ADD KEY `ctdondat_sanpham` (`MaSanPham`);

--
-- Chỉ mục cho bảng `dondat`
--
ALTER TABLE `dondat`
  ADD PRIMARY KEY (`MaDonDat`),
  ADD KEY `TenDangNhap` (`TenDangNhap`),
  ADD KEY `MaNhanVien` (`MaNhanVien`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoaiSP`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSanPham`),
  ADD KEY `MaLoaiSP` (`MaLoaiSP`);

--
-- Chỉ mục cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`TenDangNhap`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `MaBinhLuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `dondat`
--
ALTER TABLE `dondat`
  MODIFY `MaDonDat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `MaLoaiSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNhanVien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSanPham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`),
  ADD CONSTRAINT `binhluan_thanhvien` FOREIGN KEY (`TenDangNhap`) REFERENCES `thanhvien` (`TenDangNhap`);

--
-- Các ràng buộc cho bảng `ct_dondat`
--
ALTER TABLE `ct_dondat`
  ADD CONSTRAINT `ctdondat_dondat` FOREIGN KEY (`MaDonDat`) REFERENCES `dondat` (`MaDonDat`),
  ADD CONSTRAINT `ctdondat_sanpham` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`);

--
-- Các ràng buộc cho bảng `dondat`
--
ALTER TABLE `dondat`
  ADD CONSTRAINT `dondat_nhanvien` FOREIGN KEY (`MaNhanVien`) REFERENCES `nhanvien` (`MaNhanVien`),
  ADD CONSTRAINT `dondat_thanhvien` FOREIGN KEY (`TenDangNhap`) REFERENCES `thanhvien` (`TenDangNhap`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_loaisp` FOREIGN KEY (`MaLoaiSP`) REFERENCES `loaisp` (`MaLoaiSP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
