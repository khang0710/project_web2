<?php
include('../../config/connetMySQL.php');
// $tenDM = $_POST['tenDanhMuc'];

if (isset($_POST['themDanhMuc'])) {
    $sql_them = "INSERT INTO danhmuc (tenDanhMuc) VALUES ('" . $tenDM . "')";

    mysqli_query($conn, $sql_them);
    header('Location:../../index.php?action=danhmuc&query=them');
} elseif (isset($_GET['id']) && $_GET['trangThai']) {
    $id = $_GET['id'];
    $trangThai = $_GET['trangThai'];
    $sql_sua = "UPDATE donhang SET trangThai = '" . $trangThai . "' WHERE idDonHang = '" . $id . "'";
    mysqli_query($conn, $sql_sua);
    echo "<script>alert('Cập nhật trạng thái đơn hàng thành công!');</script>";
    echo "<script>window.location.href = '../../index.php?action=donhang&query=lietke';</script>";
}   elseif (isset($_POST['capNhat'])) {
    $id = $_POST['id'];
    $trangThai = $_POST['trangThai'];
    $sql_sua = "UPDATE donhang SET trangThai = '" . $trangThai . "' WHERE idDonHang = '" . $id . "'";
    mysqli_query($conn, $sql_sua);
    echo "<script>alert('Cập nhật trạng thái đơn hàng thành công!');</script>";
    $url = '../../index.php?action=donhang&query=chitiet&idDonHang=' . $id;
    //echo "<script>window.location.href = '".$url."';</script>";
    echo "<script>window.location.href = '../../index.php?action=donhang&query=lietke';</script>";

}
 else {
    $id = $_GET['iddanhmuc'];
    $sql_xoa = "DELETE FROM danhmuc WHERE idDanhMuc = '" . $id . "'";
    mysqli_query($conn, $sql_xoa);
    header('Location:../../index.php?action=danhmuc&query=lietke');
}
