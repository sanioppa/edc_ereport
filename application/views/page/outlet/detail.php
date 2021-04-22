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
              <h3 class="box-title"><b>DETAIL</b></h3>
              </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <tbody>
                  <?php 
                  $no=1;
                  foreach($record as $r) : ?>
                <tr>
                  <td width="200px"><b>KODE OUTLET</b></td>
                  <td><?= $r->id_perusahaan; ?></td>
                </tr>
                <tr>
                  <td><b>NAMA OUTLET</b></td>
                  <td><?= $r->nama_perusahaan; ?></td>
                </tr>
                <tr>
                  <td><b>ALAMAT</b></td>
                  <td><?= $r->alamat_perusahaan; ?></td>
                </tr>
                <tr>
                  <td><b>KODE POS</b></td>
                  <td><?= $r->kode_pos; ?></td>
                </tr>
                <tr>
                  <td><b>NO. TELEPON</b></td>
                  <td><?= $r->no_telpon; ?></td>
                </tr>
                <tr>
                  <td><b>E-MAIL</b></td>
                  <td><?= $r->email; ?></td>
                </tr>
                <tr>
                  <td><b>KOTA</b></td>
                  <td><?= $r->kota; ?></td>
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