<?php
if (isset($_POST['A'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    if ($start != '' && $end != '') {
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
        GROUP BY khachhang.idKhachHang 
        ORDER BY tongGiaBan DESC LIMIT 5";
        $query_donhang = mysqli_query($conn, $sql_donhang);

        $sql = "SELECT donhang.idDonHang, donhang.maDonHang, donhang.trangThai, khachhang.tenKhachHang, donhang.ngayTao,
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
    ORDER BY tongGiaBan DESC";
        $query_a = mysqli_query($conn, $sql);
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    }
}

$dataPoints = array(); // Khởi tạo mảng dataPoints trước vòng lặp
if (isset($query_donhang)) {
    while ($row = mysqli_fetch_array($query_donhang)) {
        $dataPoints[] = array("y" => $row['tongGiaBan'], "label" => $row['tenKhachHang']); // Thêm dữ liệu vào mảng dataPoints
    }
}
?>
<h3> ✩⋆｡Thống Kê</h3><br>
<form action="" method="POST">
    <label for="start"><b>Từ ngày: </b></label>
    <input type="date" id="start" name="start" value="<?php if ($start != '') echo $start ?>">

    <label for="end"><b> đến: </b></label>
    <input type="date" id="end" name="end" value="<?php if ($end != '') echo $end ?>">&emsp;&emsp;
    <button type="submit" name="A" id="btnLoc">LỌC</button>
</form><br>
<!DOCTYPE HTML>
<html>

<head>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Top khách hàng mua nhiều nhất"
                },
                axisY: {
                    minimum: 0,
                    title: "Tổng tiền (USD)"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.00 USD",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
</head>

<body>
    <div id="chartContainer" style="height: 370px; width: 80%;"></div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script><br><br>
<?php if (isset($query_a)) {
?>
    <div style="overflow-y: auto; max-height: 600px;">
    <table border="1" cellspacing="0" width="100%">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày tạo đơn</th>
                <th>Khách hàng</th>
                <th>Tổng tiền hàng</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
            $i  = 0;
            while ($row = mysqli_fetch_array($query_a)) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $row['maDonHang'] ?></td>
                    <td><?php echo date('H:i d-m-Y', strtotime($row['ngayTao'])) ?></td>
                    <td><?php echo $row['tenKhachHang'] ?></td>
                    <td>$ <?php echo $row['tongGiaBan'] ?>.00 USD</td>
                    <td><a target="_blank" href="?action=donhang&query=chitiet&idDonHang=<?php echo $row['idDonHang'] ?>"> Xem chi tiết</a></td>
                </tr>
            <?php }?>
    </table>
</div>
<?php }?>
</body>

</html>
<style>
    #start,
    #end {
        font-size: medium;
        border: 1px solid #ccc;
        color: #5c5c5c;
        padding: 5px;
    }

    #btnLoc {
        width: 150px;
        font-size: medium;
        border: 1px solid #5c5c5c;
        color: #5c5c5c;
        padding: 8px;
        background-color: white;
    }
</style>