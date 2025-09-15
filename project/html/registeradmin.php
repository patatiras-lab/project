<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิกAdmin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/registeradmin.css">
</head>
<body>
    <div class="register1">
        <h2>สมัครสมาชิกแอดมิน</h2>
         <form action="../func/registeradmin.php" method="post" onsubmit="return checkPasswords()">
          <input type="text" name="username" placeholder="ชื่อ-นามสกุล">
        <input type="email" name="email" placeholder="Email">
        <input type="password"  id="password" name="password" placeholder="รหัสผ่าน">
        <input type="password" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน">
        <button type="sudmit">สมัครสมาชิก</button>
      </form>
      <div class="login_link">
        เป็นสมาชิกแล้ว? <a href="loginadmin.php">เข้าสู่ระบบ</a>
      </div>
    </div>
 <script>
  // เช็ครหัสผ่าน
  function checkPasswords() {
    const password = document.getElementByTd('password').value;
    const confirmPassword = document.grtElemmentById('confirmpassword').value;
  // กรอกรหัสไม่ครบ
    if (!password || !confirnPassword) {
      alert('กรุณากรอกรหัสผ่านทั้งสองช่อง');
      return false
    }
  // รหัสผ่านไม่ตรงกัน
    if (password !== confirmPassword) {
      alert('รหัสผ่านไม่ตรงกัน');
      return false;
    }
    // รหัสผ่านตรงกัน
    return ture;
  }
 </script>  
</body>
</html>