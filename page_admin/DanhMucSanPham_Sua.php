<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";

if(!isset($_GET["MaLoaiSP"]))
    echo "<script>location='DanhMucSanPham.php';</script>";

global $conn;

$layDuLieu="SELECT * FROM loaisp WHERE MaLoaiSP='".$_GET["MaLoaiSP"]."'"; //truy vấn lấy loại sản phẩm theo MaLoaiSP
$truyvan_layDuLieu=mysqli_query($conn,$layDuLieu);
if(mysqli_num_rows($truyvan_layDuLieu)>0)
{
    $cot=mysqli_fetch_array($truyvan_layDuLieu); //với dữ liệu lấy được sẽ lấy mỗi dòng của dữ liệu và gán vào biến cot
}
else
{
    echo "<script>location='DanhMucSanPham.php';</script>";
}

?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                       Cập nhật danh mục sản phẩm
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                        <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                        <a href="DanhMucSanPham.php">Danh mục sản phẩm</a>
                        </li>
                        <li class="active">
                        Cập nhật danh mục sản phẩm
                        </li>
                    </ol>
                </div>

                <div class="col-lg-12">
                    <div >
                        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                            <table class="table table-bordered">

                                <tr>
                                    <th>Tên danh mục</th><td><input id="tendanhmuc" name="tendanhmuc" class="form-control" value="<?php echo $cot["TenLoai"]; ?>"> </td>

                                </tr>
                                <tr>
                                    <th>Mô tả</th><td><input id="mota" name="mota" class="form-control" value="<?php echo $cot["MoTa"]; ?>"> </td>
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

    <script>
        $(document).ready(function(){
            $('#Luu').click(function(){
                tendanhmuc=$('#tendanhmuc').val();
                mota=$('#mota').val();

                loi=0;
                if(tendanhmuc=="" || mota=="")
                {
                    loi++;
                    alert("Hãy nhập đầy đủ thông tin");
                }

                if(loi!=0)
                {
                    return false;
                }
            });

        });
    </script>


<?php
if($_SERVER["REQUEST_METHOD"]=="POST") { //kiểm tra phương thức gửi lên có phải POST không
    $tendanhmuc = $_POST["tendanhmuc"];
    $mota = $_POST["mota"];

	global $conn;
    $suaDuLieu="UPDATE loaisp SET TenLoai='".$tendanhmuc."', MoTa='".$mota."' WHERE MaLoaiSP='".$_GET["MaLoaiSP"]."'"; //sửa dữ liệu TenLoai và MoTa theo MaLoaiSP
    if(mysqli_query($conn,$suaDuLieu))
    {
        echo "<script>alert('Cập nhật thành công !')</script>";
    }
    else
    {
        echo "<script>alert('Đã xảy ra lỗi !')</script>";
    }
    echo "<script>location='DanhMucSanPham_Sua.php?MaLoaiSP=".$_GET["MaLoaiSP"]."';</script>"; //làm mới trang
}

?>
<?php
include("../layout/footer_admin.php");

?>