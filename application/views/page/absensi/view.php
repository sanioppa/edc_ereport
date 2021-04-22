<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-tachometer" aria-hidden="true"></i> List Absensi Pegawai
      <a href="absensi/post" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Absensi Manual</a>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <!-- ./col -->

      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <div class="col-sm-12">
              <table>
                <form action="<?= site_url('absensi/index') ?>" class="" method="get">
                  <tr colspan="5">
                    <td>
                      <b>Filter</b>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="date" id="tgl_awal" class="form-control col-sm-2" name="tgl_awal" placeholder="Tanggal Awal" autocomplete="off">
                    </td>
                    <td>&nbsp &nbsp</td>
                    <td>
                      <input type="date" id="tgl_akhir" class="form-control col-sm-2" name="tgl_akhir" placeholder="Tanggal Akhir" autocomplete="off">
                    </td>
                    <td>&nbsp &nbsp</td>
                    <td>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button> Tombol Gak Guna
                    </td>
                  </tr>
                </form>
              </table>

            </div>
          </div>
          <div class="box-body">
            <?php
            $berhasil = $this->session->flashdata('berhasil');

            if (!empty($berhasil)) { ?>

              <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= $this->session->flashdata('berhasil'); ?>
              </div>

            <?php }

            ?>
            <div class="box-body col-sm-12">
              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th width="30px">NO</th>
                    <th>TANGGAL</th>
                    <th>NAMA</th>
                    <th>JAM DATANG</th>
                    <th>JAM PULANG</th>
                    <th>LAMA KERJA</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record as $r) : ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= tgl_indo($r->tanggal_kerja); ?></td>
                      <td><?= $r->name; ?></td>
                      <td><?= $r->jam_datang; ?></td>
                      <td><?= $r->jam_pulang; ?></td>
                      <?php //Menghitung Lama Waktu Kerja
                      $awal  = strtotime($r->jam_datang); //waktu awal
                      $akhir = strtotime($r->jam_pulang); //waktu akhir
                      $diff  = $akhir - $awal;
                      $jam   = floor($diff / (60 * 60));
                      $menit = $diff - $jam * (60 * 60);
                      ?>
                      <td><?= $jam .  ' jam, ' . floor($menit / 60) . ' menit'; ?></td>
                      <!--
                    <td>
                      <center>
                      <a href="<?= site_url('absensi/edit/' . $r->roleId); ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="<?= site_url('asbensi/hapus/' . $r->roleId); ?>" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>
                      </center>
                    </td>
                    -->
                    </tr>
                  <?php
                    $no++;
                  endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>