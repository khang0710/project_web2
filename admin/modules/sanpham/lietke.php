<?php
$danhMuc = '';
$timKiem = '';
if (isset($_GET['danhMuc'])) {
    $danhMuc = $_GET['danhMuc'];
} else {
    $danhMuc = '';
}
if (isset($_GET['timKiem'])) {
    $timKiem = $_GET['timKiem'];
} else {
    $timKiem = '';
}
if ($danhMuc != '' && $timKiem == '') {
    $sql_sanpham = "SELECT * FROM sanpham WHERE loaiSanPham = '".$danhMuc."'";
} elseif ($danhMuc == '' && $timKiem != '') {
    $sql_sanpham = "SELECT * FROM sanpham WHERE tenSanPham LIKE '%".$_GET['timKiem']."%'";
} elseif ($danhMuc != '' && $timKiem != '') {
    $sql_sanpham = "SELECT * FROM sanpham WHERE loaiSanPham = '".$_GET['danhMuc']."' AND tenSanPham LIKE '%".$_GET['timKiem']."%'";
}else {
    $sql_sanpham = "SELECT * FROM sanpham ORDER BY idSanPham DESC";
}
$query2 = mysqli_query($conn, $sql_sanpham);
?>

<a href="index.php?action=sanpham&query=them"><button class="button-a" style="float: right;" type="button">
        <h3>Thêm Sản Phẩm</h3>
    </button></a>
<h3> ✩⋆｡Quản Lý Sản Phẩm</h3><br>
<form action="" method="GET">
    <input type="hidden" name="action" value="<?php echo $_GET['action'] ?>">
    <input type="hidden" name="query" value="<?php echo $_GET['query'] ?>">
    <select class="selectA" name="danhMuc" id="selectGiaBan">
        <option value="">Chọn</option>
        <?php
        $sql_danhmuc = "SELECT * FROM danhmuc";
        $query_danhmuc = mysqli_query($conn, $sql_danhmuc);
        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
        ?>
            <option value="<?php echo $row_danhmuc['idDanhMuc'] ?>" <?php if ($danhMuc == $row_danhmuc['idDanhMuc']) echo 'selected'; ?>><?php echo $row_danhmuc['tenDanhMuc'] ?></option>
        <?php } ?>
    </select>&emsp;
    <input type="text" name="timKiem" class="inPut" placeholder="Tìm kiếm" value="<?php if ($timKiem != '') echo $timKiem; ?>">
    <button type="submit" class="btnLoc">OK</button>
</form><br>
<div style="overflow-y: auto; max-height: 600px;">
    <table border="1" cellspacing="0" width="100%" style="font-size:small;">
        <tr>
            <th>STT</th>
            <th width="50px">HÌNH ẢNH</th>
            <th>TÊN</th>
            <th>LOẠI</th>
            <th>CHẤT LIỆU</th>
            <th>GIÁ BÁN</th>
            <th>H.THỊ</th>
            <th>NGÀY TẠO</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query2)) {
            $i++;
        ?>

            <tr>
                <td><?php echo $i ?></td>
                <td style="padding-right:10px;"><img src="modules/sanpham/uploads/<?php echo $row['hinhAnh'] ?>" width="90px"></td>
                <td><?php echo $row['tenSanPham'] ?></td>
                <td>
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
                    ?>
                </td>

                <td><?php echo $row['chatLieu'] ?></td>
                <td><?php echo $row['giaBan'] ?> $</td>
                <td><?php echo $row['hienThi'] ?></td>
                <td><?php echo $row['ngayTao'] ?></td>
                <td><a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['idSanPham']; ?>)">Xóa</a>&nbsp;&nbsp;
                    | &nbsp;&nbsp;<a href="?action=sanpham&query=sua&idsp=<?php echo $row['idSanPham'] ?>"> Sửa</a>
                    <br><br><br><a href="?action=nhaphang&query=chitiet&idsp=<?php echo $row['idSanPham'] ?>">Xem chi tiết</a>
                </td>
                <script>
                    function confirmDelete(id) {
                        if (confirm("⚠️ CẢNH BÁO! ⚠️\nNếu bạn chọn xóa sản phẩm mà các chi tiết sản phẩm và sản phẩm có trong hóa đơn liên quan sẽ không bị xóa mà chỉ ẩn đi. Các trường hợp còn lại sẽ bị xóa\n\nGợi ý: Nếu bạn muốn hiển thị lại sản phẩm này. Hãy vào chức năng chỉnh sửa và cập nhật lại trạng thái sản phẩm\n\nBẠN CÓ CHẮC CHẮN MUỐN XÓA?")) {
                            // Nếu người dùng nhấn Yes trong hộp thoại xác nhận
                            window.location.href = "modules/sanpham/xuly.php?idsp=" + id;
                        }
                    }
                </script>
            </tr>
        <?php } ?>
    </table>
</div>