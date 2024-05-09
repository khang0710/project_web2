<h3> ✩⋆｡Quản Lý Đơn Hàng</h3><br><br>
<form id="filterForm">
    <b>Tình trạng:</b>
    <select class="trangThai" name="trangThai" id="trangThai">
        <option value="Tất cả">Tất cả</option>
        <option value="Chờ xác nhận">Chờ xác nhận</option>
        <option value="Chờ lấy hàng">Chờ lấy hàng</option>
        <option value="Đang giao hàng">Đang giao hàng</option>
        <option value="Đã giao">Đã giao</option>
    </select> &emsp;&emsp;
    <label for="start"><b>Từ ngày: </b></label>
    <input type="date" id="start" name="start">

    <label for="end"><b> đến: </b></label>
    <input type="date" id="end" name="end">&emsp;&emsp;
    <button type="submit" id="btnLoc">LỌC</button>
</form><br>
<div id="products">
    <?php
        include('list.php');
    ?>
</div>

<style>
    #start,
    #end {
        font-size: medium;
        border: 1px solid #ccc;
        color: #5c5c5c;
        padding: 5px;
    }

    #btnLoc {
        width: 150px;
        font-size: medium;
        border: 1px solid #5c5c5c;
        color: #5c5c5c;
        padding: 8px;
        background-color: white;
    }
</style>

<script>
    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn việc gửi form một cách thông thường

        // Lấy dữ liệu từ form
        var formData = new FormData(this);
        // Gửi yêu cầu AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'modules/donhang/list.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Xử lý phản hồi từ list.php nếu cần
                var productsDiv = document.getElementById('products');
                productsDiv.innerHTML = xhr.responseText;
                console.log(xhr.responseText);
            } else {
                console.error('Đã xảy ra lỗi!');
            }
        };
        xhr.send(formData);
    });
    document.getElementById('trangThai').addEventListener('change', function() {
            var formData = new FormData(document.getElementById('filterForm'));

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'modules/donhang/list.php', true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var productsDiv = document.getElementById('products');
                    productsDiv.innerHTML = xhr.responseText;
                    console.log(xhr.responseText);
                } else {
                    console.error('Đã xảy ra lỗi!');
                }
            };
            xhr.send(formData);
    //     var selectValue = document.getElementById('trangThai').value;
    //     window.location.href = 'index.php?action=donhang&query=lietke&trangThai=' + encodeURIComponent(selectValue);
    });
</script>