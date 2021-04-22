<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-envelope" aria-hidden="true"></i> Detail Screening
        <small>e-Syst</small>
        &nbsp &nbsp
      </h1>
    </section>

  
    
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-danger">
              <div class="box-header">
              <h3 class="box-title"><b><?= $title ?></b></h3>
                <?php
                  foreach($record as $r){
                  }
                  if(empty($r->id_kegiatan_screening)){
                ?>
                    <a href="<?=site_url('kegiatan/addDataScreening/'.$this->uri->segment('3'));?>" class="btn btn-danger pull-right"><i class="fa fa-plus"></i> Tambah Data Screening</a>
                <?php
                  }else{
                ?>
                    <a href="<?=site_url('kegiatan/editDataScreening/'.$r->id_kegiatan);?>" class="btn btn-success pull-right"><i class="fa fa-edit"></i> Edit Data Screening</a>
                <?php
                  }
                ?>
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

              foreach ($record as $r) {
                # code...
              }

              ?>

              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 control-label">ID Kegiatan</label>
                <div class="col-sm-10">
                  <?php
                  foreach ($kegiatan as $k) {

                  } ?>
                  <?= $k->id_kegiatan; ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 control-label">Nama Kegiatan</label>
                <div class="col-sm-10">
                  <?php
                  foreach ($kegiatan as $k) {

                  } ?>
                  <?= $k->nama_kegiatan; ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 control-label">Alamat Kegiatan</label>
                <div class="col-sm-10">
                  <?php
                  foreach ($kegiatan as $k) {

                  } ?>
                  <?= $k->alamat; ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Kegiatan</label>
                <div class="col-sm-10">
                  <?php
                  foreach ($kegiatan as $k) {

                  } ?>
                  <?= tgl_indo($k->tgl_kegiatan); ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 control-label">Jumlah Peserta</label>
                <div class="col-sm-10">
                  <?php
                    if(empty($r->jumlah_peserta)){
                      echo "Belum ada data";
                    }else{
                      echo $r->jumlah_peserta." Peserta";
                    }
                  ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 control-label">Jumlah Kasus</label>
                <div class="col-sm-10">
                  <?php
                    if(empty($r->jumlah_kasus)){
                      echo "Belum ada data";
                    }else{
                      echo $r->jumlah_kasus." Kasus";
                    }
                  ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-10">
                  <?php
                    if(empty($r->ket)){
                      echo "Tidak ada";
                    }else{
                      echo $r->ket;
                    }
                  ?>
                </div>
              </div>

              <div>
                <br>
                <div class="box-header">
                  <a href="<?=site_url('kegiatan/addDataKasus/'.$this->uri->segment('3'));?>" class="btn btn-danger pull-left"><i class="fa fa-plus"></i> Tambah Daftar Kasus</a>
                </div>
              </div>

              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>NAMA PESERTA</th>
                    <th>NIK</th>
                    <th>NO. TELP</th>
                    <th>ALAMAT</th>
                    <th>JENIS KASUS</th>
                    <th>KETERANGAN</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                  foreach($kasus as $r) : ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $r->nama_peserta; ?></td>
                    <td><?= $r->nik; ?></td>
                    <td><?= $r->no_telp; ?></td>
                    <td><?= $r->alamat_peserta; ?></td>
                    <td><?= $r->jenis_kasus; ?></td>
                    <td>
                          <?php
                          $nilai = $r->ket;
                          $hasil = $nilai!="" ? $r->ket : 'Tidak ada';
                          echo $hasil;
                          ?>
                    </td>
                    <td>
                      <center>
                      <a href="<?=site_url('kegiatan/editDataKasus/'.$r->id_daftar_kasus);?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="<?=site_url('kegiatan/deleteDataKasus/'.$r->id_daftar_kasus);?>" class="btn btn-danger btn-xs alert_hapus" title="Hapus"><i class="fa fa-trash"></i></a>
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

<script src="assets/dist/ajax/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    outbox();
    $("#tahun").change(function(){
      outbox();
    });
  });
  $(document).ready(function() {
    outbox();
    $("#bulan").change(function(){
      outbox();
    });
  });
  $(document).ready(function() {
    outbox();
    $("#kode_klasifikasi").change(function(){
      outbox();
    });
  });

  function outbox() {
    //var tgl_awal = $("#tgl_awal").val();
    //var tgl_akhir = $("#tgl_akhir").val();
    var tahun = $("#tahun").val();
    var bulan = $("#bulan").val();
    var kode_klasifikasi = $("#kode_klasifikasi").val();
    $.ajax({
      url : "<?= base_url('outbox/load_outbox') ?>",
      data: "&tahun=" + tahun + "&bulan=" + bulan + "&kode_klasifikasi=" + kode_klasifikasi,
      success:function(data) {
        $("#outbox tbody").html(data);
      }
    });
  }
</script>