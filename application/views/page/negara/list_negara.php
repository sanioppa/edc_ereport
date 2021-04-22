<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-envelope" aria-hidden="true"></i> Surat Masuk
        <small>e-Syst</small>
        &nbsp &nbsp
        <a href="inbox/post" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Surat Masuk</a>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
           <!-- ./col -->
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
              <h3 class="box-title"><b>DAFTAR NEGARA</b></h3>
              </div>
                  
            <div class="box-body table-responsive">
              <?php 
              $berhasil = $this->session->flashdata('berhasil');

              if(!empty($berhasil))
              { ?>

              <!--
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= $this->session->flashdata('berhasil'); ?>
              </div>
              -->

              <?php }

              ?>
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th width="30px">NO</th>
                    <th>NAMA</th>
                    <th>IBUKOTA</th>
                    <th>REGIONAL</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($negara as $r) : ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $r->name; ?></td>
                      <td><?= $r->capital; ?></td>
                      <td><?= $r->region; ?></td>
                    </tr>
                  <?php
                    $no++;
                  endforeach; ?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
          
        </div>
    </section>
    
    
</div>