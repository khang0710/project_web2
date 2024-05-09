<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    
$q = $_SESSION['q'];}
    include('../../admin/config/connetMySQL.php');
    if ($q != "") {
        if (isset($_POST['danhMuc'])) {
            $danhMuc = $_POST['danhMuc'];
        } else {
            $danhMuc = '';
        }
        if (isset($_POST['kichCo'])) {
            $kichCo = $_POST['kichCo'];
        } else {
            $kichCo = '';
        }
        if ($danhMuc != '' && $kichCo == '') {
            $sql_sanpham = "SELECT * FROM sanpham
            JOIN danhmuc ON sanpham.loaiSanPham = danhmuc.idDanhMuc
            WHERE danhmuc.idDanhMuc = '" . $danhMuc . "' 
            AND sanpham.tenSanPham LIKE '%" . $q . "%' AND sanpham.hienThi = 1";
            $query = mysqli_query($conn, $sql_sanpham);
        } elseif ($danhMuc == '' && $kichCo != '') {

        } elseif ($danhMuc != '' && $kichCo != '') {
            $sql_sanpham = "SELECT * FROM sanpham
            JOIN danhmuc ON sanpham.loaiSanPham = danhmuc.idDanhMuc
            JOIN chitietsanpham ON sanpham.idSanPham = chitietsanpham.idSanPham
            WHERE chitietsanpham.kichCo = '" . $kichCo . "' 
            AND danhmuc.idDanhMuc = '" . $danhMuc . "' 
            AND sanpham.tenSanPham LIKE '%" . $q . "%' AND sanpham.hienThi = 1";
        $query = mysqli_query($conn, $sql_sanpham);
        } else {
            $sql_sanpham = "SELECT * FROM sanpham WHERE sanpham.tenSanPham LIKE '%" . $q . "%' AND sanpham.hienThi = 1";
            $query = mysqli_query($conn, $sql_sanpham);
        }
    }
}else{
    $sql_sanpham = "SELECT * FROM sanpham WHERE sanpham.tenSanPham LIKE '%" . $q . "%' AND sanpham.hienThi = 1";
            $query = mysqli_query($conn, $sql_sanpham);
}
?>
<div class="">
    <ul class="inlist">
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query)) {
            $i++;
        ?>

            <li class="t-item"><a href="../detail_item/chitietsanpham.php?id=<?php echo $row['idSanPham'] ?>">
                    <img class="item-img" src="../../admin/modules/sanpham/uploads/<?php echo $row['hinhAnh'] ?>">
                    <div class="item-text">
                        <?php echo $row['tenSanPham'] ?> <br>
                        <b>$<?php echo $row['giaBan'] ?>.00 USD</b>
                    </div>
                </a>
            </li>

        <?php } ?>
    </ul>
</div>