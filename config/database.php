<?php

$host = "localhost";
$user = "root";
$password = "05desember2005";
$db = "finance_app";

$conn = mysqli_connect($host, $user, $password, $db);

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>