<?php
$sql = "SELECT * FROM admin";
$query = mysqli_query($conn, $sql);
?>

<a href="index.php?action=taikhoan&query=them"><button class="button-a" style="float: right;" type= "button"><h3>Thêm Phân Loại</h3></button></a>
<h3> ✩⋆｡Quản Lý Tài Khoản</h3><br><br>
<div style="overflow-y: auto; max-height: 600px;">
    <table border="1" cellspacing="0" width="100%" style="">
        <form method="POST" action="modules/taikhoan/xuly.php">
            <tr>
                <th>STT</th>
                <th>UserName</th>
                <th>Mật khẩu</th>
                <th>Chức vụ</th>
                <th>Trạng thái</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query)) {
                $i++;
            ?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['userName'] ?></td>
                    <td><?php echo $row['passWord'] ?></td>
                    <td><?php echo $row['phanQuyen'] ?></td>
                    <td><?php if($row['trangThai'] == 1){ echo 'Hoạt động';} else {echo 'Khóa';}?></td>

                    <td><a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['idAdmin']; ?>)">Xóa</a>&nbsp;&nbsp; | &nbsp;&nbsp;<a href="?action=taikhoan&query=sua&id=<?php echo $row['idAdmin'] ?>"> Sửa </a>&ensp;</td>
                    <script>
                        function confirmDelete(id) {
                            if (confirm("Bạn có chắc chắn muốn xóa?")) {
                                // Nếu người dùng nhấn Yes trong hộp thoại xác nhận
                                window.location.href = "modules/taikhoan/xuly.php?id=" + id;
                            }
                        }
                    </script>
                </tr>
            <?php } ?>
        </form>
    </table>
</div>