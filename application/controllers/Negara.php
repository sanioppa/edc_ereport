<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

require APPPATH . '/libraries/BaseController.php';

class Negara extends BaseController
{
	var $folder =   "negara";
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
        $this->curl->http_header('X-RapidAPI-lost','restcountries-v1.p.rapidapi.com');
        $this->curl->http_header('X-RapidAPI-Key','099ff689a8mshed8ae5ec0968cbbp151ccajsn1ac40a4b825e');
        $this->curl->create('https://restcountries-v1.p.rapidapi.com/all');
        $result = $this->curl->execute();
        //print_r($result);exit();

        $data['negara'] = json_decode($result);

        $this->global['logo']      = 'assets/images/logo_edc.png';
        $this->global['pageTitle'] = 'EDC Arsip Surat';

        $this->loadViews("page/negara/list_negara", $this->global, $data , NULL);
    }

}
