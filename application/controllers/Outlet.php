<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

require APPPATH . '/libraries/BaseController.php';

class Outlet extends BaseController
{
	var $folder =   "outlet";
    var $tables =   "m_perusahaan";
    var $pk     =   "id_perusahaan";
    var $title  =   "DAFTAR OUTLET KLINIK MATA EDC GROUP";

	/*public function __construct()
	{
		parent::__construct();
		$logged_in = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(empty($logged_in))
		{
			redirect('home');
		}
		if($level != 'petugas')
		{
			redirect('home');
		}
	} */
	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();   
    }

	public function index()
	{
        $data['record']=  $this->db->from($this->tables)->order_by('m_perusahaan.id asc')->get()->result();
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $data['pk']=  $this->pk;

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = 'assets/images/logo_edc.png';
        
        $this->loadViews("page/outlet/view", $this->global, $data , NULL);
        /*$this->load->view('petugas/anggota/view',$data);*/
    }

    public function detail()
	{
        $kode 			= $this->uri->segment(3);
        $data['record'] = $this->db->where('id_perusahaan',$kode)->get($this->tables)->result();
        $data['title']  = $this->title;
        $data['desc']   = "";

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/outlet/detail", $this->global, $data, NULL);
        //$this->load->view('page/outlet/detail',$data);
    }

    public function post2()
    {

    $data['id_perusahaan']     = $this->input->post('id_perusahaan',true);
	$data['nama_perusahaan']   = $this->input->post('nama_perusahaan',true);
	$data['alamat_perusahaan'] = $this->input->post('alamat_perusahaan',true);
	$data['kode_pos']          = $this->input->post('kode_pos',true);
	$data['no_telpon']         = $this->input->post('no_telpon',true);
	$data['email']             = $this->input->post('email',true);
	$data['kota']              = $this->input->post('kota',true);
	$data['token_bpjs']        = $this->input->post('token_bpjs',true);
	$data['secretkey']         = $this->input->post('secretkey',true);

    $this->db->insert($this->tables,$data);
    $this->session->set_flashdata('berhasil','Data berhasil di Tambah');
    redirect('outlet');
    }

    function post()
    {
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../assets/images/logo_edc.png';

        $this->loadViews("page/outlet/post", $this->global, $data, NULL);
    }

    function edit()
    {
        $data['record']  = $this->db->where('id_perusahaan',$this->uri->segment(3))->get($this->tables)->result();
        $data['title']   = $this->title;
        $data['desc']    = "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/outlet/edit", $this->global, $data, NULL);
    }

    public function update()
    {

    $data['id_perusahaan']     = $this->input->post('id_perusahaan',true);
	$data['nama_perusahaan']   = $this->input->post('nama_perusahaan',true);
	$data['alamat_perusahaan'] = $this->input->post('alamat_perusahaan',true);
	$data['kode_pos']          = $this->input->post('kode_pos',true);
	$data['no_telpon']         = $this->input->post('no_telpon',true);
	$data['email']             = $this->input->post('email',true);
	$data['kota']              = $this->input->post('kota',true);
	$data['token_bpjs']        = $this->input->post('token_bpjs',true);
	$data['secretkey']         = $this->input->post('secretkey',true);

    $this->db->where('id_perusahaan',$this->uri->segment(3))->replace($this->tables,$data);
    $this->session->set_flashdata('berhasil','Data berhasil diperbarui');
    redirect('outlet');
    }

    function hapus($pk)
  	{
    $this->db->where('id_perusahaan',$pk)->delete('m_perusahaan');
    $this->session->set_flashdata('berhasil','Data berhasil di hapus');
    redirect('outlet');
  	}

}