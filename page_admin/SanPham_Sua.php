<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";

if(!isset($_GET["MaSP"]))
    echo "<script>location='SanPham.php';</script>";

global $conn;

//truy vấn lấy thông tin bảng sanpham
$layDuLieu="SELECT * FROM sanpham WHERE MaSanPham='".$_GET["MaSP"]."'";
$truyvan_layDuLieu=mysqli_query($conn,$layDuLieu);
if(mysqli_num_rows($truyvan_layDuLieu)>0)
{
    $cot=mysqli_fetch_array($truyvan_layDuLieu); //lấy dữ liệu và gán vào biến cot
}
else
{
    echo "<script>location='SanPham.php';</script>";
}

$layLoaiSP="SELECT * FROM loaisp";
$truyvan_layLoaiSP=mysqli_query($conn,$layLoaiSP);


?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Cập nhật sản phẩm
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> <a href="SanPham.php">Sản phẩm</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Cập nhật sản phẩm
                        </li>
                    </ol>
                </div>

                <div class="col-lg-12">
                    <div >
                        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" enctype="multipart/form-data">
                            <table class="table table-bordered">
                            <!-- hiển thị thông tin sản phẩm -->
                                <tr>
                                    <th>Tên sản phẩm</th><td><input id="tensanpham" name="tensanpham" class="form-control" value="<?php echo empty($_POST["tensanpham"])? $cot["TenSanPham"]:$_POST["tensanpham"]; ?>"> </td>

                                </tr>
                                <tr>
                                    <th>Số lượng</th><td><input id="soluong" name="soluong" class="form-control" value="<?php echo empty($_POST["soluong"])? $cot["SoLuong"]:$_POST["soluong"]; ?>" > </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <img src="../images/HinhSP/<?php echo $cot["Anh"];  ?>">
                                        <img src="../images/HinhSP/<?php echo $cot["Anh2"];  ?>">
                                        <img src="../images/HinhSP/<?php echo $cot["Anh3"];  ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ảnh 1</th>
                                    <td><input type="file" id="anh1" name="anh1" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Ảnh 2</th>
                                    <td><input type="file" id="anh2" name="anh2" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Ảnh 3</th>
                                    <td><input type="file" id="anh3" name="anh3" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Đơn giá</th><td><input id="dongia" name="dongia" class="form-control" value="<?php echo empty($_POST["dongia"])? $cot["DonGia"]:$_POST["dongia"]; ?>"> </td>
                                </tr>
                                <tr>
                                    <th>Thông tin</th><td><input id="thontin" name="thongtin" class="form-control" value="<?php echo empty($_POST["thontin"])? $cot["ThongTin"]:$_POST["thongtin"]; ?>"> </td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th><td><input id="trangthai" name="trangthai" class="form-control" value="<?php echo empty($_POST["trangthai"])? $cot["TrangThai"]:$_POST["trangthai"]; ?>"> </td>
                                </tr>
                                <tr>
                                    <th>Danh mục sản phẩm</th>
                                    <td>
                                        <select name="loaisp" id="loaisp" class="form-control">
                                            <?php
                                                while($cotloaisp=mysqli_fetch_array($truyvan_layLoaiSP)) {
                                                    if($cotloaisp["MaLoaiSP"]==$cot["MaLoaiSP"])
                                                    {
                                            ?>

                                                    <option selected value="<?php echo $cotloaisp["MaLoaiSP"]; ?>"><?php echo $cotloaisp["TenLoai"]; ?></option>
                                                        <?php }else{ ?>
                                                    <option value="<?php echo $cotloaisp["MaLoaiSP"]; ?>"><?php echo $cotloaisp["TenLoai"]; ?></option>
                                                <?php } } ?>
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
    $anh1=$cot["Anh"];
    $anh2=$cot["Anh2"];
    $anh3=$cot["Anh3"];
    $dongia=$_POST["dongia"];
    $thongtin=$_POST["thongtin"];
    $trangthai=$_POST["trangthai"];
    $loaisp=$_POST["loaisp"];

    if($_FILES["anh1"]["name"]!="") //Kiểm tra xem tệp đã được tải lên hay chưa
    {
        unlink("../images/HinhSP/".$anh1); //xóa ảnh cũ
        $anh1=$_FILES["anh1"]["name"]; //Gán tên của tệp mới được tải lên vào biến anh1
        move_uploaded_file($_FILES["anh1"]["tmp_name"],"../images/HinhSP/".$anh1); //chuyển tệp đã tải lên từ vị trí tạm thời tới vị trí mong muốn 
    }
    if($_FILES["anh2"]["name"]!="")
    {
        unlink("../images/HinhSP/".$anh2);
        $anh2=$_FILES["anh2"]["name"];
        move_uploaded_file($_FILES["anh2"]["tmp_name"],"../images/HinhSP/".$anh2);
    }
    if($_FILES["anh3"]["name"]!="")
    {
        unlink("../images/HinhSP/".$anh3);
        $anh3=$_FILES["anh3"]["name"];
        move_uploaded_file($_FILES["anh3"]["tmp_name"],"../images/HinhSP/".$anh3);
    }

	global $conn;
    $suaDuLieu="UPDATE sanpham
                SET TenSanPham='".$tensanpham."',SoLuong='".$soluong."',Anh='".$anh1."',Anh2='".$anh2."',Anh3='".$anh3."',DonGia='".$dongia."',
                ThongTin='".$thongtin."',TrangThai='".$trangthai."',MaLoaiSP='".$loaisp."'
                WHERE MaSanPham='".$_GET["MaSP"]."'"; //cập nhật thông tin sản phẩm theo MaSP
    if(mysqli_query($conn,$suaDuLieu))
    {
        echo "<script>alert('Cập nhật thành công !')</script>";
    }
    else
    {
        echo "<script>alert('Đã xảy ra lỗi !')</script>";
    }
    echo "<script>location='SanPham_Sua.php?MaSP=".$_GET["MaSP"]."';</script>"; //làm mới trang
}

?>
<?php
include("../layout/footer_admin.php");

?>
