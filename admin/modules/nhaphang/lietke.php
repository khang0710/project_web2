<?php
$sql_sanpham = "SELECT * FROM sanpham WHERE hienThi = 1 ORDER BY idSanPham DESC";
$query = mysqli_query($conn, $sql_sanpham);

?>
<h3> ✩⋆｡Quản Lý Nhập Hàng</h3><br><br>
<div class="list">
    <ul class="inlist">
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query)) {
            $i++;
        ?>

            <li class="t-item"><a href="index.php?action=nhaphang&query=chitiet&idsp=<?php echo $row['idSanPham'] ?>" class="detail-link">
                    <img class="item-img" src="modules/sanpham/uploads/<?php echo $row['hinhAnh'] ?>">
                    <div class="item-text">
                        <?php echo $row['tenSanPham'] ?> <br>
                    </div>
                </a>
            </li>

        <?php } ?>
    </ul>
</div>

<div id="products">

</div>


<style>
    li {
        list-style-type: none;
    }

    .list {
        max-height: 320px;
        overflow-y: auto;
    }

    .inlist {
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        /* Cho phép các phần tử chuyển hàng khi không còn đủ không gian */
        float: left;
    }

    .t-item {
        padding: 0px 0px 0px 30px;
        /* Điều chỉnh khoảng cách giữa các mục */
        box-sizing: border-box;
        /* Đảm bảo rằng padding không tăng chiều rộng của các mục */
    }

    .item-img {
        width: 100px;
    }

    .item-text {
        font-size: small;
        padding: 10px 0;
        color: #5c5c5c;
        width: 120px;
        font-weight: normal;
    }
</style>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var detailLinks = document.querySelectorAll('.detail-link');

        detailLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a

                var url = this.getAttribute('href'); // Lấy đường dẫn từ href của thẻ a
                loadDetailContent(url); // Gọi hàm để tải nội dung từ đường dẫn và hiển thị
            });
        });

        function loadDetailContent(url) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                var productsDiv = document.getElementById('products');
                productsDiv.innerHTML = xhr.responseText;
                console.log(xhr.responseText);
                } else {
                    console.error('Đã xảy ra lỗi khi tải nội dung từ ' + url);
                }
            };
            xhr.send();
        }
    });


    function saveChanges() {
        var updateSL = <?php echo json_encode($_SESSION['updateSL']); ?>;

        for (var i = 0; i < updateSL.length; i++) {
            // Lấy giá trị của input có id tương ứng
            var input = document.getElementById(i);
            var newSoLuong = input.value;

            // Thay đổi giá trị 'soLuong' trong mảng updateSL
            updateSL[i]['soLuong'] = newSoLuong;
        }

        // In ra mảng để kiểm tra
        console.log(updateSL);
        return true;
    }
</script> -->
