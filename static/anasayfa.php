<?php include("baglan.php"); ?>
<?php include("sorgular.php"); ?>

<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>
 <?php

 $sorgular = new Querys();
 $q1 = array();
 $q1 = $sorgular->icons();

?>

<?php include 'sidebar.php'; ?>

<?php include 'header.php'; ?>




			<!--içerik-->
      <div class="wrapper">


      		<div class="main">

      			<main class="content">
      				<div class="container-fluid p-0">
      					<div class="row">

                  <div class="col-3">
      							<div class="card">
      								<div class="card-body">
                        <div class="row">
                          <div class="col mt-0">
														<h5 class="card-title">Temsilci Sayısı</h5>
													</div>
                          <div class="col-auto">
														<div class="stat text-primary">
															<i class="width" class="align-middle" data-feather="users"></i>
														</div>
													</div>
                          <h1 class="mt-1 mb-3"><?php foreach ($q1 as $key => $value) { echo $value['temsilcisayi']; ?></h1>
        								</div>
                      </div>
      							</div>
      						</div>



                  <div class="col-3">
      							<div class="card">
      								<div class="card-body">
                        <div class="row">
                          <div class="col mt-0">
														<h5 class="card-title">Şube Sayısı</h5>
													</div>
                          <div class="col-auto">
														<div class="stat text-primary">
															<i class="width" class="align-middle" data-feather="map-pin"></i>
														</div>
													</div>
                          <h1 class="mt-1 mb-3"><?php echo $value['subesayi']; ?></h1>
        								</div>
                      </div>
      							</div>
      						</div>



                  <div class="col-3">
      							<div class="card">
      								<div class="card-body">
                        <div class="row">
                          <div class="col mt-0">
														<h5 class="card-title">Ürün Grubu Sayısı</h5>
													</div>
                          <div class="col-auto">
														<div class="stat text-primary">
															<i class="width" class="align-middle" data-feather="shopping-cart"></i>
														</div>
													</div>
                          <h1 class="mt-1 mb-3" style="font-size:25px;"><?php echo $value['grupsayi']; ?></h1>
        								</div>
                      </div>
      							</div>
      						</div>



                  <div class="col-3">
      							<div class="card">
      								<div class="card-body">
                        <div class="row">
                          <div class="col mt-0">
														<h5 class="card-title">En Verimli Personel</h5>
													</div>
                          <div class="col-auto">
														<div class="stat text-primary">
															<i class="width" class="align-middle" data-feather="award"></i>
														</div>
													</div>
                          <h1 class="mt-1 mb-3"   style="font-size:25px;"><?php echo $value['verimkral']; ?></h1> <?php } ?>
        								</div>
                      </div>
      							</div>
      						</div>


      					</div>

                <div class="row">
      						<div class="col-6">
      							<div class="card">
      								<div class="card-header">
      									<a><h2 class="card-title mb-0">Ürünlere Göre Ortalama Fiyatlar</h5></a>
      								</div>
      								<div class="card-body">
                        <div class="chart chart-lg">
                          <br><br><br>
                          <canvas id="grafik1"></canvas>
                        </div>
      								</div>
      							</div>
      						</div>

                  <div class="col-6">
      							<div class="card">
      								<div class="card-header">
      									<h5 class="card-title mb-0">Temsilcilerin Cinsiyet Dağılımı</h5>
      								</div>
      								<div class="card-body">
                      <div class="chart chart-lg">
                        <br><br><br>
                        <canvas id="pasta"></canvas>
                      </div>
      								</div>
      							</div>
      						</div>



                  <div class="col-6">
      							<div class="card">
      								<div class="card-header" style="background:#aaf567;">
      									<h5 class="card-title mb-0" style="color: #000;">Yüksek Performans Gösteren Temsilciler</h5>
      								</div>
      								<div class="card-body" style="background:#aaf567;" >
                        <table class="table">

                          <tr>
                              <th>Ad Soyad</th>
                              <th>Satış Sayısı</th>
                          </tr>

                      <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                      <?php



                      $sorgu = $conn->query("SELECT satis_temsilcisi.temsilci_ad_soyad, COUNT(satis.urun_id) AS satissayisi
                                            FROM satis_temsilcisi LEFT JOIN satis ON satis_temsilcisi.temsilci_id=satis.temsilci_id
                                            GROUP BY satis_temsilcisi.temsilci_ad_soyad
                                            ORDER BY satissayisi DESC LIMIT 5"); // Model tablosundaki tüm verileri çekiyoruz.
                      while ($sonuc = $sorgu->fetch_assoc()) {
                      $sayi2 = $sonuc['satissayisi'];
                      $adsoyad2 = $sonuc['temsilci_ad_soyad'];

                      ?>

                          <tr>
                              <td><?php echo $adsoyad2; ?></td>
                              <td><?php echo $sayi2; ?></td>
                          </tr>

                      <?php
                      }
                      // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                      ?>

                      </table>

      								</div>
      							</div>
      						</div>




                  <div class="col-6">
      							<div class="card">
      								<div class="card-header" style="background:#fc8383;">
      									<h5 class="card-title mb-0" style="color: #000;">Düşük Performans Gösteren Temsilciler</h5>
      								</div>
      								<div class="card-body" style="background:#fc8383;">
                        <table class="table">

                          <tr>
                              <th>Ad Soyad</th>
                              <th>Satış Sayısı</th>
                          </tr>

                      <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                      <?php



                      $sorgu = $conn->query("SELECT satis_temsilcisi.temsilci_ad_soyad, COUNT(satis.urun_id) AS satissayisi
                                            FROM satis_temsilcisi LEFT JOIN satis ON satis_temsilcisi.temsilci_id=satis.temsilci_id
                                            GROUP BY satis_temsilcisi.temsilci_ad_soyad
                                            ORDER BY satissayisi ASC LIMIT 5"); // Model tablosundaki tüm verileri çekiyoruz.
                      while ($sonuc = $sorgu->fetch_assoc()) {
                      $sayi1 = $sonuc['satissayisi'];
                      $adsoyad1 = $sonuc['temsilci_ad_soyad'];

                      ?>

                          <tr>
                              <td><?php echo $adsoyad1; ?></td>
                              <td><?php echo $sayi1; ?></td>
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
