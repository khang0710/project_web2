<?php
include('../../config/connetMySQL.php');

$idSP = $_POST['idSP'];

$soLuong = $_POST['soLuong'];


if (isset($_POST['themChiTiet'])) {
    //ThemChiTiet
    $mauSac = $_POST['mauSac'];
    $kichCo = $_POST['kichCo'];
    $sql_themct = "INSERT INTO `chitietsanpham`(`idSanPham`, `mauSac`, `kichCo`, `soLuong`) VALUES 
    ('" . $idSP . "',' " . $mauSac . " ','" . $kichCo . "','0')";
    mysqli_query($conn, $sql_themct);
    echo "<script>alert('Thêm chi tiết thành công');</script>";
    echo "<script>window.history.go(-2);</script>";
    // header("Location:../../index.php?action=nhaphang&query=chitiet&idsp=$idSP");
} elseif (isset($_POST['suaChiTiet'])) {
    //SuaChiTiet
    $id = $_GET['id'];
    $sql_sua = "UPDATE `chitietsanpham` SET `soLuong`= soLuong + '" . $soLuong . "' WHERE idChiTietSP = '" . $id . "'";
    mysqli_query($conn, $sql_sua);
    echo "<script>window.history.go(-2);</script>";
    // header("Location:../../index.php?action=nhaphang&query=chitiet&idsp=$idSP");
} else {
    //Xoa
    $id = $_GET['idct'];
    $sql_xoa_chitiet = "DELETE FROM chitietsanpham WHERE idChiTietSP = '" . $id . "'";
    if (mysqli_query($conn, $sql_xoa_chitiet)) {
        echo "<script>alert('Xóa chi tiết thành công');</script>";
        echo "<script>window.history.go(-1);</script>";
    } else {
        echo "<script>alert('Xóa chi tiết thất bại');</script>";
        echo "<script>window.history.go(-1);</script>";
    }
}
