<?php
$sql_lietke_danhmuc = "SELECT * FROM danhmuc ORDER BY tenDanhMuc ASC";
$query = mysqli_query($conn, $sql_lietke_danhmuc);
?>

<a href="index.php?action=danhmuc&query=them"><button class="button-a" style="float: right;" type= "button"><h3>Thêm Phân Loại</h3></button></a>
<h3> ✩⋆｡Quản Lý Phân Loại</h3><br><br>
<div style="overflow-y: auto; max-height: 600px;">
    <table border="1" cellspacing="0" width="100%">
        <form method="POST" action="modules/danhmuc/xuly.php">
            <tr>
                <th>STT</th>
                <th>TÊN PHÂN LOẠI</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query)) {
                $i++;
            ?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['tenDanhMuc'] ?></td>
                    <td><a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['idDanhMuc']; ?>)">Xóa</a>&nbsp;&nbsp; | &nbsp;&nbsp;<a href="?action=danhmuc&query=sua&iddanhmuc=<?php echo $row['idDanhMuc'] ?>"> Sửa</a></td>
                    <script>
                        function confirmDelete(id) {
                            if (confirm("Bạn có chắc chắn muốn xóa?")) {
                                // Nếu người dùng nhấn Yes trong hộp thoại xác nhận
                                window.location.href = "modules/danhmuc/xuly.php?iddanhmuc=" + id;
                            }
                        }
                    </script>
                </tr>
            <?php } ?>
        </form>
    </table>
</div>