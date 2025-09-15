<?php
include "../func/conn.php";

header("Content-Type: application/json");

// ตรวจสอบว่าเป็น Admin เท่านั้นที่สามารถลบ user ได้
if(!isset($_SESSION["id"]) || !isset($_SESSION["rold"]) || $_SESSION["rold"] != 1) {
    echo json_encode(["success" => false, "message" => "คุณไม่มีสิทธิ์ในการดำเนินการนี้"]);
    exit;
}

if(isset($_POST["user_id"])) {
    $user_id = intval($_POST["user_id"]);
    
    // ตรวจสอบว่า user_id ถูกต้อง
    if($user_id <= 0) {
        echo json_encode(["success" => false, "message" => "ID ผู้ใช้ไม่ถูกต้อง"]);
        exit;
    }
    
    // ตรวจสอบว่าไม่ใช่การลบตัวเอง
    if($user_id == $_SESSION["id"]) {
        echo json_encode(["success" => false, "message" => "ไม่สามารถลบบัญชีของตัวเองได้"]);
        exit;
    }
    
    // ตรวจสอบว่า user นี้มีอยู่จริง
    $checkUser = $conn->query("SELECT * FROM account WHERE id_account = $user_id");
    
    if($checkUser->num_rows == 0) {
        echo json_encode(["success" => false, "message" => "ไม่พบผู้ใช้นี้ในระบบ"]);
        exit;
    }
    
    // ตรวจสอบว่า user นี้มีการจองหรือไม่
    $checkBookings = $conn->query("SELECT COUNT(*) as booking_count FROM bookings WHERE user_id = $user_id AND status != 'cancelled'");
    $bookingResult = $checkBookings->fetch_assoc();
    
    if($bookingResult['booking_count'] > 0) {
        // ถ้ามีการจองที่ยังไม่ได้ยกเลิก ให้ยกเลิกการจองทั้งหมดก่อน
        $cancelBookings = $conn->query("UPDATE bookings SET status = 'cancelled' WHERE user_id = $user_id AND status != 'cancelled'");
        
        if(!$cancelBookings) {
            echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาดในการยกเลิกการจอง"]);
            exit;
        }
    }
    
    // ลบผู้ใช้
    $deleteUser = $conn->query("DELETE FROM account WHERE id_account = $user_id");
    
    if($deleteUser) {
        echo json_encode([
            "success" => true, 
            "message" => "ลบผู้ใช้สำเร็จ" . ($bookingResult['booking_count'] > 0 ? " (และยกเลิกการจอง " . $bookingResult['booking_count'] . " รายการ)" : "")
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาดในการลบผู้ใช้" . $conn->error]);
    }
    
} else {
    echo json_encode(["success" => false, "message" => "ไม่ได้ระบุ ID ผู้ใช้"]);
}

$conn->close();
?>