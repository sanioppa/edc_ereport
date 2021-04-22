<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_model extends CI_Model {

public function __construct()
 {
 parent::__construct();
 $this->load->database();
 }

	// Listing
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('tbl_users');
		$query = $this->db->get();
		return $query->result();
	}

  public function view(){
    return $this->db->get('tbl_users')->result(); // Tampilkan semua data yang ada di tabel siswa
  }
}


/* End of file User_model.php */
/* Location: ./application/models/User_model.php */