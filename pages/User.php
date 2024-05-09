<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CottageCore</title>
    <link rel="stylesheet" type="text/css" href="../css/TrangChu.css">
    <link rel="stylesheet" type="text/css" href="../css/User.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
    session_start();
    include("../admin/config/connetMySQL.php");
    $id = $_SESSION['dangNhapKH'];
    if (isset($_SESSION['dangNhapKH'])) {
        print($_SESSION['dangNhapKH']);
        $id = $_SESSION['dangNhapKH'];
    } else {
        header("location:Login.php");
    }
    $sql = "SELECT * FROM khachhang WHERE idKhachHang = '" . $id . "' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $id = $row['idKhachHang'];
    $sql_listDC = "SELECT * FROM `chitietkhachhang` WHERE idKhachHang = '" . $id . "'";
    $query_listDC = mysqli_query($conn, $sql_listDC);

    if (isset($_POST['themDiaChi'])) {
        $soDienThoai = $_POST['sdt'];
        $diaChi = $_POST['diachi'];
        if($soDienThoai != '' && $diaChi != '') {
        $sql_diachi = "INSERT INTO `chitietkhachhang`(`idKhachHang`, `soDienThoai`, `diaChi`, `trangThai`) VALUES ('" . $id . "','" . $soDienThoai . "','" . $diaChi . "','1')";
        mysqli_query($conn, $sql_diachi);}
        header("location:User.php");
    }

    $sql_donhang = "SELECT donhang.idDonHang, donhang.maDonHang, donhang.trangThai, donhang.ngayTao,
    SUM(sanpham.giaBan*chitietdonhang.soLuong) AS tongGiaBan, 
    SUM(chitietdonhang.soLuong) AS tongSoLuong
    FROM chitietdonhang
    JOIN chitietsanpham cs1 ON chitietdonhang.idChiTietSP = cs1.idChiTietSP
    JOIN sanpham ON cs1.idSanPham = sanpham.idSanPham
    JOIN donhang ON chitietdonhang.idDonHang = donhang.idDonHang
    JOIN chitietkhachhang ON donhang.idChiTietKH = chitietkhachhang.idChiTietKH
    JOIN khachhang ON chitietkhachhang.idKhachHang = khachhang.idKhachHang
    WHERE khachhang.idKhachHang = '".$id."'
    GROUP BY donhang.maDonHang ORDER BY donhang.idDonHang DESC";
    $query_donhang = mysqli_query($conn, $sql_donhang);
    include("../pages/page_item/header.php");
    ?>
    <div class="main">
        <div class="title">
            <div class="small-list">Thông tin</div>
            <h3>Tài khoản của tôi</h3>
            <br><br>
            Xin chào, <?php echo $row['tenKhachHang'] ?> !
            <br><br>
            Email: <?php echo $row['email'] ?>
            <br><br><br><br>
            <a href="Login.php?action=dangxuat">→ Đăng xuất</a>
            <br><br><br>
        </div>
        <div class="content">
            <div class="order-list">
                <div class="small-list">Đơn hàng của tôi</div>
                <div class="line"></div>

                <table class="tb" cellspacing="0" width="100%">
                    <?php 
                    while ($row_donhang = mysqli_fetch_array($query_donhang)){
                        $sql_sanpham = "SELECT sanpham.tenSanPham, sanpham.giaBan, chitiet.mauSac, chitiet.kichCo, chitietdonhang.soLuong, sanpham.hinhAnh
                        FROM chitietdonhang
                        JOIN chitietsanpham AS chitiet ON chitietdonhang.idChiTietSP = chitiet.idChiTietSP
                        JOIN sanpham ON chitiet.idSanPham = sanpham.idSanPham
                        JOIN donhang ON chitietdonhang.idDonHang = donhang.idDonHang
                        WHERE donhang.maDonHang = '".$row_donhang['maDonHang']."'
                        LIMIT 1
                        ;";
                        $query_sanpham = mysqli_query($conn, $sql_sanpham);
                        $row_sp = mysqli_fetch_assoc($query_sanpham);
                    ?>
                    <tr>
                        <td width="70px"><img src="../admin/modules/sanpham/uploads/<?php echo $row_sp['hinhAnh'] ?>" width="60px" style="margin-top: 10px;"></td>
                        <td>
                            <b>Mã đơn hàng: </b><?php echo $row_donhang['maDonHang'] ?><br><br>
                            <b><?php echo $row_sp['tenSanPham'] ?></b><br>
                            Phân loại: <?php echo $row_sp['mauSac'] ?>/<?php echo $row_sp['kichCo'] ?>
                        </td>
                        <td>x<?php echo $row_sp['soLuong'] ?></td>
                        <td style="text-align: right;">$<?php echo $row_sp['giaBan'] ?>.00</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $row_donhang['tongSoLuong'] ?> sản phẩm
                        <td><a href="../collection/cart/chitietdonhang.php?idDonHang=<?php echo $row_donhang['idDonHang']?>"><b>Xem chi tiết</b></a></td>
                        <td style="text-align: right; color: green;"><?php echo $row_donhang['trangThai'] ?></td>
                    </tr>
                    <tr>
                        <td class="tong" colspan="2">Tổng cộng</td>
                        <td class="tong" colspan="2" style="text-align: right;">$<?php echo $row_donhang['tongGiaBan']+5 ?>.00 USD</td>
                    </tr>
                    <?php } ?>
                </table>

            </div>
            <div class="address">
                <div class="small-list">Thông tin nhận hàng</div>
                <div class="line"></div>
                <br>
                <div id="div1" style="display: block; font-size:smaller">
                    <b>Địa chỉ:</b><br><br>
                    <?php
                    while ($row_listDC = mysqli_fetch_array($query_listDC)) {
                    ?>
                        <?php echo "• " . $row_listDC['diaChi']; ?><br>
                        &nbsp;&nbsp;&nbsp;SĐT: <?php echo $row_listDC['soDienThoai'] ?>
                        <br><br>
                    <?php } ?>
                    <button type="submit" id="btnDiaChi" onclick="btnThem()">THÊM ĐỊA CHỈ</button>
                </div>
                <form action="" method="POST">
                    <div id="div2" style="display: none;">
                        <button onclick="btnHuy()" id="btnHuy">Hủy</button>
                        *Số điện thoại:
                        <input type="text" class="inputDiaChi" name="sdt"><br><br>
                        *Địa chỉ:
                        <input type="text" class="inputDiaChi" name="diachi"><br><br>
                        <button type="submit" name="themDiaChi" id="btnDiaChi">LƯU</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include("../pages/page_item/footer.php");
    ?>

    <script>
        function btnThem() {
            var div1 = document.getElementById("div1");
            var div2 = document.getElementById("div2");

            if (div1.style.display === "block") {
                div1.style.display = "none";
                div2.style.display = "block";
            }
        }

        function btnHuy() {
            var div1 = document.getElementById("div1");
            var div2 = document.getElementById("div2");

            if (div2.style.display === "block") {
                div2.style.display = "none";
                div1.style.display = "block";
            }
        }
    </script>
</body>

</html>