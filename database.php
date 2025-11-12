<?php
$host = "sql111.infinityfree.com";
$user = "if0_40340997";
$pass = "MJdHVWf30LbZC";
$db   = "if0_40340997_sanggar";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
