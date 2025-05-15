<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include('../connect.php');

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM motel WHERE user_id = $user_id";
$result = mysqli_query($con, $sql);
?>

<h2>Tin đăng của bạn</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Địa chỉ</th>
            <th>Tiện ích</th>
            <th>Ngày tạo</th>

            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td>
                    <img src="../upload/<?= htmlspecialchars($row['images']) ?>" alt="Hình ảnh" style="width: 100px; height: 100px;">
                <td><?= number_format($row['price']) ?> VNĐ</td>
                <td><?= htmlspecialchars($row['address']) ?></td>
                 <td><?= htmlspecialchars($row['utilities']) ?></td>
                <td><?= $row['created_at'] ?></td>
                <td><?= $row['approve'] == 1 ? '✔️ Đã duyệt' : '⏳ Chờ duyệt' ?></td>
                <td>
                    <a href="update_QLTD.php?id=<?= $row['ID'] ?>">Sửa</a> |
                    <a href="delete_QLTD.php?id=<?= $row['ID'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')">Xoá</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="index.php" class="btn btn-edit">Quay về</a>

