<?php
if(!isset($_GET["MaSP"]))
    header("location: SanPham.php");

include("../layout/header.php");

global $conn;

$laySP="SELECT * FROM sanpham WHERE MaSanPham='".$_GET["MaSP"]."'"; //lấy sản phẩm
$truyvan_laySP=mysqli_query($conn,$laySP);
$cot=mysqli_fetch_array($truyvan_laySP);

$laySanPhamLQ="SELECT * FROM sanpham WHERE MaLoaiSP='".$cot["MaLoaiSP"]."' and MaSanPham != '".$_GET["MaSP"]."' order by DonGia DESC LIMIT 0,6 "; //lấy sản phẩm liên quan
$truyvan_laySanPhamLQ=mysqli_query($conn,$laySanPhamLQ);


$tendangnhap="";
$sosao="0";
if(isset($_SESSION["tendangnhap"])) {
    $tendangnhap = $_SESSION["tendangnhap"];
    
}

//SELECT FROM binhluan INNER JOIN thanhvien ON binhluan.TenDangNhap=sanpham.TenDangNhap

$layBinhLuan="SELECT *
                  FROM binhluan INNER JOIN thanhvien
                  ON binhluan.TenDangNhap=thanhvien.TenDangNhap
                  WHERE MaSanPham='".$cot["MaSanPham"]."' ORDER BY MaBinhLuan DESC"; //lấy các bình luận mới nhất từ một mã sản phẩm

$truyvan_layBinhLuan=mysqli_query($conn,$layBinhLuan);

?>

<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="index.php">Trang chủ</a></li>
                <li class="active">Chi tiết sản phẩm </li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--start-single-->
