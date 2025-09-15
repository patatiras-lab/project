<?php 
include("conn.php");
 $username = $_POST["username"];
 $password = $_POST["password"];

 $ck = $conn->query("SELECT * FROM `account` WHERE 
 `username` = '$username' AND `password` = '$password'");

if($ck->num_rows > 0){
$row = $ck->fetch_assoc();

$_SESSION["id"] = $row['id_account'];
$_SESSION["login"] = true;
$_SESSION["user"] = $row['username'];

    
header("location: ../html/home.php");
}else{
        header("location: ../html/login.php");
}




?>