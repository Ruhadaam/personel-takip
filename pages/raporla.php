<?php include_once 'data/class.php' ?>

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


