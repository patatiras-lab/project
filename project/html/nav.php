<link rel="stylesheet" href="../css/style.css" />
   <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600&display=swap" rel="stylesheet">


  <nav class="nav">
    <div class="nav-container">
      <div class="logo-container">
        <img src="../picture/logo-Photoroom.png" alt="โลโก้" class="logo" />
        <span class="site-name">สนามกีฬาออนไลน์</span>
      </div>
      <ul class="menu">
        <li><a href="../html/home.php">หน้าแรก</a></li>
        <li><a href="../html/stadium.php">จองสนาม</a></li>
        <li><a href="../html/admin.php">ติดต่อเรา</a></li>
        <?php 
  
        if(!isset($_SESSION["login"])){
        ?>
        <li><a href="../html/login.php">ล็อกอิน</a></li>
        <li><a href="../html/register.php">สมัครสมาชิก</a></li>
        <?php 
        }else{
          echo '<li><a href="../func/logout.php">logout</a></li>
           <li></li><li class="">' . $_SESSION["user"] . '</li>';
        }
        ?>
      </ul>
      </div>
  </nav>

