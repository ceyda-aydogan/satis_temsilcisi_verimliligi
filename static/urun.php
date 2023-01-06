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

            <div class="main">




			<main class="content">
                     <div class='container-fluid'>
                      <div class="col-md-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0"><b>Ürün Ekle</b></h5>
								</div>
								<div class="card-body">
								<form action="" method="post">
                  <table class="table">
                   <td>Ürün Adı :</td>
                    <td><input name="urunad" type="text" class="form-control" ></textarea></td>
                    </tr>
                    <td>Fiyat :</td>
                    <td><input name="fiyat" type="number" class="form-control" ></textarea></td>
                    </tr>

                  </table>
                  <td><input class="btn btn-primary"  type="submit" value="Urun Ekle"></td>
              </form>

              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

              <?php

              if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

                  // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                  $urunad = $_POST['urunad'];
                  $fiyat = $_POST['fiyat'];





                  if ($urunad<>"" && $fiyat<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO urunler (urun_ad,fiyat) VALUES ('$urunad','$fiyat')"))
                      {
                          echo "Ürün Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
                      }
                      else
                      {
                          echo "Hata oluştu";
                      }

                  }

              }

              ?>
								</div>
							</div>
						</div>



            <div class="col-md-12">
              <div class="card flex-fill w-100">
                <div class="card-header">
                  <h5 class="card-title mb-0"><b>Ürünler</b></h5>
                </div>
                <div class="card-body">
                  <table class="table">

                    <tr>
                        <th>Ürün Adı</th>
                        <th>Fiyat</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT * FROM urunler"); // Model tablosundaki tüm verileri çekiyoruz.
                while ($sonuc = $sorgu->fetch_assoc()) {
                $urunid = $sonuc['urun_id'];
                $urunad1 = $sonuc['urun_ad'];
                $fiyat1 = $sonuc['fiyat'];


                ?>

                    <tr>
                        <td><?php echo $urunad1; ?></td>
                        <td><?php echo $fiyat1; ?></td>
                        <td><a href="urunsil.php?urun_id=<?php echo $urunid; ?>" class="btn btn-danger">Sil</a></td>
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

			</main>


			<!--içerik bitişi-->



<?php include 'footer.php'; ?>




<?php
}else{
     header("Location: index.php");
     exit();
}
 ?>
