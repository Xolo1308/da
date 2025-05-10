<?php
include('admin/include/header.php'); // chứa <html><head>...<body>

include('admin/include/sidebar.php'); // chứa sidebar
include('admin/include/top.php');    // chứa navbar top
include('connect.php'); // chứa kết nối csdl


// Bước 2: Xử lý dữ liệu lọc và truy vấn DB
include('connect.php');

$where = "WHERE 1";
if (!empty($_GET['username'])) {
    $username = $_GET['username'];
    $where .= " AND user.Username LIKE '%$username%'";
}
if (!empty($_GET['from_date']) && !empty($_GET['to_date'])) {
    $from = $_GET['from_date'];
    $to = $_GET['to_date'];
    $where .= " AND motel.created_at BETWEEN '$from' AND '$to'";
}
if (!empty($_GET['min_price']) && !empty($_GET['max_price'])) {
    $min = $_GET['min_price'];
    $max = $_GET['max_price'];
    $where .= " AND motel.price BETWEEN $min AND $max";
}

$sql = "SELECT motel.*, user.Username 
        FROM motel 
        JOIN user ON motel.user_id = user.ID
        $where
        ORDER BY motel.created_at DESC";
$result = mysqli_query($con, $sql);
?>

    <!-- Main content wrapper -->
    <div id="page-wrapper" class="gray-bg">
       <div class="wrapper wrapper-content">
      <!-- Bước 1: Giao diện form lọc -->
<form method="GET">
    <input type="text" name="username" placeholder="Tài khoản đăng" value="<?= $_GET['username'] ?? '' ?>">
    <input type="date" name="from_date" value="<?= $_GET['from_date'] ?? '' ?>"> 
    <input type="date" name="to_date" value="<?= $_GET['to_date'] ?? '' ?>">
    <input type="number" name="min_price" placeholder="Giá phòng từ" value="<?= $_GET['min_price'] ?? '' ?>">
    <input type="number" name="max_price" placeholder="Giá đến" value="<?= $_GET['max_price'] ?? '' ?>">
    <button type="submit">Lọc</button>
</form>
   
    
<table border="1" class="table table-bordered">
      <thead>
    <tr>
        <th>Tiêu đề</th>
        <th>Người đăng</th>
        <th>Giá</th>
        <th>Trạng thái</th>
        <th>Ngày đăng</th>
    </tr>
    </thead>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['title'] ?></td>
            <td><?= $row['Username'] ?></td>
            
            <td><?= $row['price'] ?>VND</td>
            <td><?= $row['created_at'] ?></td>
        </tr>
    <?php } ?>
</table>
</div>
    </div>



<?php
include('admin/include/footer.php'); // chứa </body></html>
?>
