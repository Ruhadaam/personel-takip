<?php 
session_start();
include_once 'data/class.php'; ?>

<?php 
if (isset($_POST['register'])) {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $mail = $_POST['mail'];
    $sifre = md5($_POST['sifre']);
    $yetki=false;

    $query = "INSERT INTO `kullanici_tbl`(`ad`, `soyad`, `mail`, `sifre`,yetki) VALUES (?, ?, ?, ?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$ad, $soyad, $mail, $sifre,$yetki]);
}
?>

<?php 
if (isset($_POST['login'])) {
    // Formdan gönderilen email ve şifre değerlerini almak için
    $email = $_POST['email'];
    $sifre = md5($_POST['password']);

    // Kullanıcı bilgilerini sorgulamak için
    $query = "SELECT * FROM kullanici_tbl WHERE mail = :mail AND sifre = :sifre";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':mail', $email);
    $stmt->bindParam(':sifre', $sifre);
    $stmt->execute();

    // Eğer kullanıcı bilgisi varsa, kullanıcının yetki bilgisini al ve sessiona ata
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        $yetki = $user['yetki'];
    
        // Session'ı başlat ve yetki bilgisini sessiona ata
        session_start();
        $_SESSION['yetki'] = $yetki;
    
        // index.php sayfasına yönlendir
        header("Location: index.php");
        exit();
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> HATA!</h5>
            Geçersiz email veya şifre.
        </div>';
    }
}
?>


<?php include_once 'templates/header.php'; ?>

<div class="container" style="margin-top: 6rem;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 bg-light rounded shadow">
                <div class="card-body">
                    <h1 class="text-center fw-bold fs-3">Login</h1>
                    <hr>
                    <form method="POST">
                        <div class="form-group mb-3">
                            <label for="email" class="fw-bold">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email Giriniz..." required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="fw-bold">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Şifrenizi Giriniz..."
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-success w-100" name="login">Giriş</button>
                        </div>
                        <div class="form-group mb-0 text-center">
                            Üye değil misin ?
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#registerModal">Kaydol</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kayıt Modalı -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kaydol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="ad" class="fw-bold">Ad</label>
                        <input type="text" id="ad" name="ad" class="form-control" placeholder="Adınızı girin" required>
                    </div>
                    <div class="form-group">
                        <label for="soyad" class="fw-bold">Soyad</label>
                        <input type="text" id="soyad" name="soyad" class="form-control" placeholder="Soyadınızı girin" required>
                    </div>
                    <div class="form-group">
                        <label for="mail" class="fw-bold">Email</label>
                        <input type="email" id="mail" name="mail" class="form-control" placeholder="Email adresinizi girin"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="sifre" class="fw-bold">Şifre</label>
                        <input type="password" id="sifre" name="sifre" class="form-control" placeholder="Şifrenizi belirleyin"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary" name="register">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>