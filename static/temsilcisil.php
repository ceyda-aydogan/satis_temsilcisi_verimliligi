<?php

if ($_GET)
{

include("baglan.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($conn->query("DELETE FROM satis_temsilcisi WHERE temsilci_id =".(int)$_GET['temsilci_id']))
{
    header("location:temsilci.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>
