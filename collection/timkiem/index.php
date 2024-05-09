<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CottageCore</title>
    <link rel="stylesheet" type="text/css" href="../css/Header.css">
    <link rel="stylesheet" type="text/css" href="../css/Top.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
    session_start();
    include("../../admin/config/connetMySQL.php");
    include("../header.php");
    if (isset($_GET['q'])) {
        $q = $_GET['q'];
    if ($q == "") {
    ?>
        <div class="t_content">
            Tìm Kiếm <br><br>
        </div>
        <div style="text-align: center; font-size:medium; color:#5c5c5c; margin-bottom:100px;">
            Vui lòng nhập từ khóa tìm kiếm!
        </div>
    <?php
    } else {
        $sql_danhmuc = "SELECT COUNT(sanpham.idSanPham) AS tongSoLuong
    FROM sanpham
    WHERE sanpham.tenSanPham LIKE '%".$q."%' AND sanpham.hienThi = 1";
    $query = mysqli_query($conn, $sql_danhmuc);
    $row = mysqli_fetch_assoc($query);
    ?>
        <div style="z-index: 0;" class="t_content">
            Tìm Kiếm <br><br>
        </div>
        <div style="text-align: center; font-size:medium; color:#5c5c5c">
            <?php echo $row['tongSoLuong'] ?> kết quả với từ khóa "<?php echo $q ?>"
        </div><br>
        
        <div class="t_main">
            <div class="t_filter">
                <?php include("filter.php"); ?>
            </div>

            <div id="list_items" class="list_items">
            <?php include("list_items.php"); ?>
            </div>
        </div>
    <?php }} ?>
    <?php
    include("../../pages/page_item/footer.php");
    ?>
<script src="../js/header.js">
</script>
<script>function buildURLS() {
    var giaBanValue = getSelectedValueSLS('giaBanS');
    var danhMucValue = getSelectedValueS('danhMucS');
    var kichCoValue = getSelectedValueS('kichCoS');

    // Tạo URL dựa trên giá trị được chọn
    var url = 'index.php?q=<?php echo $q ?>&giaBan=' + encodeURIComponent(giaBanValue) + '&danhMuc=' + encodeURIComponent(danhMucValue) + '&kichCo=' + encodeURIComponent(kichCoValue);

    // Chuyển hướng người dùng đến URL
    window.location.href = url;
}

function getSelectedValueS(radioName) {
    var selectedRadio = document.querySelector('input[name="' + radioName + '"]:checked');
    return selectedRadio ? selectedRadio.value : '';
}

function getSelectedValueSLS(selectName) {
    var selectedOption = document.querySelector('select[name="' + selectName + '"] option:checked');
    return selectedOption ? selectedOption.value : '';
}

var radioButtons = document.querySelectorAll('input[type="radio"]');
radioButtons.forEach(function (radioButton) {
    radioButton.addEventListener('change', buildURLS);
});

var selectElement = document.getElementById('selectGiaBanS');
selectElement.addEventListener('change', buildURLS);
</script>
</body>
</html>