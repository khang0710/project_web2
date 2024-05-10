<?php

$trangThai = '';
$start = '';
$end = '';
if (isset($_GET['trangThai'])) {
    $trangThai = $_GET['trangThai'];
} else {
    $trangThai = '';
}
if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = '';
}
if (isset($_GET['end'])) {
    $end = $_GET['end'];
} else {
    $end = '';
}

if ($trangThai != '' && $start == '' && $end == '') {
    $sql_donhang = "SELECT donhang.idDonHang, donhang.maDonHang, donhang.trangThai, khachhang.tenKhachHang, donhang.ngayTao,
    SUM(sanpham.giaBan*chitietdonhang.soLuong) AS tongGiaBan, 
    SUM(chitietdonhang.soLuong) AS tongSoLuong
    FROM chitietdonhang
    JOIN chitietsanpham AS cs1 ON chitietdonhang.idChiTietSP = cs1.idChiTietSP
    JOIN sanpham ON cs1.idSanPham = sanpham.idSanPham
    JOIN donhang ON chitietdonhang.idDonHang = donhang.idDonHang
    JOIN chitietkhachhang ON donhang.idChiTietKH = chitietkhachhang.idChiTietKH
    JOIN khachhang ON chitietkhachhang.idKhachHang = khachhang.idKhachHang
    WHERE donhang.trangThai = '" . $trangThai . "'
    GROUP BY donhang.maDonHang 
    ORDER BY donhang.idDonHang DESC";
    $query_donhang = mysqli_query($conn, $sql_donhang);
} elseif ($trangThai == '' && $start != '' && $end != '') {
    $sql_donhang = "SELECT donhang.idDonHang, donhang.maDonHang, donhang.trangThai, khachhang.tenKhachHang, donhang.ngayTao,
    SUM(sanpham.giaBan*chitietdonhang.soLuong) AS tongGiaBan, 
    SUM(chitietdonhang.soLuong) AS tongSoLuong
    FROM chitietdonhang
    JOIN chitietsanpham AS cs1 ON chitietdonhang.idChiTietSP = cs1.idChiTietSP
    JOIN sanpham ON cs1.idSanPham = sanpham.idSanPham
    JOIN donhang ON chitietdonhang.idDonHang = donhang.idDonHang
    JOIN chitietkhachhang ON donhang.idChiTietKH = chitietkhachhang.idChiTietKH
    JOIN khachhang ON chitietkhachhang.idKhachHang = khachhang.idKhachHang
    WHERE donhang.ngayTao BETWEEN '" . $start . "' AND '" . $end . "'
    GROUP BY donhang.maDonHang 
    ORDER BY donhang.idDonHang DESC";
    $query_donhang = mysqli_query($conn, $sql_donhang);
} elseif ($trangThai != '' && $start != '' && $end != '') {
    $sql_donhang = "SELECT donhang.idDonHang, donhang.maDonHang, donhang.trangThai, khachhang.tenKhachHang, donhang.ngayTao,
    SUM(sanpham.giaBan*chitietdonhang.soLuong) AS tongGiaBan, 
    SUM(chitietdonhang.soLuong) AS tongSoLuong
    FROM chitietdonhang
    JOIN chitietsanpham AS cs1 ON chitietdonhang.idChiTietSP = cs1.idChiTietSP
    JOIN sanpham ON cs1.idSanPham = sanpham.idSanPham
    JOIN donhang ON chitietdonhang.idDonHang = donhang.idDonHang
    JOIN chitietkhachhang ON donhang.idChiTietKH = chitietkhachhang.idChiTietKH
    JOIN khachhang ON chitietkhachhang.idKhachHang = khachhang.idKhachHang
    WHERE donhang.trangThai = '" . $trangThai . "' AND donhang.ngayTao BETWEEN '" . $start . "' AND '" . $end . "'
    GROUP BY donhang.maDonHang 
    ORDER BY donhang.idDonHang DESC";
    $query_donhang = mysqli_query($conn, $sql_donhang);
} else {
    $sql_donhang = "SELECT donhang.idDonHang, donhang.maDonHang, donhang.trangThai, khachhang.tenKhachHang, donhang.ngayTao,
    SUM(sanpham.giaBan*chitietdonhang.soLuong) AS tongGiaBan, 
    SUM(chitietdonhang.soLuong) AS tongSoLuong
    FROM chitietdonhang
    JOIN chitietsanpham AS cs1 ON chitietdonhang.idChiTietSP = cs1.idChiTietSP
    JOIN sanpham ON cs1.idSanPham = sanpham.idSanPham
    JOIN donhang ON chitietdonhang.idDonHang = donhang.idDonHang
    JOIN chitietkhachhang ON donhang.idChiTietKH = chitietkhachhang.idChiTietKH
    JOIN khachhang ON chitietkhachhang.idKhachHang = khachhang.idKhachHang
    GROUP BY donhang.maDonHang 
    ORDER BY donhang.idDonHang DESC";
    $query_donhang = mysqli_query($conn, $sql_donhang);
}

