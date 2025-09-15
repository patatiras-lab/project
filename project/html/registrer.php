<?php  
      session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600&display=swap" rel="stylesheet">

</head>
<body>

<div class="register1">
   <?php
  include("nav.php");
  ?>
</div>
        <ul class="register-container">
          <h2>สมัครสมาชิก</h2>
          <form action="../func/register.php" method="post" onsubmit="return checkPasswords()">
            <li><input type="text" name="username" placeholder="ชื่อ-นามสกุล"></li>
            <li><input type="email" name="email" placeholder="Email"></li>
            <li><input type="text" name="phon" placeholder="เบอร์ติดต่อ"></li>
            <li><input type="password" id="password" name="password" placeholder="รหัสผ่าน"></li>
            <li><input type="password" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน"></li>
            <button type="submit">สมัครสมาชิก</button><br><br>
          </form>
            <div class="iogin_link">
        เป็นสมาชิกแล้ว? 
        <a href="login.html">เข้าสู่ระบบ</a>
            </div>    
          </ul>
<script>
function checkPasswords() {
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm_password').value;

  if (!password || !confirmPassword) {
    alert('กรุณากรอกรหัสผ่านทั้งสองช่อง');
    return false;
  }

  if (password !== confirmPassword) {
    alert('รหัสผ่านไม่ตรงกัน');
    return false;
  }

  // รหัสผ่านตรงกัน
  return true;
}
</script>
</body>
</html>
