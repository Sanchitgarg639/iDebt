<?php
    include 'partials/_dbconnect.php';
    session_start();

    $token = $_GET['token'];
    $query = "UPDATE `signup` SET `status`='active' WHERE token='$token'";
    $result = mysqli_query($conn , $query);
    if($result){
    	header('Location: login.php?activate=success');
    }
?>