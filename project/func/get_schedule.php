<?php
include "../func/conn.php";

if(isset($_GET["date"])) {
    $selectedDate = $_GET["date"];
    
    // Time slots
    $timeSlots = [
        "08:00", "09:00", "10:00", "11:00", "12:00", "13:00",
        "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00"
    ];
    
    // ดึงข้อมูลการจอง
    $bookingQuery = $conn->query("
        SELECT b.*, a.username, c.type, c.name as court_name 
        FROM bookings b 
        INNER JOIN account a ON b.user_id = a.id_account 
        INNER JOIN courts c ON b.court_id = c.id 
        WHERE b.booking_date = '".$selectedDate."' 
        AND b.status = 'confirmed'
        ORDER BY b.start_time
    ");
    
    $bookings = [];
    if($bookingQuery->num_rows > 0){
        while($booking = $bookingQuery->fetch_assoc()){
            $bookings[] = $booking;
        }
    }
    
    foreach($timeSlots as $time) {
        echo "<tr>";
        echo "<td><strong>$time</strong></td>";
        
        // สนามฟุตซอล/บาสเกตบอล
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
        
        // สนามปิงปอง
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
    }
}
?>