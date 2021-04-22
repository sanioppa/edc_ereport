<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <i class="fa fa-envelope" aria-hidden="true"></i> Edit Kegiatan
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
              <form method="POST" action="<?=site_url('kegiatan/update');?>" class="form-horizontal">
                <?php foreach ($kegiatan as $r) : ?>
                    
                    <input type="text" value="<?= $r->id_kegiatan; ?>" name="id_kegiatan" placeholder="id_data" class="form-control hidden" readonly>

                <?php
                if($level == HAK_ADMIN) //ADMIN
                { ?>
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
                        <option value="<?php echo $h->id_user ?>" <?= $h->id_user == $r->user ? 'selected':''; ?>><?php echo $h->name ?></option>
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
                        <option value="<?php echo $o->nama_outlet ?>" <?= $o->nama_outlet == $r->id_outlet ? 'selected':''; ?>><?php echo $o->nama_outlet ?></option>
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
                      <input type="text" value="<?= date('Y-m-d'); ?>" id="tgl_akhir" name="tgl_kegiatan" placeholder="Tanggal Kegiatan" class="form-control" autocomplete="off" required>
                    </div>
                  </div>
                <?php
                }else{ ?>
                  <input type="number" name="id_user" value="<?= $this->session->userdata('id_user'); ?>" class="form-control hidden" readonly>
                  <input type="text" name="id_outlet" value="<?= $this->session->userdata('outlet'); ?>" class="form-control hidden" readonly>
                  <input type="text" value="<?= date('Y-m-d'); ?>" id="tgl_akhir" name="tgl_kegiatan" placeholder="Tanggal Kegiatan" class="form-control hidden" autocomplete="off" readonly required>
                <?php
                } ?>
                
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
                      <option value="<?php echo $k->id_klasifikasi ?>" <?= $k->id_klasifikasi == $r->id_klasifikasi ? 'selected':''; ?>><?php echo $k->id_klasifikasi ?> | <?php echo $k->subnama_klasifikasi ?></option>
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
                    <input type="text" name="nama_kegiatan" value="<?= $r->nama_kegiatan; ?>" placeholder="Nama Kegiatan" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Instansi</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_instansi" value="<?= $r->nama_instansi; ?>" placeholder="Nama Instansi" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Personal</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_personal" value="<?= $r->nama_personal; ?>" placeholder="Nama Personal" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" name="alamat" value="<?= $r->alamat; ?>" placeholder="Alamat" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">No. Telp</label>
                  <div class="col-sm-10">
                    <input type="text" name="no_telp" value="<?= $r->no_telp; ?>" placeholder="Nomor Telepon" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Keterangan / Tujuan</label>
                  <div class="col-sm-10">
                    <input type="text" name="keterangan" value="<?= $r->keterangan; ?>" placeholder="Keterangan" class="form-control">
                  </div>
              </div>

                <div class="form-group row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Simpan</button>
                    <!-- <a href="../update" class="btn btn-success alert_simpan">Simpan</a> -->
                    &nbsp;
                    <a href="<?=site_url('kegiatan');?>" class="btn btn-danger alert_simpan">Batal</a>
                  </div>
                </div>
                <?php endforeach; ?>
              </form>
            </div>
            </div>
          </div>
        </div>
    </section>
</div>

