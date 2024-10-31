<?php
include("../layout/header.php");

if(!isset($_SESSION["giohang"]))
    echo "<script>location='SanPham.php';</script>";

//global $conn;

?>

	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="index.php">Trang Chủ</a></li>
					<li class="active">Giỏ hàng</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
<div id="giohang">
    <!--start-ckeckout-->
    <div  class="ckeckout" style="padding-bottom: 0px">
        <div class="container">
            <div class="ckeckout-top">
                <div class=" cart-items heading">
                    <h3>Giỏ hàng</h3>

                    <div class="in-check" >
                        <ul class="unit">
                            <li><span></span></li>
                            <li><span>Tên sản phẩm</span></li>
                            <li><span>Số lượng</span></li>
                            <li><span>Đơn giá</span></li>
                            <li><span>Thành tiền</span></li>
                            <li> </li>
                            <div class="clearfix"> </div>
                        </ul>
                        <?php
                        $tongtienGH=0;
                        foreach($_SESSION["giohang"] as $cotGH) //với mỗi bản ghi trong session giohang tính tổng tiền của giỏ hàng
                        {
                            $tongtienGH+=$cotGH["dongia"]*$cotGH["soluong"];
                            ?>
                            <ul class="cart-header">
                                <div class="close1" onclick="XoaGioHang(<?php echo $cotGH["masp"] ?>)"> </div>
                                <li class="ring-in"><a href="ChiTietSanPham.php?MaSP=<?php echo $cotGH["masp"]; ?>" ><img width="100"  src="../images/HinhSP/<?php echo $cotGH["hinhsp"]; ?>" class="img-responsive" alt=""></a>
                                </li>
                                <li><span><?php echo $cotGH["tensp"]; ?></span></li>
                                <li>
                            <span>
                                 <select id="soluongdat" onchange="SuaGioHang(<?php echo $cotGH["masp"]; ?>,$(this).val());">
                                     <?php for($i=1; $i < 7; $i++) {
                                         if($cotGH["soluong"]==$i) {
                                             ?>
                                             <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                         <?php }else{ ?>
                                             <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                         <?php
                                         }
                                     }
                                     ?>
                                 </select>
                            </span>
                                </li>
                                <li><span><?php echo GiaTien($cotGH["dongia"]); ?></span></li>
                                <li><span><?php echo GiaTien($cotGH["dongia"]*$cotGH["soluong"]); ?></span> </li>
                                <div class="clearfix"> </div>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-ckeckout-->
    <div class="container" style="text-align: right;padding-right: 30px">

        <?php if(isset($_SESSION["tendangnhap"])){ ?>

            <a id="angiohang" class="add-cart cart-check" style="cursor:pointer">Đặt hàng</a>
            <a id="paypal-button" class="add-cart cart-check"></a>

        <?php }else{ ?>

            <span class="text-danger">Bạn cần đăng nhập để đặt hàng.</span>

        <?php } ?>
    </div>
</div>

<?php
global $conn;
if(isset($_SESSION["tendangnhap"])) {

    $layThanhVien="SELECT * FROM thanhvien where TenDangNhap='".$_SESSION["tendangnhap"]."'";
    $truyvanlayThanhVien=mysqli_query($conn,$layThanhVien);
    $cotTV=mysqli_fetch_array($truyvanlayThanhVien);
?>


<div id="dathang" class="ckeckout" style="display: none">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <div class="container">
        <div class="ckeckout-top">
            <div class=" cart-items heading">
                <h3>Đặt hàng</h3>

                <div >
                    <ul class="unit">
                        <li><span>Thông tin người đặt</span></li>
                        <li><span></span></li>
                        <li><span>Ngày đặt</span></li>
                        <li><span>Tổng sản phẩm</span></li>
                        <li><span>Tổng tiền</span></li>
                        <div class="clearfix"> </div>
                    </ul>
                        <ul class="cart-header">

                            <li>
                                <span style="text-align: left">
                                    Tên người đặt <input type="text" value="<?php echo $cotTV["HoTen"]; ?>">
                                    Nơi giao <textarea style="width: 200px;" rows="4" type="text" id="noigiao" name="noigiao"><?php echo $cotTV["DiaChi"] ?></textarea>
                                </span>
                            </li>
                            <li><span></span></li>
                            <li><span><?php echo date("d/m/Y"); ?></span></li>
                            <li><span><?php echo count($_SESSION["giohang"]); ?></span></li>
                            <li><span><?php echo GiaTien($tongtienGH); ?> VNĐ</span></li>
                            <div class="clearfix"> </div>
                        </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="text-align: right;padding-right: 30px">
        <input  class="add-cart cart-check" type="submit" value="Đặt hàng">
    </div>
    </form>
</div>

<?php }
	global $conn;
	
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(isset($_SESSION["giohang"])) {

            $tendangnhap=$_SESSION["tendangnhap"];
            $trangthai="0";
            $noigiao=$_POST["noigiao"];
            $ngaydat=date("Y-m-d");

            $themDonDat="INSERT INTO dondat(TenDangNhap,MaNhanVien,TrangThai,NoiGiao,NgayDat) VALUES('".$tendangnhap."','1','".$trangthai."','".$noigiao."','".$ngaydat."')";
			
            if(mysqli_query($conn,$themDonDat)) {

                $madondat = 0;
                $layDonDat = "SELECT * FROM dondat ORDER BY MaDonDat";
                $truyvanlayDonDat = mysqli_query($conn,$layDonDat);

                while ($cotDD = mysqli_fetch_array($truyvanlayDonDat)) {
                    $madondat = $cotDD["MaDonDat"];
                }

                foreach ($_SESSION["giohang"] as $cotGH) {
                    $masp=$cotGH["masp"];
                    $soluong=$cotGH["soluong"];

                    $themCT_DonDat="INSERT INTO ct_dondat VALUES('".$madondat."','".$masp."','".$soluong."')";
                    mysqli_query($conn,$themCT_DonDat);
                }

                unset($_SESSION["giohang"]);
                echo "<script>alert('Đặt hàng thành công');location='SanPham.php';</script>";
            }
            else
            {
                echo "<script>alert('Đã xảy ra lỗi');</script>";
            }
        }
        else
        {
            echo "<script>alert('Giỏ hàng rỗng');</script>";
        }
    }
    else if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $data = json_decode(file_get_contents('php://input'), true);

    $payer_id = $data['payer']['payer_id'];
    $amount = $data['purchase_units'][0]['amount']['value'];
    $payment_id = $data['purchase_units'][0]['payments']['captures'][0]['id'];
    $create_time = $data['create_time'];
    
    $themThanhToan = "INSERT INTO thanhtoan(PayerID, Amount, PaymentID, CreateTime) VALUES(?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $themThanhToan);
    mysqli_stmt_bind_param($stmt, "ssss", $payer_id, $amount, $payment_id, $create_time);

    if(mysqli_stmt_execute($stmt)) {
        $tendangnhap=$_SESSION["tendangnhap"];
        $trangthai="0";
        $noigiao=$_POST["noigiao"];
        $ngaydat=date("Y-m-d");
        $themDonDat="INSERT INTO dondat(TenDangNhap,MaNhanVien,TrangThai,NoiGiao,NgayDat) VALUES('".$tendangnhap."','1','".$trangthai."','".$noigiao."','".$ngaydat."')";
        if(mysqli_query($conn,$themDonDat)) {
            $madondat = mysqli_insert_id($conn);
            foreach ($_SESSION["giohang"] as $cotGH) {
                $masp=$cotGH["masp"];
                $soluong=$cotGH["soluong"];
                $noigiao=$cotGH["noigiao"];
                $themCT_DonDat="INSERT INTO ct_dondat(MaDonDat, MaSanPham, SoLuong, NoiGiao) VALUES('".$madondat."','".$masp."','".$soluong."','".$noigiao."')";
                mysqli_query($conn,$themCT_DonDat);
            }
            
            unset($_SESSION["giohang"]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }

    mysqli_stmt_close($stmt);
}

// function vnd_to_usd($amount) {
//     $exchange_rate = 23000;
//     return $amount / $exchange_rate;
// }
// $tongtienUSD = vnd_to_usd($tongtienGH);
?>
<script src="https://www.paypal.com/sdk/js?client-id=AZS9LcLiTLSCBC8MzGd35FxXycwAm8nng7DfBBhaRYsvgh_pIF4nzHtazyJUp7gCzjhFiVteOxB7JOt0&currency=USD"></script>

<script>
paypal.Buttons({
    createOrder: function (data, actions) {
        var tongtienVND = <?php echo $tongtienGH; ?>;
        var tongtienUSD = tongtienVND / 23000;
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: tongtienUSD.toFixed(2)
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            fetch('<?php echo $_SERVER["PHP_SELF"]; ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(details),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Thanh toán thành công!');
                    location.reload(); 
                } else {
                    alert('Lỗi');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    }
}).render('#paypal-button');

</script>

<script>
    $(document).ready(function(){
        $('#angiohang').click(function(){
            $('#giohang').slideUp();
            $('#dathang').show();
        });
    })
</script>
<?php
include("../layout/footer.php");
?>
