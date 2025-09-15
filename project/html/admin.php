<?php  
      session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
       <?php
  include("nav.php");
  ?>
        <div class="container">
        <div class="content">
            
            <!-- ข้อมูล -->
            <div class="info info-box">
                <div class="box">
                <h2>ศูนย์เยาวชนชัยพฤกษ์มาลา</h2>
                <p>ซอย ชัยพฤกษ์ ถนน ชัยพฤกษ์ กรุงเทพฯ, Taling Chan, Thailand, Bangkok</p>
                <p><strong>Facebook :</strong>ศูนย์นันทนาการวัดชัยพฤกษมาลา สำนักวัฒนธรรม กีฬา และการท่องเที่ยว </p>
                <p><strong>Email:</strong> chailaypukemala@hotmail.com</p>
                <p><strong>โทร:</strong> 02-433-4597</p>
                </div>
                <div class="box2">
                <p>แผนที่ไปยังศูนย์กีฬา</p>
                <!-- Google Map -->
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.74116085628!2d100.465687675091!3d13.79447108660187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29a24acfaee53%3A0xe17557bab10e9d6f!2z4Lio4Li54LiZ4Lii4LmM4LmA4Lii4Liy4Lin4LiK4LiZ4LiK4Lix4Lii4Lie4Lik4LiB4Lip4LmM4Lih4Liy4Lil4Liy!5e0!3m2!1sth!2sth!4v1754291514191!5m2!1sth!2sth" width="995" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>   
                </div>
                </div>
                <!-- รูปภาพ
                <div class=" image image-box">
                    <img src="../picture/สนามฟุตซอลทีมชาติไทย.jpg" alt="สนามกีฬา">
                </div> -->
            </div>
</body>
</html>