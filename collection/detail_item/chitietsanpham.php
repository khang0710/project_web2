<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CottageCore</title>
    <link rel="stylesheet" type="text/css" href="../../css/TrangChu.css">
    <link rel="stylesheet" type="text/css" href="../css/Detail_item.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
    include("../../admin/config/connetMySQL.php");
    include("../header.php");
    ?>

    <?php
    $sql_lay_sanpham = "SELECT * FROM sanpham WHERE idSanPham ='$_GET[id]' LIMIT 1";
    $query = mysqli_query($conn, $sql_lay_sanpham);

    $row = mysqli_fetch_assoc($query);
    ?>
    <form method="POST" action="http://localhost/CottagecoreWeb/collection/cart/themgiohang.php?idsanpham=<?php echo $row['idSanPham'] ?>" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="product">
            <div class="product_img">
                <img src="../../admin/modules/sanpham/uploads/<?php echo $row['hinhAnh'] ?>">
                <input type="hidden" name="hinhAnh" value="<?php echo $row['hinhAnh']; ?>">
            </div>

            <div class="product_info">
                <h3><?php echo $row['tenSanPham'] ?></h3>
                <br>
                <div class="cost">&nbsp; $<?php echo $row['giaBan'] ?>.00 USD</div>
                <input type="hidden" name="giaBan" value="<?php echo $row['giaBan']; ?>">
                <br><br>
                <div class="seLect">
                    Màu sắc:
                    <?php
                    $sql_mau = "SELECT mauSac FROM `chitietsanpham` WHERE idSanPham = '$_GET[id]' GROUP BY mauSac";
                    $query2 = mysqli_query($conn, $sql_mau);
                    ?>
                    <br>
                    <?php
                    $i = 0;
                    while ($r_mau = mysqli_fetch_array($query2)) {
                        $i++;
                    ?>
                        <div class="button">
                            <input type="radio" id="<?php echo $r_mau['mauSac'] ?>" name="mauSac" value="<?php echo $r_mau['mauSac'] ?>" />
                            <label class="btn btn-default" for="<?php echo $r_mau['mauSac'] ?>"><?php echo $r_mau['mauSac'] ?></label>
                        </div>
                    <?php } ?>
                    <br><br>
                    Size:
                    <?php
                    $sql_kichco = "SELECT kichCo FROM `chitietsanpham` WHERE idSanPham = '$_GET[id]' GROUP BY kichCo ORDER BY FIELD(kichCo, 'S', 'M', 'L', 'XL', '2XL')";
                    $query3 = mysqli_query($conn, $sql_kichco);
                    ?>
                    <br>
                    <?php
                    $i = 0;
                    while ($r_kichCo = mysqli_fetch_array($query3)) {
                        $i++;
                    ?>
                        <div class="button">
                            <input type="radio" id="<?php echo $r_kichCo['kichCo'] ?>" name="kichCo" value="<?php echo $r_kichCo['kichCo'] ?>" />
                            <label class="btn btn-default" for="<?php echo $r_kichCo['kichCo'] ?>"><?php echo $r_kichCo['kichCo'] ?></label>
                        </div>
                    <?php } ?>

                    <br><br>

                    <input type="text" class="ip" id="s" value="" readonly>
                    <br><br>

                    <button class="btIn-Decrease" id="btDe">-</button>
                    <input class="inputNumber" id="inputValue" type="text" value="1" name="soLuong">
                    <button class="btIn-Decrease" id="btIn">+</button>
                    <br><br>


                    <a href="">s i z e c h a r t</a>
                    <br><br>

                    <?php
                    $sql = "SELECT mauSac, kichCo, soLuong FROM chitietsanpham WHERE idSanPham = '$_GET[id]'";
                    $result = mysqli_query($conn, $sql);
                    $data = array();
                    $i = 0;
                    while ($row5 = mysqli_fetch_assoc($result)) {
                        $data[] = $row5;
                    }
                    echo "<script>";
                    echo "var data = " . json_encode($data) . ";";
                    echo "</script>";
                    ?>
                    <button class="btAdd" name="themGioHang" type="submit">THÊM VÀO GIỎ HÀNG</button>
                </div>
                <br><br>
                <b>Chi tiết sản phẩm</b>
                <br><br>
                <?php echo '<pre>' . $row['moTa'] . '</pre>'; ?>
            </div>
        </div>
    </form>
    <?php
    include("../../pages/page_item/footer.php");
    ?>

    <script src="../js/chitietsanpham.js"></script>
</body>

</html>