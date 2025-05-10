<?php
include('admin/include/header.php');
include('admin/include/sidebar.php');
include('admin/include/top.php');
include('connect.php');

if (!isset($_GET['id'])) {
    echo "Không tìm thấy người dùng!";
    exit;
}

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE ID = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST['Name'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Role = $_POST['Role'];
    $Phone = $_POST['Phone'];

    // Kiểm tra Username đã tồn tại (ngoại trừ chính user đang sửa)
    $check = mysqli_query($con, "SELECT * FROM user WHERE Username = '$Username' AND ID != $id");
    if (mysqli_num_rows($check) > 0) {
        echo "Tên đăng nhập đã tồn tại!";
    } else {
        // Xử lý ảnh nếu có upload mới
        $imageName = $user['Avatar']; // giữ ảnh cũ
        if (!empty($_FILES['Avatar']['name'])) {
            $target_dir = "upload/";
            $imageName = time() . "_" . basename($_FILES["Avatar"]["name"]);
            $target_file = $target_dir . $imageName;

            if (!move_uploaded_file($_FILES["Avatar"]["tmp_name"], $target_file)) {
                echo "Upload ảnh thất bại!";
            }
        }

        // Cập nhật CSDL
        $sql = "UPDATE user SET 
                Name = '$Name',
                Username = '$Username',
                Email = '$Email',
                Password = '$Password',
                Role = $Role,
                Phone = '$Phone',
                Avatar = '$imageName'
                WHERE ID = $id";

        mysqli_query($con, $sql);
        header("Location: list_user.php");
    }
}
?>

<div id="page-wrapper" class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="container">
            <h2>Sửa thông tin người dùng</h2>
            <form method="POST" enctype="multipart/form-data">
                <input name="Name" value="<?= $user['Name'] ?>" placeholder="Họ và tên" required class="form-control mb-2">
                <input name="Username" value="<?= $user['Username'] ?>" placeholder="Tên đăng nhập" class="form-control mb-2">
                <input name="Email" value="<?= $user['Email'] ?>" placeholder="Email" class="form-control mb-2">
                <input name="Password" value="<?= $user['Password'] ?>" placeholder="Password" class="form-control mb-2">
                <input type="number" name="Role" value="<?= $user['Role'] ?>" placeholder="Vai trò" class="form-control mb-2">
                <input name="Phone" value="<?= $user['Phone'] ?>" placeholder="SĐT liên hệ" class="form-control mb-2">

                <label>Ảnh người dùng</label><br>
                <?php if ($user['Avatar']) echo "<img src='upload/{$user['Avatar']}' width='100'><br>"; ?>
                <input type="file" name="Avatar" class="form-control mb-2">
              
                <button class="btn btn-primary">Cập nhật</button>
                <a href="list_user.php" class="btn btn-danger">Hủy</a>
            </form>
        </div>
    </div>
</div>

<?php include('admin/include/footer.php'); ?>
