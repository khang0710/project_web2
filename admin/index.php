<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CottageCore</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/danhmuc.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<?php 
    session_start();
    if (isset($_SESSION['dangNhap'])){
        
    }else{
        header("location:login.php");
    }
?>
<body>
    <?php
    include("config/connetMySQL.php");
    include("modules/header.php");
    include("modules/menu.php");
    include("modules/footer.php");
    ?>

    <script src="../js/script.js"></script>
</body>

</html>