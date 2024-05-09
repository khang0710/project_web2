<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CottageCore</title>
    <link rel="stylesheet" type="text/css" href="../css/Header.css">
    <link rel="stylesheet" type="text/css" href="../css/Top.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
    include("../../admin/config/connetMySQL.php");
    include("../header.php");
    ?>
    <div class="t_content">
        Tất Cả <br><br>
    </div>

    <div class="t_main">
        <div class="t_filter">
            <?php include("filter.php"); ?>
        </div>

        <div class="list_items">
            <?php include("list_items.php")?>
        </div>
    </div>
    <?php
    include("../../pages/page_item/footer.php");
    ?>

    <script src="../js/header.js"></script>
</body>

</html>