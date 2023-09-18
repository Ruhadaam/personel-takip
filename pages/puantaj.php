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
                   
                    <?php
                    // 31 sütun için örnek olarak kolaylık sağlayacak şekilde numaralandırıyoruz
                    for ($i = 1; $i <= 31; $i++) {
                        echo '<th>' . $i . '</th>';
                    }
                    ?>
                </tr>

            </thead>
                <tbody>
               
                </tbody>
                <tfoot>
                <tr>
                   
                   <?php
                   // 31 sütun için örnek olarak kolaylık sağlayacak şekilde numaralandırıyoruz
                   for ($i = 1; $i <= 31; $i++) {
                       echo '<th>' . $i . '</th>';
                   }
                   ?>
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
