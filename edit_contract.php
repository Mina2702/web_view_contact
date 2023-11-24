<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if ($_SESSION['user']['Role'] !== 'ADMIN' && $_SESSION['user']['Role'] !== 'SALE') {
    echo "Bạn không có quyền sửa hợp đồng.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "quanlybds_team4");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contractID'])) {
    $contractID = $_POST['contractID'];

    if (!empty($_POST['contractCode']) && !empty($_POST['customerName'])) {
        $updatedContractCode = htmlspecialchars($_POST['contractCode']);
        $updatedCustomerName = $_POST['customerName'];

        // Additional fields
        $updatedYearOfBirth = $_POST['year_of_birth'];
        $updatedSSN = $_POST['ssn'];
        $updatedCustomerAddress = $_POST['customer_address'];
        $updatedMobile = $_POST['mobile'];
        $updatedPropertyID = $_POST['property_id'];
        $updatedDateOfContract = $_POST['date_of_contract'];
        $updatedPrice = $_POST['price'];
        $updatedDeposit = $_POST['deposit'];
        $updatedRemain = $_POST['remain'];
        $updatedStatus = $_POST['status'];

        // Validate numeric fields
        $numericFields = [$updatedYearOfBirth, $updatedSSN, $updatedPropertyID, $updatedPrice, $updatedDeposit, $updatedRemain];
        foreach ($numericFields as $field) {
            if (!is_numeric($field)) {
                echo "Các trường số phải là giá trị số.";
                exit;
            }
        }

        // Retrieve the current status from the database
        $currentStatusQuery = "SELECT Status FROM full_contract WHERE ID = ?";
        $stmtStatus = $conn->prepare($currentStatusQuery);
        $stmtStatus->bind_param("s", $contractID);
        $stmtStatus->execute();
        $stmtStatus->bind_result($currentStatus);
        $stmtStatus->fetch();
        $stmtStatus->close();

        // Prepare and bind SQL update statement
        $updateQuery = "UPDATE full_contract SET 
            Full_Contract_Code=?, Customer_Name=?, 
            Year_Of_Birth=?, SSN=?, Customer_Address=?, 
            Mobile=?, Property_ID=?, Date_Of_Contract=?, 
            Price=?, Deposit=?, Remain=?, Status=?
            WHERE ID=?";
        $stmt = $conn->prepare($updateQuery);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "ssisssisssisi",
            $updatedContractCode,
            $updatedCustomerName,
            $updatedYearOfBirth,
            $updatedSSN,
            $updatedCustomerAddress,
            $updatedMobile,
            $updatedPropertyID,
            $updatedDateOfContract,
            $updatedPrice,
            $updatedDeposit,
            $updatedRemain,
            $updatedStatus,
            $contractID
        );

        // Execute the update query and check for errors
        if ($stmt->execute()) {
            // Check if the status has changed
            if ($currentStatus != $updatedStatus) {
                // Prepare and bind SQL update statement for status
                $updateStatusQuery = "UPDATE full_contract SET Status=? WHERE ID=?";
                $stmtUpdateStatus = $conn->prepare($updateStatusQuery);
                $stmtUpdateStatus->bind_param("is", $updatedStatus, $contractID);

                // Execute the update query and check for errors
                if ($stmtUpdateStatus->execute()) {
                    // Close the PHP tag to insert JavaScript
?>
                    </div>
                    <script>
                        // Show a success notification
                        alert("Cập nhật thông tin hợp đồng và trạng thái thành công.");
                        // Redirect to the home page
                        window.location.href = "viewcontract.php";
                    </script>
        <?php
                    // Reopen the PHP tag
                    return;
                } else {
                    // Handle update status error
                    echo "Lỗi cập nhật trạng thái hợp đồng: " . $stmtUpdateStatus->error;
                }

                $stmtUpdateStatus->close();
            } else {
                // The status has not changed, you can handle this as needed
                echo "Trạng thái không thay đổi.";
            }
        } else {
            // Continue your existing error handling
            echo "Lỗi cập nhật thông tin hợp đồng: " . $stmt->error;
            echo "Debugging info: " . var_export($stmt, true);
        }

        $stmt->close();
    } else {
        echo "Vui lòng nhập đầy đủ thông tin hợp đồng.";
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $contractID = $_GET['id'];

    // Use prepared statement to retrieve contract details
    $contractDetailsQuery = "SELECT * FROM full_contract WHERE ID = ?";
    $stmt = $conn->prepare($contractDetailsQuery);
    $stmt->bind_param("s", $contractID);
    $stmt->execute();
    $contractDetailsResult = $stmt->get_result();

    if ($contractDetailsResult->num_rows > 0) {
        $contract = $contractDetailsResult->fetch_assoc();

        // HTML form for updating contract details
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sửa thông tin Hợp đồng</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }

                div {
                    max-width: 600px;
                    width: 100%;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    margin: auto;
                    /* Center the div horizontally */
                }

                h2 {
                    text-align: center;
                    color: #333;
                }

                label {
                    display: block;
                    margin: 10px 0 5px;
                    color: #555;
                }

                input,
                select,
                button {
                    width: 100%;
                    padding: 8px;
                    margin-bottom: 10px;
                    box-sizing: border-box;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                }

                button {
                    background-color: #4caf50;
                    color: #fff;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 4px;
                    cursor: pointer;
                    transition: background-color 0.3s ease-in-out;
                }

                button:hover {
                    background-color: #45a049;
                }

                /* Thêm vào file style_add_contract.css */
                .back-btn {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #3498db;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 4px;
                    margin-top: 20px;
                    transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
                }

                .back-btn:hover {
                    background-color: #e74c3c;
                    /* Đổi màu hover thành đỏ */
                    color: #fff;
                    /* Màu chữ trắng khi hover */
                }

                a {
                    display: block;
                    margin-top: 10px;
                    text-align: center;
                    text-decoration: none;
                    color: #333;
                }

                a.back-button {
                    background-color: brown;
                    color: #fff;
                    padding: 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    display: block;
                    margin: 0 auto;
                    /* Center the button horizontally */
                }

                a.back-button:hover {
                    margin-bottom: 10px;

                    text-decoration: none;
                    /* Remove line-through on hover */
                    /* Underline on hover */
                }
            </style>
        </head>

        <body>
            <div>
                <h2>Sửa thông tin Hợp đồng</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <input type="hidden" name="contractID" value="<?php echo htmlspecialchars($contract['ID']); ?>">

                    <label>Mã Hợp đồng:</label>
                    <input type="text" name="contractCode" value="<?php echo htmlspecialchars($contract['Full_Contract_Code']); ?>" required readonly>

                    <label>Tên Khách hàng:</label>
                    <input type="text" name="customerName" value="<?php echo htmlspecialchars($contract['Customer_Name']); ?>" required>

                    <label>Năm Sinh:</label>
                    <input type="text" name="year_of_birth" value="<?php echo htmlspecialchars($contract['Year_Of_Birth']); ?>" required>

                    <label>CMND:</label>
                    <input type="text" name="ssn" value="<?php echo htmlspecialchars($contract['SSN']); ?>" required>

                    <label>Địa chỉ Khách hàng:</label>
                    <input type="text" name="customer_address" value="<?php echo htmlspecialchars($contract['Customer_Address']); ?>" required>

                    <label>Điện thoại:</label>
                    <input type="text" name="mobile" value="<?php echo htmlspecialchars($contract['Mobile']); ?>" required>

                    <label>ID Bất động sản:</label>
                    <input type="text" name="property_id" value="<?php echo htmlspecialchars($contract['Property_ID']); ?>" required>

                    <label>Ngày Hợp đồng:</label>
                    <input type="text" name="date_of_contract" id="date_of_contract" value="<?php echo htmlspecialchars($contract['Date_Of_Contract']); ?>" required>

                    <label>Giá:</label>
                    <input type="text" name="price" value="<?php echo htmlspecialchars($contract['Price']); ?>" required>

                    <label>Đặt cọc:</label>
                    <input type="text" name="deposit" value="<?php echo htmlspecialchars($contract['Deposit']); ?>" required>

                    <label>Còn lại:</label>
                    <input type="text" name="remain" value="<?php echo htmlspecialchars($contract['Remain']); ?>" required>

                    <label>Trạng thái:</label>
                    <select name="status" required>
                        <option value="0" <?php echo htmlspecialchars($contract['Status'] == 0) ? 'selected' : ''; ?>>0 - Inactive</option>
                        <option value="1" <?php echo htmlspecialchars($contract['Status'] == 1) ? 'selected' : ''; ?>>1 - Active</option>
                    </select>
                    <button type="submit">Cập nhật Hợp đồng</button>
                    <a href="viewcontract.php" class="back-button">Quay lại</a>
                </form>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "Không tìm thấy thông tin hợp đồng.";
    }

    $stmt->close();
} else {
    // This message should not be displayed when the user hasn't submitted the form
    // echo "Thiếu thông tin ID hợp đồng.";
}

$conn->close();
?>