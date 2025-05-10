<?php
include('connect.php'); // chứa kết nối csdl
$id = $_GET['id'];

// Xoá ảnh cũ nếu có
$res = mysqli_query($con, "SELECT images FROM motel WHERE ID = $id");
$row = mysqli_fetch_assoc($res);
if ($row && !empty($row['images'])) {
    unlink("uploads/" . $row['images']);
}

// Xoá bản ghi
mysqli_query($con, "DELETE FROM motel WHERE ID = $id");
header('Location: list_pt.php');

?>