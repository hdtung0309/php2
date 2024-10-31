<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";

global $conn;

//xóa thành viên theo TDN
if(isset($_GET["TDN"])) //kiểm tra tên đăng nhập có tồn tại không
{
    $xoaDuLieu="DELETE FROM thanhvien  WHERE TenDangNhap='".$_GET["TDN"]."'";
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
    $trang=$_GET["trang"]; //nếu có phương thức GET thì giá trị của trang sẽ là giá trị của GET (giúp chuyển các trang)
    

$layDuLieu=phan_trang("*","thanhvien","",10,$trang,""); //phân trang với 10 đơn đặt

$truyvan_layDuLieu=$layDuLieu;

?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Quản lý thành viên
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                        <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                        Thành viên
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-12">
                <div >

                    <table class="table table-bordered table-hover">

                        <tr>
                            <th>Họ tên</th>
                            <th>Tên đăng nhập</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    <?php
                        while($cot=mysqli_fetch_array($truyvan_layDuLieu))
                        {
                        ?>
                        <!-- hiển thị thông tin thành viên -->
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
                                <td><?php echo $cot["DiaChi"];?></td>
                                <td><?php echo $cot["Email"];?></td>
                                <td>
                                    <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?TDN=<?php echo $cot["TenDangNhap"]; ?>" class="XoaDuLieu btn btn-danger">Xóa</a>
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