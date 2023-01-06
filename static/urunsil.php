<?php

if ($_GET)
{

include("baglan.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($conn->query("DELETE FROM urunler WHERE urun_id =".(int)$_GET['urun_id']))
{
    header("location:urun.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>
