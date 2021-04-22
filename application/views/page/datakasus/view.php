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

    <!-- Tabele Filter By Keyword #1 -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
              <h3 class="box-title"><b><?= $title ?></b></h3>
              </div>
                  
            <div class="box-body table-responsive">
              <?php 
              $berhasil = $this->session->flashdata('berhasil');

              if(!empty($berhasil))
              { ?>

              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= $this->session->flashdata('berhasil'); ?>
              </div>

              <?php }

              ?>
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>PENGIRIM</th>
                    <th>NO. SURAT</th>
                    <th width="130px">PERIHAL</th>
                    <th>TGL DITERIMA</th>
                    <th>NAMA PENERIMA</th>
                    <th>KET.</th>
                    <th width="100px">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                  foreach($record as $r) : ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $r->name; ?></td>
                    <td><?= $r->no_surat; ?></td>
                    <td><?= $r->isi; ?></td>
                    <td><?= tgl_indo($r->tgl_diterima); ?></td>
                    <td><?= $r->nama_penerima; ?></td>
                    <td><?= $r->ket; ?></td>
                    <td>
                      <center>
                      <a href="<?=site_url('inbox/edit/'.$r->id_ekspedisi);?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="<?=site_url('inbox/hapus/'.$r->id_ekspedisi);?>" class="btn btn-danger btn-xs alert_hapus" title="Hapus"><i class="fa fa-trash"></i></a>
                      </center>
                    </td>
                  </tr>
                  <?php 
                  $no++;
                  endforeach;?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
          
        </div>
    </section> 
    
</div>