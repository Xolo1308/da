<?php
include('connect.php'); // chứa kết nối csdl
$id = $_GET['id'];

// Xoá ảnh cũ nếu có
$res = mysqli_query($con, "SELECT Avatar FROM user WHERE ID = $id");
$row = mysqli_fetch_assoc($res);
if ($row && !empty($row['Avatar'])) {
    unlink("uploads/" . $row['Avatar']);
}

// Xoá bản ghi
mysqli_query($con, "DELETE FROM user WHERE ID = $id");
header('Location: list_user.php');

?>