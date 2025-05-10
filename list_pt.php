<?php
include('admin/include/header.php'); // chứa <html><head>...<body>

include('admin/include/sidebar.php'); // chứa sidebar
include('admin/include/top.php');    // chứa navbar top
include('connect.php'); // chứa kết nối csdl


$sql = "SELECT m.*, c.Name AS category_name, u.Name AS user_name 
        FROM motel m 
        JOIN category c ON m.category_id = c.ID 
        JOIN user u ON m.user_id = u.ID";
$result = mysqli_query($con, $sql);
?>

    <!-- Main content wrapper -->
    <div id="page-wrapper" class="gray-bg">
       <div class="wrapper wrapper-content">
      
      <div class="container">
    <h2>Quản lý phòng trọ</h2>
    <a href="add_phong_tro.php" class="btn btn-primary">Thêm phòng trọ</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Hình Ảnh</th>
                <th>Giá</th>
                <th>Trạng thái</th>
           
                <th>Người đăng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                
                <td><?= htmlspecialchars($row['category_name']) ?></td>
                <td>
                    <img src="upload/<?= htmlspecialchars($row['images']) ?>" alt="Hình ảnh" style="width: 100px; height: 100px;">
                </td>
                <td><?= number_format($row['price']) ?> VND</td>
                <td>
                    <?= $row['approve'] == 1 ? 'Đã duyệt' : 'Chưa duyệt' ?>
                </td>
               
                <td><?= htmlspecialchars($row['user_name']) ?></td>
                <td>
                    <a href="update_pt.php?id=<?= $row['ID'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete_pt.php?id=<?= $row['ID'] ?>" onclick="return confirm('Xác nhận xoá?')" class="btn btn-danger btn-sm">Xoá</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
    </div>



<?php
include('admin/include/footer.php'); // chứa </body></html>
?>
