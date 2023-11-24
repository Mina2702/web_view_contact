<?php
session_start(); // Bắt đầu phiên làm việc

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
    header("Location: index.php"); // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    exit();
}

// Kiểm tra xem người dùng có quyền xóa hay không
if ($_SESSION['user']['Role'] != 'ADMIN') {
    echo "Bạn không có quyền xóa hợp đồng.";
    exit();
}

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "quanlybds_team4");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem có giá trị ID truyền vào không
if (isset($_GET['id'])) {
    $contractID = $_GET['id'];

    // Xử lý xóa hợp đồng từ cơ sở dữ liệu
    $deleteContractQuery = "DELETE FROM full_contract WHERE ID = $contractID";
    if ($conn->query($deleteContractQuery) === TRUE) {
        // Xóa thành công, chuyển hướng về trang danh sách hợp đồng
        header("Location: viewcontract.php");
        exit();
    } else {
        echo "Lỗi xóa hợp đồng: " . $conn->error;
        exit();
    }
} else {
    echo "Không có ID hợp đồng.";
    exit();
}

?>