?>
<div style="overflow-y: auto; max-height: 600px;">
    <table border="1" cellspacing="0" width="100%">
        <form method="POST" action="modules/donhang/xuly.php" id="myForm">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày tạo đơn</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
            $i  = 0;
            while ($row = mysqli_fetch_array($query_donhang)) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $row['maDonHang'] ?></td>
                    <td><?php echo date('H:i d-m-Y', strtotime($row['ngayTao'])) ?></td>
                    <td><?php echo $row['tenKhachHang'] ?></td>
                    <td>$ <?php echo $row['tongGiaBan'] + 5 ?>.00 USD</td>
                    <td>
                        <select class="trangThai" name="trangThai" id="<?php echo $i ?>" onchange="updateInput(this,<?php echo $row['idDonHang'] ?>)">
                            <option value="<?php echo $row['trangThai'] ?>"><?php echo $row['trangThai'] ?></option>
                            <?php
                            $sql_trangthai = "SELECT * FROM trangthaidh WHERE trangThai <> '" . $row['trangThai'] . "'";
                            $query3 = mysqli_query($conn, $sql_trangthai);
                            while ($r3 = mysqli_fetch_array($query3)) {
                            ?>
                                <option value="<?php echo $r3['trangThai'] ?>"><?php echo $r3['trangThai'] ?></option>
                            <?php } ?>
                        </select>

                    </td>
                    <td>
                        <a id="a<?php echo $i ?>" href="#"> Cập nhật</a>
                        &nbsp;&nbsp; | &nbsp;&nbsp;<a href="?action=donhang&query=chitiet&idDonHang=<?php echo $row['idDonHang'] ?>"> Xem chi tiết</a>
                    </td>
                </tr>
            <?php } ?>
        </form>
    </table>
</div>

<style>
    .trangThai {
        font-size: medium;
        border: 1px solid #ccc;
        color: #5c5c5c;
        padding: 5px;
    }
</style>

<script>
    // function updateInput(select, id) {
    //     // Lấy id của select
    //     var selectId = select.id;
    //     // Lấy giá trị của select được chọn
    //     var selectedValue = select.value;

    //     document.getElementById('a' + selectId).href = 'modules/donhang/xuly.php?trangThai=' + encodeURIComponent(selectedValue) + '&id=' + id;
    // }
    function updateInput(select, id) {
    // Lấy id của select
    var selectId = select.id;
    // Lấy giá trị của select được chọn
    var selectedValue = select.value;

    document.getElementById('a' + selectId).href = 'modules/donhang/xuly.php?trangThai=' + encodeURIComponent(selectedValue) + '&id=' + id +"&tT=<?php echo $trangThai ?>"+"&start=<?php echo $start ?>"+"&end=<?php echo $end ?>";

}

</script>