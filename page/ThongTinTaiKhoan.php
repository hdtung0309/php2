<?php

include("../layout/header.php");

if(!isset($_SESSION["tendangnhap"]))
    echo "<script>location='SanPham.php';</script>";

global $conn;

$layThongTin="SELECT * FROM thanhvien WHERE TenDangNhap='".$_SESSION["tendangnhap"]."'";
$truyvanlayThongTin=mysqli_query($conn,$layThongTin);
$cot=mysqli_fetch_array($truyvanlayThongTin);

?>

<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="index.php">Trang chủ</a></li>
                <li class="active">Thông tin tài khoản</li>
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
                        <h3>Thông tin tài khoản </h3>
                        <a href="#" id="a_doithongtin">Thay thông tin tài khoản</a>
                    </div>
                    <div class="address">
                        <span>Tên đăng nhập</span>
                        <input id="tendangnhap" type="hidden" value="<?php echo $cot["TenDangNhap"]; ?>">
                        <p><?php echo $cot["TenDangNhap"]; ?></p>
                    </div>

                    <div class="address">
                        <span>Mật khẩu</span>
                        <p>******** </p>
                    </div>
                    <div class="address">
                        <span>Họ tên</span>
                        <p><?php echo $cot["HoTen"]; ?></p>
                    </div>
                    <div class="address">
                        <span>Ngày sinh</span>
                        <p><?php echo date("d/m/Y",strtotime($cot["NgaySinh"])); ?></p>
                    </div>
                    <div class="address">
                        <span>Giới tính</span>
                        <p>
                       <?php
                            if($cot["GioiTinh"]=="F")
                                echo "Nữ";
                            else
                                echo "Nam";
                       ?>
                        </p>
                    </div>
                    <div class="address">
                        <span>Địa chỉ</span>
                        <p><?php echo $cot["DiaChi"]; ?></p>
                    </div>
                    <div class="address">
                        <span>Điện thoại</span>
                        <p><?php echo $cot["DienThoai"]; ?></p>
                    </div>
                    <div class="address">
                        <span>Email</span>
                        <p><?php echo $cot["Email"]; ?></p>
                    </div>
                </form>
            </div>

            <div class="col-md-6 account-left div_doithongtin" style="display: none">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <input name="tendangnhap" type="hidden" value="<?php echo $cot["TenDangNhap"]; ?>">
                    <div class="account-top heading">
                        <h3>Thay đổi thông tin tài khoản</h3>
                    </div>
                    <div class="address">
                        <span>Họ tên</span>
                        <input id="hoten" name="hoten" type="text" value="<?php echo $cot["HoTen"] ?>">
                    </div>
                    <div class="address">
                        <span>Ngày sinh</span>
                        <input id="ngaysinh" name="ngaysinh" type="date" value="<?php echo $cot["NgaySinh"] ?>">
                    </div>
                    <div class="address">
                        <span>Giới tính</span>
                        <?php
                        if($cot["GioiTinh"]=="F") {
                            ?>

                            <input name="gioitinh" type="radio" value="M"> Nam <input name="gioitinh" type="radio" value="F" checked> Nữ

                        <?php
                        }else{
                           ?>

                        <input name="gioitinh" type="radio" value="M" checked > Nam <input name="gioitinh" type="radio" value="F" > Nữ

                        <?php } ?>
                    </div>
                    <div class="address">
                        <span>Địa chỉ</span>
                        <input id="diachi" name="diachi" type="text" value="<?php echo $cot["DiaChi"] ?>">
                    </div>
                    <div class="address">
                        <span>Điện thoại</span>
                        <input id="dienthoai" name="dienthoai" type="text" value="<?php echo $cot["DienThoai"] ?>" >
                    </div>
                    <div class="address">
                        <span>Email</span>
                        <input id="email" name="email" type="text" value="<?php echo $cot["Email"] ?>">
                    </div>
                    <div class="address">
                        <span style="color: red;" id="thongbao"></span>
                    </div>
                    <div class="address new">
                        <input id="doithongtin" type="submit" value="Thay đổi">
                    </div>
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<script src="../script/jsNguoiDung/jsNguoiDung.js"></script>

<script>

    $('#a_doimatkhau').click(function(){
        $('.div_doimatkhau').show();
        $('.div_doithongtin').hide();
    });

    $('#a_doithongtin').click(function(){
        $('.div_doimatkhau').hide();
        $('.div_doithongtin').show();
    });

    $(document).ready(function(){
        $('#doimatkhau').click(function(){

            matkhaucu=$('#matkhaucu').val();
            matkhaumoi=$('#matkhaumoi').val();
            nhaplaimatkhaumoi=$('#nlmatkhaumoi').val();

            loi=0;
            if( matkhaucu=="" || matkhaumoi=="")
            {
                loi++;
                $('#dmk_thongbao').text("Hãy nhập đầy đủ thông tin");
            }

            if(matkhaumoi!=nhaplaimatkhaumoi)
            {
                loi++;
                $('#dmk_thongbao').text("Mật khẩu mới nhập lại không trùng khớp");
            }

            if(loi!=0)
            {
                return false;
            }
            else
            {
                tendangnhap=$('#tendangnhap').val();
                $('#dmk_thongbao').text("");
                DoiMatKhau(tendangnhap,matkhaucu,matkhaumoi);
            }
        });

        $('#doithongtin').click(function(){
            hoten=$('#hoten').val();
            ngaysinh=$('#ngaysinh').val();
            diachi=$('#diachi').val();
            dienthoai=$('#dienthoai').val();
            email=$('#email').val();

            loi=0;
            if( hoten=="" || ngaysinh==""
            || diachi=="" || dienthoai=="" || email=="")
            {
                loi++;
                $('#thongbao').text("Hãy nhập đầy đủ thông tin");
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
    });
</script>

<?php
	global $conn;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $tendangnhap=$_POST["tendangnhap"];
        $hoten=$_POST["hoten"];
        $ngaysinh=$_POST["ngaysinh"];
        $gioitinh=$_POST["gioitinh"];
        $diachi=$_POST["diachi"];
        $dienthoai=$_POST["dienthoai"];
        $email=$_POST["email"];

        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            echo "<script>alert('Email không hợp lệ');</script>";
        else {
            $capnhatThongTin="UPDATE thanhvien SET HoTen='".$hoten."' ,NgaySinh='".$ngaysinh."', GioiTinh='".$gioitinh."',
            DiaChi='".$diachi."', DienThoai='".$dienthoai ."', Email='".$email."' WHERE TenDangNhap='".$tendangnhap."'";
            if(mysqli_query($conn,$capnhatThongTin))
                echo "<script>alert('Thay đổi thành công');location='ThongTinTaiKhoan.php';</script>";
            else
                echo "<script>alert('Xảy ra lỗi');</script>";
        }
    }
?>

<?php
include("../layout/footer.php");
?>

