<?php
include('../../config/connetMySQL.php');
$tenSP = $_POST['tenSP'];
$loaiSP = $_POST['loaiSanPham'];
$chatLieu = $_POST['chatLieu'];
$giaBan = $_POST['giaBan'];
$trangThai = $_POST['trangThai'];
$moTa = $_POST['moTa'];
if (isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['size'] > 0) {
    // Nếu người dùng đã chọn tệp hình ảnh mới, thực hiện tải lên và cập nhật
    $hinhAnh = $_FILES['hinhAnh']['name'];
    $hinhAnh_tmp = $_FILES['hinhAnh']['tmp_name'];
    //$hinhAnh = time() . '_' . $hinhAnh;
    //move_uploaded_file($hinhAnh_tmp, 'uploads/' . $hinhAnh);
} else {
    // Nếu người dùng không chọn tệp hình ảnh mới, giữ nguyên ảnh ban đầu
    $hinhAnh = $_POST['hinhAnhBanDau'];
}
//$hinhAnh = $_FILES['hinhAnh']['name'];
//$hinhAnh_tmp = $_FILES['hinhAnh']['tmp_name'];
//$hinhAnh = time() . '_' . $hinhAnh;

$idSP = $_POST['idSP'];
$mauSac = $_POST['mauSac'];
$kichCo = $_POST['kichCo'];


if (isset($_POST['themSanPham'])) {
    //Them
    $sql_them = "INSERT INTO sanpham(`tenSanPham`, `loaiSanPham`, `chatLieu`, `giaBan`, `hienThi`, `hinhAnh`, `moTa`, `ngayTao`) 
    VALUES ('" . $tenSP . "','" . $loaiSP . "','" . $chatLieu . "','" . $giaBan . "','" . $trangThai . "','" . $hinhAnh . "','" . $moTa . "',NOW())";
    mysqli_query($conn, $sql_them);
    move_uploaded_file($hinhAnh_tmp, 'uploads/' . $hinhAnh);
    echo "<script>alert('Thêm sản phẩm thành công!');</script>";

    echo "<script>window.location.href = '../../index.php?action=sanpham&query=lietke';</script>";

    //header('Location:../../index.php?action=sanpham&query=them');
} elseif (isset($_POST['suaSanPham'])) {
    //Sua
    $id = $_GET['idsp'];

    $sql_sua = "UPDATE sanpham SET tenSanPham='" . $tenSP . "', loaiSanPham='" . $loaiSP . "',
    chatLieu='" . $chatLieu . "', giaBan='" . $giaBan . "',
    hienThi='" . $trangThai . "', hinhAnh='" . $hinhAnh . "',
    moTa='" . $moTa . "' WHERE idSanPham = '" . $id . "'";

    mysqli_query($conn, $sql_sua);
    move_uploaded_file($hinhAnh_tmp, 'uploads/' . $hinhAnh);
    header("Location:../../index.php?action=sanpham&query=sua&idsp=$id");
} elseif (isset($_POST['themChiTiet'])) {
    //ThemChiTiet
    $sql_themct = "INSERT INTO `chitietsanpham`(`idSanPham`, `mauSac`, `kichCo`, `soLuong`) VALUES 
    ('" . $idSP . "',' " . $mauSac . " ','" . $kichCo . "','0')";
    mysqli_query($conn, $sql_themct);
    header("Location:../../index.php?action=sanpham&query=themchitiet&idsp=$idSP");
} else {
    //Xoa
    $id = $_GET['idsp'];
    $sql_kiemtra = "SELECT * FROM `sanpham`
    JOIN chitietsanpham ON sanpham.idSanPham = chitietsanpham.idSanPham
    WHERE sanpham.idSanPham = '" . $id . "'
    GROUP BY sanpham.idSanPham";
    mysqli_query($conn, $sql_kiemtra);

    $result = mysqli_query($conn, $sql_kiemtra);

    if (mysqli_num_rows($result) > 0) {
        $sql_update = "UPDATE sanpham SET hienThi ='' WHERE idSanPham = '" . $id . "'";
        mysqli_query($conn, $sql_update);
    } else {
        $sql_xoa = "DELETE FROM sanpham WHERE idSanPham = '" . $id . "'";
        mysqli_query($conn, $sql_xoa);
    }
    header('Location:../../index.php?action=sanpham&query=lietke');
}
