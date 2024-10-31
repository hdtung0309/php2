<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";

global $conn;

if(isset($_GET["MaNhanVien"]))
{
    $xoaDuLieu="DELETE FROM nhanvien  WHERE MaNhanVien='".$_GET["MaNhanVien"]."'";
    if(mysqli_query($conn,$xoaDuLieu))
    {
        echo "<script>alert('Xóa thành công !')</script>";
    }
    else
    {
        echo "<script>alert('Đã xảy ra lỗi !')</script>";
    }
}

$trang=0;
if(isset($_GET["trang"]))
    $trang=$_GET["trang"];//nếu có phương thức GET thì giá trị của trang sẽ là giá trị của GET (giúp chuyển các trang)

$layDuLieu=phan_trang("*","nhanvien","",10,$trang,""); //phân trang với 10 nhân viên

$truyvan_layDuLieu=$layDuLieu;

?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Quản lý nhân viên
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                             <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                             Nhân viên
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-12">
                <h2><a href="NhanVien_Them.php" class="btn btn-primary">Thêm nhân viên</a></h2>
                <div >

                    <table class="table table-bordered table-hover">

                        <tr>
                            <th>Họ tên</th>
                            <th>Tên đăng nhập</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Điện thoại</th>
                            <th></th>
                        </tr>
                    <?php
                        while($cot=mysqli_fetch_array($truyvan_layDuLieu))
                        {
                        ?>
                        <!-- hiển thị thông tin nhân viên -->
                            <tr>
                                <td><?php echo $cot["HoTen"];?></td>
                                <td><?php echo $cot["TenDangNhap"];?></td>
                                <td><?php echo date("d/m/Y",strtotime($cot["NgaySinh"]));?></td>
                                <td>
                                    <?php
                                        if(trim($cot["GioiTinh"])=="M")
                                            echo "Nam";
                                        else
                                            echo "Nữ";

                                    ?>
                                </td>
                                <td><?php echo $cot["DienThoai"];?></td>
                                <td>
                                    <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?MaNhanVien=<?php echo $cot["MaNhanVien"]; ?>" class="XoaDuLieu btn btn-danger">Xóa</a> <!-- Xóa nhân viên theo mã nhân viên -->
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

        });
    </script>
<?php
include("../layout/footer_admin.php");

?>