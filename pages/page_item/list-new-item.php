<?php 
$sql_sanpham = "SELECT * FROM sanpham WHERE hienThi = 1 ORDER BY idSanPham DESC LIMIT 8";
$query = mysqli_query($conn, $sql_sanpham);
?>
<div class="listshop">
        <ul class="title-new">
            <li>˚₊‧꒰ა <b>NEW DREAM</b> ໒꒱ ‧₊˚</li>
        </ul>
        
        <ul class="slideitem">
        <div class="btns">
        <i id="return-btn" class='bx bx-chevron-left'></i>
        <i id="next-btn" class='bx bx-chevron-right'></i>
        </div>
            <div class="listitem">
                <?php 
                    $i = 0;
                    while ($row = mysqli_fetch_array($query)) {
                        $i++;
                ?>
                <a href="../collection/detail_item/chitietsanpham.php?id=<?php echo $row['idSanPham'] ?>">
                <li class="item">
                    <img class="item-img" src="../admin/modules/sanpham/uploads/<?php echo $row['hinhAnh']?>">
                    <div class="item-text">
                        <?php echo $row['tenSanPham'] ?> <br>
                        <b>$<?php echo $row['giaBan'] ?>.00 USD</b>
                    </div>
                </li></a>
                <?php }?>
            </div>
        </ul>
    </div>