<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
           <!-- ./col -->
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
              <h3 class="box-title"><b>FORM AJUAN CUTI / TIDAK MASUK</b></h3>
              </div>
            <div class="box-body">
              <form method="POST" action="<?=site_url('ajuancuti/postbyadmin');?>" class="form-horizontal">

                <input type="hidden" name="tgl_ajuan" value="<?= date('Y-m-d') ?>" placeholder="Jabatan" class="form-control" readonly="">

                <div class="form-group row">
                  <label for="nip" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                  <select class="form-control required" id="nip" name="nip_pegawai">
                    <option value="0">Pilih Nama</option>
                    <?php
                      if(!empty($nama))
                      {
                        foreach ($nama as $n)
                        {
                          ?>
                          <option value="<?php echo $n->nip ?>"><?php echo $n->nama ?></option>
                          <?php
                        }
                      }
                    ?>
                  </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis Cuti</label>
                  <div class="col-sm-10">
                    <select name="jenis_cuti" class="form-control" required>
                      <option value="Pilih Atasan" disabled selected>Jenis Cuti</option>
                      <option value='bulanan'>Bulanan</option>
                      <option value='izin'>Izin</option>
                      <?php
                      //if ($anggota->gender == 'L') echo "<option value='L' selected>L</option><option value='P'>P</option>";
                      //else echo "<option value='L'>L</option><option value='P' selected>P</option>";
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Ajuan</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_ajuan" placeholder="Nama ajuan cuti" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Cuti</label>
                  <div class="col-sm-2">
                    <input type="date" id="tgl_awal" name="tgl_awal" placeholder="Tanggal Awal" class="form-control">
                  </div>
                  <div class="col-sm-1">
                    <center><h5> sampai </h5></center>
                  </div>
                  <div class="col-sm-2">
                    <input type="date" id="tgl_akhir" name="tgl_akhir" placeholder="Tanggal Akhir" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Keterangan / Alasan</label>
                  <div class="col-sm-10">
                    <input type="text" name="keterangan" placeholder="Tulis keterangan cuti" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat Cuti</label>
                  <div class="col-sm-10">
                    <input type="text" name="alamat_cuti" placeholder="Alamat saat cuti" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">No. Telp Cuti</label>
                  <div class="col-sm-10">
                    <input type="text" name="telp_cuti" placeholder="No. Telp yang bisa dihubungi" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Kirim Ajuan</button>
                    <a href="<?= site_url(); ?>" class="btn btn-danger">Batal</a>
                  </div>
                </div>
              </form>
            </div>
            </div>
          </div>
        </div>
    </section>
</div>