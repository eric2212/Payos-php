<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = uniqid();
    $amount = $_POST["amount"];
    $customer_name = $_POST["customer_name"];
    $customer_email = $_POST["customer_email"];

    // Lưu đơn hàng vào database
    $stmt = $conn->prepare("INSERT INTO orders (order_id, amount, customer_name, customer_email, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("siss", $order_id, $amount, $customer_name, $customer_email);
    $stmt->execute();
    
    // Gửi yêu cầu thanh toán đến PayOS
    $payload = [
        "merchant_id" => PAYOS_MERCHANT_ID,
        "amount" => $amount,
        "order_id" => $order_id,
        "description" => "Thanh toán đơn hàng " . $order_id,
        "return_url" => PAYOS_RETURN_URL,
        "cancel_url" => PAYOS_CANCEL_URL,
        "callback_url" => PAYOS_CALLBACK_URL
    ];
    
    $ch = curl_init("https://api.payos.vn/payment");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . PAYOS_API_KEY
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $result = json_decode($response, true);
    
    if (isset($result['payment_url'])) {
        header("Location: " . $result['payment_url']);
        exit();
    } else {
        echo "Lỗi khi tạo thanh toán.";
    }
}
?>
