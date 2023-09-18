
<?php
 // Veritabanından "ad" ve "soyad" bilgilerini çekmek için sorgu
$query = "SELECT ad, soyad FROM kullanici_tbl WHERE yetki = :yetki";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':yetki', $yetki);
$stmt->execute();

// Sonuçları al ve "ad" ve "soyad" değerlerini session'a ata
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $_SESSION['ad'] = $row['ad'];
    $_SESSION['soyad'] = $row['soyad'];
}

// "ad" ve "soyad" bilgilerini kullanarak istediğiniz şekilde kullanabilirsiniz
$ad = $_SESSION['ad'];
$soyad = $_SESSION['soyad'];


?>

<?php 

// "personel_cinsiyet" sütununda "kadın" yazan verilerin sayısını al
$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM personel_tbl WHERE personel_cinsiyet = 'kadın'");
$stmt->execute();
$row = $stmt->fetch();
$kadin = $row['count'];

// "personel_cinsiyet" sütununda "kadın" yazan verilerin sayısını al
$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM personel_tbl WHERE personel_cinsiyet = 'erkek'");
$stmt->execute();
$row = $stmt->fetch();
$erkek = $row['count'];

// personel_tbl tablosundaki toplam veri sayısını al
$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM personel_tbl");
$stmt->execute();
$row = $stmt->fetch();
$toplam = $row['count'];


?>



<nav class="navbar navbar-expand navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
    <h2><?php echo 'Merhaba '. $ad . ' ' . $soyad; ?> </h2>
    </li>
    
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
 

    <!-- Logout Button -->
    <li class="nav-item">
      <a class="nav-link" href="logout.php">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </li>
  </ul>
