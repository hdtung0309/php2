<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";


$trang=0;

if(isset($_GET["trang"]))
    $trang=$_GET["trang"]; //nếu có phương thức GET thì giá trị của trang sẽ là giá trị của GET (giúp chuyển các trang)
    
//truy vấn lấy dữ liệu đơn đặt
$select="dondat.* , thanhvien.HoTen  hotentv , nhanvien.HoTen  hotennv"; 
$from="dondat INNER JOIN thanhvien ON dondat.TenDangNhap=thanhvien.TenDangNhap
                INNER JOIN nhanvien ON dondat.MaNhanVien=nhanvien.MaNhanVien";

$layDuLieu=phan_trang($select,$from,"",10,$trang,""); //phân trang với 10 đơn đặt


$truyvan_layDuLieu=$layDuLieu;

?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Quản lý đơn đặt hàng
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                        <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                        Đơn đặt hàng
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-12">
                <div >

                    <table class="table table-bordered table-hover">

                        <tr>
                            <th>Mã đơn đặt hàng</th>
                            <th>Người đặt hàng</th>
                            <th>Nhân viên xử lý</th>
                            <th>Trạng thái</th>
                            <th>Nơi giao</th>
                            <th>Ngày đặt</th>
                            <th></th>
                        </tr>
                        <?php
                        while($cot=mysqli_fetch_array($truyvan_layDuLieu))
                        {
                            ?>
                            <!-- lấy thông tin đơn đặt -->
                            <tr>
                                <td><?php echo $cot["MaDonDat"];?></td>
                                <td><?php echo $cot["hotentv"];?></td>
                                <td><?php echo $cot["hotennv"];?></td>
                                <td>
                                    <?php if(trim($cot["TrangThai"])==0){ //kiểm tra trạng thái 
                                        echo "<span class='text-danger'>Chưa giao</span>";
                                    }else{
                                        echo "<span class='text-success'>Đã giao</span>";
                                    } ?>
                                </td>
                                <td><?php echo $cot["NoiGiao"];?></td>
                                <td><?php echo date("d/m/Y",strtotime($cot["NgayDat"]));?></td>
                                <td>
                                    <a href="DonDatHang_Xem.php?MaDonDat=<?php echo $cot["MaDonDat"]; ?>" class="btn btn-success">Xem chi tiết</a>
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


        });
    </script>
<?php
include("../layout/footer_admin.php");

?>