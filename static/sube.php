<?php include("baglan.php"); ?>
<?php include_once("sorgular.php"); ?>

<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>
 <?php

 $sorgular = new Querys();
 $q1 = array();
 $q1 = $sorgular->sure();
 $q2 = array();
 $q2 = $sorgular->cinsiyet();
 $q3 = array();
 $q3 = $sorgular->sube();

?>

<?php include 'sidebar.php'; ?>
<?php include 'header.php'; ?>




			<!--içerik-->
      <div class="wrapper">
          <div class="main">
            <main class="content">
              <div class="container-fluid p-0">


        <div class="row">
          <div class="col">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title mb-0">Şube Ekle</h5>
                    </div>
                    <div class="card-body">
                      <form action="" method="post">
                        <table class="table">
                         <td>Şube Adı:
                         </td>
                          <td><input name="subeadi" type="text" class="form-control" ></textarea></td>
                          </tr>
                        </table>
                        <td><input class="btn btn-primary" class="right" type="submit" value="Şube Ekle"></td>&nbsp&nbsp&nbsp
                        <a>
                        <?php

                        if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

                            // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                            $subeadi = $_POST['subeadi'];
                            if ($subeadi<>"") {
                            // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                                 // Veri ekleme sorgumuzu yazıyoruz.
                                if ($conn->query("INSERT INTO subeler (sube_ad) VALUES ('$subeadi')"))
                                {
                                    echo "Şube Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
                                }
                                else
                                {
                                    echo "Hata oluştu";
                                }

                            }

                        }

                        ?> </a>
                      </form>

                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title mb-0">Şubelere Göre Temsilci Sayıları</h5>
                  </div>
                  <div class="card-body">
                    <div class="chart chart-md">
                      <canvas id="line"></canvas>
                    </div>
                  </div>
                </div>





              </div>



                <div class="col-6">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title mb-0">Şubeler</h5>
                    </div>
                    <div class="card-body">

                      <table class="table table-striped">

                        <tr>
                            <th>Şube Kodu</th>
                            <th>Ad Soyad</th>
                            <th>Sil</th>
                        </tr>

                      <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                      <?php



                      $sorgu = $conn->query("SELECT * FROM subeler"); // Model tablosundaki tüm verileri çekiyoruz.
                      while ($sonuc = $sorgu->fetch_assoc()) {
                      $id = $sonuc['sube_id'];
                      $sube = $sonuc['sube_ad'];
                      ?>

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $sube; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
                            <td><a href="subesil.php?sube_id=<?php echo $id; ?>" class="btn btn-danger">Sil</a></td>
                        </tr>

                      <?php
                      }
                      // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                      ?>

                      </table>

                    </div>
                  </div>
                </div>
              </div>






      					</div>
            </main>
          </div>
        </div>

        <script>
        <?php

        $sorgu3 = $conn->query("SELECT subeler.sube_ad, COUNT(satis_temsilcisi.temsilci_id) AS temsayi FROM subeler LEFT JOIN satis_temsilcisi ON subeler.sube_id=satis_temsilcisi.sube_id GROUP BY subeler.sube_ad");
          while ($deu = $sorgu3->fetch_assoc()){
              $subead[] = $deu['sube_ad'];
              $temsayi[] = $deu['temsayi'];
        }

        ?>

        const ctx1 = document.getElementById('line');
          new Chart(ctx1, {
            type: 'bar',
            data: {
              labels: <?php echo json_encode($subead); ?>,
              datasets: [{
                label: 'Temsilci Sayısı',
                data: <?php echo json_encode($temsayi); ?>,
                borderWidth: 1.5,
                backgroundColor:'#d3e2f7',
                borderColor: '#3b7ddd',
                fill: true,


              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });

        </script>


			<!--içerik bitişi-->



<?php include 'footer.php'; ?>




<?php
}else{
     header("Location: index.php");
     exit();
}
 ?>
