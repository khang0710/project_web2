<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/Order.css">
</head>

<body>
    <?php
    session_start();
    include("../../admin/config/connetMySQL.php");
    $idDonHang = $_GET['idDonHang'];
    $id = $_SESSION['dangNhapKH'];
    $sql = "SELECT 
	donhang.maDonHang, donhang.phuongThuc, donhang.ngayTao, donhang.trangThai, khachhang.tenKhachHang, khachhang.email, chitietkhachhang.soDienThoai, chitietkhachhang.diaChi
    FROM donhang
    JOIN chitietkhachhang ON donhang.idChiTietKH = chitietkhachhang.idChiTietKH
    JOIN khachhang ON chitietkhachhang.idKhachHang = khachhang.idKhachHang
    WHERE donhang.idDonHang = '".$_GET['idDonHang']."'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    $sql_list = "SELECT sanpham.tenSanPham, sanpham.giaBan, chitiet.mauSac, chitiet.kichCo, chitietdonhang.soLuong, sanpham.hinhAnh
    FROM chitietdonhang
    JOIN chitietsanpham AS chitiet ON chitietdonhang.idChiTietSP = chitiet.idChiTietSP
    JOIN sanpham ON chitiet.idSanPham = sanpham.idSanPham
    JOIN donhang ON chitietdonhang.idDonHang = donhang.idDonHang
    WHERE donhang.idDonHang = '".$_GET['idDonHang']."'";
    $query_list = mysqli_query($conn, $sql_list);
    ?>
    <div class="main">
        <div class="infor">
            
            <div class="title"><img src="../../image/logo.jpg" width="40px"> &ensp; COTTAGECORE SHOP</div>
            <a href="../../pages/User.php">Tài khoản</a> > Chi tiết đơn hàng <br><br>
            <h3>• Thông Tin Giao Hàng</h3><br>
            <div class="small-title">Họ tên</div>
            <input type="text" class="input" readonly value="<?php echo $row['tenKhachHang'] ?>"><br>
            <div class="small-title">Địa chỉ</div>
            <input type="text" class="input" readonly value="<?php echo $row['diaChi'] ?>"><br>
            <div class="small-title">Số điện thoại</div>
            <input type="text" class="input" readonly value="<?php echo $row['soDienThoai'] ?>"><br>
            <div class="small-title">Phương thức thanh toán</div>
            <input type="text" class="input" readonly value="<?php echo $row['phuongThuc'] ?>"><br>
            <div class="small-title">Trạng thái</div>
            <input type="text" class="input" readonly value="<?php echo $row['trangThai'] ?>"><br><br><br>

        </div>

        <div class="product">
            <b>Mã Đơn Hàng: </b> <?php echo $row['maDonHang'] ?><br>
            <small>Ngày đặt hàng: <?php echo date('d-m-Y', strtotime($row['ngayTao'])) ?></small><br><br>
            <table class="tb" cellspacing="0" width="100%">
                <?php
                $tong = 0;
                while ($item = mysqli_fetch_array($query_list)) {
                    $tongO = $item['giaBan'] * $item['soLuong'];
                        $tong += $tongO;
                ?>
                        <tr>
                            <td width="60px"><img src="../../admin/modules/sanpham/uploads/<?php echo $item['hinhAnh'] ?>" width="50px"></td>
                            <td>
                                <b><?php echo $item['tenSanPham'] ?></b><br>
                                Phân loại: <?php echo $item['mauSac'] ?>/<?php echo $item['kichCo'] ?>
                            </td>
                            <td>x<?php echo $item['soLuong'] ?></td>
                            <td style="text-align: right;">$<?php echo $item['giaBan'] ?>.00</td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="3">Tổng tiền hàng:<br><br>
                            Phí vận chuyển:</td>
                        <td style="text-align: right;">$<?php echo $tong ?>.00<br><br>
                            $5.00</td>
                    </tr>
                    <tr>
                        <td class="tong" colspan="3">Tổng cộng</td>
                        <td class="tong" style="text-align: right;">$<?php echo $tong+5 ?>.00 USD</td>
                    </tr>
            </table>
        </div>
    </div>
</body>

</html>