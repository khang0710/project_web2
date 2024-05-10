<a href="javascript:history.back()"><button style="float: right;" class="button-a" type="button">
        <h3>Quay lại</h3>
    </button></a>
<h3>Thêm Tài Khoản</h3><br><br>
<form method="POST" action="modules/taikhoan/xuly.php">
    
        <b>*UserName</b> <br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="userName">
        <br><br>
        <b>*Password</b><br><br>
        <input style="font-size: 18px; padding:8px;" type="text" name="passWord">
        <br><br>
        <b>*Chức vụ</b><br><br>
        <select name="phanQuyen" id="" style="font-size: 18px; padding:8px;">
                <option value="admin">Admin</option>
                <option value="staff">Nhân viên</option>
        </select>
        <br><br>
        <br>
        <button class="button-a" name="themDanhMuc" type="submit"><h3>Lưu</h3></button></a>
   
</form>