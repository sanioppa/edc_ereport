<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id_user, BaseTbl.username, BaseTbl.name, BaseTbl.foto, BaseTbl.level');
        $this->db->from('tbl_users as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.username  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.level LIKE '%".$searchText."%'
                            OR  BaseTbl.foto  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return count($query->result());
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.id_user, BaseTbl.username, BaseTbl.name, BaseTbl.foto, BaseTbl.level');
        $this->db->from('tbl_users as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.kode_role = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.username  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.level LIKE '%".$searchText."%'
                            OR  BaseTbl.foto  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('kode_role, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getRoles() //GET FROM DATABASE ROLE
    {
        $this->db->select('*');
        $this->db->from('tbl_roles');
        $this->db->order_by('roleId','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function getLevel() //GET FROM DATABASE LEVEL
    {
        $this->db->select('*');
        $this->db->from('tbl_level');
        $this->db->order_by('id_level','ASC');
        $query = $this->db->get();
        return $query->result();

    }

    function getHumas() //GET FROM DATABASE USER
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->order_by('name','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function getOutlet() //GET FROM DATABASE OUTLET
    {
        $this->db->select('*');
        $this->db->from('tbl_outlet');
        $this->db->order_by('id_outlet','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function getKlasifikasi() //GET FROM DATABASE KLASIFIKASI
    {
        $this->db->select('*');
        $this->db->from('klasifikasi');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        return $query->result();

    }

    function getKlasifikasii($id_klasifikasi)
    {
        $hasil = $this->db->query("SELECT subnama_klasifikasi FROM 'klasifikasi' WHERE id_klasifikasi = '$id_klasifikasi' ORDER BY id ASC")->row();
        return $hasil->result();
    }

    function get_dat(){
        $this->db->select('jenis_kasus,id_daftar_kasus,id_screening');
        $result = $this->db->get('daftar_kasus_screening');
        return $result;
    }

    function Jum_kasus()
    {
        //$this->db->group_by('jurusan');
        $this->db->select('jenis_kasus');
        $this->db->select('id_daftar_kasus');
        return $this->db->from('daftar_kasus_screening')
          ->get()
          ->result();
    }

    // GRUP GRAFIK BY NAMA KLASIFIKASI ------------------------------------------------
    function kegiatanBranding()
    {
        //$this->db->group_by('jurusan');
        $this->db->select('id_klasifikasi');
        $this->db->select('nama_klasifikasi');
        $this->db->select('subnama_klasifikasi');
        $this->db->where('nama_klasifikasi', 'Branding');
        return $this->db->from('klasifikasi')
          ->get()
          ->result();
    }

    function kegiatanNetworking()
    {
        //$this->db->group_by('jurusan');
        $this->db->select('id_klasifikasi');
        $this->db->select('nama_klasifikasi');
        $this->db->select('subnama_klasifikasi');
        $this->db->where('nama_klasifikasi', 'Networking');
        return $this->db->from('klasifikasi')
          ->get()
          ->result();
    }

    function kegiatanDirectSelling()
    {
        //$this->db->group_by('jurusan');
        $this->db->select('id_klasifikasi');
        $this->db->select('nama_klasifikasi');
        $this->db->select('subnama_klasifikasi');
        $this->db->where('nama_klasifikasi', 'Direct Selling');
        return $this->db->from('klasifikasi')
          ->get()
          ->result();
    }

    function kegiatanDigitalMarketing()
    {
        //$this->db->group_by('jurusan');
        $this->db->select('id_klasifikasi');
        $this->db->select('nama_klasifikasi');
        $this->db->select('subnama_klasifikasi');
        $this->db->where('nama_klasifikasi', 'Digital Marketing');
        return $this->db->from('klasifikasi')
          ->get()
          ->result();
    }

    function kegiatanSosialMarketing()
    {
        //$this->db->group_by('jurusan');
        $this->db->select('id_klasifikasi');
        $this->db->select('nama_klasifikasi');
        $this->db->select('subnama_klasifikasi');
        $this->db->where('nama_klasifikasi', 'Sosial Marketing');
        return $this->db->from('klasifikasi')
          ->get()
          ->result();
    }

    function kegiatanAllKlasifikasi()
    {
        //$this->db->group_by('jurusan');
        $this->db->select('id_klasifikasi');
        $this->db->select('nama_klasifikasi');
        $this->db->select('subnama_klasifikasi');
        return $this->db->from('klasifikasi')
          ->get()
          ->result();
    }
    //BATAS GRUP GRAFIK BY NAMA KLASIFIKASI -------------------------------------------

    //GRUP COUNT BY KLASIFIKASI -------------------------------------------------------

    function countBR1($id_klasifikasi) //MEDIA MASSA
    {
        $countBR1 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countBR1->TOTAL;
    }

    function countBR2($id_klasifikasi) //MEDIA SOSIAL
    {
        $countBR2 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countBR2->TOTAL;
    }

    function countBR3($id_klasifikasi) //EVENT KHUSUS
    {
        $countBR3 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countBR3->TOTAL;
    }

    function countNW1($id_klasifikasi) //STAKE HOLDER
    {
        $countNW1 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countNW1->TOTAL;
    }

    function countNW2($id_klasifikasi) //BPJS, PUSKESMAS, INSTANSI
    {
        $countNW2 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countNW2->TOTAL;
    }

    function countNW3($id_klasifikasi) //TOKOH MASYARAKAT
    {
        $countNW3 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countNW3->TOTAL;
    }

    function countDS1($id_klasifikasi) //DOOR TO DOOR
    {
        $countDS1 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countDS1->TOTAL;
    }

    function countDS2($id_klasifikasi) //SCREENING
    {
        $countDS2 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countDS2->TOTAL;
    }

    function countDS3($id_klasifikasi) //PERUSAHAAN DAN ASURANSI
    {
        $countDS3 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countDS3->TOTAL;
    }

    function countDM1($id_klasifikasi) //MENCARI PASIEN DG TELEMARKETING / SOSMED
    {
        $countDM1 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countDM1->TOTAL;
    }

    function countDM2($id_klasifikasi) //MEMELIHARA HUBUNGAN DG DIGITAL/TELEMARKETING
    {
        $countDM2 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countDM2->TOTAL;
    }

    function countSM1($id_klasifikasi) //BAKTI SOSIAL
    {
        $countSM1 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countSM1->TOTAL;
    }

    function countSM2($id_klasifikasi) //BANTUAN SOSIAL
    {
        $countSM2 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countSM2->TOTAL;
    }

    function countSM3($id_klasifikasi) //KASUS / PEANANGNAN KHUSUS
    {
        $countSM3 = $this->db->query("SELECT COUNT(id_klasifikasi) AS TOTAL FROM kegiatan WHERE id_klasifikasi = '$id_klasifikasi'")->row();
        return $countSM3->TOTAL;
    }

    //BATAS GRUP COUNT BY KLASIFIKASI --------------------------------------------------

    function getJabatan($nip)
    {
    $jabatan = $this->db->query("SELECT roleId AS JABATAN FROM `tbl_users` WHERE nip = '$nip'")->row();
    return $jabatan->JABATAN;
    }

    function getJabatan2($kode_role)
    {
    $jabatan = $this->db->query("SELECT role AS JABATAN FROM `tbl_roles` WHERE kode_role = '$kode_role'")->row();
    return $jabatan->JABATAN;
    }

    function getOutlet2($id_perusahaan)
    {
    $outlet = $this->db->query("SELECT nama_perusahaan AS OUTLET FROM `m_perusahaan` WHERE id_perusahaan = '$id_perusahaan'")->row();
    return $outlet->OUTLET;
    }

    function getListRoles($nip)
    {
        $this->db->select('roleId');
        $this->db->from('tbl_users');
        $this->db->where('nip',$nip);
        $query = $this->db->get();
        return $query->result();
    }

    /*
    function getName()
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->order_by('nama','ASC');
        $query = $this->db->get();
        return $query->result();
    }
    */

    /*
    function getNameUser()
    {
        $this->db->select('name');
        $this->db->from('tbl_users');
        $this->db->where('nip !=', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
    */

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkUsernameExists($username, $userId = 0)
    {
        $this->db->select("username");
        $this->db->from("tbl_users");
        $this->db->where("username", $username);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }

    /*
    function getnama() 
    {
        
        $this->db->select('*');
        $this->db->from('pegawai');
        $query = $this->db->get();
        return $query->result();
    }
    */
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function addNewPegawai($userInfo,$peg)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);
        $this->db->insert('pegawai', $peg);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('userId, name, username, nip, roleId, foto');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', "ADMIN");
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getPegInfo($nip)
    {
        $this->db->select('kode_perusahaan');
        $this->db->from('pegawai');
        $this->db->where('nip', $nip);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getRoleInfo($roleId)
    {
        $this->db->select('id_role_atasan, roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 0);
        $this->db->where('id_role_atasan >', 0);
        $this->db->where('roleId', $roleId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function filterajuan ($jenis_cuti,$status_ajuan)
    {
        $this->db->where("jenis_cuti",$jenis_cuti);
        $this->db->where("status_ajuan",$status_ajuan);
        return $this->db->get("ajuan_cuti");
    }
    /*
    public function view()
    {
        return $this->db->get('tbl_users')->result(); // Tampilkan semua data yang ada di tabel siswa
    }
    */

    //HITUNG JUMLAH INBOX
    /*
    function data($number,$offset){
		return $query = $this->db->get('inbox',$number,$offset)->result();		
	}
 
	function jumlah_data(){
		return $this->db->get('inbox')->num_rows();
    }
    */
    
    public function view(){
        $this->load->library('pagination'); // Load librari paginationnya
        
        $query = "SELECT * FROM kegiatan"; // Query untuk menampilkan semua data inbox
        
        $config['base_url'] = base_url('kegiatan');
        $config['total_rows'] = $this->db->query($query)->num_rows();
        $config['per_page'] = 2;
        $config['uri_segment'] = 3;
        $config['num_links'] = 3;
        
        // Style Pagination
        // Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
        $config['full_tag_open']   = '<ul class="pagination pagination-sm m-t-xs m-b-xs">';
            $config['full_tag_close']  = '</ul>';
            
            $config['first_link']      = 'First'; 
            $config['first_tag_open']  = '<li>';
            $config['first_tag_close'] = '</li>';
            
            $config['last_link']       = 'Last'; 
            $config['last_tag_open']   = '<li>';
            $config['last_tag_close']  = '</li>';
            
            $config['next_link']       = ' <i class="glyphicon glyphicon-menu-right"></i> '; 
            $config['next_tag_open']   = '<li>';
            $config['next_tag_close']  = '</li>';
            
            $config['prev_link']       = ' <i class="glyphicon glyphicon-menu-left"></i> '; 
            $config['prev_tag_open']   = '<li>';
            $config['prev_tag_close']  = '</li>';
            
            $config['cur_tag_open']    = '<li class="active"><a href="#">';
            $config['cur_tag_close']   = '</a></li>';
             
            $config['num_tag_open']    = '<li>';
            $config['num_tag_close']   = '</li>';
            // End style pagination
        
        $this->pagination->initialize($config); // Set konfigurasi paginationnya
        
        $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
        $query .= " LIMIT ".$page.", ".$config['per_page'];
        
        $data['limit'] = $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links(); // Generate link pagination nya sesuai config diatas
        $data['kegiatan'] = $this->db->query($query)->result();
        
        return $data;
    } 

    // Fetch records
    public function getData($rowno,$rowperpage) {
 
        $this->db->select('*');
        $this->db->from('kegiatan');
        $this->db->limit($rowperpage, $rowno);  
        $query = $this->db->get();
     
        return $query->result_array();
    }

    // Select total records
    public function getrecordCount() {

        $this->db->select('count(*) as allcount');
        $this->db->from('kegiatan');
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }

}

  