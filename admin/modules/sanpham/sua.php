<?php
    $sql_lay_sanpham = "SELECT * FROM sanpham WHERE idSanPham ='$_GET[idsp]' LIMIT 1";
    $query = mysqli_query($conn,$sql_lay_sanpham);

    $row = mysqli_fetch_assoc($query);
?>

<a href="index.php?action=sanpham&query=lietke"><button style="float: right;" class="button-a" type= "button"><h3>Quay lại</h3></button></a>

<h3>Sửa Thông Tin Sản Phẩm</h3><br><br>

<form method="POST" action="modules/sanpham/xuly.php?idsp=<?php echo $_GET['idsp']?>" enctype="multipart/form-data">

        <b>*Tên sản phẩm</b><br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="tenSP" value="<?php echo $row['tenSanPham'] ?>">
        <br><br>
        <b>*Loại sản phẩm</b><br><br>
        <?php
        $iddm = $row['loaiSanPham'];
        $sql_laytendanhmuc = "SELECT * FROM danhmuc WHERE idDanhMuc = '".$iddm."' LIMIT 1";
        $query2 = mysqli_query($conn, $sql_laytendanhmuc);

        $sql_lietke_danhmuc = "SELECT * FROM danhmuc WHERE idDanhMuc <> '$iddm' ORDER BY tenDanhMuc ASC";
        $query3 = mysqli_query($conn, $sql_lietke_danhmuc);
        ?>
        <select style="font-size: 18px; padding:8px; width:245px;" name="loaiSanPham" id="">
                <?php 
                $r2 = mysqli_fetch_assoc($query2);
                ?>
                <option value="<?php echo $r2['idDanhMuc'] ?>"><?php echo $r2['tenDanhMuc'] ?></option>
                <?php
                $i = 0;
                while ($r3 = mysqli_fetch_array($query3)) {
                        $i++;
                ?>
                        <option value="<?php echo $r3['idDanhMuc'] ?>"><?php echo $r3['tenDanhMuc'] ?></option>
                <?php } ?>
        </select>
        <br><br>
        <b>*Chất liệu</b><br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="chatLieu" value="<?php echo $row['chatLieu'] ?>">
        <br><br>
        <b>*Giá bán </b><br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="giaBan" value="<?php echo $row['giaBan'] ?>">
        <br><br>
        <b>*Trạng thái hiển thị </b><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php if ($row['hienThi'] == 1): ?>
        <input type="radio" name="trangThai" value="0"> Ẩn        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="trangThai" value="1" checked> Hiển thị <!-- Radiobutton ẩn với giá trị mặc định là 0 -->
        <?php else: ?>
        <input type="radio" name="trangThai" value="0" checked> Ẩn        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="trangThai" value="1"> Hiển thị <!-- Radiobutton ẩn với giá trị mặc định là 0 -->
        <?php endif; ?>
        <br><br>
        <b>*Mô tả </b><br><br>
        <textarea style="font-size: 18px; padding:8px;" name="moTa" id="" cols="25" rows="3"><?php echo $row['moTa'] ?></textarea>
        <br><br>
        <b>*Hình ảnh</b><br><br>
        <input type="file" name="hinhAnh" accept="image/*" onchange="previewImage(event)" />
        <br><br>
        <div id="imagePreview">
        <img src="modules/sanpham/uploads/<?php echo $row['hinhAnh'] ?>" width="200px">
        </div>
        <input type="hidden" name="hinhAnhBanDau" value="<?php echo $row['hinhAnh']; ?>">
            
        <!-- JavaScript để xem trước hình ảnh -->
        <script>
                function previewImage(event) {
                        var reader = new FileReader();
                        reader.onload = function() {
                                var output = document.getElementById('imagePreview');
                                output.innerHTML = '<img src="' + reader.result + '" width="200" />';
                        }
                        reader.readAsDataURL(event.target.files[0]);
                }
        </script>

        <br><button class="button-a" name="suaSanPham" type="submit">
                <h3>Cập nhật</h3>
        </button></a>

</form>