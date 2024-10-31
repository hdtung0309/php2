<!DOCTYPE html>
<html>
<head>
<title>Login Admin Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="keywords" content=""/>
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

<!--/webfonts-->
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
    ?>
	
</head>
<body>

<!--start-main-->
<h1>Xin chào quản trị viên !<span>Xin hãy đăng nhập...</span></h1>
<div class="login-box">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
			<input name="tendangnhap" id="tendangnhap" type="text" class="text" value="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}" >
			<input name="matkhau" id="matkhau" type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">

		<div class="remember">
			<h4>Chào mừng đến trang quản lý.</h4>
		</div>
		<div class="clear"> </div>
		<div class="btn">
			<input id="dangnhap" type="submit" value="Đăng Nhập" >
		</div>
		<div class="clear"> </div>
    </form>

</div>
<!--//End-login-form-->

<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $tendangnhap = $_POST["tendangnhap"];
    $matkhau = $_POST["matkhau"];

    $ktTonTai = "SELECT * FROM nhanvien WHERE TenDangNhap = '" . $tendangnhap . "' and MatKhau='" . $matkhau . "'";
    $truyVanktTonTai = mysqli_query($conn,$ktTonTai);
    if (mysqli_num_rows($truyVanktTonTai) > 0) {
        echo "<script>alert('Đăng nhập thành công! Chúc mừng')</script>";
        $_SESSION["admin"]=$tendangnhap;
        echo "<script>location='../index.php';</script>";
    }
        else {
            echo "<script>alert('Tài khoản hoặc mật khẩu không đúng!')</script>";
			die("".mysqli_error($conn));
    }
}

?>
</body>
</html>

