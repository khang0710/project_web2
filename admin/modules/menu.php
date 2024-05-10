<?php 
    $name = $_SESSION['dangNhap'];
    $sql = "SELECT * FROM admin WHERE userName = '".$name."'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
?>
<div class="title">
    <h2>˚₊‧꒰ა Welcome ♡ to AdminCP ໒꒱ ‧₊˚</h2><br>
    <div class="user">~ a d m i n: <?php echo $_SESSION['dangNhap']?> ♡ ~</div>
</div>
<div class="all_menu">
    <div class="menu">
        <ul>
            <?php 
            if ($row['phanQuyen'] == 'admin'){
                echo '<li><a href="index.php?action=taikhoan&query=lietke">Tài khoản ♡</a></li>                ';
            }
            ?>
            <li><a href="index.php?action=danhmuc&query=lietke">Danh mục ✩</a></li>
            <li><a href="index.php?action=sanpham&query=lietke">Sản phẩm ☾</a></li>
            <li><a href="index.php?action=donhang&query=lietke">Đơn hàng 𖦹</a></li>
            <li><a href="index.php?action=khachhang&query=lietke">Khách hàng ୨୧</a></li>
            <li><a href="index.php?action=nhaphang&query=lietke">Nhập hàng =༚=</a></li>
            <li><a href="index.php?action=thongke&query=thongke">Thống kê •༚• ྀི</a></li>
            <li><a href="index.php?action=dangxuat&query=dangxuat">ĐĂNG XUẤT!</a></li>
        </ul>
    </div>
    <div class="content">
        <?php
            include("main.php");
        ?>
    </div>
</div>

<!-- <div class="title">
    <h2>˚₊‧꒰ა Welcome ♡ to AdminCP ໒꒱ ‧₊˚</h2><br>
    <div class="user">~ a d m i n: <?php echo $_SESSION['dangNhap']?> ♡ ~</div>
</div>
<div class="all_menu">
    <div class="menu">
        <ul>
            <li><a href="index.php?action=danhmuc&query=lietke">Danh mục ⋆｡°✩</a></li>
            <li><a href="index.php?action=sanpham&query=lietke">Sản phẩm ₊˚.☾⋆⁺₊</a></li>
            <li><a href="index.php?action=donhang&query=lietke">Đơn hàng ⋆｡𖦹°‧</a></li>
            <li><a href="index.php?action=khachhang&query=lietke">Khách hàng⋅˚୨୧ ‧₊˚⋅</a></li>
            <li><a href="index.php?action=nhacungcap&query=lietke">Nhà cung cấp^•༚• ྀི≼</a></li>
            <li><a href="index.php?action=nhaphang&query=lietke">Nhập hàng=>༚<=</a></li>
            <li><a href="index.php?action=dangxuat&query=dangxuat">ĐĂNG XUẤT!</a></li>
        </ul>
    </div>
    <div class="content">
        <?php
            //include("main.php");
        ?>
    </div>
</div> -->