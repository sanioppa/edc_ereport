<?php

$id_role_atasan = '';
$roleId = '';
$kode_role = '';
$role = '';

if(!empty($roleInfo))
{
    foreach ($roleInfo as $rf)
    {
        $id_role_atasan = $rf->id_role_atasan;
        $roleId = $rf->roleId;
        $kode_role = $rf->kode_role;
        $role = $rf->role;
    }
}


?>

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
              <h3 class="box-title"><b>EDIT RIWAYAT MUTASI JABATAN</b></h3>
              </div>
            <div class="box-body">
              <form method="POST" action="<?=site_url('mutasi/update_riwayat_mutasi');?>" class="form-horizontal">
                <?php foreach ($record as $r) : ?>
                
                    <input type="text" value="<?= $r->id_riwayat_mutasi; ?>" name="id_riwayat_mutasi" placeholder="ID Riwayat" class="form-control hidden" required readonly>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label"><i style="color: red;">*</i>NAMA</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->nama_mutasi; ?>" name="nama" placeholder="Nama" class="form-control" required readonly>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label"><i style="color: red;">*</i>NIP</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->nip; ?>" name="nip" placeholder="NIP" class="form-control" required readonly>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label"><i style="color: red;">*</i>NOMOR SK</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->nomor_sk; ?>" name="nomor_sk" placeholder="Masukkan Nomor SK Perubahan Jabatan" class="form-control" required>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label"><dt><i style="color: red;">*</i>JABATAN #1</dt></label>
                  <div class="col-sm-10">
                    <select name="jabatan1" class="form-control" required>
                      <?php
                        if(!empty($jabatan))
                        {
                          foreach ($jabatan as $jab)
                          {
                      ?>
                            <option value="<?php echo $jab->kode_role ?>" <?= $jab->kode_role== $r->jabatan1?"selected":""; ?>><?php echo $jab->role ?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label"><dt><i style="color: red;">*</i>JABATAN #2</dt></label>
                  <div class="col-sm-10">
                    <select name="jabatan2" class="form-control" required>
                            <option value="-" <?= $jab->kode_role == '-'?"selected":""; ?>>- Tidak Ada -</option>
                      <?php
                        if(!empty($jabatan))
                        {
                          foreach ($jabatan as $jab)
                          {
                      ?>
                            <option value="<?php echo $jab->kode_role ?>" <?= $jab->kode_role == $r->jabatan2?"selected":""; ?>><?php echo $jab->role ?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label"><i style="color: red;">*</i>OUTLET</label>
                  <div class="col-sm-10">
                        <select class="form-control" id="kode_perusahaan" name="outlet" required="">
                      <option value="0" disabled=""> - Pilih Outlet -</option>
                        <?php
                          if(!empty($outlet))
                          {
                            foreach ($outlet as $ot)
                            {
                          ?>
                      <option value="<?php echo $ot->id_perusahaan; ?>" <?= $ot->id_perusahaan == $r->outlet?"selected":""; ?>><?php echo $ot->nama_perusahaan ?></option>
                          <?php
                            }
                          }
                        ?>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label" autocomplete="off"><i style="color: red;">*</i>TANGGAL MUTASI</label>
                  <div class="col-sm-10">
                    <input type="date" value="<?= $r->tgl_mutasi; ?>" id="tgl_awal" name="tgl_mutasi" class="form-control" required>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label">KETERANGAN</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->keterangan; ?>" name="keterangan" placeholder="Keterangan" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12" style="text-align: right;">
                    <a href="<?= site_url('mutasi'); ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
                    &nbsp
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-check"></i> Perbarui</button>
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