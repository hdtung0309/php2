<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";

?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                       Thêm nhân viên
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="NhanVien.php">Danh sách nhân viên</a>
                        </li>
                        <li class="active">
                            Thêm nhân viên
                        </li>
                    </ol>
                </div>

                <div class="col-lg-12">
                    <div >
                        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Họ tên</th><td><input id="hoten" name="hoten" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Tên đăng nhập</th><td><input id="tendangnhap" name="tendangnhap" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Mật khẩu</th><td><input type="password" id="matkhau" name="matkhau" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh</th><td><input type="date" id="ngaysinh" name="ngaysinh" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Giới tính</th>
                                    <td>
                                        <input type="radio" checked  name="gioitinh" value="M" > Nam
                                        <input type="radio"  name="gioitinh" value="F" > Nữ
                                    </td>
                                </tr>
                                <tr>
                                    <th>Điện thoại</th><td><input id="dienthoai" name="dienthoai" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>
                                        <span style="color: red;" id="thongbao"></span> <br>
                                        <input id="Luu" type="submit" value="Lưu" class="btn btn-primary">
                                    </th>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#Luu').click(function(){
                hoten=$('#hoten').val();
                tendangnhap=$('#tendangnhap').val();
                matkhau=$('#matkhau').val();
                ngaysinh=$('#ngaysinh').val();
                dienthoai=$('#dienthoai').val();

                loi=0;
                if(tendangnhap=="" || matkhau=="" || hoten=="" || ngaysinh=="" || dienthoai=="" )
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

if($_SERVER["REQUEST_METHOD"]=="POST") { //kiểm tra phương thức gửi lên có phải POST không

    $hoten=$_POST["hoten"];
    $tendangnhap=$_POST["tendangnhap"];
    $matkhau=$_POST["matkhau"];
    $ngaysinh=$_POST["ngaysinh"];
    $gioitinh=$_POST["gioitinh"];
    $dienthoai=$_POST["dienthoai"];

    $ktTonTai="SELECT * FROM nhanvien WHERE TenDangNhap='".$tendangnhap."'";
    $truyvan_ktTonTai=mysqli_query($conn,$ktTonTai);
    if(mysqli_num_rows($truyvan_ktTonTai)>0)
    {
        echo "<script>alert('Tên đăng nhập đã tồn tại !')</script>";
    }
    else {
        $themDuLieu = "INSERT INTO nhanvien(HoTen,TenDangNhap,MatKhau,NgaySinh,GioiTinh,DienThoai) VALUES ('" . $hoten . "','" . $tendangnhap . "',
        '" . $matkhau . "','" . $ngaysinh . "','" . $gioitinh . "','" . $dienthoai . "')"; //thêm thông tin vào bảng nhanvien
        if (mysqli_query($conn,$themDuLieu)) {
            echo "<script>alert('Thêm thành công !')</script>";
            echo "<script>location='NhanVien.php';</script>";
        } else {
            echo "<script>alert('Đã xảy ra lỗi !')</script>";
        }
    }
}

?>
<?php
include("../layout/footer_admin.php");

?>