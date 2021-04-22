<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

require APPPATH . '/libraries/BaseController.php';

class Kegiatan extends BaseController
{
	var $folder   =   "kegiatan";
    var $tables   =   "kegiatan";
    var $tables2  =   "detail_screening";
    var $tables3  =   "daftar_kasus_screening";
    var $cuti     =   "ajuan_cuti";
    var $pk       =   "id_pegawai";
    var $pk2      =   "id_user";
    var $title    =   "DAFTAR KEGIATAN HUMAS";

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('mcrud');
        $this->load->helper('url');
        $this->load->library('pagination');
        //$this->load->helper('tgl_indo');
        $this->isLoggedIn();   
    }

	public function index()
	{
        $data['record'] =  $this->db/*->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')
                                    ->join('tbl_roles', 'tbl_roles.kode_role = pegawai.kode_role')*/
                                    ->get($this->tables)->result();
        $data['detail'] =  $this->db->get($this->tables2)->result();
        //$data['count']  =  $this->db->where('id_klasifikasi','BR1')->get($this->tables)->count_all_result();
        //SELECT COUNT(id_klasifikasi) FROM kegiatan WHERE id_klasifikasi = 'BR1';
        $data['title']  =  $this->title;

        $data['model']       =  $this->user_model->view();
        $data['klasifikasi'] =  $this->user_model->getKlasifikasi();
        $data['hasil']       =  $this->user_model->Jum_kasus();

        $data['branding']         =  $this->user_model->kegiatanBranding();
        $data['networking']       =  $this->user_model->kegiatanNetworking();
        $data['directSelling']    =  $this->user_model->kegiatanDirectSelling();
        $data['digitalMarketing'] =  $this->user_model->kegiatanDigitalMarketing();
        $data['sosialMarketing']  =  $this->user_model->kegiatanSosialMarketing();
        $data['allKlasifikasi']   =  $this->user_model->kegiatanAllKlasifikasi();

        $dat = $this->user_model->get_dat()->result();
        $x['dat'] = json_encode($dat);

        //$data['outlet'] = $this->user_model->getOutlet();
        //$data['jabatan'] = $this->user_model->getRoles();
        //$data['roles']  = $this->user_model->getJabatan2();

        //

        //

        $this->global['pageIcon']  = 'assets/images/logo_edc.png';
        $this->global['pageTitle'] = 'Daftar Kegiatan';
        $this->global['logo']      = 'assets/images/logo_edc.png';
        
        $this->loadViews("page/kegiatan/view", $this->global, $data, $x, NULL);
    }

    public function load_kegiatan()
    {
        //$kode_perusahaan = $_GET['kode_perusahaan'];
        if($this->session->userdata('level') == HAK_ADMIN) //ADMIN
        {
            $tahun = $_GET['tahun'];
            $bulan = $_GET['bulan'];
            $id_klasifikasi = $_GET['id_klasifikasi'];
            if ($tahun == '0' && $bulan == '0' && $id_klasifikasi == 'ALL') { //SEMUA DATA TAMPIL
                $data = $this->db->order_by('kegiatan.id_kegiatan asc')->get($this->tables)->result();
            }elseif ($tahun != '0' && $bulan == '0' && $id_klasifikasi == 'ALL') { //BERDASARKAN TAHUN
                $data = $this->db->where('year(tgl_kegiatan)',$tahun)->get($this->tables)->result();
            }elseif ($tahun == '0' && $bulan != '0' && $id_klasifikasi == 'ALL') { //BERDASARKAN BULAN
                $data = $this->db->where('month(tgl_kegiatan)',$bulan)->get($this->tables)->result();
            }elseif ($tahun == '0' && $bulan == '0' && $id_klasifikasi != 'ALL') { //BERDASARKAN KLASIFIKASI
                $data = $this->db->where('id_klasifikasi',$id_klasifikasi)->get($this->tables)->result();
            }elseif ($tahun != '0' && $bulan != '0' && $id_klasifikasi == 'ALL') { //BERDASARKAN TAHUN DAN BULAN
                $data = $this->db->where('year(tgl_kegiatan)',$tahun)->where('month(tgl_kegiatan)',$bulan)->get($this->tables)->result();
            }elseif ($tahun != '0' && $bulan == '0' && $id_klasifikasi != 'ALL') { //BERDASARKAN TAHUN DAN KLASIFIKASI
                $data = $this->db->where('year(tgl_kegiatan)',$tahun)->where('id_klasifikasi',$id_klasifikasi)->get($this->tables)->result();
            }elseif ($tahun == '0' && $bulan != '0' && $id_klasifikasi != 'ALL') { //BERDASARKAN BULAN DAN KLASIFIKASI
                $data = $this->db->where('month(tgl_kegiatan)',$bulan)->where('id_klasifikasi',$id_klasifikasi)->get($this->tables)->result();
            }else{ //BERDASARKAN SEMUA FILTER
                $data = $this->db->where('year(tgl_kegiatan)',$tahun)->where('month(tgl_kegiatan)',$bulan)->where('id_klasifikasi',$id_klasifikasi)->get($this->tables)->result();
            }
            if (!empty($data)){
                $no=1;
                    foreach($data as $r) : ?>
                    <tr>
                    <td><?= $no; ?></td>
                    <!-- <td><?= $this->user_model->getOutlet($r->id_user); ?></td> -->
                    <td><?= $r->id_klasifikasi; ?></td>
                    <td><?= $r->tgl_kegiatan; ?></td>
                    <td><?= $r->nama_kegiatan; ?></td>
                    <td><?= $r->nama_instansi; ?></td>
                    <td><?= $r->nama_personal; ?></td>
                    <td><?= $r->alamat; ?></td>
                    <td><?= $r->no_telp; ?></td>
                    <td>-</td>
                    <td>
                            <?php
                            $nilai = $r->keterangan;
                            $hasil = $nilai!="" ? $r->keterangan : 'Tidak ada';
                            echo $hasil;
                            ?>
                    </td>
                    <td>
                        <center>
                            <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-gear"></i>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li><a href="<?=site_url('kegiatan/edit/'.$r->id_kegiatan);?>" style="color: green;"><i class="fa fa-edit"></i> Edit</a></li>
                                <li><a href="<?=site_url('kegiatan/hapus/'.$r->id_kegiatan);?>" class="alert_hapus"  style="color: red;"><i class="fa fa-trash"></i> Hapus</a></li>
                                <?php
                                if ($r->id_klasifikasi == 'DS2'){ ?>
                                <li class="divider"></li>
                                <li><a href="<?=site_url('kegiatan/detailScreening/'.$r->id_kegiatan);?>"><i class="fa fa-eye"  style="color: blue;"></i> Detail Screening</a></li>
                                <?php
                                }
                                ?>
                                
                            </ul>
                            </div>
                        </center>
                    </td>
                    </tr>
                    <?php 
                    $no++;
                    endforeach;?>
                        
                        <script>
                            jQuery(document).ready(function($){
                                $('.alert_hapus').on('click',function(){
                                var getLink = $(this).attr('href');
                                    swal({
                                    title: 'Konfirmasi',
                                    text: 'Anda yakin ingin menghapus data ini?',
                                    html: true,
                                    //confirmButtonColor: '#d9534f',
                                    confirmButtonClass: "btn-danger",
                                    showCancelButton: true,
                                    confirmButtonText: "Hapus",
                                    cancelButtonText: "Batal",
                                    closeOnConfirm: false,
                                    closeOnCancel: true
                                    },
                                    function(){
                                    window.location.href = getLink
                                    swal("Sukses!", "Data berhasil dihapus", "success");
                                    });
                                    return false;
                                });
                            }); 
                        </script>
                    <?php
            }else{
                ?> <tr><td colspan="11" align="center">Belum ada data</td></tr> <?php
            }
        }else{
            $tahun = $_GET['tahun'];
            $bulan = $_GET['bulan'];
            $id_klasifikasi = $_GET['id_klasifikasi'];
            if ($tahun == '0' && $bulan == '0' && $id_klasifikasi == 'ALL') { //SEMUA DATA TAMPIL
                $data = $this->db->where('user',$this->session->userdata('id_user'))->order_by('kegiatan.id_kegiatan asc')->get($this->tables)->result();
            }elseif ($tahun != '0' && $bulan == '0' && $id_klasifikasi == 'ALL') { //BERDASARKAN TAHUN
                $data = $this->db->where('user',$this->session->userdata('id_user'))->where('year(tgl_kegiatan)',$tahun)->get($this->tables)->result();
            }elseif ($tahun == '0' && $bulan != '0' && $id_klasifikasi == 'ALL') { //BERDASARKAN BULAN
                $data = $this->db->where('user',$this->session->userdata('id_user'))->where('month(tgl_kegiatan)',$bulan)->get($this->tables)->result();
            }elseif ($tahun == '0' && $bulan == '0' && $id_klasifikasi != 'ALL') { //BERDASARKAN KLASIFIKASI
                $data = $this->db->where('user',$this->session->userdata('id_user'))->where('id_klasifikasi',$id_klasifikasi)->get($this->tables)->result();
            }elseif ($tahun != '0' && $bulan != '0' && $id_klasifikasi == 'ALL') { //BERDASARKAN TAHUN DAN BULAN
                $data = $this->db->where('user',$this->session->userdata('id_user'))->where('year(tgl_kegiatan)',$tahun)->where('month(tgl_kegiatan)',$bulan)->get($this->tables)->result();
            }elseif ($tahun != '0' && $bulan == '0' && $id_klasifikasi != 'ALL') { //BERDASARKAN TAHUN DAN KLASIFIKASI
                $data = $this->db->where('user',$this->session->userdata('id_user'))->where('year(tgl_kegiatan)',$tahun)->where('id_klasifikasi',$id_klasifikasi)->get($this->tables)->result();
            }elseif ($tahun == '0' && $bulan != '0' && $id_klasifikasi != 'ALL') { //BERDASARKAN BULAN DAN KLASIFIKASI
                $data = $this->db->where('user',$this->session->userdata('id_user'))->where('month(tgl_kegiatan)',$bulan)->where('id_klasifikasi',$id_klasifikasi)->get($this->tables)->result();
            }else{ //BERDASARKAN SEMUA FILTER
                $data = $this->db->where('user',$this->session->userdata('id_user'))->where('year(tgl_kegiatan)',$tahun)->where('month(tgl_kegiatan)',$bulan)->where('id_klasifikasi',$id_klasifikasi)->get($this->tables)->result();
            }
            if (!empty($data)){
                $no=1;
                    foreach($data as $r) : ?>
                    <tr>
                    <td><?= $no; ?></td>
                    <!-- <td><?= $this->user_model->getOutlet($r->id_user); ?></td> -->
                    <td><?= $r->id_klasifikasi; ?></td>
                    <td><?= $r->tgl_kegiatan; ?></td>
                    <td><?= $r->nama_kegiatan; ?></td>
                    <td><?= $r->nama_instansi; ?></td>
                    <td><?= $r->nama_personal; ?></td>
                    <td><?= $r->alamat; ?></td>
                    <td><?= $r->no_telp; ?></td>
                    <td>-</td>
                    <td>
                            <?php
                            $nilai = $r->keterangan;
                            $hasil = $nilai!="" ? $r->keterangan : 'Tidak ada';
                            echo $hasil;
                            ?>
                    </td>
                    <td>
                        <center>
                            <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-gear"></i>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li><a href="<?=site_url('kegiatan/edit/'.$r->id_kegiatan);?>" style="color: green;"><i class="fa fa-edit"></i> Edit</a></li>
                                <li><a href="<?=site_url('kegiatan/hapus/'.$r->id_kegiatan);?>" class="alert_hapus"  style="color: red;"><i class="fa fa-trash"></i> Hapus</a></li>
                                <?php
                                if ($r->id_klasifikasi == 'DS2'){ ?>
                                <li class="divider"></li>
                                <li><a href="<?=site_url('kegiatan/detailScreening/'.$r->id_kegiatan);?>"><i class="fa fa-eye"  style="color: blue;"></i> Detail Screening</a></li>
                                <?php
                                }
                                ?>
                                
                            </ul>
                            </div>
                        </center>
                    </td>
                    </tr>
                    <?php 
                    $no++;
                    endforeach;?>
                        
                        <script>
                            jQuery(document).ready(function($){
                                $('.alert_hapus').on('click',function(){
                                var getLink = $(this).attr('href');
                                    swal({
                                    title: 'Konfirmasi',
                                    text: 'Anda yakin ingin menghapus data ini?',
                                    html: true,
                                    //confirmButtonColor: '#d9534f',
                                    confirmButtonClass: "btn-danger",
                                    showCancelButton: true,
                                    confirmButtonText: "Hapus",
                                    cancelButtonText: "Batal",
                                    closeOnConfirm: false,
                                    closeOnCancel: true
                                    },
                                    function(){
                                    window.location.href = getLink
                                    swal("Sukses!", "Data berhasil dihapus", "success");
                                    });
                                    return false;
                                });
                            }); 
                        </script>
                    <?php
            }else{
                ?> <tr><td colspan="11" align="center">Belum ada data</td></tr> <?php
            }
        }
        
    }

    function post()
    {
        $data['record']      =  $this->db->where('user != 1')->get($this->tables)->result();
        //$data['record']    =  $this->db->join('tbl_users','tbl_users.nip=pegawai.nip')->get($this->tables)->result();
        $data['title']       =  $this->title;
        $data['desc']        =  "";
        $data['klasifikasi'] =  $this->user_model->getKlasifikasi();
        $data['humas']       =  $this->user_model->getHumas();
        $data['outlet']      =  $this->user_model->getOutlet();

        //$this->load->model('user_model');
        //$data['roles'] = $this->user_model->getUserRoles();
        //$data['role'] = $this->user_model->getRoles();
        //$data['outlet'] = $this->user_model->getOutlet();

        $this->global['pageTitle'] = 'TAMBAH KEGIATAN';
        $this->global['pageIcon']  = '../assets/images/logo_edc.png';
        $this->global['logo']      = '../assets/images/logo_edc.png';

        $this->loadViews("page/kegiatan/post", $this->global, $data, NULL);
    }

    function add()
    {
        $data['id_klasifikasi']    = $this->input->post('id_klasifikasi',true);
        $data['user']              = $this->input->post('id_user',true);
        $data['id_outlet']         = $this->input->post('id_outlet',true);
        $data['tgl_kegiatan']      = $this->input->post('tgl_kegiatan',true);
        $data['nama_kegiatan']     = $this->input->post('nama_kegiatan',true);
        $data['nama_instansi']     = $this->input->post('nama_instansi',true);
        $data['nama_personal']     = $this->input->post('nama_personal',true);
        $data['alamat']            = $this->input->post('alamat',true);
        $data['no_telp']           = $this->input->post('no_telp',true);
        $data['keterangan']        = $this->input->post('keterangan',true);

        $this->db->insert($this->tables,$data);
        //$this->session->set_flashdata('berhasil','Data Surat Masuk berhasil di Tambah');
        redirect('kegiatan');
    }

    function edit()
    {
        $data['kegiatan']   =  $this->db->where('id_kegiatan',$this->uri->segment('3'))->get('kegiatan')->result();
        $data['record']     =  $this->db->where('user != 1')->get($this->tables)->result();
        $data['klasifikasi'] =  $this->user_model->getKlasifikasi();
        $data['humas']       =  $this->user_model->getHumas();
        $data['outlet']      =  $this->user_model->getOutlet();
        $this->global['pageTitle'] = 'EDIT KEGIATAN';
        $this->global['pageIcon']  = '../../assets/images/logo_edc.png';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/kegiatan/edit", $this->global, $data, NULL);
    }

    public function update()
    {
        $kd = $this->input->post('id_kegiatan',true);
        
        $data['id_kegiatan']       = $this->input->post('id_kegiatan',true);
        $data['id_klasifikasi']   = $this->input->post('id_klasifikasi',true);
        $data['user']           = $this->input->post('id_user',true);
        $data['id_outlet']         = $this->input->post('id_outlet',true);
        $data['tgl_kegiatan']      = $this->input->post('tgl_kegiatan',true);
        $data['nama_kegiatan']     = $this->input->post('nama_kegiatan',true);
        $data['nama_instansi']     = $this->input->post('nama_instansi',true);
        $data['nama_personal']     = $this->input->post('nama_personal',true);
        $data['alamat']            = $this->input->post('alamat',true);
        $data['no_telp']           = $this->input->post('no_telp',true);
        $data['keterangan']        = $this->input->post('keterangan',true);

        $this->db->where('id_kegiatan',$kd)->update('kegiatan',$data);
        $this->session->set_flashdata('berhasil','Data Kegiatan berhasil diperbarui');

        redirect('kegiatan');
        
        //if ($this->session->userdata('level') == 'pegawai') {
        //    redirect('pegawai/profil/'.$this->session->userdata('userId'));
        //}else{
        //    redirect('pegawai/detail/'.$this->input->post('nip_pegawai'));
        //}
    }

    function hapus($pk)
  	{
        $this->db->where('id_kegiatan',$pk)->delete('kegiatan');
        $this->session->set_flashdata('berhasil','Data berhasil di hapus');
        redirect('kegiatan');
    }

    function detailScreening()
    {
        $data['record']   =  $this->db->where('id_kegiatan_screening',$this->uri->segment('3'))
                                    ->join('kegiatan', 'kegiatan.id_kegiatan = detail_screening.id_kegiatan_screening')
                                    ->get($this->tables2)->result();
        $data['kegiatan'] =  $this->db->where('id_kegiatan',$this->uri->segment('3'))->get($this->tables)->result();
        $data['kasus']    =  $this->db->where('id_screening',$this->uri->segment('3'))->get($this->tables3)->result();
        //$data['atasan'] =  $this->db->query('SELECT role FROM `tbl_roles` WHERE roleId = 2')->result();
        $data['title']  =  $this->title;

        $data['model']  = $this->user_model->view();

        $this->global['pageTitle'] = 'Detail Screening';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/detail_screening/view", $this->global, $data , NULL);
    }

    function addDataScreening()
    {
        $data['record']   = $this->db->where('id_kegiatan',$this->uri->segment('3'))
                                    ->get($this->tables)->result();
        $this->global['pageTitle'] = 'TAMBAH DATA SCREENING';
        //$this->global['pageIcon']  = '../../assets/images/logo_edc.png';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/detail_screening/post", $this->global, $data, NULL);
    }

    public function postDataScreening()
    {
        $kd = $this->input->post('id_screening',true);

        $data['id_kegiatan_screening'] = $this->input->post('id_screening',true);
        $data['tgl_screening']         = $this->input->post('tgl_screening',true);
        $data['jumlah_peserta']        = $this->input->post('jumlah_peserta',true);
        $data['jumlah_kasus']          = $this->input->post('jumlah_kasus',true);
        $data['ket']                   = $this->input->post('ket',true);

        $this->db->insert($this->tables2,$data);
        $this->session->set_flashdata('berhasil','Data Screening berhasil diperbarui');

        redirect('kegiatan/detailScreening/'.$kd);
    }

    function editDataScreening()
    {
        $data['record']   = $this->db->where('id_kegiatan_screening',$this->uri->segment('3'))
                                    ->join('kegiatan', 'kegiatan.id_kegiatan = detail_screening.id_kegiatan_screening')
                                    ->get($this->tables2)->result();
        $this->global['pageTitle'] = 'EDIT DATA SCREENING';
        //$this->global['pageIcon']  = '../../assets/images/logo_edc.png';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/detail_screening/edit", $this->global, $data, NULL);
    }

    public function updateDataScreening()
    {
        $kd = $this->input->post('id_screening',true);
        
        $data['id_kegiatan']       = $this->input->post('id_screening',true);
        $data['tgl_kegiatan']      = $this->input->post('tgl_kegiatan',true);
        $data['nama_kegiatan']     = $this->input->post('nama_kegiatan',true);
        $data['alamat']            = $this->input->post('alamat_kegiatan',true);

        $data2['tgl_screening']    = $this->input->post('tgl_kegiatan',true);
        $data2['jumlah_peserta']   = $this->input->post('jumlah_peserta',true);
        $data2['jumlah_kasus']     = $this->input->post('jumlah_kasus',true);
        $data2['ket']              = $this->input->post('ket',true);

        $this->db->where('id_kegiatan',$kd)->update('kegiatan',$data);
        $this->db->where('id_kegiatan_screening',$kd)->update('detail_screening',$data2);
        $this->session->set_flashdata('berhasil','Data Screening berhasil diperbarui');

        redirect('kegiatan/detailScreening/'.$kd);
    }

    function addDataKasus()
    {
        $data['record']      =  $this->db->where('id_kegiatan',$this->uri->segment('3'))->get($this->tables)->result();

        $this->global['pageTitle'] = 'TAMBAH DATA KASUS';
        //$this->global['pageIcon']  = '../../assets/images/logo_edc.png';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/datakasus/post", $this->global,$data, NULL);
    }

    public function postDataKasus()
    {
        $kd = $this->input->post('id_screening',true);

        $data['id_screening']   = $this->input->post('id_screening',true);
        $data['nama_peserta']   = $this->input->post('nama_peserta',true);
        $data['nik']            = $this->input->post('nik',true);
        $data['no_telp']        = $this->input->post('no_telp',true);
        $data['jk']             = $this->input->post('jk',true);
        $data['alamat_peserta'] = $this->input->post('alamat_peserta',true);
        $data['jenis_kasus']    = $this->input->post('jenis_kasus',true);
        $data['ket']            = $this->input->post('ket',true);

        $this->db->insert($this->tables3,$data);
        $this->session->set_flashdata('berhasil','Data Kasus berhasil ditambahkan');

        redirect('kegiatan/detailScreening/'.$kd);
    }

    function editDataKasus()
    {
        $data['record']      =  $this->db->where('id_daftar_kasus',$this->uri->segment('3'))->get($this->tables3)->result();

        $this->global['pageTitle'] = 'EDIT DATA KASUS';
        //$this->global['pageIcon']  = '../../assets/images/logo_edc.png';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/datakasus/edit", $this->global,$data, NULL);
    }

    public function updateDataKasus()
    {
        $kd   = $this->input->post('id_daftar_kasus',true);
        $kdsc = $this->input->post('id_screening',true);

        //$data['id_daftar_kasus'] = $this->input->post('id_daftar_kasus',true);
        $data['nama_peserta']    = $this->input->post('nama_peserta',true);
        $data['nik']             = $this->input->post('nik',true);
        $data['no_telp']         = $this->input->post('no_telp',true);
        $data['jk']              = $this->input->post('jk',true);
        $data['alamat_peserta']  = $this->input->post('alamat_peserta',true);
        $data['jenis_kasus']     = $this->input->post('jenis_kasus',true);
        $data['ket']             = $this->input->post('ket',true);

        $this->db->where('id_daftar_kasus',$kd)->update('daftar_kasus_screening',$data);
        $this->session->set_flashdata('berhasil','Data Kasus berhasil diperbarui');

        redirect('kegiatan/detailScreening/'.$kdsc);
    }
}
?>