<div class="single contact">
    <div class="container">
        <div class="single-main">
            <div class="col-md-9 single-main-left">
                <div class="sngl-top">
                    <div class="col-md-5 single-top-left">
                        <div class="flexslider" >
                            <ul class="slides">
                                <li data-thumb="../images/HinhSP/<?php echo $cot["Anh"]; ?>">
                                    <img src="../images/HinhSP/<?php echo $cot["Anh"]; ?>" />
                                </li>
                                <li data-thumb="../images/HinhSP/<?php echo $cot["Anh2"]; ?>" >
                                    <img src="../images/HinhSP/<?php echo $cot["Anh2"]; ?>" />
                                </li>
                                <li data-thumb="../images/HinhSP/<?php echo $cot["Anh3"]; ?>">
                                    <img src="../images/HinhSP/<?php echo $cot["Anh3"]; ?>" />
                                </li>
                            </ul>
                        </div>
                        <!-- FlexSlider -->
                        <script defer src="../script/jsNguoiDung/jquery.flexslider.js"></script>
                        <link rel="stylesheet" href="../css/cssNguoiDung/flexslider.css" type="text/css" media="screen" />

                        <script>
                            $(window).load(function() {
                                $('.flexslider').flexslider({
                                    animation: "slide",
                                    controlNav: "thumbnails"
                                });
                            });
                        </script>
                    </div>
                    <div class="col-md-7 single-top-right">
                        <div class="details-left-info simpleCart_shelfItem">
                            <h3><?php echo $cot["TenSanPham"] ?></h3>

                            <p class="availability">Trạng thái: <span class="color"><?php echo $cot["TrangThai"]; ?></span></p>
                            <div class="price_single">
                                <span class="actual item_price"><?php echo GiaTien($cot["DonGia"]); ?></span>
                            </div>
                            <h2 class="quick">Thông tin sản phẩm: </h2>
                            <p class="quick_desc">
                                <?php echo $cot["ThongTin"]; ?>
                            </p>
                            <div class="quantity_box">
                                <ul class="product-qty">
                                    <span>Số lượng đặt:</span>
                                    <select id="soluongdat">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </ul>
                            </div>
                            <div class="clearfix"> </div>
                            <div class="single-but item_add">
                                <input type="submit" value="Thêm giỏ hàng" onclick="ThemGioHang(<?php echo $cot["MaSanPham"]; ?>,$('#soluongdat').val())"/>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <hr>

                <h4>Bình luận sản phẩm:</h4>

                <?php if(isset($_SESSION["tendangnhap"])) {?>
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>?MaSP=<?php echo $cot["MaSanPham"]; ?>">
                        <textarea name="ndbinhluan" id="ndbinhluan" class="form-control" rows="4" placeholder="Nhập nội dung bình luận..."></textarea>
                        <div class="single-but item_add" style="text-align: right">
                            <input id="btn-binhluan" type="submit" value="Bình luận" >
                        </div>
                    </form>
                <?php }else { echo "Bạn hãy đăng nhập để bình luận sản phẩm này.";} ?>

                <?php while($cotBL=mysqli_fetch_array($truyvan_layBinhLuan)) {?>

                    <hr style="width: 70%">
                    <div>
                        <span class="bl_ten"><?php echo $cotBL["HoTen"]; ?></span>
                        <span class="bl_ngay">đã bình luận vào ngày <?php echo date("d/m/Y",strtotime($cotBL["NgayBinhLuan"])); ?></span>

                        <input id="bl_mabinhluan" type="hidden" value="<?php echo $cotBL["MaBinhLuan"]; ?>">
                        <input id="bl_noidung" type="hidden" value="<?php echo $cotBL["NoiDung"]; ?>">
                        <div class="bl_noidung">
                            <?php echo $cotBL["NoiDung"]; ?>
                        </div>
                    </div>
                <?php } ?>

                <hr>
                <span><h2> Sản phẩm liên quan </h2></span>
                <div class="latest products">
                    <div class="product-one">

                        <div class="col-md-12 p-left">
                            <div class="clearfix"> </div>
                            <?php
                            $i=0;
                            while($cot=mysqli_fetch_array($truyvan_laySanPhamLQ))
                            {
                                $i++;
                                ?>
                                <div class="product-one">
                                    <div class="col-md-4 product-left single-left">
                                        <div class="p-one simpleCart_shelfItem">

                                            <a href="ChiTietSanPham.php?MaSP=<?php echo $cot["MaSanPham"]; ?>" >  <!-- link chi tiet san pham -->

                                                <img height="250" src="../images/HinhSP/<?php echo $cot["Anh"] ?>" alt="" />
                                                <div class="mask mask1">
                                                    <span>Xem chi tiết</span>
                                                </div>
                                            </a>
                                            <h4><?php echo $cot["TenSanPham"] ?></h4>
                                            <p><a class="item_add" href="#"><span class=" item_price"> <?php echo GiaTien($cot["DonGia"]); ?> VNĐ</span></a></p>
                                        </div>
                                    </div>

                                </div>


                                <?php if($i%3==0) {?>

                                <div class="clearfix"> </div>

                            <?php
                            }
                            }
                            ?>
                            <div class="divtrang"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- phan danh muc -->
            <div class="col-md-3 p-right single-right">
                <h3>Loại sản phẩm</h3>
                <ul class="product-categories">
                    <?php
					global $conn;
                    $layLoaiSP="SELECT * FROM loaisp";
                    $truyvan_layLoaiSP=mysqli_query($conn,$layLoaiSP);
                    while($cot=mysqli_fetch_array($truyvan_layLoaiSP))
                    {
                        ?>
                        <li><a href="DanhMucSanPham.php?loaisp=<?php echo $cot["MaLoaiSP"] ?>"><?php echo $cot["TenLoai"] ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<?php
global $conn;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $masp=$_GET["MaSP"];
    $ngaybinhluan=date("Y-m-d");
    $ndbinhluan=$_POST["ndbinhluan"];
    $themBinhLuan="INSERT INTO binhluan(TenDangNhap,MaSanPham,NgayBinhLuan,NoiDung) VALUES ('".$tendangnhap."','".$masp."','".$ngaybinhluan."','".$ndbinhluan."')";
    if(mysqli_query($conn,$themBinhLuan))
    {
        echo "<script>alert('Bình luận thành công');window.location='ChiTietSanPham.php?MaSP=".$masp."'</script>";
    }
    else{
        echo "<script>alert('Đã có lỗi xảy ra');</script>";
    }

}

?>

<script>
    $(document).ready(function(){
         $('#btn-binhluan').click(function()
        {
            if($('#ndbinhluan').val()=="")
            {
                alert("Hãy nhập nội dung bình luận.");
                return false;
            }
        });
    })
</script>


<?php
include("../layout/footer.php");
?>
