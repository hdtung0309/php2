<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";
global $conn;

$layLoaiSP="SELECT * FROM loaisp";
$truyvan_layLoaiSP=mysqli_query($conn,$layLoaiSP);

?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Thêm sản phẩm
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                        <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                        <a href="SanPham.php">Sản phẩm</a>
                        </li>
                        <li class="active">
                        Thêm sản phẩm
                        </li>
                    </ol>
                </div>

                <div class="col-lg-12">
                    <div >
                        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" enctype="multipart/form-data">
                            <table class="table table-bordered">

                                <tr>
                                    <th>Tên sản phẩm</th><td><input id="tensanpham" name="tensanpham" class="form-control"> </td>

                                </tr>
                                <tr>
                                    <th>Số lượng</th><td><input id="soluong" name="soluong" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Ảnh 1</th><td><input type="file" id="anh1" name="anh1" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Ảnh 2</th><td><input type="file" id="anh2" name="anh2" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Ảnh 3</th><td><input type="file" id="anh3" name="anh3" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Đơn giá</th><td><input id="dongia" name="dongia" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Thông tin</th><td><input id="thontin" name="thongtin" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th><td><input id="trangthai" name="trangthai" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <th>Danh mục sản phẩm</th>
                                    <td>
                                        <select name="loaisp" id="loaisp" class="form-control">
                                            <?php
                                                while($cotloaisp=mysqli_fetch_array($truyvan_layLoaiSP)) {
                                            ?>
                                                    <option value="<?php echo $cotloaisp["MaLoaiSP"]; ?>"><?php echo $cotloaisp["TenLoai"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th><th><input id="Luu" type="submit" value="Lưu" class="btn btn-primary"> </th>
                                </tr>


                            </table>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>


<?php
if($_SERVER["REQUEST_METHOD"]=="POST") { //kiểm tra phương thức gửi lên có phải POST không
    $tensanpham = $_POST["tensanpham"];
    $soluong = $_POST["soluong"];
    $anh1=$_FILES["anh1"];
    $anh2=$_FILES["anh2"];
    $anh3=$_FILES["anh3"];
    $dongia=$_POST["dongia"];
    $thongtin=$_POST["thongtin"];
    $trangthai=$_POST["trangthai"];
    $loaisp=$_POST["loaisp"];

    if($anh1["name"]=="" && $anh2["name"]=="" && $anh3["name"]=="") //nếu như cả 3 ảnh đều bị để trống thì đưa ra cảnh bào thêm ảnh 
    {
        echo "<script>alert('Hãy chọn đủ hình!')</script>";
        return;
    }
    if($anh1["type"]!="image/jpeg" && $anh1["type"]!="image/png") //kiểm tra định dạng ảnh, chỉ lấy các định dạng jpeg, png
    {
        echo "<script>alert('Hãy chọn đúng định dạng hình!')</script>";
        return;
    }

    move_uploaded_file($anh1["tmp_name"],"../images/HinhSP/".$anh1["name"]); //chuyển ảnh từ thư mục tạm thời vào thư mục images/HinhSP
    move_uploaded_file($anh2["tmp_name"],"../images/HinhSP/".$anh2["name"]);
    move_uploaded_file($anh3["tmp_name"],"../images/HinhSP/".$anh3["name"]);

	global $conn;
    $themDuLieu="INSERT INTO sanpham(TenSanPham,SoLuong,Anh,Anh2,Anh3,DonGia,ThongTin,TrangThai,MaLoaiSP) VALUES
		('".$tensanpham."','".$soluong."','".$anh1["name"]."','".$anh2["name"]."','".$anh3["name"]."','".$dongia."','".$thongtin."','".$trangthai."','".$loaisp."')"; //thêm vào bảng sanpham sản phẩm mới
    if(mysqli_query($conn,$themDuLieu))
    {
        echo "<script>alert('Thêm thành công !')</script>";
        echo "<script>location='SanPham.php';</script>";
    }
    else
    {
        echo "<script>alert('Đã xảy ra lỗi !')</script>";
		echo "Lỗi: " . $themDuLieu . "<br>" . mysqli_error($conn);
    }
}

?>
<?php
include("../layout/footer_admin.php");

//$_FILES["Anh"]["type"]!="image/jpeg"
//$_FILES["spAnh"]["type"]!="image/png"
//file_exists()
//unlink()
//move_uploaded_file($_FILES["Anh"]["tmp_name"], )

?>
