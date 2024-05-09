<?php
    $sql_lay_danhmuc = "SELECT * FROM danhmuc WHERE idDanhMuc ='$_GET[iddanhmuc]' LIMIT 1";
    $query = mysqli_query($conn,$sql_lay_danhmuc);

    $row = mysqli_fetch_assoc($query);
?>

<a href="index.php?action=danhmuc&query=lietke"><button style="float: right;" class="button-a" type= "button"><h3>Quay lại</h3></button></a>

<h3>Sửa Phân Loại</h3><br><br>
<form method="POST" action="modules/danhmuc/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>">
    
        *Tên phân loại <br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="tenDanhMuc" value="<?php echo $row['tenDanhMuc'] ?>">
        <br><br><br>
        <button name="suaDanhMuc" class="button-a" type="submit"><h3>Lưu</h3></button></a>
   
</form>