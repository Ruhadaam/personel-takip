<?php

$pdo = new PDO('mysql:host=localhost;dbname=personel_db', 'root', '');
if ($pdo) {
   
} else {
    echo "Veritabanı bağlantısı sağlanamadı.";
}


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>