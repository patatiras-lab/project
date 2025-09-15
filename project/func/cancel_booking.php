<?php
session_start();
include "../func/conn.php";

header("Content-Type: application/json");

if(isset($_POST["booking_id"]) && isset($_SESSION["id"])) {
    $booking_id = $_POST["booking_id"];
    $user_id = $_SESSION["id"];
    
    // ตรวจสอบว่าเป็นการจองของผู้ใช้คนนี้
    $check = $conn->query("SELECT * FROM bookings WHERE id = $booking_id AND user_id = $user_id");
    
    if($check->num_rows > 0) {
        $update = $conn->query("UPDATE bookings SET status = \'cancelled\' WHERE id = $booking_id");
        
        if($update) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "ไม่สามารถยกเลิกการจองได้"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "ไม่พบการจองนี้"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "ข้อมูลไม่ครบถ้วน"]);
}
