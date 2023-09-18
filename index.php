<?php
session_start();

// Yetki bilgisini kontrol etmek
if (isset($_SESSION['yetki'])) {
  $yetki = $_SESSION['yetki'];

  // Admin ise gösterilecek sayfa
  if ($yetki == 1) {
    include_once 'templates/header.php';
    include_once 'templates/navbar.php';
    include_once 'templates/sidebar.php';
    if (isset($_GET['route'])) {
      $pages = 'pages/' . strtolower($_GET['route']) . '.php';
    } else {
      $pages = null;
    }
    if (file_exists($pages)) {
      include_once $pages;
    } else {
      include_once 'pages/index.php';
    }
    include_once 'templates/footer.php';
  } 



  //Yetkisiz kullanıcı içeriği
  else {
    include_once 'data/class.php';
    include_once 'templates/header.php';
    include_once 'yetkisiz.php';
    include_once 'templates/footer.php';
  }
} else {
  // Session yok, login sayfasına yönlendir
  header("Location: login.php");
  exit;
}


?>
