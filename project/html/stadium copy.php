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
                echo '<button class="tab-btn" onclick="showTab(\'schedule\')">📋 ตารางเวลา</button>';
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
                        <label>จำนวนชั่วโมง</label>
                        <select id="duration" name="out" required>
                            <option value="">เลือกจำนวนชั่วโมง</option>
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
                    <input type="date" id="scheduleDate" onchange="updateSchedule()">
                </div>
                <div class="responsive-table">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>เวลา</th>
                                <th>ฟุตซอล</th>
                                <th>บาสเกตบอล</th>
                                <th>ปิงปอง</th>
                            </tr>
                        </thead>
                        <tbody id="scheduleBody">
                            <!-- Schedule data will be populated here -->
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
                            <tr>
                                <td>สมชาย ใจดี</td>
                                <td>081-234-5678</td>
                                <td>somchai@email.com</td>
                                <td>ลูกค้า</td>
                                <td>
                                    <button class="btn btn-danger" onclick="deleteUser(this)">ลบ</button>
                                </td>
                            </tr>
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
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>เบอร์โทร</th>
                                <th>อีเมล</th>
                                <th>ประเภท</th>
                                <th>วันที่</th>
                                <th>in</th>
                                <th>out</th>
                                <th>การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="userList">
                            <?php 
                            if(isset($_SESSION['id'])){
                            $i = $_SESSION['id'];
                            $q = $conn->query("SELECT * FROM `bookings` INNER JOIN `account` ON bookings.user_id = account.id_account INNER JOIN courts ON courts.id = bookings.court_id WHERE user_id = '$i'");
                            if($q->num_rows > 0){
                            while($row = $q->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['phon'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['description'] ?></td>
                                <td><?= $row['booking_date'] ?></td>
                                <td><?= $row['start_time'] ?></td>
                                <td><?= $row['end_time'] ?></td>

                                <td>
                                    <button class="btn btn-danger" onclick="deleteUser(this)">ลบ</button>
                                </td>
                            </tr>
                            <?php }}else{
                               echo 'ไม่มี';
                            } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        <?php
        if(!isset($_SESSION['id'])){
        ?>
         document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('bookingDate').value = today;
            document.getElementById('scheduleDate').value = today;
            updateSchedule();
            updateBookingList();
        });

        showTab('schedule')
        <?php 
        } 
        ?>
        // Global variables
        let selectedSport = '';
        let bookings = [];
        let users = [
            { name: 'สมชาย ใจดี', phone: '081-234-5678', email: 'somchai@email.com', type: 'customer' }
        ];

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('bookingDate').value = today;
            document.getElementById('scheduleDate').value = today;
            updateSchedule();
            updateBookingList();
        });

        function showTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }

        window.onload = function () {
      const params = new URLSearchParams(window.location.search);
      const f = params.get('f');
      if (f === 'p') {
        showTab('mybookings');
      }
    };

        function selectSport(sport) {
            selectedSport = sport;
            
            // Update visual selection
            const cards = document.querySelectorAll('.sport-card');
            cards.forEach(card => card.classList.remove('selected'));
            event.target.classList.add('selected');
            
            // Update dropdown
            const dropdown = document.getElementById('sportType');
            dropdown.value = sport;
            dropdown.disabled = false;
        }

        

        function calculateEndTime(startTime, duration) {
            const [hours, minutes] = startTime.split(':').map(Number);
            const endHours = hours + parseInt(duration);
            return `${endHours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
        }

        function timeOverlap(start1, end1, start2, end2) {
            return (start1 < end2) && (end1 > start2);
        }

        function updateSchedule() {
            const selectedDate = document.getElementById('scheduleDate').value;
            const scheduleBody = document.getElementById('scheduleBody');
            
            const timeSlots = [
                '08:00', '09:00', '10:00', '11:00', '12:00', '13:00',
                '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'
            ];
            
            scheduleBody.innerHTML = '';
            
            timeSlots.forEach(time => {
                const row = document.createElement('tr');
                
                const timeCell = document.createElement('td');
                timeCell.textContent = time;
                row.appendChild(timeCell);
                
                ['futsal', 'basketball', 'pingpong'].forEach(sport => {
                    const cell = document.createElement('td');
                    const booking = bookings.find(b => 
                        b.date === selectedDate && 
                        b.sportType === sport && 
                        b.startTime <= time && 
                        b.endTime > time
                    );
                    
                    if (booking) {
                        cell.innerHTML = `<span class="status-booked">จองแล้ว<br>${booking.name}</span>`;
                    } else {
                        cell.innerHTML = '<span class="status-available">ว่าง</span>';
                    }
                    
                    row.appendChild(cell);
                });
                
                scheduleBody.appendChild(row);
            });
        }

    

        function cancelBooking(bookingId) {
            if (confirm('คุณต้องการยกเลิกการจองนี้หรือไม่?')) {
                bookings = bookings.filter(booking => booking.id !== bookingId);
                updateBookingList();
                updateSchedule();
                showAlert('success', '✅ ยกเลิกการจองสำเร็จ');
            }
        }

        function addUser(event) {
            event.preventDefault();
            
            const name = document.getElementById('userName').value;
            const phone = document.getElementById('userPhone').value;
            const email = document.getElementById('userEmail').value;
            const type = document.getElementById('userType').value;
            
            const user = { name, phone, email, type };
            users.push(user);
            
            // Add to table
            const userList = document.getElementById('userList');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${name}</td>
                <td>${phone}</td>
                <td>${email}</td>
                <td>${type === 'customer' ? 'ลูกค้า' : 'ผู้ดูแล'}</td>
                <td>
                    <button class="btn btn-danger" onclick="deleteUser(this)">ลบ</button>
                </td>
            `;
            userList.appendChild(row);
            
            // Reset form
            event.target.reset();
            showAlert('success', '✅ เพิ่มผู้ใช้สำเร็จ');
        }

        function deleteUser(button) {
            if (confirm('คุณต้องการลบผู้ใช้นี้หรือไม่?')) {
                button.closest('tr').remove();
                showAlert('success', '✅ ลบผู้ใช้สำเร็จ');
            }
        }

        function showAlert(type, message) {
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.textContent = message;
            
            document.querySelector('.container').insertBefore(alert, document.querySelector('.nav-tabs'));
            
            setTimeout(() => {
                alert.remove();
            }, 3000);
        }
    </script>
</body>
</html> 