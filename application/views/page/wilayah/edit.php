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
              <h3 class="box-title"><b>EDIT DATA BIDANG KERJA KLINIK MATA EDC GROUP</b></h3>
              </div>
            <div class="box-body">
              <form method="POST" action="<?=site_url('bidang/update');?>" class="form-horizontal">
                <?php foreach ($record as $r) : ?>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kode Outlet</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->id_bidang_kerja; ?>" name="id_bidang_kerja" placeholder="Kode Bidang Kerja" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Bidang</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->nama_bidang; ?>" name="nama_bidang" placeholder="Nama Bidang" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?= $r->keterangan; ?>" name="keterangan" placeholder="Keterangan" class="form-control">
                  </div>
                </div>

                <div class="form-group row" style="text-align: right;">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Perbarui</button>
                    <a href="<?= site_url('bidang'); ?>" class="btn btn-danger">Batal</a>
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