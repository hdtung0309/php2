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
                       Thêm danh mục sản phẩm
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                        <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                        <a href="DanhMucSanPham.php">Danh mục sản phẩm</a>
                        </li>
                        <li class="active">
                        Thêm danh mục sản phẩm
                        </li>
                    </ol>
                </div>

                <div class="col-lg-12">
                    <div >
                        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                            <table class="table table-bordered">

                                <tr>
                                    <th>Tên danh mục</th><td><input id="tendanhmuc" name="tendanhmuc" class="form-control"> </td>

                                </tr>
                                <tr>
                                    <th>Mô tả</th><td><input id="mota" name="mota" class="form-control"> </td>
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
    $themDuLieu="INSERT INTO loaisp(TenLoai,MoTa) VALUES ('".$tendanhmuc."','".$mota."')"; //Thêm vào bảng loaisp dữ liệu của TenLoai và MoTa
    if(mysqli_query($conn,$themDuLieu))
    {
        echo "<script>alert('Thêm thành công !')</script>";
        echo "<script>location='DanhMucSanPham.php';</script>"; //làm mới trang
    }
    else
    {
        echo "<script>alert('Đã xảy ra lỗi !')</script>";
    }
}

?>
<?php
include("../layout/footer_admin.php");

?>