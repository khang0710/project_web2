<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CottageCore</title>
    <link rel="stylesheet" type="text/css" href="../css/TrangChu.css">
    <link rel="stylesheet" type="text/css" href="../css/Login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
    include("../admin/config/connetMySQL.php");
    if (isset($_POST['dangKy'])) {
        $email = $_POST['email'];
        $sql_check_email = "SELECT COUNT(*) AS total FROM khachhang WHERE email = '$email'";
        $result_check_email = mysqli_query($conn, $sql_check_email);
        $row = mysqli_fetch_assoc($result_check_email);
        $total_emails = $row['total'];

        if ($total_emails > 0) {
            echo "<script>alert('Email này đã tồn tại. Vui lòng nhập email khác!');</script>";
        } else {
            // Email chưa tồn tại
            $tenKhachHang = $_POST['tenKhachHang'];
            $email = $_POST['email'];
            $password = $_POST['passWord'];
            $sql_insert = "INSERT INTO khachhang (tenKhachHang, email, passWord, trangThai) VALUES ('$tenKhachHang', '$email', '$password', '0')";
            if (mysqli_query($conn, $sql_insert)) {
                echo "<script>alert('Đăng ký thành công!\\nVui lòng đăng nhập!');</script>";
                echo "<script>window.location.href = 'Login.php';</script>";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
    }
    include("../pages/page_item/header.php");
    ?>
    <form action="" method="POST" onsubmit="return validateForm()">
        <div class="login">
            <h2>Đăng Ký</h2>
            Vui lòng nhập đầy đủ thông tin sau:
            <div class="inputs_login">
                <ul>
                    <input type="text" name="tenKhachHang" class="Input" id="tenKH" placeholder="Họ tên">
                </ul>
                <ul>
                    <input type="text" name="email" class="Input" id="email" placeholder="Email">
                </ul>
                <ul>
                    <input type="password" name="passWord" class="Input" id="password" placeholder="Mật khẩu">
                </ul>
            </div>
            <button type="submit" name="dangKy" id="loginButton">ĐĂNG KÝ</button>
        </div>
    </form>
    <?php
    include("../pages/page_item/footer.php");
    ?>

    <script>
        function validateForm() {
            var ten = document.getElementById("tenKH").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            if (ten == "" || email == "" || password == "") {
                alert("Vui lòng nhập đầy đủ thông tin!");
                return false; // Ngăn không gửi biểu mẫu
            }
        }
    </script>
</body>

</html>