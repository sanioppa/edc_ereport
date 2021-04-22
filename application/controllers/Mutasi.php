<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

require APPPATH . '/libraries/BaseController.php';

class Mutasi extends BaseController
{
	var $folder   =   "pegawai";
    var $tables   =   "pegawai";
    var $tables2  =   "tbl_roles";
    var $tables3  =   "tbl_users";
    var $tables4  =   "riwayat_mutasi";
    var $keluarga =   "data_keluarga";
    var $cuti     =   "ajuan_cuti";
    var $pk       =   "id_pegawai";
    var $pk2      =   "kode_role";
    var $pk3      =   "id_role_atasan";
    var $title    =   "PILIH PEGAWAI UNTUK DI MUTASI JABATAN";

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

        $data['outlet']  = $this->user_model->getOutlet();
        $data['jabatan'] = $this->user_model->getRoles();

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = 'assets/images/logo_edc.png';
        
        $this->loadViews("page/mutasi/listpegawai", $this->global, $data , NULL);
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
                    } ?>
                  </td>
                  <td>
                    <center>
                    <a href="<?=site_url('mutasi/edit/'.$r->nip);?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i> Ubah Jabatan</a>
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

    function edit($id)
    {
        $data['jabatan'] = $this->user_model->getRoles();
        $data['outlet']  = $this->user_model->getOutlet();
        $data['record'] = $this->db->where('nip',$id)->get('pegawai')->result();
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/mutasi/edit", $this->global, $data, NULL);
    }

    public function update_mutasi()
    {
        $kd = $this->input->post('nip',true);

        $data['nip']         = $this->input->post('nip',true);
        $data['nama']        = $this->input->post('nama',true);
        $data['nomor_sk']    = $this->input->post('nomor_sk',true);
        $data['eks_jabatan1']= $this->input->post('eksjabatan1',true);
        $data['jabatan1']    = $this->input->post('jabatan1',true);
        $data['eks_jabatan2']= $this->input->post('eksjabatan2',true);
        $data['jabatan2']    = $this->input->post('jabatan2',true);
        $data['outlet']      = $this->input->post('outlet',true);
        $data['eks_outlet']  = $this->input->post('outlet',true);
        $data['tgl_mutasi']  = $this->input->post('tgl_mutasi',true);
        $data['keterangan']  = $this->input->post('keterangan',true);

        $data2['nip']             = $this->input->post('nip',true);
        $data2['nama']            = $this->input->post('nama',true);
        $data2['kode_role']       = $this->input->post('jabatan1',true);
        $data2['kode_role2']      = $this->input->post('jabatan2',true);
        $data2['kode_perusahaan'] = $this->input->post('outlet',true);

        $data3['nip']        = $this->input->post('nip',true);
        $data3['name']       = $this->input->post('nama',true);
        $data3['roleId']     = $this->input->post('jabatan1',true);
        //$data3['roleId2']    = $this->input->post('jabatan2',true);

        $this->db->insert('riwayat_mutasi',$data);
        $this->db->where('nip',$kd)->update('pegawai',$data2);
        $this->db->where('nip',$kd)->update('tbl_users',$data3);
        $this->session->set_flashdata('berhasil','Data Mutasi berhasil Ditambahkan');
        redirect('mutasi');
        /*
        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            redirect('pegawai/detail/'.$this->input->post('nip_pegawai'));
        }
        */
       
    }

    public function riwayat_mutasi()
    {
        $data['record'] =  $this->db->
            join('m_perusahaan', 'm_perusahaan.id_perusahaan = riwayat_mutasi.outlet')->
            join('tbl_roles', 'tbl_roles.kode_role = riwayat_mutasi.jabatan1')->
            //join('')
            get($this->tables4)->result();
        $data['outlet']  = $this->user_model->getOutlet();

        $data['title']  =  $this->title;
        $data['desc']   =  "";
        $data['pk']     =  $this->pk;

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../assets/images/logo_edc.png';
        
        $this->loadViews("page/mutasi/riwayat_mutasi", $this->global, $data , NULL);
        /*$this->load->view('petugas/anggota/view',$data);*/
    }

    public function load_riwayat_mutasi()
    {
        //$jenis_cuti   = $_GET['jenis_cuti'];
        $tahun   = $_GET['tahun'];
        $bulan   = $_GET['bulan'];
        $outlet  = $_GET['outlet'];
        if ($tahun == '0' && $bulan == '0' && $outlet == '0') { //SEMUA DATA TAMPIL
            $data = $this->db->join('pegawai','pegawai.nip=riwayat_mutasi.nip')->get('riwayat_mutasi')->result();
        }else if ($outlet == '0' && $bulan == '0' && $tahun != '0') { //BERDASARKAN TAHUN
            $data = $this->db->join('pegawai','pegawai.nip=riwayat_mutasi.nip')->get_where('riwayat_mutasi', ['year(tgl_mutasi)'=>$tahun])->result();
        }else if ($outlet == '0' && $bulan != '0' && $tahun == '0') { //BERDASARKAN BULAN
            $data = $this->db->join('pegawai','pegawai.nip=riwayat_mutasi.nip')->get_where('riwayat_mutasi', ['month(tgl_mutasi)'=>$bulan])->result();
        }else if ($outlet == '0' && $tahun != '0' && $bulan != '0') { //BERDASARKAN TAHUN & BULAN
            $data = $this->db->join('pegawai','pegawai.nip=riwayat_mutasi.nip')->get_where('riwayat_mutasi', ['year(tgl_mutasi)'=>$tahun, 'month(tgl_mutasi)'=>$bulan])->result();
        }else if ($outlet != '0' && $tahun != '0' && $bulan == '0') { //BERDASARKAN TAHUN & STATUS
            $data = $this->db->join('pegawai','pegawai.nip=riwayat_mutasi.nip')->get_where('riwayat_mutasi', ['year(tgl_mutasi)'=>$tahun, 'outlet'=>$outlet])->result();
        }else if ($outlet != '0' && $tahun == '0' && $bulan != '0') { //BERDASARKAN BULAN & STATUS
            $data = $this->db->join('pegawai','pegawai.nip=riwayat_mutasi.nip')->get_where('riwayat_mutasi', ['month(tgl_mutasi)'=>$bulan, 'outlet'=>$outlet])->result();
        }else if ($tahun == '0' && $bulan == '0' && $outlet != '0') { //BERDASARKAN STATUS
            $data = $this->db->join('pegawai','pegawai.nip=riwayat_mutasi.nip')->get_where('riwayat_mutasi', ['outlet'=>$outlet])->result();
        }else{ //BERDASARKAN TAHUN & BULAN & STATUS
            $data = $this->db->join('pegawai','pegawai.nip=riwayat_mutasi.nip')->get_where('riwayat_mutasi', array('year(tgl_ajuan)'=>$tahun,'month(tgl_ajuan)'=>$bulan,'outlet'=>$outlet))->result();
        }
        if (!empty($data)){
            $no=1;
            foreach($data as $r) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $r->nama ?></td>
                  <td><?= $r->nomor_sk ?></td>
                  <td><?= tgl_indo($r->tgl_mutasi) ?></td>
                  <td><?= $this->user_model->getJabatan2($r->jabatan1); ?></td>
                  <td><?= $r->jabatan2 ?></td>
                  <td><?= $this->user_model->getOutlet2($r->outlet); ?></td>
                  <td><?= $r->keterangan ?></td>
                  <td>
                    <center>
                    <?php
                    if($this->isAdmin() == FALSE) //ADMIN
                    { ?>
                      <a href="<?=site_url('mutasi/edit_riwayat_mutasi/'.$r->id_riwayat_mutasi);?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="<?=site_url('mutasi/delete_riwayat_mutasi/'.$r->id_riwayat_mutasi);?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus?')" title="Hapus"><i class="fa fa-trash"></i></a>
                      <a href="<?=site_url('mutasi/#/'.$r->id_riwayat_mutasi);?>" class="btn btn-primary btn-xs" title="Lihat"><i class="fa fa-eye"></i></a>
                      <a href="<?=site_url('riwayat_mutasi/lihatpdf/'.$r->id_riwayat_mutasi);?>" class="btn btn-warning btn-xs" target="_blank" title="Download"><i class="fa fa-download"></i></a>
                      <?php
                    }else{ ?>
                      <a href="<?=site_url('ajuancuti/edit/'.$r->id_ajuan_cuti);?>" class="btn btn-success btn-xs" <?= $disabled ?> title="Edit"><i class="fa fa-edit"></i></a>
                      <button class="btn btn-xs btn-danger" <?= $disabled ?> onclick="return confirm('Yakin Hapus?')"><i class="fa fa-trash"></i></button>
                      <a href="<?=site_url('laporanpdf');?>" class="btn btn-success btn-xs" <?= $disabled ?> title="Edit"><i class="fa fa-edit"></i></a>
                    <?php
                    }
                    ?>
                    </center>
                  </td>
                </tr>
            <?php endforeach; ?> <?php
        }else{
            ?> <tr><td colspan="9" align="center">Tidak ada data</td></tr> <?php
        }
        
    }

    function edit_riwayat_mutasi($id)
    {
        $data['jabatan'] = $this->user_model->getRoles();
        $data['outlet']  = $this->user_model->getOutlet();
        $data['record'] = $this->db->where('id_riwayat_mutasi',$this->uri->segment(3))->get('riwayat_mutasi')->result();
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/mutasi/edit_riwayat_mutasi", $this->global, $data, NULL);
    }

    public function update_riwayat_mutasi()
    {
        $kd  = $this->input->post('nip',true);
        $kdm = $this->input->post('id_riwayat_mutasi',true);

        $data['nip']         = $this->input->post('nip',true);
        $data['nama_mutasi'] = $this->input->post('nama',true);
        $data['nomor_sk']    = $this->input->post('nomor_sk',true);
        //$data['eks_jabatan1']= $this->input->post('eksjabatan1',true);
        $data['jabatan1']    = $this->input->post('jabatan1',true);
        //$data['eks_jabatan2']= $this->input->post('eksjabatan2',true);
        $data['jabatan2']    = $this->input->post('jabatan2',true);
        $data['outlet']      = $this->input->post('outlet',true);
        //$data['eks_outlet']  = $this->input->post('outlet',true);
        $data['tgl_mutasi']  = $this->input->post('tgl_mutasi',true);
        $data['keterangan']  = $this->input->post('keterangan',true);

        $data2['nip']             = $this->input->post('nip',true);
        $data2['nama']            = $this->input->post('nama',true);
        $data2['kode_role']       = $this->input->post('jabatan1',true);
        $data2['kode_role2']      = $this->input->post('jabatan2',true);
        $data2['kode_perusahaan'] = $this->input->post('outlet',true);

        $data3['nip']        = $this->input->post('nip',true);
        $data3['name']       = $this->input->post('nama',true);
        $data3['roleId']     = $this->input->post('jabatan1',true);
        //$data3['roleId2']    = $this->input->post('jabatan2',true);

        $this->db->where('id_riwayat_mutasi',$kdm)->update('riwayat_mutasi',$data);
        $this->db->where('nip',$kd)->update('pegawai',$data2);
        $this->db->where('nip',$kd)->update('tbl_users',$data3);
        $this->session->set_flashdata('berhasil','Data Riwayat Mutasi berhasil diperbarui');
        redirect('mutasi/riwayat_mutasi');
        /*
        if ($this->session->userdata('level') == 'pegawai') {
            redirect('pegawai/profil/'.$this->session->userdata('userId'));
        }else{
            redirect('pegawai/detail/'.$this->input->post('nip_pegawai'));
        }
        */
       
    }

    function delete_riwayat_mutasi($pk)
    {
        $this->db->where('id_riwayat_mutasi',$pk)->delete('riwayat_mutasi');
        $this->session->set_flashdata('berhasil','Data Riwayat berhasil di hapus');
        redirect('riwayat_mutasi');
    }
}