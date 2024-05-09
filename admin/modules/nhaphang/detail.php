<?php
session_start();
include '../../config/connetMySQL.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `chitietsanpham` WHERE idSanPham = '" . $id . "'";
    $query = mysqli_query($conn, $sql);
}

?>
<br><b>Phân loại:</b><br><br>
<table border="1" cellspacing="0" width="80%">
        <tr>
            <th>Màu sắc</th>
            <th>Kích cỡ</th>
            <th>Số lượng</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
        $i  = 0;
        while ($row = mysqli_fetch_array($query)) {
            $data[] = array('id' => $row['idChiTietSP'],'mauSac' => $row['mauSac'], 'kichCo' => $row['kichCo'], 'soLuong' => $row['soLuong']);
        ?>
        <tr>
            <td><?php echo $row['mauSac'] ?></td>
            <td><?php echo $row['kichCo'] ?></td>
            <td width="200px" style="padding: 0;"><input class="input" type="text" value="<?php echo $row['soLuong'] ?>"></td>
            <td><a href="modules/nhaphang/id=<?php echo $row['idChiTietSP']?>" target="_blank"><b>OK</b></a></td>
        </tr>
        <?php $i++; }?>   
<style>
    .input{
        width: 100%;
        height: 40px;
        text-align: center;
        font-size: medium;
        border: 0;
        outline: none;
    }
</style>
<script>
    function updateInput(input, id) {
            // Lấy id của select
            var selectId = input.id;
            // Lấy giá trị của select được chọn
            var selectedValue = input.value;
            document.getElementById('a'+selectId).href = 'modules/nhaphang/xuly.php?soLuong=' + encodeURIComponent(selectedValue) + '&id=' + id;
        }
</script>
