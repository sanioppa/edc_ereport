<?php

$id_role_atasan = '';
$roleId = '';
$role = '';

if(!empty($roleInfo))
{
    foreach ($roleInfo as $rf)
    {
        $id_role_atasan = $rf->id_role_atasan;
        $roleId = $rf->roleId;
        $role = $rf->role;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <i class="fa fa-eye" aria-hidden="true"></i> Edit Data Temuan Kasus Kegiatan Sreening
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
              <form method="POST" action="<?=site_url('kegiatan/updateDataKasus');?>" class="form-horizontal">
                <?php foreach ($record as $r) : ?>
                    
                    <input type="text" value="<?= $r->id_daftar_kasus; ?>" name="id_daftar_kasus" placeholder="id_data" class="form-control hidden" readonly>
                    <input type="text" value="<?= $r->id_screening; ?>" name="id_screening" placeholder="id_sc" class="form-control hidden" readonly>
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
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Peserta</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->nama_peserta; ?>" name="nama_peserta" placeholder="Nama Peserta" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">N I K</label>
                  <div class="col-sm-10">
                    <input type="number" value="<?= $r->nik; ?>" name="nik" placeholder="NIK" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select name="jk" class="form-control" required>
                      <option value="Pilih Jenis Kelamin" disabled selected>- Pilih Jenis Kelamin -</option>
                      <option value='L' <?= $r->jk == 'L' ? 'selected':''; ?>>Laki - Laki</option>
                      <option value='P' <?= $r->jk == 'P' ? 'selected':''; ?>>Perempuan</option>
                      <?php
                      //if ($anggota->gender == 'L') echo "<option value='L' selected>L</option><option value='P'>P</option>";
                      //else echo "<option value='L'>L</option><option value='P' selected>P</option>";
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">No. Telp</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->no_telp; ?>" name="no_telp" placeholder="Nomor Telepon" class="form-control" autocomplete="off" required>
                  </div>
                </div>  

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat Peserta</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->alamat_peserta; ?>" name="alamat_peserta" placeholder="Alamat Peserta" class="form-control" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kasus</label>
                  <div class="col-sm-10">
                    <select name="jenis_kasus" class="form-control" required>
                      <option value="Pilih Jenis Kelamin" disabled selected>- Pilih Jenis Kasus -</option>
                      <option value='KTR' <?= $r->jenis_kasus == 'KTR' ? 'selected':''; ?>>Katarak</option>
                      <option value='GKM' <?= $r->jenis_kasus == 'GKM' ? 'selected':''; ?>>Glaukoma</option>
                      <option value='PTE' <?= $r->jenis_kasus == 'PTE' ? 'selected':''; ?>>Pterygium</option>
                      <option value='DBT' <?= $r->jenis_kasus == 'DBT' ? 'selected':''; ?>>Diabetik Retinopatik</option>
                      <?php
                      //if ($anggota->gender == 'L') echo "<option value='L' selected>L</option><option value='P'>P</option>";
                      //else echo "<option value='L'>L</option><option value='P' selected>P</option>";
                      ?>
                    </select>
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
                    <a href="<?=site_url('kegiatan/DetailScreening/'.$r->id_screening);?>" class="btn btn-danger alert_cancel">Batal</a>
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