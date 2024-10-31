<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";

global $conn;

if(isset($_GET["MaDonDatXoa"]))
{
    $xoaDuLieu1="DELETE FROM ct_dondat  WHERE MaDonDat='".$_GET["MaDonDatXoa"]."'"; //xóa bản ghi tại bảng ct_dondat theo MaDonDat
	$xoa1=mysqli_query($conn,$xoaDuLieu1);
	$xoaDuLieu2="DELETE FROM dondat  WHERE MaDonDat='".$_GET["MaDonDatXoa"]."'"; //xóa bản ghi tại bảng dondat theo MaDonDat
    if(mysqli_query($conn,$xoaDuLieu2))
    {
        echo "<script>alert('Xóa thành công !')</script>";
    }
    else
    {
        echo "<script>alert('Đã xảy ra lỗi !')</script>";
    }
}

if(!isset($_GET["MaDonDat"]))
    echo "<script>location='DonDatHang.php';</script>";
//lấy thông tin đơn đặt theo mã đơn đặt
$layDonDat="SELECT dondat.* , thanhvien.HoTen  hotentv , nhanvien.HoTen  hotennv FROM dondat      
                INNER JOIN thanhvien ON dondat.TenDangNhap=thanhvien.TenDangNhap
                INNER JOIN nhanvien ON dondat.MaNhanVien=nhanvien.MaNhanVien
                WHERE MaDonDat='".$_GET["MaDonDat"]."'";
$truyvan_layDonDat=mysqli_query($conn,$layDonDat);
if(mysqli_num_rows($truyvan_layDonDat)>0)
{
    //lấy thông tin đơn đặt hàng
    $cotDDH=mysqli_fetch_array($truyvan_layDonDat);

    //lấy chi tiết đơn đặt hàng
    $layCT_DonDat="SELECT  sanpham.*, ct_dondat.* FROM ct_dondat
                INNER JOIN sanpham ON ct_dondat.MaSanPham=sanpham.MaSanPham
                WHERE MaDonDat='".$_GET["MaDonDat"]."'";
    $truyvan_layCT_DonDat=mysqli_query($conn,$layCT_DonDat);

}
else
{
    echo "<script>location='DonDatHang.php';</script>";
}

?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                       Xem chi tiết đơn đặt hàng
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                        <a href="index.php">Trang chủ</a>
                        </li>
                        <li class="active">
                        <a href="DonDatHang.php">Danh sách đơn đặt hàng</a>
                        </li>
                        <li class="active">
                         Xem chi tiết đơn đặt hàng
                        </li>
                    </ol>
                </div>

                <div class="col-lg-12">
                    <div >
                        <form id="frmDuyetDDH" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                            <table class="table table-bordered">
                            <!-- hiển thị thông tin đơn đặt -->
                                <tr>
                                    <td >
                                        <b>Mã đơn đặt hàng:</b> <?php echo $cotDDH["MaDonDat"]; ?> <br>
                                        <b>Người đặt:</b> <?php echo $cotDDH["hotentv"]; ?> <br>
                                        <b>Nơi giao:</b> <?php echo $cotDDH["NoiGiao"]; ?> <br>
                                        <b>Ngày đặt:</b> <?php echo date("d/m/Y",strtotime($cotDDH["NgayDat"]));?> <br>
                                    </td>
                                    <td colspan="3">

                                       Trạng thái:
                                        <select name="TrangThai" id="TrangThai" class="form-control">
                                             <?php if(trim($cotDDH["TrangThai"])==0) {?> <!--kiểm tra xem trạng thái đơn hàng có bằng 0 không -->
                                                 <option selected value="0">Chưa giao</option> <!--nếu bằng 0 thì "Chưa giao" được chọn làm mặc định -->
                                                <option value="1">Đã giao</option>
                                            <?php }else{
                                                ?>
                                                <option value="0">Chưa giao</option>
                                                <option selected value="1">Đã giao</option><!--nếu bằng 1 thì "Đã giao" được chọn làm mặc định -->
                                           <?php } ?>
                                        </select>
                                        <br>
                                        <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?MaDonDatXoa=<?php echo $cotDDH["MaDonDat"]; ?>" id="Xoa" class="btn btn-danger">Xóa</a> <!-- Xóa đơn đặt theo MaDonDat-->
                                    </td>

                                </tr>

                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng đặt</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                                <?php
                                $tongtien=0;
                                while($cotCT_DDH=mysqli_fetch_array($truyvan_layCT_DonDat)) //gán dữ liệu truy vấn được vào biến cotCT_DDH 
                                    {
                                        $tongtien+=$cotCT_DDH["SoLuong"]*$cotCT_DDH["DonGia"]; // tính tổng tiền của đơn hàng
                                 ?>
                                    <!-- hiển thị thông tin đơn hàng -->
                                    <tr>
                                        <td><?php echo $cotCT_DDH["TenSanPham"]; ?></td>
                                        <td><?php echo $cotCT_DDH["SoLuong"]; ?></td>
                                        <td><?php echo GiaTien($cotCT_DDH["DonGia"]); ?></td>
                                        <td><?php echo GiaTien($cotCT_DDH["SoLuong"]*$cotCT_DDH["DonGia"]); ?></td>
                                    </tr>

                                <?php  } ?>
                                <tr>
                                    <th colspan="3">Tổng tiền</th>
                                    <th><?php echo GiaTien($tongtien); ?> VNĐ</th>
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
            $('#Xoa').click(function(){
                if(!confirm("Bạn có thực muốn xóa !"))
                    return false;
            });

            $('#TrangThai').change(function(){
                $('#frmDuyetDDH').submit();
            });

        });
    </script>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST") { //kiểm tra phương thức gửi lên có phải POST không
	global $conn;
    $trangthai=$_POST["TrangThai"];

    $layNV="SELECT * FROM nhanvien WHERE TenDangNhap='".$_SESSION["admin"]."'"; //lấy thông tin nhân viên xử lý đơn hàng
    $truyvan_layNV=mysqli_query($conn,$layNV);
    $cotTV=mysqli_fetch_array($truyvan_layNV);

    $suaDuLieu="UPDATE dondat SET TrangThai='".$trangthai."', MaNhanVien='".$cotTV["MaNhanVien"]."' WHERE MaDonDat='".$_GET["MaDonDat"]."'"; //update lại thông tin TrangThai với 0 là chưa giao và 1 là đã giao
    if(mysqli_query($conn,$suaDuLieu))
    {
        echo "<script>alert('Cập nhật thành công !')</script>";
    }
    else
    {
        echo "<script>alert('Đã xảy ra lỗi !')</script>";
    }
    echo "<script>location='DonDatHang_Xem.php?MaDonDat=".$_GET["MaDonDat"]."';</script>"; //làm mới trang
}

?>

<?php
include("../layout/footer_admin.php");

?>