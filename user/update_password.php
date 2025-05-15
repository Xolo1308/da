<?php
include('../connect.php');

if (!isset($_GET['id'])) {
    echo "Không tìm thấy người dùng!";
    exit;
}

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE ID = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($current_password !== $user['Password']) {
        $error = "Mật khẩu hiện tại không đúng!";
    } elseif ($new_password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp!";
    } else {
        $sql = "UPDATE user SET Password = '$new_password' WHERE ID = $id";
        mysqli_query($con, $sql);
        header("Location: index.php");
        exit;
    }

}
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

    .container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        max-width: 600px;
        margin: auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        color: white;
        cursor: pointer;
        font-size: 16px;
        margin-right: 10px;
        transition: background-color 0.3s;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    p {
        color: red;
        font-weight: bold;
    }
</style>


<div id="page-wrapper" class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="container">
            <h2>Đổi mật khẩu cho người dùng: <?= htmlspecialchars($user['Username']) ?></h2>

            <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

            <form method="POST">
                <input type="password" name="current_password" placeholder="Mật khẩu hiện tại" required class="form-control mb-2">
                <input type="password" name="new_password" placeholder="Mật khẩu mới" class="form-control mb-2" required>
                <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" class="form-control mb-2" required>

                  
                <button class="btn btn-success">Cập nhật mật khẩu</button>
                <a href="tk_user.php" class="btn btn-danger">Hủy</a>
            </form>
        </div>
    </div>
</div>
