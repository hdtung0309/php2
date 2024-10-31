<?php 
session_start();
function GiaTien($dongia) //1000000
{
    $sResult = $dongia;
    for ( $i = 3; $i < strlen($sResult); $i += 4)
    {
        $sSau = substr($sResult,strlen($sResult) - $i); // 000.000
        $sDau = substr($sResult,0, strlen($sResult) - $i); // 1
        $sResult = $sDau . "." . $sSau; // 1.000.000
    }
    return $sResult;
}
if (isset($_SESSION["giohang"]) && is_array($_SESSION["giohang"]) && !empty($_SESSION["giohang"])) {
    $giohangdaco = array();
    foreach ($_SESSION["giohang"] as $cotGH) {
        if ($cotGH["masp"] != $_POST["masanpham"]) {
            $giohangdaco[] = array(
                "masp" => $cotGH["masp"],
                "hinhsp" => $cotGH["hinhsp"],
                "tensp" => $cotGH["tensp"],
                "soluong" => $cotGH["soluong"],
                "dongia" => $cotGH["dongia"]
            );
        }
    }
    $_SESSION["giohang"] = $giohangdaco;
}

if(count($_SESSION["giohang"])==0)
{
    unset($_SESSION["giohang"]);
    echo "<script>location='SanPham.php';</script>";
}
else
{
?>


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
foreach($_SESSION["giohang"] as $cotGH) {
    ?>
    <ul class="cart-header">
        <div class="close1" onclick="XoaGioHang(<?php echo $cotGH["masp"] ?>)"></div>
        <li class="ring-in"><a href="ChiTietSanPham.php?MaSP=<?php echo $cotGH["masp"]; ?>"><img width="100"
                                                                                                 src="../images/HinhSP/<?php echo $cotGH["hinhsp"]; ?>"
                                                                                                 class="img-responsive"
                                                                                                 alt=""></a>
        </li>
        <li><span><?php echo $cotGH["tensp"]; ?></span></li>
        <li>
                            <span>
                                 <select id="soluongdat"
                                         onchange="SuaGioHang(<?php echo $cotGH["masp"]; ?>,$(this).val());">
                                     <?php for ($i = 1; $i < 7; $i++) {
                                         if ($cotGH["soluong"] == $i) {
                                             ?>
                                             <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                         <?php } else { ?>
                                             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                         <?php
                                         }
                                     }
                                     ?>

                                 </select>
                            </span>
        </li>
        <li><span><?php echo GiaTien($cotGH["dongia"]); ?></span></li>
        <li><span><?php echo GiaTien($cotGH["dongia"] * $cotGH["soluong"]); ?></span></li>
        <div class="clearfix"></div>
    </ul>
<?php
}
}
?>
