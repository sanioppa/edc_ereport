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
              <h3 class="box-title"><b>DATA OUTLET KLINIK MATA EDC GROUP</b></h3>
              </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>ID</th>
                  <th>NAMA USER</th>
                  <th>USERNAME</th>
                  <th>PASSWORD</th>
                  <th>ROLE</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach($record as $r) : ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $r->userId; ?></td>
                  <td><?= $r->name; ?></td>
                  <td><?= $r->username; ?></td>
                  <td><?= $r->realpassword; ?></td>
                  <td><?= $r->roleId; ?></td>
                  <td>
                    <center>
                    <a href="#" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-eye"></i></a>
                    <a href="<?= site_url('listuser/edituser/'.$r->userId) ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>
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