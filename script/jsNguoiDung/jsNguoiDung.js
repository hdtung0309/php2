function timkiem_sanpham(gia , loaisp)
{
    $.ajax({
        url:"ajax/TimKiemAjax.php",
        type:"POST",
        data:{
            gia:gia,
            loaisp:loaisp
        },
        success:function(giatri) {
            $('#loadSP').html(giatri);
        }

    });
}

function ThemGioHang(masanpham,soluong)
{
    $.ajax({
        url:"ajax/ThemGioHang.php",
        type:"POST",
        data:{
            masanpham:masanpham,
            soluong:soluong
        },
        success:function(giatri) {
            $('.divgiohang').html(giatri);
        }

    });
}

function SuaGioHang(masanpham,soluong)
{
    $.ajax({
        url:"ajax/SuaGioHang.php",
        type:"POST",
        data:{
            masanpham:masanpham,
            soluong:soluong
        },
        success:function(giatri) {
            $('.in-check').html(giatri);
        }

    });
}

function XoaGioHang(masanpham)
{
    $.ajax({
        url:"ajax/XoaGioHang.php",
        type:"POST",
        data:{
            masanpham:masanpham
        },
        success:function(giatri) {
            $('.in-check').html(giatri);
        }

    });
}


