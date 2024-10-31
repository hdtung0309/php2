<?php

include("../layout/header.php");

if(isset($_SESSION["tendangnhap"]))
    echo "<script>location='SanPham.php';</script>";
?>

<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="index.php">Trang chủ</a></li>
                <li class="active">Trang đăng ký</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--start-account-->
<div class="account">
    <div class="container">
        <div class="account-bottom">
            <div class="col-md-6 account-left">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="account-top heading">
                        <h3>Đăng Ký Tài Khoản</h3>
                    </div>
                    <div class="address">
                        <span>Tên đăng nhập</span>
                        <input id="tendangnhap" name="tendangnhap" type="text">
                    </div>

                    <div class="address">
                        <span>Mật khẩu</span>
                        <input id="matkhau" name="matkhau" type="password">
                    </div>
                    <div class="address">
                        <span>Nhập lại mật khẩu</span>
                        <input id="nhaplaimatkhau" name="nhaplaimatkhau" type="password">
                    </div>
                    <div class="address">
                        <span>Họ tên</span>
                        <input id="hoten" name="hoten" type="text">
                    </div>
                    <div class="address">
                        <span>Ngày sinh</span>
                        <input id="ngaysinh" name="ngaysinh" type="date">
                    </div>
                    <div class="address">
                        <span>Giới tính</span>
                        <input name="gioitinh" type="radio" value="M" checked> Nam <input name="gioitinh" type="radio" value="F"> Nữ
                    </div>
                    <div class="address">
                        <span>Địa chỉ</span>
                        <input id="diachi" name="diachi" type="text">
                    </div>
                    <div class="address">
                        <span>Điện thoại</span>
                        <input id="dienthoai" name="dienthoai" type="text">
                    </div>
                    <div class="address">
                        <span>Email</span>
                        <input id="email" name="email" type="text">
                    </div>
                    <div class="address">
                       <span style="color: red;" id="thongbao"></span>
                    </div>
                    <div class="address new">
                        <input id="dangky" type="submit" value="Đăng ký">
                    </div>
                </form>
            </div>
            <div class="col-md-6 account-left">
                <form method="post" action="DangNhap.php">
                    <input type="hidden" name="tranghientai" value="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="account-top heading">
                        <h3>Đăng nhập</h3>
                    </div>
                    <div class="address">
                        <span>Tên đăng nhập</span>
                        <input id="dn_tendangnhap" name="tendangnhap" type="text">
                    </div>
                    <div class="address">
                        <span>Mật khẩu</span>
                        <input id="dn_matkhau" name="matkhau" type="password">
                    </div>
                    <div class="address new">
                        <span style="color: red;" id="dn_thongbao"></span>
                        <input id="dangnhap" type="submit" value="Đăng nhập">

                    </div>
            </div>
            </form>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<?php
global $conn;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $tendangnhap=$_POST["tendangnhap"];
    $matkhau=$_POST["matkhau"];
    $hoten=$_POST["hoten"];
    $ngaysinh=$_POST["ngaysinh"];
    $gioitinh=$_POST["gioitinh"];
    $diachi=$_POST["diachi"];
    $dienthoai=$_POST["dienthoai"];
    $email=$_POST["email"];

    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        echo "<script>$('#thongbao').text('Email khong hop le');</script>";
    else {
        $ktTonTai = "SELECT * FROM thanhvien WHERE TenDangNhap = '" . $tendangnhap . "'";
        $truyVanktTonTai = mysqli_query($conn,$ktTonTai);
        if (mysqli_num_rows($truyVanktTonTai) > 0)
            echo "<script>$('#thongbao').text('Tài khoản đã tồn tại');</script>";
        else {

            $themNguoiDung="INSERT INTO thanhvien VALUES('".$tendangnhap."','".$matkhau."','".$hoten."','".$ngaysinh."','".$gioitinh."',
            '".$diachi."','".$dienthoai."','".$email."')";
            $truyVanthemNguoiDung=mysqli_query($conn,$themNguoiDung);
            if($truyVanthemNguoiDung)
                echo "<script>$('#thongbao').text('Đăng ký thành công');</script>";
        }
    }
}
?>

<script>
    $(document).ready(function(){
        $('#dangky').click(function(){
            tendangnhap=$('#tendangnhap').val();
            matkhau=$('#matkhau').val();
            nhaplaimatkhau=$('#nhaplaimatkhau').val();
            hoten=$('#hoten').val();
            ngaysinh=$('#ngaysinh').val();
            diachi=$('#diachi').val();
            dienthoai=$('#dienthoai').val();
            email=$('#email').val();

            loi=0;
            if(tendangnhap=="" || matkhau=="" || hoten=="" || ngaysinh==""
            || diachi=="" || dienthoai=="" || email=="")
            {
                loi++;
                $('#thongbao').text("Hãy nhập đầy đủ thông tin");
            }

            if(matkhau!=nhaplaimatkhau)
            {
                loi++;
                $('#thongbao').text("Mật khẩu nhập lại không trùng khớp");
            }

            if(isNaN(dienthoai))
            {
                loi++;
                $('#thongbao').text("Điện thoại phải là số");
            }

            if(loi!=0)
            {
                return false;
            }
        });
        $('#dangnhap').click(function(){
            dn_tendangnhap=$('#dn_tendangnhap').val();
            dn_matkhau=$('#dn_matkhau').val();

            loi=0;
            if(dn_tendangnhap=="" || dn_matkhau=="")
            {
                loi++;
                $('#dn_thongbao').text("Hãy nhập đầy đủ thông tin");
            }

            if(loi!=0)
            {
                return false;
            }
        });
    });
</script>

<?php
include("../layout/footer.php");
?>

