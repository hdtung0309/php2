<?php
include("../layout/header.php");

global $conn;


$laySP="SELECT * FROM sanpham ORDER BY SoLuong DESC LIMIT 0,8";
$truyvan_laySP=mysqli_query($conn,$laySP);

?>

<!-- slider -->
<div class="bnr" id="home">
        <ul class="rslides" id="slider4">
            <li>
                <div class="banner1"><a href=""><img src="../images/banner1.jpg"/></a></div>
            </li>
            <li>
                <div class="banner2"><a href=""><img src="../images/banner2.jpg"/></a></div>
            </li>
            <li>
                <div class="banner3"><a href=""><img src="../images/banner3.jpg"/></a></div>
            </li>
        </ul>
    <div class="clearfix"> </div>
</div>

<script src="../script/jsNguoiDung/responsiveslides.min.js"></script>
<script>

    $(function () {
        $("#slider4").responsiveSlides({
            auto: true,
            pager: true,
            nav: false,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
</script>
<!-- lấy thông tin sản phẩm -->
<div class="shoes">
    <div class="container">
        <div class="product-one"></div>
            <?php
            $i=0;
            while($cot=mysqli_fetch_array($truyvan_laySP))
                {
                    $i++;
            ?>
                <div class="product-one">
                    <div class="col-md-3 product-left">
                        <div class="p-one simpleCart_shelfItem">
                            <a href="ChiTietSanPham.php?MaSP=<?php echo $cot["MaSanPham"]; ?>">
                                <img height="250" src="../images/HinhSP/<?php echo $cot["Anh"]; ?>" alt="" />
                                <div class="mask">
                                    <span>Xem chi tiết</span>
                                </div>
                            </a>
                            <h4><?php echo $cot["TenSanPham"]; ?></h4>
                            <p><a class="item_add" href="#"><i></i> <span class=" item_price"> <?php echo GiaTien($cot["DonGia"]); ?> VNĐ</span></a></p>
                        </div>
                    </div>
                </div>
                    <?php
                            if($i%4==0)
                            { ?>
                            <div class="clearfix"></div>
                        <?php
                            }
                }
                    ?>
    </div>
</div>

<div class="abt-shoe1">
    <div class="container">
        <div class="abt-shoe-main">
            <div class="col-md-4 abt-shoe-left">
                <div class="abt-one">
                    <img src="../images/dia1.jpg" alt="" />
                    <p>Liên tục cập nhật các sản phẩm đĩa mới nhất từ nghệ sĩ trong nước, us-uk,...</p>
                    <p></p>
                </div> 
            </div>
            <div class="col-md-4 abt-shoe-left">
                <div class="abt-one">
                    <img src="../images/mam1.jpg" alt="" />
                    <p>Các sản phẩm mâm đĩa chất lượng ổn định nhất, bền bỉ, mang tới âm thanh trung thực</p>
                    <p></p>
                </div>
            </div>
            <div class="col-md-4 abt-shoe-left">
                <div class="abt-one">
                    <img src="../images/loa1.jpg" alt="" />
                    <p>Never gonna give you up Never gonna let you down Never gonna run around and desert you</p>
                    <p1>Never gonna make you cry Never gonna say goodbye Never gonna tell a lie and hurt you</p1>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>


<?php
include("../layout/footer.php");
?>
