<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CottageCore</title>
    <link rel="stylesheet" type="text/css" href="../css/Header.css">
    <link rel="stylesheet" type="text/css" href="../css/Giohang.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
    session_start();
    ?>
    <?php
    include("../../admin/config/connetMySQL.php");
    include("../header.php");
    ?>
    <div class="title">
        <h3>Giỏ Hàng</h3><br><br>
        Đơn hàng có giá trị trên $500.00 USD sẽ được miễn phí ship!
    </div>
    <div class="main">
        <?php include("giohang.php");
        ?>
    </div>
    <?php
    include("../footer.php");
    ?>

    <script src="../js/header.js"></script>
</body>

</html>