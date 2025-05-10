<?php
include('admin/include/header.php');
include('admin/include/sidebar.php');
include('admin/include/top.php');
include('connect.php'); // chứa kết nối csdl

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $area = $_POST['area'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $category_id = $_POST['category_id'];
    $district_id = $_POST['district_id'];
    $user_id =3 ;// Giả định admin là người thêm
    $approve = $_POST['approve'];
    $utilities = $_POST['utilities'];

    // Xử lý ảnh
    $target_dir = "upload/";
$imageName = time() . "_" . basename($_FILES["images"]["name"]);
$target_file = $target_dir . $imageName;

if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
    // upload thành công
} else {
    echo "Upload thất bại!";
}
    // Lưu vào DB
    $sql = "INSERT INTO motel (title, description, price, area, address, phone, user_id, category_id, district_id, approve, utilities, images)
            VALUES ('$title', '$description', $price, $area, '$address', '$phone', $user_id, $category_id, $district_id, $approve, '$utilities', '$imageName')";
    mysqli_query($con, $sql);
    
  
}
?>
<div id="page-wrapper" class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="container">
            <h2>Thêm phòng trọ</h2>
            <form method="POST" enctype="multipart/form-data">
       
   
                <input name="title" placeholder="Tiêu đề" required class="form-control mb-2">
                <textarea name="description" placeholder="Mô tả" class="form-control mb-2"></textarea>
                <input type="number" name="price" placeholder="Giá" class="form-control mb-2">
                <input type="number" name="area" placeholder="Diện tích" class="form-control mb-2">
                <input name="address" placeholder="Địa chỉ" class="form-control mb-2">
                <input name="phone" placeholder="SĐT liên hệ" class="form-control mb-2">
                <input name="utilities" placeholder="Tiện ích (ngăn cách bằng dấu ,)" class="form-control mb-2">
                <label>Ảnh phòng</label>
                <input type="file" name="images" class="form-control mb-2">
                
                <label>Danh mục</label>
                <select name="category_id" class="form-control mb-2">
                    <?php
                $res = mysqli_query($con, "SELECT * FROM category");
                while ($cat = mysqli_fetch_assoc($res)) {
                    echo "<option value='{$cat['ID']}'>{$cat['Name']}</option>";
                }
                    ?>
                </select>

                <label>Khu vực</label>
                <select name="district_id" class="form-control mb-2">
                    <?php
                    $res = mysqli_query($con, "SELECT * FROM districts");
                    while ($dist = mysqli_fetch_assoc($res)) {
                        echo "<option value='{$dist['ID']}'>{$dist['Name']}</option>";
                    }
                    ?>
                </select>

                <label>Trạng thái:</label>
                <select name="approve" class="form-control mb-2">
                    <option value="0">Chưa duyệt</option>
                    <option value="1">Đã duyệt</option>
                </select>
              
                <button class="btn btn-success">Thêm</button>
                <a href="list_pt.php" class="btn btn-danger">Hủy</a>
          
            </form>
        </div>
    </div>
</div>

<?php include('admin/include/footer.php'); 
?>
