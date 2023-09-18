<?php include_once 'data/class.php' ?>
<?php


if (isset($_POST['update'])) {
    $personel_tc = $_POST['personel_tc'];
    $personel_ad = $_POST['personel_ad'];
    $personel_soyad = $_POST['personel_soyad'];
    $personel_dogum = $_POST['personel_dogum'];
    $personel_telefon = $_POST['personel_telefon'];
    $personel_gorev = $_POST['personel_gorev'];
    $personel_adres = $_POST['personel_adres'];
    $personel_egitim = $_POST['personel_egitim'];
    $personel_mail = $_POST['personel_mail'];
 // Resim dizinini oluştur
 if (!file_exists("personel")) {
    mkdir("personel");
}
$foto_yol = "";
// Resim dosyası bilgilerini al
$dizin = "personel/";
$personel_ad = $_POST['personel_ad'];
$personel_soyad = $_POST['personel_soyad'];
$yuklenecekResim = $dizin . $personel_ad . '_' . $personel_soyad . '.jpg';

// Resim yükleme
// Resim yükleme
if (move_uploaded_file($_FILES["personel_resim"]["tmp_name"], $yuklenecekResim)) {
    echo "Resminiz başarıyla yüklendi";

    // Yeni boyutlar
    $yeni_genislik = 256;
    $yeni_yukseklik = 256;

    // Orijinal resmi yükleme
    $orijinal_resim = imagecreatefromstring(file_get_contents($yuklenecekResim));

    // Orijinal boyutları almak
    list($orijinal_genislik, $orijinal_yukseklik) = getimagesize($yuklenecekResim);

    // Yeni bir resim oluşturma
    $yeni_resim = imagecreatetruecolor($yeni_genislik, $yeni_yukseklik);

    // Yeniden boyutlandırma işlemi
    imagecopyresized($yeni_resim, $orijinal_resim, 0, 0, 0, 0, $yeni_genislik, $yeni_yukseklik, $orijinal_genislik, $orijinal_yukseklik);

    // Yeni resmi kaydetme
    $yeni_resim_yolu = $dizin . "personel_" . $personel_ad . '_' . $personel_soyad . '.jpg';
    if (imagejpeg($yeni_resim, $yeni_resim_yolu)) {
        echo "Yeni boyutlu resim başarıyla kaydedildi.";
        // Yeni boyutlu resmin yolunu değişkene ata
        $foto_yol = $yeni_resim_yolu;
    } else {
        echo "Yeni boyutlu resim kaydedilemedi.";
    }
} else {
    $foto_yol = "";
}


    // Güncelleme sorgusu
    $sql = "UPDATE personel_tbl SET
    personel_tc = '".$_POST["personel_tc"]."',
    personel_ad = '".$_POST["personel_ad"]."',
    personel_soyad = '".$_POST["personel_soyad"]."',
    personel_dogum = '".$_POST["personel_dogum"]."',
    personel_cinsiyet = '".$_POST["personel_cinsiyet"]."',
    personel_medeni = '".$_POST["personel_medeni"]."',
    personel_telefon = '".$_POST["personel_telefon"]."',
    personel_gorev = '".$_POST["personel_gorev"]."',
    personel_adres = '".$_POST["personel_adres"]."',
    personel_egitim = '".$_POST["personel_egitim"]."',
    personel_mail = '".$_POST["personel_mail"]."',
    personel_resim = '".$foto_yol."'
    WHERE personel_id = ".$_POST["personel_id"];


    // Güncelleme sorgusunun çalıştırılması
    if ($pdo->query($sql) === TRUE) {
        echo "Kayıt güncellendi";
    } 
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Personel Listeleme</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">

          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>




  <!-- Main content -->
  <section class="content">
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
                    <th>KIMLIK NO</th>
                    <th>AD</th>
                    <th>SOYAD</th>
                    <th>DOGUM</th>
                    <th>MEDENI</th>
                    <th>GOREV</th>
                    <th>ADRES</th>
                    <th>TELEFON</th>
                    <th>EGITIM</th>
                    <th>GUNCELLE</th>
                    
                    
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
    <td><?php print $value['personel_medeni']; ?></td>
    <td><?php print $value['personel_gorev']; ?></td>
    <td><?php print $value['personel_adres']; ?></td>
    <td><?php print $value['personel_telefon']; ?></td>
    <td><?php print $value['personel_egitim']; ?></td>
    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-lg<?php print $value['personel_id']; ?>">Güncelle</button>


        
    <div class="modal fade" id="modal-lg<?php print $value['personel_id']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Personeli Güncelle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                        
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>Kimlik Numarası</label>
                    <input type="text" class="form-control" name="personel_tc" value="<?php echo $value['personel_tc']; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Adı</label>
                    <input type="text" class="form-control" name="personel_ad" value="<?php echo $value['personel_ad']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>Soyadı</label>
                    <input type="text" class="form-control" name="personel_soyad" value="<?php echo $value['personel_soyad']; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Doğum Tarihi</label>
                    <input type="date" class="form-control" name="personel_dogum" value="<?php echo $value['personel_dogum']; ?>">
                </div>
            </div>
        </div>

        <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Cinsiyet -->
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="erkek"
                                                    name="personel_cinsiyet" value="erkek" <?php if ($value['personel_cinsiyet'] == 'erkek')
                                                        echo 'checked'; ?>>
                                                <label for="erkek" class="custom-control-label">Erkek</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kadın"
                                                    name="personel_cinsiyet" value="kadın" <?php if ($value['personel_cinsiyet'] == 'kadın')
                                                        echo 'checked'; ?>>
                                                <label for="kadın" class="custom-control-label">Kadın</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Medeni Hal -->
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="evli"
                                                    name="personel_medeni" value="evli">
                                                <label for="evli" class="custom-control-label">Evli</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="bekar"
                                                    name="personel_medeni" value="bekar" checked>
                                                <label for="bekar" class="custom-control-label">Bekar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    


        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>Telefon</label>
                    <input type="text" name="personel_telefon" class="form-control" value="<?php echo $value['personel_telefon']; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Görev</label>
                    <input type="text" name="personel_gorev" class="form-control" value="<?php echo $value['personel_gorev']; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                    <label>Adres</label>
                    <textarea class="form-control" name="personel_adres" rows="3"><?php echo $value['personel_adres']; ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <!-- select -->
                <div class="form-group">
                    <label>Eğitim Durumu</label>
                    <select class="custom-select" name="personel_egitim">
                        <option <?php if ($value['personel_egitim'] == 'İlkokul')
                            echo 'selected'; ?>>İlkokul</option>
                        <option <?php if ($value['personel_egitim'] == 'Ortaokul')
                            echo 'selected'; ?>>Ortaokul</option>
                        <option <?php if ($value['personel_egitim'] == 'Lise')
                            echo 'selected'; ?>>Lise</option>
                        <option <?php if ($value['personel_egitim'] == 'Üniversite')
                            echo 'selected'; ?>>Üniversite</option>
                        <option <?php if ($value['personel_egitim'] == 'Yüksek Lisans')
                            echo 'selected'; ?>>Yüksek Lisans</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Mail</label>
                    <input type="email" class="form-control" name="personel_mail" value="<?php echo $value['personel_mail']; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 ">
                <label>Fotoğraf Yükle :</label>
                <input type="file" aria-label="Fotoğraf Seçin" lang="tr" name="personel_resim" accept=".jpg, .png, .jpeg">
            </div>
         
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-success" name="update">Kaydet</button>
        </div>
        <input type="hidden" name="personel_id" value="<?php print $value['personel_id']; ?>">  
    </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
                    <th>KIMLIK NO</th>
                    <th>AD</th>
                    <th>SOYAD</th>
                    <th>DOGUM</th>
                    <th>MEDENI</th>
                    <th>GOREV</th>
                    <th>ADRES</th>
                    <th>TELEFON</th>
                    <th>EGITIM</th>
                    <th>GUNCELLE</th>
                    
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
  </section>
  <!-- /.content -->
</div>



<!-- MODAL -->


