<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Thanh toán với PayOS</title>
</head>
<body>
    <h2>Thanh toán đơn hàng</h2>
    <form action="pay.php" method="POST">
        <label>Họ và tên:</label>
        <input type="text" name="customer_name" required><br>
        
        <label>Email:</label>
        <input type="email" name="customer_email" required><br>
        
        <label>Số tiền (VNĐ):</label>
        <input type="number" name="amount" required><br>
        
        <button type="submit">Thanh toán</button>
    </form>
</body>
</html>
