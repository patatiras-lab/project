<?php
include("conn.php");

$id = $_SESSION["id"];
$_ci = $_POST['ci'];
$day = $_POST['day'];
$t_in = $_POST['in'];
$t_out = $_POST['out'];

$que = $conn->query("INSERT INTO `bookings` (`id`, `user_id`, `court_id`, `booking_date`, `start_time`, `end_time`, `status`, `created_at`) 
VALUES (NULL, '$id', '$_ci', '$day', '$t_in', '$t_out', 'confirmed', current_timestamp());");
        header("location: ../html/stadium.php?f=p");