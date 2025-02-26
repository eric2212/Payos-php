<?php
// Cấu hình thông tin API PayOS
define('PAYOS_API_KEY', 'your_api_key_here');
define('PAYOS_MERCHANT_ID', 'your_merchant_id');
define('PAYOS_SECRET_KEY', 'your_secret_key');
define('PAYOS_RETURN_URL', 'https://yourdomain.com/success.php');
define('PAYOS_CANCEL_URL', 'https://yourdomain.com/fail.php');
define('PAYOS_CALLBACK_URL', 'https://yourdomain.com/callback.php');

// Cấu hình kết nối MySQL
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_db_name');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_db_password');

// Kết nối Database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Lỗi kết nối MySQL: " . $conn->connect_error);
}
?>
