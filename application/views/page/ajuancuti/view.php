<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i><b>  DAFTAR AJUAN CUTI PEGAWAI</b>
    </section>
    
    <section class="content">
        <div class="row">
           <!-- ./col -->
          <div class="col-xs-12">
            <div class="box box-info">

            <div class="box-body">
              
                <div class="col-sm-12 row">
                  <table class="table">
                    <thead>
                      <tr>
                        <th colspan="4">Filter</th>
                        <th align="right">
                        <a href="ajuancuti/tambah" class="btn btn-success pull-right"><i class="fa fa-plus"></i> TAMBAH AJUAN</a>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <!--
                        <td width='50px'><b>Jenis</b></td>
                        <td>
                          <select class="form-control" name="jenis_cuti" id="jenis_cuti">
                            <option value="0">-- Semua --</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="izin">Izin</option>
                          </select>
                        </td>
                        -->
                        <td>
                          <label class="control-label">Tahun</label>
                          <select class="form-control col-sm-4" name="tahun" id="tahun">
                            <option value="0">-- Semua --</option>
                            <?php
                            $thn_skr = date('Y');
                            for ($x = $thn_skr; $x >= 2010; $x--) {
                            ?>
                                <option value="<?php echo $x ?>"><?php echo $x ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </td>
                        <td>&nbsp; &nbsp;</td>
                        <td>
                          <label class="control-label">Bulan</label>
                          <select class="form-control col-sm-4" name="bulan" id="bulan">
                            <option value="0">-- Semua --</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                          </select>
                        </td>
                        <td>&nbsp; &nbsp;</td>
                        <td>
                          <label class="control-label">Status</label>
                          <select class="form-control col-sm-4" name="status_ajuan" id="status_ajuan">
                            <option value="0">-- Semua --</option>
                            <option value="1">Belum Disetujui</option>
                            <option value="2">Disetujui</option>
                            <option value="3">Ditolak</option>
                          </select>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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

              <table id="ajuan_cuti" class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th width="10px">NO</th>
                    <th width="150px">NAMA</th>
                    <th width="100px">TGL AJUAN</th>
                    <th width="120px">TGL CUTI</th>
                    <th width="150px">PERIHAL</th>
                    <th width="70px">LAMA</th>
                    <th>ALASAN</th>
                    <th>STATUS</th>
                    <th width="120px">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>

        <?php
        foreach ($record as $r) {
        ?>

          <div id="modalhapus" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- konten modal-->
              <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                  <button type="button" class="close btn btn-danger btn-xs" data-dismiss="modal"> x </button>
                  <h4 class="modal-title"><b>Notice!</b></h4>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                  <h4>Anda yakin menghapus data ajuan cuti?</h4>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                  <a href="<?=site_url('ajuancuti/hapusbyadmin/'.$r->id_ajuan_cuti);?>" class="btn btn-primary" ><i class="fa fa-check"></i>Yes</a>
                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Tidak</button>
                </div>
              </div>
            </div>
          </div>

          <?php } ?>
    </section>
</div>

<script src="assets/dist/ajax/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!--
<script>
  $(document).ready(function() {
    ajuan_cuti();
    $("#jenis_cuti").change(function(){
      ajuan_cuti();
    });
  });

  $(document).ready(function() {
    ajuan_cuti();
    $("#status_ajuan").change(function(){
      ajuan_cuti();
    });
  });

  function ajuan_cuti() {
    var jenis_cuti = $("#jenis_cuti").val();
    var status_ajuan = $("#status_ajuan").val();
    $.ajax({
      url : "<?= base_url('ajuancuti/load_ajuancuti') ?>",
      data: "&jenis_cuti=" + jenis_cuti + "&status_ajuan=" + status_ajuan,
      success:function(data) {
        $("#ajuan_cuti tbody").html(data);
      }
    });
  }
</script> -->
<script>
  $(document).ready(function() {
    ajuan_cuti();
    $("#tahun").change(function(){
      ajuan_cuti();
    });
  });

  $(document).ready(function() {
    ajuan_cuti();
    $("#bulan").change(function(){
      ajuan_cuti();
    });
  });

  $(document).ready(function() {
    ajuan_cuti();
    $("#status_ajuan").change(function(){
      ajuan_cuti();
    });
  });

  function ajuan_cuti() {
    var tahun = $("#tahun").val();
    var bulan = $("#bulan").val();
    var status_ajuan = $("#status_ajuan").val();
    $.ajax({
      url : "<?= base_url('ajuancuti/load_ajuancuti') ?>",
      data: "&tahun=" + tahun + "&bulan=" + bulan + "&status_ajuan=" + status_ajuan,
      success:function(data) {
        $("#ajuan_cuti tbody").html(data);
      }
    });
  }
</script>