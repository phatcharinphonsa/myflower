<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "flower";
    $conn = mysqli_connect($host,$user,$password,$database);
    if(!$conn){
        echo "can not connect <br>";
        exit;
    }
?>