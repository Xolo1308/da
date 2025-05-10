<?php
include('admin/include/header.php'); // chứa <html><head>...<body>

include('admin/include/sidebar.php'); // chứa sidebar
include('admin/include/top.php');    // chứa navbar top
include('connect.php'); // chứa kết nối csdl


$sql = "SELECT *
        FROM user 
       ";
$result = mysqli_query($con, $sql);
?>

    <!-- Main content wrapper -->
    <div id="page-wrapper" class="gray-bg">
       <div class="wrapper wrapper-content">
      
      <div class="container">
    <h2>Thông tin người dùng</h2>
    <a href="add_user.php" class="btn btn-primary">Thêm thông tin</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên </th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Password</th>
                <th>Vai trò</th>          
                <th>Số điện thoại</th>
                 <th>Hình Ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['ID']) ?></td>
                <td><?= htmlspecialchars($row['Name']) ?></td>
                
                <td><?= htmlspecialchars($row['Username']) ?></td>
               
                <td><?= htmlspecialchars($row['Email']) ?></td>
                <td><?= htmlspecialchars($row['Password']) ?></td>
                <td>
                    <?= $row['Role'] == 1 ? 'Admin' : 'Người dùng' ?>
               
                <td><?= htmlspecialchars($row['Phone']) ?></td>
                 <td>
                    <img src="upload/<?= htmlspecialchars($row['Avatar']) ?>" alt="Hình ảnh" style="width: 100px; height: auto;">
                </td>
                <td>
                    <a href="update_user.php?id=<?= $row['ID'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete_user.php?id=<?= $row['ID'] ?>" onclick="return confirm('Xác nhận xoá?')" class="btn btn-danger btn-sm">Xoá</a>
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
