<?php  
      include "../func/conn.php";
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจองสนามกีฬา</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .nav-tabs {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .tab-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            background: white;
            color: #667eea;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .tab-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease-in;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid #e0e6ed;
        }

        .sports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .sport-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .sport-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            border-color: #667eea;
        }

        .sport-card.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, #f8f9ff 0%, #e6eaff 100%);
        }

        .sport-icon {
            font-size: 4em;
            margin-bottom: 15px;
        }

        .sport-card h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #333;
        }

        .sport-card p {
            color: #666;
            line-height: 1.6;
        }

        .booking-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group select {
            padding: 12px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .schedule-table th,
        .schedule-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e0e6ed;
        }

        .schedule-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 500;
        }

        .schedule-table tr:hover {
            background: #f8f9ff;
        }

        .status-available {
            background: #d4edda;
            color: #155724;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-booked {
            background: #f8d7da;
            color: #721c24;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .user-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .booking-list {
            display: grid;
            gap: 15px;
        }

        .booking-item {
            background: white;
            border-radius: 15px;
            padding: 20px;
            border: 1px solid #e0e6ed;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .booking-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .booking-info {
            flex: 1;
        }

        .booking-info h4 {
            margin-bottom: 8px;
            color: #333;
        }

        .booking-info p {
            color: #666;
            margin-bottom: 5px;
        }

        .responsive-table {
            overflow-x: auto;
        }

        .time-slot {
            min-height: 50px;
            position: relative;
        }

        .booking-details {
            font-size: 12px;
            line-height: 1.2;
        }

        @media (max-width: 768px) {
            .nav-tabs {
                flex-direction: column;
                align-items: center;
            }
            
            .booking-form {
                grid-template-columns: 1fr;
            }
            
            .user-form {
                grid-template-columns: 1fr;
            }
            
            .booking-item {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <?php 
    include("nav.php");
    ?>
    <div class="container">
        <div class="header">
            <h1>🏆 ระบบจองสนามกีฬา</h1>
            <p>จองสนามกีฬาออนไลน์ง่ายๆ เพียงไคลิกเดียว</p>
        </div>

        <div class="nav-tabs">
            <?php
            if(isset($_SESSION['id']) && isset($_SESSION['rold']) && $_SESSION['rold'] == 0 ){
                ?>
            <button class="tab-btn active" onclick="showTab('booking')">📅 จองสนาม</button>
            <button class="tab-btn" onclick="showTab('schedule')">📋 ตารางเวลา</button>
            <button class="tab-btn" onclick="showTab('mybookings')">📝 การจองของฉัน</button>
            <?php
            }else{
                echo '<button class="tab-btn active" onclick="showTab(\'schedule\')">📋 ตารางเวลา</button>';
            }
            if(isset($_SESSION['id']) && isset($_SESSION['rold']) && $_SESSION['rold'] == 1 ){
            ?>
            <button class="tab-btn" onclick="showTab('manage')">👤 จัดการผู้ใช้</button>
            <?php 
             }
            ?>
        </div>

        <!-- Booking Tab -->
        <div id="booking" class="tab-content active">
            <div class="card">
                <h2>🎯 เลือกประเภทสนามกีฬา</h2>
                <div class="sports-grid">
                    <div class="sport-card" onclick="selectSport('futsal')">
                        <div class="sport-icon">⚽</div>
                        <h3>สนามฟุตซอล</h3>
                        <p>สนามฟุตซอลมาตรฐาน พร้อมอุปกรณ์ครบครัน</p>
                    </div>
                    <div class="sport-card" onclick="selectSport('basketball')">
                        <div class="sport-icon">🏀</div>
                        <h3>สนามบาสเกตบอล</h3>
                        <p>สนามบาสเกตบอลครึ่งสนาม และเต็มสนาม</p>
                    </div>
                    <div class="sport-card" onclick="selectSport('pingpong')">
                        <div class="sport-icon">🏓</div>
                        <h3>สนามปิงปอง</h3>
                        <p>โต๊ะปิงปองมาตรฐาน พร้อมอุปกรณ์</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2>📝 ข้อมูลการจอง</h2>
                <form class="booking-form" action="../func/bookings.php" method="post">
                   
                    <div class="form-group">
                        <label>วันที่จอง</label>
                        <input type="date" name="day" id="bookingDate" required>
                    </div>
                    <div class="form-group">
                        <label>เวลาเริ่ม</label>
                        <select id="startTime" name="in" required>
                            <option value="">เลือกเวลา</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>เวลาสิ้นสุด</label>
                        <select id="duration" name="out" required>
                            <option value="">เลือกเวลาสิ้นสุด</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option> 
                            <option value="20:00">20:00</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ประเภทสนาม</label>
                        <select id="sportType" name="ci" required>
                            <option value="">เลือกประเภทสนาม</option>
                            <option value="1">สนามฟุตซอล&สนามบาสเกตบอล</option>
                            <option value="2">สนามปิงปอง</option>
                        </select>
                    </div>
                    <div style="grid-column: 1 / -1; text-align: center;">
                        <button type="submit" class="btn btn-primary">🎯 ยืนยันการจอง</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Schedule Tab -->
        <div id="schedule" class="tab-content">
            <div class="card">
                <h2>📋 ตารางเวลาการจอง</h2>
                <div class="form-group" style="max-width: 300px;">
                    <label>เลือกวันที่</label>
                    <input type="date" id="scheduleDate" onchange="updateSchedule()" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="responsive-table">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>เวลา</th>
                                <th>ฟุตซอล/บาสเกตบอล</th>
                                <th>ปิงปอง</th>
                            </tr>
                        </thead>
                        <tbody id="scheduleBody">
                            <?php
                            // สร้าง time slots
                            $timeSlots = [
                                '08:00', '09:00', '10:00', '11:00', '12:00', '13:00',
                                '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'
                            ];
                            
                            $selectedDate = date('Y-m-d'); // วันนี้เป็นค่าเริ่มต้น
                            
                            // ดึงข้อมูลการจองของวันที่เลือก
                            $bookingQuery = $conn->query("
                                SELECT b.*, a.username, c.type, c.name as court_name 
                                FROM bookings b 
                                INNER JOIN account a ON b.user_id = a.id_account 
                                INNER JOIN courts c ON b.court_id = c.id 
                                WHERE b.booking_date = '$selectedDate' 
                                AND b.status = 'confirmed'
                                ORDER BY b.start_time
                            ");
                            
                            $bookings = [];
                            if($bookingQuery->num_rows > 0){
                                while($booking = $bookingQuery->fetch_assoc()){
                                    $bookings[] = $booking;
                                }
                            }
                            
                            foreach($timeSlots as $time):
                                echo "<tr>";
                                echo "<td><strong>$time</strong></td>";
                                
                                // สนามฟุตซอล/บาสเกตบอล (court_id = 1)
                                echo "<td class='time-slot'>";
                                $found = false;
                                foreach($bookings as $booking){
                                    if($booking['court_id'] == 1 && 
                                       $booking['start_time'] <= $time.':00' && 
                                       $booking['end_time'] > $time.':00'){
                                        echo "<span class='status-booked'>จองแล้ว<br>";
                                        echo "<div class='booking-details'>";
                                        echo "ผู้จอง: " . htmlspecialchars($booking['username']) . "<br>";
                                        echo "เวลา: " . substr($booking['start_time'], 0, 5) . " - " . substr($booking['end_time'], 0, 5);
                                        echo "</div></span>";
                                        $found = true;
                                        break;
                                    }
                                }
                                if(!$found){
                                    echo "<span class='status-available'>ว่าง</span>";
                                }
                                echo "</td>";
                                
                                // สนามปิงปอง (court_id = 2)
                                echo "<td class='time-slot'>";
                                $found = false;
                                foreach($bookings as $booking){
                                    if($booking['court_id'] == 2 && 
                                       $booking['start_time'] <= $time.':00' && 
                                       $booking['end_time'] > $time.':00'){
                                        echo "<span class='status-booked'>จองแล้ว<br>";
                                        echo "<div class='booking-details'>";
                                        echo "ผู้จอง: " . htmlspecialchars($booking['username']) . "<br>";
                                        echo "เวลา: " . substr($booking['start_time'], 0, 5) . " - " . substr($booking['end_time'], 0, 5);
                                        echo "</div></span>";
                                        $found = true;
                                        break;
                                    }
                                }
                                if(!$found){
                                    echo "<span class='status-available'>ว่าง</span>";
                                }
                                echo "</td>";
                                
                                echo "</tr>";
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- User Management Tab -->
        <div id="manage" class="tab-content">
            <div class="card">
                <h2>👤 จัดการผู้ใช้</h2>
                <form class="user-form" onsubmit="addUser(event)">
                    <div class="form-group">
                        <label>ชื่อผู้ใช้</label>
                        <input type="text" id="userName" required>
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร</label>
                        <input type="tel" id="userPhone" required>
                    </div>
                    <div class="form-group">
                        <label>อีเมล</label>
                        <input type="email" id="userEmail" required>
                    </div>
                    <div class="form-group">
                        <label>ประเภทผู้ใช้</label>
                        <select id="userType" required>
                            <option value="">เลือกประเภท</option>
                            <option value="customer">ลูกค้า</option>
                            <option value="admin">ผู้ดูแล</option>
                        </select>
                    </div>
                    <div style="grid-column: 1 / -1; text-align: center;">
                        <button type="submit" class="btn btn-primary">➕ เพิ่มผู้ใช้</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <h2>📋 รายการผู้ใช้</h2>
                <div class="responsive-table">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>เบอร์โทร</th>
                                <th>อีเมล</th>
                                <th>ประเภท</th>
                                <th>การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="userList">
                            <?php 
                            $userQuery = $conn->query("SELECT * FROM account ORDER BY username");
                            if($userQuery->num_rows > 0){
                                while($user = $userQuery->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['username']) ?></td>
                                        <td><?= htmlspecialchars($user['phon']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td><?= ($user['rold'] == 1) ? 'ผู้ดูแล' : 'ลูกค้า' ?></td>
                                        <td>
                                            <button class="btn btn-danger" onclick="deleteUser(<?= $user['id_account'] ?>)">ลบ</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- My Bookings Tab -->
        <div id="mybookings" class="tab-content">
            <div class="card">
                <h2>📝 การจองของฉัน</h2>
                <div id="bookingList" class="booking-list">
                    <div class="responsive-table">
                        <table class="schedule-table">
                            <thead>
                                <tr>
                                    <th>ชื่อผู้จอง</th>
                                    <th>เบอร์โทร</th>
                                    <th>ประเภทสนาม</th>
                                    <th>วันที่จอง</th>
                                    <th>เวลาเริ่ม</th>
                                    <th>เวลาสิ้นสุด</th>
                                    <th>สถานะ</th>
                                    <th>การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody id="myBookingsList">
                                <?php 
                                if(isset($_SESSION['id'])){
                                    $user_id = $_SESSION['id'];
                                    $myBookingsQuery = $conn->query("
                                        SELECT b.*, a.username, a.phon, a.email, c.name as court_name, c.type, c.description 
                                        FROM bookings b 
                                        INNER JOIN account a ON b.user_id = a.id_account 
                                        INNER JOIN courts c ON c.id = b.court_id 
                                        WHERE b.user_id = '$user_id' 
                                        ORDER BY b.booking_date DESC, b.start_time DESC
                                    ");
                                    
                                    if($myBookingsQuery->num_rows > 0){
                                        while($booking = $myBookingsQuery->fetch_assoc()){
                                            $statusText = '';
                                            $statusClass = '';
                                            switch($booking['status']) {
                                                case 'confirmed':
                                                    $statusText = 'ยืนยันแล้ว';
                                                    $statusClass = 'status-available';
                                                    break;
                                                case 'pending':
                                                    $statusText = 'รอยืนยัน';
                                                    $statusClass = 'status-booked';
                                                    break;
                                                case 'cancelled':
                                                    $statusText = 'ยกเลิก';
                                                    $statusClass = 'status-booked';
                                                    break;
                                            }
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($booking['username']) ?></td>
                                                <td><?= htmlspecialchars($booking['phon']) ?></td>
                                                <td><?= htmlspecialchars($booking['description']) ?></td>
                                                <td><?= date('d/m/Y', strtotime($booking['booking_date'])) ?></td>
                                                <td><?= substr($booking['start_time'], 0, 5) ?></td>
                                                <td><?= substr($booking['end_time'], 0, 5) ?></td>
                                                <td><span class="<?= $statusClass ?>"><?= $statusText ?></span></td>
                                                <td>
                                                    <?php if($booking['status'] != 'cancelled'): ?>
                                                        <button class="btn btn-danger" onclick="cancelBooking(<?= $booking['id'] ?>)">ยกเลิก</button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="8" style="text-align: center; padding: 30px;">ไม่มีการจองใดๆ</td></tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ตั้งค่าเริ่มต้น
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('bookingDate').value = today;
            document.getElementById('scheduleDate').value = today;
        });

        // ถ้าไม่ได้ล็อกอิน ให้แสดงหน้าตารางเวลาเป็นค่าเริ่มต้น
        <?php if(!isset($_SESSION['id'])): ?>
        document.addEventListener('DOMContentLoaded', function() {
            showTab('schedule');
        });
        <?php endif; ?>

        // ฟังก์ชันสำหรับเปลี่ยน tab
        function showTab(tabName) {
            // ซ่อน tabs ทั้งหมด
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // ลบ active class จากปุ่มทั้งหมด
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            
            // แสดง tab ที่เลือก
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }

        // ตรวจสอบ URL parameter สำหรับแสดงหน้าการจองของฉัน
        window.onload = function () {
            const params = new URLSearchParams(window.location.search);
            const f = params.get('f');
            if (f === 'p') {
                showTabByName('mybookings');
            }
        };

        // ฟังก์ชันสำหรับเปลี่ยน tab โดยใช้ชื่อ (ไม่ใช้ event)
        function showTabByName(tabName) {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            
            document.getElementById(tabName).classList.add('active');
            
            // หาปุ่มที่ตรงกับ tab และเพิ่ม active class
            buttons.forEach(btn => {
                if(btn.getAttribute('onclick') && btn.getAttribute('onclick').includes(tabName)) {
                    btn.classList.add('active');
                }
            });
        }

        // ฟังก์ชันเลือกประเภทกีฬา
        function selectSport(sport) {
            // ลบการเลือกเก่า
            const cards = document.querySelectorAll('.sport-card');
            cards.forEach(card => card.classList.remove('selected'));
            
            // เพิ่มการเลือกใหม่
            event.target.closest('.sport-card').classList.add('selected');
            
            // อัปเดต dropdown
            const dropdown = document.getElementById('sportType');
            if(sport === 'futsal' || sport === 'basketball') {
                dropdown.value = '1';
            } else if(sport === 'pingpong') {
                dropdown.value = '2';
            }
        }

        // ฟังก์ชันอัปเดตตารางเวลา
        function updateSchedule() {
            const selectedDate = document.getElementById('scheduleDate').value;
            if(!selectedDate) return;
            
            // ส่ง AJAX request เพื่อดึงข้อมูลใหม่
            fetch('get_schedule.php?date=' + selectedDate)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('scheduleBody').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                });
        }

        // ฟังก์ชันยกเลิกการจอง
        function cancelBooking(bookingId) {
            if (confirm('คุณต้องการยกเลิกการจองนี้หรือไม่?')) {
                // ส่ง AJAX request เพื่อยกเลิกการจอง
                fetch('cancel_booking.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'booking_id=' + bookingId
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('ยกเลิกการจองสำเร็จ');
                        location.reload(); // โหลดหน้าใหม่เพื่อแสดงข้อมูลล่าสุด
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการยกเลิกการจอง');
                });
            }
        }

        // ฟังก์ชันเพิ่มผู้ใช้
        function addUser(event) {
            event.preventDefault();
            
            const name = document.getElementById('userName').value.trim();
            const phone = document.getElementById('userPhone').value.trim();
            const email = document.getElementById('userEmail').value.trim();
            const type = document.getElementById('userType').value;
            
            // ตรวจสอบข้อมูล
            if(!name || !phone || !email || !type) {
                alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }
            
            // ตรวจสอบรูปแบบ email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(!emailRegex.test(email)) {
                alert('รูปแบบอีเมลไม่ถูกต้อง');
                return;
            }
            
            // แสดง loading
            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = '⏳ กำลังเพิ่ม...';
            submitBtn.disabled = true;
            
            // ส่ง AJAX request เพื่อเพิ่มผู้ใช้
            fetch('../func/add_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `username=${encodeURIComponent(name)}&phone=${encodeURIComponent(phone)}&email=${encodeURIComponent(email)}&role=${type}`
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                
                if(data.success) {
                    showAlert('success', '✅ ' + data.message);
                    clearForm();
                    // รีโหลดหน้าเพื่อแสดงผู้ใช้ใหม่
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    showAlert('error', '❌ ' + data.message);
                }
            })
            .catch(error => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                console.error('Error:', error);
                showAlert('error', '❌ เกิดข้อผิดพลาดในการเพิ่มผู้ใช้');
            });
        }

        // ฟังก์ชันล้างฟอร์ม
        function clearForm() {
            document.getElementById('userName').value = '';
            document.getElementById('userPhone').value = '';
            document.getElementById('userEmail').value = '';
            document.getElementById('userType').value = '';
        }

        // ฟังก์ชันลบผู้ใช้
        function deleteUser(userId) {
            if (confirm('⚠️ คุณต้องการลบผู้ใช้นี้หรือไม่?\n\n⚠️ หากผู้ใช้นี้มีการจองอยู่ ระบบจะยกเลิกการจองทั้งหมดด้วย\n\n⚠️ การดำเนินการนี้ไม่สามารถย้อนกลับได้')) {
                fetch('../func/delete_user.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'user_id=' + userId
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        showAlert('success', '✅ ' + data.message);
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        showAlert('error', '❌ ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', '❌ เกิดข้อผิดพลาดในการลบผู้ใช้');
                });
            }
        }

        // ฟังก์ชันตรวจสอบความถูกต้องของเวลา
        document.getElementById('startTime').addEventListener('change', function() {
            const startTime = this.value;
            const endTimeSelect = document.getElementById('duration');
            
            // ล้าง options เดิม
            endTimeSelect.innerHTML = '<option value="">เลือกเวลาสิ้นสุด</option>';
            
            if(startTime) {
                const startHour = parseInt(startTime.split(':')[0]);
                
                // เพิ่ม options ที่มากกว่าเวลาเริ่ม
                for(let hour = startHour + 1; hour <= 20; hour++) {
                    const timeStr = hour.toString().padStart(2, '0') + ':00';
                    const option = document.createElement('option');
                    option.value = timeStr;
                    option.textContent = timeStr;
                    endTimeSelect.appendChild(option);
                }
            }
        });

        // ฟังก์ชันแสดงข้อความแจ้งเตือน
        function showAlert(type, message) {
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.textContent = message;
            
            document.querySelector('.container').insertBefore(alert, document.querySelector('.nav-tabs'));
            
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }

        // ตรวจสอบข้อความจาก URL parameters
        document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            const message = params.get('message');
            const type = params.get('type');
            
            if(message) {
                showAlert(type || 'success', decodeURIComponent(message));
            }
        });
    </script>


</body>
</html>