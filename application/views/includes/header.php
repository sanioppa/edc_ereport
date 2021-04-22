<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="assets/images/logo_edc.png" rel="shortcut icon">

    <!-- <?php $titpage= TITLEPAGE; //FOR TITLE OF PAGE?> -->
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />   

    <!-- CHART JS --> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.js"></script>

    <!-- Sweet Alert -->
    <link href="assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="assets/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="assets/sweetalert/sweetalert.js"></script>
    <!-- Sweet Alert 2 -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script type="text/javascript" src="assets/sweetalert2/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="assets/sweetalert2/sweetalert2.min.js"></script>
    <script type="text/javascript" src="assets/sweetalert2/sweetalert2.js"></script>
    <script type="text/javascript" src="assets/sweetalert2/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.css" type="text/css" />
    -->
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 5.15.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome5/css/fontawesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/font-awesome5/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/font-awesome5/css/solid.min.css" rel="stylesheet" type="text/css" />
    <!-- Data Tables -->
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables_themeroller.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap.min.css"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Date Picker -->
    <link href="assets/pluginsbootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="assets/pluginsbootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>

    <!-- MORRIS CHART -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">

    <!-- JQuery UI nya Disini -->
    <script type="text/javascript" src="assets/jqueryku/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/jqueryku/jquery-ui.css">
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
    </style>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- <body class="sidebar-mini skin-black-light"> -->
  <body class="skin-blue sidebar-mini">

    <script type="text/javascript">
      $(document).ready(function(){
        $('.input-tanggal').datepicker();   
      });
    </script>
    <script type="text/javascript">
      $(function()
      {
        $('#tanggal').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy-mm-dd'}),
        $('#tgl_awal').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy-mm-dd'}),
        $('#tgl_akhir').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy-mm-dd'})
      });
    </script>

    <script>
    $(function() {
      $('#only-number').on('keydown', '#number', function(e){
          -1!==$
          .inArray(e.keyCode,[46,8,9,27,13,110,190]) || /65|67|86|88/
          .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey)
          || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey|| 48 > e.keyCode || 57 < e.keyCode)
          && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
      });
    })
    </script>



    <?php
    $now = date('d/m/Y');
    ?>

    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SIAS</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="text-align: left;">
            <img src="<?php echo $logo; ?>" height="30px" width="30px">
            <!-- <img src="assets/images/logo_edc.png" height="30px" width="30px"> -->
            E-Report<b> EDC</b>
          </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/dist/fotouser/<?= $this->session->userdata('foto'); ?>" class="user-image" alt="User Image"/>
                  <!-- <span class="hidden-xs"><?php echo $level; ?> | <?php echo $name; ?></span> -->
                  <span class="hidden-xs"><?= $this->session->userdata('name'); ?> | <?= ucfirst( $this->session->userdata('level')=='Admin'?'Super Admin':'Humas Outlet' ); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url(); ?>assets/dist/fotouser/<?= $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo ucfirst($level); ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Ubah Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat alert_logout"><i class="fa fa-sign-out"></i> Log Out</a>
                      <script>
                          jQuery(document).ready(function($){
                              $('.alert_logout').on('click',function(){
                              var getLink = $(this).attr('href');
                                  swal({
                                  title: 'Konfirmasi',
                                  text: 'Anda yakin Logout?',
                                  html: true,
                                  //confirmButtonColor: '#d9534f',
                                  confirmButtonClass: "btn-danger",
                                  showCancelButton: true,
                                  confirmButtonText: "Logout",
                                  cancelButtonText: "Batal",
                                  closeOnConfirm: false,
                                  closeOnCancel: true
                                  },
                                  function(){
                                  window.location.href = getLink
                                  //swal("Sukses!", "Berhasil Logout", "success");
                                  });
                                  return false;
                              });
                          }); 
                      </script>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/dist/fotouser/<?= $this->session->userdata('foto'); ?>" class="img-circle" style="max-height: 45px; max-width: 45px" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('name'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo ucfirst($level); ?></a> <br>
        </div>
      </div>
      <!-- search form -->

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"><?php echo $outlet; ?></li>
            
            <?php
            if($level == HAK_ADMIN) //ADMIN
            {
            ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-archive"></i>
                <span>MASTER DATA</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
                <ul class="treeview-menu">
                  <li><a href="<?=site_url('userListing');?>"><i class="fa fa-users"></i> List User</a></li>
                  <li><a href="<?=site_url('outlet');?>"><i class="fa fa-bank"></i> Outlet</a></li>
                  <li><a href="<?=site_url('pegawai');?>"><i class="fa fa-gears"></i> Daftar Upaya</a></li>
                  <li><a href="<?=site_url('jabatan');?>"><i class="fa fa-eye"></i> Kasus</a></li>
                  <li><a href="<?=site_url('wilayah');?>"><i class="fa fa-filter"></i> Form Filter Wilayah</a></li>
                </ul>
            </li>
            <?php
            }
            if($level == HAK_ADMIN || $level == HAK_USER1 || $level == HAK_USER2 || $level == HAK_USER3)
            {
            ?>
            <li class="treeview">
              <a href="<?=site_url('kegiatan');?>">
                <i class="fa fa-book"></i>
                <span>Daftar Kegiatan</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=site_url('#');?>" >
                <i class="fa fa-bar-chart"></i>
                <span>Grafik Kegiatan Humas</span>
              </a>
            </li>
            <!--
            <li class="treeview">
              <a href="<?=site_url('ekspedisi');?>" >
                <i class="fa fa-files-o"></i>
                <span>Menu 3</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=site_url('laporanpdf');?>" target='_blank'>
                <i class="fa fa-print"></i>
                <span>PDF</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=site_url('laporanpdf');?>" >
                <i class="fa fa-print"></i>
                <span>EXCEL</span>
              </a>
            </li>
            -->
            <?php
            }
            if($this->session->userdata('userId') > 3) //PEGAWAI
            {
            ?>
            <li class="treeview">
              <a href="<?=site_url('pegawai/profil/'.$this->session->userdata('userId'));?>">
                <i class="fa fa-user"></i>
                <span>Profil</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=site_url('ajuancuti/post');?>" >
                <i class="fa fa-share"></i>
                <span>Ajukan Cuti</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=site_url('ajuancuti/historypegawai');?>" >
                <i class="fa fa-clock-o"></i>
                <span>Riwayat Ajuan Cuti</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=site_url('#');?>" >
                <i class="fa fa-retweet"></i>
                <span>Riwayat Mutasi</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=site_url('#');?>" >
                <i class="glyphicon glyphicon-info-sign"></i>
                <span>Informasi Jabatan</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=site_url('#');?>" >
                <i class="fa fa-file"></i>
                <span>Adendum Kontrak</span>
              </a>
            </li>
            <?php
            }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>