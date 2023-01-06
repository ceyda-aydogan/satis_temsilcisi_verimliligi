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
									<h5 class="card-title mb-0"><b>Temsilci Ekle</b></h5>
								</div>
								<div class="card-body">
								<form action="" method="post">
                  <table class="table">
                   <td>Ad Soyad :</td>
                    <td><input name="adsoyad" type="text" class="form-control" ></textarea></td>
                    </tr>
                    <td>Doğum Tarihi :</td>
                    <td><input name="dogum" type="date" class="form-control" ></textarea></td>
                    </tr>
                    <td>İşe Başlangıç Tarihi :</td>
                    <td><input name="baslangic" type="date" class="form-control" ></textarea></td>
                    </tr>
                    <td>
                     Süre  :
                    </td>
                    <td>
                    <select id="cmbMake" name="sure" onchange="document.getElementById('selected_sure').value=this.options[this.selectedIndex].text">
                      <?php foreach ($q1 as $key => $value) { ?>
                        <option value="<?php echo $value['sure_id'];?>"><?php echo $value['sure_ad'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_sure" id="selected_sure" value="" />
                    </td></tr>
                    <td>
                     Cinsiyet  :
                    </td>
                    <td>
                    <select id="cmbMake" name="cins" onchange="document.getElementById('selected_cins').value=this.options[this.selectedIndex].text">
                      <?php foreach ($q2 as $key => $value) { ?>
                        <option value="<?php echo $value['cins_id'];?>"><?php echo $value['cins_ad'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_cins" id="selected_cins" value="" />
                    </td></tr>
                    <td>
                     Şube  :
                    </td>
                    <td>
                    <select id="cmbMake" name="sube" onchange="document.getElementById('selected_sube').value=this.options[this.selectedIndex].text">
                      <?php foreach ($q3 as $key => $value) { ?>
                        <option value="<?php echo $value['sube_id'];?>"><?php echo $value['sube_ad']?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_sube" id="selected_sube" value="" />
                    </td></tr>
                    <td>Maaş :</td>
                     <td><input name="maas" type="number" class="form-control" ></textarea></td>
                  </table>
                  <td><input class="btn btn-primary"  type="submit" value="Temsilci Ekle"></td>
              </form>

              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

              <?php

              if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

                  // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                  $adsoyad = $_POST['adsoyad'];
                  $dogum = $_POST['dogum'];
                  $baslangic = $_POST['baslangic'];
                  $sure = $_POST['sure'];
                  $cinsiyet = $_POST['cins'];
                  $sube = $_POST['sube'];
                  $maas = $_POST['maas'];




                  if ($adsoyad<>"" && $dogum<>"" && $baslangic<>"" && $sure<>"" && $cinsiyet<>"" && $sube<>"" && $maas<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO satis_temsilcisi (temsilci_ad_soyad,dogum_tarihi,baslama_tarihi,sure_id,cins_id,sube_id,maas) VALUES ('$adsoyad','$dogum','$baslangic','$sure','$cinsiyet','$sube','$maas')"))
                      {
                          echo "Temsilci Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
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
                  <h5 class="card-title mb-0"><b>Satış Temsilcileri</b></h5>
                </div>
                <div class="card-body">
                  <table class="table">

                    <tr>
                        <th>Ad Soyad</th>
                        <th>Doğum Tarihi</th>
                        <th>Başlama Tarihi</th>
                        <th>Süre</th>
                        <th>Cinsiyet</th>
                        <th>Şube</th>
                        <th>Maaş</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT satis_temsilcisi.temsilci_id, satis_temsilcisi.temsilci_ad_soyad, satis_temsilcisi.dogum_tarihi, satis_temsilcisi.baslama_tarihi, calisma_suresi.sure_ad, cinsiyet.cins_ad, subeler.sube_ad, satis_temsilcisi.maas
                                       FROM subeler INNER JOIN satis_temsilcisi ON subeler.sube_id=satis_temsilcisi.sube_id INNER JOIN calisma_suresi ON calisma_suresi.sure_id=satis_temsilcisi.sure_id INNER JOIN cinsiyet ON satis_temsilcisi.cins_id=cinsiyet.cins_id"); // Model tablosundaki tüm verileri çekiyoruz.
                while ($sonuc = $sorgu->fetch_assoc()) {
                $id1 = $sonuc['temsilci_id'];
                $adsoyad1 = $sonuc['temsilci_ad_soyad'];
                $dogum1 = $sonuc['dogum_tarihi']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $baslangic1 = $sonuc['baslama_tarihi'];
                $sure1 = $sonuc['sure_ad']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $cinsiyet1 = $sonuc['cins_ad'];
                $sube1 = $sonuc['sube_ad'];
                $maas1 = $sonuc['maas'];

                ?>

                    <tr>
                        <td><?php echo $adsoyad1; ?></td>
                        <td><?php echo $dogum1; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
                        <td><?php echo $baslangic1; ?></td>
                        <td><?php echo $sure1; ?></td>
                        <td><?php echo $cinsiyet1; ?></td>
                        <td><?php echo $sube1; ?></td>
                        <td><?php echo $maas1; ?></td>
                        <td><a href="temsilcisil.php?temsilci_id=<?php echo $id1; ?>" class="btn btn-danger">Sil</a></td>
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
