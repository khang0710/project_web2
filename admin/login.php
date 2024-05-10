<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admincp</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/danhmuc.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
    session_start();
    include("config/connetMySQL.php");
    if (isset($_POST["dangNhap"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM admin WHERE userName = '" . $username . "' AND password = '" . $password . "' LIMIT 1";
        $row = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($row);
        if ($count == 1) {
            $status = mysqli_fetch_assoc($row);
            if ($status['trangThai'] != 0) {
                $_SESSION["dangNhap"] = $username;
                header("location:index.php");
            } else {
                echo "<script>alert('Tài khoản của bạn đã bị khóa!');</script>";
                echo "<script>window.location.href = 'login.php';</script>";
            }
        } else if ($username == "") {
            echo "<script>alert('Vui lòng nhập tên đăng nhập hoặc mật khẩu!');</script>";
        } else {
            echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        }
    }
    include("config/connetMySQL.php");
    include("modules/header.php");
    ?>
    <form action="" method="POST">
        <div class="login">
            <h2>Đăng Nhập ADMIN</h2>
            Vui lòng nhập tên người dùng và mật khẩu:
            <div class="inputs_login">
                <ul>
                    <input type="text" name="username" id="uInput" placeholder="Tên đăng nhập">
                </ul>
                <ul>
                    <input type="password" name="password" id="pInput" placeholder="Mật khẩu">
                </ul>
            </div>
            <div class="forgot">
                <a href="#">Quên mật khẩu?</a>
            </div>
            <button type="submit" name="dangNhap" id="loginButton">ĐĂNG NHẬP</button>
            <div class="donthaveacc">
                Bạn chưa có tài khoản? <a href="#">Đăng ký?</a>
            </div>
        </div>
    </form>
    <?php
    include("modules/footer.php");
    ?>

    <script src="../js/script.js"></script>
</body>

</html>