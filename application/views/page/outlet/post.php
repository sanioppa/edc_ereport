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
              <form method="POST" action="<?=site_url('outlet/post2');?>" class="form-horizontal">
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kode Outlet</label>
                  <div class="col-sm-10">
                    <input type="text" name="id_perusahaan" placeholder="Kode Perusahaan" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Outlet</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_perusahaan" placeholder="Nama Outlet" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" name="alamat_perusahaan" placeholder="Alamat" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kode Pos</label>
                  <div class="col-sm-10">
                    <input type="text" name="kode_pos" placeholder="Kode Pos" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">No. Telepon</label>
                  <div class="col-sm-10">
                    <input type="text" name="no_telpon" placeholder="Nomor Telepon" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">E-Mail</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" placeholder="Email" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kota</label>
                  <div class="col-sm-10">
                    <input type="text" name="kota" placeholder="Kota" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Token BPJS</label>
                  <div class="col-sm-10">
                    <input type="text" name="token_bpjs" placeholder="Token BPJS" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 control-label">Secret Key</label>
                  <div class="col-sm-10">
                    <input type="text" name="secretkey" placeholder="Kunci Rahasia" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Tambahkan</button>
                    <a href="<?= site_url('outlet'); ?>" class="btn btn-danger">Batal</a>
                  </div>
                </div>
              </form>
            </div>
            </div>
          </div>
        </div>
    </section>
</div>