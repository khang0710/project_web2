<?php
include('../../config/connetMySQL.php');
$tenDM = $_POST['tenDanhMuc'];

if (isset($_POST['themDanhMuc'])) {
    $sql_them = "INSERT INTO danhmuc (tenDanhMuc) VALUES ('" . $tenDM . "')";

    mysqli_query($conn, $sql_them);
    header('Location:../../index.php?action=danhmuc&query=them');
} elseif (isset($_POST['suaDanhMuc'])) {
    $id = $_GET['iddanhmuc'];
    $sql_sua = "UPDATE danhmuc SET tenDanhMuc = '" . $tenDM . "' WHERE idDanhMuc = '" . $id . "'";
    mysqli_query($conn, $sql_sua);
    header("Location:../../index.php?action=danhmuc&query=sua&iddanhmuc=$id");
} else {
    $id = $_GET['iddanhmuc'];
    $sql_xoa = "DELETE FROM danhmuc WHERE idDanhMuc = '" . $id . "'";
    mysqli_query($conn, $sql_xoa);
    header('Location:../../index.php?action=danhmuc&query=lietke');
}
