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
              <h3 class="box-title"><b>MUTASI JABATAN</b></h3>
              </div>
            <div class="box-body">
              <form method="POST" action="<?=site_url('mutasi/update_mutasi');?>" class="form-horizontal">
                <?php foreach ($record as $r) : ?>
                
                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label">*NAMA</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->nama; ?>" name="nama" placeholder="Nama" class="form-control" required readonly>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label">*NIP</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->nip; ?>" name="nip" placeholder="NIP" class="form-control" required readonly>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label">*NOMOR SK</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomor_sk" placeholder="Masukkan Nomor SK Perubahan Jabatan" class="form-control" required>
                  </div>
                </div>

                <input type="text" name="eksjabatan1" value="<?= $r->kode_role ?>" class="form-control hidden" required>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label"><dt>*JABATAN 1</dt></label>
                  <div class="col-sm-10">
                    <select name="jabatan1" class="form-control" required>
                      <?php
                        if(!empty($jabatan))
                        {
                          foreach ($jabatan as $jab)
                          {
                      ?>
                            <option value="<?php echo $jab->kode_role ?>" <?= $jab->kode_role== $r->kode_role?"selected":""; ?>><?php echo $jab->role ?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <input type="text" name="eksjabatan2" value="<?= $r->kode_role2 ?>" class="form-control hidden" required>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label"><dt>*JABATAN 2</dt></label>
                  <div class="col-sm-10">
                    <select name="jabatan2" class="form-control" required>
                            <option value="-" <?= $jab->kode_role == '-'?"selected":""; ?>>- Tidak Ada -</option>
                      <?php
                        if(!empty($jabatan))
                        {
                          foreach ($jabatan as $jab)
                          {
                      ?>
                            <option value="<?php echo $jab->kode_role ?>" <?= $jab->kode_role == $r->kode_role2?"selected":""; ?>><?php echo $jab->role ?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label">*OUTLET</label>
                  <div class="col-sm-10">
                        <select class="form-control" id="kode_perusahaan" name="outlet" required="">
                      <option value="0" disabled=""> - Pilih Outlet -</option>
                        <?php
                          if(!empty($outlet))
                          {
                            foreach ($outlet as $ot)
                            {
                          ?>
                      <option value="<?php echo $ot->id_perusahaan; ?>" <?= $ot->id_perusahaan == $r->kode_perusahaan?"selected":""; ?>><?php echo $ot->nama_perusahaan ?></option>
                          <?php
                            }
                          }
                        ?>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label" autocomplete="off">*TANGGAL MUTASI</label>
                  <div class="col-sm-10">
                    <input type="date" id="tgl_awal" name="tgl_mutasi" class="form-control" required>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="inputPassword3" class="col-sm-2 control-label">KETERANGAN</label>
                  <div class="col-sm-10">
                    <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" autocomplete="off" required>
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