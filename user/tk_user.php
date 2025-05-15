<?php
session_start();
include('../connect.php'); // chứa kết nối csdl


$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE ID = $user_id";

$result = mysqli_query($con, $sql);


?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 20px;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    thead {
        background-color: #007bff;
        color: white;
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    img {
        border-radius: 8px;
        max-width: 100px;
        height: auto;
    }

    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
        margin: 4px;
        display: inline-block;
        min-width: 110px;
    }

    .btn-edit {
        background-color: #007bff;
    }

    .btn-edit:hover {
        background-color: #0056b3;
    }

    .btn-password {
        background-color: #28a745;
    }

    .btn-password:hover {
        background-color: #1e7e34;
    }

    .wrapper-content {
        max-width: 1100px;
        margin: auto;
    }
</style>


    <!-- Main content wrapper -->
    <div id="page-wrapper" class="gray-bg">
       <div class="wrapper wrapper-content">
      
     
    <h2>Thông tin người dùng</h2>
    
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
                    <img src="../upload/<?= htmlspecialchars($row['Avatar']) ?>" alt="Hình ảnh" style="width: 100px; height: auto;">
                </td>
                <td>
                   <a href="update_user.php?id=<?= $row['ID'] ?>" class="btn btn-edit">✏️ Sửa</a>
                   <a href="update_password.php?id=<?= $row['ID'] ?>" class="btn btn-password">🔒 Đổi mật khẩu</a>

                     
            </tr>
        <?php endwhile; ?>
        </tbody>
        
    </table>
<a href="index.php" class="btn btn-edit">Quay về</a>
</div>
    



<?php

?>