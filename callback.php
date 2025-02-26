<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($data && isset($data['order_id'])) {
    $order_id = $data['order_id'];
    $status = $data['status']; // success hoặc failed

    // Cập nhật trạng thái đơn hàng trong database
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->bind_param("ss", $status, $order_id);
    $stmt->execute();

    http_response_code(200);
    echo json_encode(["message" => "OK"]);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Dữ liệu không hợp lệ"]);
}
?>
