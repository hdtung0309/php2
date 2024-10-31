<?php

include("../layout/header_admin.php");

if(!isset($_SESSION["admin"]))
    echo "<script>location='web/index.php';</script>";
global $conn;


//lấy thông tin từ các bảng
$tongSP=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM sanpham"));
$tongLSP=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM loaisp"));
$tongTV=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM thanhvien"));
$tongNV=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM nhanvien"));
$tongBL=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM binhluan"));
$tongDDH=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM dondat"));
$ddhChua=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM dondat WHERE TrangThai=0"));
$ddhDa=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM dondat WHERE TrangThai=1"));

?>


    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Trang chủ
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                        <a href="index.php">Trang chủ</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $tongBL; ?></div>
                                    <div>Bình luận</div>
                                </div>
                            </div>
                        </div>
                        <a href="BinhLuan.php">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $ddhChua; ?></div>
                                    <div>Đơn đặt hàng mới</div>
                                </div>
                            </div>
                        </div>
                        <a href="DonDatHang.php">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $tongSP; ?></div>
                                    <div>Sản phẩm</div>
                                </div>
                            </div>
                        </div>
                        <a href="SanPham.php">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $tongTV; ?></div>
                                    <div>Thành viên</div>
                                </div>
                            </div>
                        </div>
                        <a href="ThanhVien.php">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Thống kê chung</h3>
                        </div>
                        <!-- lấy các thông tin -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="SanPham.php" class="list-group-item">
                                    <span class="badge"><?php echo $tongSP; ?></span>
                                    Tổng sản phẩm
                                </a>
                                <a href="DanhMucSanPham.php" class="list-group-item">
                                    <span class="badge"><?php echo $tongLSP; ?></span>
                                    Tổng danh mục SP
                                </a>
                                <a href="ThanhVien.php" class="list-group-item">
                                    <span class="badge"><?php echo $tongTV; ?></span>
                                    Tổng thành viên
                                </a>
                                <a href="NhanVien.php" class="list-group-item">
                                    <span class="badge"><?php echo $tongNV; ?></span>
                                    Tổng nhân viên
                                </a>
                                <a href="BinhLuan.php" class="list-group-item">
                                    <span class="badge"><?php echo $tongBL; ?></span>
                                    Tổng bình luận
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Thống kê mua bán</h3>
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="DonDatHang.php" class="list-group-item">
                                    <span class="badge"><?php echo $tongDDH; ?></span>
                                    Tổng đơn đặt hàng
                                </a>
                                <a href="DonDatHang.php" class="list-group-item">
                                    <span class="badge"><?php echo $ddhDa; ?></span>
                                    Tổng đơn đặt hàng đã giao
                                </a>
                                <a href="DonDatHang.php" class="list-group-item">
                                    <span class="badge"><?php echo $ddhChua; ?></span>
                                    Tổng đơn đặt hàng chưa giao
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include("../layout/footer_admin.php");

?>