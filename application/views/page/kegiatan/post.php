<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <i class="fa fa-envelope" aria-hidden="true"></i> Tambah Kegiatan
        <small>e-Syst</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
           <!-- ./col -->
          <div class="col-xs-12">
            <div class="box box-danger">
              <div class="box-header">
              <h3 class="box-title"><b><?= $pageTitle ?></b></h3>
              </div>
            <div class="box-body">
              <form method="POST" action="<?=site_url('kegiatan/add');?>" class="form-horizontal">

              <?php
              if($level == HAK_ADMIN){
              ?>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">User / Nama Humas</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="id_user" id="id_user" required="">
                      <option value="" disabled required selected="">- Pilih Nama Humas -</option>
                      <?php
                      if(!empty($humas))
                      {
                        foreach ($humas as $h)
                        {
                      ?>
                      <option value="<?php echo $h->id_user ?>"><?php echo $h->name ?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Outlet</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="id_outlet" id="id_outlet" required="">
                      <option value="" disabled required selected="">- Pilih Outlet -</option>
                      <?php
                      if(!empty($outlet))
                      {
                        foreach ($outlet as $o)
                        {
                      ?>
                      <option value="<?php echo $o->nama_outlet ?>"><?php echo $o->nama_outlet ?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Kegiatan</label>
                  <div class="col-sm-4">
                    <input type="text" value="<?= date('Y-m-d'); ?>" id="tgl_awal" name="tgl_kegiatan" placeholder="Tanggal Kegiatan" class="form-control" autocomplete="off" required>
                  </div>
                </div>
              <?php
              }else{
              ?>
                <input type="text" name="id_user" value="<?= $this->session->userdata('id_user'); ?>" placeholder="ID" class="form-control hidden" autocomplete="off" required>
                <input type="text" name="id_outlet" value="<?= $this->session->userdata('outlet'); ?>" placeholder="ID Outlet" class="form-control hidden" autocomplete="off" required>
                <input type="text" value="<?= date('Y-m-d'); ?>" id="tgl_awal" name="tgl_kegiatan" placeholder="Tanggal Kegiatan" class="form-control hidden" autocomplete="off" required>
              <?php
              }
              ?>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kegiatan</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="id_klasifikasi" id="id_klasifikasi" required="">
                      <option value="" disabled required selected="">- Pilih Salah Satu Jenis Kegiatan -</option>
                      <?php
                      if(!empty($klasifikasi))
                      {
                        foreach ($klasifikasi as $k)
                        {
                      ?>
                      <option value="<?php echo $k->id_klasifikasi ?>"><?php echo $k->id_klasifikasi ?> | <?php echo $k->subnama_klasifikasi ?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Kegiatan</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_kegiatan" placeholder="Nama Kegiatan" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Instansi</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_instansi" placeholder="Nama Instansi / Dinas / Perusahaan / dll." class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Personal</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_personal" placeholder="Nama Personal / Pasien / Orang Terkait" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" name="alamat" placeholder="Alamat Kegiatan / Pasien / Instansi" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">No. Telp</label>
                  <div class="col-sm-10">
                    <input type="number" name="no_telp" placeholder="Nomor Telepon" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Keterangan / Tujuan</label>
                  <div class="col-sm-10">
                    <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" autocomplete="off">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Tambahkan</button>
                    &nbsp;
                    <a href="../kegiatan" class="btn btn-danger">Batal</a>
                  </div>
                </div>
              </form>
            </div>
            </div>
          </div>
        </div>
    </section>
</div>