<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

// Load database
 public function __construct() {
 parent::__construct();
 $this->load->model('excel_model');
 }

public function index() {
 $data = array( 'title' => 'Data user',
 'user' => $this->excel_model->listing());
 $this->load->view('excel/view',$data);
 }

public function export_excel(){
 $data = array( 'title' => 'Laporan Excel',
 'user' => $this->excel_model->listing());
 $this->load->view('excel/cetak_excel',$data);
 }

}

/* End of file Excel.php */
/* Location: ./application/controllers/Excel.php */