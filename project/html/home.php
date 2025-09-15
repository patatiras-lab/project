<?php  
      session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
   <link rel="stylesheet" href="../css/home.css">

</head>
<body>
  <?php
  include("nav.php");
  ?>
    <div class="home">
       <div class="text-with-bg"><h1>ศูนย์เยาวชนวัดชัยพฤกษมาลา</h1>
         <div class="football">
        <a  href="../html/stadium.php" role="button">จองสนามกีฬา</a>
      </div>
    </div>
    </div>
    <div>
        <h2>เกี่ยวกับเรา</h2>
        <p>ศูนย์เยาวชนวัดชัยพฤกษมาลา เปิดพื้นที่ เช่าสนามฟุตซอลสาธารณะ  สำหรับทุกคนที่สนใจ (ในวันที่-เวลาที่ให้เช่า) โดยทั่วไป สนามเปิดให้ใช้งานตลอดสัปดาห์ตามเวลาที่ระบุครับ <br>ถ้าสนใจข้อมูลเพิ่มเติม เช่น การจองสนามเป็นกลุ่ม สามารถแจ้งได้เลยนะครับ 😊</p>
        <hr>
    </div>
     <h3>แกลเลอรี่รูปภาพ</h3>
    <div class="pp">
      <div class="image-container">
    <div class="image-box">
      <img src="../picture/picture1.jpg" alt="รูปภาพ 1">
    </div>
    <div class="image-box">
      <img src="../picture/picture2.jpg" alt="รูปภาพ 2">
    </div>
    <div class="image-box">
      <img src="../picture/ta.jpg" alt="รูปภาพ 3">
    </div>
     </div>
      
    </div>
    </div>
</body>
</html>