<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

require APPPATH . '/libraries/BaseController.php';

class Pegawai extends BaseController
{
	var $folder   =   "pegawai";
    var $tables   =   "pegawai";
    var $tables2  =   "tbl_roles";
    var $tables3  =   "tbl_users";
    var $keluarga =   "data_keluarga";
    var $mutasi   =   "riwayat_mutasi";
    var $cuti     =   "ajuan_cuti";
    var $pk       =   "id_pegawai";
    var $pk2      =   "kode_role";
    var $pk3      =   "id_role_atasan";
    var $title    =   "DAFTAR PEGAWAI KLINIK MATA EDC GROUP";

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        //$this->load->helper('tgl_indo');
        $this->isLoggedIn();   
    }

	public function index()
	{
        $data['record'] =  $this->db->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->join('tbl_roles', 'tbl_roles.kode_role = pegawai.kode_role')->get($this->tables)->result();
        //$data['atasan'] =  $this->db->query('SELECT role FROM `tbl_roles` WHERE roleId = 2')->result();
        $data['title']  =  $this->title;

        $data['outlet'] = $this->user_model->getOutlet();
        $data['jabatan'] = $this->user_model->getRoles();
        //$data['roles']  = $this->user_model->getJabatan2();

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = 'assets/images/logo_edc.png';
        
        $this->loadViews("page/pegawai/view", $this->global, $data , NULL);
    }

    public function load_pegawai()
    {
        $kode_perusahaan = $_GET['kode_perusahaan'];
        $tahun = $_GET['tahun'];
        $jabatan = $_GET['jabatan'];
        if ($kode_perusahaan == 'ALL' && $tahun == '0' && $jabatan == 'ALL') { //SEMUA DATA TAMPIL
            $data = $this->db->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->order_by('pegawai.id_pegawai asc')->get($this->tables)->result();
        }elseif ($kode_perusahaan != 'ALL' && $tahun == '0' && $jabatan == 'ALL') { //BERDASARKAN PERUSAHAAN
            $data = $this->db->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->where('kode_perusahaan',$kode_perusahaan)->get($this->tables)->result();
        }elseif ($kode_perusahaan == 'ALL' && $tahun != '0' && $jabatan == 'ALL') { //BERDASARKAN TAHUN
            $data = $this->db->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->where('year(tgl_masuk)',$tahun)->get($this->tables)->result();
        }elseif ($kode_perusahaan == 'ALL' && $tahun == '0' && $jabatan != 'ALL') { //BERDASARKAN JABATAN
            $data = $this->db->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->where('kode_role',$jabatan)->or_where('kode_role2',$jabatan)->get($this->tables)->result();
        }elseif ($kode_perusahaan != 'ALL' && $tahun == '0' && $jabatan != 'ALL') { //BERDASARKAN PERUSAHAAN DAN JABATAN
            $data = $this->db->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->where('kode_perusahaan',$kode_perusahaan)->where('kode_role',$jabatan)->or_where('kode_role2',$jabatan)->get($this->tables)->result();
        }elseif ($kode_perusahaan != 'ALL' && $tahun == '0' && $jabatan != 'ALL') { //BERDASARKAN PERUSAHAAN DAN TAHUN
            $data = $this->db->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->where('kode_perusahaan',$kode_perusahaan)->where('year(tgl_masuk)',$tahun)->get($this->tables)->result();
        }elseif ($kode_perusahaan == 'ALL' && $tahun != '0' && $jabatan != 'ALL') { //BERDASARKAN TAHUN DAN JABATAN
            $data = $this->db->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->where('year(tgl_masuk)',$tahun)->where('kode_role',$jabatan)->or_where('kode_role2',$jabatan)->get($this->tables)->result();
        }else{ //BERDASARKAN PERUSAHAAN DAN TAHUN
            $data = $this->db->join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->where('kode_perusahaan',$kode_perusahaan)->where('year(tgl_masuk)',$tahun)->get($this->tables)->result();
        }
        if (!empty($data)){
            $no=1;
                foreach($data as $r) : ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $r->nama; ?></td>
                  <td><?= $r->nama_perusahaan; ?></td>
                  <td><?= $this->user_model->getJabatan2($r->kode_role); ?></td>
                  <td><?php
                    if ($r->kode_role2 == "-")
                    {
                        echo "-";
                    }else{
                        echo $this->user_model->getJabatan2($r->kode_role2);
                    } ?></td>
                  <td><?= tgl_indo($r->tgl_masuk); ?></td>
                  <td><?= $r->telp; ?></td>
                  <td>
                    <center>
                    <a href="<?=site_url('pegawai/detail/'.$r->nip);?>" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-eye"></i></a>
                    <!-- <a href="<?=site_url('pegawai/edit/'.$r->nip);?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a> -->
                    <a href="<?=site_url('pegawai/hapus/'.$r->nip);?>" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>
                    </center>
                  </td>
                </tr>
                  <?php 
                  $no++;
                  endforeach;?> <?php
        }else{
            ?> <tr><td colspan="7" align="center">Tidak ada data</td></tr> <?php
        }
        
    }

    public function detail()
    {
        $kode           = $this->uri->segment(3);
        $data['outlet'] = $this->user_model->getOutlet();
        $data['pegInfo'] = $this->user_model->getPegInfo($this->uri->segment(3));
        $data['record'] = $this->db->
            join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->
            join('tbl_roles', 'tbl_roles.kode_role = pegawai.kode_role')->
            where('nip',$kode)->get($this->tables)->result();
        $data['studi']  = $this->db->
            join('riwayat_pendidikan', 'riwayat_pendidikan.nip_pegawai = pegawai.nip')->
            where('nip',$kode)->get($this->tables)->result();
        $data['kerja']  = $this->db->
            join('riwayat_pekerjaan', 'riwayat_pekerjaan.nip_pegawai = pegawai.nip')->
            where('nip',$kode)->get($this->tables)->result();
        $data['org']    = $this->db->
            join('riwayat_organisasi', 'riwayat_organisasi.nip_pegawai = pegawai.nip')->
            where('nip',$kode)->get($this->tables)->result();
        $data['cuti']   = $this->db->where('nip_pegawai',$kode)->where('status_ajuan = 2')->get($this->cuti)->result();
        $data['keluarga']    = $this->db->
            join('data_keluarga', 'data_keluarga.nip_user = pegawai.nip')->
            where('nip',$kode)->get($this->tables)->result();
        $data['role'] = $this->db->
            join('tbl_roles', 'tbl_roles.kode_role = tbl_users.roleId')->
            where('nip',$kode)->get($this->tables3)->result();
        $data['title']  = $this->title;
        $data['desc']   = "";

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/detail", $this->global, $data, NULL);
        //$this->load->view('page/outlet/detail',$data);
    }

    public function profil()
    {
        $kode            = $this->uri->segment(3);
        $data['outlet']  = $this->user_model->getOutlet();
        $data['pegInfo'] = $this->user_model->getPegInfo($this->uri->segment(3));

        $data['roless']  = $this->db->join('tbl_users','tbl_users.roleId=tbl_roles.kode_role')->
        where('userId',$kode)->get('tbl_roles')->result();

        $data['record'] = $this->db->
            join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->
            join('tbl_users','tbl_users.nip=pegawai.nip')->
            join('tbl_roles', 'tbl_roles.kode_role = tbl_users.roleId')->
            where('userId',$kode)->
            get($this->tables)->result();
        $data['studi']  = $this->db->
            join('riwayat_pendidikan', 'riwayat_pendidikan.nip_pegawai = pegawai.nip')->
            join('tbl_users', 'tbl_users.nip = pegawai.nip')->
            where('userId',$kode)->get($this->tables)->result();
        $data['kerja']  = $this->db->
            join('riwayat_pekerjaan', 'riwayat_pekerjaan.nip_pegawai = pegawai.nip')->
            join('tbl_users', 'tbl_users.nip = pegawai.nip')->
            where('userId',$kode)->get($this->tables)->result();
        $data['org']    = $this->db->
            join('riwayat_organisasi', 'riwayat_organisasi.nip_pegawai = pegawai.nip')->
            join('tbl_users', 'tbl_users.nip = pegawai.nip')->
            where('userId',$kode)->get($this->tables)->result();
        $data['mutasi']   =  $this->db->
            join('tbl_users', 'tbl_users.nip = riwayat_mutasi.nip')->
            where('userId',$this->session->userdata('userId'))->
            get($this->mutasi)->result();
        $data['cuti']   =  $this->db->
            join('tbl_users', 'tbl_users.nip = ajuan_cuti.nip_pegawai')->
            where('userId',$this->session->userdata('userId'))->
            where('status_ajuan = 2')->get($this->cuti)->result();
        $data['keluarga']    = $this->db->
            join('data_keluarga', 'data_keluarga.nip_user = pegawai.nip')->
            join('tbl_users', 'tbl_users.nip = pegawai.nip')->
            where('userId',$kode)->get($this->tables)->result();
        $data['title']  = $this->title;
        $data['desc']   = "";

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/profil", $this->global, $data, NULL);
        //$this->load->view('page/outlet/detail',$data);
    }

    function post()
    {
        //$data['record'] =  $this->db->join('tbl_users','tbl_users.nip=pegawai.nip')->get($this->tables)->result();
        $data['title']      = $this->title;
        $data['desc']       =   "";

        $this->load->model('user_model');
        $data['roles'] = $this->user_model->getUserRoles();
        $data['role'] = $this->user_model->getRoles();
        $data['outlet'] = $this->user_model->getOutlet();

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/post", $this->global, $data, NULL);
    }

    function addData()
    {
        $data['nip']              = $this->input->post('nip',true);
        $data['kode_role']        = $this->input->post('kode_role',true);
        $data['kode_perusahaan']  = $this->input->post('kode_perusahaan',true);
        $data['nama']             = $this->input->post('nama',true);
        $data['alamat']           = $this->input->post('alamat',true);
        $data['status_kawin']     = $this->input->post('status_kawin',true);
        $data['jk']               = $this->input->post('jk',true);
        $data['tempat_lahir']     = $this->input->post('tempat_lahir',true);
        $data['tgl_lahir']        = $this->input->post('tgl_lahir',true);
        $data['agama']            = $this->input->post('agama',true);
        $data['telp']             = $this->input->post('telp',true);
        $data['email_pegawai']    = $this->input->post('email_pegawai',true);
        $data['pendidikan']       = $this->input->post('pendidikan',true);
        $data['rekening_pegawai'] = $this->input->post('rekening_pegawai',true);
        $data['nama_bank']        = $this->input->post('nama_bank',true);
        $data['tgl_masuk']        = $this->input->post('tgl_masuk',true);
        //$data['foto']             = $this->input->post('foto',true);


        $this->db->insert($this->tables,$data);
        $this->session->set_flashdata('berhasil','Data Pegawai berhasil di Tambah');
        redirect('pegawai');
    }

    function addPegawai()
    {
        if($this->isHRD() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('nama','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('username','Username','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('nip','NIP Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->post();
            }
            else
            {
                $nama            = ucwords(strtolower($this->input->post('nama')));
                $username        = $this->input->post('username');
                $password        = $this->input->post('password');
                //$kode_role         = $this->input->post('role');
                $nip             = $this->input->post('nip');
                $kode_perusahaan = $this->input->post('kode_perusahaan');
                $alamat          = $this->input->post('alamat');
                $jk              = $this->input->post('jk');
                $tempat_lahir    = $this->input->post('tempat_lahir');
                $tgl_lahir       = $this->input->post('tgl_lahir');
                $agama           = $this->input->post('agama');
                $status_kawin    = $this->input->post('status_kawin');
                $telp            = $this->input->post('telp');
                $email           = $this->input->post('email');
                $tgl_masuk       = $this->input->post('tgl_masuk');
                //$alamat   = $this->input->post('alamat');
                
                $userInfo = array('username'=>$username, 'password'=>getHashedPassword($password), 'kode_role'=>$kode_role, 'name'=> $nama,
                                    'nip'=>$nip, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                $peg      = array('nama'=>$nama, 'nip'=>$nip, /* 'id_role'=>$roleId, */ 'alamat'=>$alamat, 'status_kawin'=>$status_kawin, 'jk'=>$jk, 'tempat_lahir'=>$tempat_lahir, 'tgl_lahir'=>$tgl_lahir, 'agama'=>$agama, 'telp'=>$telp, 'email_pegawai'=>$email, 'tgl_masuk'=>$tgl_masuk);
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewPegawai($userInfo, $peg);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Pegawai created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('pegawai');
            }
        }
    }

    public function post2()
    {
        $data['kode_role']        = $this->input->post('kode_role',true);
    	$data['id_role_atasan']   = $this->input->post('id_role_atasan',true);
    	$data['role']             = $this->input->post('role',true);

        $this->db->insert($this->tables,$data);
        $this->session->set_flashdata('berhasil','Data berhasil di Tambah');
        redirect('pegawai');
    }

    function edit()
    {
        $data['record']  = $this->db->where('nip',$this->uri->segment(3))->get($this->tables)->result();
        $data['title']   = $this->title;
        $data['desc']    = "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/edit", $this->global, $data, NULL);
    }

    public function update()
    {
    $kd = $this->input->post('id_pegawai',true);
	//$data['id_role_atasan']   = $this->input->post('id_role_atasan',true);
	//$data['role']             = $this->input->post('role',true);
    $data['nip']              = $this->input->post('nip',true);
    $data['nama']             = $this->input->post('nama',true);
    $data['kode_perusahaan']  = $this->input->post('kode_perusahaan',true);
    $data['alamat']           = $this->input->post('alamat',true);
    $data['status_kawin']     = $this->input->post('status_kawin',true);
    $data['jk']               = $this->input->post('jk',true);
    $data['tempat_lahir']     = $this->input->post('tempat_lahir',true);
    $data['tgl_lahir']        = $this->input->post('tgl_lahir',true);
    $data['agama']            = $this->input->post('agama',true);
    $data['telp']             = $this->input->post('telp',true);
    $data['email_pegawai']    = $this->input->post('email_pegawai',true);
    $data['rekening_pegawai'] = $this->input->post('rekening_pegawai',true);
    $data['nama_bank']        = $this->input->post('nama_bank',true);
    $data['pendidikan']       = $this->input->post('pendidikan',true);
    $data['tgl_masuk']        = $this->input->post('tgl_masuk',true);


    $this->db->where('id_pegawai',$kd)->update($this->tables,$data);
    $this->session->set_flashdata('berhasil','Data berhasil diperbarui');
    redirect('pegawai');
    }

    public function updateprofil()
    {
        $id  = $this->uri->segment(3);
        $nip = $this->input->post('nip');

        $data['nip']              = $this->input->post('nip',true);
        //$data['kode_role']        = $this->input->post('kode_role',true);
        $data['kode_perusahaan']  = $this->input->post('kode_perusahaan',true);
        $data['nama']             = $this->input->post('nama',true);
        $data['alamat']           = $this->input->post('alamat',true);
        $data['status_kawin']     = $this->input->post('status_kawin',true);
        $data['jk']               = $this->input->post('jk',true);
        $data['tempat_lahir']     = $this->input->post('tempat_lahir',true);
        $data['tgl_lahir']        = $this->input->post('tgl_lahir',true);
        $data['agama']            = $this->input->post('agama',true);
        $data['telp']             = $this->input->post('telp',true);
        $data['email_pegawai']    = $this->input->post('email_pegawai',true);
        $data['rekening_pegawai'] = $this->input->post('rekening_pegawai',true);
        $data['nama_bank']        = $this->input->post('nama_bank',true);
        $data['pendidikan']       = $this->input->post('pendidikan',true);
        $data['tgl_masuk']        = $this->input->post('tgl_masuk',true);


        //$data2['nip']             = $this->input->post('nip',true);
        $data2['name']            = $this->input->post('nama',true);

        $this->db->where('nip',$nip)->update($this->tables,$data);
        $this->db->where('nip',$nip)->update($this->tables3,$data2);
        $this->session->set_flashdata('berhasil','Data berhasil diperbarui');
        redirect('pegawai/profil/'.$this->session->userdata('userId'));
    }

    public function tambah_pendidikan()
    {
        $data['nip_pegawai']      = $this->input->post('nip_pegawai',true);
        $data['jenis_pendidikan'] = $this->input->post('jenis_pendidikan',true);
        $data['jurusan']          = $this->input->post('jurusan',true);
        $data['nama_instansi']    = $this->input->post('nama_instansi',true);
        $data['tahun_lulus']      = $this->input->post('tahun_lulus',true);

        $this->db->insert('riwayat_pendidikan',$data);
        $this->session->set_flashdata('berhasil','Data Pendidikan berhasil ditambahkan');

        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            redirect('pegawai/detail/'.$this->input->post('nip_pegawai',true));
        }
    }

    public function tambah_pekerjaan()
    {
        $data['nip_pegawai']      = $this->input->post('nip_pegawai',true);
        $data['perusahaan_kerja'] = $this->input->post('perusahaan_kerja',true);
        $data['gaji']             = $this->input->post('gaji',true);
        $data['lama_kerja']       = $this->input->post('lama_kerja',true);
        $data['posisi']           = $this->input->post('posisi',true);

        $this->db->insert('riwayat_pekerjaan',$data);
        $this->session->set_flashdata('berhasil','Data Pekerjaan berhasil ditambahkan');
        
        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            redirect('pegawai/detail/'.$this->input->post('nip_pegawai',true));
        }
    }

    public function tambah_organisasi()
    {
        $data['nip_pegawai']        = $this->input->post('nip_pegawai',true);
        $data['nama_organisasi']    = $this->input->post('nama_organisasi',true);
        $data['jabatan_organisasi'] = $this->input->post('jabatan_organisasi',true);
        $data['lama_jabatan']       = $this->input->post('lama_jabatan',true);
        $data['periode_jabatan']    = $this->input->post('periode_jabatan',true);

        $this->db->insert('riwayat_organisasi',$data);
        $this->session->set_flashdata('berhasil','Data Organisasi berhasil ditambahkan');
        
        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            redirect('pegawai/detail/'.$this->input->post('nip_pegawai',true));
        }
    }

    function hapus_pendidikan($id)
    {
        $this->db->where('id_riwayat_pendidikan',$id)->delete('riwayat_pendidikan');
        $this->session->set_flashdata('berhasil','Data berhasil di hapus');

        $nippp = $this->db->where('id_riwayat_pendidikan',$id)->get('riwayat_pendidikan')->result();
        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            foreach ($nippp as $nn) {
            redirect('pegawai/detail/'.$nn->nip_pegawai);
            }
        }
        
        
    }

    function hapus_pekerjaan($id)
    {
        $this->db->where('id_riwayat_pekerjaan',$id)->delete('riwayat_pekerjaan');
        $this->session->set_flashdata('berhasil','Data berhasil di hapus');
        
        $nippp = $this->db->where('id_riwayat_pekerjaan',$id)->get('riwayat_pekerjaan')->result();
        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            foreach ($nippp as $nn) {
            redirect('pegawai/detail/'.$nn->nip_pegawai);
            }
        }
    }

    function hapus_organisasi($id)
    {
        $this->db->where('id_riwayat_organisasi',$id)->delete('riwayat_organisasi');
        $this->session->set_flashdata('berhasil','Data berhasil di hapus');
        
        $nippp = $this->db->where('id_riwayat_organisasi',$id)->get('riwayat_organisasi')->result();
        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            foreach ($nippp as $nn) {
            redirect('pegawai/detail/'.$nn->nip_pegawai);
            }
        }
    }

    function edit_pendidikan($id)
    {
        $data['record'] = $this->db->where('id_riwayat_pendidikan',$id)->get('riwayat_pendidikan')->result();
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/edit_pendidikan", $this->global, $data, NULL);
    }

    public function update_pendidikan()
    {
        $kd = $this->input->post('id_riwayat_pendidikan',true);

        $data['jenis_pendidikan'] = $this->input->post('jenis_pendidikan',true);
        $data['jurusan']          = $this->input->post('jurusan',true);
        $data['nama_instansi']    = $this->input->post('nama_instansi',true);
        $data['tahun_lulus']      = $this->input->post('tahun_lulus',true);

        $this->db->where('id_riwayat_pendidikan',$kd)->update('riwayat_pendidikan',$data);
        $this->session->set_flashdata('berhasil','Data Pekerjaan berhasil diperbarui');

        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            redirect('pegawai/detail/'.$this->input->post('nip_pegawai'));
        }
    }

    function edit_pekerjaan($id)
    {
        $data['record'] = $this->db->where('id_riwayat_pekerjaan',$id)->get('riwayat_pekerjaan')->result();
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/edit_pekerjaan", $this->global, $data, NULL);
    }

    public function update_pekerjaan()
    {
        $kd = $this->input->post('id_riwayat_pekerjaan',true);

        $data['perusahaan_kerja'] = $this->input->post('perusahaan_kerja',true);
        $data['gaji']             = $this->input->post('gaji',true);
        $data['lama_kerja']       = $this->input->post('lama_kerja',true);
        $data['posisi']           = $this->input->post('posisi',true);

        $this->db->where('id_riwayat_pekerjaan',$kd)->update('riwayat_pekerjaan',$data);
        $this->session->set_flashdata('berhasil','Data Pekerjaan berhasil diperbarui');
        
        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            redirect('pegawai/detail/'.$this->input->post('nip_pegawai'));
        }
    }

    function edit_organisasi($id)
    {
        $data['org'] = $this->db->where('id_riwayat_organisasi',$id)->get('riwayat_organisasi')->result();
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/edit_organisasi", $this->global, $data, NULL);
    }

    public function update_organisasi()
    {
        $kd = $this->input->post('id_riwayat_organisasi',true);

        $data['nama_organisasi']    = $this->input->post('nama_organisasi',true);
        $data['jabatan_organisasi'] = $this->input->post('jabatan_organisasi',true);
        $data['lama_jabatan']       = $this->input->post('lama_jabatan',true);
        $data['periode_jabatan']    = $this->input->post('periode_jabatan',true);

        $this->db->where('id_riwayat_organisasi',$kd)->update('riwayat_organisasi',$data);
        $this->session->set_flashdata('berhasil','Data Organisasi berhasil diperbarui');
        
        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            redirect('pegawai/detail/'.$this->input->post('nip_pegawai'));
        }
    }
    
    function upload_gambar()
    {
        
        $config['upload_path']    = './assets/dist/fotopegawai/';
        $config['allowed_types']  = 'jpg|jpeg|png';
        $config['max_size']       = '4000';
        //$config['remove_space']   = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        //if (! 
            $this->upload->do_upload('namafoto');//) {
            //echo "gagal";
        //}else{
            
        $file = $this->input->post('foto');

        $id         = $this->input->post('nip');
        $namafoto   = $_FILES['namafoto']['name'];

        $nfoto = str_replace(" ","_", $namafoto);

        $data = array(
          'nip'   => $id,
          'foto'  => $nfoto
        );

        $prev_file_path = "./assets/dist/fotopegawai/".$file;
            if(file_exists($prev_file_path ))
                unlink($prev_file_path );

        $this->mcrud->update('pegawai',$data,'nip',$id);
        //}


        redirect(base_url('pegawai/profil/4'));

    }

    function editbyuser()
    {
        $data['record']  = $this->db->join('tbl_users','tbl_users.kode_role = pegawai.kode_role')->where('userId',$this->session->userdata('userId'))->get($this->tables)->result();
        $data['title']   = $this->title;
        $data['desc']    = "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/editbiodata", $this->global, $data, NULL);
    }

    function viewtambahkeluarga()
    {
        $kode           = $this->uri->segment(3);
        //$data['record'] = $this->db->
        //    join('tbl_users', 'tbl_users.roleId = pegawai.id_role')->
        //    join('tbl_roles', 'tbl_roles.roleId = pegawai.id_role')->
        //    where('userId',$kode)->get($this->tables)->result();
        $data['record'] = $this->db->
            join('tbl_users','tbl_users.nip=pegawai.nip')->
            where('userId',$kode)->
            get($this->tables)->result();
        $data['title']      = $this->title;
        $data['desc']       =   "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/tambahkeluarga", $this->global, $data, NULL);
    }

    function postkeluarga()
    {
        $data['nip_user']       = $this->input->post('nip_pegawai',true);
        $data['nik_keluarga']   = $this->input->post('nik_keluarga',true);
        $data['nama_keluarga']  = $this->input->post('nama_keluarga',true);
        $data['tempat_lahir']   = $this->input->post('tempat_lahir',true);
        $data['tgl_lahir']      = $this->input->post('tgl_lahir',true);
        $data['alamat']         = $this->input->post('alamat',true);
        $data['jk']             = $this->input->post('gender',true);
        $data['golongan_darah'] = $this->input->post('goldar',true);
        $data['agama']          = $this->input->post('agama',true);
        $data['pekerjaan']      = $this->input->post('pekerjaan',true);
        $data['status_hidup']   = $this->input->post('status_hidup',true);
        $data['status_kawin']   = $this->input->post('status_kawin',true);
        $data['hub_keluarga']   = $this->input->post('hub_keluarga',true);

        $this->db->insert($this->keluarga,$data);
        $this->session->set_flashdata('berhasil','Ajuan cuti berhasil dikirim. Silahkan tunggu konfirmasi');
        redirect('pegawai/profil/'.$this->session->userdata('userId').'#datakeluarga');
    }

    function editkeluarga()
    {
        $kode    = $this->uri->segment(3);
        $segment = $this->uri->segment(4);
        $data['record']  = $this->db->
            join('data_keluarga', 'data_keluarga.nip_user = pegawai.nip')->
            join('tbl_users', 'tbl_users.nip = pegawai.nip')->
            where('userId',$kode)->where('id_data_keluarga',$segment)->
            get($this->tables)->result();
        $data['title']  = $this->title;
        $data['desc']   = "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../../assets/images/logo_edc.png';

        $this->loadViews("page/pegawai/editkeluarga", $this->global, $data, NULL);
    }

    function updatekeluarga()
    {
        $id_data_keluarga       = $this->input->post('id_data_keluarga');
        $data['nik_keluarga']   = $this->input->post('nik_keluarga',true);
        $data['nama_keluarga']  = $this->input->post('nama_keluarga',true);
        $data['tempat_lahir']   = $this->input->post('tempat_lahir',true);
        $data['tgl_lahir']      = $this->input->post('tgl_lahir',true);
        $data['alamat']         = $this->input->post('alamat',true);
        $data['jk']             = $this->input->post('gender',true);
        $data['golongan_darah'] = $this->input->post('goldar',true);
        $data['agama']          = $this->input->post('agama',true);
        $data['pekerjaan']      = $this->input->post('pekerjaan',true);
        $data['status_hidup']   = $this->input->post('status_hidup',true);
        $data['status_kawin']   = $this->input->post('status_kawin',true);
        $data['hub_keluarga']   = $this->input->post('hub_keluarga',true);

        $this->db->where('id_data_keluarga',$id_data_keluarga)->update($this->keluarga,$data);
        $this->session->set_flashdata('berhasil','Ajuan cuti berhasil dikirim. Silahkan tunggu konfirmasi');
        redirect('pegawai/profil/'.$this->session->userdata('userId').'#datakeluarga');
    }

    function hapus($pk)
  	{
        $this->db->where('kode_role',$pk)->delete('tbl_roles');
        $this->session->set_flashdata('berhasil','Data berhasil di hapus');
        redirect('jabatan');
  	}

    /**

    public function updatefoto() {
        $id = $this->uri->segment(3);
 
        //$config['upload_path']         = 'assets/dist/fotopegawai/';  // foler upload 
        //$config['allowed_types']        = 'gif|jpg|png'; // jenis file
        //$config['max_size']             = 3000;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;

        $config = array(
                        'upload_path'=>'assets/dist/fotopegawai',
                        'allowed_types'=>'jpg|png|jpeg',
                        'max_size'=>3000
                        );
       
        $nip = $this->input->post('nip');

        $data_kode = array('id'=>$id);
        $foto = $this->db->get_where('pegawai',$data_kode);

        if($foto->num_rows()>0){
          $pros=$foto->row();
          $name=$pros->gambar;
         
          if(file_exists($lok=FCPATH.'assets/dist/fotopegawai'.$name)){
            unlink($lok);
          }}
     
            $this->load->library('upload',$config);
           
            if($this->upload->do_upload('foto')){
     
            $finfo = $this->upload->data();
            $nama_foto = $finfo['file_name'];

 
        
        }
            
            $data['tampil']=$this->mcrud->get_by_id($id); 
            $this->load->view('productedit',$data);
    }

    function updatex()
    {
        $id = $this->input->post('nip');

        $namafoto   = $this->input->post('namafoto');

      if($_FILES['namafoto']['name']!="")
            {
      $config['upload_path']   = './assets/dist/fotopegawai/';
      $config['allowed_types'] ='gif|jpg|png|jpeg';
      $config['max_size']      = 3000;
      $config['remove_space']  = TRUE;
        $this->load->library('upload', $config);
        if($this->upload->do_upload('namafoto')){
                $uploadData = $this->upload->data();
                $image = $uploadData['file'];
            }else{
                $image= '';
            }
        }else{
            $image = '';
        }

        $data = array(
          'nip'   => $id,
          'foto'  => $namafoto
         
          );
        if($image != ''){
          $data['foto'] = $image;
          unlink("./assets/dist/fotopegawai/$r->foto");
      }

        $this->db->update('pegawai',$data)->where('nip',$id);
        redirect('profil');
    }

    */

}