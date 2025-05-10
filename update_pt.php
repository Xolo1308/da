<?php
include('admin/include/header.php');
include('admin/include/sidebar.php');
include('admin/include/top.php');
include('connect.php'); // chứa kết nối csdl

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM motel WHERE ID = $id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $area = $_POST['area'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $category_id = $_POST['category_id'];
    $district_id = $_POST['district_id'];
    $approve = $_POST['approve'];
    $utilities = $_POST['utilities'];

    // Cập nhật ảnh nếu có
    $imageName = $data['images'];
    if ($_FILES['images']['error'] == 0) {
        $target_dir = "upload/";
        $imageName = time() . "_" . basename($_FILES["images"]["name"]);
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["images"]["tmp_name"], $target_file);
    }

    $sql = "UPDATE motel SET 
            title = '$title', description = '$description', price = $price, area = $area,
            address = '$address', phone = '$phone', category_id = $category_id, 
            district_id = $district_id, approve = $approve, utilities = '$utilities',
            images = '$imageName'
            WHERE ID = $id";
    mysqli_query($con, $sql);

}
?>
<div id="page-wrapper" class="gray-bg">
    <div class="wrapper wrapper-content">
<div class="container">
    <h2>Sửa phòng trọ</h2>
    <form method="POST" enctype="multipart/form-data">
        <input name="title" value="<?= $data['title'] ?>" class="form-control mb-2">
        <textarea name="description" class="form-control mb-2"><?= $data['description'] ?></textarea>
        <input name="price" type="number" value="<?= $data['price'] ?>" class="form-control mb-2">
        <input name="area" type="number" value="<?= $data['area'] ?>" class="form-control mb-2">
        <input name="address" value="<?= $data['address'] ?>" class="form-control mb-2">
        <input name="phone" value="<?= $data['phone'] ?>" class="form-control mb-2">
        <input name="utilities" value="<?= $data['utilities'] ?>" class="form-control mb-2">
        <label>Ảnh phòng (hiện tại: <?= $data['images'] ?>)</label>
        <input type="file" name="images" class="form-control mb-2">

        <select name="category_id" class="form-control mb-2">
            <?php
            $res = mysqli_query($con, "SELECT * FROM category");
            while ($cat = mysqli_fetch_assoc($res)) {
                $selected = $cat['ID'] == $data['category_id'] ? 'selected' : '';
                echo "<option value='{$cat['ID']}' $selected>{$cat['Name']}</option>";
            }
            ?>
        </select>

        <select name="district_id" class="form-control mb-2">
            <?php
            $res = mysqli_query($con, "SELECT * FROM districts");
            while ($dist = mysqli_fetch_assoc($res)) {
                $selected = $dist['ID'] == $data['district_id'] ? 'selected' : '';
                echo "<option value='{$dist['ID']}' $selected>{$dist['Name']}</option>";
            }
            ?>
        </select>

        <select name="approve" class="form-control mb-2">
            <option value="0" <?= $data['approve'] == 0 ? 'selected' : '' ?>>Chưa duyệt</option>
            <option value="1" <?= $data['approve'] == 1 ? 'selected' : '' ?>>Đã duyệt</option>
        </select>

        <button class="btn btn-primary">Lưu</button>
        <a href="list_pt.php" class="btn btn-danger">Hủy</a>
    </form>
</div>
</div>
</div>

<?php include('admin/include/footer.php'); ?>
