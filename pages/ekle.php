<?php

$pdo = new PDO('mysql:host=localhost;dbname=personel_db', 'root', '');
if ($pdo) {
    echo "Veritabanı bağlantısı sağlandı";
} else {
    echo "Veritabanı bağlantısı sağlanamadı.";
}


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





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






if (isset($_POST['save'])) {
    // Resim dizinini oluştur
    if (!file_exists("personel")) {
        mkdir("personel");
    }
    
    // Formdan gelen verileri alın
    $personel_tc = $_POST['personel_tc'];
    $personel_ad = $_POST['personel_ad'];
    $personel_soyad = $_POST['personel_soyad'];
    $personel_dogum = $_POST['personel_dogum'];
    $personel_cinsiyet = $_POST['personel_cinsiyet'];
    $personel_medeni = $_POST['personel_medeni'];
    $personel_telefon = $_POST['personel_telefon'];
    $personel_gorev = $_POST['personel_gorev'];
    $personel_adres = $_POST['personel_adres'];
    $personel_egitim = $_POST['personel_egitim'];
    $personel_mail = $_POST['personel_mail'];
    
    // Resim dosyası bilgilerini al
    $dizin = "personel/";
    $yuklenecekResim = $dizin . $personel_ad . '_' . $personel_soyad . '.jpg';

    // Resim yükleme
    if (move_uploaded_file($_FILES["personel_resim"]["tmp_name"], $yuklenecekResim)) {
        echo "Resminiz başarıyla yüklendi";

        // Veritabanına kaydedilecek fotoğraf yolunu belirleme
        $foto_yol = $yuklenecekResim;

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

        // Yeni boyutlu resmi kaydetme
        if (imagejpeg($yeni_resim, $yuklenecekResim)) {
            echo "Yeni boyutlu resim başarıyla kaydedildi.";
        } else {
            echo "Yeni boyutlu resim kaydedilemedi.";
        }
    } else {
        $foto_yol = "";
    }

    // Veritabanına kaydetme
    $query = "INSERT INTO `personel_tbl`(`personel_tc`, `personel_ad`, `personel_soyad`, `personel_dogum`, `personel_cinsiyet`, `personel_medeni`, `personel_gorev`, `personel_adres`, `personel_telefon`, `personel_egitim`, `personel_mail`, `personel_resim`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute([$personel_tc, $personel_ad, $personel_soyad, $personel_dogum, $personel_cinsiyet, $personel_medeni, $personel_gorev, $personel_adres, $personel_telefon, $personel_egitim, $personel_mail, $foto_yol]);
        $success = true;
        echo "Veritabanına kaydedildi.";
    } catch (PDOException $e) {
        echo "Veritabanına kaydedilirken bir hata oluştu: " . $e->getMessage();
    }
}
?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Personel İstatistikleri</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6" data-toggle="modal" data-target="#modal-lg" style="cursor:pointer;">

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
                <div class="col-lg-3 col-6" data-toggle="modal" data-target="#modal-lg" style="cursor:pointer;">
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
            <!-- Main row -->
        

    </section>
    <!-- /.content -->




</div>



<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Yeni Personel Ekle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- general form elements disabled -->
                <div class="card card-success">
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
                                        <input type="text" class="form-control" name="personel_tc" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Adı</label>
                                        <input type="text" class="form-control" name="personel_ad" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Soyadı</label>
                                        <input type="text" class="form-control" name="personel_soyad" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Doğum Tarihi</label>
                                        <input type="date" class="form-control" name="personel_dogum">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Cinsiyet -->
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="erkek"
                                                name="personel_cinsiyet" value="erkek" checked>
                                            <label for="erkek" class="custom-control-label">Erkek</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="kadın"
                                                name="personel_cinsiyet" value="kadın">
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
                                        <input type="text" class="form-control" name="personel_telefon">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Görev</label>
                                        <input type="text" class="form-control" name="personel_gorev">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Adres</label>
                                        <textarea class="form-control" rows="3" name="personel_adres"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Eğitim Durumu</label>
                                        <select class="custom-select" name="personel_egitim">
                                            <option>İlkokul</option>
                                            <option>Ortaokul</option>
                                            <option>Lise</option>
                                            <option>Üniversite</option>
                                            <option>Yüksek Lisans</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mail</label>
                                        <input type="Mail" class="form-control" name="personel_mail">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6 ">
                                    <label>Fotoğraf Yükle :</label>
                                    <input type="file" aria-label="Fotoğraf Seçin" lang="tr" name="personel_resim"
                                        accept=".jpg, .png, .jpeg">
                                </div>
                               
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                                <button type="submit" name="save" class="btn  btn-success ">Kaydet</button>
                            </div>
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