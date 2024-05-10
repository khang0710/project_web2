<?php
if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
} else {
    $page = 1;
}
if ($page == '' || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page * 12) - 12;
}   

$dm = ""; $kc = ""; $gbd = "";

if(isset($_GET['danhMuc'])){ $dm = $_GET['danhMuc'];}else{ $dm = "";}
if(isset($_GET['kichCo'])){ $kc = $_GET['kichCo'];}else{ $kc = "";}
if(isset($_GET['giaBan'])){ $gbd = $_GET['giaBan'];}else{ $gbd = "";}


if ($dm!="" && $kc == "" && $gbd =="") {
    $sql_sanpham = "SELECT * FROM sanpham LEFT JOIN danhmuc ON sanpham.loaiSanPham = danhmuc.idDanhMuc WHERE sanpham.tenSanPham LIKE '%".$q."%' AND danhmuc.idDanhMuc = '".$dm."'";
    $sql_trang = mysqli_query($conn, $sql_sanpham.=" AND sanpham.hienThi = 1");
}
elseif ($dm=="" && $kc != "" && $gbd =="") {
    $sql_sanpham = "SELECT * FROM sanpham LEFT JOIN chitietsanpham ON sanpham.idSanPham = chitietsanpham.idSanPham WHERE sanpham.tenSanPham LIKE '%".$q."%' AND chitietsanpham.kichCo = '".$kc."'";
    $sql_trang = mysqli_query($conn, $sql_sanpham.=" AND sanpham.hienThi = 1");
}
elseif ($dm =="" && $kc == "" && $gbd !="") {
    $gkt = 0;
    if ($gbd == '1'){$gbd = 0; $gkt = 99;} elseif ($gbd == '100'){ $gkt = 200;} elseif ($gbd == '200'){ $gkt = 300;}else{ $gkt = 10000;}
    $sql_sanpham = "SELECT * FROM sanpham WHERE sanpham.tenSanPham LIKE '%".$q."%' AND giaBan >= ".$gbd." AND giaBan <= ".$gkt."";
    $sql_trang = mysqli_query($conn, $sql_sanpham.=" AND sanpham.hienThi = 1");
}
elseif ($dm!="" && $kc != "" && $gbd =="") {// danhMuc & kichCo
    $sql_sanpham = "SELECT * FROM sanpham LEFT JOIN chitietsanpham ON sanpham.idSanPham = chitietsanpham.idSanPham WHERE sanpham.tenSanPham LIKE '%".$q."%' AND sanpham.loaiSanPham = '".$dm."' AND chitietsanpham.kichCo = '".$kc."'";
    $sql_trang = mysqli_query($conn, $sql_sanpham.=" AND sanpham.hienThi = 1");
}
elseif ($dm=="" && $kc != "" && $gbd !="") {//kichCo & giaBan
    $gkt = 0;
    if ($gbd == '1'){$gbd = 0; $gkt = 99;} elseif ($gbd == '100'){ $gkt = 200;} elseif ($gbd == '200'){ $gkt = 300;}else{ $gkt = 10000;}
    $sql_sanpham = "SELECT * FROM sanpham LEFT JOIN chitietsanpham ON sanpham.idSanPham = chitietsanpham.idSanPham WHERE sanpham.tenSanPham LIKE '%".$q."%' AND chitietsanpham.kichCo = '".$kc."' AND giaBan >= ".$gbd." AND giaBan <= ".$gkt."";
    $sql_trang = mysqli_query($conn, $sql_sanpham.=" AND sanpham.hienThi = 1");
}
elseif ($dm!="" && $kc == "" && $gbd !="") {// giaBan & danhMuc
    $gkt = 0;
    if ($gbd == '1'){$gbd = 0; $gkt = 99;} elseif ($gbd == '100'){ $gkt = 200;} elseif ($gbd == '200'){ $gkt = 300;}else{ $gkt = 10000;}
    $sql_sanpham = "SELECT * FROM sanpham WHERE sanpham.tenSanPham LIKE '%".$q."%' AND loaiSanPham = '".$dm."' AND giaBan >= ".$gbd." AND giaBan <= ".$gkt."";
    $sql_trang = mysqli_query($conn, $sql_sanpham.=" AND sanpham.hienThi = 1");
}
elseif ($dm!="" && $kc != "" && $gbd !="") {// all
    $gkt = 0;
    if ($gbd == '1'){$gbd = 0; $gkt = 99;} elseif ($gbd == '100'){ $gkt = 200;} elseif ($gbd == '200'){ $gkt = 300;}else{ $gkt = 10000;}
    $sql_sanpham = "SELECT * FROM sanpham LEFT JOIN chitietsanpham ON sanpham.idSanPham = chitietsanpham.idSanPham WHERE sanpham.tenSanPham LIKE '%".$q."%' AND loaiSanPham = '".$dm."' AND chitietsanpham.kichCo = '".$kc."' AND giaBan >= ".$gbd." AND giaBan <= ".$gkt."";
    $sql_trang = mysqli_query($conn, $sql_sanpham.=" AND sanpham.hienThi = 1");
}
else {
    $sql_all = "SELECT * FROM sanpham WHERE tenSanPham LIKE '%".$q."%' AND hienThi = 1 ORDER BY tenSanPham ASC LIMIT $begin,12";
    $sql_trang = mysqli_query($conn, "SELECT * FROM sanpham WHERE tenSanPham LIKE '%".$q."%'");
}

if(isset($sql_sanpham)){
    $sql_sanpham.= " AND sanpham.hienThi = 1 GROUP BY sanpham.idSanPham LIMIT $begin,12";
    $query = mysqli_query($conn, $sql_sanpham);
}else{
    $query = mysqli_query($conn, $sql_all);
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
<div style="clear: both;"><br></div>
<?php
$row_trang = mysqli_num_rows($sql_trang);
$trang = ceil($row_trang / 12);
?>
<ul class="list-trang">
    <?php
    for ($i = 1; $i <= $trang; $i++) {
    ?>
        <a href="index.php?q=<?php echo $q ?>&giaBan=<?php if(isset($_GET['giaBan'])){ echo $_GET['giaBan'];} ?>&danhMuc=<?php if(isset($_GET['danhMuc'])){ echo $_GET['danhMuc'];} ?>&kichCo=<?php if(isset($_GET['kichCo'])){ echo $_GET['kichCo'];} ?>&trang=<?php echo $i ?>">
            <li <?php if ($i == $page) {
                    echo 'style="background: #ccc;"';
                } else {
                    echo '';
                } ?>><?php echo $i ?></li>
        </a>
    <?php } ?>
</ul>