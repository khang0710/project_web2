<?php include('config/connetMySQL.php');
?>
<h3> ✩⋆｡Quản Lý Đơn Hàng</h3><br><br>
<form action="" method="GET">
    <input type="hidden" name="action" value="<?php echo $_GET['action'] ?>">
    <input type="hidden" name="query" value="<?php echo $_GET['query'] ?>">
    <b>Tình trạng:</b>
    <select class="trangThai" name="trangThai" id="trangThai">
        <option value="">Tất cả</option>
        <?php
        $sql = "SELECT * FROM trangthaidh";
        $query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <option value="<?php echo $row['trangThai'] ?>" <?php if (isset($_GET['trangThai']) && $_GET['trangThai'] == $row['trangThai']) echo 'selected'; ?>><?php echo $row['trangThai'] ?></option>
        <?php } ?>
    </select> &emsp;&emsp;
    <label for="start"><b>Từ ngày: </b></label>
    <input type="date" id="start" name="start" value="<?php if (isset($_GET['start']) && $_GET['start'] != "") echo $_GET['start'];?>">
    <label for="end"><b> đến: </b></label>
    <input type="date" id="end" name="end" value="<?php if (isset($_GET['end']) && $_GET['end'] != "") echo $_GET['end'];?>">
    &emsp;&emsp;
    <button type="submit" id="btnLoc">LỌC</button>
</form><br>
<div id="products">
    <?php
        include('list.php');
    ?>
</div>

<style>
    #start,
    #end {
        font-size: medium;
        border: 1px solid #ccc;
        color: #5c5c5c;
        padding: 5px;
    }

    #btnLoc {
        width: 150px;
        font-size: medium;
        border: 1px solid #5c5c5c;
        color: #5c5c5c;
        padding: 8px;
        background-color: white;
    }
</style>