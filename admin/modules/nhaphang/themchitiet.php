<br><br>
<?php
        $id = $_GET['idsp'];
        ?>
<a href="javascript:history.back()"><button style="float: right;" class="button-a" type="button">
                <h3>Quay lại</h3>
        </button></a>
<h3>Thêm chi tiết sản phẩm:</h3><br><br>
<form method="POST" action="modules/nhaphang/xuly.php" enctype="multipart/form-data">
        <input type="hidden" name="idSP" value="<?php echo $id; ?>">
        <b>*Màu sắc </b><br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="mauSac">
        <br><br>
        <b>*Size </b><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="kichCo" value="S"> S &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="kichCo" value="M"> M &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="kichCo" value="L"> L &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="kichCo" value="XL"> XL &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="kichCo" value="2XL"> 2XL
        <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="kichCo" value="None"> None &nbsp;&nbsp;&nbsp;&nbsp;
        <br><br>

        <br><button class="button-a" name="themChiTiet" type="submit">
                <h3>Thêm chi tiết</h3>
        </button></a>
</form>