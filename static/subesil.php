<?php

if ($_GET)
{

include("baglan.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($conn->query("DELETE FROM subeler WHERE sube_id =".(int)$_GET['sube_id']))
{
    header("location:sube.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>
