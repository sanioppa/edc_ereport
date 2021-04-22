<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
        &nbsp &nbsp
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
           <!-- ./col -->
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
              <table class="table">
                    <thead>
                      <tr>
                        <th colspan="3">Filter</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="col-sm-4 row">
                          <label class="control-label col-sm-4">Kantor/Outlet</label>
                          <select class="form-control" name="kode_perusahaan" id="kode_perusahaan">
                            <option value="ALL">-- Semua Outlet --</option>
                            <?php
                            if(!empty($outlet))
                            {
                              foreach ($outlet as $p)
                              {
                            ?>
                            <option value="<?php echo $p->id_perusahaan ?>"><?php echo $p->nama_perusahaan ?></option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </td>
                        <!--
                        <td class="col-sm-4">
                          <label class="control-label">Bulan Masuk</label>
                          <select class="form-control col-sm-4" name="bulan" id="bulan">
                            <option value="0">-- Semua --</option>
                            <option value="01">Januari</option>
                          </select>
                        </td>
                        -->
                        <td class="col-sm-4">
                          <label class="control-label">Tahun Masuk</label>
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
                        <td class="col-sm-4">
                          <label class="control-label">Jabatan</label>
                          <select class="form-control col-sm-4" name="jabatan" id="jabatan">
                            <option value="ALL">-- Semua --</option>
                            <?php
                            if(!empty($jabatan))
                            {
                              foreach ($jabatan as $jab)
                              {
                            ?>
                            <option value="<?php echo $jab->kode_role ?>"><?php echo $jab->role ?></option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              <table id="pegawai" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>NAMA</th>
                  <th>OUTLET</th>
                  <th width="200px">JABATAN 1</th>
                  <th width="200px">JABATAN 2</th>
                  <th width="130px">ACTION</th>
                </tr>
                </thead>
                <tbody>

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
    pegawai();
    $("#kode_perusahaan").change(function(){
      pegawai();
    });
  });
  $(document).ready(function() {
    pegawai();
    $("#tahun").change(function(){
      pegawai();
    });
  });
  $(document).ready(function() {
    pegawai();
    $("#jabatan").change(function(){
      pegawai();
    });
  });

  function pegawai() {
    var kode_perusahaan = $("#kode_perusahaan").val();
    var tahun = $("#tahun").val();
    var jabatan = $("#jabatan").val();
    $.ajax({
      url : "<?= base_url('mutasi/load_pegawai') ?>",
      data: "&kode_perusahaan=" + kode_perusahaan + "&tahun=" + tahun + "&jabatan=" + jabatan,
      success:function(data) {
        $("#pegawai tbody").html(data);
      }
    });
  }
</script>