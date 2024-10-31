<?php
if(!isset($_SESSION["giohang"]))
echo "<script>location='SanPham.php';</script>";
	
if(!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
mysqli_query($conn,"set names utf8");

// Nhận thông tin từ payload JSON
$data = json_decode(file_get_contents('php://input'), true);

// Trích xuất thông tin cần thiết từ session
$tendangnhap = $_SESSION["tendangnhap"];
$trangthai = "0";
$noigiao = $data['noigiao'];  // Giả sử 'noigiao' được gửi từ frontend
$ngaydat = date("Y-m-d");

// Lưu đơn đặt hàng vào bảng dondat
$themDonDat = "INSERT INTO dondat(TenDangNhap, MaNhanVien, TrangThai, NoiGiao, NgayDat) VALUES ('$tendangnhap', '1', '$trangthai', '$noigiao', '$ngaydat')";

if ($conn->query($themDonDat) === TRUE) {
    $madondat = $conn->insert_id;  // Lấy ID của đơn đặt hàng vừa thêm vào

    // Lưu thông tin chi tiết đơn hàng vào bảng ct_dondat
    foreach ($data['giohang'] as $cotGH) {
        $masp = $cotGH['masp'];
        $soluong = $cotGH['soluong'];

        $themCT_DonDat = "INSERT INTO ct_dondat(MaDonDat, MaSanPham, SoLuong) VALUES ('$madondat', '$masp', '$soluong')";
        $conn->query($themCT_DonDat);
        unset($_SESSION["giohang"]);
    }
    

    unset($_SESSION["giohang"]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>