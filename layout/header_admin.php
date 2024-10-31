<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang quản trị</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/cssAdmin/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/cssAdmin/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="../script/jsAdmin/jquery.js"></script>
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

function phan_trang($tenCot,$tenBang,$dieuKien,$soLuongSP,$trang,$dieuKienTrang)
{
	global $conn;
    $spbatdau=$trang*$soLuongSP; //tính sản phẩm bắt đầu của mỗi trang 

    $laySP=" SELECT ".$tenCot." FROM ".$tenBang." ".$dieuKien ." LIMIT ".$spbatdau.",".$soLuongSP; // lấy thông tin bảng cho 1 trang
    $truyvanLaySP=mysqli_query($conn,$laySP);

    $tongsoluongsp=mysqli_num_rows(mysqli_query($conn," SELECT ".$tenCot." FROM ".$tenBang." ".$dieuKien)); // tính tổng số lượng bản ghi lấy được
    $tongsotrang=$tongsoluongsp/$soLuongSP; // tính toán tổng số trang (luôn làm tròn lên 1 đơn vị)

    $dsTrang="";
    for($i = 0 ; $i < $tongsotrang; $i++)
    {
        $sotrang=$i+1; // số trang bắt đầu từ 1
        $dsTrang .=  "<a class='divtrang_".$i."' href='".$_SERVER["PHP_SELF"]."?trang=".$i.$dieuKienTrang."'>". $sotrang  . "</a> "; //lấy url trang
    }

    echo "<script>
                $(document).ready(function(){
                    $('.divtrang').html(\"".$dsTrang."\")
                });
            </script>";

    return $truyvanLaySP;
}

if(isset($_GET["dx_admin"]))
    unset($_SESSION["admin"]);

function GiaTien($dongia) //1000000
{
    $sResult = $dongia;
    for ( $i = 3; $i < strlen($sResult); $i += 4)
    {
        $sSau = substr($sResult,strlen($sResult) - $i); // 000.000
        $sDau = substr($sResult,0, strlen($sResult) - $i); // 1
        $sResult = $sDau . "." . $sSau; // 1.000.000
    }
    return $sResult;
}
    

$soDDH=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM dondat WHERE TrangThai='0'"));

?>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Chuyển đổi điều hướng</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Trang quản trị</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Chào mừng đến trang quản trị <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?dx_admin=0"> Đăng xuất</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="index.php">Trang chủ</a>
                </li>
                <li>
                    <a href="SanPham.php"> Sản phẩm</a>
                </li>
                <li>
                    <a href="DanhMucSanPham.php"> Danh mục sản phẩm</a>
                </li>
                <li>
                    <a href="DonDatHang.php">Đơn đặt hàng</a>
                </li>
                <li>
                    <a href="BinhLuan.php"> Bình luận</a>
                </li>
                <li>
                    <a href="NhanVien.php"> Nhân viên</a>
                </li>
                <li>
                    <a href="ThanhVien.php"> Thành viên</a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>