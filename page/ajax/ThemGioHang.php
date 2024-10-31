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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vinylhanoi1";
$conn = mysqli_connect($servername, $username, $password, $dbname);
	
if(!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
mysqli_query($conn,"set names utf8");

$laySanPham="SELECT * FROM sanpham WHERE MaSanPham='".$_POST["masanpham"]."'";
$truyvanlaySanPham=mysqli_query($conn,$laySanPham);
$cot=mysqli_fetch_array($truyvanlaySanPham);

$giohangmoi=array(array("masp"=>$cot["MaSanPham"],"hinhsp"=>$cot["Anh"],"tensp"=>$cot["TenSanPham"],"soluong"=>$_POST["soluong"],"dongia"=>$cot["DonGia"])); // Khởi tạo giỏ hàng mới 

if(isset($_SESSION["giohang"])) // Kiểm tra giohang có đang tồn tại không
{
    $themspmoi=false;

    foreach($_SESSION["giohang"] as $cotGH) //với mỗi bản ghi trong giỏ hàng
    {
        if($cotGH["masp"]==$_POST["masanpham"])
        {
           $soluongdat = $cotGH["soluong"] + $_POST["soluong"];
            if($soluongdat>6)
            {
                $giohangdaco[]=["masp"=>$cotGH["masp"],"hinhsp"=>$cotGH["hinhsp"],"tensp"=>$cotGH["tensp"],"soluong"=>$cotGH["soluong"],"dongia"=>$cotGH["dongia"]];
                echo "<script>alert('Số lượng đặt vượt quá giới hạn cho phép');</script>";
            }
            else
            {
                $giohangdaco[]=array("masp"=>$cotGH["masp"],"hinhsp"=>$cotGH["hinhsp"],"tensp"=>$cotGH["tensp"],"soluong"=>$soluongdat,"dongia"=>$cotGH["dongia"]);
            }
            $themspmoi=true;
        }
        else
        {
            $giohangdaco[]=array("masp"=>$cotGH["masp"],"hinhsp"=>$cotGH["hinhsp"],"tensp"=>$cotGH["tensp"],"soluong"=>$cotGH["soluong"],"dongia"=>$cotGH["dongia"]);
        }
    }

    if($themspmoi==false)
    {
        $_SESSION["giohang"]=array_merge($giohangdaco,$giohangmoi);
    }
    else
    {
        $_SESSION["giohang"]=$giohangdaco;
    }

}
else
{
    $_SESSION["giohang"]=$giohangmoi;
}

$tongsp=0;
$tongtien=0;
foreach($_SESSION["giohang"] as $cotGH)
{
    $tongsp++;
    $tongtien+=$cotGH["dongia"]*$cotGH["soluong"]; //tính tongtien
}

?>



<div class="cart box_1">
    <a href="GioHang.php">
        <h3> <div class="total">
                <span > <?php echo GiaTien($tongtien); ?> VNĐ</span> (<span id="simpleCart_quantity" > <?php echo $tongsp; ?> </span> SP)</div>
            <img src="../images/cart-1.png" alt="" />
    </a>
    <p><a href="SanPham.php?moiGH=0"  class="simpleCart_empty">Làm mới</a></p>
    <div class="clearfix"> </div>
</div>