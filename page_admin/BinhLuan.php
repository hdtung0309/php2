<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";

if(isset($_GET["MaBinhLuan"]))
{
	global $conn;
    $xoaDuLieu="DELETE FROM binhluan  WHERE MaBinhLuan='".$_GET["MaBinhLuan"]."'";
    if(mysqli_query($conn,$xoaDuLieu))
    {
        echo "<script>alert('Xóa thành công !')</script>";
    }
    else
    {
        echo "<script>alert('Đã xảy ra lỗi !')</script>";
    }
}

$dieukienTrang="";
$trang=0;

if(isset($_GET["trang"]))
    $trang=$_GET["trang"]; //nếu có phương thức GET thì giá trị của trang sẽ là giá trị của GET (giúp chuyển các trang)

if (isset($_GET["noidung"]))
    $dieukienTrang = $_GET["noidung"]; //nếu có phương thức GET thì giá trị của dieukientrang sẽ là giá trị của GET (giúp lấy nội dung)


$from="binhluan INNER JOIN thanhvien ON binhluan.TenDangNhap=thanhvien.TenDangNhap
                INNER JOIN sanpham ON binhluan.MaSanPham=sanpham.MaSanPham";
$where="WHERE NoiDung LIKE '%" . $dieukienTrang . "%'";

$layDuLieu=phan_trang("*",$from,$where,10,$trang,"&noidung=".$dieukienTrang); //phân trang với 10 bình luận

$truyvan_layDuLieu=$layDuLieu;

?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Quản lý bình luận
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                             Bình luận
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-12">
                <div >

                    <table class="table table-bordered table-hover">

                        <tr>
                            <th>Người bình luận</th>
                            <th>Tên sản phẩm</th>
                            <th>Ngày bình luận</th>
                            <th>Nội dung</th>
                            <th></th>
                        </tr>
                        <?php
                        while($cot=mysqli_fetch_array($truyvan_layDuLieu))
                        {
                            ?>
                            <!-- lấy thông tin người bình luận và sản phẩm được bình luận -->
                            <tr>
                                <td><?php echo $cot["HoTen"];?></td>
                                <td><?php echo $cot["TenSanPham"];?></td>
                                <td><?php echo date("d/m/Y",strtotime($cot["NgayBinhLuan"]));?></td>

                                <td>
                                    <?php
                                        if(strlen($cot["NoiDung"]) < 20 )
                                            echo $cot["NoiDung"];
                                        else
                                            echo substr($cot["NoiDung"],0,20)."...";
                                    ?>

                                </td>
                                <td>
                                    <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?MaBinhLuan=<?php echo $cot["MaBinhLuan"]; ?>" class="XoaDuLieu btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
                    <div class="divtrang"></div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function () {
            <?php
               echo  "$('.divtrang_".$trang."').addClass('divtrangactive');";
            ?>

            $('.XoaDuLieu').click(function(){
                if(!confirm("Bạn có thực muốn xóa !"))
                    return false;
            });

            $('#btn-timkiem').click(function (){
                location="BinhLuan.php?noidung="+$('#txt-timkiem').val();
            });
        });
    </script>
<?php
include("../layout/footer_admin.php");

?>