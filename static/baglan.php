<?php
$sname= "localhost";
$unmae= "root";
$password = "";
$db_name = "kds";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);
if (!$conn) {
    echo "Bağlantı Hatası";
}

$conn->set_charset("utf8");
?>