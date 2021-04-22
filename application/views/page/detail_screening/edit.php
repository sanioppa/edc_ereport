<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <i class="fa fa-envelope" aria-hidden="true"></i> Edit Data Sreening
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
              <form method="POST" action="<?=site_url('kegiatan/updateDataScreening');?>" class="form-horizontal">
                <?php foreach ($record as $r) : ?>
                    
                    <input type="text" value="<?= $r->id_kegiatan_screening; ?>" name="id_screening" placeholder="id_data" class="form-control hidden" readonly>
                    <input type="date" value="<?= $r->tgl_kegiatan; ?>" id='tgl_awal' name="tgl_kegiatan" placeholder="Tanggal Kegiatan" class="form-control hidden" autocomplete="off" readonly  required>
                    <!-- <input type="text" value="<?= $r->id_outlet; ?>" name="id_outlet" placeholder="id_outlet" class="form-control hidden" readonly> -->
                <!--
                <?php
                if($level == HAK_ADMIN) //ADMIN
                { ?>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Pengirim</label>
                  <div class="col-sm-10">
                    <select name="id_user" class="form-control" required>
                      <option value="Pilih Atasan" disabled selected>Kantor / Outlet Pengirim</option>
                      <?php foreach ($record as $row) : ?>
                      <option value='<?= $row->id_user; ?>' <?= $row->id_user==$r->id_user?'selected':'';?>><?= $row->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <?php
                }else{ ?>
                  <input type="number" name="id_user" value="<?= $this->session->userdata('id_user'); ?>" hidden>
                <?php
                } ?>
                -->

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Kegiatan</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->nama_kegiatan; ?>" name="nama_kegiatan" placeholder="Nama Kegiatan" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat Kegiatan</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->alamat; ?>" name="alamat_kegiatan" placeholder="Alamat Kegiatan" class="form-control" autocomplete="off" required>
                  </div>
                </div> 

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Jumlah Peserta</label>
                  <div class="col-sm-10">
                    <input type="number" value="<?= $r->jumlah_peserta; ?>" name="jumlah_peserta" placeholder="Jumlah Peserta" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Jumlah Kasus</label>
                  <div class="col-sm-10">
                    <input type="number" value="<?= $r->jumlah_kasus; ?>" name="jumlah_kasus" placeholder="Jumlah Kasus" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->ket; ?>" name="ket" placeholder="Keterangan" class="form-control" autocomplete="off">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Simpan</button>
                    &nbsp;
                    <a href="<?=site_url('kegiatan/DetailScreening/'.$r->id_kegiatan_screening);?>" class="btn btn-danger alert_cancel">Batal</a>
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