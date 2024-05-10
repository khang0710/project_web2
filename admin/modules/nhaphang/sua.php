<?php
    $sql = "SELECT * FROM chitietsanpham WHERE idChiTietSP ='$_GET[id]' LIMIT 1";
    $query = mysqli_query($conn,$sql);

    $row = mysqli_fetch_assoc($query);
?>

<a href="index.php?action=nhaphang&query=chitiet&idsp=<?php echo $row['idSanPham'] ?>"><button style="float: right;" class="button-a" type= "button"><h3>Quay lại</h3></button></a>

<h3>Cập nhật số lượng</h3><br><br>

<form method="POST" action="modules/nhaphang/xuly.php?id=<?php echo $row['idChiTietSP'] ?>" enctype="multipart/form-data">
        <input type="hidden" name="idSP" value="<?php echo $row['idSanPham'] ?>">
        <b>*Màu sắc: </b><?php echo $row['mauSac']?><br><br>
        <!-- <input style="font-size: 18px; padding:8px;" type="text" name="mauSac" value="<?php echo $row['mauSac']?>">
        <br><br> -->
        <b>*Size: </b><?php echo $row['kichCo']?><br><br>
        <!-- &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="kichCo" value="S" <?php if ($row['kichCo'] == 'S') echo 'checked' ?>> S &nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="kichCo" value="M" <?php if ($row['kichCo'] == 'M') echo 'checked' ?>> M &nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="kichCo" value="L" <?php if ($row['kichCo'] == 'L') echo 'checked' ?>> L &nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="kichCo" value="XL" <?php if ($row['kichCo'] == 'XL') echo 'checked' ?>> XL &nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="kichCo" value="2XL" <?php if ($row['kichCo'] == '2XL') echo 'checked' ?>> 2XL

        <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="kichCo" value="None" <?php if ($row['kichCo'] == '2XL') echo 'checked' ?>> None &nbsp;&nbsp;&nbsp;&nbsp;
        <br><br> -->
        <b>*Số lượng hiện có: </b><?php echo $row['soLuong']?><br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="soLuong" placeholder="+ số lượng">
        <br><br>

        <br><button class="button-a" name="suaChiTiet" type="submit">
                <h3>Cập nhật số lượng</h3>
        </button></a>
</form>