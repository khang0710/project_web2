<a href="index.php?action=sanpham&query=lietke"><button style="float: right;" class="button-a" type="button">
                <h3>Quay lại</h3>
        </button></a>
<h3>Thêm Sản Phẩm</h3><br><br>
<form method="POST" action="modules/sanpham/xuly.php" enctype="multipart/form-data" onsubmit="return validateForm()">

        <b>*Tên sản phẩm</b><br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="tenSP">
        <br><br>
        <b>*Loại sản phẩm</b><br><br>
        <?php
        $sql_lietke_danhmuc = "SELECT * FROM danhmuc ORDER BY tenDanhMuc ASC";
        $query = mysqli_query($conn, $sql_lietke_danhmuc);
        ?>
        <select style="font-size: 18px; padding:8px; width:245px;" name="loaiSanPham" id="loaiSanPham">
                <option value=""> - Chọn - </option>
                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($query)) {
                        $i++;
                ?>
                        <option value="<?php echo $row['idDanhMuc'] ?>"><?php echo $row['tenDanhMuc'] ?></option>
                <?php } ?>
        </select>
        <br><br>
        <b>*Chất liệu</b><br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="chatLieu">
        <br><br>
        <b>*Giá bán </b><br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="giaBan">
        <br><br>
        <b>*Trạng thái hiển thị </b><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="trangThai" value="0"> Ẩn        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="trangThai" value="1" checked> Hiển thị <!-- Radiobutton ẩn với giá trị mặc định là 0 -->

        <br><br>
        <b>*Mô tả </b><br><br>
        <textarea style="font-size: 18px; padding:8px;" name="moTa" id="" cols="25" rows="3"></textarea>
        <br><br>
        <b>*Hình ảnh</b><br><br>
        <!-- Input cho phép tải lên hình ảnh từ máy tính -->
        <input type="file" name="hinhAnh" accept="image/*" onchange="previewImage(event)" />
        <br><br>
        <!-- Khung để hiển thị hình ảnh đã tải lên -->
        <div id="imagePreview"></div>

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

                function validateForm() {
                        var loaiSanPham = document.getElementById("loaiSanPham").value;
                        if (loaiSanPham == "") {
                                alert("Vui lòng chọn loại sản phẩm!");
                                return false; // Ngăn không gửi biểu mẫu nếu không chọn loại sản phẩm
                        }
                }
        </script>

        <br><button class="button-a" name="themSanPham" type="submit">
                <h3>Lưu</h3>
        </button></a>

</form>