<?php
session_start();
include('../connect.php');

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE Username = '$username' AND Password = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['username'] = $user['Username'];
        $_SESSION['role'] = $user['Role'];
        $_SESSION['name'] = $user['Name'];
        $_SESSION['avatar'] = $user['Avatar'];
        
        header("Location: ./index.php");
        exit;
    } else {
        $error = "Sai tên đăng nhập hoặc mật khẩu!";
    }
}
?>

<h2>Đăng nhập</h2>
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    <input name="username" placeholder="Tên đăng nhập" required class="form-control mb-2">
    <input name="password" type="password" placeholder="Mật khẩu" required class="form-control mb-2">
    <button class="btn btn-primary">Đăng nhập</button>
</form>
