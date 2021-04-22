<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-envelope" aria-hidden="true"></i> Daftar Kegiatan
        <small>e-Syst</small>
        &nbsp &nbsp
        <a href="kegiatan/post" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Kegiatan</a>
      </h1>
    </section>

    <style type="text/css">
    .dropdown-menu {
      right: 0;
    }
    </style>
    
    <section class="content">
        <div class="row">
           <!-- ./col -->
          <div class="col-xs-12">
            <div class="box box-danger">
              <div class="box-header">
              <h3 class="box-title"><b><?= $title ?></b></h3>
              </div>
                  
            <div class="box-body table-responsive">
              <?php 
              $berhasil = $this->session->flashdata('berhasil');

              if(!empty($berhasil))
              { ?>

              <!--
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= $this->session->flashdata('berhasil'); ?>
              </div>
              -->

              <?php }

              ?>
              <table class="table">
                    <thead>
                      <tr>
                        <th colspan="3"><h4><b>Filter</b></h4></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <!--
                        <td class="col-sm-4 row">
                          <label class="control-label col-sm-4">Kantor/Outlet</label>
                          <select class="form-control" name="kode_perusahaan" id="kode_perusahaan">
                            <option value="ALL">-- Semua Outlet --</option>
                            <?php
                            if(!empty($outlet))
                            {
                              foreach ($outlet as $p)
                              {
                            ?>
                            <option value="<?php echo $p->id_perusahaan ?>"><?php echo $p->nama_perusahaan ?></option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </td>
                        -->
                        <td class="col-sm-4">
                          <label class="control-label">Tahun</label>
                          <select class="form-control col-sm-4" name="tahun" id="tahun">
                            <option value="0">-- Semua --</option>
                            <?php
                            $thn_skr = date('Y');
                            for ($x = $thn_skr; $x >= 2019; $x--) {
                            ?>
                                <option value="<?php echo $x ?>" <?= $x == date('Y')?'selected':''; ?>><?php echo $x ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </td>

                        <td class="col-sm-4">
                          <label class="control-label">Bulan</label>
                          <select class="form-control col-sm-4" name="bulan" id="bulan">
                            <option value="0">-- Semua --</option>
                            <option value="01" <?= date('m') == '01'?'selected':''; ?>>Januari</option>
                            <option value="02" <?= date('m') == '02'?'selected':''; ?>>Februari</option>
                            <option value="03" <?= date('m') == '03'?'selected':''; ?>>Maret</option>
                            <option value="04" <?= date('m') == '04'?'selected':''; ?>>April</option>
                            <option value="05" <?= date('m') == '05'?'selected':''; ?>>Mei</option>
                            <option value="06" <?= date('m') == '06'?'selected':''; ?>>Juni</option>
                            <option value="07" <?= date('m') == '07'?'selected':''; ?>>Juli</option>
                            <option value="08" <?= date('m') == '08'?'selected':''; ?>>Agustus</option>
                            <option value="09" <?= date('m') == '09'?'selected':''; ?>>September</option>
                            <option value="10" <?= date('m') == '10'?'selected':''; ?>>Oktober</option>
                            <option value="11" <?= date('m') == '11'?'selected':''; ?>>November</option>
                            <option value="12" <?= date('m') == '12'?'selected':''; ?>>Desember</option>
                          </select>
                        </td>

                        <td class="col-sm-4">
                          <label class="control-label">Klasifikasi</label>
                          <select class="form-control col-sm-4" name="id_klasifikasi" id="id_klasifikasi">
                            <option value="ALL">-- Semua --</option>
                            <?php
                            if(!empty($klasifikasi))
                            {
                              foreach ($klasifikasi as $r)
                              {
                            ?>
                            <option value="<?php echo $r->id_klasifikasi ?>"><?php echo $r->id_klasifikasi ?> | <?php echo $r->subnama_klasifikasi ?></option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              <table id="kegiatan" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>KLASIFIKASI</th>
                  <th>TANGGAL</th>
                  <th>NAMA KEGIATAN</th>
                  <th>NAMA INSTANSI</th>
                  <th>NAMA PERSON</th>
                  <th width="150px">ALAMAT</th>
                  <th>NO. TELP</th>
                  <th>TES</th>
                  <th>KET.</th>
                  <th width="100px">AKSI</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
              <br>
              <br>
              <br>
              <br>
              <br>
              
              <!--

              <h4>Cara Membuat Grafik dengan CodeIgniter dengan Chart.js</h4>
              <div  style="width: 500px;height: 500px">
                <canvas id="myChart"></canvas>
              </div>
                  <?php
                  //Inisialisasi nilai variabel awal
                  $namakasus= "";
                  $jumlah=null;
                  foreach ($hasil as $item)
                  {
                      $jenis=$item->jenis_kasus;
                      $namakasus .= "'$jenis'". ", ";
                      $iddk=$item->id_daftar_kasus;
                      //$idsc=$item->id_screening;
                      $jumlah .= "$iddk". ", ";
                  }
                  ?>
              <script>
                  var ctx = document.getElementById('myChart').getContext('2d');
                  var chart = new Chart(ctx, {
                      // The type of chart we want to create
                      type: 'bar',
                      // The data for our dataset
                      data: {
                          labels: [<?php echo $namakasus; ?>],
                          datasets: [{
                              label:'Data Kegiatan ',
                              data: [<?php echo $jumlah; ?>],
                              backgroundColor: [
                                'rgb(255, 99, 132)', 
                                'rgba(56, 86, 255, 0.87)', 
                                'rgb(60, 179, 113)',
                                'rgb(175, 238, 239)'
                              ],
                              borderColor: [
                                'rgb(255, 99, 132)'
                              ]
                          }]
                      },
                      // Configuration options go here
                      options: {
                          scales: {
                              yAxes: [{
                                  ticks: {
                                      beginAtZero:true
                                  }
                              }]
                          }
                      }
                  });
              </script>
              
              

              <h2>Tutorial Membuat Grafik Dengan Chart.js - www.malasngoding.com</h2>



              <div style="width: 500px;height: 500px">
                <canvas id="myChartB"></canvas>
              </div>


              <a href="https://www.malasngoding.com/membuat-grafik-dengan-chart-js/">BACA TUTORIAL NYA di www.malasngoding.com</a>

              <script>
                var ctx = document.getElementById("myChartB").getContext('2d');
                var myChartB = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [{
                      label: '# of Votes',
                      data: [12, 19, 3, 23, 2, 3],
                      backgroundColor: [
                      'rgba(255, 99, 132, 1)', //Red, Green, Blue, Transparency
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 0.2)'
                      ],
                      borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero:true
                        }
                      }]
                    }
                  }
                });
              </script>
              -->

              <!--
              <div class="box-header">
                <h3 class="box-title"><b>Rekap Kegiatan Humas</b></h3>
              </div>
              <table id="kegiatan" class="table table-bordered table-striped table-hover">
                <thead align="center">
                <tr>
                  <th colspan="3" style="text-align: center;">1</th>
                  <th colspan="3" style="text-align: center;">2</th>
                  <th colspan="3" style="text-align: center;">3</th>
                  <th colspan="3" style="text-align: center;">4</th>
                  <th colspan="3" style="text-align: center;">5</th>
                </tr>
                <tr>
                  <th style="text-align: center;">A</th>
                  <th style="text-align: center;">B</th>
                  <th style="text-align: center;">C</th>
                  <th style="text-align: center;">A</th>
                  <th style="text-align: center;">B</th>
                  <th style="text-align: center;">C</th>
                  <th style="text-align: center;">A</th>
                  <th style="text-align: center;">B</th>
                  <th style="text-align: center;">C</th>
                  <th style="text-align: center;">A</th>
                  <th style="text-align: center;">B</th>
                  <th style="text-align: center;">C</th>
                  <th style="text-align: center;">A</th>
                  <th style="text-align: center;">B</th>
                  <th style="text-align: center;">C</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
              -->
            </div>
            </div>
          </div>
        </div>
    </section>

    <section class="content-header">
          <td class="col-sm-4">
            <label class="control-label">Bulan</label>
            <select class="form-control col-sm-4" name="bulan" id="bulann">
              <option value="0">-- Semua --</option>
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">Juli</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </td>
    </section>

    <br>
    <br>

    <!----------- BATAS GRAFIK KEGITAN -->

    <section class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title"><b>BRANDING</b></h3>
                <h2>Grafik Kegiatan Branding</h2>
                <div class="chart">
                  <canvas id="myChart1" style="height: 250px"></canvas>
                </div>
                  <?php
                  //Inisialisasi Nama Klasifikasi dan Jumlah Kegiatan BRANDING
                  $nama_brand= "";
                  $subnama_brand= "";
                  $jumlah_brand=null;
                  foreach ($branding as $brand)
                  {
                      $sub_brand=$brand->subnama_klasifikasi;
                      $subnama_brand .= "'$sub_brand'". ", ";
                      $klasifikasiBranding=$brand->nama_klasifikasi;
                      $nama_brand .= "$klasifikasiBranding". ", ";
                  }
                  ?>
                <script>
                  var ctx = document.getElementById("myChart1").getContext('2d');
                  var myChart1 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: [<?php echo $subnama_brand; ?>],
                      datasets: [{
                        label: 'Kegiatan ',
                        data: [12, 19, 3, 23, 2, 3],
                        backgroundColor: [
                        'rgba(255, 99, 132, 1)', //Red, Green, Blue, Transparency
                        'rgba(145, 0, 44, 1)',
                        'rgba(242, 27, 72, 1)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(145, 0, 44, 1)',
                        'rgba(242, 27, 72, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero:true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><b>NETWORKING</b></h3>
                <h2>Grafik Kegiatan Networking</h2>
                <div class="chart">
                  <canvas id="myChart2" style="height: 250px""></canvas>
                </div>
                  <?php
                  //Inisialisasi Nama Klasifikasi dan Jumlah Kegiatan NETWORKING
                  $nama_net = "";
                  $subnama_net = "";
                  $jumlah_net=null;
                  foreach ($networking as $net)
                  {
                      $sub_net=$net->subnama_klasifikasi;
                      $subnama_net .= "'$sub_net'". ", ";
                      $klasifikasiNetworking=$net->nama_klasifikasi;
                      $nama_net .= "$klasifikasiNetworking". ", ";
                  }
                  ?>
                <script>
                  var ctx = document.getElementById("myChart2").getContext('2d');
                  var myChart2 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: [<?php echo $subnama_net; ?>],
                      datasets: [{
                        label: 'Kegiatan ',
                        data: [12, 19, 3, 10, 2, 3],
                        backgroundColor: [
                        'rgba(54, 162, 235, 1)', //Red, Green, Blue, Transparency
                        'rgba(0, 42, 148, 1)',
                        'rgba(54, 105, 235, 1)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(0, 42, 148, 1)',
                        'rgba(54, 105, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero:true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><b>DIRECT SELLING</b></h3>
                <h2>Grafik Kegiatan Direct Selling</h2>
                <div class="chart">
                  <canvas id="myChart3" style="height: 250px""></canvas>
                </div>
                  <?php
                  //Inisialisasi Nama Klasifikasi dan Jumlah Kegiatan DIRECT SELLING
                  $nama_dirsell = "";
                  $subnama_dirsell = "";
                  $jumlah_dirsell=null;
                  foreach ($directSelling as $dirsell)
                  {
                      $sub_dirsell=$dirsell->subnama_klasifikasi;
                      $subnama_dirsell .= "'$sub_dirsell'". ", ";
                      $klasifikasiDirectSelling=$net->nama_klasifikasi;
                      $nama_dirsell .= "$klasifikasiDirectSelling". ", ";
                  }
                  ?>
                <script>
                  var ctx = document.getElementById("myChart3").getContext('2d');
                  var myChart3 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: [<?php echo $subnama_dirsell; ?>],
                      datasets: [{
                        label: 'Kegiatan ',
                        data: [12, 19, 3, 23, 2, 3],
                        backgroundColor: [
                        'rgba(84, 232, 143, 1)', //Red, Green, Blue, Transparency
                        'rgba(16, 122, 58, 1)',
                        'rgba(15, 191, 85, 1)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                        'rgba(84, 232, 143,1)',
                        'rgba(16, 122, 58, 1)',
                        'rgba(15, 191, 85, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero:true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>
        
          <div class="col-md-6">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title"><b>DIGITAL MARKETING</b></h3>
                <h2>Grafik Kegiatan Digital Marketing</h2>
                <div class="chart">
                  <canvas id="myChart4" style="height: 250px""></canvas>
                </div>
                  <?php
                  //Inisialisasi Nama Klasifikasi dan Jumlah Kegiatan DIGITAL MARKETING
                  $nama_digmar = "";
                  $subnama_digmar = "";
                  $jumlah_digmar=null;
                  foreach ($digitalMarketing as $digmar)
                  {
                      $sub_digmar=$digmar->subnama_klasifikasi;
                      $subnama_digmar .= "'$sub_digmar'". ", ";
                      $klasifikasiDigitalMarketing=$digmar->nama_klasifikasi;
                      $nama_digmar .= "$klasifikasiDigitalMarketing". ", ";
                  }
                  ?>
                <script>
                  var ctx = document.getElementById("myChart4").getContext('2d');
                  var myChart4 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: [<?php echo $subnama_digmar; ?>],
                      datasets: [{
                        label: 'Kegiatan ',
                        data: [12, 19, 3, 23, 2, 3],
                        backgroundColor: [
                        'rgba(68, 198, 227, 1)', //Red, Green, Blue, Transparency
                        'rgba(0, 156, 191, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                        'rgba(68, 198, 227,1)',
                        'rgba(0, 156, 191, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero:true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="box box-warning">
              <div class="box-header">
                <h3 class="box-title"><b>SOSIAL MARKETING</b></h3>
                <h2>Grafik Kegiatan Sosial Marketing</h2>
                <div class="chart">
                  <canvas id="myChart5" style="height: 250px""></canvas>
                </div>
                  <?php
                  //Inisialisasi Nama Klasifikasi dan Jumlah Kegiatan SOSIAL MARKETING
                  $nama_sosmar = "";
                  $subnama_sosmar = "";
                  $jumlah_sosmar=null;
                  foreach ($sosialMarketing as $sosmar)
                  {
                      $sub_sosmar=$sosmar->subnama_klasifikasi;
                      $subnama_sosmar .= "'$sub_sosmar'". ", ";
                      $klasifikasiSosialMarketing=$sosmar->nama_klasifikasi;
                      $nama_sosmar .= "$klasifikasiSosialMarketing". ", ";
                  }
                  ?>
                <script>
                  var ctx = document.getElementById("myChart5").getContext('2d');
                  var myChart5 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: [<?php echo $subnama_sosmar; ?>],
                      datasets: [{
                        label: 'Kegiatan ',
                        data: [12, 19, 3, 23, 2, 3],
                        backgroundColor: [
                        'rgba(255, 206, 86, 1)', //Red, Green, Blue, Transparency
                        'rgba(161, 127, 16, 1)',
                        'rgba(242, 179, 24, 1)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(161, 127, 16, 1)',
                        'rgba(242, 179, 24, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero:true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><b>SEMUA KEGIATAN</b></h3>
                <h2>Grafik Semua Kegiatan</h2>
                <div class="chart">
                  <canvas id="myChart6" style="height: 250px""></canvas>
                </div>
                  <?php
                  //Inisialisasi Nama Klasifikasi dan Jumlah Kegiatan SEMUA KEGIATAN
                  $id_klasifikasi = "";
                  $nama_klasifikasi = "";
                  $subnama_klasifikasi = "";
                  $jumlah_klasifikasi=null;
                  foreach ($allKlasifikasi as $all)
                  {
                      $id_klas=$all->id_klasifikasi;
                      $id_klasifikasi .= "'$id_klas'". ", ";  
                      $sub_klasifikasi=$all->subnama_klasifikasi;
                      $subnama_klasifikasi .= "'$sub_klasifikasi'". ", ";
                      $klasifikasiAllKlasifikasi=$all->nama_klasifikasi;
                      $nama_klasifikasi .= "$klasifikasiAllKlasifikasi". ", ";
                  }
                  ?>
                <script>
                  var ctx = document.getElementById("myChart6").getContext('2d');
                  var myChart6 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: [<?php echo $id_klasifikasi; ?>],
                      datasets: [{
                        label: 'Kegiatan ',
                        data: [12, 19, 3, 23, 2, 3, 12, 19, 3, 23, 2, 3, 7, 4],
                        backgroundColor: [
                        'rgba(255,99,132,1)', //BR1
                        'rgba(145, 0, 44, 1)', //BR2
                        'rgba(242, 27, 72, 1)', //BR3
                        'rgba(54, 162, 235, 1)', //NW1
                        'rgba(0, 42, 148, 1)', //NW2
                        'rgba(54, 105, 235, 1)', //NW3
                        'rgba(84, 232, 143,1)', //DS1
                        'rgba(16, 122, 58, 1)', //DS2
                        'rgba(15, 191, 85, 1)', //DS3
                        'rgba(68, 198, 227,1)', //DM1
                        'rgba(0, 156, 191, 1)', //DM2
                        'rgba(255, 206, 86, 1)', //SM1
                        'rgba(161, 127, 16, 1)', //SM2
                        'rgba(242, 179, 24, 1)' //SM3
                        ],
                        borderColor: [
                        'rgba(255,99,132,1)', //BR1
                        'rgba(145, 0, 44, 1)', //BR2
                        'rgba(242, 27, 72, 1)', //BR3
                        'rgba(54, 162, 235, 1)', //NW1
                        'rgba(0, 42, 148, 1)', //NW2
                        'rgba(54, 105, 235, 1)', //NW3
                        'rgba(84, 232, 143,1)', //DS1
                        'rgba(16, 122, 58, 1)', //DS2
                        'rgba(15, 191, 85, 1)', //DS3
                        'rgba(68, 198, 227,1)', //DM1
                        'rgba(0, 156, 191, 1)', //DM2
                        'rgba(255, 206, 86, 1)', //SM1
                        'rgba(161, 127, 16, 1)', //SM2
                        'rgba(242, 179, 24, 1)' //SM3
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero:true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>
        </div>

        <!----------- BATAS AKHIR GRAFIK KEGITAN -->

        <h6><b>NB : </b>Mohon maaf bila tampilan untuk Smartphone belum maksimal</h6>
        
    </section>
    
</div>

<script src="assets/dist/ajax/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    kegiatan();
    $("#tahun").change(function(){
      kegiatan();
    });
  });
  $(document).ready(function() {
    kegiatan();
    $("#bulan").change(function(){
      kegiatan();
    });
  });
  $(document).ready(function() {
    kegiatan();
    $("#id_klasifikasi").change(function(){
      kegiatan();
    });
  });

  function kegiatan() {
    //var tgl_awal = $("#tgl_awal").val();
    //var tgl_akhir = $("#tgl_akhir").val();
    var tahun = $("#tahun").val();
    var bulan = $("#bulan").val();
    var id_klasifikasi = $("#id_klasifikasi").val();
    $.ajax({
      url : "<?= base_url('kegiatan/load_kegiatan') ?>",
      data: "&tahun=" + tahun + "&bulan=" + bulan + "&id_klasifikasi=" + id_klasifikasi,
      success:function(data) {
        $("#kegiatan tbody").html(data);
      }
    });
  }
</script>

<script type='text/javascript'>
  $(document).ready(function(){

  // Detect pagination click
  $('#pagination').on('click','a',function(e){
    e.preventDefault(); 
    var pageno = $(this).attr('data-ci-pagination-page');
    loadPagination(pageno);
  });

  loadPagination(0);

  // Load pagination
  function loadPagination(pagno){
    $.ajax({
      url: '<?=base_url()?>inbox/loadRecord/'+pagno,
      type: 'get',
      dataType: 'json',
      success: function(response){
        $('#pagination').html(response.pagination);
        "<td>" + createTable(response.result,response.row) + "</td>";
      }
    });
  }

  // Create table list
  function createTable(result,sno){
    sno = Number(sno);
    $('#postsList tbody').empty();
    for(index in result){
      var id_inbox = result[index].id_inbox;
      var tgl_terima = result[index].tgl_terima;
      var isi = result[index].isi;
      //content = content.substr(0, 60) + " ...";
      var link = result[index].link;
      sno+=1;

      var tr = "<tr>";
      tr += "<td>"+ sno +"</td>";
      tr += "<td>"+ tgl_terima +"</a></td>";
      tr += "<td>"+ isi +"</td>";
      tr += "</tr>";
      $('#postsList tbody').append(tr);

      }
    }
  });
</script>

<script src="<?php echo base_url('assets/dist/js/app.min.js');?>"></script>
<script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>
<!-- FLOT CHARTS -->
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.min.js');?>"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.resize.min.js');?>"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.pie.min.js');?>"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.categories.min.js');?>"></script>