<?php
if (isset($_SESSION['cart'])) {
?>
    <table class="tb" cellspacing="0" width="100%" style="font-size:small;">
        <form method="POST" action="modules/danhmuc/xuly.php">
            <tr>
                <th width="50px">Hình ảnh</th>
                <th> </th>
                <th>Số lượng</th>
                <th style="text-align: right;">Tổng</th>
            </tr>
            <?php
            if (isset($_SESSION['cart'])) {
                $i = 0;
                $tong = 0;
                foreach ($_SESSION['cart'] as $cart_item) {
                    $tongO = $cart_item['giaBan'] * $cart_item['soLuong'];
                    $tong += $tongO;
            ?>

                    <tr class="tr1">
                        <td><a href="../detail_item/chitietsanpham.php?id=<?php echo $cart_item['id'] ?>">
                                <img src="../../admin/modules/sanpham/uploads/<?php echo $cart_item['hinhAnh'] ?>" width="100px">
                            </a>
                        </td>

                        <td class="td1"><b><?php echo $cart_item['tenSanPham'] ?><br></b>
                            Phân loại: <?php echo $cart_item['mauSac'] ?> / <?php echo $cart_item['kichCo'] ?><br>
                            $<?php echo $cart_item['giaBan'] ?>.00<br>
                            <?php // echo $cart_item['idct'] ?>
                        </td>

                        <td style="text-align: center;">
                            <a href="http://localhost/CottagecoreWeb/collection/cart/themgiohang.php?giam=<?php echo $cart_item['id'] ?>&ct=<?php echo $cart_item['idct'] ?>"><input class="inputNumber" type="button" value="-" readonly></a>
                            <input class="inputNumber" id="inputValue" type="text" value="<?php echo $cart_item['soLuong'] ?>" name="soLuong" readonly>
                            <a href="http://localhost/CottagecoreWeb/collection/cart/themgiohang.php?tang=<?php echo $cart_item['id'] ?>&ct=<?php echo $cart_item['idct'] ?>"><input class="inputNumber" type="button" value="+" readonly></a>
                            <br><br><a href="http://localhost/CottagecoreWeb/collection/cart/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>&ct=<?php echo $cart_item['idct'] ?>">Xóa</a>
                        </td>

                        <td style="text-align: right;">$<?php echo $cart_item['giaBan'] * $cart_item['soLuong'] ?>.00</td>

                    </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right; font-size:15px">Tổng cộng: <br><br><b> $<?php echo $tong ?>.00 USD</b></td>
                </tr>
            <?php } ?>
        </form>
    </table>
    <a href="order.php">
    <div>
        <button class="btAdd" name="" type="submit">THANH TOÁN</button>
    </div></a>
<?php } else {
?>
    <div style="text-align:center; font-size:small" class="none">
        Giỏ hàng trống !
    </div>
<?php } ?>