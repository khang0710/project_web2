<?php
include('../../config/connetMySQL.php');

$idSP = $_POST['idSP'];

$soLuong = $_POST['soLuong'];


if (isset($_POST['themChiTiet'])) {
    //ThemChiTiet
    $mauSac = $_POST['mauSac'];
    $kichCo = $_POST['kichCo'];
    $sql_themct = "INSERT INTO `chitietsanpham`(`idSanPham`, `mauSac`, `kichCo`, `soLuong`) VALUES 
    ('" . $idSP . "',' " . $mauSac . " ','".$kichCo."','".$soLuong."')";
    mysqli_query($conn, $sql_themct);
    header("Location:../../index.php?action=nhaphang&query=chitiet&idsp=$idSP");
}elseif (isset($_POST['suaChiTiet'])) {
    //ThemChiTiet
    $id = $_GET['id'];
    $sql_sua = "UPDATE `chitietsanpham` SET `soLuong`= soLuong + '".$soLuong."' WHERE idChiTietSP = '".$id."'";
    mysqli_query($conn, $sql_sua);
    header("Location:../../index.php?action=nhaphang&query=chitiet&idsp=$idSP");
} else {
    //Xoa
    $id = $_GET['idsp'];
    $sql_xoa_chitiet = "DELETE FROM chitietsanpham WHERE idSanPham = '" . $id . "'";
    mysqli_query($conn, $sql_xoa_chitiet);
    $sql_xoa = "DELETE FROM sanpham WHERE idSanPham = '" . $id . "'";
    mysqli_query($conn, $sql_xoa);
    header('Location:../../index.php?action=sanpham&query=lietke');
}
