<?php
include('../../config/connetMySQL.php');
$tenDM = $_POST['tenDanhMuc'];

if (isset($_POST['themDanhMuc'])) {
    $sql_them = "INSERT INTO danhmuc (tenDanhMuc) VALUES ('" . $tenDM . "')";

    mysqli_query($conn, $sql_them);
    echo "<script>alert('Thêm sản phẩm thành công!');</script>";
    echo "<script>window.history.go(-2);</script>";
} elseif (isset($_POST['suaDanhMuc'])) {
    $id = $_GET['iddanhmuc'];
    $sql_sua = "UPDATE danhmuc SET tenDanhMuc = '" . $tenDM . "' WHERE idDanhMuc = '" . $id . "'";
    mysqli_query($conn, $sql_sua);
    echo "<script>window.history.go(-1);</script>";
} else {
    $id = $_GET['iddanhmuc'];
    $sql_xoa = "DELETE FROM danhmuc WHERE idDanhMuc = '" . $id . "'";
    mysqli_query($conn, $sql_xoa);
    header('Location:../../index.php?action=danhmuc&query=lietke');
}
