<?php
include "../func/conn.php";

header("Content-Type: application/json");

// ตรวจสอบว่าเป็น Admin เท่านั้นที่สามารถเพิ่ม user ได้
if(!isset($_SESSION["id"]) || !isset($_SESSION["rold"]) || $_SESSION["rold"] != 1) {
    echo json_encode(["success" => false, "message" => "คุณไม่มีสิทธิ์ในการดำเนินการนี้"]);
    exit;
}

if(isset($_POST["username"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["role"])) {
    $username = trim($_POST["username"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $role = $_POST["role"];
    
    // ตรวจสอบข้อมูลที่จำเป็น
    if(empty($username) || empty($phone) || empty($email)) {
        echo json_encode(["success" => false, "message" => "กรุณากรอกข้อมูลให้ครบถ้วน"]);
        exit;
    }
    
    // ตรวจสอบรูปแบบ email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "รูปแบบอีเมลไม่ถูกต้อง"]);
        exit;
    }
    
    // ตรวจสอบว่า email หรือเบอร์โทรซ้ำหรือไม่
    $checkQuery = $conn->query("SELECT * FROM account WHERE email = '".$conn->real_escape_string($email)."' OR phon = '".$conn->real_escape_string($phone)."'");
    
    if($checkQuery->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "อีเมลหรือเบอร์โทรนี้มีอยู่ในระบบแล้ว"]);
        exit;
    }
    
    // กำหนดค่า role (0 = customer, 1 = admin)
    $roleValue = ($role == 'admin') ? 1 : 0;
    
    // สร้าง password เริ่มต้น (สามารถให้ user เปลี่ยนได้ภายหลัง)
    $defaultPassword = '123456'; // หรือสร้าง random password
    
    // เพิ่มข้อมูลผู้ใช้ใหม่
    $insertQuery = "INSERT INTO account (username, email, phon, password, rold) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    
    if($stmt) {
        $stmt->bind_param("ssssi", $username, $email, $phone, $defaultPassword, $roleValue);
        
        if($stmt->execute()) {
            echo json_encode([
                "success" => true, 
                "message" => "เพิ่มผู้ใช้สำเร็จ รหัสผ่านเริ่มต้นคือ: " . $defaultPassword
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาดในการเพิ่มผู้ใช้"]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาดในการเตรียม query"]);
    }
    
} else {
    echo json_encode(["success" => false, "message" => "ข้อมูลไม่ครบถ้วน"]);
}

$conn->close();
?>