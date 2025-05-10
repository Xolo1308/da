<?php
include('admin/include/header.php');
include('admin/include/sidebar.php');
include('admin/include/top.php');
include('connect.php');

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST['Name'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Role = $_POST['Role'];
    $Phone = $_POST['phone']; // form ghi 'phone' nên phải dùng đúng tên

    // Xử lý ảnh
    $target_dir = "upload/";
    $imageName = time() . "_" . basename($_FILES["Avatar"]["name"]);
    $target_file = $target_dir . $imageName;

    if (move_uploaded_file($_FILES["Avatar"]["tmp_name"], $target_file)) {
        // Upload thành công
    } else {
        $imageName = ''; // Để tránh lỗi khi không upload
    }

    $sql = "INSERT INTO user (Name, Username, Email, Password, Role, Phone, Avatar)
            VALUES ('$Name', '$Username', '$Email', '$Password', $Role, '$Phone', '$imageName')";
    mysqli_query($con, $sql);
    header('Location: list_user.php');
    exit();
}
?>

?>
<div id="page-wrapper" class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="container">
            <h2>Thêm thông tin người dùng</h2>
            <form method="POST" enctype="multipart/form-data">
       
   
                <input name="Name" placeholder="Họ và tên" required class="form-control mb-2">
                <textarea name="Username" placeholder="Tên đăng nhập" class="form-control mb-2"></textarea>
                <input name="Email" placeholder="Email" class="form-control mb-2">
                <input name="Password" placeholder="password" class="form-control mb-2">
                <input type="number" name="Role" placeholder="Vai trò" class="form-control mb-2">
                <input name="phone" placeholder="SĐT liên hệ" class="form-control mb-2">
                <label>Ảnh người dùng</label>
                <input type="file" name="Avatar" class="form-control mb-2">
                
              
                <button class="btn btn-success">Thêm</button>
                <a href="list_user.php" class="btn btn-danger">Hủy</a>
          
            </form>
        </div>
    </div>
</div>

<?php include('admin/include/footer.php'); 
?>
