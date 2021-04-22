<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

require APPPATH . '/libraries/BaseController.php';

class Wilayah extends BaseController
{
	var $folder =   "wilayah";
    var $tables =   "wil_provinsi";
    var $pk     =   "kode_role";
    var $title  =   "FORM FILTER WILAYAH";

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();   
    }

	public function index()
	{
        $data['record']=  $this->db->get($this->tables)->result();
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $data['pk']=  $this->pk;

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = 'assets/images/logo_edc.png';
        
        $this->loadViews("page/wilayah/view", $this->global, $data , NULL);
    }

    

}