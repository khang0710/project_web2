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
    $id = $_SESSION['dangNhapKH'];
    if (isset($_SESSION['dangNhapKH'])) {
        $id = $_SESSION['dangNhapKH'];
    } else {
        header("location:../../pages/Login.php");
    } //Kiem tra co khach hang Dang Nhap
    $sql = "SELECT * FROM khachhang WHERE idKhachHang = '" . $id . "' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $id = $row['idKhachHang']; //Lay thong tin khach hang

    $sql_listDC = "SELECT * FROM `chitietkhachhang` WHERE idKhachHang = '" . $id . "'";
    $query_listDC = mysqli_query($conn, $sql_listDC); //Lay cac dia chi cua KH

    if (isset($_POST['themDiaChi'])) { //Them dia chi moi
        $soDienThoai = $_POST['sdt'];
        $diaChi = $_POST['diachi'];
        $sql_diachi = "INSERT INTO `chitietkhachhang`(`idKhachHang`, `soDienThoai`, `diaChi`, `trangThai`) VALUES ('" . $id . "','" . $soDienThoai . "','" . $diaChi . "','1')";
        mysqli_query($conn, $sql_diachi);
        header("location:order.php");
    }

    if (isset($_POST['themDonHang'])) {
        $idChiTietKH = $_POST['idChiTietKH'];
        $maDonHang = $_POST['maDonHang'];
        $phuongThuc = $_POST['phuongThuc'];
        $sql_donhang = "INSERT INTO `donhang`(`idChiTietKH`, `maDonHang`, phuongThuc, `trangThai`, ngayTao) VALUES ('" . $idChiTietKH . "','" . $maDonHang . "', '" . $phuongThuc . "','Chờ xác nhận', NOW())";
        mysqli_query($conn, $sql_donhang);
        $sql_select_id = "SELECT idDonHang FROM donhang WHERE maDonHang = '" . $maDonHang . "' LIMIT 1";
        $result = mysqli_query($conn, $sql_select_id);
        $row = mysqli_fetch_assoc($result);
        $idDH = $row['idDonHang'];
        if (isset($_SESSION['cart']) && $idDH) {
            foreach ($_SESSION['cart'] as $cart_item) {
                $sql_chitiet = "INSERT INTO `chitietdonhang`(`idDonHang`, `idChiTietSP`, `soLuong`) VALUES ('" . $idDH . "','" . $cart_item['idct'] . "'," . $cart_item['soLuong'] . ")";
                mysqli_query($conn, $sql_chitiet);

                $sql_update_soluong = "UPDATE chitietsanpham SET soLuong = soLuong - '" . $cart_item['soLuong'] . "' WHERE idChiTietSP = '" . $cart_item['idct'] . "'";
                mysqli_query($conn, $sql_update_soluong);

            }
            unset($_SESSION['cart']);
                echo "<script>alert('Đặt hàng thành công!\\nBạn có thể xem lại đơn hàng ở phần thông tin tài khoản!');</script>";
                $url = '../../pages/User.php';
                echo "<script>window.location.href = '../../pages/User.php';</script>";
        }
        //header("location:index.php");
    }

    function generateRandomCode()
    {
        $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        $length = strlen($characters);
        for ($i = 0; $i < 8; $i++) {
            $code .= $characters[rand(0, $length - 1)];
        }
        return $code;
    }

    // Sử dụng hàm để tạo mã ngẫu nhiên
    $random_code = generateRandomCode();
    ?>
    <form action="" method="POST" onsubmit="return validateForm()">
        <div class="main">
            <div class="infor">
                <div class="title">COTTAGECORE SHOP</div>
                <a href="index.php">Giỏ hàng</a> > Thông tin giao hàng <br><br>
                <h3>• Thông Tin Giao Hàng</h3><br>
                <table width="80%">
                    <th><img src="../../image/logo.jpg" width="50px"></th>
                    <td class="td1"><?php echo $row['tenKhachHang'] . " (" . $row['email'] . ")" ?></td>
                </table>

                <div class="small-title">Họ tên</div>
                <input type="text" class="input" readonly value="<?php echo $row['tenKhachHang'] ?>"><br><br>

                <div class="small-title">Thông tin nhận hàng</div>
                <div class="combo">
                    <?php while ($row_listDC = mysqli_fetch_array($query_listDC)) { ?>
                        <input type="radio" name="idChiTietKH" id="idChiTietKH" value="<?php echo $row_listDC['idChiTietKH'] ?>" checked>
                        &ensp; Địa chỉ: <?php echo $row_listDC['diaChi'] ?><br><br>
                        &emsp;&ensp; SĐT: <?php echo $row_listDC['soDienThoai'] ?> <br><br>
                    <?php } ?>
                </div><br>
                <div id="div1" style="display: block;">
                    <button id="btnThem" type="button">Thêm Địa Chỉ</button>
                </div>
                <div id="div2" style="display: none;">
                    <div class="small-title">Số điện thoại</div>
                    <input type="text" class="input" name="sdt"><br>
                    <div class="small-title">Địa chỉ</div>
                    <input type="text" class="input" name="diachi"><br><br>
                    <button onclick="changeValue()" id="btnLuu" type="submit" name="themDiaChi">Lưu</button>
                </div><br>
                <h3>• Phương Thức Thanh Toán</h3>
                <div class="pay">
                    <input type="radio" name="phuongThuc" value="Thanh toán khi nhận hàng" checked> Thanh toán khi nhận hàng</input><br><br>
                    <input type="radio" name="phuongThuc" value="Chuyển tiền qua tài khoản ngân hàng"> Chuyển tiền qua tài khoản ngân hàng</input>
                </div>
            </div>

            <div class="product">
                <b>Mã Đơn Hàng: </b> <?php echo $random_code ?><br><br>
                <input type="hidden" name="maDonHang" value="<?php echo $random_code ?>">
                <table class="tb" cellspacing="0" width="100%">
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $tong = 0;
                        foreach ($_SESSION['cart'] as $cart_item) {
                            $tongO = $cart_item['giaBan'] * $cart_item['soLuong'];
                            $tong += $tongO;
                    ?>
                            <tr>
                                <td width="60px"><img src="../../admin/modules/sanpham/uploads/<?php echo $cart_item['hinhAnh'] ?>" width="50px"></td>
                                <td>
                                    <b><?php echo $cart_item['tenSanPham'] ?></b><br>
                                    Phân loại: <?php echo $cart_item['mauSac'] ?>/<?php echo $cart_item['kichCo'] ?>
                                </td>
                                <td>x<?php echo $cart_item['soLuong'] ?></td>
                                <td style="text-align: right;">$<?php echo $cart_item['giaBan'] ?>.00</td>
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
                            <td class="tong" style="text-align: right;">$<?php echo $tong + 5 ?>.00 USD</td>
                        </tr>
                    <?php } ?>
                </table>
                <button id="btnDatHang" name="themDonHang">ĐẶT HÀNG</button>
            </div>
        </div>
    </form>

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
        document.addEventListener("DOMContentLoaded", function() {
            var btnThem = document.getElementById("btnThem");
            var btnLuu = document.getElementById("btnLuu");

            btnThem.addEventListener("click", function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của button
                var div1 = document.getElementById("div1");
                var div2 = document.getElementById("div2");

                if (div1.style.display === "block") {
                    div1.style.display = "none";
                    div2.style.display = "block";
                }
            });
        });

        function changeValue() {
            var input = document.createElement("input");
            input.type = "hidden";
            input.id = "idChiTietKH";
            input.value = "0";
            document.body.appendChild(input);
        }

        function validateForm() {
            var idElement = document.getElementById("idChiTietKH");

            if (idElement) {
                var id = idElement.value;
                if (id == "") {
                    alert("Vui lòng nhập đầy đủ thông tin!");
                    return false; // Ngăn không gửi biểu mẫu
                }
            } else {
                alert("Vui lòng nhập đầy đủ thông tin!");
                return false; // Ngăn không gửi biểu mẫu
            }
        }
    </script>
</body>

</html>