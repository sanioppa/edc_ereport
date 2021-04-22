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
              <h3 class="box-title"><b>RIWAYAT CUTI</b></h3>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="50">NO</th>
                  <th width="90px">JENIS CUTI</th>
                  <th width="150px">PERIHAL</th>
                  <th width="90px">TANGGAL</th>
                  <th width="200px">ALASAN</th>
                  <th width="90px">STATUS</th>
                  <th width="100px">ACTION</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach($record as $r) : ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= strtoupper($r->jenis_cuti) ?></td>
                  <td><?= $r->nama_ajuan ?></td>
                  <td><?= date('d-m-Y',strtotime($r->tgl_awal)) ?> s/d <?= date('d-m-Y',strtotime($r->tgl_akhir)) ?></td>
                  <td><?= $r->keterangan ?></td>
                  <td><?php
                        if ($r->status_ajuan == 1 ){
                          echo "<span class='label label-info'>Belum Disetujui</span>";
                        } elseif ($r->status_ajuan == 2 ){
                          echo "<span class='label label-success'>Disetujui</span>";
                        } else {
                          echo "<span class='label label-danger'>Ditolak</span>";
                        }
                      ?>
                  </td>
                  <td>
                    <center>
                    <?php
                        if ($r->status_ajuan == 1 ){
                    ?>
                            <a href='<?=site_url("ajuancuti/edit/".$r->id_ajuan_cuti);?>' class='btn btn-success btn-xs' title='Edit'><i class='fa fa-edit'></i></a>
                            <button class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modalhapus'><i class='fa fa-trash'></i></button>
                            <a href='<?=site_url("ajuancuti/lihatpdf/".$r->id_ajuan_cuti);?>' class='btn btn-primary btn-xs' disabled target='_blank' title='Lihat'><i class='fa fa-eye'></i></a>
                    <?php
                        } else {
                    ?>
                            <a href='<?=site_url("ajuancuti/edit/".$r->id_ajuan_cuti);?>' class='btn btn-success btn-xs' disabled title='Edit'><i class='fa fa-edit'></i></a>
                            <button class='btn btn-xs btn-danger' data-toggle='modal' disabled data-target='#modalhapus'><i class='fa fa-trash'></i></button>
                            <a href='<?=site_url("ajuancuti/lihatpdf/".$r->id_ajuan_cuti);?>' class='btn btn-primary btn-xs' target='_blank' title='Lihat'><i class='fa fa-eye'></i></a>
                    <?php
                        }
                    ?>
                    </center>
                  </td>
                </tr>
                  <?php 
                  $no++;
                  endforeach;?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>

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
                  <a href="<?=site_url('ajuancuti/hapus/'.$r->id_ajuan_cuti);?>" class="btn btn-primary" ><i class="fa fa-check"></i>Yes</a>
                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Tidak</button>
                </div>
              </div>
            </div>
          </div>
    </section>
</div>