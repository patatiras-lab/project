<?php
include("conn.php");
 $username = $_POST["username"];
 $phon = $_POST["phon"];
 $em = $_POST["email"];
 $password = $_POST["password"];

 $re = $conn->query("INSERT INTO `account` (`id_account`, `username`, `email`, `phon`, `password`,`rold`) 
        VALUES (NULL, '$username', '$em', '$phon', '$password','1');");
header("location: ../html/login.php");
?>