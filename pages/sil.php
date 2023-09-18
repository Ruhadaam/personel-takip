

<?php include_once 'data/class.php';



if (isset($_POST['delete'])) {
  $dataDelete = $_POST['dataDelete'];
  
  // İlgili kaydın dosya yolunu al
  $stmt = $pdo->prepare("SELECT personel_resim FROM personel_tbl WHERE personel_id = $dataDelete");
  $stmt->execute();
  $dosyaYolu = $stmt->fetchColumn();

  // Kaydı sil
  $stmt = $pdo->prepare("DELETE FROM personel_tbl WHERE personel_id = $dataDelete");
  $stmt->execute();

  // Dosya varsa sil
  if (!empty($dosyaYolu) && file_exists($dosyaYolu)) {
    unlink($dosyaYolu);
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
<td><?php print $value['personel_medeni']; ?></td>
<td><?php print $value['personel_gorev']; ?></td>
<td><?php print $value['personel_adres']; ?></td>
<td><?php print $value['personel_telefon']; ?></td>
<td><?php print $value['personel_egitim']; ?></td>
<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default<?php print $value['personel_id']; ?>">Sil</button>

<div class="modal fade" id="modal-default<?php print $value['personel_id']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">SİL </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Üye Silme</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form method="POST">
          
            <input type="hidden" name="dataDelete" value="<?php print $value['personel_id']; ?>">
                  <p><?php print $value['personel_tc']; ?> Tc Numaralı <?php print mb_strtoupper($value['personel_ad']); ?> <?php print mb_strtoupper($value['personel_soyad']); ?> adlı kişiyi silmek istiyor musunuz ? </p>


                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-danger">Sil</button>
                  </div>
                  <input type="hidden" name="delete" value="1002">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
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
  </section>
  <!-- /.content -->
</div>



<!-- MODAL -->


