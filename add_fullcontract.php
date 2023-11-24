<?php
// Kết nối đến database
$conn = new mysqli("localhost", "root", "", "quanlybds_team4");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hiển thị form thêm hợp đồng
$showForm = true;

// Xử lý dữ liệu từ form nếu có dữ liệu được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy số cuối cùng trong Contract Code từ cơ sở dữ liệu
    $getLastCodeQuery = "SELECT SUBSTRING(Full_Contract_Code, 10) AS LastCode FROM full_contract ORDER BY LastCode DESC LIMIT 1";
    $getLastCodeResult = $conn->query($getLastCodeQuery);

    if ($getLastCodeResult->num_rows > 0) {
        $lastCode = (int)$getLastCodeResult->fetch_assoc()['LastCode'];
    } else {
        $lastCode = 0;
    }

    // Tạo Contract Code mới với 4 số cuối tăng dần
    $newCode = 'FC2211' . sprintf('%04d', $lastCode + 1);

    // Lấy dữ liệu từ form
    $customerName = $_POST['Customer_Name'];
    $yearOfBirth = $_POST['Year_Of_Birth'];
    $ssn = $_POST['SSN'];
    $customerAddress = $_POST['Customer_Address'];
    $mobile = $_POST['Mobile'];
    $propertyID = $_POST['Property_ID'];
    $dateOfContract = $_POST['Date_Of_Contract'];
    $price = $_POST['Price'];
    $deposit = $_POST['Deposit'];
    $remain = $_POST['Remain'];
    $status = $_POST['Status'];

    // Thực hiện truy vấn thêm hợp đồng
    $stmt = $conn->prepare("INSERT INTO full_contract (Full_Contract_Code, Customer_Name, Year_Of_Birth, SSN, Customer_Address, Mobile, Property_ID, Date_Of_Contract, Price, Deposit, Remain, Status) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssss", $newCode, $customerName, $yearOfBirth, $ssn, $customerAddress, $mobile, $propertyID, $dateOfContract, $price, $deposit, $remain, $status);

    if ($stmt->execute()) {
        // Đóng kết nối
        $stmt->close();
?>
        <script>
            // Display success popup
            alert("Contract added successfully!");

            // Redirect the user to index.php
            window.location.href = 'viewcontract.php';
        </script>
<?php
        exit;
    } else {
        $error_message = "Error adding contract. Please try again later.";
        error_log("Error adding contract: " . $stmt->error);
    }
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_add_contract.css">
    <title>Add Full Contract</title>
</head>

<body>
    <div class="container">
        <h1>Add Full Contract</h1>

        <?php if ($showForm) : ?>
            <form class="contract-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="input-container">
                    <label for="Customer_Name">Customer Name:</label>
                    <input type="text" name="Customer_Name" required>
                </div>

                <div class="input-container">
                    <label for="Year_Of_Birth">Year of Birth:</label>
                    <input type="text" name="Year_Of_Birth" required>
                </div>

                <div class="input-container">
                    <label for="SSN">SSN:</label>
                    <input type="text" name="SSN" required>
                </div>

                <div class="input-container">
                    <label for="Customer_Address">Customer Address:</label>
                    <input type="text" name="Customer_Address" required>
                </div>

                <div class="input-container">
                    <label for="Mobile">Mobile:</label>
                    <input type="text" name="Mobile" required>
                </div>

                <div class="input-container">
                    <label for="Property_ID">Property ID:</label>
                    <input type="text" name="Property_ID" required>
                </div>

                <div class="input-container">
                    <label for="Date_Of_Contract">Date of Contract:</label>
                    <input type="date" name="Date_Of_Contract" required>
                </div>

                <div class="input-container">
                    <label for="Price">Price:</label>
                    <input type="text" name="Price" required>
                </div>

                <div class="input-container">
                    <label for="Deposit">Deposit:</label>
                    <input type="text" name="Deposit" required>
                </div>

                <div class="input-container">
                    <label for="Remain">Remain:</label>
                    <input type="text" name="Remain" required>
                </div>

                <div class="input-container">
                    <label for="Status">Status:</label>
                    <input type="text" name="Status" required>
                </div>

                <div class="button-container">
                    <button type="submit" class="add-btn">Add Contract</button>
                    <button type="button" class="back-btn" onclick="window.location.href='viewcontract.php'">Back to Home</button>
                </div>
            </form>
        <?php else : ?>
            <p>Đã Thêm Hợp Đồng, Đăng nhập lại để xem kết quả!</p>
            <button class="back-btn" onclick="history.back()">Back to Home</button>
        <?php endif; ?>
    </div>
</body>

</html>