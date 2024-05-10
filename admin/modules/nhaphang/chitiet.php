<?php
$id = $_GET['idsp'];
$sql_sanpham = "SELECT * FROM sanpham WHERE idSanPham = '" . $id . "'";
$query2 = mysqli_query($conn, $sql_sanpham);
?>
<a href="javascript:history.back()"><button class="button-a" style="float: right; margin-left:20px" type="button">
        <h3>Quay lại</h3>
    </button></a>
<a href="index.php?action=nhaphang&query=themchitiet&idsp=<?php echo $id ?>"><button class="button-a" style="float: right;" type="button">
        <h3>Thêm chi tiết</h3>
    </button></a>
<h3> ✩⋆｡✩⋆｡Chi Tiết Sản Phẩm</h3><br><br>
<?php
$i = 0;
while ($row = mysqli_fetch_assoc($query2)) {
    $i++;
?>
    <div class="infor">
        <div class="hinhanh">
            <img style=" margin-right:30px" src="modules/sanpham/uploads/<?php echo $row['hinhAnh'] ?>" width="150px">
        </div>
        <div class="noidung">
            <b>Tên sản phẩm: </b><?php echo $row['tenSanPham'] ?><br><br>
            <b>Loại sản phẩm: </b>
            <?php
            $sql_lietke_danhmuc = "SELECT * FROM danhmuc";
            $query = mysqli_query($conn, $sql_lietke_danhmuc);
            $j = 0;
            $tenArray = mysqli_fetch_all($query, MYSQLI_ASSOC);
            foreach ($tenArray as $ten) {
                if ($ten['idDanhMuc'] == $row['loaiSanPham']) {
                    echo $ten['tenDanhMuc'];
                } else $j++;
            }
            ?><br><br>
            <b>Chất liệu: </b><?php echo $row['chatLieu'] ?><br><br>
            <b>Giá bán: </b><?php echo $row['giaBan'] ?> $<br><br>
            <b>Hiển thị: </b><?php echo $row['hienThi'] ?><br><br>
            <b>Ngày tạo: </b><?php echo $row['ngayTao'] ?><br><br>
        </div>
    </div>
<?php } ?>

<?php
$id = $_GET['idsp'];
$sql_chitiet = "SELECT * FROM chitietsanpham WHERE idSanPham = '" . $id . "' ORDER BY mauSac ASC";
$query = mysqli_query($conn, $sql_chitiet);
?>

<div style="overflow-y: auto; max-height: 1000px; margin-top:20px">
    <table border="1" cellspacing="0" width="80%">
        <form method="POST" action="modules/danhmuc/xuly.php">
            <tr>
                <th>STT</th>
                <th>Màu Sắc</th>
                <th>Size</th>
                <th>Số Lượng</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_assoc($query)) {
                $i++;
            ?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['mauSac'] ?></td>
                    <td><?php echo $row['kichCo'] ?></td>
                    <td><?php echo $row['soLuong'] ?></td>
                    <td width="240px">
                        &nbsp;&nbsp;<a href="?action=nhaphang&query=sua&id=<?php echo $row['idChiTietSP'] ?>"> Cập nhật</a>&emsp;&emsp;|&emsp;&emsp;
                        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['idChiTietSP']; ?>)">Xóa</a>
                    </td>
                    <script>
                        function confirmDelete(id) {
                            if (confirm("Bạn có chắc chắn muốn xóa?")) {
                                // Nếu người dùng nhấn Yes trong hộp thoại xác nhận
                                window.location.href = "modules/nhaphang/xuly.php?idct=" + id;
                            }
                        }
                    </script>
                </tr>
            <?php } ?>
        </form>
    </table>
</div>

<style>
    .infor {
        display: flex;
    }
</style>