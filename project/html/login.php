<?php  
      session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เข้าสู่ระบบ</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/login.css">
</head>
<body >
  <?php
  include("nav.php");
  ?>
  
  <div class="login1">
  <div class="login-container">
    <h2>เข้าสู่ระบบ</h2>
    <form action="../func/login.php" method="post">
      <input type="text" name="username" placeholder="ชื่อผู้ใช้" required>
      <input type="password" name="password" placeholder="รหัสผ่าน" required>
      <button type="submit">เข้าสู่ระบบ</button>
    </form>
    <div class="register">
      ยังไม่มีบัญชี? <a href="registrer.php">สมัครสมาชิก</a>
    </div>
  </div>
</body>
</html>