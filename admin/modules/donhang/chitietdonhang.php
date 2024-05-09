<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/CottagecoreWeb/admin/css/chitietdonhang.css">
</head>

<body>
    <?php
    //include("../../admin/config/connetMySQL.php");
    $idDonHang = $_GET['idDonHang'];
    $sql = "SELECT 
	donhang.maDonHang, donhang.phuongThuc, donhang.trangThai, khachhang.tenKhachHang, khachhang.email, chitietkhachhang.soDienThoai, chitietkhachhang.diaChi
    FROM donhang
    JOIN chitietkhachhang ON donhang.idChiTietKH = chitietkhachhang.idChiTietKH
    JOIN khachhang ON chitietkhachhang.idKhachHang = khachhang.idKhachHang
    WHERE donhang.idDonHang = '" . $_GET['idDonHang'] . "'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    $sql_list = "SELECT sanpham.tenSanPham, sanpham.giaBan, chitiet.mauSac, chitiet.kichCo, chitietdonhang.soLuong, sanpham.hinhAnh
    FROM chitietdonhang
    JOIN chitietsanpham AS chitiet ON chitietdonhang.idChiTietSP = chitiet.idChiTietSP
    JOIN sanpham ON chitiet.idSanPham = sanpham.idSanPham
    JOIN donhang ON chitietdonhang.idDonHang = donhang.idDonHang
    WHERE donhang.idDonHang = '" . $_GET['idDonHang'] . "'";
    $query_list = mysqli_query($conn, $sql_list);
    ?>
    <div class="main">
    <a href="index.php?action=donhang&query=lietke"><button style="float: right;" class="button-a" type="button">
                <h3>Quay lại</h3>
            </button></a>
        <h3> ✩⋆｡Mã Đơn Hàng: <?php echo $row['maDonHang'] ?></h3><br>
        <h3>• Thông Tin Khách Hàng</h3><br>
        &emsp;&emsp;<b>Họ tên: </b><?php echo $row['tenKhachHang'] ?><br><br>
        &emsp;&emsp;<b>Địa chỉ: </b><?php echo $row['diaChi'] ?><br><br>
        &emsp;&emsp;<b>Số điện thoại: </b><?php echo $row['soDienThoai'] ?><br><br>
        &emsp;&emsp;<b>Phương thức thanh toán: </b><?php echo $row['phuongThuc'] ?><br><br>
        <form action="modules/donhang/xuly.php" method="POST">
        &emsp;&emsp;<b>Trạng thái:</b>
        <select class="trangThai" name="trangThai">
            <option value="<?php echo $row['trangThai'] ?>"><?php echo $row['trangThai'] ?></option>
            <?php
            $sql_trangthai = "SELECT * FROM trangthaidh WHERE trangThai <> '" . $row['trangThai'] . "'";
            $query3 = mysqli_query($conn, $sql_trangthai);
            while ($r3 = mysqli_fetch_array($query3)) {
            ?>
                <option value="<?php echo $r3['trangThai'] ?>"><?php echo $r3['trangThai'] ?></option>
            <?php } ?>
        </select>&emsp;
        <input type="hidden" name="id" value="<?php echo $idDonHang ?>">
        <button class="btnCN" type="submit" name="capNhat">Cập nhật</button></form>
        <br><br>

        <h3>• Chi Tiết Sản Phẩm</h3><br>
        <table border="1" cellspacing="0" width="100%" style="font-size:small;">
            <form method="POST" action="modules/danhmuc/xuly.php">
                <tr>
                    <th>STT</th>
                    <th width="50px">HÌNH ẢNH</th>
                    <th>TÊN</th>
                    <th>PHÂN LOẠI</th>
                    <th>SỐ LƯỢNG</th>
                    <th>GIÁ BÁN</th>
                    <th>TỔNG</th>
                </tr>
                <?php
                $tong = 0;
                $i = 0;
                while ($item = mysqli_fetch_array($query_list)) {
                    $i++;
                    $tongO = $item['giaBan'] * $item['soLuong'];
                    $tong += $tongO;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><img src="modules/sanpham/uploads/<?php echo $item['hinhAnh'] ?>" width="60px" style="margin-right: 10px;"></td>
                        <td><?php echo $item['tenSanPham'] ?></td>
                        <td><?php echo $item['mauSac'] ?>/<?php echo $item['kichCo'] ?></td>
                        <td>x<?php echo $item['soLuong'] ?></td>
                        <td>$<?php echo $item['giaBan'] ?>.00</td>
                        <td style="text-align: right;">$<?php echo $tongO ?>.00</td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="6">Tổng tiền hàng:<br><br>
                        Phí vận chuyển:</td>
                    <td style="text-align: right;">$<?php echo $tong ?>.00<br><br>
                        $5.00</td>
                </tr>
                <tr>
                    <td class="tong" colspan="6">&emsp;Tổng cộng</td>
                    <td class="tong" style="text-align: right;">$<?php echo $tong + 5 ?>.00 USD</td>
                </tr>
        </table>
    </div>
</body>

</html>

<style>
    .trangThai {
        font-size: medium;
        border: 1px solid #ccc;
        color: #5c5c5c;
        padding: 5px;
    }

    .btnCN{
    font-size: small;
    background-color: white;
    color: #5c5c5c;
    padding: 10px 5px;
    border: 0.5px solid #ccc;
    margin: 0;
    width: 100px;
    text-align: center;
}
</style>