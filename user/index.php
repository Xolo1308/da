<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
} else {
    if ($_SESSION['role'] != 1) {
        header("Location: ./index.php");
        exit;
    }
}

?>

  <li class="nav-header">
        <div class="dropdown profile-element"> <span>                         
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $_SESSION['name'] ?></strong>
                             </span> <span class="text-muted text-xs block"><b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="tk_user.php">Thông tin người dùng</a></li>
                            <li><a href="QLTD.php">Quản lý tin đăng</a></li>

                            <li><a href="logout.php">Logout</a></li>
                        </ul>
        </div>
            <div class="logo-element">
                    
            </div>
 </li>