<?php
session_start(); // Bắt đầu phiên làm việc

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "quanlybds_team4");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tạo bảng full_contract nếu nó chưa tồn tại
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS full_contract (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        Full_Contract_Code VARCHAR(15) NOT NULL,
        Customer_Name VARCHAR(50) NOT NULL,
        Year_Of_Birth INT NOT NULL,
        SSN VARCHAR(15) NOT NULL,
        Customer_Address VARCHAR(100) NOT NULL,
        Mobile VARCHAR(15) NOT NULL,
        Property_ID INT NOT NULL,
        Date_Of_Contract DATE NOT NULL,
        Price DECIMAL(18, 0) NOT NULL,
        Deposit DECIMAL(18, 0) NOT NULL,
        Remain DECIMAL(18, 0) NOT NULL,
        Status BOOLEAN NOT NULL
    );
";

if ($conn->query($createTableQuery) === FALSE) {
    echo "Lỗi tạo bảng: " . $conn->error;
}

// Hiển thị danh sách hợp đồng đầy đủ và liên kết để thêm hợp đồng mới
$sql = "SELECT * FROM full_contract";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<h2>Danh sách Hợp đồng Đầy đủ</h2>
            <div class="search-container">
                <input type="text" class="search-box" id="search" placeholder="Tìm kiếm..." onkeyup="searchContracts()">
                <button class="search-btn" onclick="searchContracts()">Tìm kiếm</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th onclick="toggleSort(0)">ID</th>
                        <th onclick="toggleSort(1)">Mã Hợp đồng</th>
                        <th onclick="toggleSort(2)">Tên Khách hàng</th>
                        <th onclick="toggleSort(3)">Năm Sinh</th>
                        <th onclick="toggleSort(4)">CMND</th>
                        <th onclick="toggleSort(5)">Địa chỉ Khách hàng</th>
                        <th onclick="toggleSort(6)">Điện thoại</th>
                        <th onclick="toggleSort(7)">ID Bất động sản</th>
                        <th onclick="toggleSort(8)">Ngày Hợp đồng</th>
                        <th onclick="toggleSort(9)">Giá</th>
                        <th onclick="toggleSort(10)">Đặt cọc</th>
                        <th onclick="toggleSort(11)">Còn lại</th>
                        <th onclick="toggleSort(11)">Trạng thái</th>
                        <th onclick="toggleSort(12)">Thay đổi</th>';
}
    echo '</tr>
                </thead>
                <tbody>';

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['Full_Contract_Code']}</td>
                <td>{$row['Customer_Name']}</td>
                <td>{$row['Year_Of_Birth']}</td>
                <td>{$row['SSN']}</td>
                <td>{$row['Customer_Address']}</td>
                <td>{$row['Mobile']}</td>
                <td>{$row['Property_ID']}</td>
                <td>{$row['Date_Of_Contract']}</td>
                <td>{$row['Price']}</td>
                <td>{$row['Deposit']}</td>
                <td>{$row['Remain']}</td>
                <td>{$row['Status']}</td>";

        // Hiển thị nút Thao tác cho người dùng có quyền admin hoặc sale
        if ($_SESSION['user']['Role'] == 'ADMIN' || $_SESSION['user']['Role'] == 'SALE') {
            echo '<td><a href="edit_contract.php?id=' . $row['ID'] . '">Sửa</a> | <a href="delete_contract.php?id=' . $row['ID'] . '">Xóa</a></td>';
        }

        echo "</tr>";
    }

    echo '</tbody>
            </table>';

    // Move the button-container outside the table
    echo '<div class="button-container">';
    // Hiển thị nút Thêm Hợp đồng cho người dùng có quyền admin hoặc sale
    if ($_SESSION['user']['Role'] == 'ADMIN' || $_SESSION['user']['Role'] == 'SALE') {
        echo '<a href="add_fullcontract.php" class="add-contract-btn">Thêm Hợp đồng</a>';

    echo '<a href="index.php" class="logout-btn">Đăng xuất</a>';
    echo '</div>';
} else {
    echo "<p>Không tìm thấy hợp đồng nào.</p>";
}

// JavaScript cho chức năng tìm kiếm và sắp xếp cột
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Danh sách Hợp đồng Đầy đủ</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;}


        /* Thêm CSS cho thanh tìm kiếm */
        .search-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-box {
            width: 70%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-btn {
            padding: 10px 16px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-btn:hover {
            background-color: #2980b9;
        }

        /* Thêm CSS cho sắp xếp cột */
        th {
            cursor: pointer;
            padding: 10px;
            text-align: left;
            background-color: #3498db;
            color: #fff;
        }

        /* Cải thiện kiểu dáng của bảng */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th:hover {
            background-color: #2980b9;
        }

        /* Thêm CSS cho nút */
        .button-container {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .add-contract-btn,
        .logout-btn {
            padding: 10px 16px;
            margin-right: 10px;
            text-decoration: none;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .add-contract-btn {
            background-color: #27ae60;
        }

        .add-contract-btn:hover {
            background-color: #219952;
        }

        .logout-btn {
            background-color: #e74c3c;
            padding: 10px 16px;
            text-decoration: none;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        footer {
        position: fixed;
        bottom: 0;
        right: 0;
        margin: 10px;
        display: flex;
        align-items: center;
    }

   
    </style>
</head>

<body>
    <div class = logo>
        <img src="logo.png" alt="" />
    </div>
    <style>
        .logo {
        position: absolute;
        top: 0;
        left: 0px;
        width: 30%;
        margin: 10px; /* Add margin for better spacing */

    }
    </style>
    <!-- JavaScript cho chức năng tìm kiếm và sắp xếp cột -->
    <script>
        function searchContracts() {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                found = false;
                // Duyệt qua tất cả các cột trong mỗi hàng
                for (j = 0; j < tr[i].cells.length; j++) {
                    td = tr[i].cells[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        // Sửa điều kiện để cho phép tìm kiếm từ 2 ký tự
                        if (filter.length < 2 || txtValue.toUpperCase().includes(filter)) {
                            found = true;
                            break;
                        }
                    }
                }

                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // Hàm toggleSort thực hiện sắp xếp các hàng của bảng dựa trên giá trị của một cột.
        function toggleSort(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.querySelector("table");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;

                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                    // So sánh và đổi chỗ hai hàng nếu cần
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                // Di chuyển hàng nếu cần thiết
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
    </script>

</body>


</html>