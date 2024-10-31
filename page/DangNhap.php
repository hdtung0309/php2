<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vinylhanoi1";
$conn = mysqli_connect($servername, $username, $password, $dbname);
	
if(!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
mysqli_query($conn,"set names utf8");

$tendangnhap=$_POST["tendangnhap"];
$matkhau=$_POST["matkhau"];
$tranghientai=$_POST["tranghientai"];

$ktTonTai="SELECT * FROM thanhvien WHERE TenDangNhap='".$tendangnhap."' and MatKhau='".$matkhau."'";
$truyvanktTonTai=mysqli_query($conn,$ktTonTai);

if(mysqli_num_rows($truyvanktTonTai)>0) {
    echo "<script>alert('Đăng nhập thành công')</script>";
    $_SESSION["tendangnhap"]=$tendangnhap;
}
else {
    echo "<script>alert('Tài khoản hoặc mật khẩu không đúng')</script>";
}

?>

<script>
    location='<?php echo $tranghientai; ?>';
</script>