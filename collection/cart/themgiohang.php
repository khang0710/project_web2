<?php
session_start();
include('../../admin/config/connetMySQL.php');
//Them san pham vao gio hang
if(isset($_POST['themGioHang'])) {
    $id = $_GET['idsanpham'];
    $soLuong = $_POST['soLuong'];
    $mauSac = $_POST['mauSac'];
    $kichCo = $_POST['kichCo'];
    $giaBan = $_POST['giaBan'];
    $hinhAnh = $_POST['hinhAnh'];

    $sql_them = "SELECT * FROM sanpham WHERE idSanPham ='" . $id . "' LIMIT 1";
    $query = mysqli_query($conn, $sql_them);
    $row = mysqli_fetch_array($query);

    $sql_ct = "SELECT * FROM chitietsanpham WHERE idSanPham = '".$id."' AND kichCo = '".$kichCo."' AND mauSac = '".$mauSac."'";
    $query2 = mysqli_query($conn, $sql_ct);
    $row2 = mysqli_fetch_array($query2);
    $idct = $row2["idChiTietSP"];
    if($row && $row2) {
        $new_product = array(array('id' => $row['idSanPham'],'idct' => $idct, 'tenSanPham' => $row['tenSanPham'], 'mauSac' => $mauSac, 'kichCo' => $kichCo, 'soLuong' => $soLuong, 'giaBan' => $giaBan, 'hinhAnh' => $hinhAnh));
        //Kiem tra session gio hang ton tai
        if (isset($_SESSION['cart'])) {
            //unset($_SESSION['cart']);

            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                //neu du lieu trung
                if ($cart_item['id'] == $id && $cart_item['idct'] == $idct) {
                    $product[] = array('id' => $cart_item['id'], 'idct' => $cart_item['idct'], 'tenSanPham' => $cart_item['tenSanPham'], 'mauSac' => $cart_item['mauSac'], 'kichCo' => $cart_item['kichCo'], 'soLuong' => $cart_item['soLuong']+$soLuong, 'giaBan' => $cart_item['giaBan'], 'hinhAnh' => $cart_item['hinhAnh']);
                    $found = true;
                }
                else{
                    $product[] = array('id' => $cart_item['id'], 'idct' => $cart_item['idct'], 'tenSanPham' => $cart_item['tenSanPham'], 'mauSac' => $cart_item['mauSac'], 'kichCo' => $cart_item['kichCo'], 'soLuong' => $cart_item['soLuong'], 'giaBan' => $cart_item['giaBan'], 'hinhAnh' => $cart_item['hinhAnh']);
                }
            }
            if($found == false) {

                $_SESSION['cart'] = array_merge($product,$new_product);
            }else{
                $_SESSION['cart'] = $product;
            }
        }else{
            $_SESSION['cart'] = $new_product;
        }
    }
    header('Location:index.php');
    print_r($_SESSION['cart']);   
}

//Xoa san pham khoi gio hang
if(isset($_SESSION['cart']) && $_GET['xoa']){
    $id = $_GET['xoa'];
    $ct = $_GET['ct'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id'] != $id || ($cart_item['id'] == $id && $cart_item['idct'] != $ct)){
            $product[] = array('id' => $cart_item['id'], 'idct' => $cart_item['idct'], 'tenSanPham' => $cart_item['tenSanPham'], 'mauSac' => $cart_item['mauSac'], 'kichCo' => $cart_item['kichCo'], 'soLuong' => $cart_item['soLuong'], 'giaBan' => $cart_item['giaBan'], 'hinhAnh' => $cart_item['hinhAnh']);
        }
    }
    $_SESSION['cart'] = $product;
    header('Location:index.php');
}

//Tang so luong san pham
if(isset($_SESSION['cart']) && $_GET['tang']){
    $id = $_GET['tang'];
    $ct = $_GET['ct'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id'] == $id && $cart_item['idct'] == $ct){
            $product[] = array('id' => $cart_item['id'], 'idct' => $cart_item['idct'], 'tenSanPham' => $cart_item['tenSanPham'], 'mauSac' => $cart_item['mauSac'], 'kichCo' => $cart_item['kichCo'], 'soLuong' => $cart_item['soLuong']+1, 'giaBan' => $cart_item['giaBan'], 'hinhAnh' => $cart_item['hinhAnh']);
        }
        else{
            $product[] = array('id' => $cart_item['id'], 'idct' => $cart_item['idct'], 'tenSanPham' => $cart_item['tenSanPham'], 'mauSac' => $cart_item['mauSac'], 'kichCo' => $cart_item['kichCo'], 'soLuong' => $cart_item['soLuong'], 'giaBan' => $cart_item['giaBan'], 'hinhAnh' => $cart_item['hinhAnh']);
        }
    }
    $_SESSION['cart'] = $product;
    header('Location:index.php');
}
// Giam so luong san pham
if(isset($_SESSION['cart']) && $_GET['giam']){
    $id = $_GET['giam'];
    $ct = $_GET['ct'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id'] == $id && $cart_item['idct'] == $ct){
            if ($cart_item['soLuong']-1 <= 0){
                continue;
            }else{
            $product[] = array('id' => $cart_item['id'], 'idct' => $cart_item['idct'], 'tenSanPham' => $cart_item['tenSanPham'], 'mauSac' => $cart_item['mauSac'], 'kichCo' => $cart_item['kichCo'], 'soLuong' => $cart_item['soLuong']-1, 'giaBan' => $cart_item['giaBan'], 'hinhAnh' => $cart_item['hinhAnh']);
            }
        }
        else{
            $product[] = array('id' => $cart_item['id'], 'idct' => $cart_item['idct'], 'tenSanPham' => $cart_item['tenSanPham'], 'mauSac' => $cart_item['mauSac'], 'kichCo' => $cart_item['kichCo'], 'soLuong' => $cart_item['soLuong'], 'giaBan' => $cart_item['giaBan'], 'hinhAnh' => $cart_item['hinhAnh']);
        }
    }
    $_SESSION['cart'] = $product;
    header('Location:index.php');
}

?>