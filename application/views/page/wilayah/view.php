<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
        &nbsp &nbsp
        <a href="bidang/post" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah</a>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
           <!-- ./col -->
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
              <h3 class="box-title"><b>FILTER WILAYAH</b></h3>
              </div>
            <div class="box-body">
              <form method="POST" action="<?=site_url('bidang/post2');?>" class="form-horizontal">
                
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 control-label">PROVINSI</label>
                  <div class="col-sm-10">
                    <select name="kode_klasifikasi" class="form-control" required>
                      <option value="Pilih Atasan" disabled selected>- Provinsi -</option>
                      <option value='INTERNAL'>INTERNAL</option>
                      <option value='EKSTERNAL'>EKSTERNAL</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 control-label">KABUPATEN/KOTA</label>
                  <div class="col-sm-10">
                    <select name="kode_klasifikasi" class="form-control" required>
                      <option value="Pilih Atasan" disabled selected>- Kabupaten/Kota -</option>
                      <option value='INTERNAL'>INTERNAL</option>
                      <option value='EKSTERNAL'>EKSTERNAL</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 control-label">KECAMATAN</label>
                  <div class="col-sm-10">
                    <select name="kode_klasifikasi" class="form-control" required>
                      <option value="Pilih Atasan" disabled selected>- Kecamatan -</option>
                      <option value='INTERNAL'>INTERNAL</option>
                      <option value='EKSTERNAL'>EKSTERNAL</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 control-label">DESA</label>
                  <div class="col-sm-10">
                    <select name="kode_klasifikasi" class="form-control" required>
                      <option value="Pilih Atasan" disabled selected>- Desa -</option>
                      <option value='INTERNAL'>INTERNAL</option>
                      <option value='EKSTERNAL'>EKSTERNAL</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            </div>
          </div>
        </div>
    </section>
</div>