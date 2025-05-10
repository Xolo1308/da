<?php
include('admin/include/header.php'); // chứa <html><head>...<body>

include('admin/include/sidebar.php'); // chứa sidebar
include('admin/include/top.php');    // chứa navbar top
include('connect.php'); // chứa kết nối csdl


// Bước 2: Xử lý dữ liệu lọc và truy vấn DB
$currentYear = date("Y");
$sql = "
    SELECT MONTH(created_at) AS month, COUNT(*) AS total
    FROM motel
    WHERE YEAR(created_at) = $currentYear
    GROUP BY MONTH(created_at)
    ORDER BY month ASC
";
$result = mysqli_query($con, $sql);

// Chuẩn bị dữ liệu
$months = [];
$totals = [];

while ($row = mysqli_fetch_assoc($result)) {
    $months[] = $row['month'];
    $totals[] = $row['total'];
}
?>

    <!-- Main content wrapper -->
<div id="page-wrapper" class="gray-bg">
    <div class="wrapper wrapper-content">
      
<h2>Thống kê số tin đăng theo tháng (<?= $currentYear ?>)</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tháng</th>
            <th>Số lượng tin đăng</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 1; $i <= 12; $i++) {
            $count = in_array($i, $months) ? $totals[array_search($i, $months)] : 0;
            echo "<tr><td>Tháng $i</td><td>$count</td></tr>";
        }
        ?>
    </tbody>
</table>

    </div>
</div>



<?php
include('admin/include/footer.php'); // chứa </body></html>
?>
