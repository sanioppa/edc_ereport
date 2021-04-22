<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

require APPPATH . '/libraries/BaseController.php';

class Absensi extends BaseController
{
	var $folder =   "absensi";
    var $tables =   "absensi";
    var $pk     =   "id_absensi";
    var $title  =   "DAFTAR KEHADIRAN KARYAWAN KLINIK MATA EDC GROUP";

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();   
    }

	public function index()
	{
        $tgl_awal  = $this->input->get('tgl_awal',TRUE);
        $tgl_akhir = $this->input->get('tgl_akhir',TRUE);
        //die($tgl_awal.'==='.$tgl_akhir);

        $data['record'] =  $this->db->join('tbl_users','tbl_users.nip=absensi.nip_pegawai')->get($this->tables)->result();
        $data['title']  =  $this->title;
        $data['desc']   =  "";
        $data['pk']     =  $this->pk;

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = 'assets/images/logo_edc.png';
        
        $this->loadViews("page/absensi/view", $this->global, $data , NULL);
        /*$this->load->view('petugas/anggota/view',$data);*/
    }

    function post()
    {
        $data['title']      = $this->title;
        $data['desc']       =   "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../assets/images/logo_edc.png';

        $this->loadViews("page/jabatan/post", $this->global, $data, NULL);
    }

    public function post2()
    {

    $data['roleId']           = $this->input->post('roleId',true);
	$data['id_role_atasan']   = $this->input->post('id_role_atasan',true);
	$data['role']             = $this->input->post('role',true);

    $this->db->insert($this->tables,$data);
    $this->session->set_flashdata('berhasil','Data berhasil di Tambah');
    redirect('jabatan');
    }

    function edit()
    {
        $data['record']  = $this->db->where('roleId',$this->uri->segment(3))->get($this->tables)->result();
        $data['title']   = $this->title;
        $data['desc']    = "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/jabatan/edit", $this->global, $data, NULL);
    }

    public function update()
    {

	$data['id_role_atasan']   = $this->input->post('id_role_atasan',true);
	$data['role']             = $this->input->post('role',true);

    $this->db->where('roleId',$this->uri->segment(3))->replace($this->tables,$data);
    $this->session->set_flashdata('berhasil','Data berhasil diperbarui');
    redirect('jabatan');
    }

    function hapus($pk)
  	{
    $this->db->where('roleId',$pk)->delete('tbl_roles');
    $this->session->set_flashdata('berhasil','Data berhasil di hapus');
    redirect('jabatan');
  	}

}
