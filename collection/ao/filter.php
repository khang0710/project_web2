<?php
$sql_danhmuc = "SELECT danhmuc.idDanhMuc,danhmuc.tenDanhMuc, COUNT(sanpham.idSanPham) AS tongSoLuong
FROM danhmuc
LEFT JOIN sanpham ON danhmuc.idDanhMuc = sanpham.loaiSanPham
WHERE tenDanhMuc LIKE '%Áo%'
GROUP BY danhmuc.idDanhMuc ORDER BY tenDanhMuc ASC";
$query = mysqli_query($conn, $sql_danhmuc);

$sql = "SELECT kichCo, COUNT(*) AS soLuongSize
FROM chitietsanpham
LEFT JOIN sanpham ON chitietsanpham.idSanPham = sanpham.idSanPham
LEFT JOIN danhmuc ON sanpham.loaiSanPham = danhmuc.idDanhMuc
WHERE danhmuc.tenDanhMuc LIKE '%Áo%'
GROUP BY kichCo
ORDER BY FIELD(kichCo, 'S', 'M', 'L', 'XL', '2XL');
";
$query2 = mysqli_query($conn, $sql);
?>

<b>Giá</b><br>
    <select class="selectA" name="giaBan" id="selectGiaBan">
        <option value="">Chọn</option>
        <option value="1" <?php if (isset($_GET['giaBan']) && $_GET['giaBan'] == 1) echo 'selected'; ?>>Dưới $100.00 USD</option>
        <option value="100" <?php if (isset($_GET['giaBan']) && $_GET['giaBan'] == 100) echo 'selected'; ?>>Từ $100.00 - $200.00 USD</option>
        <option value="200" <?php if (isset($_GET['giaBan']) && $_GET['giaBan'] == 200) echo 'selected'; ?>>Từ $200.00 - $300.00 USD</option>
        <option value="300" <?php if (isset($_GET['giaBan']) && $_GET['giaBan'] == 300) echo 'selected'; ?>>Trên $300.00 USD</option>
    </select><br>

    <b>Loại sản phẩm</b><br>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $i++;
    ?>
        <input type="radio" name="danhMuc" id="<?php echo $row['idDanhMuc']; ?>" value="<?php echo $row['idDanhMuc']; ?>" <?php if (isset($_GET['danhMuc']) && $_GET['danhMuc'] == $row['idDanhMuc']) echo 'checked' ?>>
        <label for="<?php echo $row['idDanhMuc']; ?>" class="custom-radio"><?php echo $row['tenDanhMuc'] ?> (<?php echo $row['tongSoLuong'] ?>)</label><br>

    <?php } ?>

    <b>Size</b><br>
    <?php
    $i = 0;
    while ($r2 = mysqli_fetch_array($query2)) {
        $i++;
    ?>
        <input type="radio" name="kichCo" id="<?php echo $r2['kichCo']; ?>" value="<?php echo $r2['kichCo']; ?>" <?php if (isset($_GET['kichCo']) && $_GET['kichCo'] == $r2['kichCo']) echo 'checked' ?>>
        <label for="<?php echo $r2['kichCo']; ?>" class="custom-radio"><?php echo $r2['kichCo']; ?> (<?php echo $r2['soLuongSize']; ?>)</label><br>

    <?php } ?>
