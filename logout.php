<?php
session_start(); // Khởi động session

// Hủy bỏ session người dùng
unset($_SESSION['user']);

// Chuyển hướng về trang đăng nhập
header("Location: index.php");
exit;
?>
