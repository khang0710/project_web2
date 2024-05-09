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
    session_start();
    include("../admin/config/connetMySQL.php");
    if (isset($_POST["dangNhapKH"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM khachhang WHERE email = '" . $email . "' AND passWord = '" . $password . "' LIMIT 1";
        $row = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($row);
        $query = mysqli_fetch_assoc($row);
        if ($count == 1) {
            $_SESSION["dangNhapKH"] = $query['idKhachHang'];
            header("location:User.php");
        } else {
            echo "<script>alert('Email hoặc mật khẩu không đúng!');</script>";
            echo "<script>window.location.href = 'Login.php';</script>";
        }
    }
    if (isset($_GET['action']) =='dangxuat'){
        unset($_SESSION['dangNhapKH']);
        header("location:Login.php");
    }
    include("../pages/page_item/header.php");
    ?>
    <form action="" method="POST" onsubmit="return validateForm()">
        <div class="login">
            <h2>Đăng Nhập</h2>
            Vui lòng nhập email và mật khẩu:
            <div class="inputs_login">
                <ul>
                    <input type="text" name="email" class="Input" id="email" placeholder="Email">
                </ul>
                <ul>
                    <input type="password" name="password" class="Input" id="password" placeholder="Mật khẩu">
                </ul>
            </div>
            <div class="forgot">
                <a href="#">Quên mật khẩu?</a>
            </div>
            <button type="submit" name="dangNhapKH" id="loginButton">ĐĂNG NHẬP</button>
            <div class="donthaveacc">
                Bạn chưa có tài khoản? <a href="http://localhost/CottagecoreWeb/pages/Register.php">Đăng ký?</a>
            </div>
        </div>
        </form>
        <?php
        include("../pages/page_item/footer.php");
        ?>

        <script>
            function validateForm() {
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                if (email == "" || password == "") {
                    alert("Vui lòng nhập đầy đủ thông tin!");
                    return false; // Ngăn không gửi biểu mẫu
                }
            }
        </script>
</body>

</html>