</nav>
<section class="content" style="height: 83.3vh;">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row" style="margin-left:15%; margin-top:2%; margin-bottom:1%;">
                <div class="col-lg-3 col-6" data-toggle="modal" data-target="#modal-lg">

                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?php print $toplam; ?>
                            </h3>

                            <p>Toplam Personel Sayısı</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6" data-toggle="modal" data-target="#modal-lg">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>
                                <?php print $kadin; ?>
                            </h3>

                            <p>Toplam Kadın Personel Sayısı</p>
                        </div>
                        <div class="icon">
                            <i class=" fas fa-regular fa-venus"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6" data-toggle="modal" data-target="#modal-lg" style="cursor:pointer;">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?php print $erkek; ?>
                            </h3>

                            <p>Toplam Erkek Personel Sayısı</p>
                        </div>
                        <div class="icon">
                            <i class=" fas fa-solid fa-mars"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
            </div>
            <!-- /.row -->



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal Başlığı</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal içeriği buraya gelecek</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
          <button type="button" class="btn btn-primary">Kaydet</button>
        </div>
      </div>
    </div>
  </div>



            <!-- Main row -->
            <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
    
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>KİMLİK NO</th>
                    <th>AD</th>
                    <th>SOYAD</th>
                    <th>DOGUM</th>
                    <th>CİNSİYET</th>
                    <th>MEDENİ</th>
                    <th>GÖREV</th>
                    <th>ADRES</th>
                    <th>TELEFON</th>
                    <th>EGİTİM</th>
                    <th>RAPORLA</th>
                    
                    
                  </tr>
                  </thead>
                <tbody>
                <?php

                //TABLOYA VERİLERİ DOLDURMAK 
                $stmt = $pdo->query("SELECT * FROM personel_tbl");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($results as $value) { ?>
<tr>
<td><?php print $value['personel_id']; ?></td>
<td><?php print $value['personel_tc']; ?></td>
<td><?php print $value['personel_ad']; ?></td>
<td><?php print $value['personel_soyad']; ?></td>
<td><?php print $value['personel_dogum']; ?></td>
<td><?php print $value['personel_cinsiyet'] ?></td>
<td><?php print $value['personel_medeni']; ?></td>
<td><?php print $value['personel_gorev']; ?></td>
<td><?php print $value['personel_adres']; ?></td>
<td><?php print $value['personel_telefon']; ?></td>
<td><?php print $value['personel_egitim']; ?></td>
<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg<?php print $value['personel_id']; ?>">Raporla</button>

<div class="modal fade" id="modal-lg<?php print $value['personel_id']; ?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><?php print $value['personel_ad']; ?> <?php print $value['personel_soyad']; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <div class="content">
          <div class="container-fluid">
          
           <div class="row">
            <div class="ml-5"> </div>
            <div class="ml-5"> </div>
            <div class="ml-5"> </div>
              <div class="col-sm-6 ml-5">
              <div class="card card-primary card-outline pt-4">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img style="width:150px; height:150px;" src="<?php print $value['personel_resim']; ?>"
                        alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">
                    <?php print $value['personel_ad']; ?> <?php print $value['personel_soyad']; ?>
                    </h3>

                    <p class="text-muted text-center">
                    <?php print $value['personel_tc']; ?> 
                    </p>
                    <p class="text-muted text-center">
                    <?php print $value['personel_gorev']; ?> 
                    </p>
                    <br>
                  </div>
                  <!-- /.card-body -->
              </div>
              </div>
              
              </div>
           
                  <div class="row">
                      <div class="col-sm-6">
                        
                  <div class="card card-primary card-outline">
                  <div class="card-body box-profile">



                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Adı:</b> <?php print $value['personel_ad']; ?> <a>
                    
                        </a>
                      </li>
                      <li class="list-group-item">
                        <b>Soyadı:</b>  <?php print $value['personel_soyad']; ?><a>
                          
                        </a>
                      </li>
                      <li class="list-group-item">
                        <b>Telefon:</b>  <?php print $value['personel_telefon']; ?><a>
                          
                        </a>
                      </li>
                      <li class="list-group-item">
                        <b>Doğum Tarihi:</b>  <?php print $value['personel_dogum']; ?><a>
                          
                        </a>
                      </li>

                      <li class="list-group-item">
                        <b>Cinsiyeti:</b>  <?php print $value['personel_cinsiyet']; ?> <a>
                       
                        </a>
                      </li>
                  </div>
                  <!-- /.card-body -->
                </div>
                      </div>

                      <div class="col-sm-6">
                        
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
      
      
      
                          <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b>Medeni:</b>  <?php print $value['personel_medeni']; ?><a>
                          
                              </a>
                            </li>
                            <li class="list-group-item">
                              <b>Görevi:</b> <?php print $value['personel_gorev']; ?><a>
                                
                              </a>
                            </li>
                            <li class="list-group-item">
                              <b>Adres:</b> <?php print $value['personel_adres']; ?><a>
                                
                              </a>
                            </li>
                            <li class="list-group-item">
                              <b>Eğitim:</b><?php print $value['personel_egitim']; ?> <a>
                                
                              </a>
                            </li>
      
                            <li class="list-group-item">
                              <b>Mail:</b> <?php print $value['personel_mail']; ?><a>
                             
                              </a>
                            </li>
                        </div>
                        <!-- /.card-body -->
                      </div>
                            </div>
                      
                  </div>






              </div>
            </div>


            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
              <button type="button" class="btn btn-primary">Tamam</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



</td>
</tr>
<?php } ?>

                 
                </tbody>
               <tfoot>
               <tr>
                   
               <th>ID</th>
                    <th>KİMLİK NO</th>
                    <th>AD</th>
                    <th>SOYAD</th>
                    <th>DOGUM</th>
                    <th>CİNSİYET</th>
                    <th>MEDENİ</th>
                    <th>GÖREV</th>
                    <th>ADRES</th>
                    <th>TELEFON</th>
                    <th>EGİTİM</th>
                    <th>RAPORLA</th>
                    
                  </tr>
                 </tfoot>
                </table>
              </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
 
  <!-- /.content -->
    </section>  
<!-- Main content 

<footer class="main-footer bg-dark text-light footer-fixed" style="margin:0;">
    <div class="container">
      <div class="row">
        <div class="col-12  text-center">
          <p class="mb-0">Tüm Hakları Saklıdır. &copy; 2022-2022 <a href="https://www.birsebep.com">Ruh Adam</a>.</p>
        </div>
  
      </div>
    </div>-->
<!-- jQuery 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
-->
<!-- Bootstrap JS 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  </footer>

-->