<?php

class Querys
{
  public function sure()
  {
    include("baglan.php");
    $sorgu2 = $conn->query("SELECT * FROM calisma_suresi");
           $datas = array();
           while ($deu = $sorgu2->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }

  public function cinsiyet()
  {
    include("baglan.php");
    $result1 = $conn->query("SELECT * FROM cinsiyet");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }

  public function sube()
  {
    include("baglan.php");
    $result1 = $conn->query("SELECT * FROM subeler");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }



  public function icons()
  {
    include("baglan.php");
    $result1 = $conn->query("SELECT (SELECT COUNT(satis_temsilcisi.temsilci_id) FROM satis_temsilcisi) AS temsilcisayi,
                           (SELECT COUNT(subeler.sube_id) FROM subeler) AS subesayi, (SELECT COUNT(*) FROM(SELECT urunler.urun_ad FROM urunler GROUP BY urunler.urun_ad) AS sonuc) AS grupsayi,
                           (SELECT satis_temsilcisi.temsilci_ad_soyad FROM satis_temsilcisi LEFT JOIN satis ON satis_temsilcisi.temsilci_id=satis.temsilci_id GROUP BY satis.temsilci_id ORDER BY COUNT(satis.urun_id) DESC LIMIT 1) AS verimkral");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }

}


?>
