<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
        &nbsp &nbsp
        <a href="outlet/post" class="btn btn-info"><i class="fa fa-plus"></i> Tambah</a>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
           <!-- ./col -->
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
              <h3 class="box-title"><b>DATA OUTLET KLINIK MATA EDC GROUP</b></h3>
              </div>
            <div class="box-body table-responsive">
              <?php 
              $berhasil = $this->session->flashdata('berhasil');

              if(!empty($berhasil))
              { ?>

              <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= $this->session->flashdata('berhasil'); ?>
              </div>

              <?php }

              ?>
              <table id="" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>ID</th>
                  <th>NAMA OUTLET</th>
                  <th>KOTA / KABUPATEN</th>
                  <th>NO. TELPON</th>
                  <th>EMAIL</th>
                  <th width="120px">ACTION</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach($record as $r) : ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $r->id_perusahaan; ?></td>
                  <td><?= $r->nama_perusahaan; ?></td>
                  <td><?= $r->kota ?></td>
                  <td><?= $r->no_telpon; ?></td>
                  <td><?= $r->email; ?></td>
                  <td>
                    <center>
                    <a href="<?=site_url('outlet/detail/'.$r->id_perusahaan);?>" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-eye"></i></a>
                    <a href="<?=site_url('outlet/edit/'.$r->id_perusahaan);?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="<?=site_url('outlet/hapus/'.$r->id_perusahaan);?>" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>
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
    </section>
</div>